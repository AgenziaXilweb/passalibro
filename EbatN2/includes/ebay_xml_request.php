<?php

###################################################################
### Richeste eBay #################################################
###################################################################

function tep_GetItemRequest($tokensede='',$itemid='',$specifiche='false'){

// Richiest informazioni Prodotto

return $product = '<?xml version="1.0" encoding="utf-8"?>
<GetItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
<ItemID>'.$itemid.'</ItemID>
<IncludeItemSpecifics>'.$specifiche.'</IncludeItemSpecifics>
<DetailLevel>ReturnAll</DetailLevel>
<Version>819</Version>
</GetItemRequest>';

}    

function tep_ReviseItemRequest($tokensede='',$data=null,$duration='GTC',$LoadImage='0'){

//$image = file_exists('../images/ISBN/'.$data['isbn13'].'.jpg')?'images/ISBN/'.$data['isbn13'].'.jpg':file_exists('../images/ISBN/'.$data['cod_chiave'].'.jpg')?'images/ISBN/'.$data['cod_chiave'].'.jpg':'images/nopic.png';

$path_images_key = '/var/www/home/passalibo.com/images/ISBN/'.$data['cod_chiave'].'.jpg';
$path_images_isbn = '/var/www/home/passalibo.com/images/ISBN/'.$data['isbn13'].'.jpg';

if(file_exists($path_images_isbn)){

$image = 'images/ISBN/'.$data['isbn13'].'.jpg';   
    
}

if(file_exists($path_images_key)){   

$image = 'images/ISBN/'.$data['cod_chiave'].'.jpg';   
    
} else {
    
$image = 'images/nopic.png';
    
}


// Aggiornamento quantita prodotto

$updateitem = '<?xml version="1.0" encoding="utf-8"?>
<ReviseItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
<Item>
<ItemID>'.$data['ItemID'].'</ItemID>
<StartPrice currencyID="EUR">'.$data['prezzo'].'</StartPrice>
<BestOfferDetails><BestOfferEnabled>'.$data['proposta'].'</BestOfferEnabled></BestOfferDetails>
<ConditionID>'.$data['condizione_ebay'].'</ConditionID>
<Quantity>'.$data['quantity'].'</Quantity>';

 // se attivo 1 aggiorno le immagini

if($LoadImage == '1'){

$updateitem .= '<PictureDetails>
      <GalleryType>Gallery</GalleryType>
      <GalleryURL>http://www.passalibro.it/'.$image.'</GalleryURL>
      <PhotoDisplay>VendorHostedPictureShow</PhotoDisplay>
      <PictureURL>http://www.passalibro.it/'.$image.'</PictureURL>
    </PictureDetails>';   
}

$updateitem .= '</Item>
</ReviseItemRequest>';
                  
return $updateitem;

}

function tep_ReviseItemImagesRequest($tokensede='',$data=null){

$path_images_key = '/var/www/home/passalibro.com/images/ISBN/'.$data['cod_chiave'].'.jpg';
$path_images_isbn = '/var/www/home/passalibro.com/images/ISBN/'.$data['isbn13'].'.jpg';

if(file_exists($path_images_isbn)){

$image = 'images/ISBN/'.$data['isbn13'].'.jpg';   
    
}else {
    
if(file_exists($path_images_key)){   

$image = 'images/ISBN/'.$data['cod_chiave'].'.jpg';   
    
} else {
    
$image = 'images/nopic.png';
    
}
    
}



$updateitem = '<?xml version="1.0" encoding="utf-8"?>
<ReviseItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
<Item>
<ItemID>'.$data['ItemID'].'</ItemID>
<PictureDetails>
      <GalleryType>Gallery</GalleryType>
      <GalleryURL>http://www.passalibro.it/'.$image.'</GalleryURL>
      <PhotoDisplay>VendorHostedPictureShow</PhotoDisplay>
      <PictureURL>http://www.passalibro.it/'.$image.'</PictureURL>
    </PictureDetails>
</Item>
</ReviseItemRequest>';
                  
return $updateitem;

}

