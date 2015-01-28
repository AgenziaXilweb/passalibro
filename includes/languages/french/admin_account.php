<?php
define('HEADING_TITLE', 'Gestion compte de l\'administration');

define('TABLE_HEADING_ACCOUNT', 'Mon compte');

define('TEXT_INFO_FULLNAME', '<b>Nom : </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Pr&eacute;nom : </b>');
define('TEXT_INFO_LASTNAME', '<b>Nom : </b>');
define('TEXT_INFO_EMAIL', '<b>Adresse Email : </b>');
define('TEXT_INFO_PASSWORD', '<b>Mot de passe : </b>');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Cach&eacute;-');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Confirmer le mot de passe : </b>');
define('TEXT_INFO_CREATED', '<b>Date de cr&eacute;ation : </b>');
define('TEXT_INFO_LOGDATE', '<b>Dernier acc&egrave;s : </b>');
define('TEXT_INFO_LOGNUM', '<b>Nombre d&acute;acc&egrave;s : </b>');
define('TEXT_INFO_GROUP', '<b>Niveau de Groupe : </b>');
define('TEXT_INFO_ERROR', '<font color="red">L&acute;adresse Email est d&eacute;j&agrave; utilis&eacute; ! Essayer avec une autre adresse.</font>');
define('TEXT_INFO_MODIFIED', 'Modifi&eacute; : ');

define('TEXT_INFO_HEADING_DEFAULT', 'Editer Le Compte ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Confirmer le mot de passe ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Mot de passe :');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="red"><b>Erreur :</b> mot de passe faux !</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Cliquer sur le bouton <b>&eacute;diter</b> pour modifier votre compte.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br /><b>Avertissement :</b><br />Bonjour <b>%s</b>, vous venez ici pour la premi&eagrave;re fois. Nous vous recommandons de changer votre mot de passe !');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br /><b>Avertissement :</b><br />Bonjour <b>%s</b>, nous vous recommandons de changer votre Email (<font color="red">admin@localhost</font>) et votre mot de passe !');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Tous les champs sont exig&eacute;s.');

define('JS_ALERT_FIRSTNAME',        '- Requis : Pr&eacute;nom \n');
define('JS_ALERT_LASTNAME',         '- Requis : Nom \n');
define('JS_ALERT_EMAIL',            '- Requis : Adresse Email \n');
define('JS_ALERT_PASSWORD',         '- Requis : Mot de passe \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Nombre minimum de lettre pour le pr&eacute;nom : ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Nombre minimum de lettre pour le nom : ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Nombre minimum de lettre pour le mot de passe : ');
define('JS_ALERT_EMAIL_FORMAT',     '- Email non valide ! \n');
define('JS_ALERT_EMAIL_USED',       '- Adresse email d&eacute;j&agrave; utilis&eacute; ! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Confirmation du mot de passe non valide ! \n');

define('ADMIN_EMAIL_SUBJECT', 'Changement des informations personnel');
define('ADMIN_EMAIL_TEXT', 'Bonjour %s,' . "\n\n" . 'vos informations personnel sur l&acute;administration a &eacute;t&eacute; chang&eacute;s. Si ceci a &eacute;tait fait sans votre connaissance ou consentement contactez l&acute;administrateur de toute urgence !  ' . "\n\n" . 'Site Web : %s' . "\n" . 'Nom d&acute;utilisateur : %s' . "\n" . 'Mot de passe : %s' . "\n\n" . 'Merci !' . "\n" . '%s' . "\n\n" . 'Ceci est un message automatis&eacute;, veuillez ne pas repondre !'); 
?>