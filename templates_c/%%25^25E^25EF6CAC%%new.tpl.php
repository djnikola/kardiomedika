<?php /* Smarty version 2.6.26, created on 2014-10-06 16:56:28
         compiled from admin/pages/new.tpl */ ?>
<script language="javascript" type="text/javascript" src="../external/tiny/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/java_scripts/tiny.js"></script>

<script type="text/javascript">

function openSection(section_id){
	var container = document.getElementById('info_container');
    var trs = container.getElementsByTagName("tr");

    for(var i=0;i<trs.length;i++)
    {
        if(trs[i].style  && trs[i].className == 'removable') {
            if(trs[i].id == section_id){
                trs[i].style.display = 'block';
            }else{
                trs[i].style.display = 'none';
            }
        }
    }
	
}

</script>

<form action="index.php?section=pages&subsection=new" method="post">
<input type="hidden" name="page_id" value="<?php echo $this->_tpl_vars['page_id']; ?>
">
<input type="hidden" name="data[parent]" value="<?php echo $this->_tpl_vars['parent']; ?>
">
	
	<h1><?php echo $this->_tpl_vars['labels']['add_edit']; ?>
</h1>
		<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" class="grid_table" id="info_container">
			<tr class="table_header">
			    <td colspan="4">
                    <?php echo $this->_tpl_vars['labels']['page']; ?>

			    </td>
			</tr>
            <?php if ($this->_tpl_vars['parent'] == 0): ?>
            <tr>
			<td><label>Menu Position:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                <select name="data[show_place]" class="select_skin_1">
                    <option value="first" <?php if ($this->_tpl_vars['show_place'] == 'first'): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['labels']['main_navigation']; ?>
</option>
                    <option value="second" <?php if ($this->_tpl_vars['show_place'] == 'second'): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['labels']['footer_links']; ?>
</option>
                    <option value="forth" <?php if ($this->_tpl_vars['show_place'] == 'forth'): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['labels']['pediatrics']; ?>
</option>
                    <option value="third" <?php if ($this->_tpl_vars['show_place'] == 'third'): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['labels']['neurology']; ?>
</option>
                    <option value="fifth" <?php if ($this->_tpl_vars['show_place'] == 'fifth'): ?>selected=selected<?php endif; ?>><?php echo $this->_tpl_vars['labels']['psychiatry']; ?>
</option>
                </select>
			</td>
            </tr>
            <?php else: ?>
            <input type="hidden" name="data[show_place]" value="<?php echo $this->_tpl_vars['show_place']; ?>
" />
            <?php endif; ?>
			<tr>
				<td id="input">
				<label><?php echo $this->_tpl_vars['labels']['title']; ?>
:</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="data[caption]" value="<?php echo $this->_tpl_vars['caption']; ?>
" class="input_skin_1" id="caption">
				</td>
		
			</tr>
            
            <tr>
				<td id="input">
				<label><?php echo $this->_tpl_vars['labels']['visible_in_menus']; ?>
: </label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <labels><?php echo $this->_tpl_vars['labels']['yes']; ?>
<input type="radio" name="data[navigation]" value="yes" class="input_skin_1" <?php if ($this->_tpl_vars['navigation'] == 'yes'): ?>checked<?php endif; ?> ></labels>
                    <labels><?php echo $this->_tpl_vars['labels']['no']; ?>
<input type="radio" name="data[navigation]" value="no" class="input_skin_1" <?php if ($this->_tpl_vars['navigation'] == 'no'): ?>checked<?php endif; ?> ></labels>
				</td>
		
			</tr>
                       
            
            
				
            
                  
			<tr> 
				<td>
				<label id="input"><b><?php echo $this->_tpl_vars['labels']['content']; ?>
:*</b></label><br>
			
				<textarea id="html_content" name="data[content]"><?php echo $this->_tpl_vars['content']; ?>
</textarea>
				<script language="javascript" type="text/javascript">
				//<!--
					applyTiny("html_content","<?php echo $this->_tpl_vars['WEBROOT']; ?>
",520, 300, lang='<?php echo $this->_tpl_vars['lang']; ?>
');
				//-->
				</script>
				
				</td>
			</tr>
			
			<tr>
				<td>
				<input type="submit" name="submit[save]" value="<?php echo $this->_tpl_vars['labels']['save']; ?>
" class="button_skin_1">&nbsp;
				<input type="submit" name="submit[cancel]" value="<?php echo $this->_tpl_vars['labels']['cancel']; ?>
" class="button_skin_1">
				</td>
			</tr>
			
		</table>

	
</form>