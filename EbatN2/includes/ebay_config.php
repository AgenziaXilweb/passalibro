<?php

function tep_get_token($type=null,$sede=null){
if($type==null){

echo 'Connessione con eBay non attiva.<br>';
    
} else {

$sql = tep_db_query("SELECT customers_id,
       sede,
       cod_chiave,
       piattaforma,
       type,
       paypal,
       storename,
       username,
       password,
       devID,
       appID,
       certID,
       tokenID,
       sessionID,
       cap,
       merchantID
  FROM passalibroweb.account_external
 WHERE sede = ".$sede." AND piattaforma = 'ebay' AND type = '".$type."';");
  
$result = tep_db_fetch_array($sql);    

// API request variables

return array('sede' => $result['sede'],
'type'=>$result['type'],
'cod_chiave'=> $result['cod_chiave'],
'customers_id'=> $result['customers_id'],
'userid' => $result['username'],
'paypal' => $result['paypal'],
'devname' => $result['devID'],
'appname' => $result['appID'],
'certname' => $result['certID'],
'token' => $result['tokenID'],
'cap' => $result['cap'],
'siteid' => '101');
}
}

/// ultima data d'inserimento da ebay

function tep_last_startdate($sede=null){
    
$sql = tep_db_query("SELECT products_date_added
  FROM passalibroweb.products 
  WHERE products_ebay = TRUE 
  AND products_sede = ".$sede." 
  ORDER BY products_date_added DESC LIMIT 1");    

    
$result = tep_db_fetch_array($sql);

return $result['products_date_added'];    
       
}

?>