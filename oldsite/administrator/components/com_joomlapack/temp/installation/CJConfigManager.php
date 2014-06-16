<?php
/**
* @version 1.0
* @package JoomlaPackInstaller
* @copyright Copyright (C) 2007 Nicholas K. Dionysopoulos. All Rights Reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* Joomla Configuration File Management Class
*
* JoomlaPack Installer is free software. This version may have been modified
* pursuant to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );

class CJConfigManager {
	var $JoomlaVersion		= "1.0.x";
	var $isConfigLoaded		= false;
	var $config				= array();

	function CJConfigManager(){
		$JPInstallerRoot = dirname(__FILE__);
		$JPInstallerRoot = str_replace("\\", "/", $JPInstallerRoot);

		// Sense the Joomla! version (1.0.x or 1.5)
		$this->_get_JoomlaVer();

		// Try to locate the configuration.php (or default configuration)
		$JoomlaRoot = realpath($JPInstallerRoot . "/..");

		if (file_exists( $JPInstallerRoot . "/configuration.php" )) {
			$this->_load_configfile( $JPInstallerRoot . "/configuration.php" );
		} elseif (file_exists( $JoomlaRoot . "/configuration.php" )) {
			$this->_load_configfile( $JoomlaRoot . "/configuration.php" );
		} elseif (file_exists( $JPInstallerRoot . "/configuration-" . $this->JoomlaVersion . ".php" )) {
			$this->_load_configfile( $JPInstallerRoot . "/configuration-" . $this->JoomlaVersion . ".php" );
		} else {
			$this->isConfigLoaded = false;
		}

		// Try to load the configuration.php
	}

	function _get_JoomlaVer(){
		$JPInstallerRoot = dirname(__FILE__);
		$JPInstallerRoot = str_replace("\\", "/", $JPInstallerRoot);

		$JIncludesFolder = realpath($JPInstallerRoot . "/../includes/");

		if (!file_exists($JIncludesFolder . "/application.php")) {
			$this->JoomlaVersion = "1.0.x";
		} else {
			$this->JoomlaVersion = "1.5";
		}
	}

	function _load_configfile( $fileName ){
		require_once( $fileName );

		$this->config = array();

		switch($this->JoomlaVersion){
			case "1.0.x":
				$allVars = get_defined_vars();
				foreach($allVars as $varName => $varValue){
					if (stristr($varName, "mosConfig")) {
						$varName = str_replace("mosConfig_", "", $varName);
						$this->config[$varName] = $varValue;
					}

				}
				$this->isConfigLoaded = true;
				break;
			case "1.5":
				$this->config = get_class_vars("JConfig");
				$this->isConfigLoaded = true;
				break;
		} // switch
	}

	function ConfigurationContents(){
		switch($this->JoomlaVersion){
			case "1.0.x":
				$out="<?php\n";
				foreach($this->config as $name => $value){
					$out .= '$mosConfig_' . $name . " = '". addslashes($value) ."';\n";
				}

				$out .= 'setlocale (LC_ALL, $mosConfig_locale);' . "\n";
				$out .= "?>";
				return $out;
				break;
			case "1.5":
				$out =  "<?php\n";
				$out .= "class JConfig {\n";
				foreach($this->config as $name => $value){
					$out .= "\t" . 'var $' . $name . " = '". addslashes($value) ."';\n";
				}

				$out .= '}' . "\n";
				$out .= "?>";
				return $out;
				break;
		} // switch
	}
}

?>