<?PHP

// New language structure
$lang_info = array (
	'name' => 'Latvian'
	,'nativename' => 'Latvieðu' // Language name in native language. E.g: 'Français' for 'French'
	,'locale' => array('lv','lat') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'windows-1257' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Mârtiòð un Ieva Zabarovski'
	,'author_email' => 'martins@zabarovski.lv'
	,'author_url' => 'http://www.zabarovski.lv'
	,'transdate' => '07/03/2004'
);

$lang_general = array (
	'yes' => 'Jâ'
	,'no' => 'Nç'
	,'back' => 'Atpakaï'
	,'continue' => 'Turpinât'
	,'close' => 'Aizvçrt'
	,'errors' => 'Kïûdas'
	,'days' => 'Dienas'
	,'months' => 'Mçneði'
	,'years' => 'Gadi'
	,'hours' => 'Stundas'
	,'minutes' => 'Minûtes'
	,'everyday' => 'Katru dienu'
	,'everymonth' => 'Katru mçnesi'
	,'everyyear' => 'Katru gadu'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %d. %B , %Y' // e.g. Treðdiena, 5. Jûnijs, 2004
	,'full_date_time_24hour' => '%A, %d. %B, %Y Plkst. %H:%M' // e.g. Treðdiena, 5. Jûnijs, 2004 Plkst. 22:10
	,'full_date_time_12hour' => '%A, %d. %B, %Y Plkst. %I:%M %p' // e.g. Treðdiena, 5. Jûnijs, 2004 Plkst. 10:10 pm
	,'day_month_year' => '%d %m %Y'
	,'local_date' => '%c'
	,'mini_date' => '%a. %d. %b, %Y'
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Svçtdiena','Pirmdiena','Otrdiena','Treðdiena','Ceturtdiena','Piektdiena','Sestdiena')
	,'months' => array('Janvâris','Februâris','Marts','Aprîlis','Maijs','Jûnijs','Jûlijs','Augusts','Septembris','Oktobris','Novembris','Decembris')
);

$lang_system = array (
	'system_caption' => 'Sistçmas paziòojums'
  ,'page_access_denied' => 'Tev nav atïauta pieeja ðai lapai.'
  ,'operation_denied' => 'Tev nav atïauts veikt ðo operâciju.'
	,'section_disabled' => 'Ðî sadaïa ðobrîd nav pieejama!'
  ,'non_exist_cat' => 'Izvçlçtâ kategorija neeksistç!'
  ,'non_exist_event' => 'Izvçlçtais ieraksts neeksistç!'
  ,'param_missing' => 'Dati nav pareizi.'
  ,'no_events' => 'Nav ierakstu'
);


// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Pievienot ierakstu'
	,'edit_event' => 'Labot ierakstu [id%d] \'%s\''
	,'update_event_button' => 'Apstiprinât ieraksta labojumus'

// Event details
	,'event_details_label' => 'Ieraksta saturs'
	,'event_title' => 'Ieraksta Virsraksts'
	,'event_desc' => 'Ieraksta apraksts'
	,'event_cat' => 'Kategorija'
	,'choose_cat' => 'Izvçlies kategoriju'
	,'event_date' => 'Ieraksta datums'
	,'day_label' => 'Diena'
	,'month_label' => 'Mçnesis'
	,'year_label' => 'Gads'
	,'start_date_label' => 'Sâkuma laiks'
	,'start_time_label' => 'Plkst.'
	,'end_date_label' => 'Lîdz'
	,'all_day_label' => 'Visu dienu'
// Contact details
	,'contact_details_label' => 'Kontaktpersonas dati'
	,'contact_info' => 'Kontaktpersona'
	,'contact_email' => 'Kontaktpersonas E-pasts'
	,'contact_url' => 'Kontaktpersonas Mâjas lapa'
// Other details
	,'other_details_label' => 'Pârçjie dati'
	,'picture_file' => 'Attçla fails'
	,'file_upload_info' => '(%d KBaitu limits - atïautais formâts : %s )' 
	,'del_picture' => 'Dzçst attçlu?'
// Administrative options
	,'admin_options_label' => 'Administratîvâs funkcijas'
	,'auto_appr_event' => 'Ieraksta Automâtiska apstiprinâðana'

