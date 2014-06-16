<?php 
/*
**********************************************
ExtCalendar v2
Copyright (c) 2003-2005 Mohamed Moujami (Simo)
v1 originally written by Kristof De Jaeger
**********************************************
This program is free software; you can redistribute it and/or modify 
it under the terms of the GNU General Public License as published by 
the Free Software Foundation; either version 2 of the License, or 
(at your option) any later version. 
**********************************************
$File: extcalendar.php - Calendar view display$

File adapted from the file "calendar.php" in the original
ExtCalendar v2 software. Renamed and adapted to become a Mambo
Server component by Matthew Friedman.

Revision date: 5/22/2005

**********************************************
Get the latest version of ExtCalendar at:
http://extcal.sourceforge.net//
**********************************************
*/

global $mosConfig_absolute_path;
require_once( $mosConfig_absolute_path."/components/com_extcalendar/config.inc.php" );
require_once( $CONFIG_EXT['LIB_DIR']."mail.inc.php" );

if(empty($extmode)) {
	$caldefault = $CONFIG_EXT['default_view'];
	if ($caldefault == 0) $extmode = "day";
	if ($caldefault == 1) $extmode = "week";
	if ($caldefault == 2) $extmode = "cal";
	if ($caldefault == 3) $extmode = "flyer";
}

switch($extmode) {
	case 'addevent' :
	case 'eventform' :
		if (require_priv($CONFIG_EXT['who_can_add_events'])) {
			pageheader($lang_main_menu['add_event']);
			print_add_event_form($date);
		}
		break;
		
	case 'event' :
		include( $CONFIG_EXT['FS_PATH'].'admin_events.php' );
		break;

	case 'view' :
		pageheader($lang_event_view['section_title']);
		if(!empty($event_id)) print_event_view($event_id);
		else print_monthly_view();
		break;

	case 'day':
		pageheader($lang_main_menu['daily_view']);
		print_daily_view($date);
		break;

	case 'week':
		pageheader($lang_main_menu['weekly_view']);
		print_weekly_view($date);
	  break;

	case 'cats' :
		pageheader($lang_main_menu['categories_view']);
		print_categories_view();
		break;

	case 'cat' :
		if(!empty($cat_id)) {
			$cat_info = get_cat_info($cat_id);
			pageheader(sprintf($lang_cat_events_view['section_title'], $cat_info['cat_name']));
			print_cat_content($cat_id);
		} else {
			pageheader($lang_main_menu['categories_view']);
			print_categories_view();
		}
		break;

	case 'flyer' :
	case 'flat' :
		pageheader($lang_main_menu['flat_view']);
		print_flat_view($date);
		break;

	case 'month' :
	case 'cal' :
		pageheader($lang_main_menu['cal_view']);
		print_monthly_view($date);
		break;

    case 'extcal_search' :
		pageheader($lang_event_search_data['section_title']);
		include( $CONFIG_EXT['FS_PATH'].'cal_search.php' );
		break;

	default:
		pageheader($lang_main_menu['cal_view']);
		print_monthly_view($date);
		break;
}

// footer
pagefooter();

// Functions

function print_event_view($extid)	{
	// function to display details on a specific event
	global $database, $CONFIG_EXT, $lang_system, $lang_general, $lang_add_event_view; 
	$date_stamp = (isset($_GET['recurdate']) && !empty($_GET['recurdate']))?$_GET['recurdate']:false;

	$event = new ExtCal_Event();
	if (!$event->loadEvent($extid,$date_stamp)) { 
		$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
		theme_redirect_dialog($lang_system['system_caption'], $lang_system['non_exist_event'], $lang_general['back'], $sef_href);
    } else 
	{
		// additional field processing
		$event->title = format_text($event->title,false,$CONFIG_EXT['capitalize_event_titles']);
		$event->description = process_content(format_text($event->description,true,false));

		theme_view_event($event);

    	if ($CONFIG_EXT['search_view']) extcal_search();
	}
}

