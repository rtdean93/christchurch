<?PHP
// Danish translation for ExtCalendar 0.8
// New language structure
$lang_info = array (
	'name' => 'Danish'
	,'nativename' => 'Dansk' // Language name in native language. E.g: 'Fran�ais' for 'French'
	,'locale' => array('da_DK','dansk') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'mijji, wkn & Andyman'
	,'author_email' => 'none'
	,'author_url' => 'none'
	,'transdate' => '04/20/2005'
);

$lang_general = array (
	'yes' => 'Ja'
	,'no' => 'Nej'
	,'back' => 'Tilbage'
	,'continue' => 'Forts�t'
	,'close' => 'Luk'
	,'errors' => 'Fejl'
	,'info' => 'Information'
	,'day' => 'Dag'
	,'days' => 'Dage'
	,'month' => 'M�ned'
	,'months' => 'M�neder'
	,'year' => '�r'
	,'years' => '�r'
	,'hour' => 'Time'
	,'hours' => 'Timer'
	,'minute' => 'Minut'
	,'minutes' => 'Minutter'
	,'everyday' => 'Hver dag'
	,'everymonth' => 'Hver m�ned'
	,'everyyear' => 'Hvert �r'
	,'active' => 'Aktiv'
	,'not_active' => 'Ikke aktiv'
	,'today' => 'I dag'
	,'signature' => 'Drevet af %s'
	,'expand' => '�bn'
	,'collapse' => 'Luk'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %d %B, %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %d %B, %Y kl. %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %d %B, %Y kl. %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred Dato and time representation for current language 
	,'mini_date' => '%a. %d %b, %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('S�ndag','Mandag','Tirsdag','Onsdag','Torsdag','Fredag','L�rdag')
	,'months' => array('Januar','Februar','Marts','April','Maj','Juni','Juli','August','September','Oktober','November','December')
);

$lang_system = array (
	'system_caption' => 'Systembesked'
  ,'page_access_denied' => 'Du har ikke adgang til at se denne side.'
  ,'page_requires_login' => 'Du skal v�re logget ind for at se denne side.'
  ,'operation_denied' => 'Du har ikke adgang til at udf�re denne opgave.'
	,'section_disabled' => 'Denne del er ikke aktiv.'
  ,'non_exist_cat' => 'Den valgte kategori eksisterer ikke.'
  ,'non_exist_event' => 'Det valgte begivenhed eksisterer ikke.'
  ,'param_missing' => 'De opgivne oplysninger er ikke korrekte.'
  ,'no_event' => 'Der er ingen begivenheder i kalenderen.'
  ,'config_string' => 'Du bruger p.t. \'%s\' p� %s, %s and %s.'
  ,'no_table' => 'Tabellen \'%s\' eksisterer ikke!'
  ,'no_anonymous_group' => 'Tabellen %s indeholder ikke gruppen \'Anonym\'!'
  ,'calendar_locked' => 'Kalenderen er midlertidigt lukket ned for vedligeholdelse. Vi beklager de gener det m�tte medf�re!'
	,'new_upgrade' => 'Systemet har registreret en ny version. Vi anbefaler at opgradere nu. Klik "Forts�t" for at k�re opgraderingsv�rkt�jet.'
	,'no_profile' => 'Der skete en fejl, mens din profilinformation blev hentet.'
	,'unknown_component' => 'Ukendt komponent'
// Mail messages
	,'new_event_subject' => 'En begivenhed kr�ver godkendelse i %s'
	,'event_notification_failed' => 'Der opstod en fejl i fors�get p� at sende en p�mindelse!'
);

// Message body for new event email notification
$lang_system['Begivenhed_notification_body'] = <<<EOT
Den f�lgende begivenhed er netop blevet foresl�et til {CALENDAR_NAME}
og kr�ver godkendelse:

Overskrift: "{TITLE}"
Dato: "{DATE}"
Varighed: "{DURATION}"

Du kan se denne begivenhed ved at klikke p� linket herunder eller kopiere det til din browser

{LINK}

Bem�rk at du skal v�re logget ind som administrator
for at linket skal virke.

Venlig hilsen

Administrationen for {CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Log ind'
	,'register' => 'Registrer'
  ,'logout' => 'Log ud <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Min profil'
	,'admin_event' => 'Begivenheder'
  ,'admin_categories' => 'Kategorier'
  ,'admin_groups' => 'Grupper'
  ,'admin_users' => 'Brugere'
  ,'admin_settings' => 'Indstillinger'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Tilf�j begivenhed'
	,'cal_view' => 'M�nedlig'
  ,'flat_view' => 'Flad visning'
  ,'weekly_view' => 'Ugentlig'
  ,'daily_view' => 'Daglig'
  ,'yearly_view' => '�rlig'
  ,'categories_view' => 'Kategorier'
  ,'search_view' => 'S�g'
);

// ======================================================
// Add event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Tilf�j begivenhed'
	,'edit_event' => 'Ret i begivenhed [id%d] \'%s\''
	,'update_event_button' => 'Opdater begivenhed'

