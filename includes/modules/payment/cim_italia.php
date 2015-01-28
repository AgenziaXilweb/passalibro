<?php
/*

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License

  Credits to:

  Marco Spizzichino
  Starfarm Internet Communications srl
  <marco@starfarm.it>

*/

if (isset($_SESSION['sede'])) {
    
    $sede = $_SESSION['sede'];
        
} else {
    
    $sede = 0;
    
}

  class cim_italia {
    var $code, $title, $description, $enabled;

// class constructor
    function cim_italia() {
      global $order, $sede;
      
      switch ($sede) {
  case 2:
    $sede_pagamento =  'payment_280385';
  break;
  case 3:
    $sede_pagamento =  'payment_270269';
  break;
  case 4:
    $sede_pagamento =  'payment_59027913';
  break;
  }
    
if (isset($sede)) {
    
$query_parametri = tep_db_query("SELECT mackey FROM passalibro.param_ecomm where sede = " . $sede . "");

} else {

$query_parametri = tep_db_query("SELECT mackey FROM passalibro.param_ecomm where sede = 0 ");    
    
}

$dati_banca = tep_db_fetch_array($query_parametri);

      
      $this->code = 'cim_italia';
      $this->icon = 'cim_italia.png';
      $this->title = MODULE_PAYMENT_CIM_ITALIA_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_CIM_ITALIA_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_CIM_ITALIA_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_CIM_ITALIA_STATUS == 'Si') ? true : false);
      $this->fees = 0;
      $this->production = ((MODULE_PAYMENT_CIM_ITALIA_PRODUCTION == 'Si') ? true : false);
      $this->alias = $sede_pagamento;
      #$this->alias = MODULE_PAYMENT_CIM_ITALIA_ID;
      $this->tcontab = ((MODULE_PAYMENT_CIM_ITALIA_TCONTAB == 'Immediata') ? 'I' : 'D');
      $this->tautor = ((MODULE_PAYMENT_CIM_ITALIA_TAUTOR == 'Immediata') ? 'I' : 'D');
      $this->chiave_avvio = $dati_banca['mackey'];
      #$this->chiave_avvio = MODULE_PAYMENT_CIM_ITALIA_AVVIO;
      $this->chiave_esito = $dati_banca['mackey'];
      #$this->chiave_esito = MODULE_PAYMENT_CIM_ITALIA_ESITO;

      if ((int)MODULE_PAYMENT_CIM_ITALIA_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_CIM_ITALIA_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

    if($this->production) {
        
    $this->form_action_url = 'https://ecommerce.keyclient.it/ecomm/ecomm/DispatcherServlet';
    
    } else {
    
      $this->alias = 'payment_testm_urlmac';
      $this->chiave_avvio = 'esempiodicalcolomac';
      $this->chiave_esito = 'esempiodicalcolomac';
      $this->form_action_url = 'https://ecommerce.keyclient.it/ecomm/ecomm/DispatcherServlet';
    }
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_CIM_ITALIA_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_CIM_ITALIA_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }

      $this->fees = MODULE_PAYMENT_CIM_ITALIA_FEES;
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title,
                   'icon' => $this->icon);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return false;
    }

    function process_button() {
      global $order, $currencies, $currency, $customer_id, $languages_id;

      // Definizione dei campi per il form di cim_italia
      $myshoplogin = $this->alias;

      if (MODULE_PAYMENT_CIM_ITALIA_CURRENCY == 'Valuta Selezionata') {
        $osc_currency = $currency;
      } else {
        $osc_currency = substr(MODULE_PAYMENT_CIM_ITALIA_CURRENCY, 5);
      }
      if (!in_array($osc_currency, array('EUR', 'GBP', 'USD'))) {
        $osc_currency = 'EUR';
      }

      // Conversion of currencies in ISO codes
      // EUR -> 978, GBP -> 2, USD -> 1

      switch ($osc_currency) {
  case 'EUR':
    $mycurrency =  'EUR';
  break;
  case 'GBP':
    $mycurrency =  'GBP';
  break;
  case 'USD':
    $mycurrency =  'USD';
  break;
  default:
    $mycurrency =  'EUR';
  }

    if ( $this->production ) 
        // verificare che la valuta predefinita siano euro
           $myamount = $order->info['total']*100;
          #$myamount = round($order->info['total'] * $currencies->get_value($osc_currency) * 100);
      else
          /// amount needed for test purposes
          #$myamount = $order->info['total']*100;
          $myamount = 1;

      //id da dare alla transazione... serve per tenere traccia della transazione e verrà scritto sul db
      $myshoptransactionID = $customer_id . '-' . time();

      // Dati utente
      $mybuyername = $order->customer['firstname'] . ' ' . $order->customer['lastname'];
      $mybuyeremail = trim($order->customer['email_address']);

      // Lingua di risposta del gateway

      if(isset($languages_id) && !empty($languages_id))
      {
        $lang_query = tep_db_query("SELECT code FROM " . TABLE_LANGUAGES . " WHERE languages_id = " . $languages_id);
        $lang = tep_db_fetch_array($lang_query);

        switch ($lang['code']) {
    case "it":
      $mylanguage= "ITA";
    break;
    case "en":
      $mylanguage= "ENG";
    break;
    default:
      $mylanguage= "ITA-ENG";
        }
      }
      else
      {
        $mylanguage= "ITA";
      }

      // viene passata l'id di sessione che consente poi di recuperare i valori sotto:
      $mycustominfo = '?' . tep_session_name() . '=' . tep_session_id();

      // Calcola il MAC per i dati che saranno spediti
       $str = 'codTrans=' . $myshoptransactionID .
       'divisa=' . $mycurrency .
       'importo=' . $myamount .
       $this->chiave_avvio;
       
    if($this->production) {
           
    #$MAC = urlencode( base64_encode( md5($str) ) );
    $MAC = urlencode( base64_encode( md5($str) ) );
    
    } else {
       
    $MAC = sha1($str);
    
    #echo "TEST " . $MAC . "<br>";
    }
    


      $process_button_string =
        tep_draw_hidden_field('codTrans', $myshoptransactionID) .
        tep_draw_hidden_field('divisa', $mycurrency) .
        tep_draw_hidden_field('importo', $myamount) .
        tep_draw_hidden_field('alias', $myshoplogin) .
        tep_draw_hidden_field('mail', $mybuyeremail) .
        tep_draw_hidden_field('url_back', HTTP_SERVER . DIR_WS_HTTP_CATALOG . 'checkout_process.php' ) .
        tep_draw_hidden_field('url', HTTP_SERVER . DIR_WS_HTTP_CATALOG . 'checkout_process.php' ).
        tep_draw_hidden_field('session_id',tep_session_id()) .
        tep_draw_hidden_field('languageId', $mylanguage) .
        tep_draw_hidden_field('mac', $MAC);



      return $process_button_string;
    }

    function before_process() {
  // Controlla che il MAC per i dati ricevuti sia corretto
      $str = 'codTrans=' . $_GET['codTrans'] .
             'esito=' . $_GET['esito'] .
             'importo=' . $_GET['importo'] .
             'divisa=' . $_GET['divisa'] .
             'data=' . $_GET['data'] .
             'orario=' . $_GET['orario'] .
             'codAut=' . $_GET['codAut'] .
             $this->chiave_esito;
             
  if( !$this->production ) {
    
    $checkMAC = urlencode( base64_encode( md5($str) ) );
    
  } else {
    
    $checkMAC = sha1($str);
    
    
  }


switch($_GET['esito']){
    
case 'ANNULLO':

$this->after_process();

Header('Location: checkout_payment.php?message=warning');

tep_exit();

break;

case 'KO':

$this->after_process();

Header('Location: checkout_payment.php?message=errore');

tep_exit();

break;
  
case 'ERRORE':

$this->after_process();

Header('Location: checkout_payment.php?message=errore');

tep_exit();
      
break;

case 'OK':

$this->after_process();

Header('Location: checkout_process.php');
    
break;    
   
}

    if( !$this->production )
    
    $order->info['comments'] .= "\nAttenzione:questa e' una transazione di test.";

    return false;
    
    }

    function after_process() {
    global $order, $insert_id, $customer_id;
    // Salvo nel database i parametri della transazione
    $check_query = tep_db_query("select * FROM " . TABLE_ORDERS_CIM_ITALIA . " WHERE bank_transaction_id = '" . $_GET['codTrans'] . "'");
    $check = tep_db_num_rows($check_query);
    if($check > 0) {
      tep_db_query("UPDATE " . TABLE_ORDERS_CIM_ITALIA . " SET client_status = 1, customer_id = " . (int)$customer_id . ", orders_id = " . (int)$insert_id . " WHERE bank_transaction_id = '" . $_GET['codTrans'] ."'");
    
    Header('Location: checkout_payment.php?message=success');    
    
    } else {
        
$bank_data_array=array('bank_transaction_id'=>$_GET['codTrans'],
'shop_transaction_id'=>$_GET['codTrans'],
'authorization_code'=>$_GET['esito'],
'customer_id'=>(int)$customer_id , 
'orders_id'=>(int)$insert_id, 
'amount'=>$_GET['importo']/100, 
'client_status'=> (int)'1', 
'date'=>time());

tep_db_perform(TABLE_ORDERS_CIM_ITALIA,$bank_data_array);
        
    }
    return false;
   }

    function output_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_CIM_ITALIA_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {

      tep_db_query("CREATE TABLE IF NOT EXISTS " . TABLE_ORDERS_CIM_ITALIA . " (
                    bank_transaction_id varchar(50) NOT NULL default '',
                    shop_transaction_id varchar(50) NOT NULL default '',
                    authorization_code varchar(6) NOT NULL default '',
                    customer_id int(9) NOT NULL default '0',
                    orders_id int(9) NOT NULL default '0',
                    amount decimal(15,4) NOT NULL default '0.0000',
                    server_status int(1) NOT NULL default '0',
                    client_status int(1) NOT NULL default '0',
                    date int(12) NOT NULL default '0',
                    PRIMARY KEY (bank_transaction_id))");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Abilita Modulo Cimitalia', 'MODULE_PAYMENT_CIM_ITALIA_STATUS', 'Si', 'Attivare il sistema di pagamento tramite il gateway bancario di Cimitalia?', '6', '1', 'tep_cfg_select_option(array(\'Si\', \'No\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_CIM_ITALIA_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Payment Fees', 'MODULE_PAYMENT_CIM_ITALIA_FEES', '3%', 'Payment fees depending on shipping method: use numbers (in your main value) or percentage.', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Modalit&agrave; Produzione', 'MODULE_PAYMENT_CIM_ITALIA_PRODUCTION', 'No', 'Attivare la modalit&agrave; Produzione (Si) o Test (No)? In modalit&agrave; Test il sistema utilizzer&agrave; un alias e delle chiavi di prova, le informazioni salvate nella configurazione del negozio non verranno utilizzate', '6', '2', 'tep_cfg_select_option(array(\'Si\', \'No\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Codice Riconoscimento Negozio (ALIAS)', 'MODULE_PAYMENT_CIM_ITALIA_ID', 'payment_testm_urlmac', 'Identificatore del negozio del merchant assegnato dalla BANCA', '6', '3', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Chiave segreta Avvio', 'MODULE_PAYMENT_CIM_ITALIA_AVVIO', 'esempiodicalcolomac', 'Chiave segreta Avvio per calcolo MAC', '6', '4', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Chiave segreta Esito', 'MODULE_PAYMENT_CIM_ITALIA_ESITO', 'esempiodicalcolomac', 'Chiave segreta Esito per calcolo MAC', '6', '5', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Tipo di contabilizzazione', 'MODULE_PAYMENT_CIM_ITALIA_TCONTAB', 'Immediata', 'Tipo di contabilizzazione da utilizzare per questo ordine: Differita o Immediata?', '6', '6', 'tep_cfg_select_option(array(\'Immediata\', \'Differita\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Tipo di autorizzazione', 'MODULE_PAYMENT_CIM_ITALIA_TAUTOR', 'Immediata', 'Tipo di autorizzazione da utilizzare per questo ordine: Differita o Immediata?', '6', '7', 'tep_cfg_select_option(array(\'Immediata\', \'Differita\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Valuta transazione', 'MODULE_PAYMENT_CIM_ITALIA_CURRENCY', 'Solo EUR', 'La valuta da utilizzare nella transazione. &Eacute; possibile forzare l&acute;uso della valuta base EUR.', '6', '8', 'tep_cfg_select_option(array(\'Valuta Selezionata\',\'Solo EUR\',\'Solo USD\',\'Solo GBP\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordine visualizzazione.', 'MODULE_PAYMENT_CIM_ITALIA_SORT_ORDER', '0', 'Indicare l&acute;ordine con il quale questa modalit&agrave; di pagamento viene proposta all&acute;utente. 0 &eacute; il valore visualizzato per primo.', '6', '9', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Stato ordine dopo pagamento', 'MODULE_PAYMENT_CIM_ITALIA_ORDER_STATUS_ID', '0', 'Definisce quale stato ordine attribuire all&acute;ordine una volta completato il pagamento.', '6', '10', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array(
      'MODULE_PAYMENT_CIM_ITALIA_STATUS',
      'MODULE_PAYMENT_CIM_ITALIA_ZONE',
      'MODULE_PAYMENT_CIM_ITALIA_FEES',
      'MODULE_PAYMENT_CIM_ITALIA_ORDER_STATUS_ID',
      'MODULE_PAYMENT_CIM_ITALIA_SORT_ORDER',
      'MODULE_PAYMENT_CIM_ITALIA_ID',
      'MODULE_PAYMENT_CIM_ITALIA_AVVIO',
      'MODULE_PAYMENT_CIM_ITALIA_ESITO',
      'MODULE_PAYMENT_CIM_ITALIA_PRODUCTION',
      'MODULE_PAYMENT_CIM_ITALIA_CURRENCY',
      'MODULE_PAYMENT_CIM_ITALIA_TCONTAB',
      'MODULE_PAYMENT_CIM_ITALIA_TAUTOR'
      );
    }
  }
?>