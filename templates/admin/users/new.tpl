
<form action="index.php?section=users&subsection=new" method="post">
<input type="hidden" name="user_id" value="{[$user->user_id]}">
<h1>{[$labels.add]}</h1>
		<table align="left" width="100%" cellpadding="0" cellspacing="0" border="0" class="grid_table">
			
			<tr class="table_header">
				<td colspan="2">
				User data
				</td>
			</tr>
						
			{[if !$user->user_id]}
			<tr class="table_row">
				<td width="120px">
				<label>{[$labels.username]}:*</label>
				</td>
				<td>
				<input type="text" name="data[username]" value="{[$user->username]}" class="input_skin_1">
				</td>
			</tr>			
			<tr class="table_row">
				<td>
				<label>{[$labels.pass]}:* {[$user->user_id]}</label>
				</td>
				<td>
				<input type="text" name="data[password]" value="" class="input_skin_1">
				</td>
		
			</tr>
			<tr class="table_row">
				<td>
				<label>{[$labels.ver_pass]}:*</label>
				</td>
				<td>
				<input type="text" name="data[password_ver]"  class="input_skin_1">
				</td>
		
			</tr>
			{[else]}
			<tr class="table_row">
				<td width="120px">
				<label>{[$labels.username]}:*</label>
				</td>
				<td>
				<strong>{[$user->username]}</strong>
				<input type="hidden" name="data[username]" value="{[$user->username]}" class="input_skin_1" />
				</td>		
			</tr>
			<tr class="table_row">
				<td>&nbsp;
				</td>
				<td>
				<a href="index.php?section=users&subsection=change_pass&user_id={[$user->user_id]}" class="button_skin_1">{[$labels.change_pass]}</a>
				</td>
			</tr>
			{[/if]}
			<tr class="table_row">
				<td>
				<label>{[$labels.name]}:*</label>
				</td>
				<td>
				<input type="text" name="data[first_name]" value="{[$user->first_name]}" class="input_skin_1">
				</td>
			</tr>
			<tr class="table_row">
				<td>
				<label>{[$labels.surname]}:*</label>
				</td>
				<td>
				<input type="text" name="data[last_name]" value="{[$user->last_name]}"class="input_skin_1">
				</td>
			</tr>
			<tr class="table_row">
				<td>
				<label>Email:*</label>
				</td>
				<td>
				<input type="text" name="data[email]" value="{[$user->email]}" class="input_skin_1">
				</td>
		
			</tr>
			
			<tr class="table_row">
				<td>
				<label>{[$labels.user_role]}:</label>
				</td>
				<td>
				<select name="data[fk_group_id]" class="select_skin_1">
				<option value="1" {[if $user->fk_group_id == 1]}SELECTED{[/if]}>Administrator</option>
				<option value="2" {[if $user->fk_group_id == 2]}SELECTED{[/if]}>Moderator</option>
				</select>
				</td>
			</tr>

			<tr class="table_row">
				<td colspan="2">
				<input type="submit" name="submit[save]" value="{[$labels.save]}" class="button_skin_1">&nbsp;
				<input type="submit" name="submit[cancel]" value="{[$labels.cancel]}" class="button_skin_1">
				</td>
			</tr>
			
		</table>

</form>