<?php
class Articles {
	var $articles_id;
	var $content;
	var $caption;
	var $image;
    var $location;
	var $highlights;
	var $publish_date;
	var $articles_type;
	var $is_active;

	function Articles(
	$articles_id = '', 
    $content = '', 
    $caption = '',  
    $image = '',
    $location = '', 
    $highlights = '',
    $publish_date = '',
    $articles_type = '', 
    $is_active = 'yes'
	){	
    $this->articles_id = $articles_id;
    $this->content = $content;
    $this->caption = $caption;
    $this->image = $image;
    $this->location = $location;
    $this->highlights = $highlights;
    $this->publish_date = $publish_date;
    $this->articles_type  = $articles_type;
    $this->is_active  = $is_active;
	}

	function add(){
		global $config;

		$sql = "INSERT INTO articles (
		image,
		publish_date,
		articles_type,
		is_active
		)
		VALUES (
		'".addslashes($this->image)."',
		'".addslashes($this->publish_date)."',
		'$this->articles_type',
		'$this->is_active'
		)";
        
		if (mysql_query($sql) === false) { 
			return false;
		}else{ 
			$articles_id = mysql_insert_id();

			foreach($config['languages'] as $lng){
				$sql_check = "SELECT * FROM articles_trans WHERE lang='$lng' AND fk_articles_id='$articles_id'";
				$r = mysql_query($sql_check);
				
				if(mysql_fetch_array($r, MYSQL_ASSOC) == ''){
					$sql_insert_lng="INSERT INTO articles_trans SET 
					content='".addslashes($this->content)."',
					caption='".addslashes($this->caption)."',
                    location='".addslashes($this->location)."',
                    highlights='".addslashes($this->highlights)."',
					lang='$lng', 
					fk_articles_id = $articles_id";
					mysql_query($sql_insert_lng);
				}
				
			}
			return $articles_id;
			
		}
			
	}

	function get() {
		$sql = "SELECT * FROM articles AS a
		LEFT JOIN articles_trans as at ON at.fk_articles_id = a.articles_id
		WHERE a.articles_id = '$this->articles_id' AND at.lang='".$_SESSION['admin_lang']."'";
		
		$result = mysql_query($sql);
        $articles = mysql_fetch_array( $result, MYSQL_ASSOC);
		$this->image = $articles['image'];
        $this->location = $articles['location'];
		$this->highlights = $articles['highlights'];
		$this->caption = $articles['caption'];
		$this->content = $articles['content'];
		$this->publish_date = $articles['publish_date'];
		$this->articles_type = $articles['articles_type'];
		$this->is_active = $articles['is_active'];
		
	}

	function update(){
		$sql = "UPDATE articles SET
		image = '".addslashes($this->image)."',
		publish_date = '".addslashes($this->publish_date)."',
		is_active = '$this->is_active',
		articles_type = '$this->articles_type'
		WHERE articles_id = ".$this->articles_id."
		";
                
		mysql_query($sql);
        
		
		$sql = "UPDATE articles_trans SET  
		caption = '".addslashes($this->caption)."', 
		content = '".addslashes($this->content)."',
		highlights = '".addslashes($this->highlights)."',
        location = '".addslashes($this->location)."'
		WHERE fk_articles_id=".$this->articles_id." AND lang='".$_SESSION['admin_lang']."'";
		
		mysql_query($sql);
	}

	function delete(){
		global $db;
		$sql = "DELETE FROM articles WHERE articles_id = '$this->articles_id'";
		$sqlt = "DELETE FROM articles_trans WHERE fk_articles_id = '$this->articles_id'";
		mysql_query($sql);
		mysql_query($sqlt);
	}
    
    function get_public_articles() {
		$sql = "SELECT * FROM articles AS a
		LEFT JOIN articles_trans as at ON at.fk_articles_id = a.articles_id
		WHERE a.articles_id = '$this->articles_id' AND at.lang='".$_SESSION['lang']."'";
		$result = mysql_query($sql);
        $articles = mysql_fetch_array( $result, MYSQL_ASSOC);
		$this->image = $articles['image'];
		$this->highlights = $articles['highlights'];
        $this->location = $articles['location'];
		$this->caption = $articles['caption'];
		$this->content = $articles['content'];
		$this->publish_date = $articles['publish_date'];
		$this->articles_type = $articles['articles_type'];
		$this->is_active = $articles['is_active'];
	}


	function create_public_articles_list(){
	global $db;
	
	$sql = "SELECT * FROM articles AS n
	LEFT JOIN articles_trans as nt ON nt.fk_articles_id = n.articles_id
	WHERE n.publish_date <= now() AND n.is_active = 'yes' ORDER BY n.articles_id LIMIT 0,5";
	$result = mysql_query($sql);
	return mysql_fetch_array( $result, MYSQL_ASSOC);
	}

	
	function get_all_articles($where='', $limit_sql='', $order_by=''){
		global $db;
		
		$sql = "SELECT * FROM articles AS a 
		LEFT JOIN articles_trans as at ON at.fk_articles_id = a.articles_id
		$where AND at.lang='".$_SESSION['lang']."'  $order_by $limit_sql"; 

		$result = mysql_query($sql);
		$articles = array();
		if($result && mysql_num_rows($result)){
			while ($n = mysql_fetch_array($result, MYSQL_ASSOC)){
				
					$n['publish_date'] = fromsqldate($n['publish_date'],"d.m.Y");
				
				$articles[] = $n;
			}
			return $articles;
		}else{
			return false;
		}
		
	}
    
    function get_all_articles_admin($where='', $limit_sql='', $order_by=''){
		$sql = "SELECT * FROM articles AS a 
		LEFT JOIN articles_trans as at ON at.fk_articles_id = a.articles_id
		$where AND at.lang='".$_SESSION['admin_lang']."'  $order_by $limit_sql"; 
		$result = mysql_query($sql);
		$articles = array();
		if($result && mysql_num_rows($result)){
			while ($a = mysql_fetch_array($result, MYSQL_ASSOC)){
				$a['publish_date'] = fromsqldate($a['publish_date'],"d.m.Y");
				$articles[] = $a;
			}
			return $articles;
		}else{
			return false;
		}
		
	}
}






?>