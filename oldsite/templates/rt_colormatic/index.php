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

$default_style = "style5";			// style1 | style2 | style3 | ..... | style15
$orientation = "left";					// left | right
$template_width = "868";				// width in px | fluid
$side_width = "280";						// width in px
$menu_name = "mainmenu";				// mainmenu by default, can be any Joomla menu name
$menu_type = "splitmenu";				// splitmenu | suckerfish | module
$default_font = "larger";      // smaller | default | larger
$show_pathway = "false";				// true | false


require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_styleloader.php");

if ($mtype=="splitmenu") :
	require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_splitmenu.php");
	$topnav = rtShowHorizMenu($menu_name);
	$sidenav = rtShowSubMenu($menu_name);
elseif ($mtype=="suckerfish") :
	require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_suckerfish.php");
	$sidenav = false;
endif;

if ($template_width=="fluid") { 
	$template_width = "width: 100%;";
} else {
	$template_width = 'margin: 0 auto; width: ' . $template_width . 'px;';
}

// make sure sidenav is empty
if (strlen($sidenav) < 10) $sidenav = false;

//Are we in edit mode
$editmode = false;
if (  !empty( $_REQUEST['task'])  && $_REQUEST['task'] == 'edit'  ) :
	$editmode = true;
endif;
?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php if($mtype=="suckerfish") :?>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/<?php echo $mtype; ?>.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/<?php echo $tstyle; ?>.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/slimbox/slimbox.css" rel="stylesheet" type="text/css" />
<!--[if lte IE 6]>
<style type="text/css">
#fxTab {background: none; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='templates/<?php echo $mainframe->getTemplate(); ?>/images/<?php echo $tstyle; ?>/fx-tab.png', sizingMethod='scale', enabled='true');}
img { behavior: url(<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/iepngfix.htc); }
</style>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/mootools.v1.00.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/rt_tools_packed.js"></script>
<link rel="shortcut icon" href="<?php echo $mosConfig_live_site;?>/images/favicon.ico" />
<style type="text/css">
	td.left, td.right { width: <?php echo $side_width; ?>px;	}
	div.wrapper { <?php echo $template_width; ?>}
