<?php

// Setto un range di date per la richiesta

$date = date('Y-m-d');
$backdate = strtotime('-10 days',strtotime($date));
$backdate = date('Y-m-d',$backdate);

// Creo un array da passare alla richiesta XML NumberOfDays
// Completed = Pagato
// All = Tutti
$orders_data_array = array('CreateTimeFrom'=>$backdate,
'CreateTimeTo'=>$date,
'NumberOfDays'=>'1',
'OrderRole'=>'Seller',
'OrderStatus'=>'Completed',
'DetailLevel'=>'ReturnAll');

// Lancio e mando la richiesta del FEED in XML

$xml_GetOrders = tep_GetOrdersRequest($param['token'],$orders_data_array);
$req_GetOrders = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'GetOrders',$xml_GetOrders,$param['type'],'101','819');
$res_GetOrders = tep_GetOrdersResponse($req_GetOrders);

// Ciclo il risultato contando i record restituiti da eBay e scrivo in tabella ORDINI EBAY

for($i=0;$i<count($res_GetOrders);$i++){

// Stampo i risultati di prova per visualizzarli
// Creo la sessione da passare alla tabella passalibroweb.
// orders per creare poi il carrello nella tabella passalibro.tmpweb2

$len_Suffix = strlen('eBay_0000000000000000000000000');
$len_TransactionID = strlen($res_GetOrders[$i]['TransactionID']);
$start = $len_Suffix - $len_TransactionID;
$SessionID = substr_replace('eBay_0000000000000000000000000',$res_GetOrders[$i]['TransactionID'],$start,$len_TransactionID);

// Converto la stringa delle date in formato datatime per mysql 

$LastModifiedDate = strtotime($res_GetOrders[$i]['LastModifiedTime']);
$DateCreateTime = strtotime($res_GetOrders[$i]['CreatedDate']);
$PaidTime = strtotime($res_GetOrders[$i]['PaidTime']);

// Creo un array per salvare i dati nella tabella ebay_to_orders_sedeID (ID numero della sede in uso)
  
$ebay_data_array = array('ItemID'=>(int)$res_GetOrders[$i]['ItemID'],
'customers_id'=>(int)$param['customers_id'],
'customers_name'=> $res_GetOrders[$i]['Name'],
'customers_company'=>'',
'customers_street_address'=>$res_GetOrders[$i]['Street1'],
'customers_suburb'=> '',
'customers_city'=> $res_GetOrders[$i]['CityName'],
'customers_postcode'=> $res_GetOrders[$i]['PostalCode'],
'customers_state'=> $res_GetOrders[$i]['StateOrProvince'],
'customers_country'=> $res_GetOrders[$i]['Country'],
'customers_telephone'=> $res_GetOrders[$i]['Phone'],
'customers_email_address'=> $res_GetOrders[$i]['Email'],
'customers_address_format_id'=> (int)'2',
'payment_method'=>'eBay '.$res_GetOrders[$i]['PaymentMethod'],
'last_modified'=>date('Y-m-d H:i:s',$LastModifiedDate),
'date_purchased'=>date('Y-m-d H:i:s',$DateCreateTime),
'orders_status'=>$res_GetOrders[$i]['OrderStatus']== "Complete"?(int)'1':(int)'0',
'orders_date_finished'=>date('Y-m-d H:i:s',$PaidTime),
'currency'=>'EUR',
'currency_value'=>(int)'1',
'sede'=>$param['sede'],
'session_id'=>$SessionID,
'customer_service_id'=>(int)$param['sede'],
'ebayOrdersId'=>$res_GetOrders[$i]['OrderID']);

// Creo una query SELECT per evitare di duplicare eventuali ordini gia scaricati

$sql_insert = "Select ItemID From ".TABLE_EBAY_ORDERS.$param['sede']." Where ItemID = '".$res_GetOrders[$i]['ItemID']."'";
$query_insert = tep_db_query($sql_insert);
$result_insert = tep_db_fetch_array($query_insert);

// Dichiaro una condizione di controllo per non reinserire gli ordini come precedente.

if($result_insert['ItemID']!=(int)$res_GetOrders[$i]['ItemID']){

tep_db_perform(TABLE_EBAY_ORDERS.$param['sede'], $ebay_data_array);

$sql_impegno = "SELECT ep.sede,
       m.cod_chiave as chiave,
       ep.products_id,
       ep.ItemID,
       ep.quantity,
       ep.type,
       ep.venduti,
       m.impegnato_web_n,
       m.impegnato_web_u       
From ".TABLE_EBAY_PRODUCTS.$param['sede']." ep 
JOIN ".MAGAZZINO_SEDI." m USING (cod_chiave, sede) 
WHERE ep.ItemID = '".$res_GetOrders[$i]['ItemID']."'";

$query_impegno = tep_db_query($sql_impegno);
$result_impegno = tep_db_fetch_array($query_impegno);
$valore_impegnato_web_n = (int)$result_impegno['impegnato_web_n'] + (int)$res_GetOrders[$i]['QuantityPurchased'];
$valore_impegnato_web_u = (int)$result_impegno['impegnato_web_u'] + (int)$res_GetOrders[$i]['QuantityPurchased'];
$campo_impegnato_web = $result_impegno['type'] == 'u'? 'impegnato_web_u':'impegnato_web_n';

$valore_impegnato_web = $result_impegno['type'] == 'u'? $valore_impegnato_web_u : $valore_impegnato_web_n;

$sql_impegno_array = array($campo_impegnato_web => $valore_impegnato_web);

$vendite = (int)$result_impegno['venduti'] + (int)$res_GetOrders[$i]['QuantityPurchased'];
$quantity = $result_impegno['quantity'] == 0 ? (int)'0' : (int)$result_impegno['quantity'] - (int)$result_impegno['venduti'];

if((int)$result_impegno['quantity'] > (int)$result_impegno['venduti']){

tep_db_perform(TABLE_EBAY_PRODUCTS.$param['sede'],array('venduti'=>$vendite, 'quantity' => $quantity),'update','ItemID = '.(int)$res_GetOrders[$i]['ItemID']);

tep_db_perform(MAGAZZINO_SEDI,$sql_impegno_array,'update','sede = '.$param['sede'].' AND cod_chiave = '.(int)$result_impegno['chiave']);

}

$sql_products_data = "SELECT p.products_id,
       pd.products_name,
       p.products_model,
       p.products_used_quantity
  FROM ".TABLE_PRODUCTS." p 
  JOIN ".TABLE_PRODUCTS_DESCRIPTION." pd using(products_id)
  JOIN ".TABLE_EBAY_PRODUCTS.$param['sede']." ep using(products_id) 
  WHERE ep.ItemID = '".$res_GetOrders[$i]['ItemID']."'";

$query_products_data = tep_db_query($sql_products_data);

$result_products_data = tep_db_fetch_array($query_products_data);

$result_num_row = tep_db_num_rows($query_products_data);

var_dump($result_num_row);

if($result_num_row > 0){

echo 'PASSATO';

$sql_data_array = array('customers_id' =>(int)$param['customers_id'],
                          'customers_name' => $res_GetOrders[$i]['Name'],
                          'customers_street_address' => $res_GetOrders[$i]['Street1'],
                          'customers_city' => $res_GetOrders[$i]['CityName'],
                          'customers_postcode' => $res_GetOrders[$i]['PostalCode'],
                          'customers_state' => $res_GetOrders[$i]['StateOrProvince'],
                          'customers_country' => $res_GetOrders[$i]['Country'],
                          'customers_telephone' => $res_GetOrders[$i]['Phone'],
                          'customers_email_address' => $res_GetOrders[$i]['Email'],
                          'customers_address_format_id' => (int)'2', 
                          'delivery_name' => $res_GetOrders[$i]['Name'],
                          'delivery_street_address' => $res_GetOrders[$i]['Street1'],
                          'delivery_city' => $res_GetOrders[$i]['CityName'],
                          'delivery_postcode' => $res_GetOrders[$i]['PostalCode'],
                          'delivery_state' => $res_GetOrders[$i]['StateOrProvince'],
                          'delivery_country' => $res_GetOrders[$i]['Country'],
                          'delivery_address_format_id' => (int)'2', 
                          'billing_name' => $res_GetOrders[$i]['Name'],
                          'billing_company' => '',
                          'billing_street_address' => $res_GetOrders[$i]['Street1'],
                          'billing_suburb' => '', 
                          'billing_city' => $res_GetOrders[$i]['CityName'],
                          'billing_postcode' => $res_GetOrders[$i]['PostalCode'],
                          'billing_state' => $res_GetOrders[$i]['StateOrProvince'],
                          'billing_country' => $res_GetOrders[$i]['Country'],
                          'billing_address_format_id' => (int)'2', 
                          'payment_method' => 'eBay '.$res_GetOrders[$i]['PaymentMethod'],
                          'date_purchased' => 'now()', 
                          'orders_status' => (int)'1', 
                          'currency' => 'EUR', 
                          'currency_value' => (int)'1',
                          'sede' => $param['sede'],
                          'session_id'=>$SessionID);



var_dump($sql_data_array);
                          
tep_db_perform(TABLE_ORDERS, $sql_data_array);
 
$insert_id = tep_db_insert_id();
 
tep_db_query("INSERT INTO ".TABLE_ORDERS_TOTAL."
(orders_id, title, text , value, class, sort_order) 
VALUES 
(".$insert_id.", 'Sub-Totale:', '".$res_GetOrders[$i]['Subtotal']."', ".$res_GetOrders[$i]['Subtotal'].", 'ot_subtotal', 1),
(".$insert_id.", 'eBay ".$res_GetOrders[$i]['PaymentMethod']."', '0', 0 , 'ot_shipping', 2),
(".$insert_id.", 'Totale:', '<strong>".$res_GetOrders[$i]['Subtotal']."</strong>', ".$res_GetOrders[$i]['Subtotal'].", 'ot_total', 4)");

var_dump($result_products_data);

$sede_impegno = $result_impegno['type'] == 'u'? 'sede_impegno_u':'sede_impegno_n';

$array_result = array('orders_id'=>$insert_id,
                    'products_id' => (int)$result_products_data['products_id'],
                    'products_name' => utf8_decode($result_products_data['products_name']),
                    'products_model' => $result_products_data['products_model'],
                    'products_ebay' => (int)'1',
                    'final_price' => $result_impegno['type'] == 'n' ? $res_GetOrders[$i]['Subtotal'] :(int)'0',
                    'final_used_price' => $result_impegno['type'] == 'u' ? $res_GetOrders[$i]['Subtotal'] :(int)'0',
                    'products_price' => $result_impegno['type'] == 'n' ? $res_GetOrders[$i]['Subtotal'] :(int)'0',
                    'products_used_price' => $result_impegno['type'] == 'u' ? $res_GetOrders[$i]['Subtotal'] :(int)'0',
                    $sede_impegno => $param['sede'],
                    'products_tax' => (int)'0',
                    'products_used_quantity' => $result_impegno['type'] == 'u' ? (int)$res_GetOrders[$i]['QuantityPurchased'] : (int)'0',
                    'products_quantity' => $result_impegno['type'] == 'n' ? (int)$res_GetOrders[$i]['QuantityPurchased'] : (int)'0',
                    'products_quantity_reserved' => !$result_impegno['type'] ? (int)$res_GetOrders[$i]['QuantityPurchased'] : (int)'0',);

   
tep_db_perform(TABLE_ORDERS_PRODUCTS, $array_result);

}
}
}

tep_db_query("UPDATE ".TABLE_ORDERS_PRODUCTS.", orders
   SET ".TABLE_ORDERS_PRODUCTS.".order_id = orders.orders_id
 WHERE ".TABLE_ORDERS_PRODUCTS.".session_id = orders.session_id");
    
?>