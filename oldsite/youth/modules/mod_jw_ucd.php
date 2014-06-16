<?php
/*
// JW "Ultimate Content Display" Module for Joomla! 1.0.x - Version 1.0
// License: http://www.gnu.org/copyleft/gpl.html
// Authors: Fotis Evangelou - George Chouliaras - Luca Scarpa
// Copyright (c) 2006 - 2007 JoomlaWorks.gr - http://www.joomlaworks.gr
// Project page at http://www.joomlaworks.gr - Demos at http://demo.joomlaworks.gr
// Support forum at http://forum.joomlaworks.gr
// ***Last update: June 7th, 2007***
*/

/** ensure this file is being included by a parent file */
defined('_VALID_MOS' ) or die('Direct Access to this location is not allowed.' );

global $mosConfig_locale,$mosConfig_offset,$mosConfig_lang,$mosConfig_live_site,$mosConfig_absolute_path,$mainframe,$my;

// Module Parameters
$moduleclass_sfx		= $params->get('moduleclass_sfx','');
$uniqueid 				= trim($params->get('uniqueid','ajaxfader'));

// Content retrieval settings
$where					= $params->get('where','category');
$where_id				= trim( $params->get('where_id',''));
$ordering				= $params->get('ordering','rdate');
$count					= intval($params->get('count',5));
$show_front 			= intval($params->get('show_front',0));
$show_section_title 	= intval($params->get('show_section_title',1));
$show_category_title 	= intval($params->get('show_category_title',1));
$seperator 				= trim($params->get('seperator','&gt;&gt;'));

// Item display settings
$display				= intval($params->get('display',2));
$linked					= intval($params->get('linked',1));
$chars					= intval($params->get('chars',''));
$words					= intval($params->get('words',''));
$more					= intval($params->get('more',1));
$datecreated			= intval($params->get('datecreated',1));
$plugins				= intval($params->get('plugins',1));
$hideimages				= intval($params->get('hideimages',0));
$striptags 				= intval($params->get('striptags',0));
$allowed_tags 			= $params->get('allowed_tags',"<br><br /><a><b><i><u><span>"); // these tags will NOT be stripped off!

// DISPLAY TYPES Parameters - list/jqueryfader/ajaxfader
$udc_displaytype		= $params->get('udc_displaytype','list');

// if display type is AJAX Fader
$charset				= $params->get('charset','');
$udc_ajf_width 			= $params->get('udc_ajf_width','');
$udc_ajf_height 		= $params->get('udc_ajf_height','');
$udc_ajf_delay			= intval($params->get('udc_ajf_delay',6000));
$udc_ajf_cache			= intval($params->get('udc_ajf_cache',0));
$udc_ajf_bgcolor		= $params->get('udc_ajf_bgcolor','');
$udc_ajf_bottomfade 	= intval($params->get('udc_ajf_bottomfade',0));

/*
if display type is JQuery Fader
$('ID or class of the element containing the fading objects').innerfade({
	animationtype: 		Type of animation 'fade' or 'slide' (Default: 'fade'),
	speed: 				Fadingspeed in milliseconds or keywords (slow, normal or fast)(Default: 'normal'),
	timeout: 			Time between the fades in milliseconds (Default: '2000'),
	type: 				Type of slideshow: 'sequence' or 'random' (Default: 'sequence'),
	containerheight: 	Height of the containing element in any css-height-value (Default: 'auto'),
	runningclass: 		CSS-Class which the container get's applied (Default: 'innerfade')
});
*/
$udc_jqf_cheight		= $params->get('udc_jqf_cheight','');
$udc_jqf_anim			= $params->get('udc_jqf_anim','fade');
$udc_jqf_speed			= intval($params->get('udc_jqf_speed',750));
$udc_jqf_timeout		= intval($params->get('udc_jqf_timeout',6000));
$udc_jqf_bgcolor		= $params->get('udc_jqf_bgcolor','');
$udc_jqf_bottomfade 	= intval($params->get('udc_jqf_bottomfade',0));