</style>
</head>
<body id="page_bg" class="<?php echo $fontstyle; ?>">
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/slimbox.js"></script>
	<div id="fxContainer">
		<div id="fxTarget">
			<div id="fxPadding" class="wrapper">
				<?php mosLoadModules('header', -2); ?>
			</div>
		</div>
		<div id="fxShadow"></div>
		<div id="fxTab">
			<a href="#" id="fxTrigger">&nbsp;</a>
		</div>
	</div>
	<div id="template" class="wrapper">
		<div id="header">
			<div class="rk-1">
				<div class="rk-2">
					<a href="<?php echo $mosConfig_live_site;?>" class="nounder"><img src="http://www.visitchristchurch.org/images/logo.jpg" style="border:0;" alt="" id="logo" /></a>
					<div id="top">
						<div class="padding">
							<?php mosLoadModules('top', -1); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="horiz-menu" class="<?php echo $mtype; ?>">
			<?php if($mtype == "splitmenu") : ?>
				<?php echo $topnav; ?>
			<?php elseif($mtype == "suckerfish") : ?>
				<?php mosShowListMenu($menu_name);	?>
			<?php else: ?>
      	<?php mosLoadModules('toolbar',-1); ?>
	    <?php endif; ?>	
		</div>
		<?php $section1count = mosCountModules('advert1') + mosCountModules('user1') + mosCountModules('user2'); ?>
		<?php if($section1count) : ?>
		<?php $section1width = 'w' . floor(99 / $section1count); ?>
		<?php $block2div = (mosCountModules('advert1') and (mosCountModules('user1') or mosCountModules('user2'))) ? " divider" : ""; ?>
		<?php $block3div = (mosCountModules('user2') and (mosCountModules('advert1') or mosCountModules('user1'))) ? " divider" : ""; ?>
		<div class="clr" id="section1">
			<table class="sections" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<?php if(mosCountModules('advert1')) : ?>
					<td class="section <?php echo $section1width ?>">
						<?php mosLoadModules('advert1', -2); ?>
					</td>
					<?php endif; ?>
					<?php if(mosCountModules('user1')) : ?>
					<td class="section <?php echo $section1width . $block2div; ?>">
						<?php mosLoadModules('user1', -2); ?>
					</td>
					<?php endif; ?>
					<?php if(mosCountModules('user2')) : ?>
					<td class="section <?php echo $section1width . $block3div; ?>">
						<?php mosLoadModules('user2', -2); ?>
					</td>
					<?php endif; ?>
				</tr>
			</table>
		</div>
		<?php endif; ?>
		<div class="clr" id="mainbody">
			<table class="mainbody" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<?php if(!$editmode and $orientation == 'left' and (mosCountModules('left') or $sidenav)) : ?>
					<td class="left">
						<div class="padding">
							<div id="vert-menu">
								<?php echo $sidenav; ?>
							</div>
							<?php mosLoadModules('left', -2); ?>
						</div>
					</td>
					<td class="divider"></td>
					<?php endif; ?>
					<td class="mainbody">
					<?php $mainbodycount = mosCountModules('user3') + mosCountModules('user4'); ?>
					<?php if($mainbodycount) : ?>
					<?php $mainbodywidth = 'w' . floor(99 / $mainbodycount); ?>
					<?php $mainbodydiv = (mosCountModules('user3') and mosCountModules('user4')) ? " divider" : ""; ?>
						<table class="sections" cellspacing="0" cellpadding="0">
							<tr valign="top">
								<?php if(mosCountModules('user3')) : ?>
								<td class="section <?php echo $mainbodywidth; ?>">
									<?php mosLoadModules('user3', -2); ?>
								</td>
								<?php endif; ?>
								<?php if(mosCountModules('user4')) : ?>
								<td class="section <?php echo $mainbodywidth . $mainbodydiv; ?>">
									<?php mosLoadModules('user4', -2); ?>
								</td>
								<?php endif; ?>
							</tr>
						</table>
					<?php endif; ?>
						<div class="padding">
							<?php if ($show_pathway == "true") : ?>
								<?php mosPathway(); ?>
							<?php endif; ?>
							<?php mosMainbody(); ?>
							<?php mosLoadModules('inset', -2); ?>
						</div>
					</td>
					<?php if(!$editmode and $orientation == 'right' and (mosCountModules('right') or $sidenav)) : ?>
					<td class="divider"></td>
					<td class="right">
						<div class="padding">
							<div id="vert-menu">
								<?php echo $sidenav; ?>
							</div>
							<?php mosLoadModules('right', -2); ?>
						</div>
					</td>
					<?php endif; ?>
				</tr>
			</table>
		</div>
		<div id="hdiv"></div>
		<?php $section2count = mosCountModules('advert2') + mosCountModules('user4') + mosCountModules('user6'); ?>
		<?php if($section2count) : ?>
		<?php $section2width = 'w' . floor(99 / $section2count); ?>
		<?php $block2div = (mosCountModules('advert2') and (mosCountModules('user5') or mosCountModules('user6'))) ? " divider" : ""; ?>
		<?php $block3div = (mosCountModules('user6') and (mosCountModules('advert2') or mosCountModules('user5'))) ? " divider" : ""; ?>
		<div class="clr" id="section2">
			<table class="sections" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<?php if(mosCountModules('advert2')) : ?>
					<td class="section <?php echo $section1width; ?>">
						<?php mosLoadModules('advert2', -2); ?>
					</td>
					<?php endif; ?>
					<?php if(mosCountModules('user5')) : ?>
					<td class="section <?php echo $section1width . $block2div; ?>">
						<?php mosLoadModules('user5', -2); ?>
					</td>
					<?php endif; ?>
					<?php if(mosCountModules('user6')) : ?>
					<td class="section <?php echo $section1width . $block3div; ?>">
						<?php mosLoadModules('user6', -2); ?>
					</td>
					<?php endif; ?>
				</tr>
			</table>
		</div>
		<?php endif; ?>
		<?php $section3count = mosCountModules('advert3') + mosCountModules('user7') + mosCountModules('user8'); ?>
		<?php if($section3count) : ?>
		<?php $section3width = 'w' . floor(99 / $section3count); ?>
		<?php $block2div = (mosCountModules('advert3') and (mosCountModules('user7') or mosCountModules('user8'))) ? " divider" : ""; ?>
		<?php $block3div = (mosCountModules('user8') and (mosCountModules('advert3') or mosCountModules('user7'))) ? " divider" : ""; ?>
		<div class="clr" id="section3">
			<table class="sections" cellspacing="0" cellpadding="0">
				<tr valign="top">
					<?php if(mosCountModules('advert3')) : ?>
					<td class="section <?php echo $section3width ?>">
						<?php mosLoadModules('advert3', -2); ?>
					</td>
					<?php endif; ?>
					<?php if(mosCountModules('user7')) : ?>
					<td class="section <?php echo $section3width . $block2div; ?>">
						<?php mosLoadModules('user7', -2); ?>
					</td>
					<?php endif; ?>
					<?php if(mosCountModules('user8')) : ?>
					<td class="section <?php echo $section3width . $block3div; ?>">
						<?php mosLoadModules('user8', -2); ?>
					</td>
					<?php endif; ?>
				</tr>
			</table>
		</div>
		<?php endif; ?>
		<div id="footer" class="clr">
			<div class="rk-1">
				<div class="rk-2">
					<div id="the-footer"><a href="mailto:webmaster@visitchristchurch.org">Webmaster</a> || <a href="http://www.joomla.org/" target="_blank">Designed with Joomla!</a> ||
											 <a href="http://visitchristchurch.org/index.php?option=com_content&amp;task=view&amp;id=90&amp;Itemid=51">Website Policy</a> || &copy; 2007-2008</div>
				</div>
			</div>
		</div>
	</div>
<?php mosLoadModules( 'debug', -1 );?>
</body>
</html>