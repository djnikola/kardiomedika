
function getCategoryList(category_id){

	prms = 'action=get_category_list';
         
	// get ajax request...
	var ajax = new Ajax.Request(
		'ajax_server.php', {
			method: 'post', 
			parameters: prms,
			onSuccess: function setCategoryResult(request){
			// grab xml of options...
			var xml = request.responseXML;
			var search_input = document.getElementById('search_input');
			var respNode = xml.getElementsByTagName('response');
			var inner_content = '';
			var selected_opt = '';
			var categories = respNode[0].getElementsByTagName('category');
			inner_content += '<select class="search_input" onchange="getSubCategoryList(this)" name="filter[category_id]">';
			inner_content += '<option value=""></option>';
			for (k=0; k<categories.length; k++){
				var name_tags = categories[k].getElementsByTagName('name');
				var id_tags = categories[k].getElementsByTagName('id');
				if(id_tags[0].firstChild.nodeValue == category_id){
				selected_opt = 'selected';
				}else{
					selected_opt = '';
				}
				inner_content += "<option value='"+id_tags[0].firstChild.nodeValue+"' " + selected_opt + ">"+name_tags[0].firstChild.nodeValue+"</option>";
			}
			
			inner_content += "</select>";
			search_input.innerHTML = inner_content;

		}
		});
}




function getSubCategoryList(e, category_id){
	
	if(!category_id){
		if(e.selectedIndex){
			var selected = e.selectedIndex;
			var category_id = e.options[selected].value;
		}else{
			var category_id = 0;
		}
	
	}else{
		var category_id = category_id;
	}

	prms = 'action=get_subcategory_list&category_id='+category_id+'';
         
	// get ajax request...
	var ajax = new Ajax.Request(
		'ajax_server.php', {
			method: 'post', 
			parameters: prms,
			onComplete: function setSubCategoryResult(request){
			// grab xml of options...
			var xml = request.responseXML;
			var search_sub_input = document.getElementById('search_sub_input');
			var respNode = xml.getElementsByTagName('response');
			var inner_content = '';
			var categories = respNode[0].getElementsByTagName('subcategory');
			if(categories.length > 0){
				inner_content += '<select class="search_input" name="filter[s_subcategory_id]">';
				inner_content += '<option value=""> - Select one subcategory - </option>';
				for (k=0; k<categories.length; k++){
					var name_tags = categories[k].getElementsByTagName('name');
					var id_tags = categories[k].getElementsByTagName('id');
					inner_content += "<option value='"+id_tags[0].firstChild.nodeValue+"'>"+name_tags[0].firstChild.nodeValue+"</option>";
				}
				inner_content += "</select>";

				search_sub_input.innerHTML = inner_content;
			}else{
				search_sub_input.innerHTML = '<select class="search_input"><option value=""> - There is no subcategory - </option></select>';
			}

		}
		});
}


