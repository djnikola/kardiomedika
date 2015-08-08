<?php

class Picture {
	//name of table to which pictures will be attached. Example: product  OVO NEMA VEZE SA ZIVOTOM  !!!!!!
	var $table_name;
	//fk id column name for table where pictures will be attached. Example: product_pictures OVO NEMA VEZE SA ZIVOTOM !!!!!
	var $fk_id_name;
	//value of fk_id
	var $fk_id;
	//picture id
	var $picture_id;
	//picture path 
	var $path;
	var $thumbnail_path;
	var $name;
	var $description;
	var $sort;
	//single language
	var $lang;
	//array of all languages in project
	var $lang_arr;
	
	var $root_dir; // BASE_PATH,
	var $upload_dir; // "uploads/product/product",
	var $input_file; // "image",
	var $error_name; // "image_error",
	var $errors_images;
	var $max_size; // "200000",
	var $extensions; // "jpg",
	var $tmp_dir = 'tmp_uploads'; // "tmp_uploads",

	var $tmp_path; //
	var $file_name;
	var $input_file_path;// "image_path",
	var $input_file_name; // "image_name",
	var $thumbnail_sizes; // "product_thumbnails",
	//var $file_config = array();
	
	function Picture(
		$table_name = '',
		$fk_id_name = '',
		$fk_id = '',
		$picture_id = '',
		$path = '',
		$name = '',
		$description = '',
		$sort = '',
		$basePath = '',
		$uploadDir = '',
		$thumbnail_sizes = "100x100"
		) 
	{
		$this->table_name = $table_name;
		$this->fk_id_name = $fk_id_name;
		$this->fk_id = $fk_id;
		$this->picture_id = $picture_id;
		$this->path = $path;
		$this->name = $name;
		$this->description = $description;
		$this->sort = $sort;
				
		$this->root_dir = $basePath;
		$this->upload_dir = $uploadDir;
		$this->input_file = "image";
		$this->error_name = "image_error";
		$this->max_size = "2000000";
		$this->extensions = "jpg";
		$this->thumbnail_sizes = $thumbnail_sizes;
		$this->thumbnail_path = make_thumbnail_url($basePath.$this->path, $this->thumbnail_sizes);
		$this->error_name = "image_error";		
	}
	
	function unset_object() {
		$this->picture_id = '';
		$this->path = '';
		$this->name = '';
		$this->description = '';
		$this->sort = '';
		$this->input_file_path = '';
		$this->input_file_name = '';
	}
	
	function update() {
		$sql = "
			UPDATE ". $this->table_name ."
			SET
			$this->fk_id_name = ". $this->fk_id .", 
			path = '". $this->path ."',
			sort = ". (int)$this->sort ."
			WHERE picture_id = ". $this->picture_id ." 			 
		";
		//dumper($sql);
			
		$result = mysql_query($sql); echo mysql_error();
		if (mysql_error() == '') {
			$sql = "
				UPDATE ". $this->table_name ."_trans
				SET
				name = '". stripslashes($this->name) ."',
				description = '". addslashes($this->description). "'						
				WHERE fk_picture_id = ". $this->picture_id ."
				AND lang = '$this->lang'				
			";
			////dumper($sql);
			$result = mysql_query($sql); echo mysql_error();
			if (mysql_error() == '') 
				return true;
			else
				return false;
		}
	}
	
	function get() {
		$sql = "
			SELECT *
			FROM ". $this->table_name ." AS p
			LEFT JOIN ". $this->table_name ."_trans AS pt
			ON p.picture_id = pt.fk_picture_id
			WHERE p.picture_id = ". $this->picture_id ."
			AND pt.lang = '". $this->lang ."'
		";
		
		// da li treba da se koristi ovo  "ON p.picture_id = pt.$this->fk_id_name" ?????

		$result = mysql_query($sql); echo mysql_error();
		if($result && mysql_num_rows($result)) {
			$r = mysql_fetch_array($result, MYSQL_ASSOC);
			$this->name = $r['name'];
			$this->description = $r['description'];
			$this->path = $r['path'];
			$this->sort = $r['sort'];
		}
	}
	
	function add() {
		$sql = "INSERT INTO $this->table_name(
			picture_id,
			$this->fk_id_name,
			path,
			sort
			)
			VALUES (
			'',
			'$this->fk_id',
			'$this->path',
			'$this->sort'
			)
		";

