<?PHP

// New language structure
$lang_info = array (
	'name' => 'Danish'
	,'nativename' => 'Dansk' // Language name in native language. E.g: 'Français' for 'French'
	,'locale' => array('da','dansk') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Jeppe Bob Dyrby'
	,'author_email' => 'jeppe.dyrby@gmail.com'
	,'author_url' => ''
	,'transdate' => '11/05/2005'
);

$lang_general = array (
	'yes' => 'Ja'
	,'no' => 'Nej'
	,'back' => 'Tilbage'
	,'continue' => 'Fortsæt'
	,'close' => 'Luk'
	,'errors' => 'Fejl'
	,'info' => 'Information'
	,'day' => 'Dag'
	,'days' => 'Dage'
	,'month' => 'Måned'
	,'months' => 'Måneder'
	,'year' => 'År'
	,'years' => 'År'
	,'hour' => 'Time'
	,'hours' => 'Timer'
	,'minute' => 'Minut'
	,'minutes' => 'Minutter'
	,'everyday' => 'Hver dag'
	,'everymonth' => 'Hver måned'
	,'everyyear' => 'Hvert år'
	,'active' => 'Aktiv'
	,'not_active' => 'Ikke aktiv'
	,'today' => 'idag'
	,'signature' => 'Bygget på %s'
	,'expand' => 'Udvid'
	,'collapse' => 'Fold'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %B %d, %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A, %B %d, %Y At %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A, %B %d, %Y At %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a. %d %b, %Y' 
	,'month_year' => '%B %Y'
,'day_of_week' => array('Søndag','Mandag','Tirsdag','Onsdag','Torsdag','Fredag','Lørdag')
	,'months' => array('Januar','Februar','Marts','April','Maj','Juni','Juli','August','September','Oktober','November','December')
);

$lang_system = array (
	'system_caption' => 'System besked'
  ,'page_access_denied' => 'Du har ikke rettigheder til at se denne side.'
  ,'page_requires_login' => 'Du skal logge ind for at se denne side.'
  ,'operation_denied' => 'Du har ikke rettigheder til at gøre dette.'
	,'section_disabled' => 'Det er ikke muligt at bruge denne del.'
  ,'non_exist_cat' => 'Den valgte kategori eksisterer ikke.'
  ,'non_exist_event' => 'Den valgte begivenhed eksisterer ikke.'
  ,'param_missing' => 'De valgte parametre er ikke nok.'
  ,'no_events' => 'Der er ikke nogle begivenheder at vise.'
  ,'config_string' => 'Du bruger nu \'%s\' kører på %s, %s og %s.'
  ,'no_table' => '\'%s\' tabel eksisterer ikke.'
  ,'no_anonymous_group' => '%s tabel indeholder ikke \'Anonymous\' gruppen.'
  ,'calendar_locked' => 'Denne service er midlertidig nede, vi beklager ulejligheden.'
	,'new_upgrade' => 'The system has detected a new version. It is recommended to perform the upgrade now. Click "Continue" to launch the upgrade tool.'
	,'no_profile' => 'Der skete en fejl da jeg prøvede at hente dine indstillinger.'
// Mail messages
	,'new_event_subject' => 'Ny begivenhed som: %s'
	,'event_notification_failed' => 'Der skete en fejl da jeg prøvede at sende en mail.'
);

// Message body for new event email notification
$lang_system['event_notification_body'] = <<<EOT
Den følgende begivenhed er blevet indsat i: {CALENDAR_NAME}

Titel: "{TITLE}"
Dato: "{DATE}"
Længde: "{DURATION}"

Du kan læse begivenheden ved at klikke på nedenstående link,
eller kopierer adressen ind i din browser.

{LINK}

Mvh,

{CALENDAR_NAME}

EOT;

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'Opret'
  ,'logout' => 'Logud <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Min profil'
	,'admin_events' => 'Begivenheder'
  ,'admin_categories' => 'Kategorier'
  ,'admin_groups' => 'Grupper'
  ,'admin_users' => 'Brugere'
  ,'admin_settings' => 'Indstillinger'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Tilføj'
	,'cal_view' => 'Vis efter måned'
  ,'flat_view' => 'Liste'
  ,'weekly_view' => 'Vis efter uge'
  ,'daily_view' => 'Vis efter dag'
  ,'yearly_view' => 'Vis efter år'
  ,'categories_view' => 'Kategorier'
  ,'search_view' => 'Søg'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Tilføj begivenhed'
	,'edit_event' => 'Rediger begivenhed [id%d] \'%s\''
	,'update_event_button' => 'Opdater'

