<?PHP

// New language structure
$lang_info = array (
	'name' => 'German'
	,'nativename' => 'German' // Sprache name in native language. E.g: 'Français' for 'French'
	,'locale' => array('de','german') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Antoine Johannes Kuske aka fesseChaud'
	,'author_E-mail' => 'antoine@bachtel.ch'
	,'author_url' => 'http://www.randonneurs.org/'
	,'transdate' => '12/07/2004'
);

$lang_general = array (
	'yes' => 'Ja'
	,'no' => 'Nein'
	,'back' => 'Zur&#252;ck'
	,'continue' => 'Vorw&#228;rts'
	,'close' => 'Schliessen'
	,'errors' => 'Errors'
	,'info' => 'Informationen'
	,'day' => 'Tag'
	,'days' => 'Tage'
	,'month' => 'Monat'
	,'months' => 'Monate'
	,'year' => 'Jahr'
	,'years' => 'Jahre'
	,'hour' => 'Stunde'
	,'hours' => 'Stunden'
	,'minute' => 'Minute'
	,'minutes' => 'Minuten'
	,'everyday' => 'Jeden Tag'
	,'everymonth' => 'Jeden Monat'
	,'everyyear' => 'Jedes Jahr'
  ,'active' => 'Aktive'
	,'not_active' => 'Nicht Active'
	,'today' => 'Heute'
	,'signature' => 'Powered by %s'
	,'expand' => 'Expand'
	,'collapse' => 'Collapse'
);

// Datum formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %B %d, %Y' // e.g. Mittwoch, Juni 05, 2002
	,'full_date_time_24hour' => '%A, %B %d, %Y um %H:%M' // e.g. Mittwoch, Juni 05, 2002 um 21:05
	,'full_date_time_12hour' => '%A, %B %d, %Y um %I:%M %p' // e.g. Mittwoch, Juni 05, 2002 um 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d %b, %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag')
	,'months' => array('Januar','Februar','M&#228;rz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember')
);

$lang_system = array (
	'system_caption' => 'System Nachricht'
  ,'page_access_denied' => 'Sie haben nicht genug Rechte um diese Seite zu besuchen. Wenden Sie sich bitte an den Administrator.'
  ,'operation_denied' => 'Sie haben nicht genug Rechte um diese Operation durchzuf&#252;hren. Wenden Sie sich bitte an den Administrator.'
	,'section_disabled' => 'Diese Sektion ist zur Zeit nicht aktiv !'
  ,'non_exist_cat' => 'Die ausgew&#228;hlte Rubrik existiert nicht !'
  ,'non_exist_event' => 'Die ausgew&#228;hlte Veranstaltung existiert nicht !'
  ,'param_missing' => 'Die eingetragen Datum sind nicht g&#252;ltig.'
  ,'no_events' => 'Es gibt keine Veranstaltungen'
  ,'config_string' => 'Sie benutzen zur Zeit \'%s\', konfiguriert mit %s, %s und %s.'
  ,'no_table' => 'Diese\'%s\' Tabelle ist in existent !'
  ,'no_anonymous_Gruppe' => 'Diese  %s enth&#228;lt nicht die \'Anonymous\' Gruppe !'
);

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'Registrieren'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => ''
	,'admin_events' => 'Veranstaltungen'
  ,'admin_categories' => 'Rubriken'
  ,'admin_groups' => 'Gruppen'
  ,'admin_users' => 'Benutzer'
  ,'admin_settings' => 'Einstellungen'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Eintragen'
	,'cal_view' => 'Monatsansicht'
  ,
  'flat_view' => 'Flache Ansicht'
  ,
  'weekly_view' => 'Wochenansicht'
  ,
  'daily_view' => 'Tagesansicht'
  ,
  'yearly_view' => 'Jahresansicht'
  ,'categories_view' => 'Rubrikenansicht'
  ,'search_view' => 'Suchen'
);

// ======================================================
// Veranstaltung hinzuf&#252;gen Ansicht
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Veranstaltung hinzuf&#252;gen'
	,'edit_event' => 'Veranstaltung bearbeiten [id%d] \'%s\''
	,'update_event_button' => 'Update Veranstaltung'

// Veranstaltung details
	,'event_details_label' => 'Einzelheiten der Veranstaltung '
	,'event_title' => 'Titel der Veranstaltung'
	,'event_desc' => 'Beschreibung der Veranstaltung'
	,'event_cat' => 'Rubrik'
	,'choose_cat' => 'Eine Rubrik ausw&#228;hlen'
	,'event_date' => 'Veranstaltungsdatum'
	,'day_label' => 'Tag'
	,'month_label' => 'Monat'
	,'year_label' => 'Jahr'
	,'start_date_label' => 'Start Zeit'
	,'start_time_label' => 'um'
	,'end_date_label' => 'Dauer'
	,'all_day_label' => 'Jeden Tag'
// Contact details
	,'contact_details_label' => 'Kontaktinformationen'
	,'contact_info' => 'Kontakt Info'
	,'contact_E-mail' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Event Wiederholen !'
	,'repeat_method_label' => 'Wiederholungsmethode'
	,'repeat_none' => 'Diesen Event NICHT wiederholen'
	,'repeat_every' => 'Wiederhole jeden T/W/M'
	,'repeat_days' => 'Tag(e)'
	,'repeat_weeks' => 'Woche(n)'
	,'repeat_months' => 'Monat(e)'
	,'repeat_years' => 'Jahr(e)'
	,'repeat_end_date_label' => 'Enddatum f&uuml;r Wiederholungen'
	,'repeat_end_date_none' => 'Kein Enddatum'
	,'repeat_end_date_count' => 'Ende nach %s Ereignis(se)'
	,'repeat_end_date_until' => 'Wiederholen bis <br>'
// Other details
	,'other_details_label' => 'Zus&#228;tzliche Informationen'
	,'picture_file' => 'Bilddatei'
	,'file_upload_info' => '(%d KBytes Limit - G&#252;ltige extensions : %s )' 
	,'del_picture' => 'Das aktuelle Bild l&#246;schen?'
// Administrative options
	,'admin_options_label' => 'Administrative Einstellungen'
	,'auto_appr_event' => 'Veranstaltung freischalten'

// Error messages
	,'no_title' => 'Sie m&#252;ssen einen Titel eingeben !'
	,'no_desc' => 'Sie m&#252;ssen diese Veranstaltung beschreiben !'
	,'no_cat' => 'Sie m&#252;ssen aus der Dropdownliste eine Rubrik ausw&#228;hlen!'
	,'date_invalid' => 'Sie m&#252;ssen f&#252;r die Veranstaltung ein g&#252;ltiges Datum eingeben !'
	,'end_days_invalid' => 'Die Werte in \'Tags\' sind nicht g&#252;ltig !'
	,'end_hours_invalid' => 'Die Werte in den \'Stunden\' sind nicht g&#252;ltig !'
	,'end_minutes_invalid' => 'Die Werte in den \'Minuten\' sind nicht g&#252;ltig !'

	,'non_valid_extension' => 'Dieses Bildformat wird nicht unterst&#252;tzt! (Valid extensions: %s)'

	,'file_too_large' => 'Das Bild ist gr&#246;sser als %d KBytes !'
	,'move_image_failed' => 'Das Bild konnte nicht hoch geladen werden !'
	,'non_valid_dimensions' => 'Die Bildbreite oder Bildh&#246;he ist gr&#246;sser als %s Pixels !'

