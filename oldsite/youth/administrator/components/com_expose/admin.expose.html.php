<?php
//****************************************************************************
//Component	: Expose
//Version	: RC3
//Author	: Josh
//E-Mail	: webmaster@gotgtek.com
//Author	: Steinthor Kristinsson
//E-Mail	: steinthor@setjan.com
//File	: admin.expose.html.php
//Web Site	: www.gotgtek.com
//Copyright	: Copyright 2006 by GTEK Technologies
//License	: GNU General Public License (GPL), visit www.slooz.com for details
//
//Joomla 1.x flash gallery compoent.
//****************************************************************************

defined('_VALID_MOS') or die('Direct access to this location is not allowed.');
?>
<script language="JavaScript" type="text/JavaScript">
function submitbutton(save)
{
	if (save == "save") {
		document.nsave.submit();
	}
	if (save == "uploadbg") {
		<?php  if ('JVERSION' >= '1.5.0') { ?>
			popupWindow('components/com_expose/uploadimg.php?directory=&amp;t=joomla_admin','win1',250,100,'no');
		<?php  }else{ ?>
			popupWindow('components/com_expose/uploadimage.php?directory=&amp;t=joomla_admin','win1',250,100,'no');
		<?php } ?>
	}
}
</SCRIPT>

<?php
class HTML_content {
	function ShowLogo() {
		?><img src="../components/com_expose/expose/admin/logo.gif" />
	<?php }

	function ShowToolbar() { ?>
		<table id="toolbar" cellpadding="3" cellspacing="0" border="0" width="400" >
			<tr valign="middle" align="center">
				<td colspan="4"><img src="../components/com_expose/expose/admin/logo.gif" /><br /><br /></td>
			</tr>
			<tr>
				<td><a href="index2.php?option=com_expose&task=manage">[Album Manager]</a></td>
				<td><a href="index2.php?option=com_expose&task=config">[Main Configuration]</a></td>
				<td><a href="index2.php?option=com_expose&task=formats">[Font Configuration]</a></td>
				<td><a href="index2.php?option=com_expose&task=check">[System Check]</a></td>
				<td><a href="index2.php?option=com_expose&task=manual">[Manual]</a></td>
			</tr>
		</table>
	<?php }

	function ShowManager() { ?>
		<p align="center"><iframe src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/components/com_expose/expose/manager/manager.html" width="100%" height="600" scrolling="no" frameborder="0" style="position:center; z-index:100;"></iframe></p>
	<?php }

	function ShowCheck() {
		ob_start();
		require_once('../components/com_expose/expose/manager/check_system.php');
		ob_end_flush();
	}

	function ShowHelp() { ?>
		<p align="center"><iframe src="http://joomlacode.org/gf/project/expose/wiki/" width="100%" height="550" scrolling="yes" frameborder="0"></iframe></p>
	<?php }

	function readConf($path) {
		$settings = array ();
		$dom = domxml_open_file($path . "config.xml");
		$root = $dom->document_element();
		$nodes = $root->child_nodes (); ?>
		<table class="adminheading">
			<tr><th>
				<div><b />Main Configuration</b /></div>
			</th></tr>
		</table>

		<form id="nsave" name="nsave" method="post" action="index2.php?option=com_expose&task=saveConf">
		<table class="adminlist">
			<tr><th colspan="2">
				<div align="center"><b />Params</b /></div>
			</th></tr>

			<?php
			for ($i = 0; $i < count ($nodes); $i++) {
				$node = $nodes[$i];
				if ($node->node_type () == XML_ELEMENT_NODE || XML_COMMENT_NODE) {
					if ($node->node_name () == "param") {
						$setting = $node->get_attribute ("name");
						$nvalue = $node->get_attribute ("value");
						$ncomment = $node->get_attribute ("comment");
						$ntype = $node->get_attribute ("type");
						$settings[$setting] = $nvalue;
						?>

						<tr class="row0">
							<td width="70%" align="left">
								<b><?php echo $setting ?></b>
							</td>
							<td align="right"> <?php
								if($setting == 'Gallery Background Image') {
									HTML_content::SelectBackground("../components/com_expose/expose/img/",$nvalue);
								}else{
									echo "<input type='text' name='$setting' value='$nvalue' size='12'>&nbsp;";
								}
							?>
								<img src="../components/com_expose/expose/admin/tooltip.png" Title="header=[<img src='../components/com_expose/expose/admin/info.gif'>&nbsp;&nbsp;<?php echo $setting ?>] offsetx=[-300] body=[<?php echo $ncomment ?>]"><br>
							</td>
						<tr></tr>
						<?php 
					}
				}
			}
		?>
		</table>
		</form>
	<?php }

