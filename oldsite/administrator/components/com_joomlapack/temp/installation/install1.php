<?php
/**
* @version $Id: install1.php 4675 2006-08-23 16:55:24Z stingrey $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Set flag that this is a parent file
define( "_VALID_MOS", 1 );

/** Include common.php and ajaxtool.php (for sajax integration) */
require_once( 'common.php' );
require_once( "ajaxtool.php" );

global $ConfigManager;

$DBhostname = mosGetParam( $_POST, 'DBhostname', $ConfigManager->config['host'] );
$DBuserName = mosGetParam( $_POST, 'DBuserName', $ConfigManager->config['user'] );
$DBpassword = mosGetParam( $_POST, 'DBpassword', $ConfigManager->config['password'] );
$DBname  	= mosGetParam( $_POST, 'DBname', $ConfigManager->config['db'] );
$DBPrefix  	= mosGetParam( $_POST, 'DBPrefix', $ConfigManager->config['dbprefix'] );
$DBDel  	= intval( mosGetParam( $_POST, 'DBDel', 1 ) );
$DBBackup  	= intval( mosGetParam( $_POST, 'DBBackup', 0 ) );
$DBcreated	= intval( mosGetParam( $_POST, 'DBcreated', 0 ) );

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?".">";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Joomla - Web Installer</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="../images/favicon.ico" />
<link rel="stylesheet" href="install.css" type="text/css" />
<script  type="text/javascript">
<!--

<?php
	// Show SAJAX javascript code...
	sajax_show_javascript();
?>

