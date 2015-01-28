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

require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_LIST_BOOKS);

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_HISTORY, '',
    'SSL'));

require (DIR_WS_INCLUDES . 'template_top.php');


?>

<h1><?php echo HEADING_TITLE; ?></h1>

<?php



?>
<div class="contentContainer">
  <div>
    <h2><?php echo MY_LISTBOOKS_TITLE; ?></h2>
  </div>

  <div class="contentText">
  
<?php # RICHIAMO I DATI UTENTE

$cliente = tep_session_is_registered('customer_id');

$utente = "SELECT * FROM " . TABLE_CUSTOMERS . " WHERE customers_id=" . $cliente;

$record = tep_db_query($utente);

$userid = mysql_fetch_array($record);

echo "<b>Nome Scuola:</b>    " . $userid['customers_code_school'] . "<br>";


?>

<?php # TESTATA LISTA PRODOTTI ?>

<div class="ui-widget-header ui-corner-top infoBoxHeading">
    <table width="100%" cellspacing="0" cellpadding="2" border="0" class="productListingHeader">
          <tbody><tr>
                  <td align="center"></td>
                                  <th align="left" width="25%">Copertina Libro</th>
                                  <th align="center" width="25%">Nome prodotto</th>
                                  <th align="right" width="25%">Prezzo</th>
                                  <th align="center" width="25%">Acquista adesso</th>
              </tr>
                  </tbody></table>
                    </div>
<div class="ui-widget-content ui-corner-bottom productListTable">
<table width="100%" cellspacing="0" cellpadding="2" border="0" class="productListingData">


<?php # FINE TESTATA PRODOTTI ?>

<?php # INIZIO LISTA LIBRI

list($cod_min, $istit, $specfull,$citta )=explode('-',$userid['customers_code_school'],4);
            
            $query="select sede, cod_scuola from ".SCUOLE_SEDI." where 1=1
                    and upper(codice_ministeriale)='$cod_min'
                    and istituto = '$istit'
                    and specializzazione_full='$specfull'
                    and upper(citta)='$citta'";
            $prepare_indirizzo=mysql_query($query);
            $indirizzo=mysql_fetch_array($prepare_indirizzo, MYSQL_ASSOC);
            mysql_free_result($prepare_indirizzo);
            
            $query="SELECT classe, sezione
                     FROM ".SCUOLE_SEDI
                 ." JOIN ".CLASSI_SEDI." USING (cod_scuola)
                    WHERE
                    cod_scuola = ".$indirizzo['cod_scuola']." AND
                    anno = extract(YEAR FROM sysdate()) - 1 AND
                    scuolesedi.sede = classisedi.sede AND
                    scuolesedi.sede = ".$indirizzo['sede'];
            $prepare_classe=mysql_query($query);
            
$sql_lista = "SELECT * FROM passalibro.sedi WHERE sede = " . $indirizzo['sede'];

$disponibile = tep_db_query($sql_lista);

$sede = mysql_fetch_array($disponibile);


$richiesta = "SELECT * FROM " . CATALOGO . " AS libri JOIN " . SCUOLE_SEDI .
    " AS scuole JOIN " . ADOZSEDI .
    " AS adozioni on scuole.cod_scuola = adozioni.cod_scuola WHERE scuole.codice_ministeriale = '" .
    $cod_min . "' And adozioni.anno = '2011' and libri.cod_chiave = adozioni.cod_chiave and adozioni.classe = '" .
    $userid['customers_class_school'] . "' and adozioni.sezione = '" . 
    $userid['customers_section_school'] . "' and scuole.istituto = '" . 
    $istit . "' and scuole.sede = '" . 
    $indirizzo['sede'] . "'";

$lista = tep_db_query($richiesta);


while ($libro = mysql_fetch_array($lista, MYSQL_ASSOC)) {

?>   
<tbody><tr>
<td align="center"><a href="#">
<img width="100" height="80" title="<?php echo $libro['titolo']; ?>" alt="<?php echo
$libro['titolo']; ?>" src="images/nopic.png"></a></td>        
<td><a href="#"><?php echo strtoupper($libro['titolo']); ?><br />SEDE: <?php echo $sede['citta']; ?><br />QUANTITA: 0</a></td>        
<td align="right">NUOVO: <?php echo $libro['prezzo_nuovo_euro']; ?><br />USATO: <?php echo $libro['prezzo_vecchio_euro']; ?></td>        
<td align="center"><span class=""><a href="#" id="tdb5" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-priority-secondary" role="button" aria-disabled="false"><span class="ui-button-icon-primary ui-icon ui-icon-cart"></span>
<span class="ui-button-text">PRENOTA ORA</span></a>
</span><script type="text/javascript">$("#tdb5").button({icons:{primary:"ui-icon-cart"}}).addClass("ui-priority-secondary").parent().removeClass("tdbLink");</script></td>

  
  
  
<?php

}

?>
</tr>
</tbody></table>
</div>

<?php # FINE LISTA LIBRI ?>

 
  </div>
</div>

</form>


<?php

require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>