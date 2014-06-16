<?PHP

// New language structure
$lang_info = array (
	'name' => 'Italian'
	,'nativename' => 'Italian' // Language name in native language. E.g: 'Français' for 'French'
	,'locale' => array('it','italian') // Standard locale alternatives for a specific language. For reference, go to: http://www.php.net/manual/en/function.setlocale.php
	,'charset' => 'ISO-8859-1' // For reference, go to : http://www.w3.org/International/O-charset-lang.html
	,'direction' => 'ltr' // 'ltr' for Left to Right. 'rtl' for Right to Left languages such as Arabic.
	,'author' => 'Riboni Igor'
	,'author_email' => 'igor@hobbycreativi.com'
	,'author_url' => 'http://www.hobbycreativi.com'
	,'transdate' => '11/10/2004'
);

$lang_general = array (
	'yes' => 'Si'
	,'no' => 'No'
	,'back' => 'Indietro'
	,'continue' => 'Continua'
	,'close' => 'Chiudi'
	,'errors' => 'Errori'
	,'info' => 'Informazioni'
	,'day' => 'Giorno'
	,'days' => 'Giorni'
	,'month' => 'Mese'
	,'months' => 'Mesi'
	,'year' => 'Anno'
	,'years' => 'Anni'
	,'hour' => 'Ora'
	,'hours' => 'Ore'
	,'minute' => 'Minuto'
	,'minutes' => 'Minuti'
	,'everyday' => 'Ogni Giorno'
	,'everymonth' => 'Ogni Mese'
	,'everyyear' => 'Ogni Anno'
	,'signature' => 'Powered by %s'
);

// Date formats, For reference, go to : http://www.php.net/manual/en/function.strftime.php
$lang_date_format = array (
	'full_date' => '%A, %d %B %Y' // e.g. Wednesday, June 05, 2002
	,'full_date_time_24hour' => '%A %d %B %Y Ore %H:%M' // e.g. Wednesday, June 05, 2002 At 21:05
	,'full_date_time_12hour' => '%A %d %B %Y Ore %I:%M %p' // e.g. Wednesday, June 05, 2002 At 9:05 pm
	,'day_month_year' => '%d-%b-%Y' // e.g 10-Sep-2004
	,'local_date' => '%c' // Preferred date and time representation for current language 
	,'mini_date' => '%a, %d %b %Y' 
	,'month_year' => '%B %Y'
	,'day_of_week' => array('Domenica','Lunedì','Martedì','Mercoledì','Giovedi','Venerdì','Sabato')
	,'months' => array('Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre')
);

$lang_system = array (
	'system_caption' => 'Messaggio di Sistema'
  ,'page_access_denied' => 'Non hai i sufficenti privilegi per accedere a questa pagina.'
  ,'operation_denied' => 'Non hai i sufficenti privilegi per eseguire questa operazione.'
	,'section_disabled' => 'Questa sezione è attualmente disabilitata !'
  ,'non_exist_cat' => 'La categorie selezionata non esiste !'
  ,'non_exist_event' => 'L\'evento selezionato non esiste !'
  ,'param_missing' => 'I parametri forniti non sono corretti.'
  ,'no_events' => 'Nessun evento da visualizzare'
  ,'config_string' => 'Stai attualmente usando \'%s\' funzionando su %s, %s e %s.'
  ,'no_table' => 'La tabella \'%s\' non esiste !'
  ,'no_anonymous_group' => 'La tabella %s non contiene il gruppo \'Anonymous\' !'
);

// Admin menu entries
$lang_admin_menu = array (
	'login' => 'Login'
	,'register' => 'Registrati'
  ,'logout' => 'Logout <span style="color:#FF9922">[<span style="color:#606F79">%s</span>]</span>'
  ,'user_profile' => 'Mio Profilo'
	,'admin_events' => 'Eventi'
  ,'admin_categories' => 'Categorie'
  ,'admin_groups' => 'Gruppi'
  ,'admin_users' => 'Utenti'
  ,'admin_settings' => 'Settaggi'
);

// Main menu entries
$lang_main_menu = array (
	'add_event' => 'Aggiungi Evento'
	,'cal_view' => 'Vista Mensile'
  ,'flat_view' => 'Vista Flat'
  ,'weekly_view' => 'Vista Settimanale'
  ,'daily_view' => 'Vista Giornaliera'
  ,'yearly_view' => 'Vista Annuale'
  ,'categories_view' => 'Categorie'
  ,'search_view' => 'Cerca'
);

// ======================================================
// Add Event view
// ======================================================

$lang_add_event_view = array(
	'section_title' => 'Aggiungi Evento'
	,'edit_event' => 'Edita Evento [id%d] \'%s\''
	,'update_event_button' => 'Aggiurna Evento'

// Event details
	,'event_details_label' => 'Dettaglio Evento'
	,'event_title' => 'Titolo Evento'
	,'event_desc' => 'Descrizione Evento'
	,'event_cat' => 'Categoria'
	,'choose_cat' => 'Seleziona una Categoria'
	,'event_date' => 'Dta Evento'
	,'day_label' => 'Giorno'
	,'month_label' => 'Mese'
	,'year_label' => 'Anno'
	,'start_date_label' => 'Ora di Inizio'
	,'start_time_label' => 'Alle'
	,'end_date_label' => 'Durata'
	,'all_day_label' => 'Ogni Giorno'
// Contact details
	,'contact_details_label' => 'Dettagli Contatto'
	,'contact_info' => 'Info Contatto'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
// Other details
	,'other_details_label' => 'Altri Dettagli'
	,'picture_file' => 'Immagine'
	,'file_upload_info' => '(%d KBytes limit - Estensioni Valide : %s )' 
	,'del_picture' => 'Cancella l\'immagine Corrente ?'
// Administrative options
	,'admin_options_label' => 'Opzioni Amministrative'
	,'auto_appr_event' => 'Evento Approvato'

// Error messages
	,'no_title' => 'Devi fornire un Titolo per l\'evento !'
	,'no_desc' => 'Devi fornire una descrizione per questo Evento !'
	,'no_cat' => 'Devi selezionare una categoria dal menù a tendina !'
	,'date_invalid' => 'Devi fornire una data valida per questo Evento !'
	,'end_days_invalid' => 'Il valore inserito in \'Days\' non è valido !'
	,'end_hours_invalid' => 'Il valore inserito in \'Hours\' non è valido !'
	,'end_minutes_invalid' => 'Il valore inserito in \'Minutes\' non è valido !'

	,'non_valid_extension' => 'Il formato del file inserito non è supportato ! (Estensioni Valide: %s)'

	,'file_too_large' => 'L\'immagine allegata è di peso superiore al massimo consentito: %d KBytes !'
	,'move_image_failed' => 'Errore di sistema uploadando l\'immagine !'
	,'non_valid_dimensions' => 'Le dimensioni dell\'immagine, Altezza o Larghezza, sono superiori al massimo di %s pixels !'

// Misc. messages
	,'submit_event_pending' => 'Il tuo Evento è ora in attesa di approvazione. Grazie per averlo segnalato!'
	,'submit_event_approved' => 'Il tuo Evento è stato automaticamente approvato. Grazie per averlo segnalato!'
);

