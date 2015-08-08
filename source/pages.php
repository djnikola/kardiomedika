<?php

$right = '';
$left = '';
$dinamicInclude = '';

switch ($subsection){
	
	case "view":
		$user_attributs = $usersObj->getAttributes($usersObj->getUserId());
		$default_page = is_default_page($_REQUEST['page_id']);
        $smarty->assign("show_form", 1);
        $errors = array();      
        $smarty->assign("errors", $errors);
        $page = create_page($_REQUEST['page_id'],$default_page, $meta);
		$template = "pages/view.html";
		break;
		
	default:  
		$smarty->assign('default_page', 1);
		$smarty->assign('page_id', ''); 
		$page = create_page('',1, $meta);
		$template = "pages/view.html";
		break;
}

$real_page_title = $page['caption'];

?>