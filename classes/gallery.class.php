<?php

class Gallery {
	var $gallery_id;
	var $category_id;
	var $category_name;
	var $category_description;
	var $category_sort;
	//picture path for gallery
	var $gallery_path;
	var $name;
	var $description;
	var $created_date;
	var $sort;
	var $is_active;
	var $is_special;
	
	//meta fields
	var $meta_title;
	var $meta_description;
	var $meta_keywords;
	
	var $root_dir; // BASE_PATH,
	
	//single language
	var $lang;
	//array that content all languages in project
	var $lang_arr;
	//array of picuters for gallery_id
	var $picture_arr;
	//max number of pictures
	var $maxPictureNum;
	//gallery_thumbnail_sizes
	var $gallery_thumbnail_sizes = array("100x100", "200x200");
	
		
	function Gallery( $gallery_id = '', $category_id = '',
		$gallery_path = '',
		$name = '', $description = '',
		$created_date = '', $sort = '',
		$is_active = '', $is_special = '') 
	{	
		$this->gallery_id = $gallery_id;
		$this->category_id = $category_id;
		$this->gallery_path = $gallery_path;
		$this->name = $name;
		$this->description = $description;
		$this->created_date = $created_date;
		$this->sort = $sort;
		$this->is_active = $is_active;
		$this->is_special = $is_special;
		$this->picture_arr = array();
	}
	
	/*
	 * This function will return only gallery fields
	 * 
	 */
	function get() {
		$sql = "
			SELECT *
			FROM gallery g 
			INNER JOIN gallery_trans gt
			ON g.gallery_id = gt.fk_gallery_id
			WHERE g.gallery_id = '". $this->gallery_id ."'
			AND gt.lang = '". $this->lang ."'
		";
		
		$result = mysql_query($sql);echo mysql_error();
		if (mysql_error() == '') {
			$r = mysql_fetch_array($result, MYSQL_ASSOC);
			//fill all fields for gallery
			$this->category_id = $r['gallery_category_id'];
			$this->gallery_path = $r['gallery_path'];
			$this->name = $r['name'];
			$this->description = $r['description'];
			$this->created_date = $r['created_date'];
			$this->sort = $r['sort'];
			$this->is_active = $r['is_active'];
			$this->is_special = $r['is_special'];
			$this->meta_title = $r['meta_title'];
			$this->meta_description = $r['meta_description'];
			$this->meta_keywords = $r['meta_keywords'];
		}
		//dumper($sql);
	}
	
		function add() {
		$sql = "
			INSERT INTO gallery (
			gallery_category_id,
			gallery_path,
			created_date,
			sort,
			is_active,
			is_special
			)
			VALUES (
			". $this->category_id . ",
			'". addslashes($this->gallery_path) ."',
			NOW(),
			'". addslashes($this->sort) ."',
			'". addslashes($this->is_active) ."',
			'". addslashes($this->is_special)."'
			)
		";

		$result = mysql_query($sql); echo mysql_error();
		if(mysql_error() == '') {
			$this->gallery_id = mysql_insert_id();
			@reset($this->lang_arr);
			foreach($this->lang_arr as $lng) {

				//insert same values for all other languages 
				//if there is not already inserted gallery
				$sql_check = "
					SELECT * 
					FROM gallery_trans 
					WHERE lang = '$lng' 
					AND fk_gallery_id = '$this->gallery_id'
				";
				
				$result = mysql_query($sql_check);echo mysql_error();
				if(mysql_fetch_array($result, MYSQL_ASSOC) == '') {
					$sql_insert_lang = "
						INSERT INTO gallery_trans (
						fk_gallery_id,
						name,
						description,
						meta_title,
						meta_keywords,
						meta_description,
						lang
						)
						VALUES (
						". $this->gallery_id .",
						'". addslashes($this->name) ."',
						'". addslashes($this->description)."',
						'". addslashes($this->meta_title)."',
						'". addslashes($this->meta_keywords)."',
						'". addslashes($this->meta_description)."',
						'". $lng."'
						)
					";
					$result = mysql_query($sql_insert_lang);
					echo mysql_error();
					
				}
				
			}   
			return $this->gallery_id;								
		} 
		else {
			return false;
		}
	}
	
