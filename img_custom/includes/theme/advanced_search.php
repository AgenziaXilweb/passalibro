<table border="0" width="<?php echo $content; ?>" cellspacing="0" cellpadding="0" class="head_table">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE_1; ?></td>
            <td class="pageHeading2" align="right"><?php //echo tep_image(DIR_WS_IMAGES . 'table_background_browse.gif', HEADING_TITLE_1, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table><?php echo tep_draw_form('advanced_search', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get', 'onSubmit="return check_form(this);"') . tep_hide_session_id(); ?>
<?php
  echo START_BLOCK;
  if ($messageStack->size('search') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('search'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="infoBox">
              <tr class="infoBoxContents">
                <td>
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td height="30"><center><?php echo tep_draw_input_field('keywords', '', 'style="width:80%; margin:10px 0"');?></center></td>
                      </tr>
                      <tr>
                        <td align="right" style="padding-right:20px"><?php echo tep_draw_checkbox_field('search_in_description', '1') . ' ' . TEXT_SEARCH_IN_DESCRIPTION;?></td>
                      </tr>
                    </table>
                </td>
              </tr>
              <tr class="infoBoxContents">
                <td><table border="0" width="95%" cellspacing="0" cellpadding="2" style="margin:0 20px 0 12px">
          <tr>
            <td class="smallText"><?php echo '<a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_SEARCH_HELP) . '\')">' . TEXT_SEARCH_HELP_LINK . '</a>'; ?></td>
            <td class="smallText" align="right"><?php echo tep_image_submit('button_search.gif', IMAGE_BUTTON_SEARCH, ' class="noborder"'); ?></td>
          </tr>
        </table></td>
              </tr><tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
              <tr class="infoBoxContents" align="center">
                <td><table border="0"  cellspacing="0" cellpadding="2">
              <tr>
                <td class="fieldKey"><?php echo ENTRY_CATEGORIES; ?></td>
                <td class="fieldValue"><?php echo tep_draw_pull_down_menu('categories_id', tep_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES)))); ?></td>
              </tr>
              <tr>
                <td class="fieldKey">&nbsp;</td>
                <td class="smallText"><?php echo tep_draw_checkbox_field('inc_subcat', '1', true) . ' ' . ENTRY_INCLUDE_SUBCATEGORIES; ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_MANUFACTURERS; ?></td>
                <td class="fieldValue"><?php echo tep_draw_pull_down_menu('manufacturers_id', tep_get_manufacturers(array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS)))); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_PRICE_FROM; ?></td>
                <td class="fieldValue"><?php echo tep_draw_input_field('pfrom'); ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_PRICE_TO; ?></td>
                <td class="fieldValue"><?php echo tep_draw_input_field('pto'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_DATE_FROM; ?></td>
                <td class="fieldValue"><?php echo tep_draw_input_field('dfrom', DOB_FORMAT_STRING, 'onFocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"'); ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_DATE_TO; ?></td>
                <td class="fieldValue"><?php echo tep_draw_input_field('dto', DOB_FORMAT_STRING, 'onFocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"'); ?></td>
              </tr>
            </table></td>
              </tr>
            </table>
        </td>
      </tr>
<?php
  echo END_BLOCK;
?>
    </form>
