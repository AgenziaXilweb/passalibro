<?php
define('BOX_REPORTS_PRODUCTS_MONITOR', 'Product Monitor');

define('BOX_REPORTS_SUPERTRACKER', 'Supertracker');

define('BOX_VISITORS', 'Visitors');
define('TEXT_DISPLAY_NUMBER_OF_ENTRIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> entries)');

// Documents Manager
define('BOX_CATALOG_DOCUMENTS', 'Document Manager');

define('BOX_REPORTS_MARGIN_REPORT', 'Margin Report');

define('BOX_HEADING_INFORMATION', 'Information');
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
define('HEADER_TITLE_ACCOUNT', 'My Account');
define('HEADER_TITLE_LOGOFF', 'Logoff');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', 'My Account');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrator');
define('BOX_ADMINISTRATOR_MEMBERS', 'Member Groups');
define('BOX_ADMINISTRATOR_MEMBER', 'Members');
define('BOX_ADMINISTRATOR_BOXES', 'File Access');

// images
define('IMAGE_FILE_PERMISSION', 'File Permission');
define('IMAGE_GROUPS', 'Groups List');
define('IMAGE_INSERT_FILE', 'Insert File');
define('IMAGE_MEMBERS', 'Members List');
define('IMAGE_NEW_GROUP', 'New Group');
define('IMAGE_NEW_MEMBER', 'New Member');
define('IMAGE_NEXT', 'Next');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> filenames)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> members)');
//Admin end

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
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
define('HTML_PARAMS','dir="ltr" lang="ro"');

// charset for web pages and emails
define('CHARSET', 'Iso-8859-16');

// page title
define('TITLE', 'osCommerce');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administrare');
define('HEADER_TITLE_SUPPORT_SITE', 'Site de Suport (osCommerce)');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catalog Online');
define('HEADER_TITLE_ADMINISTRATION', 'Administrare');

// text for gender
define('MALE', 'Masculin');
define('FEMALE', 'Feminin');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configurare');
define('BOX_CONFIGURATION_MYSTORE', 'Magazinul meu');
define('BOX_CONFIGURATION_LOGGING', 'Logare');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Module');
define('BOX_MODULES_PAYMENT', 'Plata');
define('BOX_MODULES_SHIPPING', 'Livrare');
define('BOX_MODULES_ORDER_TOTAL', 'Total comanda');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorii/Produse');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Create Attributes');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_MANAGER', 'Associated Attributes/Articles');
define('BOX_CATALOG_MANUFACTURERS', 'Producatori');
define('BOX_CATALOG_REVIEWS', 'Opinii');
define('BOX_CATALOG_SPECIALS', 'Promotii');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Produse Asteptate');
define('BOX_CATALOG_UPLOAD_FILE', 'Upload free file');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clienti');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clienti');
define('BOX_CUSTOMERS_ORDERS', 'Comenzi');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locatii / Taxe');
define('BOX_TAXES_COUNTRIES', 'Tari');
define('BOX_TAXES_ZONES', 'Zone');
define('BOX_TAXES_GEO_ZONES', 'Tax Zones');
define('BOX_TAXES_TAX_CLASSES', 'Tax Classes');
define('BOX_TAXES_TAX_RATES', 'Valoare Taxe');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Repoarte');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Produse Vazute');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Produse Cumparate');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total-Comenzi Client');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Unelte');
define('BOX_TOOLS_BACKUP', 'Backup Baza de Date');
define('BOX_TOOLS_BANNER_MANAGER', 'Manager Bannere');
define('BOX_TOOLS_CACHE', 'Control Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Defineste Limba');
define('BOX_TOOLS_MAIL', 'Trimite Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Manager Stiri');
define('BOX_TOOLS_SERVER_INFO', 'Informatii Server');
define('BOX_TOOLS_WHOS_ONLINE', 'Cine e Online');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localizare');
define('BOX_LOCALIZATION_CURRENCIES', 'Valuta');
define('BOX_LOCALIZATION_LANGUAGES', 'Limba');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Status Comanda');

// javascript messages
define('JS_ERROR', 'Au aparut erori in procesarea comenzii!\nVa rog sa faceti urmatoarele corectari:\n\n');

define('JS_REVIEW_TEXT', '* \'Textul recenziei\' trebuie s&#259; aib&#259; cel pu&#355;in ' . REVIEW_TEXT_MIN_LENGTH . ' caractere.\n ');
define('JS_REVIEW_RATING', '* Trebuie s&#259; ad&#259;uga&#355;i o not&#259; la aceast&#259; recenzie.\n');

define('JS_OPTIONS_VALUE_PRICE', '* Noul produs are nevoie de pret\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Noul produs are nevoie de un prefix de pret\n');

