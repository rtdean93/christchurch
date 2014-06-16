<?php
defined( '_VALID_MOS' ) or die( 'Restricted access' );
// ISO stuff
$iso = explode( '=', _ISO );
// xml prolog
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php mosShowHead(); ?>
<?php
if ( $my->id ) {
	initEditor();
}
$user1=0;
$user2=0;
$left=0;
$right=0;
$front=0;


if(mosCountModules( 'user1' )){
	$user1 = 1;
}

if(mosCountModules( 'user2' )){
	$user2 = 1;
}

// left column
if ( mosCountModules( 'left' )){
	$left = 1;
}

if($_REQUEST['option'] =="com_frontpage"){
	$front = 1;
}

// right column
if ( mosCountModules( 'right' ) and ( empty( $_REQUEST['task'] ) || $_REQUEST['task'] != 'edit' ) ) {
	$right = 1;
}
?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<link href="<?php echo $mosConfig_live_site;?>/templates/simplify_blue/css/template_css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="main">
	<div id="kehys">
    	<div id="boxes">
        	<div id="header">
            	<div id="logo"><a href="<?php echo $mosConfig_live_site;?>" title="<?php echo $mosConfig_sitename; ?>"><img alt="<?php echo $mosConfig_sitename; ?>" src="<?php echo $mosConfig_live_site;?>/images//picture%205.png" width="232" height="33" border="0" style="margin: 0px 0px 13px 18px;" /></a></div>
                <div id="othernavi"><?php mosLoadModules ( 'user3', -1 ); ?></div>
            </div>
            <div id="mainnavi">
				<div id="navi"><?php mosLoadModules ( 'user5', -1 ); ?></div>
				<div id="search"><?php mosLoadModules ( 'user4', -1); ?></div>
            </div>
            <div id="crumbs"><?php mosPathWay(); ?></div>
            <div id="mainbox">
            <?php if($front==1){ // first page ?>
            	<div id="left"><?php mosLoadModules ( 'left', -2 ); ?></div>
                <div id="frontpage"><img src="<?php echo $mosConfig_live_site;?>/images//picture%206.png" width="563" height="313" alt="<?php echo $mosConfig_sitename; ?>" />
				<?php 
				
				/* if($user1==1){?>
                <div id="user1">
                <div id="frontleft"><?php mosLoadModules ( 'user1', -2); ?></div>	
                <div id="frontright"><?php mosLoadModules ( 'user2', -2); ?></div>
                </div>
                <?php } */ ?>
                <div id="mainbody">
				<?php mosMainBody(); ?></div>
                </div>
            <?php }else{ // other pages 
				if($left==1 && $right!=1){ ?>    
            	<div id="left"><?php mosLoadModules ( 'left', -2 ); ?></div>
                <div id="story1"><?php mosMainBody(); ?></div>
                <?php }else if($right==1 && $left==1){ // three columns ?>          
            	<div id="left"><?php mosLoadModules ( 'left', -2 ); ?></div>
                <div id="story"><?php mosMainBody(); ?></div>
                <div id="right"><?php mosLoadModules ( 'right', -2 ); ?></div>
                <?php }else if($left!=1 && $right==1){ ?>
                <div id="story2"><?php mosMainBody(); ?></div>
                <div id="right"><?php mosLoadModules ( 'right', -2 ); ?></div>
                <?php }else{ ?>
                <div id="story3"><?php mosMainBody(); ?></div>
        	<?php } 
			 }?>
            </div>
            <div id="footer">
            	<div id="footerleft">
                <?php if($user6){ 
					mosLoadModules ( 'user6', -1 );
				}else{
					include_once( $GLOBALS['mosConfig_absolute_path'] . '/includes/footer.php' );
				} ?>
                </div>
                <div id="footerright"><a href="http://www.estime.fi/hakukoneoptimointi" target="_blank" class="footer" title="Joomla! template">hakukoneoptimointi</a> LinkAd by Estime Templates</div>
            </div>
        </div>
    </div>
</div>
<?php mosLoadModules( 'debug', -1 );?>
</body>
</html>