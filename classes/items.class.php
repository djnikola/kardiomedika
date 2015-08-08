<?php

class Items {
	var $items_id;
	//var $description;
        var $content;
	var $image;
	        
        var $cur_lang;

	function Items(){
		
	}

	function add(){
		global $db, $config;

		$sql = "INSERT INTO items (
		image

		)
		VALUES (
		'".addslashes($this->image)."'

		)"; 
		//dumper($sql);
                //$db->Execute($sql) ;
		if ($db->Execute($sql) === false) {  
			return false;
		}else{
			$items_id = $db->Insert_ID();

			#########################
				$sql_check = "SELECT * FROM items_trans WHERE fk_items_id='$items_id'"; //dumper($sql_check);
				$r = mysql_query($sql_check);
				
				if(mysql_fetch_array($r, MYSQL_ASSOC) == ''){
					$sql_insert_lng="INSERT INTO items_trans SET 
					content='".addslashes($this->content)."',

					fk_items_id = $items_id";
					mysql_query($sql_insert_lng); 
				}
				  //dumper($miss_id);
			################################
			return $items_id;
			
		}
			
	}

	function get() {
		global $db;
		$sql = "SELECT * FROM items AS p
		LEFT JOIN items_trans as pt ON pt.fk_items_id = p.items_id
		WHERE p.items_id ='".$this->items_id."' ";// dumper($sql);exit;
		
		$result = $db->GetAll($sql); 
		$this->image = $result[0]['image'];
		$this->content = $result[0]['content'];

		//$this->description = $result[0]['description'];

		
	}

	function update(){
            
            
		global $db;
		$sql = "UPDATE items SET	
		
                image = '".addslashes($this->image)."'
                
		WHERE  items_id = ".$this->items_id."  ";  //dumper($sql);
                
		$db->Execute($sql);
		
		$sql = "UPDATE items_trans SET  

		content = '".addslashes($this->content)."'
		
		WHERE fk_items_id=".$this->items_id." "; //dumper($sql);exit;
		
		$db->Execute($sql); 
	}

	function delete(){
		global $db;
		$sql = "DELETE FROM items WHERE items_id = '$this->items_id'"; //dumper($sql);
		$sqlt = "DELETE FROM items_trans WHERE fk_items_id = '$this->items_id'";//dumper($sqlt);exit;
		$db->Execute($sql);
		$db->Execute($sqlt);
	}

	function create_public_product_list(){
	global $db;
	
	$sql = "SELECT * FROM items AS p
	LEFT JOIN items_trans as pt ON pt.fk_items_id = p.items_id
	ORDER BY p.items_id LIMIT 0,5";
	$result = $db->GetAll($sql);
	return $result;
	
	}

	/**
         * Get All Product
         * 
         * @global void $db
         * @param string $where
         * @param string $limit_sql
         * @param string $order_by
         * @return boolean 
         */
	function get_all_items($where='', $limit_sql='', $order_by=''){
		global $db;
		
		$sql = "SELECT * FROM items AS p 
		LEFT JOIN items_trans as pt ON pt.fk_items_id = p.items_id $where $order_by $limit_sql";  
		$result = mysql_query($sql);
		$product = array();
		if($result && mysql_num_rows($result)){
			while ($p = mysql_fetch_array($result, MYSQL_ASSOC)){
				
				$product[] = $p;
			}
			return $product; 
		}else{
			return false;
		}
		
	}
}


?>