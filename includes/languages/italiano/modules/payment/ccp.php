<?php
/*
  modulo per pagamento tramite Vaglia Postale
  by hOZONE, hozone@tiscali.it, http://hozone.cjb.net

  visita osCommerceITalia, http://www.oscommerceitalia.com
  
  derivato dal modulo:
  $Id: moneyorder.php,v 1.6 2003/01/24 21:36:04 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
  
  define('MODULE_PAYMENT_CCP_TEXT_TITLE', 'Conto Corrente Postale');
  define('MODULE_PAYMENT_CCP_TEXT_DESCRIPTION', 'Modulo per il pagamento tramite bollettino di Conto Corrente Postale.');
  define('MODULE_PAYMENT_CCP_TEXT_EMAIL_FOOTER', "Da pagare a:\n\nIntestatario: ".MODULE_PAYMENT_CCP_INTESTATARIO."\n\nIndirizzo: ".MODULE_PAYMENT_CCP_INDIRIZZO."\n\nCCP Numero: ".MODULE_PAYMENT_CCP_CC."\n\nNon appena riceveremo il pagamento provvederemo alla spedizione della merce ordinata.");
?>
