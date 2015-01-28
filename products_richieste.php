<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2010 osCommerce

Released under the GNU General Public License

*/

require ('includes/application_top.php');

if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}

require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_RICHIESTE);

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_RICHIESTE, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_RICHIESTE, '', 'SSL'));

require (DIR_WS_INCLUDES . 'template_top.php');

?>

<h1><?php echo HEADING_TITLE; ?></h1>


<div class="contentContainer">
  <div> 
 <?php

$richieste_cart=" SELECT count(customer_id) as libri, sede
  FROM requests_product
 WHERE customer_id = ".$_SESSION['customer_id']." AND sessione = '".tep_session_id()."'";

$richieste_cart=tep_db_query($richieste_cart);
 
$carrello=tep_db_fetch_array($richieste_cart);
if($carrello['libri']>0){
    
echo '<h2 style="text-decoration:none !important;">Sono gia\' presenti '.$carrello['libri'].' libri nella lista<br><br><a class="other_button" href="richieste.php?azione=lista&sede='.$carrello['sede'].'">Visualizza</a> <a class="other_button" href="richieste.php?azione=citta&sede='.$carrello['sede'].'">Nuova Ricerca</a></h2><br>';

}

?>  
  </div>
  <div class="contentText">
   
<?php

$anno_from = date("Y");
$anno_to = date("Y")+1;
$anno = "BETWEEN '".$anno_from."-06-01' AND '".$anno_to."-06-01'";

if(!$_REQUEST['sede']){
    
    $_REQUEST['sede']=$_SESSION['mailsede'];
    
    }

echo '<center><h1>Cerca e richiedi il tuo testo</h1>
<div id="mylist" class="mysearch">
<form method="post" action="'. FILENAME_PRODOTTI_RICHIESTE . '?sede='.$_REQUEST['sede'].'&azione=listalibri&evento=search">
<input class="myinputbox" type="text" name="richiesta"/>
<input class="mybutton" type="button" onclick="this.form.submit();" value="Cerca" />
</form></div></center>';

