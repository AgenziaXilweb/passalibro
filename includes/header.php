<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  if ($messageStack->size('header') > 0) {
    echo '<div class="grid_24">' . $messageStack->output('header') . '</div>';
  }
?>
<script> $(document).ready(function(){
$('#slider').Horinaja({
capture:'slider',delai:0.3,
duree:4,pagination:true});
});
</script>
<div id="header">
<div class="logoff">

<?php if (tep_session_is_registered('customer_id')) { ?>
            <a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); $myaccount_menu_txt="Bentornato ".$customer_first_name."!" ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a>
<?php }else{ $myaccount_menu_txt="<u>Accedi</u> oppure <u>Registrati</u><br>per effettuare gli acquisti.";  } ?>
</div>
<div id="shoppingCart"><table>
  <tr>
    <td height="42px" width="230px"><?php if ($cart->count_contents() > 0) { echo ' <a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/cart_full.gif', HEADER_TITLE_CART_CONTENTS) . '</a>' ; }

  else {
    echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'icons/cart_empty.gif', HEADER_TITLE_CART_CONTENTS) . '</a>';
  }

  echo 'Quantità: ' . $cart->count_contents() ;

  if ($cart->count_contents() > 0) {
    echo '<br>Totale: ' . $currencies->format($cart->show_total());
  }
?>
</td>
  </tr>
</table>
</div>
<!-- POP UP VOCI DESCRITTIVE DEL MENU -->
<div id="headerShortcuts" >
  <div class="moduletable-nav">
	<ul class="menu">
          <?php echo '<li alt="'.$myaccount_menu_txt.'"><a href="' . tep_href_link(FILENAME_ACCOUNT) . '">' . HEADER_TITLE_MY_ACCOUNT . '</a>'; ?></li>
          <li alt="Se il tuo Istituto ha un convenzione con “Il Passalibro” inserisci qui il tuo ordine."><?php echo '<a href="' . tep_href_link(FILENAME_CONVENZIONI) . '">' . HEADER_AREA_CONVENZIONI . $cart_count . '</a>'; ?></li>
          <li alt="Acquista on-line i tuoi libri nuovi o usati e decidi se ritirarli in uno dei nostri negozi o farteli spedire a casa."><?php echo '<a href="' . tep_href_link(FILENAME_ADOZIONI) . '">' . MY_BOOKS_SCHOOL . '</a>'; ?></li>
          <li alt="Invia una richiesta delle tue necessità senza pagare, verrai ricontattato da un nostro operatore."><?php echo '<a href="' . tep_href_link(FILENAME_RICHIESTE) . '">' . MY_BOOKSTORE_DEMAND . '</a>'; ?></li>
	</ul>
  </div>
</div>
<div id="storeLogo">
<?php 
if ($_SERVER[HTTP_HOST]=='www.libreriasassuolo.it') {
    
echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'logo_59027913.jpg', STORE_NAME) . '</a>';     
    
} else {
    
echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo.png', STORE_NAME) . '</a>';
 
}
?>

</div>

</div>

<div id="searchbox" class="mysearch">
<?php echo tep_draw_form('search', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get') . tep_draw_hidden_field('search_in_description','1') . tep_draw_input_field('keywords', '', 'class="myinputbox" size="10" maxlength="100" placeholder="Cerca per: < Isbn | Titolo | Autore | Editore >"') . ' ' . tep_hide_session_id() .'<input class="mybutton" type="submit" name="Submit" value="Search">' . '</form>'; 

?>
</div>
<div id="headerBottom">
  <div class="infoBoxHeadingBground"><?php echo '&nbsp;&nbsp;' . $breadcrumb->trail(' &raquo; '); ?></div>
</div>


<?php
  if (isset($HTTP_GET_VARS['error_message']) && tep_not_null($HTTP_GET_VARS['error_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerError">
    <td class="headerError"><?php echo htmlspecialchars(stripslashes(urldecode($HTTP_GET_VARS['error_message']))); ?></td>
  </tr>
</table>
<?php
  }

  if (isset($HTTP_GET_VARS['info_message']) && tep_not_null($HTTP_GET_VARS['info_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerInfo">
    <td class="headerInfo"><?php echo htmlspecialchars(stripslashes(urldecode($HTTP_GET_VARS['info_message']))); ?></td>
  </tr>
</table>
<?php
  }

?>
