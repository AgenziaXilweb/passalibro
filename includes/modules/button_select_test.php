<?php

if($listing['products_ebay'] == 0){
    
    if (($listing['products_quantity'] > 0) && ($listing['products_used_quantity'] > 0)) {
                        
    echo 'test 1';

    $prod_list_contents .= ' <td width="15%" align="center">' . tep_draw_button(IMAGE_BUTTON_BUY_NOW . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_price'])) . '</b>'.TEXT_SHIPPING_DELIVERY_TIME_NEW,
    'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) .
    'action=buy_now&products_id=' . $listing['products_id']),null ,null, 'nuovo') . '<br>' .
    tep_draw_button(IMAGE_BUTTON_BUY_NOW_USED . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_used_price'])) . '</b>'. TEXT_SHIPPING_DELIVERY_TIME_USED, 'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) .
    'action=buy_used_now&products_id=' . $listing['products_id']),null ,null, 'usato'). '</td>';

    }  elseif (($listing['products_used_quantity'] > 0) && ($listing['products_quantity'] == 0)) {

    echo 'test 2';

    $prod_list_contents .=
                            
    $listing['products_bookable'] == 1 ?
    
    ' <td width="15%" align="center">' . tep_draw_button(IMAGE_BUTTON_RESERVE_NOW . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_price'])) . '</b>'.TEXT_SHIPPING_DELIVERY_TIME_RESERVED,
    'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=reserve_now&products_id=' . $listing['products_id']),null ,null, 'prenotato') . '<br>' .
    
    tep_draw_button(IMAGE_BUTTON_BUY_NOW_USED . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_used_price'])) . '</b>'.TEXT_SHIPPING_DELIVERY_TIME_USED, 'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) .
    'action=buy_used_now&products_id=' . $listing['products_id']),null ,null, 'usato') . '</td>'
    
    :
    
    ' <td width="15%" align="center">' . tep_draw_button(IMAGE_BUTTON_BUY_NOW_USED . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_used_price'])) . '</b>'.TEXT_SHIPPING_DELIVERY_TIME_USED, 'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) .
    'action=buy_used_now&products_id=' . $listing['products_id']),null ,null, 'usato') . '</td>';

    }  elseif (($listing['products_used_quantity'] == 0) && ($listing['products_quantity'] == 0)) {

    echo 'test n';

    $prod_list_contents .=
                            
    $listing['products_bookable'] == 1 ?
    
    ' <td width="15%" align="center">' . tep_draw_button(IMAGE_BUTTON_RESERVE_NOW . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_price'])) . '</b>'.TEXT_SHIPPING_DELIVERY_TIME_RESERVED,
    'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=reserve_now&products_id=' . $listing['products_id']),null ,null, 'prenotato') . '</td>'
    
    :
    
    '<td width="15%" align="center">Non Prenotabile</td>';

    } elseif (($listing['products_used_quantity'] == 0) && ($listing['products_quantity'] > 0)) {

    echo 'test 3';

    $prod_list_contents .= '<td width="15%" align="center">' . tep_draw_button(IMAGE_BUTTON_BUY_NOW . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_price'])) . '</b>'.TEXT_SHIPPING_DELIVERY_TIME_NEW,
                            'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) .
                            'action=buy_now&products_id=' . $listing['products_id']),null ,null, 'nuovo') . '</td>';

    }      
}

                    
if($listing['products_ebay'] == 1){
    
    if (($listing['products_quantity'] > 0) && ($listing['products_used_quantity'] > 0)) {
                        
    echo 'test ebay 1';

    $prod_list_contents .= ' <td width="15%" align="center">' . tep_draw_button(IMAGE_BUTTON_BUY_NOW . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_price'])) . '</b>'.TEXT_SHIPPING_DELIVERY_TIME_NEW,
    'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) .
    'action=buy_now&products_id=' . $listing['products_id']),null ,null, 'nuovo') . '<br>' .
    tep_draw_button(IMAGE_BUTTON_BUY_NOW_USED . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_used_price'])) . '</b>'. TEXT_SHIPPING_DELIVERY_TIME_USED, 'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) .
    'action=buy_used_now&products_id=' . $listing['products_id']),null ,null, 'usato'). '</td>';

    }  elseif (($listing['products_used_quantity'] > 0) && ($listing['products_quantity'] == 0)) {

    echo 'test ebay 2';

    $prod_list_contents .= ' <td width="15%" align="center">' . tep_draw_button(IMAGE_BUTTON_BUY_NOW_USED . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_used_price'])) . '</b>'.TEXT_SHIPPING_DELIVERY_TIME_USED, 'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) .
    'action=buy_used_now&products_id=' . $listing['products_id']),null ,null, 'usato') . '</td>';

    } elseif (($listing['products_used_quantity'] == 0) && ($listing['products_quantity'] > 0)) {

    echo 'test ebay 3';

    $prod_list_contents .= '<td width="15%" align="center">' . tep_draw_button(IMAGE_BUTTON_BUY_NOW . '<br><b>&euro;' . str_replace('.',',',money_format('%.2n', $listing['products_price'])) . '</b>'.TEXT_SHIPPING_DELIVERY_TIME_NEW,
                            'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) .
                            'action=buy_now&products_id=' . $listing['products_id']),null ,null, 'nuovo') . '</td>';

    } elseif (($listing['products_used_quantity'] == 0) && ($listing['products_quantity'] == 0)) {

    echo 'test ebay 4';

                        $prod_list_contents .='<td width="15%" align="center">Non Prenotabile</td>';

    }    
}

?>