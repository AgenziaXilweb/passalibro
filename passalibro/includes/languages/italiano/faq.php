<?php

  $action = (!empty($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '' );

	if ( $action == 'new_faq' ){

		  define('HEADING_TITLE', 'FAQDesk - New Question');

	} elseif ( $action == 'edit_faq' ){

		  define('HEADING_TITLE', 'FAQDesk - Edit Question');

	} elseif ( $action == 'preview_faq' ){

		  define('HEADING_TITLE', 'FAQDesk - Preview');

	} else {

		  define('HEADING_TITLE', 'FAQDesk - Manage FAQ');

	}

  define('TABLE_HEADING_FAQ_ID', 'ID');

  define('TABLE_HEADING_FAQ_QUESTION', 'Question');

  define('TABLE_HEADING_FAQ_STATUS', 'Status');

  define('TABLE_HEADING_FAQ_LAST_MODIFIED', 'Last Modified');







  define('TEXT_HEADING_DELETE_INTRO', 'Delete FAQ entry #%s?');

  define('TEXT_HEADING_DELETE_FAQ', '');





  define('TITLE_ADD_QUESTION', 'New Question:');

  define('TITLE_ADD_ANSWER', 'New Answer:');

  define('TITLE_STATUS', 'Status:');

  define('TITLE_SORT', 'Sort Order:');



  define('TEXT_ON', 'On');

  define('TEXT_OFF', 'Off');

  define('TEXT_QUESTION', 'Question:');

  define('TEXT_ANSWER', 'Answer:');

  define('TEXT_LAST_UPDATED', 'last updated - ');

  define('TEXT_DISPLAY_NUMBER_OF_QUESTIONS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> questions)');

  define('TEXT_CLICK_REVEAL', 'Click on question to reveal the answer.');

?>

