<?php
/*
  $Id: index.php,v 1.1 2003/06/11 17:38:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce 

  Released under the GNU General Public License 
*/

define('TEXT_MAIN', 'inserire qui i contenuti');
define('TABLE_HEADING_NEW_PRODUCTS', 'Nuovi prodotti per %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Prodotti in arrivo');
define('TABLE_HEADING_DATE_EXPECTED', 'Data di arrivo');

if ( ($category_depth == 'products') || (isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'Vediamo cosa c\'è qui');
  define('TABLE_HEADING_IMAGE', 'Copertina');
  define('TABLE_HEADING_MODEL', 'Codice');
  define('TABLE_HEADING_PRODUCTS', 'Titolo');
  define('TABLE_HEADING_MANUFACTURER', 'Editore');
  define('TABLE_HEADING_QUANTITY', 'Quantità');
  define('TABLE_HEADING_PRICE', 'Prezzo Nuovo');
  define('TABLE_HEADING_PRICE_USED', 'Prezzo Usato');
  define('TABLE_HEADING_WEIGHT', 'Dimensioni');
  define('TABLE_HEADING_BUY_NOW', 'Acquista adesso');
  define('TEXT_NO_PRODUCTS', 'Non ci sono prodotti in questa categoria.');
  define('TEXT_NO_PRODUCTS2', 'Non ci sono prodotti per questo produttore.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Numero di prodotti: ');
  define('TEXT_SHOW', '<b>Mostra:</b>');
  define('TEXT_BUY', 'Acquista 1 \'');
  define('TEXT_NOW', '\' Ora');
  define('TEXT_ALL_CATEGORIES', 'Tutte le categoria');
  define('TEXT_ALL_MANUFACTURERS', 'Tutti gli editori');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'TOP 10 dei più venduti.');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Categorie');
}
?>
