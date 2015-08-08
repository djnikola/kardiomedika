﻿<!--<form action="index.php?section=forms&amp;subsection=contact_form" method="post" class="custom_forms">-->
<script type="text/javascript">
$(document).ready(function(){
	$( "#from_date" ).datepicker({ dateFormat: 'dd.mm.yy' });
	$( "#to_date" ).datepicker({ dateFormat: 'dd.mm.yy' });
	$( "#from_date" ).datepicker( "option", "dayNamesMin", ['Ne', 'Po', 'Ut', 'Sr', 'Če', 'Pe', 'Su'] );
	$( "#to_date" ).datepicker( "option", "dayNamesMin", ['Ne', 'Po', 'Ut', 'Sr', 'Če', 'Pe', 'Su'] );
	$( "#from_date" ).datepicker( "option", "dayNamesMin", ['Ne', 'Po', 'Ut', 'Sr', 'Če', 'Pe', 'Su'] );
	$( "#from_date" ).datepicker( "option", "monthNames", ['Januar','Februar','Mart','April','Maj','Jun','Juli','Avgust','Septembar','Oktobar','Novembar','Decembar'] );
	$( "#to_date" ).datepicker( "option", "monthNames", ['Januar','Februar','Mart','April','Maj','Jun','Juli','Avgust','Septembar','Oktobar','Novembar','Decembar'] );	
});
</script>
<form action="{[$baseUrl]}sr/zakazivanje-pregleda" method="post" class="custom_forms">
	<div class="title_text">
	<h2>Zakazivanje pregleda on-line</h2>
	</div>	

	<div class="contact-form">
        
        <table cellspan="0" cellpadding="0" border="0">
            <tr>
                <td><label><p>{[$labels.name]}:</p></label></td>
                <td><input type="text" name="data[name]" value="{[$name]}" id="name" class="input_field {[if isset($errors.name) && $errors.name ==1 ]}error_input{[/if]}" size="50" /></td>
            </tr>
            <tr>
                <td><label><p>Prezime:</p></label></td>
                <td><input type="text" name="data[lname]" value="{[$lname]}" id="lname" class="input_field {[if isset($errors.lname) && $errors.lname ==1 ]}error_input{[/if]}" size="50" /></td>
            </tr>
            <tr>
                <td><label><p>{[$labels.telephone]}:</p></label></td>
                <td><input type="text" name="data[phone]" value="{[$phone]}" id="phone" class="input_field {[if isset($errors.phone) && $errors.phone ==1 ]}error_input{[/if]}" size="50" /></td>
            </tr>
            <tr>
                <td><label><p>Godina rođenja:</p></label></td>
                <td><input type="text" name="data[birth_year]" value="{[$birth_year]}" id="birth_year" class="input_field {[if isset($errors.birth_year) && $errors.birth_year ==1 ]}error_input{[/if]}" size="50" /></td>
            </tr>
            <tr>
                <td><label><p>Email:</p></label></td>
                <td><input type="text" name="data[email]" value="{[$email]}" id="email" class="input_field {[if isset($errors.email) && $errors.email ==1 ]}error_input{[/if]}" size="50" /></td>
            </tr>
            <tr>
            	<td><p>Datum pregleda:</p></td>
            	<td>
            		<input type="text" name="data[from_date]" id="from_date" value="{[$from_date]}" class="input_field" style="width:80px;"/>
				</td>
            </tr>
            <tr>
            	<td><p>Alternativni datum pregleda:</p></td>
            	<td>
            		<input type="text" name="data[to_date]" id="to_date" value="{[$to_date]}" class="input_field" style="width:80px;"/>
				</td>
            </tr>
            <tr>
                <td><label><p>Ime doktora:</p></label></td>
                <td><input type="text" name="data[doctor_name]" value="{[$doctor_name]}" id="doctor_name" class="input_field" size="50"></td>
            </tr>
            <tr>
                <td><label><p>Vrsta pregleda:</p></label></td>
                <td><input type="text" name="data[examination]" value="{[$examination]}" id="examination" class="input_field" size="50"></td>
            </tr>
            <tr>
                <td><label><p>Vreme pregleda:</p></label></td>
                <td>
					<select name="data[daily_period]" class="input_field select_field">
                	<option value="">Odaberite termin</option>
                	<option value="am">Prepodnevni termin</option>
                	<option value="pm">Popodnevni termin</option>
                	</select>	
                </td>
            </tr>
            <tr>
                <td><label><p>Opis tegoba (razlog javljanja):</p></label></td>
                <td><textarea name="data[message]"  id="message" class="input_field {[if isset($errors.message) && $errors.message ==1 ]}error_input{[/if]}" rows="8" cols="56" >{[$message]}</textarea></td>
            </tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit[send]" value=" Pošalji " class="input_btn" /></td>
			</tr>
        </table>
        
	</div>
	{[if isset($errors) && (count($errors) > 0)]}
	<span style="color:red;"><p>Crveno uokvirena polja moraju biti ispravno popunjena!</p></span>
	{[/if]}
	<br/>
	
<div style="margin-left: 90px; margin-top: 20px; width: 480px;">	
</div>
</form>
<h2>Zakazivanje pregleda telefonom</h2>
<img src="/uploads/image/callcentar.jpg" />
<p>
<strong>Zakazivanje pregleda, informacije :</strong><br />
pozivom na brojeve 018/ 4257 213 ; 064 860 91 41<br />
Radno vreme poliklinike:<br />
radnim danom od 08h do 21h<br />
subotom od 08h do 14h
<br /><br />
<strong>Konsultacije sa doktorom :</strong><br />
radim danom od 08h do 21h,<br />
subotom do 14h na tel: 018/ 4257 213, ili 064 860 91 41 ,
<br /><br />
<strong>Za hitne pozive i konsultacije:</strong><br/>
telefon: 063 80 55 456
<br /><br />
<strong>
Za <u>hitne preglede</u> ili vremenski neodložne preglede postoji mogućnost, nakon dogovora, zakazivanje pregleda i u neradnim danima, subota popodne, nedelja, praznici. 
</strong>
</p>