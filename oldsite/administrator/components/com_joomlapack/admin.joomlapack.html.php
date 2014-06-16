<?php
/**
 * Administrator panel HTML display class
 *
 * LICENSE: This source file is distributed subject to the GNU General
 * Public Licence (GPL) version 2 or later.
 * http://www.gnu.org/copyleft/gpl.html
 * If you did not receive a copy of the GNU GPL and are unable to obtain it through the web,
 * please send a note to nikosdion@gmail.com so we can mail you a copy immediately.
 *
 * @package    JoomlaPacker
 * @Author     Nicholas K. Dionysopoulos nikosdion@gmail.com
 * @copyright  2007 Nicholas K. Dionysopoulos
 * @license    http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version    1.0.4
 * @since      File available since Release 1.0
*/

// ensure this file is being included by a parent file - Joomla! 1.0.x and 1.5 compatible
(defined( '_VALID_MOS' ) || defined('_JEXEC')) or die( 'Direct Access to this location is not allowed.' );

global $JPLang;

class jpackScreens {
	function fConfig() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fConfig.php" );
	}

	function fPack() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fPack.php" );
	}

	function fMain() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fMain.php" );
	}

	function fBUAdmin() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fBUAdmin.php" );
	}

	function fDirExclusion() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fDirExclusion.php" );
	}

	function fLog() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fLog.php" );
	}

	function fDebug() {
		global $option, $mosConfig_absolute_path;
		require_once( $mosConfig_absolute_path . "/administrator/components/$option/includes/fDebug.php" );
	}

	function CommonFooter() {
		global $option, $JPLang;
	?>
		<p>
			[
			<a href="index2.php?option=<?php echo $option; ?>"><?php echo $JPLang['cpanel']['home']; ?></a>
			]
			<br />
			<span style="font-size:x-small;">
			JoomlaPack <?php echo _JP_VERSION; ?>. Copyright &copy; 2006-2007 <a href="mailto:nikosdion@gmail.com">Nicholas K. Dionysopoulos</a>.<br/>
			<a href="http://forge.joomla.org/sf/projects/joomlapack">JoomlaPack</a> is Free Software released under the GNU/GPL License.
			</span>
		</p>
	<?php
	}
}
?>
