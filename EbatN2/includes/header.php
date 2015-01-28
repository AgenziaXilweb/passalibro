<?php

require ('includes/variables.php');
require ('includes/configure.php');
require ('includes/database_table.php');
require ('includes/functions/database.php');
require ('includes/functions/general.php');
require ('includes/ebay_function.php');
require ('includes/ebay_config.php');
require ('includes/ebay_xml_request.php');
require ('includes/ebay_xml_response.php');

// connessione al database MySQL
tep_db_connect();

// set application wide parameters
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);  
  }

// Connessione ad ebay tramite token
    
// prendo i dati da ebay
$param = tep_get_token(MODULE_EBAY_TYPE,$get_sede);

$DurationTime = MODULE_EBAY_TYPE == "sandbox" ? "Days_7" : "GTC";

// seleziono il catalogo ebay della sede attiva
$products_data = tep_db_catalogo_ebay_attivo($param['sede'],(int)$get_pubblicato);
$products_data_passive = tep_db_catalogo_ebay_passivo($param['sede'],(int)$get_pubblicato);
?>