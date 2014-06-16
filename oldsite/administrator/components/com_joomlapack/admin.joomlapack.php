<?php
/**
* @version 1.0
* @package JoomlaPack
* @copyright (C) 2006 Nicholas K. Dionysopoulos
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

// Restrict to Super Administrators only
if (!$acl->acl_check( 'administration', 'config', 'users', $my->usertype )) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

// Make sure $option is populated
global $option;
if (!isset($option)) { $option = mosGetParam( $_REQUEST, 'option', 'com_jpack' ); } // Just in case...
// Get parameters for the task at hand
$act = mosGetParam( $_REQUEST, 'act', 'default' );
$task = mosGetParam( $_REQUEST, 'task', '' );

// Some bureaucracy is only useful for non-AJAX calls. For AJAX calls, it's just a waste of CPU and memory :)
if ($act != "ajax") {
	/** Get the component version from the XML file */
	require_once( $mosConfig_absolute_path . '/includes/domit/xml_domit_lite_include.php' );
	// Parse JoomlaPack XML installation file to get version
	$xmlDoc = new DOMIT_Lite_Document();
	$xmlDoc->resolveErrors( true );
	if ($xmlDoc->loadXML( $mosConfig_absolute_path."/administrator/components/$option/joomlapack.xml", false, true )) {
		$root = &$xmlDoc->documentElement;
		$e = &$root->getElementsByPath('version', 1);
		define("_JP_VERSION", $e->getText()) ;
		$root = &$xmlDoc->documentElement;
		$e = &$root->getElementsByPath('creationDate', 1);
		define("_JP_DATE", $e->getText()) ;
	} else {
		define("_JP_VERSION", "1.1 Series");
	}

	// Default HTML support library (that's the front-end library of JoomlaPack)
	require_once( $mainframe->getPath( 'admin_html' ) );

	/** load the language files */
	global $mosConfig_lang, $mosConfig_absolute_path, $JPLang;

	$langEnglish = parse_ini_file($mosConfig_absolute_path . "/administrator/components/$option/lang/english.ini", true);
	if (file_exists( $mosConfig_absolute_path . "/administrator/components/$option/lang/$mosConfig_lang.ini" )) {
		$langLocal = parse_ini_file($mosConfig_absolute_path . "/administrator/components/$option/lang/$mosConfig_lang.ini", true);
		$JPLang = array_merge($langEnglish, $langLocal);
		unset( $langEnglish );
		unset( $langLocal );
	} else {
		$JPLang = $langEnglish;
		unset( $langEnglish );
	}
}


// Configuration class
require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/CConfiguration.php" );


/** handle the task */
switch ($act) {
    case "config":
    	echo '<link rel="stylesheet" href="components/'.$option.'/css/jpcss.css" type="text/css" />';
    	// Configuration screen
    	switch ($task) {
    		case "apply":
    			processSave();
    			jpackScreens::fConfig();
    			jpackScreens::CommonFooter();
    			break;
    		case "save":
    			processSave();
    			jpackScreens::fMain();
    			jpackScreens::CommonFooter();
    			break;
    		case "cancel":
    			jpackScreens::fMain();
    			jpackScreens::CommonFooter();
    			break;
    		default:
    			jpackScreens::fConfig();
    			jpackScreens::CommonFooter();
    			break;
    	}
		break;
    case "pack":
    	echo '<link rel="stylesheet" href="components/'.$option.'/css/jpcss.css" type="text/css" />';
    	// Packing screen - that's where the actual backup takes place
    	require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/sajax.php" );
    	require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/ajaxtool.php" );
        jpackScreens::fPack();
        jpackScreens::CommonFooter();
        break;
    case "backupadmin":
        jpackScreens::fBUAdmin();
        switch( $task ) {
        	case "downloadfile":
        		break;
        	default:
        		jpackScreens::CommonFooter();
        		break;
        }
    	break;

	case "def" :
		// Directory exclusion filters
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/CDirExclusionFilter.php" );
		jpackScreens::fDirExclusion();
		jpackScreens::CommonFooter();
		break;

    case "ajax":
    	// AJAX helper functions
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/sajax.php" );
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/ajaxtool.php" );
    	break;

    case "test":
		jpackScreens::fDebug();
        jpackScreens::CommonFooter();
    	break;

    case "log":
		jpackScreens::fLog();
        jpackScreens::CommonFooter();
    	break;

    default:
    	echo '<link rel="stylesheet" href="components/'.$option.'/css/jpcss.css" type="text/css" />';
    	// Application status check
        jpackScreens::fMain();
        jpackScreens::CommonFooter();
        // On main screen, add a PayPal donate button as well
		?>
    		<p>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Donate with PayPal - it's fast, free and secure!">
			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
			">
			</form>
			</p>
		<?php
        break;
}

function processSave() {
	global $JPConfiguration;
	$outdir				= mosGetParam( $_REQUEST, 'outdir', '' );
	$tempdir			= mosGetParam( $_REQUEST, 'tempdir', '' );
	$sqlcompat			= mosGetParam( $_REQUEST, 'sqlcompat', '' );
	$compress			= mosGetParam( $_REQUEST, 'compress', '' );
	$tarname			= mosGetParam( $_REQUEST, 'tarname', '' );
	$fileListAlgorithm	= mosGetParam( $_REQUEST, 'fileListAlgorithm', 'smart' );
	$dbAlgorithm		= mosGetParam( $_REQUEST, 'dbAlgorithm', 'smart' );
	$packAlgorithm		= mosGetParam( $_REQUEST, 'packAlgorithm', 'smart' );
	$altInstaller		= mosGetParam( $_REQUEST, 'altInstaller', 'jpi.xml' );
	$logLevel			= mosGetParam( $_REQUEST, 'logLevel', '3' );

	$JPConfiguration->OutputDirectory = $outdir;
	$JPConfiguration->TempDirectory = $tempdir;
	$JPConfiguration->MySQLCompat = $sqlcompat;
	$JPConfiguration->boolCompress = $compress;
	$JPConfiguration->TarNameTemplate = $tarname;
	$JPConfiguration->fileListAlgorithm = $fileListAlgorithm;
	$JPConfiguration->dbAlgorithm = $dbAlgorithm;
	$JPConfiguration->packAlgorithm = $packAlgorithm;
	$JPConfiguration->InstallerPackage = $altInstaller;
	$JPConfiguration->logLevel = $logLevel;

	$JPConfiguration->SaveConfiguration();
}

?>
