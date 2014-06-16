<?php
/*
// "Simple RSS Feed Reader" Module for Joomla! 1.0.x - Version 1.1
// License: http://www.gnu.org/copyleft/gpl.html
// Authors: Fotis Evangelou - George Chouliaras
// Copyright (c) 2006 - 2007 JoomlaWorks.gr - http://www.joomlaworks.gr
// Project page at http://www.joomlaworks.gr - Demos at http://demo.joomlaworks.gr
// ***Last update: January 31st, 2007***
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_offset, $mosConfig_live_site, $mosConfig_locale, $mainframe;

// module parameters
$moduleclass_sfx = $params->get( 'moduleclass_sfx', '' );
$srfr_cache			= intval($params->get( 'srfr_cache', 30 ));
$srfr_timeout		= intval($params->get( 'srfr_timeout', 10 ));
$srfr_fitems		= intval($params->get( 'srfr_fitems', 5 ));
$srfr_totalitems	= intval($params->get( 'srfr_totalitems' ));
$srfr_ftimezone		= intval($params->get( 'srfr_ftimezone', 0 ) );
$srfr_fname			= intval($params->get( 'srfr_fname', 1 ) );
$srfr_fititle		= intval($params->get( 'srfr_fititle', 1 ) );
$srfr_fitime		= intval($params->get( 'srfr_fitime', 1 ) );
$srfr_fidesc		= intval($params->get( 'srfr_fidesc', 1 ) );
$srfr_url01	= $params->get( 'srfr_url01', 'http://demo.joomlaworks.gr/index2.php?option=com_rss&feed=RSS2.0&no_html=1' );
$srfr_url02 = $params->get( 'srfr_url02', '' );
$srfr_url03 = $params->get( 'srfr_url03', '' );
$srfr_url04 = $params->get( 'srfr_url04', '' );
$srfr_url05 = $params->get( 'srfr_url05', '' );
$srfr_url06 = $params->get( 'srfr_url06', '' );
$srfr_url07 = $params->get( 'srfr_url07', '' );
$srfr_url08 = $params->get( 'srfr_url08', '' );
$srfr_url09 = $params->get( 'srfr_url09', '' );
$srfr_url10 = $params->get( 'srfr_url10', '' );
$srfr_url11 = $params->get( 'srfr_url11', '' );
$srfr_url12 = $params->get( 'srfr_url12', '' );
$srfr_url13 = $params->get( 'srfr_url13', '' );
$srfr_url14 = $params->get( 'srfr_url14', '' );
$srfr_url15 = $params->get( 'srfr_url15', '' );
$srfr_url16 = $params->get( 'srfr_url16', '' );
$srfr_url17 = $params->get( 'srfr_url17', '' );
$srfr_url18 = $params->get( 'srfr_url18', '' );
$srfr_url19 = $params->get( 'srfr_url19', '' );
$srfr_url20 = $params->get( 'srfr_url20', '' );

// SimplePie Setup
require_once($mosConfig_live_site.'/modules/mod_jw_srfr/simplepie.inc');

// Feed list
$myfeeds = array();
$myfeeds[] = ''.$srfr_url01.'';
if ($srfr_url02) {$myfeeds[] = ''.$srfr_url02.'';}
if ($srfr_url03) {$myfeeds[] = ''.$srfr_url03.'';}
if ($srfr_url04) {$myfeeds[] = ''.$srfr_url04.'';}
if ($srfr_url05) {$myfeeds[] = ''.$srfr_url05.'';}
if ($srfr_url06) {$myfeeds[] = ''.$srfr_url06.'';}
if ($srfr_url07) {$myfeeds[] = ''.$srfr_url07.'';}
if ($srfr_url08) {$myfeeds[] = ''.$srfr_url08.'';}
if ($srfr_url09) {$myfeeds[] = ''.$srfr_url09.'';}
if ($srfr_url10) {$myfeeds[] = ''.$srfr_url10.'';}
if ($srfr_url11) {$myfeeds[] = ''.$srfr_url11.'';}
if ($srfr_url12) {$myfeeds[] = ''.$srfr_url12.'';}
if ($srfr_url13) {$myfeeds[] = ''.$srfr_url13.'';}
if ($srfr_url14) {$myfeeds[] = ''.$srfr_url14.'';}
if ($srfr_url15) {$myfeeds[] = ''.$srfr_url15.'';}
if ($srfr_url16) {$myfeeds[] = ''.$srfr_url16.'';}
if ($srfr_url17) {$myfeeds[] = ''.$srfr_url17.'';}
if ($srfr_url18) {$myfeeds[] = ''.$srfr_url18.'';}
if ($srfr_url19) {$myfeeds[] = ''.$srfr_url19.'';}
if ($srfr_url20) {$myfeeds[] = ''.$srfr_url20.'';}

// This will be used to store and sort the feeds by date
$multifeeds = array();
// Go through each feed in the above array, parse it, and add specific chunks of data to the $multifeed array
foreach($myfeeds as $url) {
	// Set your own configuration options as you see fit.
	$feed = new SimplePie();
	$feed->feed_url($url);
	
	// v1.1
	$feed->set_timeout($srfr_timeout);
	
	// check if the cache folder is writable, if not disable caching
	if(file_exists($mosConfig_live_site.'/cache')) {
		$feed->cache_location($mosConfig_live_site.'/cache');
		$feed->caching = true;
	}
	else {
	$feed->caching = false;
	}	
	$feed->cache_max_minutes($srfr_cache);
	$feed->replace_headers(true);
	$feed->init();
	
	// v1.1
	// ***** if feed is empty, go to next feed
    if ($feed->get_item_quantity() == 0) $myfeeds ++;
    // ***** else continue
    else {
    // ***** 
	
	// We're going to loop through the items in the feed; starting at the beginning, and returning a max of 10 items.
	foreach ($feed->get_items(0, $srfr_fitems) as $item) {
		/*
		 * We're going to take data from the $item and put it together into a single string, delimiting each chunk 
		 * with five colons (you can delimit however you want, but it's unlikely that you'll come across five 
		 * consecutive colons in the content of a feed).
		 */
		// Start with a blank slate
		$data = '';
		// We're going to start with milliseconds since Unix epoch (this is the datestamp that we'll sort by)
		$data .= $item->get_date('U') . ':::::';
		
		// v1.1
        // ***** if item's year <= 2000, go to next post
        if (gmdate('Y',$item->get_date('U')) <= '2000') {
            $data = '';
            $item ++; }
        // ***** else, continue
        else {
        // ***** 		

		// Local timezone
		if($srfr_ftimezone == 0) {
			$data .= (date('G')+$mosConfig_offset).date(':i - j.m.Y', $item->get_date('U')) . ':::::';
		}
		// GMT timezone
		if($srfr_ftimezone == 1) {
			$data .= gmdate('G:i (\G\M\T) - j.m.Y', $item->get_date('U')) . ':::::';
		}		
		// Get the title of the posting
		$data .= $item->get_title() . ':::::';
		// Get the permalink for the posting
		$data .= $item->get_permalink() . ':::::';
		// Get the description content for the posting
		$data .= $item->get_description() . ':::::';
		// Besides $item data, we'll also get the title of the $feed we're pulling this from
		$data .= $feed->get_feed_title() . ':::::';
		// Lastly, we'll get the permalink to the $feed that we're pulling this from.
		// Since it's the last one, we don't need to add the delimiter to the end.
		$data .= $feed->get_feed_link();
		
		//v1.1
		}
		
		// Place this whole thing into the next available spot in the $multifeeds array.
		$multifeeds[] = $data;
		
		//v1.1
		}
	}
	
	// We're done with $feed for this round of the loop, so we'll wipe it out so we can loop back and start fresh.
	unset($feed);
}
// When we're done looping through the feeds and collecting our data, we'll reverse sort all of the feeds by seconds since Unix epoch (newest to oldest)
rsort($multifeeds);

