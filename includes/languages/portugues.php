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

define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
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
define('HTML_PARAMS','dir="ltr" lang="en"');

// charset for web pages and emails
define('CHARSET', 'Iso-8859-16');

// page title
define('TITLE', 'osCommerce');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administra&ccedil;&atilde;o');
define('HEADER_TITLE_SUPPORT_SITE', 'Suporte');
define('HEADER_TITLE_ONLINE_CATALOG', 'Cat&aacute;logo On-line');
define('HEADER_TITLE_ADMINISTRATION', 'Administra&ccedil;&atilde;o');

// text for gender
define('MALE', 'Masculino');
define('FEMALE', 'Feminino');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configura&ccedil;&atilde;o');
define('BOX_CONFIGURATION_MYSTORE', 'A minha loja');
define('BOX_CONFIGURATION_LOGGING', 'A entrar');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'M&oacute;dulos');
define('BOX_MODULES_PAYMENT', 'Pagamento');
define('BOX_MODULES_SHIPPING', 'Envio');
define('BOX_MODULES_ORDER_TOTAL', 'Valor Total');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Cat&aacute;logo');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorias/Produtos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Create Attributes');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES_MANAGER', 'Associated Attributes/Articles');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes');
define('BOX_CATALOG_REVIEWS', 'Coment&aacute;rios');
define('BOX_CATALOG_SPECIALS', 'Especiais');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Produtos esperados (?)');
define('BOX_CATALOG_UPLOAD_FILE', 'Upload free file');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_ORDERS', 'Encomendas');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locais / Taxas');
define('BOX_TAXES_COUNTRIES', 'Pa&iacute;ses');
define('BOX_TAXES_ZONES', 'Zonas');
define('BOX_TAXES_GEO_ZONES', 'Impostos Zona');
define('BOX_TAXES_TAX_CLASSES', 'Impostos Classes');
define('BOX_TAXES_TAX_RATES', 'Imposto %');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Relat&oacute;rios');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Produtos Visualizados');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Produtos Comprados');
define('BOX_REPORTS_ORDERS_TOTAL', 'Encomendas Cliente');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Tools');
define('BOX_TOOLS_BACKUP', 'C&oacute;pia de Seguran&ccedil;a');
define('BOX_TOOLS_BANNER_MANAGER', 'Gest&atilde;o do <i></i>Banner</i>');
define('BOX_TOOLS_CACHE', 'Controlo da Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definir Idioma');
define('BOX_TOOLS_MAIL', 'Enviar email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gest&atilde;o do Boletim de Not&iacute;cias');
define('BOX_TOOLS_SERVER_INFO', 'Informa&ccedil;&atilde;o do Servidor');
define('BOX_TOOLS_WHOS_ONLINE', 'Quem est&aacute; online');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localiza&ccedil;&atilde;o');
define('BOX_LOCALIZATION_CURRENCIES', 'Moedas');
define('BOX_LOCALIZATION_LANGUAGES', 'idiomas');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Estado das Encomendas');

// javascript messages
define('JS_ERROR', 'Ocorreram erros durante o processamento do formul&aacute;rio!\nEfectue as seguintes correc&ccedil;&otilde;es sff.:\n\n');

define('JS_REVIEW_TEXT', '* O \'Coment&aacute;rio\' tem de ter pelo menos ' . REVIEW_TEXT_MIN_LENGTH . ' letras.\n');
define('JS_REVIEW_RATING', '* Tem de pontuar o artigo (de 1 a 5 estrelas).\n');

define('JS_OPTIONS_VALUE_PRICE', '* O novo atributo de produto necessita um pre&ccedil;o.\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* O novo atributo de produto necessita um prefixo para o pre&ccedil;o.\n');

define('JS_PRODUCTS_NAME', '* O novo produto necessita um nome.\n');
define('JS_PRODUCTS_DESCRIPTION', '* O novo produto necessita descri&ccedil;&atilde;o.\n');
define('JS_PRODUCTS_PRICE', '* O novo produto necessita um pre&ccedil;o.\n');
define('JS_PRODUCTS_WEIGHT', '* O novo produto necessita um peso.\n');
define('JS_PRODUCTS_QUANTITY', '* O novo produto necessita uma quantidade.\n');
define('JS_PRODUCTS_MODEL', '* O novo produto necessita um modelo.\n');
define('JS_PRODUCTS_IMAGE', '* O novo produto necessita uma imagem.\n');

