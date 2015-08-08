<?php
class User{
	
	 var $user_id = '';	 
	 
	 var $fk_group_id = 1; 	 
	 var $fk_users_role = ''; 	 
	 var $username = '';   	 
	 var $password  = '';  	 
	 var $pass_hash = '';   	 
	 var $is_active = 0;   	 
	 var $is_baned = 0;   	 
	 var $register_date = '';   	 	 
	 var $email = '';   	 
	 var $first_name = '';   	 
	 var $last_name = '';   	 	 
	 var $activation_code = '';   	 
	 var $street = '';   	 
	 var $city = '';   	 
	 var $state = '';  	 
	 var $zip = '';   	 
	 var $country_code = '';   	 
	 var $area_code = '';   	 
	 var $phone_number = '';   	 
	 var $fax = '';   	 
	 var $mobile_phone = '';   	 
	 var $fk_country_id = ''; 
	var $class_elements = array(
	'user_id',	 	 
	 'fk_group_id', 	 
	 'fk_users_role', 	 
	 'username',  	 
	 'password', 	 
	 'pass_hash', 	 
	 'is_active', 	 
	 'is_baned',  	 
	 'register_date',   	 	 
	 'email',  	 
	 'first_name', 	 
	 'last_name',  	 	 
	 'activation_code',  	 
	 'street', 
	 'city',  
	 'state',  
	 'zip', 
	 'country_code',  	 
	 'area_code', 	 
	 'phone_number',   	 
	 'fax', 
	 'mobile_phone', 	 
	 'fk_country_id',
	);
	
	function User(
					$user_id = '',	 
					$fk_type_id = 1, 	 
					$fk_group_id = 1, 	 
					$fk_users_role = '', 	 
					$username = '',   	 
					$password  = '',  	 
					$pass_hash = '',   	 
					$is_active = 0,   	 
					$is_baned = 0,   	 
					$register_date = '',   	   	 
					$first_name = '',   	 
					$last_name = '',   	 
					$email = '',   	 
					$control_1 = '',   	 
					$street = '',   	 
					$city = '',   	 
					$state = '',  	 
					$zip = '',   	 
					$country_code = '',   	 
					$area_code = '',   	 
					$phone_number = '',   	 
					$fax = '',   	 
					$mobile_phone = '',   	 	 
					$fk_country_id = ''
	){
					$this->user_id = $user_id;
					$this->fk_type_id = $fk_type_id;	 
					$this->fk_group_id = $fk_group_id;	 
					$this->fk_users_role = $fk_users_role; 	 
					$this->username = $username;  	 
					$this->password = $password;	 
					$this->pass_hash = $pass_hash;  	 
					$this->is_active = $is_active;  	 
					$this->is_baned = $is_baned;	 
					$this->register_date = $register_date;  	 
 
					$this->first_name = $first_name; 	 
					$this->last_name = $last_name; 
					$this->email = $email;	 
					$this->control_1 = $control_1;
					$this->street = $street;	 
					$this->city = $city;
					$this->state = $state;
					$this->zip = $zip; 	 
					$this->country_code = $country_code;
					$this->area_code = $area_code;
					$this->phone_number = $phone_number;
					$this->fax = $fax;
					$this->mobile_phone = $mobile_phone;
					$this->fk_country_id = $fk_country_id;
	}

	function set_data($data, $exeptions = array()){
		foreach ($this->class_elements as $element){
			if(!in_array($element, $exeptions)){
				if(isset($data[$element])){
					$this->$element = $data[$element];
				}
				
			}
		}
	}
	
    function add(){
        $this->pass_hash = $this->codingMehanismMakeHash();
        $this->password = md5($this->password . CODE_MAKER . $this->pass_hash);
        
        $sql_part = array();
		$sql = "INSERT INTO users ";
		@reset($this->class_elements);
		foreach ($this->class_elements as $class_element){
			if($class_element != 'user_id' && $class_element != 'register_date')
				$sql_part[] = "`".$class_element."` = '".addslashes($this->$class_element)."'\n";
		}
		$sql .="SET ".join(',', $sql_part).", register_date=NOW() ";
		mysql_query($sql);
		$this->user_id = mysql_insert_id();
		if(!mysql_error()){
			return $this->user_id;
		}else{
			return false;
		}	
    }
    
