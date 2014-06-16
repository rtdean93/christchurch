<?php
/**
* @version $Id: configuration.php-dist 4802 2006-08-28 16:18:33Z stingrey $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software and parts of it may contain or be derived from the
* GNU General Public License or other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*
* -------------------------------------------------------------------------
* THIS SHOULD ONLY BE USED AS A LAST RESORT WHEN THE WEB INSTALLER FAILS
*
* If you are installing Joomla manually i.e. not using the web installer
* then rename this file to configuration.php e.g.
*
* UNIX -> mv configuration.php-dist configuration.php
* Windows -> rename configuration.php-dist configuration.php
*
* Now edit this file and configure the parameters for your site and
* database.
* -------------------------------------------------------------------------
* Database configuration section
* -------------------------------------------------------------------------
*/
$mosConfig_offline = '0';
$mosConfig_host = 'localhost';	// This is normally set to localhost
$mosConfig_user = '';			// MySQL username
$mosConfig_password = '';		// MySQL password
$mosConfig_db = '';				// MySQL database name
$mosConfig_dbprefix = 'jos_';	// Do not change unless you need to!
/**
* -------------------------------------------------------------------------
* Site specific configuration
* -------------------------------------------------------------------------
*/
$mosConfig_lang = 'english';				// Site language
$mosConfig_absolute_path = '/path/to/joomla/install';	// No trailing slash
$mosConfig_live_site = '';	// No trailing slash
$mosConfig_sitename = 'Joomla';				// Name of Joomla site
$mosConfig_shownoauth = '0';				// Display links & categories users don't have access to
$mosConfig_useractivation = '1';			// Send new registration passwords via e-mail
$mosConfig_uniquemail = '1';				// Require unique email adress for each user
$mosConfig_offline_message = 'This site is down for maintenance.<br /> Please check back again soon.';
$mosConfig_lifetime = '900'; 				// Frontend Session time
$mosConfig_session_life_admin = '1800';		// Admin Session Time
$mosConfig_MetaDesc = 'Joomla - the dynamic portal engine and content management system';
$mosConfig_MetaKeys = 'joomla';
$mosConfig_MetaTitle = '1';
$mosConfig_MetaAuthor = '1';
$mosConfig_debug = '0';
$mosConfig_locale = 'en_GB';
$mosConfig_offset = '0';				// Server Local Time
$mosConfig_offset_user = '0';			// User Local Time
$mosConfig_hideAuthor = '0';
$mosConfig_hideCreateDate = '0';
$mosConfig_hideModifyDate = '0';
$mosConfig_hidePdf = '0';
$mosConfig_hidePrint = '0';
$mosConfig_hideEmail = '0';
$mosConfig_enable_log_items = '0';
$mosConfig_enable_log_searches = '0';
$mosConfig_enable_stats = '0';
$mosConfig_sef = '0';
$mosConfig_vote = '0';
$mosConfig_gzip = '0';
$mosConfig_multipage_toc = '0';
$mosConfig_allowUserRegistration = '1';
$mosConfig_error_reporting = -1;
$mosConfig_error_message = 'This site is temporarily unavailable.<br />Please contact your System Administrator.';
$mosConfig_link_titles = '0';
$mosConfig_list_limit = '30';
$mosConfig_caching = '0';
$mosConfig_cachepath = '/path/to/joomla/install/cache';
$mosConfig_cachetime = '900';
$mosConfig_mailer = 'mail';
$mosConfig_mailfrom = '';
$mosConfig_fromname = '';
$mosConfig_sendmail = '/usr/sbin/sendmail';
$mosConfig_smtpauth = '0';
$mosConfig_smtpuser = '';
$mosConfig_smtppass = '';
$mosConfig_smtphost = 'localhost';
$mosConfig_back_button = '1';
$mosConfig_item_navigation = '1';
$mosConfig_secret = 'FBVtggIk5lAzEU9H'; //Change this to something more secure
$mosConfig_pagetitles = '1';
$mosConfig_readmore = '1';
$mosConfig_hits = '1';
$mosConfig_icons = '1';
$mosConfig_favicon = 'favicon.ico';
$mosConfig_fileperms = '';
$mosConfig_dirperms = '';
$mosConfig_helpurl = 'http://help.joomla.org';
$mosConfig_mbf_content='0';
$mosConfig_editor = 'tinymce';
$mosConfig_admin_expired = '1';
$mosConfig_frontend_login = '1';
$mosConfig_frontend_userparams = '1';
setlocale (LC_ALL, $mosConfig_locale);			// Country locale
?>