if ($_REQUEST['azione'] == 'listalibri') {
    
$query_dati = mysql_query("select istituto,
tipo_istituto,
specializzazione,
dati_anagrafici_2,
citta 
FROM " . SCUOLE_SEDI . "
JOIN " . CLASSI_SEDI . " using (cod_scuola, sede)
WHERE " . SCUOLE_SEDI . ".cod_scuola = " . $_REQUEST['scuola'] . " 
AND " . CLASSI_SEDI . ".data_ult_agg ".$anno."
AND " . SCUOLE_SEDI . ".sede = " . $_REQUEST['sede'] . "");

    $nomescuola = mysql_fetch_array($query_dati);

if(!$_REQUEST['scuola']){
    
$error=true;
    
}else{
   echo "<center><h1>SEDE DI " . strtoupper($_SESSION['nomesede']) . "</h1></center><br>";
   echo "<b>ISTITUTO:</b> " . strtoupper($nomescuola['istituto']) . "</center><br>";
   echo "<b>LOCALITA' ISTITUTO:</b> " . strtoupper($nomescuola['citta']) . "</center><br>";
   echo "<b>INDIRIZZO:</b> " . strtoupper($nomescuola['dati_anagrafici_2']) . "</center><br>";
   echo "<b>TIPO ISTITUTO:</b> " . strtoupper($nomescuola['tipo_istituto']) . "</center><br>";
   echo "<b>SPECIALIZZAZIONE:</b> " . strtoupper($nomescuola['specializzazione']) . "</center><br><br>";
   
   $_SESSION['scuola'] = $_REQUEST['scuola'];
   $_SESSION['classe'] = $_REQUEST['classe'];
   $_SESSION['sezione'] = $_REQUEST['sezione'];
   $_SESSION['istituto'] = $nomescuola['istituto'];
   $_SESSION['citta'] = $nomescuola['citta'];
   $_SESSION['dati_anagrafici_2'] = $nomescuola['dati_anagrafici_2'];
   $_SESSION['tipo_istituto'] = $nomescuola['tipo_istituto'];
   $_SESSION['specializzazione'] = $nomescuola['specializzazione'];

}

$query_lista = "SELECT " . ADOZSEDI . ".anno, 
" . CATALOGO . ".cod_chiave,
" . TABLE_PRODUCTS . ".products_image,
" . TABLE_PRODUCTS . ".products_price as prezzo_nuovo_euro,
" . TABLE_PRODUCTS . ".products_used_price as prezzo_vecchio_euro, 
" . CATALOGO . ".isbn13, 
" . CATALOGO . ".titolo, 
" . CATALOGO . ".anno_edizione, 
" . CATALOGO . ".editore, 
" . ADOZSEDI . ".sede, 
" . ADOZSEDI . ".classe, 
" . ADOZSEDI . ".sezione, 
" . ADOZSEDI . ".cod_scuola
FROM " . ADOZSEDI . "
JOIN " . TABLE_PRODUCTS . " using (cod_chiave)
JOIN " . CATALOGO . " using (cod_chiave)";

if($_REQUEST['evento']=='search'){
    
$query_lista .= "WHERE CONCAT(" . CATALOGO . ".isbn13,' ',
" . CATALOGO . ".autore1,' ',
" . CATALOGO . ".autore2,' ',
" . CATALOGO . ".autore3,' ',
" . CATALOGO . ".collana,' ',
" . CATALOGO . ".cod_chiave,' ',
" . CATALOGO . ".isbn,' ',
" . CATALOGO . ".titolo,' ',
" . CATALOGO . ".anno_edizione,' ',
" . CATALOGO . ".editore) 
LIKE '%" . $_REQUEST['richiesta'] . "%'
GROUP BY titolo ORDER BY titolo ASC limit 25"; 
    
}else{
    
$query_lista .= " WHERE " . ADOZSEDI . ".sede = " . $_REQUEST['sede'] . "
AND " . ADOZSEDI . ".data_ult_agg ".$anno." 
AND " . ADOZSEDI . ".classe = '" . $_REQUEST['classe'] . "'
AND " . ADOZSEDI . ".sezione = '" . $_REQUEST['sezione'] . "'
AND " . ADOZSEDI . ".cod_scuola = " . $_REQUEST['scuola'] . "
AND " . ADOZSEDI . ".data_ult_agg ".$anno."
GROUP BY titolo ORDER BY titolo ASC";    
    
}

$query_lista = mysql_query($query_lista);

$numero_righe = mysql_num_rows($query_lista);

    $x = "'";
    $y = "\'";

if($_REQUEST['evento']=='search'){
    
    echo "<form action='" . FILENAME_PRODOTTI_RICHIESTE .
        "?azione=email&comando=aggiungi' method='post' enctype='application/x-www-form-urlencoded'>";    
    
}else{

    echo "<form action='" . FILENAME_PRODOTTI_RICHIESTE .
        "?azione=email&comando=richiedi'' method='post' enctype='application/x-www-form-urlencoded'>";

}

if ($numero_righe > 0) {

echo "<div class='roundedOne'><input type='radio' id='radio1' name='cercolibri' value='3' checked='checked'/><label for='radio1'>Nuovo o Usato</label>
    <input type='radio' id='radio2' name='cercolibri' value='2'/><label for='radio2'>Nuovi</label>
    <input type='radio' id='radio3' name='cercolibri' value='1'/><label for='radio3'>Usati</label></div><br>";

echo "<br><div class='mediagroove'><table><caption>Risultato richieste</caption><thead><tr>
    <th>Copertina</th>
    <th>ISBN</th>
    <th>Titolo</th>
    <th>Nuovo</th>
    <th>Usato</th>
    <th align='center'> Qty </th>
    <th align='center'> Sel. </th></tr></thead><tbody>";

echo "<tr><td colspan='7'>Studente Nome:<input type='text' name='nome'> Cognome:<input type='text' name='cognome'></td></tr>";
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

$pictures = file_exists(DIR_WS_ISBN . $listalibri['products_image'])? DIR_WS_ISBN . $listalibri['products_image']: DIR_WS_IMAGES . 'nopic.png';

    
$list_draw = "<tr><td>".tep_image($pictures, $listalibri['titolo'],SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT)."</td><td align='center' width='20%'>" . str_replace('ISBN: [', '', $listalibri['isbn13']) .
            "</td><td>" . strtoupper($listalibri['titolo']) .
            "</td><td align='center' width='5%'> &euro;" . number_format($listalibri['prezzo_nuovo_euro'],
            2, ',', '.') . "</td><td align='center' width='5%'> &euro;" . number_format($listalibri['prezzo_vecchio_euro'],
            2, ',', '.') . "</td><td align='center'>
            <input type='hidden' name='chiave' value='" . $listalibri['cod_chiave'] . "'>
            <input id='qty_" . $listalibri['cod_chiave'] . "' type='text' name='quantita' size='1' value='0' readonly></td><td align='center'>
            <input id='check_" . $listalibri['cod_chiave'] . "' onclick='controlla_" . $listalibri['cod_chiave'] . "();' type='checkbox' name='inserito[]' value='" . $listalibri['cod_chiave'] . "|" . $listalibri['isbn13'] . "|" .
            htmlspecialchars(str_replace($y, $x, $listalibri['titolo']), ENT_QUOTES) . "|" .
            number_format($listalibri['prezzo_nuovo_euro'],2, ',', '.') . "' ></td></tr>";   
    



echo $list_draw;



    }



    echo "</tbody><tfoot></tfoot></table></div>";

if($_REQUEST['evento']=='search'){
    
    echo "<br><div align='center'><button id='richiesta' class='other_button' disabled>Aggiungi</button></div>";    
    
}else{

    echo "<br><div align='center'><button id='richiesta' class='other_button' disabled>Richiedi</button></div>";

}


} else {
    
    echo "<center><h3>Non sono presenti libri, inserisci la tua richiesta manualmente.</h3></center>";
}
    echo "</form>";

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