// Error messages
	,'no_title' => 'Ierakstam trûkst virsraksta!'
	,'no_desc' => 'Ierakstam nepiecieðams apraksts!'
	,'no_cat' => 'Izvçlies ieraksta kategoriju no saraksta!'
	,'date_invalid' => 'Nepareizs datums!'
	,'end_days_invalid' => 'Ieraksts \'Dienas\' nepareizs!'
	,'end_hours_invalid' => 'Ieraksts \'Stundas\' nepareizs!'
	,'end_minutes_invalid' => 'Ieraksts \'Minûtes\' nepareizs!'

	,'file_too_large' => 'Pievienotâ faila lielums pârsniedz atïauto! (Atïauts %d KBaitu)'
	,'file_invalid' => 'Faila formâts nav pareizs! (Atïautais formâts: %s)'

// Misc. messages
	,'submit_event_pending' => 'Ieraksts gaida apstiprinâjumu. Paldies, ka to veici!'
	,'submit_event_approved' => 'Ieraksts ir automâtiski apstiprinâts. Paldies, ka to veici!'
);

// ======================================================
// Category Events view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Ieraksts: \'%s\''
	,'cat_name' => 'Kategorija'
	,'event_start_date' => 'Datums'
	,'event_end_date' => 'Lîdz'
	,'contact_info' => 'Kontaktpersona'
	,'contact_email' => 'E-pasts'
	,'contact_url' => 'Mâjas lapa'
	,'no_event' => 'Nav ierakstu.'
	,'stats_string' => 'Pavisam <strong>%d</strong> ierakstu.'
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Kategoriju sadalîjums'
	,'cat_name' => 'Kategorijas nosaukums'
	,'total_events' => 'Pavisam ierakstu'
	,'upcoming_events' => 'Gaidâmie notikumi'
	,'no_cats' => 'Nav kategoriju.'
	,'stats_string' => '<strong>%d</strong> Ierakstu <strong>%d</strong> kategorijâs'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Ieraksti \'%s\''
	,'event_name' => 'Ieraksta nosaukums'
	,'event_date' => 'Datums'
	,'no_events' => 'Ðajâ kategorijâ nav ierakstu.'
	,'stats_string' => 'Pavisam <strong>%d</strong> ierakstu.'
);

// ======================================================
// theme.php
// ======================================================

// To Be Done

// ======================================================
// functions.inc.php
// ======================================================

// To Be Done

// ======================================================
// dblib.php
// ======================================================

// To Be Done

// ======================================================
// admin_events.php
// ======================================================

// To Be Done

// ======================================================
// admin_categories.php
// ======================================================

// To Be Done

// ======================================================
// settings.php
// ======================================================

if (defined('SETTINGS_PHP')) 

