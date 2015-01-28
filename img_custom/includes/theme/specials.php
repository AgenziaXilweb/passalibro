<table border="0" width="<?php echo $content; ?>" cellspacing="0" cellpadding="0" class="head_table">
  <tr>
    <td class="pageHeading"><?php echo BOX_HEADING_SPECIALS;?></td>
  </tr>
</table>
<div style="height:9px;border:none;color:#2E2E2E;font-size:1px;" >&nbsp;</div>
<table border="0" cellspacing="0" cellpadding="0" width="<?php echo ($content-30); ?>" style="margin:0">
<?php $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added DESC";
$specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_SPECIAL_PRODUCTS);

  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td class="smallText"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
              <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td style="padding-left:15px"><table border="0" width="<?echo $content; ?>" cellspacing="0" cellpadding="0">
          <tr>
<?php
    $row = 0;
    $specials_query = tep_db_query($specials_split->sql_query);
	$specials = tep_db_fetch_array($specials_query);
    while ($specials) {
      $row++;

      echo '<td align="center" width="50%" class="specials" style="border-bottom:1px dotted #B2B2B2;padding:20px 20px 20px 20px; >
	  			<div style="padding-bottom:10px">
					<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $specials['products_image'], $specials['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="small_image"') . '</a>
				</div>
				<div class="item_zag">
					<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials['products_id']) . '" class="zag_main">' . $specials['products_name'] . '</a>
				</div>
				<div class="item_price" style="border:0; text-align:center; width:100%; height:55px"><s>' . $currencies->display_price($specials['products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '</s><br>' . $currencies->display_price($specials['specials_new_products_price'], tep_get_tax_rate($specials['products_tax_class_id'])) . '
				</div>
			</td>';
$specials = tep_db_fetch_array($specials_query);
      if ((($row / 2) == floor($row / 2)) && $specials) {
?>
</tr>
  <tr>
	<td colspan="3"><?php echo tep_image(DIR_WS_IMAGES."spacer.gif",'',1,3); ?></td>
  </tr>
  <tr>
<?php
      } else echo '<td height="1" colspan="3">'.tep_image(DIR_WS_IMAGES."spacer.gif",'',1,3).'</td>';
    }
?>
          </tr>
        	</table>
		</td>
      </tr>
  </table>
    
<?php
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
    <table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td width="100%">
          <table border="0" width="100%" cellspacing="8" cellpadding="2" class="number">
          <tr>
            <td class="smallText"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $specials_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
</table>
