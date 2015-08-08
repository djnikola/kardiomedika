<?php /* Smarty version 2.6.26, created on 2014-10-24 15:26:21
         compiled from admin/gallery/gallery_new.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/gallery/gallery_new.html', 42, false),)), $this); ?>
<form action="index.php?section=gallery&subsection=new_gallery" method="post" enctype="multipart/form-data">
<input type="hidden" name="gallery_id" value="<?php echo $this->_tpl_vars['gallery_id']; ?>
">
<input type="hidden" name="data[image_path]" value="<?php echo $this->_tpl_vars['picture_path']; ?>
">
<input type="hidden" name="data[image_name]" value="<?php echo $this->_tpl_vars['image_name']; ?>
"> 
	
<h1><?php echo $this->_tpl_vars['labels']['edit']; ?>
</h1>
		<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" class="grid_table">
		
			
			<tr class="table_header">
			    <td colspan="4">
					<?php echo $this->_tpl_vars['labels']['edit']; ?>

			    </td>
			</tr>
			<tr class="prominent">
				<td id="input" style="width: 20%">
				<label><?php echo $this->_tpl_vars['labels']['name']; ?>
:*</label>
				</td>
				<td>
				<input type="text" name="data[name]" value="<?php echo $this->_tpl_vars['name']; ?>
" style="width: 200px;" class="input_skin_1">
				</td>
			</tr>

			
			<tr>
				<td id="input" >
				<label><?php echo $this->_tpl_vars['labels']['category']; ?>
:</label>
				</td>
				<td>
				<select name="data[category_id]" style="width: 200px;" class="select_skin_1">
				<?php echo $this->_tpl_vars['dropdown_show_category']; ?>

				</select>
				</td>
			</tr>
			
			<tr>
				<td id="input">
				<label><?php echo $this->_tpl_vars['labels']['active']; ?>
:</label>
				</td>
				<td>
				<select name="data[is_active]" style="width: 50px;" class="select_skin_1">
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['activeOptions'],'selected' => $this->_tpl_vars['selectedActiveOption']), $this);?>

				</select>
				</td>
			</tr>
			
			<tr>
				<td id="input" >
				<label><?php echo $this->_tpl_vars['labels']['special']; ?>
:</label>
				</td>
				<td>
				<select name="data[is_special]" style="width: 50px;" class="select_skin_1">
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['specialOptions'],'selected' => $this->_tpl_vars['selectedSpecialOptions']), $this);?>

				</select>
				</td>
			</tr>
			
			<tr>
				<td>
				<label><?php echo $this->_tpl_vars['labels']['picture']; ?>
:</label>
				</td>
				<td>
				<?php if ($this->_tpl_vars['picture_path']): ?>
				<a href="../<?php echo $this->_tpl_vars['picture_path']; ?>
" target="_blank"><img src="../<?php echo $this->_tpl_vars['picture_path']; ?>
" alt="" border="0" width="150px" /></a><br />
				<?php endif; ?>
				<input class="upload" type="file" name="picture_path"  style="width:40px;">
				</td>
			</tr>
			 <!--
			<tr >
               
			<td colspan="3">
				<div class="dhtmlgoodies_question"> <h3>+ <?php echo $this->_tpl_vars['labels']['add_meta_tags']; ?>
</h3></div>
				<div class="dhtmlgoodies_answer">
					<div>
				<table>
					<tr>
						<td>
						<b><?php echo $this->_tpl_vars['labels']['meta_title']; ?>
:</b><br/>
						<input type="text" name="data[meta_title]" value="<?php echo $this->_tpl_vars['meta_title']; ?>
" style="width: 500px;" class="input_skin_1">
						</td>
					</tr>
					<tr>
						<td>
						<b><?php echo $this->_tpl_vars['labels']['meta_keywords']; ?>
:</b><br/>
						<textarea name="data[meta_keywords]" cols="60" class="textarea_skin_1"><?php echo $this->_tpl_vars['meta_keywords']; ?>
</textarea>
						</td>
					</tr>
					<tr>
						<td>
						<b><?php echo $this->_tpl_vars['labels']['meta_description']; ?>
:</b><br/>
						<textarea name="data[meta_description]" cols="60" class="textarea_skin_1"><?php echo $this->_tpl_vars['meta_description']; ?>
</textarea>
						</td>
					</tr>
				</table>
					</div>
				</div>
			</td>
			</tr>
			-->
			
			<tr>
		
				<td colspan="4">
				<label id="input"><?php echo $this->_tpl_vars['labels']['description']; ?>
:*</label> <br />
				<textarea id="html_2" name="data[description]"rows="5" cols="70" ><?php echo $this->_tpl_vars['description']; ?>
</textarea>
				</td>
			</tr>
			<tr>
				<td class="prominent" colspan="5">
				<input type="submit" name="submit[save]" value="<?php echo $this->_tpl_vars['labels']['save']; ?>
" class="button_skin_1">&nbsp;
				<input type="submit" name="submit[cancel]" value="<?php echo $this->_tpl_vars['labels']['cancel']; ?>
" class="button_skin_1">
				</td>
			</tr>
			
		</table>

</form>
<script type="text/javascript">
initShowHideDivs();
//showHideContent(false,1);	// Automatically expand first item
</script>