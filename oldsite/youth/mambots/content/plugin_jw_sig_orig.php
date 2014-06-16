<?php
/*
// "Simple Image Gallery" (in content items) Plugin for Joomla 1.0.x - Version 1.2.1
// License: http://www.gnu.org/copyleft/gpl.html
// Authors: Fotis Evangelou - George Chouliaras
// Copyright (c) 2006 JoomlaWorks.gr - http://www.joomlaworks.gr
// Project page at http://www.joomlaworks.gr - Demos at http://demo.joomlaworks.gr
// ***Last update: January 6th, 2007***
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$_MAMBOTS->registerFunction( 'onPrepareContent', 'jw_gallery' );
function jw_gallery( $published, &$row, &$params, $page=0 ) {
   if (!$published) {
    $row->text = preg_replace( "#{gallery}(.*?){/gallery}#s", "" , $row->text );
    return;
  }
  
// Variables
global $database, $mainframe, $option, $task, $mosConfig_lang, $mosConfig_absolute_path, $mosConfig_live_site, $my, $Itemid;
$rootfolder = '/images/stories/';
$query = "SELECT id FROM #__mambots WHERE element = 'plugin_jw_sig' AND folder = 'content'";
$database->setQuery( $query );
$id = $database->loadResult();
$mambot = new mosMambot( $database );
$mambot->load( $id );
$param =& new mosParameters( $mambot->params );
$_width_ = $param->get('th_width', 200);
$_height_ = $param->get('th_height', 200);
$_quality_ = $param->get('th_quality', 80);
$displaynavtip = $param->get('displaynavtip', 1);
$navtip = $param->get('navtip', 'Navigation tip: Hover mouse on top of the right or left side of the image to see the next or previous image respectively.');
$displaymessage = $param->get('displaymessage', 1);
$message = $param->get('message', 'You are browsing images from the article:');

  
  if (preg_match_all("#{gallery}(.*?){/gallery}#s", $row->text, $matches, PREG_PATTERN_ORDER) > 0) {
	  $sigcount = -1;
	  foreach ($matches[0] as $match) {
		$sigcount++;
		$_images_dir_ = preg_replace("/{.+?}/", "", $match);
		unset($images);
		$noimage = 0;
		// read directory
	    if ($dh = opendir($mosConfig_absolute_path.$rootfolder.$_images_dir_)) {
          while (($f = readdir($dh)) !== false) {
	         if((substr(strtolower($f),-3) == 'jpg') || (substr(strtolower($f),-3) == 'gif') || (substr(strtolower($f),-3) == 'png')) {
	              $noimage++;
    	          $images[] = array('filename' => $f);
	              array_multisort($images, SORT_ASC, SORT_REGULAR); 
	         }
          }
          closedir($dh);
        }
		$itemtitle = preg_replace("/\"/", "'", $row->title);	
		if($noimage) {
	   	 $html = '
<!-- JW "Simple Image Gallery" Plugin (v1.2.1) starts here -->
<link href="'.$mosConfig_live_site.'/mambots/content/plugin_jw_sig/sig.css" rel="stylesheet" type="text/css" />
<style type="text/css">.sig_cont {width:'.($_width_+30).'px;height:'.($_height_+20).'px;}</style>
<script type="text/javascript" src="'.$mosConfig_live_site.'/mambots/content/plugin_jw_sig/mootools.js"></script>
<script type="text/javascript" src="'.$mosConfig_live_site.'/mambots/content/plugin_jw_sig/slimbox.js"></script>
<div class="sig">';
	     for($a = 0;$a<$noimage;$a++) {
		     if($images[$a]['filename'] != '') {
			    $html .= '<div class="sig_cont"><div class="sig_thumb"><a href="'.$mosConfig_live_site.$rootfolder.$_images_dir_.'/'.$images[$a]['filename'].'" rel="lightbox[sig'.$sigcount.']" title="';
				if ($displaynavtip) {$html .= $navtip.'<br /><br />';}
				if ($displaymessage) {$html .= $message.'<br /><b>'.$itemtitle.'</b>';}			
				else {$html .= '<b>'.$images[$a]['filename'].'</b>';}
				$html .= '" alt="';
				if ($displaymessage) {$html .= $message.' '.$itemtitle.'';}			
				else {$html .= $images[$a]['filename'];}
				$html .= '" target="_blank"><img src="'.$mosConfig_live_site.'/mambots/content/plugin_jw_sig/showthumb.php?img='.$_images_dir_.'/'.$images[$a]['filename'].'&width='.$_width_.'&height='.$_height_.'&quality='.$_quality_.'"></a></div></div>';
		     }
	     }
		$html .="\n<div class=\"sig_clr\"></div>\n</div>\n<!-- JW \"Simple Image Gallery\" Plugin (v1.2.1) ends here -->";
	   }
	 $row->text = preg_replace( "#{gallery}".$_images_dir_."{/gallery}#s", $html , $row->text );
	}      
  }
}

?>
