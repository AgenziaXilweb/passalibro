<?php

$sql_listalibri=tep_db_query("SELECT cod_chiave,customers_basket_id, customers_id,
       titolo,
       isbn13,
       products_image,
       da_acquistare,
       consigliata,
       adozione_nuova,
       passalibro,
       customers_basket_reserved_quantity,
       final_price,
       data_school
  FROM passalibroweb.customers_basket
       JOIN products
          USING (products_id)
       JOIN passalibro.adozsedi
          USING (cod_chiave)
       JOIN passalibro.catalogo
          USING (cod_chiave)
 WHERE passalibro.adozsedi.anno = 2013
 AND cod_scuola = ".$codice."
 AND classe = ".$classe."
 AND sezione = '".$sezione."'
 AND passalibroweb.customers_basket.customers_id = ".$_REQUEST['customer_id']." 
 AND sede = ".$sede);

while($libri=tep_db_fetch_array($sql_listalibri)){

$notifica =$libri['da_acquistare']==true?'<strong>[<font color="#DC143C">DA ACQUISTARE</font>]</strong><br>':'';
$avviso=$libri['customers_basket_reserved_quantity']==0?'Rimosso':'';

$attivo=$libri['da_acquistare']==true?'<input type="text" size="1" name="qta" value="'.$libri['customers_basket_reserved_quantity'].'" readonly="readonly"/>':'<input type="text" size="1" name="qta" value="0" readonly="readonly"/>';
$picture=file_exists('images/ISBN/'.$libri['products_image'])? 'images/ISBN/'.$libri['products_image']:'images/nopic.png';

echo '<tr><th>
<img width="100px" src="'.$picture.'" /><input type="hidden" name="customers_basket_id" value="'.$libri['customers_basket_id'].'" /></th>
<td style="font-size: 0.9em;">'.utf8_encode(strtoupper($libri['titolo'])).'</td>
<td style="width:150px; font-size: 0.8em;">'.$notifica.'</td>
<td style="width:150px; font-size: 0.8em;">'.$libri['isbn13'].'</td>
<td><input type="text" name="prezzo" value="'.number_format($libri['final_price'],2,',','.').'" /></td>
<td>'.$attivo.'</td>
<td><a href="#" class="btnIncrement" data-role="button" data-icon="plus" data-iconpos="notext" data-theme="a" data-inline="true">Aggiungi</a>
</td><td><a href="#" class="btnDecrement" data-role="button" data-icon="minus" data-iconpos="notext" data-theme="b" data-inline="true">Rimuovi</a>
</td><td><p style="color: red">'.$avviso.'</p></td></tr>';

}
?>