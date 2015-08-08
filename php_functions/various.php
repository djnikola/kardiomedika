<?php

function saveReturnPoint(){
	$_SESSION['return_point'] = array();
	$_SESSION['return_point'] = $_REQUEST;
}

function _redirect($default_url){
	if(isset($_SESSION['return_point']) && $_SESSION['return_point'] != ''){
		$location = "Location: index.php?section=" . $_SESSION['return_point']['section'] . "&subsection=" . $_SESSION['return_point']['subsection'] . "&redirect=true&SSID=".$_SESSION['SSID']."";	
		header($location);
	}else{
		header("Location: " . $default_url . "&SSID=".$_SESSION['SSID']);
	}
	
}

function restoreReturnPoint(){
	if(isset($_SESSION['return_point']) && $_SESSION['return_point'] != ''){
		$_REQUEST = $_SESSION['return_point'];
	}
		unset($_SESSION['return_point']);	
}


function checkUserPrivilegesSmarty($params="", &$smarty){
	
		$returnValue = 0;
		
		if(isset($_SESSION["privilegies"])){

			$sessions = $_SESSION["privilegies"];
			foreach ($sessions as $session){
				
				$sessionValue = $session["section"];
				$sub_sessionValue = $session["sub_section"];
				$permissions = $session["value"];
				
				if($sessionValue == $params['section'] && $sub_sessionValue == $params['subsection']){
					if($permissions == 1){
						$returnValue = 1;
					}
				}
			}
		}
	$smarty->assign($params["permission"], $returnValue);
}


function insert_array_in_base($table_name,$search_array){
	global $db;
	$keys = array();
	$values = array();
	$sql = "INSERT INTO ".$table_name." (";

	foreach ($search_array as $k => $v){
		$keys[] = $k;
	}

	$num = count($keys);
	for($i = 0;$i<$num-1;$i++){
		$sql .= " ".$keys[$i].",";
	}

	$sql .= " ".$keys[$num-1].") VALUES (";

	foreach ($search_array as $v){
		$values[] = $v;
	}


	$num = count($values);
	for($i = 0;$i<$num-1;$i++){
		$sql .= " '".$values[$i]."',";
	}

	$sql .= " '".$values[$num-1]."') ";
	$db->Execute($sql);


}

//Gives more information about SQL error if occured - to use replace "echo mysql_error()" with "mysql_err(__FILE__,__LINE__)"
function mysql_err($file,$line)
{
	$error=mysql_error();
	if (!empty($error))
		echo "MySql error in <strong>".basename($file)."</strong> on line <strong>$line</strong>: \"<em>$error</em>\".";
}

function replace_invalid_chars($s){
  $s = str_replace("ï¿½","&quot;",$s);
  $s = str_replace("ï¿½","&quot;",$s);
  $s = str_replace("ï¿½","'",$s);
  return $s;
}

function text2seo_url ($text, $translations=array())
{
	return @eregi_replace("[^0-9a-z]","-",strtr ( strip_tags(html_entity_decode($text)), $translations ));
}

//extract file extension
function extract_file_extension($file_name){
	$path_parts = pathinfo($file_name);
	return $path_parts['extension'];
}

//change file extension
function change_file_extension($file_name,$new_extension){
  $path_parts = pathinfo($file_name);
  $new_name = basename($path_parts['basename'],"." . $path_parts['extension'])  . "." . $new_extension;
  if($path_parts['dirname'] && $path_parts['dirname'] != ".")
  	$new_name = $path_parts['dirname'] . "/" . $new_name;
  return $new_name;
}

//display thumb
function display_thumb(&$data,&$file_config,$thumb_size){
  global $config,$tpl;

  $tpl->define_dynamic($file_config['section_thumb'],$file_config['section_name']);

	$file_path = $data[$file_config['input_file_path']];
	if(is_file($file_config['root_dir'] . $file_path)){
		$thumbnail = make_thumbnail_url($file_config['root_dir'] . $file_path,$thumb_size);
		if(is_file($thumbnail)){
			$tpl->assign(array(
													strtoupper($file_config['thumb_var'])				=> $thumbnail,
													strtoupper($file_config['input_file_path'])	=> $file_path
			));
		}
		else
			$tpl->clear_dynamic($file_config['section_thumb']);
	}
	else
		$tpl->clear_dynamic($file_config['section_thumb']);
}

