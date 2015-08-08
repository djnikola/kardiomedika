<?php /* Smarty version 2.6.26, created on 2014-10-06 21:20:04
         compiled from contents/tests/blood_presure_email.tpl */ ?>
<table border="0" cellspacing="0" cellpadding="0" width="500">
	<tr>
		<th align="left">
			<label>Ime:</label>
		</th>
		<td>
			<strong><?php echo $this->_tpl_vars['first_name']; ?>
</strong>&nbsp;
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Prezime:</label>
		</th>
		<td>
			<strong><?php echo $this->_tpl_vars['last_name']; ?>
</strong>&nbsp;
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Godina rođenja:</label>
		</th>
		<td>
			<strong><?php echo $this->_tpl_vars['birth_year']; ?>
</strong>&nbsp;
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Telefon:</label>
		</th>
		<td>
			<strong><?php echo $this->_tpl_vars['phone']; ?>
</strong>&nbsp;
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Email:</label>
		</th>
		<td>
			<strong><?php echo $this->_tpl_vars['email']; ?>
</strong>&nbsp;
		</td>
	</tr>
	
</table>
<br />
<table border="1" style="border-collapse:separate;border-spacing:0 5px;" cellpadding="0" cellspacing="0" summary="Dnevnik krvnog pritiska">
<tr>
	<th width="150px">Datum</th>
	<th width="110px">Vreme</th>
	<th width="70px">Gornji</th>
	<th width="70px">Donji</th>
	<th width="70px">Puls/min</th>
	<th>Komentar</th>
</tr>
<?php $_from = $this->_tpl_vars['messure']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['messure_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['messure_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['messure_loop']['iteration']++;
?> 
<tr style="{border:2px solid #ff0000;}">
	<td rowspan="3"><?php echo $this->_tpl_vars['item']['day']; ?>
. dan </td>
	<td><label>Jutro:</label><strong><?php echo $this->_tpl_vars['item']['morning_time']; ?>
</strong> h</td>
	<td><b><?php echo $this->_tpl_vars['item']['morning_upper']; ?>
</b>&nbsp;</td>
	<td><b><?php echo $this->_tpl_vars['item']['morning_down']; ?>
</b>&nbsp;</td>
	<td><b><?php echo $this->_tpl_vars['item']['morning_puls']; ?>
</b>&nbsp;</td>
	<td><b><?php echo $this->_tpl_vars['item']['morning_comments']; ?>
</b>&nbsp;</td>
</tr>
<tr>
	<td><label></label><strong><?php echo $this->_tpl_vars['item']['afternoon_time']; ?>
</strong> h</td>
	<td><b><?php echo $this->_tpl_vars['item']['afternoon_upper']; ?>
</b>&nbsp;</td>
	<td><b><?php echo $this->_tpl_vars['item']['afternoon_down']; ?>
</b>&nbsp;</td>
	<td><b><?php echo $this->_tpl_vars['item']['afternoon_puls']; ?>
</b>&nbsp;</td>
	<td><b><?php echo $this->_tpl_vars['item']['afternoon_comments']; ?>
</b>&nbsp;</td>
</tr>
<tr>
	<td><label>Veče:</label><strong><?php echo $this->_tpl_vars['item']['evening_time']; ?>
</strong> h</td>
	<td><b><?php echo $this->_tpl_vars['item']['evening_upper']; ?>
</b>&nbsp;</td>
	<td><b><?php echo $this->_tpl_vars['item']['evening_down']; ?>
</b>&nbsp;</td>
	<td><b><?php echo $this->_tpl_vars['item']['evening_puls']; ?>
</b>&nbsp;</td>
	<td><b><?php echo $this->_tpl_vars['item']['evening_comments']; ?>
</b>&nbsp;</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
	<td colspan="2">Srednje vrednosti 6 dana.<br />(Bez prvog dana!)</td>
	<td><span id="avg_upper"><?php echo $this->_tpl_vars['avg_upper']; ?>
</span>&nbsp;</td>
	<td><span id="avg_down"><?php echo $this->_tpl_vars['avg_down']; ?>
</span>&nbsp;</td>
	<td><span id="avg_puls"><?php echo $this->_tpl_vars['avg_puls']; ?>
</span>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table>
<br />