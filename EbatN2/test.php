<?php

reset($products_data);

for($i=0;$i<=count($products_data);$i++){

while(list($columns, $values) = each($products_data[$i])){

$column[] = $columns." ";
$value[] = $values."<br>";
    
}

echo $column[$i],$value[$i];
    
}

?>