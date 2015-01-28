<?php
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_TITLE', 'Carta di credito/debito e PayPal');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_DESCRIPTION', 'PayPal IPN v2.4');
  // BOF add by AlexStudio
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_SELECTION', ' Carta di credito/debito e PayPal');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_LAST_CONFIRM', ' Carta di credito/debito e PayPal');
  // EOF add by AlexStudio
  // Sets the text for the "continue" button on the PayPal Payment Complete Page
  // Maximum of 60 characters!  
  define('CONFIRMATION_BUTTON_TEXT', 'Completa e conferma il tuo ordine');
  define('EMAIL_PAYPAL_PENDING_NOTICE', 'Your payment is currently pending. We will send you a copy of your order once the payment has cleared.');
  
  define('EMAIL_TEXT_SUBJECT', 'Order Process');
  define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:');
  define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:');
  define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:');
  define('EMAIL_TEXT_PRODUCTS', 'Products');
  define('EMAIL_TEXT_SUBTOTAL', 'Sub-Total:');
  define('EMAIL_TEXT_TAX', 'Tax:        ');
  define('EMAIL_TEXT_SHIPPING', 'Shipping: ');
  define('EMAIL_TEXT_TOTAL', 'Total:    ');
  define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Delivery Address');
  define('EMAIL_TEXT_BILLING_ADDRESS', 'Billing Address');
  define('EMAIL_TEXT_PAYMENT_METHOD', 'Payment Method');

  define('EMAIL_SEPARATOR', '------------------------------------------------------');
  define('TEXT_EMAIL_VIA', 'via'); 

  define('PAYPAL_ADDRESS', 'Customer PayPal address');

/* If you want to include a message with the order email, enter text here: */
/* Use \n for line breaks */
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_EMAIL_FOOTER', '');

?>