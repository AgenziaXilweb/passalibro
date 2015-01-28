<?php
for($day=1;$day<=7;$day++){
$sql = "SELECT sedi.sede,
       orders.date_purchased,
       orders_products.products_ebay,
       sedi.desc_sede,
       sedi.ragsoc_sede,
       sedi.indirizzo_sede,
       sedi.citta,
       CASE sedi.sede
          WHEN 1 THEN '21052|VA|ITALIA|IT|PASSA3'
          WHEN 2 THEN '20090|MI|ITALIA|IT|PASSA1'
          WHEN 3 THEN '20132|MI|ITALIA|IT|PASSA2'
          ELSE ''
       END
          AS parametri,
       (SELECT amazonOrdersId
          FROM amazon_orders_to_orders
         WHERE amazon_orders_to_orders.orders_id = orders.orders_id
         LIMIT 1)
          AS amazonOrdersId,
       (SELECT orders_id
          FROM orders sub
         WHERE sub.orders_id = orders.orders_id
         LIMIT 1)
          AS orders_id,
       (SELECT ItemID
          FROM ebay_to_products_sede".$get_sede."
         WHERE products_id = orders_products.products_id
         LIMIT 1)
          AS ItemID,
       (SELECT value
          FROM orders_total
         WHERE orders_id = orders.orders_id 
         AND sort_order = 4 LIMIT 1)
          AS value,
       orders.delivery_name,
       orders.delivery_company,
       orders.delivery_street_address,
       orders.delivery_city,
       orders.customers_telephone,
       (SELECT lista_comuni.Provincia
          FROM lista_comuni
         WHERE    lista_comuni.CAP =
                     REPLACE(LPAD(orders.delivery_postcode, 5, '0'),
                             'xx',
                             '00')
               OR lista_comuni.Comune LIKE orders.delivery_city
         LIMIT 1)
          AS PV,
       REPLACE(LPAD(orders.delivery_postcode, 5, '0'), 'xx', '00') AS CAP,
       orders.delivery_country,
       '1' AS colli,
       (SELECT if(products_weight=0,1,sum(products_weight) / 1000) AS products_weight
          FROM products
         WHERE products.products_id = orders_products.products_id)
          AS peso
  FROM orders
       JOIN orders_products USING (orders_id)
       JOIN passalibro.sedi sedi USING (sede)
 WHERE     DATE(orders.date_purchased) = DATE(NOW())-".(int)$day."
       AND orders.sede = ".$get_sede."
       AND orders.printed = 0
GROUP BY orders.orders_id";

$query = tep_db_query($sql);

if(tep_db_num_rows($query) > 0){

$content = '';
while($result=tep_db_fetch_array($query)){
    
list($cap,$provincia,$stato,$stato_id,$contratto_id)=explode("|",$result['parametri']);

$orders_id = !$result['amazonOrdersId'] ? $result['products_ebay'] == (int)'1' ? 'E-'.$result['ItemID'] : 'W-'.$result['orders_id'] : $result['amazonOrdersId'];  
    
$content .= '"'.$orders_id.'","'.
$result['desc_sede'].'","'.
$result['ragsoc_sede'].'","'.
str_replace('/','-',$result['indirizzo_sede']).'","'.
$result['citta'].'","'.
$cap.'","'.
$provincia.'","'.
$stato.'","'.
$stato_id.'","'.
$contratto_id.'","'.
$result['orders_id'].'","'.
$result['delivery_name'].'","'.
$result['customers_telephone'].'","'.
$result['delivery_street_address'].'","'.
$result['delivery_city'].'","'.
$result['CAP'].'","'.
$result['PV'].'","'.
$result['peso'].'","'.
$result['date_purchased'].'","'.
$result['value'].'"'.PHP_EOL;

$sede = (int)$result['sede'];

$aggiornamenti = array('printed'=>(int)'1',
'last_modified'=>'now()');

tep_db_perform(TABLE_ORDERS,$aggiornamenti,'update','orders_id = '.$result['orders_id']);    

}

$elabfile = "data-csv-".date("Y-m-d_H-i-s").".txt";

switch($sede){

case 1:

$fp = fopen("../sdaweb/busto/".$elabfile,"x+");
fwrite($fp,$content);
fclose($fp);

break;
case 2:

$fp = fopen("../sdaweb/sesto/".$elabfile,"x+");
fwrite($fp,$content);
fclose($fp);

break;
case 3:

$fp = fopen("../sdaweb/milano/".$elabfile,"x+");
fwrite($fp,$content);
fclose($fp);

break;
    
}

}
}
?>