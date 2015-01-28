<?php
define('HEADING_TITLE', 'Manager de Backup Baza de Date');

define('TABLE_HEADING_TITLE', 'Titlu');
define('TABLE_HEADING_FILE_DATE', 'Data');
define('TABLE_HEADING_FILE_SIZE', 'Marime');
define('TABLE_HEADING_ACTION', 'Actiune');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Backup Nou');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restaurare Locala');
define('TEXT_INFO_NEW_BACKUP', 'Nu intrerupeti procesul de backup. Poate dura cateva minute.');
define('TEXT_INFO_UNPACK', '<br /><br />(dupa despachetarea fisierelor din arhiva)');
define('TEXT_INFO_RESTORE', 'Nu intrerupeti procesul de restaurare.<br /><br />Cu cat e mai mare marimea DB cu atat acest proces dureaza mai mult!<br /><br />Daca e posibil folositi clientul mysql .<br /><br />De examplu:<br /><br /><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'Nu intrerupeti procesul de restaurare.<br /><br />Cu cat e mai mare marimea DB cu atat acest proces dureaza mai mult!');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'Fisierul uploadat trebuie sa fie de tip sql raw (text).');
define('TEXT_INFO_DATE', 'Data:');
define('TEXT_INFO_SIZE', 'Marime:');
define('TEXT_INFO_COMPRESSION', 'Compresie:');
define('TEXT_INFO_USE_GZIP', 'Foloseste GZIP');
define('TEXT_INFO_USE_ZIP', 'Foloseste ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Fara Compresie (SQL Pur)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Doar Download (fara fisiere server)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Cel mai bine printr-o conectare HTTPS');
define('TEXT_DELETE_INTRO', 'Sunteti sigur(a) ca doriti sa stergeti acest backup?');
define('TEXT_NO_EXTENSION', 'Niciuna');
define('TEXT_BACKUP_DIRECTORY', 'Folder de Backup:');
define('TEXT_LAST_RESTORATION', 'Ultima restaurare:');
define('TEXT_FORGET', '(<u>uitat</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Eroare: Folderul de Backup nu exista. Va rog sa-l setati in fisierul configure.php.');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Eroare: Folderul de Backup nu poate fi scris.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Eroare: Link de download inacceptabil.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Succes: Ultima data de restaurare a fost stearsa.');
define('SUCCESS_DATABASE_SAVED', 'Succes: Baza de Date a fost salvata.');
define('SUCCESS_DATABASE_RESTORED', 'Succes: Baza de Date a fost restaurata.');
define('SUCCESS_BACKUP_DELETED', 'Succes: backup-ul a fost sters.');

// prefix table for multi store
define('TEXT_INFO_USE_PREFIX', 'Select for Backup only DB with the prefix ' . DB_PREFIX . ' or deselect for Backup all DB.');

?>