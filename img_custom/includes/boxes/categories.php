<?php
/*
  $Id: categories.php,v 1.25 2003/07/09 01:13:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
  function tep_show_category($counter) {
    global $tree, $categories_string, $cPath_array;
    static $ker, $k=0 , $ret=array();
    $pro = '';

    if (isset($cPath_array) && in_array($counter, $cPath_array)) {
      $pro = 'now';
    }
    
  $categories_string .= '<a class="'.$pro.'" href="';

    if ($tree[$counter]['parent'] == 0) {
      $cPath_new = 'cPath=' . $counter;
    } else {
      $cPath_new = 'cPath=' . $tree[$counter]['path'];
    }

    $categories_string .= tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">';


// display category name
    $categories_string .= $tree[$counter]['name'];

    if (tep_has_category_subcategories($counter)) {
      $categories_string .= ' ...';
      $categories_string .= '</a>';
    }
      else {
    $categories_string .= '</a>';
}

    if (SHOW_COUNTS == 'true') {
      $products_in_category = tep_count_products_in_category($counter);
      if ($products_in_category > 0) {
        $categories_string .= ' (' . $products_in_category . ')';
      }
    }
    
  $ret[$k++] = array($categories_string,$tree[$counter]['level']);
  $categories_string ='';
  
    if ($tree[$counter]['next_id'] != false) {
      tep_show_category($tree[$counter]['next_id']);
    }
    return($ret);
  }
?>
<!-- categories -->
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_CATEGORIES);

//  new infoBoxHeading($info_box_contents, true, false);

  $categories_string = '';
  $tree = array();

  $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '0' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
  while ($categories = tep_db_fetch_array($categories_query))  {
    $tree[$categories['categories_id']] = array('name' => $categories['categories_name'],
                                                'parent' => $categories['parent_id'],
                                                'level' => 0,
                                                'path' => $categories['categories_id'],
                                                'next_id' => false);

    if (isset($parent_id)) {
      $tree[$parent_id]['next_id'] = $categories['categories_id'];
    }

    $parent_id = $categories['categories_id'];

    if (!isset($first_element)) {
      $first_element = $categories['categories_id'];
    }
  }

  //------------------------
  if (tep_not_null($cPath)) {
    $new_path = '';
    reset($cPath_array);
    while (list($key, $value) = each($cPath_array)) {
      unset($parent_id);
      unset($first_id);
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$value . "' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
      if (tep_db_num_rows($categories_query)) {
        $new_path .= $value;
        while ($row = tep_db_fetch_array($categories_query)) {
          $tree[$row['categories_id']] = array('name' => $row['categories_name'],
                                               'parent' => $row['parent_id'],
                                               'level' => $key+1,
                                               'path' => $new_path . '_' . $row['categories_id'],
                                               'next_id' => false);

          if (isset($parent_id)) {
            $tree[$parent_id]['next_id'] = $row['categories_id'];
          }

          $parent_id = $row['categories_id'];

          if (!isset($first_id)) {
            $first_id = $row['categories_id'];
          }

          $last_id = $row['categories_id'];
        }
        $tree[$last_id]['next_id'] = $tree[$value]['next_id'];
        $tree[$value]['next_id'] = $first_id;
        $new_path .= '_';
      } else {
        break;
      }
    }
  }
  $categ_arr_link = array();
  $categ_arr_link = tep_show_category($first_element);

	echo '<tr><td valign="top">';
	echo '<div id="box_categories_heading" class="lefttext">'.BOX_HEADING_CATEGORIES.'</div>';
	echo '<div id="box_categories">';
	foreach ($categ_arr_link as $categ_arr_link_v) {
	$sub_l_add='';
	$img_prod='background:url(images/item.gif) no-repeat left';
	$color0=' style="vertical-align:middle;'.$img_prod.';padding:0 0 0 15px"';
	  for ($i=0; $i<$categ_arr_link_v[1];$i++){
		$sub_l_add .="";
		$img_prod='';
		$color0=' style="'.$img_prod.';padding:0 0 0 15px"';
	  }		
	   if ($i>0) {$sub_l_add = tep_image(DIR_WS_IMAGES . 'spacer.gif', '','10','10','style="float:left"').$sub_l_add;}
	echo $sub_l_add.$categ_arr_link_v[0].'<br>';
	
	}
	echo '<a href="'.tep_href_link('all.php').'" class="menu_all"> View All categories</a>';
	echo '</div>';
	
	echo '</td></tr>';
?>
<!-- categories_eof //-->
