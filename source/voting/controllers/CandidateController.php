<?php
/**
 * Candidate Controller
 *
 * @package Voting
 * @copyright Horisen
 * @author zeka
 */
class CandidateController extends Controller {

    /**
     * Ajax call
     * Run method
     */
    public function run(){
        $candidateId = $this->getRequestParam("candidate_id");
        //get now date
        $date = date('Y-m-d H:m:s');
        $contest = new Voting_Model_Contest();
        if( !Voting_Model_ContestMapper::getInstance()->find($date, $contest) ){
            throw new Exception("Voting candidate exception, contest not found!");
        }
        $candidate = new Voting_Model_Candidate();
        if( null == $candidateId || !Voting_Model_CandidateMapper::getInstance()->find($contest->get_id(), $candidateId, $candidate) ){
            throw new Exception("Voting candidate exception, candidate not found!");
        }
        $smarty = $this->getSmarty();
        $smarty->assign("candidate", $candidate);
    }
 
}