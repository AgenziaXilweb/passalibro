<?php
define('BOX_REPORTS_PRODUCTS_MONITOR', 'Product Monitor');

define('BOX_REPORTS_SUPERTRACKER', 'Supertracker');

define('BOX_VISITORS', 'Visitors');
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> entries)');

// Documents Manager
define('BOX_CATALOG_DOCUMENTS', 'Document Manager');

define('BOX_REPORTS_MARGIN_REPORT', 'Margin Report');

define('BOX_HEADING_INFORMATION', 'Informationen');
// START - Admin Notes
define('BOX_TOOLS_ADMIN_NOTES', 'Admin Notes');
// END - Admin Notes

define('BOX_OSWAI_UPDATE', 'OSWAI Update version');

// seo assistant start
define('BOX_TOOLS_SEO_ASSISTANT', 'SEO Assistant');
//seo assistant end

//TotalB2B start
define('BOX_CUSTOMERS_GROUPS', 'Groups');
define('BOX_MANUDISCOUNT', 'Manufacturers Discount');
define('BOX_CATEDISCOUNT', 'Categories Discount');
define('BOX_CATEMANUDISCOUNT', 'Cat-Manu Discount');
//TotalB2B end

// point
define('BOX_CUSTOMERS_POINTS', 'Customers Points');// Points/Rewards Module V2.00
define('BOX_CUSTOMERS_POINTS_PENDING', 'Pending Points');// Points/Rewards Module V2.00
define('BOX_CUSTOMERS_POINTS_REFERRAL', 'Referral Points');// Points/Rewards Module V2.00
//Admin begin
// header text in includes/header.php
define('HEADER_TITLE_ACCOUNT', 'Mein Konto');
define('HEADER_TITLE_LOGOFF', 'Abmelden');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', 'Mein Konto');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrator');
define('BOX_ADMINISTRATOR_MEMBERS', 'Gruppen-Mitglieder');
define('BOX_ADMINISTRATOR_MEMBER', 'Mitglieder');
define('BOX_ADMINISTRATOR_BOXES', 'Datei-Zugriff');

