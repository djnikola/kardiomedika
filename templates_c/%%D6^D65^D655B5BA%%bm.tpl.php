<?php /* Smarty version 2.6.26, created on 2014-10-03 12:21:33
         compiled from contents/tests/bm.tpl */ ?>
<script type="text/javascript">
	function calcuateBm(){
		var weight = $("#weight").val();
		var dailyAct = $("input[name=daily_activity_index]:checked").val();
		if (!weight || !dailyAct) {
			$("#result").text("");
			return;
		}
		
		$("#result").text((weight * 24 * dailyAct)+" Kcal");
	}
</script>

<h2>Bazalni metabolizam</h2>

<p>
Bazalni metabolizam je minimalna količina energije potrebna za telo 
koje potpuno miruje u stanju ležanja sa zatvorenim očima.
</p>
<br />
<strong>Unesite vašu težinu u kg. :</strong>
<input id="weight" name="weight" value="" class="input_field"/> Kg.
<br />
<fieldset>
	<legend><strong>Odaberite nivo vaše dnevne aktivnosti</strong></legend>
<input type="radio" id="1,2" name="daily_activity_index" value="1.2">
<label for="1,2">1,2 sedeći, malo ili bez aktivnosti</label><br />
<input type="radio" id="1,375" name="daily_activity_index" value="1.375">
<label for="1,375">1,375 lagan, lake vežbe 1-3 dana nedeljno</label><br />
<input type="radio" id="1,55" name="daily_activity_index" value="1.55">
<label for="1,55">1,55 umeren, 3-5 dana nedeljno</label><br />
<input type="radio" id="1,725" name="daily_activity_index" value="1.725">
<label for="1,725">1,725, veoma aktivan, teže vežbe 6-7 dana nedeljno</label><br />
<input type="radio" id="1,9" name="daily_activity_index" value="1.9">
<label for="1,9">1,9 teške dnevne vežbe i fizički posao 2 puta dnevno</label><br />
</fieldset>
<br /><br />
<table cellspacing="0" cellpadding="5" border="0">
<tr>
	<td><input name="calculateBmi" id="calculateBm" type="button" value="Izračunaj" onclick="calcuateBm();" class="input_btn"/></td>
	<td><strong>Potreban unos kalorija je:</strong> <span id="result"></span></td>
</tr>
</table>
