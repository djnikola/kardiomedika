<?php
define("BASE_PATH", "");     //base path for server, from this index file
ini_set('include_path', BASE_PATH);
set_include_path(BASE_PATH);   //sets include path to this folder,  security prevention
require_once("configs/config.inc.php");


            $smarty->assign("show_form", 1);
            $errors = array();
            if(isset($_REQUEST['data'])){
                require_once 'send_email.php';
                $html = initHtmlForEmail();
                $html .= "<h2>Newsletter Submit</h2><br />";
                $html .= "<label>Vorname: </label>".$_REQUEST['data']['vorname']."<br />";
                $html .= "<label>Name: </label>".$_REQUEST['data']['name']."<br />";
                $html .= "<label>Email: </label>".$_REQUEST['data']['email']."<br />";

                $html .= '</body>';
                if(isset($_REQUEST['data']['vorname']) && $_REQUEST['data']['vorname'] == "") $errors['vorname'] = 1;
                if(isset($_REQUEST['data']['name']) && $_REQUEST['data']['name'] == "") $errors['name'] = 1;
                if(isset($_REQUEST['data']['email']) && $_REQUEST['data']['email'] == "") $errors['email'] = 1;
                if(!count($errors)){
                    if(sendEmail($html, $config)){
                        $smarty->assign("show_form", 0);
                    }
                }
            }
$smarty->assign("errors", $errors);
$template = "contents/newsletter/form.tpl";
$smarty->display($template);
?>