<?php
 class iwsmile
 {
   var $code, $title, $description, $enabled, $icon;

   function iwsmile()
   {
     global $order;

     $this->code = 'iwsmile';
     $this->icon = 'iwsmile.gif';
     $this->title = MODULE_PAYMENT_IWSMILE_TEXT_TITLE;
     $this->description = MODULE_PAYMENT_IWSMILE_TEXT_DESCRIPTION;
     $this->sort_order = MODULE_PAYMENT_IWSMILE_SORT_ORDER;
     $this->enabled = ((MODULE_PAYMENT_IWSMILE_STATUS == 'True') ? true : false);

     if ((int)MODULE_PAYMENT_IWSMILE_ORDER_STATUS_ID > 0)
     {
       $this->order_status = MODULE_PAYMENT_IWSMILE_ORDER_STATUS_ID;
     }

     if (is_object($order)) $this->update_status();

     $this->form_action_url = 'https://checkout.iwsmile.it/Pagamenti/';
   }




   function update_status()
   {
     global $order;

     if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_IWSMILE_ZONE > 0) )
     {
       $check_flag = false;
       $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_IWSMILE_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
       while ($check = tep_db_fetch_array($check_query)) {
         if ($check['zone_id'] < 1) {
           $check_flag = true;
           break;
         } elseif ($check['zone_id'] == $order->billing['zone_id']) {
           $check_flag = true;
           break;
         }
       }

       if ($check_flag == false)
       {
         $this->enabled = false;
       }
     }
   }

   function javascript_validation()
   {
     return false;
   }

   function selection()
   {
     return array('id' => $this->code,
                  'module' => $this->title,
                   'icon' => $this->icon);
   }

   function pre_confirmation_check()
   {
     return false;
   }

   function confirmation()
   {
     return false;
   }

   function process_button()
   {
     global $order, $currencies;

     if (MODULE_PAYMENT_IWSMILE_CURRENCY == 'Selected Currency')
     {
       $my_currency = $_SESSION['currency'];
     }
     else
     {
       $my_currency = MODULE_PAYMENT_IWSMILE_CURRENCY;
     }
     $process_button_string = tep_draw_hidden_field('ACCOUNT', MODULE_PAYMENT_IWSMILE_ID) .
                              tep_draw_hidden_field('ITEM_NAME', STORE_NAME ) .
                              tep_draw_hidden_field('ITEM_NUMBER', HTTP_SERVER ) .
                              tep_draw_hidden_field('QUANTITY', '1') .

                             tep_draw_hidden_field('AMOUNT', number_format(($order->info['total']) ,'2', '.','' )) .
                              tep_draw_hidden_field('PAYER_FIRSTNAME', $order->delivery['firstname']) .
                              tep_draw_hidden_field('PAYER_LASTNAME', $order->delivery['lastname']) .
                              tep_draw_hidden_field('PAYER_EMAIL', $order->customer['email_address']) .


                              tep_draw_hidden_field('URL_OK', tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL')) .
                              tep_draw_hidden_field('URL_BAD', tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));

     return $process_button_string;
   }

   function before_process()
   {
     $script_path = $_SERVER['HTTP_REFERER'];
     $me = explode('main_page=', $script_path);
     $result = explode('&', $me[0]);
     if ($result[0] == 'checkout_confirmation') tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
     return false;
   }

   function after_process()
   {
     return false;
   }

   function output_error()
   {
     return false;
   }

   function check() {
     if (!isset($this->_check)) {
       $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_IWSMILE_STATUS'");
       $this->_check = tep_db_num_rows($check_query);
     }
     return $this->_check;
   }

   function install()
   {
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Abilita Modulo IWSmile', 'MODULE_PAYMENT_IWSMILE_STATUS', 'True', 'Vuoi accettare pagamenti con IWSmile?', '6', '3', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Conto IWSmile','MODULE_PAYMENT_IWSMILE_ID', '70000000001', 'Il numero di Conto IWSmile dove ricevere i pagamenti', '6', '4', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Valuta','MODULE_PAYMENT_IWSMILE_CURRENCY', 'Selected Currency', 'La valuta su cui effettuare la transazione (disponibile solo EUR)', '6', '3', 'tep_cfg_select_option(array(\'Selected Currency\',\'Solo EUR\'), ', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ordine di visualizzazione.', 'MODULE_PAYMENT_IWSMILE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zona', 'MODULE_PAYMENT_IWSMILE_ZONE', '0', 'Se una zona viene selezionata, questo pagamento vale solo per questa zona.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
     tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_IWSMILE_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
   }

   function remove()
   {
     tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
   }

   function keys()
   {
     return array('MODULE_PAYMENT_IWSMILE_STATUS', 'MODULE_PAYMENT_IWSMILE_ID', 'MODULE_PAYMENT_IWSMILE_CURRENCY', 'MODULE_PAYMENT_IWSMILE_ZONE', 'MODULE_PAYMENT_IWSMILE_ORDER_STATUS_ID', 'MODULE_PAYMENT_IWSMILE_SORT_ORDER');
   }
 }
?>