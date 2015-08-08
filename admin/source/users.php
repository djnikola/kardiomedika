<?php
switch($subsection){
	
	case "new":
		global $db;
		$submit = &$_REQUEST['submit'];
		$data = &$_REQUEST['data'];
		$user_id = &$_REQUEST['user_id'];
		$landing_marker = '';
		$user_obj = new User();	

			if($user_id){
				$user_obj->user_id = $user_id;
				$user_obj->get();
			}

			if(@$submit['save']){
				
				$errors = array();
				if(empty($data['username'])) $errors['username'] = "Enter username.";
				
				if(!$user_id){
					if(empty($data['password'])) $errors['password'] = "Enter password";
					if($data['password_ver'] != $data['password'])	$errors['password_ver'] = "Password missmatch";
				}
				if($user_obj->isUsernameExists($data['username'])) $errors['username'] = "Username already exist.";
				if(empty($data['first_name'])) $errors['first_name'] = "Enter first name";
				if(empty($data['last_name'])) $errors['last_name'] = "Enter last name";
				if(empty($data['email'])) $errors['email'] = "Email error";
				
				$user_obj->set_data($data, array('user_id'));
				$user_obj->is_active = 1;
				
				if(!count($errors)){
					// ako nema gresaka snimi ili update
					if($user_id){
						$user_obj->update();
						_redirect("index.php?section=users&subsection=list");
					}else{
						$user_id = $user_obj->add();
						$user_obj->get();
						_redirect("index.php?section=users&subsection=list");
					}
				}else{
					$_SESSION['ERRORS'] = $errors;
				}
				
			}
			
		if(@$submit['cancel']){
		    _redirect("index.php?section=users&subsection=list");
		}
		$smarty->assign("user", $user_obj);
        $template = "admin/users/new.tpl";
		
        
	break;
	
	case "list":
    default:
    saveReturnPoint();
	$data = &$_REQUEST['data'];
	$filter = &$_REQUEST['filter'];
	$user_obj = new User();	
	
	#searching conditions
	#--------------------------------------------------------------------	
	$where=array();

	//date transformation	
	$smarty->assign(array("USERNAME" => "$filter[username]",
  					  	  "FIRST_NAME" => "$filter[first_name]", 
  					  	  "LAST_NAME" => "$filter[last_name]", 
  					  	  "MAIL" => "$filter[email]", 
	));

	$where = array();
	
	
	

	if ($filter['username']) $where[] = " u.username like '%".addslashes($filter['username'])."%' ";
	if ($filter['first_name']) $where[] = " u.first_name like '%".addslashes($filter['first_name'])."%' ";
	if ($filter['last_name']) $where[] = " u.last_name like '%".addslashes($filter['last_name'])."%' ";
	if ($filter['email']) $where[] = " u.email like '%".addslashes($filter['email'])."%' ";

	
	if(count($where)){
		$where ="where ".join(" and \n",$where);
	} else {
	  $where = "";
	}
	#------------------------------------------------------------------------------

 //order by generation
 
	
	  
	if (@$data['order'] == ''){
		$data['order'] = "u.user_id";
	}
	$smarty->assign("ORDER", $data['order']);
	
	if (@$data['page'] == ''){
		$data['page'] = 0;
	}
  $order_by = "ORDER BY ".$data['order']."";
    
  //paging
	$result=mysql_query("SELECT count(*) FROM users AS u $where");
//	echo "<p> count error = ".mysql_error();
  if ($result && mysql_num_rows($result)) { 
    $total = mysql_result($result,0,0);	
    $per_page = 10;
    $pages = ceil($total / $per_page);
    if ($data['page'] > $pages)
      $data['page'] = $pages;
    if ($data['page'] <= 0) 
      $data['page'] = 1;
    $limit_sql = "LIMIT ".($data['page']-1)*$per_page.",$per_page";
  }
  $smarty->assign(array("TOTAL"  => "$total",
                     "PAGES"  => "$pages",
                     "PAGE"   => "$data[page]",
                     "NEXT"   => $data['page']+1,
                     "PREV"   => $data['page']-1,
                     "PER_PAGE" => $per_page,
  ));
  
  		$all_users = array();
  		
  		$all_users = $user_obj->get_all_users($where, $limit_sql, $order_by);
		

		$for_output = array();
		
		if(count($all_users)){
			foreach ($all_users as $admin){

				$for_output[] = $admin;
			}
		}else{
			$smarty->assign("no_result","No results.");
		}
		$smarty->assign('users_list', $for_output);
        $template = "admin/users/list.tpl";
        break;
        
    case 'delete':
    	$user_obj = new User();	
	    $user_obj->delete_user($_REQUEST['user_id']);
	   	_redirect("index.php?section=users&subsection=list");
    break;
    
    case 'change_pass':
	    $data = &$_REQUEST['data'];
	    $submit = &$_REQUEST['submit'];
	    $user_id = $_REQUEST['user_id'];
		$errors = array();
		
		$user_obj = new User();
		
	    if(empty($data['old_password'])) $errors['old_password'] = "Old password is wrong.";
		if(empty($data['password'])) $errors['password'] = "Password is wrong.";
		if($data['password_ver'] != $data['password']){
			$errors['password_ver'] ="Password missmatch";
		}
		
		$sql = "SELECT * FROM users WHERE user_id = '".$user_id."'";
		$res = mysql_query($sql);
		$user_data = mysql_fetch_array($res, MYSQL_ASSOC);
		
	    if(@$submit['save']){
	    	if(!count($errors)){
	    		$user_pass_changed = $user_obj->changePassword($user_id, $data['old_password'], $data['password']);
	    		if($user_pass_changed){
	    			$_SESSION['NOTICES'][] = "Password changed.";
	    			_redirect("index.php?section=users&subsection=new&user_id=" . $_REQUEST['user_id'] . "");
	    		}else{
	    			$_SESSION['NOTICES'][] = "Password is not changed.";
	    		}
	    	}else{
	    		$_SESSION['ERRORS'] = $errors;
	    	}
	    }
	   
		if(@$submit['cancel']){
		    _redirect("index.php?section=users&subsection=new&user_id=" . $_REQUEST['user_id'] . "");
		}
		
		$smarty->assign('user_id', $_REQUEST['user_id']);
	    $smarty->assign('user_data', $user_data);
	    $template = "admin/users/change_pass.tpl";
		
    break;
}
?>