// Event details
	,'event_details_label' => 'Detaljer'
	,'event_title' => 'Titel'
	,'event_desc' => 'Beskrivelse'
	,'event_cat' => 'Kategori'
	,'choose_cat' => 'Vælg kategori'
	,'event_date' => 'Vælg dato'
	,'day_label' => 'Dag'
	,'month_label' => 'Måned'
	,'year_label' => 'År'
	,'start_date_label' => 'Start'
	,'start_time_label' => 'Kl.'
	,'end_date_label' => 'Tid'
	,'all_day_label' => 'Hele dagen'
// Contact details
	,'contact_details_label' => 'Kontakt detaljer'
	,'contact_info' => 'Kontakt info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Repeat events
	,'repeat_event_label' => 'Gentag begivenhed'
	,'repeat_method_label' => 'Gentag metode'
	,'repeat_none' => 'Gentag ikke denne begivenhed'
	,'repeat_every' => 'Gentag hver:'
	,'repeat_days' => 'Dag'
	,'repeat_weeks' => 'Uge'
	,'repeat_months' => 'Måned'
	,'repeat_years' => 'Å'
	,'repeat_end_date_label' => 'Slut dato'
	,'repeat_end_date_none' => 'Ingen slut dato'
	,'repeat_end_date_count' => 'Slut efter %s gentagelser'
	,'repeat_end_date_until' => 'Gentag indtil'
// Other details
	,'other_details_label' => 'Andre detaljer'
	,'picture_file' => 'Billede'
	,'file_upload_info' => '(%d KBytes - Filnavn: %s )' 
	,'del_picture' => 'Slet nuværende billede?'
// Administrative options
	,'admin_options_label' => 'Admin'
	,'auto_appr_event' => 'Begivenhed godkendt'

// Error messages
	,'no_title' => 'Du skal skrive en titel.'
	,'no_desc' => 'Du skal skrive en beskrivelse.'
	,'no_cat' => 'Du skal vælge en kategori.'
	,'date_invalid' => 'Du skal vælge en dato.'
	,'end_days_invalid' => 'Den valgte dag dur ikke'
	,'end_hours_invalid' => 'Den valgte måned dur ikke'
	,'end_minutes_invalid' => 'Det valgte minut tal dur ikke'

	,'non_valid_extension' => 'Billede formattet er ikke understøttet! (Filnavn: %s)'

	,'file_too_large' => 'Billedet er for stort, højst: %d KBytes !'
	,'move_image_failed' => 'Billedet blev ikke oploadet korrekt'
	,'non_valid_dimensions' => 'Billedets højde og bredde er større end %s pixels !'

	,'recur_val_1_invalid' => 'Den angivne værdi for \'Gentag antal gange\' dur ikke. Det skal være et nummer større end \'0\' !'
	,'recur_end_count_invalid' => 'Den angivne værdi for \'Antal gentagelser\' skal være et nummer større end \'0\' !'
	,'recur_end_until_invalid' => '\'Gentag indtil\' datoen, skal værre større end start datoen'
