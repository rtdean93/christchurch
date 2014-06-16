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
File Description: functions.inc.php - General functions
$Id: functions.inc.php,v 1.47 2005/02/13 10:12:14 simoami Exp $

Modified significantly for Mambo compatibility by
Matt Friedman.
Revision date: 5/22/2005

**********************************************
Get the latest version of ExtCalendar at:
http://extcal.sourceforge.net
**********************************************
*/

function mf_process_category_date(&$row) {
// Added this function to handle custom display of event dates in the view-by-category events list,
// so that it displays recurrent events properly.

global $lang_add_event_view, $lang_event_view, $lang_general, $lang_date_format, $CONFIG_EXT, $next_recurrence_stamp;

$return_date_string = '';
$showrecurrence = $CONFIG_EXT['show_recurrence_info_category_view'];

switch ($row->recur_type) {
	case 'day': // daily
		if ( $row->recur_val == 1 ) {
			$return_date_string .= ( $showrecurrence ? mf_get_recurrence_info_string($row) : mf_get_next_recurrence($row,'%A, %B %d, %Y') ).' ('.mf_get_time_from_datetime($row->start_date).')';
			$next_recurrence_stamp = 1;
		} else {
			$return_date_string .= mf_get_next_recurrence($row,'%A, %B %d, %Y').' ('.mf_get_time_from_datetime($row->start_date).')<br />';
			if ($showrecurrence) $return_date_string .= mf_get_recurrence_info_string($row);
		}
		break;
	case 'week': // weekly
			$return_date_string .= mf_get_next_recurrence($row,'%A, %B %d, %Y').' ('.mf_get_time_from_datetime($row->start_date).')<br />';
			if ($showrecurrence) $return_date_string .= mf_get_recurrence_info_string($row);
		break;
	case 'month': // monthly
			$return_date_string .= mf_get_next_recurrence($row,'%A, %B %d, %Y').' ('.mf_get_time_from_datetime($row->start_date).')<br />';
			if ($showrecurrence) $return_date_string .= mf_get_recurrence_info_string($row);
		break;
	case 'year': // yearly
			$return_date_string .= mf_get_next_recurrence($row,'%A, %B %d, %Y').' ('.mf_get_time_from_datetime($row->start_date).')<br />';
			if ($showrecurrence) $return_date_string .= mf_get_recurrence_info_string($row);
		break;
	case '':
	default:
		$next_recurrence_stamp = mf_convert_to_timestamp($row->start_date);
		$return_date_string .= ucwords(strftime($lang_date_format['full_date'], $next_recurrence_stamp)).' ('.mf_get_time_from_datetime($row->start_date).')';
		break;
}

return $return_date_string;

}

function mf_get_recurrence_info_string(&$row) {

global $lang_add_event_view, $lang_event_view, $lang_general, $lang_date_format, $next_recurrence_stamp;

switch ($row->recur_type) {
	case 'day': // daily
		if ( $row->recur_val == 1 ) {
			$return_recur_info .= $lang_general['everyday'];
		} else {
			$return_recur_info .= $lang_add_event_view['repeat_every'].' '.$row->recur_val.' '.$lang_general['days'];
		}
		$return_recur_info .= mf_until_enddate_string($row,'%B %d, %Y');
		break;
	case 'week': // weekly
		if ( $row->recur_val == 1 ) {
			$daynumber = date('w',mf_convert_to_timestamp($row->start_date,'dateonly'));
			$return_recur_info .= $lang_add_event_view['repeat_every'].' '.$lang_date_format['day_of_week'][$daynumber];
		} else {
			$return_recur_info .= $lang_add_event_view['repeat_every'].' '.$row->recur_val.' '.$lang_add_event_view['repeat_weeks'];
		}
		$return_recur_info .= mf_until_enddate_string($row,'%B %d, %Y');
		break;
	case 'month': // monthly
		if ( $row->recur_val == 1 ) {
			$return_recur_info .= $lang_general['everymonth'];
		} else {
			$return_recur_info .= $lang_add_event_view['repeat_every'].' '.$row->recur_val.' '.$lang_general['months'];
		}
		$return_recur_info .= mf_until_enddate_string($row,'%B %d, %Y');
		break;
	case 'year': // yearly
		if ( $row->recur_val == 1 ) {
			$return_recur_info .= $lang_general['everyyear'];
		} else {
			$return_recur_info .= $lang_add_event_view['repeat_every'].' '.$row->recur_val.' '.$lang_general['years'];
		}
		$return_recur_info .= mf_until_enddate_string($row,'%B %d, %Y');
		break;
	case '':
	default:
		$return_recur_info .= $lang_add_event_view['event_no_repeat_msg'];
		break;
}

return $return_recur_info;

}

function mf_until_enddate_string(&$event, $date_format=false) {
// Used by mf_process_category_date() to calculate the end date of recurring events.

	global $lang_date_format, $lang_event_view;

	$return_string = '';
	$date_format = $date_format ? $date_format : $lang_date_format['full_date'];

	if ($event->recur_end_type) { 
		$return_string .= ' '.strtolower($lang_event_view['event_end_date']) . ' ' . ucwords(strftime($date_format, mf_convert_to_timestamp($event->recur_until,'dateonly')));
	}

	return $return_string;

}

function mf_convert_to_timestamp($timedatestring, $filter = 'dateandtime') {
// Takes a string in the typical SQL date or datetime format and returns a UNIX timestamp

	$datestring = substr($timedatestring,0,10);
	$datestringArray = explode('-',$datestring);

	$timestring = @substr($timedatestring,-8,8);
	$timestringArray = explode(':',$timestring);

	if ( $filter == 'dateonly' ) {
		return mktime(0,0,0,$datestringArray[1],$datestringArray[2],$datestringArray[0]);
	} else if ( $filter == 'timeonly' ) {
		return mktime($timestringArray[0],$timestringArray[1],$timestringArray[2],01,01,1970);
	} else {
		return mktime($timestringArray[0],$timestringArray[1],$timestringArray[2],$datestringArray[1],$datestringArray[2],$datestringArray[0]);
	}
}

function mf_get_time_from_datetime($timedatestring) {
	global $CONFIG_EXT;

	$timestring = substr($timedatestring,-8,8);
	$timestringArray = explode(':',$timestring);

	if ( $CONFIG_EXT['time_format_24hours'] ) {
		return strftime('%H:%M',mktime($timestringArray[0],$timestringArray[1],$timestringArray[2],01,01,1970));
	} else {
		$returntime = strftime('%I:%M %p',mktime($timestringArray[0],$timestringArray[1],$timestringArray[2],01,01,1970));
		// Don't include the leading zero in 12-hour time:
		return (substr($returntime,0,1) == '0') ? substr($returntime,1) : $returntime;
	}
}

function mf_get_timerange(&$event) {
// Takes an event that has been loaded as an ExtCal_Event class instance
	global $CONFIG_EXT;

	if ( $event->end_date == '0000-00-00 00:00:00' || $CONFIG_EXT['show_only_start_times'] ) return str_replace(' ','&nbsp;',mf_get_time_from_datetime($event->start_date));
		// If the event spans more than one day, don't use the end time:
	else if ( substr($event->start_date,0,10) < substr($event->end_date,0,10) ) return str_replace(' ','&nbsp;',mf_get_time_from_datetime($event->start_date));
		// If the event is an "all day" event, return that:
	else if ( $event->end_date == '0000-00-00 00:00:01' ) return EXTCAL_TEXT_ALL_DAY;
	else return str_replace(' ','&nbsp;',mf_get_time_from_datetime($event->start_date) . ' - ' . mf_get_time_from_datetime($event->end_date));

}

function mf_get_next_recurrence(&$thisEvent,$specialformat=false) {
	global $next_recurrence_stamp;

	// Now we load the whole event class, along with all its methods, so we can speed our calculations:
	$event = new ExtCal_Event();
	$event->loadEvent($thisEvent->extid);
	
	// We're going to loop through all the possible days between now and the next recurrence, so let's set the limit:
	switch ( $event->recType ) {
		case 'day': // daily
			$count_until = $event->recInterval;
			break;
		case 'week': // weekly
			$count_until = $event->recInterval * 7;
			break;
		case 'month': // monthly
			$count_until = $event->recInterval * 31;
			break;
		case 'year': // yearly
			$count_until = $event->recInterval * 365;
			break;
		default:
			$count_until = $event->recInterval;
			break;
	}

	// Today:
	$timestamp = mktime();

	// Now we loop through all possible future days to find next recurrence.
	//  There's a MUCH easier way, I know, but I can't think of one:
	for ($i=0;$i<$count_until;$i++) {
		if ($event->isRecurrentOn($timestamp)) {
			$next_recurrence_stamp = $timestamp;
			return ($specialformat) ? strftime($specialformat,$timestamp) : $timestamp;
			break;
		}
		$timestamp += 86400;
	}
	return 'No Recurrence Found';
}

