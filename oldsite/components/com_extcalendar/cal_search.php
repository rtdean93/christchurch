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
$File: cal_seach.php - Calendar search$
$Log: cal_search.php,v $
Revision 1.9  2005/02/04 03:26:21  simoami
fixed pop up size

**********************************************
Get the latest version of ExtCalendar at:
http://extcal.sourceforge.net//
**********************************************
*/

// Modified for Mambo integration. No longer a standalone page; used as an include file in the main file extcalendar.php

$num_rows = 0;

if (strlen($extcal_search) >= 3) {
	// must be longer or equal to 3 characters !

    if($CONFIG_EXT['archive']) {
	  $query = "SELECT extid,title,e.description,e.recur_type,url,cat,cat_name,day,month,year, color FROM ".$CONFIG_EXT['TABLE_EVENTS']." AS e LEFT JOIN ".$CONFIG_EXT['TABLE_CATEGORIES']." AS c ON e.cat=c.cat_id ";
	  $query .= "WHERE (title LIKE '%$extcal_search%' OR e.description LIKE '%$extcal_search%') AND c.published = '1' AND approved = '1' ";
	  $query .= "ORDER BY year ASC, month ASC, day ASC";
	} else {
      $day_pattern = sprintf("%04d%02d%02d",$today['year'],$today['month'],1); // day pattern: 20041231 for 'December 31, 2004'
	  $query = "SELECT extid,title,e.description,e.recur_type,url,cat,cat_name,day,month,year, color FROM ".$CONFIG_EXT['TABLE_EVENTS']." AS e LEFT JOIN ".$CONFIG_EXT['TABLE_CATEGORIES']." AS c ON e.cat=c.cat_id ";
	  $query .= "WHERE (title LIKE '%$extcal_search%' OR e.description LIKE '%$extcal_search%') AND c.published = '1' AND approved = '1' ";
	  $query .= "AND (DATE_FORMAT(e.start_date,'%Y%m%d') >= $day_pattern OR DATE_FORMAT(e.end_date,'%Y%m%d') >= $day_pattern OR DATE_FORMAT(e.recur_until,'%Y%m%d') >= $day_pattern) ";
	  $query .= "ORDER BY year ASC, month ASC, day ASC";
	}
	$result = extcal_db_query($query);
	$num_rows = extcal_db_num_rows($result);
	
	$count = 0;
	while ($row = extcal_db_fetch_object($result))
	{
		$title = format_text($row->title,false,$CONFIG_EXT['capitalize_event_titles']);
		$search_results[$count]['search_title'] = highlight($extcal_search,$title,"<span class='titlehighlight'>","</span>");
		
		if (!empty($row->recur_type)) $next_recurrence_stamp = mf_get_next_recurrence($row);

		# popup or not ?
		if ($CONFIG_EXT['popup_event_mode']){
			$non_sef_href = $CONFIG_EXT['calendar_url']."cal_popup.php?extmode=view&extid=".$row->extid.(!empty($row->recur_type) ? "&amp;recurdate=$next_recurrence_stamp" : '');
			$search_results[$count]['search_link'] = "href=\"javascript:;\" onclick=\"MM_openBrWindow('$non_sef_href','Calendar','toolbar=no,location=no,";
			$search_results[$count]['search_link'] .= "status=no,menubar=no,scrollbars=yes,resizable=no',".$CONFIG_EXT['popup_event_width'].",".$CONFIG_EXT['popup_event_height'].",false)\"";
		} else {
			$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page']."&amp;extmode=view&amp;extid=".$row->extid.(!empty($row->recur_type) ? "&amp;recurdate=$next_recurrence_stamp" : '') );
			$search_results[$count]['search_link'] = "href='$sef_href'";
		}

  		$description = process_content(format_text(sub_string($row->description,100,"..."),false,false));

		$search_results[$count]['search_desc'] = highlight($extcal_search,$description,"<span class='highlight'>","</span>");
		
		$search_results[$count]['cat_id'] = $row->cat;
		$search_results[$count]['cat_name'] = $row->cat_name;
		if (!empty($row->recur_type)) $search_results[$count]['date'] = strftime( $lang_date_format['day_month_year'], $next_recurrence_stamp );
		else $search_results[$count]['date'] = strftime( $lang_date_format['day_month_year'], mktime(12,0,0,$row->month,$row->day,$row->year) );
		$count++;
	}

}

theme_search_results($search_results, $num_rows);
?>