	// Populate font,color settings from the xml file into a form
	function readFormats ($path) {
		$settings = array ();
		$album = array ();
		$dom = domxml_open_file($path . "formats.xml"); ?>
		<table class="adminheading">
			<tr><th>
				<div><b />Font Configuration</b /></div>
			</th></tr>
		</table>
		<form name="nsave" method="post" action="index2.php?option=com_expose&task=saveFormats">
		<?php
		$root = $dom->document_element();
		$nodes = $root->child_nodes ();
		for ($i = 0; $i < count ($nodes); $i++) {
			$node = $nodes[$i];
			if ($node->node_type () == XML_ELEMENT_NODE) {
				if ($node->node_name () == "format") {
					$album["id"] = $node->get_attribute ("id");
					$node->get_attribute ("id");
		?>

					<table class="adminlist">
					<th colspan="2" align="left"><b><?php echo $node->get_attribute ("id");  ?></b></th>
					</tr>
					<tr class="row0">
					<td width="90%" align="left">Font</td><td align="right"><input type="hidden" readonly name="font-<?php echo $node->get_attribute ("id"); ?>" value="<?php echo getNodeProperty ($node, "font")?>"><?php echo getNodeProperty ($node, "font")?></td>
					</tr>
					<tr class="row0">
					<td align="left">Size</td><td align="right"><input type="text" name="size-<?php echo $node->get_attribute ("id"); ?>" value="<?php echo getNodeProperty ($node, "size")?>"></td>
					</tr>
					<tr class="row0">
					<td align="left">Color</td><td align="right"><input type="text" name="color-<?php echo $node->get_attribute ("id"); ?>" value="<?php echo getNodeProperty ($node, "color")?>"></td>
					</tr>
					<tr class="row0">
					<td align="left">Shadowcolor</td><td align="right"><input type="text" name="shadowcolor-<?php echo $node->get_attribute ("id"); ?>" value="<?php echo getNodeProperty ($node, "shadowcolor")?>"></td>
					</tr>
					<tr class="row0">
					<td align="left">Shadowalpha</td><td align="right"><input type="text" name="shadowalpha-<?php echo $node->get_attribute ("id"); ?>" value="<?php echo getNodeProperty ($node, "shadowalpha")?>"></td>
					</tr>
					<tr class="row0">
					<td align="left">Hshift</td><td align="right"><input type="text" name="hshift-<?php echo $node->get_attribute ("id"); ?>" value="<?php echo getNodeProperty ($node, "hshift")?>"></td>
					</tr>
					<tr class="row0">
					<td align="left">Vshift</td><td align="right"><input type="text" name="vshift-<?php echo $node->get_attribute ("id"); ?>" value="<?php echo getNodeProperty ($node, "vshift")?>"></td>
					</tr>
					<tr class="row0">
					<td align="left">Align</td><td align="right"><input type="text" name="align-<?php echo $node->get_attribute ("id"); ?>" value="<?php echo getNodeProperty ($node, "align")?>"></td>
					</tr>
					</table>

					<?php
				}
			}
		}
		echo "</form>";
	}

	function SelectBackground($dir,$nvalue) {
		echo "<select name='Gallery Background Image'>";
		echo "<option value=''>None</option>";
    	$dirpath = $dir;
    	$xmlF = expose_M::rpath();
    	$dh = opendir($dirpath);

		while (false !== ($file = readdir($dh))) {
			$filename = "img/".$file;
			if($filename == $nvalue) {
				$sel = "SELECTED";
			}
			if (!is_dir("$dirpath/$file")) {
				if ((strcasecmp(substr($file,-4),'.jpg'))) {
				} else {
					echo "<option value='img/$file' $sel>$file</option>";
				}
			}
			$sel = '';
		}

		closedir($dh);
		echo "</select>";
	}

}

?>
<!-- //The tooltip javafile -->
<script src="../components/com_expose/expose/admin/boxover.js"></script>
