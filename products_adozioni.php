<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2010 osCommerce

Released under the GNU General Public License
*/

require ('includes/application_top.php');

require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADOZIONI_PRODOTTI);

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ADOZIONI_PRODOTTI));

require (DIR_WS_INCLUDES . 'template_top.php');

?>


<h1><?php echo HEADING_TITLE; ?></h1>

<div class="contentContainer">
  <div class="contentText">

<?php


echo '<center><h1>Cerca nelle adozioni il tuo testo</h1>
<div id="mylist" class="mysearch">
<form method="post" action="'. FILENAME_ADOZIONI_PRODOTTI . '?sede='.$_REQUEST['sede'].'&azione=search">
<input class="myinputbox" type="text" name="richiesta"/>
<input class="mybutton" type="button" onclick="this.form.submit();" value="Cerca" />
</form></div></center>';

$sede = isset($_REQUEST['sede'])?$_REQUEST['sede']:$_SESSION['sede'];

$scuola= isset($_REQUEST['scuola'])?$_REQUEST['scuola']:$_SESSION['scuola'];
$classe= isset($_REQUEST['classe'])?$_REQUEST['classe']:$_SESSION['classe'];
$sezione= isset($_REQUEST['sezione'])?$_REQUEST['sezione']:$_SESSION['sezione'];

$parametri_scuola = $sede . ":" . $scuola . ":" . $classe . ":" . $sezione;

$_SESSION['data_school'] = $parametri_scuola;

$anno_from = date("Y");
$anno_to = date("Y")+1;
$anno = "BETWEEN '".$anno_from."-06-01' AND '".$anno_to."-06-01'";

$products_new_array = array();

$products_new_query_raw = "select " . TABLE_PRODUCTS . ".products_id, 
    " . TABLE_PRODUCTS . ".products_model,
    " . TABLE_PRODUCTS . ".products_quantity as nuovo, 
    " . TABLE_PRODUCTS . ".products_used_quantity as usato,
    " . TABLE_PRODUCTS_DESCRIPTION . ".products_name,
    " . TABLE_PRODUCTS_DESCRIPTION . ".products_description,
    " . TABLE_PRODUCTS . ".products_image, 
    " . TABLE_PRODUCTS . ".products_price, 
    " . TABLE_PRODUCTS . ".products_used_price, 
    " . TABLE_PRODUCTS . ".products_tax_class_id, 
    " . TABLE_PRODUCTS . ".products_date_added 
    from " . TABLE_PRODUCTS . "
    join " . ADOZSEDI . " on " . TABLE_PRODUCTS . ".cod_chiave = " . ADOZSEDI . ".cod_chiave
    join " . TABLE_PRODUCTS_DESCRIPTION . " on " . TABLE_PRODUCTS . ".products_id = " . TABLE_PRODUCTS_DESCRIPTION . ".products_id 
    where " . ADOZSEDI . ".sede = " . $_REQUEST['sede'] . "
    and " . ADOZSEDI . ".data_ult_agg ".$anno."";
    
if($_REQUEST['azione']=='search'){
    
$products_new_query_raw .= " and CONCAT(" . TABLE_PRODUCTS . ".products_model, 
" . TABLE_PRODUCTS_DESCRIPTION . ".products_name, 
" . TABLE_PRODUCTS_DESCRIPTION . ".products_description) LIKE '%" . $_REQUEST['richiesta'] . "%'
GROUP BY " . TABLE_PRODUCTS . ".products_id,
         " . TABLE_PRODUCTS . ".products_model,
         " . TABLE_PRODUCTS . ".products_quantity,
         " . TABLE_PRODUCTS . ".products_used_quantity,
         " . TABLE_PRODUCTS_DESCRIPTION . ".products_name,
         " . TABLE_PRODUCTS_DESCRIPTION . ".products_description,
         " . TABLE_PRODUCTS . ".products_image,
         " . TABLE_PRODUCTS . ".products_price,
         " . TABLE_PRODUCTS . ".products_used_price,
         " . TABLE_PRODUCTS . ".products_tax_class_id,
         " . TABLE_PRODUCTS . ".products_date_added";  
    
}else{
    
$products_new_query_raw .= " and " . ADOZSEDI . ".cod_scuola = " . $_REQUEST['scuola'] . " 
    and " . ADOZSEDI . ".classe = " . $_REQUEST['classe'] . " 
    and " . ADOZSEDI . ".sezione = '" . $_REQUEST['sezione'] . "'";    
    
}
 
$products_new_split = new splitPageResults($products_new_query_raw,
    MAX_DISPLAY_PRODUCTS_NEW);

if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') ||
    (PREV_NEXT_BAR_LOCATION == '3'))) {
?>

    <div>
      <span style="float: right;"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->
display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page',
'info', 'x', 'y'))); ?></span>

      <span><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></span>
    </div>

    <br />

<?php
}
?>