// Misc. messages
	,'submit_event_pending' => 'Ihre Veranstaltung muss noch freigeschaltet werden. Danke f&#252;r Ihren Beitrag'
	,'submit_event_approved' => 'Ihre Veranstaltung wurde automatisch freigeschaltet. Danke f&#252;r Ihren Beitrag'
);

// ======================================================
// daily Ansicht
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Tagesansicht'
	,'next_day' => 'n&#228;chster Tag'
	,'previous_day' => 'letzter Tag'
	,'no_events' => 'F&#252;r heute sind keine Veranstaltung eingetragen.'
);

// ======================================================
// weekly Ansicht
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Wochenansicht'
	,'week_period' => '%s - %s'
	,'next_week' => 'n&#228;chste Woche'
	,'previous_week' => 'letzte Woche'
	,'selected_week' => 'Woche %d'
	,'no_events' => 'F&#252;r diese Woche sind keine Veranstaltungen eingetragen'
);

// ======================================================
// monthly Ansicht
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Monatsansicht'
	,'next_month' => 'n&#228;chster Monat'
	,'previous_month' => 'letzter Monat'
);

// ======================================================
// flat Ansicht
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Flache Ansicht'
	,'week_period' => '%s - %s'
	,'next_month' => 'n&#228;chster Monat'
	,'previous_month' => 'letzter Monat'
	,'contact_info' => 'Kontakt Info'
	,'contact_E-mail' => 'E-mail'
	,'contact_url' => 'URL'
	,'no_events' => 'F&#252;r diesen Monat sind keine Veranstaltungen eingetragen'
);

// ======================================================
// Veranstaltung Ansicht
// ======================================================

$lang_event_view = array(
	'section_title' => 'Veranstaltungsansicht'
	,'display_event' => 'Veranstaltung: \'%s\''
	,'cat_name' => 'Rubrik'
	,'event_start_date' => 'Datum'
	,'event_end_date' => 'bis'
	,'event_duration' => 'Dauer'
	,'contact_info' => 'Kontakt Info'
	,'contact_E-mail' => 'E-mail'
	,'contact_url' => 'URL'
	,'no_event' => 'es gibt keine Veranstaltung anzuzeigen.'
	,'stats_string' => '<strong>%d</strong> Total der Veranstaltungen'
);

// ======================================================
// Rubriken Ansicht
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Rubrikenansichten'
	,'cat_name' => 'Rubrikenname'
	,'total_events' => 'Total Veranstaltung'
	,'upcoming_events' => 'Kommende Veranstaltungen'
	,'no_cats' => 'Es gibt keine Veranstaltungen.'
	,'stats_string' => 'There are <strong>%d</strong> Veranstaltungen in <strong>%d</strong> Rubriken'
);

// ======================================================
// Rubrik Veranstaltungs Ansicht
// ======================================================

$lang_cat_events_Ansicht = array(
	'section_title' => 'Veranstaltungs under \'%s\''
	,'event_name' => 'Name der Veranstaltung'
	,'event_date' => 'Datum'
	,'no_events' => 'In dieser Rubrik gibt es keine Veranstaltungen.'
	,'stats_string' => '<strong>%d</strong> Total der Veranstaltungen'
);

// ======================================================
// cal_Suche.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Agenda - Suche',
	'search_results' => 'Ergebnis der Suche',
	'category_label' => 'Rubrik',
	'date_label' => 'Datum',
	'no_events' => 'In dieser Rubrik gibt es keine Veranstaltungen.',
	'search_caption' => 'Geben Sie Schl&#252;sselworte ein',
	'search_again' => 'nochmals Suchen',
	'search_button' => 'Suchen',
// Misc.
	'no_results' => 'Kein Resultat gefunden',	
// Stats
	'stats_string1' => '<strong>%d</strong> Veranstaltung(en) gefunden',
	'stats_string2' => '<strong>%d</strong> Veranstaltung(en) in <strong>%d</strong> Seit(en)'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'BenutzerInnen Registration',
// Step 1: Terms & Conditions
	'terms_caption' => 'Regeln und Bedingungen',
	'terms_intro' => 'Um sich anmelden zu k&#246;nne m&#252;ssen Sie sich mit folgenden einverstanden erkl&#228;ren:',
	'terms_message' => 'Das Portal Rund um den Bachtel  lebt von den Menschen die es benutzen. Je mehr Menschen es benutzen umso gr&#246;sser ist der Nutzen.( Je mehr Inserate umso gr&#246;sser das Angebot.) Um die Vielseitigkeit des Portals zu gew&#228;hrleisten ist es m&#246;glichst offen gehalten. Die offenen Form soll die  partizipative Ausrichtung des Portals unterstreichen. Dadurch das wenig Restriktion vorhanden sind, ist jeder User aufgerufen verantwortungsvoll mit dem Angebot umzugehen. Das heisst das Sie nicht absichtlich falsche Daten oder Nonsens in das Portal einf&#252;gen.<br />
In den Kategorien in denen Sie mit Ihren Mitmenschen Information teilen sind aufgerufen wie im Alltag, die Umgangs-, und H&#246;flichkeitsregeln zu befolgen. Richten Sie sich einfach nach dem Grundsatz: "Was du nicht willst was man dir tut das f&#252;ge keinem andern zu!" und Sie sind hier der ideale Gast.
KIS Kuske IT Systems duldet keine Werbung von kommerziellen SexworkerInnen, keine  Werbung f&#252;r obskure Nahrungsmittel (Aloe vera, wundersame Sportpulver, Doppingsubstanzen, usw. ...)noch die Anpreisung von illegalen Schneeballsystemen.<br />
Sollten Sie illegale Handlungen planen bitten wir Sie nicht unsere Plattformen dazu zu missbrauchen ;-)<br /><br />
Rechtliche Hinweise<br />
KIS Kuske IT Systems duldet keine Inhalte mit rechtswidrigen Inhalten auf ihren Plattformen und h&#228;lt sich dabei an folgende gesetzlichen Bestimmungen: 
Gewaltdarstellungen im Sinne von Art. 135 des Schweizerischen Strafgesetzbuches (StGB) <br />
Pornografische Schriften, Bildaufnahmen und Darstellungen im Sinne von Art. 197 Ziff. 1 und 3 StGB. Rassendiskiminierung im Sinne von Art. 261bis StGB 
Aufrufe zur Gewalt im Sinne von Art. 259 StGB. <br />
Anleitungen oder Anstiftung zu strafbarem Verhalten oder dessen anderweitige F&#246;rderung 
Unerlaubte Gl&#252;cksspiele (insbes. im Sinne des Lotteriegesetzes) Informationen, die Urheberrechte oder andere Immaterialg&#252;terrechte Dritter verletzen.<br />
Stellt KIS Kuske IT Systems eine missbr&#228;uchliche Verwendung Ihrer Dienstleistungen fest, oder wird ihr von externer Stelle eine inhaltliche Rechtswidrigkeit gemeldet, beh&#228;lt sie sich vor, diese Inhalte sofort und ohne Begr&#252;ndung aus ihrer Datenbank zu l&#246;schen. KIS Kuske IT Systems st&#252;tzt sich in diesem Fall auf die jeweils geltenden Bestimmungen f&#252;r die Verwendung ihrer Dienstleistungen und beh&#228;lt sich in diesem Sinne vor, rechtliche Schritte einleiten<br />',
	'terms_button' => 'Ich habe diese Regeln verstanden und stimme ihnen zu.',
	
