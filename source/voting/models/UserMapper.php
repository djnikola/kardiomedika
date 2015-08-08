<?php
/**
 * Voting_Model User Mapper
 * 
 * @package Voting
 * @subpackage Model
 * @copyright Horisen
 * @author Zeka
 */
class Voting_Model_UserMapper {

    /**
     * singleton instance
     *
     * @var Voting_Model_UserMapper
     */
    protected static $_instance = null;

    /**
     * private constructor
     */
    private function __construct() {
       global $db;
    }

    /**
     * get instance
     * @return Voting_Model_UserMapper
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Find user
     *
     * @param int $userId
     * @param Voting_Model_User $user
     * @return boolean
     */
    public function find($userId, Voting_Model_User $user) {
        $sql = "SELECT * FROM voting_user AS u
                WHERE u.id = '$userId'";

        $result = mysql_query($sql);
        if(!$result || ($resultSet = mysql_fetch_array($result, MYSQL_ASSOC)) === false){
            return false;
        }

        $user->setOptions($resultSet);
        return true;
    }


    /**
     * Find user by email
     *
     * @param string $email
     * @param Voting_Model_User $user
     * @return bool
     */
    public function findByEmail($email, Voting_Model_User $user) {
        $sql = "SELECT * FROM voting_user AS u
                WHERE u.email = '$email'";

        $result = mysql_query($sql);
        if(!$result || ($resultSet = mysql_fetch_array($result, MYSQL_ASSOC)) === false){
            return false;
        }

        $user->setOptions($resultSet);
        return true;
    }

    /**
     * Save User entity
     *
     * @param Voting_Model_User $user
     */
    public function save(Voting_Model_User $user) {
        $id = $user->get_id();
        if (!isset ($id) || $id <= 0) {
            $sql = "INSERT INTO voting_user (
                    first_name,
                    last_name,
                    email,
                    created)
                    VALUES (
                    '" . addslashes($user->get_first_name()) . "',
                    '" . addslashes($user->get_last_name()) ."',
                    '" . addslashes($user->get_email()) ."',
                    now())";

            mysql_query($sql);
            $userId = mysql_insert_id();

            if($userId > 0){
                $user->set_id($userId);
                return true;
            }
            else{
                return false;
            }
        } else {
            $sql = "UPDATE voting_user SET
                    first_name = '" . addslashes($user->get_first_name())."',
                    last_name = '" . addslashes($user->get_last_name())."',
                    email = '" . addslashes($user->get_email())."',
                    created = '" . addslashes($user->get_created())."'
                    WHERE id=" . $user->get_id();

            return mysql_query($sql);
        }
    }

}