// ======================================================
// daily view
// ======================================================

$lang_daily_event_view = array(
	'section_title' => 'Vista Giornaliera'
	,'next_day' => 'Giorno Successivo'
	,'previous_day' => 'Giorno Precedente'
	,'no_events' => 'Non ci sono Eventi in questo giorno.'
);

// ======================================================
// weekly view
// ======================================================

$lang_weekly_event_view = array(
	'section_title' => 'Vista Settimanale'
	,'week_period' => '%s - %s'
	,'next_week' => 'Settimana Successivo'
	,'previous_week' => 'Settimana Precedente'
	,'selected_week' => 'Settimana %d'
	,'no_events' => 'Non ci sono eventi in questa settimana'
);

// ======================================================
// monthly view
// ======================================================

$lang_monthly_event_view = array(
	'section_title' => 'Vista Mensile'
	,'next_month' => 'Mese Successivo'
	,'previous_month' => 'Mese Precedente'
);

// ======================================================
// flat view
// ======================================================

$lang_flat_event_view = array(
	'section_title' => 'Vista Flat'
	,'week_period' => '%s - %s'
	,'next_month' => 'Mese Successivo'
	,'previous_month' => 'Mese Precedente'
	,'contact_info' => 'Info Contatto'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_events' => 'Non ci sono Eventi in questo mese'
);

// ======================================================
// Event view
// ======================================================

$lang_event_view = array(
	'section_title' => 'Vista Eventi'
	,'display_event' => 'Evento: \'%s\''
	,'cat_name' => 'Categoria'
	,'event_start_date' => 'Data'
	,'event_end_date' => 'Fino a'
	,'event_duration' => 'Durata'
	,'contact_info' => 'Info Contatto'
	,'contact_email' => 'Email'
	,'contact_url' => 'URL'
	,'no_event' => 'Non ci sono Eventi da visualizzare.'
	,'stats_string' => '<strong>%d</strong> Eventi in totale'
);

// ======================================================
// Categories view
// ======================================================

$lang_cats_view = array(
	'section_title' => 'Vista Categorie'
	,'cat_name' => 'Nome Categoria'
	,'total_events' => 'Totale Eventi'
	,'upcoming_events' => 'Eventi Imminenti'
	,'no_cats' => 'Non ci sono Categorie da visualizzare.'
	,'stats_string' => 'Ci sono  <strong>%d</strong> Eventi in <strong>%d</strong> Categorie'
);

// ======================================================
// Category Events view
// ======================================================

$lang_cat_events_view = array(
	'section_title' => 'Eventi in \'%s\''
	,'event_name' => 'Nome Evento'
	,'event_date' => 'Data'
	,'no_events' => 'Non ci sono Eventi in questa Categoria.'
	,'stats_string' => '<strong>%d</strong> Eventi in totale'
);

// ======================================================
// cal_search.php
// ======================================================

$lang_event_search_data = array(
	'section_title' => 'Cerca nel calendario',
	'search_results' => 'Risultati della ricerca',
	'category_label' => 'Categoria',
	'date_label' => 'Data',
	'no_events' => 'Non ci sono Eventi in questa Categoria.',
	'search_caption' => 'Scrivi alcune parole chiave...',
	'search_again' => 'Cerca ancora',
	'search_button' => 'Cerca',
// Misc.
	'no_results' => 'Nessun risultato per questa ricerca',	
// Stats
	'stats_string1' => '<strong>%d</strong> Evento(i) Trovato(i)',
	'stats_string2' => '<strong>%d</strong> Evento(i) in <strong>%d</strong> Pagina(e)'
);

// ======================================================
// register.php
// ======================================================

if (defined('USER_REGISTRATION_PHP')) 