	function get(){
		$sql = "SELECT * FROM users WHERE user_id = '$this->user_id'";
		$result = mysql_query($sql);
		$p = mysql_fetch_array($result, MYSQL_ASSOC);
		foreach ($this->class_elements as $class_element){
			$this->$class_element = $p[$class_element];
		}
	}
	
	function update(){
		$sql = "UPDATE users ";
		$sql_part = array(); 
		foreach ($this->class_elements as $class_element){
			if(!($class_element == 'register_date' || $class_element == 'user_id' || $class_element == 'password' || $class_element == 'activation_code' || $class_element == 'username' || $class_element == 'pass_hash' )){
			$sql_part[] = "".$class_element." = '".addslashes($this->$class_element)."'\n";
			}
		}
		$sql .="SET ".join(',', $sql_part)."WHERE user_id = ".$this->user_id."";
		
		mysql_query($sql);
		if(!mysql_error()){
			return mysql_insert_id();
		}else{
			return false;
		}	
	}

    function codingMehanismMakeHash(){
        @$tmp =date('YmdHis') . CODE_MAKER . 'secrett';
        $hash=md5($tmp);
        return $hash;
    }

    //for login  - if (strlen($pass) > 0 && md5($pass . CODE_MAKER . $user_hash) == $user_pass)
    function getUserFiltered($s_userId = false, $s_username = false, $s_isActive = false, $s_isBaned = false, $s_name = false, $s_mail = false, $s_control_1 = false, $joinContition = ' AND ', $orderBy = 'username'){
        $searchQueryArray = array();
        if ($s_userId!==false) {
            $searchQueryArray[]="user_id = '$s_userId'";
        }
        if ($s_username!==false) {
            $searchQueryArray[]="username = '$s_username'";
        }
        if ($s_isActive!==false) {
            $searchQueryArray[]="is_active = '$s_isActive'";
        }
        if ($s_isBaned!==false) {
            $searchQueryArray[]="is_baned = '$s_isBaned'";
        }
        if ($s_name!==false) {
            $searchQueryArray[]="name = '$s_name'";
        }
        if ($s_mail!==false) {
            $searchQueryArray[]="mail = '$s_mail'";
        }
        if ($s_control_1!==false) {
            $searchQueryArray[]="control_1 = '$s_control_1'";
        }
        $searchQueryString = join(" $joinContition ", $searchQueryArray);

        $sql = "SELECT * FROM users ";

        if ($searchQueryString!='') {
            $sql .= " WHERE " . $searchQueryString . " ORDER BY $orderBy ASC";
        }
        
        $result = mysql_query($sql);
        return mysql_fetch_array($result, MYSQL_ASSOC);

    }

    function activateUser($userId){
    	global $db;
    	$sql = "UPDATE users
    	           SET is_active = 1
    	           WHERE user_id = '$userId'";
    	mysql_query($sql);
    }
    /**
     * logins user, and sets its priviledges
     *
     * @param string $user
     * @param string $pass
     * @return false if all is OK
     */
    function login($user = '',$pass = ''){

        $NO_USERNAME = 'No username';
        $BAD_PASSWORD = 'bad pass';
        $USER_DOES_NOT_EXIST = true;
        $user = trim($user);

        if($user == '') {
            return $NO_USERNAME;
        }
        if($pass == '') {
            return $BAD_PASSWORD;
        }
        $userDetail = $this->getUserFiltered(false, $user);
        
        if($userDetail){
            $db_pass = $userDetail['password'];
            $db_hash = $userDetail['pass_hash'];
            $uid = $userDetail['user_id'];
            // check the password
            $pass = trim($pass);
            if(strlen($pass) > 0 && md5($pass . CODE_MAKER . $db_hash) == $db_pass){
                $login = $user;
                $_SESSION['user']['username'] = $user;
                $_SESSION['user']['user_id'] = $uid;
                $_SESSION['user']['first_name'] = $userDetail['first_name'];
                $_SESSION['user']['last_name'] = $userDetail['last_name'];
                $_SESSION['user']['group'] = $userDetail['fk_group_id'];
                $_SESSION['loged'] = 1;
                $this->setUserPrivilege($_SESSION['user']['group']);
                return false;
            } else {
                return $BAD_PASSWORD;
            }
        } else
        return $USER_DOES_NOT_EXIST;
    }
      
    
    function logout(){
    	unset($_SESSION['user']);
    	unset($_SESSION['loged']);
    	unset($_SESSION['privilegies']);
//    	echo  "DSD ds";
    }

