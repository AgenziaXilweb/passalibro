<?php

$sql_update = "SELECT * FROM ".TABLE_EBAY_PRODUCTS.$param['sede']." WHERE date(end_date)<date(now()) AND close_date IS NULL AND quantity >0 AND ripubblica = 0 LIMIT 5";
$query_update = tep_db_query($sql_update);

while($results_update = tep_db_fetch_array($query_update)){

//var_dump($results_update);

tep_db_perform(TABLE_EBAY_PRODUCTS.$param['sede'],array('ripubblica'=> 1),'update','SKU = \''.$results_update['SKU'].'\'');



}

$sql = "SELECT * FROM ".TABLE_EBAY_PRODUCTS.$param['sede']." WHERE ripubblica = 1 LIMIT 5";
$query = tep_db_query($sql);

while($results = tep_db_fetch_array($query)){

// Lancio e mando la richiesta del FEED in XML

$xml_RelistItem = tep_RelistItemRequest($param['token'],$results['ItemID']);
$req_RelistItem = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'RelistItem',$xml_RelistItem,$param['type'],'101','819');
$res_RelistItem = tep_RelistItemResponse($req_RelistItem);

//var_dump($res_RelistItem);


$relist_data_array = array(
'ItemID'=>!$res_RelistItem['ItemID']?$results['ItemID']:$res_RelistItem['ItemID'],
'RelistItemID'=>$res_RelistItem['ItemID']?$results['ItemID']:$results['RelistItemID'],
'ShortMessage' => $res_RelistItem['ShortMessage'],
'LongMessage' => $res_RelistItem['LongMessage'],
'start_date'=>!$res_RelistItem['StartTime']?date("Y-m-d"):$res_RelistItem['StartTime'],
'end_date'=>!$res_RelistItem['EndTime']?date('Y-m-d', strtotime("+30 days")):$res_RelistItem['EndTime'],
'ripubblica'=>$res_RelistItem['Ack']=='Failure'?9:0,
'esito'=>!$res_RelistItem['Ack']?$results['esito']:$res_RelistItem['Ack']);

tep_db_perform(TABLE_EBAY_PRODUCTS.$param['sede'],$relist_data_array,'update','SKU = \''.$results['SKU'].'\'');  

$sql_data_response = $results['type'] == 'u'? 'itemid_u_ebay' : 'itemid_n_ebay';

tep_db_perform(CATALOGO_SEDI,array($sql_data_response => !$res_RelistItem['ItemID']?$results['ItemID']:$res_RelistItem['ItemID']),'update','cod_chiave = '.$results['cod_chiave'].' AND sede = '.$param['sede']);    

}
?>