$lang_user_registration_data = array(
	'section_title' => 'Registrazione Utente',
// Step 1: Terms & Conditions
	'terms_caption' => 'Termini e Condizioni',
	'terms_intro' => 'Per poter procedere, Devi accettare le seguenti condizioni:',
	'terms_message' => 'Cortesemente, prendere visione delle regole descritte dettagliatamente qui sotto. Se accettate le regole e intendete procedere con la registrazione, basta premete il tasto ACCETTO. Per cancellare questa registrazione, basta semplicemente premere il tasto INDIETRO del tuo browser.<br /><br />La redazione, il webmaster, e tutti i componenti diretti o indiretti del sito e/o del calendario non possono dichiararsi responsabili per gli Eventi postati dagli utenti. Non possiamo garantire in nessun modo l\'accuratezza, l\esattezza e/o l\'usabilità dei dati e/o Eventi postati a non siamo responsabili del contenuto degli stessi.<br /><br />I messaggi espressi dall\'autore dell\'Evento , non sono necessariamentre controllati dalla redazione. Qualsiasi Utente che trovi qualsiasi tipo di abuso del servizio, discutibilità dell\'Evento inserito, o altre inottemperanze è pregato di contattarci subito via email. Abbiamo la possibilità di eliminare ogni materiale ritenuto non idoneo al sito e fare il possibile per fare rispettare queste policy nel minor tempo possibile, rimuovento parte del contenuto o tutto il contenuto stesso dove ritenuto non idoneo.<br /><br />Accettando questo, Dichiarate di non utilizzare questa applicazione del calendario per inviare materiale deliberatamente falso e/o diffamatorio, inaccurato, abusivo, volgare, razzista, discriminante, oscena, profana, orientata sessualmente, minacciante, invasiva alla privacy delle persone, e qualsiasi altra forma che violi le leggi civili, penali e/o etiche.<br /><br />Acconsite anche di non poter inviare materiale coperto da copyright a meno che il copyright sia posseduto da voi o da %s.',
	'terms_button' => 'ACCETTO',
	
// Account Info
	'account_info_label' => 'Informazioni Account',
	'user_name' => 'Username',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Conferma Password',
	'user_email' => 'Indirizzo E-mail',
// Other Details
	'other_details_label' => 'Altri Dettagli',
	'first_name' => 'Nome',
	'last_name' => 'Cognome',
	'user_website' => 'Home page',
	'user_location' => 'Locazione',
	'user_occupation' => 'Occupazione',
	'register_button' => 'Invia la mia registrazione',

// Stats
	'stats_string1' => '<strong>%d</strong> Utenti',
	'stats_string2' => '<strong>%d</strong> Utenti in <strong>%d</strong> Pagina(e)',
// Misc.
	'reg_nomail_success' => 'Grazie per la tua registrazione.',
	'reg_mail_success' => 'Una email con le informazioni per attivare il tuo account sono state spedita all\'email specificata.',
	'reg_activation_success' => 'Congratulazioni! Il tuo account adesso è attivo e puoi accedere con la user e password che hai specificato nella registrazione. Grazie per esserti registrato.',
// Mail messages
	'reg_confirm_subject' => 'Registrazione su %s',
	
// Error messages
	'no_username' => 'Devi inserire un nome !',
	'invalid_username' => 'Per favore, inserire uno username che contenga solamente lettere e numeri, di lunghezza compresa tra 4 e 30 caratteri !',
	'username_exists' => 'Lo username che hai scelto esiste già. Inserisci uno username differente !',
	'no_password' => 'Devi fornire una Password !',
	'invalid_password' => 'Per favore, inserire una passowrd che contenga solamente lettere e numeri, di lunghezza compresa tra 4 e 16 caratteri !',
	'password_is_username' => 'La password deve essere diversa dallo username !',
	'password_not_match' =>'La password che hai inserito non corrisponde con quella inserita in \'conferma password\'',
	'no_email' => 'Devi fornire un indirizzo email !',
	'invalid_email' => 'Devi fornire un indirizzo email valido !',
	'email_exists' => 'Un altro utente si è già registrato con questo indirizzo email. Inseriscine un email differente !',
	'delete_user_failed' => 'Questo account utente non può essere cancellato',
	'no_users' => 'Non ci sono account utente da visualizzare !',
	'already_logged' => 'Sei già loggato com membro !',
	'registration_not_allowed' => 'La registrazione utenti è attualmente disabilitata !',
	'reg_email_failed' => 'Si è verificato un errore tentando di inviare l\'email di attivazione account !',
	'reg_activation_failed' => 'Si è verificato un errore processando l\'attivazione !'

);
// Message body for email activation
$lang_user_registration_data['reg_confirm_body'] = <<<EOT
Grazie per esserti registrato su {CALENDAR_NAME}

Il tuo username è : "{USERNAME}"
La tua password è : "{PASSWORD}"

Per procedere alla attivazione del tuo account, devi cliccare il link qui sotto
oppure fare un copia-incolla nel tuo browser.

{REG_LINK}

Ringraziamenti,

La redazione di {CALENDAR_NAME}

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
	'section_title' => 'Amministrazione Eventi',
	'events_to_approve' => 'Amministrazione Eventi: Aventi approvati',
	'upcoming_events' => 'Amministrazione Eventi: Eventi imminenti',
	'past_events' => 'Amministrazione Eventi: Eventi passati',
	'add_event' => 'Inserisci nuovo evento',
	'edit_event' => 'Modifica Evento',
	'view_event' => 'View Event',
	'approve_event' => 'Approva Evento',
	'update_event' => 'Aggiorna informazioni Evento',
	'delete_event' => 'Calcella Evento',
	'events_label' => 'Eventi',
	'auto_approve' => 'Approva Automaticamente',
	'date_label' => 'Data',
	'actions_label' => 'Azioni',
	'events_filter_label' => 'Filtra Eventi',
	'events_filter_options' => array('Visualizza tutti gli eventi','Visualizza solo Eventi non Approvati','Visualizza solo Eventi imminenti','Visualizza solo Eventi passati'),
	'picture_attached' => 'Immagine allegata',
// View Event
	'view_event_name' => 'Evento: \'%s\'',
	'event_start_date' => 'Data',
	'event_end_date' => 'Fino a',
	'event_duration' => 'Durata',
	'contact_info' => 'Info Contatto',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
// General Info
// Event form
	'edit_event_title' => 'Evento: \'%s\'',
	'cat_name' => 'Categoria',
	'event_start_date' => 'Data',
	'event_end_date' => 'Fino a',
	'contact_info' => 'Info Contatto',
	'contact_email' => 'Email',
	'contact_url' => 'URL',
	'no_event' => 'Non ci sono Eventi da visualizzare.',
	'stats_string' => '<strong>%d</strong> Eventi in totale',
// Stats
	'stats_string1' => '<strong>%d</strong> evento(i)',
	'stats_string2' => 'Totale: <strong>%d</strong> Eventi in <strong>%d</strong> pagina(e)',