// Misc. messages
	,'submit_event_pending' => 'Din begivenhed skal godkendes'
	,'submit_event_approved' => 'Din begivenhed er godkendt, tak :)'
	,'event_repeat_msg' => 'Denne begivenhed er sat til at gentage sig selv'
	,'event_no_repeat_msg' => 'Denne begivenhed vil ikke blive gentaget.'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Vis efter dag'
	,'next_day' => 'Næste dag'
	,'previous_day' => 'Forrige dag'
	,'no_events' => 'Der er ingen begivenheder denne dag.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Vis efter uge'
	,'week_period' => '%s - %s'
	,'next_week' => 'Næste uge'
	,'previous_week' => 'Forrige uge'
	,'selected_week' => 'Uge %d'
	,'no_events' => 'Der er ingen begivenheder denne uge.'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Vis efter måned'
	,'next_month' => 'Næste måned'
	,'previous_month' => 'Forrige måned'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Liste'
	,'week_period' => '%s - %s'
	,'next_month' => 'Næste måned'
	,'previous_month' => 'Forrige måned'
	,'contact_info' => 'Kontakt'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'Der er ingen begivenheder denne måned.'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Begivenheder'
	,'display_event' => 'Begivenhed: \'%s\''
	,'cat_name' => 'Kategori'
	,'event_start_date' => 'Dato'
	,'event_end_date' => 'Til'
	,'event_duration' => 'Tid'
	,'contact_info' => 'Kontakt info'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'Der er ingen begivenheder.'
	,'stats_string' => '<strong>%d</strong> begivenheder ialt'
	,'edit_event' => 'Rediger'
	,'delete_event' => 'Slet'
	,'delete_confirm' => 'Er du sikker på at du vil slette denne begivenhed?'
	
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Vis efter kategori'
	,'cat_name' => 'Kategori'
	,'total_events' => 'Begivenheder ialt'
	,'upcoming_events' => 'Flere begivenheder'
	,'no_cats' => 'Der er ingen kategorier at vise.'
	,'stats_string' => 'Der er <strong>%d</strong> begivenheder i <strong>%d</strong> kategorier'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Begivenheder under \'%s\''
	,'event_name' => 'Begivenhed'
	,'event_date' => 'Dato'
	,'no_events' => 'Der er ingen begivenheder under denne kategori.'
	,'stats_string' => '<strong>%d</strong> begivenheder ialt'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Søg kalender',
	'search_results' => 'Søgeresultater',
	'category_label' => 'Kategori',
	'date_label' => 'Dato',
	'no_events' => 'Der er ingen begivenheder under denne kategori.',
	'search_caption' => 'Skriv et søgeord...',
	'search_again' => 'Søg igen',
	'search_button' => 'Søg',
// Misc.
	'no_results' => 'Ingen resultater fundet',	
// Stats
	'stats_string1' => '<strong>%d</strong> begivenheder fundet',
	'stats_string2' => '<strong>%d</strong> begivenheder på <strong>%d</strong> sider'
);

// ======================================================
// profile.php
// ======================================================

if (defined('PROFILE_PHP')) 

