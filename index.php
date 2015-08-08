<?php

if(!defined('BASE_PATH')){
    define('BASE_PATH', '');     //base path for server, from this index file
    ini_set('include_path', BASE_PATH);
    set_include_path(BASE_PATH);   //sets include path to this folder,  security prevention
    require_once(BASE_PATH . "configs/config.inc.php");
}

if (get_magic_quotes_gpc()) {

    function stripslashes_deep($value) {
        $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);
        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}
//header("Location:".$baseUrl."");
//dumper("Location:".$baseUrl."");exit;

(isset($_REQUEST["lang"]) && $_REQUEST["lang"] != "") ? $lang = $_REQUEST["lang"] : header("Location:".$baseUrl."sr/");
$section = (isset($_REQUEST["section"]) && $_REQUEST["section"] != "") ? $_REQUEST["section"] : "";
$subsection = (isset($_REQUEST["subsection"]) && $_REQUEST["subsection"] != "") ? $_REQUEST["subsection"] : "";
$page_id = (isset($_REQUEST["page_id"]) && $_REQUEST["page_id"] != "") ? $_REQUEST["page_id"] : "";

$show_place = (isset($_GET["show_place"]) && $_GET["show_place"] != "") ? $_GET["show_place"] : "first";

// load a language section
if ($lang != '' && in_array($lang, $available_languages)) {
    $_SESSION['lang'] = $lang;
} else if (!isset($_SESSION['lang']) || $_SESSION['lang'] == '') {
    $_SESSION['lang'] = $default_language;
}

$smarty->assign("lang", $_SESSION['lang']);

$sql_get_lang = "SELECT * FROM lang_table WHERE lang='" . $_SESSION['lang'] . "'";
$result = mysql_query($sql_get_lang);
if ($result && mysql_num_rows($result)) {
    while ($l = mysql_fetch_array($result)) {
        $labels[$l['label']] = $l['trans'];
    }
} else {
    error_log('Language table not set, or empty! > MySql Error:' . mysql_error() . ' > File: ' . __FILE__ . ' > Line: ' . __LINE__ . '', 0);
    die('Language table not set, or empty!');
}

//assign configs to smarty
$smarty->assign("labels", $labels);
common_conf_set($config);
$smarty->assign("common_conf", $config);

////////////////////////////////////////////////////////////

$template = "";
$left = "";
$right = "";
$meta = array();


switch ($section) {
    default:
    case "pages":
        include_once("source/pages.php");
        break;
    case "articles":
        include_once("source/articles.php");
        break;  
    case "gallery":
        include_once("source/gallery.php");
        break;
    case "forms":
        include_once("source/forms.php");
        break;
    case "tests":
        include_once("source/tests.php");
        break;
}
$isXmlHttpRequest = array_key_exists('X_REQUESTED_WITH', $_SERVER) &&
	$_SERVER['X_REQUESTED_WITH'] == 'XMLHttpRequest';

$smarty->assign("section", $section);
$smarty->assign("subsection", $subsection);
$smarty->assign("show_place", $show_place);

# Error messages #################
if (isset($_SESSION['ERRORS']) && count($_SESSION['ERRORS'])) {
    $smarty->assign("errors", $_SESSION['ERRORS']);
}
empty($_SESSION['ERRORS']);
$_SESSION['ERRORS'] = array();
# ################################


 
    if ($isXmlHttpRequest) {
        // is an Ajax request
        
    }else{
        generatePage($template, $right, $left, "", $meta, $page_id);
    }


?>