		$result = mysql_query($sql);
		if (mysql_error() != '' ) {
			return false;
		}else{
			//picture id
			$this->picture_id = mysql_insert_id();
			
			//insert same values for all other languages if there is not already inserted picture
			@reset($this->lang_arr);
			//dumper($this->lang_arr);
			foreach($this->lang_arr as $lng) {
				$sql_check = "
					SELECT * 
					FROM ".$this->table_name."_trans 
					WHERE lang='$lng' 
					AND fk_picture_id='". $this->picture_id ."'
				";
				$r = mysql_query($sql_check);
				
				if(mysql_fetch_array($r, MYSQL_ASSOC) == '') {
					$sql_insert_lng = "
						INSERT INTO ".$this->table_name."_trans 
						SET
						name ='".stripslashes($this->name)."',
						description ='".addslashes($this->description)."',						
						lang='$lng', 
						fk_picture_id = $this->picture_id
					";
					dumper($sql_insert_lng);
					mysql_query($sql_insert_lng);
				}
			}
		}
		return $this->picture_id;
	}
	
	function upload_save_tmp(&$errors) {
		
		$upload_file = &$_FILES[$this->input_file];
		//dumper($upload_file);
		$this->errors_images = array();
		//dumper($upload_file['tmp_name']);
  		if ($upload_file['tmp_name']) {
	  	//check errors
	  	//PHP upload errors
		  	
		  	if($upload_file['error'] > 0) {
			  switch($upload_file['error']) {
			    case 1:
			    case 2:
				  	$this->errors_images['file_size'] = 
				  		"The uploaded file exceeds the maximum file size.";
				  	break;
			    case 3:
				  	$this->errors_images['partially_uploaded'] = 
				  		"The uploaded file was only partially uploaded.";
				  	break;
				  case 4:
				  	$this->errors_images['not_uploaded'] = "No file was uploaded.";
				  	break;
				  default:
				  	$this->errors_images['uploading_error'] = "Error uploading file.";
				  	break;
				}
			}
			#Check for custom size error
			//dumper($this->errors_images);
			//dumper(c);			
			if($this->max_size && $upload_file['size'] > $this->max_size) {
				$this->errors_images[$this->error_name] = 
					" The uploaded file exceeds the maximum file size of $this->max_size bytes.";
			}
			#Check for custom extension error
			if($this->extensions) {
			  $exts = explode(",", $this->extensions);
			  $path_parts = pathinfo($upload_file['name']);
			  
			  if(!in_array(@strtolower($path_parts['extension']), $exts)){
					$this->errors_images[] .= "Aloved file extensions are: $this->extensions .";
				}
			}

			if(count($this->errors_images) == 0) {
				$dest = $this->tmp_dir . "/" . session_id();
				if(!is_dir($this->root_dir . $dest)) {
					@mkdir($this->root_dir . $dest);
					@chmod($this->root_dir . $dest, 0777);
				}
				$dest .= "/" . time() . "_" . basename($upload_file['tmp_name']);
	//			if($image){
	//				image_resize($upload_file['tmp_name'], "600x600");
	//			}
				@move_uploaded_file($upload_file['tmp_name'], $this->root_dir . $dest);
				$this->input_file_path = $dest;
				$this->input_file_name = stripslashes($upload_file['name']);	
			}else{
				foreach($this->errors_images as $error=>$text){
					$errors[$error] = $text;
				}
			}
		}
	}

	function upload_save($id = "", $time="") {
		#Create dest folders
		$dest_dir = $this->upload_dir;
		if(!is_dir($this->root_dir . $dest_dir)) {
		  mkdir($this->root_dir . $dest_dir);
		  chmod($this->root_dir . $dest_dir, 0777);
		}
		if($id) {
		  $dest_dir .= "/" . ($id % 10);
		  if(!is_dir($this->root_dir . $dest_dir)) {
		    mkdir($this->root_dir . $dest_dir);
			chmod($this->root_dir . $dest_dir, 0777);
		  }
		  $dest_dir .= "/" . $id;
		  if(!is_dir($this->root_dir . $dest_dir)) {
		  	mkdir($this->root_dir . $dest_dir);
			chmod($this->root_dir . $dest_dir, 0777);
		  }
		}
		#Distinction between update with new file and without
		$file_name = serbian2latin(text_for_link($this->input_file_name));
		if(!empty($file_name)) {
		  if($id){ 
		  	$path = $dest_dir . "/" . $id . "_" . $time . "_" . basename($file_name);
		  }
		  else {
		  	$path = $dest_dir . "/" . $time . "_". basename($file_name);
		  }
		  //dumper($this->root_dir . $this->input_file_path);
		  copy($this->root_dir . $this->input_file_path, $this->root_dir . $path);
		  unlink($this->root_dir . $this->input_file_path);
		  system("rm -rf \"$this->root_dir".str_replace("\"", "\\\"", 
		  	dirname($this->input_file_path)).'/thumbnails/*/'.
		  	str_replace("\"","\\\"",basename($this->input_file_path)."\""));
		  chmod($this->root_dir . $path, 0777);
	      if(!empty($this->thumbnail_sizes)) {
	        make_thumbnails($this->root_dir . $path, $this->thumbnail_sizes);
		  }
		  $this->input_file_path = $path;
		}
		return $this->input_file_path;
	}
	
	function setUpLanguages($lang_arr, $lang) {
		$this->lang_arr = $lang_arr;
		$this->lang = $lang;		
	}
	
	function basicInitialization($table_name, $fk_id_name, $fk_id) {
		$this->table_name = $table_name;
		$this->fk_id_name = $fk_id_name;
		$this->fk_id = $fk_id; 
	}
	
	function setThumbnailPath($thumbnailSize) {
		$this->thumbnail_path = dirname($this->path)."/thumbnails/$thumbnailSize/".basename($this->path);
	}
	
	function delete() {
		@unlink($this->root_dir.$this->path);
		$sql = "
			DELETE FROM ". $this->table_name ."
			WHERE picture_id = ". $this->picture_id ." 
		";
		$result = mysql_query($sql);echo mysql_error();
		$sql = "
			DELETE FROM ". $this->table_name ."_trans
			WHERE fk_picture_id = ". $this->picture_id ." 
		";
		$result = mysql_query($sql);echo mysql_error();
	}
	

	function emptyObject() {
  		$this->fk_id = '';
		$this->picture_id = '';
		$this->path = '';
		$this->sort = '';
		$this->special = '';
		$this->path = '';
		$this->tmp_path = ''; 
	}

}

