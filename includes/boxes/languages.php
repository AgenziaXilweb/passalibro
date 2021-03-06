<?php
/*
  $Id: languages.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- languages //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_LANGUAGES);

  new infoBoxHeading($info_box_contents, false, false);

  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language;
  }

  $languages_string = '';
  reset($lng->catalog_languages);
  $i = 0;  
  while (list($key, $value) = each($lng->catalog_languages)) {
  if ($i)  $languages_string .= tep_image(DIR_WS_IMAGES.'flag_sep.gif','','','',' class="flag_sep"');
  $languages_string .= '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . tep_image(DIR_WS_LANGUAGES . $value['directory'] . '/images/' . $value['image'], $value['name'],'','',' style=" vertical-align:top;margin-top:4px;"') . '</a>';
 $i++;
 }

  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'center',
                               'text' => '<div class="languages" align="center">'.$languages_string.'</div>');

    new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- languages_eof //-->
