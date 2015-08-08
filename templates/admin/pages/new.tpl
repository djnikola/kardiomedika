<script language="javascript" type="text/javascript" src="../external/tiny/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/java_scripts/tiny.js"></script>

<script type="text/javascript">

function openSection(section_id){
	var container = document.getElementById('info_container');
    var trs = container.getElementsByTagName("tr");

    for(var i=0;i<trs.length;i++)
    {
        if(trs[i].style  && trs[i].className == 'removable') {
            if(trs[i].id == section_id){
                trs[i].style.display = 'block';
            }else{
                trs[i].style.display = 'none';
            }
        }
    }
	
}

</script>

<form action="index.php?section=pages&subsection=new" method="post">
<input type="hidden" name="page_id" value="{[$page_id]}">
<input type="hidden" name="data[parent]" value="{[$parent]}">
	
	<h1>{[$labels.add_edit]}</h1>
		<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" class="grid_table" id="info_container">
			<tr class="table_header">
			    <td colspan="4">
                    {[$labels.page]}
			    </td>
			</tr>
            {[if $parent == 0]}
            <tr>
			<td><label>Menu Position:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <select name="data[show_place]" class="select_skin_1">
                    <option value="first" {[if $show_place == 'first']}selected=selected{[/if]}>{[$labels.main_navigation]}</option>
                    <option value="second" {[if $show_place == 'second']}selected=selected{[/if]}>{[$labels.footer_links]}</option>
                    <option value="forth" {[if $show_place == 'forth']}selected=selected{[/if]}>{[$labels.pediatrics]}</option>
                    <option value="third" {[if $show_place == 'third']}selected=selected{[/if]}>{[$labels.neurology]}</option>
                    <option value="fifth" {[if $show_place == 'fifth']}selected=selected{[/if]}>{[$labels.psychiatry]}</option>
                </select>
			</td>
            </tr>
            {[else]}
            <input type="hidden" name="data[show_place]" value="{[$show_place]}" />
            {[/if]}
			<tr>
				<td id="input">
				<label>{[$labels.title]}:</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="data[caption]" value="{[$caption]}" class="input_skin_1" id="caption">
				</td>
		
			</tr>
            
            <tr>
				<td id="input">
				<label>{[$labels.visible_in_menus]}: </label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <labels>{[$labels.yes]}<input type="radio" name="data[navigation]" value="yes" class="input_skin_1" {[if $navigation == 'yes']}checked{[/if]} ></labels>
                    <labels>{[$labels.no]}<input type="radio" name="data[navigation]" value="no" class="input_skin_1" {[if $navigation == 'no']}checked{[/if]} ></labels>
				</td>
		
			</tr>
                       
            
            
			{[*if $parent != 0]} 
			<tr class="prominent">
				<td id="input">
				<b>{[$labels.parent]}:</b>&nbsp;&nbsp;&nbsp;&nbsp;
				<select name="data[parent]" style="width: 200px;">
				{[html_options options=$page_tree selected=$parent]}
				</select>
				</td>
			</tr>
			{[/if*]}	
            
                  
			<tr> 
				<td>
				<label id="input"><b>{[$labels.content]}:*</b></label><br>
			
				<textarea id="html_content" name="data[content]">{[$content]}</textarea>
				<script language="javascript" type="text/javascript">
				//<!--
					applyTiny("html_content","{[$WEBROOT]}",520, 300, lang='{[$lang]}');
				//-->
				</script>
				
				</td>
			</tr>
			
			<tr>
				<td>
				<input type="submit" name="submit[save]" value="{[$labels.save]}" class="button_skin_1">&nbsp;
				<input type="submit" name="submit[cancel]" value="{[$labels.cancel]}" class="button_skin_1">
				</td>
			</tr>
			
		</table>

	
</form>
