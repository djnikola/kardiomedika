<script language="javascript">
<!--
function set_order(order) {
  var f = document.forms['list_gallery_pictures'];
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
<form name="list_gallery_pictures" action="index.php?section=gallery&subsection=list_gallery_pictures" method="post" enctype="multipart/form-data" class="forms">
<input type="hidden" name="data[order]" value="{[$ORDER]}"/>
<input type="hidden" name="data[page]" value="{[$PAGE]}"/>
<input type="hidden" name="gallery_id" value="{[$gallery_id]}"/>
	<h1>{[$labels.pictures]}</h1>

	<table align="center" width="100%" cellpadding="3" cellspacing="0" border="0" class="grid_table">
		<tr class="table_header">
		    <td colspan="4">
		    {[$labels.picture_list]}
		    </td>
		</tr>
		<tr>
			<th width="20%" class="right_border">
			{[$labels.picture]}
			</th>
			
	
					
			<th width="5%" class="right_border">
			<a href="#" onClick="set_order('gp.sort');return false;" class="white_link">{[$labels.sort]}</a>
			</th>
			<th width="5%" align="center">
			{[$labels.action]}
			</th>
		</tr>
		{[foreach from=$admin_gallery_picture_list item=picture]}	
		<tr class='{[cycle values="selected, noselected"]}'>
			<td align="left">
			<img src="../{[$picture->thumbnail_path]}"  class="listing_thumb_images"/></a>
			</td>
			
		
			
			<td align="center">
			{[$picture->sort]}
			</td>
			<td align="center">
			<a title="{[$labels.delete]}" class="button_skin_1" href="index.php?section=gallery&subsection=delete_gallery_picture&picture_id={[$picture->picture_id]}&gallery_id={[$gallery_id]}" onclick="return confirm('{[$labels.are_you_sure]}?');"><span>{[$labels.delete]}</span></a>
			</td>
		</tr>
		
		{[/foreach]}
		<tr>
			<td colspan="5">
				<input type="button"  value="{[$labels.add]}" onclick="location.href='index.php?section=gallery&subsection=new_gallery_pictures&gallery_id={[$gallery_id]}'" class="button_skin_1">
			</td>
		</tr>
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
				{[$PAGE]} / <span style="displ1ay: inline; clear: none; width: 23px; text-align: center;">{[$PAGES]}</span>
				&nbsp;&nbsp;<input type="button" value=" &gt; " ONCLICK="elements['data[page]'].value='{[$NEXT]}';submit();" class="button_paging">
			</td>
		</tr>
	</table>

</form>