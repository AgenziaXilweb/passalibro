
<?php

require('includes/application_top.php');

require(DIR_WS_INCLUDES . 'template_top.php');

require 'includes/ebay_function.php';
require 'includes/ebay_config.php';
require 'includes/ebay_xml_request.php';
require 'includes/ebay_xml_response.php';

$_POST['type'] = 'production';
$_POST['sede'] = (int)'3';
$_POST['date'] = date('d/m/Y', time());
$_POST['righe'] = (int)'200';


$param = tep_get_token($_POST['type'],$_POST['sede']);

$getebaytime = tep_GeteBayOfficialTimeRequest($param['token']);
$xlmtime=$oggetti = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'GeteBayOfficialTime',$getebaytime,$param['type'],'101','819');
$putebaytime=tep_GeteBayOfficialTimeResponse($xlmtime);

$lastdata=tep_last_startdate($param['sede']);

?>

<script type="text/javascript">

function ebaytime(){

document.ebayform.date.value='<?php echo $putebaytime; ?>';  
    
}
function timeline(){

document.ebayform.date.value='<?php echo $lastdata; ?>';  
    
}


</script>

<?php

echo '<form name="ebayform" method="POST" action="'.$_SERVER['PHP_SELF'].'">';
echo '<table bgcolor="whitesmoke"><thead><caption>Gestione Prodotti eBay</caption></thead>';
echo '<tr><td colspan="2" width="50%">Produzione:<input type="radio" name="type" value="production"/></td><td colspan="2" width="50%"> Sandbox:<input type="radio" name="type" value="sandbox" checked/></td></tr>';
echo '<tr><td colspan="4">Data di partenza:<input type="text" size="25" name="date"/> <input onclick="ebaytime()" type="button" value="Data e Ora eBay"/> <input onclick="timeline()" type="button" value="Ultima data inserita"/></td></tr>';
echo '<tr><td width="25%">Busto:<input type="radio" name="sede" value="1" checked/></td><td width="25%">Sesto:<input type="radio" name="sede" value="2"/></td><td width="25%">Milano:<input type="radio" name="sede" value="3"/></td><td width="25%">Sassuolo:<input type="radio" name="sede" value="4"/></td></tr>';
echo '<tr><td width="25%">Righe da visualizzare:</td><td width="25%"><select name="righe">
<option value="0" selected="yes">- selezionare -</option>
<option value="5">5</option>
<option value="10">10</option>
<option value="25">25</option>
<option value="50">50</option>
<option value="100">100</option>
<option value="200">200</option>
</select></td><td width="25%" align="right">Inserimento:</td><td  width="25%"bgcolor="red"><input type="checkbox" name="azione" value="addproducts"/></td></tr>';
echo '<tr><td colspan="4">'.tep_draw_button('Comincia la ricerca','home',null,null,'submit').'</td></tr>';
echo '</table>';
echo '</form>';

$date = !tep_last_startdate($param['sede'])?$_POST['date']:tep_last_startdate($param['sede']);

$newdate = strtotime( '+3 month' , strtotime( $date )) ; // facciamo l'operazione 
$newdate = date( 'Y-m-d' , $newdate ); //trasformiamo la data nel formato accettato dal db YYYY-MM-DD echo $newdate; - See more at: 

echo 'Dalla data: '.$date.'<br>';
echo 'Alla data: '.$newdate.'<br>';

$prodottiattivi = tep_GetSellerListRequest($param['token'],$param['userid'],$_POST['righe'],'1',$date,$newdate,'ItemArray.Item.ItemID');

$ebaysede = $param['sede'];

$oggetti = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'GetSellerList',$prodottiattivi,$param['type'],'101','819');

$itemresults = tep_GetSellerListResponseItemID($oggetti);

echo 'Totale dei records: '.count($itemresults).' già a catalogo<br>';

echo '<table width="100%" border="1">';
echo '<tr><td>Caricato</td><td>Stato</td><td>Copertina</td><td>N° Inserzione</td><td>Cat.Neg.</td><td width="250px">Titolo</td><td>';
echo 'Descrizione</td><td>Quantità</td><td>Prezzo in &euro;</td></tr>';


$i = 0;
for ($i = 0;$i < count($itemresults); $i++) {
    
$singleitem = tep_GetItemRequest($param['token'],$itemresults[$i],'true');

$prodotti = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'GetItem',$singleitem,$param['type'],'101','819');

$prodottoebay=tep_GetItemResponse($prodotti);

$check_prodotto[]=$prodottoebay;

$prezzo=str_ireplace('.',',',$prodottoebay['price'])==''?'0,00':number_format(str_ireplace('.',',',$prodottoebay['price']), 4, ',', '') ;

$condizione=$prodottoebay['ConditionID']=='1000'?'Nuovo':'Usato';

$sqlcontrol=mysql_query("SELECT itemID FROM passalibroweb.ebay_to_products WHERE itemID =".$prodottoebay['productID']);

$productsID=array();
$id=0;
while($itemID = mysql_fetch_array($sqlcontrol)){
  
    $productsID[]=$itemID['itemID'];
$id=$id++;
}


