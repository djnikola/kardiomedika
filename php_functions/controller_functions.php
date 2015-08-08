<?php

/**
 * delivering page structure 
 * and call smarty display function
 *
 * @param template $includeFile
 * @param string $side
 * @param string $right_column
 * @param array $meta
 */
function generatePage($includeFile, $right_column = '', $left_column = '', $dinamicInclude = '', $meta = array(), $page_id = "") {
    global $smarty, $config;
    
    $isXmlHttpRequest = array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    #controller template
    $smarty->assign("template", $includeFile);

    if ($isXmlHttpRequest) {
        if(json_decode(ob_get_contents()) == null){
            $smarty->display("ajax.tpl");
        }
    }else {
        # META START ------------------------------------
        if(!count($meta)){
            $meta = $config['meta'];
        }
        $smarty->assign('meta_title',  $meta['title']);
        $smarty->assign('meta_keywords',  $meta['keywords']);
        $smarty->assign('meta_description',  $meta['description']);
        # META END   ------------------------------------


        # RIGHT COLUMN START ------------------------------------
        $includeFileRight = '';
        if($right_column){
                $columns = explode('|',$right_column);
                foreach ($columns as $column_param){
                        $includeFileRight .= $smarty->fetch("_right_column/".$column_param.".tpl");
                }
        }
        $smarty->assign("includeFileRight", $includeFileRight);
        # RIGHT COLUMN END   ------------------------------------

        # LEFT COLUMN START ------------------------------------
        $includeFileLeft = '';
        if($left_column){
                $columns = explode('|',$left_column);
                foreach ($columns as $column_param){
                        $includeFileLeft .= $smarty->fetch("_left_column/".$column_param.".tpl");
                }
        }
        $smarty->assign("includeFileLeft", $includeFileLeft);
        # LEFT COLUMN END   ------------------------------------

        # DINAMIC HEADER START ------------------------------------
        if($dinamicInclude != ''){
        $dinamicInclude = $smarty->fetch("".$dinamicInclude.".tpl");
        $smarty->assign("dinamicInclude", $dinamicInclude);
        }else{
                $smarty->assign("dinamicInclude", '');
        }
        # DINAMIC HEADER END   ------------------------------------

        # MENU START   ------------------------------------
        $smarty->assign("menu", create_menu(0, ''));
        $smarty->assign("side_menu_internal_medicine", create_side_menu(0, '', 'second'));
        $smarty->assign("side_menu_pediatrics", create_side_menu(0, '', 'forth'));
        $smarty->assign("side_menu_neurology", create_side_menu(0, '', 'third'));
        $smarty->assign("side_menu_psychiatry", create_side_menu(0, '', 'fifth'));
        # MENU END   --------------------------------------


        #BODY CLASS START -------------------------------------

        #this is temprarly logic right now
        $sql_class = "SELECT class FROM page WHERE id= $page_id";
            $results_c = mysql_query($sql_class);
        $body_class = array();
        $body_class['class'] = '';
        if($results_c && mysql_num_rows($results_c) > 0)  {
            $body_class = mysql_fetch_array($results_c, MYSQLI_ASSOC);
        }
        $body_class['class'] != '' ? $smarty->assign("body_class", $body_class['class']) : $smarty->assign("body_class", "home");

        #BODY CLASS END -------------------------------------  

        # FOOTER LINKS START   ------------------------------------
        $sql_footer = "SELECT p.*, pt.* FROM page AS p
        LEFT JOIN page_trans AS pt ON pt.fk_page_id = p.id
        WHERE pt.lang='en' ORDER BY p.ordering";

        $results_f = mysql_query($sql_footer);
        $footer_links = array();
        while($p = mysql_fetch_array($results_f, MYSQL_ASSOC)){
                $footer_links[] = $p;
        }
        $smarty->assign('footer_links', $footer_links);	
        # FOOTER LINKS END   ------------------------------------

        $smarty->display("static_content/" . $_SESSION['lang'] . "/main.tpl");
    }
	
}

    function create_menu($id, $menu){
        global $db, $admin_menu_links;
        $tree = Route::getInstance($db)->getPagesTree($_SESSION['lang']);
        //dumper($tree);
        if(isset($tree[$id]['child_nodes']) && count($tree[$id]['child_nodes'])){
            $menu .= '<ul>';
            foreach ($tree[$id]['child_nodes'] as $permalink => $page_id){	
                $selected = '';
                if(isset($_REQUEST['page_id'])){
                    $top_parent = getTopParentId($_REQUEST['page_id']); 
                    if($top_parent != 0 && $top_parent == $page_id){
                       $selected = 'class="current"'; 
                    }
                }
                if($tree[$page_id]['navigation'] == 'yes' && $tree[$page_id]['show_place'] == 'first'){
                    $tree[$page_id]['parent'] != 0 ? $permalinksTrail = getParentTrail($tree[$page_id]['parent'])."/" : $permalinksTrail = '';
                    $menu .= '<li '. $selected .'><a href="'._page_seo_url($permalinksTrail.$tree[$page_id]['permalink'], $tree[$page_id]['id']).'"> '.$tree[$page_id]['caption'].'</a>';
                    $menu .= create_menu($tree[$page_id]['id'],'');
                    $menu .= '</li>';
                }
            }
            $menu .= '</ul>';
        }
    return $menu;
}

