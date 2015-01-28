<?php

require('includes/application_top.php');

if(tep_db_query("update " . TABLE_PRODUCTS_TO_CATEGORIES ." set categories_id=26 where categories_id = 0 limit 10")){echo "OK!";}

/**
 * mysql_connect("192.168.4.5", "passalibroweb", "passa20libro12");

 * mysql_select_db('passalibro_web');

 * require ('includes/database_tables.php');

 *  echo "<center><form method='POST' action='?azione=ordini'><input type='text' name='email'><input type='submit' value='Controlla'></form></center>";

 * if ($_REQUEST['azione'] == 'ordini') {

 *   
 * $sql = mysql_query("SELECT customers_lastname, customers_firstname, customers_email_address, products_model, cod_chiave, products_name, customers_basket_used_quantity, products_used_price, customers_basket_quantity, products_price
 *   FROM customers_basket
 *        JOIN customers
 *           USING (customers_id)
 *        JOIN products
 *           USING (products_id)
 *        JOIN products_description
 *           USING (products_id)
 *  WHERE customers.customers_email_address = '" . $_POST['email'] . "'
 *  GROUP BY customers_basket.customers_id");

 * echo "<table border='1'>";

 * while ($row = mysql_fetch_array($sql)) {
 *     echo "<tr><td>Nome: </td><td>" . strtoupper($row['customers_firstname']) . "</td></tr><tr><td>Cognome: </td><td>" . strtoupper($row['customers_lastname']) . "</td></tr><tr><td>UserID: </td><td>" . strtoupper($row['customers_email_address']);
 *     echo "</table><br><b>DETTAGIO ORDINE</b><br><br>";
 * }

 * $sql_details = mysql_query("SELECT customers_lastname, customers_firstname, customers_email_address, products_model, cod_chiave, products_name, customers_basket_used_quantity, products_used_price, customers_basket_quantity, products_price
 *   FROM customers_basket
 *        JOIN customers
 *           USING (customers_id)
 *        JOIN products
 *           USING (products_id)
 *        JOIN products_description
 *           USING (products_id)
 *  WHERE customers.customers_email_address = '" . $_POST['email'] . "'");

 * echo "<table border='1' width='100%'>";

 *     echo "<tr><th>Chiave</th><th>Titolo</th><th>Codice ISBN</th><th align='center'>Quantità Usato</th><th>Prezzo Usato</th><th>Quantità Nuovo</th><th>Prezzo Nuovo</th></tr>";

 * while ($rows = mysql_fetch_array($sql_details)) {

 *     echo "<tr><td>" . strtoupper($rows['cod_chiave']) . "</td><td>" . strtoupper($rows['products_name']) . "</td><td>" . strtoupper($rows['products_model']) . "</td><td align='center'>" . strtoupper($rows['customers_basket_used_quantity']) . "</td><td align='right'>" . strtoupper($rows['products_used_price']) . "</td><td align='center'>" . strtoupper($rows['customers_basket_quantity']) . "</td><td align='right'>" . strtoupper($rows['products_price']);
 * }

 * echo "";   
 * mysql_close();
 * }
 */
?> 

