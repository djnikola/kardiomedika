<form name="common_conf_list" action="index.php?section=meta&amp;subsection=list" method="post" enctype="multipart/form-data" class="forms">
		<table align="left" width="100%" cellpadding="3" cellspacing="0" border="0">
			{[foreach from=$mt item=mt_item]}	
			<tr>
				<td colspan="2">
				<h1>{[$mt_item.mt_label]}</h1>
				</td>
			</tr>
			<tr>
				<td class="list" style="width: 100px;">
				<label>
				Meta title :</label>
				</td>
				<td class="list" align="left">
				<input name="data[{[$mt_item.mt_index]}_meta_title]" value="{[$mt_item.mt_meta_title]}" class="input_skin_1" style="width: 510px">
				</td>
			</tr>
			<tr>
				<td class="list">
				<label>
				Meta keywords :</label>
				</td>
				<td class="list" align="left">
				<textarea name="data[{[$mt_item.mt_index]}_meta_keywords]" cols="70" class="textarea_skin_1">{[$mt_item.mt_meta_keywords]}</textarea>
				</td>
			</tr>
			<tr>
				<td class="list">
				<label>
				Meta description :</label>
				</td>
				<td class="list" align="left">
				<textarea name="data[{[$mt_item.mt_index]}_meta_description]" cols="70" class="textarea_skin_1">{[$mt_item.mt_meta_description]}</textarea>
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