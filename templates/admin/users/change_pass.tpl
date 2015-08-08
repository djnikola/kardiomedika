
<form action="index.php?section=users&subsection=change_pass" method="post">
<input type="hidden" name="user_id" value="{[$user_id]}">
<h1>{[$labels.change_pass]}</h1>
<table align="left" cellpadding="0" cellspacing="0" border="0" width="100%" class="grid_table">	
	
	<tr class="table_header">
		<td colspan="2">
		{[$labels.username]}: <i>{[$user_data.username]}</i>
		</td>
	</tr>
	
	<tr class="table_row">
		<td width="120px">
		<label>{[$labels.old_pass]}:*</label>
		</td>
		<td>
		<input type="text" name="data[old_password]" value="" class="input_skin_1" />
		</td>
	</tr>
	<tr class="table_row">
		<td>
		<label>{[$labels.pass]}*</label>
		</td>
		<td>
		<input type="text" name="data[password]" value="" class="input_skin_1" />
		</td>
	</tr>
	<tr class="table_row">
		<td>
		<label>{[$labels.ver_pass]}:*</label>
		</td>
		<td>
		<input type="text" name="data[password_ver]" class="input_skin_1" />
		</td>
	</tr>

	<tr class="table_row">
		<td colspan="4">
		<input type="submit" name="submit[save]" value="{[$labels.save]}" class="button_skin_1">
		<input type="submit" name="submit[cancel]" value="{[$labels.cancel]}" class="button_skin_1">
		</td>
	</tr>
	
</table>
</form>