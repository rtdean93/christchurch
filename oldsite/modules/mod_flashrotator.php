<?php
defined( '_VALID_MOS' ) or die( 'Restricted access' );
global $mosConfig_absolute_path, $mosConfig_live_site;
$folder 			= 'modules/js_flashrotator/img';
$width 				= $params->get('width');
$bgcolor 			= $params->get('bgcolor');
$height 			= $params->get( 'height' );
$linktarget 		= $params->get('linktarget' );
$transition 		= $params->get( 'transition' );
$lightcolor			= $params->get( 'lightcolor' );
$frontcolor 		= $params->get( 'frontcolor' );
$backcolor 			= $params->get( 'backcolor' );
$rotatetime 		= $params->get( 'rotatetime' );
$debug				= ($params->get( 'debug' ));
$autostart			= ($params->get('autostart'));
if ($autostart == 1) { $Myautostart = "true"; }
if ($autostart == 0) { $Myautostart = "false"; }
$repeat 			= ($params->get('repeat'));
if ($repeat == 1) { $Myrepeat = "true"; }
if ($repeat == 0) { $Myrepeat = "false"; }
if ($repeat == 2) { $Myrepeat = "list"; }
$shuffle 			= ($params->get('shuffle'));
if ($shuffle == 1) { $Myshuffle = "true"; }
if ($shuffle == 0) { $Myshuffle = "false"; }
$shownavigation 	= ($params->get( 'shownavigation' ));
if ($shownavigation == 1) { $Mynavigation = "true"; }
if ($shownavigation == 0) { $Mynavigation = "false"; }
$showicons 			= ($params->get( 'showicons' ));
if ($showicons == 1) { $Myshowicons = "true"; }
if ($showicons == 0) { $Myshowicons = "false"; }
$linkfromdisplay 	= ($params->get( 'linkfromdisplay' ));
if ($linkfromdisplay == 1) { $Mylinkfromdisplay = "true"; }
if ($linkfromdisplay == 0) { $Mylinkfromdisplay = "false"; }
$overstretch		= ($params->get( 'overstretch' ));
if ($overstretch == 1) { $Myoverstretch = "true"; }
if ($overstretch == 0) { $Myoverstretch = "false"; }
if ($overstretch == 2) { $Myoverstretch = "fit"; }
if ($overstretch == 3) { $Myoverstretch = "none"; }
$title1 			= $params->get( 'title1' );
$link1 				= $params->get( 'link1' );
$image1 			= $params->get( 'image1' );
$title2 			= $params->get( 'title2' );
$link2 				= $params->get( 'link2' );
$image2 			= $params->get( 'image2' );
$title3 			= $params->get( 'title3' );
$link3 				= $params->get( 'link3' );
$image3 			= $params->get( 'image3' );
$title4 			= $params->get( 'title4' );
$link4				= $params->get( 'link4' );
$image4 			= $params->get( 'image4' );
$title5 			= $params->get( 'title5' );
$link5				= $params->get( 'link5' );
$image5 			= $params->get( 'image5' );
$xmlout= "<playlist version=\"1\" xmlns=\"http://xspf.org/ns/0/\">";
$xmlout.= "<trackList>";
$xmlout.= "<track>";
$xmlout.= "<title>$title1</title>";
$xmlout.= "<info>$link1</info>";
$xmlout.= "<location>$folder/$image1</location>";
$xmlout.= "</track>";
$xmlout.= "<track>";
$xmlout.= "<title>$title2</title>";
$xmlout.= "<info>$link2</info>";
$xmlout.= "<location>$folder/$image2</location>";
$xmlout.= "</track>";
$xmlout.= "<track>";
$xmlout.= "<title>$title3</title>";
$xmlout.= "<info>$link3</info>";
$xmlout.= "<location>$folder/$image3</location>";
$xmlout.= "</track>";
$xmlout.= "<track>";
$xmlout.= "<title>$title4</title>";
$xmlout.= "<info>$link4</info>";
$xmlout.= "<location>$folder/$image4</location>";
$xmlout.= "</track>";
$xmlout.= "<track>";
$xmlout.= "<title>$title5</title>";
$xmlout.= "<info>$link5</info>";
$xmlout.= "<location>$folder/$image5</location>";
$xmlout.= "</track>";
$xmlout.= "</trackList>";
$xmlout.= "</playlist>";
$xml=fopen('modules/js_flashrotator/js_flashrotator.xml','w');
fwrite($xml,$xmlout);
fclose($xml);
if (!file_exists('modules/js_flashrotator/js_flashrotator' . $module->id . '.xml')) {
   touch('modules/js_flashrotator/js_flashrotator' . $module->id . '.xml');
}
$xml=fopen('modules/js_flashrotator/js_flashrotator' . $module->id . '.xml','w');
fwrite($xml,$xmlout);
fclose($xml);
$init= "<br />Flash Image Rotator Module by <a href=\"http://www.joomlashack.com\" title=\"Joomla Templates, Modules and Components\">Joomlashack</a>.";
$seotext= "<a href=\"$link1\">$title1</a><br /><a href=\"$link2\">$title2</a><br /><a href=\"$link3\">$title3</a><br /><a href=\"$link4\">$title4</a><br /><a href=\"$link5\">$title5</a><br />";
?>