function tep_AddFixedPriceItemRequest($tokensede='',$data=null,$duration='GTC') {
 
$html = 'Titolo: '.$data['titolo'].'<br>';
$html .= 'Condizioni: '.$data['stato_uso'].'<br>';
$html .= 'Ubicazione: '.$data['ubicazione'].'<br>';
$html .= 'Autore: '.$data['autore1'].'<br>';
$html .= 'Editore: '.$data['editore'].'<br>';
$html .= 'ISBN13: '.$data['isbn13'].'<br>'; 
$html .= 'Anno Edizione: '.$data['anno_edizione'].'<br><br>';
$html .= 'SKU: ['.$data['SKU'].']<br>';

if($data['isbn13'] <> ''){
    
    $details = '<ProductListingDetails>
<UPC>'.$data['isbn13'].'</UPC>
<IncludeStockPhotoURL>true</IncludeStockPhotoURL>
<IncludePrefilledItemInformation>true</IncludePrefilledItemInformation>
<UseFirstProduct>true</UseFirstProduct>
<UseStockPhotoURLAsGallery>true</UseStockPhotoURLAsGallery>
<ReturnSearchResultOnDuplicates>true</ReturnSearchResultOnDuplicates>
</ProductListingDetails>';
    
}else{
    
    $details = '';
    
}

    
$upc = strlen($data['isbn13']) == 13 ? $details : '';
$catID = $data['isbn13'] == '' ? '<PrimaryCategory><CategoryID>'.$data['categoria_ebay'].'</CategoryID></PrimaryCategory>' : '<PrimaryCategory><CategoryID>38840</CategoryID></PrimaryCategory>';
//$image = file_exists('../images/ISBN/'.$data['isbn13'].'.jpg')?'images/ISBN/'.$data['isbn13'].'.jpg':file_exists('../images/ISBN/'.$data['cod_chiave'].'.jpg')?'images/ISBN/'.$data['cod_chiave'].'.jpg':'images/nopic.png';
$path_images_key = '/var/www/home/passalibro.com/images/ISBN/'.$data['cod_chiave'].'.jpg';
$path_images_isbn = '/var/www/home/passalibro.com/images/ISBN/'.$data['isbn13'].'.jpg';

if(file_exists($path_images_isbn)){

$image = 'images/ISBN/'.$data['isbn13'].'.jpg';   
    
}else {
    
if(file_exists($path_images_key)){   

$image = 'images/ISBN/'.$data['cod_chiave'].'.jpg';   
    
} else {
    
$image = 'images/nopic.png';
    
}
    
}

$text_return_policy = 'Accetto la restituzione nei termini di legge che normano questo diritto.ABBIAMO AVUTO DISGUIDI CON LE SPEDIZIONI PIEGO DI LIBRI.RIBADIAMO CHE NON ABBIAMO NESSUN PROBLEMA AD EFFETTUARLE, MA NON CI ASSUMIAMO ALCUNA RESPONSABILITA\' PER MANCATO ARRIVO E PURTROPPO NON RISARCIAMO! CONSIGLIAMO VIVAMENTE LA SPEDIZIONE RACCOMANDATA CHE E\' TRACCIATA!';


// Aggiungo un nuovo prodotto
    
$xml = '<?xml version="1.0" encoding="utf-8"?>
<AddFixedPriceItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<ErrorLanguage>it_IT</ErrorLanguage>
<WarningLevel>High</WarningLevel>
<Item>
<ListingDesigner>
  <LayoutID>10110000</LayoutID>
  <ThemeID>10130705</ThemeID>
</ListingDesigner>
<SKU>'.$data['SKU'].'</SKU>
<StartPrice>'.$data['prezzo'].'</StartPrice>
<Title>'.$data['titolo'].'</Title>
<BestOfferDetails>
    <BestOfferEnabled>'.$data['proposta'].'</BestOfferEnabled>
</BestOfferDetails>
<CategoryMappingAllowed>true</CategoryMappingAllowed>
<ConditionID>'.$data['condizione_ebay'].'</ConditionID>
<ListingDuration>'.$duration.'</ListingDuration>
<PostalCode>'.$data['cap'].'</PostalCode>
<Country>IT</Country>
<Currency>EUR</Currency>
<Description><![CDATA['.$html.']]></Description>
<ListingType>FixedPriceItem</ListingType>
<PaymentMethods>PayPal</PaymentMethods>
<PayPalEmailAddress>'.$data['paypal'].'</PayPalEmailAddress>'.$catID.'
<PictureDetails>
 <GalleryType>Gallery</GalleryType>
 <GalleryURL>http://www.passalibro.it/'.$image.'</GalleryURL>
   <PhotoDisplay>VendorHostedPictureShow</PhotoDisplay>
 <PictureURL>http://www.passalibro.it/'.$image.'</PictureURL>
</PictureDetails>'.$details;

$xml .='<ShippingDetails>
      <ApplyShippingDiscount>false</ApplyShippingDiscount>
      <CalculatedShippingRate>
        <WeightMajor measurementSystem="English" unit="lbs">0</WeightMajor>
        <WeightMinor measurementSystem="English" unit="oz">0</WeightMinor>
      </CalculatedShippingRate>
      <InsuranceFee currencyID="EUR">0.0</InsuranceFee>
      <InsuranceOption>NotOffered</InsuranceOption>
      <SalesTax>
        <SalesTaxPercent>0.0</SalesTaxPercent>
        <ShippingIncludedInTax>false</ShippingIncludedInTax>
      </SalesTax>
      <ShippingServiceOptions>
        <ShippingService>IT_PriorityMail</ShippingService>
        <ShippingServiceCost currencyID="EUR">2.5</ShippingServiceCost>
        <ShippingServiceAdditionalCost currencyID="EUR">0.0</ShippingServiceAdditionalCost>
        <ShippingServicePriority>1</ShippingServicePriority>
        <ExpeditedService>true</ExpeditedService>
        <ShippingTimeMin>2</ShippingTimeMin>
        <ShippingTimeMax>4</ShippingTimeMax>
      </ShippingServiceOptions>
      <ShippingServiceOptions>
        <ShippingService>IT_MailRegisteredLetter</ShippingService>
        <ShippingServiceCost currencyID="EUR">5.0</ShippingServiceCost>
        <ShippingServiceAdditionalCost currencyID="EUR">0.0</ShippingServiceAdditionalCost>
        <ShippingServicePriority>2</ShippingServicePriority>
        <ExpeditedService>false</ExpeditedService>
        <ShippingTimeMin>2</ShippingTimeMin>
        <ShippingTimeMax>5</ShippingTimeMax>
      </ShippingServiceOptions>
      <ShippingType>Flat</ShippingType>
      <ThirdPartyCheckout>false</ThirdPartyCheckout>
      <InsuranceDetails>
        <InsuranceOption>NotOffered</InsuranceOption>
      </InsuranceDetails>
      <ShippingDiscountProfileID>0</ShippingDiscountProfileID>
      <InternationalShippingDiscountProfileID>0</InternationalShippingDiscountProfileID>
      <SellerExcludeShipToLocationsPreference>false</SellerExcludeShipToLocationsPreference>
    </ShippingDetails><DispatchTimeMax>2</DispatchTimeMax>';

$xml .= '<Quantity>'.$data['quantity'].'</Quantity>
      <ReturnPolicy>
        <ReturnsWithinOption>Days_14</ReturnsWithinOption>
        <ReturnsWithin>14 giorni</ReturnsWithin>
        <ReturnsAcceptedOption>ReturnsAccepted</ReturnsAcceptedOption>
        <ReturnsAccepted>Restituzione accettata</ReturnsAccepted>
        <Description>'.$text_return_policy.'</Description>
        <ShippingCostPaidByOption>Buyer</ShippingCostPaidByOption>
        <ShippingCostPaidBy>Acquirente</ShippingCostPaidBy>
      </ReturnPolicy>
<Site>Italy</Site>
</Item>
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
<WarningLevel>High</WarningLevel>
</AddFixedPriceItemRequest>';

return $xml;
       
}