function create_side_menu($id, $menu, $show_places){
        global $db, $admin_menu_links;
        $tree = Route::getInstance($db)->getPagesTree($_SESSION['lang'],true);
		//dumper($tree);
        if(isset($tree[$id]['child_nodes']) && count($tree[$id]['child_nodes'])){
            $menu .= '<ul>';
            foreach ($tree[$id]['child_nodes'] as $permalink => $page_id){	
                $selected = '';
                if(isset($_REQUEST['page_id'])){
                    $top_parent = getTopParentId($_REQUEST['page_id'], $show_places); 
                    if($top_parent != 0 && $top_parent == $page_id){
                       $selected = 'class="current"'; 
                    }
                }
                if($tree[$page_id]['navigation'] == 'yes' && $tree[$page_id]['show_place'] == $show_places){
                    $tree[$page_id]['parent'] != 0 ? $permalinksTrail = getParentTrail($tree[$page_id]['parent'], $show_places)."/" : $permalinksTrail = '';
                    $menu .= '<li '. $selected .'><a href="'._page_seo_url($permalinksTrail.$tree[$page_id]['permalink'], $tree[$page_id]['id']).'"> <p>'.$tree[$page_id]['caption'].'</p></a>';
                    $menu .= create_side_menu($tree[$page_id]['id'],'', $show_places);
                    $menu .= '</li>';
                }
            }
            $menu .= '</ul>';
        }
		
    return $menu;
}

    function getParentTrail($parent, $show_place = 'first'){
        global $db;
        $permalinks_route = '';
        $tree = Route::getInstance($db)->getPagesTree($_SESSION['lang'], true, $show_place);
        $permalinks_route .= $tree[$parent]['permalink'];
        if($tree[$parent]['parent'] != 0){
            $permalinks_route .= getParentTrail($tree[$parent]['parent'], $show_place);
        }
        return $permalinks_route;
    }
    
    function getTopParentId($page_id, $show_place = 'first'){
        global $db;
        
        $tree = Route::getInstance($db)->getPagesTree($_SESSION['lang'], true, $show_place);
        if(isset($tree[$page_id]['parent']) && $tree[$page_id]['parent'] != 0){
            return getTopParentId($tree[$page_id]['parent'], $show_place);
        }
        return $tree[$page_id]['id'];
    }

/**
 *
 * @param  $params
 * @param  $smarty
 */
function create_page($page_id,$default_page, &$meta){
	global  $config, $smarty ;
	$default_page == 1 ? $dp = 1: $dp = 0;

	if($dp == 1){
		$sql = "SELECT p.*, pt.* FROM page as p
		LEFT JOIN page_trans as pt ON pt.fk_page_id = p.id
		WHERE p.default_page=".$dp." AND pt.lang='".$_SESSION['lang']."'";
	}else{
		$sql = "SELECT p.*, pt.* FROM page as p 
		LEFT JOIN page_trans as pt ON pt.fk_page_id = p.id
		WHERE p.id=".$page_id." AND pt.lang='".$_SESSION['lang']."'";
	}
	
	$result = mysql_query($sql);
	$page = mysql_fetch_array($result, MYSQL_ASSOC);

	if(!empty($page['meta_title'])){
		$meta['title'] = $page['meta_title'];
	}else{ 
		$meta['title'] = $page['caption'];
	}
	
        
	$meta['keywords'] = $page['meta_keywords'];
	$meta['description'] = $page['meta_description'];
    if($page['type'] == 'static'){
        $page['content'] = $smarty->fetch("../templates/static_content/" . $_SESSION['lang'] . "/" . $page['link']);
    }
	$smarty->assign("default_page", $default_page);
	$smarty->assign("result", $page);
    return $page;
}
/**
 * smarty function
 *
 * @param  $params
 * @param  $smarty
 */
