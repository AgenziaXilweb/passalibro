<?php

  require('includes/application_top.php');

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'save':
        $configuration_value = tep_db_prepare_input($HTTP_POST_VARS['configuration_value']);
        $cID = tep_db_prepare_input($HTTP_GET_VARS['cID']);

        tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . tep_db_input($configuration_value) . "', last_modified = now() where configuration_id = '" . (int)$cID . "'");

        tep_redirect(tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $HTTP_GET_VARS['gID'] . '&cID=' . $cID));
        break;
    }
  }

  $gID = (isset($HTTP_GET_VARS['gID'])) ? $HTTP_GET_VARS['gID'] : 1;

  $cfg_group_query = tep_db_query("select configuration_group_title from " . TABLE_CONFIGURATION_GROUP . " where configuration_group_id = '" . (int)$gID . "'");
  $cfg_group = tep_db_fetch_array($cfg_group_query);

  require(DIR_WS_INCLUDES . 'template_top.php');
  require DIR_WS_INCLUDES . 'ebay_function.php' ;
  require DIR_WS_INCLUDES . 'ebay_config.php' ;
  require DIR_WS_INCLUDES . 'ebay_xml_request.php' ;
  require DIR_WS_INCLUDES . 'ebay_xml_response.php' ;

echo '<a href="ebay.php">Vai alla ricerca prodotti</a><br>';

echo '<table border="1">
<tr><td>Busto Arsizio: </td><td><a href="?azione=getcategorystore&sede=1&type=production">Export Categorie Negozio eBay</a></td></tr>
<tr><td>Sesto San Giovanni: </td><td><a href="?azione=getcategorystore&sede=2&type=production">Export Categorie Negozio eBay</a></td></tr>
<tr><td>Milano: </td><td><a href="?azione=getcategorystore&sede=3&type=production">Export Categorie Negozio eBay</a></td></tr>
<tr><td>Sassuolo: </td><td><a href="?azione=getcategorystore&sede=4&type=production">Export Categorie Negozio eBay</a></td></tr></table><br>';

echo '<table border="1"><tr><td>Codice categoria</td><td>Descrizione</td><td>Ordinamento</td></tr>';
	
switch($_GET['azione']){	

case 'getcategorystore':

$auth = tep_get_token($_GET['type'],$_GET['sede']);

$categorie = tep_GetCategoryStoreRequest($auth['token'],'1');

$risposta = talk_to_ebay($auth['devname'],$auth['appname'],$auth['certname'],'GetStore',$categorie,$auth['type'],'101','819');

$categoria = tep_GetCategoryStoreResponse($risposta);

for($i = 0; $i < count($categoria) ; $i++ ){
    
echo '<tr><td>'.$categoria[$i]['CategoryID'].'</td><td>'.$categoria[$i]['Name'].'</td><td>'.$categoria[$i]['Order'].'</td></tr>';

        $categories_data_array = array('sede' => $auth['sede'],
                                'ebay_categoriesstore_id' => $categoria[$i]['CategoryID'],
                                'ebay_categoriesstore_name' => $categoria[$i]['Name'],
                                'sort_order' => $categoria[$i]['Order']);

tep_action_db('passalibroweb.ebay_categoriesstore',$categories_data_array);

}
echo '</table><br>';
echo '<table border="1"><tr><td>Crea Categorie Sito da eBay: </td><td><a href="?azione=putcategoryeshop">Categorie da eBay a eCommerce</a></td></tr></table>';


break;

case 'putcategoryeshop':
 
$sql_last=mysql_query("SELECT MAX(categories_id) as cat_id FROM passalibroweb.categories");

$last_id=mysql_fetch_array($sql_last);

$ultimoid=$last_id['cat_id'];

$categories=mysql_query("SELECT ebay_categoriesstore_name
  FROM ebay_categoriesstore
GROUP BY ebay_categoriesstore_name");

$righe=mysql_num_rows($categories);

for($x = 0; $x < $righe ; $x++ ){
    
$new_categories_array=array('parent_id'=>'32',
'date_added'=>'now()',
'sort_order'=>'0');

tep_action_db('passalibroweb.categories',$new_categories_array); 

while($category=mysql_fetch_array($categories)){

echo $ultimoid.' - '.$category['ebay_categoriesstore_name'].'<br>';

$new_categories_description_array=array('categories_id'=>$ultimoid,
'categories_name'=>$category['ebay_categoriesstore_name']);

tep_action_db('passalibroweb.categories_description',$new_categories_description_array);
$ultimoid++;
}
}



echo '<table border="1"><tr><td>Sincronizza le categorie ebay con quelle del sito: </td><td><a href="?azione=syncat2cat">Syncronizza Categorie</a></td></tr></table>';



break;

case 'syncat2cat':

mysql_query("UPDATE ebay_categoriesstore, categories_description
   SET ebay_categoriesstore.category_id = categories_description.categories_id
 WHERE ebay_categoriesstore.ebay_categoriesstore_name =
          categories_description.categories_name");

break;
}   
 
echo '</table>';


?>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>