// event details
	,'event_details_label' => 'Begivenhedsoplysninger'
	,'event_title' => 'Begivenhedsoverskrift'
	,'event_desc' => 'Beskrivelse af begivenhed'
	,'event_cat' => 'Kategori'
	,'choose_cat' => 'V�lg en kategori'
	,'event_date' => 'Dato for begivenhed'
	,'day_label' => 'Dag'
	,'month_label' => 'M�ned'
	,'year_label' => '�r'
	,'start_date_label' => 'Startdato'
	,'start_time_label' => 'kl.'
	,'end_date_label' => 'Varighed'
	,'all_day_label' => 'Hele dagen'
// Contact details
	,'contact_details_label' => 'Kontaktoplysninger'
	,'contact_info' => 'Kontaktinformation'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'Websted'
// Repeat Begivenheder
	,'repeat_event_label' => 'Gentag begivenhed'
	,'repeat_method_label' => 'Gentag metode'
	,'repeat_none' => 'Gentag ikke denne begivenhed'
	,'repeat_every' => 'Gentag hver'
	,'repeat_days' => 'dag(e)'
	,'repeat_weeks' => 'uge(r)'
	,'repeat_months' => 'm�ned(er)'
	,'repeat_years' => '�r'
	,'repeat_end_date_label' => 'Gentag slutdato'
	,'repeat_end_date_none' => 'Ingen slutdato'
	,'repeat_end_date_count' => 'Slut efter %s gentagelser'
	,'repeat_end_date_until' => 'Gentag indtil'
// Andre Oplysninger
	,'other_details_label' => 'Andre oplysninger'
	,'picture_file' => 'Billedfil'
	,'file_upload_info' => '(Maksimal st�rrelse: %d Kb  - Gyldige filtyper : %s )' 
	,'del_picture' => 'Slet nuv�rende billede ?'
// Administrative options
	,'admin_options_label' => 'Administrative muligheder'
	,'auto_appr_event' => 'Begivenhed godkendt'

// Error messages
	,'no_title' => 'Du skal skrive en overskrift!'
	,'no_desc' => 'Du skal skrive en beskrivelse!'
	,'no_cat' => 'Du skal v�lge en kategori fra menuen!'
	,'date_invalid' => 'Du skal angive en gyldig dato!'
	,'end_days_invalid' => 'V�rdien indtastet i \'Dage\' feltet er ikke gyldig!'
	,'end_hours_invalid' => 'V�rdien indtastet i \'Timer\' feltet er ikke gyldig!'
	,'end_minutes_invalid' => 'V�rdien indtastet i \'Minutter\' feltet er ikke gyldig!'

	,'non_valid_extension' => 'Filformatet af det tilf�jede billede er ikke gyldigt! (Gyldige formater: %s)'

	,'file_too_large' => 'Det tilf�jede billede er st�rre end %d Kb!'
	,'move_image_failed' => 'Systemet kunne ikke uploade billedet ordentligt. Tjek venligst at det er den rette st�rrelse og i et gyldigt format, eller kontakt administratoren.'
	,'non_valid_dimensions' => 'Billedets bredde eller h�jde er st�rre end %s pixels!'

	,'recur_val_1_invalid' => 'V�rdien indtastet i \'gentag interval\' er ikke gyldig. V�rdien skal v�re et tal st�rre end \'0\'!'
	,'recur_end_count_invalid' => 'V�rdien indtastet i \'antal gentagelser\' er ikke gyldig. V�rdien skal v�re et tal st�rre end \'0\'!'
	,'recur_end_until_invalid' => 'Datoen i \'gentag indtil\' skal v�re efter startdatoen!'
// Misc. messages
	,'submit_event_pending' => 'Din begivenhed er afsendt. Den vil dog ikke kunne ses i kalenderen f�r den er godkendt af en administrator. Tak for dit bidrag!'
	,'submit_event_approved' => 'Din begivenhed er automatisk godkendt. Tak for dit bidrag!'
	,'event_repeat_msg' => 'Denne begivenhed gentages'
	,'event_no_repeat_msg' => 'Denne begivenhed gentages ikke'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Daglig'
	,'next_day' => 'N�ste dag'
	,'previous_day' => 'Forrige dag'
	,'no_events' => 'Der er ingen begivenheder denne dag.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Ugentlig'
	,'week_period' => '%s - %s'
	,'next_week' => 'N�ste uge'
	,'previous_week' => 'Forrige uge'
	,'selected_week' => 'Uge %d'
	,'no_events' => 'Der er ingen begivenheder denne uge'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'M�nedlig'
	,'next_month' => 'N�ste m�ned'
	,'previous_month' => 'Forrige m�ned'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Flad visning'
	,'week_period' => '%s - %s'
	,'next_month' => 'N�ste m�ned'
	,'previous_month' => 'Forrige m�ned'
	,'contact_info' => 'Kontaktinformation'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'Websted'
	,'no_events' => 'Der er ingen begivenheder denne m�ned'
);

