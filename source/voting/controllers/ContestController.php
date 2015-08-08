<?php
/**
 * Contest Controller
 *
 * @package Voting
 * @copyright Horisen
 * @author zeka
 */
class ContestController extends Controller {

    /**
     * Init method
     */
    protected function _init(){
        $meta = array();
        if(Voting_Model_TranslateMapper::getInstance()->readMetaData($this->getLanguage(), "contest", $meta)){
            $this->meta['title'] = $meta['title'];
            $this->meta['description'] =  $meta['description'];
            $this->meta['keywords'] =  $meta['keywords'];
        }
        parent::_init();
    }

    /**
     * Run method
     */
    public function run(){
        $contest = new Voting_Model_Contest();
        $date = date('Y-m-d H:m:s');

        if( !Voting_Model_ContestMapper::getInstance()->find($date, $contest) ){
            throw new Exception("Voting index action, contest not found");
        }
        $candidates = array();
        if( !Voting_Model_CandidateMapper::getInstance()->findAll($contest->get_id(), $candidates) ){
            throw new Exception("Voting index action, candidates not found");

        }
        $smarty = $this->getSmarty();
        $smarty->assign("candidates", $candidates);
    }
}