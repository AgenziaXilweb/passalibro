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

if(isset($amazon_products_data['products_model'])){

$nomedominio = 'www.amazon.it';
$path = '/s/ref=nb_sb_noss?field-keywords=';

$barcode = $amazon_products_data['products_model']; //'0888430119123';

$stampa = get_data($nomedominio,$path,$barcode);

$html_resp = str_get_html($stampa);

preg_match_all('<a href="(.*?)'.$barcode.'">',$stampa, $risultato);

$nuovo = $risultato[1][0].$barcode;

$resp = get_data2($nuovo);

$html= str_get_html($resp);

preg_match_all('/"large":"(.*?)"/',$resp,$image);

$path_local=DIR_FS_CATALOG.'images/ISBN/';  //cartella dove mettere immagini

if(file_exists($path_local.$amazon_products_data['products_model'].'.jpg')){

return false;

}else{
    
set_time_limit(300);
//Percorso file remoto
$remotefile=$image[1][0];
//Cartella locale in cui copiare il file
//$cartella=DIR_FS_CATALOG.'images/ISBN/EBAY/';  //cartella dove mettere immagini
//apro il file remoto da leggere

$srcfile = fopen($remotefile, "r");
//prelevo il nome del file
$nomefile=$amazon_products_data['products_model'].'.jpg';
//apro il file in locale
//$fp = fopen($nomefile,"a");
if (!($fp = fopen("../ISBN/".$nomefile,"x+")));
//scrivo contenuto del file remoto, ora in temp file, in file locale
while ($contents = fread($srcfile, 8192)) {
fwrite($fp, $contents, strlen($contents));
}
//chiudo i due files
fclose($srcfile);
fclose($fp);

}

}

}	
?>