<?php
/*
  $Id: italian.php,v 1.106 2003/06/20 00:18:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce 

  Released under the GNU General Public License 
*/

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'it_IT.ISO8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('JQUERY_DATEPICKER_I18N_CODE', ''); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'mm/dd/yy'); // see http://docs.jquery.com/UI/Datepicker/formatDate

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
} 

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="it"');

// charset for web pages and emails
define('CHARSET', 'iso-1040');

// page title
define('TITLE', 'AdminShop Passalibro.it');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Amministrazione');
define('HEADER_TITLE_SUPPORT_SITE', 'Sito di supporto');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catalogo On-line');
define('HEADER_TITLE_ADMINISTRATION', 'Amministrazione');
define('HEADER_TITLE_WAREHOUSES', 'Gestione Magazzini');

// text for gender
define('MALE', 'Uomo');
define('FEMALE', 'Donna');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configurazione');
define('BOX_CONFIGURATION_MYSTORE', 'Il mio negozio');
define('BOX_CONFIGURATION_LOGGING', 'Logging');
define('BOX_CONFIGURATION_CACHE', 'Cache');
define('BOX_CONFIGURATION_ADMINISTRATORS', 'Amministratori');
define('BOX_CONFIGURATION_STORE_LOGO', 'Logo Negozio');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Moduli');
define('BOX_MODULES_PAYMENT', 'Pagamenti');
define('BOX_MODULES_SHIPPING', 'Spedizioni');
define('BOX_MODULES_ORDER_TOTAL', 'Totale Ordine');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalogo');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorie/Prodotti');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Attributi Prodotti');
define('BOX_CATALOG_MANUFACTURERS', 'Produttori');
define('BOX_CATALOG_REVIEWS', 'Recensioni');
define('BOX_CATALOG_SPECIALS', 'Offerte');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Prodotti in arrivo');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_EBAY', 'eBay Store');
define('BOX_EBAY_CATEGORIES_PRODUCTS', 'Categorie/Prodotti');
define('BOX_EBAY_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Attributi Prodotti');
define('BOX_EBAY_MANUFACTURERS', 'Produttori');
define('BOX_EBAY_REVIEWS', 'Recensioni');
define('BOX_EBAY_SPECIALS', 'Offerte');
define('BOX_EBAY_PRODUCTS_EXPECTED', 'Prodotti in arrivo');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_AMAZON', 'Amazon Seller');
define('BOX_AMAZON_SELLERS', 'Amazon Venditore');
define('BOX_UNLOCK_REPORTS_AMAZON', 'Sblocco Carrelli');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clienti');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clienti');
define('BOX_CUSTOMERS_CHANGE_PASSWORD', 'Change Password');
define('BOX_CUSTOMERS_ORDERS', 'Ordini');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Zone/Tasse');
define('BOX_TAXES_COUNTRIES', 'Nazioni');
define('BOX_TAXES_ZONES', 'Stati/Province');
define('BOX_TAXES_GEO_ZONES', 'Tasse stat./prov.');
define('BOX_TAXES_TAX_CLASSES', 'Tipi di Tasse');
define('BOX_TAXES_TAX_RATES', 'Aliquota Tasse');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Statistiche');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Prodotti visti');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Prodotti acquistati');
define('BOX_REPORTS_ORDERS_TOTAL', 'Totale Ordini Clienti');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Strumenti utili');
define('BOX_TOOLS_BACKUP', 'Salva Database');
define('BOX_TOOLS_ACTION_RECORDER', 'Registra Azioni');
define('BOX_TOOLS_BANNER_MANAGER', 'Gestione Banner');
define('BOX_TOOLS_CACHE', 'Controllo Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definizione lingua');
define('BOX_TOOLS_FILE_MANAGER', 'Gestione File');
define('BOX_TOOLS_MAIL', 'Invio Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gestione Newsletter');
define('BOX_TOOLS_SEC_DIR_PERMISSIONS', 'Cartella dei Permessi di Sicurezza');
define('BOX_TOOLS_SERVER_INFO', 'Informazioni Server');
define('BOX_TOOLS_WHOS_ONLINE', 'Chi c\'&egrave; online');
define('BOX_TOOLS_VERSION_CHECK', 'Update per OSC');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localizzazione');
define('BOX_LOCALIZATION_CURRENCIES', 'Valute/Monete');
define('BOX_LOCALIZATION_LANGUAGES', 'Lingue');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Stato Ordini');

