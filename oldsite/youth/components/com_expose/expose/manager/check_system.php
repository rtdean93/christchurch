<?php
/****************************************************************************
Component: Expose
Function : Joomla 1.x flash gallery component.
Version  : 4.6.2 (19/10/2007)
Author   : Bruno Marchant
Based on : Andrew Lindeman (www.koders.com - ghcc.php 1v11 2006/01/06)
Web Site : www.gotgtek.net
Copyright: Copyright 2007 by GTEK Technologies
License  : GNU General Public License (GPL), visit www.slooz.com for details
			This program is free software; you can redistribute it and/or modify
			it under the terms of the GNU General Public License as published by
			the Free Software Foundation; either version 2 of the License, or (at
			your option) any later version.
 
			This program is distributed in the hope that it will be useful, but
			WITHOUT ANY WARRANTY; without even the implied warranty of
			MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
			General Public License for more details.
*********************************************************************************
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// Activate error_reporting(E_ALL);
	error_reporting( E_ALL & ~E_NOTICE); 

// **** DEFIGN STANDARD SETTINGS ****
$MD5_File = 'expose.md5';
$skipfiles = array(
	'expose/manager/expose.md5');

	$path = dirname(__FILE__) .'/';
	$path = str_replace('\\', '/', $path);
	//goto the root of com_expose
	$path = substr( $path, 0, strrpos( $path, '/') );
	$path = substr( $path, 0, strrpos( $path, '/') );
	$path = substr( $path, 0, strrpos( $path, '/') );

// **** GENERAL FUNCTIONS ****

// Utility function to read the files in a directory (code in /includes/joomla.php:3030)
//function mosReadDirectory( $path, $filter='.', $recurse=false, $fullpath=false  ) {

// Function to strip additional / or \ in a path name (code in \includes\joomla.php:3165)
//function mosPathName($p_path,$p_addtrailingslash = true) {

function is__writable($path) {
//will work in despite of Windows ACLs bug
//NOTE: use a trailing slash for folders!!!
//see http://bugs.php.net/bug.php?id=27609
//see http://bugs.php.net/bug.php?id=30931

	if ($path{strlen($path)-1}=='/')
		return is__writable($path.uniqid(mt_rand()).'.tmp');
	else if (is_dir($path))
		return is__writable($path.'/'.uniqid(mt_rand()).'.tmp');
	// check tmp file for read/write capabilities
	$rm = file_exists($path);
	$f = @fopen($path, 'a');
	if ($f===false)
		return false;
	fclose($f);
	if (!$rm)
		unlink($path);
	return true;
}

//Read php.ini setting (return: true/false)
function get_php_setting($val) {
	return (ini_get($val) == '1' ? 1 : 0);
}

//Get a part ($value) of text ($text) 
function setastext($value,$text) {
	$words = split(";", $text);
//  if ($value == 0 || $value == 1) {
	return $words[$value];
// }
//  else return $words[3];
}

//Read the installation xml file information tags
function install_info($tagname){
	// add XML library functions
	require_once( '../includes/domit/xml_domit_lite_include.php' );

	$xmlDoc = new DOMIT_Lite_Document();
	$xmlDoc->resolveErrors( true );

	if (!$xmlDoc->loadXML( '../administrator/components/com_expose/expose.xml', false, true )) {
		continue;
	}

	$root = &$xmlDoc->documentElement;

	if ($root->getTagName() != 'mosinstall') {
		continue;
	}
	if ($root->getAttribute( "type" ) != "component") {
		continue;
	}

	switch ($tagname){
	  case 'creationdate':
			$element = &$root->getElementsByPath('creationDate', 1);
			return $element ? $element->getText() : 'Unknown';
		case 'author':
			$element = &$root->getElementsByPath('author', 1);
			return $element ? $element->getText() : 'Unknown';
		case 'copyright': 
			$element = &$root->getElementsByPath('copyright', 1);
			return $element ? $element->getText() : '';
		case 'authorEmail':
			$element = &$root->getElementsByPath('authorEmail', 1);
			return $element ? $element->getText() : '';
		case 'authorUrl':
			$element = &$root->getElementsByPath('authorUrl', 1);
			return $element ? $element->getText() : '';
		case 'version':
			$element = &$root->getElementsByPath('version', 1);
			return $element ? $element->getText() : '';
	}
}

//Get the free drivespace
function my_drivespace(){
	  return intval(disk_free_space($_SERVER['DOCUMENT_ROOT'])/1048576);
}

// **** MD5 CHECK FUNCTIONS ****
// Modified snippet from Joomla! Tools Suite (@author Adam van dongen)
// Generate new file with MD5 hash results
function generateMd5Hash($opath = null, $MD5_File, $skipfiles) {
	if (is_null($opath)) return;

	$files = mosReadDirectory($opath, '.', true, true);
	$filecontent = '';

	echo "<table border='0' width='100%' cellspadding='1' cellspacing='0' align='left' class='content'>";

	for($i=0,$n=count($files);$i<$n;$i++){
		$file = str_replace($opath . '/', '', str_replace("\\", "/", $files[$i]));
		if(!in_array($file, $skipfiles)){ //skip files that have been defined...
			if(is_file($opath . '/' . $file)){
				echo "<tr><td>". $file ."</td></tr>\n";
				$filecontent .= $file . "\t" . getFileHash($opath . '/' . $file) . "\n";
			}
		}
	}

	$fp = fopen($MD5_File, "w");
	if (fwrite($fp, $filecontent) === FALSE) {
		echo "<tr><td class='warn-message'> New MD5 hashs could NOT be written to ".$MD5_File."... </td></tr></table>";
		exit;
	}
	echo "<tr><td class='good-message'> New MD5 hash created and written to ".$MD5_File."... </td></tr></table>";
	fclose($fp);
}

function getFileHash($file){
  $content = file_get_contents($file);
  $content = str_replace(array("\n", "\r"), "", $content);
  return md5($content);
}

function compair($opath = null, &$errarr, $MD5_File, $skipfiles){
	if (is_null($opath)) return;

	ob_flush();
	flush();

	$orig = array();
	$orig_c = file($MD5_File);

	for($i=0,$n=count($orig_c);$i<$n;$i++){
		$line = explode("\t", $orig_c[$i]);
		$orig[$opath . '/'. $line[0]] = trim($line[1]);
	}
	ob_flush();
	flush();

	$files = mosReadDirectory($opath, '.', true, true); //false, true);

	echo '<table cellpadding="0" cellspacing="1" border="1" width="100%">';  
	for($i=0,$n=count($files);$i<$n;$i++) {
		$file = str_replace('\\', '/', $files[$i]);
		if($content = @file_get_contents($file)) { //check if file is file or directory
			if((!empty($orig[$file])) && (getFileHash($file) != $orig[$file])){ //when a hash exists
				echo '<tr><td>WARNING</td><td>' .$file . '</td><td colspan="2">File is corrupted or has been altered</td></tr>';
				$errarr[4] ++;
			}
//			elseif(empty($orig[$file])){ //when a hash doesn't exists
//				if(!in_array($file, $skipfiles)){ //skip files that have been defined...
//					echo '<tr><td>WARNING</td><td>' . $file . '</td><td colspan="2">Unexpected File found!</td></tr>';
//					$errarr[4] ++;
//				}
//			}
			ob_flush();
			flush();
		}
		unset($orig[$file]);
	}

	if(sizeof($orig) > 0){ 
		$keys = array_keys($orig);
		for($i=0,$n=count($keys);$i<$n;$i++){
			$file = $keys[$i];
			echo '<tr><td>MISSING</td><td>' . $file . '</td><td colspan="2">File is missing</td></tr>';
			$errarr[4] ++;
			ob_flush();
			flush();
		}
	}
	if ($errarr[4] == 0) {
		echo '<tr><td>PASS</td><td>Your Expose installation matches the default setup values</td><td colspan="2">Installation Successful</td></tr>';
	}
	echo '</table>';
}

// **** HTML PRINTOUT FUNCTIONS ****
//Create html tabel code from $testarray information + keep track of errorious values
function print_table($testarr, &$errarr){
	echo "<table cellpadding='5' border='1'><tr><td>Setting</td><td>Value</td><td>FrontEnd</td><td>BackEnd</td></tr>\n";
	foreach ($testarr as $arr) {
		$showmsg = false;
		print '<tr><td><b>'.$arr['desc'].'</b></td><td><b>'.setastext($arr['test'],$arr['setng']).'</b></td>';
		print '<td>';

	//use pics for pass and fail
	//$img = ((ini_get('register_globals')) ? 'publish_x.png' : 'tick.png');
	//echo "<img src='../images/$img'";
	
  //if test is true, then setting is ok
		if ($arr['test']) {
			print '<font color="#00aa00">Pass</font>';
		}
		// if test is false, but warning
		elseif ($arr['sevfront'] == 1) {
			print '<font color="#e0850f">Warning</font>';
			//$warningfront ++;
			$errarr[0] ++;
			$showmsg = true;
		}
		// if test is false and fatal
		elseif ($arr['sevfront'] == 2) {
			print '<font color="#bb0000">Fatal Warning</font>';
			//$fatalfront ++;
			$errarr[1] ++;
			$showmsg = true;
		}

		print	'</td><td>';

		if ($arr['test']) {
			print '<font color="#00aa00">Pass</font>';
		}
		elseif ($arr['sevback'] == 1) {
			print '<font color="#e0850f">Warning</font>';
			//$warningback ++;
			$errarr[2] ++;
		$showmsg = true;
		}
		elseif ($arr['sevback'] == 2) {
			print '<font color="#bb0000">Fatal Warning</font>';
			//$fatalback ++;
			$errarr[3] ++;
			$showmsg = true;
		}

		if ($showmsg) print "</td></tr>\n<tr><td colspan='4'>&nbsp;&nbsp;&nbsp;<font size='2' >&rArr;&nbsp;".$arr['failmsg']."</font>";
		print "</td></tr>\n";
	}
	print '</table><br/>';
}

// START OF SCRIPT **********

/*
desc - A description of the test
setng - Actual value of setting (test = false, test = true)
test - Boolean value of the result, true = good, false = bad
failmsg - Message to display on fail of test
sevfront - Severity of a fail in frontend, 0 = unused, 1 = warning, 2 = fatal
sevback - Severity of a fail in backend (Manager), 0 = unused, 1 = warning, 2 = fatal
*/

