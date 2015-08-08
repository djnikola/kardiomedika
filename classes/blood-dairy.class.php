<?php

/**
 * Enter description here...
 *
 */

class BloodPresureDairy{	
	 var $blood_presure_dairy_id;
	 var $name;   	  
	 var $lname;   	  
	 var $birth_year;
	 var $phone;
	 var $email;
	 var $results;   	  
	 var $created;  	  
	
	function BloodPresureDairy(
		$blood_presure_dairy_id = 0,
	 	$name = '',
	 	$lname = '',   	  
	 	$birth_year = '',   	  
	 	$phone = '',
	 	$email = '',
	 	$results = '',   	  
	 	$created = '' 	  
	 	
	){
			
		$this->blood_presure_dairy_id = $blood_presure_dairy_id;
		$this->name = $name;
		$this->lname = $lname;
		$this->birth_year = $birth_year;
		$this->phone = $phone;
		$this->email = $email;
		$this->results = $results;
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
		$sql = "INSERT INTO blood_presure_dairy (
		name,
		lname,
		birth_year,
		phone,
		email,
		results,
		created
		)
		VALUES (
		'".addslashes($this->name)."',
		'".addslashes($this->lname)."',
		'".addslashes($this->birth_year)."',
		'".addslashes($this->phone)."',
		'".addslashes($this->email)."',
		'".addslashes($this->results)."',
		now())";

		mysql_query($sql);
		$blood_presure_dairy_id = mysql_insert_id();
		return $blood_presure_dairy_id;
	}

	function get(){
		global $db;
		
		$sql = "
			SELECT *
			FROM blood_presure_dairy
			WHERE blood_presure_dairy_id = '$this->blood_presure_dairy_id' ";
		$result = mysql_query($sql);
		$l = mysql_fetch_array($result, MYSQL_ASSOC);	
		
		$this->blood_presure_dairy_id = $l['blood_presure_dairy_id'];
		$this->name = $l['name'];
		$this->lname = $l['lname'];
		$this->birth_year = $l['birth_year'];
		$this->phone = $l['phone'];
		$this->results = $l['results'];
		$this->notice = $l['notice'];
	}

	function update(){
		$sql = "
			UPDATE blood_presure_dairy SET	
				notice = '".preg_replace("/[\n\r]/", " ", $this->notice)."'
			WHERE blood_presure_dairy_id = ".$this->blood_presure_dairy_id."";
			mysql_query($sql);
	}

	function get_all_contacts($where='', $limit_sql='', $order_by=''){
	global $db;
		
		$sql = "SELECT * FROM blood_presure_dairy  $where $order_by $limit_sql";
		$result = $db->GetAll($sql);
		return $result;
	}

	function delete(){
		global $db;
		$sql = "DELETE FROM blood_presure_dairy 
			WHERE blood_presure_dairy_id = '$this->blood_presure_dairy_id'";
		$db->Execute($sql);
	}
	
	public static function calculateAvg($type, $messure) {
		$sum = 0;
		$num = 0;
		for ($i = 2; $i <=7; $i++) {
			if (!empty($messure[$i]["morning_$type"]) && ($messure[$i]["morning_$type"] != "") ) {
				$sum += $messure[$i]["morning_$type"];
				$num++;
			}
			
			if (!empty($messure[$i]["afternoon_$type"]) && ($messure[$i]["afternoon_$type"] != "") ) {
				$sum += $messure[$i]["afternoon_$type"];
				$num++;
			}
			
			if (!empty($messure[$i]["evening_$type"]) && ($messure[$i]["evening_$type"] != "") ) {
				$sum += $messure[$i]["evening_$type"];
				$num++;
			}
		}
		if ($num > 0){
			return (floor($sum/$num));
		}
		return 0;
	}
	
}

?>