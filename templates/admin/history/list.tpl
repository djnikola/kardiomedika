<script language="javascript">

function set_order(order) {
  var f = document.forms['history_list'];
  var o = f.elements['data[order]'];

  if (o.value == order) {
  	order = order.replace(/,/g,' desc,');
    order = order + ' desc';
  }

  o.value = order;

  f.elements['submit[filter]'].click();
}

</script>
<form name="history_list" action="index.php?section=history&subsection=list" method="post" enctype="multipart/form-data" class="forms">
<input type="hidden" name="data[order]" value="{[$ORDER]}">

<h1>{[$labels.history]}</h1>


	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="grid_table">
         <tr class="table_header">
             <td colspan="5">
              Filter
             </td>
         </tr>
        <tr class="table_row">
		<td>
			<label>{[$labels.title]}:</label><br/>
			<input type="text" name="filter[caption_part]" value="{[$CAPTION_PART]}" class="input_skin_1" style="width:210px;"/>
                </td>
<!--		<td>
			<label>{[$labels.from]}:</label><br/>
            <input type="text" name="filter[publish_date_from]" id="publish_date_from" value="{[$PUBLISH_DATE_FROM]}" class="input_skin_1" style="width:80px;"/>
			<img src="../templates/images/admin/icons/calendar.png" onclick="displayCalendar(document.getElementById('publish_date_from'),'dd/mm/yyyy',this)">
		</td>
		<td>
			<label>{[$labels.to]}:</label><br/>
			<input type="text" name="filter[publish_date_to]" id="publish_date_to" value="{[$PUBLISH_DATE_TO]}" class="input_skin_1" style="width:80px;"/>
			<img src="../templates/images/admin/icons/calendar.png" onclick="displayCalendar(document.getElementById('publish_date_to'),'dd/mm/yyyy',this)">
		</td>-->
		
<!--		<th>
			<label>{[$labels.type]}:</label><br/>
			<select name="filter[history_type]"  class="select_skin_1">
			<option value="">{[$labels.any]}</option>
			{[$dropdown_history_type]}
			</select>
		</th>-->
		
<!--		<td>
			<label>{[$labels.active]}:</label><br/>
			<select name="filter[is_active]"  class="select_skin_1">
			<option value="">{[$labels.any]}</option>
			{[$dropdown_is_active]}
			</select>
		</td>		-->
	</tr>
	<tr class="table_row">
		<td colspan="5">
		<input type="submit" name="submit[filter]" value="{[$labels.search]}" class="button_skin_1" />
		</td>
	</tr>
	</table>

<br />

	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="grid_table">
        <tr class="table_header">
            <td colspan="6">
            {[$labels.list]}
            </td>
        </tr>
		<tr class="table_row">
			<th class="right_border" width="40%">
				<a href="#" onClick="set_order('ht.caption');return false;" class="white_link">{[$labels.title]}</a>
			</th>
			
			<th class="right_border" width="30%" >
				{[$labels.date]}
			</th>
<!--			<th class="right_border" width="10%">
				<a href="#" onClick="set_order('n.history_type');return false;" class="white_link">{[$labels.type]}</a>
			</th>
			
			<th class="right_border" width="5%" >
				<a href="#" onClick="set_order('n.is_active ');return false;" class="white_link">{[$labels.active]}</a>
			</th>-->
			
			<th width="30%" align="center">
				{[$labels.action]}
			</th>
		</tr>
	
	{[foreach from=$admin_history_list item=new]}	
	<tr class="table_row">
		<td>
		{[$new.caption]}
		</td>
		
		<td>
		{[$new.create_date]}
		</td>
		
<!--		<td align="center">
		{[$new.history_type]}
		</td>
		
		<td align="center">
		{[$new.is_active]}
		</td>-->
		
		<td align="center">
		{[checkUserPrivileges permission=permission section="history" subsection="new"]}
        {[if $permission == 1]}
		<a href="index.php?section=history&subsection=new&history_id={[$new.history_id]}" class="button_skin_1" >{[$labels.edit]}</a>
		{[/if]}
		{[checkUserPrivileges permission=permission section="history" subsection="delete"]}
        {[if $permission == 1]}
		<a href="index.php?section=history&subsection=delete&history_id={[$new.history_id]}" onclick="return confirm('{[$labels.are_you_sure]}?');" class="button_skin_1">{[$labels.delete]}</a>
		{[/if]}
				
		</td>
	</tr>
	{[/foreach]}
	
	{[if isset($no_result)]}
	<tr  class="table_row">
		<td align="center" colspan="5">
		{[$no_result]}
		</td>
	</tr>
	{[/if]}
	
	<tr class="table_row">
		<td colspan="5">
		<input type="button"  value="{[$labels.add]}" onclick="location.href='index.php?section=history&subsection=new'" class="button_skin_1" />
		</td>
	</tr>
	
</table>
<br />
<table width="100%" style="font-size: 12px;">
	<tr>
		<td class="paging"  align="center" height="25" colspan="6">
			<input type="button" value=" &lt; " ONCLICK="elements['data[page]'].value='{[$PREV]}';submit();" class="button_skin_1">&nbsp;&nbsp;
			{[$PAGE]} / <span style="display: inline; clear: none; width: 23px; text-align: center;">{[$PAGES]}</span>
			&nbsp;&nbsp;<input type="button" value=" &gt; " ONCLICK="elements['data[page]'].value='{[$NEXT]}';submit();" class="button_skin_1">
		</td>
	</tr>
</table>


</form>