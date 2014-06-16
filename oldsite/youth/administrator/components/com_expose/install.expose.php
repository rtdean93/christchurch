<?php
//****************************************************************************
//Component	: Expose
//Version	: 4.6.2
//Author	: Josh, Bruno
//E-Mail	: webmaster@gotgtek.net, bruno@gotgtec.net
//Author	: Steinthor Kristinsson
//E-Mail	: steinthor@setjan.com
//File	: install.expose.php 
//Web Site	: www.gotgtek.com
//Copyright	: Copyright 2006 by GTEK Technologies
//License	: GNU General Public License (GPL), visit www.slooz.com for details
//
//Joomla 1.x flash gallery compoent.
//***************************************************************************************

function com_install(){
	global $database;

	$database->setQuery( "SELECT id FROM #__components WHERE Name = 'Expose'" );
	$id = $database->loadResult();

	$database->setQuery( "UPDATE #__components SET admin_menu_link = ''  WHERE id='$id'");
	$database->query();

	//add new admin menu images
	$database -> setQuery( "UPDATE #__components SET admin_menu_img = '../administrator/components/com_expose/expose_icon.png'  WHERE id='$id'");
	$database -> query();

	$database -> setQuery("UPDATE #__components SET admin_menu_img = '../administrator/components/com_expose/manage.png', name = 'Manage Albums' WHERE parent='$id' AND name = 'Manage Albums'");
	$database -> query();

	$database -> setQuery("UPDATE #__components SET admin_menu_img = '../administrator/components/com_expose/config.png', name = 'Configuration' WHERE parent='$id' AND name = 'Configuration'");
	$database -> query();

	$database -> setQuery("UPDATE #__components SET admin_menu_img = '../administrator/components/com_expose/config.png', name = 'Check System' WHERE parent='$id' AND name = 'Check System'");
	$database -> query();

	$database -> setQuery("UPDATE #__components SET admin_menu_img = '../administrator/components/com_expose/docs.png', name = 'Manual' WHERE parent='$id' AND name = 'Manual'");
	$database -> query();        

	echo( "<p align='left'><b>Congratulations!</b><br/>Expose has been successfully installed. To use it, simply add a 'Component' <br/>type menu item and <br/>point it to Expose. Additionally, you may wish to edit the Expose files located in <br/>/com_expose/expose to suit your needs.<br/><br/><b>Default PASSWORD is <u>manager.</u></b> It's recommended to change it asap!</p>" );
	echo( "<p align='left'><b>System Requirements</b><br/>This application requires PHP version 4 or higher, the GD library, DOMXML library and the <br/>ICONV library extensions to be installed on your web server (iconv comes on most Un*x-type OSes).<br/> You will need Flash Player 8 to open the application in a web browser.</p>" );
	echo( "<p align='left'><b>Disclaimer</b><br/>This software comes as is, without any warranties or claims for fitness, either explicit or implied. <br/>The author and developpers of this software, shall not be held liable should the use of this <br/>software cause any kind of damage or loss.</p>" );
	echo( "<p align='left'><b>License</b><br/>You may use this software free of charge. You may not distribute it without the prior consent <br/>of the author, nor sell it. This software includes the AMFPHP component, and a JPEG <br/>encoder, courtesy of Uro Tinic and Cristi Cuturicu. This package also comes with the <br/>Medrano font, courtesy of Tepid Monkey.</p>" );
	echo( "<p align='left'><b>Documentation</b><br/>It is recommended to read the manual before using this component. It has information about <br/>the configuration, use, extra features and first problemsolving included.<br/> Download it at <a href=http://joomlacode.org/gf/project/expose/ target=_blank>http://joomlacode.org/gf/project/expose/</a>." );
	echo( "<p align='left'><b>Help</b><br/>We are happy to fix your problems with this component on our forum, but, please read the manual <br/>first! Also search the forum before posting a new issue.  The forum is <br/>located at <a href=http://www.gotgtek.net/forum target=_blank>http://www.gotgtek.net/forum</a>. <br/>You'll find a group for problemsolving, bugs and new features to post in." );
	echo( "<p align='left'><b>Support us</b><br/>This component is free for personal non-commercial use. You can support us by donating and/or <br/>rating this component on <a href=http://extensions.joomla.org/component/option,com_mtree/task,viewlink/link_id,254/Itemid,35/ target=_blank>http://extensions.joomla.org</a> to keep it alive ;-)" );
	echo( "<p align='left'><b>Copyright</b><br/>Copyright 2005, Ivan Dramaliev, junker@slooz.com <a href=http://www.slooz.com target=_blank>http://www.slooz.com</a> <br/>Component integration by GTEK Technologies <A href=http://www.gotgtek.net target=_blank>http://www.gotgtek.net</a></p>" );

}

?>