// javascript messages
define('JS_ERROR', 'Si sono verificati degli errori nel procedimento di compilazione del tuo modulo!!\nEseguire le seguenti correzioni:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Definire per il nuovo attributo del Prodotto un prezzo\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Definire per il nuovo attributo del Prodotto un prefisso di prezzo\n');

define('JS_PRODUCTS_NAME', '* Definire per il nuovo Prodotto un nome\n');
define('JS_PRODUCTS_DESCRIPTION', '* Definire per il nuovo Prodotto una descrizione\n');
define('JS_PRODUCTS_PRICE', '* Definire per il nuovo Prodotto necessita di un prezzo\n');
define('JS_PRODUCTS_WEIGHT', '* Definire per il  nuovo Prodotto un peso\n');
define('JS_PRODUCTS_QUANTITY', '* Definire per il nuovo Prodotto una quantit&agrave;\n');
define('JS_PRODUCTS_MODEL', '* Definire per il  nuovo Prodotto un modello\n');
define('JS_PRODUCTS_IMAGE', '* Definire per il nuovo Prodotto un\'immagine\'\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Definire un nuovo prezzo per questo prodotto.\n');

define('JS_GENDER', '* La scelta del Sesso &egrave; obbligatoria.\n');
define('JS_FIRST_NAME', '* Il Nome deve contenere almeno ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caratteri.\n');
define('JS_LAST_NAME', '* Il Cognome deve contenere almeno ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caratteri.\n');
define('JS_DOB', '* La Data di Nascita deve avere il formato: xx/xx/xxxx (mese/giorno/anno).\n');
define('JS_EMAIL_ADDRESS', '* L\'indirizzo di E-mail deve contenere almeno\' ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caratteri.\n');
define('JS_ADDRESS', '* L\'indirizzo deve contenere almeno\' ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caratteri.\n');
define('JS_POST_CODE', '* Il CAP deve contenere almeno ' . ENTRY_POSTCODE_MIN_LENGTH . ' caratteri.\n');
define('JS_CITY', '* Il nome della Citt&agrave; deve contenere almeno ' . ENTRY_CITY_MIN_LENGTH . ' caratteri.\n');
define('JS_STATE', '* Lo Stato/Provincia deve essere selezionato.\n');
define('JS_STATE_SELECT', '-- Seleziona Sotto --');
define('JS_ZONE', '* Lo Stato/Provincia deve essere scelto dalla lista.');
define('JS_COUNTRY', '* Lo Stato/Provincia deve essere scelto.\n');
define('JS_TELEPHONE', '* Il Numero di Telefono deve contenere almeno ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caratteri.\n');
define('JS_PASSWORD', '* La Password e la Conferma devono contenere almeno ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Il Numero dell\'Ordine\' %s non esiste!');

define('CATEGORY_PERSONAL', 'Personale');
define('CATEGORY_ADDRESS', 'Indirizzo');
define('CATEGORY_CONTACT', 'Contatti');
define('CATEGORY_COMPANY', 'Azienda');
define('CATEGORY_OPTIONS', 'Opzioni');

