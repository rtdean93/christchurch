<?php
/**
* @version $Id: mod_login.php 4055 2006-06-19 20:00:59Z stingrey $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $mosConfig_frontend_login;

if ( $mosConfig_frontend_login != NULL && ($mosConfig_frontend_login === 0 || $mosConfig_frontend_login === '0')) {
	return;
}

// url of current page that user will be returned to after login
$url = mosGetParam( $_SERVER, 'REQUEST_URI', null );
// if return link does not contain https:// & http:// and to url
if ( strpos($url, 'http:') !== 0 && strpos($url, 'https:') !== 0 ) {
	// check to see if url has a starting slash
	if (strpos($url, '/') !== 0) {
		// adding starting slash to url
		$url = '/'. $url;
	}
	
	$url = mosGetParam( $_SERVER, 'HTTP_HOST', null ) . $url;

	// check if link is https://
	if ( isset( $_SERVER['HTTPS'] ) && ( !empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) ) {
		$return = 'https://'. $url;
	} else {
	// normal http:// link
		$return = 'http://'. $url;
	}
} else {
	$return = $url;
}
// converts & to &amp; for xtml compliance
$return 				= str_replace( '&', '&amp;', $return );

$registration_enabled 	= $mainframe->getCfg( 'allowUserRegistration' );
$message_login 			= $params->def( 'login_message', 	0 );
$message_logout 		= $params->def( 'logout_message', 	0 );
$login 					= $params->def( 'login', 			$return );
$logout 				= $params->def( 'logout', 			$return );
$name 					= $params->def( 'name', 			1 );
$greeting 				= $params->def( 'greeting', 		1 );
$pretext 				= $params->get( 'pretext' );
$posttext 				= $params->get( 'posttext' );
$showforgotpw		= $params->get( 'showforgotpw', 1);
$autoremember		= $params->get( 'autoremember', 1);

if ( $my->id ) {
// Logout output
// ie HTML when already logged in and trying to logout
	if ( $name ) {
		$name = $my->name;
	} else {
		$name = $my->username;
	}	
	?>
	<form action="<?php echo sefRelToAbs( 'index.php?option=logout' ); ?>" method="post" name="logoutForm">	
	<div class="loginelement">
	<?php
	if ( $greeting ) {
		echo _HI;
		echo $name;
	}
	?>
	</div>

	<a href="javascript:document.logoutForm.submit();"><span class="logoutsubmit"><span><?php echo _BUTTON_LOGOUT; ?></span></span></a>

	<input type="hidden" name="option" value="logout" />
	<input type="hidden" name="op2" value="logout" />
	<input type="hidden" name="lang" value="<?php echo $mosConfig_lang; ?>" />
	<input type="hidden" name="return" value="<?php echo sefRelToAbs( $logout ); ?>" />
	<input type="hidden" name="message" value="<?php echo $message_logout; ?>" />
	</form>
	<?php
} else {
// Login output
// ie HTML when not logged in and trying to login
	// used for spoof hardening
	$validate = josSpoofValue(1);
	?>
	<form action="<?php echo sefRelToAbs( 'index.php' ); ?>" method="post" name="loginForm" >
	<?php
	echo $pretext;
	?>
	
	<div class="loginelement">
		<label for="mod_login_username"><?php echo _USERNAME; ?></label>
		<input name="username" id="mod_login_username" type="text" class="inputbox" alt="username" size="10" />
	</div>
	<div class="loginelement">
		<label for="mod_login_password"><?php echo _PASSWORD; ?></label>
		<input type="password" id="mod_login_password" name="passwd" class="inputbox" size="10" alt="password" />
	</div>
	<?php if ($autoremember) { ?>
	<input type="hidden" name="remember" value="yes" />
	<?php } else { ?>
	<div class="loginelement">
		<label for="mod_login_remember"><?php echo _REMEMBER_ME; ?></label>
		<input type="checkbox" name="remember" id="mod_login_remember" class="inputbox" value="yes" alt="Remember Me" />	
	</div>
	<?php } ?>
	<a href="javascript:document.loginForm.submit();" class="nounder"><span class="loginsubmit"><span><?php echo _BUTTON_LOGIN; ?></span></span></a>
	<?php if ($showforgotpw) { ?>
	<div class="loginelement">
		<a href="<?php echo sefRelToAbs( 'index.php?option=com_registration&amp;task=lostPassword' ); ?>"><?php echo _LOST_PASSWORD; ?></a>
	</div>
	<?php } ?>
	<?php	if ( $registration_enabled ) { ?>
	<div class="loginelement">
		<?php echo _NO_ACCOUNT; ?>
				<a href="<?php echo sefRelToAbs( 'index.php?option=com_registration&amp;task=register' ); ?>"><?php echo _CREATE_ACCOUNT; ?></a>
	</div>
	<?php	}	?>
	<?php
	echo $posttext;
	?>
	<div class="clr"></div>
	<input type="hidden" name="option" value="login" />
	<input type="hidden" name="op2" value="login" />
	<input type="hidden" name="lang" value="<?php echo $mosConfig_lang; ?>" />
	<input type="hidden" name="return" value="<?php echo sefRelToAbs( $login ); ?>" />
	<input type="hidden" name="message" value="<?php echo $message_login; ?>" />
	<input type="hidden" name="<?php echo $validate; ?>" value="1" />
	</form>
	<?php
}
?>