$lang_user_profile_data = array(
	'section_title' => 'Min profil',
	'edit_profile' => 'Rediger',
	'update_profile' => 'Opdater',
	'actions_label' => 'Actions',
// Account Info
	'account_info_label' => 'Information',
	'user_name' => 'Brugernavn',
	'user_pass' => 'Kodeord',
	'user_pass_confirm' => 'Gentag kodeord',
	'user_email' => 'E-mail',
	'group_label' => 'Gruppe',
// Other Details
	'other_details_label' => 'Detaljer',
	'first_name' => 'Fornavn',
	'last_name' => 'Efternavn',
	'full_name' => 'Navn',
	'user_website' => 'Hjemmeside',
	'user_location' => 'Geografiske placering',
	'user_occupation' => 'Spiller',
// Misc.
	'select_language' => 'Sprog',
	'edit_profile_success' => 'Din profil er opdateret',
	'update_pass_info' => 'Lad \'Kodeord\' feltet være tomt hvis du ikke vil ændre dit kodeord',
// Error messages
	'invalid_password' => 'Dit kodeord må kun indeholde tal og bogstaver, og skal være mellem 4 og 16 tegn.',
	'password_is_username' => 'Dit kodeord må ikke være det samme som dit brugernavn',
	'password_not_match' =>'De tog kodeord er ikke ens',
	'invalid_email' => 'Det skal være en rigtig email adresse',
	'email_exists' => 'Der er allerede en bruger med email adresse',
	'no_email' => 'Du skal skrive en email adresse',
	'no_password' => 'Du skal skrive et kodeord'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Oprettelse af ny bruger',
// Step 1: Terms & Conditions
	'terms_caption' => 'Terms and Conditions',
	'terms_intro' => 'In order to proceed, you must agree to the following:',
	'terms_message' => 'Please take a moment to review these rules detailed below. If you agree with them and wish to proceed with the registration, simply click the "I agree" button below. To cancel this registration, simply hit the \'back\' button on your browser.<br /><br />Please remember that we are not responsible for any events posted by users of this calendar application. We do not vouch for or warrant the accuracy, completeness or usefulness of any posted event, and are not responsible for the contents of any event.<br /><br />The messages express the views of the author of the event, not necessarily the views of this calendar application. Any user who feels that a posted event is objectionable is encouraged to contact us immediately by email. We have the ability to remove objectionable content and we will make every effort to do so, within a reasonable time frame, if we determine that removal is necessary.<br /><br />You agree, through your use of this service, that you will not use this calendar application to post any material which is knowingly false and/or defamatory, inaccurate, abusive, vulgar, hateful, harassing, obscene, profane, sexually oriented, threatening, invasive of a person\'s privacy, or otherwise violative of any law.<br /><br />You agree not to post any copyrighted material unless the copyright is owned by you or by %s.',
	'terms_button' => 'I agree',
	
// Account Info
	'account_info_label' => 'Bruger information',
	'user_name' => 'Brugernavn',
	'user_pass' => 'Kodeord',
	'user_pass_confirm' => 'Gentag kodeord',
	'user_email' => 'E-mail',
// Other Details
	'other_details_label' => 'Detaljer',
	'first_name' => 'Fornavn',
	'last_name' => 'Efternavn',
	'user_website' => 'Hjemmeside',
	'user_location' => 'Geografisk placering',
	'user_occupation' => 'Spiller',
	'register_button' => 'Opret min bruger',

// Stats
	'stats_string1' => '<strong>%d</strong> brugere',
	'stats_string2' => '<strong>%d</strong> brugere på <strong>%d</strong> sider',
// Misc.
	'reg_nomail_success' => 'Tak fordi du oprettede en bruger',
	'reg_mail_success' => 'En email er blevet sendt til din email adresse. Du skal læse den før du kan bruge siden.',
	'reg_activation_success' => 'Tillykke, din bruger er oprettet. Du kan nu logge ind med dit brugernavn og kodeord',
// Mail messages
	'reg_confirm_subject' => 'Bruger på %s',
	
// Error messages
	'no_username' => 'Du skal skrive et brugernavn',
	'invalid_username' => 'Dit brugernavn må kun indeholde tal og bogstaver, og skal være mellem 4 og 16 tegn.',
	'username_exists' => 'Der er allerede en bruger med det brugernavn',
	'no_password' => 'Du skal skrive et kodeord',
	'invalid_password' => 'Dit kodeord må kun indeholde tal og bogstaver, og skal være mellem 4 og 16 tegn.',
	'password_is_username' => 'Dit kodeord må ikke være det samme som dit brugernavn',
	'password_not_match' =>'De tog kodeord er ikke ens',
	'email_exists' => 'Der er allerede en bruger med email adresse',
	'no_email' => 'Du skal skrive en email adresse',
	'no_password' => 'Du skal skrive et kodeord',
	'invalid_email' => 'Det skal være en rigtig email adresse',
	'email_exists' => 'Der er allerede en bruger med email adresse',
	'delete_user_failed' => 'Denne bruger kan ikke slettes',
	'no_users' => 'Der er ingen bruger',
	'already_logged' => 'Du er allerede logget ind',
	'registration_not_allowed' => 'Du kan ikke oprette dig som bruger',
	'reg_email_failed' => 'Der skete en fejl da jeg prøvede at sende en mail',
	'reg_activation_failed' => 'Der skete en fejl... ups...'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Tak fordi du oprettede dig som bruger på {CALENDAR_NAME}

Dit brugernavn er:  	"{USERNAME}"
Dit kodeord er:     	"{PASSWORD}"

Du skal klikke på nedenstående link for at aktivere din bruger,
eller kopiere det ind i din browser.

{REG_LINK}

Mvh,

{CALENDAR_NAME}

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
	'section_title' => 'Administration',
	'events_to_approve' => 'Administration: Begivenheder der skal godkendes',
	'upcoming_events' => 'Event Administration: Flere begivenheder',
	'past_events' => 'Event Administration: Overståede begivenheder',
	'add_event' => 'Tilføj begivenhed',
	'edit_event' => 'Rediger',
	'view_event' => 'Vis',
	'approve_event' => 'Godkend',
	'update_event' => 'Opdater',
	'delete_event' => 'Slet',
	'events_label' => 'Begivenheder',
	'auto_approve' => 'Automatisk godkendelse',
	'date_label' => 'Dato',
	'actions_label' => 'Actions',
	'events_filter_label' => 'Filtrer begivenheder',
	'events_filter_options' => array('Vis alle','Vis ikke godkendte','Vis opfølgende','Vis gamle'),
	'picture_attached' => 'Billede tilføjet',
// View Event
	'view_event_name' => 'Begivenhed: \'%s\'',
	'event_start_date' => 'Dato',
	'event_end_date' => 'Til',
	'event_duration' => 'Tid',
	'contact_info' => 'Kontakt info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Begivenhed: \'%s\'',
	'cat_name' => 'Kategori',
	'event_start_date' => 'Dato',
	'event_end_date' => 'Til',
	'contact_info' => 'Kontakt info',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'Der er ingen begivenheder at vise',
	'stats_string' => '<strong>%d</strong> begivenheder ialt',
// Stats
	'stats_string1' => '<strong>%d</strong> begivenheder',
	'stats_string2' => 'Ialt: <strong>%d</strong> begivenheder på <strong>%d</strong> sider',
// Misc.
	'add_event_success' => 'Begivenhed tilføjet',
	'edit_event_success' => 'Begivenhed opdateret',
	'approve_event_success' => 'Begivenhed godkendt',
	'delete_confirm' => 'Er du sikker på at du vil slette denne begivenhed?',
	'delete_event_success' => 'Begivenhed slettet',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Ikke aktiv',
// Error messages
	'no_event_name' => 'Du skal skrive en titel til denne begivenhed',
	'no_event_desc' => 'Du skal skrive en beskrivelse til denne begivenhed',
	'no_cat' => 'Du skal vælge en kategori til denne begivenhed',
	'no_day' => 'Du skal vælge en dag',
	'no_month' => 'Du skal vælge en måned',
	'no_year' => 'Du skal vælge et år',
	'non_valid_date' => 'Du skal skrive en rigtig dato',
	'end_days_invalid' => 'Dagen må kun indeholde tal',
	'end_hours_invalid' => 'Timen må kun indeholde tal',
	'end_minutes_invalid' => 'Minutterne må kun være tal',
	'file_too_large' => 'Billedet er for stort, det må maks. være: %d KBytes !',
	'non_valid_extension' => 'Billedet er ikke det rigtige format',
	'delete_event_failed' => 'Denne begivenhed kan ikke slettes',
	'approve_event_failed' => 'Denne begivenhed kan ikke godkendes',
	'no_events' => 'Der er ingen begivenheder at vise',
	'move_image_failed' => 'Billedet kunne ikke oploades',
	'non_valid_dimensions' => 'Billedets højde og bredde må højst være: %s pixels !',

	'recur_val_1_invalid' => 'Den angivne \'Gentag antal gange\' skal være et tal højere end \'0\' !',
	'recur_end_count_invalid' => 'Den angivne \'Gentag antal gange\' skal være et tal højere end \'0\' !',
	'recur_end_until_invalid' => '\'Gentag indtil\' skal være størere end start datoen'

);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Kategorier',
	'add_cat' => 'Tilføj kategori',
	'edit_cat' => 'Rediger kategori',
	'update_cat' => 'Opdater kategori',
	'delete_cat' => 'Slet kategori',
	'events_label' => 'Begivenheder',
	'visibility' => 'Synlighed',
	'actions_label' => 'Actions',
	'users_label' => 'Brugere',
	'admins_label' => 'Admins',
