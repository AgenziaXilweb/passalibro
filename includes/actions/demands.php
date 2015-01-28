<?php

if ($_REQUEST['azione'] == 'email') {
    
 
$busto = 'marco.lilly@email.it';
$sesto = 'marco@ingruppo-ict.com';
$milano = 'marco@carryexpress.it';
$sassuolo = '';
$incopia = 'marco@ingruppo-ict.com';

if ($_SESSION['mailsede'] = 1) {

    $destinatario = $busto;

} elseif ($_SESSION['mailsede'] = 2) {

    $destinatario = $sesto;

} elseif ($_SESSION['mailsede'] = 3) {

    $destinatario = $milano;

} elseif ($_SESSION['mailsede'] = 4) {

    $destinatario = $sassuolo;

}
    $query_cliente = mysql_query("SELECT customers_email_address FROM passalibro_web.customers WHERE customers_id = " .
        tep_session_is_registered('customer_id') . "");

    $cliente = mysql_fetch_array($query_cliente);

    $oggetto = "Test Richieste";
    $header = "From: " . $cliente['customers_email_address'] . "\n";
    $header .= "CC: " . $incopia . "\n";
    $header .= "X-Mailer: Il nostro Php\n";

    $header .= "MIME-Version: 1.0\n";
    $header .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
    $header .= "Content-Transfer-Encoding: 7bit\n\n";

    $selezione = $_POST['inserito'];

    $corpo = "<table width='100%'><tr>
    <td><b>Codice</b></td>
    <td><b>ISBN</b></td>
    <td><b>Descrizione</b></td>
    <td><b>Prezzo Euro</b></td></tr>";

    foreach ($selezione as $messaggio) {

        $corpo .= "<tr><td>" . str_replace(' - ', "</td><td>", strtoupper($messaggio)) .
            "</td></tr>";

    }

    $corpo .= "</table>";

    $message = $corpo;

    session_start();

    $_SESSION['stampa'] = $corpo;

    if (@mail($destinatario, $oggetto, $message, $header))
        echo "<center><h1>e-mail inviata con successo!</h1><br>";
        $targetUrl = "stampe.php?" . $message;
        echo "<div align='center' class='styled-input'><a href='" . $targetUrl . "'><br><br>Stampa</a></div>";
        
   } else {
    
        echo "<center><h1>errore nell'invio dell'e-mail!</h1></center>";

}
?>