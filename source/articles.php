<?php
$meta = array(
		'title'=>'',
		'keywords'=>'fff',
		'description'=>'',
		);
$right = '';
$left = '';
$dinamicInclude = '';
$real_page_title = $labels['events'];
switch ($subsection){

	case "view":
		$articles_obj = new Articles($_REQUEST['articles_id']);
		$articles_obj->get_public_articles();
		$articles_obj->image_thumbnail = make_thumbnail_url($articles_obj->image, $config['articles_thumbnails'][1]);
		       
        $meta['title'] = $articles_obj->caption;
		
        $real_page_title = $articles_obj->caption;
        $smarty->assign("single_articles", $articles_obj);
        $template = "articles/view.tpl";
		break;

	default:
            
		$articles_obj = new Articles();
		$data = &$_REQUEST['data'];
		$type = &$_REQUEST['articles_type'];
		$filter = &$_REQUEST['filter'];

		#searching conditions
		#--------------------------------------------------------------------

		$where = array();
		if(isset($type) && $type != ''){
		$where[] = " articles_type='".$type."' ";
		}
		$where[] = " is_active='yes' ";
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
		
		#------------------------------------------------------------------------------
		//order by generation
		 
		if (@$data['order'] == ''){
			$data['order'] = "a.publish_date desc";
		}
		$smarty->assign("ORDER", $data['order']);
		if (@$data['page'] == ''){
			$data['page'] = 0;
		}
		$order_by = "ORDER BY ".$data['order']."";

		//paging
		$result=mysql_query("SELECT count(*) FROM articles AS a $where");
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
		

		$all_articles = $articles_obj->get_all_articles($where, $limit_sql, $order_by); 
		$for_output = array();

		if($all_articles){
			foreach ($all_articles as $new){	
				$new['image'] = make_thumbnail_url($new['image'], $config['articles_thumbnails'][0]);
				$for_output[] = $new;
			}
		}else{
			$smarty->assign("no_result", $labels['no_results']);
		}
		
		$smarty->assign("type", $type);
        
        $real_page_title = $type;
        
        
		isset($_REQUEST['page_id'])? $smarty->assign("page_id", $_REQUEST['page_id']):$smarty->assign("page_id", '');
                if ( !empty($_REQUEST['page_id']) ) {
                    $page = new Page($_REQUEST['page_id']);
                    
                    $page->get('sr');
                    $meta = array(
                        'title'         => $page->meta_title,
                        'keywords'      => $page->meta_keywords,
                        'description'   => $page->meta_description,
                    );
                    $smarty->assign('articles_title', $page->caption);
                    $smarty->assign('articles_content', $page->content);
                }
                
				
		$smarty->assign('articles_list', $for_output);
		$template = "articles/list.tpl";
		break;
}

?>