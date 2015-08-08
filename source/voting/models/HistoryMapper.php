<?php
/**
 * Voting_Model History Mapper
 * 
 * @package Voting
 * @subpackage Model
 * @copyright Horisen
 * @author Zeka
 */
class Voting_Model_HistoryMapper {

    /**
     * singleton instance
     *
     * @var Voting_Model_HistoryMapper
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
     * @return Voting_Model_HistoryMapper
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Find history
     *
     * @param int $historyId
     * @param string $code
     * @param Voting_Model_History $history
     * @return boolean
     */
    public function find($historyId, Voting_Model_History $history = null) {
        $sql = "SELECT * FROM voting_history AS h
                WHERE h.id = '$historyId'";
            
        $result = mysql_query($sql);
        if(!$result || ($resultSet = mysql_fetch_array($result, MYSQL_ASSOC)) === false){
            return false;
        }

        $history->setOptions($resultSet);
        return true;
    }

    /**
     * Find history by candidate id and code
     *
     * @param int $candidateId
     * @param string $code
     * @param Voting_Model_History $history
     * @return bool
     */
    public function findByCandidateAndCode($candidateId, $code, Voting_Model_History $history = null) {
        $sql = "SELECT * FROM voting_history AS h
                WHERE h.candidate_id ='$candidateId' AND h.code='$code'";

        $result = mysql_query($sql);
        if(!$result || ($resultSet = mysql_fetch_array($result, MYSQL_ASSOC)) === false){
            return false;
        }

        $history->setOptions($resultSet);
        return true;
    }

    /**
     * Save History entity
     *
     * @param Voting_Model_History $history
     */
    public function save(Voting_Model_History $history) {
        $id = $history->get_id();
        if (!isset ($id) || $id <= 0) {
            $sql = "INSERT INTO voting_history (
                    contest_id ,
                    candidate_id,
                    user_id,
                    status,
                    code,
                    posted)
                    VALUES (
                    '" . addslashes($history->get_contest_id()) . "',
                    '" . addslashes($history->get_candidate_id()) ."',
                    '" . addslashes($history->get_user_id()) ."',
                    '" . addslashes($history->get_status()) ."',
                    '" . addslashes($history->get_code()) ."',
                    now())";

            mysql_query($sql);
            $historyId = mysql_insert_id();

            if($historyId > 0){
                $history->set_id($historyId);
                return true;
            }
            else{
                return false;
            }
        } else {
            $sql = "UPDATE voting_history SET
                    status = '" . addslashes($history->get_status()) . "'
                    WHERE id='" . $history->get_id() . "'";

            return mysql_query($sql);
        }
    }

}