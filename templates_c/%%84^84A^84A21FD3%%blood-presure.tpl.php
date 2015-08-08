<?php /* Smarty version 2.6.26, created on 2014-10-03 10:30:34
         compiled from contents/tests/blood-presure.tpl */ ?>
<script type="text/javascript">
function calculateAvg(type) {
	sum = new Number(0);
	num = 0;
	for (var i = 2; i <=7; i++) {
		if ($("#morning_"+type+"_"+i).val() && !isNaN($("#morning_"+type+"_"+i).val()) ) {
			sum += new Number($("#morning_"+type+"_"+i).val());
			num++;
		}
		
		if ($("#afternoon_"+type+"_"+i).val()) {
			sum += new Number($("#afternoon_"+type+"_"+i).val());
			num++;
		}
		
		if ($("#evening_"+type+"_"+i).val() && !isNaN($("#evening_"+type+"_"+i).val())) {
			sum += new Number($("#evening_"+type+"_"+i).val());
			num++;
		}
	}
	if (num > 0){
		return (Math.floor(sum/num));
	}
	return 0;
}

function calculateAll(){
	$("#avg_upper").text(calculateAvg("upper").toFixed(0));
	$("#avg_down").text(calculateAvg("down").toFixed(0));
	$("#avg_puls").text(calculateAvg("puls").toFixed(0));
}
</script>


<div id="content_accordion">
<ul>
<li>
	<h4>Preporuke za korektno merenje krvnog pritsika u kućnim uslovima</h4>
	<ul>
		<li>
			<ol>
			  <li>Najmanje 5 minuta odmora, 30 minuta bez fizičke aktivnosti, bez pušenja, jela, konzumiranja kofeinskih napitaka (kafa, čaj, koka kola…).</li>
			  <li>U sedećem položaju sa  ispruženom opuštenom rukom položenom na stolu.</li>
			  <li>Budite smireni, relaksirani (opušteni)  neprekrštenih nogu, bez pričanja.</li>
			  <li>Korektno postavite manžetnu na nadlakticu u visini srca.</li>
			  <li>Izbegavajte merenje krvnog  pritiska u trentuku   psihičkog uznemirenja, stresa, straha ili drugih subjektivnih tegoba.</li>
			  <li>Vrednosti merenja upišite u dnevnik uz obavezan komentar : razlog merenja u tom trenutku i šta je predhodilo.</li>
			</ol>
		</li>
	</ul>
	<h4>Klasifikacija hipertenzije</h4>
	<ul>
		<li>
			<table class="blod_preasure" cellpadding="0" cellspacing="0" summery="Tabela krvnog pritiska">
			<tr>
				<th width="150px">Kategorija</th>
				<th width="50px">Sistolni(Gornji)</th>
				<th width="50px">Dijastolni(Donji)</th>
			</tr>
			<tr>
				<td>Optimalni</td>
				<td> &lt; 120</td>
				<td> &lt; 80</td>
			</tr>
			<tr>
				<td>Normalni</td>
				<td> 120 - 129</td>
				<td> 80 - 84</td>
			</tr>
			<tr>
				<td>Visoki normalni</td>
				<td> 130 - 139</td>
				<td> 85 - 89</td>
			</tr>
			<tr>
				<td>Hipertenzija 1. stepena - blaga</td>
				<td> 140 - 159</td>
				<td> 90 - 99</td>
			</tr>
			<tr>
				<td>Hipertenzija 2. stepena - umerena</td>
				<td> 160 - 179</td>
				<td> 100 - 109</td>
			</tr>
			<tr>
				<td>Hipertenzija 3. stepena - teška</td>
				<td> &ge; 180</td>
				<td> &ge; 110</td>
			</tr>
			<tr>
				<td>Izolovana sistolna hipertenzija</td>
				<td> &ge; 140</td>
				<td> &lt; 90</td>
			</tr>
			</table>
		</li>
	</ul>
	<h4>Koliko često treba meriti krvni pritisak kod kuće?</h4>
	<ul>
		<li>
			
			<ol>
				<li>Za početnu procenu hipertenzije i ocenu efekata antihipertenzivnih   lekova krvni pritisak kod kuće treba pratiti tokom najmanje 3 a po mogućstvu 7 dana. 
    Merenja treba da budu ujutru (ubrzo nakon buđenja, pola sata, sat i pre uzimanja leka) i uveče (pre jela).
				</li>
				<li>Izračunajte prosek svih merenja (srednju vrednost pritiska i pulsa),  osim prvog dana. Ovaj 7- dnevni raspored treba slediti pre svake posete lekaru.
	Dugoročno praćenje podrazumeva ređe merenje krvnog pritiska (dva puta nedeljno) i odbacite vrednosti u stresnim situacijama, ili tegobama ( može da zavara, izbezumi i da završite u  hitnoj pomoći) .
				</li>
				<li>Rezultati treba da budu zapisani u dnevnik odmah posle svakog merenja, osim ako aparat ima memoriju i može da skladišti vrednosti krvnog pritiska sa vremenom i datumom svakog merenja, ili je povezan sa telefonskim sistemom prenosa.
				</li>
			</ol>
			
		</li>
	</ul>
	<h4>Šta je normalan krvni pritisak kod kuće?</h4>
	<ul>
		<li>
			<p>Kao što je pomenuto, ponavljanja merenja trebalo bi da daju pouzdanu sliku krvnog pritiska pojedinca u kućnim uslovima.
			Prosečan sistolni krvni pritisak izmeren u kućnim uslovima manji od 130 mmHg i dijastolni manji od 80 mmHg, smatra se normalnim krvnim pritiskom, dok sistolni krvni pritisak od 135 mmHg ili više i /ili dijastolni 85 mmHg ili više u kućnim uslovima smatra se povišenim krvnim pritiskom.
			</p>
		</li>
	</ul>
	<h4>Interpretacija merenja</h4>
	<ul>
		<li>
			<p>Prosek nekoliko kućnih merenja krvnog pritiska doneta za nekoliko dana dopunjuju merenja u poliklinici i pomažu lekaru da napravi preciznu dijagnozu.
