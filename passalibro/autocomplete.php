<?php

error_reporting(0);

$return_arr=array();

$nome=$_GET['term'];

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