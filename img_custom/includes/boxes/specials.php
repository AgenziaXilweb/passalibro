<?php
/*
  $Id: specials.php,v 1.31 2003/06/09 22:21:03 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  if ($random_product = tep_random_select("select p.products_id, pd.products_name, pd.products_description, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS)) {
?>
<!-- specials //-->
<tr>
  <td>
<?php
  
	echo '<div id="box_specials_heading" class="lefttext">'.BOX_HEADING_SPECIALS. '</div>';

	$text = '';

	//$text .= '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">';
	//$text .= $random_product['products_name'] . '</a><br>';

	$text .= '<div style="margin:10px 0 10px 0px;text-align:center;">';
	$text .= '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"]) . '">';
	$text .= tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
	$text .= '</a></div>';
	//$text .= '<div style="padding-top:5px"><div id="box_specials_price"><s>';
	//$text .= $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '';
	///$text .= '</s></div><div id="box_specials_new_price">';
	//$text .= $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id']));
	//$text .= '</div></div>';
	//print_r($random_product);
	echo '<div id="box_specials">'.$text.'</div>';
?>
  </td>
</tr>
<!-- specials_eof //-->
<?php
  }
?>