//upload save tmp
function upload_save_tmp(&$data,&$file_config,&$errors, $image='true'){ 
  global $config;

  $upload_file = &$_FILES[$file_config['input_file']];

  //dumper($upload_file['tmp_name']);
  if ($upload_file['tmp_name']) {
	  //check errors
	  //PHP upload errors
	  //$errors = array();
	  if($upload_file['error'] > 0){
	    $errors[$file_config['error_name']] = 1;
		  switch($upload_file['error']){
		    case 1:
		    case 2:
			  	$errors[$file_config['error_name']] = "The uploaded file exceeds the maximum file size.";
			  	break;
		    case 3:
			  	$errors[$file_config['error_name']] = "The uploaded file was only partially uploaded.";
			  	break;
			  case 4:
			  	$errors[$file_config['error_name']] = "No file was uploaded.";
			  	break;
			  default:
			  	$errors[$file_config['error_name']] = "Error uploading file.";
			  	break;
			}
		}

		//custom size error
//		if($file_config['max_size'] && $upload_file['size'] > $file_config['max_size']){
//			$errors[$file_config['error_name']] .= " The uploaded file exceeds the maximum file size $file_config[max_size] bytes.";
//		}
		//custom extension error
		if($file_config['extensions']){
		  $exts = explode(",",$file_config['extensions']);
		  $path_parts = pathinfo($upload_file['name']);
		  
		  if(!in_array(strtolower($path_parts['extension']),$exts)){
				$errors[] .= "Aloved file extensions are: $file_config[extensions] .";
			}
		}
		if(count($errors) == 0){
			$dest = $file_config['tmp_dir'] . "/" . session_id();
			//dumper($dest);
			if(!is_dir($file_config['root_dir'] . $dest)){
				mkdir($file_config['root_dir'] . $dest);
				chmod($file_config['root_dir'] . $dest,0777);
			}
			$dest .= "/" . time() . "_" . basename($upload_file['tmp_name']);

			@move_uploaded_file($upload_file['tmp_name'],$file_config['root_dir'] . $dest);
			$data[$file_config['input_file_path']]= $dest;
			$data[$file_config['input_file_name']]= stripslashes($upload_file['name']);
		}
	}
}

//upload save
function upload_save(&$data,&$file_config,$id = "", $time="") { 
	global $config;
	//create dest folders
	$dest_dir = $file_config['upload_dir'];
	if(!is_dir($file_config['root_dir'] . $dest_dir)){
	  mkdir($file_config['root_dir'] . $dest_dir);
	  chmod($file_config['root_dir'] . $dest_dir,0777);
	}
	if($id){
	  $dest_dir .= "/" . ($id % 10);
	  if(!is_dir($file_config['root_dir'] . $dest_dir)){
			mkdir($file_config['root_dir'] . $dest_dir);
			chmod($file_config['root_dir'] . $dest_dir,0777);
	  }
	  $dest_dir .= "/" . $id;
	  if(!is_dir($file_config['root_dir'] . $dest_dir)){
			mkdir($file_config['root_dir'] . $dest_dir);
			chmod($file_config['root_dir'] . $dest_dir,0777);
	  }
	}
	//distinction between update with new file and without
	$file_name = serbian2latin(text_for_link($data[$file_config['input_file_name']]));
	if(!empty($file_name)){
	  if($id){ 
	  	$path= $dest_dir . "/" . $id . "_" . $time . "_" . basename($file_name);
	  }else{
	  	$path= $dest_dir . "/" . $time . "_". basename($file_name);
	  }
		
		copy($file_config['root_dir'] . $data[$file_config['input_file_path']],$file_config['root_dir'] . $path);
		unlink($file_config['root_dir'] . $data[$file_config['input_file_path']]);
		system("rm -rf \"$file_config[root_dir]".str_replace("\"","\\\"",dirname($data[$file_config['input_file_path']])).'/thumbnails/*/'.str_replace("\"","\\\"",basename($data[$file_config['input_file_path']])."\""));
		chmod($file_config['root_dir'] . $path,0777);
		if(!empty($config[$file_config['thumbnail_sizes']])){
			make_thumbnails($file_config['root_dir'] . $path, $config[$file_config['thumbnail_sizes']]);
		}
		if(isset($file_config['upload_original']) && $file_config['upload_original'] === false) {
			unlink($file_config['root_dir'] . $path);
		}
		
		$data[$file_config['input_file_path']] = $path;
	}
	return $data[$file_config['input_file_path']];
}



