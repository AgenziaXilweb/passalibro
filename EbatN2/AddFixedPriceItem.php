<?php

$xml_GeteBayOfficialTime = tep_GeteBayOfficialTimeRequest($param['token']);
$req_GeteBayOfficialTime = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'GeteBayOfficialTime',$xml_GeteBayOfficialTime,$param['type'],'101','819');
$res_GeteBayOfficialTime = tep_GeteBayOfficialTimeResponse($req_GeteBayOfficialTime);

for($i=0;$i<count($products_data);$i++){

// echo count($products_data).PHP_EOL;

$SKU = $products_data[$i]['cod_chiave'].'S'.$param['sede'].'T'.$products_data[$i]['type'];

$sql_insert_new_ebay = "INSERT INTO ".TABLE_EBAY_PRODUCTS.$param['sede']." (
cod_chiave, 
products_id, 
type, 
quantity, 
isbn13, 
categoria_ebay, 
sede, 
stato_uso, 
condizione_ebay, 
prezzo, 
ubicazione, 
proposta, 
ItemID, 
pubblicato_ebay,
start_date, 
autopay,
SKU)
SELECT * FROM (SELECT ".$products_data[$i]['cod_chiave']." as cod_chiave
,".$products_data[$i]['products_id']." as products_id
,'".$products_data[$i]['type']."' as type
,".$products_data[$i]['quantity']." as quantity
,'".$products_data[$i]['isbn13']."' as isbn13
,".$products_data[$i]['categoria_ebay']." as categoria_ebay
,".$products_data[$i]['sede']." as sede
,'".str_replace("'","\'",$products_data[$i]['stato_uso'])."' as stato_uso
,'".$products_data[$i]['condizione_ebay']."' as condizione_ebay
,".$products_data[$i]['prezzo']." as prezzo
,'".str_replace("*","",$products_data[$i]['ubicazione'])."' as ubicazione
,".$products_data[$i]['proposta']." as proposta
,'".$products_data[$i]['ItemID']."' as ItemID
,".$products_data[$i]['pubblicato_ebay']." as pubblicato_ebay
,'".$res_GeteBayOfficialTime."' as start_date
,".$products_data[$i]['autopay']." as autopay
,'".$products_data[$i]['SKU']."' as SKU) AS temp WHERE NOT EXISTS (SELECT SKU FROM ebay_to_products_sede".$param['sede']." WHERE SKU = '".$SKU."') LIMIT 1;";

$query_insert_new_ebay = tep_db_query($sql_insert_new_ebay);

$insert_id = tep_db_insert_id();

if($insert_id == 0){

echo 'Nessun nuovo inserimento!!';    
    
}else{
    
// seleziono il tipo di spedizione per la sede



// lancio il feed per aggiungere il prodotto su eBay

$products_request_array = array('cod_chiave'=>$products_data[$i]['cod_chiave'],
       'isbn13'=>$products_data[$i]['isbn13'],
       'autore1'=>utf8_decode($products_data[$i]['autore1']),
       'titolo'=>utf8_decode($products_data[$i]['titolo'].' - '.$products_data[$i]['autore1'].' ['.$products_data[$i]['isbn13'].']'),
       'stato_uso'=>$products_data[$i]['type'] == 'n' ? utf8_decode('Nuovo') : utf8_decode($products_data[$i]['stato_uso']),
       'anno_edizione'=>$products_data[$i]['anno_edizione'],
       'categoria_ebay'=>$products_data[$i]['categoria_ebay'],
       'ubicazione'=>utf8_decode($products_data[$i]['ubicazione']),
       'editore'=>$products_data[$i]['editore'],
       'descrizione_estesa'=>utf8_decode($products_data[$i]['descrizione_estesa']),
       'condizione_ebay'=>$products_data[$i]['condizione_ebay'],
       'prezzo'=>$products_data[$i]['prezzo'],
       'SKU'=>$products_data[$i]['SKU'],
       'proposta'=>$products_data[$i]['proposta'] > 0 ?'true':'false',
       'quantity'=>$products_data[$i]['quantity'],
       'type'=>$products_data[$i]['type'],
       'paypal'=>$param['paypal'],
       'autopay'=>$products_data[$i]['autopay'],
       'cap'=>$param['cap']);

$xml_AddFixedPriceItem = tep_AddFixedPriceItemRequest($param['token'],$products_request_array,'GTC');
$req_AddFixedPriceItem = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'AddFixedPriceItem',$xml_AddFixedPriceItem,$param['type'],'101','819');
$res_AddFixedPriceItem = tep_AddFixedPriceItemResponse($req_AddFixedPriceItem); 

var_dump($req_AddFixedPriceItem);

// Aggiorno il campo ItemID della tabella ebay_to_products su database passalibroweb, allineandolo il campo ItemID ricevuto dal feed

// Creo un array con i campi da aggiornare che mi servono

$xml_data_response = array('ItemID'=>$res_AddFixedPriceItem['ItemID'],
'start_date'=>$res_AddFixedPriceItem['StartTime'],
'end_date'=>$res_AddFixedPriceItem['EndTime'],
'ShortMessage'=>$res_AddFixedPriceItem['ShortMessage'],
'LongMessage'=>$res_AddFixedPriceItem['LongMessage'],
'esito'=>$res_AddFixedPriceItem['Ack']);

// Creo una query di aggiornamento dei campi su database passalibroweb

$query_update_ItemID_ep = tep_db_perform(TABLE_EBAY_PRODUCTS.$param['sede'],$xml_data_response,'update','new_item_id = '.$insert_id);

// Seleziono le risposte salvate e aggiorno la tabella catalogo_sedi del database passalibro

$sql_select_ItemID_ep="SELECT type,ItemID FROM ".TABLE_EBAY_PRODUCTS.$param['sede']." WHERE cod_chiave = ".$products_data[$i]['cod_chiave']." AND sede = ".$param['sede']." AND type = '".$products_data[$i]['type']."';";

$query_select_ItemID_ep = tep_db_query($sql_select_ItemID_ep);

$resItemID = tep_db_fetch_array($query_select_ItemID_ep);

$type_update_field = $resItemID['type'] == 'u'?'itemid_u_ebay':'itemid_n_ebay';

$sql_data_response = array($type_update_field=>$res_AddFixedPriceItem['ItemID']);

if($res_AddFixedPriceItem['Ack'] == "Success" || $res_AddFixedPriceItem['Ack'] == "Warning"){

$query_update_ItemID_cs = tep_db_perform(CATALOGO_SEDI,$sql_data_response,'update','cod_chiave = '.$products_data[$i]['cod_chiave'].' AND sede = '.$param['sede']);
    
} else {
    
}

echo 'Risposta da eBay: '.$res_AddFixedPriceItem['Ack']; 

}

}


?>