// Read all general System settings
$systests = array (
		0 => array ("desc" => "PHP built On",
		  	 	"setng" => (' ;'.php_uname()),
				"test" => True,
				"failmsg" => "",
				"sevfront" => 0,
				"sevback" => 0),
		1 => array ("desc" => "PHP Version",
				"setng" => phpversion().';'.phpversion(),
				"test" => version_compare(phpversion(),'4','>='),
				"failmsg" => "Must be at least version 4 or higher.",
				"sevfront" => 2,
				"sevback" => 2),
		2 => array ("desc" => "WebServer to PHP interface",
				"setng" => php_sapi_name().';'.php_sapi_name(),
				"test" => (php_sapi_name() == 'apache2handler'),
				"failmsg" => "Recommended 'apache2handler' interface.",
				"sevfront" => 1,
				"sevback" => 1),
		3 => array ("desc" => "Disabled functions",
				"setng" => (ini_get('disable_functions').";none"),
				"test" => (ini_get('disable_functions') == ''),
				"failmsg" => "Some disabled functions could cause problems.",
				"sevfront" => 1,
				"sevback" => 1));

//($df=ini_get('disable_functions'))?$df:'none')

// Read all general Joomla settings
$joomtests = array (
		0 => array ("desc" => "Register Globals Emulation",
				"setng" => "enabled;disabled",
				"test" => (get_php_setting('RG_EMULATION')),
				"failmsg" => "For security reasons, disable RG_EMULATION in Joomla global configuration.<br/>Register Globals Emulation is `ON` by default for backward compatibility.<br/><a href='http://www.joomla-addons.org/easyfaq/view/joomla-diagnostics/register-globals-emulation/136.html' target='_blank'>Read more...</a>",
				"sevfront" => 1,
				"sevback" => 1),
		1 => array ("desc" => "Register Globals",
				"setng" => "enabled;disabled",
				"test" => (!get_php_setting('register_globals')),
				"failmsg" => "For security reasons, disable register_globals in php.ini (hoster issue).<br/><a href='http://www.joomla-addons.org/easyfaq/view/joomla-diagnostics/register-globals/136.html' target='_blank'>Read more...</a>",
				"sevfront" => 1,
				"sevback" => 1),
		2 => array ("desc" => "Magic Quotes",
				"setng" => "enabled;disabled",
				"test" => (get_php_setting('magic_quotes_gpc')),
				"failmsg" => "Should be enabled for Joomla in php.ini, but not used in Expose.",
				"sevfront" => 1,
				"sevback" => 1),
		3 => array ("desc" => "Safe Mode",
				"setng" => "enabled;disabled",
				"test" => (!get_php_setting('safe_mode')),
				"failmsg" => "When enabled, you will have lots of problems concerning the ownership of files. Must be disabled in php.ini.",
				"sevfront" => 1,
				"sevback" => 2),
		4 => array ("desc" => "File Uploads",
				"setng" => "disabled;enabled",
				"test" => (get_php_setting('file_uploads') != ''),
				"failmsg" => "Should be enabled in php.ini to use the PHP upload function.<br/>Use upload to bucket folder by FTP as an alternative for now.",
				"sevfront" => 0,
				"sevback" => 1),
		5 => array ("desc" => "Session auto start",
				"setng" => "enabled;disabled",
				"test" => !get_php_setting('session.auto_start'),
				"failmsg" => "A visitor accessing your web site is assigned a unique id, the so-called session id. This enables you to build more customized applications and increase the appeal of your web site.",
				"sevfront" => 1,
				"sevback" => 1));

