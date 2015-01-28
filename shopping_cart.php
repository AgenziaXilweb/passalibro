<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2010 osCommerce

Released under the GNU General Public License
*/

require ("includes/application_top.php");

if ($cart->count_contents() > 0) {
    include (DIR_WS_CLASSES . 'payment.php');
    $payment_modules = new payment;
}

require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOPPING_CART);

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_SHOPPING_CART));

require (DIR_WS_INCLUDES . 'template_top.php');
?>

<h1><?php echo HEADING_TITLE; ?></h1>

<font size="3">Attenzione!!! Il carrello viene svuotato automaticamente dopo un'ora dal login.</font>
<h1>Tutti i libri disponibili possono essere ritirati 24 ore dopo l’ordine per i libri prenotati verrete avvisati con sms o mail</h1>

<?php

if ($cart->count_contents() > 0) {
?>

<?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_SHOPPING_CART,'action=update_product')); ?>

<div class="contentContainer">
  <h2><?php echo TABLE_HEADING_PRODUCTS; ?></h2>

  <div class="contentText">
<?php
    $any_out_of_stock = 0;
    $products = $cart->get_products();
    for ($i = 0, $n = sizeof($products); $i < $n; $i++) {
        // Push all attributes information in an array
        #Bisogna definire gli attributi per gli articoli usati
        if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
            while (list($option, $value) = each($products[$i]['attributes'])) {
                echo tep_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);
                $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
                                      from " . TABLE_PRODUCTS_OPTIONS .
                    " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " .
                    TABLE_PRODUCTS_ATTRIBUTES . " pa
                                      where pa.products_id = '" . (int)$products[$i]['id'] .
                    "'
                                       and pa.options_id = '" . (int)$option .
                    "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . (int)$value .
                    "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . (int)$languages_id .
                    "'
                                       and poval.language_id = '" . (int)$languages_id .
                    "'");
                $attributes_values = tep_db_fetch_array($attributes);

                $products[$i][$option]['products_options_name'] = $attributes_values['products_options_name'];
                $products[$i][$option]['options_values_id'] = $value;
                $products[$i][$option]['products_options_values_name'] = $attributes_values['products_options_values_name'];
                $products[$i][$option]['options_values_price'] = $attributes_values['options_values_price'];
                $products[$i][$option]['price_prefix'] = $attributes_values['price_prefix'];
            }
        }
    }
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="0">

<?php
// modifica per la stampa delle immagini con variabile $pictures
    for ($i = 0, $n = sizeof($products); $i < $n; $i++) {

// Marco - 04/03/2013 modifica per la stampa delle immagini con variabile $pictures - se immagine <ISBN>.png esiste stampo <ISBN>.png in alternativa stampo immagine nopic.png       

$pictures = file_exists(DIR_WS_ISBN . $products[$i]['image'])? DIR_WS_ISBN . $products[$i]['image']: DIR_WS_IMAGES . 'nopic.png';

// modifica per la stampa delle immagini con variabile $pictures

        echo '      <tr>';
        $products_name = '<table border="0" cellspacing="2" cellpadding="2">' . '  <tr>' .
            '    <td align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO,
            'products_id=' . $products[$i]['id']) . '">' . tep_image($pictures,
            $products[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td>' .
            '    <td valign="top"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO,
            'products_id=' . $products[$i]['id']) . '"><strong>' . $products[$i]['name'] .
            '</strong></a>';

        if (STOCK_CHECK == 'true') {
            
            $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity'], $products[$i]['used_quantity']);
            if (tep_not_null($stock_check)) {
                $any_out_of_stock = 1;
                $products_name .= $stock_check;
            }
        }

        if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
            reset($products[$i]['attributes']);
            while (list($option, $value) = each($products[$i]['attributes'])) {
                $products_name .= '<br /><small><i> - ' . $products[$i][$option]['products_options_name'] .
                    ' ' . $products[$i][$option]['products_options_values_name'] . '</i></small>';
            }
        }
  
  ############## CREO LE INPUT TEXT DI AGGIORNAMENTO E RIMOZIONE

$query_controllo = tep_db_query("SELECT sede_impegno_qta_n FROM " . TABLE_CUSTOMERS_BASKET . " WHERE customers_id = " . (int)$customer_id . " AND products_id = " . $products[$i]['id'] . "");

$sede_prodotto = tep_db_fetch_array($query_controllo);

