<?php

function tep_GeteBayOfficialTimeResponse($resp=null){
    
if ($resp->Ack == "Success") {
   
$results = $resp->Timestamp;
    
}    
return $results;    
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

}else {
    
  $results  = "<h3>Oops! La richiesta non è riuscita. Assicurarsi che si sta utilizzando una valida ";
  $results .= "AppID per l'ambiente di produzione.</h3>";
}

return $results;

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

function tep_GetSellerListResponseItemID($resp=null){

if ($resp->Ack == "Success") {

foreach($resp->ItemArray->Item as $oggetto){
  
  $ebayid = $oggetto->ItemID;  

$results[] = $ebayid;
   
  }
return $results;       
 }    
}

## GetMyeBaySellingResponseItemID (Estraggo ID dei prodotti CompraSubito)

function tep_GetMyeBaySellingResponseItemID($resp=null){

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

?>
