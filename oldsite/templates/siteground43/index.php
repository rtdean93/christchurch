<?php defined( "_VALID_MOS" ) or die( "Direct Access to this location is not allowed." );$iso = split( '=', _ISO );echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php mosShowHead(); ?>
<meta http-equiv="Content-Type" content="text/html" <?php echo _ISO; ?>" />
<?php if ( $my->id ) { initEditor(); } ?>
<?php echo "<link rel=\"stylesheet\" href=\"$GLOBALS[mosConfig_live_site]/templates/$GLOBALS[cur_template]/css/template_css.css\" type=\"text/css\"/>" ; ?>
<link rel="alternate" title="<?php echo $mosConfig_sitename; ?>" href="<?php echo $GLOBALS['mosConfig_live_site']; ?>/index2.php?option=com_rss&no_html=1" type="application/rss+xml" />
<link rel="alternate" type="application/rss+xml" title="<?php echo $mosConfig_sitename?>" href="<?php echo $mosConfig_live_site;?>/index.php?option=com_rss&feed=RSS2.0&no_html=1" />
</head>
<body>
<center>

<div class="top"></div>
<?php include'menu.php'; ?>
<div class="bg">
<table width="800" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td valign="top" width="200" align="left">
						<?php mosLoadModules ( 'left' ); ?>
						<br>
						<? $sg = 'banner'; include "templates.php"; ?>
					</td>
					<td width="10"></td>
					<td valign="top" width="590" align="left">
						<div style="width:580px;padding:10px;"><?php mosMainBody(); ?></div>
					</td>
				</tr>
			</table>
</div>
<br>
<? $sg = ''; include "templates.php"; ?>
</center>
</body>
</html>