function print_daily_view($date = '')	{
	// function to display daily events
	global $database, $CONFIG_EXT, $today, $lang_daily_event_view, $lang_system; 
	global $lang_general, $lang_date_format, $todayclr, $mosConfig_live_site; 

  if ($CONFIG_EXT['daily_view'] || has_priv('Administrator'))
  {
		// Check date. if no date is passed as argument, then we pick today
    if (empty($date))
    {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
	}
    else
    {
    	$day = $date['day'];
    	$month = $date['month'];
    	$year = $date['year'];
    }

	// check if "show past events" is enabled, else force the date to today's date
	if(mktime(0,0,0,$month,$day,$year) < mktime(0,0,0,$today['month'],1,$today['year']) && !$CONFIG_EXT['archive']) {
		$day = $today['day'];
		$month = $today['month'];
		$year = $today['year'];
	}
	$we = mktime(0,0,0,$month,$day,$year);
    $we = strftime("%w",$we);
    $we++;
					
		$nextday = mktime(0,0,0,$month,$day + 1,$year);
    $nextday = strftime("%d",$nextday);
		$nextmonth = mktime(0,0,0,$month,$day + 1,$year);
    $nextmonth = strftime("%m",$nextmonth);
		$nextyear = mktime(0,0,0,$month,$day + 1,$year);
    $nextyear = strftime("%Y",$nextyear);
		
		$previousday = mktime(0,0,0,$month,$day - 1,$year);
    $previousday = strftime("%d",$previousday);
		$previousmonth = mktime(0,0,0,$month,$day - 1,$year);
    $previousmonth = strftime("%m",$previousmonth);
		$previousyear = mktime(0,0,0,$month,$day - 1,$year);
    $previousyear = strftime("%Y",$previousyear);

    starttable('100%', $lang_daily_event_view['section_title'], 3);
		echo "<tr class='tablec'>";

    $date_stamp = mktime(0,0,0,$month,$day,$year);
    $events = get_events($date_stamp,$CONFIG_EXT['show_recurrent_events'],$CONFIG_EXT['show_overlapping_recurrences_dailyview']);
		
		$previous_day_date = date("Y-m-d", mktime(0,0,0,$previousmonth,$previousday,$previousyear));
		$next_day_date = date("Y-m-d", mktime(0,0,0,$nextmonth,$nextday,$nextyear));

		// link to previous day
		echo "<td align='center' width='33%' colspan='1' height='22' valign='middle' nowrap class='previousday'>";
		if ((mktime(0,0,0,$previousmonth,$previousday,$previousyear) >= mktime(0,0,0,$today['month'],1,$today['year'])) || $CONFIG_EXT["archive"])
		{
			$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=day&amp;date=".$previous_day_date );
			echo "<a href=\"$sef_href\">";
			echo "<img src='$mosConfig_live_site/components/com_extcalendar/images/mini_arrowleft.gif' border='0' alt=\"".$lang_daily_event_view['previous_day']."\" align='absmiddle' hspace='5'>";
			echo $lang_daily_event_view['previous_day'];
			echo "</a> ";
		}

		$bgcolor = ($day == $today['day'] && $month == $today['month'] && $year == $today['year'])?"background-color: ".$todayclr:"";
		// Current day cell
		echo "</td><td align='center' width='34%' colspan='1' height='22' valign='middle' align='center' class='currentday' style='$bgcolor' nowrap>";
		$date = ucwords(strftime($lang_date_format['full_date'], mktime(0,0,0,(int)$month,(int)$day,(int)$year)));
		echo $date."</td>";

		// link to next day
		echo "<td align='center' width='33%' colspan='1' height='22' valign='middle' nowrap class='nextday'>";
		$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=day&amp;date=".$next_day_date );
		echo "<a href=\"$sef_href\">";
		echo $lang_daily_event_view['next_day'];
		echo "<img src='$mosConfig_live_site/components/com_extcalendar/images/mini_arrowright.gif' border='0' alt=\"".$lang_daily_event_view['next_day']."\" align='absmiddle' hspace='5'>";
		echo "</a></td>";
		echo "</tr>\n";


    if(!$events) {
    	// display no events on selected day message
			echo "
<!-- BEGIN message_row -->
				<tr class='tableb'>
					<td align='center' class='tableb' colspan='3'>
					<br /><br />
					<strong>{$lang_daily_event_view['no_events']}</strong>
					<br /><br /><br />
					</td>
				</tr>
<!-- END message_row -->
";

    } else {
      // print results of query
      $event = new ExtCal_Event();
      while (list(,$event_row) = each($events))
      {
        $event->loadEvent($event_row[0]);
		if ( isset($event_row[3]) ) $event->recurStartDay = $event_row[3];
		if ( isset($event_row[4]) ) $event->recurEndDay = $event_row[4];
        // popup or link ?
        if ($CONFIG_EXT['popup_event_mode'])
        {
          $non_sef_href = $CONFIG_EXT['calendar_url']."cal_popup.php?extmode=view&extid=".$event->extid.($event->isRecurrent()?"&amp;recurdate=".$event->recurStartDay:'').
          $link = "href=\"javascript:;\" onclick=\"MM_openBrWindow('$non_sef_href','Calendar','toolbar=no,location=no,";
          $link .= "status=no,menubar=no,scrollbars=yes,resizable=no',".$CONFIG_EXT['popup_event_width'].",".$CONFIG_EXT['popup_event_height'].",false)\"";
        } else {
		  $sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=view&amp;extid=".$event->extid.($event->isRecurrent()?"&amp;recurdate=".$event->recurStartDay:'') );
		  $link = "href=\"$sef_href\"";
		}

		if ( $CONFIG_EXT['show_event_times_in_daily_view'] ) {
			if ( $event->isRecurrent() ) $event_date_string = ( $event->recurStartDay == $date_stamp ) ? ' ('.mf_get_timerange($event).')' : '';
			else $event_date_string = (  mf_convert_to_timestamp($event->start_date, 'dateonly') == $date_stamp ) ? ' ('.mf_get_timerange($event).')' : '';
		} else {
			$event_date_string = '';
		}

		echo "<tr><td colspan='3'>\n<table width='100%' cellpadding='0' cellspacing='0' border='0'>\n";
		echo "<tr><td width='6' bgcolor='".$event->color."'><img src='$mosConfig_live_site/components/com_extcalendar/images/spacer.gif' width='6' height='1'></td>\n";
        echo "<td class='tableb' width='100%'><div class='eventdesc'><a $link class='eventtitle'>".format_text(sub_string($event->title,$CONFIG_EXT['daily_view_max_chars'],'...'),false,$CONFIG_EXT['capitalize_event_titles']).$event_date_string."</a>\n";

        echo "</div></td></tr></table></td></tr>\n";
      }

		}
		display_cat_legend (3);
    endtable();

    if ($CONFIG_EXT['search_view']) extcal_search();
  } else {
	$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
    theme_redirect_dialog($lang_daily_event_view['section_title'], $lang_system['section_disabled'], $lang_general['back'], $sef_href);
  }

}


