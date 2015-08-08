<script language="javascript" type="text/javascript" src="http://www.google.com/jsapi"></script>
<script language="javascript" type="text/javascript" src="../scripts/java_scripts/translate.js"></script>


<script language="javascript" type="text/javascript" src="../tiny/tiny_mce.js"></script>
<form action="index.php?section=forms&subsection=contact_new" method="post" enctype="multipart/form-data">
<input type="hidden" name="contact_us_id" value="{[$contact->contact_us_id]}"> 
	<div class="content_top">
	</div>
	<div class="content_content clearfix">
	<h1>{[$labels.contact_edit]}</h1>
		<table align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="grid_table">
		
			<tr class="table_header">
			    <td colspan="5">
			    Podaci o kontaktu
			    </td>
			</tr>

			<tr class="prominent">
				<td id="input" style="width: 20%">
				<label>{[$labels.contact_name]}:*</label>
				</td>
				<td>
				{[$contact->name]}
				</td>
		
			</tr>
			<tr class="prominent">
				<td id="input" >
				<label>{[$labels.contact_phone]}:</label>
				</td>
				<td>
				{[$contact->phone]}
				</td>
		
			</tr>
			
			<tr class="prominent">
				<td id="input" >
				<label>{[$labels.contact_email]}:</label>
				</td>
				<td>
				{[$contact->email]}
				</td>
			</tr>
			
			<tr class="prominent">
				<td id="input" >
				<label>{[$labels.contact_subject]}:</label>
				</td>
				<td>
				{[$contact->subject]}
				</td>
			</tr>
			
			<tr class="prominent">
				<td id="input" >
				<label>{[$labels.contact_message]}:</label>
				</td>
				<td>
				{[$contact->message]}
				</td>
			</tr>
			
			<tr class="prominent">
				<td id="input" >
				<label>{[$labels.contact_notice]}:</label>
				</td>
				<td>
				<textarea name="data[notice]" cols="80" rows="5" class="textarea_skin_1">{[$contact->notice]}</textarea>
				</td>
			</tr>
			
			<tr>
				<td class="prominent" colspan="2">
				<input type="submit" name="submit[save]" value="{[$labels.save]}" class="button_skin_1">&nbsp;
				<input type="submit" name="submit[cancel]" value="{[$labels.cancel]}" class="button_skin_1">
				</td>
			</tr>
			
		</table>
	</div>
	<div class="content_bottom">
	</div>
</form>