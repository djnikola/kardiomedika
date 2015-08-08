<?php /* Smarty version 2.6.26, created on 2014-10-06 16:54:17
         compiled from admin/main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'checkUserPrivileges', 'admin/main.tpl', 40, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="UTF-8"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<title><?php echo $this->_tpl_vars['labels']['administration_panel']; ?>
</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Admin panel"/>
    <meta name="keywords" content="Admin panel"/>
   
    
    <link rel="shortcut icon" href="favicon.ico"/>
    <link rel="icon" href="favicon.ico" type="image/ico"/>
    <link rel="stylesheet" href="../scripts/css/admin/style.css" type="text/css" />
    
    <link rel="stylesheet" href="../scripts/css/snippets.css" type="text/css" />
    
    <script type="text/javascript" src="../scripts/java_scripts/common.js"></script>

 <!-- dhtmlgoodies_calendar -->
    <script type="text/javascript" src="../scripts/java_scripts/dhtmlgoodies_calendar.js"></script>
    <link rel="stylesheet" type="text/css" href="../scripts/css/admin/dhtmlgoodies_calendar.css"/>

    <script type="text/javascript" src="../scripts/java_scripts/jquery.js"></script>

</head>

<body id="<?php echo $this->_tpl_vars['section']; ?>
">

<div id="wrapper">
    
    <!-- Central content controled by modules -->
	<div class="content clearfix ">
	
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
    <?php echo checkUserPrivilegesSmarty(array('permission' => 'permission','section' => $this->_tpl_vars['section'],'subsection' => $this->_tpl_vars['subsection']), $this);?>

    <?php if (isset ( $_SESSION['loged'] ) && $_SESSION['loged'] == 1 && $this->_tpl_vars['permission']): ?>
    <tr>
    <td  class="_left">
    	
			<?php if (isset ( $_SESSION['loged'] ) && $_SESSION['loged'] == 1): ?>
			<div class="menu_holder">
				<?php $_from = $this->_tpl_vars['menu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['menuitem']):
?>
					<?php if ($_SESSION['user']['group'] == $this->_tpl_vars['menuitem']['user_group']): ?>
					<ul>
						<li><a href="<?php echo $this->_tpl_vars['menuitem']['link']; ?>
"><?php echo $this->_tpl_vars['menuitem']['caption']; ?>
</a></li>
					</ul>
					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</div>

			<?php endif; ?>
       
    </td>
    <td class="_main">  
       	
        	
            	<div class="toolbar">
                	<?php if (isset ( $_SESSION['loged'] ) && $_SESSION['loged'] == 1): ?>
                	<?php echo $this->_tpl_vars['labels']['you_are_loged_as']; ?>
: <strong><?php echo $_SESSION['user']['username']; ?>
</strong>
                    <div class="logout"><a href="index.php?navi=login&subnavi=logout">Logout</a></div>
					<?php endif; ?>
                </div>
                
                <div class="inner">
                
                    <?php if (isset ( $this->_tpl_vars['errors'] )): ?>
				    <div class="messages_errors">
				    	<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
				    	<span><?php echo $this->_tpl_vars['error']; ?>
</span><br />
				    	<?php endforeach; endif; unset($_from); ?>
				    </div>
				    <?php endif; ?>
				    
				    <?php if (isset ( $this->_tpl_vars['notices'] )): ?>
				    <div class="messages_notices">
				    	<?php $_from = $this->_tpl_vars['notices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['notice']):
?>
				    	<span><?php echo $this->_tpl_vars['notice']; ?>
</span><br />
				    	<?php endforeach; endif; unset($_from); ?>
				    </div>
				    <?php endif; ?>
                
                
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
                </div>

        </td>
        </tr>
       
		<?php else: ?>
		<tr>
		<td>
			<?php if (isset ( $this->_tpl_vars['errors'] )): ?>
		    <div class="messages_errors">
		    	<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['error']):
?>
		    	<span><?php echo $this->_tpl_vars['error']; ?>
</span><br />
		    	<?php endforeach; endif; unset($_from); ?>
		    </div>
		    <?php endif; ?>
		    
		    <?php if (isset ( $this->_tpl_vars['notices'] )): ?>
		    <div class="messages_notices">
		    	<?php $_from = $this->_tpl_vars['notices']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['notice']):
?>
		    	<span><?php echo $this->_tpl_vars['notice']; ?>
</span><br />
		    	<?php endforeach; endif; unset($_from); ?>
		    </div>
		    <?php endif; ?>
		    
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['template']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</td>
		</tr>
		<?php endif; ?>
		
    </table>

    </div>
    
    <!-- Footer -->       
    <div class="footer">
    	        
		<div class="footer_address">
			 Copyright &copy; <a href="http://www.kardiomedika.com" target="_target">Kardiomedika <?php echo $this->_tpl_vars['current_year']; ?>
</a>
        </div>      
	</div>
		
</div>

</body>
</html>