define('JS_PRODUCTS_NAME', '* Noul produs are nevoie de un nume\n');
define('JS_PRODUCTS_DESCRIPTION', '* Noul produs are nevoie de descriere\n');
define('JS_PRODUCTS_PRICE', '* Noul produs are nevoie de un pret\n');
define('JS_PRODUCTS_WEIGHT', '* Noul produs are nevoie de o masa (greutate)\n');
define('JS_PRODUCTS_QUANTITY', '* Noul produs are nevoie de o cantitate\n');
define('JS_PRODUCTS_MODEL', '* Noul produs are nevoie de un nr de model\n');
define('JS_PRODUCTS_IMAGE', '* Noul produs are nevoie de o cale catre imagine\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Un nou pret trebuie stabilit pentru acest produs\n');

define('JS_GENDER', '* Genul trebuie ales (masculin/feminin)\n');
define('JS_FIRST_NAME', '* Valoarea numelui trebuie sa fie mai mare de ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caractere.\n');
define('JS_LAST_NAME', '* Valoarea prenumelui trebuie sa fie mai mare de ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caractere.\n');
define('JS_DOB', '* Data nesterii trebuie sa fie in format: xx/xx/xxxx (zi/luna/an).\n');
define('JS_EMAIL_ADDRESS', '* Adresa de Email trebuie sa aiba macar ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caractere.\n');
define('JS_ADDRESS', '* Valoarea strazii trebuie sa aiba macar ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caractere.\n');
define('JS_POST_CODE', '* Codul postal trebuie sa aiba macar ' . ENTRY_POSTCODE_MIN_LENGTH . ' caractere.\n');
define('JS_CITY', '* Orasul trebuie sa aiba macar ' . ENTRY_CITY_MIN_LENGTH . ' caractere.\n');
define('JS_STATE', '* Judetul trebuie selectat.\n');
define('JS_STATE_SELECT', '-- Selectati Deasupra --');
define('JS_ZONE', '* Judetul/statul trebuie selectat din lista pentru aceasta tara');
define('JS_COUNTRY', '* Tara trebuie aleasa.\n');
define('JS_TELEPHONE', '* Numarul de telefon trebuie sa aiba minim ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caractere.\n');
define('JS_PASSWORD', '* Casutele \'Parola\' si \'Confirmare\' trebuie sa corespunda una cu alta si sa aiba minim ' . ENTRY_PASSWORD_MIN_LENGTH . ' caractere.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Numarul comenzii %s nu exista!');

define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Adresa');
define('CATEGORY_CONTACT', 'Contact');
define('CATEGORY_COMPANY', 'Companie');
define('CATEGORY_OPTIONS', 'Optiuni');

define('ENTRY_GENDER', 'Gen:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">required</span>');
define('ENTRY_FIRST_NAME', 'Nume:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_LAST_NAME', 'Prenume:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_DATE_OF_BIRTH', 'Data nasterii:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 31/01/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'Adresa E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Adresa de Email nu pare valida!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Adresa de Email exista deja in baza de date!</span>');
define('ENTRY_COMPANY', 'Numele Companiei:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Strada:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_SUBURB', 'Suburbie:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Cod Postal:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</span>');
define('ENTRY_CITY', 'Oras:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' chars</span>');
define('ENTRY_STATE', 'Judet/stat:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">required</span>');
define('ENTRY_COUNTRY', 'Tara:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Numar de Telefon:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</span>');
define('ENTRY_FAX_NUMBER', 'Number de Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Abonare Stiri:');
define('ENTRY_NEWSLETTER_YES', 'Abonare');
define('ENTRY_NEWSLETTER_NO', 'Ne-abonare');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Trimitere E-Mail');
define('IMAGE_BACK', 'Inapoi');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_CANCEL', 'Renunta');
define('IMAGE_CONFIRM', 'Confirma');
define('IMAGE_COPY', 'Copiaza');
define('IMAGE_COPY_TO', 'Copiaza in');
define('IMAGE_DETAILS', 'Detalii');
define('IMAGE_DELETE', 'Sterge');
define('IMAGE_EDIT', 'Editeaza');
define('IMAGE_EDIT_ATTRIBUTE', 'Edit Attribute');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_ICON_STATUS_GREEN', 'Activ');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Seteaza Activ');
define('IMAGE_ICON_STATUS_RED', 'Inactiv');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Seteaza Inactiv');
define('IMAGE_ICON_INFO', 'Informatii');
define('IMAGE_INSERT', 'Insereaza');
define('IMAGE_LOCK', 'Ingheata');
define('IMAGE_MODULE_INSTALL', 'Instaleaza Modul');
define('IMAGE_MODULE_REMOVE', 'Indeparteaza Modul');
define('IMAGE_MOVE', 'Muta');
define('IMAGE_NEW_BANNER', 'Banner nou');
define('IMAGE_NEW_CATEGORY', 'Categorie Noua');
define('IMAGE_NEW_COUNTRY', 'Tara Noua');
define('IMAGE_NEW_CURRENCY', 'Valuta noua');
define('IMAGE_NEW_FILE', 'Fisier nou');
define('IMAGE_NEW_FOLDER', 'Folder nou');
define('IMAGE_NEW_LANGUAGE', 'Adauga Limba');
define('IMAGE_NEW_NEWSLETTER', 'Adauga Stire');
define('IMAGE_NEW_PRODUCT', 'Adauga Produs');
define('IMAGE_NEW_TAX_CLASS', 'Adauga Tax Class');
define('IMAGE_NEW_TAX_RATE', 'Adauga Valoare Taxa');
define('IMAGE_NEW_TAX_ZONE', 'Adauga Tax Zone');
define('IMAGE_NEW_ZONE', 'Zona noua');
define('IMAGE_ORDERS', 'Comenzi');
define('IMAGE_ORDERS_INVOICE', 'Factura');
define('IMAGE_ORDERS_PACKINGSLIP', 'Lista de produse');
define('IMAGE_PREVIEW', 'Preview');
define('IMAGE_RESTORE', 'Restaureaza');
define('IMAGE_RESET', 'Reseteaza');
define('IMAGE_SAVE', 'Salveaza');
define('IMAGE_SEARCH', 'Cauta');
define('IMAGE_SELECT', 'Selecteaza');
define('IMAGE_SEND', 'Trimite');
define('IMAGE_SEND_EMAIL', 'Trimite Email');
define('IMAGE_UNLOCK', 'Descuie');
define('IMAGE_UPDATE', 'Updateaza');
define('IMAGE_UPDATE_CURRENCIES', 'Updateaza cursul valutar');
define('IMAGE_UPLOAD', 'Uploadeaza');

define('ICON_CROSS', 'Fals');
define('ICON_CURRENT_FOLDER', 'Folder-ul curent');
define('ICON_DELETE', 'Sterge');
define('ICON_ERROR', 'Eroare');
define('ICON_FILE', 'Fisier');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Folder');
define('ICON_LOCKED', 'Incuiat');
define('ICON_PREVIOUS_LEVEL', 'Nivelul dinainte');
define('ICON_PREVIEW', 'Preview');
define('ICON_STATISTICS', 'Statistici');
define('ICON_SUCCESS', 'Succes');
define('ICON_TICK', 'Adevarat');
define('ICON_UNLOCKED', 'Descuiat');
define('ICON_WARNING', 'Atentie!');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Pagina %s din %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> bannere)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> tari)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> clienti)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> valute)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> limbi)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> producatori)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> stiri)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> comenzi)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> statusuri comenzi)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> produse)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> produse asteptate)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> descrieri de produse)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> promotii)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> tax classes)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> tax zones)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> valori de taxe)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Arat <b>%d</b> to <b>%d</b> (of <b>%d</b> zone)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'standard');
define('TEXT_SET_DEFAULT', 'Seteaza standard');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Cerut</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Eroare: Nu este stabilita valuta. Va rog stabiliti la: Unelte de Administrare->Localizare->Valute');

