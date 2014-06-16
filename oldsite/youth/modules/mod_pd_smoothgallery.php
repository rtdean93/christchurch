<?php
/**
* @version $Id: mod_pd_smoothgallery 1.0
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
* This module was inspired by Andy Miller @ http://www.rocketheme.com
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

$imagePath 	= cleantheDir($params->get( 'imagePath', 'images/portfolio/' ));
$imageThumbPath 	= cleantheDir($params->get( 'imageThumbPath', 'images/portfolio/thumbs/' ));
$timed 	= $params->get( 'timed', 1 );
$description 	= $params->get( 'description', 1 );
$arrows = $params->get( 'arrows', 1 ); 
$carousel = $params->get( 'carousel', 1 ); 
$links = $params->get( 'links', 1 );
$delay = $params->get( 'delay', '9000' );
$slideshowtext = $params->get('slideshowtext', 'Show Thumbnail Carousel');
$hidecode = $params->get( 'hidecode', 0 );
$galheight = $params->get( 'galheight', '500' );
$galwidth = $params->get( 'galwidth', '500' );
if($hidecode==0){
echo "<script src=\"modules/pd_smoothgallery/mootools.js\" type=\"text/javascript\"></script><script src=\"modules/pd_smoothgallery/jd.gallery.js\" type=\"text/javascript\"></script>
<link rel=\"stylesheet\" href=\"modules/pd_smoothgallery/jd.gallery.css\" type=\"text/css\" media=\"screen\" />";
}
$images 	= gallerylist($imagePath);
if (count($images) > 0) {
	$imgcount = 0;
echo '<div class="content"><div id="myGallery" style="width:' . $galwidth . 'px; height:' . $galheight . 'px; margin:0px auto;">' . "\n";

echo "<script type=\"text/javascript\">
function startGallery() {
var myGallery = new gallery($('myGallery'), {
timed: ".$timed.",
showArrows: ".$arrows.",
showCarousel: ".$carousel.",
embedLinks: ".$links.",
textShowCarousel: '".$slideshowtext."',
showInfopane: ".$description.",
delay: ".$delay."
});
}
window.onDomReady(startGallery);
</script>" . "\n";

	
	foreach($images as $img) {
	$info = getgalleryInfo($imagePath, $img);
	echo "<div class=\"imageElement\">
					<h3>".trim($info[1])."</h3>
					<p class='description'>".trim($info[2])."</p>
					<a href=\"".trim($info[0])."\"  target=\"_blank\" title=\"".trim($info[1])."\" class=\"open\"></a>
					<img src=\"".$imagePath.$img."\" class=\"full\" alt=\"".trim($info[1])."\" />
					<img src=\"".$imageThumbPath.$img."\" class=\"thumbnail\" alt=\"".trim($info[1])."\" />
				</div>";
	}//end of image looping
	echo '</div></div>';
}//end making sure there are images

//helper functions
function gallerylist ($directory) {
    $results = array();
    $handler = opendir($directory);
    while ($file = readdir($handler)) {
        if ($file != '.' && $file != '..' && isthereImage($file)) {
					$results[] = $file;
					sort($results);
				}
    }
    closedir($handler);
    return $results;

}

function getgalleryInfo($imagePath, $file) {
		$file_noext = substr($file, 0, strrpos($file,"."));
		$info = array();
		$infofile = $imagePath . $file_noext . ".txt";
		if (file_exists($infofile)) {
			$imginfo = file ($infofile);
			foreach ($imginfo as $line) { 
				$info[] = $line;
			}
			return $info;
		}
		return array('#','','');
}

function isthereImage($file) {
	$imagetypes = array( ".png", ".jpg", ".jpeg", ".gif");
	$extension = substr($file,strrpos($file,"."));
	if (in_array($extension, $imagetypes)) return true;
	else return false;
}

function cleantheDir($dir) {
	if (substr($dir, -1, 1) == '/')
		return $dir;
	else
		return $dir . "/";
}
echo '<div class="clr"></div>';
?>