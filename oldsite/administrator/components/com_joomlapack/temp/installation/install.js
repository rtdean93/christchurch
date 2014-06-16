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

var JPIOptions = new Array(
		'mode': 0,
		'host': '',
		'port': 21,
		'user': '',
		'pass': '',
		'rootDir': '',
		'passive': false
	);

var JPDBOptions = new Array(
	'host': '',
	'db': '',
	'user': '',
	'pass': '',
	'drop': false,
	'backup': false
);

/**
 *
 * @access public
 * @return void
 **/
function test(){
	alert( JPIOptions['port'] );
}