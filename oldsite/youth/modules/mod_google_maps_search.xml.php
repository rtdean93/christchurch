<?php
/**
* @version 1.0 $
* @package Google Maps Sidebar
* @copyright (C) 2005 David Pollack
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
 
/** ensure this file is being included by a parent file */
if (isset($_GET['query'])) $query = $_GET['query'];
if (isset($_GET['clat'])) $clat = $_GET['clat'];
if (isset($_GET['clng'])) $clng = $_GET['clng'];
if (isset($_GET['radius'])) $radius = $_GET['radius'];

$q = '&query='. urlencode($query) . '&latitude=' . $clat . '&longitude=' . $clng;
if(isset($radius)) $q .= '&radius=' . $radius;

$gm=fopen('http://api.local.yahoo.com/LocalSearchService/V3/localSearch?appid=maverickpl94' . $q ,'r');
$tmp=@fread($gm,30000);
fclose($gm);

$clength=strlen($tmp);
header("Content-Type: text/xml");
header ("Content-length: $clength");
echo $tmp;

?>
