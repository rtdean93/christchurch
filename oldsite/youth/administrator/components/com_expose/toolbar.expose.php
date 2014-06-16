<?php
//****************************************************************************
//Component: Expose
//Version  : RC3
//Author   : Josh
//E-Mail   : webmaster@gotgtek.com
//Author   : Steinthor Kristinsson
//E-Mail   : steinthor@setjan.com
//File	   : toolbar.expose.php
//Web Site : www.gotgtek.com
//Copyright: Copyright 2006 by GTEK Technologies
//License  : GNU General Public License (GPL), visit www.slooz.com for details
//
//Joomla 1.x flash gallery compoent.
//****************************************************************************

defined('_VALID_MOS') or die('Direct access to this location is not allowed.');
require_once( $mainframe->getPath( 'toolbar_html' ) );
require_once( $mainframe->getPath( 'toolbar_default' ) );


switch ($task) {
  case "config":
    ExposeMenu::MAIN_MENU();
    break;

  case "formats":
    ExposeMenu::FORMATS_MENU();
    break;

  case "saveFormats":
    ExposeMenu::FORMATS_MENU();
    break;
    
  case "saveConf":
    ExposeMenu::MAIN_MENU();
    break;

  case "about":
    ExposeMenu::ABOUT_MENU();
    break;

  case "settings":
    ExposeMenu::CONFIG_MENU();
    break;

  default:
    
    break;
}
?>