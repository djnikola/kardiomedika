<form action="index.php?section=gallery&subsection=new_gallery_pictures" method="post" enctype="multipart/form-data">
<input type="hidden" name="gallery_id" value="{[$gallery->gallery_id]}"/>

	<h1>{[$labels.add]} {[$labels.picture]}: {[$gallery->name]}</h1>
		<table align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="grid_table">
						
			{[section loop=$gallery->picture_arr name=picture_loop]}
			<input type="hidden" name="data[image_path_{[$smarty.section.picture_loop.index]}]" value="{[$gallery->picture_arr[$smarty.section.picture_loop.index]->input_file_path]}"/>
			<input type="hidden" name="data[image_name_{[$smarty.section.picture_loop.index]}]" value="{[$gallery->picture_arr[$smarty.section.picture_loop.index]->input_file_name]}"/>
			<tr>				
				<td width="30%" valign="top">
				<label>Choose a picture :</label>
					<input class="upload" type="file" name="image_{[$smarty.section.picture_loop.index]}" />			
					<br /><br />
					<label>{[$labels.description]}:</label><br/>
					<textarea id="content" name="data[picture_{[$smarty.section.picture_loop.index]}][description]" cols="35" rows="4">{[$gallery->picture_arr[$smarty.section.picture_loop.index]->description]}</textarea>			
				</td>
				
			</tr>
			{[/section]}
		
			<tr>
				<td colspan="5">
				<input type="submit" name="submit[save]" value="{[$labels.save]}" class="button_skin_1">&nbsp;
				<input type="submit" name="submit[cancel]" value="{[$labels.cancel]}" class="button_skin_1">
				</td>
			</tr>
			
		</table>
	</div>
	<div class="content_bottom">
	</div>
</form>
