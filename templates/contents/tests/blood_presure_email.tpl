<table border="0" cellspacing="0" cellpadding="0" width="500">
	<tr>
		<th align="left">
			<label>Ime:</label>
		</th>
		<td>
			<strong>{[$first_name]}</strong>&nbsp;
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Prezime:</label>
		</th>
		<td>
			<strong>{[$last_name]}</strong>&nbsp;
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Godina rođenja:</label>
		</th>
		<td>
			<strong>{[$birth_year]}</strong>&nbsp;
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Telefon:</label>
		</th>
		<td>
			<strong>{[$phone]}</strong>&nbsp;
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Email:</label>
		</th>
		<td>
			<strong>{[$email]}</strong>&nbsp;
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
{[foreach name=messure_loop from=$messure item=item]} 
<tr style="{border:2px solid #ff0000;}">
	<td rowspan="3">{[$item.day]}. dan </td>
	<td><label>Jutro:</label><strong>{[$item.morning_time]}</strong> h</td>
	<td><b>{[$item.morning_upper]}</b>&nbsp;</td>
	<td><b>{[$item.morning_down]}</b>&nbsp;</td>
	<td><b>{[$item.morning_puls]}</b>&nbsp;</td>
	<td><b>{[$item.morning_comments]}</b>&nbsp;</td>
</tr>
<tr>
	<td><label></label><strong>{[$item.afternoon_time]}</strong> h</td>
	<td><b>{[$item.afternoon_upper]}</b>&nbsp;</td>
	<td><b>{[$item.afternoon_down]}</b>&nbsp;</td>
	<td><b>{[$item.afternoon_puls]}</b>&nbsp;</td>
	<td><b>{[$item.afternoon_comments]}</b>&nbsp;</td>
</tr>
<tr>
	<td><label>Veče:</label><strong>{[$item.evening_time]}</strong> h</td>
	<td><b>{[$item.evening_upper]}</b>&nbsp;</td>
	<td><b>{[$item.evening_down]}</b>&nbsp;</td>
	<td><b>{[$item.evening_puls]}</b>&nbsp;</td>
	<td><b>{[$item.evening_comments]}</b>&nbsp;</td>
</tr>
{[/foreach]}
<tr>
	<td colspan="2">Srednje vrednosti 6 dana.<br />(Bez prvog dana!)</td>
	<td><span id="avg_upper">{[$avg_upper]}</span>&nbsp;</td>
	<td><span id="avg_down">{[$avg_down]}</span>&nbsp;</td>
	<td><span id="avg_puls">{[$avg_puls]}</span>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
</table>
<br />