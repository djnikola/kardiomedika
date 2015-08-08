<?php

class Page {
	 var $id;   	  
	 var $parent;   	  
	 var $level;   	  	  
	 var $caption;   	  
	 var $content;   	  
	 var $class;   	  
	 var $link;  
     var $permalink;
	 var $request_params;
     var $navigation; 
	 var $default_page;   	  
	 var $ordering;   	  
	 var $show_place;
	 var $root_page_title;
	 
	 var $meta_title;
	 var $meta_description;
	 var $meta_keywords;


	function Page(
		$id = 0, 
		$parent = '', 
		$level = '',  
		$caption = '', 
		$content = '',
		$class = '', 
		$link = '',
        $permalink = '',
		$request_params = '',
        $navigation = '',
		$default_page = '',
		$ordering = '',
		$show_place = '',
		
		$meta_title = '',
		$meta_description = '',
		$meta_keywords = ''
	){
			
		$this->id = $id;
		$this->parent = $parent;
		$this->level = $level;
		$this->caption = $caption;
		$this->content = $content;
		$this->class = $class;
		$this->link = $link;
        $this->permalink = $permalink;
		$this->request_params = $request_params;
        $this->navigation = $navigation;
		$this->default_page  = $default_page;
		$this->ordering  = $ordering;
		$this->show_place  = $show_place;
		$this->root_page_title = '';
		
		$this->meta_title  = $meta_title;
		$this->meta_description  = $meta_description;
		$this->meta_keywords  = $meta_keywords;
	}

