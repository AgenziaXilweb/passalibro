
<?php

/**
 * @author 
 * @copyright 2012
 */
$sessione = tep_session_id();
$sede_id = $_SESSION['mailsede'];
$codiceutente = $_SESSION['customer_id'];
$codice_scuola = $_SESSION['scuola'];
$nome_scuola = $_SESSION['istituto'];
$localita_scuola = $_SESSION['citta'];
$indirizzo_scuola = $_SESSION['dati_anagrafici_2'];
$tipo_scuola = $_SESSION['tipo_istituto'];
$specializzazione = $_SESSION['specializzazione'];
$data_pren = date("Y-m-d H:i:s");
$classe_scuola = $_SESSION['classe'];
$sezione_scuola = $_SESSION['sezione'];
$idRow = $row;

$sql_clientesede = mysql_query("select cod_cliente_1, 
    cod_cliente_2, 
    cod_cliente_3, 
    cod_cliente_4 
    FROM passalibro.users 
    WHERE id = $codiceutente");
 
$codclientesede = mysql_fetch_array($sql_clientesede);

switch($sede_id) {

case 1: $customercode = $codclientesede['cod_cliente_1'];
break;
case 2: $customercode = $codclientesede['cod_cliente_2'];
break;
case 3: $customercode = $codclientesede['cod_cliente_3'];
break;
case 4: $customercode = $codclientesede['cod_cliente_4'];
break;
    
}

$sql_selezione = mysql_query("SELECT *
    FROM passalibroweb.customers
    JOIN passalibroweb.address_book USING (customers_id)
    WHERE customers_id = $codiceutente");
 
$anagrafica = mysql_fetch_array($sql_selezione);    
    
$nome = $anagrafica['customers_firstname'];
$cognome = $anagrafica['customers_lastname'];
$indirizzo = $anagrafica['entry_street_address']; 
$localita = $anagrafica['entry_city'];
$cap = $anagrafica['entry_postcode'];
$tel1 = $anagrafica['customers_telephone'];
$persona1 = $nome . " " . $cognome;
$tel2 = $anagrafica['customers_fax'];
$persona2 = '';
$email = $anagrafica['customers_email_address'];
$stato = $anagrafica['entry_state'];


list($codchiave,$isbn,$titolo,$prezzo)=explode("|",$messaggio);


$sql_datilibro = mysql_query("SELECT autore1, editore
 FROM passalibro.catalogo
 WHERE cod_chiave = $codchiave");
 
$datilibro = mysql_fetch_array($sql_datilibro);

$autore = $datilibro['autore1'];
$editore = $datilibro['editore'];

$data_acconto = "2050-12-30 00:00:00";

mysql_query("INSERT INTO passalibro.tmpweb(sessione,
                              cod_cliente,
                              sede,
                              cognome,
                              nome,
                              indirizzo,
                              localita,
                              cap,
                              email,
                              tel1,
                              persona1,
                              tel2,
                              persona2,
                              nome_scuola,
                              localita_scuola,
                              tipo_scuola,
                              specializzazione_scuola,
                              classe_scuola,
                              sezione_scuola,
                              cerco_libri,
                              id_scuola,
                              id_row,
                              isbn,
                              titolo,
                              voltomo,
                              autore,
                              editore,
                              cod_chiave,
                              quantita,
                              num_pren,
                              data_pren,
                              cod_tipocli,
                              convenzione,
                              data_acconto)
VALUES ('$sessione',
        $customercode,
        '$sede_id',
        '$cognome',
        '$nome',
        '$indirizzo',
        '$localita',
        '$cap',
        '$email',
        '$tel1',
        '$persona1',
        '$tel2',
        '$persona2',
        '$nome_scuola',
        '$localita_scuola',
        '$tipo_scuola',
        '$specializzazione',
        '$classe_scuola',
        '$sezione_scuola',
        '$cercolibri',
        $codice_scuola,
        $idRow,
        '$isbn',
        '$titolo',
        '',
        '$autore',
        '$editore',
        $codchiave,
        1,
        $num_pren,
        '$data_pren',
        '0',
        '',
        '$data_acconto')");
        

?>
