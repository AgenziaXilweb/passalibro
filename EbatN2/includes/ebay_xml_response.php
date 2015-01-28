<?php

###################################################################
### Risposte da eBay ##############################################
###################################################################

function tep_ReviseItemResponse($resp=null){

// Conferma di aggiornamento dati riuscito prodotto

if ($resp->Ack == "Success") {

$revisedate = $resp->Timestamp;

return $revisedate;
}
}

function tep_ReviseItemImagesResponse($resp=null){

// Conferma di aggiornamento immagine riuscito prodotto

if ($resp->Ack == "Success") {

$revisedate = $resp->Timestamp;

return $revisedate;
}
}

function tep_AddFixedPriceItemResponse($resp=null){

// Conferma di chiusura riuscito prodotto

if ($resp->Ack == "Success" || $resp->Ack == "Warning" || $resp->Ack == "Failure") {

  
$results = array( 'Timestamp' => $resp->Timestamp,
'Ack' => $resp->Ack,
'ShortMessage' => $resp->Errors->ShortMessage,
'LongMessage' => $resp->Errors->LongMessage,
'ItemID' => $resp->ItemID,
'StartTime' => $resp->StartTime,
'EndTime' => $resp->EndTime);


return $results;

 }
}

function tep_EndFixedPriceItemResponse($resp=null){

// Conferma di chiusura riuscito prodotto

if ($resp->Ack == "Success") {

$closedate = $resp->Timestamp;

return $closedate;

}

}


function tep_GeteBayOfficialTimeResponse($resp=null){
    
if ($resp->Ack == "Success") {
   
$results = $resp->Timestamp;

return $results;
    
}        
}


function tep_GetApiAccessRulesResponse($resp=null){
    
if ($resp->Ack == "Success") {

foreach($resp->ApiAccessRule as $item) {
    
    $results = array( 'CallName' => $item->CallName,
        'Counts' => $item->CountsTowardAggregate,
        'DailyHardLimit' => $item->DailyHardLimit,
        'DailySoftLimit' => $item->DailySoftLimit,
        'DailyUsage' => $item->DailyUsage,
        'HourlyHardLimit' => $item->HourlyHardLimit,
        'HourlySoftLimit' => $item->HourlySoftLimit,
        'HourlyUsage' => $item->HourlyUsage,
        'Period' => $item->Period,
        'PeriodicHardLimit' => $item->PeriodicHardLimit,
        'PeriodicSoftLimit' => $item->PeriodicSoftLimit,
        'PeriodicUsage' => $item->PeriodicUsage,
        'ModTime'=>$item->ModTime,
        'RuleCurrentStatus'=>$item->RuleCurrentStatus,
        'RuleStatus'=>$item->RuleStatus);   

  }
return $results;
 }       
}

######## Gestione del singolo prodotto

## GetItemResponse (Etraggo tutte le informazioni del prodotto)

function tep_GetItemResponse($resp=null){

if ($resp->Ack == "Success") {

  foreach($resp->Item as $item) {
    
$results = array( 'picture' => $item->PictureDetails->GalleryURL,
'link' => $item->ListingDetails->ViewItemURL,
'start' => $item->ListingDetails->StartTime,
'end' => $item->ListingDetails->EndTime,
'title' => $item->Title,
'StoreCategoryID' => $item->Storefront->StoreCategoryID,
'productID' => $item->ItemID,
'quantity' => $item->Quantity,
'price' => $item->SellingStatus->ConvertedCurrentPrice,
'Description' => $item->Description,
'ConditionDisplayName' => $item->ConditionDisplayName,
'ConditionID' => $item->ConditionID);
        }

return $results;

    }
}


function tep_GetItemSpecificsResponse($resp=null){

if ($resp->Ack == "Success") {

  foreach($resp->Item->ItemSpecifics->NameValueList as $item) {
    
$array = array( 'NameSpecifics' => $item->Name,
'ValueSpecifics' => $item->Value,
'Source' => $item->Source);
    
$results[] = $array;
  }
return $results;
 }
}