<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/modules/js_flashrotator/ufo.js"></script>

<p id="player"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.<?php echo $init; ?><br /><?php echo $seotext; ?></p>
	<script type="text/javascript">
		// <![CDATA[
		var FO = { 	movie:"./modules/js_flashrotator/flashrotator.swf",width:"<?php echo $width; ?>",height:"<?php echo $height; ?>",majorversion:"7",build:"0",bgcolor:"#<?php echo $bgcolor; ?>",wmode:"transparent",flashvars:"file=modules/js_flashrotator/js_flashrotator<?php echo $module->id; ?>.xml&autostart=<?php echo $Myautostart; ?>&shownavigation=<?php echo $Mynavigation; ?>&linkfromdisplay=<?php echo $Mylinkfromdisplay; ?>&transition=<?php echo $transition ; ?>&shuffle=<?php echo $Myshuffle; ?>&repeat=<?php echo $Myrepeat; ?>&backcolor=0x<?php echo $backcolor; ?>&frontcolor=0x<?php echo $frontcolor; ?>&lightcolor=0x<?php echo $lightcolor; ?>&linktarget=<?php echo $linktarget; ?>&logo=<?php echo $logo; ?>&overstretch=<?php echo $overstretch; ?>&rotatetime=<?php echo $rotatetime; ?>&showicons=<?php echo $Myshowicons; ?>" };
		UFO.create(FO, "player");
		// ]]>
</script>

<?php
$debugger= "<div style=\"border:2px solid red; width:600px; background: #FFFFB3; color: black; padding:10px; z-index:6000; white-space:nowrap;\" id=\"debug\">";
$debugger.= "<h2 style=\"padding:10px;\">Module Output Debug:</h2>";
$debugger.= "<ul style=\"list-style:none;text-indent:25px;\">";
$debugger.= "<li><b>Image Folder:</b> $folder</li>";
$debugger.= "<li><b>Height:</b> $height</li>";
$debugger.= "<li><b>Width:</b> $width</li>";
$debugger.= "<li><b>Movie Background Color:</b> $bgcolor</li>";
$debugger.= "<li><b>Tween Time:</b> $rotatetime</li>";
$debugger.= "<li><b>Transition:</b> $transition</li>";
$debugger.= "<li><b>Autostart:</b> $Myautostart</li>";
$debugger.= "<li><b>Repeat:</b> $Myrepeat</li>";
$debugger.= "<li><b>Shuffle:</b> $Myshuffle</li>";
$debugger.= "<li><b>Show Navigation:</b> $Mynavigation</li>";
$debugger.= "<li><b>Show Icons:</b> $Myshowicons</li>";
$debugger.= "<li><b>Images Linkable:</b> $Mylinkfromdisplay</li>";
$debugger.= "<li><b>Link Target:</b> $linktarget</li>";
$debugger.= "<li><b>Scaling Method:</b> $Myoverstretch</li>";
$debugger.= "<li><b>Text Color:</b> $frontcolor</li>";
$debugger.= "<li><b>Text Over Color:</b> $lightcolor</li>";
$debugger.= "<li><b>Text Underlay Color:</b> $backcolor</li>";
$debugger.= "</ul>";
$debugger.= "<h2 style=\"padding:10px;\">Image Playist</h2>";
$debugger.= "<strong>Image 1:</strong><br>$title1<br>Image File:<a href=\"$mosConfig_live_site/modules/js_flashrotator/jpg/$image1\">$mosConfig_live_site/modules/js_flashrotator/jpg/$image1</a><br>Link: <a href=\"$link1\">$link1</a><br><br>";
$debugger.= "<strong>Image 2:</strong><br>$title2<br>Image File:<a href=\"$mosConfig_live_site/modules/js_flashrotator/jpg/$image2\">$mosConfig_live_site/modules/js_flashrotator/jpg/$image2</a><br>Link: <a href=\"$link2\">$link2</a><br><br>";
$debugger.= "<strong>Image 3:</strong><br>$title3<br>Image File:<a href=\"$mosConfig_live_site/modules/js_flashrotator/jpg/$image3\">$mosConfig_live_site/modules/js_flashrotator/jpg/$image3</a><br>Link: <a href=\"$link3\">$link3</a><br><br>";
$debugger.= "<strong>Image 4:</strong><br>$title4<br>Image File:<a href=\"$mosConfig_live_site/modules/js_flashrotator/jpg/$image4\">$mosConfig_live_site/modules/js_flashrotator/jpg/$image4</a><br>Link: <a href=\"$link4\">$link4</a><br><br>";
$debugger.= "<strong>Image 5:</strong><br>$title5<br>Image File:<a href=\"$mosConfig_live_site/modules/js_flashrotator/jpg/$image5\">$mosConfig_live_site/modules/js_flashrotator/jpg/$image5</a><br>Link: <a href=\"$link5\">$link5</a><br><br>";
$debugger.= "<b>SWF Writeable?</b>: <a href=\"./modules/js_flashrotator/flashrotator.swf \">Check</a><br>";
$debugger.= "<b>XML Writeable?</b>: <a href=\"modules/js_flashrotator/js_flashrotator$module->id.xml \">Check</a>";
$debugger.= "</div>";
; ?>
<?php if ( $debug == "1" )
echo $debugger
?>