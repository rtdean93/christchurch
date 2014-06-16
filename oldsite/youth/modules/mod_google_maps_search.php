<?php
/**
* @version 1.0 $
* @package Google Maps Sidebar
* @copyright (C) 2005 David Pollack
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/
 
/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


?>

<form action="javascript:localSearch(document.searchForm)" name="searchForm">
<input class="inputbox" type="text" size="15" name="query" />
<br />
<input type="button" onClick="localSearch(this.form);" value="Search" />
</form>


