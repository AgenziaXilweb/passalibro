<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  
  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'save':
        $configuration_value = tep_db_prepare_input($HTTP_POST_VARS['configuration_value']);
        $cID = tep_db_prepare_input($HTTP_GET_VARS['cID']);

        tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . tep_db_input($configuration_value) . "', last_modified = now() where configuration_id = '" . (int)$cID . "'");

        tep_redirect(tep_href_link(FILENAME_WAREHOUSES, 'gID=' . $HTTP_GET_VARS['gID'] . '&cID=' . $cID));
        break;
    }
  }

  $gID = (isset($HTTP_GET_VARS['gID'])) ? $HTTP_GET_VARS['gID'] : 1;

  $cfg_group_query = tep_db_query("select configuration_group_title from " . TABLE_CONFIGURATION_GROUP . " where configuration_group_id = '" . (int)$gID . "'");
  $cfg_group = tep_db_fetch_array($cfg_group_query);

  require(DIR_WS_INCLUDES . 'template_top.php');

?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADER_TITLE_WAREHOUSES; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr></table>
<?php


  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
