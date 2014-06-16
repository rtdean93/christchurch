<?php
//****************************************************************************
//Component: Expose
//Version	: RC3
//Author	: Josh
//E-Mail	: webmaster@gotgtek.com
//Author	: Steinthor Kristinsson
//E-Mail	: steinthor@setjan.com
//File	: admin.expose.php
//Web Site	: www.gotgtek.com
//Copyright : Copyright 2006 by GTEK Technologies
//License	: GNU General Public License (GPL), visit www.slooz.com for details
//
//Joomla 1.x flash gallery compoent.
//***************************************************************************************

defined('_VALID_MOS') or die('Direct access to this location is not allowed.');

if (!($acl -> acl_check('administration', 'edit', 'users', $my -> usertype, 'components', 'all') | $acl -> acl_check('administration', 'edit', 'users', $my -> usertype, 'components', 'com_expose'))){
	mosRedirect('index2.php', _DML_NOT_AUTH);
}

	include("../components/com_expose/expose/admin/config.expose.php");
	include_once ($mosConfig_absolute_path."/components/com_expose/expose/manager/misc/common.inc.php");

	// Check for php version for domxml
	if (version_compare(PHP_VERSION,'5','>='))
		include_once($mosConfig_absolute_path."/components/com_expose/expose/manager/misc/domxml-php4-to-php5.php");
		include_once ($mosConfig_absolute_path."/components/com_expose/expose/manager/misc/xmlfunc.inc.php");

	require_once($mosConfig_absolute_path."/configuration.php" );
	require_once($mosConfig_absolute_path."/includes/joomla.php" );
	require_once( $mainframe->getPath( 'admin_html' ) );



	// Check if the system has the SYSTEM REQUIREMENTS
	$checksys = expose_M::syscheck();
	If($checksys == "") {
		$sysok = 1;
		HTML_content::ShowToolbar();
	}else{
		$sysok = 0;
		echo "<img src=../components/com_expose/expose/admin/logo.gif /><br /></br />".$checksys;
	}

	$task = $_GET['task'];

	// Main switch
	switch ($task) {
		case "manage":
			if($sysok==1) {
				HTML_content::ShowManager();
			}
			break;

		case "config":
			if($sysok==1) {
				$xmlF = expose_M::rpath();
				HTML_content::readConf($xmlF);
			}
			break; 

		case "formats":
			if($sysok==1) {
				$xmlF = expose_M::rpath();
				HTML_content::readFormats($xmlF);
			}
			break;

		case "saveFormats":
			if($sysok==1) {
				$msg = expose_M::SaveFormats();
				echo "<br /><br /><b>".$msg."</b /><br /><br />";
				$xmlF = expose_M::rpath();
				HTML_content::readFormats($xmlF);
			}
			break;

		case "saveConf":
			if($sysok==1) {
				$msg = expose_M::SaveConf();
				echo "<br /><br /><b>".$msg."</b /><br /><br />";
				$xmlF = expose_M::rpath();
				HTML_content::readConf($xmlF);
			}
			break;

		case "manual":
			HTML_content::ShowHelp();
			break;

		case "check":
			HTML_content::ShowCheck();
	}
?>
