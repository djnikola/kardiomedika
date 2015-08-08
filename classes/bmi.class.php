<?php

/**
 * Enter description here...
 *
 */

class Bmi{	
	 var $id;
	 var $type;   	  
	 var $created;  	  
	
	function Bmi(
		$id = 0,
	 	$type = '',  	  
	 	$created = '' 	  
	 	
	){
			
		$this->id = $id;
		$this->type = $type;
		$this->created = $created;
	}

	/**
	 * Creatin new contact entry into database
	 *
	 * @return unknown
	 */
	function add(){
		global $config;
		global $db;
		$sql = "INSERT INTO bmi (
		type,
		created
		)
		VALUES (
		'$this->type',
		now())";
		mysql_query($sql);
		$id = mysql_insert_id();
		return $id;
	}

	function get(){
		global $db;
		
		$sql = "
			SELECT *
			FROM bmi
			WHERE id = '$this->id' ";
		$result = mysql_query($sql);
		$l = mysql_fetch_array($result, MYSQL_ASSOC);	
		
		$this->id = $l['id'];
		$this->type = $l['type'];
		$this->created = $l['created'];
	}

	function get_result(){
		global $db;
		
		$sql = "SELECT type, COUNT(type) AS type_summ 
			FROM bmi
			GROUP BY type
			ORDER BY type";
		$result = mysql_query($sql);
		$r = array();
		for ($i = 1; $i<=6 ; $i++) {
			$r[$i] = array(
	        	'type' => 1,
	        	'type_sum' => 0,
	        	'type_precent' => 0
	        );
		}
		$num = $this->get_bni_count();
		$i =1; $totalPercent = 0; $count = 0;
		
		while ($l = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$curr = round(($l['type_summ']/$num *100));
			$totalPercent += $curr;
			$count += $l['type_summ'];
	        $r[$l['type']] = array(
	        	'type' => $l['type'],
	        	'type_sum' => $l['type_summ'],
	        	'type_precent' => $curr
	        );
	        $i++;
	    }
	    if (count($r)){
	    	$r[1]['type_precent'] = $r[1]['type_precent'] + 100 - $totalPercent;	    
	    }
	    $r['count'] = $count;
	    
		return $r;
	}

	function get_bni_count() {
		global $db;
		
		$sql = "SELECT COUNT(*) AS num
			FROM bmi";
		$result = mysql_query($sql);
		$r = mysql_fetch_array($result, MYSQL_ASSOC);
		return $r['num'];
	}

	function delete(){
		global $db;
		$sql = "DELETE FROM bmi 
			WHERE id = '$this->id'";
		$db->Execute($sql);
	}

	
}

?>