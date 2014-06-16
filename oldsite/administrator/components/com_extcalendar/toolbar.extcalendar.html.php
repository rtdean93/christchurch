<?php
/**
* @version $Id: toolbar.extcalendar.html.php,v 1.9 2005/02/16 13:55:32 stingrey Exp $
* @package Mambo
* @subpackage extcalendar
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

/**
* @package Mambo
* @subpackage Extcalendar
*/
class TOOLBAR_extcalendar {
	/**
	* Draws the menu for to Edit settings
	*/
	function _EDIT() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::save('saveSettings');
		mosMenuBar::spacer();
		mosMenuBar::cancel('cancelEditSettings');
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	function _DEFAULT() {
		mosMenuBar::startTable();
		if (is_callable(array('mosMenuBar', 'editListX'))) {
            mosMenuBar::editListX('editSettings','Edit Settings');
        } else { 
			mosMenuBar::editList('editSettings','Edit Settings');
		}
		mosMenuBar::custom('categories','move.png','move_f2.png','Manage Categories',false);
		mosMenuBar::endTable();
	}
}

/**
* @package Mambo
* @subpackage Extcalendar
*/
class TOOLBAR_extcalendarCategories {
	/**
	* Draws the menu for to Edit a category
	*/
	function _EDITCATEGORY() {
		mosMenuBar::startTable();
		mosMenuBar::spacer();
		mosMenuBar::save('saveCategory');
		mosMenuBar::spacer();
		mosMenuBar::cancel('cancelEditCategory');
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
	function _DEFAULTCATEGORIES() {
		mosMenuBar::startTable();
		if (is_callable(array('mosMenuBar', 'addNewX'))) {
			mosMenuBar::addNewX('newCategory');
        } else { 
			mosMenuBar::addNewX('newCategory');
		}
		mosMenuBar::publishList();
		mosMenuBar::unpublishList();
		if (is_callable(array('mosMenuBar', 'editListX'))) {
			mosMenuBar::editListX('editCategory');
        } else { 
			mosMenuBar::editList('editCategory');
		}
		mosMenuBar::deleteList('','deleteCategories');
		mosMenuBar::endTable();
	}
}

?>