function print_weekly_view($date = '')	{
	// function to display weekly events
	global $database, $CONFIG_EXT, $today, $lang_weekly_event_view, $lang_system, $mosConfig_live_site; 
	global $lang_general, $lang_date_format, $todayclr; 

  if ($CONFIG_EXT['weekly_view'] || has_priv('Administrator'))
  {
		// Check date. if no date is passed as argument, then we pick today
    if (empty($date))
    {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
		}
    else
    {
    	$day = $date['day'];
    	$month = $date['month'];
    	$year = $date['year'];
    }

		$current_weeknumber = get_week_number($today['day'], $today['month'], $today['year']);
    // Calculationg the week number
		$weeknumber = get_week_number($day, $month, $year);

		// check if "show past events" is enabled, else force the date to today's date
//		if(($weeknumber < $current_weeknumber && $year <= $today['year'] ) && !$CONFIG_EXT['archive']) {
		if(mktime(0,0,0,$month,$day,$year) < mktime(0,0,0,$today['month'],1,$today['year']) && !$CONFIG_EXT['archive']) {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
      $weeknumber = $current_weeknumber;
		}

    $week_bound = array();
    $week_bound = get_week_bounds($day,$month,$year);

    $fdy = $week_bound['first_day']['year'];
    $fdm = $week_bound['first_day']['month'];
    $fdd = $week_bound['first_day']['day'];

    $ldy = $week_bound['last_day']['year'];
    $ldm = $week_bound['last_day']['month'];
    $ldd = $week_bound['last_day']['day'];
		
    $period = sprintf($lang_weekly_event_view['week_period'],strftime($lang_date_format['mini_date'],mktime(0,0,0,$fdm,$fdd,$fdy)),strftime($lang_date_format['mini_date'],mktime(0,0,0,$ldm,$ldd,$ldy)));

    // header (with links)
    starttable('100%', $lang_weekly_event_view['section_title'], 3, '', $period);
		echo "<tr class='tablec'>";

		echo "<td align='center' width='33%' colspan='1' height='22' valign='middle' nowrap class='previousweek'>";
    // previous and next week links
    
    // Calculationg the week number that contains the first day of current month and year
		//$currentweek = get_week_number($today['day'], $today['month'], $today['year']);
		
    //if ($CONFIG_EXT['archive'] || ($weeknumber > $current_weeknumber || $year > $today['year'] ) )
    if ($CONFIG_EXT['archive'] || mktime(0,0,0,$fdm,$fdd,$fdy) >= mktime(0,0,0,$today['month'],1,$today['year']))
    {
      $time_stamp = mktime(0,0,0,$fdm,$fdd-7,$fdy) >= mktime(0,0,0,$today['month'],1,$today['year'])? mktime(0,0,0,$fdm,$fdd-7,$fdy):mktime(0,0,0,$today['month'],1,$today['year']);
	  $sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=week&amp;date=".date("Y-m-d", $time_stamp) );
      echo "<a href=\"$sef_href\">";
			echo "<img src='$mosConfig_live_site/components/com_extcalendar/images/mini_arrowleft.gif' border='0' alt=\"".$lang_weekly_event_view['previous_week']."\" align='absmiddle' hspace='5'>";
      echo $lang_weekly_event_view['previous_week'];
      echo "</a> ";
    }
		// Current week cell
		$bgcolor = ($weeknumber == $current_weeknumber)?"background-color: ".$todayclr:"";
		echo "</td><td align='center' width='34%' height='22' valign='middle' class='currentweek' style='$bgcolor' nowrap>";
		echo sprintf($lang_weekly_event_view['selected_week'], $weeknumber). "</td>";

		// link to next week
		echo "<td align='center' width='33%' colspan='1' height='22' valign='middle' nowrap class='nextweek'>";
		$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=week&amp;date=".date("Y-m-d", mktime(0,0,0,$ldm,$ldd+1,$ldy)) );
		echo "<a href=\"$sef_href\">";
	    echo $lang_weekly_event_view['next_week'];
		echo "<img src='$mosConfig_live_site/components/com_extcalendar/images/mini_arrowright.gif' border='0' alt=\"".$lang_weekly_event_view['next_week']."\" align='absmiddle' hspace='5'>";
		echo "</a></td>";
		echo "</tr>\n";


    while ($fdy.$fdm.$fdd <= $ldy.$ldm.$ldd )
    {

      $day_pattern = sprintf("%04d%02d%02d",$fdy,$fdm,$fdd); // day pattern: 20041231 for 'December 31, 2004'
			$query = "SELECT extid FROM ".$CONFIG_EXT['TABLE_EVENTS']." AS e LEFT JOIN ".$CONFIG_EXT['TABLE_CATEGORIES']." AS c ON ";
      $query .= "e.cat=c.cat_id WHERE (DATE_FORMAT(e.start_date,'%Y%m%d') <= $day_pattern AND DATE_FORMAT(e.end_date,'%Y%m%d') >= $day_pattern) AND c.published = '1' AND approved='1' ORDER BY start_date,title ASC";
      $result = extcal_db_query($query);
			
      $date_stamp = mktime(0,0,0,$fdm,$fdd,$fdy);
      $events = get_events($date_stamp,$CONFIG_EXT['show_recurrent_events'],$CONFIG_EXT['show_overlapping_recurrences_weeklyview']);

			
			
			$previousweekday = 0;
      // Initialize the event object
      $event = new ExtCal_Event();
      while (list(,$event_row) = each($events))
      {
        $event->loadEvent($event_row[0]);
		if ( isset($event_row[3]) ) $event->recurStartDay = $event_row[3];
		if ( isset($event_row[4]) ) $event->recurEndDay = $event_row[4];

		$weekday = date("w",mktime(0,0,0,$fdm,$fdd,$fdy));
        $weekday++;
        
        $date = ucwords(strftime($lang_date_format['full_date'], mktime(0,0,0,$fdm,$fdd,$fdy)));
		$date_stamp = mktime(0,0,0,$fdm,$fdd,$fdy); // added to pass date to recurring events
        
		if($previousweekday != $weekday ) 
			echo "<tr class='tableh2'><td colspan='3' class='tableh2'><a name=".$weekday."></a>$date</td></tr>";

		$previousweekday = $weekday;

        if ($CONFIG_EXT['popup_event_mode'])
        {
          $non_sef_href = $CONFIG_EXT['calendar_url']."cal_popup.php?extmode=view&extid=".$event->extid.($event->isRecurrent()?"&amp;recurdate=".$event->recurStartDay:'');
          $link = "href=\"javascript:;\" onclick=\"MM_openBrWindow('$non_sef_href','Calendar','toolbar=no,location=no,";
          $link .= "status=no,menubar=no,scrollbars=yes,resizable=no',".$CONFIG_EXT['popup_event_width'].",".$CONFIG_EXT['popup_event_height'].",false)\"";
        } else {
          $sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=view&amp;extid=".$event->extid.($event->isRecurrent()?"&amp;recurdate=".$event->recurStartDay:'') );
          $link = "href=\"$sef_href\"";
		}

		if ( $CONFIG_EXT['show_event_times_in_weekly_view'] ) {
			if ( $event->isRecurrent() ) $event_date_string = ( $event->recurStartDay == $date_stamp ) ? ' ('.mf_get_timerange($event).')' : '';
			else $event_date_string = (  mf_convert_to_timestamp($event->start_date, 'dateonly') == $date_stamp ) ? ' ('.mf_get_timerange($event).')' : '';
		} else {
			$event_date_string = '';
		}

		echo "<tr><td colspan='3'>\n<table width='100%' cellpadding='0' cellspacing='0' border='0'>\n";
		echo "<tr><td width='6' bgcolor='".$event->color."'><img src='$mosConfig_live_site/components/com_extcalendar/images/spacer.gif' width='6' height='1'></td>\n";
		echo "<td class='tableb' width='100%'><div class='eventdesc'><a $link class='eventtitle'>".format_text(sub_string($event->title,$CONFIG_EXT['weekly_view_max_chars'],'...'),false,$CONFIG_EXT['capitalize_event_titles']).$event_date_string."</a>\n";

		echo "</div></td>\n";

		echo "</tr></table></td></tr>\n";

      }
      $fdy = date("Y", mktime(0,0,0,$fdm,$fdd+1,$fdy));
      $fdm = date("m", mktime(0,0,0,$fdm,$fdd+1,$fdy));
      $fdd = date("d", mktime(0,0,0,$fdm,$fdd+1,$fdy));
		}
    if(!$weekday) {
    	// display no events on selected day message
			echo "
<!-- BEGIN message_row -->
				<tr class='tableb'>
					<td align='center' class='tableb' colspan='3'>
					<br /><br />
					<strong>{$lang_weekly_event_view['no_events']}</strong>
					<br /><br /><br />
					</td>
				</tr>
<!-- END message_row -->
";			

    }		
		display_cat_legend (3);
		endtable();

	  if ($CONFIG_EXT['search_view'])	extcal_search();
  } else {
	$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
    theme_redirect_dialog($lang_weekly_event_view['section_title'], $lang_system['section_disabled'], $lang_general['back'], $sef_href);
  }
}