//if ($sede_prodotto['sede_impegno_qta_n'] == null) {
//    
//    echo "<div class='popup_block' style='display: block;'>Attenzione il prodotto: <br>" . $products[$i]['name'] . "<br> NON HA GIACENZE!!</div>";
//    
//}
//
  
        $products[$i]['products_quantity']< 1 ? $readonly_n='readonly="readonly"': $readonly_n='';
        $products[$i]['products_used_quantity'] < 1 ? $readonly_u='readonly="readonly"': $readonly_u='';
                
#        if($products[$i]['used_quantity'] > 0 && $products[$i]['quantity'] > 0 && $products[$i]['reserved_quantity'] > 0){
            
            $products_name .= '<br /><br /><label> Nuovo: </label>' . tep_draw_input_field('cart_quantity[]', $products[$i]['quantity'],
            'onChange="javascript:document.cart_quantity.submit();" size="2"'.$readonly_n) . '<label> Usato: </label>'. tep_draw_input_field('cart_used_quantity[]', $products[$i]['used_quantity'],'onChange="javascript:document.cart_quantity.submit();" size="2"'.$readonly_u) .
            '<label> Prenotato: </label>'. tep_draw_input_field('cart_reserved_quantity[]', $products[$i]['reserved_quantity'],'size="2"') .
            tep_draw_hidden_field('products_id[]', $products[$i]['id']) . '<br><br>' . tep_draw_other_button(IMAGE_BUTTON_UPDATE,
            'refresh') . '&nbsp;&nbsp;&nbsp;'.TEXT_OR .'&nbsp;&nbsp;&nbsp;'.tep_draw_other_button('Rimuovi', 'delete', tep_href_link(FILENAME_SHOPPING_CART,'products_id=' . $products[$i]['id'] . '&action=remove_product'));
            
#        }elseif($products[$i]['used_quantity'] > 0 && $products[$i]['quantity'] > 0 && $products[$i]['reserved_quantity'] == 0){
#           
#           $products_name .= '<br /><br /><label> Nuovo: </label>' . tep_draw_input_field('cart_quantity[]', $products[$i]['quantity'],
#            'size="1"'.$readonly_n) . '<label> Usato: </label>'. tep_draw_input_field('cart_used_quantity[]', $products[$i]['used_quantity'],'size="1"'.$readonly_u) . 
#            tep_draw_hidden_field('products_id[]', $products[$i]['id']) . '<br><br>' . tep_draw_button(IMAGE_BUTTON_UPDATE,
#            'refresh') . '&nbsp;&nbsp;&nbsp;or <a class="remove" href="' . tep_href_link(FILENAME_SHOPPING_CART,
#            'products_id=' . $products[$i]['id'] . '&action=remove_product') .
#            '">remove</a>'; 
#            
#        }elseif($products[$i]['used_quantity'] > 0 && $products[$i]['quantity'] == 0 && $products[$i]['reserved_quantity'] == 0){
#           
#           $products_name .= '<br /><br /><label> Usato: </label>' . tep_draw_input_field('cart_used_quantity[]', $products[$i]['used_quantity'],
#            'size="1"'.$readonly_u) . tep_draw_hidden_field('products_id[]', $products[$i]['id']) . '<br><br>' . tep_draw_button(IMAGE_BUTTON_UPDATE,
#            'refresh') . '&nbsp;&nbsp;&nbsp;or <a class="remove" href="' . tep_href_link(FILENAME_SHOPPING_CART,
#            'products_id=' . $products[$i]['id'] . '&action=remove_product') .
#            '">remove</a>'; 
#            
#        }elseif($products[$i]['used_quantity'] == 0 && $products[$i]['quantity'] > 0 && $products[$i]['reserved_quantity'] > 0){
#            
#            $products_name .= '<br /><br /><label> Nuovo: </label>'. tep_draw_input_field('cart_quantity[]', $products[$i]['quantity'],'size="1"'.$readonly_n) .
#            '<label> Prenotato: </label>'. tep_draw_input_field('cart_reserved_quantity[]', $products[$i]['reserved_quantity'],'size="1"') .
#            tep_draw_hidden_field('products_id[]', $products[$i]['id']) . '<br><br>' . tep_draw_button(IMAGE_BUTTON_UPDATE,
#            'refresh') . '&nbsp;&nbsp;&nbsp;or <a class="remove" href="' . tep_href_link(FILENAME_SHOPPING_CART,
#            'products_id=' . $products[$i]['id'] . '&action=remove_product') .
#            '">remove</a>';
#        }elseif($products[$i]['used_quantity'] == 0 && $products[$i]['quantity'] == 0 && $products[$i]['reserved_quantity'] > 0){
#            
#            $products_name .= '<br /><label> Prenotato: </label>'. tep_draw_input_field('cart_reserved_quantity[]', $products[$i]['reserved_quantity'],'size="1"') .
#            tep_draw_hidden_field('products_id[]', $products[$i]['id']) . '<br><br>' . tep_draw_button(IMAGE_BUTTON_UPDATE,
#            'refresh') . '&nbsp;&nbsp;&nbsp;or <a class="remove" href="' . tep_href_link(FILENAME_SHOPPING_CART,
#            'products_id=' . $products[$i]['id'] . '&action=remove_product') .
#            '">remove</a>';
#        }elseif($products[$i]['used_quantity'] > 0 && $products[$i]['quantity'] == 0 && $products[$i]['reserved_quantity'] > 0){
#            
#            $products_name .= '<br /><label> Usato: </label>'. tep_draw_input_field('cart_used_quantity[]', $products[$i]['used_quantity'],'size="1"'.$readonly_u) .
#            '<label> Prenotato: </label>'. tep_draw_input_field('cart_reserved_quantity[]', $products[$i]['reserved_quantity'],'size="1"') . 
#            tep_draw_hidden_field('products_id[]', $products[$i]['id']) . '<br><br>' . tep_draw_button(IMAGE_BUTTON_UPDATE,
#            'refresh') . '&nbsp;&nbsp;&nbsp;or <a class="remove" href="' . tep_href_link(FILENAME_SHOPPING_CART,
#            'products_id=' . $products[$i]['id'] . '&action=remove_product') .
#            '">remove</a>';
#            
#        }elseif($products[$i]['used_quantity'] == 0 && $products[$i]['quantity'] > 0 && $products[$i]['reserved_quantity'] == 0){
#            
#            $products_name .= '<br /><label> Nuovo: </label>'. tep_draw_input_field('cart_quantity[]', $products[$i]['quantity'],'size="1"'.$readonly_n) .
#            tep_draw_hidden_field('products_id[]', $products[$i]['id']) . '<br><br>' . tep_draw_button(IMAGE_BUTTON_UPDATE,
#            'refresh') . '&nbsp;&nbsp;&nbsp;or <a class="remove" href="' . tep_href_link(FILENAME_SHOPPING_CART,
#            'products_id=' . $products[$i]['id'] . '&action=remove_product') .
#            '">remove</a>';
#        }

        $products_name .= '    </td>' . '  </tr>' . '</table>';

        echo '        <td valign="top">' . $products_name . '</td>' .
            '        <td align="center" valign="top"><strong>Totale Nuovo<br>' . $currencies->
            display_price($products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']),
            $products[$i]['quantity']+$products[$i]['reserved_quantity']) . '</strong></td>' .
            '        <td align="center" valign="top"><strong>Totale Usato<br>' . $currencies->
            display_price($products[$i]['used_final_price'], tep_get_tax_rate($products[$i]['tax_class_id']),
            $products[$i]['used_quantity']) . '</strong></td>' . '      </tr>';
    }
