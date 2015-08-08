    
<script type="text/javascript">

function display_section(e, section_id){

	if(e.checked){
		document.getElementById(section_id).style.display = "block";
	}else{
		document.getElementById(section_id).style.display = "none";
	}

}

function openSection(section_id){
	var containerDiv = document.getElementById('info_container');
	 
	if (containerDiv.hasChildNodes()) {
		// Get all children of node
		var children = containerDiv.childNodes;               

		// Loop through the children
		for(var c=0; c < children.length; c++) {
			if(children[c].style) {
				if(children[c].id == section_id){
					children[c].style.display = 'block';
				}else{
					children[c].style.display = 'none';
				}
			}
	     }
	 }
}


</script>

	<div class="title_text">
	<h1>Forma za narucivanje</h1>
	</div>	
	           
	{[if isset($errors)]}
	<div style="border:1px red solid; padding: 5px;">
	{[foreach from=$errors item=error]}
	<span style="color: #ff0000;"><img src="templates/images/icons/bullet_error.png" alt="error" style="padding: 3px; vertical-align: middle;"/>{[$error]}</span><br/>
	{[/foreach]}
	</div>
	{[/if]}
	
	
	<div class="row-0" {[if isset($errors.user_type) && $errors.user_type != '']}style="background-color: #FFEFEF;"{[/if]}>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td class="first_one">
					<h3 class="underline_header">Opcije kupovine</h3>
				</td>
			</tr>
			<tr>		
				<td>
					<label><input type="radio" name="input_type" value="private" onclick="openSection('login');"/>Već imam nalog i želim da se prijavim</label><br />
					<label><input type="radio" name="input_type" value="company" onclick="openSection('guest');"/>Želim da nastavim kupovinu bez kreiranja korisničkog naloga</label> 
					{[if isset($errors.user_type) && $errors.user_type != '']}<div class="error_login" style="float:right; padding-right: 100px;">{[$errors.user_type]}</div>{[/if]}
				</td>
			</tr>
		</table> 	
	</div>

	<div class="row-1 clearfix" id="info_container">	
		<div id="guest">
			<form action="index.php?section=order&amp;subsection=order_form" method="post" class="order_forms">
			<h3 class="underline_header">Podaci za isporuku</h3>
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td colspan="2" style="padding: 0px 0 10px 0;">
						<label><input type="checkbox" name="triger_company"  onchange="display_section(this,'company');" /><strong>&nbsp;&nbsp;Kupujem u ime firme</strong></label>
					</td>
				</tr>
				
				<tr>
					<td class="first_one">
						Ime:*
					</td>
						
					<td>
						<input type="text" name="register[first_name]" value="{[if isset($registerUserObj->first_name)]}{[$registerUserObj->first_name]}{[/if]}" class="input_field" {[if isset($errors.first_name) && $errors.first_name != '']}style="background-color: #FFEFEF;"{[/if]}/>
						{[if isset($errors.first_name) && $errors.first_name != '']}<div class="error_login">{[$errors.first_name]}</div>{[/if]}
					</td>
				</tr>
				<tr>
					<td>
						Prezime:*
					</td>
						
					<td>
						<input type="text" name="register[last_name]" value="{[if isset($registerUserObj->last_name)]}{[$registerUserObj->last_name]}{[/if]}" class="input_field" {[if isset($errors.last_name) && $errors.last_name != '']}style="background-color: #FFEFEF;"{[/if]}/>
						{[if isset($errors.last_name) && $errors.last_name != '']}<div class="error_login">{[$errors.last_name]}</div>{[/if]}
					</td>
				</tr>
			
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
			
				<tr>
					<td>
						Email:*
					</td>
						
					<td>
						<input type="text" name="register[email]" value="{[if isset($registerUserObj->email)]}{[$registerUserObj->email]}{[/if]}" class="input_field" {[if isset($errors.email) && $errors.email != '']}style="background-color: #FFEFEF;"{[/if]} />
						{[if isset($errors.email) && $errors.email != '']}<div class="error_login">{[$errors.email]}</div>{[/if]}
					</td>
				</tr>
				<tr>
					<td>
						Ulica:*
					</td>
						
					<td>
						<input type="text" name="register[street]" value="{[if isset($registerUserObj->street)]}{[$registerUserObj->street]}{[/if]}" class="input_field" {[if isset($errors.street) && $errors.street != '']}style="background-color: #FFEFEF;"{[/if]} />
						{[if isset($errors.street) && $errors.street != '']}<div class="error_login">{[$errors.street]}</div>{[/if]}
					</td>
				</tr>
				<tr>
					<td>
						Grad:*
					</td>
						
					<td>
						<input type="text" name="register[city]" value="{[if isset($registerUserObj->city)]}{[$registerUserObj->city]}{[/if]}" class="input_field" {[if isset($errors.city) && $errors.city != '']}style="background-color: #FFEFEF;"{[/if]} />
						{[if isset($errors.city) && $errors.city != '']}<div class="error_login">{[$errors.city]}</div>{[/if]}
					</td>
				</tr>
				<tr>
					<td>
						Država:*
					</td>
						
					<td>
						<input type="text" name="register[state]" value="{[if isset($registerUserObj->state)]}{[$registerUserObj->state]}{[/if]}" class="input_field" {[if isset($errors.state) && $errors.state != '']}style="background-color: #FFEFEF;"{[/if]} />
						{[if isset($errors.state) && $errors.state != '']}<div class="error_login">{[$errors.state]}</div>{[/if]}
					</td>
				</tr>
				<tr>
					<td>
						Poštanski broj:*
					</td>
						
					<td>
						<input type="text" name="register[zip]" value="{[if isset($registerUserObj->zip)]}{[$registerUserObj->zip]}{[/if]}" class="input_field" {[if isset($errors.zip) && $errors.zip!= '']}style="background-color: #FFEFEF;"{[/if]} />
						{[if isset($errors.zip) && $errors.zip != '']}<div class="error_login">{[$errors.zip]}</div>{[/if]}
					</td>
				</tr>
				<tr>
					<td class="first_one">
						Telefon:*
					</td>
						
					<td>
						<input type="text" name="register[phone_number]" value="{[if isset($registerUserObj->phone_number)]}{[$registerUserObj->phone_number]}{[/if]}" class="input_field" {[if isset($errors.phone_number) && $errors.phone_number != '']}style="background-color: #FFEFEF;"{[/if]} />
						{[if isset($errors.phone_number) && $errors.phone_number != '']}<div class="error_login">{[$errors.phone_number]}</div>{[/if]}
					</td>
				</tr>
				
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>				
			</table>
			
			<table cellpadding="0" cellspacing="0" border="0" id="company" {[if isset($registerUserObj->user_type) && $registerUserObj->user_type == 'company' && $registerUserObj->user_type != 'private']}style="display: block;"{[else]}style="display: none;"{[/if]}>
				
				<tr>
					<td class="first_one">
						Naziv firme*:
					</td>
						
					<td>
						<input type="text" name="register[company_name]" value="{[if isset($registerUserObj->company_name)]}{[$registerUserObj->company_name]}{[/if]}" class="input_field" {[if isset($errors.company_name) && $errors.company_name != '']}style="background-color: #FFEFEF;"{[/if]} />
						{[if isset($errors.company_name) && $errors.company_name != '']}<div class="error_login">{[$errors.company_name]}</div>{[/if]}
					</td>
				</tr>
				
				<tr>
					<td>
						PID firme*:
					</td>
						
					<td>
						<input type="text" name="register[company_pib]" value="{[if isset($registerUserObj->company_pib)]}{[$registerUserObj->company_pib]}{[/if]}" class="input_field" {[if isset($errors.company_pib) && $errors.company_pib != '']}style="background-color: #FFEFEF;"{[/if]} />
						{[if isset($errors.company_pib) && $errors.company_pib != '']}<div class="error_login">{[$errors.company_pib]}</div>{[/if]}
					</td>
				</tr>
				
			</table>
			<h3 class="underline_header">Vaš komentar</h3>
			<table cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td colspan="2">
					<p>
						Lorem ipsum dolor sit ameequat. Duis autem vel eum iriure dolenit augue duis dolore te feugait nulla facilisi. Epsum factorial non deposit quid pro quo hic escorol. 
					</p>
					</td>
				</tr>
				<tr>						
					<td>
						<textarea name="komentar" style="width: 100%"></textarea>
					</td>
				</tr>
			</table>
			
			<input type="submit" name="submit[send]" value=" Pregled narudzbine" class="submit_buttom" />
		</form>
		
		</div> 
		<div id="login" style="display: none;" >
			<h3 class="underline_header">Logovanje korisnika</h3>
	
			<form action="index.php?section=login&amp;subsection=login_action" method="post" class="login_form">
				(go6buvya)Korisničko ime:<br />
				<input type="text" name="login[username]" value="" class="input_field" />
					{[if isset($errors) && count($errors) && isset($errors.username) && $errors.username != '']}
					<div class="error_login">
						{[$errors.username]}
					</div>
					{[/if]}
				<br />
				
				Lozinka:<br />
				<input type="password" name="login[password]" value="" class="input_field"  /><br />
					{[if isset($errors) && count($errors) && isset($errors.password) && $errors.password != '']}
					<div class="error_login">
						{[$errors.password]}
					</div>
					{[/if]}
				<br />
				<input type="submit" name="login[submit]" value="Login" class="button"/><br /><br />
			</form>
		</div>
	</div>  
	