// General Info
	'general_info_label' => 'General Information',
	'cat_name' => 'Kategori navn',
	'cat_desc' => 'Kategori beskrivelse',
	'cat_color' => 'Farve',
	'pick_color' => 'Vælg en farve',
	'status_label' => 'Status',
// Administrative Options
	'admin_label' => 'Administration',
	'auto_admin_appr' => 'Godkend automatisk begivenheder',
	'auto_user_appr' => 'Godkend automatisk nye brugere',
// Stats
	'stats_string1' => '<strong>%d</strong> kategorier',
	'stats_string2' => 'Aktive: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Ialt: <strong>%d</strong>&nbsp;&nbsp;&nbsp;på <strong>%d</strong> sider',
// Misc.
	'add_cat_success' => 'Ny kategori tilføjet',
	'edit_cat_success' => 'Kategori opdateret',
	'delete_confirm' => 'Er du sikker på at du vil slette denne kategori?',
	'delete_cat_success' => 'Kategori slettet',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Ikke aktiv',
// Error messages
	'no_cat_name' => 'Du skal skrive et navn til denne kategori',
	'no_cat_desc' => 'Du skal skrive en beskrivelse til denne kategori',
	'no_color' => 'Du skal give denne kategori en farve',
	'delete_cat_failed' => 'Denne kategori kan ikke slettes',
	'no_cats' => 'Der er ingen kategorier',
	'cat_has_events' => 'Denne kategori har %d begivenheder og kan derfor ikke slettes!<br>Vær venlig at slette begivenhederne først, og prøv så igen.'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Bruger administration',
	'add_user' => 'Tilføj bruger',
	'edit_user' => 'Rediger bruger',
	'update_user' => 'Opdater bruger info',
	'delete_user' => 'Slet bruger',
	'last_access' => 'Sidst online',
	'actions_label' => 'Actions',
	'active_label' => 'Aktiv',
	'not_active_label' => 'Ikke aktiv',
