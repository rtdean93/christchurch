<?php
/**
* @version $Id: toolbar.extcalendar.php,v 1.6 2005/02/11 11:10:47 stingrey Exp $
* @package Mambo
* @subpackage extcalendar
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ($task) {

	case 'newCategory':
		TOOLBAR_extcalendarCategories::_EDITCATEGORY();
		break;

	case 'editCategory':
		TOOLBAR_extcalendarCategories::_EDITCATEGORY();
		break;

	case 'saveCategory':
		TOOLBAR_extcalendarCategories::_DEFAULTCATEGORIES();
		break;

	case 'showCategories':
	case 'cancelEditCategory':
		TOOLBAR_extcalendarCategories::_DEFAULTCATEGORIES();
		break;

	case 'editSettings':
		TOOLBAR_extcalendar::_EDIT();
		break;

	case 'saveSettings':
		TOOLBAR_extcalendar::_DEFAULT();
		break;

	case 'showSettings':
	case 'cancelSettings':
	default:
		TOOLBAR_extcalendar::_DEFAULT();
		break;
}
?>