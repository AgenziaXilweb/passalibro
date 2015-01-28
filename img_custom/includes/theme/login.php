<table border="0" width="<?php echo $content; ?>" cellspacing="0" cellpadding="0" class="head_table">
  <tr>
	<td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
	<td class="pageHeading2" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_login.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
  </tr>
</table>
<?php echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
<?php echo START_BLOCK; ?>
<?php
  if ($messageStack->size('login') > 0) {
?>
      <tr>
        <td><div style="margin:10px 20px"><?php echo $messageStack->output('login'); ?></div></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }

  if ($cart->count_contents() > 0) {
?>
      <tr>
        <td class="smallText"><?php echo TEXT_VISITORS_CART; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td class="main" valign="top"><b><?php echo HEADING_RETURNING_CUSTOMER; ?></b></td>
      </tr>
	  <tr>
        <td>
			<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="4">
			  <tr>
				<td class="main" colspan="2"><?php echo TEXT_RETURNING_CUSTOMER; ?></td>
			  </tr>
			  <tr>
				<td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
				<td class="main"><?php echo tep_draw_input_field('email_address'); ?></td>
			  </tr>
			  <tr>
				<td class="main"><b><?php echo ENTRY_PASSWORD; ?></b></td>
				<td class="main"><?php echo tep_draw_password_field('password'); ?></td>
			  </tr>
			  <tr>
				<td class="smallText" colspan="2"><?php echo '<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></td>
			  </tr>
			  <tr>
				<td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
				  <tr>
					<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					<td align="right"><?php echo tep_image_submit('button_login.gif', IMAGE_BUTTON_LOGIN, ' class="noborder"'); ?></td>
					<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
				  </tr>
				</table></td>
			  </tr>
			</table>
		</td>
      </tr>	  
      <tr>
        <td class="main" valign="top"><b><?php echo HEADING_NEW_CUSTOMER; ?></b></td>
      </tr>
      <tr>
        <td>
            <table border="0" width="100%" height="100%" cellspacing="0" cellpadding="4">
			  <tr>
				<td class="main" valign="top"><?php echo TEXT_NEW_CUSTOMER . '<br><br>' . TEXT_NEW_CUSTOMER_INTRODUCTION; ?></td>
			  </tr>
			  <tr>
				<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
				  <tr>
					<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
					<td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
					<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
				  </tr>
				</table></td>
			  </tr>
			</table>
		</td>
      </tr>
<?php echo END_BLOCK; ?>
</form>
