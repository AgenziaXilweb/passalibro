<?php

function tep_db_catalogo_ebay_attivo($sede=null,$published='1'){

$sql="SELECT 
cod_chiave as cod_chiave, 
products_id, 
type, 
quantity, 
isbn13, 
categoria_ebay, 
sede, 
stato_uso, 
if(condizione_ebay = '',
if(type = 'n','1000','5000'),
if(condizione_ebay = '3000','4000',condizione_ebay)) as condizione_ebay, 
prezzo, 
ubicazione, 
proposta, 
ItemID, 
pubblicato_ebay, 
autopay,
autore1,
titolo,
anno_edizione,
editore,
descrizione_estesa
  FROM (SELECT cs.cod_chiave,
               p.products_id,
               'u' AS type,
               if(m.qta_giacenza_u - m.soglia_web_u - m.impegnato_web_u < 0,
                  0,
                  m.qta_giacenza_u - m.soglia_web_u - m.impegnato_web_u)
                  AS quantity,
               c.isbn13,
               c.categoria_ebay,
               c.autore1,
               c.titolo,
               c.anno_edizione,
               c.editore,
               c.descrizione_estesa,
               cs.sede,
               cs.stato_uso,
               cs.condizione_ebay,
               if(cs.prezzo_usato_ebay = 0,
                  p.products_used_price,
                  cs.prezzo_usato_ebay) as prezzo,
               concat('RIF.WEB:',
                      cs.scaffale,
                      '-',
                      cs.piano,
                      '-',
                      cs.posizione)
                  AS ubicazione,
               cs.proposta_acquisto_usato as proposta,
               cs.itemid_u_ebay AS ItemID,
               cs.pubblicato_ebay,
               cs.autopay
          FROM passalibro.catalogo c
               JOIN passalibroweb.products p USING (cod_chiave)
               JOIN passalibro.catalogo_sedi cs USING (cod_chiave)
               JOIN passalibro.magsedi m USING (cod_chiave, sede)
         WHERE     cs.pubblicato_ebay = ".(int)$published."
               AND sede = ".$sede."
               AND m.qta_giacenza_u - m.soglia_web_u - m.impegnato_web_u > 0
               AND cs.itemid_u_ebay = ''
        UNION
        SELECT cs.cod_chiave,
               p.products_id,
               'n',
               if(m.qta_giacenza_n - m.soglia_web_n - m.impegnato_web_n < 0,
                  0,
                  m.qta_giacenza_n - m.soglia_web_n - m.impegnato_web_n),
               c.isbn13,
               c.categoria_ebay,
               c.autore1,
               c.titolo,
               c.anno_edizione,
               c.editore,
               c.descrizione_estesa,
               cs.sede,
               cs.stato_uso,
               cs.condizione_ebay,
               if(cs.prezzo_nuovo_ebay = 0,
                  p.products_price,
                  cs.prezzo_nuovo_ebay),
               concat('RIF.WEB:',
                      cs.scaffale,
                      '-',
                      cs.piano,
                      '-',
                      cs.posizione)
                  AS ubicazione,
               cs.proposta_acquisto_nuovo,
               cs.itemid_n_ebay,
               cs.pubblicato_ebay,
               cs.autopay
          FROM passalibro.catalogo c
               JOIN passalibroweb.products p USING (cod_chiave)
               JOIN passalibro.catalogo_sedi cs USING (cod_chiave)
               JOIN passalibro.magsedi m USING (cod_chiave, sede)
         WHERE     cs.pubblicato_ebay = ".(int)$published."
               AND sede = ".$sede."
               AND m.qta_giacenza_n - m.soglia_web_n - m.impegnato_web_n > 0
               AND cs.itemid_n_ebay = '')
       AS ebay_magazzino ORDER BY cod_chiave;";

$query=tep_db_query($sql);

while($results=tep_db_fetch_array($query)){
    
$array[] = array('cod_chiave'=>$results['cod_chiave'],
'products_id'=>$results['products_id'],
'type'=>$results['type'],
'quantity'=>$results['quantity'],
'isbn13'=>$results['isbn13'],
'categoria_ebay'=>$results['categoria_ebay'],
'condizione_ebay'=>$results['condizione_ebay'],
'sede'=>$results['sede'],
'editore'=>$results['editore'],
'titolo'=>$results['titolo'],
'stato_uso'=>$results['stato_uso'],
'prezzo'=>$results['prezzo'],
'autore1'=>$results['autore1'],
'anno_edizione'=>$results['anno_edizione'],
'descrizione_estesa'=>$results['descrizione_estesa'],
'ubicazione'=>$results['ubicazione'],
'proposta'=>$results['proposta'],
'ItemID'=>$results['ItemID'],
'pubblicato_ebay'=>$results['pubblicato_ebay'],
'autopay'=>$results['autopay'],
'SKU'=>$results['cod_chiave'].'S'.$results['sede'].'T'.$results['type']);   
   
}

return $array;
    
}