Kućna merenja krvnog pritiska mogu se znatno razlikovati od merenja do merenja.
Krvni pritisak može biti prilično visok, naročito u slučaju stresne situacije (napad panike, bol, itd.), ili sasvim mali (npr. nakon dugog odmora ili posle intenzivne fizičke vežbe).
Visok krvni pritisak izmeren u jednom aktu ne bi trebalo da bude alarmantan, osim veoma visokih vrednosti koje opstaju i posle dovoljnog perioda odmora ili su u pratnji teških simptoma (npr. Kratak dah, bol u grudima, slabost ruku ili nogu, teškoće u govoru).
<br />
U nekim slučajevima, samo-izmereni krvni pritisak kod kuće može biti znatno niži od merenja u poliklinici. Ova pojava nije retka i poznata je kao „hipertenzija belog mantila“. 		S druge strane,  krvni pritisak može biti nizak u poliklinici, dok je samo-izmereni krvni pritisak kod kuće visok (maskirana hipertenzija).
<br />
Ovi primeri zahtevaju pažljivu procenu od strane lekara koji mogu tražiti dalje analize i ponovno praćenje krvnog pritiska kod kuće i/ili  aparatom za 24h automatsko ambulatrono merenje krvnog pritska (Holter pritiska). Na osnovu nalaza donosi se  odluka o uvođenju terapije.
			</p>
		</li>
	</ul>
</li>

</ul>
</div>

<h2>Dnevnik krvnog pritiska</h2>
<form action="<?php echo $this->_tpl_vars['baseUrl']; ?>
sr/dnevnik-krvnog-pritiska" method="post" class="custom_forms">
<table border="0" cellspacing="0" cellpadding="0" width="500">
	<tr>
		<th align="left">
			<label>Ime:</label>
		</th>
		<td>
			<input id="name" name="data[first_name]" value="<?php echo $this->_tpl_vars['first_name']; ?>
" class="input_field" maxlength="30" size="20" <?php if (isset ( $this->_tpl_vars['errors']['first_name'] ) && $this->_tpl_vars['errors']['first_name'] == 1): ?>style="border-color:red;"<?php endif; ?>/>
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Prezime:</label>
		</th>
		<td>
			<input id="name" name="data[last_name]" value="<?php echo $this->_tpl_vars['last_name']; ?>
" class="input_field" maxlength="30" size="20" <?php if (isset ( $this->_tpl_vars['errors']['last_name'] ) && $this->_tpl_vars['errors']['last_name'] == 1): ?>style="border-color:red;"<?php endif; ?>/>
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Godina rođenja:</label>
		</th>
		<td>
			<input id="name" name="data[birth_year]" value="<?php echo $this->_tpl_vars['birth_year']; ?>
" class="input_field" maxlength="4" size="4" <?php if (isset ( $this->_tpl_vars['errors']['birth_year'] ) && $this->_tpl_vars['errors']['birth_year'] == 1): ?>style="border-color:red;"<?php endif; ?>/>
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Telefon:</label>
		</th>
		<td>
			<input id="name" name="data[phone]" value="<?php echo $this->_tpl_vars['phone']; ?>
" class="input_field"  <?php if (isset ( $this->_tpl_vars['errors']['phone'] ) && $this->_tpl_vars['errors']['phone'] == 1): ?>style="border-color:red;"<?php endif; ?>/>
		</td>
	</tr>
	<tr>
		<th align="left">
			<label>Email:</label>
		</th>
		<td>
			<input id="name" name="data[email]" value="<?php echo $this->_tpl_vars['email']; ?>
" class="input_field"/>
		</td>
	</tr>
	
