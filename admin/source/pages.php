<?php
switch ($subsection){
	
	case "new":
		$submit = &$_REQUEST['submit'];
		$data = &$_REQUEST['data'];
		$page_id = &$_REQUEST['page_id'];
		if(isset($data['parent']) && $data['parent'] != 0){
			$_REQUEST['parent'] = $data['parent'];
		}
                
                
        
        $parent = (isset($_REQUEST['parent']) && $_REQUEST['parent'] != '') ? $_REQUEST['parent'] : 0;
		if($parent > 0) $data['show_place'] = Page::get_parent_place ($parent);		
		
        $page_obj = new Page();
		$page_obj->root_page_title = $labels['root_page_title'];

			if(isset($page_id) && $page_id > 0){
                $page_obj->id = $page_id;
                $page_obj->get();
                $parent = $page_obj->parent;
			}
			if(@$submit['save']){
				$errors = array();
				if(empty($data['caption'])) $errors['caption'] = $labels['error_caption'];
                //if(empty($data['content'])) $errors['content'] = $labels['error_page_content'];
				//if(empty($data['parent']) && empty($page_id)) $errors['parent'] = 'Please select parent page!';
                    
				if(!count($errors)){
                    //$page_obj->link = $data['link'];
                    $page_obj->navigation = $data['navigation'];
					$page_obj->content = $data['content'];
					$page_obj->parent = $data['parent'];
					$page_obj->request_params = "section=pages&subsection=view";
					$page_obj->caption = $data['caption'];
					$page_obj->show_place = $data['show_place'];
					$page_obj->level = $data['parent'] > 0 ? 1 : 0;

					// ako nema gresaka snimi ili update
					if($page_id){
                        $page_obj->permalink = createPermaLinks($data['caption'], $page_id);
						$page_obj->update();
						$_SESSION['NOTICES']['page_updated'] = "Page is Updated";
						_redirect("index.php?section=pages&subsection=list");
					}else{
                        $page_obj->permalink = createPermaLinks($data['caption']);
						if($page_id = $page_obj->add()){
							$page_obj->id = $page_id;
							$_SESSION['NOTICES']['page_saved'] = "Page is saved";
							_redirect("index.php?section=pages&subsection=list");
						}
					}
				}else{
					// if there is some errors send them back
					$_SESSION['ERRORS'] = $errors;
				}
				
			}
		$smarty->assign('content', $page_obj->content);
		$smarty->assign('caption', $page_obj->caption);
		$smarty->assign('link', $page_obj->link);
        $smarty->assign('navigation', (isset($page_obj->navigation) && $page_obj->navigation != '')? $page_obj->navigation : 'yes');
		$smarty->assign('page_id', $page_obj->id);
		#======================================================	
		$show_place_options = array('first'=>'Glavni meni','second'=>'Interna medicina', 'forth' => 'Pedijatrija', 'fifth' => 'Psihijatrija', 'third'=>'Neurologija');
		$dropdown_show_place = '';
		foreach($show_place_options as $value =>$label){
			$selected = $value == $page_obj->show_place ? 'selected=selected':'';
			$dropdown_show_place .= '<option value='.$value.' '.$selected.'>'.$label.'</option>\n'; 
		}
		$smarty->assign("dropdown_show_place", $dropdown_show_place);
		#======================================================	
		
		#======================================================
		$page_tree = $page_obj->generatePageTree();
		$pt = array();
		foreach ($page_tree as $k => $v) {
			if ($page_id == $k)
				continue;
			$pt[$k] = str_repeat(' - ', $v['level']) . $v['title'];
		}
		$smarty->assign('page_tree', $pt);
		$smarty->assign('parent', $parent);
		$smarty->assign('show_place', $_REQUEST['show_place']);
		#======================================================	

		$template = "admin/pages/new.tpl";
		if(@$submit['cancel']){
		    _redirect("index.php?section=pages&subsection=list");
		}
	break;
	
	case "sort_pages":
		$page_obj = new Page($_REQUEST['id']);
		$page_obj->sortPages($_REQUEST['new_order']);
        _redirect("index.php?section=pages&subsection=list");
	break;
	
	case "delete":
		$page_obj = new Page($_REQUEST['page_id']);
		$page_obj->delete();
		_redirect("index.php?section=pages&subsection=list");
	break;
	
	
	case "list":
    default:
	$page_obj = new Page();
	$page_obj->root_page_title = $labels['root_page_title'];
	$data = &$_REQUEST['data'];
	$filter = &$_REQUEST['filter'];
	$submit = &$_REQUEST['submit'];
	@$parent = ($_REQUEST['parent'] == '') ? '0' : (int)$_REQUEST['parent'];
    $_REQUEST['parent'] = $parent;
	//dumper($_REQUEST);
	#Save ordering
	#--------------------------------------------------------------------	
	//dumper($submit);
	/*if(@$submit['save_ordering']){
		$page_obj = new Page();
		$page_obj->root_page_title = $labels['root_page_title'];
		
		foreach ($data['page_id'] as $page_id =>  $v){
			if(isset($page_id) && $page_id > 0){
				$page_obj->id = $page_id;
				$page_obj->get();	
				$page_obj -> ordering = $v;
				$page_obj -> update();
			}
			
		}
	}*/
	#searching conditions
	#--------------------------------------------------------------------	

    $filter['show_place'] = (isset($filter['show_place']) && $filter['show_place'] != '') ? $filter['show_place'] : 'first';
    $filter['caption'] = (isset($filter['caption']) && $filter['caption'] != '') ? $filter['caption'] : '';
    
	$smarty->assign(array(
        "SHOW_PLACE" => "$filter[show_place]",
        "CAPTION" => "$filter[caption]"
  			));

	$where = array();
	$where[] = "p.parent = ". $parent;
	if (isset($filter['show_place']) && $filter['show_place'] != '') {
        $where[] = "p.show_place = '".addslashes($filter['show_place'])."'";
    }
    if (isset($filter['caption']) && $filter['caption'] != '') {
        $where[] = "pt.caption like '%".addslashes($filter['caption'])."%'";
    }
		
	if(count($where)){
		$where ="where ".join(" and \n",$where);
	} else {
	  $where = "";
	}
	#dumper($where);	
	#------------------------------------------------------------------------------

 //order by generation
 
	
	  
	if (@$data['order'] == ''){
		$data['order'] = "p.ordering";
	}
	$smarty->assign("ORDER", $data['order']);
	if (@$data['page'] == ''){
		$data['page'] = 0;
	}
	$order_by = "ORDER BY ".$data['order'].", parent";
    
  	//paging
  	$sql_count = "
  		SELECT count(*) 
  		FROM page AS p 
		LEFT JOIN page_trans AS pt ON pt.fk_page_id = p.id 
		$where AND pt.lang = '".$_SESSION['admin_lang']."' 
	" ;
    
	$result=mysql_query($sql_count);
	//	echo "<p> count error = ".mysql_error();
 
	
	if ($result && mysql_num_rows($result)) { 
	    $total = mysql_result($result,0,0);	
	    $per_page = 200;
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
		
		
		$all_pages = $page_obj->get_all_pages($where, $limit_sql, $order_by);
		$for_output = array();
		if($all_pages){
			$num = 0;
			foreach ($all_pages as $page){
				$page['parent_name'] = $page_obj->get_parent_name($page['parent']);
				$for_output[] = $page;
			}
		}else{
			$smarty->assign("no_result",$labels['no_results']);
		}
		#Generate page path.
		$page_path = array();
		$smarty->assign('PARENT', $parent);
		while ($parent) {
			$sql = "
				SELECT p.id, p.parent, pt.caption
				FROM page p 
				INNER JOIN page_trans pt
				ON p.id = pt.fk_page_id
				WHERE p.id = ". $parent ." AND pt.lang = '".$_SESSION['admin_lang']."'  
			";
			$result = mysql_query($sql); echo mysql_error();
			if ($result && mysql_num_rows($result)) {
				$l = mysql_fetch_array($result, MYSQL_ASSOC);
				
				array_unshift($page_path, array(
					"page_id" => $l['id'],
					"page_name" => $l['caption'],
					)
				);						
			}
			$parent = $l['parent'];
		}
		#Add Root path
		array_unshift($page_path, array(
					"page_id" => 0,
					"page_name" => "Start",
					)
		);
		saveReturnPoint();
		$smarty->assign('page_path', $page_path);
		$smarty->assign('pages', $for_output);
        $template = "admin/pages/list.tpl";
        break;
        
        
}
?>