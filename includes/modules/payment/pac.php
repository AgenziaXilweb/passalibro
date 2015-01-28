<?php

/*

  $Id: pac.php,v 1.1 2010/01/14 05:51:31 hpdl Exp $



  osCommerce, Open Source E-Commerce Solutions

  http://www.oscommerce.com



  Copyright (c) 2010 osCommerce



  Released under the GNU General Public License

*/



  class pac {

    var $code, $title, $description, $enabled;



// class constructor

    function pac() {

      global $order;



      $this->code = 'pac';

      $this->title = MODULE_PAYMENT_PAC_TEXT_TITLE;

      $this->description = MODULE_PAYMENT_PAC_TEXT_DESCRIPTION;

      $this->sort_order = MODULE_PAYMENT_PAC_SORT_ORDER;

      $this->enabled = ((MODULE_PAYMENT_PAC_STATUS == 'True') ? true : false);

      $this->email_footer = MODULE_PAYMENT_PAC_TEXT_EMAIL_FOOTER;



      if ((int)MODULE_PAYMENT_PAC_ORDER_STATUS_ID > 0) {

        $this->order_status = MODULE_PAYMENT_PAC_ORDER_STATUS_ID;

      }



      if (is_object($order)) $this->update_status();

    }



// class methods

    function update_status() {

      global $order, $cart;

      $cart_value_threshold = 1000;



      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PAC_ZONE > 0) ) {

        $check_flag = false;

        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAC_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");

        while ($check = tep_db_fetch_array($check_query)) {

          if ($check['zone_id'] < 1) {

            $check_flag = true;

            break;

          } elseif ($check['zone_id'] == $order->delivery['zone_id']) {

            $check_flag = true;

            break;

          }

        }



        if ($check_flag == false) {

          $this->enabled = false;

        }

      }



// disable the module if the order only contains virtual products

      if ($this->enabled == true) {

        if ($order->content_type == 'virtual') {

          $this->enabled = false;

        }

      }

      //Max 18/11/2009

	if($this->enabled == true) {

	    if($cart->show_total() >= $cart_value_threshold) {

		$this->enabled = false;

	    }

	} 

	// Max 16/08/2009

	if($this->enabled == true) {

	//echo $order->info['shipping_method'];

		if($order->info['shipping_method'] == 'Corriere Espresso SDA Golden Service (Assicurata con Consegna in 24 Ore)') {

	    		$this->enabled = false;

	    	}

		if($order->info['shipping_method'] == 'Spedizione con Corriere Espresso SDA (Importo spedizione)') {

	    		$this->enabled = false;

		}

      //Max 18/11/2009

		if($order->info['shipping_method'] == 'Spedizione con Corriere Espresso SDA + Assicurazione (Importo spedizione)') {

	    		$this->enabled = false;

		}

	// Max 14/01/2010

		if($order->info['shipping_method'] == 'Spedizione con Corriere Espresso SDA con contrassegno (Importo spedizione)') {

	    		$this->enabled = false;

		}

		

	}

	

    }



    function javascript_validation() {

      return false;

    }



    function selection() {

      return array('id' => $this->code,

                   'module' => $this->title);

    }



    function pre_confirmation_check() {

      return false;

    }



    function confirmation() {

      return false;

    }



    function process_button() {

      return false;

    }



    function before_process() {

      return false;

    }



    function after_process() {

      return false;

    }



    function get_error() {

      return false;

    }



    function check() {

      if (!isset($this->_check)) {

        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAC_STATUS'");

        $this->_check = tep_db_num_rows($check_query);

      }

      return $this->_check;

    }



    function install() {

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Abilita modulo pagamento al negozio', 'MODULE_PAYMENT_PAC_STATUS', 'True', 'Vuoi abilitare il pagamento al negozio?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zona di pagamento', 'MODULE_PAYMENT_PAC_ZONE', '0', 'Se una zona è selezionata, attivare questo metodo di pagamento per la zona.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordine di visualizzazione.', 'MODULE_PAYMENT_PAC_SORT_ORDER', '0', 'Ordine di visualizzazione. Il valore + basso viene visualizzato per primo.', '6', '0', now())");

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Stato ordine', 'MODULE_PAYMENT_PAC_ORDER_STATUS_ID', '0', 'Impostare lo stato degli ordini di pagamento effettuate con questo modulo a questo valore', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");

   }



    function remove() {

      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");

    }



    function keys() {

      return array('MODULE_PAYMENT_PAC_STATUS', 'MODULE_PAYMENT_PAC_ZONE', 'MODULE_PAYMENT_PAC_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAC_SORT_ORDER');

    }

  }

?>

