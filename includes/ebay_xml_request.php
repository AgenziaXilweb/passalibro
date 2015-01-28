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

function tep_ReviseItemRequest($tokensede='',$item='',$quantity=''){

// Aggiornamento quantita prodotto

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

?>