<?php
if ($products_new_split->number_of_rows > 0) {
?>

    <div class='mediagroove'><table><caption>Risultati della ricerca</caption><thead><tr>
    <th>Copertina</th>
    <th>Descrizione del libro</th>
    <th>Prezzo</th></tr></thead><tbody>

<?php
    $products_new_query = tep_db_query($products_new_split->sql_query);
    while ($products_new = tep_db_fetch_array($products_new_query)) {
    
    $pictures = file_exists(DIR_WS_ISBN . $products_new['products_image'])? DIR_WS_ISBN . $products_new['products_image']: DIR_WS_IMAGES . 'nopic.png';    
    
        if ($new_price = tep_get_products_special_price($products_new['products_id'])) {
            $products_price = '<del>' . $currencies->display_price($products_new['products_price'],
                tep_get_tax_rate($products_new['products_tax_class_id'])) .
                '</del> <span class="productSpecialPrice">' . $currencies->display_price($new_price,
                tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span>';
            $products_used_price = '<del>' . $currencies->display_price($products_new['products_used_price'],
                tep_get_tax_rate($products_new['products_tax_class_id'])) .
                '</del> <span class="productSpecialPrice">' . $currencies->display_price($new_price,
                tep_get_tax_rate($products_new['products_tax_class_id'])) . '</span>';
        } else {
            $products_price = $currencies->display_price($products_new['products_price'],
                tep_get_tax_rate($products_new['products_tax_class_id']));
            $products_used_price = $currencies->display_price($products_new['products_used_price'],
                tep_get_tax_rate($products_new['products_tax_class_id']));
        }
?>
      <tr>
        <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" valign="top" class="main"><?php echo
'<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new['products_id'].'&parametri='.urldecode($_SESSION['data_school'])) .
'">' . tep_image($pictures, $products_new['products_name'],
SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?></td>
        <td width="100%" valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO,
'products_id=' . $products_new['products_id'].'&parametri='.urldecode($_SESSION['data_school'])) . '"><strong><u>' . $products_new['products_name'] .
'</u></strong></a><br /><br />ISBN: ' . $products_new['products_model'] . '<br/>' . TEXT_ADOZIONI_DATE_ADDED . ' ' . tep_date_long($products_new['products_date_added']) .
'<br />' . TEXT_ADOZIONI_DESCRIPTION . ' ' . $products_new['products_description']; ?></td>
        <td align="right" valign="top" class="smallText"><?php
        
################# PRIMO CONTROLLO

if (($products_new['nuovo'] > 0) && ($products_new['usato'] > 0)) {
    
        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_NUOVO_IN_CART . '<br><b>€' . str_replace('.',',',money_format('%.2n', $products_new['products_price'])) . '</b>', 'cart', str_replace('true','false',tep_href_link(FILENAME_ADOZIONI_PRODOTTI,
tep_get_all_get_params(array('action')) . 'action=buy_now&prenotato=true&parametri=' . $parametri_scuola . '&products_id=' . $products_new['products_id'])),null,null,'nuovo');

        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_USATO_IN_CART . '<br><b>€' . str_replace('.',',',money_format('%.2n', $products_new['products_used_price'])) . '</b>', 'cart', str_replace('true','false',tep_href_link(FILENAME_ADOZIONI_PRODOTTI,
tep_get_all_get_params(array('action')) . 'action=buy_used_now&prenotato=true&parametri=' . $parametri_scuola . '&products_id=' . $products_new['products_id'])),null,null,'usato');

################# SECONDO CONTROLLO

} elseif (($products_new['usato'] > 0) && ($products_new['nuovo'] <= 0)) {

        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_USATO_IN_CART . '<br><b>€' . str_replace('.',',',money_format('%.2n', $products_new['products_used_price'])) . '</b>', 'cart', str_replace('true','false',tep_href_link(FILENAME_ADOZIONI_PRODOTTI,
tep_get_all_get_params(array('action')) . 'action=buy_used_now&prenotato=true&parametri=' . $parametri_scuola . '&products_id=' . $products_new['products_id'])),null,null,'usato');

        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_PRENOTA_IN_CART . '<br><b>€' . str_replace('.',',',money_format('%.2n', $products_new['products_price'])) . '</b>', 'cart', tep_href_link(FILENAME_ADOZIONI_PRODOTTI,
tep_get_all_get_params(array('action')) . 'action=reserve_now&prenotato=true&parametri=' . $parametri_scuola . '&products_id=' . $products_new['products_id']),null,null,'prenotato');

################# TERZO CONTROLLO

} elseif (($products_new['usato'] <= 0) && ($products_new['nuovo'] > 0)) {
 
        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_NUOVO_IN_CART . '<br><b>€' . str_replace('.',',',money_format('%.2n', $products_new['products_price'])) . '</b>', 'cart', str_replace('true','false',tep_href_link(FILENAME_ADOZIONI_PRODOTTI,
tep_get_all_get_params(array('action')) . 'action=buy_now&prenotato=true&parametri=' . $parametri_scuola . '&products_id=' . $products_new['products_id'])),null,null,'nuovo');

################# QUARTO CONTROLLO

} elseif (($products_new['usato'] <= 0) && ($products_new['nuovo'] <= 0)) {

        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_PRENOTA_IN_CART . '<br><b>€' . str_replace('.',',',money_format('%.2n', $products_new['products_price'])) . '</b>', 'cart', tep_href_link(FILENAME_ADOZIONI_PRODOTTI,
tep_get_all_get_params(array('action')) . 'action=reserve_now&prenotato=true&parametri=' . $parametri_scuola . '&products_id=' . $products_new['products_id']),null,null,'prenotato');

}

?>

</td>
      </tr>
<?php
    }
?>

    </tbody></table></div>

<?php
} else {
?>

    <div>
      <?php echo TEXT_NO_NEW_PRODUCTS; ?>
    </div>

<?php
}

if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') ||
    (PREV_NEXT_BAR_LOCATION == '3'))) {
?>

    <br />

    <div>
      <span style="float: right;"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->
display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page',
'info', 'x', 'y'))); ?></span>

      <span><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></span>
    </div>

<?php
}
?>
  </div>
</div>

<?php
require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>
