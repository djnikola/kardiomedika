<?php

$right = '';
$left = '';
$dinamicInclude = '';

switch ($subsection){
    default:
	case "contact_form":
		$ERRORS = array();
		$data = &$_REQUEST['data'];
		$submit = &$_REQUEST['submit'];
		$landing_marker = '';
		if(!$_REQUEST['data']){
			$data = array();
			$data['name'] = '';
			$data['lname'] = '';
			$data['phone'] = '';
			$data['birth_year'] = '';
			$data['email'] = '';
			$data['from_date'] = '';
			$data['to_date'] = '';
			$data['doctor_name'] = '';
			$data['examination'] = '';
			$data['daily_period'] = '';
			$data['message'] = '';
		}
		$errors = array();
		if(empty($data['name'])) $errors['name'] = 1;
		if(empty($data['lname'])) $errors['lname'] = 1;
		if(empty($data['phone'])) $errors['phone'] = 1;
		
		if($submit['send']){
			if(!count($errors)){
				$contact_obj = new Contact(0,
					$data['name'],
					$data['lname'],
					$data['phone'],
					$data['birth_year'],
					$data['email'],
					$data['from_date'], 
					$data['to_date'],
					$data['doctor_name'],
					$data['examination'],
					$data['daily_period'],
					$data['message']
				);
				$contact_obj->add();
				$smarty->assign('contact_obj', $contact_obj);
				$contact_email_html = $smarty->fetch("contents/forms/user_contact_mail.tpl");

				#Send email 
					$headers  = "MIME-Version: 1.0\n";
					$headers .= "Content-type: text/html; charset=utf-8";
					send_email($config['contact_send_mail'].";drdmijalkovic@gmail.com;djnikola1978@gmail.com",
						"Zakazivanje sa web sajta: ".$data['lname'] . " ". $data['name'] ."",
						$contact_email_html,
						$data['email'],
						$headers, 
						"", 
						$ERRORS);
					$landing_marker = "saved";
			}else{
				$smarty->assign("errors", $errors);
			}
		}
		foreach($data as $k => $v){
			$smarty->assign(''.$k.'', $v);
		}
		
		$sql_meta = "SELECT * FROM common_meta WHERE mt_index = 'contact' AND lang='".$_SESSION['lang']."'";
		$res_meta = mysql_query($sql_meta);
		$meta_tags = mysql_fetch_array($res_meta, MYSQL_ASSOC);
		
		$meta['title'] = $meta_tags['mt_meta_title'];
		$meta['keywords'] = $meta_tags['mt_meta_keywords'];
		$meta['description'] = $meta_tags['mt_meta_description'];
		$template = "forms/user_contact_form.tpl";
		if($landing_marker == "saved"){
			header("Location: ".$baseUrl."sr/zakazivanje-pregleda-potvrda");
		}
        else{
        	$template = "forms/user_contact_form.tpl";
        }
        break;
        
	case "contact_form_landing":
		$template = "forms/user_contact_form_landing.tpl";
	break;        

}

?>