function print_monthly_view($date = '')	{
	// function to display monthly events
	global $database, $CONFIG_EXT, $today, $lang_monthly_event_view, $lang_system, $THEME_DIR; 
	global $lang_general, $lang_date_format, $event_icons, $template_monthly_view, $todayclr, $cat_id; 
	
  if ($CONFIG_EXT['monthly_view'] || has_priv('Administrator'))
  {
		// Check date. if no date is passed as argument, then we pick today
    if (empty($date))
    {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
		}
    else
    {
    	$day = $date['day'];
    	$month = $date['month'];
    	$year = $date['year'];
    }

		// check if "show past events" is enabled, else force the date to today's date
		if(mktime(0,0,0,$month,$day,$year) < mktime(0,0,0,$today['month'],1,$today['year']) && !$CONFIG_EXT['archive']) {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
		}

    // insert date into an array an pass it to the theme monthly view
		$target_date = array(
    	'day' => $day,
    	'month' => $month,
    	'year' => $year
    );
		// Build the category filter for the url
		$cat_filter = '';
    if(isset($cat_id) && is_numeric($cat_id)) $cat_filter .= "&cat_id=".$cat_id;
		// number of days in asked month
    $nr = date("t",mktime(12,0,0,$month,1,$year));
		
		$previous_month_date = date("Y-m-d", mktime(0,0,0,$month-1,1,$year));
		$next_month_date = date("Y-m-d", mktime(0,0,0,$month+1,1,$year));

		$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=cal&amp;date=".$previous_month_date.$cat_filter );
		$info_data['previous_month_url'] = $sef_href;
		$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=cal&amp;date=".$next_month_date.$cat_filter );
		$info_data['next_month_url'] = $sef_href;
		
		$info_data['current_month_color'] = ($month == $today['month'] && $year == $today['year'])?"background-color: ".$todayclr:"";
		
    if ($CONFIG_EXT['archive'] || ($month != date("n") || $year != date("Y"))) $info_data['show_past_months'] = true;
	else $info_data['show_past_months'] = false;
		
    // get the weekdays
    for ($i=0;$i<=6;$i++)
    {
      $array_index = $CONFIG_EXT['day_start']?($i+1)%7:$i;
      if ($array_index) $css_class = "weekdaytopclr"; // weekdays
      else $css_class = "sundaytopclr"; // sunday
      $info_data['weekdays'][$i]['name'] = $lang_date_format['day_of_week'][$array_index];
      $info_data['weekdays'][$i]['class'] = $css_class;
    }

    
    $event_stack = array();

    // 'existing' days in month
    for ($i=1;$i<=$nr;$i++)
    {
      $date_stamp = mktime(0,0,0,$month,$i,$year);
      $events = get_events($date_stamp,$CONFIG_EXT['show_recurrent_events'],$CONFIG_EXT['show_overlapping_recurrences_monthlyview']);
      //$events = sort_events($events, $event_stack, $date_stamp);

      //$event_stack[$i]['events'] = $events;
      $event_stack[$i]['week_number'] = (int) get_week_number($i, $month, $year);
      
      // Initialize the event object
      $event = new ExtCal_Event();

      while (list(,$event_info) = each($events))
      {
        $event->loadEvent($event_info[0]);
		// when the loadEvent is run it loads the values based only on the extid; if there are overlapping
		// recurrences, loadEvent doesn't distinguish and makes them all the same, with "RecurStartDay" and
		// "RecurEndDay" properties set to be those of the most recent recurrence. So now we have to correct
		// the RecurStartDay and RecurEndDay to match this recurrence's particular start and end.
		// NOTE: the values are TIMESTAMPS, date only, no time.
		if ( isset($event_info[3]) ) $event->recurStartDay = $event_info[3];
		if ( isset($event_info[4]) ) $event->recurEndDay = $event_info[4];
        $event_style = $event->get_style($date_stamp,$event_info[1],$event_info[2]);
        $event_icon = $event_icons[$event_style];
		$title = format_text(sub_string($event->title,$CONFIG_EXT['cal_view_max_chars'],'...'),false,$CONFIG_EXT['capitalize_event_titles']);
      	$event_stack[$i]['events'][] = array(
      		'title' => $title,
      		'style' => $event_style,
      		'icon' => $event_icon,
      		'color' => $event->color,
      		'extid' => $event->extid,
      		'eventdata' => $event
      	);
      }
    }
		
 	theme_monthly_view($target_date, $event_stack, $info_data);

    if ($CONFIG_EXT['search_view']) extcal_search();
    
  } else {
	$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
    theme_redirect_dialog($lang_weekly_event_view['section_title'], $lang_system['section_disabled'], $lang_general['back'], $sef_href);
  }
}

