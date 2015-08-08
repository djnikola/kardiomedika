<?php /* Smarty version 2.6.26, created on 2015-01-21 05:31:51
         compiled from contents/articles/articles_list_element.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'articles_seo_url', 'contents/articles/articles_list_element.tpl', 5, false),array('modifier', 'date_format', 'contents/articles/articles_list_element.tpl', 15, false),array('modifier', 'truncate', 'contents/articles/articles_list_element.tpl', 18, false),)), $this); ?>

<div class="event clearfix">
    <div class="col-1">
        <?php if ($this->_tpl_vars['article']['image'] != ''): ?> 
            <a	href="<?php echo articles_seo_url(array('articles_id' => $this->_tpl_vars['article']['articles_id'],'title' => $this->_tpl_vars['article']['caption'],'type' => $this->_tpl_vars['article']['articles_type']), $this);?>
"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
<?php echo $this->_tpl_vars['article']['image']; ?>
" alt="<?php echo $this->_tpl_vars['article']['caption']; ?>
"/></a>
        <?php else: ?>
            <a	href="<?php echo articles_seo_url(array('articles_id' => $this->_tpl_vars['article']['articles_id'],'title' => $this->_tpl_vars['article']['caption'],'type' => $this->_tpl_vars['article']['articles_type']), $this);?>
"><img src="<?php echo $this->_tpl_vars['baseUrl']; ?>
templates/images/no-image.png" alt="<?php echo $this->_tpl_vars['article']['caption']; ?>
"/></a>
        <?php endif; ?>    
    </div>
    <div class="col-2">
    <h3><?php echo $this->_tpl_vars['article']['caption']; ?>
</h3>
    <table class="event-data">
        <tr>
            <th align="left" width="70"><?php echo $this->_tpl_vars['labels']['date']; ?>
:</th>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['article']['publish_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y.") : smarty_modifier_date_format($_tmp, "%d.%m.%Y.")); ?>
</td>
        </tr>
        <tr>
            <td colspan="2"><?php echo ((is_array($_tmp=$this->_tpl_vars['article']['content'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 140, "...", true) : smarty_modifier_truncate($_tmp, 140, "...", true)); ?>
</td>
        </tr>
    </table>
    
			<a	href="<?php echo articles_seo_url(array('articles_id' => $this->_tpl_vars['article']['articles_id'],'title' => $this->_tpl_vars['article']['caption'],'type' => $this->_tpl_vars['article']['articles_type']), $this);?>
" class="more left"> &raquo; <?php echo $this->_tpl_vars['labels']['read_more']; ?>
</a>
    </div>
    
    <div class="fb-like" data-href="<?php echo articles_seo_url(array('articles_id' => $this->_tpl_vars['article']['articles_id'],'title' => $this->_tpl_vars['article']['caption'],'type' => $this->_tpl_vars['article']['articles_type']), $this);?>
" data-send="true" data-width="450" data-show-faces="false"></div>
</div>
                                        

                