function require_login() {
/* this function checks to see if the user is logged in.  if not, it will show
 * the login screen before allowing the user to continue */
	global $CONFIG_EXT, $my, $database, $lang_system, $lang_general;

	if (!USER_IS_LOGGED_IN) {
		//$_SESSION["wantsurl"] = qualified_me();
		pageheader($lang_system['system_caption']);
		$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
		theme_redirect_dialog($lang_system['system_caption'], $lang_system['page_requires_login'], $lang_general['continue'], $sef_href);
		return false;
	}
}

function require_priv($priv) {
    global $CONFIG_EXT, $database, $my, $lang_system, $lang_general;
/* this function checks to see if the user has the privilege $priv.  if not,
 * it will display an Insufficient Privileges page and stop */
// Revised to use new USER_IS_ADMIN global constant, which was set in config.inc.php
// using Mambo's usertype value. Does NOT have fancy code to allow "XXX type and up"
// to access page--just checks to see if you ARE that type or an Admin, and then lets
// you through. With one exception: if the privilege is set to "Registered" then anybody
// who's logged in gets through. NOTE that this differs from has_priv() in that if the user
// does NOT have the privilege, it gives them a warning screen before returning false.

	if ($priv == "Anyone") { return true; }
	else if (($priv == "Registered") && USER_IS_LOGGED_IN) { return true; }
	else if (USER_IS_ADMIN || ($my->usertype == $priv)) { return true; }
	else {
		pageheader($lang_system['system_caption']);
		$mylevel = (($my->usertype == '') || !isset($my->usertype)) ? 'Anonymous Guest' : $my->usertype;
		$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'] );
		theme_redirect_dialog($lang_system['system_caption'], $lang_system['page_access_denied'] . '<br>Your user level is merely '.$mylevel.', and it must be at least '.$priv.'.', $lang_general['back'], $sef_href);
		return false;
	}
}

function has_priv($priv) {
    global $CONFIG_EXT, $database, $my, $lang_system, $lang_general;
/* returns true if the user has the privilege $priv */
// Revised to use new USER_IS_ADMIN global constant, which was set in config.inc.php
// using Mambo's usertype value. Does NOT have fancy code to allow "XXX type and up"
// to access page--just checks to see if you ARE that type or an Admin, and then lets
// you through. With one exception: if the privilege is set to "Registered" then anybody
// who's logged in gets through.

	if ($priv == "Anyone") { return true; }
	else if (($priv == "Registered") && USER_IS_LOGGED_IN) { return true; }
	else if (USER_IS_ADMIN || ($my->usertype == $priv)) { return true; }
	else { return false; }
}

// Search function 
function extcal_search()
{
	global $lang_event_search_data;
	$keyword = (isset($_POST["extcal_search"]) && !empty($_POST["extcal_search"])) ?$_POST["extcal_search"]:$lang_event_search_data['search_caption'];
	$button = (isset($_POST["extcal_search"]) && !empty($_POST["extcal_search"])) ?$lang_event_search_data['search_again']:$lang_event_search_data['search_button'];
	theme_search_form($keyword, $button);
}

// Error strings template
function theme_error_string($string) {
    global $template_error_string;

		$params = array('{MESSAGE}' => $string);
		return template_eval($template_error_string, $params);
}