// Misc.
	'add_event_success' => 'Nuovo Evento aggiunto con successo',
	'edit_event_success' => 'Aggiornamento Evento effettuato con successo',
	'approve_event_success' => 'Evento approvato con successo',
	'delete_confirm' => 'Sei proprio sicuro di vole cancellare questo Evento ?',
	'delete_event_success' => 'Evento cancellato con successo',
	'active_label' => 'Attivo',
	'not_active_label' => 'Non Attivo',
// Error messages
	'no_event_name' => 'Devi fornire un nome per questo Evento !',
	'no_event_desc' => 'Devi fornire una descrizione per questo Evento !',
	'no_cat' => 'Devi selezionare una categoria per questo Evento !',
	'no_day' => 'Devi selezionare un giorno !',
	'no_month' => 'Devi selezionare un mese !',
	'no_year' => 'Devi selezionare un anno !',
	'non_valid_date' => 'Inserire una data corretta !',
	'end_days_invalid' => 'Assicurati che il campo \'giorni\' sotto la voce \'Durata\' consista solamente in numeri !',
	'end_hours_invalid' => 'Assicurati che il campo \'Ore\' sotto la voce \'Durata\' consista solamente in numeri !',
	'end_minutes_invalid' => 'Assicurati che il campo \'Minuti\' sotto la voce \'Durata\' consista solamente in numeri !',
	'file_too_large' => 'L\'Immagine allegata è di peso superiore al massimo consentito: %d KBytes !',
	'non_valid_extension' => 'Il formato del file allegato non è supportato !',
	'delete_event_failed' => 'Questo Evento non può essere cancellato',
	'approve_event_failed' => 'Questo Evento non può essere approvato',
	'no_events' => 'Nessun Evento da visualizzare !',
	'move_image_failed' => 'Il sistema ha provocato un errore uploadando l\'immagine !',
	'non_valid_dimensions' => 'Le dimensioni dell\'immagine, Altezza o Larghezza, sono superiori al massimo di %s pixels !'
);

// ======================================================
// admin_categories.php
// ======================================================

if (defined('ADMIN_CATS_PHP')) 

$lang_cat_admin_data = array(
	'section_title' => 'Amministrazione Categorie',
	'add_cat' => 'Aggiungi nuova Categoria',
	'edit_cat' => 'Modifica Categoria',
	'update_cat' => 'Aggiorna info Categoria',
	'delete_cat' => 'Cancella Categoria',
	'events_label' => 'Eventi',
	'visibility' => 'Visibilità',
	'actions_label' => 'Azioni',
	'users_label' => 'Utenti',
	'admins_label' => 'Amministratori',
// General Info
	'general_info_label' => 'Informazioni Generali',
	'cat_name' => 'Nome Categoria',
	'cat_desc' => 'Descrizione Categoria',
	'cat_color' => 'Colore',
	'pick_color' => 'Seleziona un colore!',
	'status_label' => 'Stato',
// Administrative Options
	'admin_label' => 'Opzioni Amministrative',
	'auto_admin_appr' => 'Approva automaticamente gli Eventi inseriti da parte del gruppo Amministratori',
	'auto_user_appr' => 'Approva automaticamente gli Eventi inseriti da parte degli utenti',
// Stats
	'stats_string1' => '<strong>%d</strong> Categorie',
	'stats_string2' => 'Attive: <strong>%d</strong>&nbsp;&nbsp;&nbsp;Totali: <strong>%d</strong>&nbsp;&nbsp;&nbsp;in <strong>%d</strong> pagina(e)',
// Misc.
	'add_cat_success' => 'Nuova Categoria aggiunta con successo',
	'edit_cat_success' => 'Categoria aggiornata con successo',
	'delete_confirm' => 'Sei proprio sicuro di voler cancellare questa Categoria ?',
	'delete_cat_success' => 'Categoria cancellata con successo',
	'active_label' => 'Attiva',
	'not_active_label' => 'Non Attiva',
// Error messages
	'no_cat_name' => 'Devi fornire un nome per questa Categoria !',
	'no_cat_desc' => 'Devi fornire una descrizione per questa Categoria !',
	'no_color' => 'Devi fornire un colore per questa Categoria !',
	'delete_cat_failed' => 'Questa categoria non può essere cancellata',
	'no_cats' => 'non ci sono categorie da visualizzare !',
	'cat_has_events' => 'Questa categoria contiene %d evento(i) e non può essere cancellata!<br>Cancella prima gli eventi contenuti nella categoria e riprova!'

);
// ======================================================
// admin_users.php
// ======================================================

if (defined('ADMIN_USERS_PHP')) 

$lang_user_admin_data = array(
	'section_title' => 'Amministrazione Utenti',
	'add_user' => 'Aggiungi nuovo Utente',
	'edit_user' => 'Modifica dettagli Utente',
	'update_user' => 'Aggiorna dettagli Utente',
	'delete_user' => 'Cancella account Utente',
	'last_access' => 'Ultimo Accesso',
	'actions_label' => 'Azioni',
	'active_label' => 'Attivo',
	'not_active_label' => 'Non attivo',
// Account Info
	'account_info_label' => 'Informazioni Account',
	'user_name' => 'Username',
	'user_pass' => 'Password',
	'user_pass_confirm' => 'Conferma Password',
	'user_email' => 'Indirizzo E-mail',
	'group_label' => 'Membro del Goruppo',
	'status_label' => 'Stato Account',
// Other Details
	'other_details_label' => 'Altri dettagli',
	'first_name' => 'Nome',
	'last_name' => 'Cognome',
	'user_website' => 'Home page',
	'user_location' => 'Locazione',
	'user_occupation' => 'Occupazione',
// Stats
	'stats_string1' => '<strong>%d</strong> Utenti',
	'stats_string2' => '<strong>%d</strong> Utenti in <strong>%d</strong> pagina(e)',
// Misc.
	'select_group' => 'Seleziona un ...',
	'add_user_success' => 'Account Utente aggiunto con successo',
	'edit_user_success' => 'Account utente aggiornato con successo',
	'delete_confirm' => 'Sei proprio sicuro di voler cancellare questo account utente ?',
	'delete_user_success' => 'Account utente cancellato con successo',
	'update_pass_info' => 'Lascia lo spazio della password vuoto se non desideri cambiarla',
	'access_never' => 'Mai',
// Error messages
	'no_username' => 'Devi fornire uno Username !',
	'invalid_username' => 'Per favore, inserire uno username che contenga solamente lettere e numeri, di lunghezza compresa tra 4 e 30 caratteri !',
	'invalid_password' => 'Per favore, inserire una passowrd che contenga solamente lettere e numeri, di lunghezza compresa tra 4 e 16 caratteri !',
	'password_is_username' => 'La password deve essere diversa dallo username !',
	'password_not_match' =>'La password che hai inserito non corrisponde a quella del campo \'Conferma password\'',
	'invalid_email' => 'Devi fornire un indirizzo email valido !',
	'email_exists' => 'Another user has already registered with the email address you entered. Please enter a different email !',
	'username_exists' => 'Un altro utente è già registrato con questo username, forniscine un altro !',
	'no_email' => 'Devi fornire un indirizzo email !',
	'no_password' => 'Defi fornire una password per questo nuovo account !',
	'no_group' => 'Seleziona il gruppo di appartenenza di questo utente !',
	'delete_user_failed' => 'Questo accout non può essere cancellato',
	'no_users' => 'Non ci sono account Utente da visualizzare !'

);

