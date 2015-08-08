<script language="javascript">
<!--
function set_order(order) {
  var f = document.forms['gallery_category_list'];
  var o = f.elements['data[order]'];

  if (o.value == order) {
  	order = order.replace(/,/g,' desc,');
    order = order + ' desc';
  }

  o.value = order;

  f.elements['submit[filter]'].click();
}

//-->
</script>
<form name="gallery_category_list" action="index.php?section=gallery&subsection=list_gallery_category" method="post" enctype="multipart/form-data" class="forms">
<input type="hidden" name="data[order]" value="{[$ORDER]}"/>

	<div class="filter_top">
	</div>
	<div class="filter_content clearfix">
	<h1>{[$labels.gallery_category_list]}</h1>
<table align="left" width="98%" cellpadding="3" cellspacing="0" border="0">
	<tr>
		<td id="input" width="200px;"><label>{[$labels.name]}:</label><br/>
		<input type="text" name="filter[name_part]" value="{[$NAME_PART]}"/></td>
		</td>		
	</tr>
	<tr>
		<td id="input"><br/>
		<input type="submit" name="submit[filter]" value="{[$labels.search]}" class="button_submit_search"/>
		
		<!-- <input type="button"  value="{[$labels.button_add]}" onclick="location.href='index.php?section=gallery&subsection=new_gallery_category'" class="button_submit_add"/> -->
		
		</td>
	</tr>
</table>
	</div>
	<div class="filter_bottom">
	</div>	
	<div class="content_top">
	</div>
	<div class="content_content clearfix">

<table align="center" width="95%" cellpadding="3" cellspacing="0" border="0" class="grid_list">

	<tr>
		<th width="95%">
		<a href="#" onClick="set_order('gct.name');return false;" class="white_link">{[$labels.name]}</a>
		</th>		
		
		<!-- <th width="45%" >		<a href="#" onClick="set_order('gc.sort');return false;" class="white_link">
		{[$labels.sort]}
		</a> </th> -->

				
		<th width="5%" align="center">
		{[$labels.action]}
		</th>
	</tr>
	{[foreach from=$gallery_category_list item=gallery_category]}	
	<tr class='{[cycle values="selected, noselected"]}'>
		<td>
		<a href="index.php?section=gallery&subsection=new_gallery_category&gallery_category_id={[$gallery_category.category_id]}">
			<b style="font-size: 12px;">{[$gallery_category.name]}</b></a>
		</td>
		
		<!-- <td class="list" align="center">
		{[$gallery_category.sort]}
		</td> -->
		
		
		<td align="center">
		<a title="{[$labels.edit]}" class="actionEdit" href="index.php?section=gallery&subsection=new_gallery_category&gallery_category_id={[$gallery_category.gallery_category_id]}"><span>{[$labels.edit]}</span></a>
		
		<!-- <a title="{[$labels.delete]}" class="actionDelete" href="index.php?section=gallery&subsection=delete_gallery_category&gallery_category_id={[$gallery_category.gallery_category_id]}" onclick="return confirm('{[$labels.are_you_sure]}?');"><span>{[$labels.delete]}</span></a> -->
		</td>
	</tr>
	{[/foreach]}
	{[if isset($no_result)]}
	<tr>
		<td align="center" colspan="4">
		{[$no_result]}
		</td>
	</tr>
	{[/if]}
	<tr>
		<td class="paging"  align="center" height="25" colspan="6">
			<input type="button" value=" &lt; " ONCLICK="elements['data[page]'].value='{[$PREV]}';submit();" class="button_paging">&nbsp;&nbsp;
			{[$TOTAL]} {[$labels.found]},&nbsp;&nbsp; {[$labels.page]} <input type="hidden" size="3" value="{[$PAGE]}" name="data[page]" class="inputstyle" style="border: 0px; width: 23px;text-align: center;"> {[$PAGE]} {[$labels.of]} <span style="displ1ay: inline; clear: none; width: 23px; text-align: center;">{[$PAGES]}, {[$labels.with]} {[$PER_PAGE]} {[$labels.per_page]}</span>
			&nbsp;&nbsp;<input type="button" value=" &gt; " ONCLICK="elements['data[page]'].value='{[$NEXT]}';submit();" class="button_paging">
		</td>
	</tr>
</table>
	</div>
	<div class="content_bottom">
	</div>
</form>