// Content retrieval
if ($where == 'section' OR $where == 'category' OR $where == 'content') {
	// source is content section/category/item
	$now		= date( 'Y-m-d H:i:s', time() + $mosConfig_offset * 60 * 60 );
	$access		= !$mainframe->getCfg( 'shownoauth' );
	switch ( $ordering ) {
		case 'random':
      		$orderby = 'RAND()';
      		break;	
		case 'date':
			$orderby = 'a.created';
			break;
		case 'rdate':
			$orderby = 'a.created DESC';
			break;
		case 'alpha':
			$orderby = 'a.title';
			break;
		case 'ralpha':
			$orderby = 'a.title DESC';
			break;
		case 'hits':
			$orderby = 'a.hits DESC';
			break;
		case 'rhits':
			$orderby = 'a.hits ASC';
			break;
		case 'order':
		default:
			$orderby = 'a.ordering';
			break;
	}
	// select between content, section, category
	switch ( $where ) {
		case 'content':
			$where_clause = "\n AND ( a.id IN (". $where_id .") )";
			break;
		case 'section':  // retrieve content item from specified section
			$where_clause = "\n AND ( a.sectionid IN (". $where_id .") )";
			break;
		case 'category':  // retrieve content item from specified category
		default:
			$where_clause = "\n AND ( a.catid IN (". $where_id .") )";
			break;
	}
	$query = "SELECT a.id, a.catid, a.sectionid, a.title, a.created, a.introtext, a.fulltext, a.images, a.attribs AS `params`"
	. "\n FROM #__content AS a"
	. "\n LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id"
	. "\n WHERE ( a.state = '1' AND a.checked_out = '0' AND a.sectionid > '0' )"
	. "\n AND ( a.publish_up = '0000-00-00 00:00:00' OR a.publish_up <= '". $now ."' )"
	. "\n AND ( a.publish_down = '0000-00-00 00:00:00' OR a.publish_down >= '". $now ."' )"
   	. ( $access ? "\n AND a.access <= '". $my->gid ."'" : '' )
   	. ( $show_front == "0" ? "\n AND f.content_id IS NULL" : '' )
	. $where_clause
	. "\n ORDER BY $orderby LIMIT 0,$count"
	;	
	$database->setQuery( $query );
	$rows = $database->loadObjectList();
	// reduce queries used by getItemid for Content Items
	$bs 	= $mainframe->getBlogSectionCount();
	$bc 	= $mainframe->getBlogCategoryCount();
	$gbs 	= $mainframe->getGlobalBlogSectionCount();
} else {
	// source is newsfeed category/item
	require_once( $mosConfig_absolute_path . "/includes/domit/xml_domit_rss_lite.php");
	if ($where == 'newsfeed_item') {
		$condition = "AND id IN ($where_id)";
	} else {
		$condition = "AND catid IN ($where_id)";
	}
	$database->setQuery( "SELECT name, link, numarticles, cache_time"
	. "\n FROM #__newsfeeds"
	. "\n WHERE published='1' AND checked_out='0' $condition"
	. "\n ORDER BY ordering"
	);
	$newsfeeds = $database->loadObjectList();
	$displayed = 0;
	$rows = array();
	foreach ($newsfeeds as $newsfeed) {
		if ($displayed >= $count) break; else {
			$cacheDir = $mosConfig_absolute_path . "/cache/";
			$LitePath = $mosConfig_absolute_path . "/includes/Cache/Lite.php";
			require_once( $mosConfig_absolute_path . "/includes/domit/xml_domit_rss_lite.php");
			$rssDoc =& new xml_domit_rss_document_lite();
			$rssDoc->useCacheLite(true, $LitePath, $cacheDir, $newsfeed->cache_time);
			$rssDoc->loadRSS($newsfeed->link);
			$totalChannels = $rssDoc->getChannelCount();
			for ($i = 0; $i < $totalChannels; $i++) {
				$currChannel =& $rssDoc->getChannel($i);
				$actualItems = $currChannel->getItemCount();
				$setItems = $newsfeed->numarticles;
				if ($setItems > $actualItems) {
					$totalItems = $actualItems;
				} else {
					$totalItems = $setItems;
				}
				for ($j = 0; $j < $totalItems; $j++) {
					if ($displayed >= $count) break; else {
						$row = new stdClass();
						$currItem =& $currChannel->getItem($j);
						$row->title = $currItem->getTitle();
						$row->text = html_entity_decode($currItem->getDescription(), ENT_QUOTES);
						$row->link = $currItem->getLink();
						$displayed++;
						$rows[] = $row;
					}
				}
			}
		}
	}
}

