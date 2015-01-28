<?php
/*
  $Id: english.php,v 1.114 2003/07/09 18:13:39 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce 

  Released under the GNU General Public License 
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
setlocale(LC_TIME, "it_IT.utf8");
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('JQUERY_DATEPICKER_I18N_CODE', 'it_IT'); // leave empty for en_US; see http://jqueryui.com/demos/datepicker/#localization
define('JQUERY_DATEPICKER_FORMAT', 'dd/mm/yy'); // see http://docs.jquery.com/UI/Datepicker/formatDate

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="it"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);


// modifica banner 1.4
require(DIR_WS_LANGUAGES . $language . '/' . 'banner_manager.php');
// modifica warehouse 0.1
require(DIR_WS_LANGUAGES . $language . '/modules/warehouse/' . 'warehouse_products_listing.php');

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Crea account');
define('HEADER_TITLE_MY_ACCOUNT', 'Il mio account');
define('HEADER_TITLE_CART_CONTENTS', 'Cosa c\'è nel carrello');
define('HEADER_TITLE_CHECKOUT', 'Acquista');
define('HEADER_TITLE_TOP', 'Home Page');
define('HEADER_TITLE_CATALOG', 'Catalogo');
define('HEADER_TITLE_LOGOFF', 'Log Off');
define('HEADER_TITLE_LOGIN', 'Log In');
define('HEADER_AREA_CONVENZIONI', 'Convenzioni');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'visite da');

// text for gender
define('MALE', 'Uomo');
define('FEMALE', 'Donna');
define('MALE_ADDRESS', 'Sig.');
define('FEMALE_ADDRESS', 'Sig.ra');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Invio Informazioni');
define('CHECKOUT_BAR_PAYMENT', 'Metodo di pagamento');
define('CHECKOUT_BAR_CONFIRMATION', 'Conferma');
define('CHECKOUT_BAR_FINISHED', 'Fine!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Selezionare');
define('TYPE_BELOW', 'Inserire qui');

// javascript messages
define('JS_ERROR', 'Ci sono stati degli errori nella compilazione del modulo!\nEseguire le seguenti modifiche:\n\n');

define('JS_REVIEW_TEXT', '* Il testo delle \'Recensioni\' deve essere di almeno ' . REVIEW_TEXT_MIN_LENGTH . ' caratteri.\n');
define('JS_REVIEW_RATING', '* Devi votare il prodotto per recensirlo.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Seleziona un tipo di pagamento per il tuo acquisto.\n');

define('JS_ERROR_SUBMITTED', 'Questo modulo è già stato inviato. Premi ok e aspetta che termini il processo.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Seleziona un tipo di pagamento per il tuo acquisto.');

define('CATEGORY_COMPANY', 'Azienda');
define('CATEGORY_PERSONAL', 'Dettagli personali');
define('CATEGORY_ADDRESS', 'Indirizzo');
define('CATEGORY_CONTACT', 'Contatti');
define('CATEGORY_OPTIONS', 'Opzioni');
define('CATEGORY_PASSWORD', 'Password');

define('ENTRY_COMPANY', 'Nome dell\' azienda:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Sesso:');
define('ENTRY_GENDER_ERROR', 'Campo \"Sesso\" Richiesto.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', 'Il campo \"Nome\" deve contentere minimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caratteri.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Cognome:');
define('ENTRY_LAST_NAME_ERROR', 'Il campo \"Cognome\" deve contenere minimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caratteri.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Data di nascita:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'La \"Data di nascita\" deve essere inserita seguendo il formato GG/MM/AAAA (eg. 21/05/1970).');
define('ENTRY_DATE_OF_BIRTH_TEXT', ' * (eg. 21/05/1970)');
define('ENTRY_EMAIL_ADDRESS', 'Indirizzo E-Mail:');
define('ENTRY_EMAIL_ADDRESS_SEDE', 'Libreria di vendita:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Il campo \"Indirizzo E-Mail\" deve contentere minimo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caratteri.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Indirizzo email non valido - accertarsi e correggere.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Indirizzo email già contenuto nel nostro database - accedere con questo indirizzo oppure creare un account con un indirizzo differente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Indirizzo:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Il campo \"Indirizzo\" deve contentere minimo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caratteri.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Frazione:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'CAP:');
define('ENTRY_POST_CODE_ERROR', 'Il campo \"CAP\" deve contentere minimo ' . ENTRY_POSTCODE_MIN_LENGTH . ' caratteri.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Città:');
define('ENTRY_CITY_ERROR', 'Il campo \"Città\" deve contentere minimo ' . ENTRY_CITY_MIN_LENGTH . ' caratteri.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Provincia:');
define('ENTRY_STATE_ERROR', 'Il campo \"Stato/Provincia\" deve contentere minimo ' . ENTRY_STATE_MIN_LENGTH . ' caratteri.');
define('ENTRY_STATE_ERROR_SELECT', 'Seleziona uno Stato/Provincia del menù a scorrimento.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Nazione:');
define('ENTRY_COUNTRY_ERROR', 'Seleziona una Nazione del menù a scorrimento.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Numero di telefono:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Il campo \"Numero di telefono\" deve contentere minimo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caratteri.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NAME_SCHOOL', 'Scuola:');
define('ENTRY_NAME_SCHOOL_ERROR', '');
define('ENTRY_NAME_SCHOOL_TEXT', '');
define('ENTRY_CLASS_SCHOOL', 'Classe:');
define('ENTRY_CLASS_SCHOOL_ERROR', '');
define('ENTRY_CLASS_SCHOOL_TEXT', '');
define('ENTRY_SECTION_SCHOOL', 'Sezione:');
define('ENTRY_SECTION_SCHOOL_ERROR', '');
define('ENTRY_SECTION_SCHOOL_TEXT', '');
define('ENTRY_CODE_SCHOOL', 'Cod. Min.:');
define('ENTRY_CODE_SCHOOL_ERROR', 'Codice Ministeriale Richiesto');
define('ENTRY_CODE_SCHOOL_TEXT', '*');
define('ENTRY_LIST_SCHOOL', 'Seleziona dalla lista:');
define('ENTRY_LIST_SCHOOL_ERROR', '');
define('ENTRY_LIST_SCHOOL_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Mi iscrivo');
define('ENTRY_NEWSLETTER_NO', 'Non mi iscrivo');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_PASSWORD_ERROR', 'Il campo \"Password\" deve contentere minimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Le Password \"Password\" e \"Conferma password\" inserite non corrispondono.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Conferma Password:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Password Attuale:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Il campo \"Password Attuale\" deve contentere minimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.');
define('ENTRY_PASSWORD_NEW', 'Nuova Password:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Il campo \"Nuova Password\" deve contentere minimo ' . ENTRY_PASSWORD_MIN_LENGTH . ' caratteri.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Le Password \"Password Attuale\" e \"Nuova Password\" inserite non corrispondono .');
define('PASSWORD_HIDDEN', '--HIDDEN--');

//PIVACF start
define('ENTRY_PIVA', 'Parita Iva:');
define('ENTRY_PIVA_ERROR', 'Numero di Partita Iva scorretto.');
define('ENTRY_PIVA_TEXT', '*');
define('ENTRY_CF', 'Codice Fiscale:');
define('ENTRY_CF_TEXT', '*');
define('ENTRY_CF_ERROR', 'Codice Fiscale scorretto.');
//PIVACF end
// BOF Separate Pricing Per Customer
define('ENTRY_COMPANY_TAX_ID', 'Numero REA:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
// EOF Separate Pricing Per Customer
define('FORM_REQUIRED_INFORMATION', '* Campi Richiesti');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Pagina dei risultati:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> prodotti)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> acquisti)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> recensioni)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> nuovi prodotti)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Visualizzati <b>%d</b> su <b>%d</b> (di <b>%d</b> offerte)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Prima pagina');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Pagina precedente');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Pagina successiva');
define('PREVNEXT_TITLE_LAST_PAGE', 'Ultima pagina');
define('PREVNEXT_TITLE_PAGE_NO', 'Pagina %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Precedenti  %d pagine');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Successive %d pagine');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;PRIMO');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Precedente]');
define('PREVNEXT_BUTTON_NEXT', '[Successivo&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'ULTIMO&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Aggiungi indirizzo');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Indirizzo');
define('IMAGE_BUTTON_BACK', 'Indietro');

###########  MODIFICHE PASSALIBRO ############
define('IMAGE_BUTTON_BUY_NOW', 'Compra Nuovo');
define('IMAGE_BUTTON_BUY_NOW_USED', 'Compra Usato');
define('IMAGE_BUTTON_RESERVE_NOW', 'Prenota Nuovo');
##############################################
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Cambia indirizzo');
define('IMAGE_BUTTON_CHECKOUT', 'Acquista');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Conferma acquisto');
define('IMAGE_BUTTON_CONTINUE', 'Continua');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continua gli acquisti');
define('IMAGE_BUTTON_DELETE', 'Cancella');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Modifica account');
define('IMAGE_BUTTON_HISTORY', 'I miei acquisti');
define('IMAGE_BUTTON_LOGIN', 'Entra');
define('IMAGE_BUTTON_IN_CART', 'Aggiungi al carrello');
define('IMAGE_ADOZIONI_BUTTON_NUOVO_IN_CART', 'Compra Nuovo');
define('IMAGE_ADOZIONI_BUTTON_USATO_IN_CART', 'Compra Usato');
define('IMAGE_ADOZIONI_BUTTON_PRENOTA_IN_CART', 'Prenota Nuovo');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Comunicazioni');
define('IMAGE_BUTTON_QUICK_FIND', 'Ricerca veloce');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Cancella comunicazioni');
define('IMAGE_BUTTON_REVIEWS', 'Recensioni');
define('IMAGE_BUTTON_SEARCH', 'Cerca');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Scegli spedizione');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Dillo ad un amico');
define('IMAGE_BUTTON_UPDATE', 'Aggiorna');
define('IMAGE_BUTTON_UPDATE_CART', 'Aggiorna il carrello');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Scrivi una recensione');

define('SMALL_IMAGE_BUTTON_DELETE', 'Cancella');
define('SMALL_IMAGE_BUTTON_EDIT', 'Modifica');
define('SMALL_IMAGE_BUTTON_VIEW', 'Visualizza');

define('ICON_ARROW_RIGHT', 'Altro');
define('ICON_CART', 'Nel carrello');
define('ICON_ERROR', 'Errore');
define('ICON_SUCCESS', 'Successo');
define('ICON_WARNING', 'Attenzione');


define('TEXT_SHIPPING_DELIVERY_TIME_NEW','<span class="time_shipping" id="time_shipping_new"> (3-5gg) </span>');
define('TEXT_SHIPPING_DELIVERY_TIME_USED','<span class="time_shipping" id="time_shipping_used"> (3-5gg) </span>');
define('TEXT_SHIPPING_DELIVERY_TIME_RESERVED','<span class="time_shipping" id="time_shipping_reserved"> (7gg) </span>');


define('TEXT_GREETING_PERSONAL', 'Bentornato <span class="greetUser">%s!</span> Vuoi vedere i <a href="%s"><u>nuovi prodotti</u></a> che sono disponibili?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Se tu non sei %s, <a href="%s"><u>effettua il log-in</u></a> con i dati del tuo accout.</small>');
define('TEXT_GREETING_GUEST', 'Benvenuto <span class="greetUser">!</span></br> Puoi effettuare qui <a href="%s"><u>il log-in</u></a> Oppure puoi creare qui <a href="%s"><u>un account</u></a>');

define('TEXT_SORT_PRODUCTS', 'Tipi di prodotti');
define('TEXT_DESCENDINGLY', 'in modo discendente');
define('TEXT_ASCENDINGLY', 'in modo ascendente');
define('TEXT_BY', ' by ');

define('TEXT_REVIEW_BY', 'da %s');
define('TEXT_REVIEW_WORD_COUNT', '%s vocaboli');
define('TEXT_REVIEW_RATING', 'Rating: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Data di inserimento: %s');
define('TEXT_NO_REVIEWS', 'Non ci sono recensioni per questo prodotto.');

define('TEXT_NO_NEW_PRODUCTS', 'Non ci sono prodotti.');

define('TEXT_UNKNOWN_TAX_RATE', 'Tassa sconosciuta');

define('TEXT_REQUIRED', '<span class="errorText">Richiesto</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>ERRORE TEP:</small> Non è possibile inviare email, non è stato specificato SMTP server. Cerca php.ini e configura SMTP server.</b></font>');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La data di scadenza della carta di credito non è corretta.<br>Controlla la data e riprova.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Il numero della carta di credito immesso è invalido.<br>Controlla il numero e riprova.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'I primi quattro numeri digitati sono: %s<br>Se questi numeri sono corretti, noi accettiamo la carta di credito.<br>Se non sono giusti, riprova.');

define('FOOTER_TEXT_BODY', 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a> Powered by <a href="http://www.agenziaperilweb.com">Studio Associato Agenzia per il Web</a> | Grafica e Sviluppo eseguite da <a href="http://www.app4web.it/" title="restyling web app ecommerce">App4Web.it</a>');

/* titoli personalizzati per librerie */

define('MY_SCHOOL_ADD', 'Informazioni sulla mia Scuola.');
define('MY_BOOKS_SCHOOL', 'Acquista Testi');
define('MY_BOOKSTORE_DEMAND', 'Richiedi Testi');
define('TEXT_OR', 'Oppure ');
define('TEXT_REMOVE', 'rimuovi');

?>