$lang_settings_data = array(
	'section_title' => 'Kalendâra iestatîjumi'
// General Settings
	,'general_settings_label' => 'Pamatuzstâdîjumi'
	,'calendar_name' => 'Kalendâra nosaukums'
	,'calendar_description' => 'Kalendâra apraksts'
	,'calendar_admin_email' => 'Kalendâra Pârziòa E-pasts'
	,'cookie_name' => 'Skripta sîkdatnes nosaukums'
	,'cookie_path' => 'Skripta sîkdatnes ceïð'
	,'debug_mode' => 'Ieslçgt lâgoðanas reþîmu'
// Environment Settings
	,'env_settings_label' => 'Vides uzstâdîjumi'
	,'lang' => 'Valoda'
		,'lang_name' => 'Valoda'
		,'lang_native_name' => 'Valodas oriìinâls'
		,'lang_trans_date' => 'Tulkots'
		,'lang_author_name' => 'Autori'
		,'lang_author_email' => 'Autora e-pasts'
		,'lang_author_url' => 'Mâjas lapa'
	,'charset' => 'Zîmju ðifrçjums'
	,'theme' => 'Motîvs'
		,'theme_name' => 'Motîva nosaukums'
		,'theme_date_made' => 'Izgatavots'
		,'theme_author_name' => 'Autors'
		,'theme_author_email' => 'E-pasts'
		,'theme_author_url' => 'Mâjas lapa'
	,'timezone' => 'Laika zona'
	,'time_format' => 'Laika formâts'
		,'24hours' => '24 stundu'
		,'12hours' => '12 stundu'
	,'auto_daylight_saving' => 'Automâtiska pâreja uz vasaras laiku.'
	,'main_table_width' => 'Galvenâs tabulas platums (Pikseïos vai %)'
	,'day_start' => 'Nedçïas pirmâ diena'
	,'default_view' => 'Noklusçjuma iestatîjums'
	,'search_view' => 'Atïaut meklçðanu'
	,'archive' => 'Râdît pagâtnes notikumus'
	,'events_per_page' => 'Notikumu skaits lappusç'
// Event View
	,'event_view_label' => 'Ieraksta izskats'
	,'popup_event_mode' => 'Ieraksta paziòojums'
	,'popup_event_width' => 'Paziòojuma platums'
	,'popup_event_height' => 'Paziòojuma augstums'
// Add Event View
	,'add_event_view_label' => 'Pievienojamâ ieraksta izskats'
	,'add_event_view' => 'Attïauts'
	,'addevent_allow_html' => 'Atïaut lietot <b>BB Kodus</b> aprakstâ'
	,'addevent_allow_contact' => 'Atïaut pievienot kontaktpersonas'
	,'addevent_allow_email' => 'Atïaut pievienot E-pastu'
	,'addevent_allow_url' => 'Atïaut pievienot Mâjas lapu'
	,'addevent_allow_picture' => 'Atïaut ievietot attçlus'
	,'new_post_notification' => 'Jauna paziòojuma brîdinâjums'
// Calendar View
	,'calendar_view_label' => 'Kalendâra (Mçneða) skats'
	,'monthly_view' => 'Atïauts'
	,'cal_view_max_chars' => 'Maksimâlais zîmju skaits aprakstâ'
// Flyer View
	,'flyer_view_label' => 'Lidòa skats'
	,'flyer_view' => 'Atïauts'
	,'flyer_show_picture' => 'Râdît attçlus lidòa skatâ'
	,'flyer_view_max_chars' => 'Maksimâlais zîmju skaits aprakstâ'
// Weekly View
	,'weekly_view_label' => 'Nedçïas skats'
	,'weekly_view' => 'Atïauts'
	,'weekly_view_max_chars' => 'Maksimâlais zîmju skaits aprakstâ'
// Daily View
	,'daily_view_label' => 'Dienas skats'
	,'daily_view' => 'Atïauts'
	,'daily_view_max_chars' => 'Maksimâlais zîmju skaits aprakstâ'
// Categories View
	,'categories_view_label' => 'Kategoriju skats'
	,'cats_view' => 'Atïauts'
	,'cats_view_max_chars' => 'Maksimâlais zîmju skaits aprakstâ'
// Mini Calendar
	,'mini_cal_label' => 'Mini Kalendârs'
	,'mini_cal_def_picture' => 'Noklusçtais attçls'
	,'mini_cal_display_picture' => 'Râdît attçlu'
	,'mini_cal_diplay_options' => array('Neviens','Noklusçtais Attçls', 'Dienas Attçls','Nedçïas Attçls','Izlozçtais Attçls')
// Picture Settings
	,'picture_settings_label' => 'Attçlu iestatîjumi'
	,'max_upl_size' => 'Maksimâlais attçlu lielums (KBaitos)'
	,'allowed_file_extensions' => 'Atïautie attçlu failu paplaðinâjumi.'
// Form Buttons
	,'update_config' => 'Saglabât Jaunos uzstâdîjumus'
	,'restore_config' => 'Atjaunot Pamatuzstâdîjumus'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Noklusçtais Attçls'
	,'daily_pic' => 'Dienas Attçls (%s)'
	,'weekly_pic' => 'Nedçïas Attçls (%s)'
	,'rand_pic' => 'Izlozçtais Attçls (%s)'
	,'post_event' => 'Veikt Jaunu ierakstu'
);

// ======================================================
// calendar.php
// ======================================================

// To Be Done

// ======================================================
// config.inc.php
// ======================================================

// To Be Done

// ======================================================
// install.php
// ======================================================

