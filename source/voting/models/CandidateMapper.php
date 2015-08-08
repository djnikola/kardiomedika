<?php
/**
 * Candidate Mapper
 * 
 * @package Voting
 * @subpackage Model
 * @copyright Horisen
 * @author Zeka
 */
class Voting_Model_CandidateMapper {

    /**
     * singleton instance
     *
     * @var Voting_Model_CandidateMapper
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
     * @return Voting_Model_CandidateMapper
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Find all candidates
     *
     * @param int $contestId
     * @param array $candidates
     * @return boolean
     */
    public function findAll($contestId, &$candidates) {
        $sql = "SELECT * FROM voting_candidate AS c
                WHERE c.contest_id = '$contestId'
                ORDER BY c.order_num";

        $result = mysql_query($sql);

        if ($result && mysql_num_rows($result)) {
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $candidate = new Voting_Model_Candidate();
                $candidate->setOptions($row);
                $candidates[] = $candidate;
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * Find candidate
     *
     * @param int $contest_id
     * @param int $candidate_id
     * @param Voting_Model_Candidate $candidate
     * @return bool
     */
    public function find($contest_id, $candidate_id, Voting_Model_Candidate $candidate) {
        $sql = "SELECT * FROM voting_candidate AS c
                WHERE c.id = '$candidate_id'
                AND c.contest_id = '$contest_id'";

        $result = mysql_query($sql);
        if(!$result || ($resultSet = mysql_fetch_array($result, MYSQL_ASSOC)) === false){
            return false;
        }

        $candidate->setOptions($resultSet);
        return true;
    }


    /**
     * Find by id candidate
     *
     * @param int $candidate_id
     * @param Voting_Model_Candidate $candidate
     * @return bool
     */
    public function findById($candidate_id, Voting_Model_Candidate $candidate) {
        $sql = "SELECT * FROM voting_candidate AS c
                WHERE c.id = '$candidate_id'";

        $result = mysql_query($sql);
        if(!$result || ($resultSet = mysql_fetch_array($result, MYSQL_ASSOC)) === false){
            return false;
        }

        $candidate->setOptions($resultSet);
        return true;
    }

    /**
     * Update votes count for this candidate
     *
     * @param Voting_Model_Candidate $candidate
     * @return boolean
     */
    public function updateVotes(Voting_Model_Candidate $candidate) {
        $sql =  "UPDATE voting_candidate
                 SET votes = (
                                SELECT COUNT(id)
                                 FROM voting_history
                                WHERE voting_history.candidate_id = voting_candidate.id
                                GROUP BY voting_history.candidate_id
                               )
                 WHERE voting_candidate.id = '" . $candidate->get_id() . "')";
        //grab new candidate
        mysql_query($sql);
        return true;
    }

}