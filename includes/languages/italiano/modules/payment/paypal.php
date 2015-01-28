<?php
/*
  $Id: paypal.php,v 2.3.2.0 10/22/2007 16:30:37 alexstudio Exp $

  Copyright (c) 2004 osCommerce
  Released under the GNU General Public License
  
  Original Authors: Harald Ponce de Leon, Mark Evans 
  Updates by PandA.nl, Navyhost, Zoeticlight, David, gravyface, AlexStudio, windfjf and Terra
  v2.3 updated by AlexStudio
    
*/

  define('MODULE_PAYMENT_PAYPAL_TEXT_TITLE', 'PayPal | PostePay | Carta di credito');
  define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', 'PayPal | PostePay | Carta di credito');
  // BOF add by AlexStudio
  define('MODULE_PAYMENT_PAYPAL_TEXT_SELECTION', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Carta di credito / Postepay / Paypal (via PayPal)');
  define('MODULE_PAYMENT_PAYPAL_TEXT_LAST_CONFIRM', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Carta di credito / Postepay / Paypal (via PayPal)');
  // EOF add by AlexStudio
  // Sets the text for the "continue" button on the PayPal Payment Complete Page
  // Maximum of 60 characters!  
  define('CONFIRMATION_BUTTON_TEXT', 'Completate in vostro ordine');
  define('EMAIL_PAYPAL_PENDING_NOTICE', 'Il vostro pagamento è in attesa. Vi invieremo una copia del vostro ordine una volta che il pagamento viene inoltrato.');
  
  define('EMAIL_TEXT_SUBJECT', 'Ordine');
  define('EMAIL_TEXT_ORDER_NUMBER', 'Numero ordine:');
  define('EMAIL_TEXT_INVOICE_URL', 'Dettagli fattura:');
  define('EMAIL_TEXT_DATE_ORDERED', 'Data ordine:');
  define('EMAIL_TEXT_PRODUCTS', 'Prodotto');
  define('EMAIL_TEXT_SUBTOTAL', 'Totale:');
  define('EMAIL_TEXT_TAX', 'Tassa:        ');
  define('EMAIL_TEXT_SHIPPING', 'Spedizione: ');
  define('EMAIL_TEXT_TOTAL', 'Total:    ');
  define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Indirizzo di consegna');
  define('EMAIL_TEXT_BILLING_ADDRESS', 'Indirizzo di fatturazione');
  define('EMAIL_TEXT_PAYMENT_METHOD', 'Metodo di pagamento');

  define('EMAIL_SEPARATOR', '------------------------------------------------------');
  define('TEXT_EMAIL_VIA', 'tramite'); 

  define('PAYPAL_ADDRESS', 'Indirizzo di PayPal');

/* Se si desidera includere un messaggio di posta elettronica con l'ordine, inserire il testo qui: */
/* Use \n for line breaks */
  define('MODULE_PAYMENT_PAYPAL_TEXT_EMAIL_FOOTER', '');
  
?>
