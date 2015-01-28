<?php
if ($_GET['gID']) {
  define('HEADING_TITLE', 'Gestion des groupes');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'D&eacute;finir les groupes');
} else {
  define('HEADING_TITLE', 'Gestion des membres');
}

define('TEXT_COUNT_GROUPS', 'Groupes : ');

define('TABLE_HEADING_NAME', 'Nom');
define('TABLE_HEADING_EMAIL', 'Adresse Email');
define('TABLE_HEADING_PASSWORD', 'Mot de passe');
define('TABLE_HEADING_CONFIRM', 'Confirmer le mot de passe');
define('TABLE_HEADING_GROUPS', 'Niveau du groupe');
define('TABLE_HEADING_CREATED', 'Date de cr&eacute;ation');
define('TABLE_HEADING_MODIFIED', 'Date de modification');
define('TABLE_HEADING_LOGDATE', 'Dernier acc&egrave;s');
define('TABLE_HEADING_LOGNUM', 'Acc&egrave;s');
define('TABLE_HEADING_LOG_NUM', 'Nombre d&acute;acc&egrave;s');
define('TABLE_HEADING_ACTION', 'Action');

define('TABLE_HEADING_GROUPS_NAME', 'Nom du groupe');
define('TABLE_HEADING_GROUPS_DEFINE', 'Bo&icirc;tes et choix des dossiers');
define('TABLE_HEADING_GROUPS_GROUP', 'Niveau');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Permission de cat&eacute;gories');

define('TEXT_INFO_HEADING_DEFAULT', 'Gestion du membre');
define('TEXT_INFO_HEADING_DELETE', 'Effacement de permission ');
define('TEXT_INFO_HEADING_EDIT', 'Editer la Cat&eacute;gorie / ');
define('TEXT_INFO_HEADING_NEW', 'Nouveau membre d&acute;Admin ');

define('TEXT_INFO_DEFAULT_INTRO', 'Membre du groupe ');
define('TEXT_INFO_DELETE_INTRO', 'Supprimer <b>%s</b> des membres de l\'administration ?');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Vous ne pouvez pas supprimer %s du groupe !');
define('TEXT_INFO_EDIT_INTRO', 'Placer le niveau de permission : ');

define('TEXT_INFO_FULLNAME', 'Nom : ');
define('TEXT_INFO_FIRSTNAME', 'Pr&eacute;nom : ');
define('TEXT_INFO_LASTNAME', 'Nom : ');
define('TEXT_INFO_EMAIL', 'Adresse Email : ');
define('TEXT_INFO_PASSWORD', 'Mot de passe : ');
define('TEXT_INFO_CONFIRM', 'Confirmer le mot de passe : ');
define('TEXT_INFO_CREATED', 'Date de cr&eacute;ation : ');
define('TEXT_INFO_MODIFIED', 'Date de modification : ');
define('TEXT_INFO_LOGDATE', 'Dernier acc&egrave;s : ');
define('TEXT_INFO_LOGNUM', 'Nombre d&acute;acc&egrave;s : ');
define('TEXT_INFO_GROUP', 'Niveau du groupe : ');
define('TEXT_INFO_ERROR', '<font color="#ff0000">L&acute;adresse Email est d&eacute;j&agrave; utilis&eacute; ! Essayer avec une autre adresse.</font>');

define('JS_ALERT_FIRSTNAME', '- Requis : Pr&eacute;nom \n');
define('JS_ALERT_LASTNAME', '- Requis : Nom \n');
define('JS_ALERT_EMAIL', '- Requis : Adresse Email \n');
define('JS_ALERT_EMAIL_FORMAT', '- Email non valide ! \n');
define('JS_ALERT_EMAIL_USED', '- Adresse email d&eacute;j&agrave; utilis&eacute; ! \n');
define('JS_ALERT_LEVEL', '- Requis : Un niveau de groupe \n');

