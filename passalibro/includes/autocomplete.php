<?php

error_reporting(0);

$return_arr=array();

$nome=$_GET['term'];

/* Connecting, selecting database */
$db_link = mysql_connect("localhost", "passalibroweb", "passa20libro12");
if (!$db_link) {
   die("Could not connect: " . mysql_error());
}
mysql_select_db("passalibroweb") or die("Could not select database");

/* Performing SQL query */


$sql='SELECT * FROM products JOIN products_description USING(products_id) where products_name like "'.mysql_real_escape_string($nome).'%" order by products_name limit 10';
$fetch=mysql_query($sql);
while($row=mysql_fetch_array($fetch, MYSQL_ASSOC)){
    
$row_array['value']=$row['nome'];
$row_array['id']=$row['sigla'];

array_push($return_arr,$row_array);

}

echo json_encode($return_arr);

?>

 limit 100