// Read all used Library settings
$libtests = array (
		0 => array ("desc" => "DOM or DOMXML extention (test 1)",
				"setng" => "NOT installed;installed",
				"test" => (extension_loaded('xml')),
				"failmsg" => "Must be installed and enabled in php.ini for reading the gallery data files.",
				"sevfront" => 2,
				"sevback" => 2),
		1 => array ("desc" => "DOM or DOMXML extention (test 2)",
				"setng" => "NOT installed;installed",
				"test" => (version_compare ('5.0.0', phpversion(), '<=') == 1 || function_exists ('domxml_open_file')),
				"failmsg" => "Must be installed and enabled in php.ini for reading the gallery data files.",
				"sevfront" => 2,
				"sevback" => 2),
		2 => array ("desc" => "GD extention",
				"setng" => "NOT installed;installed",
				"test" => (extension_loaded('gd')),
				"failmsg" => "Must be installed and activated in php.ini for manipulating the images (like resizing, watermark...).",
				"sevfront" => 0,
				"sevback" => 2));

if (extension_loaded('gd')) { // first test if this lib is enabled, then check subsettings
	if (function_exists ('gd_info')) {
		$array = gd_info();

		$libtests[] = array ("desc" => "JPG Support",
				"setng" => "disabled;enabled",
				"test" => ($array['JPG Support'] == true),
				"failmsg" => "Must be activated in php.ini for manipulating JPG type images.",
				"sevfront" => 0,
				"sevback" => 2);
		$libtests[] = array ("desc" => "FreeType Support",
				"setng" => "disabled;enabled",
				"test" => ($array['FreeType Support'] == true),
				"failmsg" => "Must be activated in php.ini for adding a watermarktext over the image.",
				"sevfront" => 0,
				"sevback" => 2);
	}
}

