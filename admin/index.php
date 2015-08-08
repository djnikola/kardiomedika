<?php

define("BASE_PATH", "../");     //base path for server, from this index file
ini_set('include_path', BASE_PATH);
set_include_path(BASE_PATH);   //sets include path to this folder,  security prevention

require_once(BASE_PATH."configs/config.inc.php");

if(isset($_GET['redirect']) && $_GET['redirect'] == true) restoreReturnPoint();

if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value) 
    {
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
/// init variables...
$lang    = (isset($_GET["lang"]) && $_GET["lang"] != "") ? $_GET["lang"] : '';
$section    = (isset($_GET["section"]) && $_GET["section"] != "") ? $_GET["section"] : "";
$subsection = (isset($_GET["subsection"]) && $_GET["subsection"] != "") ? $_GET["subsection"] : "";


// load a language section 
if(!isset($_SESSION['admin_lang'])){
	$_SESSION['admin_lang'] = $default_language;
}
if ($lang != '' && in_array($lang, $available_languages)){
	$_SESSION['admin_lang'] = $lang;
}

$sql_get_lang = "SELECT * FROM lang_table_admin WHERE lang='en'";
$result = mysql_query($sql_get_lang);
if($result && mysql_num_rows($result)){
	while($l = mysql_fetch_array($result)){
		$labels[$l['label']] = $l['trans'];
	}
}else{
	exit('Error! Language table not set, or empty.');
}

//assign configs to smarty
$smarty->assign("lang", $_SESSION['admin_lang']);
$smarty->assign("labels", $labels);
$smarty->assign("common_conf",$config);

require_once ('include/admin_menu_links.php');

////////////////////////////////////////////////////////////

if (!$usersObj->checkUserPrivileges($section, $subsection, 'login')){
	//$_SESSION['ERRORS']['password_required'] = "Permission denied. Login first.";
	$section = 'login';
}
$template = "";
switch ($section) {
	
	case "common":
		include_once("admin/source/common.php");
		break;
    case "pages":
		include_once("admin/source/pages.php");
		break;
            
    case "history":
		include_once("admin/source/history.php");
		break;
	
	case "articles":
		include_once("admin/source/articles.php");
		break;
        
    case "users":
		include_once("admin/source/users.php");
		break;
    
    case "gallery":
		include_once("admin/source/gallery.php");
		break;
	
	case "common":
		include_once("admin/source/common.php");
		break;

	case "login":
	default:
		include_once("admin/source/login.php");
		break;
}
$smarty->assign("menu", $admin_menu_links);
$smarty->assign("section", $section);
$smarty->assign("subsection", $subsection);
$smarty->assign("template", $template);
$smarty->assign("current_year", date('Y'));

# Error messages #################
if(isset($_SESSION['ERRORS']) && count($_SESSION['ERRORS'])){
	$smarty->assign("errors", $_SESSION['ERRORS']);
}

# ################################

# Notice messages ################
if(isset($_SESSION['NOTICES']) && count($_SESSION['NOTICES'])){
	$smarty->assign("notices", $_SESSION['NOTICES']);
}


# ################################

$smarty->display("admin/main.tpl");
unset($_SESSION['ERRORS']);
unset($_SESSION['NOTICES']);

?>