######## Gestione dei prodotti

## GetSellerListResponseItemID (Estraggo ID di tutti i prodotti attivi)

function tep_GetSellerListResponse($resp=null){

if ($resp->Ack == "Success") {

foreach($resp->ItemArray->Item as $oggetto){
  
    $array = array('ItemID'=>$oggetto->ItemID);
  
  $results[] = $array;  
  
  }
return $results;
 }    
}

## GetMyeBaySellingResponseItemID (Estraggo ID dei prodotti CompraSubito)

function tep_GetMyeBaySellingResponse($resp=null){

if ($resp->Ack == "Success") {

foreach($resp->ActiveList->ItemArray->Item as $oggetto){
  
  $ebayid = $oggetto->ItemID;  

$results[] = $ebayid;
   
  }
return $results;       
 }    
}

######## Gestione delle Categorie dei negozi eBay

## GetCategoryStoreResponse (Estraggo ID Categorie e relativo Nome)

function tep_GetCategoryStoreResponse($resp=null){
    
if ($resp->Ack == "Success") {

foreach($resp->Store->CustomCategories->CustomCategory as $tags){
  
$array = array('CategoryID' => $tags->CategoryID,
  'Name' => $tags->Name,
  'Order' => $tags->Order); 

$results[] = $array;
   
  }
return $results;
 }        
}

## SetCategoryStoreResponse (Conferma di modifica di StoreCategoryName)

function tep_SetCategoryStoreResponse(){

if ($resp->Ack == "Success") {

$tags = $resp->Status == "Complete"?true:false;

return $tags;

 }   
}