// ======================================================
// Begivenhed view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Vis begivenhed'
	,'display_event' => 'Begivenhed: \'%s\''
	,'cat_name' => 'Kategori'
	,'event_start_date' => 'Dato'
	,'event_end_date' => 'Indtil'
	,'event_duration' => 'Varighed'
	,'contact_info' => 'Kontaktinformation'
	,'contact_email' => 'E-mail'
	,'contact_url' => 'Website'
	,'no_event' => 'Der er ingen begivenheder'
	,'stats_string' => '<strong>%d</strong> begivenheder i alt'
	,'edit_event' => 'Rediger begivenhed'
	,'delete_event' => 'Slet begivenhed'
	,'delete_confirm' => 'Er du sikker p� at du vil slette denne begivenhed?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Vis kategorier'
	,'cat_name' => 'Kategorinavn'
	,'total_events' => 'Begivenheder i alt'
	,'upcoming_events' => 'Kommende begivenheder'
	,'no_cats' => 'Der er ingen kategorier.'
	,'stats_string' => 'Der er <strong>%d</strong> begivenheder i <strong>%d</strong> kategorier'
);

// ======================================================
// Kategori Begivenheder view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Begivenhed under \'%s\''
	,'event_name' => 'Begivenhedsnavn'
	,'event_date' => 'Dato'
	,'no_events' => 'Der er ingen begivenheder under denne kategori.'
	,'stats_string' => '<strong>%d</strong> begivenheder ialt.'
	,'stats_string1' => '<strong>%d</strong> begivenhed(er) p� <strong>%d</strong> side(r)'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'S�g i kalender',
	'search_results' => 'S�geresultater',
	'category_label' => 'Kategori',
	'date_label' => 'Dato',
	'no_event' => 'Der er ingen begivenheder under denne kategori.',
	'search_caption' => 'Indtast s�geord...',
	'search_again' => 'S�g igen',
	'search_button' => 'S�g',
// Misc.
	'no_results' => 'S�gningen fandt intet.',	
// Stats
	'stats_string1' => 'S�gningen fandt <strong>%d</strong> begivenhed(er)',
	'stats_string2' => 'S�gningen fandt <strong>%d</strong> begivenhed(er) p� <strong>%d</strong> side(r)'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Min profil',
	'edit_profile' => 'Ret min profil',
	'update_profile' => 'Opdater min profil',
	'actions_label' => 'Aktioner',  
// Account Info
	'account_info_label' => 'Profil-information',
	'user_name' => 'Brugernavn',
	'user_pass' => 'Adgangskode',
	'user_pass_confirm' => 'Bekr�ft adgangskode',
	'user_email' => 'E-mail-adresse',
	'group_label' => 'Gruppemedlemskab',
// Andre Oplysninger
	'other_details_label' => 'Andre detaljer',
	'first_name' => 'Fornavn',
	'last_name' => 'Efternavn',
	'full_name' => 'Fuldt navn',
	'user_website' => 'Hjemmeside',
	'user_location' => 'Hjemby',
	'user_occupation' => 'Besk�ftigelse',
// Misc.
	'select_language' => 'V�lg sprog',
	'edit_profile_success' => 'Din profil er opdateret',
	'update_pass_info' => 'Lad adgangskodefelterne v�re tomme, hvis du ikke vil �ndre din nuv�rende adgangskode',
// Error messages
	'invalid_password' => 'Indtast en adgangskode, der udelukkende best�r af bogstaver og tal, og som er mellem 4 og 16 tegn langt!',
	'password_is_username' => 'Adgangskode skal v�re forskellig fra brugernavnet!',
	'password_not_match' =>'De indtastede adgangskoder var forskellige',
	'invalid_email' => 'Du skal indtaste en gyldig e-mail-adresse!',
	'email_exists' => 'En anden bruger er allerede registreret med den e-mail-adresse du har indtastet. Indtast en anden e-mail-adresse!',
	'no_email' => 'Du skal indtaste en e-mail-adresse!',
	'no_password' => 'Du skal indtaste en adgangskode!'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Brugerregistrering',
// Step 1: Terms & Conditions
	'terms_caption' => 'Brugerbetingelser',
	'terms_intro' => 'For at forts�tte, skal du godkende flg.:',
	'terms_message' => 'L�s venligst reglerne herunder. Hvis du kan acceptere dem og �nsker at forts�tte med registreringen, s� klik p� "Godkend"-knappen herunder. For at afbryde registreringen, tryk p� din \'Tilbage\'-knap i din browser.<br /><br />Bem�rk venligst at vi ikke er ansvarlige for begivenheder indtastet af brugerne. Vi er ikke ansvarlige for n�jagtigheden, fuldst�ndigheden eller brugbarheden af de offentliggjorte begivenheder, ej heller for indholdet af begivenhederne.<br /><br />Teksterne udtrykker forfatteren af begivenhedernes synspunkt, ikke n�dvendigvis denne kalenderapplikations synspunkt. Enhver bruger, som finder at en offentliggjort begivenhed er anst�delig, opfordres til straks at kontakte os via e-mail. Vi har mulighed for at slette anst�deligt indhold, og vi bestr�ber os p� at g�re dette indenfor en rimelig tidsramme, s�fremt vi afg�r at sletning er n�dvendig.<br /><br />Du samtykker i forbindelse med brugen af denne service i, at du ikke vil bruge denne kalenderapplikation til at offentligg�re materiale, som du ved er usand og/eller �rekr�nkende, un�jagtig, st�dende, vulg�rt, hadefuldt, chikanerende, uanst�ndigt, blasfemisk, seksuelt orienteret, truende, kr�nker privatlivets fred eller p� anden m�der kr�nker danske love.<br/><br/>Du samtykker i, at du ikke vil offentligg�re copyright-beskyttet materiale medmindre rettighederne ejes af dig eller af %s.',
	'terms_button' => 'Godkend',

