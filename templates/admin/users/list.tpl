<script language="javascript">

function set_order(order) {
  var f = document.forms['user_list'];
  var o = f.elements['data[order]'];

  if (o.value == order) {
  	order = order.replace(/,/g,' desc,');
    order = order + ' desc';
  }

  o.value = order;

  f.elements['submit[filter]'].click();
}
</script>
<form name="user_list" action="index.php?section=users" method="post" enctype="multipart/form-data" class="forms">
<input type="hidden" name="data[order]" value="{[$ORDER]}">

<h1>{[$labels.users]}</h1>


<br />

	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="grid_table">
                        <tr class="table_header">
                            <td colspan="6">
                            {[$labels.list]}
                            </td>
                        </tr>
                        <tr>
                            <th class="right_border">
                            	<a href="#" onClick="set_order('u.username');return false;">{[$labels.username]}</a>
                            </th>
                            <th class="right_border">
                            	<a href="#" onClick="set_order('u.first_name');return false;">{[$labels.name]}</a>
                            </th>
                            <th class="right_border">
                            	<a href="#" onClick="set_order('u.last_name');return false;">{[$labels.surname]}</a>
                            </th>
                            
                            <th class="right_border">
                            <a href="#" onClick="set_order('u.fk_group_id');return false;">{[$labels.user_role]}</a>
                            </th>
                            
                            
                            <th width="120px">
                            	<a href="#">{[$labels.action]}</a>
                            </th>
                        </tr>
                        
                        {[foreach from=$users_list item=user]}
                        <tr class="table_row">
                            <td>
                            <strong>{[$user.username]}</strong>
                            </td>
                            <td>
                            {[$user.first_name]}
                            </td>
                            <td>
                            {[$user.last_name]}
                            </td>
                            <td>
                            {[ if $user.fk_group_id == 1]}
                            Administrator
                            {[else if $user.fk_group_id == 2]}
                            Moderator
                            {[/if]}
                            </td>
                            
                            <td align="center">
                            {[checkUserPrivileges permission=permission section="users" subsection="new"]}
                            {[if $permission == 1]}
                            <a class="button_skin_1" href="index.php?section=users&subsection=new&user_id={[$user.user_id]}">{[$labels.edit]}</a>
                            {[/if]}
                            {[checkUserPrivileges permission=permission section="users" subsection="delete"]}
                            {[if $permission == 1]}
							<a class="button_skin_1" href="index.php?section=users&subsection=delete&user_id={[$user.user_id]}" onclick="return confirm('{[$labels.are_you_sure]}?');">{[$labels.delete]}</a>
                            {[/if]}
                            </td>
                        </tr>
                        {[/foreach]}
                        
					    {[if isset($no_result)]}
						<tr>
							<td class="table_row" align="center" colspan="5">
							{[$no_result]}
							</td>
						</tr>
						{[/if]}
                        
                        <tr>
                        	<td class="table_row" colspan="6"><input type="button"  value="{[$labels.add]}" onclick="location.href='index.php?section=users&subsection=new'" class="button_skin_1" /></td>
                        </tr>

                    </table>


	
<table width="100%">
	<tr>
		<td class="paging"  align="center" height="25" colspan="6">
			<input type="button" value=" &lt; " ONCLICK="elements['data[page]'].value='{[$PREV]}';submit();" class="button_skin_1">&nbsp;&nbsp;
			{[$PAGE]} / <span style="displ1ay: inline; clear: none; width: 23px; text-align: center;">{[$PAGES]}</span>
			&nbsp;&nbsp;<input type="button" value=" &gt; " ONCLICK="elements['data[page]'].value='{[$NEXT]}';submit();" class="button_skin_1">
		</td>
	</tr>
</table>

</form>