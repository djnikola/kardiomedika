<?php
/**
 * Utils
 * 
 * @copyright horisen
 * @author zeka
 */
class Utils {

    /**
     * Send confirmation email
     * @param $smarty
     * @param $basePath
     * @param Voting_Model_User $user
     * @param string $confirmationLink
     * @return bool
     */
    public static function sendConfirmationEmail($smarty, $basePath, $user, $confirmationLink){
        //Define email template
        $smarty->template_dir = BASE_PATH . '/source/voting/views/scripts/email/';
        //get application
        $application = new Voting_Model_Application();
        Voting_Model_ApplicationMapper::getInstance()->find("1", $application);

        //read email settings
        $emailSettings = $application->get_email_settings();
        $smarty->assign('confirmationLink', $confirmationLink);
        $smarty->assign('heading', $emailSettings['text']['heading']);
        $smarty->assign('description', $emailSettings['text']['description']);
        $smarty->assign('footer', $emailSettings['text']['footer']);
        $body = $smarty->fetch("confirmation.tpl");

        $smarty->template_dir = BASE_PATH . "/templates/";

        $status = false;
        require_once ('libs/phpmailer/class.phpmailer.php');
	// sent an email...
        $mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug  = 1;                                          // enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;                                       // enable SMTP authentication
	$mail->Host       = $emailSettings['parameters']['server'];     // SMTP server
	$mail->Username   = $emailSettings['parameters']['username'];   // SMTP account username
	$mail->Password   = $emailSettings['parameters']['password'];   // SMTP account password
	$mail->From       = $emailSettings['from_email'];
	$mail->FromName   = $emailSettings['from_name'];
        $mail->Subject    = $emailSettings['subject'];
	$mail->CharSet    = "UTF-8";
	$mail->IsHTML(true);
        $mail->MsgHTML($body);
        $mail->AddAddress(trim($user->get_email()));

        if (($status = $mail->Send())){
            error_log("success sending e-mail to " . trim($user->get_email()));
        } else {
            error_log("failure sending e-mail to " . trim($user->get_email()));
        }
        return $status;
   }


}
?>
