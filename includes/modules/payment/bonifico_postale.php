<?php
  class bonifico_postale {
    var $code, $title, $description, $enabled, $icon;

// class constructor
    function bonifico_postale() {
      global $order;

      $this->code = 'bonifico_postale';
      $this->title = MODULE_PAYMENT_BONIFICO_POSTALE_TEXT_TITLE;
      $this->icon = 'poste_italiane.png';
      $this->description = MODULE_PAYMENT_BONIFICO_POSTALE_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_BONIFICO_POSTALE_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_BONIFICO_POSTALE_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_BONIFICO_POSTALE_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_BONIFICO_POSTALE_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->email_footer = MODULE_PAYMENT_BONIFICO_POSTALE_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_BONIFICO_POSTALE_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_BONIFICO_POSTALE_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
      return array('title' => 'Da pagare a:<br /><br/>Intestatario: '.MODULE_PAYMENT_BONIFICO_POSTALE_INTESTATARIO.'<br />Ufficio Postale: '.MODULE_PAYMENT_BONIFICO_POSTALE_BANCA.'<br />IBAN: '.MODULE_PAYMENT_BONIFICO_POSTALE_IBAN.'<br />SWIFT: '.MODULE_PAYMENT_BONIFICO_POSTALE_SWIFT.'<br /><br />Non appena riceveremo il pagamento provvederemo alla spedizione della merce ordinata.');
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
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_BONIFICO_POSTALE_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Abilita il pagamento tramite Bonifico Postale', 'MODULE_PAYMENT_BONIFICO_POSTALE_STATUS', 'True', 'Vuoi accettare pagamenti tramite Bonifico Postale?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now());");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Intestatario', 'MODULE_PAYMENT_BONIFICO_POSTALE_INTESTATARIO', '', 'Intestario del conto', '6', '3', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Ufficio Postale', 'MODULE_PAYMENT_BONIFICO_POSTALE_BANCA', '', 'Ufficio Postale', '6', '4', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('IBAN', 'MODULE_PAYMENT_BONIFICO_POSTALE_IBAN', '', 'codice IBAN', '6', '9', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('SWIFT', 'MODULE_PAYMENT_BONIFICO_POSTALE_SWIFT', '', 'codice SWIFT', '6', '10', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_BONIFICO_POSTALE_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_BONIFICO_POSTALE_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_BONIFICO_POSTALE_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_BONIFICO_POSTALE_STATUS', 'MODULE_PAYMENT_BONIFICO_POSTALE_INTESTATARIO', 'MODULE_PAYMENT_BONIFICO_POSTALE_BANCA', 'MODULE_PAYMENT_BONIFICO_POSTALE_IBAN', 'MODULE_PAYMENT_BONIFICO_POSTALE_SWIFT', 'MODULE_PAYMENT_BONIFICO_POSTALE_ZONE', 'MODULE_PAYMENT_BONIFICO_POSTALE_ORDER_STATUS_ID', 'MODULE_PAYMENT_BONIFICO_POSTALE_SORT_ORDER');
    }
  }
?>