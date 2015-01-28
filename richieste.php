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

# RICHIAMO I DATI SEDE

$anno = date("Y");

if ($_REQUEST['azione'] == '') {

echo '<h2 style="text-decoration:none;">Se la città della tua scuola non compare, puoi comunque creare la richiesta dei tuoi testi attraverso il campo di ricerca, selezionando la libreria a te più comoda per il ritiro.</h2>';

    $query_sedi = mysql_query("SELECT sede, citta FROM ". TABLE_SEDI);


    # INIZIO LISTA SEDI

    while ($libreria = mysql_fetch_array($query_sedi)) {
        
        echo "<div id='bgsedi'><div class='sedi'><a href=" . FILENAME_RICHIESTE . "?nomesede=" .
            strtoupper(str_replace(' ', '+', $libreria['citta'])) . "&sede=" . $libreria['sede'] .
            "&azione=citta >" . $libreria['citta'] . "</a></div></div>";

    }
}
# FINE LISTA SEDI

# INIZIO LISTA CITTA

if ($_REQUEST['azione'] == 'citta') {
tep_session_recreate();

    echo "<div class='mediagroove'><table><caption>" .
        $_REQUEST['nomesede'] . "</caption><thead><tr><th></th><th></th><th></th></tr></thead>\n";

    $i = 0;

$query_paesi = mysql_query("SELECT " . SCUOLE_SEDI . ".citta, " . SCUOLE_SEDI . ".sede
FROM " . CLASSI_SEDI . "
JOIN " . SCUOLE_SEDI . " using(cod_scuola, sede)
WHERE " . CLASSI_SEDI . ".sede = " . $_REQUEST['sede'] . "
AND " . CLASSI_SEDI . ".anno = '$anno' 
AND " . SCUOLE_SEDI . ".web = True
AND " . SCUOLE_SEDI . ".citta <> ''
GROUP BY " . SCUOLE_SEDI . ".citta ORDER BY " . SCUOLE_SEDI . ".citta");

echo '<center><h1>Cerca e richiedi il tuo testo</h1>
<div id="mylist" class="mysearch">
<form method="post" action="'. FILENAME_PRODOTTI_RICHIESTE . '?sede='.$_REQUEST['sede'].'&azione=listalibri&evento=search">
<input class="myinputbox" type="text" name="richiesta"/>
<input class="mybutton" type="button" onclick="this.form.submit();" value="Cerca" />
</form></div></center>';

    while ($istituto = mysql_fetch_array($query_paesi)) {

        if ($i++ % 3 == 0)
            echo "<tr>\n";
        echo "<td valign='top' width='33%'><a href=" . FILENAME_RICHIESTE .
            "?azione=scuole&sede=" . $istituto['sede'] . "&citta=" . str_replace(' ',
            '+', $istituto['citta']) . ">" . strtoupper($istituto['citta']) . "</a></td>";
        if ($i % 3 == 0)
            echo "</tr>\n";
    }

    if ($i % 3) {
        while ($i++ % 3 != 0)
            echo "<td></td>\n";
        echo "</tr>\n";
    }
    echo "</table></div>\n";

}

# FINE LISTA CITTA

# INIZIO LISTA SCUOLE

if ($_REQUEST['azione'] == 'scuole') {

$query_sede = mysql_query("SELECT sede, citta FROM " . TABLE_SEDI .
        " WHERE sede = " . $_REQUEST['sede']);

$nomesede = mysql_fetch_array($query_sede);

    echo "<div class='mediagroove'><table><caption>" .
        strtoupper($nomesede['citta']) . "</caption><thead><tr><th></th><th></th><th></th></tr></thead>\n";

    
$query_scuole = "SELECT " . SCUOLE_SEDI . ".cod_scuola, 
    " . SCUOLE_SEDI . ".specializzazione, 
    " . SCUOLE_SEDI . ".istituto, 
    " . SCUOLE_SEDI . ".tipo_istituto, 
    " . SCUOLE_SEDI . ".citta, 
    " . SCUOLE_SEDI . ".dati_anagrafici_2 
    FROM " . SCUOLE_SEDI . "
    JOIN " . CLASSI_SEDI . " using(cod_scuola, sede)
    WHERE " . SCUOLE_SEDI . ".sede = " . $_REQUEST['sede'] . "
    AND " . SCUOLE_SEDI . ".citta = '" . $_REQUEST['citta'] . "'
    AND " . CLASSI_SEDI . ".anno = '$anno'
    AND " . SCUOLE_SEDI . ".web = True
GROUP BY " . SCUOLE_SEDI . ".cod_scuola, " . SCUOLE_SEDI . ".specializzazione, " . SCUOLE_SEDI . ".istituto, " . SCUOLE_SEDI . ".tipo_istituto, " . SCUOLE_SEDI . ".citta, " . SCUOLE_SEDI . ".dati_anagrafici_2
    ORDER BY " . SCUOLE_SEDI . ".dati_anagrafici_2 DESC";
    
$query_scuole = mysql_query($query_scuole);

    $i = 0;

    while ($istituto = mysql_fetch_array($query_scuole)) {

        if ($i++ % 3 == 0)
            echo "<tr>\n";
        echo "<td valign='top' width='33%'><font color='red''><b>" . strtoupper($istituto['citta']) .
            "</b></font><br><a href=" . FILENAME_RICHIESTE . "?azione=classisedi" .
            "&sede=" . $_REQUEST['sede'] . "&scuola=" . $istituto['cod_scuola'] .
            "&nomescuola=" . str_replace(' ', '+', $istituto['istituto']) . str_replace(' ',
            '%20', ' - ' . $istituto['specializzazione']) . "><b>" . strtoupper($istituto['istituto']) .
            "</b><br>" . strtoupper($istituto['tipo_istituto']) . "<br>" . strtoupper($istituto['specializzazione']) .
            "<br>" . strtoupper($istituto['dati_anagrafici_2']) . "</a></td>";
        if ($i % 3 == 0)
            echo "</tr>\n";
    }

    if ($i % 3) {
        while ($i++ % 3 != 0)
            echo "<td>&nbsp;</td>\n";
        echo "</tr>\n";
    }
    echo "</tbody></table></div>\n";

}

# LISTA DELLE CALSSI E SEZIONI

if ($_REQUEST['azione'] == 'classisedi') {


$query_sede = mysql_query("SELECT sede, citta FROM " . TABLE_SEDI .
        " WHERE sede = " . $_REQUEST['sede']);
        
$nomesede = mysql_fetch_array($query_sede);

    echo "<div class='mediagroove'><table><caption>" .
        strtoupper($nomesede['citta']) . "</caption><thead><tr><th></th><th></th><th></th></tr></thead>\n";
        
    $_SESSION['nomesede'] = $nomesede['citta'];

$query_scuola = mysql_query("SELECT " . SCUOLE_SEDI . ".citta, " . SCUOLE_SEDI . ".cod_scuola  
    FROM " . SCUOLE_SEDI . "
    JOIN " . CLASSI_SEDI . " using(cod_scuola, sede)
    WHERE " . SCUOLE_SEDI . ".sede = " . $_REQUEST['sede'] . "
    AND " . SCUOLE_SEDI . ".web = True
    AND " . CLASSI_SEDI . ".anno = '$anno' 
    AND " . SCUOLE_SEDI . ".cod_scuola = " . $_REQUEST['scuola'] . "");

$nomescuola = mysql_fetch_array($query_scuola);

    echo "<table cellpadding='5' width='100%'><tr><td colspan='3'><font size='2'><b>" .
        strtoupper($_REQUEST['nomescuola']) . " - " . strtoupper($nomescuola['citta']) .
        "</b></font></td></tr>\n";

     
$query_classi = mysql_query("SELECT * 
    FROM " . CLASSI_SEDI . " 
    WHERE sede = " . $_REQUEST['sede'] . " 
    AND cod_scuola = " . $_REQUEST['scuola'] . "
    AND anno = '$anno'");

    $i = 0;

    while ($istituto = mysql_fetch_array($query_classi)) {

        if ($i++ % 3 == 0)
            echo "<tr>\n";

        echo "<td valign='top' width='33%'><a href=" . FILENAME_PRODOTTI_RICHIESTE .
            "?sede=" . $_REQUEST['sede'] . "&classe=" . $istituto['classe'] . "&azione=listalibri&sezione=" .
            $istituto['sezione'] . "&scuola=" . $istituto['cod_scuola'] . ">" . strtoupper($istituto['classe']),
            strtoupper($istituto['sezione']) . "</a></td>";
        if ($i % 3 == 0)
            echo "</tr>\n";
    }

    if ($i % 3) {
        while ($i++ % 3 != 0)
            echo "<td>&nbsp;</td>\n";
        echo "</tr>\n";
    }
    echo "</table></div>\n";

}

if ($_REQUEST['azione'] == 'lista') {
 
$richieste_cart=" SELECT count(customer_id) as libri
  FROM requests_product
 WHERE customer_id = ".$_SESSION['customer_id']." AND sessione = '".tep_session_id()."'";

$richieste_cart=tep_db_query($richieste_cart);
 
$carrello=tep_db_fetch_array($richieste_cart);
if($carrello['libri']>0){

$richieste_sql="SELECT num_pren,
       cerco_libri,
       isbn,
       titolo,
       quantita,
       citta
  FROM requests_product JOIN ".TABLE_SEDI." USING(sede)
 WHERE customer_id = ".$_SESSION['customer_id']." AND sessione = '".tep_session_id()."'";
 
$richieste_sql=tep_db_query($richieste_sql);

echo '<div class="mediagroove"><table width="100%"><thead><tr><th>Sede</td><th>Tipo</td><th>ISBN-13</th><th>Titolo</th><th>Qty</th></thead><tbody>';

while($richieste_righe=tep_db_fetch_array($richieste_sql)){

$npren=$richieste_righe['num_pren'];

if($richieste_righe['cerco_libri']=='1'){$tipo='Solo Usato';}
if($richieste_righe['cerco_libri']=='2'){$tipo='Solo Nuovo';}
if($richieste_righe['cerco_libri']=='3'){$tipo='Nuovo o Usato';}
    
echo '<tr><td>'.$richieste_righe['citta'].'</td>
<td>'.$tipo.'</td>
<td>'.$richieste_righe['isbn'].'</td>
<td>'.$richieste_righe['titolo'].'</td>
<td style="text-align: center !important;">'.$richieste_righe['quantita'].'</td></tr>';    
    
}

echo '</tbody><caption><h1>Prenotazione N° '.$npren.'</h1></caption></table></div>';

echo '<br><center><a class="other_button" href="products_richieste.php?azione=email&comando=invia">Invia un email al tuo indirizzo e stampa</a></center>';

}   
    
}


?>

  </div>
</div>


<?php

require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>