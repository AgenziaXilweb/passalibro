<?php

 require('includes/application_top.php');
$sql = "SELECT * FROM action_customer_stepbystep 
where action like 'remove%' 
and customers_id = ".$_GET['customers_id']."
group by action";

$query=tep_db_query($sql);

$i=1;
while($results=tep_db_fetch_array($query)){

$testo=$results['action'];   
    
preg_match_all("(:(.*?)})", $testo , $risultato );
preg_match_all("({(.*?):)", $testo , $tipo );
preg_match_all("({sede:(.*?)})", $testo , $sede );

$subsql="select products_model from products where products_id = ".$risultato[$i][0];

$subquery=tep_db_query($subsql);

while($subresults=tep_db_fetch_array($subquery)){
    
echo '<br>'.$subresults['products_model'].' - '.$tipo[$i][0].' - '.$sede[$i][0].' - '.$results['time_entry'];


}
   
}
 
 require(DIR_WS_INCLUDES . 'application_bottom.php');

?>