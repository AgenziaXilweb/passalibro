<?php
/*
$Id$

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2010 osCommerce

Released under the GNU General Public License

*/

require ('includes/application_top.php');

require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_SETEFI_RESULT);

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_RICHIESTE, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_RICHIESTE, '', 'SSL'));

require (DIR_WS_INCLUDES . 'template_top.php');

?>

<h1><?php echo HEADING_TITLE; ?></h1>

<?

?>
<div class="contentContainer">
  <div>
    <h2><?php echo PAYMENT_RESULT_TITLE; ?></h2>
  </div>

  <div class="contentText">
<?php
echo "Errore di trasmissione: " . $_GET['result'];
?>


  </div>
</div>


<?php

require (DIR_WS_INCLUDES . 'template_bottom.php');
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>