<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_styleswitcher.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if ( $my->id ) :
	initEditor();
endif;
mosShowHead();

// *************************************************
// Change this variable blow to switch color-schemes
//
// If you have any issues, check out the forum at
// http://www.rockettheme.com
//
// *************************************************

$default_style = "style1";			// style1 | style2 | style3
$topmenu_name = "topmenu";			// topmenu by default, can be any Joomla menu name
$menu_name = "mainmenu";				// mainmenu by default, can be any Joomla menu name
$menu_type = "splitmenu2";				// splitmenu2 | splitmenu | suckerfish | module
$default_font = "default";      // smaller | default | larger
$show_pathway = "true";				// true | false
$search_text = "keywords...";	// text to use in search box
// *************************************************

require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_styleloader.php");

// menu initialization code
$topnav = false;
$cssmenu = false;
$tabmenu = false;

if ($menu_type=="splitmenu2") :
	require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_splitmenu2.php");
	
	if (isset($topmenu_name)) $tabmenu = rtShowHorizMenu($topmenu_name);
	$topnav = rtShowHorizMenu($menu_name);
	$subnav = rtSubMenu($menu_name, 1);
	$sidenav = rtSubMenu($menu_name, 2);
	$cssmenu = "splitmenu";
elseif ($menu_type=="splitmenu") :
	require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_splitmenu.php");
	if (isset($topmenu_name)) $tabmenu = rtShowHorizMenu($topmenu_name);
	$subnav = rtShowHorizMenu($menu_name);
	$sidenav = rtShowSubMenu($menu_name);
	$cssmenu = "splitmenu";
elseif ($menu_type=="suckerfish") :
	if (isset($topmenu_name)) {
		require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_splitmenu2.php");
		$tabmenu = rtShowHorizMenu($topmenu_name);
	}
	require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_suckerfish.php");
	$cssmenu = "suckerfish";
	$sidenav = false;
endif;

// make sure sidenav is empty
if (strlen($sidenav) < 10) $sidenav = false;

//Are we in edit mode
$editmode = false;
if (  !empty( $_REQUEST['task'])  && $_REQUEST['task'] == 'edit'  ) :
	$editmode = true;
endif;