// Output
$html2out = array();

// Process content
foreach ( $rows as $row ) {
	if ($where == 'section' OR $where == 'category' OR $where == 'content') {
		$row->text = $row->introtext;
		$Itemid = $mainframe->getItemid( $row->id, 0, 0, $bs, $bc, $gbs );
		// Blank itemid check for SEF
		if ($Itemid == NULL) {
			$Itemid = '';
		} else {
			$Itemid = '&amp;Itemid='.$Itemid;
		}
		$link = sefRelToAbs('index.php?option=com_content&amp;task=view&amp;id='. $row->id . $Itemid );
	} else {
		$link = $row->link;
	}
	
	// Plugin processing
	if ($plugins AND ($where == 'section' OR $where == 'category' OR $where == 'content')) {
		$content_params =& new mosParameters( $row->params );

		// Global Configuration Parameters
		$content_params->def('link_titles', 	$mainframe->getCfg('link_titles'));
		$content_params->def('author', 			!$mainframe->getCfg('hideAuthor'));
		$content_params->def('createdate', 		!$mainframe->getCfg('hideCreateDate'));
		$content_params->def('modifydate', 		!$mainframe->getCfg('hideModifyDate'));
		$content_params->def('print', 			!$mainframe->getCfg('hidePrint'));
		$content_params->def('pdf', 			!$mainframe->getCfg('hidePdf'));
		$content_params->def('email', 			!$mainframe->getCfg('hideEmail'));
		$content_params->def('rating', 			$mainframe->getCfg('vote'));
		$content_params->def('icons', 			$mainframe->getCfg('icons'));
		$content_params->def('readmore', 		$mainframe->getCfg('readmore'));
		
		// Other Params
		$content_params->def('image', 			1 );
		$content_params->def('section', 		0 );
		$content_params->def('section_link', 	0 );
		$content_params->def('category', 		0 );
		$content_params->def('category_link', 	0 );
		$content_params->def('introtext', 		1 );
		$content_params->def('pageclass_sfx', 	'');
		$content_params->def('item_title', 		1 );
		$content_params->def('url', 			1 );
	
		global $_MAMBOTS;
		$_MAMBOTS->loadBotGroup('content' );
		$_MAMBOTS->trigger('onPrepareContent', array( &$row, &$content_params, 0 ), true );
	} else {
		$row->text = preg_replace('/{([a-zA-Z0-9\-_]*)\s*(.*?)}/i','', $row->text);
	}	
	
	// Remove images
	if ($hideimages) {
		$row->text = preg_replace("/<img.+?>/", "", $row->text);	
	}
	
	 // HTML cleanup
	 if ($striptags) {
	 	$row->text = strip_tags($row->text, $allowed_tags);
	 }	 	
	
	// Character limitation
	if ($chars) {
		if(function_exists("mb_substr")) {
			$row->text = mb_substr($row->text, 0, $chars).'...'; 
		}
		else {
			$row->text = substr($row->text, 0, $chars).'...';	
		}
	}
	
	// Word limitation
	if (!function_exists('word_limiter')) {
		function word_limiter($str, $limit = 100, $end_char = '&#8230;') {
			  if (trim($str) == '')
				return $str;
			  preg_match('/\s*(?:\S*\s*){'. (int) $limit .'}/', $str, $matches);
			  if (strlen($matches[0]) == strlen($str))
				$end_char = '';
			  return rtrim($matches[0]).$end_char;
		}
	}
	if ($words) {
		$row->text = word_limiter($row->text,$words);
	}		

/* Single item output inside a <li> tag - START HERE */
if ($udc_displaytype == 'ajaxfader') {
	$html = "<div class=\"udc_item\">\n";
} else {
	$html = "<li class=\"udc_item\">\n";
}

// Item title
if ($display != 1 || ($where == 'newsfeed' || $where == 'newsfeed_item')) {
	$html .= '<div class="udc_title">';
	if ($linked) { $html .= '<a href="'.$link.'">'; }
	$html .= $row->title;
	if ($linked) { $html .= '</a>'; }
	$html .= "</div>\n";
}	

// Item creation date
if ($datecreated) {
	setlocale (LC_TIME, $mosConfig_locale);
	$html .= '<span class="udc_date">'.strftime('%H:%M - %d.%m.%Y',strtotime($row->created)+3600*$mosConfig_offset).'</span>';
	$html .= "\n"; //line break
}

if ($where != 'newsfeed' && $where != 'newsfeed_item') {
	// Section - Category display
	if ($show_section_title || $show_category_title) {
		
		$cat = new mosCategory( $database );
		$cat->load( $row->catid );
		$sec = new mosSection( $database );
		$sec->load( $row->sectionid );
		
		$html .= '<span class="udc_sec_cat">';
		if ($show_section_title) {
			 $html .= $sec->title;
			 if ($show_category_title) { $html .= ' '.$seperator.' '.$cat->title; }
		} else {
			 if ($show_category_title) { $html .= $cat->title;}
		}
		$html .= "</span>\n"; //line break
	}
	
	// Item introtext
	if ($display != 0 OR $more) {
		if ($display != 0) {
			$html .= '<p class="introtext">'.$row->text.'</p>';
			$html .= "\n"; //line break
		}
		if ($more) {
			$html .= '<a class="udc_readon" href="'.$link.'">'._READ_MORE.'</a>';
			$html .= "\n"; //line break
		}
	}
}

if ($udc_displaytype == 'ajaxfader') {
	$html .= "</div>\n";
} else {
	$html .= "</li>\n";
}
/* Single item output inside a <li> tag - END HERE */
$html2out[] = $html;
}