class PictureMultiLang extends Picture{
	
	var $name='';
	var $description='';
	var $image_name='';
	
	var $lang_arr;
	var $lng;
	
	function getName() {
		return $this->name;
	}
	
	function getDescription() {
		return $this->description;
	}
	
	function getImagePath() {
		return $this->path;
	}
	
	function getImageName() {
		return $this->image_name;
	}
	
	function add(){
		
		$this->picture_id = parent::add();

		if($this->picture_id) {
			
			foreach($this->lang_arr as $lng) {
				$sql_check = "
					SELECT * 
					FROM ".$this->table_name."_trans
					WHERE lang='$lng' 
					AND fk_picture_id='". $this->picture_id ."'
				";
				$r = mysql_query($sql_check);
				
				if(mysql_fetch_array($r, MYSQL_ASSOC) == '') {
					$sql_insert_lng = "
					INSERT INTO ".$this->table_name."_trans SET 
					name ='".stripslashes($this->name)."',
					description ='".addslashes($this->description)."',
					lang='$lng', 
					fk_picture_id = $this->picture_id";
					mysql_query($sql_insert_lng); 
					echo mysql_error();
				}
			}
		}
		return $this->picture_id;
	}
	
	function update(){
		
		if(parent::update()) {
		
			$sql = "
				UPDATE ".$this->table_name."_trans SET  
				name = '".addslashes($this->name)."', 
				description = '".stripslashes($this->description)."'
				WHERE fk_picture_id = ". $this->picture_id ." 
				AND lang = '" . $this->lng . "'
			";
		//dumper($sql);	
		$result = mysql_query($sql);echo mysql_error();
		if(mysql_error() == '')
			return true;
		else 
			return false;
		}
		return false;
	}
	
	function get() {

		$sql = "
			SELECT * FROM ".$this->table_name." AS gp
			LEFT JOIN ".$this->table_name."_trans AS gpt 
			ON gpt.fk_picture_id = gp.picture_id
			WHERE gp.picture_id = '$this->picture_id' 
			AND gpt.lang='". $this->lng ."'
		";
		$result = mysql_query($sql);echo mysql_error();
		if (mysql_num_rows($result) && mysql_error() == '')
		{
			$l = mysql_fetch_array($result, MYSQL_ASSOC);
			$this->picture_id = $l['picture_id'];
			$this->path = $l['path'];
			$this->name = $l['name'];
			$this->description = $l['description'];
			$this->sort = $l['sort'];
			$this->special = $l['special'];			
		}
	}
	
