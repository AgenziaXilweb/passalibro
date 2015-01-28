<?php
/*
  $Id: languages.php,v 1.15 2003/06/09 22:10:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- languages //-->
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_LANGUAGES);

  //new infoBoxHeading($info_box_contents, false, false);

  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language;
  }
  //echo '****';
  $languages_string = '';
  $info_box_contents = array();
  reset($lng->catalog_languages);
  while (list($key, $value) = each($lng->catalog_languages)) {
    $languages_string = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . tep_image(DIR_WS_IMAGES.'icon_'.$key.'.gif','','','','class="lang_icon"') . '</a>';
  $info_box_contents[] = array('align' => 'center',
                               'text' => $languages_string);
  }
//DIR_WS_LANGUAGES .  $value['directory'] . '/images/' . $value['image'], $value['name']
  //echo  $languages_string;
  //print_r ($info_box_contents);
  //new infoBox($info_box_contents);
?>
<!-- languages_eof //-->
