<?php
require ('includes/header.php');

//talk_to_ebay();

switch($get_call){
    
case 'AddFixedPriceItem':

include('AddFixedPriceItem.php');

break;
case 'EndFixedPriceItem':

include('EndFixedPriceItem.php');

break;
case 'GetSellerList':

include('GetSellerList.php');

break;
case 'ReviseFixedPriceItem':

include('ReviseFixedPriceItem.php');

break;
case 'RelistItem':

include('RelistItem.php');

break;

// Aggiornamento prodotti

case 'ReviseItem':

include('ReviseItem.php');

break;

case 'ReviseItemImages':

include('ReviseItemImages.php');

break;

// Fine Aggiornamento prodotti

case 'GetOrders':

include('GetOrders.php');

break;
case 'CreateFileUpload':

include('CreateFileUpload.php');

break;
case 'ExternalSource':

include('includes/external_source.php');

break;
case 'CreateShip':

include('CreateShip.php');

break;
case 'CreateBackShip':

include('CreateBackShip.php');

break;
case 'CreateAmazonShipSede':

include('CreateAmazonShipSede'.$get_sede.'.php');

break;
case 'eBayTest':

include('MonitorMagazzino.php');

break;  
    
}

require('includes/footer.php');

?>