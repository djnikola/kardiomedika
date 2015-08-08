<script language="javascript" type="text/javascript" src="../external/tiny/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="../external/scripts/java_scripts/tiny.js"></script>
<form name="common_conf_list" action="index.php?section=common&amp;subsection=list" method="post" enctype="multipart/form-data" class="forms">

	<h1>{[$labels.common_config]}</h1>
	
		<table align="left" width="100%" cellpadding="3" cellspacing="0" border="0">
			{[foreach from=$cc item=cc_item]}	
			<tr>
				<td valign="top">
				<label>
				{[$cc_item.cc_label_tr]} :</label>
				</td>
				<td class="list" align="left">
				{[$cc_item.html_field]}
				{[if $cc_item.field_type == 'textarea']}
				<script language="javascript" type="text/javascript">
				//<!--
					applyMiniTiny("{[$cc_item.cc_id]}","{[$WEBROOT]}", "370", "100");
				//-->
				</script>
					
				{[/if]}
				
				
				</td>
				
			</tr>
			{[/foreach]}
			{[if isset($no_result)]}
			<tr>
				<td align="center">
				{[$no_result]}
				</td>
			</tr>
			{[/if]}
			<tr>
				<td style="padding-top: 20px;"><input type="submit" name="submit[save]" value="{[$labels.save]}" class="button_skin_1"> </td>
			</tr>
		</table>

</form>