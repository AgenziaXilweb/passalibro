<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);
  # LINK PER QRCODE
  #$product_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  #######
  $product_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
  $product_check = tep_db_fetch_array($product_check_query);

  require(DIR_WS_INCLUDES . 'template_top.php');

  if ( $product_check['total'] < 1 ) {
    
?>
 
<div class="contentContainer">
  <div class="contentText">
    <?php echo TEXT_PRODUCT_NOT_FOUND; ?>
  </div>

  <div style="float: right;">
    <?php echo tep_draw_other_button(IMAGE_BUTTON_CONTINUE, 'triangle-1-e', tep_href_link(FILENAME_DEFAULT)); ?>
  </div>
</div>

<?php
  } else {
    $product_info_query = tep_db_query("select p.products_ebay, p.products_used_quantity, p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_used_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id, ABS(pm.qta_giacenza_u) - ABS(pm.soglia_web_u) - ABS(pm.impegnato_web_u) as usato, ABS(pm.qta_giacenza_n) - ABS(pm.soglia_web_n) - ABS(pm.impegnato_web_n) as nuovo, pm.cod_chiave, pm.sede from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . MAGAZZINO . " pm where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);

    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and language_id = '" . (int)$languages_id . "'");

    if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
      $products_price = '<del>' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</del> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
      $products_used_price = '<del>' . $currencies->display_price($product_info['products_used_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</del> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';  
    } else {
      $products_price = $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
      $products_used_price = $currencies->display_price($product_info['products_used_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
    }

    if (tep_not_null($product_info['products_model'])) {
      $products_name = $product_info['products_name'] . '<br /><span class="smallText">ISBN: ' . $product_info['products_model'] . '</span>';
    } else {
      $products_name = $product_info['products_name'];
    }
?>

<?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO , tep_get_all_get_params(array('action')) . 'action=add_product')); ?>
<div>
  <h1><?php echo $products_name; ?></h1>
</div>

<div class="contentContainer">
  <div class="contentText">

<?php
    if (tep_not_null($product_info['products_image'])) {
      $pi_query = tep_db_query("select image, htmlcontent from " . TABLE_PRODUCTS_IMAGES . " where products_id = '" . (int)$product_info['products_id'] . "' order by sort_order");

      if (tep_db_num_rows($pi_query) > 0) {
?>

    <div id="piGal" style="float: right;">
      <ul>

<?php
        $pi_counter = 0;
        while ($pi = tep_db_fetch_array($pi_query)) {
        
          $pi_counter++;

          $pi_entry = '        <li><a href="';

          if (tep_not_null($pi['htmlcontent'])) {
            $pi_entry .= '#piGalimg_' . $pi_counter;
          } else {

            $pi_entry .= tep_href_link(DIR_WS_ISBN . $pi['image'], '', 'NONSSL', false);
          }

          $pi_entry .= '" target="_blank" rel="fancybox">' . tep_image(DIR_WS_ISBN . $pi['image']) . '</a>';

          if (tep_not_null($pi['htmlcontent'])) {
            $pi_entry .= '<div style="display: none;"><div id="piGalimg_' . $pi_counter . '">' . $pi['htmlcontent'] . '</div></div>';
          }

          $pi_entry .= '</li>';

          echo $pi_entry;
        }
?>

      </ul>
    </div>

<script type="text/javascript">
$('#piGal ul').bxGallery({
  maxwidth: 300,
  maxheight: 200,
  thumbwidth: <?php echo (($pi_counter > 1) ? '75' : '0'); ?>,
  thumbcontainer: 300,
  load_image: 'ext/jquery/bxGallery/spinner.gif'
});
</script>

<?php
      } else {
?>

    <div id="piGal" style="float: right;">
      
      <?php 
        $ebay_image=$product_info['products_ebay']==true?$product_info['products_image']:DIR_WS_IMAGES . 'nopic.png';
        $pictures = file_exists(DIR_WS_ISBN . $product_info['products_image'])? DIR_WS_ISBN . $product_info['products_image']: $ebay_image;
        echo '<a href="' . tep_href_link($pictures, '', 'NONSSL', false) . '" target="_blank" rel="fancybox">' . tep_image($pictures, addslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, null, 'hspace="5" vspace="5"') . '</a>'; 
      
      ?>
    
    </div>

<?php
      }
?>

<script type="text/javascript">
$("#piGal a[rel^='fancybox']").fancybox({
  cyclic: true
});
</script>

<?php
    }
?>

<?php echo stripslashes($product_info['products_description']); ?>

<?php
    $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
?>

    <p><?php echo TEXT_PRODUCT_OPTIONS; ?></p>

    <p>
<?php
      $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_name");
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {

        $products_options_array = array();
        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
        while ($products_options = tep_db_fetch_array($products_options_query)) {
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          }
        }


        if (is_string($HTTP_GET_VARS['products_id']) && isset($cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']])) {
          $selected_attribute = $cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        }
?>
      <strong><?php echo $products_options_name['products_options_name'] . ':'; ?></strong><br /><?php 
      
      
      #echo tep_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute) . "<br>";
      echo tep_draw_radio_field('id[' . $products_options_name['products_options_id'] . ']', $products_options_array[1]['id'] , 'true'), $products_options_array[1]['text'] . '<br>';
      echo tep_draw_radio_field('id[' . $products_options_name['products_options_id'] . ']',$products_options_array[0]['id']), $products_options_array[0]['text'];
      
      
      ?><br />
<?php
      }
?>
    </p>

<?php
    }
?>

    

<?php
    if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
?>

    <p style="text-align: center;"><?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($product_info['products_date_available'])); ?></p>

