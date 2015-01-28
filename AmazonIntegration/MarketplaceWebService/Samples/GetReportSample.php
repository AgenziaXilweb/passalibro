<?php
/**
 *  PHP Version 5
 *
 * @category    Amazon
 * @package     MarketplaceWebService
 * @copyright   Copyright 2009 Amazon Technologies, Inc.
 * @link        http://aws.amazon.com
 * @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 * @version     2009-01-01
 */
/*******************************************************************************
 *  Marketplace Web Service PHP5 Library
 *  Generated: Thu May 07 13:07:36 PDT 2009
 *
 */

/**
 * Get Report  Sample
 */

include_once('.config.inc.php');

/************************************************************************
 * Uncomment to configure the client instance. Configuration settings
 * are:
 *
 * - MWS endpoint URL
 * - Proxy host and port.
 * - MaxErrorRetry.
 ***********************************************************************/
// IMPORTANT: Uncomment the approiate line for the country you wish to
// sell in:
// United States:
//$serviceUrl = "https://mws.amazonservices.com";
// United Kingdom
//$serviceUrl = "https://mws.amazonservices.co.uk";
// Germany
//$serviceUrl = "https://mws.amazonservices.de";
// France
//$serviceUrl = "https://mws.amazonservices.fr";
// Italy
$serviceUrl = "https://mws.amazonservices.it";
// Japan
//$serviceUrl = "https://mws.amazonservices.jp";
// China
//$serviceUrl = "https://mws.amazonservices.com.cn";
// Canada
//$serviceUrl = "https://mws.amazonservices.ca";
// India
//$serviceUrl = "https://mws.amazonservices.in";

$config = array(
    'ServiceURL' => $serviceUrl,
    'ProxyHost' => null,
    'ProxyPort' => -1,
    'MaxErrorRetry' => 3,
);

/************************************************************************
 * Instantiate Implementation of MarketplaceWebService
 *
 * AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY constants
 * are defined in the .config.inc.php located in the same
 * directory as this sample
 ***********************************************************************/
$service = new MarketplaceWebService_Client(
    AWS_ACCESS_KEY_ID,
    AWS_SECRET_ACCESS_KEY,
    $config,
    APPLICATION_NAME,
    APPLICATION_VERSION);

/************************************************************************
 * Uncomment to try out Mock Service that simulates MarketplaceWebService
 * responses without calling MarketplaceWebService service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under MarketplaceWebService/Mock tree
 *
 ***********************************************************************/
// $service = new MarketplaceWebService_Mock();

/************************************************************************
 * Setup request parameters and uncomment invoke to try out
 * sample for Get Report Action
 ***********************************************************************/
// @TODO: set request. Action can be passed as MarketplaceWebService_Model_GetReportRequest
// object or array of parameters
// $reportId = '<Your Report Id>';

// $parameters = array (
//   'Merchant' => MERCHANT_ID,
//   'Report' => @fopen('php://memory', 'rw+'),
//   'ReportId' => $reportId,
// );
// $request = new MarketplaceWebService_Model_GetReportRequest($parameters);

