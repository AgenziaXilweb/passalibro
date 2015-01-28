<?php

/// Marco 21/05/2013 - funzione di aggiornamento quantità su ebay


if($products_array[$i]['ebay']=='1'){

$magazzino[]=tep_warhouses($products_array[$i]['model']);

for($x=0;$x<count($magazzino);$x++){

if($magazzino[$x]['model']==$products_array[$i]['model']){

$ebaysede[]=tep_get_token('sandbox',$magazzino[$x]['sede']);

$quantita_ebay=tep_GetItemRequest($ebaysede[$x]['token'],$magazzino[$x]['model']);

$GetItemXml=talk_to_ebay($ebaysede[$x]['devID'],$ebaysede[$x]['appID'],$ebaysede[$x]['certID'],'GetItem',$quantita_ebay,$ebaysede[$x]['type'],'101','819');

$qtyResults=tep_GetItemResponse($GetItemXml);

$itemResults[]=$qtyResults;

$fieldtype[]=$magazzino[$x]['type']=='n'?'products_quantity':'products_used_quantity';
    
$itemstatus[]=$magazzino[$x]['type']=='n'?(int)$itemResults[$x]['quantity']-(int)$products_array[$i]['new_qty']:(int)$itemResults[$x]['quantity']-(int)$products_array[$i]['used_qty'];

echo '<br>'.$magazzino[$x]['model'].'=='.$products_array[$i]['model'];

tep_sync_warhouses($fieldtype[$x],$magazzino[$x]['model'],$itemstatus[$x]);

$aggiorna = tep_ReviseItemRequest($ebaysede[$x]['token'],$magazzino[$x]['model'],$itemstatus[$x]);

$ReviseItemXml=talk_to_ebay($ebaysede[$x]['devID'],$ebaysede[$x]['appID'],$ebaysede[$x]['certID'],'ReviseItem',$aggiorna,$ebaysede[$x]['type'],'101','819');

tep_ReviseItemResponse($ReviseItemXml);

if($itemResults[$x]['quantity']=='1'){

$chiudi = tep_EndFixedPriceItemRequest($ebaysede[$x]['token'],$magazzino[$x]['model']);

$EndFixedPriceItemXml=talk_to_ebay($ebaysede[$x]['devID'],$ebaysede[$x]['appID'],$ebaysede[$x]['certID'],'EndFixedPriceItem',$chiudi,$ebaysede[$x]['type'],'101','819');

tep_EndFixedPriceItemResponse($EndFixedPriceItemXml);

}
}
}
}
/// Marco 21/05/2013 - funzione di aggiornamento quantità su ebay  

?>