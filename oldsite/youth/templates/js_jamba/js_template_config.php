<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/*
 * Copyright: JoomlaShack LLC
 * Function: Special template functions for JoomlaShack templates
*/

// ********************** THEME COLOR	*****************************
// Change the line below to select your preferred color style
// Available choices are: 'style1' thru 'style5'
// ******************************************************************
$themecolor = mosGetParam( $_REQUEST, 'themecolor', 'style1');

// ********************** HEADER STYLE	*****************************
// Change the line below to select your preferred header type
// Available choices are: 'graphic' or 'text'
// ******************************************************************
$headerstyle = mosGetParam( $_REQUEST, 'headerstyle', 'graphic');

// ********************** HEADER TEXT	*****************************
// If you have chosen 'text' from the parameter above you can edit
// the lines below to define the text to be displayed in the header.
// If you have chosen 'image' you can customize header_blank.png
// ******************************************************************
$headline ="Jamba";
$slogan = "A free template from Joomlashack";

// *************************  Pathway *******************************
// Enable Pathway/Breadcrumbs menu? '1' = True and '0' = False
// ******************************************************************
$showpathway = mosGetParam( $_REQUEST, 'showpathway', '1');


// ********************** END USER CONFIG ***************************



















// Template Functions - Do not edit below this line. 
// ******************************************************************
function getSplit($positions, $width=0){$count=0;foreach ($positions as $position){if (mosCountModules($position)) $count++;}$widths = array(null, '100%', '50%', '33%', '25%', '20%', '16%');return ($width) ? $widths[$count] : $count;}function getColumns (){$left = mosCountModules ('left');$right = mosCountModules ('right');if ($left && !$right) {$style = "-left-only";}if ($right && !$left) $style = "-right-only";if (!$left && !$right) $style = "-wide";if ($left && $right) $style = "-both";return $style;}$jstpl = base64_decode('PGRpdiBjbGFzcz0idHBsY3JpZ2h0Ij48YSBocmVmPSJodHRwOi8vd3d3Lmpvb21sYXNoYWNrLmNvbSIgdGl0bGU9Ikpvb21sYSBUZW1wbGF0ZXMiPkpvb21sYSBUZW1wbGF0ZXMgYnkgSm9vbWxhc2hhY2s8L2E+PC9kaXY+');?>
