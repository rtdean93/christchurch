<?php 
// Adapted from a combination of Joomla content.search and livesearch
/**
* @version $Id: content.searchbot.php 2444 2006-02-17 18:59:08Z stingrey $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 Bitflux GmbH                                      |
// +----------------------------------------------------------------------+
// | Licensed under the Apache License, Version 2.0 (the "License");      |
// | you may not use this file except in compliance with the License.     |
// | You may obtain a copy of the License at                              |
// | http://www.apache.org/licenses/LICENSE-2.0                           |
// | Unless required by applicable law or agreed to in writing, software  |
// | distributed under the License is distributed on an "AS IS" BASIS,    |
// | WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or      |
// | implied. See the License for the specific language governing         |
// | permissions and limitations under the License.                       |
// +----------------------------------------------------------------------+
// | Author: Bitflux GmbH <devel@bitflux.ch>                              |
// +----------------------------------------------------------------------+

define( '_VALID_MOS', 1 );
define( '_BASEPATH', dirname(__FILE__) );

include_once( _BASEPATH.'/../../../globals.php' );
require_once( _BASEPATH.'/../../../configuration.php' );
require_once( _BASEPATH.'/../../../includes/joomla.php' );

// loads english language file by default
if ($mosConfig_lang=='') {
	$mosConfig_lang = 'english';
}
include_once( $mosConfig_absolute_path .'/language/' . $mosConfig_lang . '.php' );
$iso = explode( '=', _ISO );
header('Content-type: text/html; charset='. $iso[1]);

global $database;
global $mosConfig_offset;
	
$text = mosGetParam( $_GET, 's', '' );
$text = $database->getEscaped( $text );

$id=0;
$order = 'a.created ASC';
$morder = 'a.title ASC';
$limit 		= 15;
$phrase='';

$nullDate 	= $database->getNullDate();
$now 		= date( 'Y-m-d H:i:s', time()+$mosConfig_offset*60*60 );
	
$text = trim( $text );
if ($text == '') {
	return array();
}

$words = explode( ' ', $text );
$wheres = array();
foreach ($words as $word) {
	$wheres2 	= array();
	$wheres2[] 	= "LOWER(a.title) LIKE '%$word%'";
	$wheres2[] 	= "LOWER(a.introtext) LIKE '%$word%'";
	$wheres2[] 	= "LOWER(a.fulltext) LIKE '%$word%'";
	$wheres2[] 	= "LOWER(a.metakey) LIKE '%$word%'";
	$wheres2[] 	= "LOWER(a.metadesc) LIKE '%$word%'";
	$wheres[] 	= implode( ' OR ', $wheres2 );
	}
$where = '(' . implode( ($phrase == 'all' ? ') AND (' : ') OR ('), $wheres ) . ')';

// search content items
$query = "SELECT a.id, a.title AS title,"
	. "\n a.id, a.created AS created,"
	. "\n CONCAT(a.introtext, a.fulltext) AS text,"
	. "\n CONCAT_WS( '/', u.title, b.title ) AS section,"
	. "\n CONCAT( 'index.php?option=com_content&task=view&id=', a.id, '&Itemid=', m.id ) AS href,"
	. "\n '2' AS browsernav"
	. "\n FROM #__content AS a"
	. "\n INNER JOIN #__categories AS b ON b.id=a.catid"
	. "\n INNER JOIN #__sections AS u ON u.id = a.sectionid"
	. "\n LEFT JOIN #__menu AS m ON m.componentid = a.id"	
	. "\n WHERE ( $where )"
	. "\n AND a.state = 1"
	. "\n AND u.published = 1"
	. "\n AND b.published = 1"
	. "\n AND a.access <= $id"
	. "\n AND b.access <= $id"
	. "\n AND u.access <= $id"
	. "\n AND ( publish_up = '$nullDate' OR publish_up <= '$now' )"
	. "\n AND ( publish_down = '$nullDate' OR publish_down >= '$now' )"
	. "\n GROUP BY a.id"
	. "\n ORDER BY $order"
	;
$database->setQuery( $query, 0, $limit );
$list = $database->loadObjectList();

// search static content
$query = "SELECT a.id, a.title AS title, a.created AS created,"
	. "\n a.id, a.introtext AS text,"
	. "\n CONCAT( 'index.php?option=com_content&task=view&id=', a.id, '&Itemid=', m.id ) AS href,"
	. "\n '2' as browsernav, 'Menu' AS section"
	. "\n FROM #__content AS a"
	. "\n LEFT JOIN #__menu AS m ON m.componentid = a.id"
	. "\n WHERE ($where)"
	. "\n AND a.state = 1"
	. "\n AND a.access <= $id"
	. "\n AND m.type = 'content_typed'"
	. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now' )"
	. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )"
	. "\n ORDER BY ". ($morder ? $morder : $order)
	;
	$database->setQuery( $query, 0, $limit );
	$list2 = $database->loadObjectList();

	// search archived content
$query = "SELECT a.id, a.title AS title,"
	. "\n a.id, a.created AS created,"
	. "\n a.introtext AS text,"
	. "\n CONCAT_WS( '/', '". _SEARCH_ARCHIVED ." ', u.title, b.title ) AS section,"
	. "\n CONCAT( 'index.php?option=com_content&task=view&id=', a.id, '&Itemid=', m.id ) AS href,"
	. "\n '2' AS browsernav"
	. "\n FROM #__content AS a"
	. "\n INNER JOIN #__categories AS b ON b.id=a.catid"
	. "\n INNER JOIN #__sections AS u ON u.id = a.sectionid"
	. "\n LEFT JOIN #__menu AS m ON m.componentid = a.id"	
	. "\n WHERE ( $where )"
	. "\n AND a.state = -1"
	. "\n AND u.published = 1"
	. "\n AND b.published = 1"
	. "\n AND a.access <= $id"
	. "\n AND b.access <= $id"
	. "\n AND u.access <= $id"
	. "\n AND ( publish_up = '0000-00-00 00:00:00' OR publish_up <= '$now' )"
	. "\n AND ( publish_down = '0000-00-00 00:00:00' OR publish_down >= '$now' )"
	. "\n ORDER BY $order"
	;
$database->setQuery( $query, 0, $limit );
$list3 = $database->loadObjectList();
$searchResult= array_merge( $list, $list2, $list3 );

?>
<div id="LSRes"><?php if ( $searchResult) { for ($i=0;$i<count($searchResult);$i++) { ?>
<div class="LSRow"><a href="<?php echo $searchResult[$i]->href ?>" rel="bookmark" title="Link: <?php echo $searchResult[$i]->title; ?>"><?php echo $searchResult[$i]->title; ?></a>
</div><?php } } else { ?>No Results<?php } ?>
</div>
<?php

function checkCurrentOS( $_OS )
{
   if ( strcmp( $_OS, _CUR_OS ) == 0 ) {
       return true;
   }
   return false;
}

function isRelative( $_dir )
{
   if ( checkCurrentOS( "Win" ) ) {
       return ( preg_match( "/^\w+:/", $_dir ) <= 0 );
   }
   else {
       return ( preg_match( "/^\//", $_dir ) <= 0 );
   }
}

function unifyPath( $_path )
{
   if ( checkCurrentOS( "Win" ) ) {
       return str_replace( "\\", _PL_OS_SEP, $_path );
   }
   return $_path;
}

function getRealpath( $_path )
{
   /*
     * This is the starting point of the system root.
     * Left empty for UNIX based and Mac.
     * For Windows this is drive letter and semicolon.
     */
   $__path = $_path;
   if ( isRelative( $_path ) ) {
       $__curdir = unifyPath( realpath( "." ) . _PL_OS_SEP );
       $__path = $__curdir . $__path;
   }
   $__startPoint = "";
   if ( checkCurrentOS( "Win" ) ) {
       list( $__startPoint, $__path ) = explode( ":", $__path, 2 );
       $__startPoint .= ":";
   }
   # From now processing is the same for WIndows and Unix, and hopefully for others.
   $__realparts = array( );
   $__parts = explode( _PL_OS_SEP, $__path );
   for ( $i = 0; $i < count( $__parts ); $i++ ) {
       if ( strlen( $__parts[ $i ] ) == 0 || $__parts[ $i ] == "." ) {
           continue;
       }
       if ( $__parts[ $i ] == ".." ) {
           if ( count( $__realparts ) > 0 ) {
               array_pop( $__realparts );
           }
       }
       else {
           array_push( $__realparts, $__parts[ $i ] );
       }
   }
   return $__startPoint . _PL_OS_SEP . implode( _PL_OS_SEP, $__realparts );
}


?>