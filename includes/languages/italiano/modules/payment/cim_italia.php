<?php
if (isset($_SESSION['sede'])) {

  $sedi_query = tep_db_query("SELECT * FROM ". TABLE_SEDI . " WHERE " . TABLE_SEDI .".sede = " . $_SESSION['sede']);
  $sedi_check = tep_db_fetch_array($sedi_query);
  
  $risultato = $sedi_check['desc_sede'] . " - " . $sedi_check['via'] . " - " . $sedi_check['citta'] . " - " . $sedi_check['tel'];
  define('MODULE_PAYMENT_CIM_ITALIA_TEXT_TITLE', 'Carta di Credito ( ' . $risultato .' )');
} else {
    
   define('MODULE_PAYMENT_CIM_ITALIA_TEXT_TITLE', 'Carta di Credito (Cim Italia)');

}
  
  define('MODULE_PAYMENT_CIM_ITALIA_TEXT_DESCRIPTION', 'Gateway bancario Cim Italia');
  define('MODULE_PAYMENT_CIM_ITALIA_TEXT_ERROR_MESSAGE', 'Errore nel processare la transazione. Si prega di riprovare.');
?>