// images
define('IMAGE_FILE_PERMISSION', 'Datei-Rechte');
define('IMAGE_GROUPS', 'Gruppen-Liste');
define('IMAGE_INSERT_FILE', 'Datei einf&uuml;gen');
define('IMAGE_MEMBERS', 'Mitglieder-Liste');
define('IMAGE_NEW_GROUP', 'Neue Gruppe');
define('IMAGE_NEW_MEMBER', 'Neues Mitglied');
define('IMAGE_NEXT', 'Weiter');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Zeige <b>%d</b> - <b>%d</b> (von <b>%d</b> Dateien)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Zeige <b>%d</b> - <b>%d</b> (von <b>%d</b> Mitgliedern)');
// EOE Access with Level Account (v. 2.2a) for the Admin Area of osCommerce (MS2) 1 of 1

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for strftime()
define('PHP_DATE_TIME_FORMAT', 'd.m.Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

// currencies separator
define('CURRENCIES_DECIMAL_POINT', ",");
define('CURRENCIES_THOUSANDS_POINT', ".");

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
define('HTML_PARAMS','dir="ltr" lang="de"');

// charset for web pages and emails
define('CHARSET', 'Iso-8859-16');

// page title
define('TITLE', 'osCommerce');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administration');
define('HEADER_TITLE_SUPPORT_SITE', 'Supportseite');
define('HEADER_TITLE_ONLINE_CATALOG', 'Online Katalog');
define('HEADER_TITLE_ADMINISTRATION', 'Administration');

// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Konfiguration');
define('BOX_CONFIGURATION_MYSTORE', 'My Store');
define('BOX_CONFIGURATION_LOGGING', 'Logging');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Module');
define('BOX_MODULES_PAYMENT', 'Zahlungsweise');
define('BOX_MODULES_SHIPPING', 'Versandart');
define('BOX_MODULES_ORDER_TOTAL', 'Zusammenfassung');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorien / Artikel');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Create Attributes');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_MANAGER', 'Associated Attributes/Articles');
define('BOX_CATALOG_MANUFACTURERS', 'Hersteller');
define('BOX_CATALOG_REVIEWS', 'Produktbewertungen');
define('BOX_CATALOG_SPECIALS', 'Sonderangebote');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'erwartete Artikel');
define('BOX_CATALOG_UPLOAD_FILE', 'Upload free file');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_ORDERS', 'Bestellungen');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Land / Steuer');
define('BOX_TAXES_COUNTRIES', 'Land');
define('BOX_TAXES_ZONES', 'Bundesl&auml;nder');
define('BOX_TAXES_GEO_ZONES', 'Steuerzonen');
define('BOX_TAXES_TAX_CLASSES', 'Steuerklassen');
define('BOX_TAXES_TAX_RATES', 'Steuers&auml;tze');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Berichte');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'besuchte Artikel');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'gekaufte Artikel');
define('BOX_REPORTS_ORDERS_TOTAL', 'Kunden-Bestellstatistik');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Hilfsprogramme');
define('BOX_TOOLS_BACKUP', 'Datenbanksicherung');
define('BOX_TOOLS_BANNER_MANAGER', 'Banner Manager');
define('BOX_TOOLS_CACHE', 'Cache Steuerung');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Sprachen definieren');
define('BOX_TOOLS_MAIL', 'eMail versenden');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Rundschreiben Manager');
define('BOX_TOOLS_SERVER_INFO', 'Server Info');
define('BOX_TOOLS_WHOS_ONLINE', 'Wer ist Online');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Sprachen/W&auml;hrungen');
define('BOX_LOCALIZATION_CURRENCIES', 'W&auml;hrungen');
define('BOX_LOCALIZATION_LANGUAGES', 'Sprachen');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Bestellstatus');

// javascript messages
define('JS_ERROR', 'W&auml;hrend der Eingabe sind Fehler aufgetreten!\nBitte korrigieren Sie folgendes:\n\n');