// Check all path and file permissions
$pathtests = array (
		0 => array ("desc" => "/xml path:<br/>&nbsp;&nbsp;&lt;joomla_root&gt;/components/com_expose/expose/xml/",
				"setng" => "NOT writable;writable",
				"test" => (is_dir($path.'/expose/xml/') && is__writable($path.'/expose/xml/')),
				"failmsg" => "Set the correct permissions for &lt;joomla_root&gt;/components/com_expose/expose/xml/ folder (make writable).",
				"sevfront" => 0,
				"sevback" => 1),
		1 => array ("desc" => "/img path:<br/>&nbsp;&nbsp;&lt;joomla_root&gt;/components/com_expose/expose/img/",
				"setng" => "NOT writable;writable",
				"test" => (is_dir($path.'/expose/img/') && is__writable($path.'/expose/img/')),
				"failmsg" => "Set the correct permissions for &lt;joomla_root&gt;/components/com_expose/expose/img/ folder (make writable).",
				"sevfront" => 0,
				"sevback" => 1),
		2 => array ("desc" => ("Session Save path:<br/>&nbsp;&nbsp;".ini_get('session.save_path')),
				"setng" => "NOT writable;writable",
				"test" => (is_dir(ini_get('session.save_path')) && is_writable(ini_get('session.save_path'))),
				"failmsg" => "Must be set to a valid directory and be writable by the web server user.",
				"sevfront" => 2,
				"sevback" => 2),
		3 => array ("desc" => "Password file attributes<br/>&nbsp;&nbsp;&lt;joomla_root&gt;/components/com_expose/expose/amfphp/extra/passhash.inc.php",
				"setng" => "NOT writable;writable",
				"test" => (is_dir($path.'/expose/manager/amfphp/extra/') && is__writable($path.'/expose/manager/amfphp/extra/passhash.inc.php')),
				"failmsg" => "Set the correct permissions for &lt;joomla_root&gt;/components/expose/manager/amfphp/extra/passhash.inc.php file (make writable).",
				"sevfront" => 0,
				"sevback" => 1),
		4 => array ("desc" => "Configuration file attributes:<br/>&nbsp;&nbsp;&lt;joomla_root&gt;/components/com_expose/expose/config/config.xml",
				"setng" => "NOT writable;writable",
				"test" => (is_dir($path.'/expose/config/') && is__writable($path.'/expose/config/config.xml')),
				"failmsg" => "Set the correct permissions for &lt;joomla_root&gt;/components/com_expose/expose/config/config.xml file (make writable).",
				"sevfront" => 0,
				"sevback" => 1),
		5 => array ("desc" => "Manager Settings file attributes:<br/>&nbsp;&nbsp;&lt;joomla_root&gt;/components/com_expose/expose/manager/amfphp/extra/config.xml",
				"setng" => "NOT writable;writable",
				"test" => (is_dir($path.'/expose/manager/amfphp/extra/') && is__writable($path.'/expose/manager/amfphp/extra/config.xml')),
				"failmsg" => "Set the correct permissions for &lt;joomla_root&gt;/components/com_expose/expose/manager/amfphp/extra/config.xml file (make writable).",
				"sevfront" => 0,
				"sevback" => 1),
		6 => array ("desc" => "Hash file attributes:<br/>&nbsp;&nbsp;&lt;joomla_root&gt;/components/com_expose/expose/manager/expose.md5",
				"setng" => "writable;not writable",
				"test" => (is_dir($path.'/expose/manager/') && is__writable($path.'/expose/manager/expose.md5')),
				"failmsg" => "For security, it's recommended to set &lt;joomla_root&gt;/components/com_expose/expose/manager/expose.md5 file UNwritable.",
				"sevfront" => 0,
				"sevback" => 1));

	if (ini_get ('upload_tmp_dir')) { // it defaults to a default system location, only test if this is set
	$pathtests[] = array ("desc" => "Temporary Upload path:<br/>&nbsp;&nbsp;".ini_get('upload_tmp_dir'),
				"setng" => "NOT writable;writable",
				"test" => (is_dir(ini_get('upload_tmp_dir')) && is__writable (ini_get ('upload_tmp_dir')) ),
				"failmsg" => "Must be set to a valid directory and be writable by the web server user.<br/>Use upload to bucket folder by FTP as an alternative.",
				"sevfront" => 0,
				"sevback" => 1);
	}
				//check if still more than 1M free (1024x1024)
		$pathtests[] = array ("desc" => "Free Disk Space<br/>&nbsp;&nbsp;Warning: value is TOTAL disk space, shared hosting is limited by account settings!",
				"setng" => (my_drivespace()."Mb;".my_drivespace()."Mb"),
				"test" => (my_drivespace() > 2),
				"failmsg" => "Add more free diskspace! Pictures are spaceconsuming files!",
				"sevfront" => 1,
				"sevback" => 1);