// Account Info
	'account_info_label' => 'Bruger info',
	'user_name' => 'Brugernavn',
	'user_pass' => 'Kodeord',
	'user_pass_confirm' => 'Gentag kodeord',
	'user_email' => 'E-mail',
	'group_label' => 'Grupper',
	'status_label' => 'Bruger status',
// Other Details
	'other_details_label' => 'Andre detaljer',
	'first_name' => 'Fornavn',
	'last_name' => 'Efternavn',
	'user_website' => 'Hjemmeside',
	'user_location' => 'Geografisk placering',
	'user_occupation' => 'Spiller',
// Stats
	'stats_string1' => '<strong>%d</strong> brugere',
	'stats_string2' => '<strong>%d</strong> brugere på <strong>%d</strong> sider',
// Misc.
	'select_group' => 'Vælg en gruppe...',
	'add_user_success' => 'Bruger tilføjer',
	'edit_user_success' => 'Bruger opdateret',
	'delete_confirm' => 'Er du sikker på at du vil slette denne bruger?',
	'delete_user_success' => 'Bruger slettet',
	'update_pass_info' => 'Lad kodeord felterne stå tomme, hvis du ikke vil ændre kodeordet',
	'access_never' => 'Aldrig',
// Error messages
	'no_username' => 'Du skal skrive et brugernavn',
	'invalid_username' => 'Dit brugernavn må kun indeholde tal og bogstaver, og skal være mellem 4 og 16 tegn.',
	'invalid_password' => 'Dit kodeord må kun indeholde tal og bogstaver, og skal være mellem 4 og 16 tegn.',
	'password_is_username' => 'Dit kodeord må ikke være det samme som dit brugernavn',
	'password_not_match' =>'De tog kodeord er ikke ens',
	'invalid_email' => 'Det skal være en rigtig email adresse',
	'email_exists' => 'Der er allerede en bruger med email adresse',
	'no_email' => 'Du skal skrive en email adresse',
	'no_password' => 'Du skal skrive et kodeord',
	'username_exists' => 'Der er allerede en bruger med dette navn',
	'no_group' => 'Du skal vælge en gruppe',
	'delete_user_failed' => 'Brugeren kunne ikke slettes',
	'no_users' => 'Der er ingen brugere'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Grupper',
	'add_group' => 'Tilføj gruppe',
	'edit_group' => 'Rediger grupper',
	'update_group' => 'Opdater gruppe',
	'delete_group' => 'Slet gruppe',
	'view_group' => 'Vis gruppe',
	'users_label' => 'Brugere',
	'actions_label' => 'Actions',
// General Info
	'general_info_label' => 'General Information',
	'group_name' => 'Gruppe navn',
	'group_desc' => 'Gruppe beskrivelse',
// Group Access Level
	'access_level_label' => 'Gruppe rettigheder',
	'has_admin_access' => 'Brugere har admin rettigheder',
	'can_manage_accounts' => 'Brugere kan redigere i andre brugere',
	'can_change_settings' => 'Brugere kan ændre generalle indstillinger',
	'can_manage_cats' => 'Brugere kan ændre kategorier',
	'upl_need_approval' => 'Redigerede ting skal godkendes af en admin.',
// Stats
	'stats_string1' => '<strong>%d</strong> grupper',
	'stats_string2' => 'Ialt: <strong>%d</strong> grupper på <strong>%d</strong> sider',
	'stats_string3' => 'Ialt: <strong>%d</strong> brugere på <strong>%d</strong> sider',
// View Group Members
	'group_members_string' => 'Brugere i \'%s\' gruppen',
	'username_label' => 'Brugernavn',
	'firstname_label' => 'Fornavn',
	'lastname_label' => 'Efternavn',
	'email_label' => 'Email',
	'last_access_label' => 'Sidst online',
	'edit_user' => 'Rediger bruger',
	'delete_user' => 'Slet bruger',
// Misc.
	'add_group_success' => 'Gruppe tilføjer',
	'edit_group_success' => 'Gruppe opdateret',
	'delete_confirm' => 'Er du sikker på at du vil slette denne gruppe?',
	'delete_user_confirm' => 'Er du sikker på at du vil fjerne denne bruger?',
	'delete_group_success' => 'Gruppe slettet',
	'no_users_string' => 'Der er ingen brugere i denne gruppe',
