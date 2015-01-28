<table border="0" width="<?php echo $content; ?>" cellspacing="0" cellpadding="0" class="head_table">
          <tr>
            <td><?php echo tep_image(DIR_WS_IMAGES . 'table_background_man_on_board.gif', HEADING_TITLE); ?></td>
          </tr>
              <tr>
                <td class="pageHeading" align="center"><?php echo HEADING_TITLE; ?></td>
              </tr>
        </table>
<?php
  echo START_BLOCK;
?>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_ACCOUNT_CREATED; ?></td>
              </tr>
              <tr>
                <td align="right"><?php echo '<a href="' . $origin_href . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
              </tr>
<?php
  echo END_BLOCK;
?>
