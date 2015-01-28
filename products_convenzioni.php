<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com
54
Copyright (c) 2010 osCommerce

Released under the GNU General Public License

*/

require ('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONVENZIONI);

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONVENZIONI, '', 'SSL'));

require (DIR_WS_INCLUDES . 'template_top.php');

?>

<h1><?php echo HEADING_TITLE; ?></h1>


<div class="contentContainer">
  <div>
<?php

#echo "<h2>" . MY_BOOKSTORE_DEMAND . "</h2>";

#require (DIR_WS_INCLUDES . 'actions/demands.php');


?>
  </div>

  <div class="contentText">



<?php

if ($_REQUEST['azione'] == 'listalibri') {

    echo "<center><h1>SEDE DI " . strtoupper($_SESSION['nomesede']) .
        "</h1></center><br>";
    echo "<center><b>ISTITUTO:</b> " . strtoupper($_SESSION['istituto']) .
        "</center>";
    echo "<center><b>LOCALITA' ISTITUTO:</b> " . strtoupper($_SESSION['citta']) .
        "</center><br>";
    echo "<center><b>TIPO ISTITUTO:</b> " . strtoupper($_SESSION['tipo_istituto']) .
        "</center><br>";
    echo "<center><b>SPECIALIZZAZIONE:</b> " . strtoupper($_SESSION['specializzazione']) .
        "</center><br><br>";

$anno_from = date("Y");
$anno_to = date("Y")+1;
$anno = "BETWEEN '".$anno_from."-06-01' AND '".$anno_to."-06-01'";

$query_lista = mysql_query("SELECT " . ADOZSEDI . ".anno,
" . CATALOGO . ".cod_chiave,
" . CATALOGO . ".prezzo_nuovo_euro,
" . CATALOGO . ".isbn13,
" . CATALOGO . ".titolo,
" . CATALOGO . ".anno_edizione,
" . CATALOGO . ".editore,
" . ADOZSEDI . ".sede,
" . ADOZSEDI . ".classe,
" . ADOZSEDI . ".sezione,
" . ADOZSEDI . ".cod_scuola
FROM " . ADOZSEDI . "
JOIN " . CATALOGO . " using (cod_chiave)
WHERE " . ADOZSEDI . ".sede = " . $_REQUEST['sede'] . "
AND " . ADOZSEDI . ".classe = '" . $_REQUEST['classe'] . "'
AND " . ADOZSEDI . ".sezione = '" . $_REQUEST['sezione'] . "'
AND " . ADOZSEDI . ".cod_scuola = " . $_REQUEST['scuola'] . "
AND " . ADOZSEDI . ".data_ult_agg ".$anno."");

    $x = "'";
    $y = "\'";

    echo "<form action='" . FILENAME_PRODOTTI_CONVENZIONI .
        "?azione=email' method='post' enctype='application/x-www-form-urlencoded'>";

    echo "<br><table id='listarichieste'><tr>
    <th>Codice ISBN</b></th>
    <th><b>Titolo</b></th>
    <th>Prezzo Nuovo</th>
    <th align='center'>Qty</th>
    <th align='center'>Sel.</th></tr>";

    while ($listalibri = mysql_fetch_array($query_lista)) {

?>

<script type="text/javascript" language="JavaScript">
<!--
function controlla_<?php echo $listalibri['cod_chiave'];?>() {

var richiesta = document.getElementById("richiesta"),i;
var test = document.getElementById("check_<?php echo $listalibri['cod_chiave'];?>"),i;
var quantita = document.getElementById("qty_<?php echo $listalibri['cod_chiave'];?>"),i;

    if(test.checked == true) {
        
     quantita.value = 1;
     richiesta.disabled = false
         
} else {
     quantita.value = 0;
     richiesta.disabled = true
     }
}

//-->
</script>



<?php

        echo "<tr><td align='center' width='20%'>" . str_replace('ISBN: [', '', $listalibri['isbn13']) .
            "</td><td>" . strtoupper($listalibri['titolo']) .
            "</td><td align='center' width='10%'> &euro;" . number_format($listalibri['prezzo_nuovo_euro'],
            2, ',', '.') . "</td><td align='center'>
            <input type='hidden' name='chiave' value='" .
            $listalibri['cod_chiave'] . "'>
            <input id='qty_" . $listalibri['cod_chiave'] . "' type='text' name='quantita' size='1' value='0' readonly></td>
            <td align='center'><input id='check_" . $listalibri['cod_chiave'] . "' onclick='controlla_" . $listalibri['cod_chiave'] . "();' type='checkbox' name='inserito[]' value='" . $listalibri['cod_chiave'] . "|" . $listalibri['isbn13'] . "|" .
            htmlspecialchars(str_replace($y, $x, $listalibri['titolo']), ENT_QUOTES) . "|" .
            number_format($listalibri['prezzo_nuovo_euro'],2, ',', '.') . "' ></td></tr>";


    }

    echo "</table>";

    echo "<br><div align='center'><input id='richiesta' value='Richiedi' class='other_button' type='button' onclick='this.form.submit()' disabled/></div>
    </form>";



    session_start();

    $mailsede = $_REQUEST['sede'];
    $_SESSION['mailsede'] = $mailsede;

    mysql_free_result($query_lista);

}


############################## INZIO LA MAIL ALLA SEDE

if ($_REQUEST['azione'] == 'email') {


$query_casella = mysql_query("SELECT email FROM parametri_banche WHERE sede = " .
        $_SESSION['mailsede'] . "");

$mailfrom = mysql_fetch_array($query_casella);

$spedisce = $mailfrom['email'];

$incopia = "info@agenziaperilweb.it,$spedisce";

############################## SELEZIONO LA MAIL


    $query_cliente = mysql_query("SELECT customers_firstname, 
    customers_lastname, 
    customers_telephone, 
    customers_fax, 
    customers_email_address 
    FROM " . TABLE_CUSTOMERS . " 
    WHERE customers_id = " . $_SESSION['customer_id'] . "");

    $cliente = mysql_fetch_array($query_cliente);
    
    $nome = $cliente['customers_firstname'];
    $cognome = $cliente['customers_lastname'];
    $fisso = $cliente['customers_telephone'];
    $mobile = $cliente['customers_fax'];

    $oggetto = "Area Convenzioni - Richesta Testi";
    $destinatario = $spedisce;
    $header = "From: " . $cliente['customers_email_address'] . "\n";
    $header .= "Cc: " . $incopia . "," . $cliente['customers_email_address'] . "\n";
    $header .= "BCc: " . $incopia . "\n";
    $header .= "X-Mailer: sendmail\n";

    $header .= "MIME-Version: 1.0\n";
    $header .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
    $header .= "Content-Transfer-Encoding: 7bit\n\n";

    $selezione = $_REQUEST['inserito'];
    
    $corpo = "Richiesta da: " . $nome . " " . $cognome . "<br>";
    $corpo .= "Telefono: " . $fisso . "<br>";
    $corpo .= "Cellulare: " . $mobile . "<br>";
          
    $corpo .= "<table width='100%'><tr>
    <td><b>Codice</b></td>
    <td><b>ISBN</b></td>
    <td><b>Descrizione</b></td>
    <td><b>Prezzo Euro</b></td></tr>";

    foreach ($selezione as $messaggio) {

        $corpo .= "<tr><td>" . str_replace('|', "</td><td>", strtoupper($messaggio)) .
            "</td></tr>";

    }

    $corpo .= "</table>";

    $message = $corpo;

    if (@mail($destinatario, $oggetto, $message, $header)) {
        echo "<center><h1>e-mail inviata con successo!</h1><br>";

   } else {

        echo "<center><h1>errore nell'invio dell'e-mail!</h1></center>";

}
}

mysql_close();

# FINE CODICE


?>

  </div>
</div>


<?php

require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');

?>
