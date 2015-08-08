<script language="javascript">

function set_order(order) {
  var f = document.forms['page_list'];
  var o = f.elements['data[order]'];

  if (o.value == order) {
  	order = order.replace(/,/g,' desc,');
    order = order + ' desc';
  }

  o.value = order;

  f.elements['submit[filter]'].click();
}


</script>
<form name="page_list" id="page_list" action="index.php?section=pages&subsection=list" method="post" enctype="multipart/form-data" class="forms">
<input type="hidden" name="data[order]" value="{[$ORDER]}">
<input type="hidden" name="filter[show_place]" value="{[$SHOW_PLACE]}">
<input type="hidden" name="parent" value={[$PARENT]} />

	<h1>{[$labels.pages]}</h1>
    
	<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" class="grid_table">
		<tr class="table_header">
            <td colspan="6" >          
            Filter
            </td>
        </tr>
        
        <tr>
            <td>
                <label>{[$labels.title]}:</label><br />
                <input type="text" name="filter[caption]" value="{[$CAPTION]}" class="input_skin_1" style="width:200px;"/>
            </td>
            {[$SHOW_PLACE]}
            {[if $PARENT == 0]}
			<td>
                <label>Menu Position:</label><br />
                <select name="filter[show_place]" onchange="document.forms['page_list'].submit();" class="select_skin_1">
                    <option value="first" {[if $SHOW_PLACE == 'first']}selected=selected{[/if]}>{[$labels.main_navigation]}</option>
                    <option value="second" {[if $SHOW_PLACE == 'second']}selected=selected{[/if]}>{[$labels.footer_links]}</option>
                    <option value="forth" {[if $SHOW_PLACE == 'forth']}selected=selected{[/if]}>{[$labels.pediatrics]}</option>
                    <option value="third" {[if $SHOW_PLACE == 'third']}selected=selected{[/if]}>{[$labels.neurology]}</option>
                    <option value="fifth" {[if $SHOW_PLACE == 'fifth']}selected=selected{[/if]}>{[$labels.psychiatry]}</option>
                </select>
			</td>
            {[/if]}
		</tr>
        
		<tr>
            <td colspan="5">
			<input type="submit" name="submit[filter]" value="{[$labels.search]}" class="button_skin_1"/>
			</td>
		</tr>
       
	</table>
	<br />
    
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="grid_table">
        <tr class="table_header">
            <td colspan="6" >          
            {[foreach from=$page_path item=p]}
				<a href="index.php?section=pages&subsection=list&parent={[$p.page_id]}&filter[show_place]={[$SHOW_PLACE]}" class="breadcrumb">{[$p.page_name]} &nbsp;»</a>
			{[/foreach]}
            </td>
        </tr>
		<tr class="table_row">
			<th width="40%" align="left" class="right_border">
				<a href="#" onClick="set_order('pt.caption');return false;">{[$labels.title]}</a>
			</th>
				
			<th width="30%" align="center" class="right_border">
				<a href="#" onClick="set_order('p.subpage_num');return false;"></a>
			</th>
			
			<th width="30%" align="center" class="right_border">
				{[*$labels.action*]}
			</th>
		</tr>
				
		{[foreach from=$pages item=page]}	
		<tr class='{[cycle values="selected, noselected"]}'>
			<td>
				<strong>{[$page.caption]}</strong>
			</td>
			<td align="center">
				{[if $page.type != 'functionality' && $page.level == 0  && $SHOW_PLACE != 'first']}
                <a href="index.php?section=pages&subsection=list&parent={[$page.id]}&filter[show_place]={[$SHOW_PLACE]}" > <strong>{[$labels.edit]} ({[$page.subpage_num]}) subpages</strong> </a>
				{[/if]}
			</td>
			
			<td align="center">
				{[if $page.type != 'functionality' && $page.type != 'static']}
				<a title="{[$labels.edit]}" href="index.php?section=pages&subsection=new&page_id={[$page.id]}&show_place={[$SHOW_PLACE]}" class="button_skin_1">{[$labels.edit]}</a>
					{[if $page.parent != 0]}
						<a title="{[$labels.delete]}" href="index.php?section=pages&subsection=delete&page_id={[$page.id]}" onclick="return confirm('{[$labels.are_you_sure]}?');" class="button_skin_1">{[$labels.delete]}</a>
					{[/if]}
				{[else]}
				&nbsp;
				{[/if]}
			</td>
		</tr>
		{[/foreach]}
				{[if isset($no_result)]}
				<tr>
					<td align="center" colspan="5">
					{[$no_result]}
					</td>
				</tr>
				{[/if]}
                    
				<tr>
					<td colspan="5">
						 {[*if $PARENT != 0*]}           
						<input type="button"  value="{[$labels.add]}" onclick="location.href='index.php?section=pages&subsection=new&parent={[$PARENT]}&show_place={[$SHOW_PLACE]}'"class="button_skin_1"/>
						{[*/if*]}
					</td>
				</tr>
				
			</table>
			
    
            <table width="100%">
            <tr class="table_row">
                <td class="paging"  align="center" height="25" colspan="6">
                    <input type="button" value=" &lt; " ONCLICK="elements['data[page]'].value='{[$PREV]}';submit();" class="button_skin_1">&nbsp;&nbsp;
                    <input type="hidden" size="3" value="{[$PAGE]}" name="data[page]" class="inputstyle" style="border: 0px; width: 23px;text-align: center;"> {[$PAGE]} / <span style="displ1ay: inline; clear: none; width: 23px; text-align: center;">{[$PAGES]}</span>
                    &nbsp;&nbsp;<input type="button" value=" &gt; " ONCLICK="elements['data[page]'].value='{[$NEXT]}';submit();" class="button_skin_1">
                </td>
            </tr>
            </table>

</form>