<?php echo tep_draw_form('order', tep_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL')); ?>
<?php
  echo START_BLOCK;
?>
          <tr>
            <td valign="top"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_man_on_board.gif', HEADING_TITLE); ?></td>
            <td valign="top" class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?><div align="center" class="pageHeading"><?php echo HEADING_TITLE; ?></div><br><?php echo TEXT_SUCCESS; ?><br><br>
<?php
  if ($global['global_product_notifications'] != '1') {
    echo TEXT_NOTIFY_PRODUCTS . '<br><p class="productsNotifications">';

    $products_displayed = array();
    for ($i=0, $n=sizeof($products_array); $i<$n; $i++) {
      if (!in_array($products_array[$i]['id'], $products_displayed)) {
        echo tep_draw_checkbox_field('notify[]', $products_array[$i]['id']) . ' ' . $products_array[$i]['text'] . '<br>';
        $products_displayed[] = $products_array[$i]['id'];
      }
    }

    echo '</p>';
  } else {
    echo TEXT_SEE_ORDERS . '<br><br>' . TEXT_CONTACT_STORE_OWNER;
  }
?>
            <h3><?php echo TEXT_THANKS_FOR_SHOPPING; ?></h3></td>
          </tr>
<?php
  echo END_BLOCK;
  echo START_BLOCK;
?>
      <tr>
        <td align="right" class="main"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
      </tr>
<?php
  echo END_BLOCK;
  echo START_BLOCK;
?>
      <tr>
        <td><center><table border="0" width="80%" cellspacing="0" cellpadding="0">
          <tr style="background:url(images/pixel_silver.gif) left repeat-x;">
            <td width="25%" height="11"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
                <td width="50%"><?php echo tep_image(DIR_WS_IMAGES . 'checkout_bullet.gif'); ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_DELIVERY; ?></td>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
            <td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
          </tr>
        </table></center></td>
      </tr>
<?php if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php'); ?>
<?php
  echo END_BLOCK;
?>
    </form>
