<?php
/*
  $Id: best_sellers.php,v 1.21 2003/06/09 22:07:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  /*if (isset($current_category_id) && ($current_category_id > 0)) {
    $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
  } else {*/
    $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
  //}

  if (tep_db_num_rows($best_sellers_query) >= MIN_DISPLAY_BESTSELLERS) {
?>
<!-- best_sellers //-->
<?php
	echo '<div id="box_bestsellers_heading" class="lefttext">'.BOX_HEADING_BESTSELLERS.'</div>';
    
	$info_box_contents = array();
    $rows = 0;
    while ($best_sellers = tep_db_fetch_array($best_sellers_query)) {
      $rows++;
    $info_box_contents[$rows-1]['link'] = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id']) . '">';
    $info_box_contents[$rows-1]['name'] = $best_sellers['products_name'];
    }
}
if (tep_db_num_rows($best_sellers_query) >= MIN_DISPLAY_BESTSELLERS) {
	echo '<div id="box_bestsellers">';
	foreach ($info_box_contents as $categ_arr_link_v) {
//    for ($i=0; isset($info_box_contents[$i]['link']); $i++) {
	  $sub_l_add='';
	  $img_prod='background:url(images/item.gif) no-repeat left 6px';
	  $color0=' class="menu_text" style="vertical-align:middle;'.$img_prod.';padding:5px 0px 5px 15px"';
	  echo $sub_l_add.$categ_arr_link_v['link'].$categ_arr_link_v['name'].'</a><br>';
//      echo '<tr><td width="10" style="padding:0 0 0 15px">'. tep_image(DIR_WS_IMAGES . 'item.gif') .'</td>
//      <td class="best_sell">'.$info_box_contents[$i]['link'].$info_box_contents[$i]['name'].' </a></td>
//      </tr>
//      ';
//print_r($categ_arr_link_v);
	}
	echo '</div>';
  } else {
  echo 'We have no item';
  }
?>