define('TEXT_CACHE_CATEGORIES', 'Sectiune Categorii');
define('TEXT_CACHE_MANUFACTURERS', 'Sectiune Producatori');
define('TEXT_CACHE_ALSO_PURCHASED', 'Module deja cumparate');

define('TEXT_NONE', '--nimic--');
define('TEXT_TOP', 'Sus');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Eroare: Destinatia nu exista.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Eroare: Destinatia nu poate fi scrisa.');
define('ERROR_FILE_NOT_SAVED', 'Eroare: Fisierul nu poate fi uploadat.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Eroare: Tipul fisierului de uploadat nu este suportat.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Succes: Fisierul a fost uploadat pe site.');
define('WARNING_NO_FILE_UPLOADED', 'Atentie: Nici un fisier uploadat.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Atentie: Uploadurile sunt restrictionate din fisierul php.ini .');

// Easy polulate
define('BOX_CATALOG_IMP_EXP', 'Utility Import Export');
// END
define('BOX_CUSTOMERS_BIRTHDAY', 'birthday');

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
  define('TEXT_MONTHS_01_NAME', 'ianuarie');
  define('TEXT_MONTHS_02_NAME', 'februarie');
  define('TEXT_MONTHS_03_NAME', 'martie');
  define('TEXT_MONTHS_04_NAME', 'aprilie');
  define('TEXT_MONTHS_05_NAME', 'mai');
  define('TEXT_MONTHS_06_NAME', 'iunie');
  define('TEXT_MONTHS_07_NAME', 'iulie');
  define('TEXT_MONTHS_08_NAME', 'august');
  define('TEXT_MONTHS_09_NAME', 'septembrie');
  define('TEXT_MONTHS_10_NAME', 'octombrie');
  define('TEXT_MONTHS_11_NAME', 'noiembrie');
  define('TEXT_MONTHS_12_NAME', 'decembrie');

  define('TEXT_WEEK_00_NAME', 'duminic&#259;');
  define('TEXT_WEEK_01_NAME', 'luni');
  define('TEXT_WEEK_02_NAME', 'mar&#355;i');
  define('TEXT_WEEK_03_NAME', 'miercuri');
  define('TEXT_WEEK_04_NAME', 'joi');
  define('TEXT_WEEK_05_NAME', 'vineri');
  define('TEXT_WEEK_06_NAME', 's&acirc;mb&#259;t&#259;');
?>