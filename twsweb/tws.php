<?php

$sql ="SELECT sedi.sede,
       orders.date_purchased,
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
       orders.delivery_country
  FROM orders
       JOIN orders_products USING (orders_id)
       JOIN passalibro.sedi sedi USING (sede)
 WHERE     DATE(orders.date_purchased) = DATE(NOW()) - 1
       AND orders.sede = ".$get_sede."
       AND orders.printed = 0
GROUP BY orders.orders_id";

while($result=tep_db_fetch_array($query)){

list($cap,$provincia,$stato,$id_stato,$id_contratto) = explode('|',$result['parametri']);

$orders_id = !$result['amazonOrdersId'] ? $result['orders_id'] : $result['amazonOrdersId'];

echo '"'.$orders_id.'","'.
$result['ragsoc_sede'].'","'.
$result['desc_sede'].'VOLARE SRL","'.
$result['indirizzo_sede'].'VIA ROVANI 242","'.
$result['citta'].'SESTO SAN GIOVANNI","'.
$cap.'","'.
$provincia.'","'.
$stato.'","'.
$id_stato.'","'.
$id_contratto,'","'.
$result['delivery_name'].$result['delivery_company'].'","'.
$result['buyer-phone-number'].'","'.
$result['delivery_street_address'].'","'.
$result['delivery_city'].'","'.
$result['PV'].'","'.
$result['CAP'].'","'.
$result['orders.delivery_country'].'","'.
$result['date_purchased'].'","'.
'1","'.
$result['colli'].'","'.
$result['value'].'"'.PHP_EOL;



}
	
?>