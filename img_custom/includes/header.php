<?php
/*
  $Id: header.php,v 1.42 2003/06/10 18:20:38 hpdl Exp $
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2003 osCommerce
  Released under the GNU General Public License





*/
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td align="right" height="25" valign="bottom">
      <?php include(DIR_WS_BOXES . 'languages.php'); ?>
      <table border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td class="headertext" style="color:#1E2526;"><?php echo BOX_HEADING_LANGUAGES; ?>&nbsp;&nbsp;</td>
          <td width="25"><?php echo $info_box_contents[0]['text'] ?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td valign="top" style="padding:0px 0 0 20px" height="65"><a href="<?php echo tep_href_link(FILENAME_DEFAULT); ?>" ><?php echo tep_image(DIR_WS_IMAGES . 'logo.gif'); ?></a></td>
  </tr>
  <tr>
    <td><?php echo tep_image(DIR_WS_IMAGES . 'header.gif'); ?></td>
  </tr>
  <tr>
    <td style="padding-bottom:4px">
      <table cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td width="139"><a title="<?php echo STORE_NAME;?>" href="<?php echo tep_href_link(FILENAME_DEFAULT); ?>" ><?php echo tep_image_button("../../../../../images/button1.gif", "home"," onMouseOver=\"button_act(this)\" onMouseOut=\"button_pas(this)\""); ?></a></td>
          <td width="136"><a title="<?php echo BOX_HEADING_WHATS_NEW;?>" href="<?php echo tep_href_link(FILENAME_PRODUCTS_NEW); ?>" ><?php echo tep_image_button("../../../../../images/button2.gif", BOX_HEADING_WHATS_NEW," onMouseOver=\"button_act(this)\" onMouseOut=\"button_pas(this)\""); ?></a></td>
          <td width="137"><a title="<?php echo BOX_HEADING_SEARCH;?>" href="<?php echo tep_href_link(FILENAME_ADVANCED_SEARCH); ?>" ><?php echo tep_image_button("../../../../../images/button3.gif", BOX_HEADING_SEARCH," onMouseOver=\"button_act(this)\" onMouseOut=\"button_pas(this)\""); ?></a></td>
          <td width="133"><a title="<?php echo BOX_HEADING_SPECIALS;?>" href="<?php echo tep_href_link(FILENAME_SPECIALS); ?>" ><?php echo tep_image_button("../../../../../images/button4.gif", BOX_HEADING_SPECIALS," onMouseOver=\"button_act(this)\" onMouseOut=\"button_pas(this)\""); ?></a></td>
          <td width="136"><a title="<?php echo HEADER_TITLE_MY_ACCOUNT;?>" href="<?php echo tep_href_link(FILENAME_ACCOUNT); ?>" ><?php echo tep_image_button("../../../../../images/button5.gif", HEADER_TITLE_MY_ACCOUNT," onMouseOver=\"button_act(this)\" onMouseOut=\"button_pas(this)\""); ?></a></td>
          <td width="135"><a title="<?php echo BOX_INFORMATION_CONTACT;?>" href="<?php echo tep_href_link(FILENAME_CONTACT_US); ?>" ><?php echo tep_image_button("../../../../../images/button6.gif", BOX_INFORMATION_CONTACT," onMouseOver=\"button_act(this)\" onMouseOut=\"button_pas(this)\""); ?></a></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <table cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td class="shoppad" align="center">
            <table border="0" cellspacing="0" cellpadding="0" align="center" width="180">
              <tr valign="middle">
                <td class="headertext"><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?> "><div style="float:left;padding-right:10px;"><?php echo tep_image(DIR_WS_IMAGES . 'cart.gif'); ?></div><?php echo BOX_HEADING_SHOPPING_CART; ?><br><b style="font-weight:normal">now in your cart <span id="shop_items"><b><?php echo $cart->count_contents(); ?></span> items</b><?php if($cart->count_contents()>1) echo "s"; ?></b></a></td>
              </tr>
            </table>
          </td>
          <td width="3"></td>
          <td class="number_up">
            <table cellspacing="0" cellpadding="0" border="0">
              <tr>
                <td style="padding-left:25px">
                 <table border="0" cellspacing="0" cellpadding="0"><tr><td valign="middle">
                  <?php  if ((USE_CACHE == 'true') && empty($SID)) {
                  echo tep_cache_manufacturers_box();
                  } else {
                  include(DIR_WS_BOXES . 'search.php');
                  echo $info_box_contents[0]['form'].'<table style="margin:0 0 0 0px"><tr><td valign="middle" class="headertext"><b>'. BOX_HEADING_SEARCH.': </b>';
                  echo $info_box_contents[0]['text']."</td><td valign='middle' style='padding-left:5px'>".$info_box_contents[0]['img'].'</td></tr></table></form>';
                  } ?>
                      </td>
                    </tr>
                  </table>
                </td>
                <td width="65">&nbsp;</td>
                <td class="headertext"><?php echo BOX_HEADING_CURRENCIES; ?>:&nbsp;&nbsp;</td>
                <td><?php require DIR_WS_BOXES.'currencies.php';?></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