?>

    </table>

    <p align="right"><strong><?php echo SUB_TITLE_SUB_TOTAL; ?> <?php echo $currencies->
format($cart->show_total()); ?></strong></p>

<?php
    if ($any_out_of_stock == 1) {
        if (STOCK_ALLOW_CHECKOUT == 'true') {
?>

    <p class="stockWarning" align="center"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></p>

<?php
        } else {
?>

    <p class="stockWarning" align="center"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></p>

<?php
        }
    }
?>

  </div>

  <div class="buttonSet">
    <span class="buttonAction"><?php echo tep_draw_other_button(IMAGE_BUTTON_CHECKOUT,
'triangle-1-e', tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'), 'primary'); ?></span>
  </div>

<?php
    $initialize_checkout_methods = $payment_modules->checkout_initialization_method();

    if (!empty($initialize_checkout_methods)) {
?>

  <p align="right" style="clear: both; padding: 15px 50px 0 0;"><?php echo
TEXT_ALTERNATIVE_CHECKOUT_METHODS; ?></p>

<?php
        reset($initialize_checkout_methods);
        while (list(, $value) = each($initialize_checkout_methods)) {
?>

  <p align="right"><?php echo $value; ?></p>
<?php
        }
    }
?>

</div>

</form>

<?php
} else {
?>

<div class="contentContainer">
  <div class="contentText">
    <?php echo TEXT_CART_EMPTY; ?>

    <p align="right"><?php echo tep_draw_other_button(IMAGE_BUTTON_CONTINUE,
'triangle-1-e', tep_href_link(FILENAME_DEFAULT)); ?></p>
  </div>
</div>

<?php
}

require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>