$incopia = "marco@ingruppo-ict.com,$spedisce";

############################## SELEZIONO LA MAIL


    $query_cliente = mysql_query("SELECT customers_firstname, 
    customers_lastname, 
    customers_telephone, 
    customers_fax, 
    customers_email_address 
    FROM passalibroweb.customers 
    WHERE customers_id = " . $_SESSION['customer_id'] . "");

    $cliente = mysql_fetch_array($query_cliente);
    
    $nome = !$_REQUEST['nome']?$cliente['customers_firstname']:$_REQUEST['nome'];
    $cognome = !$_REQUEST['cognome']?$cliente['customers_lastname']:$_REQUEST['cognome'];
    $fisso = $cliente['customers_telephone'];
    $mobile = $cliente['customers_fax']==''?'N/D':$cliente['customers_fax'];

    $oggetto = "Nuova Richiesta Testi";
    $destinatario = $spedisce;
    $header = "From: " . $cliente['customers_email_address'] . "\n";
    $header .= "Cc: " . $incopia . "," . $cliente['customers_email_address'] . "\n";
    $header .= "BCc: " . $incopia . "\n";
    $header .= "X-Mailer: sendmail\n";

    $header .= "MIME-Version: 1.0\n";
    
    $header .= "Content-Type: text/html; charset=\"windows-1252\"\n";
    $header .= "Content-Transfer-Encoding: 7bit\n\n";

    $selezione = $_POST['inserito'];
    $quantita = $_POST['inserito'] == true? '1':'0';
    $num_row = 0;
    $cercolibri = $_POST['cercolibri'];
    
    $sql_numerazione = mysql_query("SELECT num_pren
    FROM passalibro.tmpweb order by num_pren desc limit 1");
 
    $controllo = mysql_num_rows($sql_numerazione);

    $numeratore = mysql_fetch_array($sql_numerazione);

    $num_pren = $controllo == 0?1:$numeratore['num_pren']+1;
    
    switch($_REQUEST['cercolibri']){
        case '1': $statolibri = "U";
    break;
        case '2': $statolibri = "N";
    break;
        case '3': $statolibri = "N/U";
    break;    
        
    }
    $corpo = "<html><img src='http://www.passalibro.com/images/store_logo.png'/><br><br><div class='mediagroove'><table border='1' width='100%'><caption>Dati cliente</caption>";
    $corpo .= "<tr><td>Richiesta da:</td><td>" . $nome . " " . $cognome . "</td></tr>";
    $corpo .= "<tr><td>Telefono:</td><td>" . $fisso . "</td></tr>";
    $corpo .= "<tr><td>Cellulare:</td><td>" . $mobile . "</td></tr>";
    $corpo .= "<tr><td>Istituto:</td><td>" .$_SESSION['istituto'] . "</td></tr>";
    $corpo .= "<tr><td>Classe:</td><td>" .$_SESSION['classe'] . "</td></tr>";
    $corpo .= "<tr><td>Sezione:</td><td>" .$_SESSION['sezione'] . "</td></tr>";
    $corpo .= "<tr><td>Localita:</td><td>" .$_SESSION['citta'] . "</td></tr>";
    $corpo .= "<tr><td>Indirizzo:</td><td>" .$_SESSION['dati_anagrafici_2'] . "</td></tr>";
    $corpo .= "<tr><td>Tipo istituto:</td><td>" .$_SESSION['tipo_istituto'] . "</td></tr>";
    $corpo .= "<tr><td>Specializzazione:</td><td>" .$_SESSION['specializzazione'] . "</td></tr>";
    $corpo .= "</table></div>";
    
if($_REQUEST['comando']=='richiedi'){

    $corpo .= "<div class='mediagroove'><table border='1' width='100%'><caption>Risultato richieste</caption><thead><tr>
    <th>N.Riga</th>
    <th>Tipo</th>
    <th>Quantit&agrave;</th>
    <th>Codice</th>
    <th>ISBN</th>
    <th align='left'>Descrizione</th>
    <th>Prezzo</th></tr></thead>";

}

    foreach ($selezione as $messaggio) {

        $row = (++$num_row);
        
        $corpo .= "<tr><td><center>" . $row . "</center></td>" . "<td><center>" . $statolibri . "</center></td>" . "<td><center>" . $quantita . "</center></td><td>" . str_replace('|', "</td><td>", strtoupper($messaggio)) .
            "</td></tr>";
        
        require ('products_richieste_insert.php');
    }

    



if($_REQUEST['comando']=='richiedi'){
    
    $corpo .= "</table></div></html>";
    
        $message = $corpo;

    if (@mail($destinatario, $oggetto, $message, $header)) {
        echo "<center><h1>e-mail inviata con successo!<br>Ti abbiamo inviato una mail della richiesta che puoi stampare.</h1></center><br><br>";
        echo "<font size='2'><h3>Controlla i dati che hai inviato: </h3><br>" . $corpo . "</font>";
    } else {

        echo "<center><h1>errore nell'invio dell'e-mail!</h1></center>";

    }
 
} 

if($_REQUEST['comando']=='invia'){

    
$richieste_sql="SELECT num_pren,
       cerco_libri,
       isbn,
       titolo,
       quantita,
       citta
  FROM requests_product JOIN ".TABLE_SEDI." USING(sede)
 WHERE customer_id = ".$_SESSION['customer_id']." AND sessione = '".tep_session_id()."'";
 
$richieste_sql=tep_db_query($richieste_sql);

$corpo .= '<div class="mediagroove"><table  border="1" width="100%"><thead><tr><th>Sede</td><th>Tipo</td><th>ISBN-13</th><th>Titolo</th><th>Qty</th></thead><tbody>';

while($richieste_righe=tep_db_fetch_array($richieste_sql)){

$npren=$richieste_righe['num_pren'];

if($richieste_righe['cerco_libri']=='1'){$tipo='Solo Usato';}
if($richieste_righe['cerco_libri']=='2'){$tipo='Solo Nuovo';}
if($richieste_righe['cerco_libri']=='3'){$tipo='Nuovo o Usato';}
    
$corpo .= '<tr><td>'.$richieste_righe['citta'].'</td>
<td>'.$tipo.'</td>
<td>'.$richieste_righe['isbn'].'</td>
<td>'.$richieste_righe['titolo'].'</td>
<td style="text-align: center !important;">'.$richieste_righe['quantita'].'</td></tr>';    
    
}

$corpo .= '</tbody><tfoot><caption>Richiesta N° '.$npren.'<caption></tfoot></table></div>';

$message = $corpo;
    
    if (@mail($destinatario, $oggetto, $message, $header)) {
        echo "<center><h1>e-mail inviata con successo!<br>Ti abbiamo inviato una mail della richiesta che puoi stampare.</h1></center><br><br>";
        echo "<font size='2'><h3>Controlla i dati che hai inviato: </h3><br>" . $corpo . "</font>";
    } else {

        echo "<center><h1>errore nell'invio dell'e-mail!</h1></center>";

        }
    
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