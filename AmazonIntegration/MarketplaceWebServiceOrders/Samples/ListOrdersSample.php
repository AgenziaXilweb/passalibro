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
 * List Orders  Sample
 */

include_once('.config.inc.php');
tep_db_connect() or die('Unable to connect to database server!');

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
 * sample for List Orders Action
 ***********************************************************************/
// @TODO: set request. Action can be passed as MarketplaceWebServiceOrders_Model_ListOrdersRequest
$request = new MarketplaceWebServiceOrders_Model_ListOrdersRequest();
$sedi_amazon = tep_db_query("SELECT sede, merchantID, marketPlace FROM " . TABLE_ACCOUNT_EXTERNAL . " WHERE piattaforma='amazon' ORDER BY sede");
while ($sede_amazon = tep_db_fetch_array($sedi_amazon)) {

    $request->setSellerId($sede_amazon['merchantID']);
    $today = new DateTime('NOW');
    // List all orders udpated after a certain date
    $date = new DateTime($today->format('Y-m-d'));
    // Set the marketplaces queried in this ListOrdersRequest
    $marketplaceIdList = new MarketplaceWebServiceOrders_Model_MarketplaceIdList();
    $marketplaceIdList->setId(array($sede_amazon['marketPlace']));
    $request->setMarketplaceId($marketplaceIdList);
    $amazonStatusOrdersList = tep_db_query("SELECT amazonStatusDescription, amazonOrdersCreatedAfter FROM " . TABLE_AMAZON_ORDER_STATUS . " WHERE active=1");
    $arrayOrderStatus=new ArrayObject();
    while ($amazonStatusOrderList = tep_db_fetch_array($amazonStatusOrdersList)) {
        $arrayOrderStatus->append($amazonStatusOrderList['amazonStatusDescription']);
    }
    $request->setCreatedAfter($date->sub(new DateInterval('PT1H')));
    //Set the order statuses for this ListOrdersRequest (optional)
    $orderStatuses = new MarketplaceWebServiceOrders_Model_OrderStatusList();
    $orderStatuses->setStatus($arrayOrderStatus->getArrayCopy());
    $request->setOrderStatus($orderStatuses);
    // Set the Fulfillment Channel for this ListOrdersRequest (optional)
    //$fulfillmentChannels = new MarketplaceWebServiceOrders_Model_FulfillmentChannelList();
    //$fulfillmentChannels->setChannel(array('MFN'));
    //$request->setFulfillmentChannel($fulfillmentChannels);
    // @TODO: set request. Action can be passed as MarketplaceWebServiceOrders_Model_ListOrdersRequest
    // object or array of parameters
    invokeListOrders($service, $request, $sede_amazon['sede']);
}


/**
 * List Orders Action Sample
 * ListOrders can be used to find orders that meet the specified criteria.
 *
 * @param MarketplaceWebServiceOrders_Interface $service instance of MarketplaceWebServiceOrders_Interface
 * @param mixed $request MarketplaceWebServiceOrders_Model_ListOrders or array of parameters
 */