// ======================================================
// admin_groups.php
// ======================================================

if (defined('ADMIN_GROUPS_PHP')) 

$lang_group_admin_data = array(
	'section_title' => 'Amministrazione Gruppo',
	'add_group' => 'Aggiungi Gruppo',
	'edit_group' => 'Modifica Gruppo',
	'update_group' => 'Aggiorna info Gruppo',
	'delete_group' => 'Cancella Gruppo',
	'view_group' => 'Visualizza Gruppo',
	'users_label' => 'Membri',
	'actions_label' => 'Azioni',
// General Info
	'general_info_label' => 'Informazioni Generali',
	'group_name' => 'Nome Gruppo',
	'group_desc' => 'Descrizione Grupo',
// Group Access Level
	'access_level_label' => 'Livello di accesso Gruppo',
	'has_admin_access' => 'Gli Utenti di queto Gruppo hanno accesso Amministrativo',
	'can_manage_accounts' => 'Gli Utenti di questo Gruppo possono maneggiare gli account',
	'can_change_settings' => 'Gli Utenti di questo Gruppo posso cambiare i settaggi del Calendario',
	'can_manage_cats' => 'Gli utenti di questo Gruppo possono maneggiare le Categorie',
	'upl_need_approval' => 'L\' Evento proposto richiede l\'approvazione di un amministratore',
// Stats
	'stats_string1' => '<strong>%d</strong> Gruppi',
	'stats_string2' => 'Totale: <strong>%d</strong> Gruppo(i) in <strong>%d</strong> pagina(e)',
	'stats_string3' => 'Totale: <strong>%d</strong> Utente(i) in <strong>%d</strong> pagina(e)',
// View Group Members
	'group_members_string' => 'Membri di \'%s\' Gruppo',
	'username_label' => 'Username',
	'firstname_label' => 'Nome',
	'lastname_label' => 'Cognome',
	'email_label' => 'Email',
	'last_access_label' => 'Ultimo Accesso',
	'edit_user' => 'Modifica Utente',
	'delete_user' => 'Cancella Utente',
// Misc.
	'add_group_success' => 'Nuovo Gruppo aggiunto con successo',
	'edit_group_success' => 'Gruppo Aggiornato con successo',
	'delete_confirm' => 'Sei proprio sicuro di voler calcellare questo Gruppo ?',
	'delete_user_confirm' => 'Sei proprio sicuro di voler calcellare questo Gruppo ?',
	'delete_group_success' => 'Gruppo cancellato con successo',
	'no_users_string' => 'Non ci sono Utenti in questo Gruppo',
// Error messages
	'no_group_name' => 'Devi fornire un nome per questo Gruppo !',
	'no_group_desc' => 'Devi fornire una descrizione per questo Gruppo !',
	'delete_group_failed' => 'Questo Gruppo non può essere cancellato',
	'no_groups' => 'Non ci sono Gruppi da visualizzare !',
	'group_has_users' => 'Questo Gruppo contiene %d utente(i) e non può essere cancellato!<br>Eliminare le associazaioni di utenti a questo Gruppo prima di cancellarlo!'

);

// ======================================================
// admin_settings.php / admin_settings_template.php / 
// admin_settings_updates.php
// ======================================================

if (defined('SETTINGS_PHP')) 

