<?php
require('configure.php');
require('database_table.php');
require('functions/database.php');
 
tep_db_connect();

$amazon_sql="SELECT * FROM products";

$amazon_query=tep_db_query($amazon_sql);

require('simple_html_dom.php');
require('functions/curl.php');

while($amazon_products_data=tep_db_fetch_array($amazon_query)){

if($amazon_products_data['products_model']){

$nomedominio = 'www.amazon.it';
$path = '/s/ref=nb_sb_noss?field-keywords=';

//$nomedominio = 'www.deastore.com';
//$path='/search/products/usr/keywords/';
$barcode = $amazon_products_data['products_model']; //'0888430119123';

$stampa = get_data($nomedominio,$path,$barcode);

$html_resp = str_get_html($stampa);

preg_match_all('<a href="(.*?)'.$barcode.'">',$stampa, $risultato);

//preg_match_all("<a href=\"(.*?)\" class=\"titolo_link\">",$stampa, $risultato);

//echo $risultato[1][0].$barcode;

$nuovo = $risultato[1][0].$barcode;

$resp = get_data2($nuovo);

//print_r($resp);

$html= str_get_html($resp);


preg_match_all("/&amp;search-alias=(.*?)\"/",$resp, $alias);


switch($alias[1][0]){

case 'popular':

$field_search='field-artist';
$field_ref='&amp;';

break;
case 'dvd':

$field_search='field-keywords';
$field_ref='&amp;ref=dp_dvd_bl_act&amp;';

break;
case 'stripbooks':

$field_search='field-author';
$field_ref='&amp;';

break;
    
}

preg_match_all("/".$field_search."=(.*?)".$field_ref."search-alias=".$alias[1][0]."/",$resp, $data);

//var_dump($data);

$author='';

for($res=0;$res<count($data);$res++){
    
$author.=$data[1][$res].'-';    

}

$article=array('title'=> $html->find('h1.parseasinTitle span#btAsinTitle span', 0)->plaintext,
'author'=> urldecode($author),
'details'=> array($html->find('td.bucket ul li', 0)->plaintext,$html->find('td.bucket ul li', 1)->plaintext,$html->find('td.bucket ul li', 2)->plaintext,$html->find('td.bucket ul li', 3)->plaintext,$html->find('td.bucket ul li', 4)->plaintext,$html->find('td.bucket ul li', 5)->plaintext,$html->find('td.bucket ul li', 6)->plaintext,$html->find('td.bucket ul li', 7)->plaintext),
'isbn'=> 'EAN: '.$barcode,
'description'=>$html->find('div.productDescriptionWrapper', 0)->plaintext);

$desc='';

$desc.= 'Titolo: '. $article['title'].'</br>\n';
$desc.= 'Artista: '. $article['author'].'</br>\n';

for($i=0;$i<7;$i++){
$desc.=$article['details'][$i].'</br>\n';
}
$desc.=$article['isbn'].'</br>\n';
$desc.=$article['description'];

echo $desc;


}

}	
?>