// Benutzerkonto Info
	'account_info_label' => 'Konto Informationen',
	'user_name' => 'Benutzername',
	'user_pass' => 'Passwort',
	'user_pass_confirm' => 'Best&#228;tigen Sie das Passwort',
	'user_E-mail' => 'E-mail Adresse',
// Andere Einzelheiten
	'other_details_label' => 'Andere Einzelheiten',
	'first_name' => 'Vorname',
	'last_name' => 'Nachnamen',
	'user_website' => 'Homepage',
	'user_location' => 'Wohnort',
	'user_occupation' => 'Besch&#228;ftigung',
	'register_button' => 'Meine Registration absenden',

// Stats
	'stats_string1' => '<strong>%d</strong> BenutzerInnen',
	'stats_string2' => '<strong>%d</strong> BenutzerInnen in <strong>%d</strong> Seit(en)',
// Misc.
	'reg_nomail_success' => 'Danke f&#252;r Ihre Anmeldung.',
	'reg_mail_success' => 'Eine E-mail mit den n&#246;tigen Informationen um Ihr Konto zu aktivieren wurde soeben Ihnen zugestellt.',
	'reg_activation_success' => 'Gl&#252;ckwunsch Sie haben sich soeben erfolgreich in der Agenda angemeldet. Danke f&#252;r Ihre Anmeldung.',
// Mail messages
	'reg_confirm_subject' => 'Registriert als %s',
	
// Error messages
	'no_username' => 'Sie m&#252;ssen einen Benutzernamen eintragen !',
	'invalid_username' => 'W&#228;hlen Sie eine Benutzernamen der zwischen 4 und 30 Buchstaben lang ist !',
	'username_exists' => 'Dieser Benutzernamen wurde schon vergeben, w&#228;hlen Sie einen andern!',
	'no_password' => 'Sie m&#252;ssen ein Passwort w&#228;hlen !',
	'invalid_password' => 'W&#228;hlen Sie ein Passwort der zwischen 4 und 30 Buchstaben lang ist und nur aus Zahlen und Buchstaben besteht!',
	'password_is_username' => 'Benutzername und Passwort m&#252;ssen sich unterscheiden !',
	'password_not_match' =>'Sie haben ein ung&#252;ltiges Passwort eingegeben \'Best&#228;tige Passwort\'',
	'no_email' => 'Sie m&#252;ssen eine E-mail angeben! !',
	'invalid_email' => 'Sie m&#252;ssen eine g&#252;ltige E-mail angeben!',
	'email_exists' => 'Eine andere BenutzerIn hat sich schon mir dieser E-mail eingetragen, w&#228;hlen Sie bitte eine andere E-mail!',
	'delete_user_failed' => 'Dieses Benutzerkonto kann nicht gel&#246;scht werden',
	'no_users' => 'Es gibt keine Benutzerkonten zum anzeigen !',
	'already_logged' => 'Sie sind schon als Mitglied eingeloggt !',
	'registration_not_allowed' => 'Die Benutzeranmeldung ist zur Zeit nicht verf&#252;gbar, kommen Sie bitte sp&#228;ter noch einmal vorbei !',
	'reg_E-mail_failed' => 'Ein Fehler ist beim pr&#252;fen Ihrer E-mail entstanden!',
	'reg_activation_failed' => 'Ein Fehler ist bei der Aktivierung aufgetreten, versuchen Sie es bitte nochmals !'

);
// Message body for E-mail activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Danke das Sie sich bei uns Registriert haben{CALENDAR_NAME}

Ihr Benutzernamen ist : "{USERNAME}"
Ihr Passwort ist : "{PASSWORD}"

Zum aktivieren Ihrer Anmeldung m&#252;ssen Sie auf den folgenden Link klicken

{REG_LINK}

Herzlichen Dank das Sie sich bei uns angemeldet haben,

Viel Spass w&#252;nscht das Team von {CALENDAR_NAME}

EOT;

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

if (defined('ADMIN_EVENTS_PHP')) 

