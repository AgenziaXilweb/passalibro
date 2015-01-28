<?php
/*
  $Id: whats_new.php,v 1.31 2003/02/10 22:31:09 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  if ($random_product = tep_random_select("select products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " where products_status = '1' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
?>
<!-- whats_new //-->
          <tr>
            <td>
<?php
    $random_product['products_name'] = tep_get_products_name($random_product['products_id']);
    $random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);    
    $hot = '<div style="position:absolute">'.tep_image(DIR_WS_IMAGES.'hot.gif').'</div>';

    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_WHATS_NEW);

    //new infoBoxHeading($info_box_contents, false, false, tep_href_link(FILENAME_PRODUCTS_NEW));

    if (tep_not_null($random_product['specials_new_products_price'])) {
      $whats_new_price = '<span class="price">'.'<span class="old">' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>&nbsp;&nbsp;';
      $whats_new_price .=  $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
    } else {
      $whats_new_price = '<span class="price">'.$currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])).'</span>';
    }
	echo '<div id="box_whats_new_heading">'.tep_image_button('zag_whats.gif', BOX_HEADING_WHATS_NEW).'</div>';
	$text = '';
		$text .= '<a style="color:#000" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '"><b>';
	$text .= $random_product['products_name'] . '</b></a><br>';

#	$text .= $hot;
	$text .= '<br><div style="width:128px;border:solid #D0D1DB 1px;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">';
	$text .= tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
	$text .= '</a></div><br><br>';
	$text .= '<div style="text-align:left;font-family:arial;font-size:16px;color:#262B2D"><b>'.$whats_new_price.'</b></div>';
#	$text .= '<div>';
#	$text .= '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">';
#	$text .= $random_product['products_name'];
#	$text .= '</a><br>';
#	$text .= $whats_new_price;
#	$text .= '</div>';
	echo '<div id="box_whats_new">'.$text.'</div>';
?>
            </td>
          </tr>
<!-- whats_new_eof  //-->

<?php
  }
?>
