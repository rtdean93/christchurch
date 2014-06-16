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

// This is livesearch is based on mod_shep by Jomres (http://www.jomres.net)

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
global $mosConfig_live_site, $mainframe;

$button			= $params->get( 'button', '' );
$button_pos		= $params->get( 'button_pos', 'left' );
$button_text	= $params->get( 'button_text', _SEARCH_TITLE );
$width 			= intval( $params->get( 'width', 20 ) );
$text 			= $params->get( 'text', _SEARCH_BOX );
$set_Itemid		= intval( $params->get( 'set_itemid', 0 ) );
$clickresults 	= $params->get( 'clickresults', 'Click a result' );

$url = $mosConfig_live_site . "/templates/" . $mainframe->getTemplate() . "/";

// set Itemid id for links
if ( $set_Itemid ) {
	// use param setting
	$_Itemid	= $set_Itemid;
	$link 		= 'index.php?option=com_search&amp;Itemid='. $set_Itemid;
} else {
	$query = "SELECT id"
	. "\n FROM #__menu"
	. "\n WHERE link = 'index.php?option=com_search'"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();
	
	// try to auto detect search component Itemid
	if ( count( $rows ) ) {
		$_Itemid	= $rows[0]->id;
		$link 		= 'index.php?option=com_search&amp;Itemid='. $_Itemid;
	} else {
	// Assign no Itemid
		$_Itemid 	= '';
		$link 		= 'index.php?option=com_search';	
	}
}
?>

    <div>
		<div class="thedate"><?php echo mosCurrentDate(); ?></div>
		<form id="searchform" method="get" action="<?php echo $link; ?>" onsubmit="return liveSearchSubmit()">
			<input id="livesearch" name="searchword" onkeypress="liveSearchStart('<?php echo $url; ?>')" size="15" value="live search..."  onblur="if(this.value=='') this.value='live search...';" onfocus="if(this.value=='live search...') this.value='';" /><br/>
			<input type="submit" id="searchsubmit" style="display: none;" value="Search" />
			<div id="LSResult" style="display: none;"><div id="LSShadow"></div></div>
			<input type="hidden" name="option" value="com_search" />
			<input type="hidden" name="Itemid" value="<?php echo $_Itemid; ?>" />
		</form>

    </div>
	