define('JS_REVIEW_TEXT', '* Der Text muss mindestens aus ' . REVIEW_TEXT_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_REVIEW_RATING', '* Geben Sie Ihre Bewertung ein.\n');

define('JS_OPTIONS_VALUE_PRICE', '* Sie m&uuml;ssen diesem Wert einen Preis zuordnen\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Sie m&uuml;ssen ein Vorzeichen f&uuml;r den Preis angeben (+/-)\n');

define('JS_PRODUCTS_NAME', '* Der neue Artikel muss einen Namen haben\n');
define('JS_PRODUCTS_DESCRIPTION', '* Der neue Artikel muss eine Beschreibung haben\n');
define('JS_PRODUCTS_PRICE', '* Der neue Artikel muss einen Preis haben\n');
define('JS_PRODUCTS_WEIGHT', '* Der neue Artikel muss eine Gewichtsangabe haben\n');
define('JS_PRODUCTS_QUANTITY', '* Sie m&uuml;ssen dem neuen Artikel eine verf&uuml;gbare Anzahl zuordnen\n');
define('JS_PRODUCTS_MODEL', '* Sie m&uuml;ssen dem neuen Artikel eine Artikel-Nr. zuordnen\n');
define('JS_PRODUCTS_IMAGE', '* Sie m&uuml;ssen dem Artikel ein Bild zuordnen\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Es muss ein neuer Preis f&uuml;r diesen Artikel festgelegt werden\n');

define('JS_GENDER', '* Die \'Anrede\' muss ausgew&auml;hlt werden.\n');
define('JS_FIRST_NAME', '* Der \'Vorname\' muss mindestens aus ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_LAST_NAME', '* Der \'Nachname\' muss mindestens aus ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_DOB', '* Das \'Geburtsdatum\' muss folgendes Format haben: xx.xx.xxxx (Tag/Jahr/Monat).\n');
define('JS_EMAIL_ADDRESS', '* Die \'eMail-Adresse\' muss mindestens aus ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_ADDRESS', '* Die \'Strasse\' muss mindestens aus ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_POST_CODE', '* Die \'Postleitzahl\' muss mindestens aus ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_CITY', '* Die \'Stadt\' muss mindestens aus ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_STATE', '* Das \'Bundesland\' muss ausgew&auml;hlt werden.\n');
define('JS_STATE_SELECT', '-- W&auml;hlen Sie oberhalb --');
define('JS_ZONE', '* Das \'Bundesland\' muss aus der Liste f&uuml;r dieses Land ausgew&auml;hlt werden.');
define('JS_COUNTRY', '* Das \'Land\' muss ausgew&auml;hlt werden.\n');
define('JS_TELEPHONE', '* Die \'Telefonnummer\' muss aus mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen bestehen.\n');
define('JS_PASSWORD', '* Das \'Passwort\' sowie die \'Passwortbest&auml;tigung\' m&uuml;ssen &uuml;bereinstimmen und aus mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen bestehen.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Auftragsnummer %s existiert nicht!');

define('CATEGORY_PERSONAL', 'Pers&ouml;nliche Daten');
define('CATEGORY_ADDRESS', 'Adresse');
define('CATEGORY_CONTACT', 'Kontakt');
define('CATEGORY_COMPANY', 'Firma');
define('CATEGORY_OPTIONS', 'Optionen');

define('ENTRY_GENDER', 'Anrede:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">notwendige Eingabe</span>');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Buchstaben</span>');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Buchstaben</span>');
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(z.B. 31/01/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'eMail Adresse:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Buchstaben</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">ung&uuml;ltige eMail-Adresse!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Diese eMail-Adresse existiert schon!</span>');
define('ENTRY_COMPANY', 'Firmenname:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Strasse:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Buchstaben</span>');
define('ENTRY_SUBURB', 'weitere Anschrift:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zahlen</span>');
define('ENTRY_CITY', 'Stadt:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Buchstaben</span>');
define('ENTRY_STATE', 'Bundesland:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">notwendige Eingabe</font></small>');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zahlen</span>');
define('ENTRY_FAX_NUMBER', 'Telefaxnummer:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Rundschreiben:');
define('ENTRY_NEWSLETTER_YES', 'abonniert');
define('ENTRY_NEWSLETTER_NO', 'nicht abonniert');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'eMail versenden');
define('IMAGE_BACK', 'Zur&uuml;ck');
define('IMAGE_BACKUP', 'Datensicherung');
define('IMAGE_CANCEL', 'Abbruch');
define('IMAGE_CONFIRM', 'Best&auml;tigen');
define('IMAGE_COPY', 'Kopieren');
define('IMAGE_COPY_TO', 'Kopieren nach');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'L&ouml;schen');
define('IMAGE_EDIT', 'Bearbeiten');
define('IMAGE_EDIT_ATTRIBUTE', 'Edit Attribute');
define('IMAGE_EMAIL', 'eMail versenden');
define('IMAGE_ICON_STATUS_GREEN', 'aktiv');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'aktivieren');
define('IMAGE_ICON_STATUS_RED', 'inaktiv');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'deaktivieren');
define('IMAGE_ICON_INFO', 'Information');
define('IMAGE_INSERT', 'Einf&uuml;gen');
define('IMAGE_LOCK', 'Sperren');
define('IMAGE_MODULE_INSTALL', 'Module Installieren');
define('IMAGE_MODULE_REMOVE', 'Module Entfernen');
define('IMAGE_MOVE', 'Verschieben');
define('IMAGE_NEW_BANNER', 'Neuen Banner aufnehmen');
define('IMAGE_NEW_CATEGORY', 'Neue Kategorie erstellen');
define('IMAGE_NEW_COUNTRY', 'Neues Land aufnehmen');
define('IMAGE_NEW_CURRENCY', 'Neue W&auml;hrung einf&uuml;gen');
define('IMAGE_NEW_FILE', 'Neue Datei');
define('IMAGE_NEW_FOLDER', 'Neues Verzeichnis');
define('IMAGE_NEW_LANGUAGE', 'Neue Sprache anlegen');
define('IMAGE_NEW_NEWSLETTER', 'Neues Rundschreiben');
define('IMAGE_NEW_PRODUCT', 'Neuen Artikel aufnehmen');
define('IMAGE_NEW_TAX_CLASS', 'Neue Steuerklasse erstellen');
define('IMAGE_NEW_TAX_RATE', 'Neuen Steuersatz anlegen');
define('IMAGE_NEW_TAX_ZONE', 'Neue Steuerzone erstellen');
define('IMAGE_NEW_ZONE', 'Neues Bundesland einf&uuml;gen');
define('IMAGE_ORDERS', 'Bestellungen');
define('IMAGE_ORDERS_INVOICE', 'Rechnung');
define('IMAGE_ORDERS_PACKINGSLIP', 'Lieferschein');
define('IMAGE_PREVIEW', 'Vorschau');
define('IMAGE_RESET', 'Zur&uuml;cksetzen');
define('IMAGE_RESTORE', 'Zur&uuml;cksichern');
define('IMAGE_SAVE', 'Speichern');
define('IMAGE_SEARCH', 'Suchen');
define('IMAGE_SELECT', 'Ausw&auml;hlen');
define('IMAGE_SEND', 'Versenden');
define('IMAGE_SEND_EMAIL', 'eMail versenden');
define('IMAGE_UNLOCK', 'Entsperren');
define('IMAGE_UPDATE', 'Aktualisieren');
define('IMAGE_UPDATE_CURRENCIES', 'Wechselkurse aktualisieren');
define('IMAGE_UPLOAD', 'Hochladen');

