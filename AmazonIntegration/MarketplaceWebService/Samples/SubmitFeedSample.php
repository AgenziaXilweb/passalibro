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
 * Submit Feed  Sample
 */

/**
 * control check del parametro passato.
 */
if ($argv[1] > 4 || $argv[1] < 1) {
    exit("\nSede non valida: Inserisci sede 1|2|3|4\n");
}

include_once('.config.inc.php');

$MERCHANT_ID = constant("MERCHANT_ID_" . $argv[1]);

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
 * sample for Submit Feed Action
 ***********************************************************************/
// @TODO: set request. Action can be passed as MarketplaceWebService_Model_SubmitFeedRequest
// object or array of parameters

// Note that PHP memory streams have a default limit of 2M before switching to disk. While you
// can set the limit higher to accomidate your feed in memory, it's recommended that you store
// your feed on disk and use traditional file streams to submit your feeds. For conciseness, this
// examples uses a memory stream.

$headerXml = <<< EOD
<?xml version="1.0" encoding="utf-8"?>
<AmazonEnvelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
  xsi:noNamespaceSchemaLocation="amzn-envelope.xsd">
  <Header>
    <DocumentVersion>1.01</DocumentVersion>
    <MerchantIdentifier>$MERCHANT_ID</MerchantIdentifier>
  </Header>
EOD;

$footerXml = '</AmazonEnvelope>';

