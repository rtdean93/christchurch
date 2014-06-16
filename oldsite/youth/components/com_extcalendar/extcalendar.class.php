<?php
/**
* @version $Id: extcalendar.class.php
* @package Mambo
* @subpackage Extcalendar
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Extcalendar
*/
class mosExtCalendarSettings extends mosDBTable {
	/** @var string */
	var $name				= "";
	/** @var string */
	var $value				= "";
	/** @var int */
	var $checked_out		= 0;
	/** @var date */
	var $checked_out_time	= 0;
	
	function mosExtCalendarSettings( &$_db ) {
		$this->mosDBTable( '#__extcal_config', 'name', $_db );
	}
	
}

class mosExtCalendarCategories extends mosDBTable {
	/** @var int */
	var $cat_id				= null;
	/** @var int */
	var $cat_parent			= 0;
	/** @var string */
	var $cat_name			= "";
	/** @var string */
	var $description		= "";
	/** @var string */
	var $color				= "#000000";
	/** @var string */
	var $bgcolor			= "#EEF0F0";
	/** @var int */
	var $options			= 0;
	/** @var int */
	var $published			= 0;
	/** @var int */
	var $checked_out		= 0;
	/** @var date */
	var $checked_out_time	= 0;
	
	function mosExtCalendarCategories( &$_db ) {
		$this->mosDBTable( '#__extcal_categories', 'cat_id', $_db );
	}
	
	function check() {
		// check for valid category name
		if (trim($this->cat_name == "")) {
			$this->_error = "You must specify a category name.";
			return false;
		}
		
		// check for valid color
		if (trim($this->color == "")) {
			$this->_error = "You must specify a category color.";
			return false;
		}

		return true;
	}
	
}
?>