define('JS_SPECIALS_PRODUCTS_PRICE', 'Um novo pre&ccedil;o para este produto necessita ser definido.\n');

define('JS_GENDER', '* Tem de indicar o \'Sexo\'.\n');
define('JS_FIRST_NAME', '* O \'Nome\' tem de conter pelo menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_LAST_NAME', '* O \'Apelido\' tem de conter pelo menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_DOB', '* A \'Data de Nascimento\' tem que estar indicado no formato: xx/xx/xxxx (dia/m&ecirc;s/ano).\n');
define('JS_EMAIL_ADDRESS', '* O \'Endere&ccedil;o de E-Mail \' tem de conter pelo menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS', '* A \'Morada\' tem de conter pelo menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_POST_CODE', '* O \'C&oacute;digo Postal\' tem de conter pelo menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.\n');
define('JS_CITY', '* A \'Cidade\' tem de conter pelo menos ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.\n');
define('JS_STATE', '* O \'Distrito/Estado\' tem de ser indicado.\n');
define('JS_STATE_SELECT', '-- Seleccione Abaixo --');
define('JS_ZONE', '* O \'Distrito/Estado\' tem que ser escolhido da lista para o pa&iacute;s.');
define('JS_COUNTRY', '* O \'Pa&iacute;s\' tem que ser indicado.\n');
define('JS_TELEPHONE', '* O \'Telefone\' tem de conter pelo menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.\n');
define('JS_PASSWORD', '* The \'Palavra Passe\' e \'Confirma&ccedil;&atilde;o\' t&ecirc;em de coincidir e conter pelo menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'A Encomenda N&uacute;mero %s n&atilde;o existe!');

define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Address');
define('CATEGORY_CONTACT', 'Contact');
define('CATEGORY_COMPANY', 'Company');
define('CATEGORY_OPTIONS', 'Options');

define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">obrigat&oacute;rio</span>');
define('ENTRY_FIRST_NAME', 'Nome:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min&iacute;mo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_LAST_NAME', 'Last Nome:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min&iacute;mo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_DATE_OF_BIRTH', 'Data de Nascimento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(ex. 31/01/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'Endere&ccedil;o E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min&iacute;mo ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">O endere&ccedil;o de email parece n&atilde;o ser v&aacute;lido!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Este endere&ccedil;o de email j&aacute; existe!</span>');
define('ENTRY_COMPANY', 'Empresa:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Morada:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min&iacute;mo ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'C&oacute;digo Postal:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min&iacute;mo ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_CITY', 'Cidade:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min&iacute;mo ' . ENTRY_CITY_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_STATE', 'Distrito/Estado:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">obrigat&oacute;rio</span>');
define('ENTRY_COUNTRY', 'Pa&iacute;s:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefone:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min&iacute;mo ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres</span>');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Boletim de Not&iacute;cias:');
define('ENTRY_NEWSLETTER_YES', 'Subscrito');
define('ENTRY_NEWSLETTER_NO', 'N&atilde;o subscrito');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Sending E-Mail');
define('IMAGE_BACK', 'Back');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_CANCEL', 'Cancel');
define('IMAGE_CONFIRM', 'Confirm');
define('IMAGE_COPY', 'Copy');
define('IMAGE_COPY_TO', 'Copy To');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'Delete');
define('IMAGE_EDIT', 'Edit');
define('IMAGE_EDIT_ATTRIBUTE', 'Edit Attribute');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_ICON_STATUS_GREEN', 'Active');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Set Active');
define('IMAGE_ICON_STATUS_RED', 'Inactive');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Set Inactive');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Insert');
define('IMAGE_LOCK', 'Lock');
define('IMAGE_MODULE_INSTALL', 'Install Module');
define('IMAGE_MODULE_REMOVE', 'Remove Module');
define('IMAGE_MOVE', 'Move');
define('IMAGE_NEW_BANNER', 'New Banner');
define('IMAGE_NEW_CATEGORY', 'New Category');
define('IMAGE_NEW_COUNTRY', 'New Country');
define('IMAGE_NEW_CURRENCY', 'New Currency');
define('IMAGE_NEW_FILE', 'New File');
define('IMAGE_NEW_FOLDER', 'New Folder');
define('IMAGE_NEW_LANGUAGE', 'New Language');
define('IMAGE_NEW_NEWSLETTER', 'New Newsletter');
define('IMAGE_NEW_PRODUCT', 'New Product');
define('IMAGE_NEW_TAX_CLASS', 'New Tax Class');
define('IMAGE_NEW_TAX_RATE', 'New Tax Rate');
define('IMAGE_NEW_TAX_ZONE', 'New Tax Zone');
define('IMAGE_NEW_ZONE', 'New Zone');
define('IMAGE_ORDERS', 'Orders');
define('IMAGE_ORDERS_INVOICE', 'Invoice');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('IMAGE_PREVIEW', 'Preview');
define('IMAGE_RESTORE', 'Restore');
define('IMAGE_RESET', 'Reset');
define('IMAGE_SAVE', 'Save');
define('IMAGE_SEARCH', 'Search');
define('IMAGE_SELECT', 'Select');
define('IMAGE_SEND', 'Send');
define('IMAGE_SEND_EMAIL', 'Send Email');
define('IMAGE_UNLOCK', 'Unlock');
define('IMAGE_UPDATE', 'Update');
define('IMAGE_UPDATE_CURRENCIES', 'Update Exchange Rate');
define('IMAGE_UPLOAD', 'Upload');