$lang_settings_data = array(
	'section_title' => 'Settaggi Calendario'
// Links
	,'admin_links_text' => 'Scegli Sezione'
	,'admin_links' => array('Sezione Principale','Configurazione Template','Aggiornamento Prodotto')
// General Settings
	,'general_settings_label' => 'Settaggi Generali'
	,'calendar_name' => 'Nome Calendario'
	,'calendar_description' => 'Descrizione Calendario'
	,'calendar_admin_email' => 'Email amministratore Calendario'
	,'cookie_name' => 'Nome dei cookie usati dallo script'
	,'cookie_path' => 'Indirizzo dei cookie usati dallo script'
	,'debug_mode' => 'Abilità debug mode'
// Environment Settings
	,'env_settings_label' => 'Settaggi d\'ambiente'
	,'lang' => 'Lingua'
		,'lang_name' => 'Linga'
		,'lang_native_name' => 'Nome Nativo'
		,'lang_trans_date' => 'Tradotto da'
		,'lang_author_name' => 'Autore'
		,'lang_author_email' => 'E-mail'
		,'lang_author_url' => 'Sito Web'
	,'charset' => 'Codifica Caratteri'
	,'theme' => 'Tema'
		,'theme_name' => 'Nome Tema'
		,'theme_date_made' => 'Creato da'
		,'theme_author_name' => 'Autore'
		,'theme_author_email' => 'E-mail'
		,'theme_author_url' => 'Sito Web'
	,'timezone' => 'Timezone'
	,'time_format' => 'Formato di visualizzazione ora'
		,'24hours' => '24 Ore'
		,'12hours' => '12 Ore'
	,'auto_daylight_saving' => 'Aggiorna automaticaticamente con il sistema (DST)'
	,'main_table_width' => 'Larghezza della tabella principale (Pixels o %)'
	,'day_start' => 'La settimana inizia da'
	,'default_view' => 'Vista di default'
	,'search_view' => 'Abilita ricerca'
	,'archive' => 'Visualizza Eventi passati'
	,'events_per_page' => 'Numero di Eventi per pagina'
	,'sort_order' => 'Ordine di Default'
		,'sort_order_title_a' => 'Titolo Ascendente'
		,'sort_order_title_d' => 'Titolo Discendente'
		,'sort_order_date_a' => 'Data Ascendente'
		,'sort_order_date_d' => 'Data Discendente'
// User Settings
	,'user_settings_label' => 'Settaggi Utente'
	,'allow_user_registration' => 'Abilità registrazione Utenti'
	,'reg_duplicate_emails' => 'Permetti email duplicate'
	,'reg_email_verify' => 'Abilita attivazione account via email'
// Event View
	,'event_view_label' => 'Vista Evento'
	,'popup_event_mode' => 'Evento Pop-up'
	,'popup_event_width' => 'Larghezza della finestra di Pop-up'
	,'popup_event_height' => 'Altezza della finestra di Pop-up'
// Add Event View
	,'add_event_view_label' => 'Vista aggiungi Evento'
	,'add_event_view' => 'Abilitata'
	,'addevent_allow_html' => 'Abilita Utilizzo di <b>BB Code</b> nella descrizione'
	,'addevent_allow_contact' => 'Abilita Inserimento Contatto'
	,'addevent_allow_email' => 'Abilita Inserimento Email'
	,'addevent_allow_url' => 'Abilita Inserimento URL'
	,'addevent_allow_picture' => 'Abilita Inserimento Immagini'
	,'new_post_notification' => 'Notificazione nuovi inserimenti'
// Calendar View
	,'calendar_view_label' => 'Vista (Mensile) del Calendario'
	,'monthly_view' => 'Abilitata'
	,'cal_view_max_chars' => 'Numero massimo di caratteri nella descrizione'
// Flyer View
	,'flyer_view_label' => 'Vista Aletta'
	,'flyer_view' => 'Abilitata'
	,'flyer_show_picture' => 'Visualizza immagini nella visualizzazione Aletta'
	,'flyer_view_max_chars' => 'Numero massimo di caratteri nella descrizione'
// Weekly View
	,'weekly_view_label' => 'Vista Settimanale'
	,'weekly_view' => 'Abilitata'
	,'weekly_view_max_chars' => 'Numero massimo di caratteri nella descrizione'
// Daily View
	,'daily_view_label' => 'Vista Giornaliera'
	,'daily_view' => 'Abilitata'
	,'daily_view_max_chars' => 'Numero massimo di caratteri nella descrizione'
// Categories View
	,'categories_view_label' => 'Vista Categorie'
	,'cats_view' => 'Abiliatat'
	,'cats_view_max_chars' => 'Numero massimo di caratteri nella descrizione'
// Mini Calendar
	,'mini_cal_label' => 'Mini Calendario'
	,'mini_cal_def_picture' => 'Immagine di Default'
	,'mini_cal_display_picture' => 'Visualizza Immagine'
	,'mini_cal_diplay_options' => array('Nessuna','Immagine di default', 'Immagine giornaliera','Immagine settimanale','Immagine random')
// Picture Settings
	,'picture_settings_label' => 'Settaggi Immagini'
	,'max_upl_dim' => 'Larghezza e altezza massima delle immagini allegate'
	,'max_upl_size' => 'Peso massimo delle immagine allegate (in Bytes)'
	,'picture_chmod' => 'Permessi di default della immagini allegate (CHMOD) (in Octal)'
	,'allowed_file_extensions' => 'Estensioni accettate per i file in allegato'
// Form Buttons
	,'update_config' => 'Salva nuova configurazione'
	,'restore_config' => 'Ripristaina valori di default'
// Misc.
	,'update_settings_success' => 'Settaggi aggiornati con successo'
	,'restore_default_confirm' => 'Sei proprio sicuro di voler ripristinare i settaggi di default ?'
// Template Configuration
	,'template_type' => 'Tipo di Template'
	,'template_header' => 'Customizzazione Header'
	,'template_footer' => 'Customizzazione Footer'
	,'template_status_default' => 'Usa il Template di default del Tema'
	,'template_status_custom' => 'Usa il seguente Template:'
	,'template_custom' => 'Template Custom'

	,'info_meta' => 'Meta Informazioni'
	,'info_status' => 'Controllo Stato'
	,'info_status_default' => 'Disabilita questo contenuto'
	,'info_status_custom' => 'Visualizza il seguente contenuto:'
	,'info_custom' => 'Contenuto Custom'

	,'dynamic_tags' => 'Tags Dynamico'

// Product Updates
	,'updates_check_text' => 'Per favore, attenti, sto richiedendo informazioni al server...'
	,'updates_no_response' => 'Nessuna risposta da parte del server. Per favore riprova.'
	,'avail_updates' => 'Aggiornamenti disponibili'
	,'updates_download_zip' => 'Scarica pacchetto ZIP (.zip)'
	,'updates_download_tgz' => 'Scarica pacchetto TGZ (.tar.gz)'
	,'updates_released_label' => 'Data di rilascio: %s'
	,'updates_no_update' => 'Stai utilizando l\'ultima versione rilasciata. Nessun aggiornamento disponibile.'
);

// ======================================================
// cal_mini.inc.php
// ======================================================

