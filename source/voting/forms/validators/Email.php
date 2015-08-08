<?php
require_once 'Interface.php';
/**
 * Email validator
 *
 * @copyright horisen
 * @author zeka
 */
class EmailValidator implements ValidatorInterface {

    private $email;

    private $message = "Email address it's already used.";


    public function  __construct($email){
        $this->email = $email;
    }

    public function isValid(){
        return $this->emailNotExist($this->email);
    }

    public function getErrorMessage(){
        return $this->message;
    }

    //----------- private methods ----------//
    
    private function emailNotExist($email) {
        global $db;

        $sql = "SELECT u.*, h.*
                FROM voting_user u, voting_history h
                WHERE h.user_id = u.id AND u.email='$email' AND h.status='approved'";

        $result = mysql_query($sql);
        
        if(!$result || ($resultSet = mysql_fetch_array($result, MYSQL_ASSOC)) === false){
            return true;
        }

        return false;
    }


}
?>