/////////////////////////////////////////////////////////////////TERMS_MESSAGE er ikke 100% oversat.

	
// Account Info
	'account_info_label' => 'Profil-information',
	'user_name' => 'Brugernavn',
	'user_pass' => 'Adgangskode',
	'user_pass_confirm' => 'Godkend adgangskode',
	'user_email' => 'E-mail',
// Andre Oplysninger
	'other_details_label' => 'Andre oplysninger',
	'first_name' => 'Fornavn',
	'last_name' => 'Efternavn',
	'user_website' => 'Hjemmeside',
	'user_location' => 'Hjemby',
	'user_occupation' => 'Besk�ftigelse',
	'register_button' => 'Indsend min registrering',

// Stats
	'stats_string1' => '<strong>%d</strong> brugere',
	'stats_string2' => '<strong>%d</strong> brugere p� <strong>%d</strong> side(r)',
// Misc.
	'reg_nomail_success' => 'Tak for din registrering.',
	'reg_mail_success' => 'En e-mail med informaion om hvordan du aktiverer din konto er blevet sendt til den e-mail-adresse du indtastede.',
	'reg_activation_success' => 'Tillykke! Din profil er nu aktiv og du kan logge ind med dit brugernavn og adgangskode. Tak for din registrering.',
// Mail messages
	'reg_confirm_subject' => 'Registrering hos %s',
	
// Error messages
	'no_username' => 'Du skal indtaste et brugernavn!',
	'invalid_username' => 'Indtast et brugernavn, der kun best�r af bogstaver og tal, og er mellem 4 og 30 tegn langt!',
	'username_exists' => 'Brugernavnet du indtastede er optaget. Indtast et nyt brugernavn!',
	'no_password' => 'Du skal indtaste en adgangskode!',
	'invalid_password' => 'Indtast en adgangskode, der kun best�r af bogstaver og tal, og er mellem 4 og 16 tegn langt!',
	'password_is_username' => 'Adgangskoden skal v�re forskellig fra brugernavnet!',
	'password_not_match' =>'De indtastede adgangskoder var forskellige',
	'no_email' => 'Du skal indtaste en e-mail!',
	'invalid_email' => 'Du skal skrive en gyldig e-mail-adresse!',
	'email_exists' => 'En anden bruger er registreret med den e-mail-adresse du indtastede. Indtast en anden e-mail-adresse.!',
	'delete_user_failed' => 'Denne profil kan ikke slettes',
	'no_users' => 'Der er ingen brugerprofiler!',
	'already_logged' => 'Du er allerede logget ind som medlem!',
	'registration_not_allowed' => 'Brugerregistrering er ikke aktiv!',
	'reg_email_failed' => 'Der skete en fejl under afsendelse af aktiveringsmail!',
	'reg_activation_failed' => 'Der skete en fejl under godkendelsen af aktiveringen'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Tak fordi du registrede dig i {CALENDAR_NAME}

Dit brugernavn er: "{USERNAME}"
Din adgangskode er: "{PASSWORD}"

For at aktivere din profil skal du klikke p� linket herunder
eller kopiere det til din webbrowser

{REG_LINK}

Venlig hilsen

Administratoren i {CALENDAR_NAME}

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
// admin_Begivenheder.php
// ======================================================


if (defined('ADMIN_EVENTS_PHP')) 

