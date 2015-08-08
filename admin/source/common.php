<?php

switch ($subsection){
	case "list":
    default:
	
	$data = &$_REQUEST['data'];
	$submit = &$_REQUEST['submit'];
	
		if(@$submit['save']){
			
			
				$errors = array();
				$set = array();
				
					foreach($data as $k=>$v){
						if(empty($data[$k])) $errors[$k] = 'Empty field!';
					}
			
				if(!count($errors)){
					foreach($data as $k => $v){
						
						$set[] = "cc_value = '".$v."'";
						 
						 $sql_save = "
							UPDATE common_conf_trans SET 
							cc_value = '".addslashes($v)."' 
							WHERE fk_cc_id = '".$k."' AND lang='".$_SESSION['admin_lang']."'
						";
						 mysql_query($sql_save); echo mysql_error();
					}
					
					header("Location: index.php?section=common&subsection=list");

				}else{
					// ako ima gresaka vrati izmenjene podatke u html
					$_SESSION['ERRORS'] = $errors;
				}		
		}
	
		$sql_cc = "
			SELECT *  
			FROM common_conf cc 
			LEFT JOIN common_conf_trans ccf 
			ON cc.cc_id = ccf.fk_cc_id
			WHERE ccf.lang='" . $_SESSION['admin_lang'] . "'
		";
		$result = mysql_query($sql_cc);
		
		if(mysql_num_rows($result) && $result){
			while ($l = mysql_fetch_array($result, MYSQL_ASSOC)){
				$field_params = array(
					'field_type' => $l['field_type'],
					'name' => $l['cc_id'], // . "|" .$l['cc_label'],
					'array_name' => 'data',
					'value' => $l['cc_value'],
					'cc_id' => $l['cc_id'],
					'id' => $l['cc_id'],
					'cc_label_tr' => $l['cc_label_tr'],
					'size' => '60',	
					'class' => 'input_skin_1',	
						
				);
				$l['html_field'] = generate_html_field($field_params);
				$for_output[] = $l;
			}
		}else{
			$smarty->assign("no_result", $labels['no_results']);
		}
		$smarty->assign('cc', $for_output);
        $template = "admin/common/common.tpl";
        break;
}
?>