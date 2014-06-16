<?PHP

// New language structure
$lang_info = array (
	'name' => 'Dutch'
	,'nativename' => 'Nederlands' // Language name in native language. E.g: 'Français' for 'French'
	,'locale' => array('nl','dutch') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Armand Segers'
	,'author_email' => 'webmaster@goghie.nl'
	,'author_url' => 'http://www.goghie.nl'
	,'transdate' => '10/07/2004'
);

$lang_general = array (
	'yes' => 'Ja'
	,'no' => 'Nee'
	,'back' => 'Terug'
	,'continue' => 'Doorgaan'
	,'close' => 'Sluiten'
	,'errors' => 'Fouten'
	,'info' => 'Info'
	,'days' => 'Dagen'
	,'months' => 'Maanden'
	,'years' => 'Jaren'
	,'hours' => 'Uren'
	,'minutes' => 'Minuten'
	,'everyday' => 'Elke Dag'
	,'everymonth' => 'Elke Maand'
	,'everyyear' => 'Elk Jaar'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %d %B %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %d %B %Y Om %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %d %B %Y Om %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d %m %Y'
	,'local_date' => '%c'
	,'mini_date' => '%a. %d %b %Y'
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag')
	,'months' => array('Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December')
);

$lang_system = array (
	'system_caption' => 'Systeembericht'
  ,'page_access_denied' => 'U heeft niet genoeg bevoegdheden voor toegang tot deze pagina.'
  ,'operation_denied' => 'U heeft niet genoeg bevoegdheden om deze funktie uit te voeren.'
	,'section_disabled' => 'Deze afdeling is momenteel uitgeschakeld !'
  ,'non_exist_cat' => 'De geselecteerde categorie bestaat niet !'
  ,'non_exist_event' => 'Het geselecteerde event bestaat niet !'
  ,'param_missing' => 'De opgegeven parameters zijn niet correct.'
  ,'no_events' => 'Geen events'
);


// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Voeg Event Toe'
	,'edit_event' => 'Bewerk event [id%d] \'%s\''
	,'update_event_button' => 'Update Event'

// Event details
	,'event_details_label' => 'Event Details'
	,'event_title' => 'Event Titel'
	,'event_desc' => 'Event Beschrijving'
	,'event_cat' => 'Categorie'
	,'choose_cat' => 'Selecteer een categorie'
	,'event_date' => 'Event Datum'
	,'day_label' => 'Dag'
	,'month_label' => 'Maand'
	,'year_label' => 'Jaar'
	,'start_date_label' => 'Starttijd'
	,'start_time_label' => 'Om'
	,'end_date_label' => 'Duur'
	,'all_day_label' => 'Hele Dag'
// Contact details
	,'contact_details_label' => 'Contact Details'
	,'contact_info' => 'Contact Info'
	,'contact_email' => 'Contact Email'
	,'contact_url' => 'Contact URL'
// Other details
	,'other_details_label' => 'Overige Details'
	,'picture_file' => 'Afbeelding Bestand'
	,'file_upload_info' => '(%d KBytes limiet - toegestane extensies : %s )' 
	,'del_picture' => 'Verwijder huidige afbeelding ?'
// Administrative options
	,'admin_options_label' => 'Administratieopties'
	,'auto_appr_event' => 'Event Goedgekeurd'

// Error messages
	,'no_title' => 'U moet een titel voor het event opgeven !'
	,'no_desc' => 'U moet een beschrijving voor het event opgeven !'
	,'no_cat' => 'U moet een categorie uit het menu selecteren !'
	,'date_invalid' => 'U moet een correcte datum voor het event opgeven !'
	,'end_days_invalid' => 'De opgegeven waarde in het \'Days\' veld is niet correct !'
	,'end_hours_invalid' => 'De opgegeven waarde in het \'Hours\' veld is niet correct !'
	,'end_minutes_invalid' => 'De opgegeven waarde in het \'Minutes\' veld is niet correct !'

	,'file_too_large' => 'Het bestand is te groot ! (%d KBytes limiet)'
	,'file_invalid' => 'Het bestandsformaat wordt niet ondersteund ! (Toegestane extensies: %s)'

