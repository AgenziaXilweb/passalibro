<?php
/*
  $Id: tell_a_friend.php,v 1.16 2003/06/10 18:26:33 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- tell_a_friend //-->
<?php
  if (isset($int_inp)){
  $int_inp=(int)$int_inp;
  if ($int_inp<5) $int_inp=15;}
  else $int_inp=15;
  
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_TELL_A_FRIEND);

  //new infoBoxHeading($info_box_contents, false, false);
  if (!$HTTP_GET_VARS['products_id']) {
   $tell_products_query = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p where products_status = '1' order by p.products_date_added desc limit " . 1);
   $tell_products = tep_db_fetch_array($tell_products_query);
   $tell_id=$tell_products['products_id'];
  }
  else $tell_id=$HTTP_GET_VARS['products_id'];
  $info_box_contents = array();
  $info_box_contents[] = array('form' => tep_draw_form('tell_a_friend', tep_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL', false), 'get'),
                               'align' => 'center',
                               'text' => tep_draw_input_field('to_email_address', '', 'size="10"') . '&nbsp;' . tep_image_submit('button_tell_a_friend.gif', BOX_HEADING_TELL_A_FRIEND) . tep_draw_hidden_field('products_id', $tell_id) . tep_hide_session_id() . '<br>' . BOX_TELL_A_FRIEND_TEXT,
                               'input' => tep_draw_input_field('to_email_address', '', 'size="'.$int_inp.'" class="inp_tell"'),
                               'img' => tep_image_submit('button_ok.gif', BOX_HEADING_TELL_A_FRIEND)
                               );
                               
  //print_r ($info_box_contents);
  //new infoBox($info_box_contents);
?>
<!-- tell_a_friend_eof //-->