// Check some Expose specific settings
$exposetests = array (
		0 => array ("desc" => "Version",
				"setng" => (install_info('version').";&nbsp;"),
				"test" => (False),
				"failmsg" => "Be sure to verify <a href='http://joomlacode.org/gf/project/expose/' target='_blank'>JoomlaCode.org</a> for the latest release",
				"sevfront" => 1,
				"sevback" => 1),
		1 => array ("desc" => "Creation Date",
				"setng" => (install_info('creationdate').";&nbsp;"),
				"test" => (False),
				"failmsg" => "Be sure to verify <a href='http://joomlacode.org/gf/project/expose/' target='_blank'>JoomlaCode.org</a> for the latest release",
				"sevfront" => 0,
				"sevback" => 0),
		2 => array ("desc" => "Exec()",
				"setng" => "disabled;enabled",
				"test" => (!in_array ('exec', split (',\s*', ini_get ('disable_functions')))),
				"failmsg" => "Remove from disabled_functions setting in php.ini",
				"sevfront" => 1,
				"sevback" => 1),
		3 => array ("desc" => "Session Cookies",
				"setng" => "disabled;enabled",
				"test" => (get_php_setting('session.use_cookies')),
				"failmsg" => "Must be enabled in php.ini.",
				"sevfront" => 0,
				"sevback" => 0),
		4 => array ("desc" => "Allow Url Fopen",
				"setng" => "disabled;enabled",
				"test" => (get_php_setting('allow_url_fopen')),
				"failmsg" => "Gallery will not be able to fetch pictures from remote hosts.<br/>Use upload to bucket folder by FTP as an alternative.",
				"sevfront" => 0,
				"sevback" => 1),
		5 => array ("desc" => "Max Upload filesize",
				"setng" => (ini_get( 'post_max_size' )."b;".ini_get( 'post_max_size' )."b"),
				"test" => (ini_get( 'post_max_size' ) >= 2),
				"failmsg" => "It's advisable to increase the post_max_size in the php.ini. Big images could fail to upload to the server.",
				"sevfront" => 0,
				"sevback" => 1));

