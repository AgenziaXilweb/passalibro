<table border="0" width="<?php echo $content; ?>" cellspacing="0" cellpadding="0" class="head_table">
  <tr>
    <td class="pageHeading"><?php echo HEADING_TITLE_W; ?></td>
    <td class="pageHeading2" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_specials.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
  </tr>
</table>
<?php
  echo START_BLOCK;
?>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main" style="padding-top:20px"><?php echo TEXT_MAIN_W; ?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="1" cellpadding="2">
        <tr class="infoBoxContents">
          <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
<?php
  echo END_BLOCK;
?>