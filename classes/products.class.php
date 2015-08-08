<?php

class Products {
      
    var $id;
    var $brand_id;
    var $category_id;
    var $new;
    var $name;
    var $type;
    var $description;
    var $image_path;
    var $url;
    
    function Products(
	$id = '', 
        $brand_id = '', 
        $category_id = '', 
        $new = '',  
        $name = '',
        $type = '', 
        $description = '',
        $image_path = '', 
        $url = ''
	){
			
		$this->id = $id;
		$this->brand_id = $brand_id;
		$this->category_id = $category_id;
		$this->new = $new;
		$this->name = $name;
		$this->type = $type;
		$this->description = $description;
		$this->image_path  = $image_path;
		$this->url  = $url;
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
                                short_content='".addslashes($this->short_content)."',
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
		$this->short_content = $articles['short_content'];
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
        short_content = '".addslashes($this->short_content)."',
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
    
    function find() {
        $sql = "SELECT p.* , pt.id AS  tr_id , pt.name AS tr_name, pt.description AS tr_description FROM product AS p
        LEFT JOIN product_tr as pt ON (p.id = pt.translation_id AND pt.language='".$_SESSION['lang']."' )
        WHERE p.id = '$this->id' ";
        $result = mysql_query($sql);
        $products = mysql_fetch_array( $result, MYSQL_ASSOC);
		$this->id = $products['id'];
		$this->brand_id = $products['brand_id'];
		$this->name = $products['name'];
		$this->new = $products['new'];
		$this->type = $products['type'];
		$this->description = $products['description'];
		$this->image_path =  $this->getPath('products',$products['id'] , $products['image_path'], false);
    }


    function create_public_articles_list(){
	global $db;
	
	$sql = "SELECT * FROM articles AS n
	LEFT JOIN articles_trans as nt ON nt.fk_articles_id = n.articles_id
	WHERE n.publish_date <= now() AND n.is_active = 'yes' ORDER BY n.articles_id LIMIT 0,5";
	$result = mysql_query($sql);
	return mysql_fetch_array( $result, MYSQL_ASSOC);
    }
    
    /**
     * Get data rows
     *
     * @param int $page
     * @param int $rows
     * @param array $parameters
     * @return stdClass $response
     */
    public function getData($where='', $limit_sql='', $order_by=''){
        global $db;
        $sql = "SELECT `p`.* FROM `product` AS `p`
                LEFT JOIN product_tr as pt ON (p.id = pt.translation_id AND pt.language='".$_SESSION['lang']."' )
                $where  $order_by $limit_sql"; 
        
        $result = mysql_query($sql);
        $products = array();
        if($result && mysql_num_rows($result)){
            while ($n = mysql_fetch_array($result, MYSQL_ASSOC)){
                $n['url'] = $this->getProductViewUrl($n['id']);
                $n['image_path'] = $this->getPath('products',$n['id'] , $n['image_path'], true);
                $products[] = $n;
            }
            return $products;
        }else{
            return array();
        }

    }
    /**
     * Get data rows
     *
     * @param int $page
     * @param int $rows
     * @param array $parameters
     * @return stdClass $response
     */
    public function getBrand($where='', $limit_sql='', $order_by=''){
        global $db;
//        SELECT `b`.* FROM `product_brand` AS `b`
//        LEFT JOIN `product_category_brand` AS `r` ON r.brand_id = b.id ORDER BY `b`.`order_num` asc
        $sql = "SELECT `b`.* FROM `product_brand` AS `b`
                LEFT JOIN product_brand_tr as bt ON (b.id = bt.translation_id AND bt.language='".$_SESSION['lang']."' )
                LEFT JOIN `product_category_brand` AS `r` ON r.brand_id = b.id 
                $where  $order_by $limit_sql"; 
        
        $result = mysql_query($sql);
        $brands = array();
        if($result && mysql_num_rows($result)){
            while ($n = mysql_fetch_array($result, MYSQL_ASSOC)){
                $n['url'] = $this->getProductUrl($n['id']);
                $n['image_path'] = $this->getPath('brand',$n['id'] , $n['image_path'], false);
                $brands[] = $n;
            }
            return $brands;
        }else{
            return array();
        }

    }
     
    protected function getPath($entiti, $id,$image, $thumb = false){
        if($thumb)
            return "/content/".$entiti."/".$id."/thumbnail/".$image;
        else
           return  "/content/".$entiti."/".$id."/".$image;
    }
    
    protected function getProductViewUrl($productId){
        return '/'.$_SESSION['lang'].'/products/product-view/id/'.$productId."/";
    }
    
    
    public function getProductUrl($brandId){
        return '/'.$_SESSION['lang'].'/products/product-list/brand_id/'.$brandId."/";
    }
    
    /**
     * Get data rows
     *
     * @param int $page
     * @param int $rows
     * @param array $parameters
     * @return stdClass $response
     */
    public function getCategory($where='', $limit_sql='', $order_by=''){
        global $db;
//        SELECT `b`.* FROM `product_brand` AS `b`
//        LEFT JOIN `product_category_brand` AS `r` ON r.brand_id = b.id ORDER BY `b`.`order_num` asc
        $sql = "SELECT `b`.* FROM `product_category` AS `pc`
               LEFT JOIN `product_category_brand` AS `r` ON r.brand_id = b.id 
                $where  $order_by $limit_sql"; 
        
        $result = mysql_query($sql);
        $brands = array();
        if($result && mysql_num_rows($result)){
            while ($n = mysql_fetch_array($result, MYSQL_ASSOC)){
                $brands[] = $n;
            }
            return $brands;
        }else{
            return array();
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