define('ENTRY_GENDER', 'Sesso:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">campo richiesto</span>');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">minimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caratteri</span>');
define('ENTRY_LAST_NAME', 'Cognome:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">minimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caratteri</span>');
define('ENTRY_DATE_OF_BIRTH', 'Data di Nascita:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'Indirizzo E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">minimo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caratteri</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">L\'inidirizzo email non sembra essere valido!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Questo indirizzo email esiste gi&agrave;!</span>');
define('ENTRY_COMPANY', 'Nome Azienda:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Indirizzo:');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">minimo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caratteri</span>');
define('ENTRY_SUBURB', 'Frazione:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'CAP:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">minimo ' . ENTRY_POSTCODE_MIN_LENGTH . ' caratteri</span>');
define('ENTRY_CITY', 'Citt&agrave;:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">minimo ' . ENTRY_CITY_MIN_LENGTH . ' caratteri</span>');
define('ENTRY_STATE', 'Stato/Provincia:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">richiesto</span>');
define('ENTRY_COUNTRY', 'Nazione:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Numero di telefono:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">minimo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caratteri</span>');
define('ENTRY_FAX_NUMBER', 'Numero di Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_YES', 'Mi iscrivo');
define('ENTRY_NEWSLETTER_NO', 'Non mi iscrivo');
define('ENTRY_NEWSLETTER_ERROR', '');

//PIVACF start
define('ENTRY_PIVA', 'Partita Iva:');
define('ENTRY_CF', 'Codice Fiscale:');
define('JS_PIVA', 'Parita Iva richiesta');
define('JS_CF', 'Codice Fiscale richiesto');
//PIVACF end

// images
define('IMAGE_ANI_SEND_EMAIL', 'Spedisci E-Mail');
define('IMAGE_BACK', 'Indietro');
define('IMAGE_BACKUP', 'Salva');
define('IMAGE_CANCEL', 'Cancella');
define('IMAGE_CONFIRM', 'Conferma');
define('IMAGE_COPY', 'Copia');
define('IMAGE_COPY_TO', 'Copia In');
define('IMAGE_DETAILS', 'Dettagli');
define('IMAGE_DELETE', 'Cancella');
define('IMAGE_EDIT', 'Modifica');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_EXPORT', 'Esporta');
define('IMAGE_FILE_MANAGER', 'File Manager');
define('IMAGE_ICON_STATUS_GREEN', 'Attiva');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Imposta come Attivo');
define('IMAGE_ICON_STATUS_RED', 'Inattiva');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Imposta come Inattivo');
define('IMAGE_ICON_INFO', 'Informazioni');
define('IMAGE_INSERT', 'Inserisci');
define('IMAGE_LOCK', 'Blocca');
define('IMAGE_MODULE_INSTALL', 'Installa Modulo');
define('IMAGE_MODULE_REMOVE', 'Rimuovi Modulo');
define('IMAGE_MOVE', 'Sposta');
define('IMAGE_NEW_BANNER', 'Nuovo Banner');
define('IMAGE_NEW_CATEGORY', 'Nuova Categoria');
define('IMAGE_NEW_COUNTRY', 'Nuova Nazione');
define('IMAGE_NEW_CURRENCY', 'Nuova Valuta');
define('IMAGE_NEW_FILE', 'Nuovo File');
define('IMAGE_NEW_FOLDER', 'Nuova Cartella');
define('IMAGE_NEW_LANGUAGE', 'Nuova Lingua');
define('IMAGE_NEW_NEWSLETTER', 'Nuova Newsletter');
define('IMAGE_NEW_PRODUCT', 'Nuovo Prodotto');
define('IMAGE_NEW_TAX_CLASS', 'Nuovo Tipo di Tassa');
define('IMAGE_NEW_TAX_RATE', 'Nuova Aliquota Tassa');
define('IMAGE_NEW_TAX_ZONE', 'Nuova Tassa Stat./Prov.');
define('IMAGE_NEW_ZONE', 'Nuovo Stato/Provincia');
define('IMAGE_ORDERS', 'Ordini');
define('IMAGE_ORDERS_INVOICE', 'Fattura');
define('IMAGE_ORDERS_PACKINGSLIP', 'Ordini evasi');
define('IMAGE_PREVIEW', 'Anteprima');
define('IMAGE_RESTORE', 'Ripristina');
define('IMAGE_RESET', 'Resetta');
define('IMAGE_SAVE', 'Salva');
define('IMAGE_SEARCH', 'Cerca');
define('IMAGE_SELECT', 'Seleziona');
define('IMAGE_SEND', 'Spedisci');
define('IMAGE_SEND_EMAIL', 'Invia Email');
define('IMAGE_UNLOCK', 'Sblocca');
define('IMAGE_UPDATE', 'Aggiorna');
define('IMAGE_UPDATE_CURRENCIES', 'Aggiorna Tasso di Cambio');
define('IMAGE_UPLOAD', 'Upload??');

define('ICON_CROSS', 'Falso');
define('ICON_CURRENT_FOLDER', 'Cartella Corrente');
define('ICON_DELETE', 'Cancella');
define('ICON_ERROR', 'Errore');
define('ICON_FILE', 'File');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Cartella');
define('ICON_LOCKED', 'Bloccato');
define('ICON_PREVIOUS_LEVEL', 'Livello Precedente');
define('ICON_PREVIEW', 'Anteprima');
define('ICON_STATISTICS', 'Statistiche');
define('ICON_SUCCESS', 'Riuscito');
define('ICON_TICK', 'Vero');
define('ICON_UNLOCKED', 'Sbloccato');
define('ICON_WARNING', 'Attenzione');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Pagina %s di %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Visualizzate <b>%d</b> su <b>%d</b> (di <b>%d</b> nazioni)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> clienti)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Visualizzate <b>%d</b> su <b>%d</b> (di <b>%d</b> valute)');
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Visualizzati <strong>%d</strong> di <strong>%d</strong> (of <strong>%d</strong> entries)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Visualizzate <b>%d</b> su <b>%d</b> (di <b>%d</b> lingue)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> produttori)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Visualizzate <b>%d</b> su <b>%d</b> (di <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> ordini)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> stato ordini)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> prodotti)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> prodotti in attesa)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> recensioni prodotto)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> prodotti in offerta)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> tipi di tassa)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Visualizzate <b>%d</b> su <b>%d</b> (di <b>%d</b> tasse stat./prov)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Visualizzate <b>%d</b> su <b>%d</b> (di <b>%d</b> aliquote di tassa)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> stati/Province)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'default');
define('TEXT_SET_DEFAULT', 'Setta come Default');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Richiesto</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Errore: Non c&egrave; un valore di Default settato. Settane uno da: Tool Amministrazione->Localizzazione->Valute');

