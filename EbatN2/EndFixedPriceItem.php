<?php

for($i=0;$i<count($products_data_passive);$i++){

$sql="SELECT new_item_id,
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
       ebay_categoriesstore_id,
       start_date,
       end_date,
       autopay,
       prima_edizione,
       SKU,
       esito,
       ShortMessage,
       LongMessage,
       venduti,
       chiusura,
       RelistItemID
  FROM ".TABLE_EBAY_PRODUCTS.$param['sede']." 
  WHERE ItemID = '".$products_data_passive[$i]['ItemID']."' AND chiusura = 0;";

var_dump($products_data_passive[$i]);

$query=tep_db_query($sql);

while($results=tep_db_fetch_array($query)){

    $results_data_array = array('chiusura'=>(int)'1',
       'venduti'=>(int)$results['quantity'],
       'close_date'=>date("d-m-Y H:i:s"),
       'quantity'=>(int)$products_data_passive[$i]['quantity']);

    $xml_EndFixedPriceItem = tep_EndFixedPriceItemRequest($param['token'],$results['ItemID']);
    $req_EndFixedPriceItem = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'EndFixedPriceItem',$xml_EndFixedPriceItem,$param['type'],'101','819');
    $res_EndFixedPriceItem = tep_EndFixedPriceItemResponse($req_EndFixedPriceItem);
    
//var_dump($xml_EndFixedPriceItem);

tep_db_perform(TABLE_EBAY_PRODUCTS.$param['sede'],$results_data_array,'update','ItemID = '.$products_data_passive[$i]['ItemID']);

    }
}
echo $sql;
?>