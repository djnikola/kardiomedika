<?php
/**
 * Email Controller
 *
 * @package Voting
 * @copyright horisen
 * @author zeka
 */
class EmailController extends Controller {

   /**
    * Run method
    */
   public function run(){

        echo "Email Controller";
        exit();

       /*
       $logger = Zend_Registry::get('Zend_Log');
        try{

            $logger->log("CliEmailController action send", Zend_Log::DEBUG);
            $console = $this->getConsoleOptions(
                array(
                        'userId|u=i' => 'user id option, with required integer',
                        'confirmationLink|l=s' => 'confirmation link option, with required string')
            );

            $confirmationLink = $console->getOption("confirmationLink");
            $userId = $console->getOption("userId");
            $logger->log("CliEmail confirmationLink=$confirmationLink", Zend_Log::INFO);
            $logger->log("CliEmail userId=$userId", Zend_Log::INFO);

            //get application
            $application = new Application_Model_Application();
            Application_Model_ApplicationMapper::getInstance()->find("1", $application);
            $logger->log("Read appliction data!", Zend_Log::DEBUG);

            //get user
            $user = new Voting_Model_User();
            Voting_Model_UserMapper::getInstance()->find($userId, $user);

            //read email settings
            $emailSettings = $application->get_email_settings();
            //create email transport object
            $transport = HCMS_Email_TransportFactory::createFactory($application);

            //send Application Mail
            $view = new Zend_View();
            $view->addScriptPath(APPLICATION_PATH . '/modules/voting/views/scripts');
            $view->assign("confirmationLink", $confirmationLink);
            $view->assign($emailSettings['text']);
            $body = $view->render("/email/confirmation.phtml");
            $logger->log("email body: $body", Zend_Log::DEBUG);
       
            $mail = new Zend_Mail('UTF-8');
            $mail->setBodyHtml($body);
            $mail->setFrom($emailSettings['from_email'], $emailSettings['from_name']);
            $mail->addTo(trim($user->get_email()));
            $mail->setSubject($emailSettings['subject']);
            $mail->send($transport);

            $logger->log("Succesfully send email", Zend_Log::DEBUG);
            exit(0);
        }catch(Exception $e){
            $logger->log("Exception in send email, message:". $e->getMessage(), Zend_Log::ERR);
            $logger->log("Exception trace:". $e->getTraceAsString(), Zend_Log::ERR);
            exit(0);
        }
        */
   }

}