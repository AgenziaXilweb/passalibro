


<?php

require ('includes/application_top.php');
require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);
require (DIR_WS_INCLUDES . 'template_top.php');
tep_db_connect();
?>

<div class="contentContainer">
  <div>
    <div class="inputRequirement" style="float: right;"></div>

    <h2><?php echo MY_BOOKS_SCHOOL; ?></h2>
  </div>

  <div class="contentText">

<?php

$query = "SELECT
  DISTINCT (codice_ministeriale),
          REPLACE(CONCAT(
             '['
            ,codice_ministeriale
            ,']-'
            ,UPPER(istituto)
            ,'-'
            ,specializzazione_full
            ,'-'
            ,UPPER(citta)), '\"', '')
             AS scuole
FROM " . SCUOLE_SEDI;
$prepare_scuole = mysql_query($query);
?>
<script>
	$(function() {
		var availableTags = [<?php while ($scuola = mysql_fetch_array($prepare_scuole,
MYSQL_ASSOC)) {
    echo "\"" . $scuola['scuole'] . "\"," . "\n";
} ?>
			
		];
		$( "#tags" ).autocomplete({
			source: availableTags
		});
	});
	</script>
<?php mysql_free_result($prepare_scuole); ?>
<div class="demo" align="center">
 <div class="ui-widget">
  <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="get" enctype="application/x-www-form-urlencoded">
	<input id="tags" size="80" name="Istituto"/><?php echo tep_draw_button(IMAGE_BUTTON_SEARCH,
'search', null, null, 'submit'); ?><br />    
    Inserisci il NOME della scuola, il [CODICE MINISTERIALE] oppure la CITTA'.<br />
    
    <?
if (isset($_GET['Istituto']) && !empty($_GET['Istituto'])) {
    echo "SELEZIONA CLASSE E SEZIONE<br />";
    list($cod_min, $istit, $specfull, $citta) = explode('-', $_GET['Istituto']);
    $cod_min = str_replace(array('[', ']'), "", $cod_min);
    $query = "select sede, cod_scuola from " . SCUOLE_SEDI . " where 1=1
                    and upper(codice_ministeriale)='$cod_min'
                    and istituto = '$istit'
                    and specializzazione_full='$specfull'
                    and upper(citta)='$citta'";
    $prepare_indirizzo = mysql_query($query);
    $indirizzo = mysql_fetch_array($prepare_indirizzo, MYSQL_ASSOC);
    mysql_free_result($prepare_indirizzo);

    $query = "SELECT classe, sezione
                     FROM " . SCUOLE_SEDI . " JOIN " . CLASSI_SEDI .
        " USING (cod_scuola)
                    WHERE
                    cod_scuola = " . $indirizzo['cod_scuola'] . " AND
                    anno = extract(YEAR FROM sysdate()) - 1 AND
                    scuolesedi.sede = classisedi.sede AND
                    scuolesedi.sede = " . $indirizzo['sede'];
    $prepare_classe = mysql_query($query);
    echo '<div class="ui-widget-header ui-corner-top infoBoxHeading">
    <table width="100%" cellspacing="0" cellpadding="2" border="0" class="productListingHeader">
          <tbody><tr>
                  <th align="left" width="25%">Seleziona la classe</th>
                </tr>
                  </tbody></table>
                    </div>
                    <div class="ui-widget-content ui-corner-bottom productListTable">
<table width="100%" cellspacing="0" cellpadding="2" border="0" class="productListingData">';


    while ($classe = mysql_fetch_array($prepare_classe, MYSQL_ASSOC)) {
        echo '<tr><td align="left">';
        echo "<a href=\"" . FILENAME_ADOZIONI_PRODOTTI . "?scuola=" . $indirizzo['cod_scuola'] .
            "&sede=" . $indirizzo['sede'] . "&classe=" . $classe['classe'] . "&sezione=" . $classe['sezione'] .
            "\">" . $classe['classe'] . strtoupper($classe['sezione']) . "</a><br />";
        echo '</tr></td>';
    }
    echo '</table></div></form>';
}
?>    
  

    </div>	 	 
        </div>
    </div>
</div><!-- End demo -->
<?php mysql_close(); ?>
<?php
require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>