$lang_mini_cal = array(
	'def_pic' => 'Immagine di default'
	,'daily_pic' => 'Immagine Giornaliera (%s)'
	,'weekly_pic' => 'Immagine Settimanale (%s)'
	,'rand_pic' => 'Immagine Random (%s)'
	,'post_event' => 'Inserisci nuovo Evento'
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
	'section_title' => 'Accesso Utente'
// General Settings
	,'login_intro' => 'Inserisci username e password per effettuare l\'accesso'
	,'username' => 'Username'
	,'password' => 'Password'
	,'remember_me' => 'Ricordami'
	,'login_button' => 'Accesso'
// Errors
	,'invalid_login' => 'Per favore, verifica le informazioni inserite e riprova!'
	,'no_username' => 'Devi fornire uno username !'
	,'already_logged' => 'Hai già eseguito l\'accesso utente !'
);

// ======================================================
// logout.php
// ======================================================

// To Be Done


// old structure	

$maand[0]="Ogni Mese";
$maand[1]="Gennaio";
$maand[2]="Febbraio";
$maand[3]="Marzo";
$maand[4]="Aprile";
$maand[5]="Maggio";
$maand[6]="Giugno";
$maand[7]="Luglio";
$maand[8]="Agosto";
$maand[9]="Settembre";
$maand[10]="Ottobre";
$maand[11]="Novembre";
$maand[12]="Dicembre";

$week[1]="Domenica";
$week[2]="Lunedì";
$week[3]="Martedì";
$week[4]="Mercoledì";
$week[5]="Giovedì";
$week[6]="Venerdì";
$week[7]="Sabato";