function display_event_form($target, $extmode, $form, $event_mode = '') {
/* Display event form */
	
	global $CONFIG_EXT, $database, $THEME_DIR, $template_add_event_form, $errors, $today;
	global $lang_add_event_view, $lang_general, $lang_date_format, $lang_settings_data;

	// building category list
	$cat_id = $form['cat'];
	$cat_filter = "";
	if(!has_priv('can_manage_cats')) $cat_filter = " WHERE published = '1' OR cat_id = '$cat_id'";
	$query = "SELECT * FROM ".$CONFIG_EXT['TABLE_CATEGORIES'] . $cat_filter;
	$result = extcal_db_query($query);
	$cat_list = '';
	while ($row = extcal_db_fetch_object($result))
	{
		$selected = "";
		if(isset($form['cat']))
			$selected = ($row->cat_id == $form['cat'])?"selected":"";
		$cat_list .= "\t<option value='".$row->cat_id."' style='color: " . $row->color . "' $selected>".$row->cat_name."\n";
	}

	// building day list
	$day_list = '';
	for ($i = 1;$i<=31;$i++)
	{
		$selected = ($form['day']==$i)?"selected":"";
		$day_list .= "\t<option value='$i' $selected>$i</option>\n";
	}

	// building month list
	$month_list = '';
	for($i=1;$i<=12;$i++)
	{
		$selected = ($form['month'] == $i)?"selected":"";
		$month_list .= "\t<option value='".$i."' $selected>".$lang_date_format['months'][$i-1]."</option>\n";
	}

	// building year list
	$year_list = '';
	$y = date("Y", extcal_get_local_time()) - 1;
	for ($i=0;$i<=4;$i++)
	{
		$selected = ($form['year']==$y)?"selected":"";
		$year_list .= "\t<option $selected>$y</option>\n";
		$y += 1;
	}
	
	// building time list options
	if($CONFIG_EXT['time_format_24hours']) {
		$hour_init = 0;
		$hour_limit = 23;
	} else {
		$hour_init = 1;
		$hour_limit = 12;
	}
	$start_hour_list = '';
	for ($i = $hour_init;$i<=$hour_limit;$i++)
	{
		$selected = ($form['start_time_hour'] == $i)?"selected":"";
		$start_hour_list .= "\t<option value='$i' $selected>".sprintf("%02d",$i)."</option>\n";
	}
	$start_minute_list = '';
	for ($i = 0;$i<=59;$i+=15)
	{
		$selected = ($form['start_time_minute'] == $i)?"selected":"";
		$start_minute_list .= "\t<option value='$i' $selected>".sprintf("%02d",$i)."</option>\n";
	}

	if(!$CONFIG_EXT['time_format_24hours']) {
		$selected = ($form['start_time_ampm'] == 'am')?"selected":"";
		$start_ampm_list = "\t<option value='am' $selected>AM</option>\n";
		$selected = ($form['start_time_ampm'] == 'pm')?"selected":"";
		$start_ampm_list .= "\t<option value='pm' $selected>PM</option>\n";
	} else {
		$start_ampm_list = '';
	}

	// building recurrence info
	$recur_type_1_options = '';
	$selected = ($form['recur_type_1'] == "day")?"selected":"";
	$recur_type_1_options .= "\t<option value='day' ".$selected.">".$lang_add_event_view['repeat_days']."\n";
	$selected = ($form['recur_type_1'] == "week")?"selected":"";
	$recur_type_1_options .= "\t<option value='week' ".$selected.">".$lang_add_event_view['repeat_weeks']."\n";
	$selected = ($form['recur_type_1'] == "month")?"selected":"";
	$recur_type_1_options .= "\t<option value='month' ".$selected.">".$lang_add_event_view['repeat_months']."\n";
	$selected = ($form['recur_type_1'] == "year")?"selected":"";
	$recur_type_1_options .= "\t<option value='year' ".$selected.">".$lang_add_event_view['repeat_years']."\n";

	// building day list
	$recur_until_day_list = '';
	for ($i = 1;$i<=31;$i++)
	{
		$selected = ($form['recur_until_day']==$i)?"selected":"";
		$recur_until_day_list .= "\t<option value='$i' $selected>$i</option>\n";
	}

	// building month list
	$recur_until_month_list = '';
	for($i=1;$i<=12;$i++)
	{
		$selected = ($form['recur_until_month'] == $i)?"selected":"";
		$recur_until_month_list .= "\t<option value='".$i."' $selected>".$lang_date_format['months'][$i-1]."</option>\n";
	}

	// building year list
	$recur_until_year_list = '';
	$y = date("Y", extcal_get_local_time());
	for ($i=0;$i<=4;$i++)
	{
		$selected = ($form['recur_until_year']==$y)?"selected":"";
		$recur_until_year_list .= "\t<option $selected>$y</option>\n";
		$y += 1;
	}


	$auto_approve = (isset($form['autoapprove']) && $form['autoapprove'])?"checked":"";
	$del_picture = (isset($form['delpicture']) && $form['delpicture'])?"checked":"";
		
	// building upload requirements
	$extensions = explode('/', $CONFIG_EXT['allowed_file_extensions']);
	$upload_reqs = sprintf($lang_add_event_view['file_upload_info'], ($CONFIG_EXT['max_upl_size'] / 1000), strtoupper(implode($extensions," ")) );
	
	$orig_picture = isset($form['origpicture'])?$form['origpicture']:"";
	
	if(!has_priv("Administrator")) template_extract_block($template_add_event_form, 'admin_row');
	if(!$errors) template_extract_block($template_add_event_form, 'errors_row');
	if(!$CONFIG_EXT['addevent_allow_contact']) template_extract_block($template_add_event_form, 'contact_row');
	if(!$CONFIG_EXT['addevent_allow_email']) template_extract_block($template_add_event_form, 'email_row');
	if(!$CONFIG_EXT['addevent_allow_url']) template_extract_block($template_add_event_form, 'url_row');
	if(!$CONFIG_EXT['addevent_allow_picture']) template_extract_block($template_add_event_form, 'picture_row');
	if(!$CONFIG_EXT['addevent_allow_html']) template_extract_block($template_add_event_form, 'bbcode_funcs_row');
	if(!isset($form['origpicture']) || !$form['origpicture']) template_extract_block($template_add_event_form, 'orig_picture_row');

	switch($event_mode) {
		case "edit":
			$title = format_text($form['title'],false,$CONFIG_EXT['capitalize_event_titles']);
			starttable("100%", sprintf($lang_add_event_view['edit_event'],$form['extid'],$title),2);
			$submit = $lang_add_event_view['update_event_button'];
			break;
		case "add": 
		default:
			starttable("100%",$lang_add_event_view['section_title'],2);
			$submit = $lang_add_event_view['section_title'];
	}
	if($CONFIG_EXT['time_format_24hours']) template_extract_block($template_add_event_form, '12hour_mode_row'); 
	
	$params = array(
		'{TARGET}' => $target,
		'{THEME_DIR}' => $THEME_DIR,
		'{MODE}' => $extmode,
		'{EVENT_ID}' => isset($form['extid'])?$form['extid']:"",
		'{ERRORS}' => $lang_general['errors'],
		'{ERROR_MSG}' => $errors,
		'{EVENT_DETAILS_CAPTION}' => $lang_add_event_view['event_details_label'],
		'{TITLE_LABEL}' => $lang_add_event_view['event_title'],
		'{TITLE_VAL}' => isset($form['title'])?$form['title']:"",
		'{DESC_LABEL}' => $lang_add_event_view['event_desc'],
		'{DESC_VAL}' => isset($form['description'])?$form['description']:"",
		'{SEL_CATS_LABEL}' => $lang_add_event_view['event_cat'],
		'{SEL_CATS_DEF}' => $lang_add_event_view['choose_cat'],
		'{SEL_CATS_VAL}' => $cat_list,
		'{DATE_LABEL}' => $lang_add_event_view['event_date'],
		'{DAY_LABEL}' => $lang_add_event_view['day_label'],
		'{MONTH_LABEL}' => $lang_add_event_view['month_label'],
		'{YEAR_LABEL}' => $lang_add_event_view['year_label'],
		'{START_DATE_LABEL}' => $lang_add_event_view['start_date_label'],
		'{START_TIME_LABEL}' => $lang_add_event_view['start_time_label'],
		'{END_DATE_LABEL}' => $lang_add_event_view['end_date_label'],
		'{DAYS_LABEL}' => $lang_general['days'],
		'{HOURS_LABEL}' => $lang_general['hours'],
		'{MINUTES_LABEL}' => $lang_general['minutes'],
		'{ALL_DAY_LABEL}' => $lang_add_event_view['all_day_label'],
		'{NO_DURATION_LABEL}' => $lang_add_event_view['repeat_end_date_none'].' ('.$lang_settings_data['multi_day_events_start'].')',
		'{DURATION_TYPE_NORMAL_CHECKED}' => ((int)$form['duration_type'] == 1)?'checked':'',
		'{DURATION_TYPE_NONE_CHECKED}' => ((int)$form['duration_type'] == 0)?'checked':'',
		'{DURATION_TYPE_ALLDAY_CHECKED}' => ((int)$form['duration_type'] == 2)?'checked':'',
		'{START_DAY_VAL}' => $day_list,
		'{START_MONTH_VAL}' => $month_list,
		'{START_YEAR_VAL}' => $year_list,
		'{START_HOUR_VAL}' => $start_hour_list,
		'{START_MINUTE_VAL}' => $start_minute_list,
		'{START_AMPM_VAL}' => $start_ampm_list,
		'{DAYS_VAL}' => $form['end_days'],
		'{HOURS_VAL}' => $form['end_hours'],
		'{MINUTES_VAL}' => $form['end_minutes'],
		'{CONTACT_CAPTION}' => $lang_add_event_view['contact_details_label'],
		'{CONTACT_LABEL}' => $lang_add_event_view['contact_info'],
		'{CONTACT_VAL}' => isset($form['contact'])?$form['contact']:"",
		'{EMAIL_LABEL}' => $lang_add_event_view['contact_email'],
		'{EMAIL_VAL}' => isset($form['email'])?$form['email']:"",
		'{URL_LABEL}' => $lang_add_event_view['contact_url'],
		'{URL_VAL}' => isset($form['url'])?$form['url']:"",
		'{OTHERS_CAPTION}' => $lang_add_event_view['other_details_label'],
		'{CURRENT_PIC_LABEL}' => $lang_add_event_view['picture_file'],
		'{CURRENT_PIC}' => $CONFIG_EXT['UPLOAD_DIR_URL'] . $orig_picture,
		'{DEL_PIC_LABEL}' => $lang_add_event_view['del_picture'],
		'{DEL_PIC_STATUS}' => $del_picture,
		'{ORIG_PICTURE}' => $orig_picture,
		'{UPLOAD_LABEL}' => $lang_add_event_view['picture_file'],
		'{UPLOAD_REQS}' => $upload_reqs,
		'{ADMIN_CAPTION}' => $lang_add_event_view['admin_options_label'],
		'{AUTO_APPR_LABEL}' => $lang_add_event_view['auto_appr_event'],
		'{AUTO_APPR_STATUS}' => $auto_approve,
		'{SUBMIT}' => $submit,
		'{RECUR_CAPTION}' => $lang_add_event_view['repeat_event_label'],
		'{RECUR_METHOD_CAPTION}' => $lang_add_event_view['repeat_method_label'],
		'{EXPAND}' => $lang_general['expand'],
		'{COLLAPSE}' => $lang_general['collapse'],
		'{RECURRENCE_CLOSE_SECTION}' => get_display_style('recurrence','close'),
		'{RECURRENCE_OPEN_SECTION}' => get_display_style('recurrence','open'),
		'{RECURRENCE_MESSAGE}' => !empty($form['recur_type_select'])?$lang_add_event_view['event_repeat_msg']:$lang_add_event_view['event_no_repeat_msg'],
		'{RECUR_TYPE_NONE}' => $lang_add_event_view['repeat_none'],
		'{RECUR_TYPE_NONE_CHECKED}' => !((int)$form['recur_type_select'])?"checked":"",
		'{RECUR_TYPE_1_CHECKED}' => ((int)$form['recur_type_select'] == 1)?"checked":"",
		'{RECUR_EVERY}' => $lang_add_event_view['repeat_every'],
		'{RECUR_VAL_1}' => $form['recur_val_1'],
		'{RECUR_TYPE_1_OPTIONS}' => $recur_type_1_options,
		'{RECUR_END_DATE_CAPTION}' => $lang_add_event_view['repeat_end_date_label'],
		'{RECUR_END_DATE_NONE_CHECKED}' => !((int)$form['recur_end_type'])?"checked":"",
		'{RECUR_END_DATE_NONE}' => $lang_add_event_view['repeat_end_date_none'],
		'{RECUR_END_DATE_COUNT_CHECKED}' => ((int)$form['recur_end_type'] == 1)?"checked":"",
		'{RECUR_END_DATE_COUNT}' => sprintf($lang_add_event_view['repeat_end_date_count'],'<input type="text" name="recur_end_count" value="'.$form['recur_end_count'].'" size="2" class="textinput">'),
		'{RECUR_END_DATE_UNTIL_CHECKED}' => ((int)$form['recur_end_type'] == 2)?"checked":"",
		'{RECUR_END_DATE_UNTIL}' => $lang_add_event_view['repeat_end_date_until'],
		'{RECUR_UNTIL_DAY_VAL}' => $recur_until_day_list,
		'{RECUR_UNTIL_MONTH_VAL}' => $recur_until_month_list,
		'{RECUR_UNTIL_YEAR_VAL}' => $recur_until_year_list
		
	);
	echo template_eval($template_add_event_form, $params);
	endtable();
}
	
