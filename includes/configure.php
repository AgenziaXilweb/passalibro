<?php
  define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST']);
  define('HTTPS_SERVER', 'https://'.$_SERVER['HTTP_HOST']);
  define('ENABLE_SSL', false);
  define('HTTP_COOKIE_DOMAIN', '');
  define('HTTPS_COOKIE_DOMAIN', '');
  define('HTTP_COOKIE_PATH', '/');
  define('HTTPS_COOKIE_PATH', '/');
  define('DIR_WS_HTTP_CATALOG', '/');
  define('DIR_WS_HTTPS_CATALOG', '/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ISBN', DIR_WS_IMAGES . 'ISBN/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_WAREHOUSE', DIR_WS_MODULES . 'warehouse/');

  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', '/var/www/home/passalibro.com/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

  define('DB_SERVER', '172.19.0.30');
  define('DB_SERVER_USERNAME', 'passalibroweb');
  define('DB_SERVER_PASSWORD', 'passa20libro12');
  define('DB_DATABASE', 'passalibroweb');
  define('USE_PCONNECT', 'true');
  define('STORE_SESSIONS', 'mysql');
  
  #CONNESSIONE PASSALIBRO DB GESTIONALE

  define('DB_SERVER_GEST', '172.19.0.30');
  define('DB_SERVER_GEST_USERNAME', 'passalibroweb');
  define('DB_SERVER_GEST_PASSWORD', 'passa20libro12');
  define('DB_DATABASE_GEST', 'passalibro');
?>