	function update() {
		$sql = "
			UPDATE gallery 
			SET
			gallery_category_id = ". $this->category_id .",
			gallery_path = '". $this->gallery_path ."',
			is_active = '". addslashes($this->is_active) ."',
			is_special = '". addslashes($this->is_special) ."'
			WHERE gallery_id = " .$this->gallery_id. "
		";
		$result = mysql_query($sql);
		//dumper($sql);
		echo mysql_error();
		if (mysql_error() == '') {
			$sql = "
				UPDATE gallery_trans 
				SET
				name = '".addslashes($this->name)."',
				description = '".addslashes($this->description)."',
				meta_title = '".addslashes($this->meta_title)."',
				meta_keywords  = '".addslashes($this->meta_keywords)."',
				meta_description ='".addslashes($this->meta_description)."'
				WHERE fk_gallery_id = ". $this->gallery_id ."
				AND lang = '". $this->lang ."'				
			";
			//dumper($sql);
			$result = mysql_query($sql);
			echo mysql_error();
			if (mysql_error() == '') 
				return true;
			else
				return false;
		}
		else {
			return false;	
		}
	}
	
	function delete() {
		
		$this->deleteGalleryPictures();
		
		$sql = "
			DELETE FROM gallery
			WHERE gallery_id = ". $this->gallery_id ." 
		";
		$result = mysql_query($sql);echo mysql_error();
		$sql = "
			DELETE FROM gallery_trans
			WHERE fk_gallery_id = ". $this->gallery_id ." 
		";
		$result = mysql_query($sql);echo mysql_error();
		#delete all pictures for gallery (not pictures under gallery, just pictures associates to gallery itself)
		@unlink($this->root_dir.$this->gallery_path);
		remove_thumbnails($this->root_dir.$this->gallery_path, $this->gallery_thumbnail_sizes);
				
	}
	
		
	
	/**
	 * Function returns all categories with belonging galleries and there thumbnails and data
	 *
	 * @param unknown_type $where
	 * @param unknown_type $limit_sql
	 * @param unknown_type $order_by
	 * @return unknown
	 */
	
	function getAllCategories($where='', $limit_sql='', $order_by='') {
		$sql ="
			SELECT *
			FROM gallery_category AS gc
			INNER JOIN gallery_category_trans AS gct
			ON gc.gallery_category_id = gct.fk_gallery_category_id
			AND gct.lang = '". $this->lang ."'
			$where 
			$order_by 
			$limit_sql
		";
		
		$result = mysql_query($sql);
		$all = array();
		if($result && mysql_num_rows($result)) {
			while ($gc = mysql_fetch_array($result, MYSQL_ASSOC)) {
				
				$sql = "
					SELECT *	
					FROM gallery AS g
					INNER JOIN gallery_trans AS gt
					ON g.gallery_id = gt.fk_gallery_id 
					AND gt.lang = '". $this->lang ."'
					AND g.is_active = 1
					WHERE g.gallery_category_id = ". $gc['gallery_category_id'] ."
				";
				$resultGallery = mysql_query($sql);
				$galleries = array();
				if($resultGallery && mysql_num_rows($resultGallery)) {
					while($g = mysql_fetch_array($resultGallery, MYSQL_ASSOC)) {
						
						$g['gallery_path'] = make_thumbnail_url($g['gallery_path'],	$this->gallery_thumbnail_sizes[1]);
						$galleries[] = $g;	
					}
				}
				$gc['galleries'] = $galleries;
				$all[] = $gc;
				
			}
			return $all;
		}
		
                return $all;
		
	}
	
