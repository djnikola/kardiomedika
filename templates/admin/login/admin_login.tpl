<form action="index.php?section=login&subsection=login_action" method="post" class="admin_login_form">

				<table cellpadding="3"  cellspacing="3" border="0">
					<tr>
					<td><label>{[$labels.username]}:</label>
					<input  name="username" alt="username" type="text" class="input_skin_1" value="{[$smarty.post.username|default:'']}" /></td>
					</tr>
					
					<tr>
					<td><label>{[$labels.pass]}:</label>
					<input type="password"  name="password" value="" class="input_skin_1"  alt="password"  /></td>
					</tr>
					 
					<tr>
						<td>
						<label></label><input type="submit" value="Login" class="button_skin_1">
						</td>
					</tr>
				</table>
				
					

</form>
