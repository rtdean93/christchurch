<?php
/**
* @version 1.0
* @package JoomlaPackInstaller
* @copyright Copyright (C) 2007 Nicholas K. Dionysopoulos. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*
* JoomlaPack Installer is built upon the Joomla! installer, which is copyright 2005
* by Open Source Matters and distributed also under the terms of the GNU/GPL. These
* functions are a mere extension to that project to overcome timeouts in populating
* the database.
*/

set_time_limit(0);

// Set flag that this is a parent file
define( "_VALID_MOS", 1 );

// Include common.php
require_once( 'common.php' );
require_once( '../includes/database.php' );

sajax_init();
sajax_export("AjaxPing", "TryConnect", "populateDB", "DropOrRenameTables");
sajax_handle_client_request();

function AjaxPing() {
	return 1;
}

function TryConnect($DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix ) {
	$Response = array(
		"connect" => false,
		"errors" => "",
		"nextOffset" => 0,
		"totalBytes" => 0,
	);

	$database = null;

	if (!$DBhostname || !$DBuserName || !$DBname) {
		$Response["errors"] = "The database details provided are incorrect and/or empty.";
		return $Response;
	}

	if($DBPrefix == '') {
		$Response["errors"] = "You have not entered a database prefix.";
		return $Response;
	}

	$database = new database( $DBhostname, $DBuserName, $DBpassword, '', '', false );
	$test = $database->getErrorMsg();

	if (!$database->_resource) {
		$Response["errors"] = "The password and username provided are incorrect.";
		return $Response;
	}

	$sql = "CREATE DATABASE `$DBname`";
	$database->setQuery( $sql );
	$database->query();
	$test = $database->getErrorNum();

	if ($test != 0 && $test != 1007) {
		$Response["errors"] = 'A database error occurred: ' . $database->getErrorMsg();
		return $Response;
	}

	$Response["connect"] = true;
	$Response["totalBytes"] = filesize( dirname(__FILE__) . "/sql/joomla.sql" );
	return $Response;
}

/**
	Private function to read a small chunk of SQL data in memory
*/
function readChunk($fileName, $nextOffset) {
	$JPI_CHUNK_LENGTH = 8196;

	// Initialize return array
	$retArray = array(
		"nextOffset" => -1,
		"data" => false,
		"error" => ""
	);

	// If we tried to go past end of file, abort
	if ( $nextOffset >= filesize($fileName) ) {
		return $retArray;
	}

	// Try opening the file, or abort
	$fp = @fopen($fileName, "rb");

	if ($fp === FALSE) {
		$retArray['error'] = "Could not open database backup file for reading";
		return $retArray;
	}

	// Get first chunk
	if ($nextOffset > 0) {
		fseek($fp, $nextOffset,  SEEK_SET);
	}

	$mqr = @get_magic_quotes_runtime();
	@set_magic_quotes_runtime(0);
	$retArray['data'] = fread($fp, $JPI_CHUNK_LENGTH );
	@set_magic_quotes_runtime($mqr);

	// Find position of last line return (newline mark)
	$pos = strrpos($retArray['data'], "\n");

	// If there was no newline found, we've got to read more blocks
	if (($pos === FALSE) && (!feof($fp))) {
		$tmpRet = readChunk($fileName, $nextOffset + strlen($retArray['data']));
		if ( ($tmpRet['data'] != false) && ( !is_null($tmpRet['data']) ) ) {
			$retArray['data'] .= $tmpRet['data'];
		}
		$pos = strrpos($retArray['data'], "\n");
		if ($pos === false) {
			$pos = strlen($retArray['data']);
		}
	}

	// Discard partial data after the last newline
	$tmp = @str_split($retArray['data'], $pos);
	$retArray['data'] = $tmp[0];
	$dataLength = strlen($retArray['data']);
	if ($dataLength == 0) {
		$dataLength = 1;
	}
	$retArray['nextOffset'] = $nextOffset + $dataLength;

	return $retArray;
}

