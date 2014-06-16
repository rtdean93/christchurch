<?php
/**
* @version $Id: install4.php 3773 2006-06-01 09:49:10Z stingrey $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

set_time_limit(0);

// Set flag that this is a parent file
define( "_VALID_MOS", 1 );

// Include common.php
require_once( 'common.php' );
require_once( '../includes/database.php' );

$DBhostname = mosGetParam( $_POST, 'DBhostname', $ConfigManager->config['host'] );
$DBuserName = mosGetParam( $_POST, 'DBuserName', $ConfigManager->config['user'] );
$DBpassword = mosGetParam( $_POST, 'DBpassword', $ConfigManager->config['password'] );
$DBname  	= mosGetParam( $_POST, 'DBname', $ConfigManager->config['db'] );
$DBPrefix  	= mosGetParam( $_POST, 'DBPrefix', $ConfigManager->config['dbprefix'] );
$sitename  	= mosGetParam( $_POST, 'sitename', $ConfigManager->config['sitename'] );

$adminEmail = mosGetParam( $_POST, 'adminEmail', $ConfigManager->config['mailfrom']);
$siteUrl  	= mosGetParam( $_POST, 'siteUrl', $ConfigManager->config['live_site']);

$absolutePath = mosGetParam( $_POST, 'absolutePath', '' );
$adminPassword = mosGetParam( $_POST, 'adminPassword', '');

$filePerms = '';
if (mosGetParam($_POST,'filePermsMode',0))
	$filePerms = '0'.
		(mosGetParam($_POST,'filePermsUserRead',0) * 4 +
		 mosGetParam($_POST,'filePermsUserWrite',0) * 2 +
		 mosGetParam($_POST,'filePermsUserExecute',0)).
		(mosGetParam($_POST,'filePermsGroupRead',0) * 4 +
		 mosGetParam($_POST,'filePermsGroupWrite',0) * 2 +
		 mosGetParam($_POST,'filePermsGroupExecute',0)).
		(mosGetParam($_POST,'filePermsWorldRead',0) * 4 +
		 mosGetParam($_POST,'filePermsWorldWrite',0) * 2 +
		 mosGetParam($_POST,'filePermsWorldExecute',0));

$dirPerms = '';
if (mosGetParam($_POST,'dirPermsMode',0))
	$dirPerms = '0'.
		(mosGetParam($_POST,'dirPermsUserRead',0) * 4 +
		 mosGetParam($_POST,'dirPermsUserWrite',0) * 2 +
		 mosGetParam($_POST,'dirPermsUserSearch',0)).
		(mosGetParam($_POST,'dirPermsGroupRead',0) * 4 +
		 mosGetParam($_POST,'dirPermsGroupWrite',0) * 2 +
		 mosGetParam($_POST,'dirPermsGroupSearch',0)).
		(mosGetParam($_POST,'dirPermsWorldRead',0) * 4 +
		 mosGetParam($_POST,'dirPermsWorldWrite',0) * 2 +
		 mosGetParam($_POST,'dirPermsWorldSearch',0));

if ((trim($adminEmail== "")) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $adminEmail )==false)) {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";
	echo "<script>alert('You must provide a valid admin email address.'); document.stepBack.submit(); </script>";
	return;
}

if($DBhostname && $DBuserName && $DBname) {
	$configArray['DBhostname']	= $DBhostname;
	$configArray['DBuserName']	= $DBuserName;
	$configArray['DBpassword']	= $DBpassword;
	$configArray['DBname']	 	= $DBname;
	$configArray['DBPrefix']	= $DBPrefix;
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";

	echo "<script>alert('The database details provided are incorrect and/or empty'); document.stepBack.submit(); </script>";
	return;
}

if ($sitename) {
	if (!get_magic_quotes_gpc()) {
		$configArray['sitename'] = addslashes($sitename);
	} else {
		$configArray['sitename'] = $sitename;
	}
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBPrefix\" value=\"$DBPrefix\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		<input type=\"hidden\" name=\"filePerms\" value=\"$filePerms\" />
		<input type=\"hidden\" name=\"dirPerms\" value=\"$dirPerms\" />
		</form>";

	echo "<script>alert('The sitename has not been provided'); document.stepBack2.submit();</script>";
	return;
}

if (file_exists( '../configuration.php' )) {
	$canWrite = is_writable( '../configuration.php' );
} else {
	$canWrite = is_writable( '..' );
}

if ($siteUrl) {
	// Fix for Windows
	$absolutePath= str_replace("\\\\","/", $absolutePath);
	// Feed ConfigManager the user selected values
	$ConfigManager->config['host'] = $DBhostname;
	$ConfigManager->config['user'] = $DBuserName;
	$ConfigManager->config['password'] = $DBpassword;
	$ConfigManager->config['db'] = $DBname;
	$ConfigManager->config['dbprefix'] = $DBPrefix;

	$ConfigManager->config['absolute_path'] = $absolutePath;
	$ConfigManager->config['live_site'] = $siteUrl;
	$ConfigManager->config['sitename'] = $sitename;

	$ConfigManager->config['cachepath'] = $absolutePath . "/cache";
	$ConfigManager->config['fromname'] = $sitename;
	$ConfigManager->config['mailfrom'] = $adminEmail;

	$ConfigManager->config['secret'] = mosMakePassword(16);

	$ConfigManager->config['fileperms']=$filePerms;
	$ConfigManager->config['dirperms']=$dirPerms;

	$config = $ConfigManager->ConfigurationContents();

	if ($canWrite && ($fp = fopen("../configuration.php", "w"))) {
		fputs( $fp, $config, strlen( $config ) );
		fclose( $fp );
	} else {
		$canWrite = false;
	} // if

	$cryptpass=md5( $adminPassword );

	$database = new database( $DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix );
	$nullDate = $database->getNullDate();

	// drop the admin user if he already exists
	$query = "DELETE FROM `#__users` WHERE id=62 LIMIT 1,1";
	$database->setQuery( $query );
	$database->query();
	// create the admin user
	$installdate = date('Y-m-d H:i:s');
	$query = "INSERT INTO `#__users` VALUES (62, 'Administrator', 'admin', '$adminEmail', '$cryptpass', 'Super Administrator', 0, 1, 25, '$installdate', '$nullDate', '', '')";
	$database->setQuery( $query );
	$database->query();
	// drop pre-existing ARO
	$query = "DELETE FROM `#__core_acl_aro` WHERE aro_id=10 LIMIT 1,1";
	$database->setQuery( $query );
	$database->query();
	// add the ARO (Access Request Object)
	$query = "INSERT INTO `#__core_acl_aro` VALUES (10,'users','62',0,'Administrator',0)";
	$database->setQuery( $query );
	$database->query();
	// drop pre-existing map between the ARO and the Group
	$query = "DELETE FROM `#__core_acl_groups_aro_map` WHERE group_id=10 AND aro_id=10 LIMIT 1,1";
	$database->setQuery( $query );
	$database->query();
	// add the map between the ARO and the Group
	$query = "INSERT INTO `#__core_acl_groups_aro_map` VALUES (25,'',10)";
	$database->setQuery( $query );
	$database->query();

	// chmod files and directories if desired
	$chmod_report = "Directory and file permissions left unchanged.";
	if ($filePerms != '' || $dirPerms != '') {
		$mosrootfiles = array(
			'administrator',
			'cache',
			'components',
			'images',
			'language',
			'mambots',
			'media',
			'modules',
			'templates',
			'configuration.php'
		);
		$filemode = NULL;
		if ($filePerms != '') $filemode = octdec($filePerms);
		$dirmode = NULL;
		if ($dirPerms != '') $dirmode = octdec($dirPerms);
		$chmodOk = TRUE;
		foreach ($mosrootfiles as $file) {
			if (!mosChmodRecursive($absolutePath.'/'.$file, $filemode, $dirmode)) {
				$chmodOk = FALSE;
			}
		}
		if ($chmodOk) {
			$chmod_report = 'File and directory permissions successfully changed.';
		} else {
			$chmod_report = 'File and directory permissions could not be changed.<br />'.
							'Please CHMOD Joomla files and directories manually.';
		}
	} // if chmod wanted
} else {
?>
	<form action="install3.php" method="post" name="stepBack3" id="stepBack3">
	  <input type="hidden" name="DBhostname" value="<?php echo $DBhostname;?>" />
	  <input type="hidden" name="DBusername" value="<?php echo $DBuserName;?>" />
	  <input type="hidden" name="DBpassword" value="<?php echo $DBpassword;?>" />
	  <input type="hidden" name="DBname" value="<?php echo $DBname;?>" />
	  <input type="hidden" name="DBPrefix" value="<?php echo $DBPrefix;?>" />
	  <input type="hidden" name="DBcreated" value="1" />
	  <input type="hidden" name="sitename" value="<?php echo $sitename;?>" />
	  <input type="hidden" name="adminEmail" value="$adminEmail" />
	  <input type="hidden" name="siteUrl" value="$siteUrl" />
	  <input type="hidden" name="absolutePath" value="$absolutePath" />
	  <input type="hidden" name="filePerms" value="$filePerms" />
	  <input type="hidden" name="dirPerms" value="$dirPerms" />
	</form>
	<script>alert('The site url has not been provided'); document.stepBack3.submit();</script>
<?php
}
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?".">";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Joomla - Web Installer</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="joomla"><img src="header_install.png" alt="Joomla Installation" /></div>
	</div>
</div>
<div id="ctr" align="center">
	<form action="dummy" name="form" id="form">
	<div class="install">
		<div id="stepbar">
			<div class="step-off">pre-installation check</div>
			<div class="step-off">license</div>
			<div class="step-off">step 1</div>
			<div class="step-off">step 2</div>
			<div class="step-off">step 3</div>
			<div class="step-on">step 4</div>
		</div>
		<div id="right">
			<div id="step">step 4</div>
			<div class="far-right">
				<input class="button" type="button" name="runSite" value="View Site"
<?php
				if ($siteUrl) {
					echo "onClick=\"window.location.href='$siteUrl/index.php' \"";
				} else {
					echo "onClick=\"window.location.href='".$configArray['siteURL']."/index.php' \"";
				}
?>/>
				<input class="button" type="button" name="Admin" value="Administration"
<?php
				if ($siteUrl) {
					echo "onClick=\"window.location.href='$siteUrl/administrator/index.php' \"";
				} else {
					echo "onClick=\"window.location.href='".$configArray['siteURL']."/administrator/index.php' \"";
				}
?>/>
			</div>
			<div class="clr"></div>
			<h1>Congratulations! Joomla is installed</h1>
			<div class="install-text">
				<p>Click the "View Site" button to start Joomla site or "Administration"
					to take you to administrator login.</p>
			</div>
			<div class="install-form">
				<div class="form-block">
					<table width="100%">
						<tr><td class="error" align="center">PLEASE REMEMBER TO COMPLETELY<br/>REMOVE THE INSTALLATION DIRECTORY</td></tr>
						<tr><td align="center"><h5>Administration Login Details</h5></td></tr>
						<tr><td align="center" class="notice"><b>Username : admin</b></td></tr>
						<tr><td align="center" class="notice"><b>Password : <?php echo $adminPassword; ?></b></td></tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td align="right">&nbsp;</td></tr>
<?php						if (!$canWrite) { ?>
						<tr>
							<td class="small">
								Your configuration file or directory is not writeable,
								or there was a problem creating the configuration file. You'll have to
								upload the following code by hand. Click in the textarea to highlight
								all of the code.
							</td>
						</tr>
						<tr>
							<td align="center">
								<textarea rows="5" cols="60" name="configcode" onclick="javascript:this.form.configcode.focus();this.form.configcode.select();" ><?php echo htmlspecialchars( $config );?></textarea>
							</td>
						</tr>
<?php						} ?>
						<tr><td class="small"><?php /*echo $chmod_report*/; ?></td></tr>
					</table>
				</div>
			</div>
			<div id="break"></div>
		</div>
		<div class="clr"></div>
	</div>
	</form>
</div>
<div class="clr"></div>
<div class="ctr">
	<a href="http://www.joomla.org" target="_blank">Joomla!</a> is Free Software released under the GNU/GPL License.
</div>
</html>
