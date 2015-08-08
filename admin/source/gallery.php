<?php

switch ($subsection) {
		
	case "new_gallery": 
		$submit = &$_REQUEST['submit'];
		$data = &$_REQUEST['data'];
		$gallery_id = &$_REQUEST['gallery_id'];
		$landing_marker = '';
		$file_config = array(
		"root_dir" => BASE_PATH,
		"upload_dir" => "uploads/gallery",
		"input_file" => "picture_path",
		"error_name" => "image_error",
		"max_size" => "200000",
		"extensions" => "jpg",
		"tmp_dir" => "tmp_uploads",
		"input_file_path" => "image_path",
		"input_file_name" => "image_name",
		"thumbnail_sizes" => "gallery_thumbnails",
		);
		
		$gallery_obj = new Gallery();
		$gallery_obj->setUpLanguages($config['languages'], $_SESSION['admin_lang']);
		
		//language inicialization
		/*
		$gallery_obj->setUpLanguages($config['languages'], $_SESSION['lang']);
		$gallery_obj->maxPictureNum = $config['galleryMaxPictures'];
		
		for($i=0; $i < $gallery_obj->maxPictureNum; $i++) {
			//object initialization
			$pictureObj = new Picture();
			$pictureObj->basicInitialization($config['gp_table_name'],
											  $config['gp_fk_id_name'], $gallery_id);
			
			$pictureObj->input_file .= "_".$i;
			$pictureObj->input_file_path .= "_".$i;
			$pictureObj->input_file_name .= "_".$i;
											  
			//language inicialization
			$pictureObj->setUpLanguages($gallery_obj->lang_arr, $gallery_obj->lang);		

			//dumper($productPictureObj);
			$gallery_obj->picture_arr[$i] = $pictureObj;
		}
		*/
		if(isset($gallery_id) && $gallery_id > 0) {
			$gallery_obj->gallery_id = $gallery_id;
			$gallery_obj->get();
			$data['image_path'] = $gallery_obj->gallery_path;	
			$data['image_name'] = '';
			//dumper($gallery_obj);

		}
		if(@$submit['save']) {
			$errors = array();

			if($_FILES[$file_config['input_file']]) {
				upload_save_tmp($data, $file_config, $errors);
			}
			if(empty($data['name'])) $errors['name'] = $labels['error_caption'];
			
				$gallery_obj->name = $data['name'];
				$gallery_obj->description = $data['description'];
				$gallery_obj->category_id = $data['category_id'];
				$gallery_obj->is_active = $data['is_active'];
				$gallery_obj->is_special = $data['is_special'];
		
				$gallery_obj->meta_title = $data['meta_title'];
				$gallery_obj->meta_keywords = $data['meta_keywords'];
				$gallery_obj->meta_description = $data['meta_description'];
						
			if(!count($errors)) {
				#If there is no errors save or update
				if($gallery_id) {
					#Delete old picture
					if(isset($data['remove_picture']) || !empty($_FILES[$file_config['input_file']]['name'])){
						$picture_path = $gallery_obj->gallery_path;
						@unlink(BASE_PATH . $picture_path);
						@remove_thumbnails(BASE_PATH . $picture_path, $config['gallery_thumbnails']);
						$gallery_obj->gallery_path = '';
						
						if(!empty($_FILES[$file_config['input_file']]['name'])){
							#New picture
							$picture_path = upload_save($data, $file_config, $gallery_obj->gallery_id);
							$gallery_obj->gallery_path = $picture_path;
						}
					}
		
					$gallery_obj->update();
					$gallery_obj->get();
					header("Location:index.php?section=gallery&subsection=list_gallery");
				}else{
					$gallery_id = $gallery_obj->add();
					$gallery_obj->gallery_id = $gallery_id;
					#New picture
					$picture_path = upload_save($data, $file_config, $gallery_id);
					$gallery_obj->gallery_path = $picture_path;
					$gallery_id = $gallery_obj->update();
					$gallery_obj->get();
					header("Location:index.php?section=gallery&subsection=list_gallery");
				}
			}else{
				// ako ima gresaka vrati izmenjene podatke u html
				$_SESSION['ERRORS'] = $errors;
			}
			
		}
			
		$smarty->assign('name', $gallery_obj->name);
		$smarty->assign('description', $gallery_obj->description);
		$smarty->assign('picture_path', $data['image_path']);
		$smarty->assign('image_name', $data['image_name']);

		$smarty->assign('meta_title', $gallery_obj->meta_title);
		$smarty->assign('meta_keywords', $gallery_obj->meta_keywords);
		$smarty->assign('meta_description', $gallery_obj->meta_description);

		$smarty->assign('gallery_id', $gallery_obj->gallery_id);

		$smarty->assign('picture_thumbnail_path', make_thumbnail_url($gallery_obj->gallery_path, $config[$file_config['thumbnail_sizes']][0]));
		
		//$smarty->assign('PicturesArr', $gallery_obj->picture_arr);
		#======================================================	
		$sql = "
		SELECT * FROM gallery_category as gc
		LEFT JOIN gallery_category_trans as gct ON gct.fk_gallery_category_id=gc.gallery_category_id
		WHERE gct.lang = '" .$_SESSION['admin_lang']. "'";

		$res = mysql_query($sql);
		$show_category_options = array();
		while($p = mysql_fetch_array($res, MYSQL_ASSOC)){
			$show_category_options[$p['gallery_category_id']] = $p['name'];
		}
		$dropdown_show_category = '';
		foreach($show_category_options as $value =>$label){
			$selected = $value == $gallery_obj->category_id ? 'selected=selected':'';
			$dropdown_show_category .= '<option value='.$value.' '.$selected.'>'.$label.'</option>\n'; 
		}
		$smarty->assign("dropdown_show_category", $dropdown_show_category);
		#======================================================	
		#======================================================	
		
		$activeOptions = array(
			'1' => $labels['yes'],
			'0' => $labels['no']
		);
		$selectedActiveOption = empty($gallery_obj->is_active) ? 1 : $gallery_obj->is_active;
		$smarty->assign("activeOptions", $activeOptions);
		$smarty->assign("selectedActiveOption", $selectedActiveOption);
		
		#======================================================
		#======================================================	
		$specialOptions = array(
			'1' => $labels['yes'],
			'0' => $labels['no']
		);
		$selectedSpecialOptions = empty($gallery_obj->is_special) ? 0 : $gallery_obj->is_special;
		$smarty->assign("specialOptions", $specialOptions);
		$smarty->assign("selectedSpecialOptions", $selectedSpecialOptions);
		#======================================================
        
		$template = "admin/gallery/gallery_new.html";
		if(@$submit['cancel']){
		    header("Location:index.php?section=gallery&subsection=list_gallery");
		}
	break;
	
	case "sort_galleries":
		$gallery_obj = new Gallery($_REQUEST['gallery_id']);
		$gallery_obj->sortGallery($_REQUEST['new_order']);
		header("Location:index.php?section=gallery&subsection=list_gallery");
	break;
	
	case "list_gallery":
    default:
	$gallery_obj = new Gallery();
	$gallery_obj->lang_arr = $config['languages'];
	$gallery_obj->lang = $_SESSION['admin_lang'];
	
	$data = &$_REQUEST['data'];
	$filter = &$_REQUEST['filter'];
	
	#searching conditions
	#--------------------------------------------------------------------	
	$where=array();

	//date transformation	
	$smarty->assign(array("NAME_PART" => "$filter[name_part]",  
  					   		"CREATED_DATE_FROM" => "$filter[created_date_from]", 
  					   		"CREATED_DATE_TO" => "$filter[created_date_to]", 
	));

	$where = array();
	if ($filter['name_part']) $where[] = "gt.name like '%".addslashes($filter['name_part'])."%'";
	if ($filter['is_active'] != '') $where[] = "g.is_active = '".$filter['is_active']."'";
	if ($filter['created_date_from']) $where[] = "g.created_date >= '".date_converter_from_serbian_format($filter['created_date_from'])."'";
	if ($filter['created_date_to']) $where[] = "g.created_date <= '".date_converter_from_serbian_format($filter['created_date_to'])."'";

	if(count($where)) {
		$where ="AND ".join(" AND \n",$where);
	} else {
	  $where = "";
	}
	#------------------------------------------------------------------------------

 //order by generation
 
	
	  
	if (@$data['order'] == ''){
		$data['order'] = "g.sort";
	}
	$smarty->assign("ORDER", $data['order']);
	if (@$data['page'] == ''){
		$data['page'] = 0;
	}
  $order_by = "ORDER BY ".$data['order']."";
    
#Paging
	$total = $gallery_obj->getGalleryNumber($where);
	$per_page = 10;
    $pages = 0;
    if($total)
    	$pages = ceil($total / $per_page);
    if ($data['page'] > $pages) $data['page'] = $pages;
    if ($data['page'] <= 0) $data['page'] = 1;
    $limit_sql = "LIMIT ".($data['page']-1)*$per_page.",$per_page";

  $smarty->assign(array("TOTAL"  => "$total",
                     "PAGES"  => "$pages",
                     "PAGE"   => $data['page'],
                     "NEXT"   => $data['page']+1,
                     "PREV"   => $data['page']-1,
                     "PER_PAGE" => $per_page,
  ));
		$for_output = array();

		$all_galleries = $gallery_obj->getAllGalleries($where, $limit_sql, $order_by);
		if($all_galleries){
			foreach ($all_galleries as $gallery){
				$gallery['gallery_path_thumb'] = '../'.make_thumbnail_url($gallery['gallery_path'], $config['gallery_thumbnails'][0]);
				$for_output[] = $gallery;
			}
		}else{
			$smarty->assign("no_result", $labels['no_results']);
		}
		
		#======================================================	
		$activeOptions = array(
			'' => $labels['any'],
			'1' => $labels['yes'],
			'0' => $labels['no']
		);
		$selectedActiveOption = $filter['is_active'];
		$smarty->assign("activeOptions", $activeOptions);

		$smarty->assign("selectedActiveOption", $selectedActiveOption);
		#======================================================	
		$smarty->assign('admin_gallery_list', $for_output);
        $template = "admin/gallery/gallery_list.html";
        break;

	case "new_gallery_pictures":
		$submit = &$_REQUEST['submit'];
		$data = &$_REQUEST['data'];		
		$gallery_id = &$_REQUEST['gallery_id'];
		$landing_marker = '';
		$data = $_REQUEST['data'];
		
		$gallery_obj = new Gallery();
		$gallery_obj->setUpLanguages($config['languages'], $_SESSION['admin_lang']);

		$gallery_obj->gallery_id = $gallery_id;
		$gallery_obj->get();
		
		
		for($i = 0; $i < $config['upload_picture_number']; $i++) {
			$picture_obj = new Picture();
			$picture_obj->setUpLanguages($config['languages'], $_SESSION['admin_lang']);
			$picture_obj->table_name = "gallery_pictures";
			$picture_obj->fk_id_name = "fk_gallery_id";
			$picture_obj->fk_id = $gallery_id;
			$picture_obj->tmp_dir = "tmp_uploads";
			$picture_obj->root_dir = "../";
			$picture_obj->upload_dir = "uploads/gallery_pictures";
			$picture_obj->thumbnail_sizes = $config['gallery_pictures_thumbnails'];
			$picture_obj->input_file .= "_".$i;
			$picture_obj->input_file_path = $data['image_path_'.$i.''];
			$picture_obj->input_file_name = $data['image_name_'.$i.''];
			
			$gallery_obj->picture_arr[] = $picture_obj;
		}
		
		
		if(@$submit['save']) {
			$errors = array();
			
			@reset($gallery_obj->picture_arr);
			for($i = 0; $i < $config['upload_picture_number']; $i++) {
				if($_FILES[$gallery_obj->picture_arr[$i]->input_file]['size'] == 0) {
					continue;
				}
				
				//if(empty($data["picture_$i"]['name']))  $errors["picture_$i"]['name'] = $labels['error_caption'];
//				if(empty($data["picture_$i"]['description'])) 
//					$errors["picture_$i"]['description'] = $labels['error_description'];	
	
				$gallery_obj->picture_arr[$i]->upload_save_tmp($errors["picture_$i"]);
				$gallery_obj->picture_arr[$i]->name = $data['picture_'.$i]['name'] = "";
				$gallery_obj->picture_arr[$i]->description = $data['picture_'.$i]['description'];
				//$gallery_obj->picture_arr[$i]->sort = $data['picture_'.$i]['sort'];

				if (!count($errors["picture_$i"])) {
					$gallery_obj->picture_arr[$i]->add();				
					$gallery_obj->picture_arr[$i]->upload_save($gallery_obj->picture_arr[$i]->picture_id);
					$gallery_obj->picture_arr[$i]->path = $gallery_obj->picture_arr[$i]->input_file_path;
					$gallery_obj->picture_arr[$i]->setThumbnailPath("100x100");
					$gallery_obj->picture_arr[$i]->update();
					$_SESSION['NOTICES']['pictures_saved'] = 'Pictures are saved.';
				}
				$_SESSION['ERRORS'] = $errors['picture_0'];
				if($gallery_obj->picture_arr[$i]->picture_id) $gallery_obj->picture_arr[$i]->unset_object();
			}
		}
		
		if(@$submit['cancel']) {
			header("Location:index.php?section=gallery&subsection=list_gallery_pictures&gallery_id=".$gallery_id."");
			
		}
		
		//$smarty->assign("PicturesArr", $gallery_obj->picture_arr);
		$smarty->assign("gallery", $gallery_obj);
		$template = "admin/gallery/picture_new.tpl";	
	break;
	
    case "delete_gallery_picture":
    	$picture_id = &$_REQUEST['picture_id'];
    	$gallery_id = &$_REQUEST['gallery_id'];

    	$pictureObj = new Picture();
    	if($picture_id > 0) {
	    	$pictureObj->setUpLanguages($config['languages'], $_SESSION['admin_lang']);
			$pictureObj->table_name = "gallery_pictures";
			$pictureObj->fk_id_name = "fk_picture_id";
			$pictureObj->fk_id = $gallery_id;
			$pictureObj->picture_id = $picture_id;
			$pictureObj->root_dir = "../";
			#Need to take file system path to picture that need to be deleted
			$pictureObj->get();
			#delete file
			@unlink(BASE_PATH . $pictureObj->path);
			#Delete picture from file system and database
			$pictureObj->delete();
			
			header("Location:index.php?section=gallery&subsection=list_gallery_pictures&gallery_id=". $gallery_id ."");
    	}
    break;    
        
    case "list_gallery_pictures":
    	$gallery_id = &$_REQUEST['gallery_id'];
    	if(!isset($gallery_id) || $gallery_id == 0){
    		$gallery_id = -1;
    	}
    	
    	$gallery_obj = new Gallery();
    	$gallery_obj->gallery_id = $gallery_id;
    	$gallery_obj->lang_arr = $config['languages'];
    	$gallery_obj->lang = $_SESSION['admin_lang'];
    	$gallery_obj->get();

    	$data = &$_REQUEST['data'];
    	$filter = &$_REQUEST['filter'];
    	#searching conditions
    	#--------------------------------------------------------------------
    	$where=array();

    	//date transformation
    	$smarty->assign(array(
    		"NAME_PART" => "$filter[name_part]",
  		));

    	$where = array();

    	if ($filter['name_part']) $where[] = "gpt.name like '%".addslashes($filter['name_part'])."%'";
    	if(count($where)){
    		$where ="AND ".join(" AND \n",$where);
    	} else {
    		$where = "";
    	}
    	#------------------------------------------------------------------------------

    	//order by generation


    	$pages = 0;
    	if (@$data['order'] == ''){
    		$data['order'] = "gp.sort desc";
    	}
    	$smarty->assign("ORDER", $data['order']);
    	if (@$data['page'] == ''){
    		$data['page'] = 0;
    	}
    	$order_by = "ORDER BY ".$data['order']."";
    	#Paging
    	$total = $gallery_obj->getGalleryPictureNumber($where);
    	//$result=mysql_query("SELECT count(*) FROM gallery_pictures AS gp $where");
    	//dumper("SELECT count(*) FROM gallery_pictures AS gp $where");
    	//if ($result && mysql_num_rows($result)) {
		//	$total = mysql_result($result,0,0);
    		$per_page = 10;
    		if($total)
    			$pages = ceil($total / $per_page);
    		if ($data['page'] > $pages)
	      	$data['page'] = $pages;
	      	if ($data['page'] <= 0)
	      	$data['page'] = 1;
	      	$limit_sql = "LIMIT ".($data['page']-1)*$per_page.",$per_page";
	    //}

    	$smarty->assign(array("TOTAL"  => "$total",
                     "PAGES"  => "$pages",
                     "PAGE"   => "$data[page]",
                     "NEXT"   => $data['page']+1,
                     "PREV"   => $data['page']-1,
                     "PER_PAGE" => $per_page,
    	));
    	$all_gallery_pictures = array();
    	$for_output = array();

    	$gallery_obj->getAllGalleryPictures($where, $limit_sql, $order_by);
    	
    	if(!count($gallery_obj->picture_arr)) {
    		$smarty->assign("no_result", $labels['no_results']);
    	}
    	//dumper($gallery_id);	
    	$smarty->assign('admin_gallery_picture_list', $gallery_obj->picture_arr);
    	$smarty->assign('gallery_id', $gallery_id);
    	$smarty->assign('gallery_name', $gallery_obj->name);
    	$template = "admin/gallery/picture_list.tpl";
    	
    	break;
    	
    case "new_gallery_category":
    	$submit = &$_REQUEST['submit'];
		$data = &$_REQUEST['data'];
		$gallery_category_id = &$_REQUEST['gallery_category_id'];
		$landing_marker = '';
		$galleryObj = new Gallery();
		$galleryObj->setUpLanguages($config['languages'], $_SESSION['admin_lang']);
		
		if(!empty($gallery_category_id)) {
			$galleryObj->category_id = $gallery_category_id;
			$galleryObj->getGalleryCategory();
		}
		//dumper($galleryObj);
		$errors = array();
		if(@$submit['save']) {
			
			if(empty($data['name'])) 
				$errors['name'] = $labels['error_caption'];
			
			$galleryObj->category_name = $data['name'];
			$galleryObj->category_description = $data['description'];
			$galleryObj->category_sort = $data['sort'];
			//dumper($galleryObj);
			if(!count($errors)) {
				if($gallery_category_id) {
					$galleryObj->updateGalleryCateogry();
				}
				else {
					$galleryObj->addGalleryCategory();					
				}
				header("Location:index.php?section=gallery&subsection=list_gallery_category");
				
			}
			else {
				// If there are errors
				$_SESSION['ERRORS'] = $errors;
			}
		}
		$smarty->assign('gallery_category_id', $galleryObj->category_id);
		$smarty->assign('gallery_category_name', $galleryObj->category_name);
		$smarty->assign('gallery_category_description', $galleryObj->category_description);
		$smarty->assign('gallery_category_sort', $galleryObj->category_sort);
		
		$template = "admin/gallery/category_new.tpl";
		if(@$submit['cancel']) {
		    header("Location:index.php?section=gallery&subsection=list_gallery_category");
		}
		
    break;

    case "list_gallery_category":
	
		$data = &$_REQUEST['data'];
		$filter = &$_REQUEST['filter'];
		
		$gallery_obj = new Gallery();
		$gallery_obj->lang_arr = $config['languages'];
		$gallery_obj->lang = $_SESSION['admin_lang'];
		#searching conditions
		#--------------------------------------------------------------------	
		$where=array();
	
		//date transformation	
		$smarty->assign(array("NAME_PART" => "$filter[name_part]"
		));
	
		$where = array();
		if ($filter['name_part']) $where[] = "gct.name LIKE '%".addslashes($filter['name_part'])."%'";
	
		if(count($where)) {
			$where ="AND ".join(" AND \n",$where);
		} else {
		  $where = "";
		}
		#------------------------------------------------------------------------------
	
	#Order by generation
		  
		if (@$data['order'] == ''){
			$data['order'] = "gc.sort DESC";
		}
		$smarty->assign("ORDER", $data['order']);
		if (@$data['page'] == '') {
			$data['page'] = 0;
		}
	  $order_by = "ORDER BY ".$data['order']."";
	#Paging
		$total = $gallery_obj->getGalleryCategoryNumber($where);
		$per_page = 10;
		$pages = 0;
		if($total)
		$pages = ceil($total / $per_page);
		if ($data['page'] > $pages) $data['page'] = $pages;
		if ($data['page'] <= 0) $data['page'] = 1;
		$limit_sql = "LIMIT ".($data['page']-1)*$per_page.",$per_page";
	
		$smarty->assign(array(
			"TOTAL"  => "$total",
			"PAGES"  => "$pages",
	        "PAGE"   => $data['page'],
	        "NEXT"   => $data['page']+1,
	        "PREV"   => $data['page']-1,
	        "PER_PAGE" => $per_page,
	  	));
		$allGalleryCategories = array();
		$for_output = array();
	
		$allGalleryCategories = $gallery_obj->getAllCategories($where, $limit_sql, $order_by);
		if($allGalleryCategories) {
			foreach ($allGalleryCategories as $galleryCategory) {
				$for_output[] = $galleryCategory;
			}
		}
		else {
			$smarty->assign("no_result", $labels['no_results']);
		}
		
		$smarty->assign('gallery_category_list', $for_output);
		$template = "admin/gallery/category_list.tpl";
    break;

    case "delete_gallery_category":
    	$gallery_category_id = &$_REQUEST['gallery_category_id'];
		$landing_marker = '';
		$galleryObj = new Gallery();
		$galleryObj->setUpLanguages($config['languages'], $_SESSION['admin_lang']);
		$galleryObj->category_id = $gallery_category_id;
		
		if(!$galleryObj->countGalleriesForGalleryCategory()) {
			$deleted = $galleryObj->deleteGalleryCategory($errors);
			if(!$deleted)
				$ERRORS = $labels['category_not_empty'];
		}
		//$smarty->assign('gallery_category_list', $for_output);
		$template = "admin/gallery/category_list.tpl";
		header("Location:index.php?section=gallery&subsection=list_gallery_category");
	break;
	
	case "delete_gallery":
    	$gallery_id = &$_REQUEST['gallery_id'];
		$galleryObj = new Gallery();
		$galleryObj->setUpLanguages($config['languages'], $_SESSION['admin_lang']);
		$galleryObj->gallery_id = $gallery_id;
		$galleryObj->root_dir = BASE_PATH;
		$galleryObj->get();
		$galleryObj->delete();
		header("Location:index.php?section=gallery&subsection=list_gallery");
	break;

}
?>