function tep_EndFixedPriceItemRequest($tokensede='',$itemid=''){

// Chiudo inserzione prodotto

//  Indicates the seller's reason for ending the listing early. 
//  This field is required if the seller is ending the item early and the item did not successfully sell. 
//
// Applicable values:
// CustomCode - (in/out) Reserved for internal or future use.
// Incorrect - (in/out) The start price or reserve price is incorrect.
// LostOrBroken  - (in/out) The item was lost or broken.
// NotAvailable - (in/out) The item is no longer available for sale.
// OtherListingError - (in/out) The listing contained an error (other than start price or reserve price).
// SellToHighBidder - (in/out) Seller want to sell the listing to the high bidder. 
// Sold - (in/out) The vehicle was sold. Applies to local classified listings for vehicles only.

// Marco 31/05/2014 ultimo
    
$xml = '<?xml version="1.0" encoding="utf-8"?>
<EndFixedPriceItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
<ItemID>'.$itemid.'</ItemID>
<EndingReason EnumType="EndReasonCodeType">NotAvailable</EndingReason>
</EndFixedPriceItemRequest>';    

return $xml;
    
}

function tep_RelistItemRequest($tokensede='',$itemid=''){

return $xml = '<?xml version="1.0" encoding="utf-8"?>
<RelistItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
  <RequesterCredentials>
  <eBayAuthToken>'.$tokensede.'</eBayAuthToken>
  </RequesterCredentials>
  <ErrorLanguage>it_IT</ErrorLanguage>
  <WarningLevel>High</WarningLevel>
  <Item>
    <ItemID>'.$itemid.'</ItemID>
  </Item>
</RelistItemRequest>?';

}

/// RICHIEDEO IN REPORT CHIAMATE

function tep_GeteBayOfficialTimeRequest($tokensede=''){
    
return $ebaytime='<?xml version="1.0" encoding="utf-8"?>
<GeteBayOfficialTimeRequest xmlns="urn:ebay:apis:eBLBaseComponents">
  <RequesterCredentials>
    <eBayAuthToken>'.$tokensede.'</eBayAuthToken>
  </RequesterCredentials>
</GeteBayOfficialTimeRequest>';    

}


