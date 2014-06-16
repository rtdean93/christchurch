<?php

/* admin.config.inc.php
Important configuration settings for the Admin section, modeled
after the main config.inc.php file of the component.
author: Matt Friedman
revision date: 5/22/2005
*/

//----------------------------------------------
// LIFTED FROM config.inc.php    START
//----------------------------------------------

define('USER_IS_ADMIN',((($my->usertype == 'Administrator') || ($my->usertype == 'Super Administrator')) ? true : false));
define('SETTINGS_PHP', true);
define('ADMIN_CATS_PHP', true);
define('IN_MAMBO_ADMIN_SECTION', true);

// Set initial debug level
error_reporting (E_ALL ^ E_NOTICE);
$DB_DEBUG = true;

// define application constants
define('CONFIG_FILE_INCLUDED', true);

define('CALENDAR_NAME', 'ExtCalendar');
define('CALENDAR_VERSION', '2.0');

define('TEMPLATE_FILE', 'template.html');

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
$CONFIG_EXT['ADMIN_PATH'] = $mosConfig_absolute_path . "/administrator/components/com_extcalendar/";        // Your admin file system path
$CONFIG_EXT['calendar_url'] = $mosConfig_live_site . "/components/com_extcalendar/";        // Your calendar web url
$CONFIG_EXT['calendar_calling_page'] = $mosConfig_live_site . "/index.php?option=" . mosGetParam( $_REQUEST, 'option', 'com_extcalendar');  // Your calendar web url

require_once $CONFIG_EXT['FS_PATH']."include/functions.inc.php";
require_once $CONFIG_EXT['FS_PATH']."include/dblib.php";

$ME = $CONFIG_EXT['calendar_calling_page'];
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
$CONFIG_EXT['app_name'] = $CONFIG_EXT['calendar_name'];
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

