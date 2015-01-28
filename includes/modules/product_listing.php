<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2010 osCommerce

Released under the GNU General Public License
*/

$listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS,
    'p.products_id');
?>

  <div class="contentText">

<?php
if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') ||
    (PREV_NEXT_BAR_LOCATION == '3'))) {
?>

    <div>
      <span><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></span>
    </div>
    <div id="pg"><span style="float: right;"><?php echo $listing_split->
display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array(
        'page',
        'info',
        'x',
        'y'))); ?>
        </span></div>

    <br />

<?php
}

$prod_list_contents = '<div class="mediagroove"><div>' .
    '    <table><caption>' . TEXT_RESULT_PAGE . '</caption>' .
    '      <thead><tr>';

for ($col = 0, $n = sizeof($column_list); $col < $n; $col++) {
    $lc_align = '';

    switch ($column_list[$col]) {
        case 'PRODUCT_LIST_MODEL':
            $lc_text = '<th width="15%">' . TABLE_HEADING_MODEL . '</th>';
            $lc_align = '';
            break;
        case 'PRODUCT_LIST_NAME':
            $lc_text = '<th width="51%">' . TABLE_HEADING_PRODUCTS. '</th>';
            $lc_align = '';
            break;
        case 'PRODUCT_LIST_MANUFACTURER':
            $lc_text = '<th width="5%">' . TABLE_HEADING_MANUFACTURER. '</th>';
            $lc_align = '';
            break;
        case 'PRODUCT_LIST_PRICE':
            $lc_text = '<th width="5%">' . TABLE_HEADING_PRICE. '</th>';
            $lc_align = 'right';
            break;
        case 'PRODUCT_LIST_PRICE_USED':
            $lc_text = '<th width="5%">' . TABLE_HEADING_PRICE_USED. '</th>';
            $lc_align = 'right';
            break;
            ####### BLOCCATA LA VISUALIZZAZIONE QTA SU RICHIESTA PASSALIBRO ####
            #      case 'PRODUCT_LIST_QUANTITY':
            #        $lc_text = ''; #TABLE_HEADING_QUANTITY;
            #        $lc_align = 'right';
            #        break;
            #      case 'PRODUCT_LIST_QUANTITY_USED':
            #        $lc_text = ''; #TABLE_HEADING_QUANTITY;
            #        $lc_align = 'right';
            #        break;
            ####################################################################
        case 'PRODUCT_LIST_WEIGHT':
            $lc_text = '<th width="25%">' . TABLE_HEADING_WEIGHT . '</th>';
            $lc_align = 'right';
            break;
        case 'PRODUCT_LIST_IMAGE':
            $lc_text = '<th width="17%">' . TABLE_HEADING_IMAGE . '</th>';
            $lc_align = 'center';
            break;
        case 'PRODUCT_LIST_BUY_NOW':
            $lc_text ='<th width="25%">' . TABLE_HEADING_BUY_NOW . '</th>';
            $lc_align = 'center';
            break;
    }

    if (($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] !=
        'PRODUCT_LIST_IMAGE')) {
        empty($lc_text) ? '' : $lc_text = tep_create_sort_heading($HTTP_GET_VARS['sort'],
            $col + 1, $lc_text);
    }
    ### MODIFICA PASSALIBRO: EVITO CHE VENGANO CREATE LE COLONNE DELLE QTA NUOVO/USATO ################################
    if (($column_list[$col] == 'PRODUCT_LIST_QUANTITY_USED') || ($column_list[$col] ==
        'PRODUCT_LIST_QUANTITY'))
        continue; 
    ###################################################################################################################
    $prod_list_contents .= '        <td' . (tep_not_null($lc_align) ? ' align="' . $lc_align .
        '"' : '') . '>' . $lc_text . '</td>';
}

$prod_list_contents .= '      </tr></thead>' . '    </table>' . '  </div>';

