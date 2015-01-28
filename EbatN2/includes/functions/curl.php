<?php
	
/* gets the data from a URL */
function get_data($url='',$search='',$keywords='') {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, "http://".$url."".$search."".$keywords);
    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
    curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

function get_data2($url='') {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
    curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}    

    
?>