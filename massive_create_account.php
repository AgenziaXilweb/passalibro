<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');
  
$query_utenti = mysql_query("select * from passalibro.users");

while ($anagrafica = mysql_fetch_array($query_utenti)) {
    
echo "Dati Utente: " . 
$anagrafica['id'] . " - " .
$anagrafica['nome'] . " - " .
$anagrafica['cognome'] . " - " .
$anagrafica['email'] . " - " .
$anagrafica['company'] . " - " .
$anagrafica['indirizzo'] . " - " .
$anagrafica['localita'] . " - " .
$anagrafica['cap'] . " - " .
$anagrafica['localita'] . " - " .
$anagrafica['localita'] . " - " . 
$anagrafica['tel1'] . " - " .
$anagrafica['tel2'] . "<br>";

    $gender = false; #N/A?
    $idusers = tep_db_prepare_input($anagrafica['id']);
    $firstname = tep_db_prepare_input($anagrafica['nome']);
    $lastname = tep_db_prepare_input($anagrafica['cognome']);
    $email_address = tep_db_prepare_input($anagrafica['email']);
    $street_address = tep_db_prepare_input($anagrafica['indirizzo']);
    $suburb = tep_db_prepare_input($anagrafica['localita']);
    $postcode = tep_db_prepare_input($anagrafica['cap']);
    $city = tep_db_prepare_input($anagrafica['localita']);
    $state = tep_db_prepare_input($anagrafica['localita']);  
    $zone_id = tep_db_prepare_input('182');
    $country = tep_db_prepare_input('105');
    $telephone = tep_db_prepare_input($anagrafica['tel1']);
    $fax = tep_db_prepare_input($anagrafica['tel2']);
    $newsletter = true;
    $password = tep_db_prepare_input($anagrafica['password']);




      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
                              'users_id' => $idusers,
                              'customers_password' => tep_encrypt_password($password));

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $customer_id = tep_db_insert_id();

      $sql_data_array = array('customers_id'         => $customer_id,
                              'entry_firstname'      => $firstname,
                              'entry_lastname'       => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode'       => $postcode,
                              'entry_city'           => $city,
                              'entry_country_id'     => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = $zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }
      
       tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = tep_db_insert_id();

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

      tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");

}

  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
