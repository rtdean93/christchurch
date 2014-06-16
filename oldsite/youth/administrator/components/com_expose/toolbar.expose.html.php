<?php
//****************************************************************************
//Component: Expose
//Version  : RC3
//Updated  : 20/07/2007
//Author   : Josh
//E-Mail   : webmaster@gotgtek.com
//Author   : Steinthor Kristinsson
//E-Mail   : steinthor@setjan.com
//File	   : toolbar.expose.html.php
//Web Site : www.gotgtek.com
//Copyright: Copyright 2006 by GTEK Technologies
//License  : GNU General Public License (GPL), visit www.slooz.com for details
//
//Joomla 1.x flash gallery component.
//****************************************************************************
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class ExposeMenu {
    function MAIN_MENU() {    
    mosMenuBar::startTable();
    mosMenuBar::save();
//		** function removed to close securityhole until fixed **
//    if ('JVERSION' == '1.5.0') {
//    mosMenuBar::custom('uploadbg','upload','upload','Upload BG', $listSelect = false)    ;
//    }else{
//    mosMenuBar::custom('uploadbg','upload_f2.png','upload_f2.png','Upload BG', $listSelect = false)    ;
//    }    
    mosMenuBar::spacer();    
    mosMenuBar::endTable();
  }
   function FORMATS_MENU() {
    mosMenuBar::startTable();
    mosMenuBar::save();    
    mosMenuBar::spacer();
    mosMenuBar::endTable();
  }
  function ABOUT_MENU() {
    mosMenuBar::startTable();
    mosMenuBar::back();
    mosMenuBar::spacer();
    mosMenuBar::endTable();
  }
}
?>