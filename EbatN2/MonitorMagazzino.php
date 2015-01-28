<?php

// Reimpegno tutti i sospesi delle sedi

//$sql = "SELECT (SELECT aps.products_id
//          FROM amazon_products_sede" . $get_sede . " aps
//         WHERE aps.amazon_products_id = ot.amazonSellerSKU)
//          AS products_id,
//       (SELECT aps.conditions
//          FROM amazon_products_sede" . $get_sede . " aps
//         WHERE aps.amazon_products_id = ot.amazonSellerSKU)
//          AS conditions
//  FROM amazonorderlistitems ot, amazonorderlist ol
// WHERE     ot.amazonOrderId = ol.amazonOrderId
//       AND ol.amazonOrderStatus = 'Pending'
//       AND DATE(ol.amazonPurchaseDate) = DATE(NOW())
//       AND ot.amazonSede = " . $get_sede . ";";
//
//echo $sql;
//
//$query = tep_db_query($sql);
//
//$i = 1;
//while ($result = tep_db_fetch_array($query)) {
//
//
//    $sql2 = "SELECT cod_chiave
// FROM passalibroweb.products
// WHERE products_id = " . $result['products_id'];
//
//    $query2 = tep_db_query($sql2);
//
//    $result2 = tep_db_fetch_array($query2);
//
//    $impegnato_web = $result['conditions'] == 'u' ? 'impegnato_web_u' :
//        'impegnato_web_n';
//
//    $sql_magsedi_array = array($impegnato_web => (int)'1');
//
//    echo $i . '-' . $result['products_id'] . '-' . $result['conditions'] . '-' . $result2['cod_chiave'] .
//        '<br>';
//
//    $i++;
//}

// Controllo e disimpegno il carrello.

for($t=1;$t<=2;$t++){

$type = $t == 1 ? 'n' : 'u';

$sql3 = "SELECT m.cod_chiave
  FROM passalibro.magsedi m
 WHERE     m.cod_chiave NOT IN (SELECT p.cod_chiave
                                  FROM passalibroweb.customers_basket cb
                                       JOIN passalibroweb.products p
                                          USING (products_id))
       AND m.cod_chiave > 0
       AND m.sede = ".$get_sede."
       AND m.impegnato_web_".$type." <> 0;";

$query3 = tep_db_query($sql3);


while($result3 = tep_db_fetch_array($query3)){



$sql_update_3 = "UPDATE passalibro.magsedi
   SET impegnato_web_".$type." = 0
 WHERE cod_chiave = ".$result3['cod_chiave']." AND sede = ".$get_sede;
 
tep_db_query($sql_update_3);
}   
    
}    



?>