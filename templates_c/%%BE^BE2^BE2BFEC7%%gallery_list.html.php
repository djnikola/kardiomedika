<?php /* Smarty version 2.6.26, created on 2014-10-24 15:21:25
         compiled from admin/gallery/gallery_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/gallery/gallery_list.html', 46, false),)), $this); ?>
<script language="javascript">

function set_order(order) {
  var f = document.forms['gallery_list'];
  var o = f.elements['data[order]'];

  if (o.value == order) {
  	order = order.replace(/,/g,' desc,');
    order = order + ' desc';
  }

  o.value = order;

  f.elements['submit[filter]'].click();
}

</script>
<form name="gallery_list" action="index.php?section=gallery&subsection=list_gallery" method="post" enctype="multipart/form-data" class="forms">
	<input type="hidden" name="data[order]" value="<?php echo $this->_tpl_vars['ORDER']; ?>
">
	
		
		<h1><?php echo $this->_tpl_vars['labels']['gallery']; ?>
</h1>
		<table align="left" width="100%" cellpadding="3" cellspacing="0" border="0" class="grid_table">
		<tr class="table_header">
	        <td colspan="4">
	        Filter
	        </td>
		</tr>
		<tr class="table_row">
			<td id="input"><label><?php echo $this->_tpl_vars['labels']['name']; ?>
:</label><br/>
				<input type="text" name="filter[name_part]" value="<?php echo $this->_tpl_vars['NAME_PART']; ?>
" class="input_skin_1">
			</td>
			<td id="input" >
				<label><?php echo $this->_tpl_vars['labels']['from']; ?>
:</label><br/>
				<input type="text" name="filter[created_date_from]" id="created_date_from" value="<?php echo $this->_tpl_vars['CREATED_DATE_FROM']; ?>
" class="input_skin_1" size="10">
				<img src="../templates/images/admin/icons/calendar.png" onclick="displayCalendar(document.getElementById('created_date_from'),'dd/mm/yyyy',this)">
			</td>
			<td id="input" >
				<label><?php echo $this->_tpl_vars['labels']['to']; ?>
:</label><br/>
				<input type="text" name="filter[created_date_to]" id="created_date_to" value="<?php echo $this->_tpl_vars['CREATED_DATE_TO']; ?>
" class="input_skin_1" size="10">
				<img src="../templates/images/admin/icons/calendar.png" onclick="displayCalendar(document.getElementById('created_date_to'),'dd/mm/yyyy',this)">
			</td>
			<td>
				<label><?php echo $this->_tpl_vars['labels']['active']; ?>
:</label><br/>
				<select name="filter[is_active]" style="width: 90px;" class="select_skin_1">
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['activeOptions'],'selected' => $this->_tpl_vars['selectedActiveOption']), $this);?>

				</select>
			</td>		
		</tr>
		<tr class="table_row">
			<td id="input" colspan="5">
				<input type="submit" name="submit[filter]" value="<?php echo $this->_tpl_vars['labels']['search']; ?>
" class="button_skin_1" />
			</td>
		</tr>
	</table>
	<div>&nbsp;</div>
	<table align="center" cellpadding="0" width="100%" cellspacing="0" border="0" class="grid_table">
		<tr class="table_header">
			<td colspan="6">
	        	<?php echo $this->_tpl_vars['labels']['list']; ?>

	       	</td>
    	</tr>
		<tr class="table_row">
			<th width="10%" class="right_border">
			&nbsp;
			</th>
			<th width="30%" class="right_border" >
			<a href="#" onClick="set_order('gt.name');return false;" class="white_link"><?php echo $this->_tpl_vars['labels']['name']; ?>
</a> / <a href="#" onClick="set_order('g.created_date');return false;" class="white_link"><?php echo $this->_tpl_vars['labels']['date']; ?>
</a>
			</th>
	
			<th width="15%" class="right_border">
			<a href="#" onClick="set_order('g.gallery_category_id');return false;" class="white_link"><?php echo $this->_tpl_vars['labels']['category']; ?>
</a>
			</th>	
			
			<th width="15%" class="right_border">
			<?php echo $this->_tpl_vars['labels']['sort']; ?>

			</th>
			<th width="30%" align="center">
			<?php echo $this->_tpl_vars['labels']['action']; ?>

			</th>
		</tr>
	
	<?php $_from = $this->_tpl_vars['admin_gallery_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gallery']):
?>	
	<tr class="table_row">
		<td>
		<img src="<?php echo $this->_tpl_vars['gallery']['gallery_path_thumb']; ?>
"  class="listing_thumb_images"/>
		</td>
		
		<td>
			<a href="index.php?section=gallery&subsection=new_gallery&gallery_id=<?php echo $this->_tpl_vars['gallery']['gallery_id']; ?>
"><b style="font-size: 12px;"><?php echo $this->_tpl_vars['gallery']['gallery_name']; ?>
</b></a><br/>
			<?php echo $this->_tpl_vars['gallery']['created_date']; ?>
<br /><br />
			<a href="index.php?section=gallery&subsection=list_gallery_pictures&gallery_id=<?php echo $this->_tpl_vars['gallery']['gallery_id']; ?>
"><?php echo $this->_tpl_vars['labels']['picture_list']; ?>
</a>
		</td>
		
		<td>
			<?php echo $this->_tpl_vars['gallery']['gallery_category_name']; ?>

		</td>
		
		<td align="center">
			<a href="index.php?section=gallery&subsection=sort_galleries&gallery_id=<?php echo $this->_tpl_vars['gallery']['gallery_id']; ?>
&new_order=up&data[order]=<?php echo $this->_tpl_vars['ORDER']; ?>
"><img src="../templates/images/admin/arrow_up.png" border="0" /></a>
			<a href="index.php?section=gallery&subsection=sort_galleries&gallery_id=<?php echo $this->_tpl_vars['gallery']['gallery_id']; ?>
&new_order=down&data[order]=<?php echo $this->_tpl_vars['ORDER']; ?>
"><img src="../templates/images/admin/arrow_down.png" border="0"/></a>
		</td>
		<td align="center">
			
			<a title="<?php echo $this->_tpl_vars['labels']['edit']; ?>
" class="button_skin_1" href="index.php?section=gallery&subsection=new_gallery&gallery_id=<?php echo $this->_tpl_vars['gallery']['gallery_id']; ?>
" ><span><?php echo $this->_tpl_vars['labels']['edit']; ?>
</span></a>
		
			<a title="<?php echo $this->_tpl_vars['labels']['delete']; ?>
" class="button_skin_1" href="index.php?section=gallery&subsection=delete_gallery&gallery_id=<?php echo $this->_tpl_vars['gallery']['gallery_id']; ?>
" onclick="return confirm('<?php echo $this->_tpl_vars['labels']['are_you_sure']; ?>
?');"><span><?php echo $this->_tpl_vars['labels']['delete']; ?>
</span></a>
		</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	<?php if (isset ( $this->_tpl_vars['no_result'] )): ?>
	<tr class="table_row">
		<td align="center" colspan="6">
		<?php echo $this->_tpl_vars['no_result']; ?>

		</td>
	</tr>
	<?php endif; ?>
    
    <tr class="table_row">
		<td align="left" colspan="6">
		<input type="button"  value="<?php echo $this->_tpl_vars['labels']['add']; ?>
" onclick="location.href='index.php?section=gallery&subsection=new_gallery'" class="button_skin_1"/>
		</td>
	</tr>
</table>
    
    <table width="100%">
    <tr class="table_row">
		<td class="paging"  align="center" height="25" colspan="6">
			<input type="button" value=" &lt; " ONCLICK="elements['data[page]'].value='<?php echo $this->_tpl_vars['PREV']; ?>
';submit();" class="button_skin_1">&nbsp;&nbsp;
			<input type="hidden" size="3" value="<?php echo $this->_tpl_vars['PAGE']; ?>
" name="data[page]" class="inputstyle" style="border: 0px; width: 23px;text-align: center;"> <?php echo $this->_tpl_vars['PAGE']; ?>
 / <span style="displ1ay: inline; clear: none; width: 23px; text-align: center;"><?php echo $this->_tpl_vars['PAGES']; ?>
</span>
			&nbsp;&nbsp;<input type="button" value=" &gt; " ONCLICK="elements['data[page]'].value='<?php echo $this->_tpl_vars['NEXT']; ?>
';submit();" class="button_skin_1">
		</td>
	</tr>
    </table>
    
	
</form>