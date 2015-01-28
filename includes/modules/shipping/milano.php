<?php
/*

  $Id: busto.php,v 1.1 2010/01/14 22:41:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class milano {
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function milano() {
      global $order;
      $this->code = 'milano';
      $this->title = MODULE_SHIPPING_MILANO_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_MILANO_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_MILANO_SORT_ORDER;
      $this->icon = '';
      $this->tax_class = MODULE_SHIPPING_MILANO_TAX_CLASS;
      $this->enabled = ((MODULE_SHIPPING_MILANO_STATUS == 'True') ? true : false);
      $this->min_order = MODULE_SHIPPING_MILANO_MINIMUM_ORDER_TOTAL;

      if ( ($this->min_order != '') && ($order->info['total'] < $this->min_order) )  {
        $this->enabled = false;
      }

      if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_MILANO_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_MILANO_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
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
    }

// class methods - aggiunto sort_order per dare priorità alla checked, se sort_order == 1 checked == true

    function quote($method = '') {
      global $order;

      $this->quotes = array('id' => $this->code,
                            'module' => MODULE_SHIPPING_MILANO_TEXT_TITLE,
                            'sort_order' => MODULE_SHIPPING_MILANO_SORT_ORDER,
                            'methods' => array(array('id' => $this->code,
                                                     'title' => MODULE_SHIPPING_MILANO_TEXT_WAY,
                                                     'cost' => MODULE_SHIPPING_MILANO_COST)));

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);

      return $this->quotes;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_MILANO_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Abilita Consegna in Sede', 'MODULE_SHIPPING_MILANO_STATUS', 'True', 'Vuoi offrire la spedizione con consegna in sede?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Spese di Spedizione', 'MODULE_SHIPPING_MILANO_COST', '0.00', 'Costo di spedizione per tutti gli ordini utilizzando questo metodo di spedizione.', '6', '0', now())");
	    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Strada del sito di consegna', 'MODULE_SHIPPING_MILANO_ADDR_VIA', '', 'Specificare la via e il numero civico del sito di consegna.', '6', '3', now())");
	    tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Città del sito di consegna', 'MODULE_SHIPPING_MILANO_ADDR_CITTA', '', 'Specificare la città e la provincia del sito di consegna.', '6', '4', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CAP del sito di consegna', 'MODULE_SHIPPING_MILANO_ADDR_CAP', '', 'Specificare il CAP del sito di consegna.', '6', '5', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tassa', 'MODULE_SHIPPING_MILANO_TAX_CLASS', '0', 'Utilizzare la seguente classe fiscale per la tassa di spedizione.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Zona di spedizione', 'MODULE_SHIPPING_MILANO_ZONE', '0', 'Se una zona è selezionata, attivare questo metodo di spedizione per la zona.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SHIPPING_MILANO_SORT_ORDER', '0', 'Ordine di visualizzazione.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Minimo Totale ordine', 'MODULE_SHIPPING_MILANO_MINIMUM_ORDER_TOTAL', '', 'Ordine minimo totale richiesto per questa opzione per essere attivato.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_SHIPPING_MILANO_STATUS', 'MODULE_SHIPPING_MILANO_COST', 'MODULE_SHIPPING_MILANO_TAX_CLASS','MODULE_SHIPPING_MILANO_ADDR_VIA','MODULE_SHIPPING_MILANO_ADDR_CITTA','MODULE_SHIPPING_MILANO_ADDR_CAP','MODULE_SHIPPING_MILANO_ZONE', 'MODULE_SHIPPING_MILANO_SORT_ORDER', 'MODULE_SHIPPING_MILANO_MINIMUM_ORDER_TOTAL');
    }
  }
?>