function check() {
	// form validation check
	var formValid=false;
	var f = document.form;
	if ( f.DBhostname.value == '' ) {
		alert('Please enter a Host name');
		f.DBhostname.focus();
		formValid=false;
	} else if ( f.DBuserName.value == '' ) {
		alert('Please enter a Database User Name');
		f.DBuserName.focus();
		formValid=false;
	} else if ( f.DBname.value == '' ) {
		alert('Please enter a Name for your new Database');
		f.DBname.focus();
		formValid=false;
	} else if ( f.DBPrefix.value == '' ) {
		alert('You must enter a MySQL Table Prefix for Joomla to operate correctly.');
		f.DBPrefix.focus();
		formValid=false;
	} else if ( f.DBPrefix.value == 'old_' ) {
		alert('You cannot use "old_" as the MySQL Table Prefix because Joomla uses this prefix for backup tables.');
		f.DBPrefix.focus();
		formValid=false;
	} else if ( confirm('Are you sure these settings are correct? \nJoomla will now attempt to populate a Database with the settings you have supplied')) {
		formValid=true;
	}

	if (formValid) {
		do_ping_bench();
	}
}

	/*
	 * Timeout detection timer
	 */
	var tElapsed = 0; // Seconds elapsed since timer start
	var tStart  = null; // Time the timer started
	var timerID = 0;
	var ResponseOffset = 0; // Time it takes the server to respond

	function UpdateTimer() {
		if(timerID) {
			clearTimeout(timerID);
		}

		if(!tStart)
			tStart   = new Date();

		var   tDate = new Date();
		var   tDiff = tDate.getTime() - tStart.getTime();

		tDate.setTime(tDiff);

		tElapsed = tDate.getMinutes() * 60 + tDate.getSeconds();
		timerID = setTimeout("UpdateTimer()", 1000);

		// Check if more than 60 seconds elapsed; if so, it's dead
		if (tElapsed > (60 + ResponseOffset)) {
			StopTimer();
			alert("AJAX failed to function within 60 seconds; aborting database restoration.");
			document.getElementById("NextButton").style.display = "block";
			document.getElementById("AJAXInfo").style.display = "none";
		}
	}

	function StartTimer() {
		StopTimer();
		tStart   = new Date();
		timerID  = setTimeout("UpdateTimer()", 1000);
	}

	function StopTimer() {
	   if(timerID) {
	      clearTimeout(timerID);
	      timerID  = 0;
	   }

	   tStart = null;
	}

	function do_ping_bench() {
		document.getElementById("NextButton").style.display = "none";
		document.getElementById("AJAXInfo").style.display = "block";
		document.getElementById("AJAXInfo").innerHTML = "";
		document.getElementById("AJAXInfo").style.background = "#e0e0e0";
		StartTimer();
		x_AjaxPing( do_ping_bench_cb );
	}

	function do_ping_bench_cb( myRet ) {
		StopTimer();
		ResponseOffset = tElapsed;
		checkConnect();
	}

	var totalBytes = 0;
	var nextOffset = 0;

	function checkConnect() {
		var DBhostname 	= document.getElementsByName("DBhostname")[0].value;
		var DBuserName 	= document.getElementsByName("DBuserName")[0].value;
		var DBpassword	= document.getElementsByName("DBpassword")[0].value;
		var DBname		= document.getElementsByName("DBname")[0].value;
		var DBPrefix	= document.getElementsByName("DBPrefix")[0].value;

		x_TryConnect( DBhostname, DBuserName, DBpassword, DBname, DBPrefix, cb_checkConnect );
	}

	function cb_checkConnect( myRet ) {
		if ( myRet['connect'] ) {
			totalBytes = myRet['totalBytes'];
			nextOffset = myRet['nextOffset'];
			checkBackupOrDropTables();
		} else {
			showError('Could not connect to database. The error description was :<br/>' + myRet['errors']);
		}
	}

	function checkBackupOrDropTables() {
		var DBhostname 	= document.getElementsByName("DBhostname")[0].value;
		var DBuserName 	= document.getElementsByName("DBuserName")[0].value;
		var DBpassword	= document.getElementsByName("DBpassword")[0].value;
		var DBname		= document.getElementsByName("DBname")[0].value;
		var DBPrefix	= document.getElementsByName("DBPrefix")[0].value;
		var DBDel		= document.getElementsByName("DBDel")[0].value;
		var DBBackup	= document.getElementsByName("DBBackup")[0].value;
		x_DropOrRenameTables( DBhostname, DBuserName, DBpassword, DBname, DBPrefix, DBDel, DBBackup, checkBackupOrDropTables_cb);
	}

	function checkBackupOrDropTables_cb( myRet ) {
		if (myRet['ok'] == false) {
			showError(myRet['error']);
		} else {
			nextOffset = 0;
			populateDB();
		}
	}

	function populateDB() {
		var DBhostname 	= document.getElementsByName("DBhostname")[0].value;
		var DBuserName 	= document.getElementsByName("DBuserName")[0].value;
		var DBpassword	= document.getElementsByName("DBpassword")[0].value;
		var DBname		= document.getElementsByName("DBname")[0].value;
		var DBPrefix	= document.getElementsByName("DBPrefix")[0].value;

		x_populateDB(DBhostname, DBuserName, DBpassword, DBname, DBPrefix, nextOffset, populateDB_cb);
	}

	function populateDB_cb( myRet ) {
		if (myRet['nextOffset'] == -1) {
			if (myRet['error'] == "") {
				finalize();
			} else {
				showError( myRet['error'] );
			}
		} else {
			nextOffset = myRet['nextOffset'];
			document.getElementById("AJAXInfo").innerHTML = "Restoring database...<br/>" + nextOffset + " from " + totalBytes + " bytes have been processed" ;
			populateDB();
		}
	}

	function finalize() {
		document.getElementById("DBcreated").value = 1;
		document.forms[0].submit();
	}

	function showError( strError ) {
		document.getElementById("AJAXInfo").style.background = "#ffe0a0";
		document.getElementById("NextButton").style.display = "block";
		document.getElementById("AJAXInfo").innerHTML = strError;
		alert('An error has occured. Your database has not been restored.');
	}
//-->
</script>
</head>
<body onload="document.form.DBhostname.focus();">
<div id="wrapper">
	<div id="header">
		<div id="joomla"><img src="header_install.png" alt="Joomla Installation" /></div>
	</div>
