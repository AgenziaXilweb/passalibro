<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  $cl_box_groups[] = array(
    'heading' => BOX_HEADING_EBAY,
    'apps' => array(
      array(
        'code' => FILENAME_EBAY,
        'title' => BOX_EBAY_CATALOG,
        'link' => tep_href_link(FILENAME_EBAY)
      ),
      array(
        'code' => FILENAME_EBAY_CATEGORIES,
        'title' => BOX_EBAY_CATEGORIES,
        'link' => tep_href_link(FILENAME_EBAY_CATEGORIES)
      )
    )
  );
?>
