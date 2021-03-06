<?php
/**
 *  PHP Version 5
 *
 * @category    Amazon
 * @package     MarketplaceWebServiceOrders
 * @copyright   Copyright 2008-2012 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 * @link        http://aws.amazon.com
 * @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 * @version     2011-01-01
 */
/*******************************************************************************
 *
 *  Marketplace Web Service Orders PHP5 Library
 *
 */

/**
 * List Order Items  Sample
 * VERSIONE MODIFICATA PASSALIBRO:
 * Il presente script verrà lanciato in seguito al ListOrdersSample.php una volta che quest'ultimo
 * avrà inserito i nuovi ordini in pending(attualmente schedulato ad ogni 1') ed eliminati tutti i pending
 * che avranno superato la soglia dei giorni prefissata con tale status (vedi tabella amazonOrderStatus).
 * Pertanto verranno dapprima eliminati i relativi prodotti ed in seguito inseriti i nuovi, andando rispettivamente ad
 * impegnare e disimpegnare il magazzino passalibro.
 */

include_once('.config.inc.php');

tep_db_connect() or die('Unable to connect to database server!');

$today = new DateTime('NOW');

//Fase di disimpegno prodotti dei vecchi ordini in status=Pending(secondo soglia) e Canceled.
$queryAmazonProductsDelete = tep_db_query("SELECT *
                                             FROM " . TABLE_AMAZON_ORDER_LIST . " ol
                                                  JOIN " . TABLE_AMAZON_ORDER_LIST_ITEMS . " oli USING (amazonOrderId, amazonSede)
                                                  LEFT JOIN " . TABLE_AMAZON_ORDER_STATUS . " os
                                                    ON ol.amazonOrderStatus = os.amazonStatusDescription
                                           WHERE (amazonOrderStatus = 'Pending'
                                             AND date(amazonPurchaseDate) < date(now()) - interval os.amazonOrdersCreatedAfter day
                                               OR amazonOrderStatus = 'Canceled')
                                          ");
if (tep_db_num_rows($queryAmazonProductsDelete)) {
    while ($amazonProductsDelete = tep_db_fetch_array($queryAmazonProductsDelete)) {
        if (preg_match('/[A-Za-z]+/', $amazonProductsDelete['amazonSellerSKU'])) {
            echo "Impossibile disimpegnare: SKU->" . $amazonProductsDelete['amazonSellerSKU'], PHP_EOL;
            continue;
        }
        $queryAmazonProductData = tep_db_query("SELECT conditions, cod_chiave FROM " . TABLE_AMAZON_PRODUCTS_SEDE . $amazonProductsDelete['amazonSede'] . " JOIN " . TABLE_PRODUCTS . " using(products_id) WHERE amazon_products_id = " . $amazonProductsDelete['amazonSellerSKU']);
        if (tep_db_num_rows($queryAmazonProductData)) {
            $amazonProductData = tep_db_fetch_array($queryAmazonProductData);
            $queryCurrentlyEngagement = tep_db_query("SELECT impegnato_web_" . $amazonProductData['conditions'] . " as impegnato_attuale FROM " . MAGAZZINO . " WHERE cod_chiave = " . $amazonProductData['cod_chiave'] . " AND sede = " . $amazonProductsDelete['amazonSede']);
            $currentlyEngagement = tep_db_fetch_array($queryCurrentlyEngagement);
            $sql_product_impegno = array('impegnato_web_' . $amazonProductData['conditions'] => $currentlyEngagement['impegnato_attuale'] - $amazonProductsDelete['amazonItemQuantityOrdered']);
            if ($currentlyEngagement['impegnato_attuale'] > 0) {
                echo "FASE DI DISIMPEGNO PRODOTTI: ", PHP_EOL;
                tep_db_perform(MAGAZZINO, $sql_product_impegno, 'update', 'cod_chiave = ' . $amazonProductData['cod_chiave'] . ' AND sede = ' . $amazonProductsDelete['amazonSede']);
                tep_db_query("DELETE FROM " . TABLE_AMAZON_ORDER_LIST . " WHERE amazonOrderId = '" . $amazonProductsDelete['amazonOrderId'] . "'");
                tep_db_query("DELETE FROM " . TABLE_AMAZON_ORDER_LIST_ITEMS . " WHERE amazonOrderId = '" . $amazonProductsDelete['amazonOrderId'] . "'");
                tep_db_perform(TABLE_AMAZON_PRODUCTS_SEDE . $amazonProductsDelete['amazonSede'], array('not_send_amazon_feed' => 0), 'update', 'amazon_products_id = ' . $amazonProductsDelete['amazonSellerSKU']);
                echo $today->format('d-m-Y H:i:s') . " - {AmazonOrderId: ", $amazonProductsDelete['amazonOrderId'], "|Sku: ", $amazonProductsDelete['amazonSellerSKU'], "|Cod_chiave: ", $amazonProductData['cod_chiave'], "|Sede: ", $amazonProductsDelete['amazonSede'], "}", PHP_EOL;
            }
        }
    }
}

/************************************************************************
 * Instantiate Implementation of MarketplaceWebServiceOrders
 *
 * AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY constants
 * are defined in the .config.inc.php located in the same
 * directory as this sample
 ***********************************************************************/
// United States:
//$serviceUrl = "https://mws.amazonservices.com/Orders/2011-01-01";
// Europe
$serviceUrl = "https://mws-eu.amazonservices.com/Orders/2011-01-01";
// Japan
//$serviceUrl = "https://mws.amazonservices.jp/Orders/2011-01-01";
// China
//$serviceUrl = "https://mws.amazonservices.com.cn/Orders/2011-01-01";
// Canada
//$serviceUrl = "https://mws.amazonservices.ca/Orders/2011-01-01";

$config = array(
    'ServiceURL' => $serviceUrl,
    'ProxyHost' => null,
    'ProxyPort' => -1,
    'MaxErrorRetry' => 3,
);

$service = new MarketplaceWebServiceOrders_Client(
    AWS_ACCESS_KEY_ID,
    AWS_SECRET_ACCESS_KEY,
    APPLICATION_NAME,
    APPLICATION_VERSION,
    $config);


/************************************************************************
 * Uncomment to try out Mock Service that simulates MarketplaceWebServiceOrders
 * responses without calling MarketplaceWebServiceOrders service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under MarketplaceWebServiceOrders/Mock tree
 *
 ***********************************************************************/
// $service = new MarketplaceWebServiceOrders_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out
 * sample for List Order Items Action
 ***********************************************************************/
// @TODO: set request. Action can be passed as MarketplaceWebServiceOrders_Model_ListOrderItemsRequest
$request = new MarketplaceWebServiceOrders_Model_ListOrderItemsRequest();
$sedi_amazon = tep_db_query("SELECT sede, merchantID, marketPlace FROM " . TABLE_ACCOUNT_EXTERNAL . " WHERE piattaforma='amazon' ORDER BY sede");
while ($sede_amazon = tep_db_fetch_array($sedi_amazon)) {
    $request->setSellerId($sede_amazon['merchantID']);
    $amazonListOrders = tep_db_query("SELECT *
                                        FROM " . TABLE_AMAZON_ORDER_LIST . " ol
                                       WHERE (amazonOrderStatus = 'Pending'
                                                OR amazonOrderStatus = 'Unshipped')
                                            AND ol.amazonSede = " . $sede_amazon['sede'] . "
                                            AND NOT EXISTS( SELECT amazonOrderId
                                                                FROM " . TABLE_AMAZON_ORDER_LIST_ITEMS . " oli
                                                            WHERE ol.amazonOrderId = oli.amazonOrderId )
                                    ");
    $count = 0; //count for throttling
    while ($amazonOrderId = tep_db_fetch_array($amazonListOrders)) {
        //richiesta massima=30 con restore ogni 2 secondi.
        if ($count == 30) {
            $count = 0;
            sleep(3);
        }
        $request->setAmazonOrderId($amazonOrderId['amazonOrderId']);
        // object or array of parameters
        invokeListOrderItems($service, $request, $sede_amazon['sede']);
        $count++;
    }
}

/**
 * List Order Items Action Sample
 * This operation can be used to list the items of the order indicated by the
 * given order id (only a single Amazon order id is allowed).
 *
 * @param MarketplaceWebServiceOrders_Interface $service instance of MarketplaceWebServiceOrders_Interface
 * @param mixed $request MarketplaceWebServiceOrders_Model_ListOrderItems or array of parameters
 */
function invokeListOrderItems(MarketplaceWebServiceOrders_Interface $service, $request, $sede)
{
    $today = new DateTime('NOW');
    $sql_data_array = array(
        'amazonOrderId' => null,
        'amazonASIN' => null,
        'amazonOrderItemId' => null,
        'amazonSellerSKU' => null,
        'amazonItemTitle' => null,
        'amazonItemQuantityOrdered' => null,
        'amazonConditionId' => null,
        'amazonSede' => $sede,
    );
    try {
        $response = $service->listOrderItems($request);

        echo("Service Response Sede $sede\n");
        echo("=============================================================================\n");

        echo("        ListOrderItemsResponse\n");
        if ($response->isSetListOrderItemsResult()) {
            echo("            ListOrderItemsResult\n");
            $listOrderItemsResult = $response->getListOrderItemsResult();
            if ($listOrderItemsResult->isSetNextToken()) {
                echo("                NextToken\n");
                echo("                    " . $listOrderItemsResult->getNextToken() . "\n");
            }
            if ($listOrderItemsResult->isSetAmazonOrderId()) {
                echo("                AmazonOrderId\n");
                echo("                    " . $listOrderItemsResult->getAmazonOrderId() . "\n");
                $sql_data_array['amazonOrderId'] = $listOrderItemsResult->getAmazonOrderId();
            }
            if ($listOrderItemsResult->isSetOrderItems()) {
                echo("                OrderItems\n");
                $orderItems = $listOrderItemsResult->getOrderItems();
                $orderItemList = $orderItems->getOrderItem();
                foreach ($orderItemList as $orderItem) {
                    echo("                    OrderItem\n");
                    if ($orderItem->isSetASIN()) {
                        echo("                        ASIN\n");
                        echo("                            " . $orderItem->getASIN() . "\n");
                        $sql_data_array['amazonASIN'] = $orderItem->getASIN();
                    }
                    if ($orderItem->isSetConditionSubtypeId()) {
                        echo("                        ConditionSubtypeId\n");
                        echo("                            " . $orderItem->getConditionSubtypeId() . "\n");
                        $sql_data_array['amazonConditionId'] = $orderItem->getConditionSubtypeId();
                    }
                    if ($orderItem->isSetSellerSKU()) {
                        echo("                        SellerSKU\n");
                        echo("                            " . $orderItem->getSellerSKU() . "\n");
                        $sql_data_array['amazonSellerSKU'] = $orderItem->getSellerSKU();
                    }
                    if ($orderItem->isSetOrderItemId()) {
                        echo("                        OrderItemId\n");
                        echo("                            " . $orderItem->getOrderItemId() . "\n");
                        $sql_data_array['amazonOrderItemId'] = $orderItem->getOrderItemId();
                    }
                    if ($orderItem->isSetTitle()) {
                        echo("                        Title\n");
                        echo("                            " . $orderItem->getTitle() . "\n");
                        $sql_data_array['amazonItemTitle'] = $orderItem->getTitle();
                    }
                    if ($orderItem->isSetQuantityOrdered()) {
                        echo("                        QuantityOrdered\n");
                        echo("                            " . $orderItem->getQuantityOrdered() . "\n");
                        $sql_data_array['amazonItemQuantityOrdered'] = $orderItem->getQuantityOrdered();
                    }
                    if ($orderItem->isSetQuantityShipped()) {
                        echo("                        QuantityShipped\n");
                        echo("                            " . $orderItem->getQuantityShipped() . "\n");
                    }
                    if ($orderItem->isSetItemPrice()) {
                        echo("                        ItemPrice\n");
                        $itemPrice = $orderItem->getItemPrice();
                        if ($itemPrice->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $itemPrice->getCurrencyCode() . "\n");
                        }
                        if ($itemPrice->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $itemPrice->getAmount() . "\n");
                        }
                    }
                    if ($orderItem->isSetShippingPrice()) {
                        echo("                        ShippingPrice\n");
                        $shippingPrice = $orderItem->getShippingPrice();
                        if ($shippingPrice->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $shippingPrice->getCurrencyCode() . "\n");
                        }
                        if ($shippingPrice->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $shippingPrice->getAmount() . "\n");
                        }
                    }
                    if ($orderItem->isSetGiftWrapPrice()) {
                        echo("                        GiftWrapPrice\n");
                        $giftWrapPrice = $orderItem->getGiftWrapPrice();
                        if ($giftWrapPrice->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $giftWrapPrice->getCurrencyCode() . "\n");
                        }
                        if ($giftWrapPrice->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $giftWrapPrice->getAmount() . "\n");
                        }
                    }
                    if ($orderItem->isSetItemTax()) {
                        echo("                        ItemTax\n");
                        $itemTax = $orderItem->getItemTax();
                        if ($itemTax->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $itemTax->getCurrencyCode() . "\n");
                        }
                        if ($itemTax->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $itemTax->getAmount() . "\n");
                        }
                    }
                    if ($orderItem->isSetShippingTax()) {
                        echo("                        ShippingTax\n");
                        $shippingTax = $orderItem->getShippingTax();
                        if ($shippingTax->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $shippingTax->getCurrencyCode() . "\n");
                        }
                        if ($shippingTax->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $shippingTax->getAmount() . "\n");
                        }
                    }
                    if ($orderItem->isSetGiftWrapTax()) {
                        echo("                        GiftWrapTax\n");
                        $giftWrapTax = $orderItem->getGiftWrapTax();
                        if ($giftWrapTax->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $giftWrapTax->getCurrencyCode() . "\n");
                        }
                        if ($giftWrapTax->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $giftWrapTax->getAmount() . "\n");
                        }
                    }
                    if ($orderItem->isSetShippingDiscount()) {
                        echo("                        ShippingDiscount\n");
                        $shippingDiscount = $orderItem->getShippingDiscount();
                        if ($shippingDiscount->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $shippingDiscount->getCurrencyCode() . "\n");
                        }
                        if ($shippingDiscount->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $shippingDiscount->getAmount() . "\n");
                        }
                    }
                    if ($orderItem->isSetPromotionDiscount()) {
                        echo("                        PromotionDiscount\n");
                        $promotionDiscount = $orderItem->getPromotionDiscount();
                        if ($promotionDiscount->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $promotionDiscount->getCurrencyCode() . "\n");
                        }
                        if ($promotionDiscount->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $promotionDiscount->getAmount() . "\n");
                        }
                    }
                    if ($orderItem->isSetPromotionIds()) {
                        echo("                        PromotionIds\n");
                        $promotionIds = $orderItem->getPromotionIds();
                        $promotionIdList = $promotionIds->getPromotionId();
                        foreach ($promotionIdList as $promotionId) {
                            echo("                            PromotionId\n");
                            echo("                                " . $promotionId);
                        }
                    }
                    if ($orderItem->isSetCODFee()) {
                        echo("                        CODFee\n");
                        $CODFee = $orderItem->getCODFee();
                        if ($CODFee->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $CODFee->getCurrencyCode() . "\n");
                        }
                        if ($CODFee->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $CODFee->getAmount() . "\n");
                        }
                    }
                    if ($orderItem->isSetCODFeeDiscount()) {
                        echo("                        CODFeeDiscount\n");
                        $CODFeeDiscount = $orderItem->getCODFeeDiscount();
                        if ($CODFeeDiscount->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $CODFeeDiscount->getCurrencyCode() . "\n");
                        }
                        if ($CODFeeDiscount->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $CODFeeDiscount->getAmount() . "\n");
                        }
                    }
                    if ($orderItem->isSetGiftMessageText()) {
                        echo("                        GiftMessageText\n");
                        echo("                            " . $orderItem->getGiftMessageText() . "\n");
                    }
                    if ($orderItem->isSetGiftWrapLevel()) {
                        echo("                        GiftWrapLevel\n");
                        echo("                            " . $orderItem->getGiftWrapLevel() . "\n");
                    }
                    if ($orderItem->isSetInvoiceData()) {
                        echo("                        InvoiceData\n");
                        $invoiceData = $orderItem->getInvoiceData();
                        if ($invoiceData->isSetInvoiceRequirement()) {
                            echo("                            InvoiceRequirement\n");
                            echo("                                " . $invoiceData->getInvoiceRequirement() . "\n");
                        }
                        if ($invoiceData->isSetBuyerSelectedInvoiceCategory()) {
                            echo("                            BuyerSelectedInvoiceCategory\n");
                            echo("                                " . $invoiceData->getBuyerSelectedInvoiceCategory() . "\n");
                        }
                        if ($invoiceData->isSetInvoiceTitle()) {
                            echo("                            InvoiceTitle\n");
                            echo("                                " . $invoiceData->getInvoiceTitle() . "\n");
                        }
                        if ($invoiceData->isSetInvoiceInformation()) {
                            echo("                            InvoiceInformation\n");
                            echo("                                " . $invoiceData->getInvoiceInformation() . "\n");
                        }
                    }
                    tep_db_perform(TABLE_AMAZON_ORDER_LIST_ITEMS, $sql_data_array);
                    // Fase impegno magazzino sede.
                    $queryOrderStatus = tep_db_query("SELECT amazonOrderStatus FROM " . TABLE_AMAZON_ORDER_LIST . " WHERE amazonOrderId = '" . trim($sql_data_array['amazonOrderId']) . "'");
                    $orderStatus = tep_db_fetch_array($queryOrderStatus);
                    #SE LO SKU NON E' NUMERICO PASSO AL PROSSIMO PRODOTTO
                    if (preg_match('/[A-Za-z]+/', $sql_data_array['amazonSellerSKU'])) {
                        echo "Prodotto non impegnato: SKU->" . $sql_data_array['amazonSellerSKU'], PHP_EOL;
                        continue;
                    }
                    $queryAmazonProduct = tep_db_query("SELECT conditions, cod_chiave FROM " . TABLE_AMAZON_PRODUCTS_SEDE . $sede . " JOIN " . TABLE_PRODUCTS . " using(products_id) WHERE amazon_products_id = " . $sql_data_array['amazonSellerSKU']);
                    if (tep_db_num_rows($queryAmazonProduct)) {
                        echo "FASE DI IMPEGNO PRODOTTI", PHP_EOL;
                        $amazonProduct = tep_db_fetch_array($queryAmazonProduct);
                        $queryCurrentlyEngagement = tep_db_query("SELECT impegnato_web_" . $amazonProduct['conditions'] . " as impegnato_attuale FROM " . MAGAZZINO . " WHERE cod_chiave = " . $amazonProduct['cod_chiave'] . " AND sede = " . $sede);
                        $currentlyEngagement = tep_db_fetch_array($queryCurrentlyEngagement);
                        $sql_product_impegno = array('impegnato_web_' . $amazonProduct['conditions'] => $currentlyEngagement['impegnato_attuale'] + $sql_data_array['amazonItemQuantityOrdered']);
                        tep_db_perform(MAGAZZINO, $sql_product_impegno, 'update', 'cod_chiave = ' . $amazonProduct['cod_chiave'] . ' AND sede = ' . $sede);
                        tep_db_perform(TABLE_AMAZON_PRODUCTS_SEDE . $sede, array('products_quantity' => 0, 'not_send_amazon_feed' => 1), 'update', 'amazon_products_id = ' . $sql_data_array['amazonSellerSKU']);
                        echo $today->format('d-m-Y H:i:s') . " - {AmazonOrderId: ", $sql_data_array['amazonOrderId'], "|Sku: ", $sql_data_array['amazonSellerSKU'], "|Cod_chiave: ", $amazonProduct['cod_chiave'], "|Sede: ", $sede, "}", PHP_EOL;
                    }
                }
            }
        }
        if ($response->isSetResponseMetadata()) {
            echo("            ResponseMetadata\n");
            $responseMetadata = $response->getResponseMetadata();
            if ($responseMetadata->isSetRequestId()) {
                echo("                RequestId\n");
                echo("                    " . $responseMetadata->getRequestId() . "\n");
            }
        }

        echo("            ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
    } catch (MarketplaceWebServiceOrders_Exception $ex) {
        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
}
