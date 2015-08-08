<?php

switch ($subsection){
	
	case "new": 
		$submit = &$_REQUEST['submit'];
		$data = &$_REQUEST['data'];
		$history_id = &$_REQUEST['history_id'];
		
                
		$landing_marker = '';
		$file_config = array(
		"root_dir" => BASE_PATH,
		"upload_dir" => "uploads/history",
		"input_file" => "image",
		"error_name" => "image_error",
		"max_size" => "200000",
		"extensions" => "jpg",
		"tmp_dir" => "tmp_uploads",
		"input_file_path" => "image_path",
		"input_file_name" => "image_name",
		"thumbnail_sizes" => "history_thumbnails",
		);
		
                //dumper($_REQUEST);//exit;

		$history_obj = new History();
		
			if(isset($history_id) && $history_id > 0){
					$history_obj->history_id = $history_id;
					$history_obj->get();	
			}
			if(@$submit['save']){
				$errors = array();

				if(empty($data['caption'])) $errors['caption'] = "Please enter Title";
				//if(empty($data['content'])) $errors['content'] = "Please enter Content";
				if($_FILES[$file_config['input_file']])	@upload_save_tmp($data, $file_config, $errors);
					$history_obj->content = $data['content'];
					$history_obj->caption = $data['caption'];
					//$history_obj->publish_date = date_converter_from_serbian_format($data['publish_date']);
		
				if(!count($errors)){
					// ako nema gresaka snimi ili update
					if($history_id){
                                                            //dumper($data);exit;
					#Delete old picture 
					if(!empty($_FILES[$file_config['input_file']]['name']) || isset($data['remove_picture'])){  
                                                
						$picture_path = $history_obj->image;
						@unlink(BASE_PATH . $picture_path);
						@remove_thumbnails(BASE_PATH . $picture_path, $config['history_thumbnails']);
						$history_obj->image = '';
						
						if(!empty($_FILES[$file_config['input_file']]['name'])){
							#New picture
							$picture_path = @upload_save($data, $file_config, $history_obj->history_id);
							$history_obj->image = $picture_path;
						}
					}
		
					$history_obj->update();
					$history_obj->get();
					_redirect("index.php?section=history&subsection=list");
					}else{
						$history_id = $history_obj->add();
						$history_obj->history_id = $history_id;
							#New picture
							$picture_path = @upload_save($data, $file_config, $history_id);
							$history_obj->image = $picture_path; //dumper($picture_path);exit;
							$history_id = $history_obj->update();
						$history_obj->get();
						_redirect("index.php?section=history&subsection=list");
					}
				}else{
					// ako ima gresaka vrati izmenjene podatke u html
					$_SESSION['ERRORS'] = $errors;
				}
				
			}
		$smarty->assign('content', $history_obj->content);
		
		$smarty->assign('image', $history_obj->image);   
		$smarty->assign('image_name', $data['image_name']);
		$smarty->assign('caption', $history_obj->caption);

		
		//$smarty->assign('publish_date', fromsqldate($history_obj->publish_date, "d/m/Y"));
		$smarty->assign('history_id', $history_obj->history_id);
		$smarty->assign('picture_thumbnail_path', make_thumbnail_url($history_obj->image, $config[$file_config['thumbnail_sizes']][0]));
		#======================================================	
//		$show_history_type_options = array('music'=>'Music', 'sport'=>'Sport', 'messen'=>'Messen', 'special'=>'Special');
//		$dropdown_historys_type = '';
//		foreach($show_history_type_options as $value =>$label){
//			$selected = $value == $history_obj->history_type ? 'selected=selected':'';
//			$dropdown_history_type .= '<option value='.$value.' '.$selected.'>'.$label.'</option>\n'; 
//		}
//		$smarty->assign("dropdown_history_type", $dropdown_history_type);
		#======================================================	
		#======================================================	
//		$is_active_options = array('yes'=>'Yes', 'no'=>'No');
//		$labels = array('yes' => '' . $labels['yes'] . '', 'no' => '' . $labels['no'] . '');
//		$dropdown_is_active = '';
//		foreach($is_active_options as $value =>$label){
//			$selected = $value == $history_obj->is_active ? 'selected=selected':''; 
//			$dropdown_is_active .= '<option value='.$value.' '.$selected.'>'.$labels[strtolower($label)].'</option>\n'; 
//		}
//		$smarty->assign("dropdown_is_active", $dropdown_is_active);
		#======================================================
		$template = "admin/history/new.tpl";
		if(@$submit['cancel']){
		    _redirect("index.php?section=history&subsection=list");
		}
		
	break;
	
	case "delete":
		$history_obj = new History($_REQUEST['history_id']);
		$history_obj->get();
		$picture_path = $history_obj->image;
		@unlink(BASE_PATH . $picture_path);
		@remove_thumbnails(BASE_PATH . $picture_path, $config['history_thumbnails']);
		
		$history_obj->delete();
        _redirect("index.php?section=history&subsection=list");
	break;
	
	
	case "list":
    default:
    saveReturnPoint();
	$history_obj = new History();
	$data = &$_REQUEST['data'];
	$filter = &$_REQUEST['filter'];
	
	#searching conditions
	#--------------------------------------------------------------------	

	//date transformation	
	$smarty->assign(array(  "CAPTION_PART" => "$filter[caption_part]",   					   		
	
	));

	$where = array();
	
	if ($filter['caption_part']) $where[] = "ht.caption like '%".addslashes($filter['caption_part'])."%'";


	if(count($where)){
		$where ="WHERE ".join(" and \n",$where);
	} else {
        $where = "";
	}
	#------------------------------------------------------------------------------

 //order by generation
 
	
	  
	if (@$data['order'] == ''){
		$data['order'] = "h.history_id desc";
	}
	$smarty->assign("ORDER", $data['order']);
	if (@$data['page'] == ''){
		$data['page'] = 0;
	}
  $order_by = "ORDER BY ".$data['order']."";
    
  //paging
  //$result=mysql_query("SELECT count(*) FROM history AS h $where");
  
  $resalt=mysql_query("SELECT count(*) 
  		FROM history AS h 
		LEFT JOIN history_trans AS ht ON ht.fk_history_id = h.history_id 
		$where AND ht.lang = '".$_SESSION['admin_lang']."'" );

//        dumper("SELECT count(*) 
//  		FROM history AS h 
//		LEFT JOIN history_trans AS ht ON ht.fk_history_id = h.history_id 
//		$where AND ht.lang = '".$_SESSION['admin_lang']."'" );  
        
        
  if ($result && mysql_num_rows($result)) { 
    $total = mysql_result($result,0,0);	
    $per_page = 10;
    $pages = ceil($total / $per_page);
    if ($data['page'] > $pages)
      $data['page'] = $pages;
    if ($data['page'] <= 0) 
      $data['page'] = 1;
    $limit_sql = "LIMIT ".($data['page']-1)*$per_page.",$per_page";
  }

  $smarty->assign(array("TOTAL"  => "$total",
                     "PAGES"  => "$pages",
                     "PAGE"   => "$data[page]",
                     "NEXT"   => $data['page']+1,
                     "PREV"   => $data['page']-1,
                     "PER_PAGE" => $per_page,
  ));
		
		
		$all_history = array();
		$for_output = array();

		$all_history = $history_obj->get_all_history_admin($where, $limit_sql, $order_by);
		//dumper($all_history);exit;
		if($all_history){
			foreach ($all_history as $new){
				$for_output[] = $new;
			}
		}else{
			$smarty->assign("no_result",$labels['no_results']);
		}
                
                //dumper($for_output); exit;
		#======================================================	
//		$show_history_type_options = array('music'=>'Music', 'sport'=>'Sport', 'messen'=>'Messen', 'special'=>'Special');
//		$dropdown_history_type = '';
//		foreach($show_history_type_options as $value =>$label){
//			$selected = $value == $history_obj->history_type ? 'selected=selected':'';
//			$dropdown_history_type .= '<option value='.$value.' '.$selected.'>'.$label.'</option>\n'; 
//		}
//		$smarty->assign("dropdown_history_type", $dropdown_history_type);
		#======================================================	
		#======================================================	
//		$labels = array('yes' => ''.$labels['yes'].'', 'no' => ''.$labels['no'].'');
//		$is_active_options = array('yes'=>$labels['yes'], 'no'=>$labels['no']);
//		$dropdown_is_active = '';
//		foreach($is_active_options as $value =>$label){
//			$selected = $value == $filter['is_active'] ? 'selected=selected':'';
//			$dropdown_is_active .= '<option value='.$value.' '.$selected.'>'.$label.'</option>\n'; 
//		}
//		$smarty->assign("dropdown_is_active", $dropdown_is_active);
		#======================================================	
		$smarty->assign('admin_history_list', $for_output); //dumper($for_output);exit;
        $template = "admin/history/list.tpl";

        break;
}
?>