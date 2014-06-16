<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$iso = split( '=', _ISO );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if ( $my->id ) {
	initEditor();
}
mosShowHead();

// *************************************************
// Change this variable blow to switch color-schemes
//
// If you have any issues, check out the forum at
// http://www.rockettheme.com
//
// *************************************************

$background_style = "medium";			// light | medium | dark | blue
$primary_style = "red";				// red | blue | green | purple
$body_style = "beige";						// beige | grey
$menu_name = "mainmenu";				// mainmenu by default, can be any Joomla menu name
$show_pathway = "false";				// true | false
$enable_livesearch = "true";		// true | false

// config override
$override_config = $mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_config.php";
if(file_exists($override_config)) require($override_config);

// *************************************************

require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_splitmenu.php");

// menu initialization code
$forcehilite = false;
$topnav = rtShowHorizMenu($menu_name);
$subnav = rtSubMenu($menu_name, 1);
$sidenav = rtSubMenu($menu_name, 2);

$livesearch =  $mosConfig_absolute_path . "/templates/" . $mainframe->getTemplate() . "/livesearch/livesearch_ui.php";

//Are we in edit mode
if (  !empty( $_REQUEST['task'])  && $_REQUEST['task'] == 'edit'  ) {
	$editmode = true;
}

// *************************************************
?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/body_<?php echo $body_style; ?>.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/primary_<?php echo $primary_style; ?>.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 7]>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if lte IE 6]>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/slimbox/slimbox.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php echo $mosConfig_live_site;?>/images/favicon.ico" />
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/livesearch.js"></script>
<?php if (!$editmode) : ?>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/mootools.release.83.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/slimbox.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/rt_sameheight.js"></script>
<?php endif; ?>
</head>
<body id="page_bg" class="b-<?php echo $background_style; ?> p-<?php echo $primary_style; ?> bd-<?php echo $body_style; ?>">
	<div class="wrapper">
		
		<div class="mainbg">
			<div id="header">
				<a href="<?php echo $mosConfig_live_site;?>" class="nounder"><img src="<?php echo $mosConfig_live_site;?>/images/blank.png" border="0" alt="" id="logo" /></a>
				<div id="scroller">
					<?php mosLoadModules('newsflash', -1); ?>
				</div>
				<div id="header_spotlight">
					<div id="topbox">
						<?php mosLoadModules('banner', -2); ?>
					</div>
					<div id="searchbox">
						<?php if ($enable_livesearch == "true") : ?>
							<?php include($livesearch) ?>
						<?php else: ?>
							<?php mosLoadModules('user8', -1); ?>
						<?php endif;  ?>
					</div>
				</div>
			</div>
			
			<div id="safari">
				<div id="nav">
					<?php echo $topnav; ?>
				</div>
				<div id="menu_horiz" >
					<?php echo $subnav; ?>
					<div class="clr"></div>
				</div>
			</div>
			
			<table class="mainbg" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<td class="main">
						<?php if (!$editmode and mosCountModules('inset')) : ?>
						<div class="hilight">
							<?php mosLoadModules('inset', -2); ?>
									</div>
						<?php endif; ?>
						<?php if (!$editmode and (mosCountModules('user1') or mosCountModules('user2'))) : ?>
						<div class="block normal">
							<table class="userblock" cellspacing="0" cellpadding="0">
								<tr valign="top">
									<?php if (mosCountModules('user1')) : ?>
									<td class="user">
										<?php mosLoadModules('user1', -2); ?>
									</td>
									<?php endif; ?>
									<?php if (mosCountModules('user1') and mosCountModules('user2')) : ?>
									<td class="spacer">&nbsp;</td>
									<?php endif; ?>
									<?php if (mosCountModules('user2')) : ?>
									<td class="user">
										<?php mosLoadModules('user2', -2); ?>
									</td>
									<?php endif; ?>
								</tr>
							</table>
						</div>
						<?php endif; ?>
						<div class="mainbody">
							<?php if ($show_pathway == "true") : ?>
							<?php mosPathway(); ?>
							<?php endif; ?>
							<?php mosMainbody(); ?>
						</div>
						<?php if (!$editmode and (mosCountModules('user3') or mosCountModules('user4'))) : ?>
						<div class="surround">
							<div class="block bottom">
								<table class="userblock" cellspacing="0" cellpadding="0">
									<tr valign="top">
										<?php if (mosCountModules('user3')) : ?>
										<td class="user">
											<?php mosLoadModules('user3', -2); ?>
										</td>
										<?php endif; ?>
										<?php if (mosCountModules('user3') and mosCountModules('user4')) : ?>
										<td class="spacer">&nbsp;</td>
										<?php endif; ?>
										<?php if (mosCountModules('user4')) : ?>
										<td class="user">
											<?php mosLoadModules('user4', -2); ?>
										</td>
										<?php endif; ?>
									</tr>
								</table>
							</div>
						</div>
						<?php endif; ?>
					</td>
					<?php if (!$editmode and mosCountModules('user5')) : ?>
					<td class="middle">
						<div class="block light">
						<?php mosLoadModules('user5', -2); ?>
						</div>
					</td>
					<?php endif; ?>
					<?php if (!$editmode and ($sidenav != '' or mosCountModules('user6') or mosCountModules('user7'))) : ?>
					<td class="side">
						<?php if ($sidenav != '' or mosCountModules('user6')) : ?>
						<div class="block dark">
							<div class="extra_pad">
								<?php echo $sidenav; ?>
								<?php mosLoadModules('user6', -2); ?>
							</div>
						</div>
						<?php endif; ?>
						<?php if (mosCountModules('user7')) : ?>
						<div class="block">
							<?php mosLoadModules('user7', -2); ?>
						</div>
						<?php endif; ?>
					</td>
					<?php endif; ?>
				</tr>
			</table>
			<div id="footer">
				<a href="http://www.rockettheme.com/" title="RocketTheme Joomla Template Club"><img src="<?php echo $mosConfig_live_site;?>/images/blank.png" border="0" alt="RocketTheme Joomla Templates" id="rocket" /></a>
				<a href="http://jigsaw.w3.org/css-validator/validator?profile=css2&amp;warning=2&amp;uri=<?php echo $mosConfig_live_site;?>"><img src="<?php echo $mosConfig_live_site;?>/images/blank.png" class="css_button" alt="CSS Valid" /></a>
				<a href="http://validator.w3.org/check?uri=<?php echo $mosConfig_live_site;?>"><img src="<?php echo $mosConfig_live_site;?>/images/blank.png" class="xhtml_button" alt="XHTML Valid" /></a> 
				<?php mosLoadModules('footer',-1); ?>
			</div>							
		</div>
	</div>


<?php mosLoadModules( 'debug', -1 );?>
</body>
</html>