$lang_config_data = array(
	$lang_settings_data['general_settings_label'],
//	array($lang_settings_data['calendar_name'], 'calendar_name', 0),
//	array($lang_settings_data['calendar_description'], 'calendar_description', 0),
	array($lang_settings_data['calendar_admin_email'], 'calendar_admin_email', 0),
	array($lang_settings_data['cookie_name'], 'cookie_name', 0),
	array($lang_settings_data['cookie_path'], 'cookie_path', 0),
	array($lang_settings_data['debug_mode'], 'debug_mode', 1),
	array($lang_settings_data['calendar_status'], 'calendar_status', 12),
	array('Default Target for URLS in Events', 'url_target_for_events', 0),
	array('Capitalize Event Titles', 'capitalize_event_titles', 1),
	array('Show Only Start Times', 'show_only_start_times', 1),
	array('Show Top Navigation Bar', 'show_top_navigation_bar', 1),
	array($lang_settings_data['search_view'], 'search_view', 1),
	array('Who Can Submit New Events<br /><small>(as long as "'.$lang_settings_data['add_event_view_label'].'" is enabled below)</small>', 'who_can_add_events', 15),
	array('Who Can Submit Event Edits', 'who_can_edit_events', 15),
	array('Who Can Delete Events', 'who_can_delete_events', 15),
	array($lang_settings_data['new_post_notification'].'<br /><small>(Sends an email to the email address above whenever a new or edited event needs approval. Note: ONLY sends an email if approval is required.)</small>', 'new_post_notification', 1),

	$lang_settings_data['env_settings_label'],
//	array($lang_settings_data['lang'], 'lang', 5),
//	array($lang_settings_data['charset'], 'charset', 4),
	array($lang_settings_data['theme'], 'theme', 6),
	array($lang_settings_data['timezone'], 'timezone', 7),
	array($lang_settings_data['time_format'], 'time_format_24hours', 11),
	array($lang_settings_data['auto_daylight_saving'], 'auto_daylight_saving', 1),
	array($lang_settings_data['main_table_width'], 'main_table_width', 0),
	array($lang_settings_data['day_start'], 'day_start', 9),
	array($lang_settings_data['default_view'], 'default_view', 2),
	array($lang_settings_data['archive'], 'archive', 1),
//	array($lang_settings_data['events_per_page'], 'events_per_page', 0),
//	array($lang_settings_data['sort_order'], 'sort_order', 3),
	array($lang_settings_data['show_recurrent_events'], 'show_recurrent_events', 16),
	array($lang_settings_data['multi_day_events'], 'multi_day_events', 13),

//	$lang_settings_data['user_settings_label'],
//	array($lang_settings_data['allow_user_registration'], 'allow_user_registration', 1),
//	array($lang_settings_data['reg_duplicate_emails'], 'reg_duplicate_emails', 1),
//	array($lang_settings_data['reg_email_verify'], 'reg_email_verify', 1),

	$lang_settings_data['event_view_label'],
	array($lang_settings_data['popup_event_mode'], 'popup_event_mode', 1),
	array('Show Recurrence Info', 'show_recurrence_info_event_view', 1),
	array($lang_settings_data['popup_event_width'], 'popup_event_width', 0),
	array($lang_settings_data['popup_event_height'], 'popup_event_height', 0),

	$lang_settings_data['add_event_view_label'],
	array($lang_settings_data['add_event_view'].'<br /><small>(Note that if this is disabled, it overrides "Who Can Submit New Events" above. Administrators will still be able to add events, however.)</small>', 'add_event_view', 1),
	array('Allow Javascript in URLS in Event Descriptions', 'allow_javascript_in_event_urls', 1),
	array($lang_settings_data['addevent_allow_html'], 'addevent_allow_html', 1),
	array($lang_settings_data['addevent_allow_contact'], 'addevent_allow_contact', 1),
	array($lang_settings_data['addevent_allow_email'], 'addevent_allow_email', 1),
	array($lang_settings_data['addevent_allow_url'], 'addevent_allow_url', 1),
	array($lang_settings_data['addevent_allow_picture'], 'addevent_allow_picture', 1),

	$lang_settings_data['calendar_view_label'],
	array($lang_settings_data['monthly_view'], 'monthly_view', 1),
	array('Show Event Times', 'show_event_times_in_monthly_view', 1),
	array($lang_settings_data['cal_view_show_week'], 'cal_view_show_week', 1),
	array($lang_settings_data['cal_view_max_chars'], 'cal_view_max_chars', 0),
	array('Show Overlapping Recurrences<br /><small>(only relevant if an event\'s duration is longer than its interval--for example, an event that lasts 3 days but recurs every 2 days.)', 'show_overlapping_recurrences_monthlyview', 1),

	$lang_settings_data['flyer_view_label'],
	array($lang_settings_data['flyer_view'], 'flyer_view', 1),
	array('Show Event Times', 'show_event_times_in_flat_view', 1),
	array($lang_settings_data['flyer_show_picture'], 'flyer_show_picture', 1),
	array($lang_settings_data['flyer_view_max_chars'], 'flyer_view_max_chars', 0),
	array('Show Overlapping Recurrences<br /><small>(only relevant if an event\'s duration is longer than its interval--for example, an event that lasts 3 days but recurs every 2 days.)', 'show_overlapping_recurrences_flatview', 1),

	$lang_settings_data['weekly_view_label'],
	array($lang_settings_data['weekly_view'], 'weekly_view', 1),
	array('Show Event Times', 'show_event_times_in_weekly_view', 1),
	array($lang_settings_data['weekly_view_max_chars'], 'weekly_view_max_chars', 0),
	array('Show Overlapping Recurrences<br /><small>(only relevant if an event\'s duration is longer than its interval--for example, an event that lasts 3 days but recurs every 2 days.)', 'show_overlapping_recurrences_weeklyview', 1),

	$lang_settings_data['daily_view_label'],
	array($lang_settings_data['daily_view'], 'daily_view', 1),
	array('Show Event Times', 'show_event_times_in_daily_view', 1),
	array($lang_settings_data['daily_view_max_chars'], 'daily_view_max_chars', 0),
	array('Show Overlapping Recurrences<br /><small>(only relevant if an event\'s duration is longer than its interval--for example, an event that lasts 3 days but recurs every 2 days.)', 'show_overlapping_recurrences_dailyview', 1),

	$lang_settings_data['categories_view_label'],
	array($lang_settings_data['cats_view'], 'cats_view', 1),
	array('Show Recurrence Info', 'show_recurrence_info_category_view', 1),
	array($lang_settings_data['sort_order'], 'sort_category_view_by', 3),
	array($lang_settings_data['cats_view_max_chars'], 'cats_view_max_chars', 0),

//	$lang_settings_data['mini_cal_label'],
//	array($lang_settings_data['mini_cal_def_picture'], 'mini_cal_def_picture', 0),
//	array($lang_settings_data['mini_cal_display_picture'], 'mini_cal_diplay_options',10),

	$lang_settings_data['mail_settings_label'],
	array($lang_settings_data['mail_method'], 'mail_method', 14),
	array($lang_settings_data['mail_smtp_host'], 'mail_smtp_host',0),
	array($lang_settings_data['mail_smtp_auth'], 'mail_smtp_auth',1),
	array($lang_settings_data['mail_smtp_username'], 'mail_smtp_username',0),
	array($lang_settings_data['mail_smtp_password'], 'mail_smtp_password',0),

	$lang_settings_data['picture_settings_label'],
	array($lang_settings_data['max_upl_dim'], 'max_upl_dim', 0),
	array($lang_settings_data['max_upl_size'], 'max_upl_size', 0),
	array($lang_settings_data['picture_chmod'], 'picture_chmod', 0),
	array($lang_settings_data['allowed_file_extensions'], 'allowed_file_extensions',0)

);


//----------------------------------------------
// LIFTED FROM config.inc.php   END
//----------------------------------------------

?>