/////////////////////////////////////////////////////////////////////
// Now output everything, depending on the "display type"
/////////////////////////////////////////////////////////////////////
if ($udc_displaytype == 'list') {
?>

<!-- JoomlaWorks "Ultimate Content Display" Module (v1.0) starts here -->
<style type="text/css" media="screen">
@import "modules/mod_jw_ucd/list/mod_jw_ucd.css";
</style>
<div class="udc<?php echo $moduleclass_sfx; ?>">
  <ul id="<?php echo $uniqueid; ?>" class="udc_list">
    <?php foreach ($html2out as $key => $value) { echo "<!-- ".$key." -->\n".$value; } ?>
  </ul>
</div>
<!-- JoomlaWorks "Ultimate Content Display" Module (v1.0) ends here -->

<?php } elseif ($udc_displaytype == 'ajaxfader') {
$ucd_output = "";
foreach ($html2out as $key => $value) { $ucd_output.= "$value";}
if (file_exists("modules/mod_jw_ucd/ajaxfader/ucd_content_$uniqueid.txt") && filemtime ("modules/mod_jw_ucd/ajaxfader/ucd_content_$uniqueid.txt") + $udc_ajf_cache * 60 > time()) {
	// do nothing
} else {
	$ucd_content = fopen("modules/mod_jw_ucd/ajaxfader/ucd_content_$uniqueid.txt",'w');
	fwrite($ucd_content,$ucd_output);
	fclose($ucd_content);
}
?>

<!-- JoomlaWorks "Ultimate Content Display" Module (v1.0) starts here -->
<style type="text/css" media="screen">
@import "modules/mod_jw_ucd/ajaxfader/mod_jw_ucd.css";
#<?php echo $uniqueid; ?> {position:relative;overflow:hidden;width:<?php echo $udc_ajf_width; ?>;height:<?php echo $udc_ajf_height; ?>;background-color:<?php echo $udc_ajf_bgcolor; ?>;}
#<?php echo $uniqueid; ?> div {background-color:<?php echo $udc_ajf_bgcolor; ?>;}
</style>
<!--[if lt IE 7]>
<style type="text/css" media="screen">
* html .udc_ajaxfader_bottomfade {background:none;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="<?php echo $mosConfig_live_site; ?>/modules/mod_jw_ucd/ajaxfader/bottomfade.png", sizingMethod="scale");}
</style>
<![endif]-->
<div class="udc<?php echo $moduleclass_sfx; ?>">
  <div class="udc_ajaxfader">
    <script type="text/javascript" src="modules/mod_jw_ucd/ajaxfader/ajaxfader.js" charset="<?php echo $charset; ?>"></script>
    <script type="text/javascript">
	var txtfile="modules/mod_jw_ucd/ajaxfader/ucd_content_<?php echo $uniqueid; ?>.txt"
	new udcajaxfader(txtfile,"<?php echo $uniqueid; ?>","nothingreally",<?php echo $udc_ajf_delay; ?>,"fade")
	</script>
  </div>