	function sortGallery($new_order){
		$sql_current = "SELECT sort FROM gallery WHERE gallery_id=". $this->gallery_id ."";
		$result = mysql_query($sql_current);
		$current_sort = mysql_fetch_array($result, MYSQL_ASSOC);

		if($new_order == 'up' && $current_sort['sort'] > 1){
			$sql_prev = "SELECT gallery_id, sort FROM gallery WHERE sort < '". $current_sort['sort'] ."' ORDER BY sort desc LIMIT 0,1";
			$result = mysql_query($sql_prev);
			$prev = mysql_fetch_array($result, MYSQL_ASSOC);
			
			//dumper($sql_prev);
			//dumper($prev);
			
			$sql_update_prev = "UPDATE gallery SET sort='". $current_sort['sort'] ."' WHERE gallery_id = '". $prev['gallery_id'] ."'";
			//($sql_update_prev);
			mysql_query($sql_update_prev);
			$new_sort = $current_sort['sort'] -1;
			$sql_update_current = "UPDATE gallery SET sort= '".$new_sort."' WHERE gallery_id = '". $this->gallery_id ."'";
			//dumper("Kliknut: ".$sql_update_current);
			mysql_query($sql_update_current);
		}
		
		if($new_order == 'down'){
			$sql_next = "SELECT gallery_id, sort FROM gallery WHERE sort > '". $current_sort['sort'] ."' ORDER BY sort asc LIMIT 0,1";
			$result = mysql_query($sql_next);
			$next = mysql_fetch_array($result, MYSQL_ASSOC);
			
			$sql_update_next = "UPDATE gallery SET sort='". $current_sort['sort'] ."' WHERE gallery_id = '". $next['gallery_id'] ."'";
			//($sql_update_next);
			mysql_query($sql_update_next);
			$new_sort = $current_sort['sort'] +1;
			$sql_update_current = "UPDATE gallery SET sort=$new_sort WHERE gallery_id = '". $this->gallery_id ."'";
			//dumper("Kliknut: ".$sql_update_current);
			mysql_query($sql_update_current);
		}
	}
	
	function getAllGalleries($where='', $limit_sql='', $order_by='') {
		
		$sql = "
			SELECT *, gt.name AS gallery_name, gct.name AS gallery_category_name
			FROM gallery AS g
			INNER JOIN gallery_trans AS gt ON g.gallery_id = gt.fk_gallery_id 
			INNER JOIN gallery_category AS gc ON g.gallery_category_id = gc.gallery_category_id
			INNER JOIN gallery_category_trans AS gct ON gc.gallery_category_id = gct.fk_gallery_category_id	AND gct.lang = gt.lang
			$where 
			AND gt.lang = '". $this->lang ."'
			$order_by 
			$limit_sql
		";
			//dumper($sql);

		$result = mysql_query($sql);
		$all = array();
		if($result && mysql_num_rows($result)) {
			while ($g = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$g['created_date'] = fromsqldate($g['created_date'], "d.m.Y");
				//$g['gallery_category_name'] = 
				$all[] = $g;
			}
			return $all;
		}
		else {
			return false;
		}
		
	}
	
	function getAllGalleryPictures($where='', $limit_sql='', $order_by='', $thumnail_size = "100x100") {
		$sql = "
			SELECT * 
			FROM gallery_pictures AS gp
			INNER JOIN gallery_pictures_trans AS gpt 
			ON gp.picture_id = gpt.fk_picture_id
			$where 
			AND gpt.lang = '". $this->lang ."'
			AND gp.fk_gallery_id = '".$this->gallery_id."'
			$order_by 
			$limit_sql
		";
		//dumper($sql);
		$result = mysql_query($sql);
		$this->picture_arr = array();
		if($result && mysql_num_rows($result)) {
			while ($gp = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$pictureObj = new Picture(
					"gallery_pictures",
					"gallery_id",
					$this->gallery_id,
					$gp['picture_id'],
					$gp['path'],
					$gp['name'],
					$gp['description'],
					$gp['sort'],
					"",
					'',
					$thumnail_size					
				);
				
				
				$pictureObj->setUpLanguages($this->lang_arr, $this->lang);
				$this->picture_arr[] = $pictureObj;
			}
			return true;
		}
		else {
			return false;
		}
	}
	