  static function getUserId(){
        if (isset($_SESSION['user']['uid'])) {
            return $_SESSION['user']['uid'];
        }else {
            return false;
        }

    }

    function getUserGroupId(){
        if (isset($_SESSION['user']['group'])) {
            return $_SESSION['user']['group'];
        }else {
            return false;
        }

    }

    function createConfirmationMessage($name, $email, $activationUrl){
    	global $smarty;
    	$smarty->assign('name', $name);
    	$smarty->assign('email', $email);
    	$smarty->assign('urlRegistrationActivationFromMail', $activationUrl);
        $message = $smarty->fetch('mails/registration_confirmation.html');
        return $message;
    }

    function create_activation_code(){
    	$code_unique = true;
		$activation_code = md5(uniqid(rand(), true));

		while($code_unique){
			$sql_code_check = "select activation_code from users where activation_code='".$activation_code."'";
			$result = mysql_query($sql_code_check);
			if(mysql_num_rows($result)){
				$activation_code = md5(uniqid(rand(), true));
			}else{
				$code_unique = false;
			}
		}
		
		return $activation_code;
    }

    function getAuthParametarsByGroupId( $fkGroupId){
		$sql = "SELECT loc_id, section, sub_section, value FROM auth_locations
			WHERE fk_group_id = $fkGroupId ";
		$result = mysql_query($sql);
		$param = array();
		if($result && mysql_num_rows($result)){
            while ($sect = mysql_fetch_array($result, MYSQL_ASSOC)){
                $param[] = array(
                "section"        => $sect["section"],
                "sub_section"    => $sect["sub_section"],
                "value"          => $sect["value"],
                );
            }
        }
		return $param;


	}

	function setUserPrivilege($fkGroupId){
		$_SESSION["privilegies"] = $this->getAuthParametarsByGroupId( $fkGroupId);

	}



/**
 * This function returns "true" if user has privilegies to enter $section
 *
 * @param unknown_type $section
 * @param unknown_type $sub_section
 * @param string $gestSections grents acces to all users
 * @param unknown_type $gestSub_sections
 * @return unknown
 */


static function checkUserPrivileges($navi, $subnavi = "", $guestSections){

	//dumper($navi);
	//dumper($_SESSION["privilegies"]);
	$returnValue = false;
	// access granted for guest sections
	$guestSectionsValues = explode("|", $guestSections);
	//dumper($guestSectionsValues);
	foreach ($guestSectionsValues as $guestSect){
		if($navi == $guestSect){
				$returnValue = true;
		}
	}

	
	if($returnValue == false){
		if(isset($_SESSION["privilegies"])){

			$sessions = $_SESSION["privilegies"];
			foreach ($sessions as $session){
				
				$sessionValue = $session["section"];
				$sub_sessionValue = $session["sub_section"];
				$permission = $session["value"];
				
				if($sessionValue == $navi && $sub_sessionValue == $subnavi){
					if($permission == 1){
						$returnValue = true;
					}else{
						$returnValue = false;
					}
				}
			}
		}
	}
	
	return $returnValue;
}

/**
 * return all about users which first name or last name like as $string
 *
 * @param unknown_type $string
 * @return unknown
 */
function searchUsers($string ){
	$sql = "SELECT u.*, v.file_name, v.image_id
			FROM users u
			LEFT JOIN user_uploads v
			ON u.user_id=v.fk_user_id
			WHERE u.first_name LIKE '%". $string. "%' OR u.last_name LIKE '%". $string."%' AND v.is_visible=1 AND v.is_main=1";
	$result = mysql_query($sql);
        return mysql_fetch_array($result, MYSQL_ASSOC);
}

