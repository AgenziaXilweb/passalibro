<?php



//$image = file_exists('../images/ISBN/9788845913914.jpg')?'images/ISBN/9788845913914.jpg':'images/nopic.png';
//
//$path= 'http:www.passalibro.it/';
//
//echo $path.$image;


//$mia_img = imagecreatefromjpeg("../images/ISBN/9788845913914.jpg");  

// Definisco i colori dello sfondo e del testo 
# $colore_sfondo = imagecolorallocate($mia_img,102,102,153); 
# $colore_testo = imagecolorallocate($mia_img,255,255,255); 

// Do colorealla mia immagine $mia_img 
# imagefill($mia_img,0,0,$colore_sfondo); 

// Creo una variabile con il testo da stampare nell'immagine 
# $testo = "Il tuo IP è " . $_SERVER[REMOTE_ADDR]; 

// Scrivo il testo all'interno dell'immagine 
# Imagestring($mia_img,10,5,5,$testo,$colore_testo); 

// Definisco l'intestazione del file 
// indicando che si tratta di una immagine Jpeg 
# header("Content-type: image/jpeg"); 

// Mostro l'immagine creata 
# imagejpeg($mia_img); 

// Faccio pulizia 
# imagedestroy($mia_img);

$sql = "SELECT if(eb.type = 'u',
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
 WHERE eb.esito IN('success','warning') AND eb.chiusura = 0";
 
$query = tep_db_query($sql);
while($data = tep_db_fetch_array($query)){


$path_images_key = '../images/ISBN/'.$data['cod_chiave'].'.jpg';
$path_images_isbn = '../images/ISBN/'.$data['isbn13'].'.jpg';

if(file_exists($path_images_isbn)){

$image = $data['ItemID'].' - '.'images/ISBN/'.$data['isbn13'].'.jpg';     
    
} else {
    
$image = $data['ItemID'].' - '.'images/nopic.png';
    
}

echo $image.'<br>';

//if(file_exists($path_images_key)){
//    
//$image = 'images/ISBN/'.$data['cod_chiave'].'.jpg';  
//    
//}     
    
}



?>