<?php
switch ($subsection){
	
	case "list":
    default:
	
	$data = &$_REQUEST['data'];
	$submit = &$_REQUEST['submit'];
	
		if(@$submit['save']){
				$errors = array();
				$set = array();

				foreach($config['controlers'] as $controler){
					//if(empty($data[$controler.'_meta_title'])) $errors[$controler.'_meta_title'] = $controler.'_meta_title empty field!';
				}
				
				if(!count($errors)){

					foreach($config['controlers'] as $controler){
				
						$sql_save = "
						UPDATE common_meta SET 
							mt_meta_title = '".addslashes($data[$controler.'_meta_title'])."',
							mt_meta_keywords = '".addslashes($data[$controler.'_meta_keywords'])."',
							mt_meta_description = '".addslashes($data[$controler.'_meta_description'])."'
						WHERE mt_index = '".$controler."' AND lang='".$_SESSION['lang']."'
						";
						mysql_query($sql_save); echo mysql_error();
					}
					
					header("Location: index.php?section=meta&subsection=list");
				}else{
					// ako ima gresaka vrati izmenjene podatke u html
					$_SESSION['ERRORS'] = $errors;
				}		
		}

		$sql_mt = "SELECT * FROM common_meta WHERE lang='".$_SESSION['lang']."'";
		$result = mysql_query($sql_mt);

		if(mysql_num_rows($result) && $result){
			while ($l = mysql_fetch_array($result, MYSQL_ASSOC)){
				$for_output[] = $l;
			}
			
		}else{
			$smarty->assign("no_result","No results");
		}
		
		$smarty->assign('mt', $for_output);
        $template = "admin/common/meta.tpl";
        break;
}
?>