$feedType_query = tep_db_query('SELECT feedsTypeID, feedsTypeValue, feedsXmlMessageType
                                FROM ' . TABLE_AMAZON_FEEDS_TYPE . ' ORDER BY feedsTypeID ASC');

while ($feedType = tep_db_fetch_array($feedType_query)) {

    if ($feedType['feedsTypeID'] != 4) {

        $xmlMessageID = 1;
        $xmlMessageType = $feedType['feedsXmlMessageType'];
        $feedTypeVal = $feedType['feedsTypeValue'];
        $xmlFeed = '';

        $feed_query = tep_db_query('SELECT amazon_feeds_id, amazon_xmlReqString
                                    FROM    ' . TABLE_AMAZON_FEEDS . '
                                WHERE amazon_feedSubmissionId IS NULL AND amazon_xmlReqString IS NOT NULL AND amazon_sede =' . $argv[1] . '
                                AND amazon_feedType=' . $feedType['feedsTypeID']);

        if (!tep_db_num_rows($feed_query)) {
            continue;
        }

        while ($feed = tep_db_fetch_array($feed_query)) {

            $xmlFeed .= '<Message><MessageID>' . $xmlMessageID . '</MessageID>' . utf8_encode($feed['amazon_xmlReqString']) .
                '</Message>';
            $xmlMessageID++;
        }

        $reqFeed = $headerXml . $xmlMessageType . $xmlFeed . $footerXml;

        echo $feedTypeVal . ":\n" . $reqFeed . "\n\n\n";
        $feedHandle = fopen('xmlReq/xmlFeed' . $feedType['feedsTypeID'] . 'SubmissionResultSede' . $argv[1] . '.xml', 'w+');

    } else {

        $txtMessageType = $feedType['feedsXmlMessageType']; //head flat-file 3 righe
        $feedTypeVal = $feedType['feedsTypeValue']; // _POST_FLAT_FILE_BOOKLOADER_DATA_
        $txtFeed = '';

        $feed_query = tep_db_query('SELECT amazon_feeds_id, amazon_xmlReqString
                                    FROM    ' . TABLE_AMAZON_FEEDS . '
                                WHERE amazon_feedSubmissionId IS NULL AND amazon_xmlReqString IS NOT NULL AND amazon_sede =' . $argv[1] . '
                                AND amazon_feedType=' . $feedType['feedsTypeID']);
        if (!tep_db_num_rows($feed_query)) {
            continue;
        }

        while ($feed = tep_db_fetch_array($feed_query)) {

            $txtFeed .= $feed['amazon_xmlReqString'] . PHP_EOL;

        }

        $reqFeed = $txtMessageType . PHP_EOL . $txtFeed;
        echo $feedTypeVal . ":\n" . $reqFeed . "\n\n\n";
        $feedHandle = fopen('txtReq/txtFeed' . $feedType['feedsTypeID'] . 'SubmissionResultSede' . $argv[1] . '.txt', 'w+');
    }

    // Constructing the MarketplaceId array which will be passed in as the the MarketplaceIdList
    // parameter to the SubmitFeedRequest object.
    //$marketplaceIdArray = array("Id" => array('<Marketplace_Id_1>','<Marketplace_Id_2>'));

    // MWS request objects can be constructed two ways: either passing an array containing the
    // required request parameters into the request constructor, or by individually setting the request
    // parameters via setter methods.
    // Uncomment one of the methods below.

    /********* Begin Comment Block *********/

    //    $feedHandle = @fopen('php:temp', 'rw+');
    //    fwrite($feedHandle, $xmlReqFeed);
    //    rewind($feedHandle);
    //    $parameters = array (
    //      'Merchant' => $MERCHANT_ID,
    //      //'MarketplaceIdList' => $marketplaceIdArray,
    //      'FeedType' => $feedTypeVal,
    //      'FeedContent' => $feedHandle,
    //      'PurgeAndReplace' => false,
    //      'ContentMd5' => base64_encode(md5(stream_get_contents($feedHandle), true)),
    //    );
    //
    //    rewind($feedHandle);
    //
    //    $request = new MarketplaceWebService_Model_SubmitFeedRequest($parameters);
    /********* End Comment Block *********/

    /********* Begin Comment Block *********/
    fwrite($feedHandle, $reqFeed);
    rewind($feedHandle);
    $request = new MarketplaceWebService_Model_SubmitFeedRequest();
    $request->setMerchant($MERCHANT_ID);
    //$request->setMarketplaceIdList($marketplaceIdArray);
    $request->setFeedType($feedTypeVal);
    $request->setContentMd5(base64_encode(md5(stream_get_contents($feedHandle), true)));
    rewind($feedHandle);
    $request->setPurgeAndReplace(false);
    $request->setFeedContent($feedHandle);
    rewind($feedHandle);
    /********* End Comment Block *********/

    invokeSubmitFeed($service, $request, $feedType['feedsTypeID'], $argv[1]);
    @fclose($feedHandle);
    sleep(3); //il seguente sleep per cercare di ovviare al bug di amazon in merito alla perdita di alcuni feed di inventory
}
/**
 * Submit Feed Action Sample
 * Uploads a file for processing together with the necessary
 * metadata to process the file, such as which type of feed it is.
 * PurgeAndReplace if true means that your existing e.g. inventory is
 * wiped out and replace with the contents of this feed - use with
 * caution (the default is false).
 *
 * @param MarketplaceWebService_Interface $service instance of MarketplaceWebService_Interface
 * @param mixed $request MarketplaceWebService_Model_SubmitFeed or array of parameters
 */
function invokeSubmitFeed(MarketplaceWebService_Interface $service, $request, $reqFeedType, $sede = '')
{
    try {
        $response = $service->submitFeed($request);

        echo("Service Response\n");
        echo("=============================================================================\n");

        echo("        SubmitFeedResponse\n");
        if ($response->isSetSubmitFeedResult()) {
            echo("            SubmitFeedResult\n");
            $submitFeedResult = $response->getSubmitFeedResult();
            if ($submitFeedResult->isSetFeedSubmissionInfo()) {
                echo("                FeedSubmissionInfo\n");
                $feedSubmissionInfo = $submitFeedResult->getFeedSubmissionInfo();
                if ($feedSubmissionInfo->isSetFeedSubmissionId()) {
                    echo("                    FeedSubmissionId\n");
                    echo("                        " . $feedSubmissionInfo->getFeedSubmissionId() .
                        "\n");
                }
                if ($feedSubmissionInfo->isSetFeedType()) {
                    echo("                    FeedType\n");
                    echo("                        " . $feedSubmissionInfo->getFeedType() . "\n");
                }
                if ($feedSubmissionInfo->isSetSubmittedDate()) {
                    echo("                    SubmittedDate\n");
                    echo("                        " . $feedSubmissionInfo->getSubmittedDate()->
                            format(DATE_FORMAT) . "\n");
                }
                if ($feedSubmissionInfo->isSetFeedProcessingStatus()) {
                    echo("                    FeedProcessingStatus\n");
                    echo("                        " . $feedSubmissionInfo->getFeedProcessingStatus
                            () . "\n");
                }
                if ($feedSubmissionInfo->isSetStartedProcessingDate()) {
                    echo("                    StartedProcessingDate\n");
                    echo("                        " . $feedSubmissionInfo->
                            getStartedProcessingDate()->format(DATE_FORMAT) . "\n");
                }
                if ($feedSubmissionInfo->isSetCompletedProcessingDate()) {
                    echo("                    CompletedProcessingDate\n");
                    echo("                        " . $feedSubmissionInfo->
                            getCompletedProcessingDate()->format(DATE_FORMAT) . "\n");
                }

                $sql_data_array = array(
                    'amazon_feedSubmissionId' => $feedSubmissionInfo->getFeedSubmissionId(),
                    'amazon_feedProcessingStatus' => $feedSubmissionInfo->getFeedProcessingStatus(),
                    'amazon_lastAckDate' => 'now()',

                );
                tep_db_perform(TABLE_AMAZON_FEEDS, $sql_data_array, 'update',
                    "amazon_feedType = " . (int)$reqFeedType . " AND amazon_sede=" . $sede);

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

        echo("            ResponseHeaderMetadata: " . $response->
                getResponseHeaderMetadata() . "\n");
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
