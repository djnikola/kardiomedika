<?php

$meta = array(
    'title' => '',
    'keywords' => '',
    'description' => '',
);
$right = '';
$left = '';
$dinamicInclude = '';
$real_page_title = $labels['events'];

$data = &$_REQUEST['data'];
$type = &$_REQUEST['type'];
$brand_id = &$_REQUEST['brand_id'];
$category_id = &$_REQUEST['category_id'];
$filter = &$_REQUEST['filter'];

$smarty->assign("CURR_LANG", $lang);

switch ($subsection) {
    case "index":
        $template = "products/index.tpl";
        break;
    case "category-list":
        $template = "products/index.tpl";
        break;
    case "brand-list":
        $products_obj = new Products('', $_REQUEST['category_id']);
        $where = array();
        if (isset($category_id) && $category_id != '') {
            $where[] = " r.category_id = '" . $category_id . "' ";
        }
        
        if (count($where)) {
            $where = " WHERE " . join(" AND \n", $where);
        } else {
            $where = "";
        }
        
        if (@$data['order'] == '') {
            $data['order'] = "b.order_num asc";
        }
        if (@$data['page'] == '') {
            $data['page'] = 1 ;
        }
        $order_by = "ORDER BY " . $data['order'] . "";
        
        $per_page = 50;
        
        $limit_sql = "LIMIT " . ($data['page'] - 1) * $per_page . ",$per_page"; 
        $brands = $products_obj->getBrand($where, $limit_sql, $order_by);
        $smarty->assign("brands", $brands);
        $template = "products/brand_list.tpl";
        break;
    case "product-list":
        $products_obj = new Products('', $_REQUEST['brand_id']);
        
        $where = array();
        if (isset($type) && $type != '') {
            $where[] = " p.type = '" . $type . "' ";
        }
        if (isset($brand_id) && $brand_id != '') {
            $where[] = " p.brand_id ='" . $brand_id . "' ";
        }
        
        if (count($where)) {
            $where = " WHERE " . join(" AND \n", $where);
        } else {
            $where = "";
        }
        
        if (@$data['order'] == '') {
            $data['order'] = "p.id desc";
        }
        if (@$data['page'] == '') {
            $data['page'] = 1 ;
        }
        $order_by = "ORDER BY " . $data['order'] . "";
        
        $per_page = 50;
        
        $limit_sql = "LIMIT " . ($data['page'] - 1) * $per_page . ",$per_page";
        
        $products = $products_obj->getData($where, $limit_sql, $order_by);
        $smarty->assign("products", $products);
        $template = "products/products_list.tpl";
        break;
    case "product-view":
        $products_obj = new Products($_REQUEST['id']);
        $products_obj->find();
        $products_obj->image_thumbnail = make_thumbnail_url($products_obj->image_path, $config['products_thumbnails'][0]);

        if (empty($products_obj->meta_title)) {
            $meta['title'] = $products_obj->name;
        } else {
            $meta['title'] = $products_obj->meta_title;
        }

        $real_page_title = $products_obj->name;
        
        $smarty->assign("single_products", $products_obj);
        $template = "products/view.tpl";
        break;
    default:
     
        break;
}
?>