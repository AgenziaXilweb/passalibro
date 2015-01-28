<?php

// query di controllo giacenza tra magsedi e tabella ebay della sede

$sql="SELECT if(eb.type = 'u',
          m.qta_giacenza_u - m.soglia_web_u - m.impegnato_web_u,
          m.qta_giacenza_n - m.soglia_web_n - m.impegnato_web_n)
          AS new_quantity,
       c.titolo,
       c.autore1,
       c.editore,
       c.descrizione_estesa,
       c.anno_edizione,
       eb.cod_chiave as cod_chiave,
       eb.quantity,
       eb.sede,
       eb.type,
       eb.isbn13,
       eb.categoria_ebay,
       if(eb.stato_uso <> cs.stato_uso,cs.stato_uso,eb.stato_uso) AS new_stato_uso,
       if(eb.type = 'u',cs.prezzo_usato_ebay,cs.prezzo_nuovo_ebay) AS new_prezzo,
       if(eb.condizione_ebay <> cs.condizione_ebay,cs.condizione_ebay,eb.condizione_ebay) AS new_condizione_ebay,
       eb.condizione_ebay,
       eb.prezzo,
       eb.ubicazione,
       eb.proposta,
       eb.ItemID,
       eb.autopay,
       eb.prima_edizione,
       eb.new_item_id,
       eb.SKU
  FROM ".TABLE_EBAY_PRODUCTS.$param['sede']." eb
       JOIN ".CATALOGO_SEDI." cs
          USING (cod_chiave, sede)
       JOIN ".MAGAZZINO_SEDI." m
          USING (cod_chiave, sede)
       JOIN ".CATALOGO." c
          USING (cod_chiave)
 WHERE eb.esito IN('success','warning','failure') AND eb.chiusura = 0";

if($get_proposta == 0){
 
$sql .= " AND if(eb.type = 'u',
          m.qta_giacenza_u - m.soglia_web_u - m.impegnato_web_u,
          m.qta_giacenza_n - m.soglia_web_n - m.impegnato_web_n) < eb.quantity LIMIT 10";   
    
}

if($get_proposta == 1){
 
$sql .= " AND eb.proposta = 1 LIMIT 10";  
    
}

if($get_proposta == 9){
 
$sql .= ' LIMIT 10';   
    
}

#echo $sql;

$query=tep_db_query($sql);

while($products=tep_db_fetch_array($query)){

// Richiamo le funzioni predefinite per la Revise dell'inserzione.'

if($products['new_quantity'] <> $products['quantity'] || $products['new_prezzo'] <> $products['prezzo'] || $products['new_condizione_ebay'] <> $products['condizione_ebay']){

$sql_ebay_array = array('stato_uso'=>utf8_decode($products['new_stato_uso']),
       'prezzo'=>$products['new_prezzo'],
       'condizione_ebay'=>$products['type'] == 'n'? '1000':$products['new_condizione_ebay'],
       'proposta'=>$products['proposta'] > 0 ? (int)'1' : (int)'0',
       'quantity'=>$products['new_quantity'],
       'autopay'=>$products['autopay']);

// Aggiorno i campi in tabella ebay per allineara le quantita o eventuali modifiche.
       
tep_db_perform(TABLE_EBAY_PRODUCTS.$param['sede'],$sql_ebay_array,'update','new_item_id = '.$products['new_item_id']);

// Creo un array dei campi per passare i valori aggiornati ad eBay con XML

$ReviseItem_array = array('titolo'=>utf8_decode($products['titolo']),
       'ItemID'=>$products['ItemID'],
       'cod_chiave'=>$products['cod_chiave'],
       'isbn13'=>$products['isbn13'],
       'stato_uso'=>utf8_decode($products['new_stato_uso']),
       'categoria_ebay'=>$products['categoria_ebay'],
       'ubicazione'=>$products['ubicazione'],
       'descrizione_estesa'=>utf8_decode($products['descrizione_estesa']),
       'condizione_ebay'=>$products['type']== 'n'? '1000':$products['condizione_ebay'],
       'prezzo'=>$products['new_prezzo'],
       'proposta'=>$products['proposta'] > 0 ? 'true' : 'false',
       'quantity'=>$products['new_quantity'],
       'type'=>$products['type'],
       'autopay'=>$products['autopay']);
    
$xml_ReviseItem = tep_ReviseItemRequest($param['token'],$ReviseItem_array,$DurationTime,'0');
$req_ReviseItem = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'ReviseItem',$xml_ReviseItem,$param['type'],'101','819');
$res_ReviseItem = tep_ReviseItemResponse($req_ReviseItem);    

 
   
} else {
    
return false;
    
}
var_dump($req_ReviseItem); 
}

?>