// Error messages
	'no_group_name' => 'Du skal skrive et navn til denne gruppe',
	'no_group_desc' => 'Du skal skrive en beskrivelse til denne gruppe',
	'delete_group_failed' => 'Denne gruppe kan ikke slettes',
	'no_groups' => 'Der er ingen grupper',
	'group_has_users' => 'Denne gruppe indeholder %d brugere og kan derfor ikke slettes!<br>Fjern brugerne fra gruppen, og prøv igen.'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

if (defined('SETTINGS_PHP')) 

$lang_settings_data = array(
	'section_title' => 'Kalender indstillinger'
// Links
	,'admin_links_text' => 'Vælg indstillinger'
	,'admin_links' => array('Generalt','Udseende','Opdateringer')
// General Settings
	,'general_settings_label' => 'Generalt'
	,'calendar_name' => 'Kalender navn'
	,'calendar_description' => 'Beskrivelse'
	,'calendar_admin_email' => 'Admin email'
	,'cookie_name' => 'Cookie navn'
	,'cookie_path' => 'Cookie sti'
	,'debug_mode' => 'Debug'
	,'calendar_status' => 'Offentlig status'
// Environment Settings
	,'env_settings_label' => 'Internationale indstillinger'
	,'lang' => 'Sprog'
		,'lang_name' => 'Sprog'
		,'lang_native_name' => 'Lokalt navn'
		,'lang_trans_date' => 'Oversat på'
		,'lang_author_name' => 'Forfatter'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Hjemmeside'
	,'charset' => 'Tegnsæt'
	,'theme' => 'Tema'
		,'theme_name' => 'Tema navn'
		,'theme_date_made' => 'Lavet på'
		,'theme_author_name' => 'Forfatter'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Hjemmeside'
	,'timezone' => 'Tidszone'
	,'time_format' => 'Tids format'
		,'24hours' => '24 timer'
		,'12hours' => '12 timer'
	,'auto_daylight_saving' => 'Sommer/vinter tid'
	,'main_table_width' => 'Bredde af siden (procent eller pixel)'
	,'day_start' => 'Ugen starter:'
	,'default_view' => 'Standard'
	,'search_view' => 'Søgning'
	,'archive' => 'Vis gamle begivenheder'
	,'events_per_page' => 'Begivenheder per side'
	,'sort_order' => 'Sorter efter'
		,'sort_order_title_a' => 'Titel'
		,'sort_order_title_d' => 'Titel omvendt'
		,'sort_order_date_a' => 'Dato'
		,'sort_order_date_d' => 'Dato omvendt'
	,'show_recurrent_events' => 'Vis gentagne begivenheder'
	,'multi_day_events' => 'Fler-dage-begivenheder'
		,'multi_day_events_all' => 'Vis hele dato rækken'
		,'multi_day_events_bounds' => 'Vis kun start og slut dato'
		,'multi_day_events_start' => 'Vis kun start dato'
	// User Settings
	,'user_settings_label' => 'Bruger indstillinger'
	,'allow_user_registration' => 'Tillad brugeroprettelser'
	,'reg_duplicate_emails' => 'Tillad samme email flere gange'
	,'reg_email_verify' => 'Brugere skal aktiveres gennem email'
// Event View
	,'event_view_label' => 'Begivenhed udseende'
	,'popup_event_mode' => 'Pop-up begivenhed'
	,'popup_event_width' => 'Bredde af pop-up'
	,'popup_event_height' => 'Højde af pop-up'
// Add Event View
	,'add_event_view_label' => 'Tilføj begivenheds udseeende'
	,'add_event_view' => 'Aktiv'
	,'addevent_allow_html' => 'Tillad <b>BB Code</b> i beskrivelse'
	,'addevent_allow_contact' => 'Tillad kontakt information'
	,'addevent_allow_email' => 'Tillad email'
	,'addevent_allow_url' => 'Tillad URL'
	,'addevent_allow_picture' => 'Tillad billeder'
	,'new_post_notification' => 'Mail ved ny begivenhed'
// Calendar View
	,'calendar_view_label' => 'Kalender (pr. måned)'
	,'monthly_view' => 'Aktiv'
	,'cal_view_show_week' => 'Vis uge numre'
	,'cal_view_max_chars' => 'Maksimum antal tegn i beskrivelse'
// Flyer View
	,'flyer_view_label' => 'Vis som \'flyer\''
	,'flyer_view' => 'Aktiv'
	,'flyer_show_picture' => 'Vis billede i \'flyer\''
	,'flyer_view_max_chars' => 'Maksimum antal tegn i beskrivelse'
// Weekly View
	,'weekly_view_label' => 'Vis pr. uge'
	,'weekly_view' => 'Aktiv'
	,'weekly_view_max_chars' => 'Maksimum antal tegn i beskrivelse'
// Daily View
	,'daily_view_label' => 'Vis pr. dag'
	,'daily_view' => 'Aktiv'
	,'daily_view_max_chars' => 'Maksimum antal tegn i beskrivelse'
// Categories View
	,'categories_view_label' => 'Vis pr. kategori'
	,'cats_view' => 'Aktiv'
	,'cats_view_max_chars' => 'Maksimum antal tegn i beskrivelse'
// Mini Calendar
	,'mini_cal_label' => 'Mini kalender'
	,'mini_cal_def_picture' => 'Standard billede'
	,'mini_cal_display_picture' => 'Vis billede'
	,'mini_cal_diplay_options' => array('Ingen','Standard billede', 'Dagligt billede','Ugentlig billede','Tilfældigt billede')
// Mail Settings
	,'mail_settings_label' => 'Mail indstillinger'
	,'mail_method' => 'Metode til at sende mail'
	,'mail_smtp_host' => 'SMTP Hosts (flere med ; (semikolon) imellem)'
	,'mail_smtp_auth' => ' SMTP Authentication'
	,'mail_smtp_username' => 'SMTP Username'
	,'mail_smtp_password' => 'SMTP Password'

// Picture Settings
	,'picture_settings_label' => 'Billede indstillinger'
	,'max_upl_dim' => 'Maks bredde og højde for billeder'
	,'max_upl_size' => 'Maks filstørrelse'
	,'picture_chmod' => 'Standard rettigheder til billeder (CHMOD)'
	,'allowed_file_extensions' => 'Filendelser'
// Form Buttons
	,'update_config' => 'Gem konfiguration'
	,'restore_config' => 'Gendan konfiguration'
// Misc.
	,'update_settings_success' => 'Indstillinger opdateret'
	,'restore_default_confirm' => 'Er du sikker på at du vil gendanne konfigurationen'
// Template Configuration
	,'template_type' => 'Udseende'
	,'template_header' => 'Sidehoved'
	,'template_footer' => 'Sidefod'
	,'template_status_default' => 'Brug standard tema'
	,'template_status_custom' => 'Brug følgende tema:'
	,'template_custom' => 'Brugerdefineret tema'

	,'info_meta' => 'Meta Information'
	,'info_status' => 'Status kontrol'
	,'info_status_default' => 'Slå dette indhold fra'
	,'info_status_custom' => 'Vis følgende indhold:'
	,'info_custom' => 'Brugerdefineret indhold'

	,'dynamic_tags' => 'Dynamiske koder'

// Product Updates
	,'updates_check_text' => 'Vent venligts mens jeg komunikerer med serveren...'
	,'updates_no_response' => 'Serveren svarer ikke, prøv igen senere...'
	,'avail_updates' => 'Opdateringer:'
	,'updates_download_zip' => 'Download ZIP pakke (.zip)'
	,'updates_download_tgz' => 'Download TGZ pakke (.tar.gz)'
	,'updates_released_label' => 'Dato: %s'
	,'updates_no_update' => 'Du har allerede den seneste opdatering.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Standard billede'
	,'daily_pic' => 'Dagens billede (%s)'
	,'weekly_pic' => 'Ugens billede (%s)'
	,'rand_pic' => 'Tilfældigt billede (%s)'
	,'post_event' => 'Tilføj begivenhed'
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
	'section_title' => 'Login'
// General Settings
	,'login_intro' => 'Skriv dit brugernavn og kodeord for at logge ind'
	,'username' => 'Brugernavn'
	,'password' => 'Kodeord'
	,'remember_me' => 'Husk login'
	,'login_button' => 'Login'
// Errors
	,'invalid_login' => 'Tjek dit brugernavn og kodeord, og prøv igen!'
	,'no_username' => 'Du skal skrive et brugernavn'
	,'already_logged' => 'Du er allerede logget ind'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


?>