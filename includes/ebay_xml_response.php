<?php

###################################################################
### Risposte da eBay ##############################################
###################################################################


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

function tep_ReviseItemResponse($resp=null){

// Conferma di aggiornamento riuscito prodotto

if ($resp->Ack == "Success") {

$revisedate = $resp->Timestamp;

}
return $revisedate;
}

?>