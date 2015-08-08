<?php /* Smarty version 2.6.26, created on 2014-10-04 03:34:15
         compiled from contents/gallery/view.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'contents/gallery/view.html', 26, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseUrl']; ?>
scripts/java_scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<script type="text/javascript">
$(document).ready(function() {
    
    /* Apply fancybox to multiple items */
	$("a.grouped_elements").fancybox();    

});
</script>

<form name="gallery_pictures_list" action="index.php?section=gallery&subsection=single_gallery&gallery_id=<?php echo $this->_tpl_vars['gallery_obj']->gallery_id; ?>
" method="post" enctype="multipart/form-data">
<input type="hidden" name="data[page]" value="<?php echo $this->_tpl_vars['PAGE']; ?>
" /> 

              <h2><?php echo $this->_tpl_vars['gallery_obj']->name; ?>
</h2>
              
              	<p>
					<?php echo $this->_tpl_vars['gallery_obj']->description; ?>

				</p>
              
              <?php $_from = $this->_tpl_vars['gallery_obj']->picture_arr; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['picture']):
?> 

				<div class="gallery_picture_list">
					<!-- <span class="gallery_picture_name"><?php echo ((is_array($_tmp=$this->_tpl_vars['picture']->name)) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, ' ...') : smarty_modifier_truncate($_tmp, 30, ' ...')); ?>
</span> -->
					<a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['picture']->path; ?>
" class="grouped_elements" rel="test" caption="<?php echo ((is_array($_tmp=$this->_tpl_vars['picture']->description)) ? $this->_run_mod_handler('truncate', true, $_tmp, 300, '') : smarty_modifier_truncate($_tmp, 300, '')); ?>
" title="<?php echo $this->_tpl_vars['picture']->name; ?>
"  author="Test" >

                        <span style="background-image:url(<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['picture']->thumbnail_path; ?>
);">
						
						</span>
					</a>	
				</div>

              <?php endforeach; endif; unset($_from); ?>
              <div style="clear:both;"></div>
   				
		<?php if (isset ( $this->_tpl_vars['no_result'] )): ?>
			<h5><?php echo $this->_tpl_vars['labels']['no_result']; ?>
</h5>
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