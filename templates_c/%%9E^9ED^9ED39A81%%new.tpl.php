<?php /* Smarty version 2.6.26, created on 2014-10-27 16:31:17
         compiled from admin/articles/new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/articles/new.tpl', 54, false),)), $this); ?>
<script language="javascript" type="text/javascript" src="../external/tiny/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/java_scripts/tiny.js"></script>
<form action="index.php?section=articles&subsection=new" method="post" enctype="multipart/form-data">
<input type="hidden" name="articles_id" value="<?php echo $this->_tpl_vars['article']->articles_id; ?>
">
<input type="hidden" name="data[image_path]" value="<?php echo $this->_tpl_vars['image']; ?>
">
<input type="hidden" name="data[image_name]" value="<?php echo $this->_tpl_vars['image_name']; ?>
"> 

	<h1><?php echo $this->_tpl_vars['labels']['add_edit']; ?>
</h1>
		<table align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="grid_table">
		
			<tr class="table_header">
			    <td colspan="2">
			    <?php echo $this->_tpl_vars['labels']['data']; ?>

			    </td>
			</tr>
			<tr class="table_row">
				<td>
				<label><?php echo $this->_tpl_vars['labels']['title']; ?>
:*</label>
				</td>
				<td>
                    <input type="text" name="data[caption]" value="<?php echo $this->_tpl_vars['article']->caption; ?>
" class="input_skin_1" />
				</td>
			</tr>
			 
			<input type="hidden" name="data[articles_type]" value="<?php echo $this->_tpl_vars['article']->articles_type; ?>
"/>
			<tr>
				<td >
				<label><?php echo $this->_tpl_vars['labels']['active']; ?>
:</label>
				</td>
				<td>
					<select name="data[is_active]" class="select_skin_1" style="width: 50px;">
					<?php echo $this->_tpl_vars['dropdown_is_active']; ?>

					</select>
				</td>
			</tr>
                        
                        <tr>
				<td>
				<label><?php echo $this->_tpl_vars['labels']['article_type']; ?>
:</label>
				</td>
				<td>
                                    <select name="data[articles_type]" class="select_skin_1">
                                        <option></option>
                                        <?php echo $this->_tpl_vars['dropdown_articles_type']; ?>

                                    </select>
				</td>
			</tr>
			
			<tr>
				<td>
				<label><?php echo $this->_tpl_vars['labels']['date']; ?>
:</label>
				</td>
				<td>
				<input type="text" name="data[publish_date]" id="publish_date" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['article']->publish_date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y") : smarty_modifier_date_format($_tmp, "%d/%m/%y")); ?>
" class="input_skin_1" />
				<img src="../templates/images/admin/icons/calendar.png" onclick="displayCalendar(document.getElementById('publish_date'),'dd/mm/yyyy',this)">
				<strong>dd/mm/yyyy</strong>
				</td>
			</tr>
			<tr>
				<td >
				<label><?php echo $this->_tpl_vars['labels']['picture']; ?>
:</label>
				</td>
				<td>
				<?php if ($this->_tpl_vars['image']): ?>
                <a href="../<?php echo $this->_tpl_vars['image']; ?>
" target="_blank"><img src="../<?php echo $this->_tpl_vars['image']; ?>
" alt="" border="0" width="150"/></a><br/>
				<label><input type="checkbox" name="data[remove_picture]" value="1"/>Remove </label><br/>
				<?php endif; ?>
				<input type="file" name="image"  />
				</td>
			</tr>
			<tr class="table_row">
				<td>
				<label><?php echo $this->_tpl_vars['labels']['location']; ?>
:*</label>
				</td>
				<td>
                    <input type="text" name="data[location]" value="<?php echo $this->_tpl_vars['article']->location; ?>
" class="input_skin_1" />
				</td>
			</tr>
            
                    <input type="hidden" name="data[highlights]" value="" class="input_skin_1" />
				
        </table>
        <table align="center" width="100%" cellpadding="5" cellspacing="0" border="0" class="grid_table"> 
            <tr <?php if ($this->_tpl_vars['article']->articles_type == 'termine'): ?>style="display:none;"<?php endif; ?> id="articles" class="removable">

                <td colspan="2">
                <label id="input"><?php echo $this->_tpl_vars['labels']['content']; ?>
:*</label><br>
                <textarea id="html_2" name="data[content]" ><?php echo $this->_tpl_vars['article']->content; ?>
</textarea>

                <script language="javascript" type="text/javascript">
                //<!--
                    applyTiny("html_2","<?php echo $this->_tpl_vars['WEBROOT']; ?>
", 520, 300, lang='<?php echo $this->_tpl_vars['lang']; ?>
');
                //-->
                </script>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                <input type="submit" name="submit[save]" value="<?php echo $this->_tpl_vars['labels']['save']; ?>
" class="button_skin_1" />&nbsp;
                <input type="submit" name="submit[cancel]" value="<?php echo $this->_tpl_vars['labels']['cancel']; ?>
" class="button_skin_1" />
                </td>
            </tr>

        </table>

</form>