function display_cat_form($target, $extmode, $form) {
/* Display category form */
	global $CONFIG_EXT, $database, $template_cat_form, $THEME_DIR, $errors, $lang_cat_admin_data, $lang_general;
	// build category list

	$admin_auto_approve = (isset($form['adminapproved']) && $form['adminapproved'])?"checked":"";
	$user_auto_approve = (isset($form['userapproved']) && $form['userapproved'])?"checked":"";
	$cat_status = (isset($form['published']) && $form['published'])?"checked":"";	

	if(!$errors) template_extract_block($template_cat_form, 'errors_row');

	switch($extmode) {
		case "add": 
			starttable("600",$lang_cat_admin_data['add_cat'],2);
			$submit = $lang_cat_admin_data['add_cat'];
			break;
		case "edit":
			starttable("600",$lang_cat_admin_data['edit_cat']." [id{$form['cat_id']}] '{$form['cat_name']}'",2);
			$submit = $lang_cat_admin_data['update_cat'];
			break;

		default:
			starttable("600",$lang_cat_admin_data['add_cat'],2);
			$submit = $lang_cat_admin_data['add_cat'];
	}

	$params = array(
		'{TARGET}' => $target,
		'{MODE}' => $extmode,
		'{CAT_ID}' => isset($form['cat_id'])?$form['cat_id']:"",
		'{ERRORS}' => $lang_general['errors'],
		'{ERROR_MSG}' => $errors,
		'{CAT_DETAILS_CAPTION}' => $lang_cat_admin_data['general_info_label'],
		'{CAT_NAME_LABEL}' => $lang_cat_admin_data['cat_name'],
		'{CAT_NAME_VAL}' => isset($form['cat_name'])?$form['cat_name']:"",
		'{DESC_LABEL}' => $lang_cat_admin_data['cat_desc'],
		'{DESC_VAL}' => isset($form['description'])?$form['description']:"",
		'{COLOR_LABEL}' => $lang_cat_admin_data['cat_color'],
		'{COLOR}' => isset($form['color'])?$form['color']:"",
		'{PICK_COLOR_ICON}' => $THEME_DIR . "/images/icon-colorpicker.gif",
		'{PICK_COLOR_LNK}' => $CONFIG_EXT['calendar_url']."include/colorpicker.php",
		'{PICK_COLOR}' => $lang_cat_admin_data['pick_color'],
		'{STATUS_LABEL}' => $lang_cat_admin_data['status_label'],
		'{STATUS_CHK}' => $cat_status,
		'{STATUS_ACTIVE_LABEL}' => $lang_cat_admin_data['active_label'],
		'{ADMIN_CAPTION}' => $lang_cat_admin_data['admin_label'],
		'{USR_APPR_LABEL}' => $lang_cat_admin_data['auto_user_appr'],
		'{ADMIN_APPR_LABEL}' => $lang_cat_admin_data['auto_admin_appr'],
		'{ADMIN_APPR_CHK}' => $admin_auto_approve,
		'{USR_APPR_CHK}' => $user_auto_approve,
		'{SUBMIT}' => $submit
	);

	echo template_eval($template_cat_form, $params);
	endtable();
}

function display_user_form($target, $extmode, $form) {
/* Display user form */
	
	global $CONFIG_EXT, $database, $template_user_form, $THEME_DIR, $errors, $lang_user_admin_data, $lang_general;

	// build group list
	$query = "SELECT group_id, group_name FROM ".$CONFIG_EXT['TABLE_GROUPS'];
	$result = extcal_db_query($query);
	$group_list = "\t<option value='' style='color: #666666'>".$lang_user_admin_data['select_group']."</option>\n";
	while ($row = extcal_db_fetch_object($result))
	{
		$selected = "";
		if(isset($form['group_id']))
			$selected = ($row->group_id == $form['group_id'])?"selected":"";
		$group_list .= "\t<option value='".$row->group_id."' $selected>".$row->group_name."</option>\n";
	}

	$user_status = (isset($form['user_status']) && $form['user_status'])?"checked":"";	
	if(!$errors) template_extract_block($template_user_form, 'errors_row');

	switch($extmode) {
		case "add": 
			starttable("100%",$lang_user_admin_data['add_user'],2);
			$submit = $lang_user_admin_data['add_user'];
			template_extract_block($template_user_form, 'static_username_row');
			template_extract_block($template_user_form, 'info_row');
			break;
		case "edit":
			starttable("100%", $lang_user_admin_data['edit_user']." [id{$form['user_id']}] '{$form['username']}'",2);
			$submit = $lang_user_admin_data['update_user'];
			template_extract_block($template_user_form, 'dynamic_username_row');
			break;

		default:
			starttable("100%",$lang_user_admin_data['add_user'],2);
			$submit = $lang_user_admin_data['add_user'];
	}
	
	$info_msg = $lang_user_admin_data['update_pass_info'];
	
	$params = array(
		'{TARGET}' => $target,
		'{MODE}' => $extmode,
		'{USER_ID}' => isset($form['user_id'])?$form['user_id']:"",
		'{ERRORS}' => $lang_general['errors'],
		'{ERROR_MSG}' => $errors,
		'{INFO}' => $lang_general['info'],
		'{INFO_MSG}' => $info_msg,
		'{ACCOUNT_INFO_CAPTION}' => $lang_user_admin_data['account_info_label'],
		'{USER_NAME_LABEL}' => $lang_user_admin_data['user_name'],
		'{USER_NAME_VAL}' => isset($form['username'])?$form['username']:"",
		'{USER_PASS_LABEL}' => $lang_user_admin_data['user_pass'],
		'{USER_PASS_VAL}' => isset($form['password'])?$form['password']:"",
		'{USER_PASS_CONFIRM_LABEL}' => $lang_user_admin_data['user_pass_confirm'],
		'{USER_PASS_CONFIRM_VAL}' => isset($form['password_confirm'])?$form['password_confirm']:"",
		'{USER_EMAIL_LABEL}' => $lang_user_admin_data['user_email'],
		'{USER_EMAIL_VAL}' => isset($form['email'])?$form['email']:"",
		'{GROUP_LABEL}' => $lang_user_admin_data['group_label'],
		'{GROUP_VAL}' => $group_list,
		'{STATUS_LABEL}' => $lang_user_admin_data['status_label'],
		'{STATUS_CHK}' => $user_status,
		'{STATUS_ACTIVE_LABEL}' => $lang_user_admin_data['active_label'],
		'{OTHER_DETAILS_CAPTION}' => $lang_user_admin_data['other_details_label'],
		'{USER_FNAME_LABEL}' => $lang_user_admin_data['first_name'],
		'{USER_FNAME_VAL}' => isset($form['firstname'])?$form['firstname']:"",
		'{USER_LNAME_LABEL}' => $lang_user_admin_data['last_name'],
		'{USER_LNAME_VAL}' => isset($form['lastname'])?$form['lastname']:"",
		'{USER_WEBSITE_LABEL}' => $lang_user_admin_data['user_website'],
		'{USER_WEBSITE_VAL}' => isset($form['user_website'])?$form['user_website']:"",
		'{USER_LOCATION_LABEL}' => $lang_user_admin_data['user_location'],
		'{USER_LOCATION_VAL}' => isset($form['user_location'])?$form['user_location']:"",
		'{USER_OCCUPATION_LABEL}' => $lang_user_admin_data['user_occupation'],
		'{USER_OCCUPATION_VAL}' => isset($form['user_occupation'])?$form['user_occupation']:"",
		'{SUBMIT}' => $submit
	);

	echo template_eval($template_user_form, $params);
	endtable();
}