	function add(){
	
		global $config;
		global $db;
		
		$sql = "INSERT INTO page (
		parent,
		level,
		class,
        navigation,
		request_params,
		default_page,
		ordering,
		show_place
		)
		VALUES (
		'".addslashes($this->parent)."',
		'".addslashes($this->level)."',
		'".addslashes($this->class)."',
        '".addslashes($this->navigation)."',
		'".addslashes($this->request_params)."',
		'".addslashes($this->default_page)."',
		'".addslashes($this->ordering)."',
		'".addslashes($this->show_place)."')";
		
        
			if (mysql_query($sql) === false) {
				return false;
			}else{
				$page_id = mysql_insert_id();
			
				foreach($config['languages'] as $lng){
				$sql_check = "SELECT * FROM page_trans WHERE lang='$lng' AND fk_page_id=$page_id";
				$r = mysql_query($sql_check);
				
				if(mysql_fetch_array($r, MYSQL_ASSOC) == ''){
					$sql_insert_lng="INSERT INTO page_trans SET 
					content='".addslashes($this->content)."',
					caption='".addslashes($this->caption)."',
                    permalink='".addslashes($this->permalink)."',
					
					meta_title='".addslashes($this->meta_title)."', 
					meta_keywords='".addslashes($this->meta_keywords)."',
					meta_description='".addslashes($this->meta_description)."',
					
					lang='".addslashes($lng)."', 
					fk_page_id = $page_id";
					mysql_query($sql_insert_lng);
				}
			}
			return $page_id;
		}
	}

	function get($lng = ''){
		global $db;
                $lang = empty($_SESSION['admin_lang']) ? $lng : $_SESSION['admin_lang'];
		$sql = "SELECT p.*, pt.* FROM page as p 
		LEFT JOIN page_trans as pt ON pt.fk_page_id = p.id
		WHERE p.id = '$this->id' AND pt.lang='". $lang ."'";
		$result = mysql_query($sql);
                
		while($q = mysql_fetch_array($result, MYSQL_ASSOC)){
			$this->parent = $q['parent'];
			$this->level = $q['level'];
			$this->caption = $q['caption'];
			$this->content = $q['content'];
			$this->class = $q['class'];
            $this->permalink = $q['permalink'];
			$this->request_params = $q['request_params'];
            $this->navigation = $q['navigation'];
			$this->default_page = $q['default_page'];
			$this->ordering = $q['ordering'];
			$this->show_place = $q['show_place'];
			
			$this->meta_title = $q['meta_title'];
			$this->meta_keywords = $q['meta_keywords'];
			$this->meta_description = $q['meta_description'];
		}	
	}

	function update(){
		global $db;
		$sql = "UPDATE page SET
			
		parent = '".addslashes($this->parent)."',
		level = '".addslashes($this->level)."',
		class = '".addslashes($this->class)."',
        navigation = '".addslashes($this->navigation)."',
		request_params = '".addslashes($this->request_params)."',
		default_page = '".addslashes($this->default_page)."',
		ordering = '".addslashes($this->ordering)."',
		show_place = '".addslashes($this->show_place)."' 
		
		WHERE id=".$this->id."";
		mysql_query($sql);
		
		$sql = "UPDATE page_trans SET  
		caption = '".addslashes($this->caption)."', 
		content = '".addslashes($this->content)."',
        permalink = '".addslashes($this->permalink)."',
		meta_title = '".addslashes($this->meta_title)."',
		meta_keywords = '".addslashes($this->meta_keywords)."',
		meta_description = '".addslashes($this->meta_description)."' 
		WHERE fk_page_id=".$this->id." AND lang='".$_SESSION['admin_lang']."'";

		mysql_query($sql);
	}

	function delete(){
		global $db, $ERRORS, $labels;
		
		$sql_check = "SELECT parent FROM page WHERE id='".$this->id."'";
		$res_check = mysql_query($sql_check);
		$p = mysql_fetch_array($res_check,MYSQL_ASSOC);

		//if($p['parent'] != 0){
		$sql = "DELETE FROM page WHERE id = '$this->id'";
		$sqlt = "DELETE FROM page_trans WHERE fk_page_id = '$this->id'";
		mysql_query($sql);
		mysql_query($sqlt);
		//}else{
		//	$ERRORS[] = $labels['error_basic_page'];
		//}
	}

	function get_all_pages($where='', $limit_sql='', $order_by=''){
		global $db;
		
		$sql = "SELECT p.*, pt.*, (SELECT COUNT(*) FROM page WHERE page.parent = p.id) AS subpage_num 
		FROM page AS p 
		LEFT JOIN page_trans as pt ON pt.fk_page_id = p.id
		$where AND pt.lang='".$_SESSION['admin_lang']."'
		$order_by $limit_sql";
		//dumper($sql);
		$result = mysql_query($sql);
		$pages = array();
		if($result && mysql_num_rows($result)){
			while ($p = mysql_fetch_array($result, MYSQL_ASSOC)){
				$pages[] = $p;
			}
			return $pages;
		}else{
			return false;
		}
	}
	
	function get_parent_name($parent_id){
		
		$sql = "SELECT caption FROM page_trans WHERE fk_page_id = '$parent_id' AND lang='".$_SESSION['admin_lang']."'";
		
		$parent_name = array();
		
        if($result = mysql_query($sql)){
            $parent_name = mysql_fetch_row($result);
        }
        
        if(count($parent_name)){
			return $parent_name['caption'];
		}else{
			return $this->root_page_title;		
		}
	}
    
    static function get_parent_place($parent_id){
		$sql = "SELECT show_place FROM page WHERE id = '$parent_id'";

        $show_place = array();
		$result = mysql_query($sql);
		if($result){
            $show_place = mysql_fetch_row($result); 
        }
        
        if(count($show_place)){
			return $show_place[0];
		}
	}
	
	function sortPages($new_order){
		$sql_current = "SELECT ordering FROM page WHERE id=". $this->id ."";
		//dumper($sql_current);
		$result = mysql_query($sql_current);
		$current_sort = mysql_fetch_array($result, MYSQL_ASSOC);

		if($new_order == 'up' && $current_sort['ordering'] > 1){
			$sql_prev = "SELECT id, ordering FROM page WHERE ordering < '". $current_sort['ordering'] ."' ORDER BY ordering desc LIMIT 0,1";
			$result = mysql_query($sql_prev);
			$prev = mysql_fetch_array($result, MYSQL_ASSOC);
			
			$sql_update_prev = "UPDATE page SET ordering='". $current_sort['ordering'] ."' WHERE id = '". $prev['id'] ."'";
			mysql_query($sql_update_prev);
			$new_sort = $current_sort['ordering'] -1;
			$sql_update_current = "UPDATE page SET ordering= '".$new_sort."' WHERE id = '". $this->id ."'";
			mysql_query($sql_update_current);
		}
		
		if($new_order == 'down'){
			$sql_next = "SELECT id, ordering FROM page WHERE ordering > '". $current_sort['ordering'] ."' ORDER BY ordering asc LIMIT 0,1";
			$result = mysql_query($sql_next);
			$next = mysql_fetch_array($result, MYSQL_ASSOC);
			
			$sql_update_next = "UPDATE page SET ordering='". $current_sort['ordering'] ."' WHERE id = '". $next['id'] ."'";
			//dumper($sql_update_next);
			mysql_query($sql_update_next);
			$new_sort = $current_sort['ordering'] +1;
			$sql_update_current = "UPDATE page SET ordering=$new_sort WHERE id = '". $this->id ."'";
			//dumper("Kliknut: ".$sql_update_current);
			mysql_query($sql_update_current);
		}
	}
	
	function generatePageTree() {
		$result = array();
		$this->_generatePageTree(0, $result, $level = 0);
		return $result;
	}
	
	function _generatePageTree($parent, &$r, &$level) {		
		$sql = "
			SELECT p.id, p.parent, pt.caption
			FROM page AS p
			INNER JOIN page_trans pt
			ON p.id = pt.fk_page_id
			WHERE p.parent = ".(int)$parent."
			AND pt.lang = '". $_SESSION['admin_lang'] ."'
			ORDER BY ordering
		";
		$result = mysql_query($sql); echo mysql_error();
		if ($result && mysql_num_rows($result)) {
			while($l = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$r[$l['id']] = array(
					"title" => $l['caption'],
					"level" => $level,
				);
				$parent = $l['id'];
				$level++;
				$this->_generatePageTree($parent, $r, $level);
			}
		}
		$level--;
	}

}



?>
