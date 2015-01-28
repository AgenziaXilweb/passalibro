<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  $oscTemplate->buildBlocks();

  if (!$oscTemplate->hasBlocks('boxes_column_left')) {
    $oscTemplate->setGridContentWidth($oscTemplate->getGridContentWidth() + $oscTemplate->getGridColumnWidth());
  }

  if (!$oscTemplate->hasBlocks('boxes_column_right')) {
    $oscTemplate->setGridContentWidth($oscTemplate->getGridContentWidth() + $oscTemplate->getGridColumnWidth());
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.0 Transitional//IT" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />    
<?php
if($_SERVER['REQUEST_URI']=='/'){

echo '<meta name="keywords" content="libri,librerie,libraccio,testi,scuole,scolastica,scolastici,studenti,studio,elementari,medie,superiori,università,nuovi,usati,nuovo,usato,isbn,isbn13,ebooks,ebook,book,books,library,convenzioni,adozioni,giochi didattici,cd,dvd,varia"/>';
echo '<meta name="description" content="la libreria online dove puoi acquistare tutti i libri di testo nuovi e usati,la spedizione è gratuita con una spesa minima di 50 euro,le consegne vengono eseguite in tutta italia, isole comprese, inoltre puoi pagare e ritirare direttamente nella libreria piu vicina a te, puoi vendere i tuoi libri usati e ti paghiamo in contanti"/>'; 
  
}
?>

<meta name="msvalidate.01" content="73928EF177113C6D87F4BB10A4168B6A" />
<title><?php 
if($_SERVER[HTTP_HOST]=='www.libreriasassuolo.it') {

echo 'La Libreria di Sassuolo '.str_replace('Passalibro.it', '',tep_output_string_protected($oscTemplate->getTitle()));

} else {
    
echo tep_output_string_protected($oscTemplate->getTitle());  
    
}
?>
</title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
<link href='http://fonts.googleapis.com/css?family=Russo+One|Maven+Pro' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,900' rel='stylesheet' type='text/css'/>
<script type="text/javascript" src="ext/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="ext/jquery/ui/jquery-ui-1.8.19.custom.min.js"></script>

<?php
  if (tep_not_null(JQUERY_DATEPICKER_I18N_CODE)) {
?>
<script type="text/javascript" src="ext/jquery/ui/i18n/jquery.ui.datepicker-it.js"></script>
<script type="text/javascript">
$.datepicker.setDefaults($.datepicker.regional['<?php echo JQUERY_DATEPICKER_I18N_CODE; ?>']);
</script>
<?php
  }
?>

<script type="text/javascript" src="ext/jquery/bxGallery/jquery.bxGallery.1.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="ext/960gs/<?php echo ((stripos(HTML_PARAMS, 'dir="rtl"') !== false) ? 'rtl_' : ''); ?>960_24_col.css" />
<script src='includes/js/jquery.mousewheel.js' type="text/javascript"></script>
<!--<script src='includes/js/class.horinaja.jquery.js' type='text/javascript'></script>-->
<!--<link rel="stylesheet" href="css/horinaja.css" type="text/css" media="screen" />-->
<!-- Load the CloudCarousel JavaScript file -->
<script type="text/JavaScript" src="../js/cloud-carousel.1.0.5.js"></script>
 
<script>
$(document).ready(function(){
						   
	//When you click on a link with class of poplight and the href starts with a #

	$('a.poplight[href^=#]').click(function() {

		var popID = $(this).attr('rel'); //Get Popup Name

		var popURL = $(this).attr('href'); //Get Popup href to define size



		//Pull Query & Variables from href URL

		var query= popURL.split('?');

		var dim= query[1].split('&');

		var popWidth = dim[0].split('=')[1]; //Gets the first query string value



		//Fade in the Popup and add close button

		$('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<a href="#" class="close"><img src="images/close_pop.png" class="images/btn_close" title="Close Window" alt="Close" /></a>');



		//Define margin for center alignment (vertical + horizontal) - we add 80 to the height/width to accomodate for the padding + border width defined in the css

		var popMargTop = ($('#' + popID).height() + 80) / 2;

		var popMargLeft = ($('#' + popID).width() + 80) / 2;



		//Apply Margin to Popup

		$('#' + popID).css({

			'margin-top' : -popMargTop,

			'margin-left' : -popMargLeft

		});



		//Fade in Background

		$('body').append('<div id="fade"></div>'); //Add the fade layer to bottom of the body tag.

		$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn(); //Fade in the fade layer



		return false;

	});





	//Close Popups and Fade Layer

	$('a.close, #fade').live('click', function() { //When clicking on the close or fade layer...

	  	$('#fade , .popup_block').fadeOut(function() {

			$('#fade, a.close').remove();

	}); //fade them both out



		return false;

	});

// Animazione del popup
$("ul.menu li").hover(
  function () {
    $(this).append($("<span>"+$(this).attr('alt')+"</span>").fadeIn(1000));
  }, 
  function () {
    $(this).find("span:last").remove();
  });
  
$("#box-prenotazioni").hover(
  function () {
    $(this).append($("<div id='box2'>"+$(this).attr('alt')+"</div>").fadeIn(1000));
  }, 
  function () {
    $(this).find("div:last").remove();
  });
  
  var icons = {
            header: "accordion",
            activeHeader: "accordion_active"
        };
        $( "#accordion" ).accordion({
            icons: icons,
            active:false,
            collapsible: true            
        });
        $( "#toggle" ).button().click(function() {
            if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
                $( "#accordion" ).accordion( "option", "icons", null );
            } else {
                $( "#accordion" ).accordion( "option", "icons", icons );
            }
        });	
	
	// This initialises carousels on the container elements specified, in this case, carousel1.
	$("#carousel1").CloudCarousel(		
		{			
			xPos: 340,
			yPos: 50,
			//buttonLeft: $("#left-but"),
			//buttonRight: $("#right-but"),
			//altBox: $("#desc-text"),
			titleBox: $("#title-text"),
            yRadius:50,
            speed:0.15,
            mouseWheel:true,
            reflHeight:56,
            reflGap:3,
            bringToFront:true,
            autoRotate:'right',
            autoRotateDelay: 3000
		}
	);
});
 