function invokeListOrders(MarketplaceWebServiceOrders_Interface $service, $request, $sede)
{
    $sql_data_array = array(
        'amazonOrderId' => null,
        'amazonOrderStatus' => null,
        'amazonPurchaseDate' => null,
        'amazonLastUpdateDate' => null,
        'amazonSede' => $sede,
    );
    try {
        $response = $service->listOrders($request);

        echo("Service Response Sede $sede\n");
        echo("=============================================================================\n");

        echo("        ListOrdersResponse\n");
        if ($response->isSetListOrdersResult()) {
            echo("            ListOrdersResult\n");
            $listOrdersResult = $response->getListOrdersResult();
            if ($listOrdersResult->isSetNextToken()) {
                echo("                NextToken\n");
                echo("                    " . $listOrdersResult->getNextToken() . "\n");
            }
            if ($listOrdersResult->isSetCreatedBefore()) {
                echo("                CreatedBefore\n");
                echo("                    " . $listOrdersResult->getCreatedBefore() . "\n");
            }
            if ($listOrdersResult->isSetLastUpdatedBefore()) {
                echo("                LastUpdatedBefore\n");
                echo("                    " . $listOrdersResult->getLastUpdatedBefore() . "\n");
            }
            if ($listOrdersResult->isSetOrders()) {
                echo("                Orders\n");
                $orders = $listOrdersResult->getOrders();
                $orderList = $orders->getOrder();
                foreach ($orderList as $order) {
                    echo("                    Order\n");
                    if ($order->isSetAmazonOrderId()) {
                        echo("                        AmazonOrderId\n");
                        echo("                            " . $order->getAmazonOrderId() . "\n");
                        $sql_data_array['amazonOrderId'] = $order->getAmazonOrderId();
                    }
                    if ($order->isSetSellerOrderId()) {
                        echo("                        SellerOrderId\n");
                        echo("                            " . $order->getSellerOrderId() . "\n");
                    }
                    if ($order->isSetPurchaseDate()) {
                        $purchaseDate = new DateTime($order->getPurchaseDate());
                        $purchaseDate->setTimezone(new DateTimeZone('Europe/Rome'));
                        echo("                        PurchaseDate\n");
                        echo("                            " . $purchaseDate->format('Y-m-d H:i:s') . "\n");
                        $sql_data_array['amazonPurchaseDate'] = $purchaseDate->format('Y-m-d H:i:s');
                    }
                    if ($order->isSetLastUpdateDate()) {
                        $lastUpdateDate = new DateTime($order->getLastUpdateDate());
                        $lastUpdateDate->setTimezone(new DateTimeZone('Europe/Rome'));
                        echo("                        LastUpdateDate\n");
                        echo("                            " . $lastUpdateDate->format('Y-m-d H:i:s') . "\n");
                        $sql_data_array['amazonLastUpdateDate'] = $lastUpdateDate->format('Y-m-d H:i:s');
                    }
                    if ($order->isSetOrderStatus()) {
                        echo("                        OrderStatus\n");
                        echo("                            " . $order->getOrderStatus() . "\n");
                        $sql_data_array['amazonOrderStatus'] = $order->getOrderStatus();
                    }
                    if ($order->isSetFulfillmentChannel()) {
                        echo("                        FulfillmentChannel\n");
                        echo("                            " . $order->getFulfillmentChannel() . "\n");
                    }
                    if ($order->isSetSalesChannel()) {
                        echo("                        SalesChannel\n");
                        echo("                            " . $order->getSalesChannel() . "\n");
                    }
                    if ($order->isSetOrderChannel()) {
                        echo("                        OrderChannel\n");
                        echo("                            " . $order->getOrderChannel() . "\n");
                    }
                    if ($order->isSetShipServiceLevel()) {
                        echo("                        ShipServiceLevel\n");
                        echo("                            " . $order->getShipServiceLevel() . "\n");
                    }
                    if ($order->isSetShippingAddress()) {
                        echo("                        ShippingAddress\n");
                        $shippingAddress = $order->getShippingAddress();
                        if ($shippingAddress->isSetName()) {
                            echo("                            Name\n");
                            echo("                                " . $shippingAddress->getName() . "\n");
                        }
                        if ($shippingAddress->isSetAddressLine1()) {
                            echo("                            AddressLine1\n");
                            echo("                                " . $shippingAddress->getAddressLine1() . "\n");
                        }
                        if ($shippingAddress->isSetAddressLine2()) {
                            echo("                            AddressLine2\n");
                            echo("                                " . $shippingAddress->getAddressLine2() . "\n");
                        }
                        if ($shippingAddress->isSetAddressLine3()) {
                            echo("                            AddressLine3\n");
                            echo("                                " . $shippingAddress->getAddressLine3() . "\n");
                        }
                        if ($shippingAddress->isSetCity()) {
                            echo("                            City\n");
                            echo("                                " . $shippingAddress->getCity() . "\n");
                        }
                        if ($shippingAddress->isSetCounty()) {
                            echo("                            County\n");
                            echo("                                " . $shippingAddress->getCounty() . "\n");
                        }
                        if ($shippingAddress->isSetDistrict()) {
                            echo("                            District\n");
                            echo("                                " . $shippingAddress->getDistrict() . "\n");
                        }
                        if ($shippingAddress->isSetStateOrRegion()) {
                            echo("                            StateOrRegion\n");
                            echo("                                " . $shippingAddress->getStateOrRegion() . "\n");
                        }
                        if ($shippingAddress->isSetPostalCode()) {
                            echo("                            PostalCode\n");
                            echo("                                " . $shippingAddress->getPostalCode() . "\n");
                        }
                        if ($shippingAddress->isSetCountryCode()) {
                            echo("                            CountryCode\n");
                            echo("                                " . $shippingAddress->getCountryCode() . "\n");
                        }
                        if ($shippingAddress->isSetPhone()) {
                            echo("                            Phone\n");
                            echo("                                " . $shippingAddress->getPhone() . "\n");
                        }
                    }
                    if ($order->isSetOrderTotal()) {
                        echo("                        OrderTotal\n");
                        $orderTotal = $order->getOrderTotal();
                        if ($orderTotal->isSetCurrencyCode()) {
                            echo("                            CurrencyCode\n");
                            echo("                                " . $orderTotal->getCurrencyCode() . "\n");
                        }
                        if ($orderTotal->isSetAmount()) {
                            echo("                            Amount\n");
                            echo("                                " . $orderTotal->getAmount() . "\n");
                        }
                    }
                    if ($order->isSetNumberOfItemsShipped()) {
                        echo("                        NumberOfItemsShipped\n");
                        echo("                            " . $order->getNumberOfItemsShipped() . "\n");
                    }
                    if ($order->isSetNumberOfItemsUnshipped()) {
                        echo("                        NumberOfItemsUnshipped\n");
                        echo("                            " . $order->getNumberOfItemsUnshipped() . "\n");
                    }
                    if ($order->isSetPaymentExecutionDetail()) {
                        echo("                        PaymentExecutionDetail\n");
                        $paymentExecutionDetail = $order->getPaymentExecutionDetail();
                        $paymentExecutionDetailItemList = $paymentExecutionDetail->getPaymentExecutionDetailItem();
                        foreach ($paymentExecutionDetailItemList as $paymentExecutionDetailItem) {
                            echo("                            PaymentExecutionDetailItem\n");
                            if ($paymentExecutionDetailItem->isSetPayment()) {
                                echo("                                Payment\n");
                                $payment = $paymentExecutionDetailItem->getPayment();
                                if ($payment->isSetCurrencyCode()) {
                                    echo("                                    CurrencyCode\n");
                                    echo("                                        " . $payment->getCurrencyCode() . "\n");
                                }
                                if ($payment->isSetAmount()) {
                                    echo("                                    Amount\n");
                                    echo("                                        " . $payment->getAmount() . "\n");
                                }
                            }
                            if ($paymentExecutionDetailItem->isSetPaymentMethod()) {
                                echo("                                PaymentMethod\n");
                                echo("                                    " . $paymentExecutionDetailItem->getPaymentMethod() . "\n");
                            }
                        }
                    }
                    if ($order->isSetPaymentMethod()) {
                        echo("                        PaymentMethod\n");
                        echo("                            " . $order->getPaymentMethod() . "\n");
                    }
                    if ($order->isSetMarketplaceId()) {
                        echo("                        MarketplaceId\n");
                        echo("                            " . $order->getMarketplaceId() . "\n");
                    }
                    if ($order->isSetBuyerEmail()) {
                        echo("                        BuyerEmail\n");
                        echo("                            " . $order->getBuyerEmail() . "\n");
                    }
                    if ($order->isSetBuyerName()) {
                        echo("                        BuyerName\n");
                        echo("                            " . $order->getBuyerName() . "\n");
                    }
                    if ($order->isSetShipmentServiceLevelCategory()) {
                        echo("                        ShipmentServiceLevelCategory\n");
                        echo("                            " . $order->getShipmentServiceLevelCategory() . "\n");
                    }
                    if ($order->isSetShippedByAmazonTFM()) {
                        echo("                        ShippedByAmazonTFM\n");
                        echo("                            " . $order->getShippedByAmazonTFM() . "\n");
                    }
                    if ($order->isSetTFMShipmentStatus()) {
                        echo("                        TFMShipmentStatus\n");
                        echo("                            " . $order->getTFMShipmentStatus() . "\n");
                    }
                    tep_db_query("INSERT INTO " . TABLE_AMAZON_ORDER_LIST . "(amazonOrderId, amazonOrderStatus, amazonPurchaseDate, amazonLastUpdateDate, amazonSede) SELECT * FROM (SELECT '". $sql_data_array['amazonOrderId']. "', '". $sql_data_array['amazonOrderStatus']. "', '". $sql_data_array['amazonPurchaseDate']. "', '". $sql_data_array['amazonLastUpdateDate']. "',". $sql_data_array['amazonSede']. ") as tmp WHERE NOT EXISTS ( SELECT amazonOrderId FROM ". TABLE_AMAZON_ORDER_LIST. " WHERE amazonOrderId='". $sql_data_array['amazonOrderId']. "')");
                    //tep_db_perform(TABLE_AMAZON_ORDER_LIST, $sql_data_array);
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