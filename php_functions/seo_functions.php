<?php
function articles_seo_url($params=""){
	$articles_seo_url = '';
	$title = text_for_link($params['title']);
	if(empty($title) || empty($params['articles_id'])){
		$articles_seo_url = "";
	}else{
		if(SEOURLS){
			$articles_seo_url = BASE_URL . $_SESSION['lang'] . "/events/" . strtolower($title) . "/" . $params['articles_id'] . "/";
		}else{
			$articles_seo_url = "index.php?section=articles&subsection=view&articles_id=" . $params['articles_id'] . "	";
		}
	}
	return $articles_seo_url;
}

function product_seo_url($params=""){
	$product_seo_url = '';
	$title = text_for_link($params['title']);
	if(empty($title) || empty($params['product_id'])){
		$product_seo_url = "";
	}else{
		
		if(SEOURLS){
			$product_seo_url = $title."-product" .$params['product_id'].".html";
		}else{
			$product_seo_url = "index.php?section=product&subsection=single_product&product_id=" . $params['product_id'] . "	";
		}
	}
	return $product_seo_url;
}

function page_seo_url($params="", &$smarty){
	$page_seo_url = '';
	//$title = text_for_link($params['title']);
	if(empty($title) || empty($params['page_id'])){
		$page_seo_url = "";
	}else{
		if(SEOURLS){
			$page_seo_url = BASE_URL . $_SESSION['lang'] . "/" . $title ;
		}else{
			$page_seo_url = "index.php?section=page&subsection=show_page&page_id=" . $params['page_id'] . "";
		}
	}
	
	return $page_seo_url;
}


function _page_seo_url($title, $page_id){
	$page_seo_url = '';
	//$title = text_for_link($title);
	if(empty($title) || empty($page_id)){
		$page_seo_url = "";
	}else{
		if(SEOURLS){
			$page_seo_url = BASE_URL . $_SESSION['lang'] . "/" . $title ;
		}else{
			$page_seo_url = "index.php?section=page&subsection=show_page&page_id=" . $page_id . "";
		}
	}
	
	return $page_seo_url;
}

function _functionality_page_seo_url($title, $page_id){
	$page_seo_url = '';
	//$title = text_for_link($title);
	

			$sql = "SELECT link FROM page WHERE id=". $page_id ." AND type='functionality'";
			$result = mysql_query($sql);
			
			if($result && mysql_num_rows($result)) {
				$r = mysql_fetch_array($result, MYSQL_ASSOC);
				if(SEOURLS){
					$page_seo_url = BASE_URL . $_SESSION['lang'] . "/" . $title;
				}
			}else{
				$page_seo_url = "index.php";
			}
			
	
	return $page_seo_url;
}

function products_seo_url($params="", &$smarty){
	$service_seo_url = '';
	$title = text_for_link($params['title']);

	if(empty($title) || empty($params['product_id'])){
		$service_seo_url = "";
	}else{
		
		if(SEOURLS){
			$service_seo_url = BASE_URL . $_SESSION['lang'] . "/" . $title."-s".$params['product_id']."-single-service.html";
		}else{
			$service_seo_url = "index.php?section=product&subsection=single_product&product_id=". $params['product_id'] ." ";
		}
	}
	
	return $service_seo_url;
}

function gallery_album_seo_url($params=""){
	$gallery_album_seo_url = '';
	$title = text_for_link($params['title']);
	if(empty($title) || empty($params['gallery_id'])){
		$gallery_album_seo_url = "";
	}else{
		if(SEOURLS){
			$gallery_album_seo_url = BASE_URL . $_SESSION['lang'] . "/gallery/" . strtolower($title) . "/" . $params['gallery_id'] . "/";
		}else{
			$gallery_album_seo_url = "index.php?section=gallery&subsection=single_gallery&gallery_id=" . $params['gallery_id'] . "";
		}
		
	}
	
	return $gallery_album_seo_url;
}
?>