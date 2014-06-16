<?php
/**
* Contact Information Module 2.0
* Joomla Module
* Edward Cupler
* www.digitalgreys.com
* ecupler@digitalgreys.com
* @copyright Copyright (C) 2007 Digital Greys. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Contact Information Module is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

$contact_id = $params->get( 'contact_cid', '' );

	global $mainframe, $database, $my, $Itemid;
	$query = "SELECT * FROM #__contact_details WHERE id IN ( $contact_id )";
	$database->setQuery( $query );
	$contacts = $database->loadObjectList();
	
	if ($params->get( 'layout_style', '' )=="SeperateLines") {
		$linebreak="<br />";
		$newspace="";
	} else {
		$linebreak="";
		$newspace=" ";
	}

	if ($params->get( 'separate_code', '' )=="div") {
		$separate_code="<div class=\"contact_sep\"></div>";
	} else if ($params->get( 'separate_code', '' )=="br") {
		$separate_code="<br />";
	} else if ($params->get( 'separate_code', '' )=="hr") {
		$separate_code="<hr class=\"contact_sep\" />";
	} else {
		$separate_code="";
	}

	
	$separate_num=sizeof($contacts);
	foreach ( $contacts as $contact ) {
		$telephone_array=explode(" ",$contact->telephone);
		if ($params->get( 'show_name', '' ) == 1) {
			if ($params->get( 'link_to', '' ) == 1) {
				echo "<span class=\"info_name\"><a href=\"index.php?option=com_contact&task=view&contact_id=" . $contact->id . "\">" . $contact->name . "</a></span>$linebreak$newspace\n";
			} else {
				echo "<span class=\"info_name\">" . $contact->name . "</span>$linebreak$newspace\n";
			}
		}
		if ($params->get( 'con_position', '' ) == 1) {
			echo "<span class=\"info_position\">".$contact->con_position . "</span>$linebreak$newspace\n";
		}
		if ($params->get( 'show_address', '' ) == 1) {
			echo "<span class=\"info_address\">".$contact->address . "</span>$linebreak$newspace\n";
		}
		if ($params->get( 'show_suburb', '' ) == 1) {
			echo "<span class=\"info_suburb\">".$contact->suburb . "</span>, \n";
		}
		if ($params->get( 'show_state', '' ) == 1) {
			echo "<span class=\"info_state\">".$contact->state . "</span> \n";
		}
		if ($params->get( 'show_postcode', '' ) == 1) {
			echo "<span class=\"info_postcode\">".$contact->postcode . "</span>$linebreak$newspace\n";
		}
		if ($params->get( 'show_country', '' ) == 1) {
			echo "<span class=\"info_country\">".$contact->country . "</span>$linebreak$newspace\n";
		}
		if ($params->get( 'show_telephone', '' ) == 1 && $contact->telephone != "") {
			if (sizeof($telephone_array) > 1) {
				echo "<span class=\"info_telephone\">".$telephone_array[0] . " or$linebreak$newspace" .$telephone_array[1]. "</span>$linebreak$newspace\n";
			} else {
				echo "<span class=\"info_telephone\">".$telephone_array[0]. "</span>$linebreak$newspace\n";
			}
		}
		if ($params->get( 'show_fax', '' ) == 1 && $contact->fax != "") {
			echo "<span class=\"info_fax\">Fax: " . $contact->fax ."</span>$linebreak$newspace\n";
		}
		if ($params->get( 'show_email_to', '' ) == 1 && $contact->email_to != "") {
			echo "<span class=\"info_email\">".mosHTML::emailcloaking( $contact->email_to, true )."</span>$linebreak$newspace\n";
		}
		if ($params->get( 'show_misc', '' ) == 1 && $contact->misc != "") {
			echo "<span class=\"info_misc\">".$contact->misc ."</span>$linebreak$newspace\n";
		}
		if ($separate_num > 1) {
			echo $separate_code."\n";
		}
		$separate_num=$separate_num-1;
	}
?>
