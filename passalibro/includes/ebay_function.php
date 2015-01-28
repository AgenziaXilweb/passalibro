<?php

// funzioni personalizzate ebay Marco 22/04/2013
// Chimata standard
function talk_to_ebay($devid, $appid, $certid, $callname, $xml, $mode="sandbox", $siteid="101", $version="819"){


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

function tep_create_table_ebay_categoriesstore(){

$sql="CREATE TABLE `ebay_categoriesstore` (
  `sede` int(1) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `ebay_categoriesstore_id` int(11) NOT NULL,
  `ebay_categoriesstore_name` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  PRIMARY KEY (`category_id`,`ebay_categoriesstore_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";    
    
    
}

?>