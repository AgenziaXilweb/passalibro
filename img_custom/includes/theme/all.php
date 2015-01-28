<table border="0" width="<?php echo $content; ?>" cellspacing="0" cellpadding="0" class="head_table">
          <tr>
            <td class="pageHeading">All products</td>
            <td class="pageHeading2" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_products_new.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table><table border="0" cellspacing="15" cellpadding="0" width="<?php echo $content; ?>">
      
<?php
  $products_new_array = array();

  $products_new_query_raw = "select p.products_id, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on (p.manufacturers_id = m.manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added DESC, pd.products_name";
  $products_new_split = new splitPageResults($products_new_query_raw, MAX_DISPLAY_PRODUCTS_NEW);

  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="3" cellpadding="0">
<?php
  if ($products_new_split->number_of_rows > 0) {
    $products_new_query = tep_db_query($products_new_split->sql_query);
    while ($products_new = tep_db_fetch_array($products_new_query)) {
      if ($new_price = tep_get_products_special_price($products_new['products_id'])) {
        $products_price = '<s class="zag_pr_old" style="font-size:15px;">' . $currencies->display_price($products_new['products_price'], tep_get_tax_rate($products_new['products_tax_class_id'])) . '</s> <span class="zag_pr_price" style="font-size:15px;">' . $currencies->display_price($new_price, tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span>';
      } else {
        $products_price = '<span class="zag_pr_price">'.$currencies->display_price($products_new['products_price'], tep_get_tax_rate($products_new['products_tax_class_id'])).'</span>';
      }
?>
    <tr>
      <td style="padding-bottom:12px;border-bottom:1px dotted #B2B2B2;">
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
          </tr>
          <tr>
            <td class="all" valign="top"  width="<?php echo (SMALL_IMAGE_WIDTH+20);?>"><?php 
            echo '<a  href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $products_new['products_image'], $products_new['products_name'], SMALL_IMAGE_WIDTH/1.2, SMALL_IMAGE_HEIGHT/1.2, ' align="left" style="margin:0 15px 0 5px" class="small_image"') . '</a>'; 
            ?>
            </td>
            <td class="main" style="padding:0" ><?php  echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new['products_id']) . '" class="zag_main"><b>' . $products_new['products_name'] . '</b><br><br></a><span class="item_manuf">'. TEXT_DATE_ADDED . ' ' . tep_date_long($products_new['products_date_added']) . '<br>' . TEXT_MANUFACTURER . ' ' . $products_new['manufacturers_name'] . '<br></span><div class="zag_pr_text" style="font-size:15px;">' . TEXT_PRICE . ' ' . $products_price . '</div>'; ?></td>
          </tr>
          <tr>
          	<td height="18" colspan="2"><div align="right" valign="middle"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_new['products_id']) . '">' . tep_image_button('button_in_cart.gif', IMAGE_BUTTON_IN_CART) . '</a>'; ?></div></td>
          </tr>
        </table>
      </td>
    </tr>		
<?php
    }
  } else {
?>
    <tr>
      <td bgcolor="#AFBCC1">
        <table border="0" width="100%" cellspacing="0" cellpadding="2" bgcolor="#FFFFFF">
          <tr>
            <td class="main"><?php echo TEXT_NO_NEW_PRODUCTS; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '3'); ?></td>
          </tr>
        </table>
      </td>
    </tr>
<?php
  }
?>
        </table></td>
      </tr>
  </table>
<?php
  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td width="100%">
          <table border="0" width="100%" cellspacing="0" cellpadding="8" class="number">
          <tr>
            <td class="smallText"><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
</table>
