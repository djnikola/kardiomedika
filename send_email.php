<?php
include_once('external/phpmailer/class.phpmailer.php');

function initHtmlForEmail(){
	$html  = '';
	$html .= '<html><head>';
	$html .= '<style type="text/css">';
	$html .= '
	h1 {
		color: #000;
		font: normal 16px Verdana, Helvetica, sans-serif;
		margin: 0;
		padding: 0;
	}
	p {
		font: normal 11px Verdana, Helvetica, sans-serif;
		margin: 0 0 5px 0;
		padding: 0;
	}
    br {
        line-height: 5px;
    }
				';
	$html .= '</style>';
	$html .= '</head>';
	$html .= '<body>';

    return $html;
}

function sendEmail($html, $config){
    $sts = false;

	// sent an email...
    $mail             = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug  = 1;                 // enables SMTP debug information (for testing)
	$mail->SMTPAuth   = true;              // enable SMTP authentication
	$mail->Host       = "mail.horisen.com";  // SMTP server
	$mail->Username   = "boris@horisen.com";        // SMTP account username
	$mail->Password   = "boris";        // SMTP account password

	$mail->From       = "boris.kundacina@horisen.com";
	$mail->FromName   = "DJ F.A.B.";
    $mail->Subject    = "DJ F.A.B.";
	$mail->CharSet    = "UTF-8";
	$mail->IsHTML(true);
    $mail->MsgHTML($html);

    if ($config["contact_form_email_recipient"] != ""){
        $mail->AddAddress($config["contact_form_email_recipient"]);

        if (($sts = $mail->Send())){
            error_log("success sending e-mail to ".$config["contact_form_email_recipient"]);
        } else {
            error_log("failure sending e-mail to ".$config["contact_form_email_recipient"]);
        }
    } else {
        error_log("failure sending e-mail - e-mail is empty");
    }

	return $sts;
}


?>
