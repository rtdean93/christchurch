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
Date Last Updated : 10/09/2004
Author(s) : Mohamed Moujami (Simo), Kristof De Jaeger
Description : database library

Get the latest version of ExtCalendar at http://extcal.sourceforge.net//
*/

if (!isset($DB_DIE_ON_FAIL)) { $DB_DIE_ON_FAIL = true; }
if (!isset($DB_DEBUG)) { $DB_DEBUG = true; }


function extcal_db_query($query, $debug=false, $die_on_debug=false, $silent=false) {
/* run the query $query against the current database.  if $debug is true, then
 * we will just display the query on screen.  if $die_on_debug is true, and
 * $debug is true, then we will stop the script after printing he debug message,
 * otherwise we will run the query.  if $silent is true then we will surpress
 * all error messages, otherwise we will print out that a database error has
 * occurred */
 
	global $database, $DB_DIE_ON_FAIL, $DB_DEBUG, $CONFIG_EXT;

	if ($debug || $DB_DEBUG) {
//		echo "<pre>" . htmlspecialchars($query) . "</pre>";
	}

	$database->setQuery( $query );
	$return_result = $database->query();
	
	if ( ($database->getErrorMsg() != '') && ! $silent) {
		echo "<h3>Database error encountered</h3>";
		if ($DB_DEBUG) {
			echo "<li><strong> DB Error</strong>: ";
			echo "<br /><pre>" . stripslashes($database->getErrorMsg()) . "</pre>";
		}

	}

	return $return_result;
}

function extcal_db_fetch_array($qid) {
/* grab the next row from the query result identifier $qid, and return it
 * as an associative array.  if there are no more results, return FALSE */

	return mysql_fetch_array($qid);
}

function extcal_db_fetch_row($qid) {
/* grab the next row from the query result identifier $qid, and return it
 * as an array.  if there are no more results, return FALSE */

	return mysql_fetch_row($qid);
}

function extcal_db_fetch_object($qid) {
/* grab the next row from the query result identifier $qid, and return it
 * as an object.  if there are no more results, return FALSE */

	return mysql_fetch_object($qid);
}

function extcal_db_num_rows($qid) {
/* return the number of records (rows) returned from the SELECT query with
 * the query result identifier $qid. */

	return mysql_num_rows($qid);
}

function extcal_db_affected_rows() {
/* return the number of rows affected by the last INSERT, UPDATE, or DELETE
 * query */

	return mysql_affected_rows();
}

function extcal_db_insert_id() {
/* if you just INSERTed a new row into a table with an autonumber, call this
 * function to give you the ID of the new autonumber value */

	return mysql_insert_id();
}

function extcal_db_free_result($qid) {
/* free up the resources used by the query result identifier $qid */

	mysql_free_result($qid);
}

function extcal_db_num_fields($qid) {
/* return the number of fields returned from the SELECT query with the
 * identifier $qid */

	return mysql_num_fields($qid);
}

function extcal_db_field_name($qid, $fieldno) {
/* return the name of the field number $fieldno returned from the SELECT query
 * with the identifier $qid */

	return mysql_field_name($qid, $fieldno);
}

function extcal_db_data_seek($qid, $row) {
/* move the database cursor to row $row on the SELECT query with the identifier
 * $qid */

	if (extcal_db_num_rows($qid)) { return mysql_data_seek($qid, $row); }
}
?>