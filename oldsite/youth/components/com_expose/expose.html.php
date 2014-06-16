<?php
//****************************************************************************
//Component: Expose
//Version  : RC3
//Author   : Josh
//E-Mail   : webmaster@gotgtek.com
//Author   : Steinthor Kristinsson
//E-Mail   : steinthor@setjan.com
//File	   : expose.html.php
//Web Site : www.gotgtek.com
//Copyright: Copyright 2006 by GTEK Technologies
//License  : GNU General Public License (GPL), visit www.slooz.com for details
//
//Joomla 1.x flash gallery compoent.
//*********************************************************************************
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (version_compare(PHP_VERSION,'5','>='))
	include_once($mosConfig_absolute_path."/components/com_expose/expose/manager/misc/domxml-php4-to-php5.php");

include($mosConfig_absolute_path."/components/com_expose/expose/manager/misc/common.inc.php");
include($mosConfig_absolute_path."/components/com_expose/expose/admin/config.expose.php");

class expose_html {

	// Get Main gallery variables
	function getbg() {
		$xmlF = expose_M::rpath2();
		$bgc = expose_M::GetAttr($xmlF,"Gallery Background");
		return $bgc;
	}

	function getbgi() {
		$xmlF = expose_M::rpath2();
		$bgi = expose_M::GetAttr($xmlF,"Gallery Background Image");
		return $bgi;
	}

	function geth() {
		$xmlF = expose_M::rpath2();
		$bgh = expose_M::GetAttr($xmlF,"Gallery height");
		return $bgh;
	}

	function getw() {
		$xmlF = expose_M::rpath2();
		$bgw = expose_M::GetAttr($xmlF,"Gallery width");
		return $bgw;
	}

	function getlang() {
		$xmlF = expose_M::rpath2();
		$bgl = expose_M::GetAttr($xmlF,"Language");
		return $bgl;
	}

	function writeGameFlash($msg){
		global $mainframe;
		global $mosConfig_live_site;

		$mainframe->addCustomHeadTag ('<script type="text/javascript" src="' . $mosConfig_live_site . '/components/com_expose/AC_RunActiveContent.js"></script>');

		?>

		<table align="center" border="0">
			<tr>
				<td>
					<script type = "text/javascript">
// <!--
function showpic (args) {
	var argsarray = args.split ("_SPLIT_");
	var imgurl = argsarray[0];
	var caption = argsarray[1];
	var date = argsarray[2];
	var location = argsarray[3];
	window.open ("<?php echo $mosConfig_live_site; ?>/components/com_expose/showpic.html?" +
	"img=expose/" + imgurl +
	"&amp;caption=" + escape (caption) +
	"&amp;date=" + escape (date) +
	"&amp;location=" + escape (location)
	, 'pic',
	"width=" + screen.width +
	",height=" + screen.height +
	",toolbar=no,resizable=yes,scrollbars=yes,location=no,top=0,left=0,fullscreen=1,status=no");
}

function openurl (args) {
	var url = args;
	window.open (url);
}

var InternetExplorer = navigator.appName.indexOf("Microsoft") != -1;

function expose_DoFSCommand(command, args) {
	var exposeObj = InternetExplorer ? expose : document.expose;
	if (command == "showpic") {
		showpic (args);
	}
	if (command == "openurl") {
		openurl (args);
	}
}

if (navigator.appName && navigator.appName.indexOf("Microsoft") != -1 &&
		navigator.userAgent.indexOf("Windows") != -1 && navigator.userAgent.indexOf("Windows 3.1") == -1) {
	document.write('<SCRIPT LANGUAGE=VBScript\> \n');
	document.write('on error resume next \n');
	document.write('Sub expose_FSCommand(ByVal command, ByVal args)\n');
	document.write('  call expose_DoFSCommand(command, args)\n');
	document.write('end sub\n');
	document.write('</SCRIPT\> \n');
}

// SEO fix thanks to Hambon
function getQueryVariable(variable) {
	var query = window.location.search.substring(1);
	var pairDelimiter = "&";
	var pairSeparator = "=";
	var joomlaComName = "option,com_expose";

	if (query == "") {
		query = window.location.pathname.substring(1);
		var joomlaIsSEO = query.indexOf(joomlaComName);
		if (joomlaIsSEO != -1) {
			pairDelimiter = "/";
			pairSeparator = ",";
		}
	}

	var vars = query.split(pairDelimiter);
	for (var i=0;i<vars.length;i++) {
		var pair = vars[i].split(pairSeparator);
		if (pair[0] == variable) {
			return pair[1];
		}
	}
	return '';
}

var topLevelCollectionID = getQueryVariable ('topcoll');
var autoLoadAlbumID = getQueryVariable ('album');
var autoLoadPhotoID = getQueryVariable ('photo');
var autoStartSlideShow = getQueryVariable ('playslideshow');

	AC_FL_RunContent(
		'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0',
		'width', '<?php echo expose_html::getw(); ?>',
		'height', '<?php echo expose_html::geth(); ?>',
		'src', 'components/com_expose/expose/swf/expose',
		'quality', 'high',
		'wmode','transparent',
		'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
		'align', 'middle',
		'play', 'true',
		'id', 'expose',
		'bgcolor', '#<?php echo expose_html::getbg(); ?>',
		'name', 'expose',
		'menu', 'false',
		'allowScriptAccess','sameDomain',
		'movie', 'components/com_expose/expose/swf/expose',
		'salign', '',
		'FlashVars', 'bgColor=<?php echo expose_html::getbg(); ?>&amp;albumsXMLURL=xml/albums.xml&amp;stringsXMLURL=config/strings.xml&amp;formatsXMLURL=config/formats.xml&amp;configXMLURL=config/config.xml&amp;baseXMLURL=xml/&amp;baseImageURL=img/&amp;baseVideoURL=expose/img/&amp;baseAudioURL=img/&amp;topLevelCollectionID=' + topLevelCollectionID + '&amp;autoLoadAlbumID=' + autoLoadAlbumID + '&amp;autoLoadPhotoID=' + autoLoadPhotoID + '&amp;autoStartSlideShow=' + autoStartSlideShow + '&amp;bgImageURL=<?php echo expose_html::getbgi(); ?>&amp;fgImageURL=&amp;language=<?php echo expose_html::getlang(); ?>&amp;useEmbeddedFonts=yes',
		'base', 'components/com_expose/expose'
		);
// -->
</script>

					</td>
				</tr>
			</table>

		<?php
	}
}
?>