function display_group_form($target, $extmode, $form) {
/* Display group form */
	
	global $CONFIG_EXT, $database, $template_group_form, $THEME_DIR, $errors, $lang_group_admin_data, $lang_general;

	$Administrator = (isset($form['Administrator']) && $form['Administrator'])?"checked":"";
	$can_manage_accounts = (isset($form['can_manage_accounts']) && $form['can_manage_accounts'])?"checked":"";
	$can_change_settings = (isset($form['can_change_settings']) && $form['can_change_settings'])?"checked":"";	
	$can_manage_cats = (isset($form['can_manage_cats']) && $form['can_manage_cats'])?"checked":"";	
	$upl_need_approval = (isset($form['upl_need_approval']) && $form['upl_need_approval'])?"checked":"";	

	if(!$errors) template_extract_block($template_group_form, 'errors_row');

	switch($extmode) {
		case "add": 
			starttable("100%",$lang_group_admin_data['add_group'],2);
			$submit = $lang_group_admin_data['add_group'];
			break;
		case "edit":
			starttable("100%",$lang_group_admin_data['edit_group']." [id{$form['group_id']}] '{$form['group_name']}'",2);
			$submit = $lang_group_admin_data['update_group'];
			break;

		default:
			starttable("100%",$lang_group_admin_data['add_group'],2);
			$submit = $lang_group_admin_data['add_group'];
	}

	$params = array(
		'{TARGET}' => $target,
		'{MODE}' => $extmode,
		'{GROUP_ID}' => isset($form['group_id'])?$form['group_id']:"",
		'{ERRORS}' => $lang_general['errors'],
		'{ERROR_MSG}' => $errors,
		'{GROUP_DETAILS_CAPTION}' => $lang_group_admin_data['general_info_label'],
		'{GROUP_NAME_LABEL}' => $lang_group_admin_data['group_name'],
		'{GROUP_NAME_VAL}' => isset($form['group_name'])?$form['group_name']:"",
		'{DESC_LABEL}' => $lang_group_admin_data['group_desc'],
		'{DESC_VAL}' => isset($form['description'])?$form['description']:"",
		'{ACCESS_LEVEL_CAPTION}' => $lang_group_admin_data['access_level_label'],
		'{Administrator_LABEL}' => $lang_group_admin_data['Administrator'],
		'{Administrator_CHK}' => $Administrator,
		'{CAN_MANAGE_ACCOUNTS_LABEL}' => $lang_group_admin_data['can_manage_accounts'],
		'{CAN_MANAGE_ACCOUNTS_CHK}' => $can_manage_accounts,
		'{CAN_CHANGE_SETTINGS_LABEL}' => $lang_group_admin_data['can_change_settings'],
		'{CAN_CHANGE_SETTINGS_CHK}' => $can_change_settings,
		'{CAN_MANAGE_CATS_LABEL}' => $lang_group_admin_data['can_manage_cats'],
		'{CAN_MANAGE_CATS_CHK}' => $can_manage_cats,
		'{UPL_NEED_APPROVAL_LABEL}' => $lang_group_admin_data['upl_need_approval'],
		'{UPL_NEED_APPROVAL_CHK}' => $upl_need_approval,
		'{SUBMIT}' => $submit
	);

	echo template_eval($template_group_form, $params);
	endtable();
}

// function to display a legend of categories
function display_cat_legend ($colspan = '', $today = false)
{
	global $CONFIG_EXT, $database;
	
	$categories = get_active_categories();
	theme_cat_legend ($categories, $colspan, $today);
}

// HTML template for the list of categories and their corresponding colors
function theme_cat_legend ($categories, $colspan = '', $today = false)
{
	global $template_cat_legend, $CONFIG_EXT, $lang_general, $todayclr;
	if(!$colspan) $colspan = "1";
	
	$template_cat_legend1 = $template_cat_legend;
	$header_row = template_extract_block($template_cat_legend1, 'header_row');
	$start_col_row = template_extract_block($template_cat_legend1, 'start_col_row');
	$end_col_row = template_extract_block($template_cat_legend1, 'end_col_row');
	$today_row = template_extract_block($template_cat_legend1, 'today_row');
	$cats_row = template_extract_block($template_cat_legend1, 'cats_row');
	$empty_cell_row = template_extract_block($template_cat_legend1, 'empty_cell_row');
	$footer_row = template_extract_block($template_cat_legend1, 'footer_row');

	$columns = 4;
	
	
	
	$params = array(
		'{ROWS}' => $colspan
	);
	echo template_eval($header_row, $params);

	$cat_count = count($categories); // 
	$rows = ceil(( $cat_count + 1) / $columns); // total number of rows
	$row = 0; // used to count rows in <tr> loop

	while($row < $rows) {
		echo $start_col_row;
		for($column=0;$column < $columns;$column++ ) {
			if($today && $column == 0 && $row == 0) {
				$params = array(
					'{TODAY}' => $lang_general['today'],
					'{COLOR}' => $todayclr
				);
				echo template_eval($today_row, $params);
			} elseif($cat_count) {
				list(,$category) = each($categories);
				$sef_href = sefRelToAbs( $CONFIG_EXT['calendar_calling_page'].'&amp;extmode=cat&amp;cat_id='.$category['cat_id'] );
				$params = array(
					'{CAT_NAME}' => $category["cat_name"],
					'{CAT_LINK}' => 'href="'.$sef_href .'"',
					'{COLOR}' => $category['color']
				);
				echo template_eval($cats_row, $params);
				$cat_count--;
			} else 	echo $empty_cell_row;
		}
		echo $end_col_row;
		$row++; // increase row number for next loop
	}
	echo $footer_row;
}

// Eval a template (substitute vars with values)
function template_eval(&$template, &$vars)
{
        return strtr($template, $vars);
}


// Extract and return block '$block_name' from the template, the block is replaced by $subst
function template_extract_block(&$template, $block_name, $subst='')
{
        if(!$template) return;
        $pattern = "#(<!-- BEGIN $block_name -->)(.*?)(<!-- END $block_name -->)#s";
        if ( !preg_match($pattern, $template, $matches)){
                die ('<b>Template error<b><br />Failed to find block \''.$block_name.'\' in :<br /><pre>'.htmlspecialchars($template).'</pre>');
        }
        $template = str_replace($matches[1].$matches[2].$matches[3], $subst, $template);
        return $matches[2];
}

// Highlight found keywords in a given string and return the processed string 
function highlight($keyword,$string,$startTag,$endTag)
{
	$newString = "";
	$positions = array();
	$lastPos = 0;
	$stringLength = strlen($string);
	$length = strlen($keyword);
	$start = strpos(strtolower($string), strtolower($keyword));

	if (is_integer($start)) {
		$positions[] = $start; 
	}

	while(is_integer($start = strpos(substr(strtolower($string),$start+$length), strtolower($keyword))))
	{
		if (is_integer($start)) {
			$count=count($positions) - 1;
			$start = $positions[$count]+$start+$length;
			$positions[] = $start;
		}
	}

	if(count($positions))
	{
		foreach($positions as $pos) {
			$newString .= substr($string,$lastPos,$pos - $lastPos).$startTag.substr($string,$pos,$length).$endTag;
			$lastPos = $pos +$length;
		}
	}

	$newString .= substr($string,$lastPos,$stringLength - $lastPos);
	return $newString;

}

function colorHighlight($hexColor) {
  // highlights a color by increasing it's luminosity
	$temp = hexdec(substr($hexColor, 1)) - hexdec("140A04");
	return "#".dechex($temp);
}

function extcal_get_local_time ($target_timezone = '') {
	global $CONFIG_EXT, $database;
	if(!$target_timezone) $target_timezone = $CONFIG_EXT['timezone'];
	$zonedate = mktime(gmdate('G'), gmdate('i'), gmdate('s'), gmdate('n'),
	gmdate('j'), gmdate('Y'), 0) + ($target_timezone * 3600);

	return $zonedate;
}

function extcal_12to24hour($hour,$extmode) {
	// converts 12hours format to 24hours
	if($extmode == 'am') return $hour%12;
	else return $hour%12 + 12;
}

function extcal_24to12hour($hour) {
	// converts 24hours format to 12hours with am/pm flag
	$new_time[0] = ($hour%12)?$hour%12:12;
	$new_time[1] = ($hour>12)?false:true; // AM (true) / PM (false)
	return $new_time;
}

function format_text($string,$no_slashes = false,$ucwords = false) {
	// processes a given text and returns it
	$string = ($ucwords)?ucwords($string):$string;
	//$string = nl2br(html_entities($string));
	$string = nl2br($string);
	if($no_slashes)
		$string = stripslashes($string);
	return $string;
}

