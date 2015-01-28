<?php
/*
  $Id: search.php,v 1.22 2003/02/10 22:31:05 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- search //-->
          
            
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_SEARCH);

//  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents[] = array('form' => tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get'),
                               'align' => 'center',
                               'text' => tep_draw_input_field('keywords', BOX_HEADING_SEARCH1, 'size="10" maxlength="30" class="search_input" onfocus="if(this.value==\''.BOX_HEADING_SEARCH1.'\') this.value=\'\'" onblur="if(this.value==\'\') this.value=\''.BOX_HEADING_SEARCH1.'\'"') ,
                               'img' => tep_hide_session_id() . tep_image_submit('../../../../../images/button_quick_find.gif', BOX_HEADING_SEARCH1, 'id="search_bt"') ,
                               's_ad' => '<a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '" class="search_ad">' . BOX_SEARCH_ADVANCED_SEARCH . '</a>');

//  new infoBox($info_box_contents);
	
	
#	echo $info_box_contents[0][img];
	
?>

            
<!-- search_eof //-->
