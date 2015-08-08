<?php

/**
 * Enter description here...
 *
 */

class Contact{
	
	
	 var $contact_us_id;
	 var $name;
	 var $lname;   	  
	 var $phone;
	 var $birth_year;   	  
	 var $email;  	  
	 var $message;
	 var $from_date;
	 var $to_date;
	 var $doctor_name;
	 var $examination;
	 var $daily_period;   	  
	 var $created;   	  
	 var $notice;   	  
	

	function Contact(
		$contact_us_id = 0,
	 	$name = '', 
	 	$lname = '',  	  
	 	$phone = '',
	 	$birth_year = '',   	  
	 	$email = '',   	  
	 	$from_date = '',
	 	$to_date = '',
	 	$doctor_name = '',
	 	$examination = '',
	 	$daily_period = '',   	  
	 	$message = '',  
	 	$notice = '',  
	 	$created = '' 	  
	 	
	){
			
		$this->contact_us_id = $contact_us_id;
		$this->name = $name;
		$this->lname = $lname;
		$this->phone = $phone;
		$this->birth_year = $birth_year;
		$this->email = $email;
		$this->from_date = $from_date;
	 	$this->to_date = $to_date;
	 	$this->doctor_name = $doctor_name;
	 	$this->examination = $examination;
	 	$this->daily_period = $daily_period;
		$this->message = $message;
		$this->notice = $notice;
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
		$sql = "INSERT INTO contact_us (
		name,
		lname,
		phone,
		birth_year,
		email,
		from_date,
	 	to_date,
	 	doctor_name,
	 	examination,
	 	daily_period,
		message,
		notice,
		created
		)
		VALUES (
		'".addslashes($this->name)."',
		'".addslashes($this->lname)."',
		'".addslashes($this->phone)."',
		'".addslashes($this->birth_year)."',
		'".addslashes($this->email)."',
		'".date_converter_from_serbian_format($this->from_date, ".")."',
		'".date_converter_from_serbian_format($this->to_date, ".")."',
		'".addslashes($this->doctor_name)."',
		'".addslashes($this->examination)."',
		'".addslashes($this->daily_period)."',
		'".addslashes($this->message)."',
		'$this->notice',
		now())";

		mysql_query($sql);
		$contact_us_id = mysql_insert_id();
		return $contact_us_id;
	}

	function get(){
		global $db;
		
		$sql = "
			SELECT *
			FROM contact_us
			WHERE contact_us_id = '$this->contact_us_id' ";
		$result = mysql_query($sql);
		$l = mysql_fetch_array($result, MYSQL_ASSOC);	
		
		$this->contact_us_id = $l['contact_us_id'];
		$this->name = $l['name'];
		$this->lname = $l['lname'];
		$this->phone = $l['phone'];
		$this->birth_year = $l['birth_year'];
		$this->email = $l['email'];
		$this->from_date = $l['from_date'];
		$this->to_date = $l['to_date'];
		$this->doctor_name = $l['doctor_name'];
		$this->examination = $l['examination'];
		$this->daily_period = $l['daily_period'];
		$this->message = $l['message'];
		$this->created = $l['created'];
		$this->notice = $l['notice'];
	}

	function update(){
		$sql = "
			UPDATE contact_us SET	
				notice = '".preg_replace("/[\n\r]/", " ", $this->notice)."'
			WHERE contact_us_id=".$this->contact_us_id."";
			mysql_query($sql);
	}

	function get_all_contacts($where='', $limit_sql='', $order_by=''){
	global $db;
		
		$sql = "SELECT * FROM contact_us  $where $order_by $limit_sql";
		$result = $db->GetAll($sql);
		return $result;
	}

	function delete(){
		global $db;
		$sql = "DELETE FROM contact_us WHERE contact_us_id = '$this->contact_us_id'";
		$db->Execute($sql);
	}

	
}

?>