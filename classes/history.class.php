<?php

class History {
	var $history_id;
	var $content;
	var $caption;
	var $image;
	var $short_content;
	var $create_date;
	

	function History(
	$history_id = '', $content = '', $caption = '',  $image = '',
	$create_date = '', $deleted = ''
	){
			
		$this->history_id = $history_id;
		$this->content = $content;
		$this->caption = $caption;
		$this->image = $image;
		$this->create_date = $create_date;

	}

	function add(){
		global $config;

		$sql = "INSERT INTO history (
		image,
		create_date
		)
		VALUES (
		'".addslashes($this->image)."',
                NOW()
		)";
		
		if (mysql_query($sql) === false) { 
			return false;
		}else{ 
			$history_id = mysql_insert_id();

			foreach($config['languages'] as $lng){
				$sql_check = "SELECT * FROM history_trans WHERE lang='$lng' AND fk_history_id='$history_id'";
				$r = mysql_query($sql_check);
				
				if(mysql_fetch_array($r, MYSQL_ASSOC) == ''){
					$sql_insert_lng="INSERT INTO history_trans SET 
					content='".addslashes($this->content)."',
					caption='".addslashes($this->caption)."',
					
					lang='$lng', 
					fk_history_id = $history_id";
					mysql_query($sql_insert_lng);
				}
				
			}
			return $history_id;
			
		}
			
	}

	function get() {
		$sql = "SELECT * FROM history AS h
		LEFT JOIN history_trans as ht ON ht.fk_history_id = h.history_id
		WHERE h.history_id = '$this->history_id' AND ht.lang='".$_SESSION['admin_lang']."'";
		
		$result = mysql_query($sql);
                $history = mysql_fetch_array( $result, MYSQL_ASSOC);
		$this->image = $history['image'];

		$this->caption = $history['caption'];
		$this->content = $history['content'];
		$this->create_date = $history['create_date'];
	
		
	}

	function update(){
		$sql = "UPDATE history SET
		image = '".addslashes($this->image)."'

		WHERE history_id = ".$this->history_id."";
		mysql_query($sql);
        
		
		$sql = "UPDATE history_trans SET  
		caption = '".addslashes($this->caption)."', 
		content = '".addslashes($this->content)."'
		WHERE fk_history_id=".$this->history_id." AND lang='".$_SESSION['admin_lang']."'";
		mysql_query($sql);
	}

	function delete(){
		global $db;
		$sql = "DELETE FROM history WHERE history_id = '$this->history_id'";
		$sqlt = "DELETE FROM history_trans WHERE fk_history_id = '$this->history_id'";
		mysql_query($sql);
		mysql_query($sqlt);
	}
    
    function get_public_history() {
		$sql = "SELECT * FROM history AS h
		LEFT JOIN history_trans as ht ON ht.fk_history_id = h.history_id
		WHERE h.history_id = '$this->history_id' AND ht.lang='".$_SESSION['lang']."'";
		
		$result = mysql_query($sql);
                $history = mysql_fetch_array( $result, MYSQL_ASSOC);
		$this->image = $history['image'];

		$this->caption = $history['caption'];
		$this->content = $history['content'];
		$this->create_date = $history['create_date'];

	}


	function create_public_history_list(){
	global $db;
	
	$sql = "SELECT * FROM history AS h
	LEFT JOIN history_trans as ht ON ht.fk_history_id = h.history_id
	ORDER BY h.history_id LIMIT 0,5";
	$result = mysql_query($sql);
	return mysql_fetch_array( $result, MYSQL_ASSOC);
	}

	
	function get_all_history($where='', $limit_sql='', $order_by=''){
		global $db;
		
		$sql = "SELECT * FROM history AS h 
		LEFT JOIN history_trans as ht ON ht.fk_history_id = h.history_id
		$where AND ht.lang='".$_SESSION['lang']."'  $order_by $limit_sql";

		$result = mysql_query($sql);
		$history = array();
		if($result && mysql_num_rows($result)){
			while ($h = mysql_fetch_array($result, MYSQL_ASSOC)){
				
                                        $h['create_date'] = fromsqldate($h['create_date'],"d.m.Y ");      
				
				$history[] = $h;
			}
			return $history;
		}else{
			return false;
		}
		
	}
    
    function get_all_history_admin($where='', $limit_sql='', $order_by=''){
		
		$sql = "SELECT * FROM history AS h 
		LEFT JOIN history_trans as ht ON ht.fk_history_id = h.history_id
		$where AND ht.lang='".$_SESSION['admin_lang']."'  $order_by $limit_sql";  //dumper($sql); exit;
	        
		$result = mysql_query($sql);
		$history = array();
		if($result && mysql_num_rows($result)){
			while ($h = mysql_fetch_array($result, MYSQL_ASSOC)){
				
                                        $h['create_date'] = fromsqldate($h['create_date'],"d.m.Y ");                                        
				
				$history[] = $h;
			}
			return $history;
		}else{
			return false;
		}
		
	}
}






?>