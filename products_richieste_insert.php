
<?php


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
    
$nome = !$_REQUEST['nome']?$anagrafica['customers_firstname']:$_REQUEST['nome'];
$cognome = !$_REQUEST['cognome']?$anagrafica['customers_lastname']:$_REQUEST['cognome'];
$indirizzo = $anagrafica['entry_street_address']; 
$localita = $anagrafica['entry_city'];
$cap = $anagrafica['entry_postcode'];
$tel1 = $anagrafica['customers_telephone'];
$persona1 = $anagrafica['customers_firstname'] . " " . $anagrafica['customers_lastname'];
$tel2 = $anagrafica['customers_fax'];
$persona2 = $nome . " " . $cognome;
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


switch($_REQUEST['comando']){

case 'aggiungi':

$riga_sql=tep_db_query("SELECT max(id_row) AS riga, num_pren, sessione
  FROM passalibro.tmpweb
 WHERE sessione = '".$sessione."'");
$ultima_riga=tep_db_fetch_array($riga_sql);

$idRow=!$ultima_riga['riga']?1:$ultima_riga['riga']+1;
$num_pren=$ultima_riga['sessione']==$sessione?$ultima_riga['num_pren']:$num_pren;

$custom_list = array('sessione'=>$sessione,
'customer_id'=>(int)$codiceutente,
'cod_cliente'=>(int)$customercode,
'sede'=>$sede_id,
'cognome'=>$cognome,
'nome'=>$nome,
'indirizzo'=>$indirizzo,
'localita'=>$localita,
'cap'=>$cap,
'email'=>$email,
'tel1'=>$tel1,
'persona1'=>$persona1,
'tel2'=>$tel2,
'persona2'=>$persona2,
'nome_scuola'=>$nome_scuola,
'localita_scuola'=>$localita_scuola,
'tipo_scuola'=>$tipo_scuola,
'specializzazione_scuola'=>$specializzazione,
'classe_scuola'=>$classe_scuola,
'sezione_scuola'=>$sezione_scuola,
'cerco_libri'=>$cercolibri,
'id_scuola'=>(int)$codice_scuola,
'id_row'=>(int)$idRow,
'isbn'=>$isbn,
'titolo'=>$titolo,
'voltomo'=>'',
'autore'=>$autore,
'editore'=>$editore,
'cod_chiave'=>(int)$codchiave,
'quantita'=>1,
'num_pren'=>(int)$num_pren,
'data_pren'=>$data_pren,
'cod_tipocli'=>'0',
'convenzione'=>'',
'data_acconto'=>$data_acconto);

tep_db_perform('requests_product',$custom_list);

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

echo '</tbody><caption><h1>Richiesta N° '.$npren.'</h1></caption></table></div>';

echo '<br><center><a class="other_button" href="products_richieste.php?azione=email&comando=invia">Invia un email al tuo indirizzo e stampa</a></center>';

}

break;
  
case 'richiedi':     

$riga_sql=tep_db_query("SELECT max(id_row) AS riga, num_pren, sessione
  FROM passalibro.tmpweb
 WHERE sessione = '".$sessione."'");
$ultima_riga=tep_db_fetch_array($riga_sql);

$idRow=!$ultima_riga['riga']?1:$ultima_riga['riga']+1;
$num_pren=$ultima_riga['sessione']==$sessione?$ultima_riga['num_pren']:$num_pren;

$custom_list = array('sessione'=>$sessione,
'customer_id'=>(int)$codiceutente,
'cod_cliente'=>(int)$customercode,
'sede'=>$sede_id,
'cognome'=>$cognome,
'nome'=>$nome,
'indirizzo'=>$indirizzo,
'localita'=>$localita,
'cap'=>$cap,
'email'=>$email,
'tel1'=>$tel1,
'persona1'=>$persona1,
'tel2'=>$tel2,
'persona2'=>$persona2,
'nome_scuola'=>$nome_scuola,
'localita_scuola'=>$localita_scuola,
'tipo_scuola'=>$tipo_scuola,
'specializzazione_scuola'=>$specializzazione,
'classe_scuola'=>$classe_scuola,
'sezione_scuola'=>$sezione_scuola,
'cerco_libri'=>$cercolibri,
'id_scuola'=>(int)$codice_scuola,
'id_row'=>(int)$idRow,
'isbn'=>$isbn,
'titolo'=>$titolo,
'voltomo'=>'',
'autore'=>$autore,
'editore'=>$editore,
'cod_chiave'=>(int)$codchiave,
'quantita'=>1,
'num_pren'=>(int)$num_pren,
'data_pren'=>$data_pren,
'cod_tipocli'=>'0',
'convenzione'=>'',
'data_acconto'=>$data_acconto);

tep_db_perform('requests_product',$custom_list);

break;

}
 
?>