function tep_GetApiAccessRulesRequest($tokensede=''){
    
return $xml = '<?xml version="1.0" encoding="utf-8"?>
<GetApiAccessRulesRequest xmlns="urn:ebay:apis:eBLBaseComponents">
  <RequesterCredentials>
    <eBayAuthToken>'.$tokensede.'</eBayAuthToken>
  </RequesterCredentials>
</GetApiAccessRulesRequest>';
        
}



/// RICHIAMO LISTA PRODOTTI ATTIVI ////

function tep_GetMyeBaySelling($tokensede='',$pageitems='',$pagemumber=''){

return $prodottiattivi = '<?xml version="1.0" encoding="utf-8"?>
<GetMyeBaySellingRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
<ActiveList>
<Include>true</Include>
<ListingType>FixedPriceItem</ListingType>
<Sort>ItemID</Sort>
<IncludeNotes>false</IncludeNotes>
<Pagination><EntriesPerPage>'.$pageitems.'</EntriesPerPage>
<PageNumber>'.$pagemumber.'</PageNumber>
</Pagination>
</ActiveList>
<DetailLevel>ReturnAll</DetailLevel>
</GetMyeBaySellingRequest>';
}

// RICHIAMO E SCARICO LE CATEGORIE DEL NEGOZIO //

function tep_GetCategoryStoreRequest($tokensede='',$level=''){
    
return $categorystore = '<?xml version="1.0" encoding="utf-8"?>
<GetStoreRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
<CategoryStructureOnly>true</CategoryStructureOnly>
<LevelLimit>'.$level.'</LevelLimit>
<Version>819</Version>
</GetStoreRequest>';   
    
}

// RICHAMO E SETTO LE CATEGORIE DEL NEGOZIO

function tep_SetStoreCategoryRequest($tokensede='',$action='Rename',$categoryid=null,$name=null){
    
return $categorystore = '<?xml version="1.0" encoding="utf-8"?>
<SetStoreCategoriesRequest xmlns="urn:ebay:apis:eBLBaseComponents">
  <RequesterCredentials>
    <eBayAuthToken>'.$tokensede.'</eBayAuthToken>
  </RequesterCredentials>
  <Action>'.$action.'</Action>
  <StoreCategories>
    <CustomCategory>
      <CategoryID>'.$categoryid.'</CategoryID>
      <Name>'.$name.'</Name>
    </CustomCategory>
  </StoreCategories>
</SetStoreCategoriesRequest>';
    
}

// RICHIAMO LA LISTA DEI PRODOTTI ATTIVI



function tep_GetSellerListRequest($tokensede='',$userid=null,$entriesperpage=null,$pagenumber=null,$starttimefrom=null,$starttimeto=null,$selector=''){
    
return $xml = '<?xml version="1.0" encoding="utf-8"?>
<GetSellerListRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
<Pagination ComplexType="PaginationType">
<EntriesPerPage>'.$entriesperpage.'</EntriesPerPage>
<PageNumber>'.$pagenumber.'</PageNumber>
</Pagination>
<UserID>'.$userid.'</UserID>
<StartTimeFrom>'.$starttimefrom.'</StartTimeFrom> 
 <StartTimeTo>'.$starttimeto.'</StartTimeTo>
<DetailLevel>ItemReturnDescription</DetailLevel>
<OutputSelector>'.$selector.'</OutputSelector>
<Version>819</Version>
</GetSellerListRequest>?';  
    
}

// Richiesta degli ordini completati 

function tep_GetOrdersDateRequest($tokensede='',$data=''){
    
return '<?xml version="1.0" encoding="utf-8"?>
<GetOrdersRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
    <CreateTimeFrom>'.$data['CreateTimeFrom'].'</CreateTimeFrom>
  <CreateTimeTo>'.$data['CreateTimeTo'].'</CreateTimeTo>
  <OrderRole>'.$data['OrderRole'] .'</OrderRole>
  <OrderStatus>'.$data['OrderStatus'].'</OrderStatus>
  <DetailLevel>'.$data['DetailLevel'].'</DetailLevel>
</GetOrdersRequest>';
    
}

// Richiesta degli ordini completati NumberOfDays

function tep_GetOrdersRequest($tokensede='',$data=''){
    
return '<?xml version="1.0" encoding="utf-8"?>
<GetOrdersRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
    <NumberOfDays>'.$data['NumberOfDays'].'</NumberOfDays>
  <OrderRole>'.$data['OrderRole'] .'</OrderRole>
  <OrderStatus>'.$data['OrderStatus'].'</OrderStatus>
  <DetailLevel>'.$data['DetailLevel'].'</DetailLevel>
</GetOrdersRequest>';
    
}

?>