$lang_event_admin_data = array(
	'section_title' => 'Veranstaltungs Administration',
	'events_to_approve' => 'Veranstaltungs Administration: Veranstaltungen zum freischalten',
	'upcoming_events' => 'Veranstaltungs Administration: Kommende Veranstaltungen',
	'past_events' => 'Veranstaltungs Administration: Abgelaufene Veranstaltungen',
	'add_event' => 'Neue Veranstaltung hinzuf&#252;gen',
	'edit_event' => 'Veranstaltungen bearbeiten',
	'view_event' => 'Veranstaltungen anzeigen',
	'approve_event' => 'Pr&#252;fen der Veranstaltung(en)',
	'update_event' => 'Aktualisierung der Veranstaltungs Informationen',
	'delete_event' => 'L&#246;sche Veranstaltung(en)',
	'events_label' => 'Veranstaltungen',
	'auto_approve' => 'Automatische &#220;berpr&#252;fung',
	'date_label' => 'Datum',
	'actions_label' => 'Aktion',
	'events_filter_label' => 'Veranstaltungsfilter',
	'events_filter_options' => array('Alle Veranstaltungen anzeigen','Nur ungepr&#252;fte Veranstaltungen anzeigen','Kommende Veranstaltungen anzeigen','Nur vergangene Veranstaltungen anzeigen'),
	'picture_attached' => 'Bild hinzugef&#252;gt',
// Ansicht Veranstaltung
	'view_event_name' => 'Veranstaltung: \'%s\'',
	'event_start_date' => 'Datum',
	'event_end_date' => 'bis',
	'event_duration' => 'Dauer',
	'contact_info' => 'Kontakt Info',
	'contact_E-mail' => 'E-mail',
	'contact_url' => 'URL',
// General Info
// Veranstaltung form
	'edit_event_title' => 'Veranstaltung: \'%s\'',
	'cat_name' => 'Rubrik',
	'event_start_date' => 'Datum',
	'event_end_date' => 'bis',
	'contact_info' => 'Kontakt Info',
	'contact_E-mail' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'es gibt keine Veranstaltung anzuzeigen.',
	'stats_string' => '<strong>%d</strong> Total der Veranstaltungen',
// Stats
	'stats_string1' => '<strong>%d</strong> Veranstaltung(en)',
	'stats_string2' => 'Total: <strong>%d</strong> Veranstaltungen am<strong>%d</strong> Seit(en)',
// Misc.
	'add_event_success' => 'Veranstaltung erfolgreich hinzugef&#252;gt',
	'edit_event_success' => 'Veranstaltungen erfolgreich upgedatet',
	'approve_event_success' => 'Veranstaltung erfolgreich &#252;berpr&#252;ft',
	'delete_confirm' => 'Sind Sie sicher das Sie diese Veranstaltung l&#246;schen wollen?',
	'delete_event_success' => 'Veranstaltung erfolgreich gel&#246;scht',
	'active_label' => 'Aktive',
	'not_active_label' => 'Keine Aktiven',
// Error messages
	'no_event_name' => 'Sie m&#252;ssen f&#252;r diese Veranstaltung einen Namen eintragen!',
	'no_event_desc' => 'Sie m&#252;ssen f&#252;r diese Veranstaltung eine Beschreibung eingeben!',
	'no_cat' => 'Sie m&#252;ssen f&#252;r diese Veranstaltung eine Rubrik ausw&#228;hlen!',
	'no_day' => 'Sie m&#252;ssen einen Tag ausw&#228;hlen!',
	'no_month' => 'Sie m&#252;ssen einen Monat ausw&#228;hlen!',
	'no_year' => 'Sie m&#252;ssen ein Jahr ausw&#228;hlen!',
	'non_valid_date' => 'Bitte geben Sie ein g&#252;ltiges Datum ein!',
	'end_days_invalid' => 'Vergewissern Sie sich das \'Tage\' Feld unter \'Dauer\' nur aus Zahlen besteht !',
	'end_hours_invalid' => 'Vergewissern Sie sich das \'Stunden\' Feld unter \'Dauer\'password nur aus Zahlen besteht !',
	'end_minutes_invalid' => 'Vergewissern Sie sich das \'Minuten\' Feld unter \'Dauer\' nur aus Zahlen besteht !',
	'file_too_large' => 'Das ist gr&#246;sser als %d KBytes, versuchen Sie es bitte mit einer andern Gr&#246;sse !',
	'non_valid_extension' => 'Dieses Bildformat wird nicht unterst&#252;tzt!',
	'delete_event_failed' => 'Diese Veranstaltung kann nicht gel&#246;scht werden',
	'approve_event_failed' => 'Diese Veranstaltung kann nicht &#252;berpr&#252;ft werden',
	'no_events' => 'es gibt keine Veranstaltung anzuzeigen !',
	'move_image_failed' => 'Das System konnte nicht das hochgeladene Bild verarbeiten!',
	'non_valid_dimensions' => 'Das Bild ist h&#246;her oder breiter als %s Pixels!'
);

// ======================================================
// admin_Rubriken.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Rubriken Administration',
	'add_cat' => 'Neue Rubrik hinzuf&#252;gen',
	'edit_cat' => 'Rubrik bearbeiten',
	'update_cat' => 'Update Rubrik Info',
	'delete_cat' => 'Rubrik l&#246;schen',
	'events_label' => 'Veranstaltungen',
	'visibility' => 'Sichtbarkeit',
	'actions_label' => 'Aktion',
	'users_label' => 'BenutzerInnen',
	'admins_label' => 'Administratoren',
// General Info
	'general_info_label' => 'Basisinformation',
	'cat_name' => 'Rubrikenname',
	'cat_desc' => 'Rubrik Beschreibung',
	'cat_color' => 'Farbe',
	'pick_color' => 'W&#228;hlen Sie eine Farbe!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Administrative Optionen',
	'auto_admin_appr' => 'Automatisches &#252;berpr&#252;fen der Admineingaben',
	'auto_user_appr' => 'Automatisches &#252;berpr&#252;fen der Benutzereingaben',
// Stats
	'stats_string1' => '<strong>%d</strong> Rubriken',
	'stats_string2' => 'Aktiv: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;on <strong>%d</strong> Seit(en)',
// Misc.
	'add_cat_success' => 'Neue Rubrik erfolgreich hinzuf&#252;gen',
	'edit_cat_success' => ' Die Aktualisierung der Rubrik war erfolgreich',
	'delete_confirm' => 'Sind Sie sicher das Sie diese Rubrik l&#246;schen wollen? ?',
	'delete_cat_success' => 'Rubrik erfolgreich gel&#246;scht',
	'active_label' => 'Aktive',
	'not_active_label' => 'Keine Aktiv(en)',
// Error messages
	'no_cat_name' => 'Sie m&#252;ssen eine Name f&#252;r diese Rubrik eingeben !',
	'no_cat_desc' => 'Sie m&#252;ssen einen Beschreibung f&#252;r diese Rubrik eingeben !',
	'no_Farbe' => 'Sie m&#252;ssen eine Farbe f&#252;r diese Rubrik eingeben !',
	'delete_cat_failed' => 'Diese Rubrik kann nicht gel&#246;scht werden',
	'no_cats' => 'Es gibt keine Veranstaltungen !',
	'cat_has_events' => 'Diese Rubrik enth&#228;lt %d Veranstaltungsdaten und kann nicht gel&#246;scht werden!<br>Bitte l&#246;schen Sie die Veranstaltungen einzeln bevor Sie diese Rubrik l&#246;schen!'

);
// ======================================================
// admin_BenutzerInnens.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'BenutzerInnen Administration',
	'add_user' => 'Neuer BenutzerInnen hinzuf&#252;gen',
	'edit_user' => 'Bearbeiten der BenutzerInnen Info',
	'update_user' => 'Update BenutzerInnen Info',
	'delete_user' => 'Benutzerkonto l&#246;schen',
	'last_access' => 'Letzte Anmeldung der BenutzerInnen',
	'actions_label' => 'Aktion',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Nicht Aktiv',
// Benutzerkonto Info
	'user_info_label' => 'Konto Informationen',
	'user_name' => 'Benutzername',
	'user_pass' => 'Passwort',
	'user_pass_confirm' => 'Best&#228;tigen Sie das Passwort',
	'user_email' => 'E-mail Adresse',
	'group_label' => 'Gruppen Mitgliedschaft',
	'status_label' => 'Benutzerkonto Status',