function sub_string($string,$max,$suffix) {
	// returns a substring that may be encoded in utf-8 or other character encodings. 
	// and adds a suffix in case the substring is smaller than the original string 
	global $CONFIG_EXT, $database;
	if($CONFIG_EXT['charset'] == "utf-8") {
		if(preg_match('/(.{1,'.$max.'})/u', $string, $matches)) $new_string = $matches[0];
		else $new_string = $string; // this state occurs if the string contains chars with mixed encodings
	} else {
		$new_string = substr($string,0,$max);
	}
	$new_string = strlen($new_string)==strlen($string)?$new_string:$new_string.$suffix;
	return $new_string;
}

function html_entities($string) {
   // replaces all html entities except 'double' encoding of the ampersands that are already existant
   $translation_table = get_html_translation_table (HTML_ENTITIES,ENT_QUOTES);
   $translation_table[chr(38)] = '&';
   return preg_replace("/&(?![A-Za-z]{0,4}\w{2,3};|#[0-9]{2,4};)/","&amp;" , strtr($string, $translation_table));
} 

function html_decode($string) 
{
   $trans_tbl = get_html_translation_table(HTML_ENTITIES);
   $trans_tbl = array_flip($trans_tbl);
   return strtr($string, $trans_tbl);
}


function strip_querystring($url) {
	// takes a URL and returns it without the querystring portion
	if ($commapos = strpos($url, '?')) {
		return substr($url, 0, $commapos);
	} else {
		return $url;
	}
}

function get_referer() {
	// returns the URL of the HTTP_REFERER without the querystring portion
	$referer = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'';
	return $referer;
//	return strip_querystring($referer);
}

function me() {
	// returns the name of the current script, without the querystring portion.
	if (getenv("REQUEST_URI")) {
	$me = getenv("REQUEST_URI");
	} elseif (getenv("PATH_INFO")) {
	$me = getenv("PATH_INFO");
	} elseif ($GLOBALS["PHP_SELF"]) {
	$me = $GLOBALS["PHP_SELF"];
	}
	return strip_querystring($me);
}

function qualified_me() {
	// returns current URL
	$HTTPS = getenv("HTTPS");
	$SERVER_PROTOCOL = getenv("SERVER_PROTOCOL");
	$HTTP_HOST = getenv("HTTP_HOST");
	$protocol = (isset($HTTPS) && $HTTPS == "on") ? "https://" : "http://";
	$url_prefix = "$protocol$HTTP_HOST";
	return $url_prefix . me();
}

function match_referer($good_referer = "") {
	// returns true if the referer is the same as the good_referer. 
	// If good_refer is not specified, use qualified_me as the good_referer
	if ($good_referer == "") { $good_referer = qualified_me(); }
	return $good_referer == get_referer();
}

function extcal_dir_list($dirname)
{	
	$handle=opendir($dirname);
	while ($file = readdir($handle))
	{
   		if($file=='.'||$file=='..'||is_dir($dirname.$file)) continue;
   		$result_array[]=$file;
 	}
 	closedir($handle);
 	return $result_array;
}

function extcal_get_picture_file($file) {
	global $CONFIG_EXT, $database;
	if($file) {
		if(file_exists($CONFIG_EXT['MINI_PICS_DIR'].$file.".jpg")) $file = $file.".jpg";
		elseif(file_exists($CONFIG_EXT['MINI_PICS_DIR'].$file.".gif")) $file = $file.".jpg";
		else $file = $CONFIG_EXT['mini_cal_def_picture'];
	} else $file = $CONFIG_EXT['mini_cal_def_picture'];
	return $file;
}