define('ICON_CROSS', 'Falsch');
define('ICON_CURRENT_FOLDER', 'aktueller Ordner');
define('ICON_DELETE', 'L&ouml;schen');
define('ICON_ERROR', 'Fehler');
define('ICON_FILE', 'Datei');
define('ICON_FILE_DOWNLOAD', 'Herunterladen');
define('ICON_FOLDER', 'Ordner');
define('ICON_LOCKED', 'Gesperrt');
define('ICON_PREVIOUS_LEVEL', 'Vorherige Ebene');
define('ICON_PREVIEW', 'Vorschau');
define('ICON_STATISTICS', 'Statistik');
define('ICON_SUCCESS', 'Erfolg');
define('ICON_TICK', 'Wahr');
define('ICON_UNLOCKED', 'Entsperrt');
define('ICON_WARNING', 'Warnung');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seite %s von %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bannern)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> L&auml;ndern)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Kunden)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> W&auml;hrungen)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Sprachen)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Herstellern)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Rundschreiben)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bestellungen)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bestellstatus)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> erwarteten Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bewertungen)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Sonderangeboten)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Steuerklassen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Steuerzonen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Steuers&auml;tzen)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Angezeigt werden <b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bundesl&auml;ndern)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'Standard');
define('TEXT_SET_DEFAULT', 'als Standard definieren');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* erforderlich</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Fehler: Es wurde keine Standardw&auml;hrung definiert. Bitte definieren Sie unter Adminstration -> Sprachen/W&auml;hrungen -> W&auml;hrungen eine Standardw&auml;hrung.');

define('TEXT_CACHE_CATEGORIES', 'Kategorien Box');
define('TEXT_CACHE_MANUFACTURERS', 'Hersteller Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Modul f&uuml;r ebenfalls gekaufte Artikel');

define('TEXT_NONE', '--keine--');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destination not writeable.');
define('ERROR_FILE_NOT_SAVED', 'Error: File upload not saved.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: File upload type not allowed.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Warning: No file uploaded.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: File uploads are disabled in the php.ini configuration file.');

