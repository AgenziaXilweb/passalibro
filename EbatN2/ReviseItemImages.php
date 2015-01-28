<?php

// query di controllo giacenza tra magsedi e tabella ebay della sede

$sql="SELECT * FROM ".TABLE_EBAY_PRODUCTS.$param['sede']." eb
 WHERE eb.esito IN('success','warning') 
 AND eb.PicturesFlag = 0 
 AND eb.chiusura = 0";

if($get_proposta == 0){
 
$sql .= " ORDER BY new_item_id DESC LIMIT 100";   
    
}

if($get_proposta == 1){
 
$sql .= " ORDER BY new_item_id DESC LIMIT 10";   
    
}

if($get_proposta == 9){
 
$sql .= " ORDER BY new_item_id DESC LIMIT 1";   
    
}

$query=tep_db_query($sql);

while($products=tep_db_fetch_array($query)){

$path_images_key = '/var/www/home/passalibro.com/images/ISBN/'.$products['cod_chiave'].'.jpg';
$path_images_isbn = '/var/www/home/passalibro.com/images/ISBN/'.$products['isbn13'].'.jpg';

$sql_ebay_array = array('PicturesFlag'=>(int)'1');

// Aggiorno i campi in tabella ebay con il flag immagine SI/NO

$ReviseItemImages_array = array('ItemID'=>$products['ItemID'],
       'cod_chiave'=>$products['cod_chiave'],
       'isbn13'=>$products['isbn13']);

if(file_exists($path_images_isbn)){

tep_db_perform(TABLE_EBAY_PRODUCTS.$param['sede'],$sql_ebay_array,'update','new_item_id = '.$products['new_item_id']);

// Richiamo le funzioni predefinite per la Revise dell'inserzione.'
    
$xml_ReviseItemImages = tep_ReviseItemImagesRequest($param['token'],$ReviseItemImages_array);
$req_ReviseItemImages = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'ReviseItem',$xml_ReviseItemImages,$param['type'],'101','819');
$res_ReviseItemImages = tep_ReviseItemImagesResponse($req_ReviseItemImages);    
    
}else {
    
if(file_exists($path_images_key)){   

tep_db_perform(TABLE_EBAY_PRODUCTS.$param['sede'],$sql_ebay_array,'update','new_item_id = '.$products['new_item_id']); 

// Richiamo le funzioni predefinite per la Revise dell'inserzione.'
    
$xml_ReviseItemImages = tep_ReviseItemImagesRequest($param['token'],$ReviseItemImages_array);
$req_ReviseItemImages = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'ReviseItem',$xml_ReviseItemImages,$param['type'],'101','819');
$res_ReviseItemImages = tep_ReviseItemImagesResponse($req_ReviseItemImages);    

    
} else {
    
return false;
    
}
    
}
   
}

?>