define('ADMIN_EMAIL_SUBJECT', 'Nouveau Membre Administratif %s: %s %s');
define('ADMIN_EMAIL_TEXT', 'Bonjour %s,' . "\n\n" . 'vous pouvez acc&eacute;der au panneau d&acute;administration avec le mot de passe suivant. Une fois que vous acc&eacute;dez &agrave; l&acute;admin, changez svp votre mot de passe !' . "\n\n" . 'Site Web : %s' . "\n" . 'Nom d&acute;utilisateur : %s' . "\n" . 'Mot de passe : %s' . "\n\n" . 'Merci !' . "\n" . '%s' . "\n\n" . 'Ceci est un message automatis&eacute;, veuillez ne pas repondre !'); 
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Changement pour administration');
define('ADMIN_EMAIL_EDIT_TEXT', 'Bonjour %s,' . "\n\n" . 'Vos informations personnelle a &eacute;t&eacute; mise &agrave; jour par un administrateur.' . "\n\n" . 'Site Web : %s' . "\n" . 'Nom d&acute;utilisateur : %s' . "\n" . 'Mot de passe : %s' . "\n\n" . 'Merci !' . "\n" . '%s' . "\n\n" . 'Ceci est un message automatis&eacute;, veuillez ne pas repondre !'); 

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Gestion du groupe');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Supprimer un groupe');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>NOTE :</b><br /><br /><li><b>Editer :</b> Editer le nom du groupe.</li><br /><br /><li><b>Effacer :</b> Supprimer un groupe.</li><br /><br /><li><b>Permission :</b> D&eacute;finir les acc&egrave;s d&acute;un groupe.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', '<font color="red">ATTENTION :</font> la suppression de ce groupe supprimera &eacute;galement les membres. Etes vous s&ucirc;r de vouloir supprimer le groupe <nobr><b>%s</b> ?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Vous ne pouvez pas supprimer ce groupe !');
define('TEXT_INFO_GROUPS_INTRO', 'Donner un nom pour le groupe');
define('TEXT_INFO_HEADING_EDIT_GROUP', 'Nom du groupe');

define('TEXT_INFO_EDIT_GROUP_INTRO', 'Vous pouvez renommer le nom du groupe. <font color="red"><br />ATTENTION :</font> le nom doit comporter au minimum <b>6 lettres.</b>');
define('TEXT_INFO_HEADING_GROUPS', 'Nouveau groupe');
define('TEXT_INFO_GROUPS_NAME', ' <b>Nom du groupe :</b><br />Donner un nom pour le nouveau groupe puis cliquer sur <b>suivant</b>.<br />');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>ERREUR :</b> Le nom du groupe doit contenir plus de 5 caract&egrave;re !</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>ERREUR :</b> Le nom du groupe est d&eacute;j&agrave; utilis&eacute; !</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Niveau du groupe : ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Permission des bo�tes :</b><br /> Donner les acc&egrave;s dans les bo&icirc;tes.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Iclure les dossiers : ');

define('TEXT_INFO_HEADING_DEFINE', 'D&eacute;finir les groupes');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>Groupe %s :</b><br /><br />Vous ne pouvez pas changer la permission de(s) dossier(s) pour ce groupe.<br /><br />');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>Groupe %s :</b><br /><br /><li>Changez la permission pour ce groupe en choisissant les bo&icirc;tes et les dossiers.</li><br /><br /><li>Cliquer sur <b>sauver</b> apres modification.</li><br /><br />');
}


// BOF: KategorienAdmin / OLISWISS
define('TEXT_INFO_CATEGORIEACCESS','Categorie Access:');
define('TEXT_RIGHTS_CNEW','create Categorie');
define('TEXT_RIGHTS_CEDIT','edit Categorie');
define('TEXT_RIGHTS_CMOVE','move Categorie');
define('TEXT_RIGHTS_CDELETE','delete Categorie');
define('TEXT_RIGHTS_PNEW','create Product');
define('TEXT_RIGHTS_PEDIT','edit product');
define('TEXT_RIGHTS_PMOVE','move Product');
define('TEXT_RIGHTS_PCOPY','copy Product');
define('TEXT_RIGHTS_PDELETE','delete Product');
// EOF: KategorienAdmin / OLISWISS
?>