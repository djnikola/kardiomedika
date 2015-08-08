<?php /* Smarty version 2.6.26, created on 2015-01-21 05:31:51
         compiled from contents/articles/list.tpl */ ?>
<form name="articles_list" action="index.php?section=articles&type=<?php echo $this->_tpl_vars['type']; ?>
&page_id=<?php echo $this->_tpl_vars['page_id']; ?>
" method="post" enctype="multipart/form-data">
<input type="hidden" name="data[page]" value="<?php echo $this->_tpl_vars['PAGE']; ?>
" />
<h2><?php echo $this->_tpl_vars['articles_title']; ?>
</h2>
    <strong><?php echo $this->_tpl_vars['articles_content']; ?>
</strong>
    <br /><br /><br /><br />
	<?php $_from = $this->_tpl_vars['articles_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['article']):
?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "contents/articles/articles_list_element.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endforeach; endif; unset($_from); ?>


    <?php if (isset ( $this->_tpl_vars['no_result'] )): ?>
        <h3><?php echo $this->_tpl_vars['labels']['no_results']; ?>
</h3>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['PAGES'] > 1): ?>
        <div class="paging" align="center">
        <input type="button" value=" &#171; " ONCLICK="elements['data[page]'].value='<?php echo $this->_tpl_vars['PREV']; ?>
';submit();" class="button_paging">&nbsp;&nbsp;
        <?php echo $this->_tpl_vars['labels']['found']; ?>
: <?php echo $this->_tpl_vars['TOTAL']; ?>
,&nbsp;&nbsp; <?php echo $this->_tpl_vars['labels']['pages']; ?>
 <?php echo $this->_tpl_vars['PAGE']; ?>
 <?php echo $this->_tpl_vars['labels']['of']; ?>
 <span style="displ1ay: inline; clear: none; width: 23px; text-align: center;"><?php echo $this->_tpl_vars['PAGES']; ?>
, <?php echo $this->_tpl_vars['labels']['with']; ?>
 <?php echo $this->_tpl_vars['PER_PAGE']; ?>
 <?php echo $this->_tpl_vars['labels']['per_page']; ?>
</span>
        &nbsp;&nbsp;<input type="button" value=" &#187; " ONCLICK="elements['data[page]'].value='<?php echo $this->_tpl_vars['NEXT']; ?>
';submit();" class="button_paging">
        </div>	
    <?php endif; ?>                                
</form>