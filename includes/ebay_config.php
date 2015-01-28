<?php

function tep_get_token($type=null,$sede=null){
if($type==null){

echo 'Connessione con eBay non attiva.<br>';
    
} else {

$sql = mysql_query("SELECT customers_id,
       sede,
       cod_chiave,
       piattaforma,
       type,
       storename,
       username,
       password,
       devID,
       appID,
       certID,
       tokenID,
       sessionID,
       merchantID
  FROM passalibroweb.account_external
 WHERE sede = ".$sede." AND piattaforma = 'ebay' AND type = '".$type."';");
  
$result = mysql_fetch_array($sql);    

// API request variables

return array('sede' => $result['sede'],
'type'=>$result['type'],
'cod_chiave'=> $result['cod_chiave'],
'userid' => $result['username'],
'devname' => $result['devID'],
'appname' => $result['appID'],
'certname' => $result['certID'],
'token' => $result['tokenID'],
'siteid' => '101');
}
}

/// ultima data d'inserimento da ebay

function tep_last_startdate($sede=null){
    
$sql = mysql_query("SELECT products_date_added
  FROM passalibroweb.products 
  WHERE products_ebay = TRUE 
  AND products_sede = ".$sede." 
  ORDER BY products_date_added DESC LIMIT 1");    

    
$result = mysql_fetch_array($sql);

return $result['products_date_added'];    
       
}

?>