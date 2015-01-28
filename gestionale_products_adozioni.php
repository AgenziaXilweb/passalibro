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
require (DIR_WS_INCLUDES . 'ext_dbconnetc.php');

?>


<h1><?php echo HEADING_TITLE; ?></h1>

<div class="contentContainer">
  <div class="contentText">

<?php

$anno = date("Y");

#echo str_replace('.', '-', $_SERVER['SERVER_NAME']);

echo "ADOZIONI $anno";

$query_adozioni = "SELECT adozsedi.anno, 
catalogo.cod_chiave, 
SUM(magsedi.soglia_web_n) AS giacenza_nuovo, 
SUM(magsedi.soglia_web_u) AS giacenza_usato,
(catalogo.prezzo_nuovo_euro) AS products_price,
catalogo.isbn13, 
catalogo.titolo, 
catalogo.anno_edizione, 
catalogo.editore, 
adozsedi.sede, 
adozsedi.classe, 
adozsedi.sezione, 
adozsedi.cod_scuola
FROM adozsedi 
JOIN catalogo using (cod_chiave) 
JOIN magsedi using (cod_chiave)
WHERE " . ADOZSEDI . ".sede = " . $_REQUEST['sede'] . "
AND " . MAGSEDI . ".sede = " . $_REQUEST['sede'] . "
AND " . ADOZSEDI . ".classe = '" . $_REQUEST['classe'] . "'
AND " . ADOZSEDI . ".sezione = '" . $_REQUEST['sezione'] . "'
AND " . ADOZSEDI . ".cod_scuola = " . $_REQUEST['scuola'] ."
and adozsedi.anno = $anno group by adozsedi.cod_chiave";

$query_result = mysql_query($query_adozioni);


?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">

<?php
$quanti = mysql_num_rows($query_result);

echo "Trovati: " . $quanti;

while ($libri = mysql_fetch_array($query_result, MYSQL_ASSOC)) {

$prezzo_nuovo = $libri['products_price'];
$prezzo = str_replace(',','.',$prezzo_nuovo);
$prezzo_usato = str_replace('.',',',$prezzo/100*50);

               
?>
      <tr align="center" class="p_adozioni">
        <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" valign="top" class="main">
        
        <?php echo '<a href="' . tep_href_link(FILENAME_ADOZIONI_PRODOTTI,
'cod_chiave=' . $libri['cod_chiave']) . '">' . tep_image(DIR_WS_IMAGES .
'nopic.png' /*$products_new['products_image']*/, $libri['titolo'],
SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?>
        
        </td>
        <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_ADOZIONI_PRODOTTI,
'cod_chiave=' . $libri['cod_chiave']) . '"><b>' . strtoupper($libri['titolo']) .
'</b></a><br />' . TEXT_ADOZIONI_DATE_ADDED . ' ' . '<br /><br />' .
TEXT_ADOZIONI_USED_PRICE . ' &euro;. ' . $prezzo_usato . ' <br />' . TEXT_ADOZIONI_NEW_PRICE . ' &euro;. ' . $prezzo_nuovo; ?>
        </td>
        <td width="25%" class="main"><?php echo 'Disponibile Usato: ' . $libri['giacenza_usato'] . '<br />' .
'Disponibile Nuovo: ' . $libri['giacenza_nuovo'] . '<br />'; ?>
        
        </td>
        <td align="right" valign="middle" class="smallText"><?php

    if (($libri['giacenza_nuovo'] > 0) && ($libri['giacenza_usato'] > 0)) {

        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_NUOVO_IN_CART, 'cart', tep_href_link
            (FILENAME_ADOZIONI_PRODOTTI, tep_get_all_get_params(array('action')) .
            'action=buy_now_ado&cod_chiave=' . $libri['cod_chiave']));

        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_USATO_IN_CART, 'cart', tep_href_link
            (FILENAME_ADOZIONI_PRODOTTI, tep_get_all_get_params(array('action')) .
            'action=buy_used_now_ado&products_used_price=' . $prezzo_usato . '&cod_chiave=' . $libri['cod_chiave']));

    } elseif (($libri['giacenza_usato'] > 0) && ($libri['giacenza_nuovo'] <= 0)) {

        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_USATO_IN_CART, 'cart', tep_href_link
            (FILENAME_ADOZIONI_PRODOTTI, tep_get_all_get_params(array('action')) .
            'action=buy_used_now_ado&products_used_price=' . $prezzo_usato . '&cod_chiave=' . $libri['cod_chiave']));

        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_PRENOTA_IN_CART, 'cart',
            tep_href_link(FILENAME_ADOZIONI_PRODOTTI, tep_get_all_get_params(array('action')) .
            'action=buy_now_ado&cod_chiave=' . $libri['cod_chiave']));

    } elseif (($libri['giacenza_usato'] <= 0) && ($libri['giacenza_nuovo'] > 0)) {

        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_NUOVO_IN_CART, 'cart', tep_href_link
            (FILENAME_ADOZIONI_PRODOTTI, tep_get_all_get_params(array('action')) .
            'action=buy_now_ado&cod_chiave=' . $libri['cod_chiave']));

    } elseif (($libri['giacenza_usato'] <= 0) && ($libri['giacenza_nuovo'] <= 0)) {

        echo tep_draw_button(IMAGE_ADOZIONI_BUTTON_PRENOTA_IN_CART, 'cart',
            tep_href_link(FILENAME_ADOZIONI_PRODOTTI, tep_get_all_get_params(array('action')) .
            'action=buy_now_ado&cod_chiave=' . $libri['cod_chiave']));

    }

?>

</td>
      </tr>
<?php
}
?>

    </table>
</div>
</div>
<?php
require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>
