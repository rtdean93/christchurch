<?php
/**
* @version $Id: install2.php 3832 2006-06-03 16:47:58Z stingrey $
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

$DBhostname = mosGetParam( $_POST, 'DBhostname', $ConfigManager->config['host'] );
$DBuserName = mosGetParam( $_POST, 'DBuserName', $ConfigManager->config['user'] );
$DBpassword = mosGetParam( $_POST, 'DBpassword', $ConfigManager->config['password'] );
$DBname  	= mosGetParam( $_POST, 'DBname', $ConfigManager->config['db'] );
$DBPrefix  	= mosGetParam( $_POST, 'DBPrefix', $ConfigManager->config['dbprefix'] );
$DBDel  	= intval( mosGetParam( $_POST, 'DBDel', 1 ) );
$DBBackup  	= intval( mosGetParam( $_POST, 'DBBackup', 0 ) );
$DBSample  	= intval( mosGetParam( $_POST, 'DBSample', 1 ) );

$DBcreated	= intval( mosGetParam( $_POST, 'DBcreated', 0 ) );
$BUPrefix = 'old_';
$configArray['sitename'] = trim( mosGetParam( $_POST, 'sitename', $ConfigManager->config['sitename'] ) );

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?".">";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Joomla - Web Installer</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script type="text/javascript">
<!--
function check() {
	// form validation check
	var formValid = true;
	var f = document.form;
	if ( f.sitename.value == '' ) {
		alert('Please enter a Site Name');
		f.sitename.focus();
		formValid = false
	}
	return formValid;
}
//-->
</script>
</head>
<body onload="document.form.sitename.focus();">
<div id="wrapper">
	<div id="header">
	  <div id="joomla"><img src="header_install.png" alt="Joomla Installation" /></div>
	</div>
</div>

<div id="ctr" align="center">
	<form action="install3.php" method="post" name="form" id="form" onsubmit="return check();">
	<input type="hidden" name="DBhostname" value="<?php echo "$DBhostname"; ?>" />
	<input type="hidden" name="DBuserName" value="<?php echo "$DBuserName"; ?>" />
	<input type="hidden" name="DBpassword" value="<?php echo "$DBpassword"; ?>" />
	<input type="hidden" name="DBname" value="<?php echo "$DBname"; ?>" />
	<input type="hidden" name="DBPrefix" value="<?php echo "$DBPrefix"; ?>" />
	<input type="hidden" id="DBcreated" name="DBcreated" value="<?php echo "$DBcreated"; ?>" />
	<div class="install">
		<div id="stepbar">
		  	<div class="step-off">pre-installation check</div>
	  		<div class="step-off">license</div>
		  	<div class="step-off">step 1</div>
		  	<div class="step-on">step 2</div>
	  		<div class="step-off">step 3</div>
		  	<div class="step-off">step 4</div>
		</div>
		<div id="right">
  			<div class="far-right">
  		  		<input class="button" type="submit" name="next" value="Next >>"/>
  			</div>
	  		<div id="step">step 2</div>
  			<div class="clr"></div>

  			<h1>Enter the name of your Joomla site:</h1>
			<div class="install-text">
			SUCCESS!
			<br/>
			<br/>
  			Type in the name for your Joomla site. This
			name is used in email messages so make it something meaningful.
  		</div>
  		<div class="install-form">
  			<div class="form-block">
  				<table class="content2">
  				<tr>
  					<td width="100">Site name</td>
  					<td align="center"><input class="inputbox" type="text" name="sitename" size="50" value="<?php echo $configArray['sitename']; ?>" /></td>
  				</tr>
  				<tr>
  					<td width="100">&nbsp;</td>
  					<td align="center" class="small">e.g. The Home of Joomla</td>
  				</tr>
  				</table>
  			</div>
  		</div>
  		<div class="clr"></div>
  		<div id="break"></div>
	</div>
	<div class="clr"></div>
	</form>
</div>
<div class="clr"></div>
</div>
<div class="ctr">
	<a href="http://www.joomla.org" target="_blank">Joomla!</a> is Free Software released under the GNU/GPL License.
</div>
</body>
</html>