$specifiche=tep_GetItemSpecificsResponse($prodotti);

$descrizione='';
for($z = 0; $z < count($specifiche); $z++){
    
$descrizione.=$specifiche[$z]['NameSpecifics'].':'.$specifiche[$z]['ValueSpecifics'].'<br>';
    
}

if($productsID[$id]==$check_prodotto[$id]['productID']){
echo $productsID[$id].'=='.$prodottoebay['productID'];


echo '<tr bgcolor="yellow"><td>SI</td><td>'.$condizione.'</td><td><img src="'.$prodottoebay['picture'].'" width="50px"></td><td>'.$prodottoebay['productID'].'</td><td>'.$prodottoebay['StoreCategoryID'].'</td><td width="250px">'.'<a href="'.$prodottoebay['link'].'">'.$prodottoebay['title'].'</a></td><td>';
echo $descrizione;
echo '</td><td>'.$prodottoebay['quantity'].'</td><td>'.$prezzo.'</td></tr>';
   
    
} else {


echo '<tr bgcolor="whitesmoke"><td>NO</td><td>'.$condizione.'</td><td><img src="'.$prodottoebay['picture'].'" width="50px"></td><td>'.$prodottoebay['productID'].'</td><td>'.$prodottoebay['StoreCategoryID'].'</td><td width="250px">'.'<a href="'.$prodottoebay['link'].'">'.$prodottoebay['title'].'</a></td><td>';
echo $descrizione;
echo '</td><td>'.$prodottoebay['quantity'].'</td><td>'.$prezzo.'</td></tr>';

switch($_REQUEST['azione']){
    
## Aggiungo in tabella products

case 'addproducts':

$pictures=$prodottoebay['picture']==''?'http://p.ebaystatic.com/aw/pics/nextGenVit/imgNoImg.gif':$prodottoebay['picture'];
$campo_quantity=$condizione=='Nuovo'?'products_quantity':'products_used_quantity';
$campo_price=$condizione=='Nuovo'?'products_price':'products_used_price';
$status=$condizione=='Nuovo'?'n':'u';

        $products_data_array = array($campo_quantity => $prodottoebay['quantity'],
                                $campo_price => (float)$prezzo,
                                'products_model' => $prodottoebay['productID'],
                                'cod_chiave' => $param['cod_chiave'],
                                'products_image' => $pictures,
                                'products_date_added' => date("Y-m-d H:i:s",strtotime($prodottoebay['start'])),
                                'products_sede' => $param['sede'],
                                'products_ebay' => '1');

tep_db_perform('passalibroweb.products',$products_data_array);

## Recupero l'ultimo ID della tabella products

$lastid=mysql_query("SELECT MAX(products_id) AS ultimo FROM products");
$rec=mysql_fetch_array($lastid);

## Inserisco lingua,titolo e descrizione nella tabella products_description

        $description_data_array = array('products_id' => $rec['ultimo'],
                                        'products_name'=>$prodottoebay['title'],
                                        'products_description'=>$descrizione);


tep_db_perform('passalibroweb.products_description',$description_data_array);

## Inserisco e associo le categorie usando una funzione personalizzata.

        $item_to_cat_data_array = array('products_id'=>$rec['ultimo'],
                                        'categories_id'=>'32');

tep_db_perform('passalibroweb.products_to_categories',$item_to_cat_data_array);

## Inserisco nella nuova tabella creata i dati che estraggo da ebay relazionandola con l'identificativo
## della tabella products, questo mi serve per relazionare i prodotti con le categorie, controllare le quantita
## da entrambe le piattaforme. 

        $ebayceck_data_array = array('sede' => $param['sede'],
                                'products_id' => $rec['ultimo'],
                                'itemID' => $prodottoebay['productID'],
                                'ebay_categoriesstore_id' => $prodottoebay['StoreCategoryID'],
                                'quantity' => $prodottoebay['quantity'],
                                'start_date' => $prodottoebay['start'],
                                'type' => $status,
                                'end_date' => $prodottoebay['end']);

tep_db_perform('passalibroweb.ebay_to_products',$ebayceck_data_array);

mysql_query("UPDATE products_to_categories, ebay_to_products, ebay_categoriesstore
   SET products_to_categories.categories_id = ebay_categoriesstore.category_id
 WHERE     ebay_to_products.products_id = products_to_categories.products_id
       AND ebay_to_products.ebay_categoriesstore_id = ebay_categoriesstore.ebay_categoriesstore_id");


break;
  }
 }
}

echo '</table>';


//$regole=tep_GetApiAccessRulesRequest($param['token']);
//
//$periodo = talk_to_ebay($param['devname'],$param['appname'],$param['certname'],'GetApiAccessRules',$regole,$param['type'],'101','819');
//
//$regola = tep_GetApiAccessRulesResponse($periodo);
//
//
//echo 'Risultato: '.$regola['DailyUsage'];

 
#print_r($resp);

#$aggiorna = tep_ReviseItemRequest($token,'110115408405','30');

#talk_to_ebay($devname,$appname,$certname,'ReviseItem',$aggiorna,'s','101','819');

?>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>