function process_content($data)
{
/* Process message data with various conversions */

	global $CONFIG_EXT, $database, $CFG;

	if ($CONFIG_EXT['addevent_allow_html'])
	{

		$data = preg_replace("/\[B\](.*?)\[\/B\]/si", "<strong>\\1</strong>", $data);
		$data = preg_replace("/\[I\](.*?)\[\/I\]/si", "<em>\\1</em>", $data);
		$data = preg_replace("/\[U\](.*?)\[\/U\]/si", "<u>\\1</u>", $data);

		$data = preg_replace("/\[LEFT\](.*?)\[\/LEFT\]/si", "<div align='left'>\\1</div>", $data);
		$data = preg_replace("/\[CENTER\](.*?)\[\/CENTER\]/si", "<div align='center'>\\1</div>", $data);
		$data = preg_replace("/\[RIGHT\](.*?)\[\/RIGHT\]/si", "<div align='right'>\\1</div>", $data);

		$data = preg_replace("/\[URL\](http:\/\/)?(.*?)\[\/URL\]/si", "<A HREF=\"http://\\2\" target=\"".$CONFIG_EXT['url_target_for_events']."\">\\2</A>", $data);
		$data = preg_replace("/\[URL=(http:\/\/)?(.*?)\](.*?)\[\/URL\]/si", "<A HREF=\"http://\\2\" target=\"".$CONFIG_EXT['url_target_for_events']."\">\\3</A>", $data);
		if ( $CONFIG_EXT['allow_javascript_in_event_urls'] ) $data = preg_replace("/http:\/\/javascript:(.*?) target=\"".$CONFIG_EXT['url_target_for_events']."\"/si", "javascript:$1", $data);
		$data = preg_replace("/\[EMAIL\](.*?)\[\/EMAIL\]/si", "<A HREF=\"mailto:\\1\" style=\"color:#446699\">\\1</A>", $data);
		$data = preg_replace("/\[IMG\](.*?)\[\/IMG\]/si", "<IMG border=0 SRC=\"\\1\">", $data);

		/* adding a space to beginning */
		$data = " ".$data;
		
		$data = preg_replace("#([\n ])([a-z]+?)://([^,<> \n\r]+)#i", "\\1<a href=\"\\2://\\3\" target=\"".$CONFIG_EXT['url_target_for_events']."\">\\2://\\3</a>", $data);

		$data = preg_replace("#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[^,<> \n\r]*)?)#i", "\\1<a href=\"http://www.\\2.\\3\\4\" target=\"".$CONFIG_EXT['url_target_for_events']."\">www.\\2.\\3\\4</a>", $data);
	
		$data = preg_replace("#([\n ])([a-z0-9\-_.]+?)@([^,<> \n\r]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $data);

		/* Remove space */
		$data = substr($data, 1);

	}
	return $data;

}

// Get the week number in ISO 8601:1988 format
function get_week_number($day, $month, $year) {
 global $CONFIG_EXT, $database;
 if($CONFIG_EXT['day_start']) $week = strftime("%W", mktime(0, 0, 0, $month, $day, $year));
 else $week = strftime("%U", mktime(0, 0, 0, $month, $day, $year));
 $yearBeginWeekDay = strftime("%w", mktime(0, 0, 0, 1, 1, $year));
 $yearEndWeekDay  = strftime("%w", mktime(0, 0, 0, 12, 31, $year)); 
 // make the checks for the year beginning
 if($yearBeginWeekDay > 0 && $yearBeginWeekDay < 5) {
  // First week of the year begins during Monday-Thursday.
  // Currently first week is 0, so all weeks should be incremented by one
  $week++;
 } else if($week == 0) {
  // First week of the year begins during Friday-Sunday.
  // First week should be 53, and other weeks should remain as they are
  $week = 53;
 }
 // make the checks for the year end, these only apply to the weak 53
 if($week == 53 && $yearEndWeekDay > 0 && $yearEndWeekDay < 5) {
  // Currently the last week of the year is week 53.
  // Last week of the year begins during Friday-Sunday
  // Last week should be week 1
  $week = 1;
 }
 // return the correct ISO 8601:1988 week
 return $week;
}

// Get the week's first and last days
function get_week_bounds($day, $month, $year) {
 global $dayOfWeek, $CONFIG_EXT;
	if($CONFIG_EXT['day_start']) { // if monday is the first day
		$dayOfWeek = (strftime("%w", mktime(0,0,0,$month,$day,$year)) - 1); // weekday as a decimal number [0,6], with 0 representing Monday
  	$dayOfWeek = ($dayOfWeek == -1)?6:$dayOfWeek;
	}
	else  // if sunday is the first day
		$dayOfWeek = strftime("%w", mktime(0,0,0,$month,$day,$year)); // weekday as a decimal number [0,6], with 0 representing Sunday
	
  // first day of week
  $offset = $dayOfWeek;
  $week = Array();
  $week['first_day']['year'] = date("Y", mktime(0,0,0,$month,$day - $offset,$year) );
  $week['first_day']['month'] = date("m", mktime(0,0,0,$month,$day - $offset,$year));
  $week['first_day']['day'] = date("d", mktime(0,0,0,$month,$day - $offset,$year));
  // last day of week
  $offset=(6 - $dayOfWeek);
  $week['last_day']['year']  = date("Y", mktime(0,0,0,$month,$day + $offset,$year) );
  $week['last_day']['month']  = date("m", mktime(0,0,0,$month,$day + $offset,$year));
  $week['last_day']['day']  = date("d", mktime(0,0,0,$month,$day + $offset,$year));
  return $week;
}

function timetoduration ($seconds, $periods = null) {
  // Force the seconds to be numeric        
  $seconds = (int)$seconds;                
  // Define our periods        
  if (!is_array($periods)) {            
  	$periods = array (                    
  	//'years'     => 31556926,                    
  	//'months'    => 2629743,                    
  	//'weeks'     => 604800,                    
  	'days'      => 86400,                    
  	'hours'     => 3600,                    
  	'minutes'   => 60,                    
  	//'seconds'   => 1                    
  	);        
  }        
  // Loop through        
  foreach ($periods as $period => $value) {            
  	$count = floor($seconds / $value);            
  	$values[$period] = $count;            
  	if ($count == 0) {                
  		continue;            
  	}            
  	$seconds = $seconds % $value;        
  }        
  // Return array        
  if (empty($values)) {            
  	$values = null;        
  }
  
  return $values;    
}

function datestoduration ($start_date, $end_date, $periods = null) {

	$seconds = strtotime($end_date) - strtotime($start_date);
  // Force the seconds to be numeric        
  $seconds = (int)$seconds;                
  // Define our periods        
  if (!is_array($periods)) {            
  	$periods = array (                    
  	//'years'     => 31556926,                    
  	//'months'    => 2629743,                    
  	//'weeks'     => 604800,                    
  	'days'      => 86400,                    
  	'hours'     => 3600,                    
  	'minutes'   => 60,                    
  	//'seconds'   => 1                    
  	);        
  }        
  // Loop through        
  foreach ($periods as $period => $value) {            
  	$count = floor($seconds / $value);            
  	$values[$period] = $count;            
  	if ($count == 0) {                
  		continue;            
  	}            
  	$seconds = $seconds % $value;        
  }        
  // Return array        
  if (empty($values)) {            
  	$values = null;        
  }
  
// fix the all day value
	if(date("G:i",strtotime($end_date)) == "23:59") { 
		$values['days']++;
		$values['hours'] = 0;
		$values['minutes'] = 0;
	} 
	
  return $values;    
}

// Load and parse the template.html file
function load_template()
{
  global $THEME_DIR, $CONFIG_EXT, $database, $template_header, $template_footer, $meta_content, $lang_general;

	$use_extcal_db_header = false;
	$use_extcal_db_footer = false;
	$use_extcal_db_meta = false;
	$header_content	= '';
	$footer_content	= '';
	$meta_content	= '';

/* 	// retrieve template data from db
	$query = "SELECT * FROM ".$CONFIG_EXT['TABLE_TEMPLATES'];
	$result = extcal_db_query($query);
	while ($row = extcal_db_fetch_array($result))
	{
		switch($row['template_type']) {
			case "header":
				$use_extcal_db_header = $row['template_status']?true:false;
				$header_content = $row['template_value'];
				break;
			case "footer":
				$use_extcal_db_footer = $row['template_status']?true:false;
				$footer_content = $row['template_value'];
				break;
			case "meta":
				if($row['template_status']) $meta_content = $row['template_value'];
				break;
			default:
			}
	} */
	
	  if (file_exists($CONFIG_EXT['FS_PATH']."themes/".$CONFIG_EXT['theme']."/" . TEMPLATE_FILE)) {
	      $template_file = $CONFIG_EXT['FS_PATH']."themes/".$CONFIG_EXT['theme']."/" . TEMPLATE_FILE;
	  } else die("<b>ExtCalendar critical error</b>:<br />Unable to load template file ".TEMPLATE_FILE."!</b>");
	
	  $template = fread(fopen($template_file, 'r'), filesize($template_file));
		
	// Header processing
	if($use_extcal_db_header) {
		$cal_pos = strpos($template, "<body ");
	 	$template_header = substr($template, 0, $cal_pos);
		$template_header .= html_decode($header_content);
	} else {
		$cal_pos = strpos($template, "{CONTENT}");
  	$template_header = substr($template, 0, $cal_pos);
  }

	$signature = '<a href="http://extcal.sourceforge.net/" target="_new">ExtCalendar <span style="color:orange">2</span></a>';
	if(strpos(" ".$lang_general['signature'],"%s"))
		$signature = sprintf($lang_general['signature'], $signature);
	else 
		$signature = $lang_general['signature'] . " " . $signature;
	$add_signature = '<div class="atomic" style="color:#CCCCCC;">'.$signature.'</div><br />';

	// Footer processing
	if($use_extcal_db_footer) {
		$template_footer = $add_signature.html_decode($footer_content);
	} else {
		$cal_pos = strpos($template, "{CONTENT}");
	  $template = str_replace("{CONTENT}", $add_signature ,$template);
		$template_footer = substr($template, $cal_pos);
	}
	
	$add_version_info = '<!--ExtCalendar '.$CONFIG_EXT['release_name'].'--></body>';

  $template_footer = ereg_replace("</body[^>]*>",$add_version_info,$template_footer);
}

function get_version_readable($version = "200.00") {
	// returns a readable version (Major.Minor.CVS) out of a string version
	$matches = explode(".",$version);
	$major_version = intval((int)$matches[0]/100);
	$minor_version = $major_version * 100 - intval($matches[0]);
	$cvs_version = intval($matches[1]);
	return $major_version.".".$minor_version.".".$cvs_version;
}	

function get_events($date_stamp, $include_recurrent = false, $show_overlapping_recurrences = false) {
	// return events that occur at a specific date
  global $CONFIG_EXT, $database, $cat_id;
	
	if(empty($date_stamp)) return false;
	
	$cat_filter = "";
  // generate the sql query for a specific date
  $day_pattern = date("Ymd", $date_stamp); // day pattern: 20041231 for 'December 31, 2004'
  $event_condition = '';

  switch($CONFIG_EXT['multi_day_events']) {
  	case "bounds":
		  $event_condition = "(DATE_FORMAT(e.start_date,'%Y%m%d') = $day_pattern OR DATE_FORMAT(e.end_date,'%Y%m%d') = $day_pattern)";
  	
  		break;
  	case "start":
		  $event_condition = "(DATE_FORMAT(e.start_date,'%Y%m%d') = $day_pattern)";
  	
  		break;
  	case "all":
		default:  		
		  $event_condition = "( ( DATE_FORMAT(e.start_date,'%Y%m%d') <= $day_pattern AND DATE_FORMAT(e.end_date,'%Y%m%d') >= $day_pattern )";
			// Added this to account for "all day" events, which are marked with a weird end_date value:
		  $event_condition .=  " OR ( DATE_FORMAT(e.start_date,'%Y%m%d') = $day_pattern ) )";
  	
  		break;
  }
  
  $query = "SELECT e.extid, start_date, end_date from " . $CONFIG_EXT['TABLE_EVENTS'] . " AS e LEFT JOIN " . $CONFIG_EXT['TABLE_CATEGORIES'] . " AS c ON e.cat=c.cat_id ";
  $query .= "WHERE ".$event_condition." AND c.published = '1' AND approved = '1' AND recur_type = ''";
	if(isset($cat_id) && is_numeric($cat_id)) $query .= "AND e.cat = '".$cat_id."' "; 
  $query .= "ORDER BY start_date,title ASC";
  $result = extcal_db_query($query);

	$events = array();
  
  while ($row = extcal_db_fetch_row($result))
  {
  	$events[] = array($row[0],strtotime($row[1]),strtotime($row[2]));
  }
	
	if($include_recurrent) {
		// calculate recurrent events
		if(isset($cat_id) && is_numeric($cat_id)) $cat_filter .= "AND e.cat = '".$cat_id."'"; 
	  $query = "SELECT e.extid, recur_type, recur_val, recur_until, start_date, end_date, recur_end_type, recur_count from " . $CONFIG_EXT['TABLE_EVENTS'] . " AS e LEFT JOIN " . $CONFIG_EXT['TABLE_CATEGORIES'] . " AS c ON e.cat=c.cat_id ";
	  $query .= "WHERE (DATE_FORMAT(e.start_date,'%Y%m%d') <= $day_pattern) AND c.published = '1' AND approved = '1' AND recur_type <> '' $cat_filter ORDER BY start_date,title ASC";
	  $result1 = extcal_db_query($query);
	  $recur_events = array();

	  while ($row = extcal_db_fetch_array($result1))
	  {
	  	$event = new ExtCal_Event();
	  	//$event->loadEvent($row[0]);
	  	$event->recType = $row['recur_type']; // pass recur_type to event object
	  	$event->recInterval = (int)$row['recur_val']; // pass recur_interval to event object
	  	$event->recEndDate = strtotime($row['recur_until']." 00:00:00")-strtotime("0000-00-00 00:00:00")?strtotime($row['recur_until']." 23:59:59"):false; // pass recur_until to event object
	  	$event->setStartDate(strtotime($row['start_date'])); // convert start_date to timestamp and pass it to event object
		// Fix to make sure that recurring events with no end date specified are still counted:
		if ( ($row['end_date'] == '0000-00-00 00:00:00') || ($row['end_date'] == '0000-00-00 00:00:01') ) $row['end_date'] = $row['start_date'];
	  	$event->setEndDate(strtotime($row['end_date'])); // convert end_date to timestamp and pass it to event object
	  	$event->recEndType = (int)$row['recur_end_type']; 
	  	$event->recEndCount = (int)$row['recur_count'];

		// MF - if event is recurrent on this date, add it here:
	  	if ( $event->isRecurrentOn($date_stamp) ) {
			// MF - added the last two elements so we capture the extra "recurStartDay" and "recurEndDay" that I added to the event class:
			if ( $show_overlapping_recurrences ) {
				foreach ( $event->recurrencesOnThisDate as $thisRecurrence ) {
			  		$recur_events[] = array($row['extid'],$thisRecurrence['exact_recurrence_start'],$thisRecurrence['exact_recurrence_end'],$thisRecurrence['recurrence_start_day'],$thisRecurrence['recurrence_end_day']);
				}
			} else {
				// MF - If overlapping recurrences are off, add only the LAST recurrence of the event. This way
				// events which recur STARTING today are listed on the calendar as starting today instead of as
				// being continued from a prior day.
				$thisRecurrence = $event->recurrencesOnThisDate[count($event->recurrencesOnThisDate)-1];
		  		$recur_events[] = array($row['extid'],$thisRecurrence['exact_recurrence_start'],$thisRecurrence['exact_recurrence_end'],$thisRecurrence['recurrence_start_day'],$thisRecurrence['recurrence_end_day']);
			}
		}
	  }

		$events = array_merge($events,$recur_events);
	}
	return is_array($events)?$events:false;
}

function get_cat_info ($cat_id) {
// function that returns a category name if it exists, given a cat_id	
	global $CONFIG_EXT, $database;
	
	if(!$cat_id) return false;
	$query = "SELECT cat_name, description FROM " . $CONFIG_EXT['TABLE_CATEGORIES'] . " WHERE published = 1 and cat_id = '$cat_id'";
	$results = extcal_db_query($query);
	if(!extcal_db_num_rows($results)) return false;
	list($cat_name,$description) = extcal_db_fetch_array($results);
	$cat_info = array('cat_name' => $cat_name, 'cat_desc' => $description );
	extcal_db_free_result($results);
	
	return $cat_info;	
}

function get_active_categories() {
// function that returns a list of categories that a user is allowed to see	
	global $CONFIG_EXT, $database;
	
	$query = "SELECT cat_id, cat_name, description AS cat_desc, color FROM " . $CONFIG_EXT['TABLE_CATEGORIES'] . " WHERE published = 1";
	$results = extcal_db_query($query);
	if(!extcal_db_num_rows($results)) return false;

	$cat_list = array();
	while ($row = extcal_db_fetch_array($results))
	{
		$cat_list[] = $row;
	}
	extcal_db_free_result($results);
	
	return $cat_list;	
}

function sort_events($events, &$event_stack, $date_stamp) {

 	while (list(,$event_info) = each($events))
 	{
    $event_style = Event::get_style($date_stamp,$event_info[1],$event_info[2]);

  	if($event_style=="eventstart" && !in_array($event_info[0], $event_stack)) $event_stack[] = $event_info[0];
	}
	
	reset($events);
 	while (list(,$event_info) = each($events))
 	{
    $event_style = Event::get_style($date_stamp,$event_info[1],$event_info[2]);

  	if($event_style=="eventend" && in_array($event_info[0], $event_stack)) {
  		for($key=0;$key<count($event_stack);$key++)
  			if($event_stack[$key]==$event_info[0]) break;
  		array_splice($event_stack, $key);
  	}
	}
	reset($events);
	return $events;
}

function get_display_style ($name,$type) {
	global $CONFIG_EXT, $database;
	$status = 0;
	$return_value = array("display: none","display: show");
	$cookie_name = $CONFIG_EXT['cookie_name']."_hidden_display";
	$items = explode(',',$_COOKIE[$cookie_name]);
	$status = in_array($name,$items);
	if($type == "close")
		return $status?$return_value[1]:$return_value[0]; 
	elseif($type == "open")
		return $status?$return_value[0]:$return_value[1]; 
}

function invoke_code($component,$params) {
	// function that invokes a component with and returns output for display
	global $CONFIG_EXT, $database, $lang_system;
	
	switch($component) {
		case "minicalendar":
			$output_buffer = print_mini_cal_view($params);
			return array('status' => true, 'html' => $output_buffer);
			break;
		default:
			return array('status' => false, 'html' => $lang_system['unknown_component']);
	}
}

function get_language_name($language_dir) {
	// returns the name and native name of a given language
	$language_names = array(
		'arabic' => array('Arabic','&#1575;&#1604;&#1593;&#1585;&#1576;&#1610;&#1577;'),
		'bosnian' => array('Bosnian','Bosanski'),
		'brazilian_portuguese' => array('Portuguese [Brazilian]'),
		'bulgarian' => array('Bulgarian','&#1041;&#1098;&#1083;&#1075;&#1072;&#1088;&#1089;&#1082;&#1080;'),
		'chinese_big5' => array('Chinese-Big5','&#21488;&#28771;'),
		'chinese_gb' => array('Chinese-GB2312','&#20013;&#22269;'),
		'croatian' => array('Croatian(Hrvatski'),
		'czech' => array('Czech(&#x010C;esky'),
		'danish' => array('Danish','Dansk'),
		'dutch' => array('Dutch','Nederlands'),
		'english' => array('English','English'),
		'estonian' => array('Estonian','Eesti'),
		'finnish' => array('Finnish','Suomea'),
		'french' => array('French','Fran&ccedil;ais'),
		'german' => array('German','Deutsch','de'),
		'greek' => array('Greek','&#917;&#955;&#955;&#951;&#957;&#953;&#954;&#940;'),
		'hebrew' => array('Hebrew','&#1506;&#1489;&#1512;&#1497;&#1514;'),
		'hungarian' => array('Hungarian','Magyarul'),
		'indonesian' => array('Indonesian','Bahasa Indonesia'),
		'italian' => array('Italian','Italiano'),
		'japanese' => array('Japanese','&#26085;&#26412;&#35486;'),
		'korean' => array('Korean','&#54620;&#44397;&#50612;'),
		'latvian' => array('Latvian','Latvian'),
		'norwegian' => array('Norwegian','Norsk'),
		'polish' => array('Polish','Polski'),
		'portuguese' => array('Portuguese [Portugal]','Portugu&ecirc;s'),
		'russian' => array('Russian','&#1056;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081;'),
		'slovak' => array('Slovak','Slovensky'),
		'slovenian' => array('Slovenian','Slovensko'),
		'spanish' => array('Spanish','Espa&ntilde;ol'),
		'swedish' => array('Swedish','Svenska'),
		'thai' => array('Thai','&#3652;&#3607;&#3618;'),
		'turkish' => array('Turkish','T&uuml;rk&ccedil;e'),
		'vietnamese' => array('Vietnamese')
	);
	$name = count($language_names[$language_dir])==2?$language_names[$language_dir][0]." (".$language_names[$language_dir][1].")":$language_names[$language_dir][0];
	return isset($language_names[$language_dir])?$name:$language_dir;	
}
?>
