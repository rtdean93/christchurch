<?if( $sg == 'banner' ):?>
<div style="width: 100%;" align="center" border="0" cellpadding="0" cellspacing="0">
<br>
<table width="137" align="center">
	<tr>
		<td>
		<font class="sgf1">Designed by:</font>
		</td>
	</tr>
</table>
<table width="137" height="16" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<a href="http://www.siteground.com/ecommerce-hosting.htm" target="_blank"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $GLOBALS[cur_template]?>/images/banner_01.jpg" width="28" height="16" alt="Ecommerce hosting" title="Ecommerce hosting" border="0"></a></td>
		<td width="2" height="16"></td>
		<td background="<?php echo $mosConfig_live_site;?>/templates/<?php echo $GLOBALS[cur_template]?>/images/banner_02.jpg" width="107" height="16" align="center">
		<a href="http://www.siteground.com/mambo-hosting/mambo-templates.htm" style="font-size: 10px; font-family: Verdana,Arial,Helvetica,sans-serif; color: #333333;text-decoration:none;">
		Mambo Templates</a>
		</td>
	</tr>
</table>
<table align="center">
	<tr>
		<td class="sgf">
		<a href="http://www.siteground.com/" class="sglink" target="blank">Web Hosting</a> Services
		</td>
	</tr>
</table>
</div> 
 
 <?else:?>
 
 <?php echo $mosConfig_live_site;?>, Powered by <a href="http://mamboserver.com/" class="sgfooter">Mambo</a> and Designed by SiteGround <a href="http://www.siteground.com/" target="_blank" class="sgfooter">web hosting</a>
 
 <?endif;?>