// To Be Done

// ======================================================
// login.php
// ======================================================

// To Be Done

// ======================================================
// logout.php
// ======================================================

// To Be Done

// ======================================================
// admin_events.php
// ======================================================

// To Be Done

// old structure	

$maand[0]="Katru mçnesi";
$maand[1]="Janvârî";
$maand[2]="Februârî";
$maand[3]="Martâ";
$maand[4]="Aprîlî";
$maand[5]="Maijâ";
$maand[6]="Jûnijâ";
$maand[7]="Jûlijâ";
$maand[8]="Augustâ";
$maand[9]="Septembrî";
$maand[10]="Oktobrî";
$maand[11]="Novembrî";
$maand[12]="Decembrî";

$week[1]="Svçtdienâ";
$week[2]="Pirmdienâ";
$week[3]="Otrdienâ";
$week[4]="Treðdienâ";
$week[5]="Ceturtdienâ";
$week[6]="Piektdienâ";
$week[7]="Sestdienâ";

function translate($word){

    switch ($word) {
        // Language parameters
        case "lang_name": $new = "Latvian";    break;
        case "lang_nativename": $new = "Latvieðu";    break;
        case "lang_charset": $new = "windows-1257";    break;
				// Translations
        case "yes": $new = "Jâ";    break;
        case "no": $new = "Nç";    break;
        case "welcometo": $new = "Laipni lûdzam";    break;
        case "admin": $new = "Administrâcija";    break;
        case "adminoptions": $new = "Pârziòa Funkcijas";    break;
        case "cate": $new = "Skatît kategorijas"; break;
        case "day": $new = "Dienas Skats"; break;
        case "week": $new = "Nedçïa"; break;
        case "weeklyview": $new = "Nedçïas Skats"; break;
        case "cal": $new = "Kalendâra Skats"; break;
        case "nocats": $new = "Vçl nav Kategoriju"; break;
        case "addcat": $new = "Pievienot Kategoriju"; break;
        case "cats": $new = "Kategorijas"; break;
        case "addevent": $new = "Pievienot Ierakstu"; break;
        case "outof": $new = "Pagâjuðie notikumi"; break;
        case "upcomingevents": $new = "Gaidâmie notikumi"; break;
        case "totalevents": $new = "Pavisam Ierakstu"; break;
        case "events": $new = "Ieraksti"; break;
        case "errors": $new = "Kïûdas"; break;
        case "weeklyevents": $new = "Nedçïas notikumi"; break;
        case "eventdetails": $new = "Ieraksta detaïas"; break;
        case "eventitle": $new = "Ieraksta virsraksts"; break;
        case "description": $new = "Notikuma apraksts"; break;
        case "choosecat": $new = "Izvçlies Kategoriju"; break;
        case "selectyear": $new = "Gads"; break;
        case "selectmonth": $new = "Mçnesis"; break;
        case "selectday": $new = "Diena"; break;
        case "everyyear": $new = "Katru gadu"; break;
        case "everymonth": $new = "Katru mçnesi"; break;
        case "bdate": $new = "Datums"; break;
        case "notitle": $new = "Norâdi ieraksta nosaukumu!"; break;
        case "nodescription": $new = "Sniedz notikuma aprakstu"; break;
        case "noday": $new = "Izvçlies dienu!"; break;
        case "nomonth": $new = "Izvçlies mçnesi !"; break;
        case "noyear": $new = "Izvçlies gadu !"; break;
        case "nocat": $new = "Izvçlies kategoriju !"; break;
        case "novaliddate": $new = "Ievadi eksistçjoðu datumu !"; break;
        case "kblimit": $new = "KBaitu limits"; break;
        case "back": $new = "Atpakaï"; break;
        case "action": $new = "Notikums"; break;
        case "nononapproved": $new = "Nav neviena ieraksta, kas gaidîtu apstiprinâðanu"; break;
        case "nonapproved": $new = "Ieraksti Apstiprinâðanai"; break;
        case "autoapprove": $new = "Automâtiski apstiprinât ierakstu"; break;
        case "cat": $new = "Kategorija"; break;
        case "view": $new = "Skatît ierakstu"; break;
        case "edit": $new = "Labot ierakstu"; break;
        case "updateevent": $new = "Apstiprinât ieraksta izmaiòas"; break;
        case "approve": $new = "Apstiprinât ierakstu"; break;
        case "appreventok": $new = "Ieraksts apstiprinâts"; break;
        case "cantapprevent": $new = "Ieraksts nevar tikt apstiprinâts."; break;
        case "moreinfo": $new = "Papildus informâcija"; break;
        case "editcat": $new = "Labot Kategoriju"; break;
        case "delcat": $new = "Dzçst Kategoriju"; break;
        case "edit": $new = "Labot"; break;
        case "del": $new = "Dzçst"; break;
        case "name": $new = "Nosaukums"; break;
        case "update": $new = "Izmainît"; break;
        case "reallydelcat": $new = "Vai tieðâm izdzçst ðo kategoriju? Visi ieraksti, kas ietilpst ðajâ kategorijâ tiks pilnîbâ izdzçsti!"; break;
        case "noback": $new = "Ups, nç, atgriezies.!"; break;
        case "deleventok": $new = "Ieraksts izdzçsts"; break;
        case "cantdelevent": $new = "Ieraksts nevar tikt dzçsts"; break;
        case "surecat": $new = "Jâ, izdzçst!"; break;
        case "noevents": $new = "Nav ierakstu"; break;
        case "numbevents": $new = "Ieraksti "; break;
        case "upevent": $new = "Izmainît Ierakstu"; break;
        case "delev": $new = "Dzçst ierakstu"; break;
        case "currentpic": $new = "Esoðais Attçls"; break;
        case "delpic": $new = "Dzçst ðo attçlu"; break;
        case "nooutofdate": $new = "Nav pagâjuðo notikumu."; break;
        case "delalloodev": $new = "Dzçst visus pagâjuðos notikumus"; break;
        case "delevok": $new = "Vai tieðâm esi pârliecinâts, ka gribi dzçst ðo ierakstu?"; break;
        case "delalloodevok": $new = "Dzçst tos visus!"; break;
        case "prevm": $new = "Iepriekðçjais mçnesis"; break;
        case "nextm": $new = "Nâkamais mçnesis"; break;
        case "today": $new = "Ðodien"; break;
        case "eventstoday": $new = "Ðodienas notikumi"; break;
        case "readmore": $new = "Lasît vairâk"; break;
        case "nextday": $new = "Nâkamâ diena"; break;
        case "prevday": $new = "Iepriekðçjâ diena"; break;
        case "askedday": $new = "Izvçlçtâ diena"; break;
        case "nextweek": $new = "Nâkamâ nedçïa"; break;
        case "prevweek": $new = "Iepriekðçjâ nedçïa"; break;
        case "weeknr": $new = "Nedçïas kârtas numurs"; break;
        case "eventsthisweek": $new = "Ieraksti no "; break;
        case "till": $new = "lîdz"; break;
        case "thankyou": $new = "Paldies par ieraksta veikðanu, tas bûs redzams pçc mirkïa!"; break;
        case "eventedited": $new = "Ieraksta izmaiòas veiktas!"; break;
				case "op": $new = "Ieslçgt"; break;
       	# here start the new not yet translated language vars
        case "disabled": $new = "Ðî sadaïa nav pieejama"; break;
       	case "searchbutton": $new = "Sâkt meklçt"; break;
       	case "searchtitle": $new = "Meklçt"; break;
       	case "searchcaption": $new = "Ieraksti vârdus pçc kâ meklçt"; break;
       	case "searchresults": $new = "Atrastie Ieraksti"; break;
       	case "searchagain": $new = "Meklçt vçlreiz"; break;
      	case "onedate": $new = "Vienâ datumâ"; break;
        case "moredates": $new = "Vairâkos datumos"; break;
      	case "moredatesexplain": $new = "Vairâkos datumos: 'dd-mm-yyyy;dd-mm-yyyy' Ja datums viens, raksti 01, tas pats mçneðiem! Bez beigu datuma-';' !"; break;
      	case "email": $new = "E-pasts"; break;
      	case "results": $new = "Rezultâti"; break;
      	case "noresults": $new = "Nav atrastu ierakstu"; break;
        case "wronglogin": $new = "Pârbaudiet savu ieejas vârdu un paroli, un mçìiniet vçlreiz!"; break;
        case "userman": $new = "Lietotâju vadîba"; break;
        case "users": $new = "Lietotâji"; break;
        case "logout": $new = "Iziet"; break;
        case "deluser": $new = "Dzçst lietotâju"; break;
        case "addnewuser": $new = "Pievienot jaunu lietotâju"; break;
        case "loginscreen": $new = "Ieejas Logs"; break;
        case "login": $new = "Ieejas vârds"; break;
        case "password": $new = "Parole"; break;
        case "rememberme": $new = "Atceries mani"; break;
				case "loginmsg": $new = "Ieraksti Ieejas vârdu un paroli"; break;
				case "nologinname": $new = "Lûdzu Ieraksti savu ieejas vârdu !"; break;
        case "userwarning": $new = "Atceries savu paroli! Tâ nevar tikt atjaunota !"; break;
        case "userdelok": $new = "Vai tieðâm dzçst ðo lietotâju ?"; break;
        case "contact": $new = "Kontaktpersona"; break;
        case "contactinfo": $new = "Kontaktpersonas dati"; break;
        case "otherdetails": $new = "Pârçjie dati"; break;
        case "picture": $new = "Attçls"; break;
        case "filetolarge": $new = "Pievienotais fails ir pârâk liels !"; break;
        case "extensionnovalid": $new = "Faila paplaðinâjums nav atïauts !"; break;
        case "flyerlink": $new = "Lidòa skats"; break;
        case "mailtitle": $new = "Griezies pie kalendâra pârziòa nekavçjoties!"; break;
        case "mailbody": $new = "Kâds veicis jaunu ierakstu !"; break;
        case "continuebutton": $new = "Uzklikðíini lai turpinâtu"; break;
        case "returnbutton": $new = "Atgrieztis mâjas lapâ"; break;
        case "in": $new = "sokojoðâ"; break;
        case "uploadapplnk": $new = "Ierakstu Apstiprinâðana"; break;
        case "settingslnk": $new = "Iestatîjumi"; break;
        case "categorieslnk": $new = "Kategorijas"; break;
        case "userslnk": $new = "Lietotâji"; break;
        case "groupslnk": $new = "Grupas"; break;
        case "myprofile": $new = "Mani Iestatîjumi"; break;
        case "status": $new = "Statuss"; break;
        case "options": $new = "Funkcijas"; break;
        case "autoappr": $new = "Aotomâtiskâ Apstiprinâðana"; break;
        case "active": $new = "Aktîvs"; break;
        case "inactive": $new = "Neaktîvs"; break;
        case "admincats": $new = "Kategoriju Pârraudzîba"; break;
        case "generalinfo": $new = "Pamatinformâcija"; break;
        case "catname": $new = "Kategorijas nosaukums"; break;
        case "catdesc": $new = "Kategorijas apraksts"; break;
        case "color": $new = "Krâsa"; break;
        case "pickcolor": $new = "Izvçlies krâsu!"; break;
        case "autouserappr": $new = "Automâtiski apstiprinât lietotâju ierakstus"; break;
        case "autoadminappr": $new = "Automâtiski apstiprinât pârziòa ierakstus"; break;
        case "nocatname": $new = "Ieraksti kategorijas nosaukumu!"; break;
        case "nocatdesc": $new = "Apraksti notikumu!"; break;
        case "nocolor": $new = "Izvçlies krâsu!"; break;
        case "total": $new = "Pavisam"; break;
        case "admins": $new = "Pârziòî"; break;
        case "updatecat": $new = "Izmainît kategoriju"; break;
        case "catedited": $new = "Kategorija izmainîta!"; break;
        case "delcatmoreevents": $new = "Ðajâ kategorijâ ir %d ieraksts (i) un tâdçï tâ nevar tikt dzçsta!<br>Lûdzu izdzçs ierakstus ðajâ kategorijâ un tad mçìini vçlreiz!"; break;
        case "delcatok": $new = "Kategorija izdzçsta!"; break;
        
        default: $new = "<b>".$word."</b> Jâtulko !";    break;

    }
    return $new;
}
?>