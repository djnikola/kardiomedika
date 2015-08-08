<?php /* Smarty version 2.6.26, created on 2015-01-21 05:36:22
         compiled from contents/articles/view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'articles_seo_url', 'contents/articles/view.tpl', 26, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
    
    /* Apply fancybox to multiple items */
	$("a.element").fancybox();    

});
</script>
<table cellpadding="0" cellspacing="0" border="0" class="event_table">         
<tr>
	<td valign="top" class="image_holder">
		<?php if ($this->_tpl_vars['single_articles']->image_thumbnail != ''): ?>
		<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['single_articles']->image; ?>
" class="element" rel="Kardiomedika"  author="Kardiomedika" >
			<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['single_articles']->image_thumbnail; ?>
" alt="<?php echo $this->_tpl_vars['single_articles']->caption; ?>
"/> 
		</a>
		<?php else: ?>
			<img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/no-image.png" alt="<?php echo $this->_tpl_vars['single_articles']->caption; ?>
" />
		<?php endif; ?>
	</td>
	<td class="caption_holder">
		<h2><?php echo $this->_tpl_vars['single_articles']->caption; ?>
</h2>

		<div class="fb-like" data-href="<?php echo articles_seo_url(array('articles_id' => $this->_tpl_vars['article']['articles_id'],'title' => $this->_tpl_vars['article']['caption'],'type' => $this->_tpl_vars['article']['articles_type']), $this);?>
" data-send="true" data-width="450" data-show-faces="false"></div>
		<!-- <a	href="<?php echo articles_seo_url(array('articles_id' => $this->_tpl_vars['new']['articles_id'],'title' => $this->_tpl_vars['new']['caption'],'type' => $this->_tpl_vars['new']['articles_type']), $this);?>
"><?php echo $this->_tpl_vars['labels']['read_more']; ?>
</a>-->
	</td>
</tr>
<tr>
	<td colspan="2" class="content_holder">
		<?php echo $this->_tpl_vars['single_articles']->content; ?>

	</td>
</tr>
</table>