// Andere EinzelheitenPasswort
	'other_details_label' => 'Andere Einzelheiten',
	'first_name' => 'Vorname',
	'last_name' => 'Nachnamen',
	'user_website' => 'Homepage',
	'user_location' => 'Wohnort',
	'user_occupation' => 'Besch&#228;ftigung',
// Stats
	'stats_string1' => '<strong>%d</strong> BenutzerInnen',
	'stats_string2' => '<strong>%d</strong> BenutzerInnen in <strong>%d</strong> Seit(en)',
// Misc.
	'select_group' => 'W&#228;hlen sie...',
	'add_username_success' => 'Benutzerkonto erfolgreich hinzugef&#252;gt',
	'edit_username_success' => 'Die Aktualisierung Benutzerkonto war erfolgreich',
	'delete_confirm' => 'Sie Sie sicher das Sie das Benutzerkonto l&#246;schen wollen?',
	'delete_user_success' => 'Benutzerkonto erfolgreich gel&#246;scht',
	'update_pass_info' => 'Lassen Sie das Passwortfeld frei, Sie m&#252;ssen es nicht aktualisieren ',
	'access_never' => 'Niemals',
// Error messages
	'no_username' => 'Sie m&#252;ssen einen Benutzername eingeben!',
	'invalid_username' => 'W&#228;hlen Sie eine Benutzernamen der zwischen 4 und 30 Buchstaben lang ist !',
	'invalid_password' => 'W&#228;hlen Sie ein Passwort der zwischen 4 und 30 Buchstaben lang ist und nur aus Zahlen und Buchstaben besteht!',
	'password_is_username' => 'Das Passwort muss sich vom Benutzername unterscheiden!',
	'password_not_match' =>'Das Passwort das sie angeben haben stimmt nicht \'confirm Passwort\'',
	'invalid_email' => 'Sie m&#252;ssen einen g&#252;ltige E-mail angeben!',
	'email_exists' => 'Eine andere BenutzerIn hat sich schon mir dieser E-mail eingetragen, w&#228;hlen Sie bitte eine andere E-mail!',
	'username_exists' => 'Der Benutzername ist schon vergeben, w&#228;hlen Sie einen andern Benutzername !',
	'no_email' => 'Sie m&#252;ssen einen E-mail eingeben!',
	'invalid_email' => 'Sie m&#252;ssen eine g&#252;ltige E-mail eingeben !',
	'no_pasword' => 'Sie m&#252;ssen eine Passwort f&#252;r diese neue Konto eingeben!',
	'no_group' => 'Bitte w&#228;hlen Sie eine Gruppe f&#252;r diesen BenutzerInnen!',
	'delete_users_failed' => 'Dieses Benutzerkonto kann nicht gel&#246;scht werden',
	'no_users' => 'Es gibt keine Benutzerkonten zum anzeigen!'

);

// ======================================================
// admin_Gruppes.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Gruppen - Administration',
	'add_group' => 'Neue Gruppe hinzuf&#252;gen',
	'edit_group' => 'Gruppe bearbeiten',
	'update_group' => 'Update Gruppe Info',
	'delete_group' => 'Gruppe l&#246;schen',
	'view_group' => 'Gruppe anzeigen',
	'users_label' => 'Mitglied',
	'actions_label' => 'Aktion',
// General Info
	'general_info_label' => 'Basisinformation',
	'group_name' => 'Gruppen Name',
	'group_desc' => 'Gruppen Beschreibung',
// Gruppe Access Level
	'access_level_label' => 'Gruppe Access Level',
	'has_admin_access' => 'Benutzer in dieser Gruppe haben Adminrechte',
	'can_manage_accounts' => 'Benutzer in dieser Gruppe K&#246;nne Konten managen',
	'can_change_settings' => 'Benutzer in dieser Gruppe k&#246;nnen  Agendaeinstellungen bearbeiten',
	'can_manage_cats' => 'BenutzerInnen in dieser Gruppe d&#252;rfen Rubriken managen',
	'upl_need_approval' => 'Veranstaltungshinweise einsenden ben&#246;tigt Adminrechte',
// Stats
	'stats_string1' => '<strong>%d</strong> Gruppen',
	'stats_string2' => 'Total: <strong>%d</strong> Gruppen in <strong>%d</strong> Seit(en)',
	'stats_string3' => 'Total: <strong>%d</strong> BenutzerInnen in <strong>%d</strong> Seit(en)',
// Ansicht Gruppe Mitglied
	'group_members_string' => 'Mitglied von \'%s\' Gruppe',
	'username_label' => 'Benutzername',
	'firstname_label' => 'Vorname',
	'lastname_label' => 'Nachnamen',
	'email_label' => 'E-mail',
	'last_access_label' => 'Letztes Login',
	'edit_user' => 'BenutzerIn  bearbeiten',
	'delete_user' => 'BenutzerIn l&#246;schen',
// Misc.
	'add_group_success' => 'Neue Gruppe erfolgreich hinzugef&#252;gt',
	'edit_group_success' => 'Aktualisierung der Gruppe war erfolgreich',
	'delete_confirm' => 'Sind Sie sicher das Sie diese Gruppe l&#246;schen wollen?',
	'delete_user_confirm' => 'Sind Sie sicher das Sie diese Gruppe l&#246;schen wollen?',
	'delete_group_success' => 'Gruppe erfolgreich gel&#246;scht',
	'no_user_string' => 'Es gibt keine BenutzerInnen in dieser  Gruppe',
// Error messages
	'no_group_name' => 'Sie m&#252;ssen einen Namen f&#252;r diese Gruppe eingeben!',
	'no_group_desc' => 'Sie m&#252;ssen einen Beschreibung f&#252;r diese Gruppe eingeben!',
	'delete_group_failed' => 'Diese Gruppe kann nicht gel&#246;scht werden',
	'no_group' => 'Es gibt keine Gruppes zum anzeigen!',
	'group_has_user' => 'Diese Gruppe enth&#228;lt %d Benutzerdaten und kann nicht gel&#246;scht werden!<br>Bitte l&#246;schen Sie die Benutzerdaten einzeln bevor Sie diese Gruppe l&#246;schen!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

if (defined('SETTINGS_PHP')) 