// Easy polulate
define('BOX_CATALOG_IMP_EXP', 'Utility Import Export');
// END
define('BOX_CUSTOMERS_BIRTHDAY', 'Geburtstage');

// stat v3
  define('BOX_HEADING_STORE_STATISTICS','Store statistics');
  define('BOX_TOOLS_STORE_STATISTICS','Store statistics');
  define('BOX_TOOLS_ORDERS_STATISTICS','Orders statistics');
  define('BOX_TOOLS_PRODUCTS_STATISTICS','Products statistics');
// end

define('IMAGE_EXCLUDE', 'Exclude');
define('BOX_TOOLS_SITEMAP', 'Sitemap');

// Google SiteMap BEGIN
define('BOX_GOOGLE_SITEMAP', 'Google SiteMaps');
// Google SiteMap END

define('BOX_TOOLS_PAGE_MANAGER', 'Extra info Pages Manager');
define('TEXT_DISPLAY_NUMBER_OF_PAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> Pages)');

define('BOX_REPORTS_MISSING_PICS', 'Missing Pictures');

// easy price
define('BOX_CATALOG_PRODUCTS_UPDATE', 'Update Prices/Stock');

//PIVACF start
define('ENTRY_PIVA', 'VAT Number:');
define('ENTRY_CF', 'Tax Identification Number:');
define('JS_PIVA', 'VAT Number Required');
define('JS_CF', 'Tax Identification Number Required');
//PIVACF end

        /* Optional Related Products (ORP) */
        define('BOX_CATALOG_CATEGORIES_RELATED_PRODUCTS', 'Related Products');
        define('IMAGE_BUTTON_NEW_INSTALL_SQL', 'Install SQL for New Install of Related Products, Version 4.0');
        define('IMAGE_BUTTON_UPGRADE_SQL', 'Update SQL for Upgrade Install of Related Products, Version 4.0');
        define('IMAGE_BUTTON_REMOVE_SQL', 'Remove SQL for all versions of Related Products');
        /***********************************/

define('WARNING_ADMIN_NOTES_TIME', '<b>Warning:</b> A notice exceeded its reminder datetime!');

// Extra Product Fields
define('TEXT_NOT_APPLY', 'Does Not Apply');
define('BOX_CATALOG_PRODUCTS_EXTRA_FIELDS', 'Extra Product Fields');
define('BOX_CATALOG_PRODUCTS_EXTRA_VALUES', 'Extra Field Values');
define('BOX_CATALOG_PRODUCTS_PTYPES', 'Product Types');
define('TEXT_PTYPE', 'Product Type:');
?>
<?php
  define('TEXT_MONTHS_01_NAME', 'Januar');
  define('TEXT_MONTHS_02_NAME', 'Februar');
  define('TEXT_MONTHS_03_NAME', 'M&aulm;rz');
  define('TEXT_MONTHS_04_NAME', 'April');
  define('TEXT_MONTHS_05_NAME', 'Mai');
  define('TEXT_MONTHS_06_NAME', 'Juni');
  define('TEXT_MONTHS_07_NAME', 'Juli');
  define('TEXT_MONTHS_08_NAME', 'August');
  define('TEXT_MONTHS_09_NAME', 'September');
  define('TEXT_MONTHS_10_NAME', 'Oktober');
  define('TEXT_MONTHS_11_NAME', 'November');
  define('TEXT_MONTHS_12_NAME', 'Dezember');

  define('TEXT_WEEK_00_NAME', 'Sonntag');
  define('TEXT_WEEK_01_NAME', 'Montag');
  define('TEXT_WEEK_02_NAME', 'Dienstag');
  define('TEXT_WEEK_03_NAME', 'Mittwoch');
  define('TEXT_WEEK_04_NAME', 'Donnerstag');
  define('TEXT_WEEK_05_NAME', 'Freitag');
  define('TEXT_WEEK_06_NAME', 'Samstag');
?>