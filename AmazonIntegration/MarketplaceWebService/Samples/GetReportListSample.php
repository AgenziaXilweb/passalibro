<?php

/**
 *  PHP Version 5
 *
 *  @category    Amazon
 *  @package     MarketplaceWebService
 *  @copyright   Copyright 2009 Amazon Technologies, Inc.
 *  @link        http://aws.amazon.com
 *  @license     http://aws.amazon.com/apache2.0  Apache License, Version 2.0
 *  @version     2009-01-01
 */
/*******************************************************************************

*  Marketplace Web Service PHP5 Library
*  Generated: Thu May 07 13:07:36 PDT 2009
* 
*/

/**
 * Get Report List  Sample
 */

include_once ('.config.inc.php');

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
$service = new MarketplaceWebService_Client(AWS_ACCESS_KEY_ID,
    AWS_SECRET_ACCESS_KEY, $config, APPLICATION_NAME, APPLICATION_VERSION);

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
* sample for Get Report List Action
***********************************************************************/
// @TODO: set request. Action can be passed as MarketplaceWebService_Model_GetReportListRequest
// object or array of parameters
// $parameters = array (
//   'Merchant' => MERCHANT_ID,
//   'AvailableToDate' => new DateTime('now', new DateTimeZone('UTC')),
//   'AvailableFromDate' => new DateTime('-6 months', new DateTimeZone('UTC')),
//   'Acknowledged' => false,
// );
//
// $request = new MarketplaceWebService_Model_GetReportListRequest($parameters);

//Scarico i report per ogni sede
$merchant_query = tep_db_query("select sede, merchantID from " .
    TABLE_ACCOUNT_EXTERNAL." WHERE piattaforma = 'amazon'");
$date=new DateTime('now', new DateTimeZone('UTC'));
while ($merchant = tep_db_fetch_array($merchant_query)) {
    $request = new MarketplaceWebService_Model_GetReportListRequest();
    $reportTypeList = new MarketplaceWebService_Model_TypeList();
    $reportTypeList->setType('_GET_ORDERS_DATA_');
    $request->setMerchant($merchant['merchantID']);
    //$request->setAvailableToDate(new DateTime('now', new DateTimeZone('UTC')));
    $request->setReportTypeList($reportTypeList);
    $request->setAvailableFromDate($date->sub(new DateInterval('P6D')));
    $request->setAcknowledged(false);
    invokeGetReportList($service, $request, $merchant['sede']);
}
/**
 * Get Report List Action Sample
 * returns a list of reports; by default the most recent ten reports,
 * regardless of their acknowledgement status
 *   
 * @param MarketplaceWebService_Interface $service instance of MarketplaceWebService_Interface
 * @param mixed $request MarketplaceWebService_Model_GetReportList or array of parameters
 */
function invokeGetReportList(MarketplaceWebService_Interface $service, $request,
    $sede)
{
    try
    {
        $response = $service->getReportList($request);

        echo ("Service Response\n");
        echo ("=============================================================================\n");

        echo ("        GetReportListResponse\n");
        if ($response->isSetGetReportListResult())
        {
            echo ("            GetReportListResult\n");
            $getReportListResult = $response->getGetReportListResult();
            if ($getReportListResult->isSetNextToken())
            {
                echo ("                NextToken\n");
                echo ("                    " . $getReportListResult->getNextToken() . "\n");
            }
            if ($getReportListResult->isSetHasNext())
            {
                echo ("                HasNext\n");
                echo ("                    " . $getReportListResult->getHasNext() . "\n");
            }
            $reportInfoList = $getReportListResult->getReportInfoList();
            
            $sql_data_array = array(
                'sede' => null,
                'reportsId' => null,
                'reportsType' => null,
                'reportsAvailableDate' => null,
                );
            
            foreach ($reportInfoList as $reportInfo)
            {
                
                $sql_data_array['sede'] = $sede;
                //                        echo("                ReportInfo\n");
                if ($reportInfo->isSetReportId())
                {
                //    echo ("                    ReportId\n");
                //    echo ("                        " . $reportInfo->getReportId() . "\n");
                    $sql_data_array['reportsId'] = $reportInfo->getReportId();
                }
                if ($reportInfo->isSetReportType())
                {
                //    echo ("                    ReportType\n");
                //    echo ("                        " . $reportInfo->getReportType() . "\n");
                    $sql_data_array['reportsType'] = $reportInfo->getReportType();
                }
                //                        if ($reportInfo->isSetReportRequestId())
                //                        {
                //                            echo("                    ReportRequestId\n");
                //                            echo("                        " . $reportInfo->getReportRequestId() . "\n");
                //                        }
                if ($reportInfo->isSetAvailableDate())
                {
                //    echo ("                    AvailableDate\n");
                //    echo ("                        " . $reportInfo->getAvailableDate()->format(DATE_FORMAT) ."\n");
                    $sql_data_array['reportsAvailableDate'] = $reportInfo->getAvailableDate()->format('Y-m-d\TH:i:s');
                }
                //              if ($reportInfo->isSetAcknowledged())
                //              {
                //                      echo("                    Acknowledged\n");
                //                            echo("                        " . $reportInfo->getAcknowledged() . "\n");
                //                        }
                //                        if ($reportInfo->isSetAcknowledgedDate())
                //                        {
                //                            echo("                    AcknowledgedDate\n");
                //                            echo("                        " . $reportInfo->getAcknowledgedDate()->format(DATE_FORMAT) . "\n");
                //                        }
                // Controllo per evitare di inserire pi� volte gli stessi ordini per via di un possibile timeout di sistema.
                $queryReportList=tep_db_query("SELECT reportsId FROM ".TABLE_AMAZON_REPORTS_LIST." WHERE reportsId='".$sql_data_array['reportsId']."' AND sede=".$sql_data_array['sede']);
                if(!tep_db_num_rows($queryReportList)){
                    tep_db_perform(TABLE_AMAZON_REPORTS_LIST, $sql_data_array);
                }
            }
        }
        if ($response->isSetResponseMetadata())
        {
            echo ("            ResponseMetadata\n");
            $responseMetadata = $response->getResponseMetadata();
            if ($responseMetadata->isSetRequestId())
            {
                echo ("                RequestId\n");
                echo ("                    " . $responseMetadata->getRequestId() . "\n");
            }
        }

        echo ("            ResponseHeaderMetadata: " . $response->
            getResponseHeaderMetadata() . "\n");
    }
    catch (MarketplaceWebService_Exception $ex)
    {
        echo ("Caught Exception: " . $ex->getMessage() . "\n");
        echo ("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo ("Error Code: " . $ex->getErrorCode() . "\n");
        echo ("Error Type: " . $ex->getErrorType() . "\n");
        echo ("Request ID: " . $ex->getRequestId() . "\n");
        echo ("XML: " . $ex->getXML() . "\n");
        echo ("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
    }
}

?>
