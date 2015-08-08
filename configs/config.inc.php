<?php
/**
 * @PAR Prepare path & url variables
 * @var $aplUrl - The base url of site
 * @var $aplPath - The apsolute path of the base url
 * @var $aplEntry - entry point, i.e. invoked root file (index.php, popup.php, etc)
 */

define('CODE_MAKER', 'CS');
define('SEOURLS', 1); // 1 = enabled, 0 = disabled

$aplUrl = '';
$aplPath = '';
$aplEntry = '';
$tmp_https = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != '') ? strtolower($_SERVER['HTTPS']) : 'off'; //IIS will use 'off' others will keep undefined
$tmp_port = (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] > 0) ? $_SERVER["SERVER_PORT"] : 0;
if ($tmp_https == 'off') {
    $aplUrl = 'http://';
    // remove port if it is default for this protocol
    if ($tmp_port == 80) $tmp_port = 0;
} else {
    $aplUrl = 'https://';
    // remove port if it is default for this protocol
    if ($tmp_port == 443) $tmp_port = 0;
}

$aplUrl .= $_SERVER["SERVER_NAME"];
// add non standard port on the URL
if ($tmp_port > 0) {
    $aplUrl .= ':'.$tmp_port;
}
// add script path without / at the end
$aplUrl = rtrim($aplUrl . dirname($_SERVER["PHP_SELF"]),'/\\');
$aplEntry = basename($_SERVER["PHP_SELF"]);
if (isset($_SERVER["SCRIPT_FILENAME"])) {
    $aplPath = str_replace("//","/",str_replace("\\","/",dirname($_SERVER["SCRIPT_FILENAME"])));
} else {
    $aplPath = str_replace("//","/",str_replace("\\","/",dirname($_SERVER["PATH_TRANSLATED"])));
}

$baseUrl = $aplUrl . '/';
$fullUrl = $baseUrl . $aplEntry;
define("BASE_URL", $baseUrl);

unset($tmp_https);
unset($tmp_port);

/**
 * @PAR Prepare php environment
 * First detect php version and check do we work under development environment,
 * then prepare php to be independent from outside settings as much as possible
 */
//ini_set('memory_limit','32M');
ini_set('magic_quotes_gpc','1');
ini_set('magic_quotes_runtime','0');
ini_set('magic_quotes_sybase','0');
ini_set('default_charset','UTF-8');
ini_set('mbstring.internal_encoding','UTF-8');
ini_set('error_reporting',E_ALL);
ini_set("session.use_cookies",1);
ini_set("session.use_only_cookies",0);
ini_set("use_trans_sid",1);

// can redefine do we work in development or production environment
$_sys_development_environment = false;

if ($_sys_development_environment == true) {
    ini_set('display_startup_errors','1');
    ini_set('display_errors','1');
    ini_set('html_errors','1');
    ini_set('log_errors','1');
    ini_set('error_log',$aplPath.'/log/error.log');
} else {
    ini_set('display_startup_errors','0');
    ini_set('display_errors','0');
    ini_set('html_errors','0');
    ini_set('error_append_string',"\n");
    ini_set('log_errors','1');
    ini_set('error_log','/log/error.log');
}

if (!version_compare(phpversion(),'5.0.0','<')) {
    // put here ini_Set commands specific for php5 or above
    ini_set('zend.ze1_compatibility_mode','0');
    ini_set('date.timezone','Europe/Paris');
}


/* required functions */
require_once (BASE_PATH . "php_functions/controller_functions.php");
require_once (BASE_PATH . "php_functions/seo_functions.php");
require_once (BASE_PATH . "php_functions/various.php");

//REQUIRED CLASSE   
require_once (BASE_PATH . "classes/user.class.php");
require_once (BASE_PATH . "classes/articles.class.php");
require_once (BASE_PATH . "classes/history.class.php");
require_once (BASE_PATH . "classes/page.class.php");
require_once (BASE_PATH . "classes/gallery.class.php");
require_once (BASE_PATH . "classes/picture.class.php");
require_once (BASE_PATH . "classes/contact_us.class.php");
require_once (BASE_PATH . "classes/products.class.php");
require_once (BASE_PATH . "classes/route.class.php");
require_once (BASE_PATH . "classes/blood-dairy.class.php");
require_once (BASE_PATH . "classes/bmi.class.php");


/**
 * Prepare DB connection
 * If connection failed then write error to log and leave script
 */
require_once 'configs/db_config.inc.php';
$con = mysql_connect($server,$user,$password);
if (!$con)
  {
    error_log ('Database connection failed! File: '.__FILE__.' Line: '.__LINE__.'', 0);
    die('Could not connect: ' . mysql_error());
  }

// select the current db
$db = mysql_select_db($database, $con);
if (!$db) {
    error_log ('Can\'t use database : '. mysql_error() . ' > File: '.__FILE__.' > Line: '.__LINE__.'', 0);
    die ('Can\'t use database : ' . mysql_error());
}
mysql_query("SET NAMES 'utf8'");

/**
 * @PAR Configure Smarty
 * Configuration depends on $_sys_development_environment
 */
require_once (BASE_PATH . "external/libs/Smarty.class.php");

$smarty = new Smarty;

$smarty->compile_check = true;
$smarty->debugging = false;
$smarty->error_reporting = error_reporting(E_ALL);
$smarty->template_dir = BASE_PATH . "templates/";
$smarty->compile_dir = BASE_PATH . "templates_c/";
$smarty->left_delimiter = "{[";
$smarty->right_delimiter = "]}";


$smarty->register_function('checkUserPrivileges', 'checkUserPrivilegesSmarty');
$smarty->register_function('articles_seo_url', 'articles_seo_url');
$smarty->register_function('product_seo_url', 'product_seo_url');
$smarty->register_function('special_articles', 'special_articles');
$smarty->register_function('gallery_album_seo_url', 'gallery_album_seo_url');
$smarty->register_function('service_seo_url', 'service_seo_url');
$smarty->register_function('special_lists', 'special_lists');
$smarty->register_function('special_gallery_pictures', 'special_gallery_pictures');
// site url and path
$smarty->assign("baseUrl", $baseUrl);
$smarty->assign("WEBROOT", $baseUrl );
$smarty->assign("fullUrl", $fullUrl);

$usersObj = new User();

if(isset($_REQUEST['SSID']) && $_REQUEST['SSID'] != ""){
    $SSID = $_REQUEST['SSID'];
    session_id($SSID);
}
session_start(); 
$SSID = session_id();
$_SESSION['SSID'] = $SSID;
$smarty->assign('SSID',$SSID);

// required files
require_once (BASE_PATH . "configs/var_config.inc.php");
?>
