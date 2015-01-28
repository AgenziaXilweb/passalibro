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

<?

?>
<div class="contentContainer">
  <div>
    <h2><?php echo MY_BOOKSTORE; ?></h2>
  </div>

  <div class="contentText">
  
<?php

# RICHIAMO I DATI SEDE

$anno = date("Y");

if ($_REQUEST['azione'] == '') {

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

    
$query_scuole = mysql_query("SELECT " . SCUOLE_SEDI . ".cod_scuola, 
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
    ORDER BY " . SCUOLE_SEDI . ".dati_anagrafici_2 DESC");

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


?>

  </div>
</div>


<?php

require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>