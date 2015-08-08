<?php

switch($subsection){
	
	case 'login_action':
        //this will login user
        $login = $_POST['username'];
        $password = $_POST['password'];
        $_SESSION['ERRORS'] = array();
        
        if ($login == '') {
            $_SESSION['ERRORS']['enter_username'] = "Please enter username.";
        }else{
            
        	if (!$usersObj->getUserFiltered(false, $login)) {
                $_SESSION['ERRORS']['username_not_exist'] = "Username dosen't exist";
            }else{
                if (!$usersObj->getUserFiltered(false, $login, 1, 0)){
                    $_SESSION['ERRORS']['username_not_active'] = "This user is not active";                    
                }
            }


        }
        if ($password=='') {
            $_SESSION['ERRORS']['password_required'] = "Password is required.";
        }
        if (count($_SESSION['ERRORS'])>0) {
            //there is some error, back to the login page
            header("Location: index.php?section=login&subsection=show_login");
        }else {

            if (!$usersObj->login($login, $password)) {
                header("Location: index.php?section=pages&subsection=list");
            }else {
                $_SESSION['ERRORS']['wrong_username_password'] = "Wrong username or password.";
				header("Location: index.php?section=login&subsection=show_login");
            }

        }
        
        break;
        
        
        
    case "logout":
        $usersObj->logout();
        header("Location: index.php?section=login&subsection=show_login");
        break;
        
    case "welcome": //dumper("wel-7fdfdfd");exit;
        $template = "admin/login/admin_welcome.tpl";
        
        break;
        
   
    case "show_login":
    default:
    	   	
	    $template = "admin/login/admin_login.tpl";
        break;


}


?>