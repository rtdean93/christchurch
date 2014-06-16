<?php
/**
* @version $Id: mod_whosonline.php 2726 2006-03-09 14:01:19Z stingrey $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );



$showmode 	= $params->get( 'showmode', 0 );
$imagePath 	= cleanDir($params->get( 'imagePath', 'images/stories/fruit' ));
$showDescription 	= $params->get( 'showDescription', 1 );
$width = $params->get( 'width', 430 ); 
$height = $params->get( 'height', 200 ); 
$duration = $params->get( 'duration', 9000 );
$speed = $params->get('speed', 700);
$jslib = $params->get('jslib', 1);
$sortcriteria = $params->get('sortcriteria', 0);
$sortorder = $params->get('sortorder', 'asc');

$images 	= imageList($imagePath, $sortcriteria, $sortorder);
if (count($images) > 0) {
	$imgcount = 0;
	if ($jslib == 1) {
		echo '<script src="modules/rt_slideshow/mootools.release.83.js" type="text/javascript"></script>' . "\n";
	}
  echo '<script src="modules/rt_slideshow/timed.slideshow.js" type="text/javascript"></script>' . "\n";
	echo '<div class="timedSlideshow jdSlideshow" id="mySlideshow" style="width:' . $width . 'px;height:' . $height . 'px"></div>' . "\n";
	echo '<script type="text/javascript">' . "\n";
	echo '  var mySlideData = new Array();' . "\n";
	
	foreach($images as $img) {
		$info = getInfo($imagePath, $img);
		echo "mySlideData[" . $imgcount++ . "] = new Array(\n";
		echo "'$imagePath$img',\n";
		echo "'" . trim($info[0]) . "',\n";
		echo "'" . trim($info[1]) . "',\n";
		echo "'" . trim($info[2]) . "'\n";
		echo ");";
	}
	echo '</script>
	<script type="text/javascript">
	function startSlideshow() {
	var slideshow = new timedSlideShow($("mySlideshow"), mySlideData, ' . $duration . ', ' . $speed . ');
	}

	addLoadEvent(startSlideshow);
	</script>';
}

//echo $output;


//helper functions
function imageList ($directory, $sortcriteria, $sortorder) {
    $results = array();
    $handler = opendir($directory);
		$i = 0;
    while ($file = readdir($handler)) {
        if ($file != '.' && $file != '..' && isImage($file)) {
					$results[$i][0] = $file;
					$results[$i][1] = filemtime($directory . "/" .$file);
					$i++;
				}
    }
    closedir($handler);

		//these lines sort the contents of the directory by the date
		// Obtain a list of columns
		
		foreach($results as $res) {
			if ($sortcriteria == 0 ) $sortAux[] = $res[0];
			else $sortAux[] = $res[1];
		}
		
		if ($sortorder == 0) 	array_multisort($sortAux, SORT_ASC, $results);
		else array_multisort($sortAux, SORT_DESC, $results);
		
		foreach($results as $res) {
			$sorted_results[] = $res[0];
		}

    return $sorted_results;
}

function getInfo($imagePath, $file) {
		global $iso_client_lang;

		$langext = "";
		$fileext= ".txt";
		
		if (isset($iso_client_lang) && strlen($iso_client_lang)>1) $langext = "." . $iso_client_lang;

		$file_noext = substr($file, 0, strrpos($file,"."));
		$info = array();

		$infofile = $imagePath . $file_noext . $langext . $fileext;

		if (!file_exists($infofile)) $infofile = $imagePath . $file_noext . $fileext;

		if (file_exists($infofile)) {
			$imginfo = file ($infofile);
			foreach ($imginfo as $line) { 
				$info[] = addslashes($line);
			}
			return $info;
		}
		return array('#','','');
}

function isImage($file) {
	$imagetypes = array(".jpg", ".jpeg", ".gif", ".png");
	$extension = substr($file,strrpos($file,"."));
	if (in_array($extension, $imagetypes)) return true;
	else return false;
}

function cleanDir($dir) {
	if (substr($dir, -1, 1) == '/')
		return $dir;
	else
		return $dir . "/";
}

?>