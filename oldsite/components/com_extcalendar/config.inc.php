<?php 
/*
**********************************************
ExtCalendar v2
Copyright (c) 2003-2005 Mohamed Moujami (Simo)
v1 originally written by Kristof De Jaeger
**********************************************
This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version. 
**********************************************
File Description: config.inc.php - Configuration file
$Id: config.inc.php,v 1.27 2005/02/04 06:18:05 simoami Exp $ 

Modified significantly for Mambo compatibility by
Matt Friedman.
Revision date: 5/22/2005

**********************************************
Get the latest version of ExtCalendar at:
http://extcal.sourceforge.net//
**********************************************
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
global $database, $mosConfig_absolute_path, $mosConfig_live_site, $my, $mosConfig_lang, $Itemid, $session, $mosConfig_sitename;
if ( !defined('USER_IS_ADMIN') ) define('USER_IS_ADMIN',((($my->usertype == 'Administrator') || ($my->usertype == 'Super Administrator')) ? true : false));
if ( !defined('USER_IS_LOGGED_IN') ) define('USER_IS_LOGGED_IN',!($my->usertype == ''));

// Set initial debug level
error_reporting (E_ALL ^ E_NOTICE);
$DB_DEBUG = true;

// define application constants
define('CONFIG_FILE_INCLUDED', true);

define('CALENDAR_NAME', 'ExtCalendar');
define('CALENDAR_VERSION', '2.0');

define('TEMPLATE_FILE', 'template.html');

// Start buffering
ob_start();

// unescape special characters if enabled by default.
if (get_magic_quotes_gpc()) {
	function stripslashes_deep($value)
	{
		$char_array = array('"' => '&quot;', '<' => '&lt;', '>' => '&gt;');

		$value = is_array($value) ?array_map('stripslashes_deep', $value) : strtr(stripslashes($value), $char_array);
		return $value;
	}
	$_POST = array_map('stripslashes_deep', $_POST);
	$_GET = array_map('stripslashes_deep', $_GET);

}


$temp_path = get_fspath(isset($_SERVER['PATH_TRANSLATED'])?$_SERVER['PATH_TRANSLATED']:$_SERVER['SCRIPT_FILENAME']);

// Initialise the $CONFIG_EXT array and some other variables
$CONFIG_EXT = array();

// DB TABLE NAMES PREFIX
$CONFIG_EXT['TABLE_PREFIX'] =  "#__extcal_";

// FS configuration
$CONFIG_EXT['FS_PATH'] = $mosConfig_absolute_path . "/components/com_extcalendar/";        // Your file system path
$CONFIG_EXT['calendar_url'] = $mosConfig_live_site . "/components/com_extcalendar/";        // Your calendar web url

if (isset($Itemid) && ($Itemid != 0)) { $CONFIG_EXT['Itemid'] = $Itemid; }
else {
  $CONFIG_EXT['Itemid'] = mosGetParam( $_REQUEST, 'Itemid', false );
  if (!$CONFIG_EXT['Itemid']) {
    $database->setQuery("SELECT MAX(id) FROM #__menu WHERE link LIKE '%index.php?option=$com_extcalendar%' AND published <> '-2'");
	$CONFIG_EXT['Itemid'] = $database->loadResult();
  }
}
$Itemid_Querystring = $CONFIG_EXT['Itemid'] ? '&amp;Itemid='.$CONFIG_EXT['Itemid'] : '';
$CONFIG_EXT['calendar_calling_page'] = "index.php?option=$option" . $Itemid_Querystring;  // Your calendar web url

require_once $CONFIG_EXT['FS_PATH']."include/functions.inc.php";
require_once $CONFIG_EXT['FS_PATH']."include/dblib.php";
require_once $CONFIG_EXT['FS_PATH']."lib/event.inc.php";

$REFERER = get_referer();

// File system paths
$CONFIG_EXT['UPLOAD_DIR'] = $CONFIG_EXT['FS_PATH']."upload/";
$CONFIG_EXT['UPLOAD_DIR_URL'] = $CONFIG_EXT['calendar_url']."upload/";
$CONFIG_EXT['MINI_PICS_DIR'] = $CONFIG_EXT['FS_PATH']."images/minipics/";
$CONFIG_EXT['MINI_PICS_URL'] = $CONFIG_EXT['calendar_url']."images/minipics/";
$CONFIG_EXT['LIB_DIR'] = $CONFIG_EXT['FS_PATH']."lib/";
$CONFIG_EXT['PLUGINS_DIR'] = $CONFIG_EXT['FS_PATH']."plugins/";
$CONFIG_EXT['LANGUAGES_DIR'] = $CONFIG_EXT['FS_PATH']."languages/";
$CONFIG_EXT['THEMES_DIR'] = $CONFIG_EXT['FS_PATH']."themes/";

// Database definitions
$CONFIG_EXT['TABLE_CATEGORIES'] = $CONFIG_EXT['TABLE_PREFIX'] . "categories";
$CONFIG_EXT['TABLE_GROUPS'] = $CONFIG_EXT['TABLE_PREFIX'] . "groups";
$CONFIG_EXT['TABLE_USERS'] = $CONFIG_EXT['TABLE_PREFIX'] . "users";
$CONFIG_EXT['TABLE_EVENTS'] = $CONFIG_EXT['TABLE_PREFIX'] . "events";
$CONFIG_EXT['TABLE_CONFIG'] = $CONFIG_EXT['TABLE_PREFIX'] . "config";
$CONFIG_EXT['TABLE_TEMPLATES'] = $CONFIG_EXT['TABLE_PREFIX'] . "templates";
$CONFIG_EXT['TABLE_PLUGINS'] = $CONFIG_EXT['TABLE_PREFIX'] . "plugins";

// Retrieve DB stored configuration
$results = extcal_db_query("SELECT * FROM {$CONFIG_EXT['TABLE_CONFIG']}");
while ($row = extcal_db_fetch_array($results)) {
    $CONFIG_EXT[$row['name']] = $row['value'];
} // while
extcal_db_free_result($results);

// Other $CONFIG_EXT vars
$CONFIG_EXT['app_name'] = $mosConfig_sitename . " ExtCalendar"; // The Mambo sitename where your calendar lives
// get current version info
if(!isset($CONFIG_EXT['release_version'])) {
	$CONFIG_EXT['release_name'] = '2.0 dev';
	$CONFIG_EXT['release_version'] = "200.00";
	$CONFIG_EXT['release_type'] = 'dev';
}
if(!isset($CONFIG_EXT['calendar_status'])) $CONFIG_EXT['calendar_status'] = 1;

// Set error logging level
if ($CONFIG_EXT['debug_mode']) {
    error_reporting (E_ALL);
		$DB_DEBUG = true;
} else {
    error_reporting (E_ALL ^ E_NOTICE);
		$DB_DEBUG = false;
} 

if (!file_exists($CONFIG_EXT['FS_PATH']."themes/{$CONFIG_EXT['theme']}/theme.php")) $CONFIG_EXT['theme'] = 'default';
require_once $CONFIG_EXT['FS_PATH']."themes/{$CONFIG_EXT['theme']}/theme.php";
$THEME_DIR = $CONFIG_EXT['calendar_url']."themes/{$CONFIG_EXT['theme']}";

$CONFIG_EXT['lang'] = $mosConfig_lang;
if (!file_exists($CONFIG_EXT['LANGUAGES_DIR']."{$CONFIG_EXT['lang']}/index.php")) $CONFIG_EXT['lang'] = 'english';
require_once $CONFIG_EXT['LANGUAGES_DIR']."{$CONFIG_EXT['lang']}/index.php";

// Localizing time
while(list(,$temp_lang_code) = each($lang_info['locale']) ) {
	setlocale (LC_TIME,$temp_lang_code);
}
$zone_stamp = extcal_get_local_time();
$today = ucwords(strftime ($lang_date_format['full_date'], $zone_stamp));
// e.g. Wednesday, June 05, 2002

// load main template
load_template();

// some settings of vars
$extmode = isset($_GET['extmode'])?trim( strtolower( mosGetParam( $_GET, 'extmode' ) ) ):'';
$extmode = isset($_POST['extmode'])?trim( strtolower( mosGetParam( $_POST, 'extmode' ) ) ):$extmode;
$event_mode = isset($_GET['event_mode'])?trim( strtolower( mosGetParam( $_GET, 'event_mode' ) ) ):'';
$event_mode = isset($_POST['event_mode'])?trim( strtolower( mosGetParam( $_POST, 'event_mode' ) ) ):$event_mode;
$extid = isset($_GET['extid'])?intval( mosGetParam( $_GET, 'extid' ) ):'';
$extid = isset($_POST['extid'])?intval( mosGetParam( $_POST, 'extid' ) ):$extid;
$event_id = isset($_GET['event_id'])?intval( mosGetParam( $_GET, 'event_id' ) ):$extid;
$event_id = isset($_POST['event_id'])?intval( mosGetParam( $_POST, 'event_id' ) ):$event_id;
$cat_id = isset($_GET['cat_id'])?intval( mosGetParam( $_GET, 'cat_id' ) ):'';
$cat_id = isset($_POST['cat_id'])?intval( mosGetParam( $_POST, 'cat_id' ) ):$cat_id;
$extcal_search = isset($_POST['extcal_search'])?mosGetParam( $_POST, 'extcal_search' ):'';

// Initialize time variables with today's date
$m = (int)date("n", extcal_get_local_time()); // Numeric representation of a month, without leading zeros
$y = (int)date("Y", extcal_get_local_time()); 
$d = (int)date("j", extcal_get_local_time()); // Day of the month without leading zeros

$today = array(
	'day' => $d,
	'month' => $m,
	'year' => $y
);
// initialise the date variable 
if(isset($_POST['date'])) {
	list($year, $month, $day) = split('[/.-]', $_POST['date']); // split at a slash, dot, or hyphen.
	$date = array(
		'day' => (int)$day,
		'month' => (int)$month,
		'year' => (int)$year
	);
} elseif(isset($_GET['date'])) {
	list($year, $month, $day) = split('[/.-]', $_GET['date']); // split at a slash, dot, or hyphen.
	$date = array(
		'day' => (int)$day,
		'month' => (int)$month,
		'year' => (int)$year
	);
} else {
	$date = array(
		'day' => (int)$today['day'],
		'month' => (int)$today['month'],
		'year' => (int)$today['year']
	);
} 

function get_fspath($fs_path) {
// function to format the fs path correctly (paths end with a trail "/")
	$fs_path=preg_split("/[\/\\\]/", dirname($fs_path));

	// just in case $fs_path equals "//"
	$fs_path = ereg_replace("//","/",join('/',$fs_path)."/");
	return $fs_path;
}

define('EXTCAL_TEXT_ALL_DAY',$lang_add_event_view['all_day_label']);

?>