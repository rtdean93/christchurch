<?php 
/*
ExtCalendar v2
Copyright (C) 2003-2004 Mohamed Moujami (Simo)

This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version. 
This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the 
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

Date Started : 21/08/2002
Date Last Updated : 16/09/2004
Author(s) : Mohamed Moujami (Simo), Kristof De Jaeger
Description : Extended Mail class 

Get the latest version of ExtCalendar at http://extcal.sourceforge.net//
*/

require( $CONFIG_EXT['LIB_DIR']."class.phpmailer.php" );

class extcalMailer extends phpmailer {
    // Set default variables for all new objects

    var $Mail = false;
    var $Host = "";

    var $From     = "";
    var $FromName = "";
    var $CharSet = "";

    var $Mailer   = ""; // Method to send mail: ("mail", "sendmail", or "smtp").

    var $WordWrap = 75;
		var $Sender = "";

		function extcalMailer() {
      // defining the constructor
	    global $CONFIG_EXT, $global_vars, $lang_info;
	    
      $this->CharSet = $CONFIG_EXT['charset'] == 'language-file' ? $lang_info['charset'] : $CONFIG_EXT['charset'];
      $this->From = $CONFIG_EXT['calendar_admin_email'];
      $this->FromName = $CONFIG_EXT['app_name'];

      $this->WordWrap = 0;
      $this->Helo = "localhost.localdomain";

			switch($CONFIG_EXT['mail_method']) {
				case 'smtp':
					$this->IsSMTP();
					break;
				case 'mail':
					$this->IsMail();
					break;
				case 'sendmail':
					$this->IsSendmail();
					break;
				case 'qmail':
					$this->IsQmail();
					break;
				default:
					$this->IsMail(); // use php mail() by default
			}

      $this->Host = $CONFIG_EXT["mail_smtp_host"];
      //$this->Port = 25;
      $this->SMTPAuth = (int)$CONFIG_EXT['mail_smtp_auth']?true:false; // Sets SMTP authentication. 
      												 //Utilizes the Username and Password variables if set to true
      $this->Username = $CONFIG_EXT['mail_smtp_username'];
      $this->Password = $CONFIG_EXT['mail_smtp_password'];
      //$this->PluginDir = $INCLUDE_DIR;
			
			$this->Sender = $CONFIG_EXT['calendar_admin_email'];
			
			$this->SMTPDebug = (int)$CONFIG_EXT['debug_mode']>0?true:false;
 			
			
		}

		/*
    // Replace the default error_handler
    function error_handler($msg) {
        echo "Site Error";
        echo "Description:";
        printf("%s", $msg);
        exit;
    }
    */

}

?>