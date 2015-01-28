<?php

require('includes/application_top.php');
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);

##########################################################
######################## FUNZIONI ########################
##########################################################

### SVUOTA IL CARRELLO
     
function SvuotaCarrello($id=''){
 
return tep_db_query("DELETE FROM customers_basket
 WHERE customers_id = ".$id);

}

### SELEZIONO IL CIRCUITO DAL CODICE CONVENZIONE LEGATO ALCODICE SCUOLA DEL CLIENTE

function tep_circuito_bancario($customer_id=null){
    
$sql=tep_db_query("SELECT customers.customers_id AS customers_id,
       customers_firstname,
       customers_lastname,
       customers_dob,
       customers_email_address,
       customers_default_address_id,
       customers_telephone,
       customers_fax,
       customers_newsletter,
       customers_name_school,
       customers_class_school,
       customers_section_school,
       customers_code_school,
       entry_gender,
       entry_company,
       entry_firstname,
       entry_lastname,
       entry_street_address,
       entry_suburb,
       entry_postcode,
       entry_city,
       entry_state,
       entry_country_id,
       entry_zone_id,
       circuito,
       convenzioni_to_parametri.sede,
       parent_sede,
       alias,
       mackey,
       email,
       attivo
  FROM passalibroweb.customers,
       passalibro.convenzioni,
       parametri_banche,
       convenzioni_to_parametri,
       address_book
 WHERE     customers.customers_code_school = convenzioni_to_parametri.Codice
       AND parametri_banche.sede = convenzioni_to_parametri.parent_sede
       AND customers.customers_id = address_book.customers_id
       AND convenzioni_to_parametri.attivo=true
       AND customers.customers_id = ".$customer_id."
GROUP BY customers.customers_code_school;");
 
$result=tep_db_fetch_array($sql);

$array = array('customers_id'=>$result['customers_id'],
       'customers_firstname'=>$result['customers_firstname'],
       'customers_lastname'=>$result['customers_lastname'],
       'customers_dob'=>$result['customers_dob'],
       'entry_gender'=>$result['entry_gender'],
       'entry_company'=>$result['entry_company'],
       'entry_firstname'=>$result['entry_firstname'],
       'entry_lastname'=>$result['entry_lastname'],
       'entry_street_address'=>$result['entry_street_address'],
       'entry_suburb'=>$result['entry_suburb'],
       'entry_postcode'=>$result['entry_postcode'],
       'entry_city'=>$result['entry_city'],
       'entry_state'=>$result['entry_state'],
       'entry_country_id'=>$result['entry_country_id'],
       'entry_zone_id'=>$result['entry_zone_id'],
       'customers_email_address'=>$result['customers_email_address'],
       'customers_default_address_id'=>$result['customers_default_address_id'],
       'customers_telephone'=>$result['customers_telephone'],
       'customers_fax'=>$result['customers_fax'],
       'customers_newsletter'=>$result['customers_newsletter'],
       'customers_name_school'=>$result['customers_name_school'],
       'customers_class_school'=>$result['customers_class_school'],
       'customers_section_school'=>$result['customers_section_school'],
       'customers_code_school'=>$result['customers_code_school'],
       'sede'=>$result['sede'],
       'parent_sede'=>$result['parent_sede'],
       'alias'=>$result['alias'],
       'email'=>$result['email'],
       'circuito'=>$result['circuito'],
       'attivo'=>$result['attivo'],
       'mackey'=>$result['mackey']);

return $array;
    
}
function tep_get_products($customer_id=null) {

$sql = tep_db_query("SELECT p.products_id,
       pd.products_name,
       p.products_model,
       p.products_ebay,
       p.products_image,
       p.products_price,
       p.products_weight,
       p.products_tax_class_id,
       cb.customers_basket_reserved_quantity
  FROM products p, products_description pd, customers_basket cb
 WHERE     p.products_id = cb.products_id
       AND p.products_id = pd.products_id
       AND cb.customers_id = ".$customer_id."
GROUP BY products_id");
                
            while($products = tep_db_fetch_array($sql)){
                
           $result[] = array('products_id' => $products['products_id'],
                    'products_name' => $products['products_name'],
                    'products_model' => $products['products_model'],
                    'products_ebay' => $products['products_ebay'],
                    'products_image' => $products['products_image'],
                    'products_quantity_reserved' => $products['customers_basket_reserved_quantity'],
                    'products_price' => $products['products_price']);
            }
            
            return $result;

        }

##########################################################
################### VARIABILI ############################
##########################################################

$sede=(int)'2';
$anno=date("Y");
$cliente_id=(int)$_REQUEST['customer_id'];
$firstname=$_REQUEST['firstname'];
$lastname=$_REQUEST['lastname'];
$street_address=$_REQUEST['street_address'];
$telephone=$_REQUEST['phone_number'];
$postcode=$_REQUEST['postcode'];
$city=$_REQUEST['city'];
$email_address=tep_db_prepare_input($_REQUEST['email_address']);
$email_address_login=tep_db_prepare_input($_REQUEST['email_address_login']);
$email_login=tep_db_prepare_input($_REQUEST['email_login']);
$fax=$_REQUEST['telephone'];
$newsletter=true;
$password=$_REQUEST['password'];
$password_login=tep_db_prepare_input($_REQUEST['password_login']);
$country=(int)'105';
$zone=(int)'182';

$chiave_esito=$_GET['esito'];

##########################################################
################### AZIONI ###############################
##########################################################

switch($_REQUEST['action']){

case 'getIstituto':

//$sql_istituto=tep_db_query('SELECT istituto, tipo_istituto, specializzazione, 
// cod_scuola, 
// sede 
// FROM passalibro.scuolesedi
// WHERE sede = '.$sede.' 
//AND istituto LIKE \'%'.$_REQUEST['istituto'].'%\' 
//AND convenzione = 1');

$sql_istituto=tep_db_query('SELECT istituto, tipo_istituto, specializzazione, 
 cod_scuola, 
 sede 
 FROM passalibro.scuolesedi
 WHERE sede = '.$sede.' 
AND istituto LIKE \'%salesiani%\' 
AND convenzione = 1');

    if(!tep_db_num_rows($sql_istituto)){
    
        echo 'Non ci sono risultati!';
    
   } else {

        echo '<option>'.strtoupper('istituto').'</option>';

        while($tipo_istituto=tep_db_fetch_array($sql_istituto)){
        
        $specializzazione=$tipo_istituto['tipo_istituto']=='media'?' [ primo grado ]':' [ '.$tipo_istituto['specializzazione'].' ]';
 
        echo '<option value="'.$tipo_istituto['cod_scuola'].'">'.strtoupper($tipo_istituto['istituto'].' - '.$tipo_istituto['tipo_istituto'].$specializzazione).'</option>';
    

  }
 }

break; 

case 'getClassiSedi':

#$_SESSION['cod_scuola']=$_REQUEST['cod_scuola'];

$sql_classisedi=tep_db_query("SELECT cod_scuola, classe, sezione
 FROM passalibro.classisedi
 WHERE sede = ".$sede." and cod_scuola = ".$_REQUEST['cod_scuola']." and anno = '".$anno."'");
 
    if(!tep_db_num_rows($sql_classisedi)){
    
        echo 'Non ci sono risultati!';
    
   } else {

        echo '<option>'.strtoupper('classe / sezione').'</option>';

        while($classe_sezione=tep_db_fetch_array($sql_classisedi)){
 
        echo '<option value="'.$classe_sezione['cod_scuola'].':'.$classe_sezione['classe'].':'.$classe_sezione['sezione'].'">'.strtoupper('Classe: '.$classe_sezione['classe'].' Sezione: '.$classe_sezione['sezione']).'</option>';  

  }
 } 

break; 


case 'getCheckEmailExist':

  $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
  $check_email = tep_db_fetch_array($check_email_query);
  if ($check_email['total'] > 0) {
	  echo "false";
  }else{
	  echo "true";
  }
  
break;


case 'getCreateAccount':

list($codice,$classe,$sezione)=explode(':',$_REQUEST['cod_scuola']);

$sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
                              'customers_code_school' => $codice,
                              'customers_class_school' => $classe,
                              'customers_section_school' => $sezione,                              
                              'customers_password' => tep_encrypt_password($password));

      $query1=tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);
      

      $customer_id = tep_db_insert_id();

      $sql_data_array = array('customers_id' => (int)$customer_id,
                              'entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_zone_id' => $zone,
                              'entry_country_id' => $country);

tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
      
      $address_id = tep_db_insert_id();

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

      tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");

     
$carrello=tep_lista_adozioni($sede,$codice, $classe, $sezione,$anno);

for($l=0;$l<count($carrello);$l++) {

$qta=$carrello[$l]['da_acquistare']==true?(int)'1':(int)'0';

$articoli=array('customers_id' => (int)$customer_id,
                'products_id' => $carrello[$l]['products_id'],
                'customers_basket_quantity' => (int)'0',
                'final_price' =>  $carrello[$l]['products_price'],
                'customers_basket_used_quantity' => (int)'0',
                'final_used_price' => (int)'0',
                'data_school' => $sede.':'.$_REQUEST['cod_scuola'],
                'customers_basket_reserved_quantity'=> $qta);

tep_db_perform(TABLE_CUSTOMERS_BASKET, $articoli);

$basket_insert_id = tep_db_insert_id();

tep_db_perform(TABLE_CUSTOMERS_BASKET,array('customers_basket_reserved_quantity'=>$qta),'update','customers_basket_id='.$basket_insert_id);
  
}

$query5=tep_db_query("SELECT MAX(customers_id) as LastCartID FROM ".TABLE_CUSTOMERS_BASKET." WHERE customers_id = ".$customer_id);
$cartID=tep_db_fetch_array($query5);

  
    echo (int)$customer_id;
      
//build the message content

      $name = $firstname . ' ' . $lastname;
      $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
      $email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
      tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);


break;

case 'checkEmailNotExist':

$check_customer_email = tep_db_query("select customers_id, customers_firstname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address_login) . "'");
if (!tep_db_num_rows($check_customer_email)) {

    if($password_login==false){
        
        echo "false";
        
        }
	      
  }else{ 
    
    if($password_login==false){
        
        echo "true";
        
        }
    
    }

break;


case 'checkAccountExists':

$check_customer_exist = tep_db_query("select customers_id, customers_firstname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_login) . "'");
$check_exist = tep_db_fetch_array($check_customer_exist);
if(!tep_validate_password($password_login, $check_exist['customers_password'])){
    

echo "false";    
    
} else {
    
echo "true";
    
}

break;


case 'customerLogin':

$check_customer_login = tep_db_query("select customers_id, customers_email_address, customers_code_school, customers_class_school, customers_section_school from " . TABLE_CUSTOMERS . " WHERE customers_email_address = '".$_REQUEST['email_login']."'");
$check_login = tep_db_fetch_array($check_customer_login);

list($codice,$classe,$sezione)=explode(':',$_REQUEST['cod_scuola']);

tep_db_query("UPDATE customers SET customers_code_school ='".$codice."' , customers_class_school= '".$classe."', customers_section_school='".$sezione."' WHERE customers_id = ".$check_login['customers_id']);

$check_customer_bastket=tep_db_query("select customers_basket_id, customers_id, data_school FROM customers_basket WHERE customers_id = ".$check_login['customers_id']);
$check_basket=tep_db_fetch_array($check_customer_bastket);

$carrello=tep_lista_adozioni($sede,(int)$check_login['customers_code_school'],(int)$check_login['customers_class_school'],$check_login['customers_section_school'],$anno);

if (!$check_basket['customers_id']) {

for($l=0;$l<count($carrello);$l++) {

$qta=$carrello[$l]['da_acquistare']==true?(int)'1':(int)'0';

$articoli=array('customers_id' => (int)$check_login['customers_id'],
                'products_id' => $carrello[$l]['products_id'],
                'customers_basket_quantity' => (int)'0',
                'final_price' => $carrello[$l]['products_price'],
                'customers_basket_used_quantity' => (int)'0',
                'final_used_price' => (int)'0',
                'data_school' => $sede.':'.$_REQUEST['cod_scuola'],
                'customers_basket_reserved_quantity'=> $qta);

tep_db_perform(TABLE_CUSTOMERS_BASKET, $articoli);

$basket_insert_id = tep_db_insert_id();

tep_db_perform(TABLE_CUSTOMERS_BASKET,array('customers_basket_reserved_quantity'=>$qta),'update','customers_basket_id='.$basket_insert_id);
 
}

echo $check_login['customers_id'];    
    
} else {
    
echo $check_login['customers_id'];
    
}


break;

#################################################################
###################### CANCELLO E RICREO IL CARRELLO ############
#################################################################
   
case 'getListaTesti':

$check_customer_login = tep_db_query("select customers_id, customers_email_address, customers_code_school, customers_class_school, customers_section_school from " . TABLE_CUSTOMERS . " WHERE customers_id = '".$_REQUEST['customer_id']."'");
$check_login = tep_db_fetch_array($check_customer_login);

list($codice,$classe,$sezione)=explode(':',$_REQUEST['cod_scuola']);

tep_db_query("UPDATE customers SET customers_code_school ='".$codice."' , customers_class_school= '".$classe."', customers_section_school='".$sezione."' WHERE customers_id = ".$check_login['customers_id']);

$check_customer_bastket=tep_db_query("select customers_basket_id, customers_id, data_school FROM customers_basket WHERE customers_id = ".$check_login['customers_id']);
$check_basket=tep_db_fetch_array($check_customer_bastket);

$carrello=tep_lista_adozioni($sede,(int)$check_login['customers_code_school'],(int)$check_login['customers_class_school'],$check_login['customers_section_school'],$anno);

$mystring = trim($check_login['data_school']);
$findme   = trim($_REQUEST['cod_scuola']);
$pos = strpos($mystring, $findme);

if ($pos !== true) {

SvuotaCarrello($_REQUEST['customer_id']);

for($l=0;$l<count($carrello);$l++) {

$qta=$carrello[$l]['da_acquistare']==true?(int)'1':(int)'0';

$articoli=array('customers_id' => $check_login['customers_id'],
                'products_id' => $carrello[$l]['products_id'],
                'customers_basket_quantity' => (int)'0',
                'final_price' =>  $carrello[$l]['products_price'],
                'customers_basket_used_quantity' => (int)'0',
                'final_used_price' => (int)'0',
                'data_school' => $sede.':'.$_REQUEST['cod_scuola'],
                'customers_basket_reserved_quantity'=> $qta);

tep_db_perform(TABLE_CUSTOMERS_BASKET, $articoli);

$basket_insert_id = tep_db_insert_id();

tep_db_perform(TABLE_CUSTOMERS_BASKET,array('customers_basket_reserved_quantity'=>$qta),'update','customers_basket_id='.$basket_insert_id);
 
}

include('includes/risultati_convenzioni.php');

}else{

include('includes/risultati_convenzioni.php');

}

break;

case 'updateBasketQty':

tep_db_query("UPDATE customers_basket SET customers_basket_reserved_quantity = ".$_REQUEST['qta'] ." WHERE customers_basket_id = ".$_REQUEST['basketId']);

break;

case 'getBasketTotalQty':

$sql_sum_basket=tep_db_query("SELECT sum(customers_basket_reserved_quantity) as qta_cliente from customers_basket WHERE customers_id=".$_REQUEST['customer_id']);
$articoli_tot_carrello=tep_db_fetch_array($sql_sum_basket);

echo $articoli_tot_carrello['qta_cliente'];

break;

case 'getBasketTotalPrice':

$sql_totale_carrello=tep_db_query("SELECT sum(final_price*customers_basket_reserved_quantity) as totale from customers_basket WHERE customers_id=".$_REQUEST['customer_id']);
$totale_carrello=tep_db_fetch_array($sql_totale_carrello);

echo number_format($totale_carrello['totale'],2,',','.');

break;

case 'getHtmlFormBank':


if($_SERVER['HTTP_HOST']=='www1.passalibro.com'){

$alias="payment_testm_urlmac";   
$chiave_avvio='esempiodicalcolomac';
$myshoptransactionID=$_REQUEST['customer_id'].'-'.time().'-'.'TEST';
$mycurrency='EUR';
$myamount=$_REQUEST['total_price'];
$mail='info@ingruppo-ict.com';
$mycustominfo = '?' . tep_session_name() . '=' . tep_session_id();

$str = 'codTrans='.$myshoptransactionID.
        'divisa='.$mycurrency.
        'importo='.$myamount.
        $chiave_avvio;

$MAC = sha1($str);

}else{

$data_seller=tep_circuito_bancario($_REQUEST['customer_id']);

$mail=$data_seller['customers_email_address'];
    
$alias=$data_seller['alias'];   
$chiave_avvio=$data_seller['mackey'];
$myshoptransactionID=$_REQUEST['customer_id'].'-'.time().'-'.$data_seller['parent_sede'];
$mycurrency='EUR';
$myamount=$_REQUEST['total_price'];

$mycustominfo = '?' . tep_session_name() . '=' . tep_session_id();

echo $myamount;

$str = 'codTrans=' . $myshoptransactionID .
       'divisa=' . $mycurrency .
       'importo=' . $myamount .
        $chiave_avvio;
        
$MAC = urlencode( base64_encode( md5($str) ) );

}

$modulo = '<form name="checkout_confirmation" action="https://ecommerce.keyclient.it/ecomm/ecomm/DispatcherServlet" method="post">';
$modulo.='<input type="hidden" name="codTrans" value="'.$myshoptransactionID.'" />';
$modulo.='<input type="hidden" name="divisa" value="'.$mycurrency.'" />';
$modulo.='<input type="hidden" name="importo" value="'.$myamount.'" />';
$modulo.='<input type="hidden" name="alias" value="'.$alias.'" />';
$modulo.='<input type="hidden" name="mail" value="'.$mail.'" />';
$modulo.='<input type="hidden" name="url_back" value="http://'.$_SERVER['HTTP_HOST'].'/convenzioni_acquisti.php?action=CheckoutProcess" />';
$modulo.='<input type="hidden" name="url" value="http://'.$_SERVER['HTTP_HOST'].'/convenzioni_acquisti.php?action=CheckoutProcess" />';
$modulo.='<input type="hidden" name="session_id" value="'.tep_session_id().'" />';
$modulo.='<input type="hidden" name="languageId" value="ITA" />';
$modulo.='<input type="hidden" name="mac" value="'.$MAC.'" />';
$modulo.='<input class="other_button ui-btn-right" data-inline="true" data-icon="check" id="tdb1" type="submit" value="Conferma acquisto" data-theme="b"/>';
$modulo.='</form>';

echo $modulo;

break;

case 'CheckoutProcess':

require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PROCESS);

#######################################################################
################# APRO LE RISPOSTE DENTRO L'ACTION ####################
######################## CheckoutProcess ##############################
#######################################################################

switch($_REQUEST['esito']){

case 'KO':

echo '<h1>Siamo spiacenti si è verificato un problema nel pagamento!!</h1>';

header('Refresh: 2; http://'.$_SERVER['HTTP_HOST'].'/lista_testi.html#'.$id);

break;

case 'ERRORE':

echo '<h1>Errore nella transazione!!</h1>';

header('Refresh: 2; http://'.$_SERVER['HTTP_HOST'].'/lista_testi.html#'.$id);

break;
    
case 'ANNULLO':

echo '<h1>Ordine Annullato!!</h1>';

header('Refresh: 2;  http://'.$_SERVER['HTTP_HOST'].'/lista_testi.html#'.$id);

break;

case 'OK':

echo '<h1>Complimenti!! il tuo acquisto è andato a buon fine. Arrivederci e grazie!!</h1>';

list($id,$time)=explode('-',$_REQUEST['codTrans']);

$customer_id=(int)$id;

$data_order=tep_circuito_bancario($customer_id);

$myamount=$_REQUEST['importo'];

tep_db_query("DELETE FROM ".TABLE_CUSTOMERS_BASKET." WHERE customers_id = ".$data_order['customers_id']." AND customers_basket_reserved_quantity = 0;");

  $sql_data_array = array('customers_id' => $data_order['customers_id'],
                          'customers_name' => $data_order['customers_firstname'] . ' ' . $data_order['customers_lastname'],
                          'customers_street_address' => $data_order['entry_street_address'],
                          'customers_city' => $data_order['entry_city'],
                          'customers_postcode' => $data_order['entry_postcode'], 
                          'customers_state' => 'Italia', 
                          'customers_country' => 'Italy', 
                          'customers_telephone' => $data_order['customers_telephone'], 
                          'customers_email_address' => $data_order['customers_email_address'],
                          'customers_address_format_id' => (int)'2', 
                          'delivery_name' => trim($data_order['customers_firstname'] . ' ' . $data_order['customers_lastname']),
                          'delivery_street_address' => $data_order['entry_street_address'],  
                          'delivery_city' => $data_order['entry_city'], 
                          'delivery_postcode' => $data_order['entry_postcode'], 
                          'delivery_state' => 'Italia', 
                          'delivery_country' => 'Italy', 
                          'delivery_address_format_id' => (int)'2', 
                          'billing_name' => $data_order['customers_firstname'] . ' ' . $data_order['customers_lastname'], 
                          'billing_company' => $data_order['entry_company'],
                          'billing_street_address' => $data_order['entry_street_address'], 
                          'billing_suburb' => $data_order['entry_suburb'], 
                          'billing_city' => $data_order['entry_city'], 
                          'billing_postcode' => $data_order['entry_postcode'], 
                          'billing_state' => 'Italia', 
                          'billing_country' => 'Italy', 
                          'billing_address_format_id' => (int)'2', 
                          'payment_method' => 'Convenzione Saleziani '.$data_order['customers_code_school'].' (Carta di Credito)', 
                          'date_purchased' => 'now()', 
                          'orders_status' => (int)'1', 
                          'currency' => 'EUR', 
                          'currency_value' => (int)'1',
                          'sede' => $data_order['sede'],
                          'session_id'=>tep_session_id());
                          
  tep_db_perform(TABLE_ORDERS, $sql_data_array);
  
  $insert_id = tep_db_insert_id();

$myamount=(int)$myamount/100;
 
tep_db_query("INSERT INTO passalibroweb.orders_total
(orders_id, title, text , value, class, sort_order) 
VALUES 
(".$insert_id.", 'Sub-Totale:', '".$myamount."', ".$myamount.", 'ot_subtotal', 1),
(".$insert_id.", 'Convenzione ".$data_order['customers_code_school']." Punto Vendita:', '0', 0 , 'ot_shipping', 2),
(".$insert_id.", 'Totale:', '<strong>".$myamount."</strong>', ".$myamount.", 'ot_total', 4)");

tep_db_perform(TABLE_ORDERS,array('session_id'=>substr(tep_session_id(),0,-strlen($insert_id)).$insert_id),'update','orders_id='.$insert_id);

#### SALVO I DATI IN TABELLA BANCHE

    $check_query = tep_db_query("select * FROM ".TABLE_ORDERS_CIM_ITALIA." WHERE bank_transaction_id = '" . $_GET['codTrans'] . "'");
    $check = tep_db_num_rows($check_query);
    if($check > 0) {
      tep_db_query("UPDATE ".TABLE_ORDERS_CIM_ITALIA." SET client_status = 1, customer_id = " . (int)$customer_id . ", orders_id = " . (int)$insert_id . " WHERE bank_transaction_id = '" . $_GET['codTrans'] ."'");
    
    } else {
        
$bank_data_array=array('bank_transaction_id'=>$_GET['codTrans'],
'shop_transaction_id'=>$_GET['codTrans'],
'authorization_code'=>$_GET['esito'],
'customer_id'=>(int)$customer_id , 
'orders_id'=>(int)$insert_id, 
'amount'=>$_GET['importo']/100, 
'client_status'=> (int)'1', 
'date'=>time());

tep_db_perform(TABLE_ORDERS_CIM_ITALIA,$bank_data_array);
        
    }

#### CONFERMA EMAIL
$products_ordered = '';

$lista=tep_get_products($data_order['customers_id']);

for($i=0;$i<count($lista);$i++){

   
               $array_result = array('orders_id'=>$insert_id,
               'products_id' => $lista[$i]['products_id'],
                    'products_name' => $lista[$i]['products_name'],
                    'products_model' => $lista[$i]['products_model'],
                    'products_ebay' => $lista[$i]['products_ebay'],
                    'final_price' => number_format($lista[$i]['products_price'],4,'.',''),
                    'products_used_price' => number_format($lista[$i]['products_used_price'],4,'.',''),
                    'scuola' => $data_order['customers_code_school'],
                    'classe' => $data_order['customers_class_school'],
                    'sezione' => $data_order['customers_section_school'],
                    'products_tax' => (int)'0',
                    'products_used_quantity' => (int)'0',
                    'products_quantity' => (int)'0',
                    'products_quantity_reserved' => $lista[$i]['products_quantity_reserved'],
                    'products_price' => number_format($lista[$i]['products_price'],4,'.',''));
    
tep_db_perform(TABLE_ORDERS_PRODUCTS, $array_result);

tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $lista[$i]['products_quantity']+$lista[$i]['products_used_quantity']) . " where products_id = '" . tep_get_prid($lista[$i]['products_id']) . "'");    



$products_ordered .= $lista[$i]['products_quantity_reserved'] . ' x ' . $lista[$i]['products_name'] . ' (' . $lista[$i]['products_model'] . ') = €.' . $lista[$i]['final_price'] . "\n";
  }


  $email_order = STORE_NAME . "\n" . 
                 EMAIL_SEPARATOR . "\n" . 
                 EMAIL_TEXT_ORDER_NUMBER . ' ' . $insert_id . "\n" .
                 EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $insert_id, 'SSL', false) . "\n" .
                 EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n";
  
  $email_order .= EMAIL_TEXT_PRODUCTS . "\n" . 
                  EMAIL_SEPARATOR . "\n" . 
                  $products_ordered . 
                  EMAIL_SEPARATOR . "\n";

$order_reserved=tep_db_query("SELECT title, text FROM ".TABLE_ORDERS_TOTAL." where orders_id = ".$insert_id);

  for ($i=0, $n=sizeof($order_reserved); $i<$n; $i++) {
    $email_order .= strip_tags($order_reserved[$i]['title']) . ' ' . strip_tags($order_reserved[$i]['text']) . "\n";
  }

  $email_order .= "\n" . EMAIL_TEXT_BILLING_ADDRESS . "\n" .
                  EMAIL_SEPARATOR . "\n" .
                  tep_address_label($data_order['customers_id'], $billto, 0, '', "\n") . "\n\n";
  
### Invio posta una Sedi:

  tep_mail($data_order['customers_firstname'] . ' ' . $data_order['customers_lastname'], $data_order['customers_email_address'], EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, $data_order['sede']);

SvuotaCarrello((int)$customer_id);

header('Refresh: 2; http://'.$_SERVER['HTTP_HOST'].'/convenzioni_acquisti.html');

break;
  
}

################################# CHIUDO LE RISPOSTE #######################

break;    
    
}        
require('includes/application_bottom.php');  
?>
