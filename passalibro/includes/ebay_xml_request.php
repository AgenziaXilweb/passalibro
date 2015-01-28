<?php

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

/// RICHIAMO E AGGIORNO PRODOTTI ///

function tep_ReviseItemRequest($tokensede='',$item='',$quantity=''){

return $updateitem = '<?xml version="1.0" encoding="utf-8"?>
<ReviseItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>'.$tokensede.'</eBayAuthToken>
</RequesterCredentials>
<Item ComplexType="ItemType">
<ItemID>'.$item.'</ItemID>
<Quantity>'.$quantity.'</Quantity>
</Item>
</ReviseItemRequest>';

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

// RICHIAMO LE INFORMAZIONI DEL PRODOTTO

function tep_GetItemRequest($tokensede='',$itemid='',$specifiche='false'){

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

?>