//Create the html code
print "<h1 align='center'>Expose system check</h1>
		<hr width='50%'>
		<h2>Overview</h2>
		This scripts tests many of the basic requirements for the Expose component to
		run on your hosts system.  It's not a catch all, but it does check most
		settings that the gallery requires.
		<br/><br/>
		If any of these tests fail with a <b><font color='#e0850f'>Warning</font></b>,
		the Expose gallery could run on your server. Sometimes little changes in the settings
		need to be done.<br/>
		When any test fails with a <b><font color='#bb0000'>Fatal Warning</font></b>,
		the Expose gallery will not run on your host without changing the server configuration
		files, which usually, only your host can do. A possible solution at warning or fail
		of the test is provided at this time.
		<br/><br/>
		If the component, after a successful report, still doesn't function, we suggest to
		<b>search the forum</b> at <a href='http://www.gotgtek.net/forum'>www.gotgtek.net/forum</a>
		for a fix.
		<br/>
		Please, before posting a new topic on the forum, also <b>check the manual</b> for
		installation, backup, configuration, security, troubleshooting and lots of other
		information. Get the latest version now at
		<a href='http://joomlacode.org/gf/project/expose/frs'>http://joomlacode.org/gf/project/expose/frs/</a>.
		<br/><br/><hr width='50%'>\n";

