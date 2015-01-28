<?php
define('HEADING_TITLE', 'Administrator-Konto');

define('TABLE_HEADING_ACCOUNT', 'Mein Konto');

define('TEXT_INFO_FULLNAME', '<b>Name: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Vorname: </b>');
define('TEXT_INFO_LASTNAME', '<b>Nachname: </b>');
define('TEXT_INFO_EMAIL', '<b>Email Address: </b>');
define('TEXT_INFO_PASSWORD', '<b>Kennwort: </b>');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Versteckt-');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Best&auml;tigen Sie das Kennwort: </b>');
define('TEXT_INFO_CREATED', '<b>Konto erstellt: </b>');
define('TEXT_INFO_LOGDATE', '<b>Letzter Login: </b>');
define('TEXT_INFO_LOGNUM', '<b>Anzahl Anmeldungen: </b>');
define('TEXT_INFO_GROUP', '<b>Gruppen-Level: </b>');
define('TEXT_INFO_ERROR', '<font color="red">Die Email Adresse wird bereits verwendet! Bitte erneut versuchen.</font>');
define('TEXT_INFO_MODIFIED', 'Ge&auml;ndert: ');

define('TEXT_INFO_HEADING_DEFAULT', 'Konto bearbeiten ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Kennwort-Best&auml;tigung ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Kennwort:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="red"><b>FEHLER:</b> falsches Kennwort!</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Klicken Sie auf <B><I>Bearbeiten</I></B>, um Ihre Kontoinformationen zu &auml;ndern.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br /><b>Warnung:</b><br />Hallo <b>%s</b>, Dies ist Ihr erster Besuch, wir empfehlen dringend eine &Auml;nderung des Passworts!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br /><b>WARNUNG:</b><br />Hallo <b>%s</b>, Wir empfehlen eine &Auml;nderung Ihrer Email von <font color="red">admin@localhost</font> und Ihres Kennworts!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Alle Felder m&uuml;ssen ausgef&uuml;llt werden.');

define('JS_ALERT_FIRSTNAME',        '- Bitte definieren: Vorname \n');
define('JS_ALERT_LASTNAME',         '- Bitte definieren: Nachname \n');
define('JS_ALERT_EMAIL',            '- Bitte definieren: Email Addresse \n');
define('JS_ALERT_PASSWORD',         '- Bitte definieren: Kennwort \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Vorname ist zu kurz ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Nachnahme ist zu kurz ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Kennwort ist zu kurz ');
define('JS_ALERT_EMAIL_FORMAT',     '- Format der Email Adresse ist unzul&auml;ssig! \n');
define('JS_ALERT_EMAIL_USED',       '- Die Email-Adresse ist bereits vergeben! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Passworte sind unterschiedlich, bitte noch einmal eingeben! \n');

define('ADMIN_EMAIL_SUBJECT', 'Pers&ouml;nliche Informationen wurden bearbeitet');
define('ADMIN_EMAIL_TEXT', 'Hallo %s,' . "\n\n" . 'Ihre pers&ouml;nlichen Informationen, m&ouml;glicherweise auch Ihr Kennwort, sind ge&auml;ndert worden. Wenn dies ohne Ihr Wissen oder Ihre Zustimmung geschehen ist, treten Sie mit dem Administrator schnellstens in Verbindung!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Dies ist eine automatische Nachricht, bitte antworten Sie nicht!');
?>
