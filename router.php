<?php
define("BASE_PATH", "");     //base path for server, from this index file
ini_set('include_path', BASE_PATH);
set_include_path(BASE_PATH);   //sets include path to this folder,  security prevention

require_once(BASE_PATH . "configs/config.inc.php");
//route
include_once 'classes/route.class.php';
Route::getInstance($db)->route($baseUrl, $_REQUEST, $available_languages, $default_language);
//continue with normal bootstrap
include 'index.php';