###########################################################################################

function tep_db_catalogo_ebay_passivo($sede=null,$published='1'){

$sql="SELECT 
cod_chiave as cod_chiave, 
products_id, 
type, 
quantity, 
isbn13, 
categoria_ebay, 
sede, 
stato_uso, 
condizione_ebay, 
prezzo, 
ubicazione, 
proposta, 
ItemID, 
pubblicato_ebay, 
autopay,
autore1,
titolo,
anno_edizione,
editore,
descrizione_estesa
  FROM (SELECT cs.cod_chiave,
               p.products_id,
               'u' AS type,
               if(m.qta_giacenza_u - m.soglia_web_u - m.impegnato_web_u < 0,
                  0,
                  m.qta_giacenza_u - m.soglia_web_u - m.impegnato_web_u)
                  AS quantity,
               c.isbn13,
               c.categoria_ebay,
               c.autore1,
               c.titolo,
               c.anno_edizione,
               c.editore,
               c.descrizione_estesa,
               cs.sede,
               cs.stato_uso,
               cs.condizione_ebay,
               if(cs.prezzo_usato_ebay = 0,
                  p.products_used_price,
                  cs.prezzo_usato_ebay) as prezzo,
               concat('RIF.WEB:',
                      cs.scaffale,
                      '-',
                      cs.piano,
                      '-',
                      cs.posizione)
                  AS ubicazione,
               cs.proposta_acquisto_usato as proposta,
               cs.itemid_u_ebay AS ItemID,
               cs.pubblicato_ebay,
               cs.autopay
          FROM passalibro.catalogo c
               JOIN passalibroweb.products p USING (cod_chiave)
               JOIN passalibro.catalogo_sedi cs USING (cod_chiave)
               JOIN passalibro.magsedi m USING (cod_chiave, sede)
         WHERE     cs.pubblicato_ebay = ".(int)$published."
               AND sede = ".$sede."
               AND m.qta_giacenza_u - m.soglia_web_u - m.impegnato_web_u <= 0
               AND cs.itemid_u_ebay <> ''
        UNION
        SELECT cs.cod_chiave,
               p.products_id,
               'n',
               if(m.qta_giacenza_n - m.soglia_web_n - m.impegnato_web_n < 0,
                  0,
                  m.qta_giacenza_n - m.soglia_web_n - m.impegnato_web_n),
               c.isbn13,
               c.categoria_ebay,
               c.autore1,
               c.titolo,
               c.anno_edizione,
               c.editore,
               c.descrizione_estesa,
               cs.sede,
               cs.stato_uso,
               cs.condizione_ebay,
               if(cs.prezzo_nuovo_ebay = 0,
                  p.products_price,
                  cs.prezzo_nuovo_ebay),
               concat('RIF.WEB:',
                      cs.scaffale,
                      '-',
                      cs.piano,
                      '-',
                      cs.posizione)
                  AS ubicazione,
               cs.proposta_acquisto_nuovo,
               cs.itemid_n_ebay,
               cs.pubblicato_ebay,
               cs.autopay
          FROM passalibro.catalogo c
               JOIN passalibroweb.products p USING (cod_chiave)
               JOIN passalibro.catalogo_sedi cs USING (cod_chiave)
               JOIN passalibro.magsedi m USING (cod_chiave, sede)
         WHERE     cs.pubblicato_ebay = ".(int)$published."
               AND sede = ".$sede."
               AND m.qta_giacenza_n - m.soglia_web_n - m.impegnato_web_n <= 0
               AND cs.itemid_n_ebay <> '')
       AS ebay_magazzino ORDER BY cod_chiave;";

$query=tep_db_query($sql);

while($results=tep_db_fetch_array($query)){
    
$array[] = array('cod_chiave'=>$results['cod_chiave'],
'products_id'=>$results['products_id'],
'type'=>$results['type'],
'quantity'=>$results['quantity'],
'isbn13'=>$results['isbn13'],
'categoria_ebay'=>$results['categoria_ebay'],
'condizione_ebay'=>$results['condizione_ebay'],
'sede'=>$results['sede'],
'editore'=>$results['editore'],
'titolo'=>$results['titolo'],
'stato_uso'=>$results['stato_uso'],
'prezzo'=>$results['prezzo'],
'autore1'=>$results['autore1'],
'anno_edizione'=>$results['anno_edizione'],
'descrizione_estesa'=>$results['descrizione_estesa'],
'ubicazione'=>$results['ubicazione'],
'proposta'=>$results['proposta'],
'ItemID'=>$results['ItemID'],
'pubblicato_ebay'=>$results['pubblicato_ebay'],
'autopay'=>$results['autopay'],
'SKU'=>$results['cod_chiave'].'S'.$results['sede'].'T'.$results['type']);   
   
}

return $array;
    
}



?>