<?php
    }
?>

  </div>

<?php
    $reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and reviews_status = 1");
    $reviews = tep_db_fetch_array($reviews_query);
?>
<div class="buttonSet">
  
    <span class="buttonAction"><?php 
    
    $nuovo = tep_draw_button('Compra Nuovo <b>'.$products_price.'</b>', 'cart', tep_href_link(FILENAME_PRODUCT_INFO, urldecode(tep_get_all_get_params()) . 'action=buy_now'), 'primary',null,'nuovo');
    $usato = tep_draw_button('Compra Usato <b>'.$products_used_price.'</b>', 'cart', tep_href_link(FILENAME_PRODUCT_INFO, urldecode(tep_get_all_get_params()) . 'action=buy_used_now'), 'primary',null,'usato');
    $prenotato = tep_draw_button('Prenota Nuovo <b>'.$products_price.'</b>', 'cart', tep_href_link(FILENAME_PRODUCT_INFO, urldecode(tep_get_all_get_params()) . 'action=reserve_now'), 'primary',null,'prenotato');
    
    
    echo tep_draw_hidden_field('products_id', $product_info['products_id']); 
    
    if($product_info['products_quantity'] == 0) {
      
      $checkebay=$product_info['products_ebay'] == false?$prenotato:'';
      
        echo $checkebay;
            
        if ($product_info['products_used_quantity'] > 0){
      
        echo $usato;
                
        }
        
               
    }elseif ($product_info['nuovo'] > 0) {
       
       echo $nuovo;
       
       if ($product_info['usato'] > 0){
      
        echo $usato;
                
        }
        
    }
           
     ?>
     </span>

    <?php echo tep_draw_other_button(IMAGE_BUTTON_REVIEWS . (($reviews['count'] > 0) ? ' (' . $reviews['count'] . ')' : ''), 'comment', tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params())); ?>
    <?php echo tep_draw_other_button(IMAGE_BUTTON_BACK, 'triangle-1-w', tep_href_link('index.php', tep_get_all_get_params(array('action')))); ?>
</div>
<?php
    if ((USE_CACHE == 'true') && empty($SID)) {
      echo tep_cache_also_purchased(3600);
    } else {
      include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
    }
?>

</div>

</form>
<!-- QRCODE 
<p><img src="http://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?php #echo $product_url; ?>" alt="QR:
<?php $product_info['products_name']; ?>" title="<?php $product_info['products_name']; ?>"/></p>
 FINE QRCODE -->
<?php
  }

  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
