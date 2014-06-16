<?php

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_extcalendar' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$task =  (!isset($task) || ($task == '')) ? "showSettings" : $task;
$cid = mosGetParam( $_POST, 'cid', mosGetParam( $_REQUEST, 'cat_id', array(0) ) );

switch ($task) {

	case 'categories':
		switchToCategoriesPage();
		break;

	case 'newCategory':
		newCategory( $option );
		break;

	case 'editCategory':
		editCategory( $cid[0], $option );
		break;

	case 'saveCategory':
		saveCategory( $option );
		break;

	case 'cancelEditCategory':
		cancelEditCategory( $option );
		break;

	case 'showCategories':
		showCategories( $option );
		break;
		
	case 'deleteCategories':
		deleteCategories( $option, $cid );
		break;
		
	case 'publish':
		publishCategories( $option, $cid, 1 );
		break;
		
	case 'unpublish':
		publishCategories( $option, $cid, 0 );
		break;

	case 'editSettings':
		editSettings( $option );
		break;

	case 'saveSettings':
		saveSettings( $option );
		break;

	case 'cancelEditSettings':
		cancelEditSettings( $option );
		break;
		
	case 'showSettings':
	default:
		showSettings( $option );
		break;

}

function switchToCategoriesPage() {
	mosRedirect( 'index2.php?option=com_extcalendar&task=showCategories' );
}

function showSettings( $option ) {
	global $database, $mainframe, $mosConfig_lang;

	$query = "SELECT * FROM #__extcal_config";
	$database->setQuery( $query );

	if(!$result = $database->query()) {
		echo $database->stderr();
		return;
	}
	$rows = $database->loadObjectList();
	HTML_extcalendar::showSettings( $rows, $option );
}


function editSettings( $option ) {
	global $database, $mainframe, $mosConfig_absolute_path, $mosConfig_live_site, $my, $mosConfig_lang, $CONFIG_EXT, $THEME_DIR,
	 $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format, $lang_settings_data, $lang_info, $theme_info, $lang_general, $lang_config_data;

	$query = "SELECT ec.*, u.name as editor FROM #__extcal_config as ec "
	. "\n LEFT JOIN #__users AS u ON u.id = ec.checked_out";
	$database->setQuery( $query );

	if(!$result = $database->query()) {
		echo $database->stderr();
		return;
	}
	
	require_once($CONFIG_EXT['ADMIN_PATH'].'admin.config.inc.php');
	
	foreach($lang_config_data as $element) {
		if ((is_array($element))) {
			$row = new mosExtCalendarSettings($database);
			$row->load( $element[1] );
			$row->checkout( $my->id );
		}
	}
	
	HTML_extcalendar::editSettings( $option );
	include 'admin_settings.php';
}

function saveSettings( $option ) {
	global $database, $mainframe, $mosConfig_absolute_path, $mosConfig_live_site, $my, $mosConfig_lang, $CONFIG_EXT, $THEME_DIR,
	 $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format, $lang_settings_data, $lang_info, $theme_info, $lang_general, $lang_config_data;

	require_once($CONFIG_EXT['ADMIN_PATH'].'admin.config.inc.php');

	foreach($lang_config_data as $element) {
		if ((is_array($element))) {
			if ((!isset($_POST[$element[1]]))) die("Missing config value for '{$element[1]}'". __FILE__ . __LINE__);
			$value = addslashes($_POST[$element[1]]);
			extcal_db_query("UPDATE #__extcal_config SET value = '$value' WHERE name = '{$element[1]}'");
			$row = new mosExtCalendarSettings($database);
			$row->load( $element[1] );
			$row->checkin();
		}
	}
	
	$msg = 'Saved New Settings';

	mosRedirect( 'index2.php?option=com_extcalendar', $msg );
}

function cancelEditSettings() {
	global $database;
	
	$checkInQuery = "SELECT * FROM #__extcal_config";
	$database->setQuery( $checkInQuery );
	$rows = $database->loadObjectList();
	
 	foreach($rows as $key => $value) {
		$row = new mosExtCalendarSettings($database);
		$row->load( $value->name );
		$row->checkin();
	}
	
	mosRedirect( 'index2.php?option=com_extcalendar', 'Cancelled Settings Change' );
}

