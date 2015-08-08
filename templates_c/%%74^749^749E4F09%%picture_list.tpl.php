<?php /* Smarty version 2.6.26, created on 2014-12-11 13:14:52
         compiled from admin/gallery/picture_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/gallery/picture_list.tpl', 47, false),)), $this); ?>
<script language="javascript">
<!--
function set_order(order) {
  var f = document.forms['list_gallery_pictures'];
  var o = f.elements['data[order]'];

  if (o.value == order) {
  	order = order.replace(/,/g,' desc,');
    order = order + ' desc';
  }

  o.value = order;

  f.elements['submit[filter]'].click();
}


//-->
</script>
<form name="list_gallery_pictures" action="index.php?section=gallery&subsection=list_gallery_pictures" method="post" enctype="multipart/form-data" class="forms">
<input type="hidden" name="data[order]" value="<?php echo $this->_tpl_vars['ORDER']; ?>
"/>
<input type="hidden" name="data[page]" value="<?php echo $this->_tpl_vars['PAGE']; ?>
"/>
<input type="hidden" name="gallery_id" value="<?php echo $this->_tpl_vars['gallery_id']; ?>
"/>
	<h1><?php echo $this->_tpl_vars['labels']['pictures']; ?>
</h1>

	<table align="center" width="100%" cellpadding="3" cellspacing="0" border="0" class="grid_table">
		<tr class="table_header">
		    <td colspan="4">
		    <?php echo $this->_tpl_vars['labels']['picture_list']; ?>

		    </td>
		</tr>
		<tr>
			<th width="20%" class="right_border">
			<?php echo $this->_tpl_vars['labels']['picture']; ?>

			</th>
			
	
					
			<th width="5%" class="right_border">
			<a href="#" onClick="set_order('gp.sort');return false;" class="white_link"><?php echo $this->_tpl_vars['labels']['sort']; ?>
</a>
			</th>
			<th width="5%" align="center">
			<?php echo $this->_tpl_vars['labels']['action']; ?>

			</th>
		</tr>
		<?php $_from = $this->_tpl_vars['admin_gallery_picture_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['picture']):
?>	
		<tr class='<?php echo smarty_function_cycle(array('values' => "selected, noselected"), $this);?>
'>
			<td align="left">
			<img src="../<?php echo $this->_tpl_vars['picture']->thumbnail_path; ?>
"  class="listing_thumb_images"/></a>
			</td>
			
		
			
			<td align="center">
			<?php echo $this->_tpl_vars['picture']->sort; ?>

			</td>
			<td align="center">
			<a title="<?php echo $this->_tpl_vars['labels']['delete']; ?>
" class="button_skin_1" href="index.php?section=gallery&subsection=delete_gallery_picture&picture_id=<?php echo $this->_tpl_vars['picture']->picture_id; ?>
&gallery_id=<?php echo $this->_tpl_vars['gallery_id']; ?>
" onclick="return confirm('<?php echo $this->_tpl_vars['labels']['are_you_sure']; ?>
?');"><span><?php echo $this->_tpl_vars['labels']['delete']; ?>
</span></a>
			</td>
		</tr>
		
		<?php endforeach; endif; unset($_from); ?>
		<tr>
			<td colspan="5">
				<input type="button"  value="<?php echo $this->_tpl_vars['labels']['add']; ?>
" onclick="location.href='index.php?section=gallery&subsection=new_gallery_pictures&gallery_id=<?php echo $this->_tpl_vars['gallery_id']; ?>
'" class="button_skin_1">
			</td>
		</tr>
		<?php if (isset ( $this->_tpl_vars['no_result'] )): ?>
		<tr>
			<td align="center" colspan="4">
			<?php echo $this->_tpl_vars['no_result']; ?>

			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class="paging"  align="center" height="25" colspan="6">
				<input type="button" value=" &lt; " ONCLICK="elements['data[page]'].value='<?php echo $this->_tpl_vars['PREV']; ?>
';submit();" class="button_paging">&nbsp;&nbsp;
				<?php echo $this->_tpl_vars['PAGE']; ?>
 / <span style="displ1ay: inline; clear: none; width: 23px; text-align: center;"><?php echo $this->_tpl_vars['PAGES']; ?>
</span>
				&nbsp;&nbsp;<input type="button" value=" &gt; " ONCLICK="elements['data[page]'].value='<?php echo $this->_tpl_vars['NEXT']; ?>
';submit();" class="button_paging">
			</td>
		</tr>
	</table>

</form>