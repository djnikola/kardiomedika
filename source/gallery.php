<?php		
$right = '';
$left = '';
$dinamicInclude = '';
$real_page_title = $labels['gallery'];
switch ($subsection){

	case "view":
		$gallery_obj = new Gallery();
		$gallery_obj->gallery_id = $_REQUEST['gallery_id'];
		$gallery_obj->setUpLanguages($config['languages'], $_SESSION['lang']);
		$gallery_obj->get();
		
		$data = &$_REQUEST['data'];
		$filter = &$_REQUEST['filter'];

		#searching conditions
		#--------------------------------------------------------------------

		$where = array();
		
		if(count($where)){
			$where =" WHERE ".join(" AND \n",$where);
		} else {
	  		$where = "";
		}
		#------------------------------------------------------------------------------
		//order by generation
		 
		if (@$data['order'] == ''){
			$data['order'] = "gp.sort";
		}
		$smarty->assign("ORDER", $data['order']);
		if (@$data['page'] == '') {
			$data['page'] = 0;
		}
		$order_by = "ORDER BY ".$data['order']."";

		//paging
		$result=mysql_query("SELECT count(*) FROM gallery_pictures AS gp $where");
		//	echo "<p> count error = ".mysql_error();
		if ($result && mysql_num_rows($result)) {
			$total = mysql_result($result,0,0);
			$per_page = 1000;
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
		
		$gallery_obj->getAllGalleryPictures($where, $limit_sql, $order_by, $config['gallery_pictures_thumbnails'][1]);
		
		//dumper($gallery_obj->picture_arr);
		
		if(empty($gallery_obj->meta_title)){
			$meta['title'] = $gallery_obj->name;
		}else{
			$meta['title'] = $gallery_obj->meta_title;
		}
		$meta['keywords'] = $gallery_obj->meta_keywords;
		$meta['description'] = $gallery_obj->meta_description;

		if($gallery_obj->is_active == 1){
			$smarty->assign("gallery_obj", $gallery_obj);
			$template = "gallery/view.html";
		}else{
			header("Location: " . $baseUrl . "");
		}
		break;

	case "gallery_list":
	default:
		$gallery_obj = new Gallery();
		$gallery_obj->setUpLanguages($config['languages'], $_SESSION['lang']);
		$data = &$_REQUEST['data'];
		$gallery_category_id = 0;
		if(isset($_REQUEST['gallery_category_id']) && $_REQUEST['gallery_category_id'] != ''){
			$gallery_category_id = $_REQUEST['gallery_category_id'];
		}
		$data = &$_REQUEST['data'];
		
		$filter = &$_REQUEST['filter'];

		#searching conditions
		#--------------------------------------------------------------------

		$where = array();
		if($gallery_category_id){
			$where[] = "gc.gallery_category_id = ".$gallery_category_id."";
		}
		
		
		if(count($where)){
			$where =" WHERE ".join(" AND \n",$where);
		} else {
	  		$where = "";
		}
		
		#------------------------------------------------------------------------------
		//order by generation
		 
		if (@$data['order'] == ''){
			$data['order'] = "gc.sort asc";
		}
		$smarty->assign("ORDER", $data['order']);
		if (@$data['page'] == ''){
			$data['page'] = 0;
		}
		$order_by = "ORDER BY ".$data['order']."";

		//paging
		$result=mysql_query("SELECT count(*) FROM gallery_category AS gc $where");
		//	echo "<p> count error = ".mysql_error();
		if ($result && mysql_num_rows($result)) {
			$total = mysql_result($result,0,0);
			$per_page = 1000;
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
		
		$all_categories = $gallery_obj->getAllCategories($where, $limit_sql, $order_by);
		
		$for_output = array();
                
		if(count($all_categories)){
			foreach ($all_categories as $category){		
				$for_output[] = $category;
			}
		}else{
			$smarty->assign("no_result", $labels['no_results']);
		}
		$sql_meta = "SELECT * FROM common_meta WHERE mt_index = 'gallery'";
		$res_meta = mysql_query($sql_meta);
		$meta_tags = mysql_fetch_array($res_meta, MYSQL_ASSOC);
		
		$meta['title'] = $meta_tags['mt_meta_title'];
		$meta['keywords'] = $meta_tags['mt_meta_keywords'];
		$meta['description'] = $meta_tags['mt_meta_description'];
		
		$smarty->assign('gallery_category_list', $for_output);
		$template = "gallery/list.html";
		break;
}
?>