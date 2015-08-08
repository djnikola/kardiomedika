<?php /* Smarty version 2.6.26, created on 2014-12-11 13:15:02
         compiled from admin/gallery/picture_new.tpl */ ?>
<form action="index.php?section=gallery&subsection=new_gallery_pictures" method="post" enctype="multipart/form-data">
<input type="hidden" name="gallery_id" value="<?php echo $this->_tpl_vars['gallery']->gallery_id; ?>
"/>

	<h1><?php echo $this->_tpl_vars['labels']['add']; ?>
 <?php echo $this->_tpl_vars['labels']['picture']; ?>
: <?php echo $this->_tpl_vars['gallery']->name; ?>
</h1>
		<table align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="grid_table">
						
			<?php unset($this->_sections['picture_loop']);
$this->_sections['picture_loop']['loop'] = is_array($_loop=$this->_tpl_vars['gallery']->picture_arr) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['picture_loop']['name'] = 'picture_loop';
$this->_sections['picture_loop']['show'] = true;
$this->_sections['picture_loop']['max'] = $this->_sections['picture_loop']['loop'];
$this->_sections['picture_loop']['step'] = 1;
$this->_sections['picture_loop']['start'] = $this->_sections['picture_loop']['step'] > 0 ? 0 : $this->_sections['picture_loop']['loop']-1;
if ($this->_sections['picture_loop']['show']) {
    $this->_sections['picture_loop']['total'] = $this->_sections['picture_loop']['loop'];
    if ($this->_sections['picture_loop']['total'] == 0)
        $this->_sections['picture_loop']['show'] = false;
} else
    $this->_sections['picture_loop']['total'] = 0;
if ($this->_sections['picture_loop']['show']):

            for ($this->_sections['picture_loop']['index'] = $this->_sections['picture_loop']['start'], $this->_sections['picture_loop']['iteration'] = 1;
                 $this->_sections['picture_loop']['iteration'] <= $this->_sections['picture_loop']['total'];
                 $this->_sections['picture_loop']['index'] += $this->_sections['picture_loop']['step'], $this->_sections['picture_loop']['iteration']++):
$this->_sections['picture_loop']['rownum'] = $this->_sections['picture_loop']['iteration'];
$this->_sections['picture_loop']['index_prev'] = $this->_sections['picture_loop']['index'] - $this->_sections['picture_loop']['step'];
$this->_sections['picture_loop']['index_next'] = $this->_sections['picture_loop']['index'] + $this->_sections['picture_loop']['step'];
$this->_sections['picture_loop']['first']      = ($this->_sections['picture_loop']['iteration'] == 1);
$this->_sections['picture_loop']['last']       = ($this->_sections['picture_loop']['iteration'] == $this->_sections['picture_loop']['total']);
?>
			<input type="hidden" name="data[image_path_<?php echo $this->_sections['picture_loop']['index']; ?>
]" value="<?php echo $this->_tpl_vars['gallery']->picture_arr[$this->_sections['picture_loop']['index']]->input_file_path; ?>
"/>
			<input type="hidden" name="data[image_name_<?php echo $this->_sections['picture_loop']['index']; ?>
]" value="<?php echo $this->_tpl_vars['gallery']->picture_arr[$this->_sections['picture_loop']['index']]->input_file_name; ?>
"/>
			<tr>				
				<td width="30%" valign="top">
				<label>Choose a picture :</label>
					<input class="upload" type="file" name="image_<?php echo $this->_sections['picture_loop']['index']; ?>
" />			
					<br /><br />
					<label><?php echo $this->_tpl_vars['labels']['description']; ?>
:</label><br/>
					<textarea id="content" name="data[picture_<?php echo $this->_sections['picture_loop']['index']; ?>
][description]" cols="35" rows="4"><?php echo $this->_tpl_vars['gallery']->picture_arr[$this->_sections['picture_loop']['index']]->description; ?>
</textarea>			
				</td>
				
			</tr>
			<?php endfor; endif; ?>
		
			<tr>
				<td colspan="5">
				<input type="submit" name="submit[save]" value="<?php echo $this->_tpl_vars['labels']['save']; ?>
" class="button_skin_1">&nbsp;
				<input type="submit" name="submit[cancel]" value="<?php echo $this->_tpl_vars['labels']['cancel']; ?>
" class="button_skin_1">
				</td>
			</tr>
			
		</table>
	</div>
	<div class="content_bottom">
	</div>
</form>