define('TEXT_CACHE_CATEGORIES', 'Box Categorie');
define('TEXT_CACHE_MANUFACTURERS', 'Box Produttori');
define('TEXT_CACHE_ALSO_PURCHASED', 'Also Purchased Module');

define('TEXT_NONE', '--none--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Errore: Destinazione non esistente.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Errore: Destinazione non scrivibile.');
define('ERROR_FILE_NOT_SAVED', 'Errore: File upload non salvato.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Errore: Tipo di file upload non consentito.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Successo: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Warning: Nessuno file uplodato.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: Il meccanismo di file uploads &egrave; disabilitato nel file di configurazione php.ini.');

//TotalB2B start
define('BOX_CUSTOMERS_GROUPS', 'Grouppi');
define('BOX_MANUDISCOUNT', 'Discount Produttori');
define('BOX_CATEMANUDISCOUNT', 'Discount Categorie Produttori');
define('BOX_CATEDISCOUNT', 'Discount Categorie');
//TotalB2B end

//customersextrafileds start
define('BOX_TOOLS_EXTRA_FIELDS_MANAGER','Extra fields manager');
define('ENTRY_EXTRA_FIELDS_ERROR','Field %s must contain a minimum of %d characters');
define('TEXT_DISPLAY_NUMBER_OF_FIELDS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> Fields)');
//customersextrafileds end

//extrapages start
define('BOX_TOOLS_PAGE_MANAGER', 'Extra info Pages Manager');
define('TEXT_DISPLAY_NUMBER_OF_PAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> Pages)');
//extrapages end

// START: Product Extra Fields
define('BOX_CATALOG_PRODUCTS_EXTRA_FIELDS', 'Product Extra Fields');
// END: Product Extra Fields

//FAQDesk 2.1
define('BOX_TOOLS_FAQ', 'FAQ Manager');
//FAQDesk 2.1

//Stats Low Stock
define('BOX_REPORTS_STOCK_LEVEL', 'Low Stock Report');
//Stats Low Stock

//++++ QT Pro: Begin Changed code
define('BOX_REPORTS_STATS_LOW_STOCK_ATTRIB', 'Stock Report');
//++++ QT Pro: End Changed Code

define('BOX_TOOLS_SLIDESHOW', 'Slideshow');
// BOF Order Maker
define('IMAGE_CREATE_ORDER', 'Crea');
define('BOX_CUSTOMERS_CREATE_ORDER', 'Crea Ordine');
// EOF Order Maker
// BOF Create Account 
define('BOX_CUSTOMERS_CREATE_ACCOUNT', 'Crea Cliente');
// EOF Create Account

##### DEFINIZIONI MAGAZZINO

define('BOX_CONFIGURATION_WAREHOUSES', 'Gestione Magazzini');

?>
