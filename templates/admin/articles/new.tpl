<script language="javascript" type="text/javascript" src="../external/tiny/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/java_scripts/tiny.js"></script>
<form action="index.php?section=articles&subsection=new" method="post" enctype="multipart/form-data">
<input type="hidden" name="articles_id" value="{[$article->articles_id]}">
<input type="hidden" name="data[image_path]" value="{[$image]}">
<input type="hidden" name="data[image_name]" value="{[$image_name]}"> 

	<h1>{[$labels.add_edit]}</h1>
		<table align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="grid_table">
		
			<tr class="table_header">
			    <td colspan="2">
			    {[$labels.data]}
			    </td>
			</tr>
			<tr class="table_row">
				<td>
				<label>{[$labels.title]}:*</label>
				</td>
				<td>
                    <input type="text" name="data[caption]" value="{[$article->caption]}" class="input_skin_1" />
				</td>
			</tr>
			 
			<input type="hidden" name="data[articles_type]" value="{[$article->articles_type]}"/>
			<tr>
				<td >
				<label>{[$labels.active]}:</label>
				</td>
				<td>
					<select name="data[is_active]" class="select_skin_1" style="width: 50px;">
					{[$dropdown_is_active]}
					</select>
				</td>
			</tr>
                        
                        <tr>
				<td>
				<label>{[$labels.article_type]}:</label>
				</td>
				<td>
                                    <select name="data[articles_type]" class="select_skin_1">
                                        <option></option>
                                        {[$dropdown_articles_type]}
                                    </select>
				</td>
			</tr>
			
			<tr>
				<td>
				<label>{[$labels.date]}:</label>
				</td>
				<td>
				<input type="text" name="data[publish_date]" id="publish_date" value="{[$article->publish_date|date_format:"%d/%m/%y"]}" class="input_skin_1" />
				<img src="../templates/images/admin/icons/calendar.png" onclick="displayCalendar(document.getElementById('publish_date'),'dd/mm/yyyy',this)">
				<strong>dd/mm/yyyy</strong>
				</td>
			</tr>
			<tr>
				<td >
				<label>{[$labels.picture]}:</label>
				</td>
				<td>
				{[if $image]}
                <a href="../{[$image]}" target="_blank"><img src="../{[$image]}" alt="" border="0" width="150"/></a><br/>
				<label><input type="checkbox" name="data[remove_picture]" value="1"/>Remove </label><br/>
				{[/if]}
				<input type="file" name="image"  />
				</td>
			</tr>
			<tr class="table_row">
				<td>
				<label>{[$labels.location]}:*</label>
				</td>
				<td>
                    <input type="text" name="data[location]" value="{[$article->location]}" class="input_skin_1" />
				</td>
			</tr>
            
                    <input type="hidden" name="data[highlights]" value="" class="input_skin_1" />
				
        </table>
        <table align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="grid_table"> 
            <tr {[if $article->articles_type == 'termine']}style="display:none;"{[/if]} id="articles" class="removable">

                <td colspan="2">
                <label id="input">{[$labels.content]}:*</label><br>
                <textarea id="html_2" name="data[content]" >{[$article->content]}</textarea>

                <script language="javascript" type="text/javascript">
                //<!--
                    applyTiny("html_2","{[$WEBROOT]}", 520, 300, lang='{[$lang]}');
                //-->
                </script>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                <input type="submit" name="submit[save]" value="{[$labels.save]}" class="button_skin_1" />&nbsp;
                <input type="submit" name="submit[cancel]" value="{[$labels.cancel]}" class="button_skin_1" />
                </td>
            </tr>

        </table>

</form>
