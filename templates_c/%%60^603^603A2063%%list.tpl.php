<?php /* Smarty version 2.6.26, created on 2014-10-06 16:55:55
         compiled from admin/pages/list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'admin/pages/list.tpl', 85, false),)), $this); ?>
<script language="javascript">

function set_order(order) {
  var f = document.forms['page_list'];
  var o = f.elements['data[order]'];

  if (o.value == order) {
  	order = order.replace(/,/g,' desc,');
    order = order + ' desc';
  }

  o.value = order;

  f.elements['submit[filter]'].click();
}


</script>
<form name="page_list" id="page_list" action="index.php?section=pages&subsection=list" method="post" enctype="multipart/form-data" class="forms">
<input type="hidden" name="data[order]" value="<?php echo $this->_tpl_vars['ORDER']; ?>
">
<input type="hidden" name="filter[show_place]" value="<?php echo $this->_tpl_vars['SHOW_PLACE']; ?>
">
<input type="hidden" name="parent" value=<?php echo $this->_tpl_vars['PARENT']; ?>
 />

	<h1><?php echo $this->_tpl_vars['labels']['pages']; ?>
</h1>
    
	<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" class="grid_table">
		<tr class="table_header">
            <td colspan="6" >          
            Filter
            </td>
        </tr>
        
        <tr>
            <td>
                <label><?php echo $this->_tpl_vars['labels']['title']; ?>
:</label><br />
                <input type="text" name="filter[caption]" value="<?php echo $this->_tpl_vars['CAPTION']; ?>
" class="input_skin_1" style="width:200px;"/>
            </td>
            <?php echo $this->_tpl_vars['SHOW_PLACE']; ?>

            <?php if ($this->_tpl_vars['PARENT'] == 0): ?>
			<td>
                <label>Menu Position:</label><br />
                <select name="filter[show_place]" onchange="document.forms['page_list'].submit();" class="select_skin_1">
                    <option value="first" <?php if ($this->_tpl_vars['SHOW_PLACE'] == 'first'): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['labels']['main_navigation']; ?>
</option>
                    <option value="second" <?php if ($this->_tpl_vars['SHOW_PLACE'] == 'second'): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['labels']['footer_links']; ?>
</option>
                    <option value="forth" <?php if ($this->_tpl_vars['SHOW_PLACE'] == 'forth'): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['labels']['pediatrics']; ?>
</option>
                    <option value="third" <?php if ($this->_tpl_vars['SHOW_PLACE'] == 'third'): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['labels']['neurology']; ?>
</option>
                    <option value="fifth" <?php if ($this->_tpl_vars['SHOW_PLACE'] == 'fifth'): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['labels']['psychiatry']; ?>
</option>
                </select>
			</td>
            <?php endif; ?>
		</tr>
        
		<tr>
            <td colspan="5">
			<input type="submit" name="submit[filter]" value="<?php echo $this->_tpl_vars['labels']['search']; ?>
" class="button_skin_1"/>
			</td>
		</tr>
       
	</table>
	<br />
    
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="grid_table">
        <tr class="table_header">
            <td colspan="6" >          
            <?php $_from = $this->_tpl_vars['page_path']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
				<a href="index.php?section=pages&subsection=list&parent=<?php echo $this->_tpl_vars['p']['page_id']; ?>
&filter[show_place]=<?php echo $this->_tpl_vars['SHOW_PLACE']; ?>
" class="breadcrumb"><?php echo $this->_tpl_vars['p']['page_name']; ?>
 &nbsp;»</a>
			<?php endforeach; endif; unset($_from); ?>
            </td>
        </tr>
		<tr class="table_row">
			<th width="40%" align="left" class="right_border">
				<a href="#" onClick="set_order('pt.caption');return false;"><?php echo $this->_tpl_vars['labels']['title']; ?>
</a>
			</th>
				
			<th width="30%" align="center" class="right_border">
				<a href="#" onClick="set_order('p.subpage_num');return false;"></a>
			</th>
			
			<th width="30%" align="center" class="right_border">
							</th>
		</tr>
				
		<?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>	
		<tr class='<?php echo smarty_function_cycle(array('values' => "selected, noselected"), $this);?>
'>
			<td>
				<strong><?php echo $this->_tpl_vars['page']['caption']; ?>
</strong>
			</td>
			<td align="center">
				<?php if ($this->_tpl_vars['page']['type'] != 'functionality' && $this->_tpl_vars['page']['level'] == 0 && $this->_tpl_vars['SHOW_PLACE'] != 'first'): ?>
                <a href="index.php?section=pages&subsection=list&parent=<?php echo $this->_tpl_vars['page']['id']; ?>
&filter[show_place]=<?php echo $this->_tpl_vars['SHOW_PLACE']; ?>
" > <strong><?php echo $this->_tpl_vars['labels']['edit']; ?>
 (<?php echo $this->_tpl_vars['page']['subpage_num']; ?>
) subpages</strong> </a>
				<?php endif; ?>
			</td>
			
			<td align="center">
				<?php if ($this->_tpl_vars['page']['type'] != 'functionality' && $this->_tpl_vars['page']['type'] != 'static'): ?>
				<a title="<?php echo $this->_tpl_vars['labels']['edit']; ?>
" href="index.php?section=pages&subsection=new&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
&show_place=<?php echo $this->_tpl_vars['SHOW_PLACE']; ?>
" class="button_skin_1"><?php echo $this->_tpl_vars['labels']['edit']; ?>
</a>
					<?php if ($this->_tpl_vars['page']['parent'] != 0): ?>
						<a title="<?php echo $this->_tpl_vars['labels']['delete']; ?>
" href="index.php?section=pages&subsection=delete&page_id=<?php echo $this->_tpl_vars['page']['id']; ?>
" onclick="return confirm('<?php echo $this->_tpl_vars['labels']['are_you_sure']; ?>
?');" class="button_skin_1"><?php echo $this->_tpl_vars['labels']['delete']; ?>
</a>
					<?php endif; ?>
				<?php else: ?>
				&nbsp;
				<?php endif; ?>
			</td>
		</tr>
		<?php endforeach; endif; unset($_from); ?>
				<?php if (isset ( $this->_tpl_vars['no_result'] )): ?>
				<tr>
					<td align="center" colspan="5">
					<?php echo $this->_tpl_vars['no_result']; ?>

					</td>
				</tr>
				<?php endif; ?>
                    
				<tr>
					<td colspan="5">
						            
						<input type="button"  value="<?php echo $this->_tpl_vars['labels']['add']; ?>
" onclick="location.href='index.php?section=pages&subsection=new&parent=<?php echo $this->_tpl_vars['PARENT']; ?>
&show_place=<?php echo $this->_tpl_vars['SHOW_PLACE']; ?>
'"class="button_skin_1"/>
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