<?php echo tep_draw_form('checkout_payment', tep_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'), 'post', 'onsubmit="return check_form();"'); ?>
<?php
  echo START_BLOCK;
  if (isset($HTTP_GET_VARS['payment_error']) && is_object(${$HTTP_GET_VARS['payment_error']}) && ($error = ${$HTTP_GET_VARS['payment_error']}->get_error())) {
?>
  <tr>
    <td class="main"><b><?php echo tep_output_string_protected($error['title']); ?></b></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main" width="100%" valign="top"><?php echo tep_output_string_protected($error['error']); ?></td>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
  </tr>
<?php
  echo END_BLOCK;
  echo START_BLOCK;
?>
  <?php
  }
?>
  <tr>
    <td class="main"><b><?php echo TABLE_HEADING_BILLING_ADDRESS; ?></b></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
	  <tr>
		<td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		<td class="main" width="50%" valign="top"><?php echo TEXT_SELECTED_BILLING_DESTINATION; ?><br>
		  <br>
		  <?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL') . '">' . tep_image_button('button_change_address.gif', IMAGE_BUTTON_CHANGE_ADDRESS) . '</a>'; ?></td>
		<td align="right" width="50%" valign="top"><table border="0" cellspacing="0" cellpadding="2">
			<tr>
			  <td class="main" valign="top"><b><?php echo TITLE_BILLING_ADDRESS; ?></b><br />
				<?php echo tep_address_label($customer_id, $billto, true, ' ', '<br>'); ?></td>
			</tr>
		  </table></td>
	  </tr>
	</table></td>
  </tr>
<?php
  echo END_BLOCK;
  echo START_BLOCK;
?>
  <tr>
    <td class="main"><b><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></b></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <?php
  $selection = $payment_modules->selection();

  if (sizeof($selection) > 1) {
?>
              <tr>
                <td class="main" width="50%" valign="top"><?php echo TEXT_SELECT_PAYMENT_METHOD; ?></td>
                <td class="main" width="50%" valign="top" align="right"><b><?php echo TITLE_PLEASE_SELECT; ?></b><br>
                  <?php echo tep_image(DIR_WS_IMAGES . 'arrow_east_south.gif'); ?></td>
              </tr>
              <?php
  } else {
?>
              <tr>
                <td class="main" width="100%" colspan="2"><?php echo TEXT_ENTER_PAYMENT_INFORMATION; ?></td>
              </tr>
              <?php
  }

  $radio_buttons = 0;
  for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
?>
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                    <?php
    if ( ($selection[$i]['id'] == $payment) || ($n == 1) ) {
      echo '                  <tr id="defaultSelected" class="moduleRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
    } else {
      echo '                  <tr class="moduleRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="selectRowEffect(this, ' . $radio_buttons . ')">' . "\n";
    }
?>
                    <td class="main" colspan="3"><b><?php echo $selection[$i]['module']; ?></b></td>
                      <td class="main" align="right"><?php
    if (sizeof($selection) > 1) {
      echo tep_draw_radio_field('payment', $selection[$i]['id'],($selection[$i]['id'] == $payment), 'class="checkout_input"');
    } else {
      echo tep_draw_hidden_field('payment', $selection[$i]['id']);
    }
?>
                      </td>
                    </tr>
                    <?php
    if (isset($selection[$i]['error'])) {
?>
                    <tr>
                      <td class="main" colspan="4"><?php echo $selection[$i]['error']; ?></td>
                    </tr>
                    <?php
    } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
?>
                    <tr>
                      <td colspan="4"><table border="0" cellspacing="0" cellpadding="2">
                          <?php
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>
                          <tr>
                            <td class="main"><?php echo $selection[$i]['fields'][$j]['title']; ?></td>
                            <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                            <td class="main"><?php echo $selection[$i]['fields'][$j]['field']; ?></td>
                          </tr>
                          <?php
      }
?>
                        </table></td>
                    </tr>
                    <?php
    }
?>
                  </table></td>
              </tr>
              <?php
    $radio_buttons++;
  }
?>
            </table></td>
  </tr>
<?php
  echo END_BLOCK;
  echo START_BLOCK;
?>
  <tr>
    <td class="main"><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><?php echo tep_draw_textarea_field('comments', 'soft', '46', '5', $comments); ?></td>
              </tr>
            </table></td>
  </tr>
<?php
  echo END_BLOCK;
  echo START_BLOCK;
?>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main"><?php echo '<b>'. TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</b><br>' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></td>
                <td class="main" align="right"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE, 'class="checkout_input"'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
  </tr>
<?php
  echo END_BLOCK;
  echo START_BLOCK;
?>
  <tr>
    <td align="center"><table border="0" width="80%" cellspacing="0" cellpadding="0">
        <tr style="background:url(images/pixel_silver.gif) left repeat-x;">
          <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="right"><?php echo tep_draw_separator('spacer.gif', '1', '5'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('spacer.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
          <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('spacer.gif', '100%', '1'); ?></td>
                <td><?php echo tep_image(DIR_WS_IMAGES . 'checkout_bullet.gif'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('spacer.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
          <td width="25%"><?php echo tep_draw_separator('spacer.gif', '100%', '1'); ?></td>
          <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('spacer.gif', '100%', '1'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('spacer.gif', '1', '5'); ?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="center" width="25%" class="checkoutBarFrom"><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '" class="checkoutBarFrom">' . CHECKOUT_BAR_DELIVERY . '</a>'; ?></td>
          <td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
          <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
          <td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
        </tr>
      </table></td>
  </tr>
<?php
  echo END_BLOCK;
  echo '</form>';
?>
