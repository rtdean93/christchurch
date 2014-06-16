<?php

/**
 * UI Block Context Paths Menu
 *
 * $paths			: array of main_menu and block paths
 * $paths_selected  : array
 */
function ui_paths_menu($paths) {

  // Sellect All link if URL is 'root'
  $all_selected = false;

  if(node_path() == '/') {
	
    $menu = '<li><a class="selected" href="/admin/structure/block/">All</a></li>';
    $all_selected = true;
  }
  else {
    $menu = '<li><a href="/admin/structure/block/">All</a></li>';
  }
  
  // Path links
  foreach($paths as $path => $title) {
  
    // select link if path is current
    if(node_path() == $path || alias_path() == html_entity_decode($path)) {
      $menu = $menu . '<li><a class="selected" href="/admin/structure/block/path/' . $path . '">' . $title . '</a></li>';
    }
    // deselect link if path is not current
    else {
      $menu = $menu . '<li><a href="/admin/structure/block/path/' . $path . '">' . $title . '</a></li>';
    }
  }
        
  return $menu;
}

/**
 * UI Selected Paths Dropdown Menu
 *
 * $sections		: array of main_menu paths/titles, and all block paths/titles
 * $block_key		: in the form 'module_delta'
 * $block_paths		: array of paths that this block is enabled for
 *
 * returns			: html dropdown menu for the block
 */
function ui_paths_dropdown($sections, $block_key, $block_paths) {
  
  // create default menu item
  $menu = '<option>All</option>';
    
  // create dropdown menu item for blocks with paths
  if($block_paths[0] != '') {
  
    // for each path/title item in the sections array
    foreach($sections as $path => $title) {
      
      // by default the selected status is false
      $selected = false;
    
      // compare the current section path with the most recent path of the block
      // and convert <front> path strings to &lt;front&gt
      if($path == htmlspecialchars(end($block_paths))) {
	
        $selected = true;
        // create selected dropdown item
        $menu = $menu . '<option selected="' . $path . '">' . $path . '</option>';
      }
      // or create normal dropdown item
      else {
        $menu = $menu . '<option value="' . $path . '">' . $path . '</option>';
      }
    }
  }
  // create dropdown menu for block with no paths
  else {
    foreach($sections as $path => $title) {
      $menu = $menu . '<option value="' . $path . '">' . $path . '</option>';  
    }
  }
  // wrap menu items inside select menu
  $menu ='<select name="blocks['  .  $block_key  .  '][path]">'.  $menu  .  '</select>' . ui_paths_list($block_paths) . '';
  return $menu;
}

/**
 * UI Unselected Paths List
 *
 * $paths			: array of this blocks paths
 * returns			: html list of paths in this block except the first (selected)
 */
function ui_paths_list($paths) {
  
  // if array more than one element (we remove first element anyway)
  if( count($paths) > 1 ) {
    
    // remove first element from array
    array_pop($paths);
  
    $html = '';
  
    foreach($paths as $key => $path) {
 
      $html = $html . '<li>' . htmlspecialchars($path) . '</li>'; // also converting internal "$lt;" to "<"
    }
    return '<span class="rest-links"><ul><li><em>As well as:</em></li>' . $html . '</ul></span>';
  }
  else return NULL;
}