if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing_query = tep_db_query($listing_split->sql_query);

    $prod_list_contents .=
        '  <div class="mediagroove">'.
        '    <table>';

    while ($listing = tep_db_fetch_array($listing_query)) {

    if($listing['products_ebay']==true){

    $pictures=$listing['products_image']==''? 'http://p.ebaystatic.com/aw/pics/nextGenVit/imgNoImg.gif':$listing['products_image'];

    }else{

    $pictures = file_exists(DIR_WS_ISBN . $listing['products_image'])? DIR_WS_ISBN . $listing['products_image']:DIR_WS_IMAGES . 'nopic.png';

    }

        $rows++;
        $prod_list_contents .= '      <tr>';

        for ($col = 0, $n = sizeof($column_list); $col < $n; $col++) {

            switch ($column_list[$col]) {
                case 'PRODUCT_LIST_MODEL':
                    $prod_list_contents .= '        <td width="15%"><center>' . $listing['products_model'] . '</center></td>';
                    break;
                case 'PRODUCT_LIST_NAME':
                    if (isset($HTTP_GET_VARS['manufacturers_id']) && tep_not_null($HTTP_GET_VARS['manufacturers_id'])) {
                        $prod_list_contents .= '<td width="50%">
                            <a href="' . tep_href_link(FILENAME_PRODUCT_INFO,
                            'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing['products_id']) .
                            '">' . $listing['products_name'] . '</a></br></br>
                            <b>Isbn:</b> '. $listing['products_model']. '
                            </td>';
                    } else {
                        $prod_list_contents .= '        <td width="50%"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO,
                            ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) .
                            '">' . $listing['products_name'] . '</a>
                            </br></br>
                            <b>Isbn:</b> '. $listing['products_model'].'</br>'.$listing['products_description'].'
                            </td>';
                    }
                    break;
                case 'PRODUCT_LIST_MANUFACTURER':
                    $prod_list_contents .= '        <td width="25%"><a href="' . tep_href_link(FILENAME_DEFAULT,
                        'manufacturers_id=' . $listing['manufacturers_id']) . '">' . $listing['manufacturers_name'] .
                        '</a></td>';
                    break;
                case 'PRODUCT_LIST_PRICE':
                    if (tep_not_null($listing['specials_new_products_price'])) {
                        $prod_list_contents .= '        <td width="25%" align="right"><del>' . $currencies->
                            display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) .
                            '</del>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->
                            display_price($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) .
                            '</span></td>';
                    } else {
                        $prod_list_contents .= '        <td width="25%" align="right">' . $currencies->
                            display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) .
                            '</td>';
                    }
                    break;
                case 'PRODUCT_LIST_PRICE_USED':
                    if (tep_not_null($listing['specials_new_products_price'])) {
                        $prod_list_contents .= '        <td width="25%" align="right"><del>' . $currencies->
                            display_price($listing['products_used_price'], tep_get_tax_rate($listing['products_tax_class_id'])) .
                            '</del>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->
                            display_price($listing['specials_new_products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) .
                            '</span></td>';
                    } else {
                        $prod_list_contents .= '        <td width="25%" align="right">' . $currencies->
                            display_price($listing['products_used_price'], tep_get_tax_rate($listing['products_tax_class_id'])) .
                            '</td>';
                    }
                    break;

                    /*bof stock announcement
                    case 'PRODUCT_LIST_QUANTITY':
                    $lc_align = 'right';
                    if ((STOCK_CHECK == 'true')&&($listing['products_quantity'] < 1)) {
                    $lc_text = '<td align="right">Non Disponibile</td>';
                    } elseif ((STOCK_CHECK == 'true')&&($listing['products_quantity'] > 0 )) {
                    $lc_text = '<td align="right">' . $listing['products_quantity'] . '</td>';
                    } else {
                    $lc_text = '&nbsp;' . $listing[$x]['products_quantity'] . '&nbsp;';
                    }
                    break;
                    eof stock announcement */

                case 'PRODUCT_LIST_QUANTITY':
                    #$prod_list_contents .= '        <td align="right">' . $listing['products_quantity'] . '</td>';
                    $prod_list_contents .= '';
                    break;
                case 'PRODUCT_LIST_QUANTITY_USED':
                    #$prod_list_contents .= '        <td align="right">' . $listing['products_quantity'] . '</td>';
                    $prod_list_contents .= '';
                    break;
                case 'PRODUCT_LIST_WEIGHT':
                    $prod_list_contents .= '        <td width="25%" align="right">' . $listing['products_weight'] .
                        '</td>';
                    break;
                case 'PRODUCT_LIST_IMAGE':
                    if (isset($HTTP_GET_VARS['manufacturers_id']) && tep_not_null($HTTP_GET_VARS['manufacturers_id'])) {
                        $prod_list_contents .= '        <td width="15%" align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO,
                            'manufacturers_id=' . $HTTP_GET_VARS['manufacturers_id'] . '&products_id=' . $listing['products_id']) .
                            '">' . tep_image($pictures, addslashes($product_info['products_name']),
                            SMALL_IMAGE_WIDTH) . '</a></td>';
                    } else {
                        $prod_list_contents .= '        <td width="5%" align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO,
                            ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing['products_id']) .
                            '">' . tep_image($pictures, addslashes($product_info['products_name']),
                            SMALL_IMAGE_WIDTH) . '</a></td>';
                    }
                    break;



#MODIFICATO PER PASSALIBRO MARCO 30/04/2013 16.30
                    
                case 'PRODUCT_LIST_BUY_NOW':

                    include('button_select.php');
                    
                    break;
            }
        }

        //          case 'PRODUCT_LIST_BUY_NOW':
        //          if ((STOCK_CHECK == 'true')&&($listing['products_quantity'] < 1)) {
        //            $prod_list_contents .= '        <td align="center">Prenotabile</td>';
        //            } elseif ((STOCK_CHECK == 'true')&&($listing['products_quantity'] > 0 )) {
        //            $prod_list_contents .= '        <td align="center">' . tep_draw_button(IMAGE_BUTTON_BUY_NOW, 'cart', tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'products_id')) . 'action=buy_now&products_id=' . $listing['products_id'])) . '</td>';
        //            } else {
        //      $lc_text = '&nbsp;' . $listing['products_quantity'] . '&nbsp;';
        //  }
        //            break;
        //        }
        //      }

        $prod_list_contents .= '      </tr>';
    }

    $prod_list_contents .= '    </table>' . '  </div>' . '</div>';


    echo $prod_list_contents;
} else {
?>

    <p><?php echo TEXT_NO_PRODUCTS; ?></p>

<?php
}

if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') ||
    (PREV_NEXT_BAR_LOCATION == '3'))) {
?>

    <br />

    <div>
      <span style="float: right;"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->
display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array(
        'page',
        'info',
        'x',
        'y'))); ?></span>

      <span><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></span>
    </div>

<?php
}
?>

  </div>