function print_flat_view($date = '')	{
	// function to display monthly events in a flat view mode
	global $database, $CONFIG_EXT, $today, $lang_flat_event_view, $lang_system, $THEME_DIR; 
	global $lang_general, $lang_date_format, $todayclr, $mosConfig_live_site;

  if ($CONFIG_EXT['flyer_view'] || has_priv('Administrator'))
  {
		// Check date. if no date is passed as argument, then we pick today
    if (empty($date))
    {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
		}
    else
    {
    	$day = $date['day'];
    	$month = $date['month'];
    	$year = $date['year'];
    }

		// check if "show past events" is enabled, else force the date to today's date
		if(mktime(0,0,0,$month,$day,$year) < mktime(0,0,0,$today['month'],1,$today['year']) && !$CONFIG_EXT['archive']) {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
		}

    // previous month
    $pm = $month;
    if ($month == "1") $pm = "12"; else  $pm--;
    // previous year
    $py = $year;
    if ($pm == "12") $py--;

    // next month
    $nm = $month;
    if ($month == "12") $nm = "1"; else $nm++;
    // next year
    $ny = $year;
    if ($nm == 1) $ny++;

    $firstday = strftime ("%w", mktime(12,0,0,$month,1,$year));
    $firstday++;
    // nr of days in askedmonth
    $nr = date("t",mktime(12,0,0,$month,1,$year));

    $today_date = ucwords(strftime($lang_date_format['full_date'], mktime(0,0,0,$today['month'],$today['day'],$today['year'])));
		starttable('100%', $lang_flat_event_view['section_title'], 3, '', $today_date);
		echo "<tr class='tablec'>";
    echo "<td align='center' width='33%' colspan='1' height='22' valign='middle' nowrap class='previousmonth'>";

		$previous_month_date = date("Y-m-d", mktime(0,0,0,$pm,1,$py));
		$next_month_date = date("Y-m-d", mktime(0,0,0,$nm,1,$ny));
		
    if ($month != date("n") || $year != date("Y"))
    {
			// date for previous month
      $date = ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$pm,1,$py)));
	  $sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=flyer&amp;date=".$previous_month_date );
      echo "<a href=\"$sef_href\" onMouseOver=\"showOnBar('".$date."');return true;\" onMouseOut=\"showOnBar('');return true;\">";
      echo "<img src='$mosConfig_live_site/components/com_extcalendar/images/mini_arrowleft.gif' border='0' alt=\"$date\" align='absmiddle' hspace='5'>";
      echo $date;
      echo "</a>"; 
    }
    elseif ($CONFIG_EXT['archive'] == '1')
    {
			// date for previous month
      $date = ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$pm,1,$py)));
	  $sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=flyer&amp;date=".$previous_month_date );
      echo "<a href=\"$sef_href\" onMouseOver=\"showOnBar('".$date."');return true;\" onMouseOut=\"showOnBar('');return true;\">";
      echo "<img src='$mosConfig_live_site/components/com_extcalendar/images/mini_arrowleft.gif' border='0' alt=\"$date\" align='absmiddle' hspace='5'>";
			echo $date;
      echo "</a>"; 
    }
    // date for current month
	$date = ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$month,1,$year)));
	$bgcolor = ($month == $today['month'] && $year == $today['year'])?"background-color: ".$todayclr:"";
    echo "</td><td align='center' height='22' valign='middle' align='center' class='currentmonth' style='$bgcolor' nowrap>";
	echo $date."</td>";

	// date for next month
	$date = ucwords(strftime($lang_date_format['month_year'], mktime(0,0,0,$nm,1,$ny)));
    echo "<td align='center' height=\"22\" valign=\"middle\" align='left' nowrap class='nextmonth'><strong>";
    $sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=flyer&amp;date=".$next_month_date );
    echo "<a href=\"$sef_href\" onMouseOver=\"showOnBar('".$date."');return true;\" onMouseOut=\"showOnBar('');return true;\">";
	echo $date;
	echo "<img src='$mosConfig_live_site/components/com_extcalendar/images/mini_arrowright.gif' border='0' alt=\"$date\" align='absmiddle' hspace='5'>";
    echo "</a></td>";
    echo "</tr>\n";




    $foo = '';
    for ($i=1;$i<=$nr;$i++)
    {

      $date_stamp = mktime(0,0,0,$month,$i,$year);
      $events = get_events($date_stamp,$CONFIG_EXT['show_recurrent_events'],$CONFIG_EXT['show_overlapping_recurrences_flatview']);
      
      // if result, let's go for that day !
      if ($events){

        $date = ucwords(strftime($lang_date_format['full_date'], mktime(0,0,0,$month,$i,$year)));
				echo "<tr class='tableh2'><td colspan='3' class='tableh2'><a name=$i></a>".$date."</td></tr>";

	      // Initialize the event object
        $event = new ExtCal_Event();
	      while (list(,$event_info) = each($events))
	      {
	        $event->loadEvent($event_info[0]);
			if ( isset($event_info[3]) ) $event->recurStartDay = $event_info[3];
			if ( isset($event_info[4]) ) $event->recurEndDay = $event_info[4];
			
			if ( $CONFIG_EXT['show_event_times_in_flat_view'] ) {
				if ( $event->isRecurrent() ) $event_date_string = ( $event->recurStartDay == $date_stamp ) ? ' ('.mf_get_timerange($event).')' : '';
				else $event_date_string = (  mf_convert_to_timestamp($event->start_date, 'dateonly') == $date_stamp ) ? ' ('.mf_get_timerange($event).')' : '';
			} else {
				$event_date_string = '';
			}

			echo "<tr><td colspan='3'>\n<table width='100%' cellpadding='0' cellspacing='0' border='0'>\n";
			echo "<tr><td width='6' bgcolor='".$event->color."'><img src='$mosConfig_live_site/components/com_extcalendar/images/spacer.gif' width='6' height='1'></td>\n";
			$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=view&amp;extid=".$event->extid.($event->isRecurrent()?"&amp;recurdate=".$event->recurStartDay:'') );
			echo "<td class='tableb' width='100%'><div class='eventdesc'><a href=\"$sef_href\" class='eventtitle'>".format_text($event->title,false,$CONFIG_EXT['capitalize_event_titles']).$event_date_string."</a><br />\n";

          // picture
          if ($CONFIG_EXT["flyer_show_picture"])
          {
            if ($event->picture) echo "<img src=\"".$CONFIG_EXT['calendar_url']."/upload/".$event->picture."\" align=\"right\"><br />";
          }
          // title
          // description
		  echo process_content(format_text(sub_string($event->description,$CONFIG_EXT['flyer_view_max_chars'],'...'),true,false))."<br />\n";
          echo "<img src='$mosConfig_live_site/components/com_extcalendar/images/spacer.gif' width='1' height='4'><br />\n";
          // contact
          if ($event->contact) echo "<strong>".$lang_flat_event_view['contact_info']." :</strong> ".stripslashes($event->contact)." \n";
          // email
          if ($event->email) echo "<strong>".$lang_flat_event_view['contact_email']." :</strong> <a href=mailto:".$event->email.">".$event->email."</a> \n";
          // url
          if ($event->url) echo "<strong>Url:</strong> <a href=".$event->url.">".$event->url."</a>\n";
          echo "<img src='$mosConfig_live_site/components/com_extcalendar/images/spacer.gif' width='1' height='8'><br />\n";
					echo "</div></td></tr></table></td></tr>\n";
        }
      }
    }
	display_cat_legend (3);
    endtable();
    if ($CONFIG_EXT['search_view']) extcal_search();
  } else {
	$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
    theme_redirect_dialog($lang_flat_event_view['section_title'], $lang_system['section_disabled'], $lang_general['back'], $sef_href);
  }
}  

function print_categories_view()	{
	// function to display a list of event categories
	global $database, $CONFIG_EXT, $today, $lang_cats_view, $lang_system; 
	global $lang_general, $lang_date_format;

  if ($CONFIG_EXT['cats_view'] || has_priv('Administrator')) //  enabled or not ?
  {
		$query = "SELECT * FROM " . $CONFIG_EXT['TABLE_CATEGORIES'] . " WHERE published = '1'";
		$results = extcal_db_query($query);
		$rows = extcal_db_num_rows($results);
		
    if (!$rows) { 
			$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
			theme_redirect_dialog($lang_system['system_caption'], $lang_cats_view['no_cats'], $lang_general['back'], $sef_href);
    } else {

			$total_cats = 0;
			$all_events = 0;
			$count = 0;
			$cat_rows = '';
      while ($row = extcal_db_fetch_object($results))
      {
	      if($CONFIG_EXT['archive']) {
		      $query = "SELECT * FROM ".$CONFIG_EXT['TABLE_EVENTS'] . " WHERE cat = '$row->cat_id' AND approved = 1 ORDER BY title";
				} else {
		      $day_pattern = sprintf("%04d%02d%02d",$today['year'],$today['month'],1); // day pattern: 20041231 for 'December 31, 2004'
		      $query = "SELECT * FROM ".$CONFIG_EXT['TABLE_EVENTS'] . " AS e WHERE (DATE_FORMAT(e.start_date,'%Y%m%d') >= $day_pattern) AND cat = '$row->cat_id' AND approved = 1 ORDER BY title";
				}
	      $result1 = extcal_db_query($query);
	      $total_events = extcal_db_num_rows($result1);
	      $day_pattern = sprintf("%04d%02d%02d",$today['year'],$today['month'],$today['day']); // day pattern: 20041231 for 'December 31, 2004'
	      $query = "SELECT * FROM ".$CONFIG_EXT['TABLE_EVENTS'] . " AS e WHERE (DATE_FORMAT(e.start_date,'%Y%m%d') > $day_pattern OR DATE_FORMAT(e.recur_until,'%Y%m%d') >= $day_pattern) AND cat = $row->cat_id AND approved = 1";
	      $result2 = extcal_db_query($query);
	      $upcoming_events = extcal_db_num_rows($result2);

				$cat_rows[$count]['total_events'] = $total_events;
				$cat_rows[$count]['upcoming_events'] = $upcoming_events;
				$cat_rows[$count]['color'] = $row->color;
				$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=cat&amp;cat_id=".$row->cat_id );
				$cat_rows[$count]['link'] = $sef_href;
				$cat_rows[$count]['cat_id'] = $row->cat_id;
				$cat_rows[$count]['cat_name'] = stripslashes($row->cat_name);
				$cat_rows[$count]['description'] = stripslashes($row->description);
				
				$all_events += $total_events;
				$total_cats ++;
				$count ++;
				
				extcal_db_free_result($result1);
				extcal_db_free_result($result2);
      }
			$stat_string = sprintf($lang_cats_view['stats_string'], $all_events, $total_cats);

			theme_cats_list($cat_rows, $stat_string);
			
			extcal_db_free_result($results);
    }
    if ($CONFIG_EXT['search_view']) extcal_search();
  } else {
	$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
    theme_redirect_dialog($lang_cats_view['section_title'], $lang_system['section_disabled'], $lang_general['back'], $sef_href);
  }
}

