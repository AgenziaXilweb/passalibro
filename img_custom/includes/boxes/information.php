<?php
/*
  $Id: information.php,v 1.6 2003/02/10 22:31:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- information //-->
          <tr>
            <td>
<?php
  //$info_box_contents = array();
  //$info_box_contents[] = array('text' => BOX_HEADING_INFORMATION);

  //new infoBoxHeading($info_box_contents, false, false);

echo '<br><div id="box_infoWrmation_heading">'.tep_image_button('zag_info.gif', BOX_HEADING_INFORMATION).'</div>';
$text = '';
$text .='<div id="box_information">';
$text .='<a href="'.tep_href_link(FILENAME_SHIPPING).'">'.BOX_INFORMATION_SHIPPING.'</a><br>';
$text .='<a href="'.tep_href_link(FILENAME_PRIVACY).'">'.BOX_INFORMATION_PRIVACY.'</a><br>';
$text .='<a href="'.tep_href_link(FILENAME_CONDITIONS).'">'.BOX_INFORMATION_CONDITIONS.'</a><br>';
$text .='<a href="'.tep_href_link(FILENAME_CONTACT_US).'">'.BOX_INFORMATION_CONTACT.'</a><br>';
$text .='</div>';
echo $text;
?>
          </td>
          </tr>
<!--   information_eof //-->
