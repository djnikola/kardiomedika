<?php
/**
 * Confirmation Controller
 *
 * @package Voting
 * @copyright Horisen
 * @author zeka
 */
class ConfirmationController extends Controller {

    /**
     * Ajax call
     * Run method
     */
    public function run(){
        //read data params
        $data = $this->getRequestParams();
        if( !isset($data["candidate_id"]) || !isset($data["code"]) ){
            throw new Exception("Exception in confirmation controller, candidate_id or code set!");
        }

        //update history status
        $history = new Voting_Model_History();
        if( !Voting_Model_HistoryMapper::getInstance()->findByCandidateAndCode($data["candidate_id"], $data["code"], $history) ){
            throw new Exception("Exception in confirmation controller, history not found!");
        }
        $history->set_status("approved");
        Voting_Model_HistoryMapper::getInstance()->save($history);

        //Update candidate votes number
        $candidate = new Voting_Model_Candidate();
        if( !Voting_Model_CandidateMapper::getInstance()->find($history->get_contest_id(), $history->get_candidate_id(), $candidate) ){
            throw new Exception("Exception in confirmation controller, candidate not found!");
        }

        if( !Voting_Model_CandidateMapper::getInstance()->updateVotes($candidate) ){
            throw new Exception("Exception in confirmation controller, couldn't update candidate votes");
        }

        //redirect
        header('Location: ' . 'http://' . $_SERVER['SERVER_NAME'] . '/' . $this->getLanguage() . '/');
        exit();
    }
}
?>
