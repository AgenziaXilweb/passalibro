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

require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_RICHIESTE);

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_RICHIESTE, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_RICHIESTE, '', 'SSL'));

require (DIR_WS_INCLUDES . 'template_top.php');

?>

<h1><?php echo HEADING_TITLE; ?></h1>

<?

?>
<div class="contentContainer">
  <div>
    <h2><?php echo MY_BOOKSTORE; ?></h2>
  </div>

  <div class="contentText">

<?php


$paymentID = $_REQUEST['paymentid'];
$result = $_REQUEST['result'];
$auth = $_REQUEST['auth'];
$ref = $_REQUEST['ref'];
$tranid = $_REQUEST['tranid'];
$trackid = $_REQUEST['trackid'];
$details = $_REQUEST['udf1']; #udf2,3,4,5
$responsecode = $_REQUEST['responsecode'];

if($_REQUEST['result'] != 'CAPTURED'){
    
    $reply = "REDIRECT=" . HTTP_SERVER . "/checkout_payment.php?error_message=Transazione negata.";

}else{

    $reply = "REDIRECT=" . HTTP_SERVER . "/checkout_process.php?paymentid=$paymentID&result=$result&auth=$auth&ref=$ref&tranid=$tranid&trackid=$trackid&udf1=$details&responsecode=$responsecode";
}

echo $reply;

?>

  </div>
</div>


<?php

require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>