function special_articles($params="", &$smarty){
	global  $config, $smarty ;
    $where = '';
    if(isset($params['type']) && $params['type'] == 'news'){
       $where = " AND CURDATE() >= publish_date "; 
    }
	$sql_n = "  SELECT * FROM articles as a
                LEFT JOIN articles_trans as at ON at.fk_articles_id = a.articles_id        
                WHERE is_active=1 AND articles_type = '".$params['type']."' AND at.lang='".$_SESSION['lang']."' " . $where . " ORDER BY  a.publish_date DESC LIMIT 0,".$params['count']."";  

    $results_n = mysql_query($sql_n);
	$spec_articles = array();
	if(mysql_num_rows($results_n)){
		while($articles = mysql_fetch_array($results_n, MYSQL_ASSOC)){
			//$articles['publish_date'] = fromsqldate($articles['publish_date'], "d. m. Y.");
			$spec_articles[] = $articles;
		}
	}
	$smarty->assign("costum_articles_list", $spec_articles);
}

/**
 * smarty function
 *
 * @param  $params
 * @param  $smarty
 */
function special_lists($params="", &$smarty){
	/*heandling files*/	
    $files = array();
    if ($handle = opendir('media_content/' . $params['folder'] . '/' . $params['type'] . '/')) {
        $c = 0;
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && !is_dir($file)) {
                $files[$file]['counter'] = $c++;
                $files[$file]['file_name'] = $file;
                $files[$file]['file_link'] = 'media_content/about/' . $params['type'] . '/'.$file;
            }
        }
    closedir($handle);
    }
   
    ksort($files);
    
	$smarty->assign("costum_articles_list", $files);
}

/**
 * smarty function
 *
 * @param  $params
 * @param  $smarty
 */
function special_gallery_pictures($params="", &$smarty){
	global  $config, $smarty ;
    $where = '';

	$sql_n = "  SELECT * FROM gallery_pictures as gp
                LEFT JOIN gallery_pictures_trans as gpt ON gpt.fk_picture_id = gp.picture_id        
                WHERE gpt.lang='".$_SESSION['lang']."' " . $where . " LIMIT 0,".$params['count']."";  
    
    $results_n = mysql_query($sql_n);
	$spec_gallery_pictures = array();
	if(mysql_num_rows($results_n)){
		while($pictures = mysql_fetch_array($results_n, MYSQL_ASSOC)){
			$pictures['thumbnail'] = make_thumbnail_url($pictures['path'], $config['gallery_pictures_thumbnails'][0]);
			$spec_gallery_pictures[] = $pictures;
		}
	}
	$smarty->assign("costum_picture_list", $spec_gallery_pictures);
}


function is_default_page($page_id){
	$sql = "SELECT p.* FROM page as p WHERE p.id=".$page_id."";
	$result = mysql_query($sql);
    $page = mysql_fetch_array($result, MYSQL_ASSOC);
	if($page['default_page'] == 1){
		return $page['default_page'];
	}
	return 0;
}

function common_conf_set($config){
	global $config;
	$sql_cc = "SELECT cct.cc_value, cc.cc_label FROM common_conf as cc
	LEFT JOIN common_conf_trans as cct ON cct.fk_cc_id = cc.cc_id
	WHERE cct.lang='".$_SESSION['lang']."'
	";
	$result = mysql_query($sql_cc);
	while($l = mysql_fetch_array($result, MYSQL_ASSOC)){
		$config[$l['cc_label']]= $l['cc_value']; 
	}
}


/**
 * This function returns value of "param_value" (for input "section", "sub_section" and "param_title")
 * in "privilegies"
 * this function called:
 * {getPrivilege result=value section=portal subsection=home parametar=has_scheduled_events}
 * {$value} is returned value of this function
 *
 * @param unknown_type $params
 * @param unknown_type $smarty
 */
function getPrivilegeSmarty($params="", &$smarty){
	global $db;
	if(empty($params["subsection"])){
		$params["subsection"] = "";
	}
	$result = 0;
	
	if($_SESSION['loged_in']){
		
	//////////////////
	$privilegies = $_SESSION["privilegies"];
	foreach ($privilegies as $values){
		if($values["section"] == $params["section"]){
			if($params["subsection"] == "" || $params["subsection"] == $values["sub_section"]){
				$parametars = $values["parametars"];
				foreach ($parametars as $parametar) {
					if($parametar['param_title'] == $params["parametar"]){
						$result = $parametar["param_value"];
					}
				}
			}

		}
	}
	/////////////
		}
	$smarty->assign($params["result"], $result);
}


?>
