<table border="0" width="<?php echo $content; ?>" cellspacing="0" cellpadding="0" class="head_table">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading2" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_contact_us.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table><?php echo tep_draw_form('contact_us', tep_href_link(FILENAME_CONTACT_US, 'action=send')); ?>
<?php
  echo START_BLOCK;
?>
<?php
  if ($messageStack->size('contact') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('contact'); ?></td>
      </tr>
<?php
  }

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'success')) {
?>
      <tr>
        <td class="main" align="center"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_man_on_board.gif', HEADING_TITLE, '0', '0', 'align="left"') . TEXT_SUCCESS; ?></td>
      </tr>
      <tr>
        <td>
			<table border="0" width="100%" cellspacing="1" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE, ' class="noborder"') . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table>
		</td>
      </tr>
<?php
  } else {
?>
      <tr>
        <td>
			<table border="0" width="100%" cellspacing="0" cellpadding="2">
			  <tr>
				<td class="main"><?php echo ENTRY_NAME; ?></td>
			  </tr>
			  <tr>
				<td class="main"><?php echo tep_draw_input_field('name'); ?></td>
			  </tr>
			  <tr>
				<td class="main"><?php echo ENTRY_EMAIL; ?></td>
			  </tr>
			  <tr>
				<td class="main"><?php echo tep_draw_input_field('email'); ?></td>
			  </tr>
			  <tr>
				<td class="main"><?php echo ENTRY_ENQUIRY; ?></td>
			  </tr>
			  <tr>
				<td><?php echo tep_draw_textarea_field('enquiry', 'soft', 46, 15); ?></td>
			  </tr>
			</table>
		</td>
	  <tr>	
		<td><div style="margin:15px 0 15px 250px; float:left"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE, ' class="noborder"'); ?></div></td>
      </tr>
<?php
  }
  echo END_BLOCK;
?>
    </form>
