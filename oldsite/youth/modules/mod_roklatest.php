<?php
/**
* @package RokLatest
* @copyright Copyright (C) 2007 RocketWerx. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $mosConfig_offset, $mosConfig_live_site, $mainframe;

$type 		= intval( $params->get( 'type', 1 ) );
$count 		= intval( $params->get( 'count', 5 ) );
$catid 		= trim( $params->get( 'catid' ) );
$secid 		= trim( $params->get( 'secid' ) );
$start_open = trim( $params->get( 'start_open', 0) );
$start_transition = trim( $params->get( 'start_transition', 1) );
$transparent_slide = trim( $params->get( 'transparent_slide', 1) );
$moo_duration     = trim( $params->get("moo_duration", "200") );
$moo_transition   = trim( $params->get("moo_transition", "Linear") );
$show_front	= trim( $params->get( 'show_front', 1 ) );
$length = intval($params->get( 'preview_count', 200) );
$title_as_link	= trim( $params->get( 'ntlink', 0 ) );
$show_date		= trim( $params->get( 'ndate', 0 ) );

$jslib 				= $params->get( 'jslib', 0);

$now 		= date( 'Y-m-d H:i:s', time() );
$access 	= !$mainframe->getCfg( 'shownoauth' );
$nullDate 	= $database->getNullDate();



if (!function_exists('prepareContent')) {

	function prepareContent( $text, $length=200 ) {
		// strips tags won't remove the actual jscript
		$text = preg_replace( "'<script[^>]*>.*?</script>'si", "", $text );
		$text = preg_replace( '/{.+?}/', '', $text);
		// replace line breaking tags with whitespace
		$text = preg_replace( "'<(br[^/>]*?/|hr[^/>]*?/|/(div|h[1-6]|li|p|td))>'si", ' ', $text );
		$text = substr(strip_tags( $text ), 0, $length) ;
		return $text;
	}
}

// select between Content Items, Static Content or both
switch ( $type ) {
	case 2:
	//Static Content only
		$query = "SELECT a.id, a.title, a.introtext"
		. "\n FROM #__content AS a"
		. "\n WHERE ( a.state = 1 AND a.sectionid = 0 )"
		. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
		. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
		. ( $access ? "\n AND a.access <= $my->gid" : '' )
		. "\n ORDER BY a.created DESC"
		. "\n LIMIT $count"
		;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		break;

	case 3:
	//Both
		$query = "SELECT a.id, a.title, a.introtext, a.sectionid, a.catid, cc.access AS cat_access, s.access AS sec_access, cc.published AS cat_state, s.published AS sec_state"
		. "\n FROM #__content AS a"
		. "\n LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id"
		. "\n LEFT JOIN #__categories AS cc ON cc.id = a.catid"
		. "\n LEFT JOIN #__sections AS s ON s.id = a.sectionid"
		. "\n WHERE a.state = 1"
		. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
		. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
		. ( $access ? "\n AND a.access <= $my->gid" : '' )
		. ( $catid ? "\n AND ( a.catid IN ( $catid ) )" : '' )
		. ( $secid ? "\n AND ( a.sectionid IN ( $secid ) )" : '' )
		. ( $show_front == '0' ? "\n AND f.content_id IS NULL" : '' )
		. "\n ORDER BY a.created DESC"
		. "\n LIMIT $count"
		;
		$database->setQuery( $query );
		$temp = $database->loadObjectList();

		$rows = array();
		if (count($temp)) {
			foreach ($temp as $row ) {
				if (($row->cat_state == 1 || $row->cat_state == '') &&  ($row->sec_state == 1 || $row->sec_state == '') &&  ($row->cat_access <= $my->gid || $row->cat_access == '' || !$access) &&  ($row->sec_access <= $my->gid || $row->sec_access == '' || !$access)) {
					$rows[] = $row;
				}
			}
		}
		unset($temp);
		break;

	case 1:
	default:
	//Content Items only - Add a.created by FinLy Arifin
		$query = "SELECT a.id, a.title, a.introtext, a.sectionid, a.catid, a.created"
		. "\n FROM #__content AS a"
		. "\n LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id"
		. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
		. "\n INNER JOIN #__sections AS s ON s.id = a.sectionid"
		. "\n WHERE ( a.state = 1 AND a.sectionid > 0 )"
		. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
		. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
		. ( $access ? "\n AND a.access <= $my->gid AND cc.access <= $my->gid AND s.access <= $my->gid" : '' )
		. ( $catid ? "\n AND ( a.catid IN ( $catid ) )" : '' )
		. ( $secid ? "\n AND ( a.sectionid IN ( $secid ) )" : '' )
		. ( $show_front == '0' ? "\n AND f.content_id IS NULL" : '' )
		. "\n AND s.published = 1"
		. "\n AND cc.published = 1"
		. "\n ORDER BY a.created DESC"
		. "\n LIMIT $count"
		;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		break;
}


// needed to reduce queries used by getItemid for Content Items
if ( ( $type == 1 ) || ( $type == 3 ) ) {
	$bs 	= $mainframe->getBlogSectionCount();
	$bc 	= $mainframe->getBlogCategoryCount();
	$gbs 	= $mainframe->getGlobalBlogSectionCount();
}

// Output
if ($jslib == 1) {
	echo "<script src=\"modules/roklatest/mootools.js\" type=\"text/javascript\"></script>\n";
}
?>
<script type="text/javascript">
	window.addEvent('domready', function(){
		new Accordion('h3.atStart', 'div.atStart', {
			opacity: <?php echo($transparent_slide==1?"true":"false"); ?>,
			duration: <?php echo $moo_duration; ?>,
			transition: Fx.Transitions.<?php echo $moo_transition; ?>,
			<?php if($start_transition==1) :?>
			display: <?php echo $start_open; ?>,
			<?php else: ?>
			show: <?php echo $start_open; ?>,
			<?php endif; ?>
			onActive: function(toggler, element){
				toggler.setStyle('cursor', 'pointer');
				toggler.addClass('toggle-hilite');
			},
			onBackground: function(toggler, element){
				toggler.setStyle('cursor', 'pointer');
				toggler.removeClass('toggle-hilite');
			}
		});
});
</script>
<div id="accordian" class="roklatestnews">
<?php
$counter = 0;
foreach ( $rows as $row ) {
	// get Itemid
	switch ( $type ) {
		case 2:
			$query = "SELECT id"
			. "\n FROM #__menu"
			. "\n WHERE type = 'content_typed'"
			. "\n AND componentid = $row->id"
			;
			$database->setQuery( $query );
			$Itemid = $database->loadResult();
			break;

		case 3:
			if ( $row->sectionid ) {
				$Itemid = $mainframe->getItemid( $row->id, 0, 0, $bs, $bc, $gbs );
			} else {
				$query = "SELECT id"
				. "\n FROM #__menu"
				. "\n WHERE type = 'content_typed'"
				. "\n AND componentid = $row->id"
				;
				$database->setQuery( $query );
				$Itemid = $database->loadResult();
			}
			break;

		case 1:
		default:
			$Itemid = $mainframe->getItemid( $row->id, 0, 0, $bs, $bc, $gbs );
			break;
	}

	// Blank itemid checker for SEF
	if ($Itemid == NULL) {
		$Itemid = '';
	} else {
		$Itemid = '&amp;Itemid='. $Itemid;
	}

	$link = sefRelToAbs( 'index.php?option=com_content&amp;task=view&amp;id='. $row->id . $Itemid );
	?>

		<?php //Change By FinLy Arifin ?>
		<h3 class="toggler atStart bg<?php echo ($counter)%2; ?>">
		<?php if ($show_date) {?>
		<span class="date">(<?php echo mosFormatDate( $row->created, '%d/%m' );?>)</span>
		<?php } ?>
		<?php if(!$title_as_link) { ?>
		<?php echo prepareContent($row->title); ?>
		<?php } else { ?>
		<a href="<?php echo $link; ?>"><?php echo $row->title; ?></a>
		<?php } ?>
		<?php //End Change ?>
		</h3>
		<div class="element atStart bg<?php echo ($counter++)%2; ?>">
		<?php //Change By FinLy Arifin ?>
  		<span><?php echo prepareContent($row->introtext, $length) . '...'; ?></span>
		<?php if(!$title_as_link) { ?>
		<br /><a href="<?php echo $link; ?>" class="readon">Read More ...</a>
		<?php } ?>
		</div>
		<?php //End Change ?>
	<?php
}
?>
</div>
