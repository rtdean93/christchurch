<?php
// $Id: install.extcalendar.php,v 0.9 2005/05/18
//ExtCal Calendar//
// NOTICE: Portions of this install-file code were inspired by the code from 
// Events Calendar by Eric Lamette and Dave McDonnell and used a jumping-off
// point. Thank you to those excellent programmers! NOT the calendar, though; that was
// all by the ExtCal people.
/**
* Content code
* @package Mambo Open Source
* @ Mambo Open Source is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
**/

// ################################################################
// MOS Intruder Alerts
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
// ################################################################

function com_install() {
global $database, $mosConfig_absolute_path, $mosConfig_mailfrom;

// Do the clean up if installed on a previous installation

$database->setQuery("SELECT count(id) as count, max(id) as lastInstalled FROM #__components WHERE name='ExtCal Calendar'");
$reginfo = $database->loadObjectList();
$lastInstalled = $reginfo[0]->lastInstalled;

// Check if there are more registered instances of the ExtCal Calendar component
if ($reginfo[0]->count <> "1") {
	// Get duplicates
	$sql="SELECT * FROM #__components WHERE name='ExtCal Calendar' AND id!='$lastInstalled' AND admin_menu_link LIKE 'option=com_extcalendar'";
	$database->setQuery($sql);
	$toberemoved = $database->loadObjectList();
	foreach ($toberemoved as $remid){
		// Delete duplicate entries
		$database->setQuery("DELETE FROM #__components WHERE id='$remid->id' or parent='$remid->id'");
		$database->query();
	}
}
$sql="UPDATE #__extcal_config SET value = '$mosConfig_mailfrom' WHERE name='calendar_admin_email'";
$database->setQuery($sql);
$database->query();

if (is_dir("../components/com_extcalendar/upload")) chmod("../components/com_extcalendar/upload",0777);
if (is_dir("../components/com_extcalendar/images/minipics")) chmod("../components/com_extcalendar/images/minipics",0777);

// Well done
    echo "Installed Successfully";
    echo "<div align='left'>";
    include ("../components/com_extcalendar/index.html");
    echo "</div>";
}

?>
