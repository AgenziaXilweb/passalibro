<?php

### FUNZIONI PERSONALIZZATE - Marco 

// Seleziono una sede per settare la sessione in caso di prenotazione 
  
   function tep_check_reserved_sede($parametri=null) {
 
    $sql = tep_db_query("SELECT sum(ot.value) AS totale, op.sede_scuola as sede
  FROM orders_total ot, orders_products op
 WHERE ".$parametri."
GROUP BY op.sede_scuola
ORDER BY totale, op.sede_scuola ASC
 LIMIT 1");

    $result = tep_db_fetch_array($sql);

    return $result['sede'];
    
 }
 
// Seleziono la lista dei libri per le convenzioni (convenzione_acquisti.php)
 
function tep_lista_adozioni($sede=null,$codice='', $classe='', $sezione='',$anno=null){

if(is_null($anno)){$anno=date("Y");}
 
$sql=tep_db_query("SELECT da_acquistare,
products_id, 
consigliata, 
adozione_nuova, 
isbn13, titolo, 
products_image, 
products_price, 
products_used_price
  FROM passalibro.adozsedi
  join passalibroweb.products using(cod_chiave)
  JOIN passalibro.catalogo using (cod_chiave)
 WHERE     cod_scuola = ".$codice."
       AND sede = ".$sede."
       AND anno = ".$anno."
       AND classe = ".$classe."
       AND sezione = '".$sezione."'");
       
$array=array();

    while($results=tep_db_fetch_array($sql)){                

array_push($array, $results);
    
        }
return $array;

}

// Seleziono i libri da acquistare per le convenzioni (convenzione_acquisti.php)

function tep_status_adozioni($products_id=null){
 
$sql=tep_db_query("SELECT da_acquistare,
products_id, 
consigliata, 
adozione_nuova, 
  FROM passalibro.adozsedi
  join passalibroweb.products using(cod_chiave)
  JOIN passalibro.catalogo using (cod_chiave)
 WHERE     products_id = ".$products_id."'");

$results=tep_db_fetch_array($sql);                

return $array;

    }

// Seleziono il gateway da utilizzare per la sede di vendita
    
function tep_sede_gateway($sede=''){

$sql=tep_db_query("SELECT sede, circuito
 FROM passalibroweb.parametri_banche
 WHERE sede = ".$sede."
ORDER BY sede");
 
$result=tep_db_fetch_array($sql);

$result = array('sede'=>$result['sede'],
            'circuito'=>$result['circuito']);

return $result;

}

// Seleziono una sede per settare la sessione in caso di prenotazione se è settato il campo data_school nella tabella 'customers_basket'

function tep_data_school_reserved($customer_id=null){

$sql=tep_db_query("SELECT data_school, MID(data_school, 1, 1) AS sede
  FROM customers_basket
 WHERE customers_id = ".$customer_id." 
 AND customers_basket_reserved_quantity > 0 
 AND customers_basket_used_quantity = 0 
 AND customers_basket_quantity = 0
ORDER BY sede DESC
 LIMIT 1");

$result=tep_db_fetch_array($sql);

$array=array('data_school'=>$result['data_school'],
'sede'=>$result['sede']);

return $array;
    
}

// Seleziono per inviare la mail dell' ordine con sede come mittente

function tep_db_mail_orders($order_id=null){

$sql=tep_db_query("SELECT o.sede
  FROM parametri_banche pb, orders o
 WHERE o.sede = pb.sede AND o.orders_id =".$order_id);

$result=tep_db_fetch_array($sql);

return $result['sede'];

}

// Aggiorno il campo sede del cliente come default, seleziono sempre la sede che ha fatto meno vendite nella giornata.

function tep_default_sede_customers(){

$sql=tep_db_query("SELECT o.date_purchased, o.sede, count(o.orders_id) AS ordini
  FROM orders o
 WHERE o.sede > 0 AND o.date_purchased LIKE concat(CURDATE(), '%')
GROUP BY o.sede
ORDER BY ordini
 LIMIT 1");

if(!tep_db_num_rows($sql)){

$array = array('sede'=>3);

} else {

$result=tep_db_fetch_array($sql);

$array = array('sede'=>$result['sede']); 

}      

return $array;
   
}   

function tep_check_hostname($dominio_attivo='www.passalibro.it'){

$sql = tep_db_query("SELECT warehouse_id, includi, sede, citta, hostname, shipping, active, messaggio 
FROM passalibroweb.warehouses WHERE hostname = '" . $dominio_attivo ."'");

$result=tep_db_fetch_array($sql);

$array = array('sede'=>$result['sede'],
'citta'=>$result['citta'],
'messaggio'=>$result['messaggio'],
'hostname'=>$result['hostname'],
'includi'=>$result['includi'],
'shipping'=>$result['shipping'],
'active'=>$result['active']);   

return $array;
  
}

function tep_check_warehouse_customers_basket($active_customer_id=null,$session_sede=null){

tep_db_query("update passalibro.magsedi SET qta_giacenza_n = 0 WHERE qta_giacenza_n < 0");
tep_db_query("update passalibro.magsedi SET qta_giacenza_u = 0 WHERE qta_giacenza_u < 0");
tep_db_query("update passalibro.magsedi SET impegnato_web_n = 0 WHERE impegnato_web_n < 0");
tep_db_query("update passalibro.magsedi SET impegnato_web_u = 0 WHERE impegnato_web_u < 0");
tep_db_query("update passalibro.magsedi SET impegnato_web_n = 0 WHERE qta_giacenza_n = 0 and impegnato_web_n <> 0");
tep_db_query("update passalibro.magsedi SET impegnato_web_u = 0 WHERE qta_giacenza_u = 0 and impegnato_web_u <> 0");
    
$sql="SELECT cb.customers_basket_id,
       m.sede,
       m.cod_chiave,
       p.products_id,
       m.qta_giacenza_n - m.soglia_web_n > 0 AS nuovo,
       m.qta_giacenza_u - m.soglia_web_u > 0 AS usato
  FROM products p
       JOIN customers_basket cb
          USING (products_id)
       JOIN passalibro.magsedi m
          USING (cod_chiave)
 WHERE     p.products_id IN (SELECT products_id
                               FROM passalibroweb.customers_basket
                              WHERE customers_id = ".$active_customer_id.")
       AND m.sede = ".$session_sede."
       AND   (m.qta_giacenza_n - m.soglia_web_n)
           + (m.qta_giacenza_u - m.soglia_web_u) > 0
GROUP BY cb.customers_basket_id,
         m.sede,
         m.cod_chiave,
         p.products_id,
         p.products_model,
         m.qta_giacenza_n - m.soglia_web_n > 0,
         m.qta_giacenza_u - m.soglia_web_u > 0";

    $query=tep_db_query($sql);

    while($results=tep_db_fetch_array($query)){   

    tep_db_perform('customers_basket',array('warehouse'=>$results['sede']),'update','customers_basket_id='.$results['customers_basket_id']);   
    
    }    
    
}

?>