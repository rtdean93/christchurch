<?php 
session_start();
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
if(!isset($_SESSION['dateformat']))
	$_SESSION['dateformat'] = "H:i";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php echo "<?xml version=\"1.0\"?>"; ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $mosConfig_sitename; ?></title>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<link href="<?php echo $mosConfig_live_site;?>/templates/sg_joomla/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="css/template_css.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo $mosConfig_live_site;?>/images/favicon.ico" />
<script language="javascript" type="text/javascript" src="templates/sg_joomla/clock.js"> </script>
</head>
<body>
<div class="webcontainer">
<!-- Start Top -->
<table id="Table_01" width="780" height="55" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td background="templates/sg_joomla/images/top_01.jpg" width="5" height="17"></td>
		<td background="templates/sg_joomla/images/top_02.jpg" width="699" height="17">
		<span><?php mosPathWay(); ?></span>
		</td>
		<td background="templates/sg_joomla/images/top_03.jpg" width="61" height="17" align="center" id="clock" class="time"><script>initclock()</script></td>
		<td background="templates/sg_joomla/images/top_04.jpg" width="11" height="17" border="0" onclick="javascript:toggleClock();" alt="12/24 mode" title="12/24 mode"></td>
		<td background="templates/sg_joomla/images/top_05.jpg" width="4" height="17"></td>
	</tr>
	<tr>
		<td colspan="5" width="780" height="28" align="left">
		</td>
	</tr>
	<tr>
		<td background="templates/sg_joomla/images/top_07.jpg" width="5" height="10"></td>
		<td background="templates/sg_joomla/images/top_08.jpg" width="699" height="10"></td>
		<td colspan="3" background="templates/sg_joomla/images/top_09.jpg" width="76" height="10"></td>
	</tr>
</table>
<!-- End Top -->
<!-- Start Content -->
  <table width="780" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="115" class="table_top_content">
      <table width="760" height="115" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>
            <table width="100%" height="115" border="0" cellpadding="0" cellspacing="0" class="header_table">
                <tr>
                  <td align="left" valign="middle" style="padding-left:10px;"></td>
                  <td align="right" valign="top"><table width="379" height="95" cellpadding="0" cellspacing="0" style="margin-top:10px; margin-right:10px;">
                      <tr>
                        <td valign="top"><div class="newsflash_div">
                          <?php if ( mosCountModules( 'top' ) ) { mosLoadModules ( 'top', -3 );	} ?>
                        </div></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td valign="top" class="table_middle_content">
      <table width="760" border="0" align="center" cellpadding="0" cellspacing="0" >
          <tr>
            <td height="5" colspan="2" valign="top"></td>
          </tr>
          <tr>
            <td width="180" valign="top" style="padding:5px 0px 5px 0px;">
            <table width="180" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td background="templates/sg_joomla/images/menu_01.jpg" width="180" height="10"></td>
				</tr>                
            	<tr>
                  <td background="templates/sg_joomla/images/menu_03.jpg" style="padding:0px 4px 10px 4px;">
                    <?php mosLoadModules ( 'left', -2 ); ?>
                      <span style="padding-left:10px;">
                      <?php mosLoadModules ( 'right', -3 ); ?>
                      <?php include ("templates.php");?>
                    </td>
                </tr>
                <tr>
					<td background="templates/sg_joomla/images/menu_02.jpg" width="180" height="10"></td>
				</tr>   
            </table>
           </td>
            <td valign="top" style="padding:5px 10px 5px 10px;">
			<?php mosMainBody(); ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                  <tr>
                    <td width="50%" valign="top" style="padding-right:10px;">
                      <?php mosLoadModules ( 'user1', -2 ); ?>
                    </td>
                    <td width="50%" valign="top">
                      <?php mosLoadModules ( 'user2', -2 ); ?>
                    </td>
                  </tr>
              </table>
              <table align="center">
              	<tr>
              		<td align="center">
              		<?php mosLoadModules ( 'banner' ); ?>
              		</td>
              	</tr>
              </table>  
              </td>
            </tr>
          <tr height="10">
            <td></td>
          </tr>
          <tr>
            <td colspan="2" align="center" valign="bottom" style="border-top:1px dotted #CCCCCC; font-size:9px;">
              <?php mosLoadModules ( 'bottom', -2 ); ?>
              <p>
              <?php echo $mosConfig_live_site;?>, Powered by <a href="http://www.joomla.org/" class="sgfooter">Joomla</a> and Designed by SiteGround <a href="http://www.siteground.com/" target="_blank" class="sgfooter">web hosting</a>
              </p>
              </td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td class="table_bottom_content"></td>
    </tr>
  </table>
<br>
  <p align="center"><span class="seitencontainer">
    <?php
if ($my->id) {
  include ("editor/editor.php");
  initEditor();
}
?>
  </span></p>
</div>
</body>
</html>