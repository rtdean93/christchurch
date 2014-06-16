<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$cookie_prefix = "ts-";
$cookie_time = time()+31536000;
if (isset($_GET['scheme'])) {
	$scheme = $_GET['scheme'];
	$_SESSION[$cookie_prefix. 'scheme'] = $scheme;
	setcookie ($cookie_prefix. 'scheme', $scheme, $cookie_time, '/', false);
}
?>
