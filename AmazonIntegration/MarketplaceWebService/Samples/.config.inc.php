<?php
// include the list of project database tables
  define('DB_SERVER', '172.19.0.30');
  define('DB_SERVER_USERNAME', 'passalibroweb');
  define('DB_SERVER_PASSWORD', 'passa20libro12');
  define('DB_DATABASE', 'passalibroweb');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
require ('../../../includes/database_tables.php');

// include the database functions
require ('../../../includes/functions/database.php');


// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');
   
   define ('DATE_FORMAT', 'Y-m-d\TH:i:s\Z');

   /************************************************************************
    * REQUIRED
    *
    * * Access Key ID and Secret Acess Key ID, obtained from:
    * http://aws.amazon.com
    *
    * IMPORTANT: Your Secret Access Key is a secret, and should be known
    * only by you and AWS. You should never include your Secret Access Key
    * in your requests to AWS. You should never e-mail your Secret Access Key
    * to anyone. It is important to keep your Secret Access Key confidential
    * to protect your account.
    ***********************************************************************/
    define('AWS_ACCESS_KEY_ID', 'AKIAIIBJM37JY2YJW4FQ');
    define('AWS_SECRET_ACCESS_KEY', 'Gu4h0WK5/FcY7DiqGu5hux66IJWIdVOL4fsrb0lR');

   /************************************************************************
    * REQUIRED
    * 
    * All MWS requests must contain a User-Agent header. The application
    * name and version defined below are used in creating this value.
    ***********************************************************************/
    define('APPLICATION_NAME', 'Passalibro');
    define('APPLICATION_VERSION', '1.0');
    
   /************************************************************************
    * REQUIRED
    * 
    * All MWS requests must contain the seller's merchant ID and
    * marketplace ID.
    ***********************************************************************/
    
    # Definisco tutti i MERCHANT_ID di tutte le sedi.
    $merchant_query = tep_db_query("SELECT sede, merchantID FROM " .
    TABLE_ACCOUNT_EXTERNAL." WHERE piattaforma = 'amazon'");
    while ($merchant = tep_db_fetch_array($merchant_query)) {
        define('MERCHANT_ID_'.$merchant['sede'], $merchant['merchantID']);
    }
    
   /************************************************************************ 
    * OPTIONAL ON SOME INSTALLATIONS
    *
    * Set include path to root of library, relative to Samples directory.
    * Only needed when running library from local directory.
    * If library is installed in PHP include path, this is not needed
    ***********************************************************************/   
    set_include_path(get_include_path() . PATH_SEPARATOR . '../../.');
    
   /************************************************************************ 
    * OPTIONAL ON SOME INSTALLATIONS  
    * 
    * Autoload function is reponsible for loading classes of the library on demand
    * 
    * NOTE: Only one __autoload function is allowed by PHP per each PHP installation,
    * and this function may need to be replaced with individual require_once statements
    * in case where other framework that define an __autoload already loaded.
    * 
    * However, since this library follow common naming convention for PHP classes it
    * may be possible to simply re-use an autoload mechanism defined by other frameworks
    * (provided library is installed in the PHP include path), and so classes may just 
    * be loaded even when this function is removed
    ***********************************************************************/   
     function __autoload($className){
        $filePath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        $includePaths = explode(PATH_SEPARATOR, get_include_path());
        foreach($includePaths as $includePath){
            if(file_exists($includePath . DIRECTORY_SEPARATOR . $filePath)){
                require_once $filePath;
                return;
            }
        }
    }
  


