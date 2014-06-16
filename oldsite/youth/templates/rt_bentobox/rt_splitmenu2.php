<?php
/**
* @version $Id: md_submenu.php,v 1.2 2005/04/28 04:56:49 rhuk Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

if (!defined( '_MOS_SUBMENU_MODULE' )) {
	/** ensure that functions are declared only once */
	define( '_MOS_SUBMENU_MODULE', 1 );
	$hilightid = -1;
	$hilightid2 = -1;
	$button_index = 0;
	

	/**
	* Utility function for writing a menu link
	*/
	function rtGetTabColor() {
		global $tab_color;
		return $tab_color;
	}
	

	function rtGetHilightid() {
		global $hilightid;
		return $hilightid;
	}
	
	function rtGetSubMenuLink( $mitem, $level, $hilight=false , $color_index=false) {
		global $Itemid, $mosConfig_live_site, $mainframe, $hilightid, $hilightid2, $menuname, $forcehilite, $button_index, $menu_buttons;
		$txt = '';
		$id = '';
		$img_class = '';
		$active = '';

		switch ($mitem->type) {
			case 'separator':
			case 'component_item_link':
			break;
			case 'content_item_link':
			$temp = split("&task=view&id=", $mitem->link);
			$mitem->link .= '&Itemid='. $mainframe->getItemid($temp[1]);
			break;
			case 'url':
			if ( eregi( 'index.php\?', $mitem->link ) ) {
				if ( !eregi( 'Itemid=', $mitem->link ) ) {
					$mitem->link .= '&Itemid='. $mitem->id;
				}
			}
			break;
			case 'content_typed':
			default:
			$mitem->link .= '&Itemid='. $mitem->id;
			break;
		}

		/*if (isset($menu_buttons)) {
			$img_class .= ' class="' . $menu_buttons[($button_index)%count($menu_buttons)] . '"';
			$button_index++;
		} else {
			$img_class .= ' class="b0"';
		}*/
		$button_index++;
		// Active Menu highlighting
		$current_itemid = trim( mosGetParam( $_REQUEST, 'Itemid', 0 ) );
		if ( !$current_itemid && !$hilight ) {
			//$id = '';
		} else if (($current_itemid == $mitem->id || $hilight)) {
			if ($level == 0) {
				$tab_color = $id;
				$menuname = $mitem->name;
				$hilightid = $mitem->id;
			} elseif ($level == 1) {
				$hilightid2 = $mitem->id;
				$menuname = $mitem->name;
			}
			$active = 'active_menu';
		} 
		
		$id = ' class="index-' . $button_index . ' ' . $active . '"';
		$mitem->link = ampReplace( $mitem->link );

		if ( strcasecmp( substr( $mitem->link,0,4 ), 'http' ) ) {
			$mitem->link = sefRelToAbs( $mitem->link );
		}

		switch ($mitem->browserNav) {
			// cases are slightly different
			case 1:
			// open in a new window
			$txt = '<li'. $id . '><a href="'. $mitem->link .'" target="_blank"'. $img_class . '>'. $mitem->name ."</a></li>\n";
			break;

			case 2:
			// open in a popup window
			$txt = "<li". $id . "><a href=\"#\" onclick=\"javascript: window.open('". $mitem->link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\"". $img_class . ">". $mitem->name ."</a></li>\n";
			break;

			case 3:
			// don't link it
			$txt = '<li'. $id . '><span class="seperator"'. $img_class . '>'. $mitem->name ."</span></li>\n";
			break;

			default:	// formerly case 2
			// open in parent window
			$txt = '<li'. $id . '><a href="'. $mitem->link .'"'. $img_class . '>'. $mitem->name ."</a></li>\n";
			break;
		}

		return $txt;
	}
	
	function rtSubMenu ( $menutype, $level ) {
		global $database, $my, $cur_template, $Itemid, $hilightid, $hilightid2, $forcehilite, $menuname, $button_index;
		global $mosConfig_absolute_path, $mosConfig_shownoauth;
		
		$button_index = 0;
		//turn off notices from undefined indexes
		error_reporting(0);
		
		if ($level==1) {
			$hilightid = $hilightid;
			$menuclass = "submenu";
		}
		if ($level==2) {
			$hilightid = $hilightid2;
			$menuclass = "sidenav";
		}
		
		if ($mosConfig_shownoauth) {
			$sql = "SELECT m.* FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1' AND parent=" . $hilightid
			. "\nORDER BY ordering";
		} else {
			$sql = "SELECT m.* FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1' AND access <= '$my->gid' AND parent=" . $hilightid
			. "\nORDER BY ordering";
		}
		$database->setQuery( $sql );

		$sublevel = $database->loadObjectList( 'id' );
		
		if ($level == 1) {
			//work out if this should be highlighted
			$sql = "SELECT m.* FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND parent>0 AND published='1'"; 
			$database->setQuery( $sql );
			$subrows = $database->loadObjectList( 'id' );
			$maxrecurse = 5;
			$childid = $Itemid;

			//this makes sure toplevel stays hilighted when submenu active
			while ($maxrecurse-- > 0) {
				$childid = getParentRow($subrows, $childid);
				if (isset($childid) && $childid >= 0 && $subrows[$childid]) {
					$hilightid2 = $childid;
				} else {
					break;	
				}
			}
		}
		

		
		$links = array();
		$subnav = '';
		foreach ($sublevel as $menuitem) {
			if ($menuitem->id == $hilightid2) {
				$hilight = true;	
			} else {
				$hilight = false;
			}
			$links[]  = rtGetSubMenuLink( $menuitem, $level, $hilight, true );
		}

		if (count( $links )) {
			if ($level==2) $subnav .= '<div class="moduletable"><h3>' . $menuname . ' menu</h3>';
			$subnav .= '<ul class="'. $menuclass .'">';
			foreach ($links as $link) {
				$subnav .= $link;
			}
			$subnav .= '</ul>';
			if ($level==2) $subnav .= '</div>';
			
		}
		return $subnav;
		
	}
	

	
	function rtShowHorizMenu(  $menutype) {
		global $database, $my, $cur_template, $Itemid, $hilightid, $forcehilite, $button_index;
		global $mosConfig_absolute_path, $mosConfig_shownoauth;
		
		$topnav = '';
		
		$button_index = 0;

		if ($mosConfig_shownoauth) {
			$sql = "SELECT m.* FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1' AND parent=0"
			. "\nORDER BY ordering";
		} else {
			$sql = "SELECT m.* FROM #__menu AS m"
			. "\nWHERE menutype='". $menutype ."' AND published='1' AND access <= '$my->gid' AND parent=0"
			. "\nORDER BY ordering";
		}
		$database->setQuery( $sql );

		$topmenu = $database->loadObjectList( 'id' );
		
		//work out if this should be highlighted
		$sql = "SELECT m.* FROM #__menu AS m"
		. "\nWHERE menutype='". $menutype ."' AND published='1'"; 
		$database->setQuery( $sql );
		$subrows = $database->loadObjectList( 'id' );
		$maxrecurse = 5;
		$parentid = $Itemid;

		//this makes sure toplevel stays hilighted when submenu active
		while ($maxrecurse-- > 0) {
			$parentid = getParentRow($subrows, $parentid);
			if (isset($parentid) && $parentid >= 0 && $subrows[$parentid]) {
				$hilightid = $parentid;
			} else {
				break;	
			}
		}
				
		$links = array();
		$i = 0;
		foreach ($topmenu as $menuitem) {
			$hilight = false;
			if (isset($forcehilite) && $forcehilite && $forcehilite == $i++) {
					$hilight = true;
			} else {
				if ($menuitem->id == $hilightid) {
					$hilight = true;	
				}
			}
			$links[] = rtGetSubMenuLink( $menuitem, 0, $hilight, true );
		}
		



		$menuclass = 'mainlevel';
		if (count( $links )) {
	
			$topnav .= '<ul class="'. $menuclass .'">';
			foreach ($links as $link) {
				$topnav .= $link;
			}
			$topnav .= '</ul>';
			
		}
		return $topnav;
	}
	
	function getParentRow($rows, $id) {
		if (isset($rows[$id]) && $rows[$id]) {
			if($rows[$id]->parent > 0) {
				return $rows[$id]->parent;
			}	
		}
		return -1;
	}
	
	function beginsWith( $str, $sub ) {
   return ( substr( $str, 0, strlen( $sub )-1 ) == $sub );
	}

}

?>
