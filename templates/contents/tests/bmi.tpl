<script type="text/javascript">
	function calculateNormalBMi(height){
		$("#min_ideal_weight_result").text((18.5*height*height/10000).toFixed(2));
		$("#max_ideal_weight_result").text((25*height*height/10000).toFixed(2));
	}

	function calcuateBmi(){
		
		var weight = $("#data\\[weight\\]").val();
		var height = $("#data\\[height\\]").val();

		if (!weight || isNaN(weight) || !height || isNaN(height)) {
			$("#result").text("");
			$("#min_ideal_weight_result").text("");
			$("#max_ideal_weight_result").text("");
			return;
		}
		calculateNormalBMi(height, 25);
		var result = parseFloat(weight/height/height*10000).toFixed(2);		
		$("#result").text(result);
		var type = 1;
		if (result < 18.5){
			$("#0").css({backgroundColor:"#fff", color:"#ff0000"});
			type = 1;
		}
		else if(18.5 <= result && result < 25){
			$("#18,5").css({backgroundColor:"#fff", color:"#ff0000"});
			type = 2;
		}
		else if(25 <= result && result < 30){
			$("#25").css({backgroundColor:"#fff", color:"#ff0000"});
			type = 3;
		}
		else if(30 <= result && result < 35){
			$("#30").css({backgroundColor:"#fff", color:"#ff0000"});
			type = 4;
		}
		else if(35 <= result && result < 40){
			$("#35").css({backgroundColor:"#fff", color:"#ff0000"});
			type = 5;
		}
		else if(result > 40){
			$("#40").css({backgroundColor:"#fff", color:"#ff0000"});
			type = 6;
		}
		
		$.ajax({
            url: '{[$baseUrl]}{[$lang]}/bmi-insert',
            dataType: "json",
            data: 'type=' + type,
            success: function(data, textStatus, responseObject) {
                var type1 =  (data[1])?parseInt(data[1].type_precent):0;
                var type2 =  (data[2])?parseInt(data[2].type_precent):0;
                var type3 =  (data[3])?parseInt(data[3].type_precent):0;
                var type4 =  (data[4])?parseInt(data[4].type_precent):0;
                var type5 =  (data[5])?parseInt(data[5].type_precent):0;
                var type6 =  (data[6])?parseInt(data[6].type_precent):0;
                sum = type1 + type2+ type3+ type4+ type5+ type6;
                 
                chart = new Highcharts.Chart({
        			chart: {
        				renderTo: 'container',
        				plotBackgroundColor: null,
        				plotBorderWidth: null,
        				plotShadow: false
        			},
        			title: {
        				text: 'Rezultati ankete: Ukupno akentirano:' + data.count
        			},
        			tooltip: {
        				formatter: function() {
        					return '<b>'+ this.point.name +'</b>: '+ parseFloat(this.percentage).toFixed(2)+' %';
        				}
        			},
        			plotOptions: {
        				pie: {
        					allowPointSelect: true,
        					cursor: 'pointer',
        					dataLabels: {
        						enabled: true,
        						color: '#000000',
        						connectorColor:  '#000000',
        						formatter: function() {
        							return '<b>'+ this.point.name +'</b>: '+ parseFloat(this.percentage).toFixed(2) +' %';
        						}
        					}
        				}
        			},
        		    series: [{
        				type: 'pie',
        				name: 'Indeks telesne mase',
        				data: [
        					{name: 'Slab', y:type1, sliced: (type == 1), selected: (type == 1), color: '#BFFCCF'},
        					{name: 'Normalan', y:type2, sliced: (type == 2), selected: (type == 2), color: '#6BE58A'},
        					{name: 'Prekomeran', y:type3, sliced: (type == 3), selected: (type ==3), color: '#F2CC85'},
        					{name: 'Gojaznost I stepena', y:type4, sliced: (type == 4), selected: (type == 4), color: '#F7A35D'},
        					{name: 'Gojaznost II stepena', y:type5, sliced: (type == 5), selected: (type == 5), color: '#F77674'},
        					{name: 'Gojaznost III stepena', y:type6, sliced: (type == 6), selected: (type == 6), color: '#CE6161'}
        				]
        			}]
        		});
            }
        });		
	}

	

</script>

<h2>Indeks Telesne Mase</h2>

<p>
Poštavni, izračunajte Vaš Indeks telesne mase. Index telesne mase (eng. BMI Body Mass Index) je metoda računjanja uhranjenosti. 
Što je indeks više iznad okvira urednih vrednosti, to je veći rizik od oboljevanja od
raznih srčanih bolesti, dijabetisa i povišenog krvnog pritiska.
</p>

<table border="0" cellspacing="0" cellpadding="0" width="500">
	<tr>
		<th>
			<label>Unesite vašu težinu u kg:</label>
		</th>
		<td>
			<input name="data[weight]" id="data[weight]" value="" class="input_field" maxlength="3" size="3"/> kg
		</td>
	</tr>
	<tr>
		<th>
			<label>Unesite vašu visinu u cm:</label>
		</th>
		<td>
			<input name="data[height]" id="data[height]" value="" class="input_field" maxlength="3" size="3"/> cm
		</td>
	</tr>
	<tr>
		<th>
		</th>
		<td>
			<br />
			<input name="calculateBmi" id="calculateBmi" type="button" class="input_btn" value="Izračunaj" onclick="calcuateBmi();" /><br /><br />
		</td>
	</tr>
	
	<tr>
		<th>
			Vaš index telesne mase je: 
		</th>
		<td>
			<strong><span id="result"></span></strong>
		</td>
	</tr>
	<tr>
		<th>
			Idealna težina za vašu visinu je: 
		</th>
		<td>
			<strong><span id="min_ideal_weight_result"></span></strong> kg. do 
			<strong><span id="max_ideal_weight_result"></span></strong> kg.
		</td>
	</tr>
</table>
  
 


<div></div>
<div></div>
<br /><br />


<table border="0" cellpadding="3" cellspacing="2" summary="tabela indexa telesne mase" class="bmi_table">
<tr>
	<th>BMI</th>
	<th>Stepen uhranjenosti</th>
	<th>Rizik za oboljenje</th>
	<th>Rizik za oboljenje na osnovu BMI i Komorbiditet</th>
</tr>
<tr id="0" style="background-color: #BFFCCF">
	<td>&lt; 18,5</td>
	<td>Slab</td>
	<td>Minimalan</td>
	<td>Nizak</td>
</tr>
<tr id="18,5" style="background-color: #6BE58A">
	<td>18,5 - 25</td>
	<td>Noraman</td>
	<td>Nizak</td>
	<td>Umeren</td>
</tr>
<tr id="25" style="background-color: #F2CC85">
	<td>25 - 30</td>
	<td>Prekomeran</td>
	<td>Umeren</td>
	<td>Visok</td>
</tr>
<tr id="30" style="background-color: #F7A35D">
	<td>30 - 35</td>
	<td>Gojaznost I stepena</td>
	<td>Visok</td>
	<td>Vema visok</td>
</tr>
<tr id="35" style="background-color: #F77674">
	<td>35-40</td>
	<td>Gojaznost II stepena</td>
	<td>Vrlo visok</td>
	<td>Ekstremno visok</td>
</tr>
<tr id="40" style="background-color: #CE6161">
	<td>&gt; 40</td>
	<td>Gojaznost III stepena</td>
	<td>Ekstremno visok</td>
	<td>Ekstremno visok</td>
</tr>
</table>

<div id="container">
</div>
<div id="content">
	<div id="category_list">
	</div>
</div>
