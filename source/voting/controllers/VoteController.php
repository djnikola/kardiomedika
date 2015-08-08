<?php
/**
 * Vote Index Controller
 *
 * @package Vote
 * @copyright Horisen
 * @author zeka
 */
class VoteController extends Controller {

    /**
     * Ajax call
     * Run method
     */
    public function run(){
        $data = $this->getRequestParam("data");
        //get now date
        $date = date('Y-m-d H:m:s');
        $candidateId = isset($data['candidate']) ? $data['candidate'] : 0;
        $contest = new Voting_Model_Contest();
        if( !Voting_Model_ContestMapper::getInstance()->find($date, $contest) ){
            throw new Exception("Voting candidate exception, contest not found!");
        }
        $candidate = new Voting_Model_Candidate();
        if( 0 != $candidateId && !Voting_Model_CandidateMapper::getInstance()->find($contest->get_id(), $candidateId, $candidate) ){
            throw new Exception("Voting candidate exception, candidate not found!");
        }

        $form = new Voting_Form_Vote($data);
        if($form->isValid()){
            $data = $form->getValues();

            //Save/update user
            $user = new Voting_Model_User();
            Voting_Model_UserMapper::getInstance()->findByEmail($data['email'], $user);
            //set all user data
            $user->set_email($data['email']);
            Voting_Model_UserMapper::getInstance()->save($user);

            //Save history
            $code = md5(rand(0,999));
            $history = new Voting_Model_History();
            $history->set_contest_id($contest->get_id())
                    ->set_candidate_id($candidateId)
                    ->set_user_id($user->get_id())
                    ->set_status("pending")
                    ->set_code($code);
            Voting_Model_HistoryMapper::getInstance()->save($history);

            //create confirmation link (candidateId, code)
            $confirmationLink = $this->createConfirmationLink($candidateId, $history);
            //send confirmation email
            Utils::sendConfirmationEmail($this->getSmarty(), $this->getBasePath(), $user, $confirmationLink);

            //Return response
            $response = array("success" => true, "message" => "Voting was successful");
            $this->sendJson($response);
        }else{
            $response["error"]["message"] = $form->getMessages();
            $this->sendJson($response);
        }
    }

    /**
     * Create confirmation link
     * @param int $candidateId
     * @param Voting_Model_History $history
     * @return string
     */
    private function createConfirmationLink($candidateId, $history){
        return "http://" . $_SERVER['SERVER_NAME'] . "/" . $this->getLanguage() . "/voting/confirmation/candidate_id/" . $candidateId . "/code/" . $history->get_code() . "/";
    }

}