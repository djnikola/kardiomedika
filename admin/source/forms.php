<?php

switch ($subsection){	

	default:
	case "contact_list":
	saveReturnPoint();
	$data = &$_REQUEST['data'];
	$filter = &$_REQUEST['filter'];
	
	#searching conditions
	#--------------------------------------------------------------------	
	$where = array();

	//date transformation	
	$smarty->assign(array(
		"NAME" => "$filter[name]",
		"EMAIL" => "$filter[email]",
		"PHONE" => "$filter[phone]", 
		"SUBJECT" => "$filter[subject]", 
		"MESSAGE" => "$filter[message]", 
	));

	$where = array();
	if ($filter['name']) $where[] = " name LIKE '%".addslashes($filter['name'])."%' ";
	if ($filter['email']) $where[] = " email LIKE '%".addslashes($filter['email'])."%' ";
	if ($filter['phone']) $where[] = " phone LIKE '%".addslashes($filter['phone'])."%' ";
	if ($filter['subject']) $where[] = " subject LIKE '%".addslashes($filter['subject'])."%' ";
	if ($filter['message']) $where[] = " message LIKE '%".addslashes($filter['message'])."%' ";

	if(count($where)){
		$where = "WHERE ".join(" AND \n",$where);
	} else {
	  $where = "";
	}
	#------------------------------------------------------------------------------

 //order by generation
 
	if (@$data['order'] == ''){
		$data['order'] = " contact_us_id DESC ";
	}
	$smarty->assign("ORDER", $data['order']);
	
	if (@$data['page'] == ''){
		$data['page'] = 0;
	}
  $order_by = " ORDER BY ".$data['order']."";
    
  //paging
	$result = "
		SELECT count(*) 
		FROM contact_us
		$where"
	;
	$result=mysql_query($result);

  if ($result && mysql_num_rows($result)) { 
    $total = mysql_result($result, 0, 0);	
    $per_page = 10;
    $pages = ceil($total / $per_page);
    if ($data['page'] > $pages)
      $data['page'] = $pages;
    if ($data['page'] <= 0) 
      $data['page'] = 1;
    $limit_sql = "LIMIT ".($data['page']-1)*$per_page.",$per_page";
  }
  $smarty->assign(array("TOTAL"  => "$total",
                     "PAGES"  => "$pages",
                     "PAGE"   => "$data[page]",
                     "NEXT"   => $data['page']+1,
                     "PREV"   => $data['page']-1,
                     "PER_PAGE" => $per_page,
  ));
  
	$all_contacts = array();
	$contacts_obj = new Contact();
	$all_contacts = $contacts_obj->get_all_contacts($where, $limit_sql, $order_by);

	
	$for_output = array();
	if(count($all_contacts)){
		foreach ($all_contacts as $contact){
			$contact['created'] = fromsqldate($contact['created'], "d.m.Y");
			if($contact['message']){
			$contact['message'] = cuttext($contact['message'], 150);
			}
			
			$for_output[] = $contact;
		}
		}else{
			$smarty->assign("no_result", $labels['no_results']);
		}
		$smarty->assign('contacts', $for_output);
        $template = "admin/forms/admin_contact_list.html";
	break;
	
	case "contact_new":
	$submit = &$_REQUEST['submit'];
	$data = &$_REQUEST['data'];
	$contact_us_id = &$_REQUEST['contact_us_id'];
	$contact_obj = new Contact();
	
	if(isset($contact_us_id) && $contact_us_id > 0){
			$contact_obj->contact_us_id = $contact_us_id;
			$contact_obj->get();
	}

	if(@$submit['save']){
		$errors = array();
		
		if(!count($errors)){
			$contact_obj->notice = $data['notice'];
			// ako nema gresaka snimi ili update
			if($contact_us_id){
				$contact_obj->update();
				_redirect("index.php?section=forms&subsection=contact_list");
			}
		}
	}		
	
	
	if(@$submit['cancel']){
		_redirect("index.php?section=forms&subsection=contact_list");
	}
	
	$smarty->assign('contact', $contact_obj);
	$template = "admin/forms/admin_contact_new.tpl";
	break;
	
	case "contact_delete":	
		$sql = "DELETE FROM contact_us WHERE contact_us_id = ".$_REQUEST['contact_us_id']."";
		mysql_query($sql);
		$template = "admin/forms/admin_contact_list.html";
	break;

}