$request = new MarketplaceWebService_Model_GetReportRequest();
$requestReportAcknowledged = new MarketplaceWebService_Model_UpdateReportAcknowledgementsRequest();
$sediPassalibro = tep_db_query("SELECT distinct(report.sede) as sede, account.merchantID, account.customers_id
                                FROM " . TABLE_AMAZON_REPORTS_LIST . " report JOIN " . TABLE_ACCOUNT_EXTERNAL . " account USING(sede) WHERE account.piattaforma='amazon'");
while ($sede = tep_db_fetch_array($sediPassalibro)) {
    $datiSede = array('sede' => $sede['sede'],
        'customer_id' => $sede['customers_id'],
        'merchantID' => $sede['merchantID'],);
    $request->setMerchant($datiSede['merchantID']);
    $requestReportAcknowledged->setMerchant($datiSede['merchantID']);
    $reportsList_query = tep_db_query('SELECT reportsId
                                FROM ' . TABLE_AMAZON_REPORTS_LIST . ' WHERE sede = ' . $datiSede['sede'] . ' AND reportsAcknowledged = 0');
    while ($report = tep_db_fetch_array($reportsList_query)) {
        $fileReportOrder = 'xmlReq/reportOrdersList_' . $report['reportsId'] . '_Sede' . $datiSede['sede'] . '.xml';
        $request->setReport(fopen($fileReportOrder, 'w+'));
        $request->setReportId($report['reportsId']);
        invokeGetReport($service, $request);
        echo("       Generate Orders into Orders tables, tmpweb2 and impegno passalibro.magsedi...\n");
        $xml = simplexml_load_file($fileReportOrder);
        foreach ($xml->Message as $message) {
            $sql_order_data = array('sede' => $datiSede['sede'],
                'customers_id' => $datiSede['customer_id'],
                'customers_name' => $message->OrderReport->BillingData->BuyerName,
                'customers_street_address' => $message->OrderReport->BillingData->Address->AddressFieldOne." ".$message->OrderReport->BillingData->Address->AddressFieldTwo,
                'customers_city' => $message->OrderReport->BillingData->Address->City,
                'customers_postcode' => $message->OrderReport->BillingData->Address->PostalCode,
                'customers_state' => $message->OrderReport->BillingData->Address->StateOrRegion,
                'customers_country' => $message->OrderReport->BillingData->Address->CountryCode,
                'customers_telephone' => $message->OrderReport->BillingData->Address->PhoneNumber,
                'customers_email_address' => $message->OrderReport->BillingData->BuyerEmailAddress,
                'customers_address_format_id' => 2,
                'delivery_name' => $message->OrderReport->FulfillmentData->Address->Name,
                'delivery_street_address' => $message->OrderReport->FulfillmentData->Address->AddressFieldOne." ".$message->OrderReport->FulfillmentData->Address->AddressFieldTwo,
                'delivery_city' => $message->OrderReport->FulfillmentData->Address->City,
                'delivery_postcode' => $message->OrderReport->FulfillmentData->Address->PostalCode,
                'delivery_state' => $message->OrderReport->FulfillmentData->Address->StateOrRegion,
                'delivery_country' => $message->OrderReport->FulfillmentData->Address->CountryCode,
                'delivery_address_format_id' => 2,
                'billing_name' => $message->OrderReport->BillingData->BuyerName,
                'billing_street_address' => $message->OrderReport->BillingData->Address->AddressFieldOne." ".$message->OrderReport->FulfillmentData->Address->AddressFieldTwo,
                'billing_city' => $message->OrderReport->BillingData->Address->City,
                'billing_postcode' => $message->OrderReport->BillingData->Address->PostalCode,
                'billing_state' => $message->OrderReport->BillingData->Address->StateOrRegion,
                'billing_country' => $message->OrderReport->BillingData->Address->CountryCode,
                'billing_address_format_id' => 2,
                'payment_method' => 'amazon payment',
                'date_purchased' => date('Y-m-d H:i:s', strtotime($message->OrderReport->OrderDate)),
                'orders_status' => 1,
                'currency_value' => 1,
                'currency' => 'EUR',
                'session_id' => uniqid('Amazon_'),
            );
            tep_db_perform(TABLE_ORDERS, $sql_order_data);
            $orders_id = tep_db_insert_id();
            //tep_db_perform(TABLE_AMAZON_ORDERS_TO_ORDERS,array('amazonOrdersId'=>$message->OrderReport->AmazonOrderID,'orders_id'=>$orders_id,'sede'=>$sede['sede']));
            $totalProductsPrice = 0;
            foreach ($message->OrderReport->Item as $product) {
                #SE LO SKU NON E' NUMERICO PASSO AL PROSSIMO PRODOTTO
                if (preg_match('/[A-Za-z]+/', $product->SKU)) {
                    continue;
                }
                $queryAmazonProducts = tep_db_query("SELECT amazon.*,p.cod_chiave FROM amazon_products_sede" . $datiSede['sede'] . " amazon JOIN products p USING (products_id) WHERE amazon_products_id = " . $product->SKU);
                while ($amazonProduct = tep_db_fetch_array($queryAmazonProducts)) {
                    $sql_product_data = array(
                        'orders_id' => $orders_id,
                        'products_id' => $amazonProduct['products_id'],
                        'products_model' => $amazonProduct['isbn'],
                        'products_name' => $product->Title,
                        'products_price' => $amazonProduct['conditions'] == 'n' ? $amazonProduct['products_price'] : 0,
                        'final_price' => $amazonProduct['conditions'] == 'n' ? $amazonProduct['products_price'] : 0,
                        'products_tax' => 0,
                        'products_quantity' => $amazonProduct['conditions'] == 'n' ? $product->Quantity : 0,
                        'products_used_price' => $amazonProduct['conditions'] == 'u' ? $amazonProduct['products_price'] : 0,
                        'final_used_price' => $amazonProduct['conditions'] == 'u' ? $amazonProduct['products_price'] : 0,
                        'products_used_quantity' => $amazonProduct['conditions'] == 'u' ? $product->Quantity : 0,
                        'sede_scuola' => $datiSede['sede'],
                        'sede_impegno_n' => $amazonProduct['conditions'] == 'n' ? $datiSede['sede'] : 0,
                        'sede_impegno_u' => $amazonProduct['conditions'] == 'u' ? $datiSede['sede'] : 0,
                    );
                    $totalProductsPrice += $amazonProduct['products_price'];
                    tep_db_perform(TABLE_AMAZON_ORDERS_TO_ORDERS, array('amazonOrdersId' => $message->OrderReport->AmazonOrderID, 'orders_id' => $orders_id, 'sede' => $datiSede['sede'], 'products_id' => $amazonProduct['products_id'], 'amazonOrderItemCode' => $product->AmazonOrderItemCode, 'amazonOrderDate' => $sql_order_data['date_purchased'], 'reportsId' => $report['reportsId']));
                    tep_db_perform(TABLE_ORDERS_PRODUCTS, $sql_product_data);
                    tep_db_perform(TABLE_AMAZON_PRODUCTS_SEDE . $datiSede['sede'], array('not_send_amazon_feed' => 0), 'update', 'amazon_products_id = ' . $product->SKU);

                    /* Se non venisse scaricato l'ordine con status pending,
                     * in quanto l'acquisto è stato più rapido del tempo di lancio del job schedulato a crontab (attualmente ogni 1 min),
                     * allora si procede all'impegno di tale prodotto.
                     */
                    $queryAmazonOrder = tep_db_query('SELECT amazonOrderId FROM ' . TABLE_AMAZON_ORDER_LIST . ' WHERE  amazonOrderId = "' . $message->OrderReport->AmazonOrderID . '"');
                    if (!tep_db_num_rows($queryAmazonOrder)) {
                        $impegnatoType = $amazonProduct['conditions'] == 'n' ? 'impegnato_web_n' : 'impegnato_web_u';
                        $currentlyImpegnatoQuery = tep_db_query("SELECT " . $impegnatoType . " FROM " . MAGAZZINO . " WHERE cod_chiave=" . $amazonProduct['cod_chiave'] . " AND sede=" . $datiSede['sede']);
                        $currentlyImpegnato = tep_db_fetch_array($currentlyImpegnatoQuery);
                        $sql_product_impegno = array($impegnatoType => $product->Quantity + $currentlyImpegnato[$impegnatoType]);
                        tep_db_perform(MAGAZZINO, $sql_product_impegno, 'update', 'cod_chiave = ' . $amazonProduct['cod_chiave'] . ' AND sede = ' . $datiSede['sede']);
                    }
                }
            }
            $sql_data_orders_total = array(
                0 => array(
                    'orders_id' => $orders_id,
                    'title' => 'Sub-Totale:',
                    'text' => '&euro;' . str_replace('.', ',', (string)$totalProductsPrice),
                    'value' => $totalProductsPrice,
                    'class' => 'ot_subtotal',
                    'sort_order' => 1),
                1 => array(
                    'orders_id' => $orders_id,
                    'title' => 'Ordine Amazon n.<a href="https://sellercentral.amazon.it/gp/orders-v2/details?ie=UTF8&orderID=' . $message->OrderReport->AmazonOrderID . '">(' . $message->OrderReport->AmazonOrderID . ')</a> Sede ' . $datiSede['sede'],
                    'text' => '&euro;0,00',
                    'value' => 0,
                    'class' => 'ot_shipping',
                    'sort_order' => 2),
                2 => array(
                    'orders_id' => $orders_id,
                    'title' => 'Totale:',
                    'text' => '<strong>&euro;' . str_replace('.', ',', (string)$totalProductsPrice) . '</strong>',
                    'value' => $totalProductsPrice,
                    'class' => 'ot_total',
                    'sort_order' => 4),
            );
            foreach ($sql_data_orders_total as $orders_total) {
                tep_db_perform(TABLE_ORDERS_TOTAL, $orders_total);
            }
        }
        echo("Done!\n");
        unlink($fileReportOrder);
        $idList = new MarketplaceWebService_Model_IdList();
        $requestReportAcknowledged->setReportIdList($idList->withId($report['reportsId']));
        $requestReportAcknowledged->setAcknowledged(true);
        invokeUpdateReportAcknowledgements($service, $requestReportAcknowledged);
        tep_db_perform(TABLE_AMAZON_REPORTS_LIST,array('reportsAcknowledged'=>1),'update','reportsId= '.$report['reportsId']. ' AND sede='.$datiSede['sede']. ' AND reportsAcknowledged = 0');
    }
}

/**
 * Get Report Action Sample
 * The GetReport operation returns the contents of a report. Reports can potentially be
 * very large (>100MB) which is why we only return one report at a time, and in a
 * streaming fashion.
 *
 * @param MarketplaceWebService_Interface $service instance of MarketplaceWebService_Interface
 * @param mixed $request MarketplaceWebService_Model_GetReport or array of parameters
 */
function invokeGetReport(MarketplaceWebService_Interface $service, $request)
{
    try {
        $response = $service->getReport($request);

        echo("Service Response\n");
        echo("=============================================================================\n");

        echo("        GetReportResponse\n");
        if ($response->isSetGetReportResult()) {
            $getReportResult = $response->getGetReportResult();
            echo("            GetReport");

            if ($getReportResult->isSetContentMd5()) {
                echo("                ContentMd5");
                echo("                " . $getReportResult->getContentMd5() . "\n");
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
        // echo (stream_get_contents($request->getReport()) . "\n");
    } catch (MarketplaceWebService_Exception $ex) {
        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
}

/**
 * Update Report Acknowledgements Action Sample
 * The UpdateReportAcknowledgements operation updates the acknowledged status of one or more reports.
 *
 * @param MarketplaceWebService_Interface $service instance of MarketplaceWebService_Interface
 * @param mixed $request MarketplaceWebService_Model_UpdateReportAcknowledgements or array of parameters
 */
function invokeUpdateReportAcknowledgements(MarketplaceWebService_Interface $service, $request)
{
    try {
        $response = $service->updateReportAcknowledgements($request);

        echo("Service Response\n");
        echo("=============================================================================\n");

        echo("        UpdateReportAcknowledgementsResponse\n");
        if ($response->isSetUpdateReportAcknowledgementsResult()) {
            echo("            UpdateReportAcknowledgementsResult\n");
            $updateReportAcknowledgementsResult = $response->getUpdateReportAcknowledgementsResult();
            if ($updateReportAcknowledgementsResult->isSetCount()) {
                echo("                Count\n");
                echo("                    " . $updateReportAcknowledgementsResult->getCount() . "\n");
            }
            //$reportInfoList = $updateReportAcknowledgementsResult->getReportInfo();
//                    foreach ($reportInfoList as $reportInfo) {
//                        echo("                ReportInfo\n");
//                        if ($reportInfo->isSetReportId()) 
//                        {
//                            echo("                    ReportId\n");
//                            echo("                        " . $reportInfo->getReportId() . "\n");
//                        }
//                        if ($reportInfo->isSetReportType()) 
//                        {
//                            echo("                    ReportType\n");
//                            echo("                        " . $reportInfo->getReportType() . "\n");
//                        }
//                        if ($reportInfo->isSetReportRequestId()) 
//                        {
//                            echo("                    ReportRequestId\n");
//                            echo("                        " . $reportInfo->getReportRequestId() . "\n");
//                        }
//                        if ($reportInfo->isSetAvailableDate()) 
//                        {
//                            echo("                    AvailableDate\n");
//                            echo("                        " . $reportInfo->getAvailableDate()->format(DATE_FORMAT) . "\n");
//                        }
//                        if ($reportInfo->isSetAcknowledged()) 
//                        {
//                            echo("                    Acknowledged\n");
//                            echo("                        " . $reportInfo->getAcknowledged() . "\n");
//                        }
//                        if ($reportInfo->isSetAcknowledgedDate()) 
//                        {
//                            echo("                    AcknowledgedDate\n");
//                            echo("                        " . $reportInfo->getAcknowledgedDate()->format(DATE_FORMAT) . "\n");
//                        }
//                    }
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
    } catch (MarketplaceWebService_Exception $ex) {
        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
}
