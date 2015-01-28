<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  require(DIR_WS_INCLUDES . 'template_top.php');

echo '<div style="margin: 50px 50px 50px 50px;"><table width="500px" border="0"><thead><caption>RICERCA PRODOTTO</cation></thead><tr>';
  
echo '<td width="100%"><form method="POST" action='.$_SERVER['PHP_SELF'].'><input size="100%" name="search" type="text"/></td><td><input class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" type="submit"/></form></td></tr>';
echo '<tr><td colspan="2"></td></tr>';
if(!$_REQUEST['search']){

echo '<tr><td colspan="2">Inserire un valore</td></tr>';   
    
} else {
    
$sql = mysql_query("SELECT distinct(products_id),products_image,products_price,CONCAT(products_model,' | ',products_name) as ricerca FROM products JOIN products_description USING(products_id) WHERE products_name LIKE '%".$_REQUEST['search']."%' OR products_model LIKE '%".$_REQUEST['search']."%'");

while($row = mysql_fetch_array($sql)){
    
$pictures = file_exists(DIR_WS_ISBN . $row['products_image'])? DIR_WS_ISBN . $row['products_image']: DIR_WS_IMAGES . 'nopic.png';

echo '<tr><td><a href="'.FILENAME_SPECIALS.'?action=new&name='.urlencode($row['ricerca']).'&products_id='.$row['products_id'].'&prezzo='.urlencode($row['products_price']).'">'.$row['ricerca'].'</a></td><td><img src="../'.$pictures.'" width="50px"/></td></tr>'; 
    
}
}

echo '</table></div>';
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>