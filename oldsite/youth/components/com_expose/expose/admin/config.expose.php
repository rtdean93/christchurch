<?php
//****************************************************************************
//Component: Expose
//Version  : RC3
//Author   : Josh
//E-Mail   : webmaster@gotgtek.com
//Author   : Steinthor Kristinsson
//E-Mail   : steinthor@setjan.com
//File	   : config.expose.php
//Web Site : www.gotgtek.com
//Copyright: Copyright 2006 by GTEK Technologies
//License  : GNU General Public License (GPL), visit www.slooz.com for details
//
//Joomla 1.x flash gallery compoent.
//****************************************************************************

defined('_VALID_MOS') or die('Direct access to this location is not allowed.');

class expose_M {	

 

	// Get the path for our xml files
	function rpath() {
	    	$xmlF = realpath2 ("../components/com_expose/expose/config")."/";		
 		return $xmlF;
	}
	
	function rpath2() {	
	    		$xmlF = realpath2 ("components/com_expose/expose/config")."/";	 	
 		return $xmlF;
	}
	
	// Save the new config values from the form
	function SaveConf() {	
	// Loop the config form and call our setConf function
	$xmlF = expose_M::rpath();
	foreach ($_POST as $key => $val) {
		if (!isset(${$key})) ${$key} = $val;			
		        $fix_form = str_replace("_"," ", $key);					
			$setcon = expose_M::setConf($xmlF, $fix_form, $val);			
		}
		
		return $setcon;
		
	}	
	
	// Save the new formats values from the form
	function SaveFormats() {		
		$xmlF = expose_M::rpath();
		foreach ($_POST as $key => $val) {
			if (!isset(${$key})) ${$key} = $val;			
				$ids = explode('-',$key);				
			        $fix_form = str_replace("_"," ", $ids[0]);					
				$setcon = expose_M::setFonts($xmlF, $ids[1], $val, $fix_form);						
		}
		return $setcon;
	}
	
	

		
	// Function to save the changes made in the config form
	function setFonts($path, $attr, $attrv, $pname) {
		$dom = domxml_open_file($path . "formats.xml");
		$root = $dom->document_element();
		$nodes = $root->child_nodes ();
		for ($i = 0; $i < count ($nodes); $i++) {
			$node = $nodes[$i];
			if ($node->node_type () == XML_ELEMENT_NODE) {
				if ($node->node_name () == "format") {
					if ($node->get_attribute ("id") == $attr) {						
					changeNodeProperty ($node, $pname, $attrv);										
					}
				}
			}
		}
		$dom->dump_file ($path . "formats.xml", false, true);
		return "Saved";
		
	}	
	
	// Save config
	function setConf($path, $attr, $attrv) {
		
		
		$dom = domxml_open_file($path . "config.xml");

		$root = $dom->document_element();
		$nodes = $root->child_nodes ();
		for ($i = 0; $i < count ($nodes); $i++) {
			$node = $nodes[$i];
			if ($node->node_type () == XML_ELEMENT_NODE) {
				if ($node->node_name () == "param") {
					if ($node->get_attribute ("name") == $attr)	 {						
						$node->set_attribute ("value", $attrv);										
					}	
				}
			}
		}
		$dom->dump_file ($path . "config.xml", false, true);
		return "Saved";
		
	}
	
	// Get the values from param in config.xml
	function GetAttr($path,$attr) {
		$settings = array ();		
		$dom = domxml_open_file($path . "config.xml");
		$root = $dom->document_element();
		$nodes = $root->child_nodes ();		
		for ($i = 0; $i < count ($nodes); $i++) {
			$node = $nodes[$i];
			if ($node->node_type () == XML_ELEMENT_NODE) {
				if ($node->node_name () == "param") {
					if($node->get_attribute ("name") == $attr) {
						return $node->get_attribute ("value");						
					}
				}
			}
		}
	}
	
		
	
	//Check if folder is writable
	function is__writable($path)
		{
		
		   if ($path{strlen($path)-1}=='/')
		    
		       return expose_M::is__writable($path.uniqid(mt_rand()).'.tmp');
		 
		   else {
		   
		   if (ereg('.tmp', $path))
		   {
		    
		       if (!($f = @fopen($path, 'w+')))
		           return false;
		       fclose($f);
		       unlink($path);
		       return true;
		
		   }
		   else {
		   	if (!($f = @fopen($path, 'a')))
		           return false;
		       fclose($f);
		       return true;
		   }//We have a path error.
		    }
		
		
		}
	
	// Check if the system has the SYSTEM REQUIREMENTS
	function syscheck() {

		if (version_compare ('5.0.0', phpversion(), '<=') == 1 || function_exists (domxml_open_file)) {
			$domerror = 0;	
		} else {
			$domerror = 1;
			$domresponse = '<font color=#ff3300>DOMXML extension unavailable</font><br>';				
		}
		
		if (function_exists ('imagecreatefromjpeg')) {
			$gderror = 0;		
		} else {
			$gdresponse = '<font color=#ff3300>GD extension unavailable</font><br>';
			$gderror = 1;		
		}
		
		if (expose_M::is__writable(dirname(__FILE__).'/'.'../img/')) {		
			$imgpatherror = 0;
		} else {
			$imgresponse = '<font color=#ff3300>expose/img/ folder is NOT writable. please set the correct permissions.</font><br>';
			$imgpatherror = 1;
		}
		
		if (expose_M::is__writable(dirname(__FILE__).'/'.'../config/')) {		
			$confpatherror = 0;
		} else {
			$confresponse = '<font color=#ff3300>expose/config/ folder is NOT writable. please set the correct permissions.</font><br>';
			$confpatherror = 1;
		}
		
		if (expose_M::is__writable(dirname(__FILE__).'/'.'../xml/')) {
			$xmlpatherror = 0;
		} else {
			$xmlpatherror = 1;
			$xmlresponse = '<font color=#ff3300>expose/xml/ folder is NOT writable. please set the correct permissions.</font><br>';
		}
		
		if (expose_M::is__writable(dirname(__FILE__).'/'.'../manager/amfphp/extra/passhash.inc.php')) {
			$passerror = 0;
		} else {
			$passerror = 1;
			$passresponse = '<font color=#ff3300>Password file (expose/manager/amfphp/extra/passhash.inc.php) is NOT writable. please set the correct permissions.</font><br>';
		}
	
		if ($domerror == 1 || $gderror == 1 || $imgpatherror == 1 || $xmlpatherror == 1 || $passerror == 1 || $confpatherror == 1) {
			
			$errorMsg = "<b>Your system dose not meet the SYSTEM REQUIREMENTS to run the Expose config section.</b /> <br><br>".$domresponse.$gdresponse.$imgresponse.$xmlresponse.$passresponse.$confresponse;
			return $errorMsg;
		}else{
			return "";
		}
	
	}
	
	
	
	
} // End Class
?>

                                         