//print "<h2>Latest Live Information</h2>
//		Below, if this site has access on the internet, you'll get online latest information about
//		updates, fixes and more of the Expose gallery component. It's advisable to verify this
//		information, and the projectpage on JoomlaCode from time to time.
//		<iframe src='http://doctorjz.googlepages.com/expose_info.html' width='100%' frameborder='0'></iframe>";
	
	//Store tracked test-errors (warningfront, fatalfront, warningback, fatalback, warningfiles)
	$warnings = array(0,0,0,0,0);
	//  print_r ($joomtests);

	echo "<h2>System Settings</h2>\n";
	echo "Overview of the server configuration<br/>\n";
	print_table($systests, $warnings);
	echo "<h2>Joomla Settings</h2>\n";
	echo "Compairing Joomla recommended with actual settings<br/>\n";
	print_table($joomtests, $warnings);
	echo "<h2>File &amp; Path Permissions</h2>\n";
	echo "Checking file and path permissions of important Expose items<br/>\n";
	print_table($pathtests, $warnings);
	echo "<h2>Library activations (php.ini)</h2>\n";
	echo "Checking available and activated libraries on server<br/>\n";
	print_table($libtests, $warnings);
	echo "<h2>Expose Settings</h2>\n";
	echo "Checking some important settings for the Expose component itselve<br/>\n";
	print_table($exposetests, $warnings);
	echo "<h2>Installation Hash Check</h2>\n";
	if (file_exists( mosPathName( dirname(__FILE__) ).$MD5_File)) {
		echo "Comparing file hashes against original Expose installation.<br/>\n";
		compair($path, $warnings, mosPathName( dirname(__FILE__) ).$MD5_File, $skipfiles);
	} else {
		echo "Creating new file hashes for the current Expose installation.<br/>\n";
		generateMd5Hash($path, mosPathName( dirname(__FILE__) ).$MD5_File, $skipfiles);
	}
	print "<hr width='50%'><h2>Final Status Report</h2>";

	if ($warnings[4]) {
		echo "If this is the first check after installation, you'll need to verify some files. Some MD5 calculations didn't match with our original installation. If this is just a random check, all altered files should be in the list. Special notice should be taken on unexpected files.<br/><br/>";
	}
	if ($warnings[1]) {
		echo '<font color="#bb0000">Your PHP configuration flagged <b>'.$warnings[1].' fatal warning(s)</b>. The FRONTEND gallery will not run on this host without modifications to the PHP configuration. Check manual for details.</font>';
	} elseif ($warnings[0]-2) {
		echo '<font color="#e0850f">Your PHP configuration flagged <b>'.($warnings[0]-1).' warning(s)</b>. The FRONTEND gallery may lose some functionality.  Check manual for details.</font>';
	} else {
		echo '<font color="#00aa00">Your PHP configuration check <b>passed</b> with flying colors! The FRONTEND gallery should be able to run on this host.</font>';
	}	
	print '<br/>';
	if ($warnings[3]) {
		echo '<font color="#bb0000">Your PHP configuration flagged <b>'.$warnings[3].' fatal warning(s)</b>. The BACKEND gallery will not run on this host without modifications to the PHP configuration. Check manual for details.</font>';
	} elseif ($warnings[2]-2) {
		echo '<font color="#e0850f">Your PHP configuration flagged <b>'.($warnings[2]-1).' warning(s)</b>. The BACKEND gallery may lose some functionality.  Check manual for details.</font>';
	} else {
		echo '<font color="#00aa00">Your PHP configuration check <b>passed</b> with flying colors! The BACKEND gallery should be able to run on this host.</font>';
	}
	if (!$warnings[1]) echo "<br/><br/>Enjoy the gallery,<br/>the GTEK dev team.<br/><br/>";
	else echo "<br/><br/>Greetings,<br/>the GTEK dev team.<br/><br/>";
?>