function tep_GetOrdersResponse($resp=null){

$xml='<Order>
      <OrderID>164177154017</OrderID>
      <OrderStatus>Completed</OrderStatus>
      <AmountPaid currencyID="EUR">32.5</AmountPaid>
      <CheckoutStatus>
        <LastModifiedTime>2014-04-24T08:04:37.000Z</LastModifiedTime>
        <PaymentMethod>PayPal</PaymentMethod>
        <Status>Complete</Status>
      </CheckoutStatus>
      <CreatingUserRole>Seller</CreatingUserRole>
      <CreatedTime>2014-04-17T07:19:26.000Z</CreatedTime>
      <PaymentMethods>PayPal</PaymentMethods>
      <SellerEmail>frigierimarco@tiscali.it</SellerEmail>
      <ShippingAddress>
        <Name>Marina Perotti c/o Editrice delle Alpi</Name>
        <Street1>via Crimea 2 bis</Street1>
        <Street2>
        </Street2>
        <CityName>Collegno</CityName>
        <StateOrProvince>TO</StateOrProvince>
        <Country>IT</Country>
        <CountryName>Italia</CountryName>
        <Phone>3420049547</Phone>
        <PostalCode>10093</PostalCode>
        <AddressID>1349728656017</AddressID>
        <AddressOwner>eBay</AddressOwner>
        <ExternalAddressID>
        </ExternalAddressID>
      </ShippingAddress>
      <ShippingServiceSelected>
        <ShippingService>IT_MailRegisteredLetter</ShippingService>
        <ShippingServiceCost currencyID="EUR">3.5</ShippingServiceCost>
      </ShippingServiceSelected>
      <Subtotal currencyID="EUR">29.0</Subtotal>
      <Total currencyID="EUR">32.5</Total>
      <TransactionArray>
        <Transaction>
          <Buyer>
            <Email>maper@fastwebnet.it</Email>
          </Buyer>
          <ShippingDetails>
            <SellingManagerSalesRecordNumber>34637</SellingManagerSalesRecordNumber>
          </ShippingDetails>
          <CreatedDate>2014-04-17T07:09:07.000Z</CreatedDate>
          <Item>
            <ItemID>260821240487</ItemID>
          </Item>
          <QuantityPurchased>1</QuantityPurchased>
          <TransactionID>1401680670016</TransactionID>
          <TransactionPrice currencyID="EUR">6.0</TransactionPrice>
          <TransactionSiteID>Italy</TransactionSiteID>
          <Platform>eBay</Platform>
          <OrderLineItemID>260821240487-1401680670016</OrderLineItemID>
          <InvoiceSentTime>2014-04-17T07:19:26.000Z</InvoiceSentTime>
        </Transaction>
      </TransactionArray>
      <BuyerUserID>marinap53</BuyerUserID>
      <PaidTime>2014-04-23T14:25:07.000Z</PaidTime>
      <ShippedTime>2014-04-24T08:02:11.000Z</ShippedTime>
    </Order>';
    
if ($resp->Ack == "Success") {

foreach($resp->OrderArray->Order as $tags){
  
$array = array('OrderID' => $tags->OrderID,
'LastModifiedTime' => $tags->CheckoutStatus->LastModifiedTime,
'PaymentMethod' => $tags->CheckoutStatus->PaymentMethod,
'OrderStatus' => $tags->CheckoutStatus->Status,
'TransactionID' => $tags->TransactionArray->Transaction->TransactionID,
'ItemID' => $tags->TransactionArray->Transaction->Item->ItemID,
'Name' => utf8_decode($tags->ShippingAddress->Name),
'Street1' => utf8_decode($tags->ShippingAddress->Street1),
'Street2' => utf8_decode($tags->ShippingAddress->Street2),
'CityName' => utf8_decode($tags->ShippingAddress->CityName),
'StateOrProvince' => utf8_decode($tags->ShippingAddress->StateOrProvince),
'Country' => utf8_decode($tags->ShippingAddress->Country),
'Phone' => $tags->ShippingAddress->Phone,
'PostalCode' => $tags->ShippingAddress->PostalCode,
'AddressID' => $tags->ShippingAddress->AddressID,
'QuantityPurchased' => $tags->TransactionArray->Transaction->QuantityPurchased,
'Email' => $tags->TransactionArray->Transaction->Buyer->Email,
'CreatedDate' => $tags->TransactionArray->Transaction->CreatedDate,
'TransactionPrice' => $tags->TransactionArray->Transaction->TransactionPrice,
'ShippingService'=> $tags->ShippingServiceSelected->ShippingService,
'ShippingServiceCost'=> str_replace('.',',',$tags->ShippingServiceSelected->ShippingServiceCost),
'BuyerUserID'=> $tags->BuyerUserID,
'PaidTime'=> $tags->PaidTime,
'Subtotal'=> $tags->Subtotal,
'ShippedTime'=> $tags->ShippedTime);

$results[] = $array;
   
  }
return $results;
 }
    
}

function tep_RelistItemResponse($resp=null) {
    
// Conferma di ripubblicazione prodotto

if ($resp->Ack == "Success" || $resp->Ack == "Warning" || $resp->Ack == "Failure") {

$results = array( 'Timestamp' => $resp->Timestamp,
'Ack' => $resp->Ack,
'ItemID' => $resp->ItemID,
'ShortMessage' => $resp->Errors->ShortMessage,
'LongMessage' => $resp->Errors->LongMessage,
'StartTime' => $resp->StartTime,
'EndTime' => $resp->EndTime);

return $results;

 }   
  
}

function tep_RelistFixedPriceItemResponse($resp=null) {
    
// Conferma di ripubblicazione prodotto

if ($resp->Ack == "Success" || $resp->Ack == "Warning" || $resp->Ack == "Failure") {
 
$results = array( 'Timestamp' => $resp->Timestamp,
'Ack' => $resp->Ack,
'ItemID' => $resp->ItemID,
'StartTime' => $resp->StartTime,
'EndTime' => $resp->EndTime);

return $results;

 }   
  
}

?>