/**
	Public function that populates the database with data, by reading small chunks out of the SQL file
*/
function populateDB($DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix, $nextOffset) {
	// Initialize return array
	$retArray = array(
		"nextOffset" => -1,
		"error" => null
	);

	// Try reading next chunk, or fail gracefully
	$fileName = dirname(__FILE__) . "/sql/joomla.sql";
	$chunkData = readChunk( $fileName, $nextOffset );
	if ($chunkData['error'] != "") {
		$retArray['error'] = $chunkData['error'];
		return $retArray;
	}
	// Parse chunk's lines
	$linesSQL = explode("\n", $chunkData['data']);

	// Try connecting to database, or fail gracefully
	$database = new database( $DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix );
	$test = $database->getErrorMsg();

	if (!$database->_resource) {
		$retArray['error'] = "Invalid username/password";
		return $retArray;
	}
	if ($test != 0 && $test != 1007) {
		$retArray['error'] = 'A database error occurred: ' . $database->getErrorMsg();
		return $retArray;
	}

	// Loop through all the lines
	foreach($linesSQL as $sql) {
		$sql = trim( $sql );
		$split_sql = @str_split($sql);
		if ( ( !empty( $sql ) ) && ( $split_sql[1] != '#' ) ) {
			$database->setQuery( $sql );
			if (!$database->query()) {
				$retArray['error'] = 'A database error occurred when running query<br /><tt>' . $database->getQuery() . "</tt><br />The error was:<br />" . $database->getErrorMsg();
				return $retArray;
			}
		}
	}

	// Update nextOffset and return
	$retArray['nextOffset'] = $chunkData['nextOffset'];
	return $retArray;
}

function DropOrRenameTables($DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix, $DBDel, $DBBackup) {
	$retArray = array(
		"error" => "",
		"ok" => false
	);

	$BUPrefix = "old_";

	// Try connecting to database, or fail gracefully
	$database = new database( $DBhostname, $DBuserName, $DBpassword, $DBname, $DBPrefix );
	$test = $database->getErrorMsg();

	if (!$database->_resource) {
		$retArray['error'] = "Invalid username/password";
		return $retArray;
	}
	if ($test != 0 && $test != 1007) {
		$retArray['error'] = 'A database error occurred: ' . $database->getErrorMsg();
		return $retArray;
	}

	// Do we have _anything_ to do?
	if ($DBDel) {
		$query = "SHOW TABLES FROM `$DBname`";
		$database->setQuery( $query );
		$errors = array();
		if ($tables = $database->loadResultArray()) {
			foreach ($tables as $table) {
				if (strpos( $table, $DBPrefix ) === 0) {
					if ($DBBackup) {
						$butable = str_replace( $DBPrefix, $BUPrefix, $table );
						$query = "DROP TABLE IF EXISTS `$butable`";
						$database->setQuery( $query );
						$database->query();
						if ($database->getErrorNum()) {
							$retArray['error'] = 'A database error occurred when running query<br /><tt>' . $database->getQuery() . "</tt><br />The error was:<br />" . $database->getErrorMsg();
							return $retArray;
						}
						$query = "RENAME TABLE `$table` TO `$butable`";
						$database->setQuery( $query );
						$database->query();
						if ($database->getErrorNum()) {
							$retArray['error'] = 'A database error occurred when running query<br /><tt>' . $database->getQuery() . "</tt><br />The error was:<br />" . $database->getErrorMsg();
							return $retArray;
						}
					}
					$query = "DROP TABLE IF EXISTS `$table`";
					$database->setQuery( $query );
					$database->query();
					if ($database->getErrorNum()) {
							$retArray['error'] = 'A database error occurred when running query<br /><tt>' . $database->getQuery() . "</tt><br />The error was:<br />" . $database->getErrorMsg();
							return $retArray;
					}
				}
			}
		}
	}

	$retArray['ok'] = true;
	return $retArray;
}
?>