function showCategories( $option ) {
	global $database, $mainframe, $mosConfig_lang, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );

	// get the total number of records
	$database->setQuery( "SELECT count(*) FROM #__extcal_categories" );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$query = "SELECT c.*, u.name as editor FROM #__extcal_categories as c "
	. "\n LEFT JOIN #__users AS u ON u.id = c.checked_out"
	. "\nLIMIT $pageNav->limitstart,$pageNav->limit";
	$database->setQuery( $query );

	if(!$result = $database->query()) {
		echo $database->stderr();
		return;
	}
	$rows = $database->loadObjectList();
	HTML_extcalendar::showCategories( $rows, $pageNav, $option );
}

function newCategory( $option ) {
	global $database, $mainframe, $mosConfig_absolute_path, $mosConfig_live_site, $my, $mosConfig_lang, $CONFIG_EXT, $THEME_DIR, $form,
	 $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format, $lang_settings_data, $lang_info, $theme_info, $lang_general,
	 $lang_config_data, $template_cat_form, $lang_cat_admin_data, $errors;

	require_once($CONFIG_EXT['ADMIN_PATH'].'admin.config.inc.php');
	HTML_extcalendar::editCategory( $option );

	$form['published'] = 1;	
	$form['adminapproved'] = true;
	$form['userapproved'] = false;	

	$form['color'] = "#505054";

	pageheader('', '', false);
	display_cat_form('index2.php','add',$form);
	echo '
		   <input type="hidden" name="option" value="'.$option.'">
		   <input type="hidden" name="task" value="initial">
		 </form>
	';
	
	// footer
	pagefooter();
}

function editCategory( $cat_id, $option ) {
	global $database, $mainframe, $mosConfig_absolute_path, $mosConfig_live_site, $my, $mosConfig_lang, $CONFIG_EXT, $THEME_DIR, $form,
	 $today, $zone_stamp, $DB_DEBUG, $ME, $REFERER, $lang_date_format, $lang_settings_data, $lang_info, $theme_info, $lang_general,
	 $lang_config_data, $template_cat_form, $lang_cat_admin_data, $errors;

	require_once($CONFIG_EXT['ADMIN_PATH'].'admin.config.inc.php');
	HTML_extcalendar::editCategory( $option );
	
	$query = "SELECT * FROM #__extcal_categories WHERE cat_id = '$cat_id'";
	$database->setQuery( $query );
	$formObject = $database->loadObjectList();
	$form = get_object_vars( $formObject[0] );
	
	$form['userapproved'] = $form['options'] & 1;
	$form['adminapproved'] = $form['options'] & 2;

	pageheader('', '', false);
	display_cat_form('index2.php','add',$form);
	echo '
		   <input type="hidden" name="option" value="'.$option.'">
		   <input type="hidden" name="task" value="initial">
		 </form>
	';
	
	// footer
	pagefooter();
}

function cancelEditCategory( $option ) {
	global $database;
	
	$row = new mosExtCalendarCategories($database);
	$row->bind( $_POST );
	$row->checkin();
	
	mosRedirect( "index2.php?option=$option&task=showCategories", 'Cancelled Categories Change' );
}

function saveCategory( $option ) {
	global $database;
	
	$row = new mosExtCalendarCategories( $database );

	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	
	$admin_auto_approve = (isset($_POST['adminapproved']))?1:0;
	$user_auto_approve = (isset($_POST['userapproved']))?1:0;
	$row->options = $user_auto_approve + $admin_auto_approve*2;
	
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->checkin();
	
	mosRedirect( "index2.php?option=$option&task=showCategories", 'Saved Categories Change' );
}


/**
* Publishes or Unpublishes one or more categories
* @param array An array of unique category id numbers
* @param integer 0 if unpublishing, 1 if publishing
* @param string The name of the current user
*/
function publishCategories( $option, $cid=null, $publish=1 ) {
	global $database, $my;

	if (!is_array( $cid )) {
		$cid = array();
	}

	if (count( $cid ) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('Select a category to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode( ',', $cid );

	$query = "UPDATE #__extcal_categories SET published='$publish'"
	. "\nWHERE cat_id IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))"
	;
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit();
	}

	if (count( $cid ) == 1) {
		$row = new mosExtCalendarCategories( $database );
		$row->checkin( $cid[0] );
	}

	mosRedirect( 'index2.php?option='.$option.'&task=showCategories' );
}

function deleteCategories( $option, $cid ) {
	global $database;
	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$database->setQuery( "DELETE FROM #__extcal_categories WHERE cat_id IN ($cids)" );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}
	mosRedirect( 'index2.php?option='.$option.'&task=showCategories', 'Delete Successful' );
}

?>