	function deleteGalleryPictures(){
	$sql = "
			SELECT picture_id 
			FROM gallery_pictures AS gp
			INNER JOIN gallery_pictures_trans AS gpt 
			ON gp.picture_id = gpt.fk_picture_id
			WHERE gp.fk_gallery_id = '".$this->gallery_id."'
		";
		$result = mysql_query($sql);
		$this->picture_arr = array();
		if($result && mysql_num_rows($result)) {
			while ($gp = mysql_fetch_array($result, MYSQL_ASSOC)) {
				
				$pictureObj = new Picture();
				$pictureObj->setUpLanguages($this->lang_arr, $this->lang);
				$this->picture_arr[] = $pictureObj;
				$pictureObj->picture_id = $gp['picture_id'];
				$pictureObj->table_name = "gallery_pictures";
				$pictureObj->get();
				
				$pictureObj->delete();
							
			}
		}		
	}
	
	function getGalleryWithPictures() {
		//this sql will return all pictures for $this->gallery_id
		$sql = "
			SELECT *
			FROM gallery g 
			INNER JOIN gallery_trans gt
			WHERE gt.lang = '" . $this->lang . "'
			AND g.gallery_id = '" . $this->gallery_id . "'
		";
		//dumper($sql);
		
		$result = mysql_query($sql);echo mysql_error();
		if (mysql_error() == '' && mysql_num_fields($result)) {
			$g = mysql_fetch_array($result, MYSQL_ASSOC);
			//fill all fields for gallery
			$this->category_id = $g['gallery_category_id'];
			$this->gallery_path = $g['gallery_path'];
			$this->name = $g['name'];
			$this->description = $g['description'];
			$this->created_date = $g['created_date'];
			$this->sort = $g['sort'];
			$this->is_active = $g['is_active'];
			$this->is_special = $g['is_special'];
			$this->lang = $g['lang'];
			
			$sql = "
				SELECT * 
				FROM gallery_pictures AS gp
				INNER JOIN gallery_pictures_trans AS gpt
				ON gp.picture_id = gpt.fk_picture_id
				AND gpt.lang = '". $this->lang ."'
				AND gp.fk_gallery_id = ". $this->gallery_id ."
			";
			$result = mysql_query($sql); echo mysql_error();
			if (mysql_error() == '') {
				while($p = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$pictureObj = new Picture(
					"gallery_pictures",
					"gallery_id",
					$this->gallery_id,
					$p['picture_id'],
					$p['path'],
					$p['name'],
					$p['description'],
					$p['sort'],
					"../",
					$this->gallery_thumbnail_sizes[0]					
				);
				$pictureObj->setUpLanguages($this->lang_arr, $this->lang);
				$this->picture_arr[] = $pictureObj;
				}
			}
			
		}
	}
	
	
	function addGalleryCategory() {
		$sql = "
			INSERT INTO gallery_category (
			gallery_category_id,
			sort
			)
			VALUES (
			NULL,
			'". addslashes($this->category_sort) ."'
			)	
		";
		//dumper($sql);
		$result = mysql_query($sql);
		echo mysql_error();
		if (mysql_error() == '') {
			$this->category_id = mysql_insert_id();
			//insert same values for all other languages 
			//if there is not already inserted gallery category
			@reset($this->lang_arr);
			foreach($this->lang_arr as $lng) {
				$sql_check = "
					SELECT * 
					FROM gallery_category_trans 
					WHERE lang = '$lng' 
					AND fk_gallery_category_id = '$this->category_id'
				";
				//dumper($sql_check);
				$result = mysql_query($sql_check);echo mysql_error();
				if(mysql_fetch_array($result, MYSQL_ASSOC) == '') {
					$sql_insert_lang = "
						INSERT INTO gallery_category_trans (
						fk_gallery_category_id,
						name,
						description,
						lang
						)
						VALUES (
						". $this->category_id .",
						'". addslashes($this->category_name) ."',
						'". addslashes($this->category_description)."',
						'". $lng."'
						)
					";
					//dumper($sql_insert_lang);
					$result = mysql_query($sql_insert_lang);
					echo mysql_error();
				}
			}
		}
		else {
			return false;
		}
	}
	
