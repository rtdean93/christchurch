<?php
/**
* @version 1.0 - RokSlimbox - RocketTheme 
* @package Joomla
* @copyright Copyright (C) 2007 RocketTheme. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

$_MAMBOTS->registerFunction( 'onPrepareContent', 'botRokSlimbox' );

function botRokSlimbox( $published, &$row, &$params, $page=0 ) {
	global $mainframe, $Itemid, $database, $_MAMBOTS;
	
	require_once(dirname(__FILE__) . '/rokslimbox/imagehandler.php');

	// simple performance check to determine whether bot should process further
	if ( strpos( $row->text, 'slimbox' ) === false ) {
		return true;
	}
	
	// define the regular expression for the bot
	$regex = "#{slimbox(.*?)}(.*?){/slimbox}#s";
	
		// check whether mambot has been unpublished
	if ( !$published ) {
		return true;
	}

	if ( !isset($_MAMBOTS->_content_mambot_params['rokslimbox']) ) {
		// load mambot params info
		$query = "SELECT params"
		. "\n FROM #__mambots"
		. "\n WHERE element = 'rokslimbox'"
		. "\n AND folder = 'content'"
		;
		$database->setQuery( $query );
		$database->loadObject($mambot);
		
		// save query to class variable
		$_MAMBOTS->_content_mambot_params['rokslimbox'] = $mambot;
	}

	// pull query data from class variable
	$mambot = $_MAMBOTS->_content_mambot_params['rokslimbox'];
	
 	$botParams = new mosParameters( $mambot->params );
 	$GLOBALS['_MAMBOT_rokslimbox_PARAMS'] =& $botParams;

	// perform the replacement
	$row->text = preg_replace_callback( $regex, 'rokslimbox_replacer', $row->text );

	return true;
}

/**
* Replaces the matched tags an image
* @param array An array of matches (see preg_match_all)
* @return string
*/
function rokslimbox_replacer( &$matches ) {
	global $mosConfig_cachepath;
	
	$botParams =& $GLOBALS['_MAMBOT_rokslimbox_PARAMS'];
	
	$thumb_ext	= $botParams->def( 'thumb_ext', '_thumb');
	$thumb_class	= $botParams->def( 'thumb_class', 'album');
	$thumb_width = $botParams->def( 'thumb_width', '100');
	$thumb_height = $botParams->def( 'thumb_height', '100');
	$thumb_quality = $botParams->def( 'thumb_quality', '90');
	$thumb_custom = $botParams->def( 'thumb_custom', 0);
	$thumb_dir = $botParams->def( 'thumb_dir');
	$thealbum = '';
	$thetitle = '';
	
	/* thumbnail settings */
	$improve_thumbnails = false; // Auto Contrast, Unsharp Mask, Desaturate,  White Balance
	$temp_path = $mosConfig_cachepath; //required for improved gd_verion() function
	$thumb_quality = $thumb_quality;
	$width = $thumb_width;
	$height = $thumb_height;
	

	if (@$matches[1]) {
		$inline_params = $matches[1];
	
		// get album
		$album_matches = array();
		preg_match( "#album=\|(.*?)\|#s", $inline_params, $album_matches );
		if (isset($album_matches[1])) $thealbum = "[" . trim($album_matches[1]) . "]";
		
		// get title
		$title_matches = array();
		preg_match( "#title=\|(.*?)\|#s", $inline_params, $title_matches );
		if (isset($title_matches[1])) $thetitle =  $title_matches[1];
	}

	$image_url = $matches[2];
	$extension = substr($image_url,strrpos($image_url,"."));
	$image_name = substr($image_url,0,strrpos($image_url, "."));
	$just_image = 
	$tmp_thumb =  $thumb_dir . substr($image_url,strrpos($image_url,DIRECTORY_SEPARATOR));
	$thumb_url = $image_name . $thumb_ext . $extension;
	
	if (file_exists($thumb_url)) {
		// thumbnail exists so can do lightbox with thumbnail
		$text = '<a href="' . $image_url . '" rel="lightbox' . $thealbum . '" title="' . $thetitle . '"><img class="'. $thumb_class . '" src="' . $thumb_url . '" alt="' . $thetitle . '" /></a>';
	} elseif (file_exists($tmp_thumb)) {
		$text = '<a href="' . $image_url . '" rel="lightbox' . $thealbum . '" title="' . $thetitle . '"><img class="'. $thumb_class . '" src="' . $tmp_thumb . '" alt="' . $thetitle . '" /></a>';
		
	} else {
		//try to generate thumbs
		if ($thumb_custom) $thumb_url = $tmp_thumb;
		$rd = new imgRedim(false, $improve_thumbnails, $temp_path);
		$image_filename = $image_url; // define source image here
		$output_filename = $thumb_url; // define destination image here
		$rd->loadImage($image_filename);
		$rd->redimToSize($width, $height, true);
		$rd->saveImage($output_filename, $thumb_quality);
		$text = '<a href="' . $image_url . '" rel="lightbox' . $thealbum . '" title="' . $thetitle . '"><img class="'. $thumb_class . '" src="' . $thumb_url . '" alt="' . $thetitle . '" /></a>';
	}
	return $text;
}
?>
