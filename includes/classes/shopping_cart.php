<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2003 osCommerce

Released under the GNU General Public License
*/


class shoppingCart
{
    var $contents, $total, $weight, $cartID, $content_type;

    function shoppingCart()
    {
        $this->reset();
    }

    function restore_contents()
    {
        global $customer_id;

        if (!tep_session_is_registered('customer_id'))
            return false;

        // insert current cart contents in database
        if (is_array($this->contents)) {
            reset($this->contents);
            while (list($products_id, ) = each($this->contents)) {
                $qty = $this->contents[$products_id]['qty'];
                $used_qty = $this->contents[$products_id]['used_qty'];
                $reserved_qty = $this->contents[$products_id]['reserved_qty'];
                $product_query = tep_db_query("select products_id from " .
                    TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id .
                    "' and products_id = '" . tep_db_input($products_id) . "'");
                if (!tep_db_num_rows($product_query)) {
                    tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET .
                        " (customers_id, products_id, customers_basket_quantity, customers_basket_used_quantity, customers_basket_date_added, customers_basket_reserved_quantity) values ('" .
                        (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . tep_db_input
                        ($qty) . "', '" . ($used_qty) . "', '" . date('Ymd') . "', ".($reserved_qty).")");
                    if (isset($this->contents[$products_id]['attributes'])) {
                        reset($this->contents[$products_id]['attributes']);
                        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
                            tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES .
                                " (customers_id, products_id, products_options_id, products_options_value_id) values ('" .
                                (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . (int)$option .
                                "', '" . (int)$value . "')");
                        }
                    }
                } else {
                    tep_db_query("update " . TABLE_CUSTOMERS_BASKET .
                        " set customers_basket_quantity = '" . tep_db_input($qty) .
                        "' and customers_basket_used_quantity = '" . tep_db_input($used_qty) .
                        "' and customers_basket_reserved_quantity = '" . tep_db_input($reserved_qty) .
                        "' where customers_id = '" . (int)$customer_id . "' and products_id = '" .
                        tep_db_input($products_id) . "'");
                }
            }
        }

        // reset per-session cart contents, but not the database contents
        $this->reset(false);

        $products_query = tep_db_query("select products_id, customers_basket_quantity, customers_basket_used_quantity, customers_basket_reserved_quantity from " .
            TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "'");
        while ($products = tep_db_fetch_array($products_query)) {
            $this->contents[$products['products_id']] = array('qty' => $products['customers_basket_quantity'],
                    'used_qty' => $products['customers_basket_used_quantity'], 'reserved_qty' => $products['customers_basket_reserved_quantity']);
            // attributes
            $attributes_query = tep_db_query("select products_options_id, products_options_value_id from " .
                TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id .
                "' and products_id = '" . tep_db_input($products['products_id']) . "'");
            while ($attributes = tep_db_fetch_array($attributes_query)) {
                $this->contents[$products['products_id']]['attributes'][$attributes['products_options_id']] =
                    $attributes['products_options_value_id'];
            }
        }

        $this->cleanup();

        // assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
        $this->cartID = $this->generate_cart_id();
    }

    function reset($reset_database = false)
    {
        global $customer_id;

        $this->contents = array();
        $this->total = 0;
        $this->weight = 0;
        $this->content_type = false;

        if (tep_session_is_registered('customer_id') && ($reset_database == true)) {
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" .
                (int)$customer_id . "'");
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES .
                " where customers_id = '" . (int)$customer_id . "'");
        }

        unset($this->cartID);
        if (tep_session_is_registered('cartID'))
            tep_session_unregister('cartID');
        unset($_SESSION['sede']);
    }

    #MODIFICA PASSALIBRO: Aggiunta del parametro $type, con valore="used","new" o "reserved".
    
    #######################################################################################
    ###################### MODIFICATO PER DIVISIONE MAGAZZINI - MARCO #####################
    #######################################################################################
    
    function add_cart($products_id, $qty = '1', $attributes = '', $notify = true, $type, $data_school = null, $warehouse = null)
    {
        global $new_products_id_in_cart, $customer_id, $products_id_string;

        $products_id_string = tep_get_uprid($products_id, $attributes);
        $products_id = tep_get_prid($products_id_string);       
        

        if (defined('MAX_QTY_IN_CART') && (MAX_QTY_IN_CART > 0) && ((int)$qty >
            MAX_QTY_IN_CART)) {
            $qty = MAX_QTY_IN_CART;
        }

        $attributes_pass_check = true;

        if (is_array($attributes) && !empty($attributes)) {
            reset($attributes);
            while (list($option, $value) = each($attributes)) {
                if (!is_numeric($option) || !is_numeric($value)) {
                    $attributes_pass_check = false;
                    break;
                } else {
                    $check_query = tep_db_query("select products_attributes_id from " .
                        TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id .
                        "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value .
                        "' limit 1");
                    if (tep_db_num_rows($check_query) < 1) {
                        $attributes_pass_check = false;
                        break;
                    }
                }
            }
        } elseif (tep_has_product_attributes($products_id)) {
            $attributes_pass_check = false;
        }

        if (is_numeric($products_id) && is_numeric($qty) && ($attributes_pass_check == true)) {
            $check_product_query = tep_db_query("select products_status from " .
                TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
            $check_product = tep_db_fetch_array($check_product_query);

            if (($check_product !== false) && ($check_product['products_status'] == '1')) {
                if ($notify == true) {
                    $new_products_id_in_cart = $products_id;
                    tep_session_register('new_products_id_in_cart');
                }

                if ($this->in_cart($products_id_string)) {
                    switch ($type) {
                        case 'new':
                            $key_qty = 'qty';
                            break;
                        
                        case 'reserved':
                            $key_qty = 'reserved_qty';
                            break;

                        case 'used':
                            $key_qty = 'used_qty';
                            break;
                    }

                    $this->update_quantity($products_id_string, $qty, $attributes, $key_qty, $warehouse);

                } else {

                    switch ($type) {
                        case 'new':
                            $qta_n_u = array('qty' => (int)$qty, 'used_qty' => 0, 'reserved_qty' => 0, 'engagement_wh'=>(int)$warehouse);
                            break;
                            
                        case 'reserved':
                            $qta_n_u = array('reserved_qty' => (int)$qty, 'qty' => 0, 'used_qty' => 0);
                            break;

                        case 'used':
                            $qta_n_u = array('qty' => 0, 'reserved_qty' => 0, 'used_qty' => (int)$qty, 'engagement_wh'=>(int)$warehouse);
                            break;
                    }

                    $this->contents[$products_id_string] = $qta_n_u;
                    
                    // insert into database
                    if (tep_session_is_registered('customer_id'))                        
                        
                        tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET .
                            " (customers_id, products_id, customers_basket_quantity, customers_basket_used_quantity, customers_basket_date_added, data_school, customers_basket_reserved_quantity, warehouse) values ('" .
                            (int)$customer_id . "', '" . tep_db_input($products_id_string) . "', '" . (int)
                            $qta_n_u['qty'] . "', '" . $qta_n_u['used_qty'] . "', '" . date('Ymd') . "', '".$data_school."', ".$qta_n_u['reserved_qty'].", ".(int)$warehouse.")");

                    if (is_array($attributes)) {
                        reset($attributes);
                        while (list($option, $value) = each($attributes)) {
                            $this->contents[$products_id_string]['attributes'][$option] = $value;
                            // insert into database
                            if (tep_session_is_registered('customer_id'))
                                tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES .
                                    " (customers_id, products_id, products_options_id, products_options_value_id) values ('" .
                                    (int)$customer_id . "', '" . tep_db_input($products_id_string) . "', '" . (int)
                                    $option . "', '" . (int)$value . "')");
                        }
                    }
                }

                $this->cleanup();

                // assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
                $this->cartID = $this->generate_cart_id();
            }
        }
    }

    function update_quantity($products_id, $quantity = '', $attributes = '', $key_quantity, $warehouse)
    {
        global $customer_id;

        $products_id_string = tep_get_uprid($products_id, $attributes);
        $products_id = tep_get_prid($products_id_string);

        if (defined('MAX_QTY_IN_CART') && (MAX_QTY_IN_CART > 0) && ((int)$quantity >
            MAX_QTY_IN_CART)) {
            $quantity = MAX_QTY_IN_CART;
        }

        $attributes_pass_check = true;

        if (is_array($attributes)) {
            reset($attributes);
            while (list($option, $value) = each($attributes)) {
                if (!is_numeric($option) || !is_numeric($value)) {
                    $attributes_pass_check = false;
                    break;
                }
            }
        }

        switch ($key_quantity) {
            case 'qty':
                $campo_basket_qta = 'customers_basket_quantity';
                break;
            
            case 'reserved_qty':
                $campo_basket_qta = 'customers_basket_reserved_quantity';
                break;

            case 'used_qty':
                $campo_basket_qta = 'customers_basket_used_quantity';
                break;
        }

        if (is_numeric($products_id) && isset($this->contents[$products_id_string]) &&
            is_numeric($quantity) && ($attributes_pass_check == true)) {

            $this->contents[$products_id_string][$key_quantity] = (int)$quantity;
            // update database
            if (tep_session_is_registered('customer_id'))
                tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set " . $campo_basket_qta .
                    " = " . $this->contents[$products_id_string][$key_quantity] .", warehouse = ".(int)$warehouse." where customers_id = '" . (int)$customer_id . "' and products_id = '" .
                    tep_db_input($products_id_string) . "'");

            if (is_array($attributes)) {
                reset($attributes);
                while (list($option, $value) = each($attributes)) {
                    $this->contents[$products_id_string]['attributes'][$option] = $value;
                    // update database
                    if (tep_session_is_registered('customer_id'))
                        tep_db_query("update " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES .
                            " set products_options_value_id = '" . (int)$value . "' where customers_id = '" .
                            (int)$customer_id . "' and products_id = '" . tep_db_input($products_id_string) .
                            "' and products_options_id = '" . (int)$option . "'");
                }
            }
            $this->cartID = $this->generate_cart_id();
        }
    }

    function cleanup()
    {
        global $customer_id;

        reset($this->contents);
        while (list($key, ) = each($this->contents)) {
            if ($this->contents[$key]['qty'] < 1 && $this->contents[$key]['used_qty'] < 1 && $this->contents[$key]['reserved_qty'] < 1) {
                unset($this->contents[$key]);
                // remove from database
                if (tep_session_is_registered('customer_id')) {
                    tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" .
                        (int)$customer_id . "' and products_id = '" . tep_db_input($key) . "'");
                    tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES .
                        " where customers_id = '" . (int)$customer_id . "' and products_id = '" .
                        tep_db_input($key) . "'");
                }
            }
        }
    }

    function count_contents()
    { // get total number of items in cart
        $total_items = 0;
        if (is_array($this->contents)) {
            reset($this->contents);
            while (list($products_id, ) = each($this->contents)) {
                $total_items += $this->get_quantity($products_id, 'new') + $this->get_quantity($products_id,
                    'used')+$this->get_quantity($products_id,
                    'reserved');
            }
        }

        return $total_items;
    }

    function get_quantity($products_id, $type)
    {
        switch ($type) {
            case 'new':
                $key_qty = 'qty';
                break;
                
            case 'reserved':
                $key_qty = 'reserved_qty';
                break;

            case 'used':
                $key_qty = 'used_qty';
                break;
        }
        if (isset($this->contents[$products_id])) {
            return $this->contents[$products_id][$key_qty];
        } else {
            return 0;
        }
    }

    function in_cart($products_id)
    {
        if (isset($this->contents[$products_id])) {
            return true;
        } else {
            return false;
        }
    }

    function remove($products_id)
    {
        global $customer_id;

        unset($this->contents[$products_id]);
        // remove from database
        if (tep_session_is_registered('customer_id')) {
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" .
                (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES .
                " where customers_id = '" . (int)$customer_id . "' and products_id = '" .
                tep_db_input($products_id) . "'");
        }

        // assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
        $this->cartID = $this->generate_cart_id();
    }

    function remove_all()
    {
        $this->reset();
    }

    function get_product_id_list()
    {
        $product_id_list = '';
        if (is_array($this->contents)) {
            reset($this->contents);
            while (list($products_id, ) = each($this->contents)) {
                $product_id_list .= ', ' . $products_id;
            }
        }

        return substr($product_id_list, 2);
    }

    function calculate()
    {
        global $currencies;

        $this->total = 0;
        $this->weight = 0;
        if (!is_array($this->contents))
            return 0;

        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
            $qty = $this->contents[$products_id]['qty'];
            $used_qty = $this->contents[$products_id]['used_qty'];
            $reserved_qty = $this->contents[$products_id]['reserved_qty'];

            // products price
            $product_query = tep_db_query("select products_id, products_price, products_used_price, products_tax_class_id, products_weight from " .
                TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
            if ($product = tep_db_fetch_array($product_query)) {
                $prid = $product['products_id'];
                $products_tax = tep_get_tax_rate($product['products_tax_class_id']);
                $products_price = $product['products_price'];
                $products_used_price = $product['products_used_price'];
                $products_weight = $product['products_weight'];

                $specials_query = tep_db_query("select specials_new_products_price from " .
                    TABLE_SPECIALS . " where products_id = '" . (int)$prid . "' and status = '1'");
                if (tep_db_num_rows($specials_query)) {
                    $specials = tep_db_fetch_array($specials_query);
                    $products_price = $specials['specials_new_products_price'];
                    $products_used_price = $specials['specials_new_products_price'];
                }

                $this->total += $currencies->calculate_price($products_price, $products_tax, $qty+$reserved_qty);
                $this->total += $currencies->calculate_price($products_used_price, $products_tax,
                    $used_qty);
                $this->weight += ($qty+$reserved_qty * $products_weight);
                $this->weight += ($used_qty * $products_weight);
            }

            // attributes price
            if (isset($this->contents[$products_id]['attributes'])) {
                reset($this->contents[$products_id]['attributes']);
                while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
                    $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " .
                        TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$prid .
                        "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value .
                        "'");
                    $attribute_price = tep_db_fetch_array($attribute_price_query);
                    if ($attribute_price['price_prefix'] == '+') {
                        $this->total += $currencies->calculate_price($attribute_price['options_values_price'],
                            $products_tax, $qty);
                        $this->total += $currencies->calculate_price($attribute_price['options_values_price'],
                            $products_tax, $used_qty);
                    } else {
                        $this->total -= $currencies->calculate_price($attribute_price['options_values_price'],
                            $products_tax, $qty);
                        $this->total -= $currencies->calculate_price($attribute_price['options_values_price'],
                            $products_tax, $used_qty);
                    }
                }
            }
        }
    }

    function attributes_price($products_id)
    {
        $attributes_price = 0;

        if (isset($this->contents[$products_id]['attributes'])) {
            reset($this->contents[$products_id]['attributes']);
            while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
                $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " .
                    TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id .
                    "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value .
                    "'");
                $attribute_price = tep_db_fetch_array($attribute_price_query);
                if ($attribute_price['price_prefix'] == '+') {
                    $attributes_price += $attribute_price['options_values_price'];
                } else {
                    $attributes_price -= $attribute_price['options_values_price'];
                }
            }
        }

        return $attributes_price;
    }

    function get_products()
    {
        global $languages_id, $customer_id;

        if (!is_array($this->contents))
            return false;

        $products_array = array();
        reset($this->contents);

        while (list($products_id, ) = each($this->contents)) {

#### MODIFICA PASSALIBRO #### JOIN TRA PRODUCTS, PRODUCTS_DESCRIPITON, CUSOMER_BASKET - STAMPO IN PAGINA SHIPPING_CART LE QUANTITA' DELLA CUSTOMER_BASKET #####

            $products_query = tep_db_query("select p.products_id, 
            pd.products_name, 
            p.products_model,
            p.products_ebay,
            p.products_image, 
            p.products_price, 
            p.products_used_price, 
            p.products_quantity, 
            p.products_used_quantity,  
            p.products_weight, 
            p.products_tax_class_id,
            cb.data_school,
            cb.customers_basket_quantity,
            cb.customers_basket_used_quantity,
            cb.customers_basket_reserved_quantity,
            cb.sede_impegno_qta_n,
            cb.sede_impegno_qta_u from " .
                TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . 
                " pd, " . TABLE_CUSTOMERS_BASKET ." cb where p.products_id = '" . (int)$products_id .
                "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id .
                "' and pd.products_id = cb.products_id and cb.customers_id = " . (int)$customer_id);
            if ($products = tep_db_fetch_array($products_query)) {
                $prid = $products['products_id'];
                $products_price = $products['products_price'];
                $products_used_price = $products['products_used_price'];
                $specials_query = tep_db_query("select specials_new_products_price from " .
                    TABLE_SPECIALS . " where products_id = '" . (int)$prid . "' and status = '1'");
                if (tep_db_num_rows($specials_query)) {
                    $specials = tep_db_fetch_array($specials_query);
                    $products_price = $specials['specials_new_products_price'];
                    $products_used_price = $specials['specials_new_products_price'];
                }

                $products_array[] = array(
                    'id' => $products_id,
                    'name' => $products['products_name'],
                    'model' => $products['products_model'],
                    'ebay' => $products['products_ebay'],
                    'image' => $products['products_image'],
                    'price' => $products_price,
                    'used_price' => $products_used_price,
                    'quantity' => $products['customers_basket_quantity'],
                    'used_quantity' => $products['customers_basket_used_quantity'],
                    'products_quantity' => $products['products_quantity']-$this->contents[$products_id]['qty'], #qta nel db meno la qta nel carrello
                    'products_used_quantity' => $products['products_used_quantity']-$this->contents[$products_id]['used_qty'], #qta nel db meno la qta nel carrello
                    'reserved_quantity' => $products['customers_basket_reserved_quantity'],
                    'data_school'=>$products['data_school'],
                    'sede_impegno_nuovo'=> $products['sede_impegno_qta_n'],
                    'sede_impegno_usato'=> $products['sede_impegno_qta_u'],
                    'weight' => $products['products_weight'],
                    'final_price' => ($products_price + $this->attributes_price($products_id)),
                    'used_final_price' => ($products_used_price + $this->attributes_price($products_id)),
                    'tax_class_id' => $products['products_tax_class_id'],
                    'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->
                        contents[$products_id]['attributes'] : ''));
            }
        }

        return $products_array;
    }

    function show_total()
    {
        $this->calculate();
        return $this->total;
    }

    function show_weight()
    {
        $this->calculate();

        return $this->weight;
    }

    function generate_cart_id($length = 5)
    {
        return tep_create_random_value($length, 'digits');
    }

    function get_content_type()
    {
        $this->content_type = false;

        if ((DOWNLOAD_ENABLED == 'true') && ($this->count_contents() > 0)) {
            reset($this->contents);
            while (list($products_id, ) = each($this->contents)) {
                if (isset($this->contents[$products_id]['attributes'])) {
                    reset($this->contents[$products_id]['attributes']);
                    while (list(, $value) = each($this->contents[$products_id]['attributes'])) {
                        $virtual_check_query = tep_db_query("select count(*) as total from " .
                            TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD .
                            " pad where pa.products_id = '" . (int)$products_id .
                            "' and pa.options_values_id = '" . (int)$value .
                            "' and pa.products_attributes_id = pad.products_attributes_id");
                        $virtual_check = tep_db_fetch_array($virtual_check_query);

                        if ($virtual_check['total'] > 0) {
                            switch ($this->content_type) {
                                case 'physical':
                                    $this->content_type = 'mixed';

                                    return $this->content_type;
                                    break;
                                default:
                                    $this->content_type = 'virtual';
                                    break;
                            }
                        } else {
                            switch ($this->content_type) {
                                case 'virtual':
                                    $this->content_type = 'mixed';

                                    return $this->content_type;
                                    break;
                                default:
                                    $this->content_type = 'physical';
                                    break;
                            }
                        }
                    }
                } else {
                    switch ($this->content_type) {
                        case 'virtual':
                            $this->content_type = 'mixed';

                            return $this->content_type;
                            break;
                        default:
                            $this->content_type = 'physical';
                            break;
                    }
                }
            }
        } else {
            $this->content_type = 'physical';
        }

        return $this->content_type;
    }

    function unserialize($broken)
    {
        for (reset($broken); $kv = each($broken); ) {
            $key = $kv['key'];
            if (gettype($this->$key) != "user function")
                $this->$key = $kv['value'];
        }
    }

}
?>
