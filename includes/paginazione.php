<?php

//if($current_page == 1) { // se siamo nella prima pagina
//$precedente = "<< precedente";
//} else { // altrimenti
//$previous_page = ($current_page - 1);
//$precedente = "<a href='" . FILENAME_ADOZIONI . "?sede=" . $_REQUEST['sede'] . "&page=" . $previous_page . "><< precedente</a>";
//}
//
//if($current_page == $tot_pages) { // se siamo nell'ultima pagina
//$successiva = "successiva >>";
//} else { // altrimenti
//$next_page = ($current_page + 1);
//$successiva = "<a href='" . FILENAME_ADOZIONI . "?sede=" . $_REQUEST['sede'] . "&page=" . $next_page . ">successiva >></a>";
//}
//$paginazione = "$precedente $successiva";


$paginazione = "Pagine totali: " . $tot_pages . "
[";
for($i = 1; $i <= $tot_pages; $i++) {
if($i == $current_page) {
$paginazione .= $i . " ";
} else {
$paginazione .= "<a href=" . FILENAME_ADOZIONI ."?sede=" . $_REQUEST['sede'] . "&page=$i title=\"Vai alla pagina $i\">$i</a> ";
}
}
$paginazione .= "]";



?> 