$lang_settings_data = array(
	'section_title' => 'Agenda - Administration'
// Links
	,'admin_links_text' => 'W&#228;hlen Sie eine Sektion'
	,'admin_links' => array('Basiseinstellungen','Template Konfiguration','Produkt Updates')
// General Einstellungen
	,'general_settings_label' => 'Basiseinstellungen'
	,'calendar_name' => 'Name der Agenda'
	,'calendar_description' => 'Agenda Beschreibung'
	,'calendar_admin_email' => 'E-mai der Agenda - Administratoren'
	,'cookie_name' => 'Name der Cookie die von Script benutzt werden.'
	,'cookie_path' => 'Pfad der Cookie die von Script benutzt werden.'
	,'debug_mode' => 'Debugmode aktivieren'
// Environment Einstellungen
	,'env_settings_label' => 'Umgebungseinstellungen'
	,'lang' => 'Sprache'
		,'lang_name' => 'Sprache'
		,'lang_native_name' => 'Sprache'
		,'lang_trans_date' => '&#220;bersetzt von'
		,'lang_author_name' => 'Autor'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'Character encoding'
	,'theme' => 'Theme'
		,'theme_name' => 'Theme name'
		,'theme_date_made' => 'Made on'
		,'theme_author_name' => 'Autor'
		,'theme_author_E-mail' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => 'Timezone offset'
	,'time_format' => 'Zeitformat AM - PM'
		,'24hours' => '24 Stunden'
		,'12hours' => '12 Stunden'
	,'auto_daylight_saving' => 'Automatischer Wechsel Sommerzeit - Winterzeit (DST)'
	,'main_table_width' => 'Tabellenbreite der Haupttabelle (Pixels oder %)'
	,'day_start' => 'Woche startet am'
	,'default_view' => 'Standardansicht'
	,'search_view' => 'Aktiviere Suche'
	,'archive' => 'Anzeige der abgelaufen Veranstaltungen'
	,'events_per_page' => 'Anzahl der Veranstaltungen auf einer Seite' 
	,'sort_order' => 'Reihenfolge in der geordnet wird'
		,'sort_order_title_a' => 'Titel aufsteigend'
		,'sort_order_title_d' => 'Titel absteigend'
		,'sort_order_date_a' => 'Datum aufsteigend'
		,'sort_order_date_d' => 'Datum absteigend'
// user Einstellungen
	,'user_settings_label' => 'BenutzerInnen Einstellungen'
	,'allow_user_registration' => 'Erlaube BenutzerInnen  die Registratur'
	,'reg_duplicate_emails' => 'Erlaube doppelte Benutzung einer E-mail- addy'
	,'reg_email_verify' => 'Aktiviere Benutzerkonten durch E-mail'
// Veranstaltungsansicht
	,'event_view_label' => 'Veranstaltungsansicht'
	,'popup_event_mode' => 'Pop-up Veranstaltung'
	,'popup_event_width' => 'Breite der Pop-up Fenster'
	,'popup_event_height' => 'H&#246;he der Pop-up Fenster'
// Veranstaltung hinzuf&#252;gen Ansicht
	,'add_event_view_label' => 'Ansicht - Veranstaltungen hinzuf&#252;gen'
	,'add_event_view' => 'Aktiviert'
	,'addevent_allow_html' => 'Erlaube <b>BB Code</b> in der Beschreibung'
	,'addevent_allow_contact' => 'Erlaube Kontakt'
	,'addevent_allow_email' => 'Erlaube E-mail'
	,'addevent_allow_url' => 'Erlaube URL'
	,'addevent_allow_picture' => 'Erlaube Bilder'
	,'new_post_notification' => 'Benachrichtigung bei neuer Post'
// Agenda Ansicht
	,'calendar_view_label' => 'Monatliche Agenda-Ansicht'
	,'monthly_view' => 'Aktiviert'
	,'cal_view_max_chars' => 'Maximale Anzahl Buchstaben in der Beschreibung'
// Flugblatt Ansicht
	,'flyer_view_label' => 'Flugblatt Ansicht'
	,'flyer_view' => 'Aktiviert'
	,'flyer_show_picture' => 'Zeige Bilder in der Flugblatt Ansicht'
	,'flyer_view_max_chars' => 'Maximale Anzahl Buchstaben in der Beschreibung'
// Wochenansicht
	,'weekly_view_label' => 'Wochenansicht'
	,'weekly_view' => 'Aktiviert'
	,'weekly_view_max_chars' => 'Maximale Buchstabenanzahl in der Beschreibung'
// Tagesansicht
	,'daily_view_label' => 'Tagesansicht'
	,'daily_view' => 'Aktiviert'
	,'daily_view_max_chars' => 'Maximale Anzahl Buchstaben in der Beschreibung'
// Rubrikenansichten
	,'categories_view_label' => 'Rubrikenansichten'
	,'cats_view' => 'Aktiviert'
	,'cats_view_max_chars' => 'Maximale Anzahl Buchstaben in der Beschreibung'
// Mini Agenda
	,'mini_cal_label' => 'Mini Agenda'
	,'mini_cal_def_picture' => 'Standartbild'
	,'mini_cal_display_picture' => 'Bild anzeige'
	,'mini_cal_diplay_options' => array('Kein Bild','Standartbild', 'Bild des Tages','Bild der Woche','Zufallsbild')
// Bild Einstellungen
	,'picture_settings_label' => 'Bild Einstellungen'
	,'max_upl_dim' => 'Max. Breite oder H&#246;he der Bilder'
	,'max_upl_size' => 'Max. Gr&#246;sse der Bilder (in Bytes)'
	,'picture_chmod' => 'Standardrechte der Bilder (CHMOD) (in Octal)'
	,'allowed_file_extensions' => 'G&#252;ltige File Extensions f&#252;r der Bilder'
// Form Buttons
	,'update_config' => 'Sichere neue Konfiguration'
	,'restore_config' => 'Stelle Werkseinstellungen wieder her'
// Misc.
	,'update_settings_success' => 'Einstellungen erfolgreich aktualisiert'
	,'restore_default_confirm' => 'Sind Sie sicher das Sie die Standardeinstellungen wieder herstellen wollen?'
// Template Konfiguration
	,'template_type' => 'Template Typ'
	,'template_header' => 'Header Anpassung'
	,'template_footer' => 'Footer Anpassung'
	,'template_status_default' => 'Benutze das Standard Template'
	,'template_status_custom' => 'Benutze folgendes Template:'
	,'template_custom' => 'Standard Template'

	,'info_meta' => 'Meta Information'
	,'info_status' => 'Status kontrolle'
	,'info_status_default' => 'L&#246;sche diesen Content'
	,'info_status_custom' => 'Zeige den folgenden Content:'
	,'info_custom' => 'Standard Content'

	,'dynamic_tags' => 'Dynamic Tags'

// Product Updates
	,'updates_check_text' => 'Bitte warten Sie, der Server &#252;bertr&#228;gt Daten...'
	,'updates_no_response' => 'Keine Antwort vom Server. Versuchen Sie es sp&#228;ter.'
	,'avail_updates' => 'Verf&#252;gbare Updates'
	,'updates_download_zip' => 'Download ZIP package (.zip)'
	,'updates_download_tgz' => 'Download TGZ package (.tar.gz)'
	,'updates_released_label' => 'Release Datum: %s'
	,'updates_no_update' => 'Sie haben schon die aktuelle Version am laufen.  Ein Update ist nicht n&#246;tig'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Standartbild'
	,'daily_pic' => 'Bild des Tag (%s)'
	,'weekly_pic' => 'Bild der Woche (%s)'
	,'rand_pic' => 'Zufallsbild (%s)'
	,'post_event' => 'Neue Veranstaltung einsenden'
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

if (defined('LOGIN_PHP')) 

$lang_login_data = array(
	'section_title' => 'Anmeldung'
// General Einstellungen
	,'login_intro' => 'geben Sie Ihren Benutzername und Ihr Passwort ein'
	,'username' => 'Benutzername'
	,'password' => 'Passwort'
	,'remember_me' => 'Erinnere mich'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Bitte &#252;berpr&#252;fen Sie Ihre Login Informationen und versuchen es nochmals!'
	,'no_username' => 'Sie m&#252;ssen einen Benutzername eingeben!'
	,'already_logged' => 'Sie sind schon eingeloggt !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


// old structure	

$maand[0]="Jeden Monat";
$maand[1]="Januar";
$maand[2]="Februar";
$maand[3]="M&#228;rz";
$maand[4]="April";
$maand[5]="Mai";
$maand[6]="Juni";
$maand[7]="Juli";
$maand[8]="August";
$maand[9]="September";
$maand[10]="Oktober";
$maand[11]="November";
$maand[12]="Dezember";

$week[1]="Sonntag";
$week[2]="Montag";
$week[3]="Dienstag";
$week[4]="Mittwoch";
$week[5]="Donnerstag";
$week[6]="Freitag";
$week[7]="Samstag";

function translate($word){

    switch ($word) {
        // Language parameters
        case "lang_name": $new = "German";    break;
        case "lang_nativename": $new = "German";    break;
        case "lang_charset": $new = "ISO-8859-1";    break;
				// Translations
        case "yes": $new = "Ja";    break;
        case "no": $new = "Nein";    break;
        case "welcometo": $new = "Willkommen bei";    break;
        case "admin": $new = "Administration";    break;
        case "adminoptions": $new = "Administrative Einstellungen";    break;
        case "cate": $new = "Rubriken anzeigen"; break;
        case "day": $new = "Tagesansicht"; break;
        case "week": $new = "Woche"; break;
        case "weeklyview": $new = "Wochenansicht"; break;
        case "cal": $new = "Agenda - Ansicht"; break;
        case "nocats": $new = "Zur Zeit es keine Rubriken"; break;
        case "addcat": $new = "Rubrik hinzuf&#252;gen"; break;
        case "cats": $new = "Rubriken"; break;
        case "addevent": $new = "Veranstaltung hinzuf&#252;gen"; break;
        case "outof": $new = "Historical items"; break;
        case "upcomingevents": $new = "Kommende Veranstaltungen"; break;
        case "totalevents": $new = "Total der Veranstaltung"; break;
        case "events": $new = "Veranstaltungen"; break;
        case "errors": $new = "Errors"; break;
        case "weeklyevents": $new = "W&#246;chentliche Veranstaltungen"; break;
        case "eventdetails": $new = "Einzelheiten der Veranstaltung"; break;
        case "eventitle": $new = "Titel der Veranstaltung"; break;
        case "description": $new = "Beschreibung der Veranstaltung"; break;
        case "choosecat": $new = "w&#228;hlen Sie eine Rubrik"; break;
        case "selectyear": $new = "Jahr"; break;
        case "selectmonth": $new = "Monat"; break;
        case "selectday": $new = "Tag"; break;
        case "everyyear": $new = "J&#228;hrlich"; break;
        case "everymonth": $new = "Monatlich"; break;
        case "bdate": $new = "Datum"; break;
        case "notitle": $new = "sie m&#252;ssen einen Titel f&#252;r die Veranstaltung eingeben!"; break;
        case "nodescription": $new = "Sie m&#252;ssen eine Beschreibung der Veranstaltung eingeben"; break;
        case "noday": $new = "Sie m&#252;ssen einen Tag ausw&#228;hlen !"; break;
        case "nomonth": $new = "Sie m&#252;ssen einen Monat ausw&#228;hlen !"; break;
        case "noyear": $new = "Sie m&#252;ssen ein Jahr ausw&#228;hlen !"; break;
        case "nocat": $new = "Sie m&#252;ssen eine Rubrik ausw&#228;hlen !"; break;
        case "novaliddate": $new = "Bitte geben Sie ein g&#252;ltiges Datum ein !"; break;
        case "kblimit": $new = "Bytes Limit"; break;
        case "back": $new = "Zur&#252;ck"; break;
        case "action": $new = "Aktion"; break;
        case "nononapproved": $new = "Es m&#252;ssen zur Zeit keine Veranstaltungen freigeschaltet werden"; break;
        case "nonapproved": $new = "Veranstaltung zum &#252;berpr&#252;fen"; break;
        case "autoapprove": $new = "Automatisches &#252;berpr&#252;fen der Veranstaltung"; break;
        case "cat": $new = "Rubrik"; break;
        case "view": $new = "Veranstaltung(en) anzeigen"; break;
        case "edit": $new = "Bearbeite die Veranstaltung(en)"; break;
        case "updateevent": $new = "Veranstaltung aktualisieren"; break;
        case "approve": $new = "Veranstaltung(en) &#252;berpr&#252;fen"; break;
        case "appreventok": $new = "Veranstaltung(en) erfolgreich &#252;berpr&#252;ft"; break;
        case "cantapprevent": $new = "Diese Veranstaltung kann nicht freigeschaltet werden"; break;
        case "moreinfo": $new = "Mehr Informationen"; break;
        case "editcat": $new = "Bearbeiten der Rubrik(en)"; break;
        case "delcat": $new = "Rubrik l&#246;schen"; break;
        case "edit": $new = "Bearbeiten"; break;
        case "del": $new = "L&#246;schen"; break;
        case "name": $new = "Name"; break;
        case "update": $new = "Aktualisieren"; break;
        case "reallydelcat": $new = "Sind Sie sicher das Sie diese Rubrik l&#246;schen wollen? Alle mit ihr zusammenh&#228;ngenden Veranstaltungen werden gel&#246;scht !"; break;
        case "noback": $new = "Oops, nein, gehe zur&#252;ck !"; break;
        case "deleventok": $new = "Veranstaltung erfolgreich gel&#246;scht"; break;
        case "cantdelevent": $new = "Diese Veranstaltung kann nicht gel&#246;scht werden"; break;
        case "surecat": $new = "ja, l&#246;sche sie jetzt!"; break;
        case "noevents": $new = "Nein, keine Veranstaltungen"; break;
        case "numbevents": $new = "Veranstaltungen in "; break;
        case "upevent": $new = "Aktualisiere Veranstaltung"; break;
        case "delev": $new = "L&#246;sche Veranstaltung"; break;
        case "currentpic": $new = "Aktuelles Bild"; break;
        case "delpic": $new = "L&#246;sche das Bild"; break;
        case "nooutofdate": $new = "Keine abgelaufenen Veranstaltungen."; break;
        case "delalloodev": $new = "L&#246;sche alle abgelaufenen Veranstaltungen"; break;
        case "delevok": $new = "Sind Sie sicher das Sie diese Veranstaltung l&#246;schen wollen?"; break;
        case "delalloodevok": $new = "Alle l&#246;schen !"; break;
        case "prevm": $new = "Letzten Monat"; break;
        case "nextm": $new = "N&#228;chste Woche"; break;
        case "today": $new = "Heute"; break;
        case "eventstoday": $new = "Veranstaltungen heute"; break;
        case "readmore": $new = "Lese mehr"; break;
        case "nextday": $new = "N&#228;chster Tag"; break;
        case "prevday": $new = "Letzter Tag"; break;
        case "askedday": $new = "Angefragter Tag"; break;
        case "nextweek": $new = "N&#228;chste Woche"; break;
        case "prevweek": $new = "Letzte Woche"; break;
        case "weeknr": $new = "Wochen Nummer"; break;
        case "eventsthisweek": $new = "Veranstaltungen vom"; break;
        case "till": $new = "bis"; break;
        case "thankyou": $new = "Danke das Sie f&#252;r die Anmeldung Ihrer Veranstaltung, Sie wird in K&#252;rze freigeschaltet!"; break;
        case "eventedited": $new = "Die Veranstaltung wurde erfolgreich aktuallisiert!"; break;
				case "auf": $new = "an"; break;
       	# here start the new not yet translated language vars
        case "disabled": $new = "Diese Sektion wurde still gelegt"; break;
       	case "searchbutton": $new = "Suche jetzt"; break;
       	case "searchtitle": $new = "Suche"; break;
       	case "searchcaption": $new = "Geben Sie Schl&#252;sselworte ein"; break;
       	case "searchresults": $new = "Suchergebnisse"; break;
       	case "searchagain": $new = "suche nochmals"; break;
      	case "onedate": $new = "Ein Datum"; break;
        case "moredates": $new = "Mehrere Daten"; break;
      	case "moredatesexplain": $new = "Mehr Daten: 'dd-mm-yyyy;dd-mm-yyyy' wenn der Tag ist eines, geben Sie 01 ein, dasselbe f&#252;r die Monate! ohne End-';' !"; break;
      	case "email": $new = "E-mail"; break;
      	case "results": $new = "Resultate"; break;
      	case "noresults": $new = "Keine Resultate"; break;
        case "wronglogin": $new = "&#220;berpr&#252;fen Sie Ihre Zugangsdaten nochmals und versuche es bitte nochmals!"; break;
        case "userman": $new = "BenutzerInnen - Management"; break;
        case "users": $new = "BenutzerInnen"; break;
        case "logout": $new = "Logout"; break;
        case "deluser": $new = "BenutzerIn l&#246;schen"; break;
        case "addnewuser": $new = "Neue(r) BenutzerIn hinzuf&#252;gen"; break;
        case "loginscreen": $new = "Anmeldung"; break;
        case "login": $new = "Login"; break;
        case "password": $new = "Passwort"; break;
        case "rememberme": $new = "Erinnere mich"; break;
				case "loginmsg": $new = "Geben Sie Benutzernamen und Passwort ein"; break;
				case "nologinname": $new = "Bitte geben Sie den Benutzernamen ein"; break;
        case "userwarning": $new = "Wahren Sie Passwort und Benutzernamen an einem sichern Ort auf. Sie k&#246;nnen nicht mehr beschafft werden!"; break;
        case "userdelok": $new = "Sie Sie sicher das Sie diese BenutzerIn l&#246;schen wollen?"; break;
        case "contact": $new = "Kontakt"; break;
        case "contactinfo": $new = "Kontaktinformationen"; break;
        case "otherdetails": $new = "Andere Einzelheiten"; break;
        case "picture": $new = "Bild(er)"; break;
        case "filetolarge": $new = "Die hinzugef&#252;gte ist zu gross !"; break;
        case "extensionnovalid": $new = "Diese Datenformat ist nicht g&#252;tig !"; break;
        case "flyerlink": $new = "Flugblatt Ansicht"; break;
        case "mailtitle": $new = "&#220;berpr&#252;fen Sie die Admin - ASAP !"; break;
        case "mailbody": $new = "Jemand hat eine Veranstaltungen eingeben!"; break;
        case "continuebutton": $new = "Klicken Sie zum weiter machen"; break;
        case "returnbutton": $new = "Zur&#252;ck zur Homepage"; break;
        case "in": $new = "in"; break;
        case "uploadapplnk": $new = "Veranstaltungen"; break;
        case "settingslnk": $new = "Einstellungen"; break;
        case "categorieslnk": $new = "Rubriken"; break;
        case "userslnk": $new = "BenutzerInnen"; break;
        case "groupslnk": $new = "Gruppen"; break;
        case "myprofile": $new = "Mein Profil"; break;
        case "status": $new = "Status"; break;
        case "options": $new = "Einstellungen"; break;
        case "autoappr": $new = "Automatische &#252;berpr&#252;fung"; break;
        case "active": $new = "aktive"; break;
        case "inactive": $new = "Keine aktiven"; break;
        case "admincats": $new = "Rubrik(en) Administration"; break;
        case "generalinfo": $new = "Basisinformation"; break;
        case "catname": $new = "Rubrik(en) Name"; break;
        case "catdesc": $new = "Rubrik(en) Beschreibung"; break;
        case "color": $new = "Farbe"; break;
        case "pickcolor": $new = "W&#228;hlen Sie eine Farbe aus!"; break;
        case "autouserappr": $new = "Automatisches &#252;berpr&#252;fen der Userbeitr&#228;ge"; break;
        case "autoadminappr": $new = "Automatisches &#252;berpr&#252;fen der Adminbeitr&#228;ge"; break;
        case "nocatname": $new = "Sie m&#252;ssen einen Namen ausw&#228;hlen!"; break;
        case "nocatdesc": $new = "Sie m&#252;ssen eine Beschrebung eingeben!"; break;
        case "nocolor": $new = "Sie m&#252;ssen eine Farbe ausw&#228;hlen!"; break;
        case "total": $new = "Total"; break;
        case "admins": $new = "Administratoren"; break;
        case "updatecat": $new = "Aktualisiere die Rubrik(en)"; break;
        case "catedited": $new = "Rubrik(en) erfolgreich aktualisiert!"; break;
        case "delcatmoreevents": $new = "Diese Rubrik enth&#228;lt %d Veranstaltug(en) und kann nicht gel&#246;scht werden!<br>Bitte l&#246;schen Sie zuerst die einzelnen Veranstaltungen und versuchen es danach nochmals!"; break;
        case "delcatok": $new = "Rubrik(en) erfolgreich gel&#246;scht!"; break;
        
        default: $new = "<b>".$word."</b> needs to be translated !";    break;

    }
    return $new;
}
?>