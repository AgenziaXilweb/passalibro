<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2010 osCommerce

Released under the GNU General Public License

*/

require('includes/configure.php');


#if (!tep_session_is_registered('customer_id')) {
#    $navigation->set_snapshot();
#    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
#}


$paymentID = $_REQUEST['paymentid'];
$result = $_REQUEST['result'];
$auth = $_REQUEST['auth'];
$ref = $_REQUEST['ref'];
$tranid = $_REQUEST['tranid'];
$trackid = $_REQUEST['trackid'];
$details = $_REQUEST['udf1']; #udf2,3,4,5
$responsecode = $_REQUEST['responsecode'];


if ($responsecode == '00' || $responsecode == '000') {

    $reply = "REDIRECT=" . HTTP_SERVER . DIR_WS_HTTP_CATALOG . "checkout_process.php?paymentid=$paymentID&result=$result&auth=$auth&ref=$ref&tranid=$tranid&trackid=$trackid&udf1=$details&responsecode=$responsecode";


} else {

    $reply = "REDIRECT=" . HTTP_SERVER . DIR_WS_HTTP_CATALOG . "checkout_payment.php";

}

echo $reply;


?>