function showDiv() {
document.getElementById('box').style.display = "block";
}
function closeDiv() {
document.getElementById('box').style.display = "none";
}
</script>
<link rel="stylesheet" type="text/css" href="stylesheet.css" />
<meta name="google-site-verification" content="PENXQKqLSiqlWLI11nw3WqFmhHnG243Sv5MTXxhY8OQ" />
<meta name="alexaVerifyID" content="CMkWQx9oAoJoRzmtvGcRrF7N_DE" />
<?php echo $oscTemplate->getBlocks('header_tags'); ?>
</head>
<body onload="showDiv()">
<?php
if($_SERVER['REQUEST_URI']=='/'){
    
echo '<div title="libri,librerie,libraccio,testi,scuole,scolastica,scolastici,studenti,studio,elementari,medie,superiori,università,nuovi,usati,nuovo,usato,isbn,isbn13,ebooks,ebook,book,books,library,convenzioni,adozioni,giochi didattici,cd,dvd,varia" style="display: none;">libri,librerie,libraccio,testi,scuole,scolastica,scolastici,studenti,studio,elementari,medie,superiori,universita,university,nuovi,usati,nuovo,usato,isbn,isbn13,ebooks,ebook,book,books,library,convenzioni,adozioni,giochi didattici,cd,dvd,varia</div>';    
    
}
?>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"tjMsi1aUS/00Ug", domain:"passalibro.it",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=tjMsi1aUS/00Ug" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
<?php include_once("analyticstracking.php") ?>
<div id="bodyWrapper" class="container_<?php echo $oscTemplate->getGridContainerWidth(); ?>">
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<div id="bodyContent" class="grid_<?php #echo $oscTemplate->getGridContentWidth(); ?> <?php #echo ($oscTemplate->hasBlocks('boxes_column_left') ? 'push_' . $oscTemplate->getGridColumnWidth() : ''); ?>">