<?php
  define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST']);
  define('HTTP_CATALOG_SERVER', 'http://'.$_SERVER['HTTP_HOST']);
  define('HTTPS_CATALOG_SERVER', 'https://'.$_SERVER['HTTP_HOST']);
  define('ENABLE_SSL_CATALOG', 'false');
  define('DIR_FS_DOCUMENT_ROOT', '/var/www/home/passalibro.com/');
  define('DIR_WS_ADMIN', '/admshop/');
  define('DIR_FS_ADMIN', '/var/www/home/passalibro.com/admshop/');
  define('DIR_WS_CATALOG', '/');
  define('DIR_FS_CATALOG', '/var/www/home/passalibro.com/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

  define('DB_SERVER', '172.19.0.30');
  define('DB_SERVER_USERNAME', 'passalibroweb');
  define('DB_SERVER_PASSWORD', 'passa20libro12');
  define('DB_DATABASE', 'passalibroweb');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
?>
