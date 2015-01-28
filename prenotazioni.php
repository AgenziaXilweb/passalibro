<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2010 osCommerce

Released under the GNU General Public License

*/

require ('includes/application_top.php');

require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADOZIONI);

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ADOZIONI, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ADOZIONI, '', 'SSL'));

require (DIR_WS_INCLUDES . 'template_top.php');

?>


<?php

$anno_precedente=date("Y")-1;
$anno = date("Y");

$periodo = "data_prenotazione BETWEEN '".$anno_precedente."-01-01' and '".$anno."-12-31'"; 


$sql_reserved = tep_db_query("SELECT * FROM " . PRENOTAZIONI .
    " WHERE ".$periodo." AND cod_cliente = '" . $_POST['cliente_id'] . "' AND sede='" . $_POST['sede'] .
    "' ORDER BY data_pren DESC");

echo '<div class="mediagroove"><table><caption>Controllo Prenotazioni</caption><thead><tr>
		<th><strong>Data Prenotazione</strong></th>
		<th><strong>ISBN-13</strong></th>
        <th><strong>Titolo</strong></th>
		<th><strong>Stato</strong></th>
		<th><strong>Qtà Richiesta</strong></th>
		<th><strong>Qtà Evasa</strong></th>
		</tr></thead><tbody>';


while ($prenotazione = tep_db_fetch_array($sql_reserved)) {

    $annullato = $prenotazione['qta_originale'] == 0 ?
        '<b><font color="red">Annullato</font></b>' :
        '<b><font color="green">In Arrivo</font></b>';

    $status = isset($prenotazione['data_arrivo']) && $prenotazione['qta_originale'] == $prenotazione['qta_arrivata'] ? '<b>Arrivato</b>' : $annullato;

    echo '<tr><td width="20%">' . $prenotazione['data_pren'] . '</td>
		<td width="5%">' . $prenotazione['isbn13'] . '</td>
		<td width="40%">' . strtoupper($prenotazione['titolo']) . '</td>
		<td width="10%">' . $status . '</td>
		<td width="5%">' . $prenotazione['qta_originale'] . '</td>
		<td width="5%">' . $prenotazione['qta_arrivata'] . '</td>
		</tr>';

}

echo '</tbody><tfoot></tfoot></table></div><br><br>';

?>

<?php

require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>