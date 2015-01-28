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

define('TABLE_ORDERS_SETEFI', DB_PREFIX . 'orders_setefi');

  class setefi {
    var $code, $title, $description, $enabled;

// class constructor
    function setefi() {
      global $order;

      $this->code = 'setefi';
      $this->icon = 'setefi.png';
      $this->title = MODULE_PAYMENT_SETEFI_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_SETEFI_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_SETEFI_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_SETEFI_STATUS == 'Si') ? true : false);
      $this->fees = 0;
      $this->production = ((MODULE_PAYMENT_SETEFI_PRODUCTION == 'Si') ? true : false);
      $this->alias = MODULE_PAYMENT_SETEFI_ID;
      $this->tcontab = ((MODULE_PAYMENT_SETEFI_TCONTAB == 'Immediata') ? 'I' : 'D');
      $this->tautor = ((MODULE_PAYMENT_SETEFI_TAUTOR == 'Immediata') ? 'I' : 'D');
      $this->chiave_avvio = MODULE_PAYMENT_SETEFI_AVVIO;
      $this->chiave_esito = MODULE_PAYMENT_SETEFI_ESITO;

      if ((int)MODULE_PAYMENT_SETEFI_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_SETEFI_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

    if($this->production) {
        
        
      $this->form_action_url = 'https://www.monetaonline.it/monetaweb/hosted/init/http';
    
    } else {
      
      $this->alias = '97423388';
      $this->chiave_avvio = 'Passa20libro12';
      $this->chiave_esito = '4';
      $this->form_action_url = 'https://test.monetaonline.it/monetaweb/hosted/init/http';
    }
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_SETEFI_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_SETEFI_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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

      $this->fees = MODULE_PAYMENT_SETEFI_FEES;
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

      if (MODULE_PAYMENT_SETEFI_CURRENCY == 'Valuta Selezionata') {
        $osc_currency = $currency;
      } else {
        $osc_currency = substr(MODULE_PAYMENT_SETEFI_CURRENCY, 5);
      }
      if (!in_array($osc_currency, array('EUR', 'GBP', 'USD'))) {
        $osc_currency = 'EUR';
      }

      // Conversion of currencies in ISO codes
      // EUR -> 978, GBP -> 2, USD -> 1

      switch ($osc_currency) {
        case 'EUR':
            $mycurrency =  '978';
        break;
        case 'GBP':
            $mycurrency =  '2';
        break;
        case 'USD':
            $mycurrency =  '1';
        break;
        default:
            $mycurrency =  '978';
        }

    if ( $this->production )
        // verificare che la valuta predefinita siano euro
          $myamount = round($order->info['total'] * $currencies->get_value($osc_currency) * 100);
      else
          /// amount needed for test purposes
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
//      $str = 'codTrans=' . $myshoptransactionID .
//       'divisa=' . $mycurrency .
//       'importo=' . $myamount .
//       $this->chiave_avvio;
//    $MAC = urlencode( base64_encode( md5($str) ) );


        $data="id=$myshoplogin&password=$this->chiave_avvio&action=$this->chiave_esito&amt=$myamount&currencycode=$mycurrency&langid=$mylanguage&responseurl=".HTTP_SERVER . DIR_WS_HTTP_CATALOG . 'checkout_process.php'."&errorurl=".HTTP_SERVER . DIR_WS_HTTP_CATALOG . 'checkout_process.php'."&trackid=$myshoptransactionID&udf1=Email aquirente $mybuyeremail";
        $curl_handle=curl_init();
        curl_setopt($curl_handle,CURLOPT_URL,$this->form_action_url);
        curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        $token=explode(":",$buffer,2);
        $tid=$token[0];
        $paymenturl=$token[1];
        $link = $paymenturl.'?PaymentID='.$tid;
        
//        $process_button_string =
//        tep_draw_hidden_field('trackid', $myshoptransactionID) .
//        tep_draw_hidden_field('currencycode', $mycurrency) .
//        tep_draw_hidden_field('amt', $myamount) .
//        tep_draw_hidden_field('id', $myshoplogin) .
//        tep_draw_hidden_field('udf1', 'Email acquirente '.$mybuyeremail) .
//        tep_draw_hidden_field('responseurl', HTTP_SERVER . DIR_WS_HTTP_CATALOG . 'checkout_process.php' ) .
//        tep_draw_hidden_field('errorurl', HTTP_SERVER . DIR_WS_HTTP_CATALOG . 'checkout_process.php' ).
//        tep_draw_hidden_field('password',$this->chiave_avvio) .
//        tep_draw_hidden_field('langid', $mylanguage) .
//        tep_draw_hidden_field('action', $this->chiave_esito);
//
//
      return $link;
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
    $checkMAC = urlencode( base64_encode( md5($str) ) );

    // Il MAC non e' corretto. Torniamo alla pagina per il pagamento: funziona anche nel caso in cui l'ordine è stato cancellato
    if( $_GET['esito'] == 'ANNULLO' || $_GET['esito'] == 'KO' ) {
      if( $_GET['esito'] == 'ANNULLO' ) $err_message = 'ordine annullato';
      if( $_GET['esito'] == 'KO' ) $err_message = 'errore nel pagamento: credenziali non valide o credito non disponibile nella carta';
      Header('Location: checkout_payment.php?error_message=' . urlencode($err_message) );
      tep_exit();
    }
    else if ( strtolower($_GET['mac']) != strtolower($checkMAC)) {
      Header('Location: checkout_payment.php?error_message=' . urlencode("errore di protezione nel pagamento") );
      tep_exit();
    }

    if( !$this->production )
      $order->info['comments'] .= "\nAttenzione:questa e' una transazione di test.";

    return false;
    }

    function after_process() {
    global $order, $insert_id, $customer_id;
    // Salvo nel database i parametri della transazione
    $check_query = tep_db_query("select * FROM " . TABLE_ORDERS_SETEFI . " WHERE bank_transaction_id = '" . $_GET['IDTRANS'] . "'");
    $check = tep_db_num_rows($check_query);
    if($check > 0) {
      tep_db_query("UPDATE " . TABLE_ORDERS_SETEFI . " SET client_status = 1, customer_id = " . $customer_id . ", orders_id = " . $insert_id . " WHERE bank_transaction_id = '" . $_GET['IDTRANS'] ."'");
    } else {
      tep_db_query("INSERT INTO " . TABLE_ORDERS_SETEFI . " (bank_transaction_id, shop_transaction_id, authorization_code, customer_id, orders_id, amount, client_status, date) VALUES ('" . $_GET['IDTRANS'] . "', '" . $_GET['NUMORD'] . "','" . $_GET['AUT'] . "', " . $customer_id . "," . $insert_id . ", " . $_GET['IMPORTO']/100 . ",1," . time() . ")");
    }
    return false;
   }

    function output_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_SETEFI_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {

      tep_db_query("CREATE TABLE IF NOT EXISTS " . TABLE_ORDERS_SETEFI . " (
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

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Abilita Modulo Cimitalia', 'MODULE_PAYMENT_SETEFI_STATUS', 'Si', 'Attivare il sistema di pagamento tramite il gateway bancario di Cimitalia?', '6', '1', 'tep_cfg_select_option(array(\'Si\', \'No\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_SETEFI_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Payment Fees', 'MODULE_PAYMENT_SETEFI_FEES', '3%', 'Payment fees depending on shipping method: use numbers (in your main value) or percentage.', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Modalit&agrave; Produzione', 'MODULE_PAYMENT_SETEFI_PRODUCTION', 'No', 'Attivare la modalit&agrave; Produzione (Si) o Test (No)? In modalit&agrave; Test il sistema utilizzer&agrave; un alias e delle chiavi di prova, le informazioni salvate nella configurazione del negozio non verranno utilizzate', '6', '2', 'tep_cfg_select_option(array(\'Si\', \'No\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Codice Riconoscimento Negozio (ALIAS)', 'MODULE_PAYMENT_SETEFI_ID', 'payment_testm_urlmac', 'Identificatore del negozio del merchant assegnato dalla BANCA', '6', '3', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Chiave segreta Avvio', 'MODULE_PAYMENT_SETEFI_AVVIO', 'esempiodicalcolomac', 'Chiave segreta Avvio per calcolo MAC', '6', '4', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Chiave segreta Esito', 'MODULE_PAYMENT_SETEFI_ESITO', 'esempiodicalcolomac', 'Chiave segreta Esito per calcolo MAC', '6', '5', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Tipo di contabilizzazione', 'MODULE_PAYMENT_SETEFI_TCONTAB', 'Immediata', 'Tipo di contabilizzazione da utilizzare per questo ordine: Differita o Immediata?', '6', '6', 'tep_cfg_select_option(array(\'Immediata\', \'Differita\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Tipo di autorizzazione', 'MODULE_PAYMENT_SETEFI_TAUTOR', 'Immediata', 'Tipo di autorizzazione da utilizzare per questo ordine: Differita o Immediata?', '6', '7', 'tep_cfg_select_option(array(\'Immediata\', \'Differita\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Valuta transazione', 'MODULE_PAYMENT_SETEFI_CURRENCY', 'Solo EUR', 'La valuta da utilizzare nella transazione. &Eacute; possibile forzare l&acute;uso della valuta base EUR.', '6', '8', 'tep_cfg_select_option(array(\'Valuta Selezionata\',\'Solo EUR\',\'Solo USD\',\'Solo GBP\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordine visualizzazione.', 'MODULE_PAYMENT_SETEFI_SORT_ORDER', '0', 'Indicare l&acute;ordine con il quale questa modalit&agrave; di pagamento viene proposta all&acute;utente. 0 &eacute; il valore visualizzato per primo.', '6', '9', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Stato ordine dopo pagamento', 'MODULE_PAYMENT_SETEFI_ORDER_STATUS_ID', '0', 'Definisce quale stato ordine attribuire all&acute;ordine una volta completato il pagamento.', '6', '10', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array(
      'MODULE_PAYMENT_SETEFI_STATUS',
      'MODULE_PAYMENT_SETEFI_ZONE',
      'MODULE_PAYMENT_SETEFI_FEES',
      'MODULE_PAYMENT_SETEFI_ORDER_STATUS_ID',
      'MODULE_PAYMENT_SETEFI_SORT_ORDER',
      'MODULE_PAYMENT_SETEFI_ID',
      'MODULE_PAYMENT_SETEFI_AVVIO',
      'MODULE_PAYMENT_SETEFI_ESITO',
      'MODULE_PAYMENT_SETEFI_PRODUCTION',
      'MODULE_PAYMENT_SETEFI_CURRENCY',
      'MODULE_PAYMENT_SETEFI_TCONTAB',
      'MODULE_PAYMENT_SETEFI_TAUTOR'
      );
    }
  }
?>