// Misc. messages
	,'submit_event_pending' => 'Uw event wacht op goedkeuring. Dank U voor uw toevoeging!'
	,'submit_event_approved' => 'Uw event is automatisch goedgekeurd. Dank U voor uw toevoeging!'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Event: \'%s\''
	,'cat_name' => 'Categorie'
	,'event_start_date' => 'Datum'
	,'event_end_date' => 'Tot'
	,'contact_info' => 'Contact Info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'Er is geen event om weer te geven.'
	,'stats_string' => '<strong>%d</strong> Events Totaal'
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Categorieën Weergave'
	,'cat_name' => 'Categorie Naam'
	,'total_events' => 'Totaal Aantal Events'
	,'upcoming_events' => 'Events Binnenkort'
	,'no_cats' => 'Er zijn geen categorieën om weer te geven.'
	,'stats_string' => 'Er zijn <strong>%d</strong> Events in <strong>%d</strong> Categorieën'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Events onder \'%s\''
	,'event_name' => 'Event Naam'
	,'event_date' => 'Datum'
	,'no_events' => 'Er zijn geen events binnen deze categorie.'
	,'stats_string' => '<strong>%d</strong> Events Totaal'
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

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Category Administratie',
	'add_cat' => 'Voeg Nieuwe Categorie Toe',
	'edit_cat' => 'Bewerk Categorie',
	'update_cat' => 'Update Categorie Info',
	'delete_cat' => 'Verwijder Categorie',
	'events_label' => 'Events',
	'auto_approve' => 'Automatisch Goedkeuren',
	'actions_label' => 'Acties',
	'users_label' => 'Gebruikers',
	'admins_label' => 'Admins',
// General Info
	'general_info_label' => 'Algemene Informatie',
	'cat_name' => 'Categorie Naam',
	'cat_desc' => 'Categorie Beschrijving',
	'cat_color' => 'Kleur',
	'pick_color' => 'Kies een Kleur!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Administratieopties',
	'auto_admin_appr' => 'Atomatisch Goedkeuren Admin-toevoegingen',
	'auto_user_appr' => 'Automatisch Goedkeuren Gebruikerstoevoegingen',
// Stats
	'stats_string1' => '<strong>%d</strong> categorieën',
	'stats_string2' => 'Actief: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Totaal: <strong>%d</strong>&nbsp;&nbsp;&nbsp;op %d pagina(s)',
// Misc.
	'add_cat_success' => 'Nieuwe categorie succesvol toegevoegd',
	'edit_cat_success' => 'Categorie met succes bewerkt',
	'delete_confirm' => 'Weet U zeker dat U deze categorie wilt verwijderen ?',
	'delete_cat_success' => 'Categorie succesvol verwijderd',
	'active_label' => 'Actief',
	'not_active_label' => 'Niet Actief',
// Error messages
	'no_cat_name' => 'U moet een naam opgeven voor deze categorie !',
	'no_cat_desc' => 'U moet een beschrijving opgeven voor deze categorie !',
	'no_color' => 'U moet een kleur opgeven voor deze categorie !',
	'delete_cat_failed' => 'Deze categorie kan niet verwijderd worden',
	'no_cats' => 'Er zijn geen categorieën om weer te geven !',
	'cat_has_events' => 'Deze categorie bevat %d event(s) en kan derhalve niet verwijderd worden!<br>Verwijder a.u.b. overgebleven events onder deze categorie en probeer nogmaals!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Gebruikers Administratie',
	'add_user' => 'Voeg Nieuwe Gebruiker Toe',
	'edit_user' => 'Bewerk Gebrukersinfo',
	'update_user' => 'Update Gebruikersinfo',
	'delete_user' => 'Verwijder Gebruiker',
	'last_access' => 'Laatste Toegang',
	'actions_label' => 'Acties',
// Account Info
	'account_info_label' => 'Account Informatie',
	'user_name' => 'Gebruikersnaam',
	'user_pass' => 'Wachtwoord',
	'user_email' => 'E-mail',
	'group_label' => 'Groep Lidmaatschap',
// Other Details
	'other_details_label' => 'Overige Details',
	'first_name' => 'Voornaam',
	'last_name' => 'Achternaam',
// Stats
	'stats_string1' => '<strong>%d</strong> gebruikers',
	'stats_string2' => '<strong>%d</strong> gebruikers op %d pagina(s)',
// Misc.
	'select_group' => 'Selecteer iets...',
	'add_user_success' => 'Gebrukersaccount met succes toegevoegd',
	'edit_user_success' => 'Gebruikersaccount met succes bewerkt',
	'delete_confirm' => 'Weet U zeker dat U dit accuont wilt verwijderen?',
	'delete_user_success' => 'Gebruikersaccount met succes verwijderd',
	'update_pass_info' => 'Laat het wachtwoord-veld leeg als het wachtwoord niet veranderd hoeft te worden',
