<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
define( 'YOURBASEPATH', $mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() );
require( YOURBASEPATH . "/rt_styleswitcher.php"); 


	// *************************************************
	// Change the variables below to adjust the template
	//
	// If you have any issues, check out the forum at
	// http://www.rockettheme.com
	//
	// *************************************************

	$default_style				= "style4";			 // [style1... 12]
	$enable_ie6warn             = "true";            // true | false
	$font_family                = "helvetica";        // geneva | optima | helvetica | trebuchet | lucida | georgia | palatino
	$enable_fontspans           = "true";            // true | false
	$show_fontbuttons			= "true";		     // true | false
	$template_width 			= "962";			 // width in px
	$leftcolumn_width			= "210";			 // width in px
	$rightcolumn_width			= "210";			 // width in px
	$inset_width				= "290";			 // width in px
	$splitmenu_col				= "rightcol";		 // leftcol | rightcol
	$menu_name 					= "mainmenu";		 // mainmenu by default, can be any Joomla menu name
	$menu_type 					= "moomenu";		 // moomenu | suckerfish | splitmenu | module
	$default_font 				= "default";         // smaller | default | larger
	$show_pathway 				= "false";			 // true | false
								
	require(YOURBASEPATH . "/rt_styleloader.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<?php
	if ( $my->id ) {
		initEditor();
	}
	mosShowHead();	
					
	require(YOURBASEPATH . "/rt_utils.php");
    require(YOURBASEPATH . "/rt_head_includes.php");
    ?>
	</head>
	<body id="ff-<?php echo $fontfamily; ?>" class="<?php echo $tstyle; ?> <?php echo $fontstyle; ?>">
		<!-- begin header -->
		<div id="header">
			<div class="wrapper">
				<a href="<?php echo $mosConfig_live_site;?>" class="nounder"><img src="http://visitchristchurch.org/youth/images/logoyouth.jpg" border="0" alt="" id="logo" /></a>
				<!-- begin top panel -->
				<?php if (mosCountModules('top')) : ?>
					<div id="toppanel-container" class="wrapper">
						<div id="topmod">
							<div class="wrapper">
								<?php mosLoadModules('top',-2); ?>
							</div>
							<div id="top-tab">
								<span class="tab-text">Member Login</span>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<!-- end top panel -->
				<?php if (mosCountModules('icon')) : ?>
					<div id="toplinks">
						<?php mosLoadModules('icon',-2); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<!-- end header -->
		<div id="page-bg">
			<div class="wrapper">
				<div id="sub-header">
					<!-- begin search module -->
					<?php if (mosCountModules('search')) : ?>
						<div id="searchmod">
							<?php mosLoadModules('search',-2); ?>
						</div>
					<?php endif; ?>
					<!-- end search module -->
					<!-- begin menu bar -->
					<div id="horiz-menu" class="<?php echo $mtype; ?>">
						<div id="horiz-menu2">
						<?php if($mtype != "module") : ?>
							<?php echo $topnav->display(); ?>
						<?php else: ?>
							<?php mosLoadModules('toolbar',-1); ?>
						<?php endif; ?>
						</div>
					</div>
					<!-- end menu bar -->
				</div>
				<!-- begin showcase area -->
				<?php if (mosCountModules('header') or mosCountModules('header2')) : ?>
					<div id="showcase">
						<div id="showcase2">
							<div class="padding">
								<?php mosLoadModules('header2',-3); ?>
							</div>
						</div>
						<div id="showcase3">
							<?php mosLoadModules('header',-3); ?>
						</div>
					</div>
				<?php endif; ?>
				<div class="clr"></div>
				<!-- end showcase area -->
				<!-- begin featured area -->
				<?php if (mosCountModules('advert1') or mosCountModules('advert2')) : ?>
				<div id="featured">
					<div id="featured2">
						<?php if (mosCountModules('advert2')) : ?>
							<div id="featured-right-column">
								<div class="padding">
								<?php mosLoadModules('advert2',-3); ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if (mosCountModules('advert1')) : ?>
							<div id="featured-left-column">
								<div class="padding">
								<?php mosLoadModules('advert1',-3); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div id="featured-bottom">
					<div id="featured-bottom2">
						<div id="featured-bottom3">
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="clr"></div>
				<!-- end featured area -->
				<!-- begin main content area -->
				<div id="main-content-bar">
					<?php if ($show_fontbuttons == "true") : ?>
					<div id="accessibility">
						<div id="buttons">
							<a href="<?php echo $thisurl; ?>fontstyle=f-larger" title="Increase size" class="large"><span class="button">&nbsp;</span></a>
							<a href="<?php echo $thisurl; ?>fontstyle=f-default" title="Default size" class="default"><span class="button">&nbsp;</span></a>
							<a href="<?php echo $thisurl; ?>fontstyle=f-smaller" title="Decrease size" class="small"><span class="button">&nbsp;</span></a>
						</div>
					</div>
					<?php endif; ?>
					<?php if (mosCountModules('user1') or mosCountModules('user2') or mosCountModules('user3')) : ?>
					<div class="content-bar-text">Special <span class="color2">Feature</span></div>
					<?php endif; ?>
				</div>
				<div id="main-content">
					<table class="mainbody" border="0" cellspacing="0" cellpadding="0">
						<tr valign="top">
							<!-- begin leftcolumn -->
							<?php if (mosCountModules('left') or (isset($subnav) and $subnav->ismenu() and $splitmenu_col=="leftcol")) : ?>
								<td class="leftcol">
									<div class="padding">
										<?php if($subnav and $splitmenu_col=="leftcol" && $subnav->ismenu()) : ?>
											<div id="sub-menu">
												<?php echo $subnav->display(); ?>
											</div>
											<?php endif; ?>
										<?php mosLoadModules('left', -3); ?>
									</div>
								</td>
							<?php endif; ?>
							<!-- end leftcolumn -->
							<!-- begin maincolumn -->
							<td class="maincol">
								<?php if (mosCountModules('user1') or mosCountModules('user2') or mosCountModules('user3')) : ?>
								<div class="maincol-indicator"></div>
								<?php endif; ?>
									<div class="padding">
									<?php if (mosCountModules('user1') or mosCountModules('user2') or mosCountModules('user3')) : ?>
										<div id="mainmodules" class="spacer<?php echo $mainmod_width; ?>">
											<?php if (mosCountModules('user1')) : ?>
												<div class="block">
													<?php mosLoadModules('user1',-3); ?>
												</div>
											<?php endif; ?>
											<?php if (mosCountModules('user2')) : ?>
												<div class="block">
													<?php mosLoadModules('user2',-3); ?>
												</div>
											<?php endif; ?>
											<?php if (mosCountModules('user3')) : ?>
												<div class="block">
													<?php mosLoadModules('user3',-3); ?>
												</div>
											<?php endif; ?>
										</div>
									<?php endif; ?>
									<?php if (mosCountModules('user1') or mosCountModules('user2') or mosCountModules('user3')) : ?>
									<div id="main-content-bar2">
										<div class="content-bar-text2">Recent <span class="color3">News</span></div>
									</div>
									<?php endif; ?>
									<?php if ($show_pathway == "true") : ?>
										<div id="pathway">
											<?php mosPathway(); ?>
										</div>
									<?php endif; ?>
									<?php if (mosCountModules('inset')) : ?>
										<div id="inset">
											<div class="padding">
											<?php mosLoadModules('inset',-3); ?>
											</div>
										</div>
									<?php endif; ?>
									<div id="content-area">
										<?php mosMainbody(); ?>
									</div>
								</div>
							</td>
							<!-- end maincolumn -->
							<!-- begin rightcolumn -->
							<?php if (mosCountModules('right') or (isset($subnav) and $subnav->ismenu() and $splitmenu_col=="rightcol")) : ?>
								<td class="rightcol">
									<div class="padding">
										<?php if($subnav and $splitmenu_col=="rightcol" && $subnav->ismenu()) : ?>
											<div id="sub-menu">
												<?php echo $subnav->display(); ?>
											</div>
											<?php endif; ?>
										<?php mosLoadModules('right', -3); ?>
									</div>
								</td>
							<?php endif; ?>
							<!-- end rightcolumn -->
						</tr>
					</table>
				</div>
				<!-- end main content area -->
				<!-- begin bottom section -->
				<?php if (mosCountModules('user4') or mosCountModules('user5') or mosCountModules('user6') or mosCountModules('user7')) : ?>
				<div id="bottom">
					<div id="bottommodules" class="spacer<?php echo $bottommods_width; ?>">
						<?php if (mosCountModules('user4')) : ?>
							<div class="block">
								<?php mosLoadModules('user4',-3); ?>
							</div>
						<?php endif; ?>
						<?php if (mosCountModules('user5')) : ?>
							<div class="block">
								<?php mosLoadModules('user5',-3); ?>
							</div>
						<?php endif; ?>
						<?php if (mosCountModules('user6')) : ?>
							<div class="block">
								<?php mosLoadModules('user6',-3); ?>
							</div>
						<?php endif; ?>
						<?php if (mosCountModules('user7')) : ?>
							<div class="block">
								<?php mosLoadModules('user7',-3); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
				<!-- end bottom section -->
				<!-- begin footer -->
				<div id="footer">
					<div class="footer2">
						<div class="footer3">
							<a href="<?php echo $mosConfig_live_site;?>" class="nounder"><img src="http://visitchristchurch.org/youth/images/logoyouth.jpg" border="0" alt="" id="logo-bottom" /></a>
							<?php if (mosCountModules('footer')) : ?>
								<div id="bottom-menu">
									<div id="bottom-menu2">
									<?php mosLoadModules('footer',-2); ?>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div id="copyright">
					<a href="http://www.rockettheme.com/" title="RocketTheme Joomla Template Club" class="nounder"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/blank.gif" alt="Christ Congregational UCC" id="rocket" /></a>
					<div class="copyright">&copy; 2008 All rights reserved.</div>
				</div>
				<!-- end footer -->
				<?php mosLoadModules('debug',-1); ?>
			</div>
		</div>	
	</body>
</html>