function print_cat_content($cat_id) {
	// function to display events under a specific category
	global $database, $CONFIG_EXT, $today, $lang_cat_events_view, $lang_system, $next_recurrence_stamp; 
	global $lang_general, $lang_date_format;
	
  if ($CONFIG_EXT['cats_view'] || has_priv('Administrator')) //  enabled or not ?
  {
		$cat_info = get_cat_info($cat_id);
    if (!$cat_info) { 
			$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] . "&amp;extmode=cats" );
			theme_redirect_dialog($lang_system['system_caption'], $lang_system['non_exist_cat'], $lang_general['back'], $sef_href);
    } else 
    {

			$total_cats = 0;
			$count = 0;
			$event_rows = '';

      if($CONFIG_EXT['archive']) {
	      $query = "SELECT * FROM ".$CONFIG_EXT['TABLE_EVENTS'] . " WHERE cat = '$cat_id' AND approved = 1 ORDER BY title";
	      $result = extcal_db_query($query);
			} else {
	      
				// still have to add support for show past event
	      $day_pattern = sprintf("%04d%02d%02d",$today['year'],$today['month'],1); // day pattern: 20041231 for 'December 31, 2004'
	      $query = "SELECT * FROM ".$CONFIG_EXT['TABLE_EVENTS'] . " AS e WHERE (DATE_FORMAT(e.start_date,'%Y%m%d') >= $day_pattern OR DATE_FORMAT(e.end_date,'%Y%m%d') >= $day_pattern OR DATE_FORMAT(e.recur_until,'%Y%m%d') >= $day_pattern) AND cat = '$cat_id' AND approved = 1 ORDER BY title";
	      $result = extcal_db_query($query);
			}
      $total_events = extcal_db_num_rows($result);
      
      while ($row = extcal_db_fetch_object($result))
      {
				$month = ($row->month)?$lang_date_format['months'][$row->month-1]:$lang_general['everymonth'];
				$year = ($row->year)?$row->year:$lang_general['everyyear'];
				$event_rows[$count]['date'] = mf_process_category_date($row);
				$event_rows[$count]['start_date'] = $row->start_date;
				$event_rows[$count]['next_recurrence_stamp'] = $next_recurrence_stamp;
				if ($CONFIG_EXT['popup_event_mode']) {
				    $non_sef_href = $CONFIG_EXT['calendar_url']."cal_popup.php?extmode=view&extid=".$row->extid.(!empty($row->recur_type) ? "&amp;recurdate=$next_recurrence_stamp" : '');
					$event_rows[$count]['link'] = "href='Javascript: //' onClick=\"MM_openBrWindow('$non_sef_href','eventview','toolbar=no,status=no,resizable=no,scrollbars=yes',".$CONFIG_EXT['popup_event_width'].",".$CONFIG_EXT['popup_event_height'].",false)\"";						
				} else {
					$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=view&amp;extid=".$row->extid.(!empty($row->recur_type) ? "&amp;recurdate=$next_recurrence_stamp" : '') );
					$event_rows[$count]['link'] = "href='$sef_href'";
				}
				$event_rows[$count]['extid'] = $row->extid;
				$event_rows[$count]['title'] = format_text(sub_string($row->title,$CONFIG_EXT['cats_view_max_chars'],'...'),false,$CONFIG_EXT['capitalize_event_titles']);
				// $event_rows[$count]['description'] = process_content(format_text($row->description, true,false));
				
				$count ++;
      }
			$stats['total_events'] = (int)$total_events;
			
		  // Now we sort the merged array by order specified in Settings:
		  function sortCategoryEvents( $a, $b ) {
		  	global $CONFIG_EXT;
		    switch ( $CONFIG_EXT['sort_category_view_by'] ) {
			  case 'title_asc':
				return strcmp(strtolower($a['title']), strtolower ($b['title']));
			  	break;
			  case 'title_desc':
				return strcmp(strtolower($b['title']), strtolower ($a['title']));
			  	break;
			  case 'date_desc':
			  	if ( $a['next_recurrence_stamp'] == $b['next_recurrence_stamp'] ) {
					// if same day, sort by time:
					if ( mf_convert_to_timestamp($a['start_date'],'timeonly') == mf_convert_to_timestamp($b['start_date'],'timeonly') ) return 0;
					else return ( mf_convert_to_timestamp($a['start_date'],'timeonly') > mf_convert_to_timestamp($b['start_date'],'timeonly') ) ? -1 : 1;
				} else return ( $a['next_recurrence_stamp'] > $b['next_recurrence_stamp'] ) ? -1 : 1;
			  	break;
			  case 'date_asc':
			  default:
			  	if ( $b['next_recurrence_stamp'] == $a['next_recurrence_stamp'] ) {
					// if same day, sort by time:
					if ( mf_convert_to_timestamp($b['start_date'],'timeonly') == mf_convert_to_timestamp($a['start_date'],'timeonly') ) return 0;
					else return ( mf_convert_to_timestamp($b['start_date'],'timeonly') > mf_convert_to_timestamp($a['start_date'],'timeonly') ) ? -1 : 1;
				} else return ( $b['next_recurrence_stamp'] > $a['next_recurrence_stamp'] ) ? -1 : 1;
			  	break;
			}
		  }
		  if ( is_array($event_rows) ) usort( $event_rows, "sortCategoryEvents" );
		  
			theme_cat_events_list($event_rows, $cat_info, $stats);
			extcal_db_free_result($result);

    }
		
    if ($CONFIG_EXT['search_view']) extcal_search();
		
  } else {
	$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
    theme_redirect_dialog($lang_cats_view['section_title'], $lang_system['section_disabled'], $lang_general['back'], $sef_href);
  }

}

