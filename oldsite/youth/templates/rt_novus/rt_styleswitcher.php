<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$cookie_prefix = "nbus-";
$cookie_time = time()+31536000;
if (isset($_GET['fontstyle'])) {
    $font = mosGetParam( $_REQUEST, 'fontstyle' );
	$_SESSION[$cookie_prefix. 'fontstyle'] = $font;
	setcookie ($cookie_prefix. 'fontstyle', $font, $cookie_time, '/', false);
}
if (isset($_GET['mtype'])) {
	$mtype = mosGetParam( $_REQUEST,'mtype');
	$_SESSION[$cookie_prefix. 'mtype'] = $mtype;
	setcookie ($cookie_prefix. 'mtype', $mtype, $cookie_time, '/', false);
}
?>
