<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class bm_prenotazioni {
    var $code = 'bm_prenotazioni';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function bm_prenotazioni() {
      $this->title = MODULE_BOXES_PRENOTAZIONI_TITLE;
      $this->description = MODULE_BOXES_PRENOTAZIONI_DESCRIPTION;

      if ( defined('MODULE_BOXES_PRENOTAZIONI_STATUS') ) {
        $this->sort_order = MODULE_BOXES_PRENOTAZIONI_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_PRENOTAZIONI_STATUS == 'True');

        $this->group = ((MODULE_BOXES_PRENOTAZIONI_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }

    function execute() {
      global $oscTemplate;

$info='Se desideri controllare lo stato della tue prenotazioni fatte nell\' area \'RICHIEDI TESTI\' oppure in \'NEGOZIO\' puoi farlo direttamente online: 
seleziona la libreria dove hai fatto la richiesta e inserisci il codice cliente che ti abbiamo assegnato.';

      $data = '<div class="ui-widget infoBoxContainer">' .
              '  <div class="ui-widget-header infoBoxHeading">' . MODULE_BOXES_PRENOTAZIONI_BOX_TITLE . '</div>' .
              '  <div class="ui-widget-content infoBoxContents">
              <center><div id="box-prenotazioni" class="mysearch" alt="'.$info.'">
                 <form method="post" action="prenotazioni.php">
                 <div class="myselect"><select name="sede" >
                    <option value="0" selected="selected">Selezione libreria...</option>
                    <option value="1">Busto Arsizio</option>
                    <option value="2">Sesto San Giovanni</option>
                    <option value="3">Milano</option>
                    <option value="4">Sassuolo</option>
                </select></div>
                 <input class="myinputbox" type="text" size="8" name="cliente_id" />
                 <input class="mybutton" type="submit"/><br>Codice Cliente</form></div><br><br></center>' .
              '  </div>' .
              '</div>';

      $oscTemplate->addBlock($data, $this->group);
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_PRENOTAZIONI_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Reserved Module', 'MODULE_BOXES_PRENOTAZIONI_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_PRENOTAZIONI_CONTENT_PLACEMENT', 'Left Column', 'Should the module be loaded in the left or right column?', '6', '1', 'tep_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_PRENOTAZIONI_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_PRENOTAZIONI_STATUS', 'MODULE_BOXES_PRENOTAZIONI_CONTENT_PLACEMENT', 'MODULE_BOXES_PRENOTAZIONI_SORT_ORDER');
    }
  }
?>