	function getSpecialPicture() {
		$sql = "
			SELECT * FROM ".$this->table_name." AS gp
			LEFT JOIN ".$this->table_name."_trans AS gpt ON gpt.fk_picture_id = gp.picture_id
			WHERE gpt.lang='". $this->lng ."'
			AND ".$this->fk_id_name." = '".$this->fk_id."'
			ORDER BY gp.sort, gpt.fk_picture_id
			LIMIT 0,1
		";
		//dumper($sql);
		$l = array();
		$result = mysql_query($sql);echo mysql_error();
		if (mysql_num_rows($result) && mysql_error() == '')
		{
			$l = mysql_fetch_array($result, MYSQL_ASSOC);
			$this->picture_id = $l['picture_id'];
			$this->path = $l['path'];
			$this->name = $l['name'];
			$this->description = $l['description'];
			$this->sort = $l['sort'];
			$this->special = $l['special'];			
		}
	}
	
	function getPictureById($picture_id) {
		$sql = "
			SELECT * FROM ".$this->table_name." AS gp
			LEFT JOIN ".$this->table_name."_trans AS gpt 
			ON gpt.fk_picture_id = gp.picture_id
			WHERE gpt.lang='". $this->lng ."'
			AND gp.picture_id = '".$picture_id."'
		";
		//dumper($sql);
		$result = mysql_query($sql);echo mysql_error();
		if (mysql_num_rows($result) && mysql_error() == '')
		{
			$picture = mysql_fetch_array($result, MYSQL_ASSOC);
			return $picture;	
		}else{
			return false;
		}
	}
	
	/**
	 * returns number of pictures for product_id
	 *
	 */
	function getPictureNum() {
		$sql = "
			SELECT COUNT(*) 
			FROM ".$this->table_name." AS gp
			LEFT JOIN ".$this->table_name."_trans AS gpt 
			ON gpt.fk_picture_id = gp.picture_id
			WHERE gp.$this->fk_id_name = '$this->fk_id' 
			AND gpt.lang='". $this->lng ."'
		";
		
		$result = mysql_query($sql);echo mysql_error();
		return mysql_result($result, 0 , 0);
	}
	
	function getPicturesIdsArr($orderBy='') {
		$sql = "
			SELECT picture_id
			FROM ".$this->table_name." AS gp
			LEFT JOIN ".$this->table_name."_trans AS gpt 
			ON gpt.fk_picture_id = gp.picture_id
			WHERE gp.$this->fk_id_name = '$this->fk_id' 
			AND gpt.lang='". $this->lng ."'
			 ORDER BY gp.sort 
		";
		$result = mysql_query($sql); echo mysql_error();
		$pictureIds = array();
		if($result && mysql_num_rows($result)) {
			$i = 1;
			while ($gp = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$pictureIds[$i] = $gp['picture_id'];
				$i++;
			}
		}
		return $pictureIds;
	}
	
	function get_all_pictures($where='', $limit_sql='', $order_by=''){
		
		$sql = "
			SELECT * 
			FROM ".$this->table_name." AS gp
			LEFT JOIN ".$this->table_name."_trans AS gpt
			ON gp.picture_id = gpt.fk_picture_id
			$where 
			$order_by 
			$limit_sql
		";

		$result = mysql_query($sql);echo mysql_error();
		$pictures = array();
		if($result && mysql_num_rows($result)){
			while ($gp = mysql_fetch_array($result, MYSQL_ASSOC)){
				$pictures[] = $gp;
			}
			return $pictures;
		}else{
			return false;
		}
	}

	function delete($thumbnailArr){
		
		if(parent::delete($thumbnailArr)) {
		
			$sql = "DELETE FROM ".$this->table_name."_trans WHERE fk_picture_id = '$this->picture_id'";
			$result = mysql_query($sql);
			echo mysql_error();
			$this->emptyObject();
		}
	}
	/**
	 * 
	 * @param $data
	 * @return unknown_type
	 * 
	 * $data array for setting Values for class members
	 * NOTE: picture path is not set here!
	 * 
	 */
	function setVariables($data) {
		$this->name = $data['name'];
		$this->description = $data['description'];
		$this->sort = $data['sort'];
		$this->special = @$data['special'];
	}
	
	function emptyObject() {
		
		parent::emptyObject();
		$this->name = '';
		$this->description = '';		
	}
}
?>
