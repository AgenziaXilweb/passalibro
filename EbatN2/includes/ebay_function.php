<?php

// funzioni personalizzate ebay Marco 22/04/2013

// Chimata standard

function talk_to_ebay($devid, $appid, $certid, $callname, $xml, $mode="", $siteid="101", $version="819"){

switch($mode){

case "sandbox": $ch = curl_init("https://api.sandbox.ebay.com/ws/api.dll");
break;
case "production": $ch = curl_init("https://api.ebay.com/ws/api.dll");
break;   
    
}


	$headers =	array('X-EBAY-API-COMPATIBILITY-LEVEL:'.$version,
					  'X-EBAY-API-DEV-NAME:'.$devid,
					  'X-EBAY-API-APP-NAME:'.$appid,
					  'X-EBAY-API-CERT-NAME:'.$certid,
					  'X-EBAY-API-CALL-NAME:'.$callname,
					  'X-EBAY-API-SITEID:'.$siteid);

	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml); // don't forget to add auth token in XML message.
        
	$output = curl_exec($ch);
	curl_close($ch);

	return simplexml_load_string($output);

}

function tep_warhouses($itemID=null){
    
$sql=tep_db_query("SELECT *
  FROM ebay_to_products
 WHERE itemID = '".$itemID."'");
 
while($results=tep_db_fetch_array($sql)){

return array('sede'=>$results['sede'],
'quantita'=>$results['quantity'],
'products_id'=>$results['products_id'],
'model'=>$results['itemID'],
'type'=>$results['type']);      

}      
}

function tep_sync_warhouses($type_fields_qty='',$ebayID='',$ebay_qty=''){
 
tep_db_query("UPDATE ebay_to_products
   SET quantity = ".$ebay_qty."
    WHERE itemID = ".$ebayID);

tep_db_query("UPDATE products
   SET ".$type_fields_qty." = ".$ebay_qty."
    WHERE products_model = ".$ebayID);
    

}

function tep_downloadFile ($url, $path) {

  $newfname = $path;
  $file = fopen ($url, "rb");
  if ($file) {
    $newf = fopen ($newfname, "wb");

    if ($newf)
    while(!feof($file)) {
      fwrite($newf, fread($file, 1024 * 8 ), 1024 * 8 );
    }
  }

  if ($file) {
    fclose($file);
  }

  if ($newf) {
    fclose($newf);
  }
 }
 
function download_remote_file($file_url, $save_to)
	{
		$content = file_get_contents($file_url);
		file_put_contents($save_to, $content);
	}

?>