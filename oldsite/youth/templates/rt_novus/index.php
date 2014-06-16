<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_styleswitcher.php");
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

	$template_width = "950";			// width in px | fluid
	$menu_name = "mainmenu";			// mainmenu by default, can be any Joomla menu name
	$menu_type = "splitmenu";			// splitmenu | module
	$side_column = "25%";               // width in px | percent
	$default_font = "default";          // smaller | default | larger
	$show_pathway = "false";			// true | false
	$iepng_fix = "false";               //true | false, turn internet explorer png fix on or off

	require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_styleloader.php");
	require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_utils.php");
	
	?>
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
	<link rel="shortcut icon" href="<?php echo $mosConfig_live_site;?>/images/favicon.ico" />
	<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_css.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		div.wrapper { <?php echo $template_width; ?>}
		#sidecol { width: <?php echo $side_column; ?>;}
		#main-column { margin-left: <?php echo $side_column; ?>;}
	</style>	
	<?php if (isIe6()) :?>
	<!--[if lte IE 6]>
	<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_ie6.css" rel="stylesheet" type="text/css" />
	<?php if($iepng_fix == "true") : ?>
	<style type="text/css">
	img { behavior: url(<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/iepngfix.htc); } 
	</style>
	<?php endif; ?>
	<![endif]-->
	<?php endif; ?>
	<?php if($mtype=="splitmenu") :
		echo "<!--[if IE]>\n";		
	  include_once( "$mosConfig_absolute_path/templates/" . $mainframe->getTemplate() . "/js/ie_splitmenu.js" );
	  echo "<![endif]-->\n";
	endif; ?>	
	</head>
	<body class="<?php echo $fontstyle; ?> <?php echo $tstyle; ?>">
		<!--Begin Menu-->
		<div id="menu-bar">
			<div class="wrapper">
				<div id="horiz-menu" class="<?php echo $mtype; ?>">
					<?php if($mtype == "splitmenu") : ?>
						<?php echo $topnav; ?>
					<?php else: ?>
						<?php mosLoadModules('toolbar',-1); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!--End Menu-->
		<!--Begin Inset Area-->
		<div id="inset">
			<div class="wrapper">
				<a href="<?php echo $mosConfig_live_site;?>" class="nounder"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/blank.gif" style="border:0;" alt="" id="logo" /></a>
				<div class="content">
					<?php mosLoadModules('banner',-1); ?>
				</div>
			</div>
		</div>
		<!--End Inset Area-->
		<!--Begin Main Content Area-->
		<div id="content">
			<div class="wrapper">
				<?php if (mosCountModules('left') or $subnav) : ?>
					<div id="sidecol">
						<div id="side-column">
							<div class="padding">
								<div class="inner">
									<?php if($subnav) : ?>
										<div id="sub-menu">
											<?php echo $subnav; ?>
										</div>
									<?php endif; ?>
									<?php mosLoadModules('left',-2); ?>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div id="main-column">
					<div class="padding">
						<div class="inner">
							<?php if ($show_pathway == "true") : ?>
								<?php mosPathway(); ?>
							<?php endif; ?>
							<div id="top">
								<?php mosLoadModules('top',-2); ?>
							</div>
							<?php if (mosCountModules('user1') or mosCountModules('user2')) : ?>
								<div id="topmodules" class="spacer<?php echo $topmod_width; ?>">
									<?php if (mosCountModules('user1')) : ?>
										<div class="block">
											<?php mosLoadModules('user1',-2); ?>
										</div>
									<?php endif; ?>
									<?php if (mosCountModules('user2')) : ?>
										<div class="block">
											<?php mosLoadModules('user2',-2); ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<div class="contentpadding">
								<?php mosMainbody(); ?>
							</div>
							<?php if (mosCountModules('user3') or mosCountModules('user4')) : ?>
								<div id="bottommodules" class="spacer<?php echo $bottommod_width; ?>">
									<?php if (mosCountModules('user3')) : ?>
										<div class="block">
											<?php mosLoadModules('user3',-2); ?>
										</div>
									<?php endif; ?>
									<?php if (mosCountModules('user4')) : ?>
										<div class="block">
											<?php mosLoadModules('user4',-2); ?>
										</div>
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<div class="clr"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--End Main Content Area-->
		<div class="clr"></div>
		<!--Begin Bottom Panel-->
		<div id="bottom">
			<div class="wrapper">
				<?php if (mosCountModules('user5') or mosCountModules('user6') or mosCountModules('user7')) : ?>
					<div id="footermodules" class="spacer<?php echo $footermod_width; ?>">
						<?php if (mosCountModules('user5')) : ?>
							<div class="block">
								<?php mosLoadModules('user5',-2); ?>
							</div>
						<?php endif; ?>
						<?php if (mosCountModules('user6')) : ?>
							<div class="block">
								<?php mosLoadModules('user6',-2); ?>
							</div>
						<?php endif; ?>
						<?php if (mosCountModules('user7')) : ?>
							<div class="block">
								<?php mosLoadModules('user7',-2); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div align="center">
					<a href="http://www.rockettheme.com/" title="RocketTheme Joomla Template Club" class="nounder"><img src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/images/blank.gif" alt="RocketTheme Joomla Templates" id="rocket" /></a>
				</div>
			</div>
		</div>
		<!--End Bottom Panel-->
	</body>	
</html>