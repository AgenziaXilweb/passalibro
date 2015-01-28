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

if ($argv[1] > 4 || $argv[1] < 1) {
    exit("\nSede non valida: Inserisci sede 1|2|3|4\n");
}

/**
 * Get Feed Submission Result  Sample
 */

include_once ('.config.inc.php');
$MERCHANT_ID = constant("MERCHANT_ID_" . $argv[1]); 

/************************************************************************
* Uncomment to configure the client instance. Configuration settings
* are:
*
* - MWS endpoint URL
* - Proxy host and port.
* - MaxErrorRetry.
***********************************************************************/
// IMPORTANT: Uncomment the appropriate line for the country you wish to
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

$config = array (
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
 * sample for Get Feed Submission Result Action
 ***********************************************************************/
 // @TODO: set request. Action can be passed as MarketplaceWebService_Model_GetFeedSubmissionResultRequest
 // object or array of parameters
 
//$parameters = array (
//  'Merchant' => MERCHANT_ID,
//  'FeedSubmissionId' => '<Feed Submission Id>',
//  'FeedSubmissionResult' => @fopen('php://memory', 'rw+'),
//);
//
//$request = new MarketplaceWebService_Model_GetFeedSubmissionResultRequest($parameters);

$request = new MarketplaceWebService_Model_GetFeedSubmissionResultRequest();
$request->setMerchant($MERCHANT_ID);

$feedId_query = tep_db_query("SELECT distinct(amazon_feedSubmissionId) as feedSubmissionId, amazon_feedType
                                FROM ".TABLE_AMAZON_FEEDS."
                                WHERE amazon_sede=".$argv[1]."
                              AND amazon_feedProcessingStatus = '_DONE_' AND amazon_xmlReqString IS NOT NULL");
while ($feedId = tep_db_fetch_array($feedId_query)) {
    $request->setFeedSubmissionId($feedId['feedSubmissionId']);
    $xmlSubmissionsFileResult='xmlReq/feedType'.$feedId['amazon_feedType'].'SubmissionResultSede'.$argv[1].'_'.date('Y-m-d\TH:i').'.xml';
    $request->setFeedSubmissionResult(fopen($xmlSubmissionsFileResult, 'w+'));
    invokeGetFeedSubmissionResult($service, $request);
    if($feedId['amazon_feedType']==1){ //Richiesta anagrafica prodotto scartate perchè assente su amazon.
        $xmlFile = simplexml_load_file($xmlSubmissionsFileResult);
        $skus= new ArrayIterator();
        foreach($xmlFile->Message as $Message){
            if((int)$Message->ProcessingReport->ProcessingSummary->MessagesWithError > 0 && $Message->ProcessingReport->Result->ResultCode='Error'){
                foreach($Message->ProcessingReport->Result as $Result){
                    $skus->append((int)$Result->AdditionalInfo->SKU);
                    tep_db_perform(TABLE_AMAZON_PRODUCTS_ERRORCODE,array('amazon_products_id'=>(int)$Result->AdditionalInfo->SKU,'sede'=>$argv[1],'error_date'=>'now()','result_message_code'=>$Result->ResultMessageCode,'result_description'=>$Result->ResultDescription,'feed_type'=>$feedId['amazon_feedType']));
                }
            }
        }
        foreach(array_unique($skus->getArrayCopy()) as $sku){
            tep_db_perform(TABLE_AMAZON_PRODUCTS_SEDE.$argv[1],array('no_amazon'=>1),'update','amazon_products_id='.(int)$sku);
        }
    }else{ //tutte le altre richieste scartate.
        $xmlFile = simplexml_load_file($xmlSubmissionsFileResult);
        foreach($xmlFile->Message as $Message){
            if((int)$Message->ProcessingReport->ProcessingSummary->MessagesWithError > 0 && $Message->ProcessingReport->Result->ResultCode='Error'){
                foreach($Message->ProcessingReport->Result as $Result){
                    tep_db_perform(TABLE_AMAZON_PRODUCTS_ERRORCODE,array('amazon_products_id'=>(int)$Result->AdditionalInfo->SKU,'sede'=>$argv[1],'error_date'=>'now()','result_message_code'=>$Result->ResultMessageCode,'result_description'=>$Result->ResultDescription,'feed_type'=>$feedId['amazon_feedType']));
                }
            }
        }
    }
    tep_db_query("DELETE FROM ".TABLE_AMAZON_FEEDS."
                                WHERE amazon_sede=".$argv[1]."
                              AND amazon_feedSubmissionId = ".$feedId['feedSubmissionId']);
}

/**
  * Get Feed Submission Result Action Sample
  * retrieves the feed processing report
  *   
  * @param MarketplaceWebService_Interface $service instance of MarketplaceWebService_Interface
  * @param mixed $request MarketplaceWebService_Model_GetFeedSubmissionResult or array of parameters
  */
  
  function invokeGetFeedSubmissionResult(MarketplaceWebService_Interface $service, $request) 
  {
      try {
              $response   = $service->getFeedSubmissionResult($request);
              
                echo ("Service Response\n");
                echo ("=============================================================================\n");

                echo("        GetFeedSubmissionResultResponse\n");
                
                if ($response->isSetGetFeedSubmissionResultResult()) {
                  $getFeedSubmissionResultResult = $response->getGetFeedSubmissionResultResult(); 
                  echo ("            GetFeedSubmissionResult: ");
                   
                  if ($getFeedSubmissionResultResult->isSetContentMd5()) {
                    echo ("                ContentMd5");
                    echo ("                " . $getFeedSubmissionResultResult->getContentMd5() . "\n");
                  }
                }
                if ($response->isSetResponseMetadata()) { 
                    echo("            ResponseMetadata\n");
                    $responseMetadata = $response->getResponseMetadata();
                    if ($responseMetadata->isSetRequestId()) 
                    {
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
?>
