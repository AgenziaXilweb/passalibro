<?php
 define('TEXT_PRODUCTS_COST_INFO', 'Cost: ');
 define('TEXT_PRODUCTS_PROFIT_INFO', 'Profit:');
 define('TEXT_PRODUCTS_PRICE_COST', 'Products Price (Cost):');
//
define('ENTRY_PRODUCTS_PRICE', 'Product Price #');
define('ENTRY_PRODUCTS_PRICE_DISABLED', 'disabled');
//

// multi images
define('TEXT_PRODUCTS_IMAGE_EXTRA', 'Products Extra Image #');
define('TEXT_DELETE_IMAGE', 'Delete image');

define('HEADING_TITLE', 'Kategorien / Artikel');
define('HEADING_TITLE_SEARCH', 'Suche: ');
define('HEADING_TITLE_GOTO', 'Gehe zu:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorien / Artikel');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_EVIDENCE_STATUS', 'Evidence');

define('TEXT_NEW_PRODUCT', 'Neuer Artikel in ');
define('TEXT_CATEGORIES', 'Kategorien:');
define('TEXT_SUBCATEGORIES', 'Unterkategorien:');
define('TEXT_PRODUCTS', 'Artikel:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preis:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuerklasse:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'durchschnittl. Bewertung:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Anzahl:');
define('TEXT_DATE_ADDED', 'hinzugef&uuml;gt am:');
define('TEXT_DATE_AVAILABLE', 'Erscheinungsdatum:');
define('TEXT_LAST_MODIFIED', 'letzte &Auml;nderung:');
define('TEXT_IMAGE_NONEXISTENT', 'BILD EXISTIERT NICHT');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte f&uuml;gen Sie eine neue Kategorie oder einen Artikel ein.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'F&uuml;r weitere Informationen, besuchen Sie bitte die <a href="http://%s" >Homepage</a> des Herstellers.');
define('TEXT_PRODUCT_DATE_ADDED', 'Diesen Artikel haben wir am %s in unseren Katalog aufgenommen.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dieser Artikel ist erh&auml;ltlich ab %s.');

define('TEXT_EDIT_INTRO', 'Bitte f&uuml;hren Sie alle notwendigen &Auml;nderungen durch.');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategorie ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategorie Name:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Kategorie Bild:');
define('TEXT_EDIT_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_INFO_COPY_TO_INTRO', 'Bitte w&auml;hlen Sie eine neue Kategorie aus, in die Sie den Artikel kopieren m&ouml;chten:');
define('TEXT_INFO_CURRENT_CATEGORIES', 'aktuelle Kategorien:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie bearbeiten');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie l&ouml;schen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Artikel l&ouml;schen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Artikel verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieren nach');

define('TEXT_DELETE_CATEGORY_INTRO', 'Sind Sie sicher, dass Sie diese Kategorie l&ouml;schen m&ouml;chten?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Sind Sie sicher, dass Sie diesen Artikel l&ouml;schen m&ouml;chten?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>WARNUNG:</b> Es existieren noch %s (Unter-)Kategorien, die mit dieser Kategorie verbunden sind!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNUNG:</b> Es existieren noch %s Artikel, die mit dieser Kategorie verbunden sind!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte w&auml;hlen Sie die &uuml;bergordnete Kategorie, in die Sie <b>%s</b> verschieben m&ouml;chten');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte w&auml;hlen Sie die &uuml;bergordnete Kategorie, in die Sie <b>%s</b> verschieben m&ouml;chten');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> nach:');

define('TEXT_NEW_CATEGORY_INTRO', 'Bitte geben Sie die neue Kategorie mit allen relevanten Daten ein.');
define('TEXT_CATEGORIES_NAME', 'Kategorie Name:');
define('TEXT_CATEGORIES_IMAGE', 'Kategorie Bild:');
define('TEXT_SORT_ORDER', 'Sortierreihenfolge:');

define('TEXT_PRODUCTS_STATUS', 'Produktstatus:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Erscheinungsdatum:');
define('TEXT_PRODUCT_AVAILABLE', 'auf Lager');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'nicht vorr&auml;tig');
define('TEXT_PRODUCTS_MANUFACTURER', 'Artikel-Hersteller:');
define('TEXT_PRODUCTS_NAME', 'Artikelname:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Artikelbeschreibung:');
define('TEXT_PRODUCTS_QUANTITY', 'Artikelanzahl:');
define('TEXT_PRODUCTS_MODEL', 'Artikel-Nr.:');
define('TEXT_PRODUCTS_IMAGE', 'Artikelbild:');
define('TEXT_PRODUCTS_URL', 'Herstellerlink:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(ohne f&uuml;hrendes http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Artikelpreis (Netto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Artikelpreis (Brutto):');
define('TEXT_PRODUCTS_WEIGHT', 'Artikelgewicht:');

define('EMPTY_CATEGORY', 'Leere Kategorie');

define('TEXT_HOW_TO_COPY', 'Kopiermethode:');
define('TEXT_COPY_AS_LINK', 'Produkt verlinken');
define('TEXT_COPY_AS_DUPLICATE', 'Produkt duplizieren');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Fehler: Produkte k&ouml;nnen nicht in der gleichen Kategorie verlinkt werden.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das Verzeichnis \'images\' im Katalogverzeichnis ist schreibgesch&uuml;tzt: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das Verzeichnis \'images\' im Katalogverzeichnis ist nicht vorhanden: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: Category cannot be moved into child category.');
define('TEXT_EDIT_STATUS', 'Status Category');
define('TEXT_CATEGORIES_DESC', 'Description category');

  define('TEXT_PRODUCTS_HEIGHT', 'Height:');
  define('TEXT_PRODUCTS_LENGTH', 'Length:');
  define('TEXT_PRODUCTS_WIDTH', 'Width:');
  define('TEXT_PRODUCTS_READY_TO_SHIP', 'Ready to ship:');
  define('TEXT_PRODUCTS_READY_TO_SHIP_SELECTION', 'Product can be shipped in its own container.');
  define('TEXT_PRODUCTS_CODEBAR', 'CODE-BAR:');

  define('TEXT_PRODUCTS_RSS', 'Add this article "out" (it will appear in the box at the top of homepage)');

  define('TEXT_PRODUCTS_ATTRIBUTE_BOX', 'Size and weight including packaging article: (WARNING: the values are used for the calculation of transport!) <br /> NB.utile if they would be sealed in blister or if they are included its own package. ');
  define('TEXT_PRODUCTS_INFO_WEIGHT', 'Product weight without packaging:');
  define('TEXT_PRODUCTS_INFO_LENGTH', 'Length of the product without packaging:');
  define('TEXT_PRODUCTS_INFO_WIDTH', 'Depth of the product without packaging:');
  define('TEXT_PRODUCTS_INFO_HEIGHT', 'Height of the product without packaging:');
  define('TEXT_PRODUCTS_ATTRIBUTE_INFO', 'part dimensions and weights without packaging: <br /> NB. If you do not put a value will be taken into account the value of the package above');

define('TEXT_EXTRA_FIELDS', 'If any of the following extra fields do not apply to this product leave them blank if it is a text or checkbox field or set to &ldquo;Does Not Apply&rdquo; if it is a drop down list or radio button field.');
?>