?>

<!-- JW "Simple RSS Feed Reader" Module (v1.1) starts here -->
<link rel="stylesheet" type="text/css" href="modules/mod_jw_srfr/mod_jw_srfr.css" />
<div id="jw_srfr_container<?php echo $moduleclass_sfx; ?>">
  <ul class="jw_srfr">
    <?php
	// Go through each and every feed in $multifeeds
	if($srfr_totalitems) { $i=0; }
	foreach ($multifeeds as $posting) {
		// Break it all back into chunks
		if($srfr_totalitems) { if($i>=$srfr_totalitems) continue; }
		$data = explode(':::::', $posting);
	?>
    <li>
      <!-- feed item title -->
      <?php if($srfr_fititle) { ?>
      <a class="srfr_feeditemtitle" target="_blank" href="<?php echo $data[3]; ?>"><?php echo $data[2]; ?></a>
      <?php } ?>
      <!-- feed item timestamp -->
      <?php if($srfr_fitime) { ?>
      <span class="srfr_feeditemtitle"><?php echo $data[1]; ?></span>
      <?php } ?>
      <!-- feed name -->
      <?php if($srfr_fname) { ?>
      <a class="srfr_feedname" target="_blank" href="<?php echo $data[6]; ?>"><?php echo $data[5]; ?></a>
      <?php } ?>
      <!-- feed item description -->
      <?php if($srfr_fidesc) { ?>
      <p class="srfr_feeditemdesc"><?php echo $data[4]; ?></p>
      <?php } ?>
    </li>
    <?php 
		if($srfr_totalitems) { $i++; }
	}
	?>
  </ul>
</div>
<!-- JW "Simple RSS Feed Reader" Module (v1.1) ends here -->