</div>
<div id="ctr" align="center">
	<form action="install2.php" method="post" name="form" id="form">
	<input type="hidden" id="DBcreated" name="DBcreated" value="<?php echo $DBcreated; ?>" />
	<div class="install">
		<div id="stepbar">
			<div class="step-off">
				pre-installation check
			</div>
			<div class="step-off">
				license
			</div>
			<div class="step-on">
				step 1
			</div>
			<div class="step-off">
				step 2
			</div>
			<div class="step-off">
				step 3
			</div>
			<div class="step-off">
				step 4
			</div>
		</div>
		<div id="right">
			<div class="far-right">
				<input class="button" type="button" name="next" value="Next >>" id="NextButton" onclick="check();" />
  			</div>
	  		<div id="step">
	  			step 1
	  		</div>
  			<div class="clr"></div>
  			<h1>MySQL database configuration:</h1>
			<div id="AJAXInfo" style="display:none; background-color: #e0e0e0; border: thin solid #333333; margin: 2em; padding: 1em; font-size: 125%;">
			</div>
			<div class="clr"></div>
	  		<div class="install-text">
  				<p>Setting up Joomla to run on your server involves 4 simple steps...</p>
  				<p>Please enter the hostname of the server Joomla is to be installed on.</p>
				<p>Enter the MySQL username, password and database name you wish to use with Joomla.</p>
				<p>Enter a table name prefix to be used by this Joomla! install and select what
					to do with existing tables from former installations.</p>
				<p>Install the sample data unless you are an experienced Joomla! User wanting to start with a completely empty site.</p>
  			</div>
			<div class="install-form">
  				<div class="form-block">
  		 			<table class="content2">
  		  			<tr>
  						<td></td>
  						<td></td>
  						<td></td>
  					</tr>
  		  			<tr>
  						<td colspan="2">
  							Host Name
  							<br/>
  							<input class="inputbox" type="text" name="DBhostname" value="<?php echo "$DBhostname"; ?>" />
  						</td>
			  			<td>
			  				<em>This is usually 'localhost'</em>
			  			</td>
  					</tr>
					<tr>
			  			<td colspan="2">
			  				MySQL User Name
			  				<br/>
			  				<input class="inputbox" type="text" name="DBuserName" value="<?php echo "$DBuserName"; ?>" />
			  			</td>
			  			<td>
			  				<em>Either something as 'root' or a username given by the hoster</em>
			  			</td>
  					</tr>
			  		<tr>
			  			<td colspan="2">
			  				MySQL Password
			  				<br/>
			  				<input class="inputbox" type="text" name="DBpassword" value="<?php echo "$DBpassword"; ?>" />
			  			</td>
			  			<td>
			  				<em>For site security using a password for the mysql account is mandatory</em>
			  			</td>
					</tr>
  		  			<tr>
  						<td colspan="2">
  							MySQL Database Name
  							<br/>
  							<input class="inputbox" type="text" name="DBname" value="<?php echo "$DBname"; ?>" />
  						</td>
			  			<td>
			  				<em>Some hosts allow only a certain DB name per site. Use table prefix in this case for distinct Joomla sites.</em>
			  			</td>
  					</tr>
  		  			<tr>
  						<td colspan="2">
  							MySQL Table Prefix
  							<br/>
  							<input class="inputbox" type="text" name="DBPrefix" value="<?php echo "$DBPrefix"; ?>" />
  						</td>
			  			<td>
			  			<!--
			  			<em>Don't use 'old_' since this is used for backup tables</em>
			  			-->
			  			</td>
  					</tr>
  		  			<tr>
			  			<td>
			  				<input type="checkbox" name="DBDel" id="DBDel" value="1" <?php if ($DBDel) echo 'checked="checked"'; ?> />
			  			</td>
						<td>
							<label for="DBDel">Drop Existing Tables</label>
						</td>
  						<td>
  						</td>
			  		</tr>
  		  			<tr>
			  			<td>
			  				<input type="checkbox" name="DBBackup" id="DBBackup" value="1" <?php if ($DBBackup) echo 'checked="checked"'; ?> />
			  			</td>
						<td>
							<label for="DBBackup">Backup Old Tables</label>
						</td>
  						<td>
  							<em>Any existing backup tables from former Joomla installations will be replaced</em>
  						</td>
			  		</tr>
		  		 	</table>
  				</div>
			</div>
		</div>
		<div class="clr"></div>
	</div>
	</form>
</div>
<div class="clr"></div>
<div class="ctr">
	<a href="http://www.joomla.org" target="_blank">Joomla!</a> is Free Software released under the GNU/GPL License.
</div>
</body>
</html>
<?php
ob_end_flush();
?>