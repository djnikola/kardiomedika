<?php
$ajax_path = 'ajax_server/';
require_once("config.inc.php");

$code_page = "ISO-8859-1";
/*
$utfDecode = (isset($_POST['utfDecode']) && $_POST['utfDecode'] == 'no') ? false : true;
if ($utfDecode) utfDecoder($_POST, $code_page);
*/

$action = isset($_POST['action']) ? $_POST['action'] : "";

$json_arr = array();

if ($action != "") {
	$action = strtolower($action);
	if (file_exists($ajax_path.'/'.$action.'.inc.php')) {
		include($ajax_path.'/'.$action.'.inc.php');
	} else {
        $json_arr['response_status'] = array('code' => 3, 'desc' => 'AJAX: Include file not exists!');
	}
} else {
    $json_arr['response_status'] = array('code' => 2, 'desc' => 'AJAX: Input parameters are not valid!');
}

header('Content-Type: application/jsonrequest');
header('Cache-Control: no-store, no-cache, must-revalidate');

echo json_encode($json_arr);

?>
