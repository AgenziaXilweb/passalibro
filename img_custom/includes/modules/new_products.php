<?php
/*
  $Id: new_products.php,v 1.34 2003/06/09 22:49:58 hpdl Exp $
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce
  Released under the GNU General Public License
*/

  $info_box_contents = array();
  $info_box_contents[] = array('text' => sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')));
  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
    $new_products_query = tep_db_query("select p.products_id, p.products_image, p.manufacturers_id,  p.products_tax_class_id,  if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where products_status = '1' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
  } else {
    $new_products_query = tep_db_query("select distinct p.products_id, p.manufacturers_id, p.products_image, p.products_tax_class_id,  if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
  }
  $row = 0;
  $col = 0;
  $info_box_contents = array();
  $arr_manuf = tep_get_manufacturers();
  $list_manuf = array();
  foreach ($arr_manuf as $arr_manuf_v){
    $list_manuf[$arr_manuf_v['id']] = $arr_manuf_v['text'];}
  while ($new_products = tep_db_fetch_array($new_products_query)) {
    $new_products['products_name'] = tep_get_products_name($new_products['products_id']);
    $product_query = tep_db_query("select products_description from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$new_products['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $product = tep_db_fetch_array($product_query);
    $new_products['products_name'] = tep_get_products_name($new_products['products_id']);
    $info_box_contents[$row][$col] = array('align' => 'right',
                                           'params' => 'class="smallText" width="50%" valign="top"',
                                           'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, ' ') . '</a>',
                                           'zg'=>'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . $new_products['products_name'] . '</a>' ,
                                           'price'=> $currencies->display_price($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])),
                                           'newpr'=> $currencies->display_price($new_price, tep_get_tax_rate($new_products['products_tax_class_id'])),
                                           'id'=>$new_products['products_id'],
                                           'des'=>$product['products_description'],
                                           'img'=>$new_products['products_image'],
                                           'manuf'=>$list_manuf[$new_products['manufacturers_id']],
                                           'name'=>$new_products['products_name']
                                           );
    $col ++;
    if ($col > 10) {
      $col = 0;
      $row ++;
    }
  }
$st_key = false;
$kk=0;
$max_c=1;
$max_i=MAX_DISPLAY_NEW_PRODUCTS;
?>
<table border="0" width="<?php echo $_kol_cn; ?>" cellspacing="0" cellpadding="0" class="head_table">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_products_new.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table>
<?php
  /*echo '<table width="'.$content.'" border="0" cellpadding="0" cellspacing="0" style="padding:0; margin:0;">'.
    '<tr><td style="padding:15px 0 0 25px">';
  echo tep_image_button("zag_pr_p.gif","Featured products");
  echo '</td></tr></table>';*/
  echo '<table width="'.$content.'" border="0" cellpadding="0" cellspacing="2" style="padding:0; margin:0;">'.
    '<tr valign="top"><td style="padding:15px 0 0 0px">';
// START
    for ($i_=0;$i_<$max_i; $i_=$i_+=2){
    $align='left';
    $align2='right';
    if ($st_key) {
      $st_key = false;
      $k=0;
    } else {
      $st_key = true;
      $k=1;
    }
    $kk++;
	if ($kk == 1) {$align='right';$align2='left';}
	if($info_box_contents[0][$i_]["zg"]!=''){
?>
    
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td style="padding:0px 0 0 12px">
    <div class="goods">
    <div style="padding:15px 0 0 8px">
    <div class="item_zag_main zag" style="text-align:center"><?php echo $info_box_contents[0][$i_]["zg"] ;?></div>	
    <div style="float:left;padding:25px 10px 0 10px; width: <?php echo SMALL_IMAGE_WIDTH; ?>px"><?php echo $info_box_contents[0][$i_]["text"];?></div>
    <div class="item_des" style="padding-top:25px"><?php echo substr($info_box_contents[0][$i_]["des"],0,14);?></div>
			<div style="height:13px"></div>
			<div class="item_price"><?php echo $info_box_contents [0][$i_]['price']; ?></div>
			<div style=" margin:0px 0 0 0px;"><?php echo  tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product'),'post','') . tep_image_submit('../../../../../images/button_in_cart.gif', IMAGE_BUTTON_IN_CART,'style="margin:15px 0px 6px 0px; float:left"') . tep_draw_hidden_field('products_id', $info_box_contents[0][$i_]['id']) . '</form>'.'<a href="'.tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $info_box_contents[0][$i_]['id']).'">'.tep_image_button('../../../../../images/button_det.gif','','style="float:left"').'</a>';?></div>&nbsp;
		</div>
    </div>
    </td>
    
        <td style="padding:0px 0 0 0px">
    <div class="goods">
    <div style="padding:15px 0 0 8px">
    <div class="item_zag_main zag" style="text-align:center;"><?php echo $info_box_contents[0][$i_+1]["zg"] ;?></div>	
    <div style="float:left;padding:25px 10px 0 10px; width: <?php echo SMALL_IMAGE_WIDTH; ?>px"><?php echo $info_box_contents[0][$i_+1]["text"];?></div>
    <div class="item_des" style="padding-top:25px"><?php echo substr($info_box_contents[0][$i_]["des"],0,14);?></div>
			<div style="height:13px"></div>
			<div class="item_price"><?php echo $info_box_contents [0][$i_+1]['price']; ?></div>
			<div style=" margin:0px 0 0 0px;"><?php echo  tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product'),'post','') . tep_image_submit('../../../../../images/button_in_cart.gif', IMAGE_BUTTON_IN_CART,'style="margin:15px 0px 6px 0px; float:left"') . tep_draw_hidden_field('products_id', $info_box_contents[0][$i_+1]['id']) . '</form>'.'<a href="'.tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $info_box_contents[0][$i_+1]['id']).'">'.tep_image_button('../../../../../images/button_det.gif','','style="float:left"').'</a>';?></div>&nbsp;
		</div>
    </div>
    </td>
  </tr>
</table>
<?php  } 
  if ( ($i_+2) < $max_i ) {
    if ( !isset($info_box_contents[0][$i_+1]['id']) ) {
	  break;
	}
	if ( $kk == $max_c ) {
	  $kk = 0;
	  echo '</td></tr><tr><td></td></tr><tr valign="top">';
	} else {
   // echo '</td><td>'.tep_image(DIR_WS_IMAGES . 'hor_line.gif').'</td>';
  }
  echo '<td>';
  }
}
echo '<br></td></tr></table>'; ?>