function creatingUploadPath($file_name, &$file_config, $id = "", $time="") {
	if($time == "") $time = time();
	$dest_dir = $file_config['upload_dir'];
	$path = '';
	if(!is_dir($file_config['root_dir'] . $dest_dir)) {
	  mkdir($file_config['root_dir'] . $dest_dir);
	  chmod($file_config['root_dir'] . $dest_dir,0777);
	}
	if($id){
	  $dest_dir .= "/" . ($id % 10);
	  if(!is_dir($file_config['root_dir'] . $dest_dir)) {
			@mkdir($file_config['root_dir'] . $dest_dir);
			@chmod($file_config['root_dir'] . $dest_dir,0777);
	  }
	  $dest_dir .= "/" . $id;
	  if(!is_dir($file_config['root_dir'] . $dest_dir)) {
			@mkdir($file_config['root_dir'] . $dest_dir);
			@chmod($file_config['root_dir'] . $dest_dir,0777);
	  }
	}
	//distinction between update with new file and without
	if(!empty($file_name)){
	  if($id){ 
	  	$path= $dest_dir . "/" . $id . "_" . $time . "_" . basename($file_name);
	  }else{
	  	$path= $dest_dir . "/" . $time . "_". basename($file_name);
	  }
	}
	return $path;
}

/**
 * is unique permalink
 * @param type $id
 * @param type $value
 * @return type 
 */

function is_unique_permalink($caption, $page_id = 0){
	$page_id == 0 ? $sql = "SELECT COUNT(*) as not_unique FROM page_trans WHERE permalink='".$caption."' AND lang='".$_SESSION['admin_lang']."'" : $sql = "SELECT COUNT(*) as not_unique FROM page_trans WHERE permalink='".$caption."' AND lang='".$_SESSION['admin_lang']."' AND fk_page_id != $page_id";

	$res = mysql_query($sql);
	if($res && mysql_num_rows($res)){
		$count = mysql_fetch_array($res, MYSQL_ASSOC);
		if($count['not_unique']){
			return false;
		}else{
			return true;
		}
	}else{
		return false;
	}
		
}


function serbian2latin($text){
	$serbian = array('š'=>'s','đ'=>'d','ć'=>'c','č'=>'c','ž'=>'z');
	foreach($serbian as $ser=>$lat){
		$text = str_replace($ser,$lat, $text);
	}
	return $text;
	
}
  
function createPermaLinks($caption, $page_id = 0){
    $letters = array('Ä'=>'Ae','Ö'=>'Oe','Ü'=>'Ue','ä'=>'ae','ö'=>'oe','ü'=>'ue', 'Č'=>'c', 'č'=>'c', 'Ć'=>'c', 'ć'=>'c', 'Đ'=>'d', 'đ'=>'d', 'Š'=>'s', 'š'=>'s', 'Ž'=>'z', 'ž'=>'z');
    foreach($german_letters as $ger=>$lat){
        $caption = str_replace($ger,$lat, $caption);
    }
    $caption = text2seo_url(strtolower($caption));
    if(is_unique_permalink($caption, $page_id)){
        return  $caption;
    }else{
        return  $caption . "-" . rand(1,1000);
    }
}

#--------------------------------
#------- LOG_TEXT ---------------
#--------------------------------
function log_text($text,$file_name = "log.txt"){
  $handle = fopen ($file_name,"a");
  fwrite($handle,$text . "\n");
  fclose($handle);
}

#------------------------------
#----- GET_FIELD_TRANSLATION --
#------------------------------
function get_field_translation(&$l,$field,$lang) {
  global $config;
  $lsuf = "_$lang";

  if (empty($l[$field.$lsuf])) {
    if ($l[$field])
      return($l[$field]);
    else {
      @reset($config['languages']);
      while (list($k,$v) = @each($config['languages']))
       if ($l[$field."_".$k]) return($l[$field."_".$k]);
    }
  } else return($l[$field.$lsuf]);
}