	function getAttributes($user_id){
	    $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
	    $result = mysql_query($sql);
        return mysql_fetch_array($result, MYSQL_ASSOC);
	}

function updateAttributes($user_id, $title, $first_name, $last_name, 
                           $mail, $street,$city,$state,$zip,$country_code,$area_code,$phone_number,$mobile_phone,$fax,
                           $fk_country_id){
    $sql = "UPDATE users SET
            title = '$title',
            first_name = '$first_name',
            last_name = '$last_name',
            mail = '$mail',
            street = '$street',
            city = '$city',
            state = '$state',
            zip = '$zip',
            country_code = '$country_code',
            area_code = '$area_code',
            phone_number = '$phone_number',
            mobile_phone = '$mobile_phone',
            fax = '$fax',
            fk_country_id = '$fk_country_id'
            WHERE user_id = '$user_id'";
    mysql_query($sql);
}
	
function changePassword($user_id,$oldpass,$newpass){
    $sql = "SELECT password,pass_hash FROM users WHERE user_id = '$user_id'";
    $result = mysql_query($sql);
    $user = mysql_fetch_array($result, MYSQL_ASSOC);
    $db_pass = $user['password'];
    $db_hash = $user['pass_hash'];

    $oldpass = trim($oldpass);
    $newpass = trim($newpass);
    if(strlen($oldpass) > 0 && md5($oldpass . CODE_MAKER . $db_hash) == $db_pass){
        $hashForPass = @User::codingMehanismMakeHash();
        $hashedPass = md5($newpass . CODE_MAKER . $hashForPass);
        $sql = "UPDATE users SET
                password = '$hashedPass',
                pass_hash = '$hashForPass'
                WHERE user_id = '$user_id'";
        mysql_query($sql);
        return true;
    }else {
        return false;
    }
}

	
static function get_all_users($where, $limit_sql, $order_by){
    $users = array();
    $sql = "SELECT * FROM users as u $where $order_by $limit_sql";
    $result = mysql_query($sql);
    while($u = mysql_fetch_array($result, MYSQL_ASSOC)){
        $users[] = $u;
    }
    return $users;

}

function delete_user ($user_id){
    $sql = "DELETE FROM users WHERE user_id=".$user_id."";
    $res = mysql_query($sql);

    if(empty($res)){
        return 0;
    }else{
        return $res;
    }
}
	

function change_status ($user_id){
    global $db;
    $sql = "SELECT fk_group_id FROM users WHERE user_id=".$user_id."";
    $result = mysql_query($sql);
    $user = mysql_fetch_array($result, MYSQL_ASSOC);
    $group_id = 1;
    if($user['fk_group_id'] == 1){
        $group_id = 2;			
    }
    if($user['fk_group_id'] == 2){
        $group_id = 1;	
    }

    $sql = "UPDATE users SET fk_group_id = ".$group_id."  WHERE user_id=".$user_id."";
    $res = mysql_query($sql);

    if(empty($res)){
        return 0;
    }else{
        return $res;
    }
}
	
function block_user($user_id){
    global $db;
    $sql = "SELECT is_active  FROM users WHERE user_id=".$user_id."";
    $result = mysql_query($sql);
    $user = mysql_fetch_array($result, MYSQL_ASSOC);
    if($user['is_active'] == 0){
        $is_active = 1;			
    }

    if($user['is_active'] == 1){
        $is_active = 0;	
    }

    $sql = "UPDATE users SET is_active = ".$is_active."  WHERE user_id=".$user_id."";
    $res = mysql_query($sql);

    if(empty($res)){
        return 0;
    }else{
        return $res;
    }
}
	
function isUsernameExists($username) {
    $sql = "
        SELECT 1
        FROM users
        WHERE username = '" . $username . "' 
    ";

    if($this->user_id)
        $sql .= "AND user_id <> '" . $this->user_id . "'";

    $result = mysql_query($sql); echo mysql_error();
    if ($result && mysql_num_rows($result))
        return mysql_result($result, 0, 0);
    else
        return ;
}
		
}// end of user class


	
?>