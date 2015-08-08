<?php /* Smarty version 2.6.26, created on 2014-10-06 16:54:17
         compiled from admin/login/admin_login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'admin/login/admin_login.tpl', 6, false),)), $this); ?>
<form action="index.php?section=login&subsection=login_action" method="post" class="admin_login_form">

				<table cellpadding="3"  cellspacing="3" border="0">
					<tr>
					<td><label><?php echo $this->_tpl_vars['labels']['username']; ?>
:</label>
					<input  name="username" alt="username" type="text" class="input_skin_1" value="<?php echo ((is_array($_tmp=@$_POST['username'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" /></td>
					</tr>
					
					<tr>
					<td><label><?php echo $this->_tpl_vars['labels']['pass']; ?>
:</label>
					<input type="password"  name="password" value="" class="input_skin_1"  alt="password"  /></td>
					</tr>
					 
					<tr>
						<td>
						<label></label><input type="submit" value="Login" class="button_skin_1">
						</td>
					</tr>
				</table>
				
					

</form>