function print_add_event_form($date = '') {
	// function to display events under a specific category
	global $database, $CONFIG_EXT, $today, $lang_add_event_view, $lang_system; 
	global $lang_general, $extmode, $errors, $lang_settings_data;

	if (($CONFIG_EXT['add_event_view'] || has_priv('Administrator')) && require_priv($CONFIG_EXT['who_can_add_events'])) // enabled or not ?
  {
	  $successful = false;
	  $form = &$_POST;
		
		// Check date. if no date is passed as argument, then we pick today
    if (empty($date))
    {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
		}
    else
    {
    	$day = $date['day'];
    	$month = $date['month'];
    	$year = $date['year'];
    }

		// check if "show past events" is enabled, else force the date to today's date
		if(mktime(0,0,0,$month,$day,$year) < mktime(0,0,0,$today['month'],1,$today['year']) && !$CONFIG_EXT['archive']) {
      $day = $today['day'];
      $month = $today['month'];
      $year = $today['year'];
		}

		$day = isset($form['day'])?$form['day']:$day;
		$month = isset($form['month'])?$form['month']:$month;
		$year = isset($form['year'])?$form['year']:$year;

		if (isset($form['title'])) $title = addslashes($form['title']); else $title = '';
		if (isset($form['description'])) $description = addslashes($form['description']); else $description = '';
		if (isset($form['contact'])) $contact = addslashes($form['contact']); else $contact = '';
		if (isset($form['email'])) $email = addslashes($form['email']); else $email = '';
		if (isset($form['url'])) $url = addslashes($form['url']); else $url = '';
		if (isset($form['cat'])) $cat = $form['cat']; else $cat = '';

		if(count($_POST)) {
		// Process user submission

			// Form Validation	
			$errors = '';
			if (empty($title)) $errors .=  theme_error_string($lang_add_event_view['no_title']);
			if (empty($description)) $errors .= theme_error_string($lang_add_event_view['no_desc']);
			if (empty($cat)) $errors .= theme_error_string($lang_add_event_view['no_cat']);
			if (empty($day) || empty($month) || empty($year) || !checkdate($month,$day,$year)) $errors .= theme_error_string($lang_add_event_view['date_invalid']);

			if ($form['duration_type'] == '1') {
				$form['end_days'] = empty($form['end_days'])?'0':$form['end_days'];
				$form['end_hours'] = empty($form['end_hours'])?'0':$form['end_hours'];
				$form['end_minutes'] = empty($form['end_minutes'])?'0':$form['end_minutes'];
				if (!is_numeric($form['end_days'])) { $errors .= theme_error_string($lang_add_event_view['end_days_invalid']); }
				if (!is_numeric($form['end_hours'])) { $errors .= theme_error_string($lang_add_event_view['end_hours_invalid']); }
				if (!is_numeric($form['end_minutes'])) { $errors .= theme_error_string($lang_add_event_view['end_minutes_invalid']); }
			}

			// check recurrence information
			switch((int)$form['recur_type_select']) {
				case 1:
					if (!is_numeric($form['recur_val_1']) || (int)$form['recur_val_1'] < 1) { $errors .= theme_error_string($lang_add_event_view['recur_val_1_invalid']); }
					break;
				case 0:
				default:
			}
			switch((int)$form['recur_end_type']) {
				case 0:
					break;
				case 1:
					if (!is_numeric($form['recur_end_count']) || (int)$form['recur_end_count'] < 1) { $errors .= theme_error_string($lang_add_event_view['recur_end_count_invalid']); }
					break;
				case 2:
					if (mktime(0,0,0,$month,$day,$year) > mktime(0,0,0,$form['recur_until_month'],$form['recur_until_day'],$form['recur_until_year'])) { $errors .= theme_error_string($lang_add_event_view['recur_end_until_invalid']); }
					break;
				default:
					
			}
			
			$valid_pic = false;
			// may someone upload picture or not ?
			if ($CONFIG_EXT['addevent_allow_picture'])
			{
				if (is_uploaded_file($_FILES['picture']['tmp_name']))
				{
					// check for size of picture
					$size = $_FILES['picture']['size'];
					// check for extension ! 
					$name = $_FILES['picture']['name'];
					$ext = explode(".",$name);
					$ext = array_reverse($ext);
					$ext = $ext[0];
					$extensions = explode('/', $CONFIG_EXT['allowed_file_extensions']);
					$valid_pic = false;
					for ($i=0;$i<count($extensions);$i++)
					{
						if(preg_match("/".$extensions[$i]."$/i",$ext))
						{
							$valid_pic = true;
						}
					}

	        // Get picture information
	        $dimensions  = getimagesize($_FILES['picture']['tmp_name']); 
					$filesize = $CONFIG_EXT['max_upl_size'];

					if ($size > $filesize)
					{
						$errors .= theme_error_string(sprintf($lang_add_event_view['file_too_large'],$CONFIG_EXT['max_upl_size'] / 1000)); 
            @unlink($_FILES['picture']['tmp_name']);
					}
					elseif (!$valid_pic)
					{
						$errors .= theme_error_string(sprintf($lang_add_event_view['non_valid_extension'],str_replace('/',' ',$CONFIG_EXT['allowed_file_extensions']))); 
            @unlink($_FILES['picture']['tmp_name']);
					}
					elseif (max($dimensions[0], $dimensions[1]) > $CONFIG_EXT['max_upl_dim']) {
		        // Picture dimensions (in pixels) must be is lower than the maximum allowed
						$errors .= theme_error_string(sprintf($lang_add_event_view['non_valid_dimensions'],$CONFIG_EXT['max_upl_dim'])); 
            @unlink($_FILES['picture']['tmp_name']);
          }
				}
				else $picture = '';

				} 
			else $picture = '';
			
			if(!$errors) {
				$temp_id = '';
				if($valid_pic)
				{
					$temp_id = substr(md5(time()),0,4);
					$picture = "$temp_id"."_".$_FILES['picture']['name'];
					$picture = str_replace(" ","",$picture);
          // Move uploaded picture from the temporary folder
		    @chmod(substr($CONFIG_EXT['UPLOAD_DIR'],0,-1), 0777);
	        if(@move_uploaded_file($_FILES['picture']['tmp_name'], $CONFIG_EXT['UPLOAD_DIR'].$picture)) {
	        // Change file permission
			        @chmod($CONFIG_EXT['UPLOAD_DIR'].$picture, octdec($CONFIG_EXT['picture_chmod']));
					} else {
					$errors .= theme_error_string($lang_add_event_view['move_image_failed'] . '<br>'.$_FILES['picture']['tmp_name'].'<br>'. $CONFIG_EXT['UPLOAD_DIR'].$picture); 
					}	         
					
				}
			}
			if(!$errors) {

				$url = str_replace("http://","",$url);
				
				if(has_priv("Administrator")) $approve = (isset($form['autoapprove']))?1:0;
				else {
					// determine if the specified category requires the event to be approved
					$query = "SELECT options FROM " . $CONFIG_EXT['TABLE_CATEGORIES'] . " WHERE cat_id = $cat";
					$result = extcal_db_query($query);
					$options = extcal_db_fetch_array($result);
					$approve = $options['options'] & 1;
					extcal_db_free_result($result);
				}
				
				if($CONFIG_EXT['time_format_24hours']) $start_time_hour = $form['start_time_hour']; // 24 hours mode
				else $start_time_hour = extcal_12to24hour($form['start_time_hour'], $form['start_time_ampm']); // 12 hours mode
				$start_date = date("Y-m-d H:i:s", mktime($start_time_hour, $form['start_time_minute'], 0, $month, $day, $year));					

// Here is where we deal with what kind of duration to use. If a duration is specified, we calculate the end_date to enter into the database.
// If not, we enter a special end_date instead.

				if ($form['duration_type'] == '1') { // This is a normal event, with a SPECIFIED duration
					if($form['end_days'] > 0 && !$form['end_hours'] && !$form['end_minutes']) {
						$form['end_days']--; // to make sure not to jump to the next day, we push the time to 23:59:59
						$total_hours = 23;
						$total_minutes = 59;
						$total_seconds = 59;
					} else {
						$total_hours = $start_time_hour + $form['end_hours'];
						$total_minutes = $form['start_time_minute'] + $form['end_minutes'];
						$total_seconds = 0;
					}
					$end_date = date("Y-m-d H:i:s", mktime( $total_hours, $total_minutes, $total_seconds, $month, $day + $form['end_days'], $year));						
				} else if ($form['duration_type'] == '2') { // This is an event where "No end date" was checked instead
					$end_date = '0000-00-00 00:00:01';
				} else { // This is an event where "No end date" was checked instead
					$end_date = '0000-00-00 00:00:00';
				}

				// Set recurrence information
				switch((int)$form['recur_type_select']) {
					case 1:
						$recur_type = $form['recur_type_1'];
						$recur_val = $form['recur_val_1'];
						break;
					case 0:
					default:
						$recur_type = '';
						$recur_val = 0;
						break;
				}
				$recur_end_type = $form['recur_end_type'];
				$recur_count = $form['recur_end_count'];
				
				// Determine the recur_until value by doing actual calculation if necessary. If the recur type
				// is "recur x number of times" then we calculate the end date.
				if ( $recur_end_type == 0 || $recur_type == '' ) $recur_until = substr($start_date,0,10);
				else if ( $recur_end_type == 2 ) $recur_until = date("Y-m-d", mktime(0, 0, 0, $form['recur_until_month'], $form['recur_until_day'], $form['recur_until_year']));
				else {
					switch ( $recur_type ) {
						case "day":
								$enddatestamp = mktime(0,0,0,$month,$day+($recur_val*$recur_count),$year);
								break;
						case "week":
								$enddatestamp = mktime(0,0,0,$month,$day+($recur_val*$recur_count*7),$year);
								break;
						case "month":
								$enddatestamp = mktime(0,0,0,$month+($recur_val*$recur_count),$day,$year);
								break;
						case "year":
								$enddatestamp = mktime(0,0,0,$month,$day,$year+($recur_val*$recur_count));
								break;
						default:
								break;
					}
					$recur_until = date("Y-m-d", $enddatestamp);
				}

				$query = "
				INSERT INTO ".$CONFIG_EXT['TABLE_EVENTS']." (
					title, description, contact, url, email, picture, cat, day, month, year, start_date, end_date, approved, recur_type, recur_val, recur_end_type, recur_count, recur_until
				) VALUES (
					'$title','$description','$contact','$url','$email','$picture','$cat','$day','$month','$year','$start_date','$end_date','$approve','$recur_type','$recur_val','$recur_end_type','$recur_count','$recur_until'
				)";
				extcal_db_query($query);
				if (!$approve && !has_priv("Administrator"))
				{
					if ($CONFIG_EXT['new_post_notification'])
					{
						// send email notification
						$duration_array = datestoduration ($start_date,$end_date);
						$days_string = $duration_array['days']?$duration_array['days']." ".$lang_general['day']. " ":'';
						$days_string = $duration_array['days']>1?$duration_array['days']." ".$lang_general['days']. " ":$days_string;
						$hours_string = $duration_array['hours']?$duration_array['hours']." ".$lang_general['hour']. " ":'';
						$hours_string = $duration_array['hours']>1?$duration_array['hours']." ".$lang_general['hours']. " ":$hours_string;
						$minutes_string = $duration_array['minutes']?$duration_array['minutes']." ".$lang_general['minute']:'';
						$minutes_string = $duration_array['minutes']>1?$duration_array['minutes']." ".$lang_general['minutes']:$minutes_string;
					
						// create an instance of the mail class
						$mail = new extcalMailer;
						
						// Now you only need to add the necessary stuff
						$mail->AddAddress($CONFIG_EXT['calendar_admin_email'], " ");
						$mail->Subject = sprintf($lang_system['new_event_subject'], $CONFIG_EXT['app_name']);

				$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'].'&amp;extmode=event&amp;event_mode=view&amp;extid=' . extcal_db_insert_id() );
		        $event_link = $sef_href;
		        $template_vars = array(
							'{CALENDAR_NAME}' => $CONFIG_EXT['app_name'],
							'{TITLE}' => $title,
							'{DATE}' => $start_date,
							'{DURATION}' => $days_string.$hours_string.$minutes_string,
							'{LINK}' => $event_link
						);

						$mail->Body  = strtr($lang_system['event_notification_body'], $template_vars);

						if(!$mail->Send() && $CONFIG_EXT['debug_mode'])
						{
							// An error occurred while trying to send the email
							$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
							theme_redirect_dialog($lang_system['system_caption'], $lang_system['event_notification_failed'], $lang_general['back'], $sef_href);
							pagefooter();
							exit;
						}
					}
				}
				// Successfull message
				$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
				if($approve) theme_redirect_dialog($lang_add_event_view['section_title'], $lang_add_event_view['submit_event_approved'], $lang_general['continue'], $sef_href);
				else theme_redirect_dialog($lang_add_event_view['section_title'], $lang_add_event_view['submit_event_pending'], $lang_general['continue'], $sef_href);
				// to remember not to display the form again
				$successful = true;
			} 
		} else {
			// No HTTP post or get requests found. THESE ARE THE DEFAULT VALUES FOR ADDING NEW EVENTS:
			$form['autoapprove'] = true;
			$form['end_days'] = '1';
			$form['end_hours'] = '0';
			$form['end_minutes'] = '0';
			$form['start_time_hour'] = '8';
			$form['start_time_minute'] = '0';
			$form['start_time_ampm'] = 'am';
			$form['day'] = $day;
			$form['month'] = $month;
			$form['year'] = $year;
			// initial values for recurrence
			$form['recur_type_select'] = '0';
			$form['recur_type_1'] = 'day';
			$form['recur_val_1'] = '1';
			$form['recur_end_type'] = '0';
			$form['recur_end_count'] = '1';
			$form['recur_until_day'] = $day;
			$form['recur_until_month'] = $month;
			$form['recur_until_year'] = $year;
			$form['duration_type'] = '1';
		}
		
		// Render the form
    if(!$successful) {
			$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'].'&amp;extmode=addevent' );
			display_event_form($sef_href,'addevent',$form);
		}
  } else if (require_priv($CONFIG_EXT['who_can_add_events'])) {
    $sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
    theme_redirect_dialog($lang_add_event_view['section_title'], $lang_system['section_disabled'], $lang_general['back'], $sef_href);
  }
}

?>