//day of week 0-6 (Mon to Sun)
function get_day_of_week($time_stamp){
  $result = date("w",$time_stamp);
  if($result == 0)
    return 6;//Sunday
  else
    return $result - 1; //Monday to Saturday
}

//inc day (Increment day)
function inc_day($curr_time,$days){
  $time_arr = getdate($curr_time);
  return mktime(0,0,0,$time_arr['mon'],$time_arr['mday'] + $days,$time_arr['year']);
}


//send mail
function send_email($to,$subject,$message,$from,$headers,$params = array(), $errors) {
	$mail_params = "";
	if ($from) {
	  $headers .= "\nMIME-Version: 1.0";
	  $headers .= "\nContent-Type: text/html; charset=utf-8";
		$headers .= "\nFrom: $from";
		$headers .= "\nReturn-Path: $from";
		$headers = trim($headers);

		if (@eregi("[a-z0-9\_=\.\-]+\@([a-z0-9\_\-]+\.)+[a-z0-9\_]+",$from,$r))
		$mail_params = " -f $r[0] ";
	}

	$headers = @eregi_replace("[\n\r]+","\n",$headers);
	$message = str_replace("\r","",$message);

	$destination_emails=explode(";",$to);
	foreach($destination_emails as $i => $email_to){
		if(!@mail($email_to,$subject,$message,$headers,$mail_params));
			$errors[$email_to]=$email_to;
	}
	if(!count($errors))
		return true;
	else
		return false;

}


#---------------------------------
#---------- EXTEND_URL -----------
#---------------------------------
function extend_url($url) {
  if (!eregi("^http[s]?://",$url) && $url)
    return("http://".$url);
  else
    return($url);
}


#--------------------------------
#----- GET_PRIVATE_DIR ----------
#--------------------------------
function get_private_dir($id,$root,$create = TRUE){
  $curr_dir = $root;
  if($create && !is_dir($curr_dir)){
		@mkdir($curr_dir);
		@chmod($curr_dir,0777);
  }
  $curr_dir .= "/" . ($id % 10);
  if($create && !is_dir($curr_dir)){
		@mkdir($curr_dir);
		@chmod($curr_dir,0777);
  }
  $curr_dir .= "/" . $id;
  if($create && !is_dir($curr_dir)){
		@mkdir($curr_dir);
		@chmod($curr_dir,0777);
  }
  return $curr_dir;
}

#------------------------------------
#--------- REMOVE_EMPTY_ELEMENTS ----
#------------------------------------
function remove_empty_elements(&$a) {
  if (is_array($a)) {
    @reset($a);
    while (list($k,$v) = @each($a)) {
      if (is_array($v)) remove_empty_elements($a[$k]);
      else if ($v == "") {
        unset($a[$k]);
      }
    }
  }
}

function request_strip_slashes(&$arr) {
  global $config;

  if ($config['form_strip_slashes'] != "yes") return;
  while (list($k,$v) = each($arr)) {
    if (is_array($v)) request_strip_slashes($arr[$k]);
    else $arr[$k] = logikstripslashes($v);
  }
  reset($arr);
}

function get_valid_image_path($image,$size,$default) {
  global $config;

  if ($size == "default")
    $size = $default;

  if ($size == "original") return($image);
  else if ($image) return(dirname($image)."/thumbnails/$size/".rawurlencode(basename($image)) );
  else return("images/spacer.gif");
}

function text_snippet($text,$size) {
  if (strlen($text) < $size)
    return($text);
  else
    return(substr($text,0,$size)."...");
}

function text_for_link($text) {
	$text = serbian2latin($text);
  return(@eregi_replace('[^a-z0-9\.]+','-',$text));
}


function logikstripslashes($text) {
  global $config;
  if ($config["form_strip_slashes"] == "yes")
    return (stripslashes($text));
  else
    return $text;
}

function fromsqldate($date,$format) {
  if (@ereg("^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2}) ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",$date,$r)) {
    return(@date($format,mktime($r[4],$r[5],$r[6],$r[2],$r[3],$r[1])));
  } else if (@ereg("^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$",$date,$r)) {
    return(@date($format,mktime(0,0,0,$r[2],$r[3],$r[1])));
  } else if (@ereg("^([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})",$date,$r)) {
    return(@date($format,mktime($r[4],$r[5],$r[6],$r[2],$r[3],$r[1])));
  }
}