	function getGalleryCategory() {
		$sql = "
			SELECT *
			FROM gallery_category gc 
			INNER JOIN gallery_category_trans gct
			ON gc.gallery_category_id = gct.fk_gallery_category_id
			WHERE gc.gallery_category_id = '". $this->category_id ."'
			AND gct.lang = '". $this->lang ."'
		";
		
		$result = mysql_query($sql);echo mysql_error();
		if (mysql_error() == '') {
			$r = mysql_fetch_array($result, MYSQL_ASSOC);
			//fill all fields for gallery
			$this->category_name = $r['name'];
			$this->category_description = $r['description'];
			$this->category_sort = $r['sort'];
		}
	}
	
	/*
	 * This function is for updateing Gallery Category
	 */
	function updateGalleryCateogry() {
		$sql = "
			UPDATE gallery_category
			SET
			sort = '". addslashes($this->category_sort) ."'
			WHERE gallery_category_id = ". $this->category_id ."
		";
		$result = mysql_query($sql);
		echo mysql_error();
		if (mysql_error() == '') {
			$sql = "
				UPDATE gallery_category_trans
				SET
				name = '". addslashes($this->category_name) ."',
				description = '". addslashes($this->category_description) ."'
				WHERE fk_gallery_category_id = ". $this->category_id ."
				AND lang = '". $this->lang ."'
			";
			$result = mysql_query($sql);
			echo mysql_error();
			if (mysql_error() == '') 
				return true;
			else
				return false;
		}
		else {
			return false;
		}
	}
	/**
	 * Function return number of galleries for 
	 * gallery category
	 * 
	 * @return int
	 */
	
	function countGalleriesForGalleryCategory() {
		$where = "AND g.gallery_category_id = ". $this->category_id;
		$number = $this->getGalleryNumber($where);	
	}
	
	function deleteGalleryCategory() {
			$sql = "
				DELETE 
				FROM gallery_category 
				WHERE gallery_category_id = ". $this->category_id ."
			";
			//dumper($sql);
			$result = mysql_query($sql); echo mysql_error();
			if ($result) {
				$sql = "
					DELETE 
					FROM gallery_category_trans 
					WHERE fk_gallery_category_id = ". $this->category_id ."
				";
				$result = mysql_query($sql); echo mysql_error();
				if ($result) 
					return true;
				else
					return false;
			}
			else 
				return false;
	}

	function setUpLanguages($lang_arr, $lang) {
		$this->lang_arr = $lang_arr;
		$this->lang = $lang;		
	}
	
	function getPictures() {
		
		$sql = "
			
		";
	}
	
	function getGalleryNumber($where) {
		$sql = "
			SELECT count(*) 
			FROM gallery AS g
			INNER JOIN gallery_trans AS gt
			ON g.gallery_id = gt.fk_gallery_id
			WHERE 1=1
			AND gt.lang = '". $this->lang ."'
			$where
		";
		//dumper($sql);
		$result = mysql_query($sql);
		echo mysql_error();
		return mysql_result($result, 0, 0);		 
	}
	
	function getGalleryPictureNumber($where) {
		$sql = "
			SELECT count(*)
			FROM gallery_pictures AS gp
			INNER JOIN gallery_pictures_trans AS gpt
			ON gp.picture_id = gpt.fk_picture_id
			WHERE 1=1
			AND gpt.lang = '". $this->lang ."'
			$where
		";
		$result = mysql_query($sql);
		echo mysql_error();
		return mysql_result($result, 0, 0);	
	}
	
	function getGalleryCategoryNumber($where) {
		$sql = "
			SELECT count(*)
			FROM gallery_category AS gc
			INNER JOIN gallery_category_trans AS gct
			ON gc.gallery_category_id = gct.fk_gallery_category_id
			WHERE 1=1
			AND gct.lang = '". $this->lang ."'
			$where
		";
		
		$result = mysql_query($sql); echo mysql_error();
		return mysql_result($result, 0, 0);
	}
	
}

?>