$lang_event_admin_data = array(
	'section_title' => 'Begivenhedsadministration',
	'events_to_approve' => 'Begivenhedsadministration: Begivenheder, der afventer godkendelse',
	'upcoming_event' => 'Begivenhedsadministration: Kommende begivenheder',
	'past_event' => 'Begivenhedsadministration: Tidligere begivenheder',
	'add_event' => 'Tilf�j ny begivenhed',
	'edit_event' => 'Rediger begivenhed',
	'view_event' => 'Vis begivenhed',
	'approve_event' => 'Godkend begivenhed',
	'update_event' => 'Opdater begivenhedsinformation',
	'delete_event' => 'Slet begivenhed',
	'events_label' => 'Begivenheder',
	'auto_approve' => 'Auto-godkend',
	'date_label' => 'Dato',
	'actions_label' => 'Aktioner',
	'events_filter_label' => 'Sorter begivenheder',
	'events_filter_options' => array('Vis alle begivenheder','Vis ikke-godkendte begivenheder','Vis kommende begivenheder','Vis tidligere begivenheder'),
	'picture_attached' => 'Billede vedh�ftet',
// Vis Begivenhed
	'view_event_name' => 'Begivenhed: \'%s\'',
	'event_start_date' => 'Dato',
	'event_end_date' => 'Indtil',
	'event_duration' => 'Varighed',
	'contact_info' => 'Kontaktinformation',
	'contact_email' => 'E-mail',
	'contact_url' => 'Websted',
// General Info
// Begivenhed form
	'edit_event_title' => 'Begivenhed: \'%s\'',
	'cat_name' => 'Kategori',
	'event_start_date' => 'Dato',
	'event_end_date' => 'Indtil',
	'contact_info' => 'Kontaktinformation',
	'contact_email' => 'E-mail',
	'contact_url' => 'Websted',
	'no_event' => 'Der er ingen begivenheder',
	'stats_string' => '<strong>%d</strong> Begivenheder ialt',
// Stats
	'stats_string1' => '<strong>%d</strong> Begivenhed(er)',
	'stats_string2' => 'Total: <strong>%d</strong> Begivenheder p� <strong>%d</strong> side(r)',
// Misc.
	'add_event_success' => 'Ny begivenhed tilf�jet',
	'edit_event_success' => 'Begivenhed opdateret',
	'approve_event_success' => 'Begivenhed godkendt',
	'delete_confirm' => 'Er du sikker p� at du vil slette denne begivenhed ?',
	'delete_event_success' => 'Begivenhed slettet',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Inaktiv',
// Error messages
	'no_event_name' => 'Du skal indtaste et navn til denne begivenhed!',
	'no_event_desc' => 'Du skal indtaste en beskrivelse af denne begivenhed!',
	'no_cat' => 'Du skal v�lge en kategori til denne begivenhed!',
	'no_day' => 'Du skal v�lge en dag!',
	'no_month' => 'Du skal v�lge en m�ned!',
	'no_year' => 'Du skal v�lge et �r!',
	'non_valid_date' => 'Indtast en gyldig dato!',
	'end_days_invalid' => '\'Dage\'-feltet under \'Varighed\' m� kun best� af tal!',
	'end_hours_invalid' => '\'Timer\'-feltet under \'Varighed\' m� kun indeholde tal!',
	'end_minutes_invalid' => '\'Minutter\'-feltet under \'Varighed\' m� kun indeholde tal!',
	'file_too_large' => 'Det billede du vedh�ftede er st�rre end %d Kb!',
	'non_valid_extension' => 'Det vedh�ftede billedes filformat er ikke tilladt!',
	'delete_event_failed' => 'Denne begivenhed kunne ikke slettes',
	'approve_event_failed' => 'Denne begivenhed kunne ikke godkendes',
	'no_events' => 'Der er ingen begivenheder!',
	'move_image_failed' => 'Systemet kunne ikke flytte det uploadede billede!',
	'non_valid_dimensions' => 'Billedets bredde eller h�jde er st�rre end %s pixels!',

	'recur_val_1_invalid' => 'V�rdien indtastet i \'Gentag interval\' er ikke gyldigt. Det skal v�re et tal st�rre end \'0\'!',
	'recur_end_count_invalid' => 'V�rdien indtastet i \'Antal gentagelser\' er ikke gyldigt. Det skal v�re et tal st�rre end \'0\'!',
	'recur_end_until_invalid' => 'V�rdien indtastet i \'Gentag indtil\', er ikke gyldigt. Det skal v�re en dato efter startdatoen!'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Kategori-administration',
	'add_cat' => 'Tilf�j ny kategori',
	'edit_cat' => 'Ret kategori',
	'update_cat' => 'Opdater kategori-info',
	'delete_cat' => 'Slet kategori',
	'events_label' => 'Begivenheder',
	'visibility' => 'Offentliggjort',
	'actions_label' => 'Aktioner',
	'users_label' => 'Brugere',
	'admins_label' => 'Administratorer',
// General Info
	'general_info_label' => 'Generel information',
	'cat_name' => 'Kategorinavn',
	'cat_desc' => 'Kategoribeskrivelse',
	'cat_color' => 'Farve',
	'pick_color' => 'V�lg en farve!',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Administrative egenskaber',
	'auto_admin_appr' => 'Auto-godkend admin-indtastninger',
	'auto_user_appr' => 'Auto-godkend bruger-indtastninger',
// Stats
	'stats_string1' => '<strong>%d</strong> kategorier',
	'stats_string2' => 'Aktiv: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Total: <strong>%d</strong>&nbsp;&nbsp;&nbsp;p� <strong>%d</strong> side(r)',
// Misc.
	'add_cat_success' => 'Ny kategori tilf�jet',
	'edit_cat_success' => 'Kategori opdateret',
	'delete_confirm' => 'Er du sikker p� at du vil slette denne kategori ?',
	'delete_cat_success' => 'Kategori slettet',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Inaktiv',
// Error messages
	'no_cat_name' => 'Du skal indtaste et navn til denne kategori!',
	'no_cat_desc' => 'Du skal indtaste en beskrivelse af denne kategori!',
	'no_color' => 'Du skal v�lge en farve til denne kategori!',
	'delete_cat_failed' => 'Denne kategori kunne ikke slettes',
	'no_cats' => 'Der er ingen kategorier!',
	'cat_has_events' => 'Denne kategori indeholder %d begivenhed(er) og kan derfor ikke slettes!<br>Slet resterende begivenheder og pr�v igen!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Brugeradministration',
	'add_user' => 'Tilf�j ny bruger',
	'edit_user' => 'Rediger bruger',
	'update_user' => 'Opdater bruger',
	'delete_user' => 'Slet bruger',
	'last_access' => 'Sidste login',
	'actions_label' => 'Aktioner',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Inaktiv',
// Account Info
	'account_info_label' => 'Brugerinformation',
	'user_name' => 'Brugernavn',
	'user_pass' => 'Adgangskode',
	'user_pass_confirm' => 'Bekr�ft adgangskode',
	'user_email' => 'E-mail',
	'group_label' => 'Gruppemedlemskab',
	'status_label' => 'Brugerstatus',
// Andre Oplysninger
	'other_details_label' => 'Andre oplysninger',
	'first_name' => 'Fornavn',
	'last_name' => 'Efternavn',
	'user_website' => 'Hjemmeside',
	'user_location' => 'Hjemby',
	'user_occupation' => 'Besk�ftigelse',
// Stats
	'stats_string1' => '<strong>%d</strong> brugere',
	'stats_string2' => '<strong>%d</strong> brugere p� <strong>%d</strong> side(r)',
// Misc.
	'select_group' => 'V�lg...',
	'add_user_success' => 'Bruger tilf�jet',
	'edit_user_success' => 'Bruger opdateret',
	'delete_confirm' => 'Er du sikker p� du vil slette denne bruger?',
	'delete_user_success' => 'Bruger slettet',
	'update_pass_info' => 'Lad adgangskode-feltet v�re tomt, hvis du ikke vil �ndre det',
	'access_never' => 'Aldrig',
// Error messages
	'no_username' => 'Du skal indtaste et brugernavn!',
	'invalid_username' => 'Indtast et brugernavn, der udelukkende best�r af tal og bogstaver, og er mellem 4 og 30 tegn langt!',
	'invalid_password' => 'Indtast en adgangskode, der udelukkende best�r af tal og bogstaver, og er mellem 4 og 16 tegn langt!',
	'password_is_username' => 'Adgangskode skal v�re forskellig fra brugernavnet!',
	'password_not_match' =>'De 2 adgangskoder var forskellige',
	'invalid_email' => 'Du skal skrive en gyldig e-mail-adresse!',
	'email_exists' => 'En anden bruger er registreret med den e-mail-adresse du indtastede. Indtast en anden e-mail-adresse.!',
	'username_exists' => 'Brugernavnet er optaget, v�lg venligst et andet!',
	'no_email' => 'Du skal indtaste en e-mail-adresse!',
	'invalid_email' => 'Du skal indtaste en gyldig e-mail-adresse!',
	'no_password' => 'Du skal indtaste en adgangskode!',
	'no_group' => 'V�lg en gruppe til denne bruger!',
	'delete_user_failed' => 'Denne profil kan ikke slettes',
	'no_users' => 'Der er ingen brugerprofiler!'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Gruppeadministration',
	'add_group' => 'Tilf�j ny gruppe',
	'edit_group' => 'Rediger gruppe',
	'update_group' => 'Opdater gruppe',
	'delete_group' => 'Slet gruppe',
	'view_group' => 'Vis gruppe',
	'users_label' => 'Brugere',
	'actions_label' => 'Aktioner',
// General Info
	'general_info_label' => 'Generel information',
	'group_name' => 'Gruppenavn',
	'group_desc' => 'Gruppebeskrivelse',
// Group Access Level
	'access_level_label' => 'Gruppe-adgangsniveau',
	'Administrator' => 'Brugere i denne gruppe har administratoradgang',
	'can_manage_accounts' => 'Brugere i denne gruppe kan redigere brugere',
	'can_change_settings' => 'Brugere i denne gruppe kan �ndre i kalenderegenskaber',
	'can_manage_cats' => 'Brugere i denne gruppe kan redigere kategorier',
	'upl_need_approval' => 'Indtastede begivenheder kr�ver administrativ godkendelse',
// Stats
	'stats_string1' => '<strong>%d</strong> grupper',
	'stats_string2' => 'Total: <strong>%d</strong> grupper p� <strong>%d</strong> side(r)',
	'stats_string3' => 'Total: <strong>%d</strong> brugere p� <strong>%d</strong> side(r)',
// View Group Members
	'group_members_string' => 'Medlemmer af \'%s\' gruppen',
	'username_label' => 'Brugernavn',
	'firstname_label' => 'Fornavn',
	'lastname_label' => 'Efternavn',
	'email_label' => 'E-mail',
	'last_access_label' => 'Sidste login',
	'edit_user' => 'Rediger bruger',
	'delete_user' => 'Slet bruger',
// Misc.
	'add_group_success' => 'Ny gruppe tilf�jet',
	'edit_group_success' => 'Gruppe opdateret',
	'delete_confirm' => 'Er du sikker p� du vil slette denne gruppe?',
	'delete_user_confirm' => 'Er du sikker p� du vil slette denne bruger?',
	'delete_group_success' => 'Gruppe slettet',
	'no_users_string' => 'Der er ingen brugere i denne gruppe',
// Error messages
	'no_group_name' => 'Du skal indtaste et navn p� denne gruppe!',
	'no_group_desc' => 'Du skal indtaste en beskrivelse for denne gruppe!',
	'delete_group_failed' => 'Denne gruppe kunne ikke slettes',
	'no_groups' => 'Der er ingen grupper!',
	'group_has_users' => 'Denne gruppe indeholder %d bruger(e) og kan derfor ikke slettes!<br>Fjern resterende brugere fra denne gruppe og pr�v igen!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

$lang_settings_data = array(
	'section_title' => 'Kalenderindstillinger'
// Links
	,'admin_links_text' => 'V�lg sektion'
	,'admin_links' => array('Hovedindstillinger','Templateindstillinger','Opdateringer')
// General Settings
	,'general_settings_label' => 'Hovedindstillinger'
	,'calendar_name' => 'Kalendernavn'
	,'calendar_description' => 'Kalenderbeskrivelse'
	,'calendar_admin_email' => 'Kalenderadministrators e-mail'
	,'cookie_name' => 'Navn p� cookie brugt af komponenten'
	,'cookie_path' => 'Sti p� cookie brugt af komponenten'
	,'debug_mode' => 'Aktiver debug mode'
	,'calendar_status' => 'Kalenderens offentlige status'
// Environment Settings
	,'env_settings_label' => 'Milj�indstillinger'
	,'lang' => 'Sprog'
		,'lang_name' => 'Sprog'
		,'lang_native_name' => 'Navn'
		,'lang_trans_date' => 'Oversat d.'
		,'lang_author_name' => 'Forfatter'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Websted'
	,'charset' => 'Landekode'
	,'theme' => 'Tema'
		,'theme_name' => 'Temanavn'
		,'theme_date_made' => 'Lavet den'
		,'theme_author_name' => 'Forfatter'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Websted'
	,'timezone' => 'Tidszone-forskydning'
	,'time_format' => 'Format for klokkesl�t'
		,'24hours' => '24 timer'
		,'12hours' => '12 timer'
	,'auto_daylight_saving' => 'Automatisk indstilling af sommertid'
	,'main_table_width' => 'Bredde p� hovedtabel (pixels eller %)'
	,'day_start' => 'Ugedage starter med'
	,'default_view' => 'Standardvisning'
	,'search_view' => 'Tillad s�gning'
	,'archive' => 'Vis tidligere begivenheder'
	,'events_per_page' => 'Antal begivenheder pr. side'
	,'sort_order' => 'Standardsortering'
		,'sort_order_title_a' => 'Titel stigende'
		,'sort_order_title_d' => 'Titel faldende'
		,'sort_order_date_a' => 'Dato stigende'
		,'sort_order_date_d' => 'Dato faldende'
	,'show_recurrent_events' => 'Vis gentagne begivenheder'
	,'multi_day_events' => 'Flerdagsbegivenheder'
		,'multi_day_events_all' => 'Vis alle datoer'
		,'multi_day_events_bounds' => 'Vis kun start og slutdatoer'
		,'multi_day_events_start' => 'Vis kun startdato'
	// User Settings
	,'user_settings_label' => 'Brugerindstillinger'
	,'allow_user_registration' => 'Tillad brugerregistreringer'
	,'reg_duplicate_emails' => 'Tillad samme e-mail-adresse til flere brugere'
	,'reg_email_verify' => 'Aktiver brugeraktivering gennem e-mail'
// event View
	,'Begivenhed_view_label' => 'Vis begivenheder'
	,'popup_event_mode' => 'Popup-begivenhed'
	,'popup_event_width' => 'Bredde p� popup-vindue'
	,'popup_event_height' => 'H�jde p� popup-vindue'
// Add event View
	,'add_event_view_label' => 'Tilf�j begivenhedsvisning'
	,'add_event_view' => 'Aktiveret'
	,'addevent_allow_html' => 'Tillad <b>BB Code</b> i beskrivelse'
	,'addevent_allow_contact' => 'Tillad kontakt'
	,'addevent_allow_email' => 'Tillad e-mail'
	,'addevent_allow_url' => 'Tillad URL'
	,'addevent_allow_picture' => 'Tillad billeder'
	,'new_post_notification' => 'Send mig en e-mail n�r en begivenhed skal godkendes'
// Calendar View
	,'calendar_view_label' => 'Vis kalender (m�nedlig)'
	,'monthly_view' => 'Aktiveret'
	,'cal_view_show_week' => 'Vis ugenumre'
	,'cal_view_max_chars' => 'Maks. tegn i beskrivelse'
// Flyer View
	,'flyer_view_label' => 'Vis brochure'
	,'flyer_view' => 'Aktiveret'
	,'flyer_show_picture' => 'Vis billeder i brochurevisning'
	,'flyer_view_max_chars' => 'Maks. tegn i beskrivelse'
// Weekly View
	,'weekly_view_label' => 'Vis ugentlig'
	,'weekly_view' => 'Aktiveret'
	,'weekly_view_max_chars' => 'Maks. tegn i beskrivelse'
// Daily View
	,'daily_view_label' => 'Vis daglig'
	,'daily_view' => 'Aktiveret'
	,'daily_view_max_chars' => 'Maks. tegn i beskrivelse'
// Vis Kategorier
	,'categories_view_label' => 'Vis kategorier'
	,'cats_view' => 'Aktiveret'
	,'cats_view_max_chars' => 'Maks. tegn i beskrivelse'
// Mini Calendar
	,'mini_cal_label' => 'Minikalender'
	,'mini_cal_def_picture' => 'Standardbillede'
	,'mini_cal_display_picture' => 'Vis billede'
	,'mini_cal_diplay_options' => array('Intet','Standardbillede', 'Dagligt billede','Ugentligt billede','Tilf�ldigt billede')
// Mail Settings
	,'mail_settings_label' => 'Mail-indstillinger'
	,'mail_method' => 'Metode til at sende mail'
	,'mail_smtp_host' => 'SMTP hosts (adskilt af semikolon;)'
	,'mail_smtp_auth' => ' SMTP authentication'
	,'mail_smtp_username' => 'SMTP brugernavn'
	,'mail_smtp_adgangskode' => 'SMTP adgangskode'

// Picture Settings
	,'picture_settings_label' => 'Billed-indstillinger'
	,'max_upl_dim' => 'Maks. bredde og h�jde for uploadede billeder'
	,'max_upl_size' => 'Maks. st�rrelse for uploadede billeder (i bytes)'
	,'picture_chmod' => 'Standardrettigheder for billeder (CHMOD)(oktalt)'
	,'allowed_file_extensions' => 'Godkendte filtyper for uploadede billeder'
// Form Buttons
	,'update_config' => 'Gem ny konfiguration'
	,'restore_config' => 'Gendan standardindstillinger'
// Misc.
	,'update_settings_success' => 'Indstillinger opdateret'
	,'restore_default_confirm' => 'Er du sikker p� du vil gendanne standardindstillinger?'
// Template Configuration
	,'template_type' => 'Skabelonstype'
	,'template_header' => 'Hovedtekst'
	,'template_footer' => 'Fodtekst'
	,'template_status_default' => 'Brug standard-tema-skabelon'
	,'template_status_custom' => 'Brug flg. skabelon:'
	,'template_custom' => 'Brugerdefineret skabelon'

	,'info_meta' => 'Meta-information'
	,'info_status' => 'Statuskontrol'
	,'info_status_default' => 'Deaktiver dette indhold'
	,'info_status_custom' => 'Vis flg. indhold:'
	,'info_custom' => 'Brugerdefineret indhold'

	,'dynamic_tags' => 'Dynamiske tags'

// Product updates
	,'updates_check_text' => 'Vent venligst mens vi henter information fra serveren...'
	,'updates_no_response' => 'Intet svar fra serveren, pr�v igen senere.'
	,'avail_updates' => 'Tilg�ngelige opdateringer:'
	,'updates_download_zip' => 'Download ZIP-fil (.zip)'
	,'updates_download_tgz' => 'Download TGZ-fil (.tar.gz)'
	,'updates_released_label' => 'Udgivelsesdag: %s'
	,'updates_no_update' => 'Du bruger den seneste version. Ingen opdatering n�dvendig.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Standardbillede'
	,'daily_pic' => 'Dagens billede (%s)'
	,'weekly_pic' => 'Ugens billede (%s)'
	,'rand_pic' => 'Tilf�ldigt billede (%s)'
	,'post_event' => 'Tilf�j ny begivenhed'
	,'num_events' => '%d begivenhed(er)'
	,'selected_week' => 'Uge %d'
);

// ======================================================
// extcalendar.php
// ======================================================

// To Be Done

// ======================================================
// config.inc.php
// ======================================================

// To Be Done

// ======================================================
// installe.php
// ======================================================

// To Be Done

// ======================================================
// login.php
// ======================================================

if (defined('LOGIN_PHP')) 

$lang_login_data = array(
	'section_title' => 'Log ind'
// General Settings
	,'login_intro' => 'Indtast brugernavn og adgangskode for at logge ind'
	,'username' => 'Brugernavn'
	,'password' => 'Adgangskode'
	,'remember_me' => 'Husk mig'
	,'login_button' => 'Log ind'
// Errors
	,'invalid_login' => 'Tjek dine indtastede oplysninger og pr�v igen!'
	,'no_username' => 'Du skal indtaste dit brugernavn!'
	,'already_logged' => 'Du er allerede logget ind!'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>