#------------------------------
#------- COMPLETE_URL ---------
#------------------------------
function complete_url($url) {
  if (!eregi('^http://',$url) && !eregi('^https://',$url))
    return("http://$url");
  else
    return($url);
}

function check_email($email) {
  return preg_match("/^[a-z0-9\_=\.\-]+\@([a-z0-9\_\-]+\.)+[a-z0-9\_]+$/",$email);
}

function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
↪'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
↪([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}


function check_url ( $url )
{
		$url = @parse_url($url);

		if ( ! $url) {
			return false;
		}

		$url = array_map('trim', $url);
		$url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port'];
		$path = (isset($url['path'])) ? $url['path'] : '';

		if ($path == '')
		{
			$path = '/';
		}

		$path .= ( isset ( $url['query'] ) ) ? "?$url[query]" : '';

		if ( isset ( $url['host'] ) AND $url['host'] != @gethostbyname ( $url['host'] ) )
		{
			if ( PHP_VERSION >= 5 )
			{
				$headers = @get_headers("$url[scheme]://$url[host]:$url[port]$path");
			}
			else
			{
				$fp = @fsockopen($url['host'], $url['port'], $errno, $errstr, 30);

				if ( ! $fp )
				{
					return false;
				}
				@fputs($fp, "HEAD $path HTTP/1.1\r\nHost: $url[host]\r\n\r\n");
				$headers = @fread ( $fp, 128 );
				@fclose ( $fp );
			}
			$headers = ( is_array ( $headers ) ) ? implode ( "\n", $headers ) : $headers;
			return ( bool ) preg_match ( '#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers );
		}
		return false;
}
function check_phone($phone) {
	return preg_match('/\\A[0-9- \\+\\(\\)]+\\z/', $phone);
}

function make_thumbnails2($image,$sizes = array("150x150")) {
  if (is_file($image)) {
    $name = basename($image);
    $dir = dirname($image);

   
    $itmp = @getimagesize($image);
    if (function_exists("imagecreatefromjpeg") && $itmp[2] == 2)
      $img = imagecreatefromjpeg($image);
    else if (function_exists("imagecreatefromgif") && $itmp[2] == 1) {
      $img = imagecreatefromgif($image);
      imagealphablending($img,FALSE);
      imagesavealpha($img,FALSE);
      $trans_color = imagecolortransparent($img);
      $gif = 1;
    } else
      return;
$img = imagecreatefromjpeg($image);

    if (!is_dir("${dir}/thumbnails")){
    	mkdir("${dir}/thumbnails",0777);
    	chmod("${dir}/thumbnails",0777);
    }
    
    for ($i=0;$i<count($sizes);$i++) {
      if (!is_dir("${dir}/thumbnails/$sizes[$i]")){
      	mkdir("${dir}/thumbnails/$sizes[$i]",0777);
      	chmod("${dir}/thumbnails/$sizes[$i]",0777);
      }
      
      $thumbnail = "${dir}/thumbnails/${sizes[$i]}/$name";

     
      list($nx,$ny) = @split("x",$sizes[$i]);
      $sx = $nx / imagesx($img);
      $sy = $ny / imagesy($img);

      $s = min($sx,$sy);

      $nx = (int)($s*imagesx($img));
      $ny = (int)($s*imagesy($img));

      if (function_exists("imagecreatetruecolor"))
        $nimg = imagecreatetruecolor($nx,$ny);
      else
        $nimg = imagecreate($nx,$ny);

      if (function_exists('imagecopyresampled'))
        imagecopyresampled($nimg,$img,0,0,0,0,$nx,$ny,imagesx($img),imagesy($img));
      else
        imagecopyresized($nimg,$img,0,0,0,0,$nx,$ny,imagesx($img),imagesy($img));

      if (@$gif) {
        imageJPEG($nimg,$thumbnail,85);
      } else
        imageJPEG($nimg,$thumbnail,85);
      imagedestroy($nimg);
    }
  }
}

function make_thumbnails($image,$sizes = array("150x150")) { 
  global $config;

  
  if (1) {
    make_thumbnails2($image,$sizes);
    return;
  }
  
  $name = basename($image);
  $dir = dirname($image);    
  if (!is_dir("${dir}/thumbnails")){
  	mkdir("${dir}/thumbnails",0755);
  	chmod("${dir}/thumbnails",0755);
  }
  for ($i=0;$i<count($sizes);$i++) {
    if (!is_dir("${dir}/thumbnails/$sizes[$i]")){
    	mkdir("${dir}/thumbnails/$sizes[$i]",0777);
    	chmod("${dir}/thumbnails/$sizes[$i]",0777);
    }
    $thumbnail = "${dir}/thumbnails/${sizes[$i]}/$name";
    system ("${config[convert_path]}convert -geometry $sizes[$i] \"${image}\" \"${thumbnail}\"");
    $image = $thumbnail; 
  }
}

function make_thumbnail_url($path,$size) {
  return(dirname($path)."/thumbnails/$size/".basename($path));
}

function remove_thumbnails($path, $sizes) {
  reset($sizes);
  while (list($k,$v) = each($sizes)) {
	@unlink(dirname($path)."/thumbnails/$v/".basename($path));
	@rmdir(dirname($path)."/thumbnails/$v");
	@rmdir(dirname($path)."/thumbnails");
	@rmdir(dirname($path));
  }
}

function image_resize ($image, $size)
{
  global $config;
	if (copy($image, $image.'.bak')) { // creating backup file

	  if ($config['make_thumbnails'] == "GD") {
//-----------
		  if (is_file($image)) {
		    $name = basename($image);
		    $dir = dirname($image);
		    $ii = getimagesize($image);
		    //echo serialize($ii);

		    if ($ii[2] == 2 && @function_exists(imagecreatefromjpeg)) {
		      $img = imagecreatefromjpeg($image);
		    } else if ($ii[2] == 1 && function_exists(imagecreatefromgif)) {
		      $img = imagecreatefromgif($image);
		    } else if ($ii[2] == 3 && function_exists(imagecreatefrompng)) {
		      $img = imagecreatefrompng($image);
		    } else if ($ii[2] == 6 && function_exists(imagecreatefromwbmp)) {
		      $img = imagecreatefromwbmp($image);
		    } else {
		      echo "NO GD Support <br>";
		      return;
		    }

	      list($nx,$ny) = split("x",$size);
	      $sx = $nx / imagesx($img);
	      $sy = $ny / imagesy($img);

	      $s = min($sx,$sy);

	      $nx = (int)($s*imagesx($img));
	      $ny = (int)($s*imagesy($img));

	      if (@function_exists(imagecreatetruecolor))
	        $nimg = imagecreatetruecolor($nx,$ny);
	      else
	        $nimg = imagecreate($nx,$ny);

	      if (function_exists('imagecopyresampled'))
	        imagecopyresampled($nimg,$img,0,0,0,0,$nx,$ny,imagesx($img),imagesy($img));
	      else
	        imagecopyresized($nimg,$img,0,0,0,0,$nx,$ny,imagesx($img),imagesy($img));

	      imageJPEG($nimg,$image,85);
	      imagedestroy($nimg);
		  }


//------------
	    return;
	  }

	  $name = basename($image);
	  $dir = dirname($image);
	  system ("$config[convert_path]convert -geometry $size \"${image}\" \"${image}\"");

	} else echo "Unable to create image backup file!";

}

#--------------------------------
#------ ADD_WORD -------
#--------------------------------
function add_word($word,&$words) {
  if (!empty($word))
    $words[] = $word;
}

#--------------------------------
#------ EXTRACT_KEYWORDS -------
#--------------------------------

function extract_keywords($keywords) {

// $state == 0 - Reading chars of word
// $state == 1 - reading chars inside "

  $words = array();
  $state = 0;
  $i=0;
  while ($i < strlen($keywords)) {
    $char = substr($keywords,$i,1);
    if ($state == 0) {
      if (eregi("[a-z0-9]",$char))
        $word = $word.$char;
      else if ($char == "\"") {
        add_word($word,$words);
        $word = "";
        $state = 1;
        $i++;
        continue;
      } else {
        add_word($word,$words);
        $word = "";
      }
    } else if ($state == 1) {
      if ($char != "\"")
        $word = $word.$char;
      else {
        add_word($word,$words);
        $word = "";
        $state = 0;
      }
    }
    $i++;
  }
  add_word($word,$words);
  return($words);
}

function create_keywords_condition($keywords,$fields,$type,$field_type = "or",$search_whole_words=FALSE) {
  $where_or = array();
  $where = array();
  $cnt = count($fields);
  $words = extract_keywords($keywords);
  reset($words);

  while (list($key,$val) = each($words)) {
    reset($fields);
    $where_or = array();
    for($i=0;$i<$cnt;$i++)
		{
			if ($search_whole_words)
      	$where_or[] = "$fields[$i] REGEXP '\[\[:<:\]\]$val\[\[:>:\]\]'";
      else
	      $where_or[] = "$fields[$i] like '%$val%'";

    }
    if (count($where_or))
      $where[] = "(".join(" $field_type ",$where_or).")";
  }
  if (count($where))
    return "".join(" $type ",$where)."";

}

#--------------------------------
#------ IS_WHOLE_NUMBER ---------
#--------------------------------
function is_whole_number($var){
  return (is_numeric($var)&&(intval($var)==floatval($var)));
}

#------------------------------
#--------- DATE CONVERTER from english format -----
#------------------------------
function date_converter_from_english_format($date){
	$tmpDate = split('/', $date);
	$new_date_format = (int)$tmpDate[2]."-".(int)$tmpDate[0]."-".(int)$tmpDate[1];
	if(checkdate((int)$tmpDate[0],(int)$tmpDate[1], (int)$tmpDate[2])){
		return $new_date_format;
	}else{
		return false;
	}
}
#------------------------------
#--------- DATE CONVERTER from serbian format -----
#------------------------------
function date_converter_from_serbian_format($date, $separator="/"){
	$tmpDate = explode($separator, $date);
	@$new_date_format = (int)$tmpDate[2]."-".(int)$tmpDate[1]."-".(int)$tmpDate[0];
	if(@checkdate((int)$tmpDate[1],(int)$tmpDate[0], (int)$tmpDate[2])){
		return $new_date_format;
	}else{
		return false;
	}
}

#------------------------------
#--- DATE CONVERTER FROM DB ---
#------------------------------
function date_converter_from_db($date = ""){
	
	if($date == ""){
		$date = date("Y-m-d");
	}
	
	$tmpDate = split('-', $date);
	$new_date_format = (int)$tmpDate[2]."/".(int)$tmpDate[1]."/".(int)$tmpDate[0];
	//if(checkdate((int)$tmpDate[2],(int)$tmpDate[1], (int)$tmpDate[0])){
		return $new_date_format;
	//}else{
	//	return '';
	//}
}

function cuttext($value, $length)
{   
    if(is_array($value)) list($string, $match_to) = $value;
    else { $string = $value; @$match_to = $value{0}; }

    @$match_start = stristr($string, $match_to);
    $match_compute = strlen($string) - strlen($match_start);

    if (strlen($string) > $length)
    {
        if ($match_compute < ($length - strlen($match_to)))
        {
            $pre_string = substr($string, 0, $length);
            $pos_end = strrpos($pre_string, " ");
            if($pos_end === false) $string = $pre_string."...";
            else $string = substr($pre_string, 0, $pos_end)."...";
        }
        else if ($match_compute > (strlen($string) - ($length - strlen($match_to))))
        {
            $pre_string = substr($string, (strlen($string) - ($length - strlen($match_to))));
            $pos_start = strpos($pre_string, " ");
            $string = "...".substr($pre_string, $pos_start);
            if($pos_start === false) $string = "...".$pre_string;
            else $string = "...".substr($pre_string, $pos_start);
        }
        else
        {       
            $pre_string = substr($string, ($match_compute - round(($length / 3))), $length);
            $pos_start = strpos($pre_string, " "); $pos_end = strrpos($pre_string, " ");
            $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
            if($pos_start === false && $pos_end === false) $string = "...".$pre_string."...";
            else $string = "...".substr($pre_string, $pos_start, $pos_end)."...";
        }

        $match_start = stristr($string, $match_to);
        $match_compute = strlen($string) - strlen($match_start);
    }
   
    return $string;
}

function is_emtpy_folder($folder){
   if(is_dir($folder) ){
       $handle = opendir($folder);
       while( (gettype( $name = readdir($handle)) != "boolean")){
               $name_array[] = $name;
       }
       foreach($name_array as $temp)
           $folder_content .= $temp;

       closedir($handle);//<--------moved this
       if($folder_content == "...") {
           return true;
       } else {
           return false;
       }
   }
   else
       return true; // folder doesnt exist
}

/**
 * Enter description here...
 *
 * @return unknown
 */

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

/**
 * Load Helper
 *
 * This function loads the specified helper file.
 *
 * @access	public
 * @param	mixed
 * @return	void
 */
function load_helper($helpers = array())
{
	if ( ! is_array($helpers))
	{
		$helpers = array($helpers);
	}

	foreach ($helpers as $helper)
	{		
		$helper = strtolower(str_replace(EXT, '', str_replace('_helper', '', $helper)).'_helper');

		$ext_helper = BASE_PATH.'php_functions/helpers/'.$helper.EXT;		
		if (file_exists($ext_helper))
		{
			include_once($ext_helper);
		}
		else
		{		
			dumper('Unable to load the requested file: helpers/'.$helper.EXT);
		}	
	}		
}

/**
 * my favorite function
 *
 * @param any type $data
 */
function dumper($data) {
    echo "<pre style=' width:100%; background:#C8C8C9; z-index:20;border-width:1px;border-style:dashed;border-size:1px;border-color:#ff0000;color:#000;'>";
    print_r($data);
    echo "</pre>";
}
function generatePaging($total, $per_page = 10, &$limit_sql, &$data){
	global $smarty;
	$pages = 1;
	if ($total) { 
	    $pages = ceil($total / $per_page);
	    if ($data['page'] > $pages)
	      	$data['page'] = $pages;
	    if ($data['page'] <= 0) 
	      	$data['page'] = 1;
	    $limit_sql = "LIMIT ".($data['page']-1)*$per_page.",$per_page";
  	}
	$smarty->assign(array(
		"TOTAL"  => "$total",
        "PAGES"  => "$pages",
        "PAGE"   => "$data[page]",
        "NEXT"   => $data['page']+1,
        "PREV"   => $data['page']-1,
        "PER_PAGE" => $per_page,
  	));
			
}

function generate_html_field($field_params=array()){
	
	$html_field = '';
	switch($field_params['field_type']){
		
		case 'text':
		default:
			$html_field = "<input type='text' "; 
			$html_field .= "name='";
			$html_field .= empty($field_params['array_name']) ? $field_params['name'] :   
					"data[" . $field_params['name'] . "]";
			$html_field .= "'";
			$html_field .= empty($field_params['id']) ? "" : " id='" . $field_params['id'] . "' ";
			$html_field .= empty($field_params['class']) ? "" : " class='" . $field_params['class'] . "' ";
			$html_field .= empty($field_params['size']) ? "" : " size='" . $field_params['size'] . "' ";
			$html_field .= empty($field_params['value']) ? "" : " value='" . $field_params['value'] . "' ";
			$html_field .= empty($field_params['size']) ? "" : " size='" . $field_params['size'] . "' ";
			$html_field .= " />";
			return $html_field;
		break;
		case 'textarea':
			$html_field = "<textarea "; 
			$html_field .= "name='"; 
			$html_field .= empty($field_params['array_name']) ? $field_params['name'] :   
					"data[" . $field_params['name'] . "]";
			$html_field .= "'";
			$html_field .= empty($field_params['id']) ? "" : " id='" . $field_params['id'] . "' ";
			$html_field .= empty($field_params['class']) ? "" : " class='" . $field_params['class'] . "' ";
			$html_field .= empty($field_params['size']) ? "" : " size='" . $field_params['size'] . "' ";
			$html_field .= " rows= 6 ";
			$html_field .= " cols= 50 ";
			$html_field .= ">";
			$html_field .= empty($field_params['value']) ? "" : "" . $field_params['value'] . "";
			$html_field .= " </textarea>";
			return $html_field;
		break;
		
	}
	
}


?>