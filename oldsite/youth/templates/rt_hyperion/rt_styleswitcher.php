<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
if( !isset( $_SESSION ) ) { session_start(); }

$cookie_prefix = "hyperion-";
$cookie_time = time()+31536000;
$template_properties = array('fontstyle','fontfamily','tstyle','mtype');
$my_session = $mainframe->_session;

foreach ($template_properties as $tprop) {
    
    if (isset($_REQUEST[$tprop])) {
	    $$tprop = mosGetParam( $_REQUEST,$tprop);
    	$my_session->set($cookie_prefix. $tprop, $$tprop);
    	$my_session->update();
    	setcookie ($cookie_prefix. $tprop, $$tprop, $cookie_time, '/', false);    
    }
}

	//cludgy special case for prev/next
	if (isset($_REQUEST['pstyle'])) {
	  $tstyle = "style1";
	  if (isset($_SESSION[$cookie_prefix. 'tstyle'])) {
	    $tstyle = mosGetParam($_SESSION, $cookie_prefix. 'tstyle');
	  } elseif (isset($_COOKIE[$cookie_prefix. $tprop])) {
	  	$tstyle = mosGetParam($_COOKIE, $cookie_prefix. 'tstyle');
	  }
	  $stylenum = intval(substr($tstyle,5));
	  $stylenum = ($stylenum + (mosGetParam($_REQUEST,'pstyle') == "prev" ? -1 : +1))%12;
	  if ($stylenum == 0) $stylenum = 12;
	  $tstyle = "style$stylenum";
	  $my_session->set($cookie_prefix. 'tstyle', $tstyle);
	  $my_session->update();
	  setcookie ($cookie_prefix. 'tstyle', $tstyle, $cookie_time, '/', false);
	}

?>