// *************************************************
?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php if($cssmenu) :?>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/<?php echo $cssmenu; ?>.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/litebox/lightbox.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/<?php echo $tstyle; ?>.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if lte IE 6]>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<link rel="shortcut icon" href="<?php echo $mosConfig_live_site;?>/images/favicon.ico" />
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/prototype.lite.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/moo.fx.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/litebox-1.0.js"></script>
</head>
<body id="page-bg" class="<?php echo $fontstyle; ?> <?php echo $tstyle; ?> <?php echo $cssmenu; ?>">
	<div id="wrapper">
		<div id="mainbody">
			<div class="shad-1">
				<div class="shad-2">
					<div class="shad-3">
						<div id="header">
							<div id="search">
								<span class="searchtitle"><?php echo _SEARCH_TITLE; ?></span>
								<form action="index.php?option=com_search&amp;Itemid=5" method="get">
								<div class="search">
								  <input name="searchword" id="mod_search_searchword" maxlength="20" alt="search" class="inputbox" size="20" value="<?php echo $search_text; ?>" onblur="if(this.value=='') this.value='<?php echo $search_text; ?>';" onfocus="if(this.value=='<?php echo $search_text; ?>') this.value='';" type="text" />
								</div>
								  <input name="option" value="com_search" type="hidden" />
								  <input name="Itemid" value="5" type="hidden" />
								</form>
							</div>
							<div id="access">
								<div id="buttons">
									<a href="<?php echo $thisurl; ?>fontstyle=f-smaller" title="Decrease size" class="small"><span class="button">&nbsp;</span></a>
			  					<a href="<?php echo $thisurl; ?>fontstyle=f-default" title="Default size" class="default"><span class="button">&nbsp;</span></a>
									<a href="<?php echo $thisurl; ?>fontstyle=f-larger" title="Increase size" class="large"><span class="button">&nbsp;</span></a>
								</div>
							</div>
							<div id="tabmenu">
								<?php echo $tabmenu; ?>
							</div>
							<a href="<?php echo $mosConfig_live_site;?>" class="nounder"><img src="<?php echo $mosConfig_live_site;?>/images/blank.png" border="0" alt="" id="logo" /></a>
							<?php if($menu_type=="splitmenu2" and isset($topnav)) : ?>
							<div id="nav-main" class="splitmenu2">
								<?php echo $topnav; ?>
							</div>
							<?php else: ?>
							<div id="nav-main">
								<?php mosLoadModules('banner', -1); ?>
							</div>	
							<?php endif; ?>
							<div id="nav-sub">
								<?php if($menu_type == "splitmenu" or $menu_type=="splitmenu2") : ?>
									<?php echo $subnav; ?>
								<?php elseif($menu_type == "suckerfish") : ?>
									<?php mosShowListMenu($menu_name);	?>
								<?php else: ?>
					      	<?php mosLoadModules('toolbar',-1); ?>
						    <?php endif; ?>
							</div>
						</div>

					</div>
					<div id="content-bg">
						<div class="border-pad border-bottom">
							<div id="showcase">
								<div class="clr"></div>
								<?php if (mosCountModules('user1') or mosCountModules('user2') or mosCountModules('user3')) : ?>
								<?php $width = (99 / ((mosCountModules('user1')?1:0) + (mosCountModules('user2')?1:0) + (mosCountModules('user3')?1:0))); ?>
								<?php if(mosCountModules('user1')) : ?>
								<div class="usermodule" style="width:<?php echo $width; ?>%">
									<?php mosLoadModules('user1', -2); ?>
								</div>
								<?php endif; ?>
								<?php if(mosCountModules('user2')) : ?>
								<div class="usermodule" style="width:<?php echo $width; ?>%">
									<?php mosLoadModules('user2', -2); ?>
								</div>
								<?php endif; ?>
								<?php if(mosCountModules('user3')) : ?>
								<div class="usermodule" style="width:<?php echo $width; ?>%">
									<?php mosLoadModules('user3', -2); ?>
								</div>
								<?php endif; ?>
								<?php endif; ?>
								<div class="clr"></div>
							</div>
						</div>
						<div id="middlecolumn" class="border-pad">
							<?php $showcolumn = (mosCountModules('left') or $sidenav) ? 1 : 0; ?>
							<div id="fakecolumn1" class="sc_<?php echo $showcolumn; ?>">
								<div id="fakecolumn2">
									<?php if(mosCountModules('left') or $sidenav) : ?>
									<div id="leftcolumn">
										<div id="vert-menu">
											<?php echo $sidenav; ?>
										</div>
										<?php mosLoadModules('left', -2); ?>
									</div>
									<?php endif; ?>

										<div id="align-padding">
											<?php if(mosCountModules('inset')) : ?>
											<div id="inset">
												<?php mosLoadModules('inset', -2); ?>
											</div>
											<?php endif; ?>
											<?php $showcolumn = $editmode ? 0 : mosCountModules('right'); ?>
											<?php if(!$editmode and mosCountModules('right')) : ?>
											<div id="rightcolumn">
												<?php mosLoadModules('right', -3); ?>
											</div>
											<?php endif; ?>
											<div id="componentcolumn" class="sc_<?php echo $showcolumn; ?>">
												<div class="padding">
												<?php if ($show_pathway == "true") : ?>
												<?php mosPathway(); ?>
												<?php endif; ?>
												<?php mosMainbody(); ?>
												</div>
												<?php if (mosCountModules('user4') or mosCountModules('user5')) : ?>
												<?php $width =(99 / ((mosCountModules('user4')?1:0) + (mosCountModules('user5')?1:0))); ?>
												<?php if(mosCountModules('user4')) : ?>
												<div class="usermodule" style="width:<?php echo $width;  ?>%">
													<?php mosLoadModules('user4', -3); ?>
												</div>
												<?php endif; ?>
												<?php if(mosCountModules('user5')) : ?>
												<div class="usermodule" style="width:<?php echo $width; ?>%">
													<?php mosLoadModules('user5', -3); ?>
												</div>
												<?php endif; ?>
												<?php endif; ?>
											</div>
										</div>
										<div class="clr"></div>
									</div>
									<div class="clr"></div>
								</div>
								<div class="clr"></div>
								<?php if (mosCountModules('user6') or mosCountModules('user7') or mosCountModules('user8')) : ?>
								<div id="footer">
									<?php $width = (99 / ((mosCountModules('user6')?1:0) + (mosCountModules('user7')?1:0) + (mosCountModules('user8')?1:0))); ?>
									<?php if(mosCountModules('user6')) : ?>
									<div class="usermodule" style="width:<?php echo $width; ?>%">
										<?php mosLoadModules('user6', -2); ?>
									</div>
									<?php endif; ?>
									<?php if(mosCountModules('user7')) : ?>
									<div class="usermodule" style="width:<?php echo $width; ?>%">
										<?php mosLoadModules('user7', -2); ?>
									</div>
									<?php endif; ?>
									<?php if(mosCountModules('user8')) : ?>
									<div class="usermodule" style="width:<?php echo $width; ?>%">
										<?php mosLoadModules('user8', -2); ?>
									</div>
									<?php endif; ?>
									<div class="clr"></div>
								</div>
								<?php endif; ?>
							</div>
							<div class="clr"></div>
						</div>
					</div>
				</div>
			</div>
			<div id="bottom">
				<div class="shad-1">
					<div class="shad-2">
						<a href="http://www.rockettheme.com" title="RocketTheme Joomla Templates Club" class="nounder"><img src="<?php echo $mosConfig_live_site;?>/images/blank.png" border="0" alt="" id="rocket" /></a>
					</div>
				</div>
			</div>
		</div>

	
	
	


<?php mosLoadModules( 'debug', -1 );?>
</body>
</html>

