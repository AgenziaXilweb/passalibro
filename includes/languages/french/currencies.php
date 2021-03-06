<?php
define('HEADING_TITLE', 'Devises');

define('TABLE_HEADING_CURRENCY_NAME', 'Devise');
define('TABLE_HEADING_CURRENCY_CODES', 'Code');
define('TABLE_HEADING_CURRENCY_VALUE', 'Valeur');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_EDIT_INTRO', 'Merci de faire les changements n&eacute;cessaires');
define('TEXT_INFO_CURRENCY_TITLE', 'Titre :');
define('TEXT_INFO_CURRENCY_CODE', 'Code:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'Symbole gauche :');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'Symbole droit :');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Point d&eacute;cimal :');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'S&eacute;parateur de milliers :');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'Nombre de d&eacute;cimales :');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Derni&egrave;re mise &agrave; jour :');
define('TEXT_INFO_CURRENCY_VALUE', 'Valeur :');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Exemple de sortie :');
define('TEXT_INFO_INSERT_INTRO', 'Merci de rentrer la nouvelle devise avec ces don&eacute;es li&eacute;es');
define('TEXT_INFO_DELETE_INTRO', 'Etes vous sur de vouloir supprimer cette devise ?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nouvelle devise');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Editer devise');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Supprimer devise');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (Requiert une mise &agrave; jour manuelle de la valeur de la devise)');
define('TEXT_INFO_CURRENCY_UPDATED', 'Le taux de change pour %s (%s) a &eacute;t&eacute; mis &agrave; jour avec succ&egrave;s par l&acute;interm&eacute;diaire de %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Erreur : La devise par d&eacute;faut ne peut &ecirc;tre supprim&eacute;e. Merci de choisir une autre devise par d&eacute;faut et de r&eacute;essayer.');
define('ERROR_CURRENCY_INVALID', 'Erreur : Le taux de change pour %s (%s) n&acute;a pas &eacute;t&eacute; mis &agrave; jour par l&acute;interm&eacute;diaire de %s. S&acute;agit t&acute;il d&acute;un code devise valide ?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Attention : Le serveur de taux de change primaire (%s) a echou&eacute; %s (%s) - essayer avec le serveur de taux de change secondaire.');
?>