// Error messages
	'no_username' => 'U moet een gebruikersnaam opgeven !',
	'username_exists' => 'De door U gekozen gebruikersnaam is reeds in gebruik.<br>Kies een andere gebruikersnaam !',
	'no_email' => 'U moet een emailadres opgeven !',
	'invalid_email' => 'U moet een geldig emailadres opgeven !',
	'no_password' => 'U moet een wachtwoord opgeven voor het nieuwe account !',
	'no_group' => 'Kies een groep waar deze gebruiker lid van dient te zijn !',
	'delete_user_failed' => 'Dit gebruikersaccount kan niet verwijderd worden',
	'no_users' => 'Er zijn geen gebruikersaccounts om weer te geven !'

);

// ======================================================
// settings.php
// ======================================================

if (defined('SETTINGS_PHP')) 

$lang_settings_data = array(
	'section_title' => 'Kalenderinstellingen'
// General Settings
	,'general_settings_label' => 'Algemene Instellingen'
	,'calendar_name' => 'Kalender Naam'
	,'calendar_description' => 'Kalender Beschrijving'
	,'calendar_admin_email' => 'Kalender-admin email'
	,'cookie_name' => 'Naam van het cookie dat door het script gebruikt wordt'
	,'cookie_path' => 'Pad van het cookie dat door het script gebruikt wordt'
	,'debug_mode' => 'Zet foutopsporingsmodus aan'
// Environment Settings
	,'env_settings_label' => 'Omgevings Instellingen'
	,'lang' => 'Taal'
		,'lang_name' => 'Taal'
		,'lang_native_name' => 'Nationale Naam'
		,'lang_trans_date' => 'Vertaald op'
		,'lang_author_name' => 'Auteur'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Website'
	,'charset' => 'Character Encoding'
	,'theme' => 'Thema'
		,'theme_name' => 'Thema Naam'
		,'theme_date_made' => 'Gemaakt op'
		,'theme_author_name' => 'Auteur'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Website'
	,'timezone' => 'Tijdzone'
	,'time_format' => 'Tijdsweergave formaat'
		,'24hours' => '24 Uurs'
		,'12hours' => '12 Uurs'
	,'auto_daylight_saving' => 'Automatisch aanpassen voor zomer/wintertijd'
	,'main_table_width' => 'Breedte van de hoofdtabel (Pixels of %)'
	,'day_start' => 'Week start op'
	,'default_view' => 'Standaardweergave'
	,'search_view' => 'Zoeken activeren'
	,'archive' => 'Toon events in het verleden'
	,'events_per_page' => 'Aantal events per pagina'
// Event View
	,'event_view_label' => 'Event Weergave'
	,'popup_event_mode' => 'Pop-up Event'
	,'popup_event_width' => 'Breedte van het Pop-up Venster'
	,'popup_event_height' => 'Hoogte van het Pop-up Venster'
// Add Event View
	,'add_event_view_label' => 'Toevoegen Event Weergave'
	,'add_event_view' => 'Geactiveerd'
	,'addevent_allow_html' => 'Sta <b>BB Code</b> toe in de beschrijvingen'
	,'addevent_allow_contact' => 'Toestaan Contactgegevens'
	,'addevent_allow_email' => 'Toestaan Email'
	,'addevent_allow_url' => 'Toestaan URL'
	,'addevent_allow_picture' => 'Toestaan Afbeeldingen'
	,'new_post_notification' => 'Nieuwe Toevoeging Notificatie'
// Calendar View
	,'calendar_view_label' => 'Kalender (Maandelijks) Weergave'
	,'monthly_view' => 'Geactiveerd'
	,'cal_view_max_chars' => 'Maximum aantal Tekens in beschrijvingen'
// Flyer View
	,'flyer_view_label' => 'Flyer Weergave'
	,'flyer_view' => 'Geactiveerd'
	,'flyer_show_picture' => 'Toon Afbeeldingen in Flyer Weergave'
	,'flyer_view_max_chars' => 'Maximum aantal Tekens in beschrijvingen'
// Weekly View
	,'weekly_view_label' => 'Wekelijkse Weergave'
	,'weekly_view' => 'Geactiveerd'
	,'weekly_view_max_chars' => 'Maximum aantal Tekens in beschrijvingen'
// Daily View
	,'daily_view_label' => 'Dagelijkse Weergave'
	,'daily_view' => 'Geactiveerd'
	,'daily_view_max_chars' => 'Maximum aantal Tekens in beschrijvingen'
// Categories View
	,'categories_view_label' => 'Categorie Weergave'
	,'cats_view' => 'Geactiveerd'
	,'cats_view_max_chars' => 'Maximum aantal Tekens in beschrijvingen'
// Mini Calendar
	,'mini_cal_label' => 'Minikalender'
	,'mini_cal_def_picture' => 'Standaard Afbeelding'
	,'mini_cal_display_picture' => 'Weergeven Afbeelding'
	,'mini_cal_diplay_options' => array('Geen','Standaard Afbeelding', 'Dagelijkse Afbeelding','Wekelijkse Afbeelding','Willekeurige Afbeelding')
// Picture Settings
	,'picture_settings_label' => 'Afbeeldingsinstellingen'
	,'max_upl_size' => 'Max. Grootte voor Afbeeldingen (in KBytes)'
	,'allowed_file_extensions' => 'Toegestane bestandsextensies voor Afbeeldingen'
// Form Buttons
	,'update_config' => 'Bewaar nieuwe Configuratie'
	,'restore_config' => 'Herstel Standaardinstellingen'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Standaardafbeelding'
	,'daily_pic' => 'Afbeelding van de Dag (%s)'
	,'weekly_pic' => 'Afbeelding van de Week (%s)'
	,'rand_pic' => 'Willekeurige Afbeelding (%s)'
	,'post_event' => 'Plaats nieuw Event'
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
	'section_title' => 'Loginscherm'
// General Settings
	,'general_settings_label' => 'Algemene Instellingen'
	,'calendar_name' => 'Kalender Naam'
	,'calendar_description' => 'Kalender Omschrijving'
	,'calendar_admin_email' => 'Kalender-admin email'
	,'cookie_name' => 'Naam van het cookie dat door het script gebruikt wordt'
	,'cookie_path' => 'Pad van het cookie dat door het script gebruikt wordt'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


// old structure	

$maand[0]="Elke maand";
$maand[1]="Januari";
$maand[2]="Februari";
$maand[3]="Maart";
$maand[4]="April";
$maand[5]="Mei";
$maand[6]="Juni";
$maand[7]="Juli";
$maand[8]="Augustus";
$maand[9]="September";
$maand[10]="Oktober";
$maand[11]="November";
$maand[12]="December";

$week[1]="Zondag";
$week[2]="Maandag";
$week[3]="Dinsdag";
$week[4]="Woensdag";
$week[5]="Donderdag";
$week[6]="Vrijdag";
$week[7]="Zaterdag";

function translate($word){

    switch ($word) {
        // Language parameters
        case "lang_name": $new = "Engels";    break;
        case "lang_nativename": $new = "English";    break;
        case "lang_charset": $new = "ISO-8859-1";    break;
				// Translations
        case "yes": $new = "Ja";    break;
        case "no": $new = "Nee";    break;
        case "welcometo": $new = "Welkom bij";    break;
        case "admin": $new = "Administratie";    break;
        case "adminoptions": $new = "Administratieve Opties";    break;
        case "cate": $new = "Categorie Weergave"; break;
        case "day": $new = "Dagelijkse Weergave"; break;
        case "week": $new = "Week"; break;
        case "weeklyview": $new = "Wekelijkse Weergave"; break;
        case "cal": $new = "Kalender Weergave"; break;
        case "nocats": $new = "Nog geen categorieën"; break;
        case "addcat": $new = "Voeg nieuwe categorie toe"; break;
        case "cats": $new = "Categorieën"; break;
        case "addevent": $new = "Voeg Event Toe"; break;
        case "outof": $new = "Historische items"; break;
        case "upcomingevents": $new = "Events Binnenkort"; break;
        case "totalevents": $new = "Totaal Aantal Events"; break;
        case "events": $new = "Events"; break;
        case "errors": $new = "Foutmeldingen"; break;
        case "weeklyevents": $new = "Weekelijkse events"; break;
        case "eventdetails": $new = "Event details"; break;
        case "eventitle": $new = "Event titel"; break;
        case "description": $new = "Event beschrijving"; break;
        case "choosecat": $new = "Kies categorie"; break;
        case "selectyear": $new = "Jaar"; break;
        case "selectmonth": $new = "Maand"; break;
        case "selectday": $new = "Dag"; break;
        case "everyyear": $new = "Elk Jaar"; break;
        case "everymonth": $new = "Elke Maand"; break;
        case "bdate": $new = "Datum"; break;
        case "notitle": $new = "U moet een eventtitel opgeven !"; break;
        case "nodescription": $new = "U moet een eventbeschrijving opgeven"; break;
        case "noday": $new = "U moet een dag uitkiezen !"; break;
        case "nomonth": $new = "U moet een maand uitkiezen !"; break;
        case "noyear": $new = "U moet een jaar uitkiezen !"; break;
        case "nocat": $new = "U moet een categorie uitkiezen !"; break;
        case "novaliddate": $new = "Voer a.u.b. een geldige datum in !"; break;
        case "kblimit": $new = "KBytes limiet"; break;
        case "back": $new = "Terug"; break;
        case "action": $new = "Acties"; break;
        case "nononapproved": $new = "Er zijn op dit moment geen events die goedkeuring behoeven"; break;
        case "nonapproved": $new = "Events ter goedkeuring"; break;
        case "autoapprove": $new = "Automatisch Goedkeuren Event"; break;
        case "cat": $new = "Categorie"; break;
        case "view": $new = "Bekijk event"; break;
        case "edit": $new = "Bewerk event"; break;
        case "updateevent": $new = "Update event"; break;
        case "approve": $new = "Dit event goedkeuren"; break;
        case "appreventok": $new = "Event met succes goedgekeurd"; break;
        case "cantapprevent": $new = "Het opgegeven event kan niet goedgekeurd worden"; break;
        case "moreinfo": $new = "Meer info"; break;
        case "editcat": $new = "Bewerk Categorie"; break;
        case "delcat": $new = "Verwijder Categorie"; break;
        case "edit": $new = "Bewerk"; break;
        case "del": $new = "Verwijder"; break;
        case "name": $new = "Naam"; break;
        case "update": $new = "Update"; break;
        case "reallydelcat": $new = "Weet U zeker dat U deze categorie wilt verwijderen ?<br>Alle events onder deze categorie worden permanent verwijderd !"; break;
        case "noback": $new = "Oops, nee, terug !"; break;
        case "deleventok": $new = "Event succesvol verwijderd"; break;
        case "cantdelevent": $new = "Het opgegeven event kan niet worden verwijderd"; break;
        case "surecat": $new = "Ja, verwijder nu !"; break;
        case "noevents": $new = "Geen events"; break;
        case "numbevents": $new = "Events in "; break;
        case "upevent": $new = "Update event"; break;
        case "delev": $new = "Verwijder event"; break;
        case "currentpic": $new = "Huidige afbeelding"; break;
        case "delpic": $new = "Verwijder deze afbeelding"; break;
        case "nooutofdate": $new = "Geen out-of-date events."; break;
        case "delalloodev": $new = "Verwijder alle out-of-date events"; break;
        case "delevok": $new = "Weet U absoluut zeker dat U dit event wilt verwijderen?"; break;
        case "delalloodevok": $new = "Verwijder ze allemaal !"; break;
        case "prevm": $new = "Vorige Maand"; break;
        case "nextm": $new = "Volgende Maand"; break;
        case "today": $new = "Vandaag"; break;
        case "eventstoday": $new = "Events vandaag"; break;
        case "readmore": $new = "Lees meer"; break;
        case "nextday": $new = "Volgende dag"; break;
        case "prevday": $new = "Vorige dag"; break;
        case "askedday": $new = "Gevraagde dag"; break;
        case "nextweek": $new = "Volgende week"; break;
        case "prevweek": $new = "Vorige week"; break;
        case "weeknr": $new = "weeknummer"; break;
        case "eventsthisweek": $new = "Events van "; break;
        case "till": $new = "tot"; break;
        case "thankyou": $new = "Dank U voor het toevoegen van een event, het zal binnenkort verschijnen!"; break;
        case "eventedited": $new = "Event succesvol bewerkt!"; break;
				case "op": $new = "aan"; break;
       	# here start the new not yet translated language vars
        case "disabled": $new = "Deze afdeling is niet geactiveerd"; break;
       	case "searchbutton": $new = "Zoek Nu"; break;
       	case "searchtitle": $new = "Zoeken"; break;
       	case "searchcaption": $new = "Geef Uw zoekopdracht/woorden op"; break;
       	case "searchresults": $new = "Zoekresultaten"; break;
       	case "searchagain": $new = "Zoek nogmaals"; break;
      	case "onedate": $new = "Een datum"; break;
        case "moredates": $new = "Meerdere datums"; break;
      	case "moredatesexplain": $new = "More datums: 'dd-mm-yyyy;dd-mm-yyyy' als de datum de eerste is, type 01, hetzelfde geldt voor de maand! zonder ';' aan het einde !"; break;
      	case "email": $new = "Email"; break;
      	case "results": $new = "Resultaten"; break;
      	case "noresults": $new = "Geen resultaten"; break;
        case "wronglogin": $new = "Verifieëer a.u.b. uw logingegevens en probeer opnieuw!"; break;
        case "userman": $new = "Gebruikers management"; break;
        case "users": $new = "Gebruikers"; break;
        case "logout": $new = "Uitloggen"; break;
        case "deluser": $new = "Verwijder gebruiker"; break;
        case "addnewuser": $new = "Nieuwe gebruiker toevoegen"; break;
        case "loginscreen": $new = "Inlogscherm"; break;
        case "login": $new = "Inloggen"; break;
        case "password": $new = "Wachtwoord"; break;
        case "rememberme": $new = "Onthoud mij"; break;
				case "loginmsg": $new = "Voer Uw gebruikersnaam en wachtwoord in om in te loggen"; break;
				case "nologinname": $new = "Geef a.u.b. een geldige gebruikersnaam op!"; break;
        case "userwarning": $new = "Onthoud Uw wachtwoord goed, het kan niet meer achterhaald worden !"; break;
        case "userdelok": $new = "Weet U zeker dat U deze gebruiker wilt verwijderen ?"; break;
        case "contact": $new = "Adres"; break;
        case "contactinfo": $new = "Adresgegevens"; break;
        case "otherdetails": $new = "Overige Gegevens"; break;
        case "picture": $new = "Afbeelding"; break;
        case "filetolarge": $new = "Dit bestand is te groot !"; break;
        case "extensionnovalid": $new = "Bestandsextensie is niet toegestaan !"; break;
        case "flyerlink": $new = "Flyer Weergave"; break;
        case "mailtitle": $new = "Check your calendar admin ASAP !"; break;
        case "mailbody": $new = "Somebody has given in an event !"; break;
        case "continuebutton": $new = "Doorgaan"; break;
        case "returnbutton": $new = "Terug naar homepage"; break;
        case "in": $new = "in"; break;
        case "uploadapplnk": $new = "Event Goedkeuring"; break;
        case "settingslnk": $new = "Instellingen"; break;
        case "categorieslnk": $new = "Categorieën"; break;
        case "userslnk": $new = "Gebruikers"; break;
        case "groupslnk": $new = "Groepen"; break;
        case "myprofile": $new = "Mijn Profiel"; break;
        case "status": $new = "Status"; break;
        case "options": $new = "Opties"; break;
        case "autoappr": $new = "Automatische Goedkeuring"; break;
        case "active": $new = "Actief"; break;
        case "inactive": $new = "Niet Actief"; break;
        case "admincats": $new = "Categorie Administratie"; break;
        case "generalinfo": $new = "Algemene Informatie"; break;
        case "catname": $new = "Categorienaam"; break;
        case "catdesc": $new = "Categorieomschrijving"; break;
        case "color": $new = "Kleur"; break;
        case "pickcolor": $new = "Kies een kleur!"; break;
        case "autouserappr": $new = "Automatisch goedkeuren gebruikerstoevoegingen"; break;
        case "autoadminappr": $new = "Automatisch goedkeuren admin-toevoegingen"; break;
        case "nocatname": $new = "U moet een categorienaam opgeven!"; break;
        case "nocatdesc": $new = "U moet een beschrijving opgeven!"; break;
        case "nocolor": $new = "U moet een kleur opgeven!"; break;
        case "total": $new = "Totaal"; break;
        case "admins": $new = "Admins"; break;
        case "updatecat": $new = "Categorie Updaten"; break;
        case "catedited": $new = "Categorie succesvol ge-update!"; break;
        case "delcatmoreevents": $new = "Deze categorie bevat %d event(s) en kan derhalve niet verwijderd worden!<br>Please delete remaining events under this category and try again!"; break;
        case "delcatok": $new = "Categorie succesvol verwijderd!"; break;
        
        default: $new = "<b>".$word."</b> moet vertaald worden !";    break;

    }
    return $new;
}
?>