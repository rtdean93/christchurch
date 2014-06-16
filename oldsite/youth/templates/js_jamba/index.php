<?php defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); $style = ""; 
?>
<?php require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/styleswitcher.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="<?php echo _LANGUAGE; ?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<?php 
if ( $my->id ) {
	initEditor();
}
mosShowHead();?>
<?php require_once($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/js_template_config.php");?>
<?php require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/themesaver.php");?>
<?php
$user_positions = array('user4','user5');
$user45width = getSplit($user_positions, 1);
$bottom_user_positions = array('user6','user7');
$user67width = getSplit($bottom_user_positions, 1);
$style = getColumns();
?>

<link rel="stylesheet" href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate();?>/css/nav.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate();?>/css/template_css.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate();?>/css/<?php echo $scheme;?>.css" media="screen" type="text/css" />

<!--[if IE]>
	<link rel="stylesheet" href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate();?>/css/ie.css" media="screen" type="text/css" />
<![endif]-->


</head>
<body>
<div id="header-wrap">
	<div id="header_<?php echo $headerstyle; ?>">
			<div id="headermod"><?php mosLoadModules ( 'newsflash',-2 ); ?></div>
				<h1>
				<?php if ($headerstyle=='graphic') { ?>
				<a href="<?php echo $mosConfig_live_site;?>" title="<?php echo $headline; ?>"><img src="http://visitchristchurch.org/youth/images//picture1.png" title="<?php echo $headline; ?>" alt="<?php echo $slogan; ?>"/></a>
				<?php } ?>
				<?php if ($headerstyle=='text') { ?>
				<a href="<?php echo $mosConfig_live_site;?>" title="<?php echo $headline; ?>"><?php echo $headline;?></a>
				<?php } ?>
				</h1>
				<h2><?php echo $slogan;?></h2>	
			</div>
		</div>
<div class="menubar">
	<div id="navmenu">
	<!--[if IE]>
	<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate();?>/js/barmenu.js"></script>
	<![endif]-->
		<?php mosLoadModules ( 'top',-1 ); ?>
	</div>
</div>
	<div id="main-wrapper">		
		<div class="main-top<?php echo $style; ?>"></div>
			<div id="mainbody<?php echo $style; ?>">
				<?php if (mosCountModules('left')) { ?>
					
					<div id="leftcol">
						<div class="left-inside">
							<?php mosLoadModules ( 'left',-3 ); ?>
						</div>
					</div>
					
				<?php } ?>
				<?php if (mosCountModules('right')) { ?>
					<div id="rightcol">
						<div class="right-inside">
							<?php mosLoadModules ( 'right',-3 ); ?>
						</div>
					</div>
				<?php } ?>
				<div class="main<?php echo $style; ?>">
						<table border="0" cellspacing="0" cellpadding="0">
						  <tr>
						    <td valign="top">
								<?php if (mosCountModules ('user4') || mosCountModules ('user5') ) { ?>
										<div id="showcase">
										<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
										<tr>
										<?php if(mosCountModules('user4')) : ?>
										<td style="width: <?php echo $user45width; ?>;padding:5px; vertical-align:top;">
										<?php mosLoadModules ('user4', -3);?>
										</td>
										<?php endif; ?>
										<?php if(mosCountModules('user5')) : ?>
										<td style="width: <?php echo $user45width; ?>;padding:5px; vertical-align:top;">
										<?php mosLoadModules ('user5', -3);?>
										</td>
										<?php endif; ?>
										</tr>
										</table>
										</div>
									<?php } ?>
									
							<?php if(mosCountModules('banner')) : ?>
								<div id="banner"><?php mosLoadModules ('banner', -1);?></div>
							<?php endif; ?>
							
							<?php if ($showpathway) { ?>
							<div id="pathway"><?php mosPathWay(); ?></div>
							<?php } ?>
							
						<?php mosMainBody(); ?>
						</td>
						  </tr>
						</table>
				<?php if (mosCountModules ('user6') || mosCountModules ('user7') ) { ?>
						<table border="0" cellpadding="0" cellspacing="0" align="center" width="100%">
						<tr>
						<?php if(mosCountModules('user6')) : ?>
						<td style="width: <?php echo $user67width; ?>;padding:5px; vertical-align:top;">
						<?php mosLoadModules ('user6', -3);?>
						</td>
						<?php endif; ?>
						<?php if(mosCountModules('user7')) : ?>
						<td style="width: <?php echo $user67width; ?>;padding:5px; vertical-align:top;">
						<?php mosLoadModules ('user7', -3);?>
						</td>
						<?php endif; ?>
						</tr>
						</table>
				<?php } ?>
				<div class="clear"></div>
					</div>
			</div>
		<div class="bottom<?php echo $style; ?>"></div>
		
		<?php if (mosCountModules ('footer')) { ?>
			
		<div class="main-top-wide"></div>
		<div class="mainbody-wide">
			<div class="footer">
				<?php mosLoadModules ('footer', -1);?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="bottom-wide">&nbsp;</div>
		<?php } ?><?php echo $jstpl;?>
	</div>
</body>
</html>