</div>
<?php if ($udc_ajf_bottomfade) { ?>
<div class="udc_ajaxfader_bottomfade"></div>
<?php } ?>
<!-- JoomlaWorks "Ultimate Content Display" Module (v1.0) ends here -->

<?php } elseif ($udc_displaytype == 'jqueryfader') { ?>

<!-- JoomlaWorks "Ultimate Content Display" Module (v1.0) starts here -->
<style type="text/css" media="screen">
@import "modules/mod_jw_ucd/jqueryfader/mod_jw_ucd.css";
ul.udc_jqueryfader li {height:<?php echo $udc_jqf_cheight;?>;background-color:<?php echo $udc_jqf_bgcolor; ?>;}
</style>
<!--[if lt IE 7]>
<style type="text/css" media="screen">
* html .udc_ajaxfader_bottomfade {background:none;filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src="<?php echo $mosConfig_live_site; ?>/modules/mod_jw_ucd/ajaxfader/bottomfade.png", sizingMethod="scale");}
</style>
<![endif]-->
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_jw_ucd/jqueryfader/jquery.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/mod_jw_ucd/jqueryfader/jquery.innerfade.js"></script>
<script type="text/javascript">
var $j = jQuery.noConflict();
$j(document).ready(
	function(){
		$j('.udc_jqueryfader').innerfade({
			animationtype: '<?php echo $udc_jqf_anim;?>',
			speed: <?php echo $udc_jqf_speed;?>,
			timeout: <?php echo $udc_jqf_timeout;?>,
			type: 'sequence',
			containerheight: '<?php echo $udc_jqf_cheight;?>'
		});
});
</script>
<div class="udc<?php echo $moduleclass_sfx; ?>">
  <ul id="<?php echo $uniqueid; ?>" class="udc_jqueryfader">
    <?php foreach ($html2out as $key => $value) { echo "<!-- ".$key." -->\n".$value; } ?>
  </ul>
</div>
<?php if ($udc_jqf_bottomfade) { ?>
<div class="udc_jqueryfader_bottomfade"></div>
<?php } ?>
<!-- JoomlaWorks "Ultimate Content Display" Module (v1.0) ends here -->

<?php } ?>