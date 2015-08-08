<?php /* Smarty version 2.6.26, created on 2014-10-28 12:11:27
         compiled from admin/users/list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'checkUserPrivileges', 'admin/users/list.tpl', 72, false),)), $this); ?>
<script language="javascript">

function set_order(order) {
  var f = document.forms['user_list'];
  var o = f.elements['data[order]'];

  if (o.value == order) {
  	order = order.replace(/,/g,' desc,');
    order = order + ' desc';
  }

  o.value = order;

  f.elements['submit[filter]'].click();
}
</script>
<form name="user_list" action="index.php?section=users" method="post" enctype="multipart/form-data" class="forms">
<input type="hidden" name="data[order]" value="<?php echo $this->_tpl_vars['ORDER']; ?>
">

<h1><?php echo $this->_tpl_vars['labels']['users']; ?>
</h1>


<br />

	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="grid_table">
                        <tr class="table_header">
                            <td colspan="6">
                            <?php echo $this->_tpl_vars['labels']['list']; ?>

                            </td>
                        </tr>
                        <tr>
                            <th class="right_border">
                            	<a href="#" onClick="set_order('u.username');return false;"><?php echo $this->_tpl_vars['labels']['username']; ?>
</a>
                            </th>
                            <th class="right_border">
                            	<a href="#" onClick="set_order('u.first_name');return false;"><?php echo $this->_tpl_vars['labels']['name']; ?>
</a>
                            </th>
                            <th class="right_border">
                            	<a href="#" onClick="set_order('u.last_name');return false;"><?php echo $this->_tpl_vars['labels']['surname']; ?>
</a>
                            </th>
                            
                            <th class="right_border">
                            <a href="#" onClick="set_order('u.fk_group_id');return false;"><?php echo $this->_tpl_vars['labels']['user_role']; ?>
</a>
                            </th>
                            
                            
                            <th width="120px">
                            	<a href="#"><?php echo $this->_tpl_vars['labels']['action']; ?>
</a>
                            </th>
                        </tr>
                        
                        <?php $_from = $this->_tpl_vars['users_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
                        <tr class="table_row">
                            <td>
                            <strong><?php echo $this->_tpl_vars['user']['username']; ?>
</strong>
                            </td>
                            <td>
                            <?php echo $this->_tpl_vars['user']['first_name']; ?>

                            </td>
                            <td>
                            <?php echo $this->_tpl_vars['user']['last_name']; ?>

                            </td>
                            <td>
                            <?php if ($this->_tpl_vars['user']['fk_group_id'] == 1): ?>
                            Administrator
                            <?php else: ?>
                            Moderator
                            <?php endif; ?>
                            </td>
                            
                            <td align="center">
                            <?php echo checkUserPrivilegesSmarty(array('permission' => 'permission','section' => 'users','subsection' => 'new'), $this);?>

                            <?php if ($this->_tpl_vars['permission'] == 1): ?>
                            <a class="button_skin_1" href="index.php?section=users&subsection=new&user_id=<?php echo $this->_tpl_vars['user']['user_id']; ?>
"><?php echo $this->_tpl_vars['labels']['edit']; ?>
</a>
                            <?php endif; ?>
                            <?php echo checkUserPrivilegesSmarty(array('permission' => 'permission','section' => 'users','subsection' => 'delete'), $this);?>

                            <?php if ($this->_tpl_vars['permission'] == 1): ?>
							<a class="button_skin_1" href="index.php?section=users&subsection=delete&user_id=<?php echo $this->_tpl_vars['user']['user_id']; ?>
" onclick="return confirm('<?php echo $this->_tpl_vars['labels']['are_you_sure']; ?>
?');"><?php echo $this->_tpl_vars['labels']['delete']; ?>
</a>
                            <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; endif; unset($_from); ?>
                        
					    <?php if (isset ( $this->_tpl_vars['no_result'] )): ?>
						<tr>
							<td class="table_row" align="center" colspan="5">
							<?php echo $this->_tpl_vars['no_result']; ?>

							</td>
						</tr>
						<?php endif; ?>
                        
                        <tr>
                        	<td class="table_row" colspan="6"><input type="button"  value="<?php echo $this->_tpl_vars['labels']['add']; ?>
" onclick="location.href='index.php?section=users&subsection=new'" class="button_skin_1" /></td>
                        </tr>

                    </table>


	
<table width="100%">
	<tr>
		<td class="paging"  align="center" height="25" colspan="6">
			<input type="button" value=" &lt; " ONCLICK="elements['data[page]'].value='<?php echo $this->_tpl_vars['PREV']; ?>
';submit();" class="button_skin_1">&nbsp;&nbsp;
			<?php echo $this->_tpl_vars['PAGE']; ?>
 / <span style="displ1ay: inline; clear: none; width: 23px; text-align: center;"><?php echo $this->_tpl_vars['PAGES']; ?>
</span>
			&nbsp;&nbsp;<input type="button" value=" &gt; " ONCLICK="elements['data[page]'].value='<?php echo $this->_tpl_vars['NEXT']; ?>
';submit();" class="button_skin_1">
		</td>
	</tr>
</table>

</form>