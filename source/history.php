<?php
$meta = array(
		'title'=>'',
		'keywords'=>'',
		'description'=>'',
		);
$right = '';
$left = '';
$dinamicInclude = '';
$real_page_title = $labels['history'];
switch ($subsection){

	case "view":
		$history_obj = new History($_REQUEST['history_id']);
		$history_obj->get_public_history();
		$history_obj->image_thumbnail = make_thumbnail_url($history_obj->image, $config['history_thumbnails'][0]);
		       
        $meta['title'] = $history_obj->caption;
		
        $real_page_title = $history_obj->caption;
        $smarty->assign("single_history", $history_obj);
        $template = "history/view.tpl";
		break;

	default:
		$history_obj = new History();
		$data = &$_REQUEST['data'];
		$type = &$_REQUEST['type'];
		$filter = &$_REQUEST['filter'];

		#searching conditions
		#--------------------------------------------------------------------

		$where = array();
//		if(isset($type) && $type != ''){
//		$where[] = " articles_type='".$type."' ";
//		}
//		$where[] = " is_articles='yes' ";
		/*
        if(isset($type) && $type == 'articles'){
           $where[] = " CURDATE() >= a.publish_date "; 
        }
         */
        
		
		if(count($where)){
			$where =" WHERE ".join(" AND \n",$where);
		} else {
	  		$where = "";
		}
		//dumper($data); exit;
		#------------------------------------------------------------------------------
		//order by generation
		 
//		if (@$data['order'] == ''){
//			$data['order'] = "a.publish_date desc";
//		}
		$smarty->assign("ORDER", $data['order']);
		if (@$data['page'] == ''){
			$data['page'] = 0;
		}
                
                if(isset($data['order'])){
		$order_by = "ORDER BY ".$data['order']."";
                }else{
                    $order_by = "";
                }
                
		//paging
		$result=mysql_query("SELECT count(*) FROM history AS a $where");
		//	echo "<p> count error = ".mysql_error();
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
		

		$all_history = $history_obj->get_all_history($where, $limit_sql, $order_by); 
		$for_output = array();

		if($all_history){
			foreach ($all_history as $new){				
				$for_output[] = $new;
			}
		}else{
			$smarty->assign("no_result", $labels['no_results']);
		}
		//dumper($for_output); exit;
		$smarty->assign("type", $type);
        
        $real_page_title = $type;
        
		isset($_REQUEST['page_id'])? $smarty->assign("page_id", $_REQUEST['page_id']):$smarty->assign("page_id", '');
				
		$smarty->assign('history_list', $for_output);
		$template = "history/list.tpl";
		break;
}

?>