define('ICON_CROSS', 'False');
define('ICON_CURRENT_FOLDER', 'Current Folder');
define('ICON_DELETE', 'Delete');
define('ICON_ERROR', 'Error');
define('ICON_FILE', 'File');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Folder');
define('ICON_LOCKED', 'Locked');
define('ICON_PREVIOUS_LEVEL', 'Previous Level');
define('ICON_PREVIEW', 'Preview');
define('ICON_STATISTICS', 'Statistics');
define('ICON_SUCCESS', 'Success');
define('ICON_TICK', 'True');
define('ICON_UNLOCKED', 'Unlocked');
define('ICON_WARNING', 'Warning');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s of %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> countries)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> customers)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> currencies)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> languages)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> manufacturers)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders status)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products expected)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> product reviews)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products on special)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax classes)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax zones)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax rates)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> zones)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'default');
define('TEXT_SET_DEFAULT', 'Set as default');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Required</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Error: There is currently no default currency set. Please set one at: Administration Tool->Localization->Currencies');

define('TEXT_CACHE_CATEGORIES', 'Categories Box');
define('TEXT_CACHE_MANUFACTURERS', 'Manufacturers Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Also Purchased Module');

define('TEXT_NONE', '--none--');
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
  define('TEXT_MONTHS_01_NAME', 'janeiro');
  define('TEXT_MONTHS_02_NAME', 'fevereiro');
  define('TEXT_MONTHS_03_NAME', 'mar&ccedil;o');
  define('TEXT_MONTHS_04_NAME', 'abril');
  define('TEXT_MONTHS_05_NAME', 'maio');
  define('TEXT_MONTHS_06_NAME', 'junho');
  define('TEXT_MONTHS_07_NAME', 'julho');
  define('TEXT_MONTHS_08_NAME', 'agosto');
  define('TEXT_MONTHS_09_NAME', 'setembro');
  define('TEXT_MONTHS_10_NAME', 'outubro');
  define('TEXT_MONTHS_11_NAME', 'novembro');
  define('TEXT_MONTHS_12_NAME', 'dezembro');

  define('TEXT_WEEK_00_NAME', 'domingo');
  define('TEXT_WEEK_01_NAME', 'segunda-feira');
  define('TEXT_WEEK_02_NAME', 'ter&ccedil;a-feira');
  define('TEXT_WEEK_03_NAME', 'quarta-feira');
  define('TEXT_WEEK_04_NAME', 'quinta-feira');
  define('TEXT_WEEK_05_NAME', 'sexta-feira');
  define('TEXT_WEEK_06_NAME', 's&aacute;bado');
?>