function translate($word){

    switch ($word) {
        // Language parameters
        case "lang_name": $new = "Italian";    break;
        case "lang_nativename": $new = "Italian";    break;
        case "lang_charset": $new = "ISO-8859-1";    break;
				// Translations
        case "yes": $new = "Si";    break;
        case "no": $new = "No";    break;
        case "welcometo": $new = "Benvenuto su";    break;
        case "admin": $new = "Amministrazione";    break;
        case "adminoptions": $new = "Opzioni di Amministrazione";    break;
        case "cate": $new = "Vista Categorie"; break;
        case "day": $new = "Cista Giornaliera"; break;
        case "week": $new = "Settimana"; break;
        case "weeklyview": $new = "Vista Settimanale"; break;
        case "cal": $new = "Vista Calendario"; break;
        case "nocats": $new = "Nessuna Categoria"; break;
        case "addcat": $new = "Aggiungi Categoria"; break;
        case "cats": $new = "Categorie"; break;
        case "addevent": $new = "Aggiungi Evento"; break;
        case "outof": $new = "Storico Articoli"; break;
        case "upcomingevents": $new = "Eventi Imminenti"; break;
        case "totalevents": $new = "Totale Eventi"; break;
        case "events": $new = "Eventi"; break;
        case "errors": $new = "Errori"; break;
        case "weeklyevents": $new = "Eventi Settimanali"; break;
        case "eventdetails": $new = "Eventi Giornalieri"; break;
        case "eventitle": $new = "Titolo Evento"; break;
        case "description": $new = "Descrizione Evento"; break;
        case "choosecat": $new = "Seleziona Categoria"; break;
        case "selectyear": $new = "Anno"; break;
        case "selectmonth": $new = "Mese"; break;
        case "selectday": $new = "Giorno"; break;
        case "everyyear": $new = "Ogni Anno"; break;
        case "everymonth": $new = "Ogni Mese"; break;
        case "bdate": $new = "Data"; break;
        case "notitle": $new = "Devi Fornire un titolo per l\'Evento !"; break;
        case "nodescription": $new = "Devi fornire una descrizione per l\'Evento"; break;
        case "noday": $new = "Devi selezionare un giorno !"; break;
        case "nomonth": $new = "Devi selezionare un mese !"; break;
        case "noyear": $new = "Devi selezionare un anno !"; break;
        case "nocat": $new = "Devi selezionare una categoria !"; break;
        case "novaliddate": $new = "Inserisci una data valida !"; break;
        case "kblimit": $new = "Limite di Bytes"; break;
        case "back": $new = "Indietro"; break;
        case "action": $new = "Azioni"; break;
        case "nononapproved": $new = "Non ci sono Eventi in attesa di approvazione in questo momento"; break;
        case "nonapproved": $new = "Eventi da Approvare"; break;
        case "autoapprove": $new = "Eventi Auto-Approvati"; break;
        case "cat": $new = "Categorie"; break;
        case "view": $new = "Vista Evento"; break;
        case "edit": $new = "Modifica Evento"; break;
        case "updateevent": $new = "Aggiorna Evento"; break;
        case "approve": $new = "Approva questo Evento"; break;
        case "appreventok": $new = "Evento approvato con successo"; break;
        case "cantapprevent": $new = "L\'Evento specificato non può essere approvato"; break;
        case "moreinfo": $new = "Altre Info"; break;
        case "editcat": $new = "Modifica Categoria"; break;
        case "delcat": $new = "Cancella Categoria"; break;
        case "edit": $new = "Modifica"; break;
        case "del": $new = "Cancella"; break;
        case "name": $new = "Nome"; break;
        case "update": $new = "Aggiorna"; break;
        case "reallydelcat": $new = "Sei proprio sicuro di voler rimuovere questa categoria ? Tutti gli Eventi associati a questa categoria verranno definitivamente cancellati !"; break;
        case "noback": $new = "Oops, no, Torna Indietro !"; break;
        case "deleventok": $new = "Evento cancellato con successo"; break;
        case "cantdelevent": $new = "L\'Evento specificato non può essere cancellato"; break;
        case "surecat": $new = "Si, Cancellalo adesso !"; break;
        case "noevents": $new = "Nessun Evento"; break;
        case "numbevents": $new = "Eventi in "; break;
        case "upevent": $new = "Aggiorna ogni"; break;
        case "delev": $new = "Cancella Evento"; break;
        case "currentpic": $new = "Immagine Corrente"; break;
        case "delpic": $new = "Cancella questa immagine"; break;
        case "nooutofdate": $new = "Nessun Evento scaduto."; break;
        case "delalloodev": $new = "Cancella tutti gli Eventi scaduti"; break;
        case "delevok": $new = "Sei proprio sicuro di voler cancellare questo Evento?"; break;
        case "delalloodevok": $new = "Cancellali adesso !"; break;
        case "prevm": $new = "Mese Precedente"; break;
        case "nextm": $new = "Mese Successivo"; break;
        case "today": $new = "Oggi"; break;
        case "eventstoday": $new = "Eventi di Oggi"; break;
        case "readmore": $new = "Leggi Ancora"; break;
        case "nextday": $new = "Giorno Successivo"; break;
        case "prevday": $new = "Giorno Precedente"; break;
        case "askedday": $new = "Giorno richiesto"; break;
        case "nextweek": $new = "Settimana Successiva"; break;
        case "prevweek": $new = "Settimana Precedente"; break;
        case "weeknr": $new = "Settimana Numero"; break;
        case "eventsthisweek": $new = "Eventi da "; break;
        case "till": $new = "Lavorare a"; break;
        case "thankyou": $new = "Grazie per aver inserito l\'Evento, Apparirà il prima possibile!"; break;
        case "eventedited": $new = "Evento aggiornato con successo!"; break;
				case "op": $new = "su"; break;
       	# here start the new not yet translated language vars
        case "disabled": $new = "Questa sezione risulta disabilitata"; break;
       	case "searchbutton": $new = "Cerca Adesso"; break;
       	case "searchtitle": $new = "Cerca"; break;
       	case "searchcaption": $new = "Inserisci qualche parola chiave"; break;
       	case "searchresults": $new = "Risultati della ricerca"; break;
       	case "searchagain": $new = "Cerca Ancora"; break;
      	case "onedate": $new = "Una Data"; break;
        case "moredates": $new = "Altre Date"; break;
      	case "moredatesexplain": $new = "Altre Date: 'dd-mm-yyyy;dd-mm-yyyy' se il giorno è uno, inserisci 01, uguale per il mese! fino alla fine-';' !"; break;
      	case "email": $new = "Email"; break;
      	case "results": $new = "Risultati"; break;
      	case "noresults": $new = "Nessun Risultato"; break;
        case "wronglogin": $new = "Verifica le informazioni di accesso e riprova!"; break;
        case "userman": $new = "Amministrazione Utente"; break;
        case "users": $new = "Utenti"; break;
        case "logout": $new = "Logout"; break;
        case "deluser": $new = "Cancella Utente"; break;
        case "addnewuser": $new = "Aggiungi Utente"; break;
        case "loginscreen": $new = "Schermata di accesso"; break;
        case "login": $new = "Accesso"; break;
        case "password": $new = "Password"; break;
        case "rememberme": $new = "Ricordami"; break;
				case "loginmsg": $new = "Inserisci username e password per effettuare l\'accesso"; break;
				case "nologinname": $new = "Inserisci uno username!"; break;
        case "userwarning": $new = "Raccomandiamo di essere sicuri di ricordare la proria password, sarà successivamente irrecuperabile !"; break;
        case "userdelok": $new = "Sei sicuro di voler cancellare l\'utente ?"; break;
        case "contact": $new = "Contatto"; break;
        case "contactinfo": $new = "Info Contatto"; break;
        case "otherdetails": $new = "Altri Dettagli"; break;
        case "picture": $new = "Immagine"; break;
        case "filetolarge": $new = "L\'allegato è troppo grande !"; break;
        case "extensionnovalid": $new = "Estensione del file non valida!"; break;
        case "flyerlink": $new = "Vista Aletta"; break;
        case "mailtitle": $new = "Controlla la tua amministrazione del calendario ASAP !"; break;
        case "mailbody": $new = "Qualcuno ha inserito un Evento !"; break;
        case "continuebutton": $new = "Clicca per continuare"; break;
        case "returnbutton": $new = "Ritorna alla Home Page"; break;
        case "in": $new = "in"; break;
        case "uploadapplnk": $new = "Enenti"; break;
        case "settingslnk": $new = "Settaggi"; break;
        case "categorieslnk": $new = "Categorie"; break;
        case "userslnk": $new = "Utenti"; break;
        case "groupslnk": $new = "Gruppi"; break;
        case "myprofile": $new = "Profilo"; break;
        case "status": $new = "Stato"; break;
        case "options": $new = "Opzioni"; break;
        case "autoappr": $new = "Auto Approva"; break;
        case "active": $new = "Attivo"; break;
        case "inactive": $new = "Non Attivo"; break;
        case "admincats": $new = "Amministrazione Categoria"; break;
        case "generalinfo": $new = "Informazioni Generali"; break;
        case "catname": $new = "Nome Categoria"; break;
        case "catdesc": $new = "Descrizione Categoria"; break;
        case "color": $new = "Colore"; break;
        case "pickcolor": $new = "Scegli un colore!"; break;
        case "autouserappr": $new = "Approvazione automatica inserimento da Utente"; break;
        case "autoadminappr": $new = "Approvazione automatica inserimento da Amministratore"; break;
        case "nocatname": $new = "Devi fornire un nome per la categoria!"; break;
        case "nocatdesc": $new = "Devi fornire una descrizione!"; break;
        case "nocolor": $new = "Devi fornire un colore!"; break;
        case "total": $new = "Totale"; break;
        case "admins": $new = "Amministratori"; break;
        case "updatecat": $new = "Aggiorna Categoria"; break;
        case "catedited": $new = "Categoria aggiornata con successo!"; break;
        case "delcatmoreevents": $new = "Questa categoria contiene %d evento(i) E quindi non può essere cancellata!<br>Cancella gli eventi rimanenti associati a questa categoria prima di cancellare la stessa!"; break;
        case "delcatok": $new = "Categoria cancellata con successo!"; break;
        
        default: $new = "<b>".$word."</b> Necessita di essere tradotto !";    break;

    }
    return $new;
}
?>