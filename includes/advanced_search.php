<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ADVANCED_SEARCH));

?>

<script type="text/javascript" src="general.js"></script>
<script type="text/javascript"><!--
function check_form() {
  var error_message = "<?php echo JS_ERROR; ?>";
  var error_found = false;
  var error_field;
  var keywords = document.advanced_search.keywords.value;
  var dfrom = document.advanced_search.dfrom.value;
  var dto = document.advanced_search.dto.value;
  var pfrom = document.advanced_search.pfrom.value;
  var pto = document.advanced_search.pto.value;
  var pfrom_float;
  var pto_float;

  if ( ((keywords == '') || (keywords.length < 1)) && ((dfrom == '') || (dfrom.length < 1)) && ((dto == '') || (dto.length < 1)) && ((pfrom == '') || (pfrom.length < 1)) && ((pto == '') || (pto.length < 1)) ) {
    error_message = error_message + "* <?php echo ERROR_AT_LEAST_ONE_INPUT; ?>\n";
    error_field = document.advanced_search.keywords;
    error_found = true;
  }

  if (dfrom.length > 0) {
    if (!IsValidDate(dfrom, '<?php echo DOB_FORMAT_STRING; ?>')) {
      error_message = error_message + "* <?php echo ERROR_INVALID_FROM_DATE; ?>\n";
      error_field = document.advanced_search.dfrom;
      error_found = true;
    }
  }

  if (dto.length > 0) {
    if (!IsValidDate(dto, '<?php echo DOB_FORMAT_STRING; ?>')) {
      error_message = error_message + "* <?php echo ERROR_INVALID_TO_DATE; ?>\n";
      error_field = document.advanced_search.dto;
      error_found = true;
    }
  }

  if ((dfrom.length > 0) && (IsValidDate(dfrom, '<?php echo DOB_FORMAT_STRING; ?>')) && (dto.length > 0) && (IsValidDate(dto, '<?php echo DOB_FORMAT_STRING; ?>'))) {
    if (!CheckDateRange(document.advanced_search.dfrom, document.advanced_search.dto)) {
      error_message = error_message + "* <?php echo ERROR_TO_DATE_LESS_THAN_FROM_DATE; ?>\n";
      error_field = document.advanced_search.dto;
      error_found = true;
    }
  }

  if (pfrom.length > 0) {
    pfrom_float = parseFloat(pfrom);
    if (isNaN(pfrom_float)) {
      error_message = error_message + "* <?php echo ERROR_PRICE_FROM_MUST_BE_NUM; ?>\n";
      error_field = document.advanced_search.pfrom;
      error_found = true;
    }
  } else {
    pfrom_float = 0;
  }

  if (pto.length > 0) {
    pto_float = parseFloat(pto);
    if (isNaN(pto_float)) {
      error_message = error_message + "* <?php echo ERROR_PRICE_TO_MUST_BE_NUM; ?>\n";
      error_field = document.advanced_search.pto;
      error_found = true;
    }
  } else {
    pto_float = 0;
  }

  if ( (pfrom.length > 0) && (pto.length > 0) ) {
    if ( (!isNaN(pfrom_float)) && (!isNaN(pto_float)) && (pto_float < pfrom_float) ) {
      error_message = error_message + "* <?php echo ERROR_PRICE_TO_LESS_THAN_PRICE_FROM; ?>\n";
      error_field = document.advanced_search.pto;
      error_found = true;
    }
  }

  if (error_found == true) {
    alert(error_message);
    error_field.focus();
    return false;
  } else {
    return true;
  }
}

function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=280,screenX=150,screenY=150,top=150,left=150')
}


//--></script>
<div id="accordion" >
    <h3><?php echo HEADING_TITLE_1; ?></h3>
    <?php
  if ($messageStack->size('search') > 0) {
    echo $messageStack->output('search');
  }
?>
    <div id="accordion_element">
        <p>
        <?php echo tep_draw_form('advanced_search', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get', 'onsubmit="return check_form(this);"') . tep_hide_session_id(); ?>
        <?php echo HEADING_SEARCH_CRITERIA; ?>
        <?php echo tep_draw_input_field('keywords', '', 'style="width: 100%"') . tep_draw_hidden_field('search_in_description', '1'); ?>
        <?php echo '<a href="' . tep_href_link(FILENAME_POPUP_SEARCH_HELP) . '" target="_blank" onclick="$(\'#helpSearch\').dialog(\'open\'); return false;">' . TEXT_SEARCH_HELP_LINK . '</a>'; ?>
        <br />
        <div id="helpSearch" title="<?php echo HEADING_SEARCH_HELP; ?>">
        <p><?php echo TEXT_SEARCH_HELP; ?><br /><br /><a href="<?php echo tep_href_link(basename($PHP_SELF), tep_get_all_get_params()); ?>" onclick="document.getElementById('helpSearch').style.display='none';">Chiudi</a></p>
        </div>
        <script type="text/javascript">
            $('#helpSearch').dialog({
                autoOpen: false
            });

        </script>
        <?php echo ENTRY_CATEGORIES; ?>
        <?php echo tep_draw_pull_down_menu('categories_id', tep_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES)))); ?>
        <br />
        <?php echo tep_draw_checkbox_field('inc_subcat', '1', true) . ' ' . ENTRY_INCLUDE_SUBCATEGORIES; ?>
        <br />
        <?php echo ENTRY_MANUFACTURERS; ?>
        <?php echo tep_draw_pull_down_menu('manufacturers_id', tep_get_manufacturers(array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS)))); ?>
        <br />
        <?php echo ENTRY_PRICE_FROM; ?>
        <?php echo tep_draw_input_field('pfrom'); ?>
        <?php echo ENTRY_PRICE_TO; ?>
        <?php echo tep_draw_input_field('pto'); ?>
        <br />
        <?php echo ENTRY_DATE_FROM; ?>
        <?php echo tep_draw_input_field('dfrom', '', 'id="dfrom"'); ?><script type="text/javascript">$('#dfrom').datepicker({dateFormat: '<?php echo JQUERY_DATEPICKER_FORMAT; ?>', changeMonth: true, changeYear: true, yearRange: '-10:+0'});</script>
        <?php echo ENTRY_DATE_TO; ?>
        <?php echo tep_draw_input_field('dto', '', 'id="dto"'); ?><script type="text/javascript">$('#dto').datepicker({dateFormat: '<?php echo JQUERY_DATEPICKER_FORMAT; ?>', changeMonth: true, changeYear: true, yearRange: '-10:+0'});</script>
        <br />
    <span style="float: right;"><?php echo tep_draw_button(IMAGE_BUTTON_SEARCH, 'search', null, 'primary'); ?></span>
  </div>
</div>

</form>
        </p>
    </div>
    
</div>
 
