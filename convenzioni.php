<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2010 osCommerce

Released under the GNU General Public License

*/

require ('includes/application_top.php');

require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONVENZIONI);

$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONVENZIONI, '', 'SSL'));

require (DIR_WS_INCLUDES . 'template_top.php');


?>

<h1><?php echo HEADING_TITLE; ?></h1>


<div class="contentContainer">
  <div>
<?php

#echo "<h2>" . MY_BOOKSTORE_DEMAND . "</h2>";

?>    
  </div>

  <div class="contentText">

<?php
########################################## SELEZIONO LA SEDE ## INIZIO CODICE

if ($_REQUEST['azione'] == '') {
    
$query_sedi = mysql_query("SELECT sede, citta FROM " . TABLE_SEDI);

    while ($result1 = mysql_fetch_array($query_sedi)) {

        echo "<div id='bgsedi'><div class='sedi'><a href='" . $_SERVER['PHP_SELF'] .
            "?sede=" . $result1['sede'] . "&azione=cerca&nomesede=" . $result1['citta'] .
            "'>" . $result1['citta'] . "</a></div></div>";

    }
    mysql_free_result($query_sedi);
}

########################################## SELEZIONO LA SCUOLA

if ($_REQUEST['azione'] == 'cerca') {
    
session_start();
     
     $nomesede = $_REQUEST['nomesede'];
     $_SESSION['nomesede'] = $nomesede;
     
     $sede = $_REQUEST['sede'];
     $_SESSION['sede'] = $sede;
    
        echo "<center><h1>SEDE DI " . strtoupper($_SESSION['nomesede']) . "</h1></center>";
        echo "<center><h3>AREA CONVENZIONI SCUOLE</h3></center>";
        echo "<center>SE LA TUA SCUOLA HA UNA CONVENZIONE SELEZIONALA DALLA LISTA</center><br>";

$query_scuole = mysql_query("SELECT *
  FROM passalibro.convenzioni pc, passalibro.scuolesedi ps
 WHERE     pc.Sede = $sede
       AND pc.Sede = ps.sede
       AND pc.Codice = ps.cod_scuola
       AND ps.web = 1");


    echo "<center><div id='richieste'><form class='selezionesedi' action='" . $_SERVER['PHP_SELF'] .
        "?azione=classi' method='post' enctype='application/x-www-form-urlencoded'>";

    echo "<input type='hidden' name='sede' value='" . $sede . "'>";

    echo "<div class='styled-select'><select name='scuola' onchange='this.form.submit();'><option>Seleziona la tua scuola...</option>";

    while ($result1 = mysql_fetch_array($query_scuole)) {

        echo "<option value=" . $result1['Codice'] . ">" . strtoupper($result1['citta'] .
            " - " . $result1['istituto'] . " - " . $result1['tipo_istituto'] . " - " . $result1['specializzazione']) .
            "</option>";

    }

    echo "</select></div></form></div></center>";
        
        echo "<center><h3>AREA CONVENZIONI ENTI/SOCIETA'/ASSOCIAZIONI</h3></center>";
        echo "<center>Se hai già ottenuto il PIN* di convenzione inseriscilo:</center>";


    echo "<center><div id='richieste'><form class='selezionesedi' method='POST' action='convenzioni.php?azione=convenzioni' enctype='application/x-www-form-urlencoded'>";

    echo "<input type='hidden' name='codsede' value='" . $_REQUEST['sede'] . "'>";

    echo "<div class='styled-select'>
    <input size='4' type='text' name='codscuola'>
    <input type='submit' value='Avanti'></div></div></form></center>";

    echo "<center>*Lunghezza massima 4 caratteri</center><br>";    

}   

########################################## SELEZIONO LA CLASSE

if ($_REQUEST['azione'] == 'convenzioni') {

echo "<center><h1>SEDE DI " . strtoupper($_SESSION['nomesede']) . "</h1></center><br>";

$codsede = $_REQUEST['codsede'];
$codscuola = $_REQUEST['codscuola'];

$sql = mysql_query("SELECT * FROM " . CONVENZIONI . " WHERE `Sede` = $codsede AND `Codice` = '$codscuola' ");


while ($nomescuola = mysql_fetch_array($sql)) {
    

echo "<center><h1>Benvenuto - " . strtoupper($nomescuola['Descrizione']) . "</h1></center>";    
echo "<center><h1><a href='convenzioni.php?azione=classi&sede=".(int)$nomescuola['Sede']."&scuola=".(int)$nomescuola['Codice']."'>Clicca</a></h1></center>";
session_start();

$_SESSION['convenzione'] = $nomescuola['Descrizione'];
   
    }
    mysql_free_result($sql);
}

########################################## SELEZIONO LA SEZIONE

if ($_REQUEST['azione'] == 'classi') {
    

$query_dati = mysql_query("select istituto,
tipo_istituto,
specializzazione,
citta 
FROM " . SCUOLE_SEDI . " 
WHERE cod_scuola = " . $_REQUEST['scuola'] . " and scuolesedi.convenzione = True");

    $nomescuola = mysql_fetch_array($query_dati);

    $_SESSION['istituto'] = $nomescuola['istituto'];
    $_SESSION['tipo_istituto'] = $nomescuola['tipo_istituto'];
    $_SESSION['specializzazione'] = $nomescuola['specializzazione'];
    $_SESSION['citta'] = $nomescuola['citta'];

   echo "<center><h1>SEDE DI " . strtoupper($_SESSION['nomesede']) . "</h1></center><br>";
   echo "<center><b>ISTITUTO:</b> " . strtoupper($_SESSION['istituto']) . "</center>";
   echo "<center><b>LOCALITA' ISTITUTO:</b> " . strtoupper($_SESSION['citta']) . "</center><br>";
   echo "<center><b>TIPO ISTITUTO:</b> " . strtoupper($_SESSION['tipo_istituto']) . "</center><br>";
   echo "<center><b>SPECIALIZZAZIONE:</b> " . strtoupper($_SESSION['specializzazione']) . "</center><br><br>";

$query_classi = mysql_query("select classe
FROM " . ADOZSEDI . " 
WHERE sede = " . $sede . "
AND cod_scuola = " . $_REQUEST['scuola'] . "
AND anno = " . date("Y") . "
group by classe");


    echo "<div id='richieste'><center><form class='selezionesedi' action='" . $_SERVER['PHP_SELF'] .
        "?azione=sezioni' method='post' enctype='application/x-www-form-urlencoded'>";

    echo "<input type='hidden' name='sede' value='" . $sede . "'>";
    echo "<input type='hidden' name='scuola' value='" . $_REQUEST['scuola'] . "'>";

    echo "<div class='styled-select'><select name='classe' onchange='this.form.submit();'><option>Seleziona la tua sezione...</option>";

    while ($result2 = mysql_fetch_array($query_classi)) {

        echo "<option value=" . $result2['classe'] . ">" . strtoupper($result2['classe']) .
            "</option>";

    }

    echo "</select></div></form></center></div>";
    mysql_free_result($query_classi);


}


if ($_REQUEST['azione'] == 'sezioni') {
    
   echo "<center><h1>SEDE DI " . strtoupper($_SESSION['nomesede']) . "</h1></center><br>";
   echo "<center><b>ISTITUTO:</b> " . strtoupper($_SESSION['istituto']) . "</center>";
   echo "<center><b>LOCALITA' ISTITUTO:</b> " . strtoupper($_SESSION['citta']) . "</center><br>";
   echo "<center><b>TIPO ISTITUTO:</b> " . strtoupper($_SESSION['tipo_istituto']) . "</center><br>";
   echo "<center><b>SPECIALIZZAZIONE:</b> " . strtoupper($_SESSION['specializzazione']) . "</center><br><br>";
    
$query_sezioni = mysql_query("select sezione 
FROM " . ADOZSEDI . "
where sede = " . $sede . "
AND cod_scuola = " . $_REQUEST['scuola'] . "
AND classe = " . $_REQUEST['classe'] . "
AND anno = " . date("Y") . "
group by sezione");

    echo "<div id='richieste'><center><form class='selezionesedi' action='" . FILENAME_PRODOTTI_CONVENZIONI .
        "?azione=listalibri' method='post' enctype='application/x-www-form-urlencoded'>";

    echo "<input type='hidden' name='sede' value='" . $sede . "'>";
    echo "<input type='hidden' name='classe' value='" . $_REQUEST['classe'] . "'>";
    echo "<input type='hidden' name='scuola' value='" . $_REQUEST['scuola'] . "'>";

    echo "<div class='styled-select'><select name='sezione' onchange='this.form.submit();'><option>Seleziona la tua sezione...</option>";

    while ($result3 = mysql_fetch_array($query_sezioni)) {

        echo "<option value=" . $result3['sezione'] . ">" . strtoupper($result3['sezione']) .
            "</option>";

    }

    echo "</select></div></form></center></div>";

    mysql_free_result($query_sezioni);
}


# FINE CODICE


?>

  </div>
</div>

<?php

require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');

?>