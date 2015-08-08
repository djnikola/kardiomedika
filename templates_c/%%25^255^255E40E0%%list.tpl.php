<?php /* Smarty version 2.6.26, created on 2014-10-27 16:31:00
         compiled from admin/articles/list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'checkUserPrivileges', 'admin/articles/list.tpl', 111, false),)), $this); ?>
<script language="javascript">

function set_order(order) {
  var f = document.forms['articles_list'];
  var o = f.elements['data[order]'];

  if (o.value == order) {
  	order = order.replace(/,/g,' desc,');
    order = order + ' desc';
  }

  o.value = order;

  f.elements['submit[filter]'].click();
}

</script>
<form name="articles_list" action="index.php?section=articles&subsection=list" method="post" enctype="multipart/form-data" class="forms">
<input type="hidden" name="data[order]" value="<?php echo $this->_tpl_vars['ORDER']; ?>
">

<h1><?php echo $this->_tpl_vars['labels']['articles']; ?>
</h1>


	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="grid_table">
         <tr class="table_header">
             <td colspan="5">
              Filter
             </td>
         </tr>
        <tr class="table_row">
		<td>
			<label><?php echo $this->_tpl_vars['labels']['title']; ?>
:</label><br/>
			<input type="text" name="filter[caption_part]" value="<?php echo $this->_tpl_vars['CAPTION_PART']; ?>
" class="input_skin_1" style="width:100px;"/></td>
		<td>
			<label><?php echo $this->_tpl_vars['labels']['from']; ?>
:</label><br/>
            <input type="text" name="filter[publish_date_from]" id="publish_date_from" value="<?php echo $this->_tpl_vars['PUBLISH_DATE_FROM']; ?>
" class="input_skin_1" style="width:80px;"/>
			<img src="../templates/images/admin/icons/calendar.png" onclick="displayCalendar(document.getElementById('publish_date_from'),'dd/mm/yyyy',this)">
		</td>
		<td>
			<label><?php echo $this->_tpl_vars['labels']['to']; ?>
:</label><br/>
			<input type="text" name="filter[publish_date_to]" id="publish_date_to" value="<?php echo $this->_tpl_vars['PUBLISH_DATE_TO']; ?>
" class="input_skin_1" style="width:80px;"/>
			<img src="../templates/images/admin/icons/calendar.png" onclick="displayCalendar(document.getElementById('publish_date_to'),'dd/mm/yyyy',this)">
		</td>
		
		
		
		<td>
			<label><?php echo $this->_tpl_vars['labels']['active']; ?>
:</label><br/>
			<select name="filter[is_active]"  class="select_skin_1">
			<option value=""><?php echo $this->_tpl_vars['labels']['any']; ?>
</option>
			<?php echo $this->_tpl_vars['dropdown_is_active']; ?>

			</select>
		</td>		
	</tr>
	<tr class="table_row">
		<td colspan="5">
		<select name="filter[articles_type]">
                    <option></option>
                    <?php echo $this->_tpl_vars['dropdown_articles_type']; ?>

                </select>
		</td>
	</tr>
	<tr class="table_row">
		<td colspan="5">
		<input type="submit" name="submit[filter]" value="<?php echo $this->_tpl_vars['labels']['search']; ?>
" class="button_skin_1" />
		</td>
	</tr>
	</table>

<br />

	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="grid_table">
        <tr class="table_header">
            <td colspan="6">
            <?php echo $this->_tpl_vars['labels']['list']; ?>

            </td>
        </tr>
		<tr class="table_row">
			<th class="right_border" width="30%">
				<a href="#" onClick="set_order('at.caption');return false;" class="white_link"><?php echo $this->_tpl_vars['labels']['title']; ?>
</a>
			</th>
			
			<th class="right_border" width="15%" >
				<a href="#" onClick="set_order('a.publish_date');return false;" class="white_link"><?php echo $this->_tpl_vars['labels']['date']; ?>
</a>
			</th>
						
			<th class="right_border" width="5%" >
				<a href="#" onClick="set_order('a.is_active ');return false;" class="white_link"><?php echo $this->_tpl_vars['labels']['active']; ?>
</a>
			</th>
			
			<th width="20%" align="center">
				<?php echo $this->_tpl_vars['labels']['action']; ?>

			</th>
		</tr>
	
	<?php $_from = $this->_tpl_vars['admin_articles_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['new']):
?>	
	<tr class="table_row">
		<td>
		<?php echo $this->_tpl_vars['new']['caption']; ?>

		</td>
		
		<td>
		<?php echo $this->_tpl_vars['new']['publish_date']; ?>

		</td>
				
		<td align="center">
		<?php echo $this->_tpl_vars['new']['is_active']; ?>

		</td>
		
		<td align="center">
		<?php echo checkUserPrivilegesSmarty(array('permission' => 'permission','section' => 'articles','subsection' => 'new'), $this);?>

        <?php if ($this->_tpl_vars['permission'] == 1): ?>
		<a href="index.php?section=articles&subsection=new&articles_id=<?php echo $this->_tpl_vars['new']['articles_id']; ?>
" class="button_skin_1" ><?php echo $this->_tpl_vars['labels']['edit']; ?>
</a>
		<?php endif; ?>
		<?php echo checkUserPrivilegesSmarty(array('permission' => 'permission','section' => 'articles','subsection' => 'delete'), $this);?>

        <?php if ($this->_tpl_vars['permission'] == 1): ?>
		<a href="index.php?section=articles&subsection=delete&articles_id=<?php echo $this->_tpl_vars['new']['articles_id']; ?>
" onclick="return confirm('<?php echo $this->_tpl_vars['labels']['are_you_sure']; ?>
?');" class="button_skin_1"><?php echo $this->_tpl_vars['labels']['delete']; ?>
</a>
		<?php endif; ?>
				
		</td>
	</tr>
	<?php endforeach; endif; unset($_from); ?>
	
	<?php if (isset ( $this->_tpl_vars['no_result'] )): ?>
	<tr  class="table_row">
		<td align="center" colspan="5">
		<?php echo $this->_tpl_vars['no_result']; ?>

		</td>
	</tr>
	<?php endif; ?>
	
	<tr class="table_row">
		<td colspan="5">
		<input type="button"  value="<?php echo $this->_tpl_vars['labels']['add']; ?>
" onclick="location.href='index.php?section=articles&subsection=new'" class="button_skin_1" />
		</td>
	</tr>
	
</table>
<br />
<table width="100%" style="font-size: 12px;">
	<tr>
		<td class="paging"  align="center" height="25" colspan="6">
			<input type="button" value=" &lt; " ONCLICK="elements['data[page]'].value='<?php echo $this->_tpl_vars['PREV']; ?>
';submit();" class="button_skin_1">&nbsp;&nbsp;
			<?php echo $this->_tpl_vars['PAGE']; ?>
 / <span style="display: inline; clear: none; width: 23px; text-align: center;"><?php echo $this->_tpl_vars['PAGES']; ?>
</span>
			&nbsp;&nbsp;<input type="button" value=" &gt; " ONCLICK="elements['data[page]'].value='<?php echo $this->_tpl_vars['NEXT']; ?>
';submit();" class="button_skin_1">
		</td>
	</tr>
</table>


</form>