<?php
/*
  $Id: column_right.php,v 1.17 2003/06/09 22:06:41 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
  
  <div style="padding-top:5px"><?php if ($banner = tep_banner_exists('dynamic', 'baner_01')) echo tep_display_banner('static', $banner); ?></div>
  
*/
?>

<table border="0" cellspacing="0" cellpadding="0">
  <?php require DIR_WS_BOXES.'categories.php';?>
  <tr><td height="5"></td></tr>
  <?php require DIR_WS_BOXES.'specials.php';?>
  <tr><td height="5"></td></tr>
  <tr><td><?php require DIR_WS_BOXES.'best_sellers.php';?></td></tr>
  <tr><td height="10"></td></tr>
</table>


