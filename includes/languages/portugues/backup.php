<?php
define('HEADING_TITLE', 'Gest&atilde;o de C&oacute;pias de Seguran&ccedil;a da Base de Dados');

define('TABLE_HEADING_TITLE', 'T&iacute;tulo');
define('TABLE_HEADING_FILE_DATE', 'Data');
define('TABLE_HEADING_FILE_SIZE', 'Tamanho');
define('TABLE_HEADING_ACTION', 'Ac&ccedil;&atilde;o');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nova c&oacute;pia');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Recupera&ccedil;&atilde;o local');
define('TEXT_INFO_NEW_BACKUP', 'N&atilde;o interrompa o processo de c&oacute;pia de seguran&ccedil;a (pode demorar alguns minutos).');
define('TEXT_INFO_UNPACK', '<br /><br />(ap&oacute;s expandir o ficheiro do arquivo)');
define('TEXT_INFO_RESTORE', 'N&atilde;o interrompa o processo de recupera&ccedil;&atilde;o.<br /><br />Quanto maior &eacute; a c&oacute;pia de seguran&ccedil;a mais tempo demora a recupera&ccedil;&atilde;o!<br /><br />Se poss&iacute;vel utilize o cliente MySQL.<br /><br />Por exemplo:<br /><br /><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'N&atilde;o interrompa o processo de recupera&ccedil;&atilde;o.<br /><br />>Quanto maior &eacute; a c&oacute;pia de seguran&ccedil;a mais tempo demora a recupera&ccedil;&atilde;o!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'O ficheiro carregado que que ser um ficheiro sequencial de sql (texto).');
define('TEXT_INFO_DATE', 'Data:');
define('TEXT_INFO_SIZE', 'Tamanho:');
define('TEXT_INFO_COMPRESSION', 'Compress&atilde;o:');
define('TEXT_INFO_USE_GZIP', 'Utilize o GZIP');
define('TEXT_INFO_USE_ZIP', 'Utilize o ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sem compress&atilde;o (SQL Puro)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Descarregar apenas (n&atilde;o armazene no servidor)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Melhor atrav&eacute;s de uma liga&ccedil;&atilde;o HTTPS');
define('TEXT_NO_EXTENSION', 'Nenhum');
define('TEXT_BACKUP_DIRECTORY', 'Pasta para a c&oacute;pia de seguran&ccedil;a:');
define('TEXT_LAST_RESTORATION', '&Uacute;ltima recupera&ccedil;&atilde;o:');
define('TEXT_FORGET', '(<u>esquecido</u>)');
define('TEXT_DELETE_INTRO', 'Tem a certeza que quer apagar esta c&oacute;pia de seguran&ccedil;a?');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Erro: A pasta para c&oacute;pia de seguran&ccedil;a n&atilde;o existe. Por favor defina-a em \'configure.php\'.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Erro: A pasta para a c&oacute;pia de seguran&ccedil;a n&atilde;o pode ser escrita.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Erro: Liga&ccedil;&atilde;o para descarregar n&atilde;o aceite.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Successo: A data da &uacute;lima recupera&ccedil;&atilde;o foi limpa.');
define('SUCCESS_DATABASE_SAVED', 'Successo: A base de dados foi guardada.');
define('SUCCESS_DATABASE_RESTORED', 'Successo: A base de dados foi recuperada.');
define('SUCCESS_BACKUP_DELETED', 'Successo: A c&oacute;pia de seguran&ccedil;a foi apagada.');

// prefix table for multi store
define('TEXT_INFO_USE_PREFIX', 'Select for Backup only DB with the prefix ' . DB_PREFIX . ' or deselect for Backup all DB.');

?>