<script language="javascript" type="text/javascript" src="http://www.google.com/jsapi"></script>
<script language="javascript" type="text/javascript" src="../scripts/java_scripts/translate.js"></script>
<script language="javascript" type="text/javascript" src="../tiny/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/java_scripts/tiny.js"></script>
<form action="index.php?section=gallery&subsection=new_gallery_category" method="post" enctype="multipart/form-data">
<input type="hidden" name="gallery_category_id" value="{[$gallery_category_id]}">

	<div class="content_top">
	</div>
	<div class="content_content clearfix">
	{[if $gallery_category_name neq '']}
		<h1>{[$labels.edit_gallery_category]}:&nbsp;{[$gallery_category_name]}</h1>
	{[else]}
		<h1>{[$labels.add_gallery_category]}</h1>
	{[/if]}
		<table align="center" width="95%" cellpadding="5" cellspacing="0" border="0">
		
			
			<tr>
				<td colspan="2">
				&nbsp;
				</td>
			</tr>
			<tr class="prominent">
				<td id="input" style="width: 20%">
				<label>{[$labels.name]}:*</label>
				</td>
				<td>
				<input type="text" name="data[name]" value="{[$gallery_category_name]}" style="width: 200px;"/>
				</td>
			</tr>
			<tr class="prominent">
		
				<td colspan="4">
				<label id="input">{[$labels.description]}:*</label><br>
				<textarea id="html_2" name="data[description]" >{[$gallery_category_description]}</textarea>
				
				<script language="javascript" type="text/javascript">
				//<!--
					applyMiniTiny("html_2","{[$WEBROOT]}");
				//-->
				</script>
				</td>
			</tr>
			<tr class="prominent">
				<td id="input" style="width: 20%">
				<label>{[$labels.sort]}:*</label>
				</td>
				<td>
				<input type="text" name="data[sort]" value="{[$gallery_category_sort]}" style="width: 50px;"/>
				</td>
			</tr>			
			<tr>
				<td class="prominent" colspan="5">
				<input type="submit" name="submit[save]" value="{[$labels.save]}" class="button_submit_save"/>&nbsp;
				<input type="submit" name="submit[cancel]" value="{[$labels.cancel]}" class="button_submit_cancel"/>
				</td>
			</tr>
			
		</table>
	</div>
	<div class="content_bottom">
	</div>
</form>
<script type="text/javascript">
initShowHideDivs();
//showHideContent(false,1);	// Automatically expand first item
</script>