</table>
<br />
<table class="blod_preasure" style="border-collapse:separate;border-spacing:0 5px;" cellpadding="0" cellspacing="0" summary="Dnevnik krvnog pritiska">
<tr>
	<th width="150px">Datum</th>
	<th width="110px">Vreme</th>
	<th width="70px">Gornji</th>
	<th width="70px">Donji</th>
	<th width="70px">Puls/min</th>
	<th>Komentar</th>
</tr>
<?php $_from = $this->_tpl_vars['messure']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['iteration'] => $this->_tpl_vars['v']):
?>
<tr style="{border:2px solid #ff0000;}">
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?> rowspan="3"><?php echo $this->_tpl_vars['iteration']; ?>
. dan <input class="date" id="day_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][day]" value="<?php echo $this->_tpl_vars['v']['day']; ?>
"/></td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><label>Jutro:</label><input class="hour" id="morning_time_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][morning_time]" value="<?php echo $this->_tpl_vars['v']['morning_time']; ?>
"/> h</td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="preasure" id="morning_upper_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][morning_upper]" value="<?php echo $this->_tpl_vars['v']['morning_upper']; ?>
"/></td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="preasure" id="morning_down_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][morning_down]" value="<?php echo $this->_tpl_vars['v']['morning_down']; ?>
"/></td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="puls" id="morning_puls_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][morning_puls]" value="<?php echo $this->_tpl_vars['v']['morning_puls']; ?>
"/></td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="comment" id="morning_comments_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][morning_comments]" value="<?php echo $this->_tpl_vars['v']['morning_comments']; ?>
"/></td>
</tr>
<tr>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><label>&nbsp;</label><input class="hour" id="afternoon_time_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][afternoon_time]" value="<?php echo $this->_tpl_vars['v']['afternoon_time']; ?>
"/> h</td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="preasure" id="afternoon_upper_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][afternoon_upper]" value="<?php echo $this->_tpl_vars['v']['afternoon_upper']; ?>
"/></td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="preasure" id="afternoon_down_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][afternoon_down]" value="<?php echo $this->_tpl_vars['v']['afternoon_down']; ?>
"/></td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="puls" id="afternoon_puls_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][afternoon_puls]" value="<?php echo $this->_tpl_vars['v']['afternoon_puls']; ?>
"/></td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="comment" id="afternoon_comments_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][afternoon_comments]" value="<?php echo $this->_tpl_vars['v']['afternoon_comments']; ?>
"/></td>
</tr>
<tr>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><label>Veče:</label><input class="hour" id="evening_time_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][evening_time]" value="<?php echo $this->_tpl_vars['v']['evening_time']; ?>
"/> h</td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="preasure" id="evening_upper_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][evening_upper]" value="<?php echo $this->_tpl_vars['v']['evening_upper']; ?>
"/></td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="preasure" id="evening_down_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][evening_down]" value="<?php echo $this->_tpl_vars['v']['evening_down']; ?>
"/></td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="puls" id="evening_puls_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][evening_puls]" value="<?php echo $this->_tpl_vars['v']['evening_puls']; ?>
"/></td>
	<td  bgcolor=<?php if ($this->_tpl_vars['iteration'] == 1): ?>"yellow"<?php else: ?>"#EFF3F4"<?php endif; ?>><input class="comment" id="evening_comments_<?php echo $this->_tpl_vars['iteration']; ?>
" name="messure[<?php echo $this->_tpl_vars['iteration']; ?>
][evening_comments]" value="<?php echo $this->_tpl_vars['v']['evening_comments']; ?>
"/></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
<tr>
	<td colspan="2">Srednje vrednosti 6 dana.<br />(Bez prvog dana!)</td>
	<td><span id="avg_upper" style="font-weight:bold;"></span></td>
	<td><span id="avg_down" style="font-weight:bold;"></span></td>
	<td><span id="avg_puls" style="font-weight:bold;"></span></td>
	<td></td>
</tr>
</table>
<br />
<?php if (isset ( $this->_tpl_vars['errors'] ) && ( count ( $this->_tpl_vars['errors'] ) > 0 )): ?>
	<span style="color:red;">Crveno uokvirena polja moraju biti ispravno popunjena!</span>
<?php endif; ?>
<br />
<input id="calculateAvg" type="button" onclick="calculateAll();" class="input_btn" value="Izračunaj"/>
<input id="calculateAvg" name="submit[send]" type="submit" class="input_btn" value="Pošalji rezultate"/>
<br /><br />
<b>Napomena:</b> Odgovor mogu očekivati posetioci sajta koji imaju otvoren elektronski karton u poliklinici Kardio Medika. <br />
Formular <strong>"Dnevnik krvnog pritiska"</strong> možete preuzeti i <a href="<?php echo $this->_tpl_vars['baseUrl']; ?>
Dnevnik-krvnog-pritiska.pdf" target="_blank"><strong>ovde</strong></a>.
</form>