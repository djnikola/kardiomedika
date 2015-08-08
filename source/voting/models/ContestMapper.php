<?php
/**
 * Voting_Model Contest Mapper
 *
 * @package Voting
 * @subpackage Model
 * @copyright Horisen
 * @author Zeka
 */
class Voting_Model_ContestMapper {

    /**
     * singleton instance
     *
     * @var Voting_Model_ContestMapper
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
     * @return Voting_Model_ContestMapper
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Find contest
     *
     * @param string $date
     * @param Voting_Model_Contest $contest
     * @return boolean
     */
    public function find($date, Voting_Model_Contest $contest) {
        $sql = "SELECT * FROM voting_contest AS v
                WHERE v.start_dt <= '$date'
                AND  v.end_dt >= '$date'";

        $result = mysql_query($sql);
        if( !$result || ($resultSet = mysql_fetch_array($result, MYSQL_ASSOC)) === false){
            return false;
        }

        $contest->setOptions($resultSet);
        return true;
    }
    
}