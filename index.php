<html>
<head>
<script src="scripts/jquery-1.11.3.min.js"></script>
<script src="scripts/raphael-2.1.4.min.js"></script>
<script src="scripts/justgage-1.1.0.min.js"></script>
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/rsens.css" rel="stylesheet">
</head>
<body>
<div id="wrapper" class="container-fluid">
	<div>
		<div class="row">
			<div class="col-md-6 col">
				<div class="info guage text-center"><span class="infoText">Plug Sensor  </span><span id="plugStatus" class="glyphicon glyphicon-record" aria-hidden="true"></span></div>
			</div>
			<div class="col-md-6 col">
				<div class="info guage text-center"><span class="infoText">Tub Sensor  </span><span id="tubStatus" class="glyphicon glyphicon-record" aria-hidden="true"></span></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-6 col">
				<div id="plug" class="guage main_guage"></div>
			</div>
			<div class="col-md-6 col-xs-6 col">
				<div id="tub" class="guage main_guage"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-xs-6 col">
				<div id="plug_adverage" class="guage sub_guage"></div>
			</div>
			<div class="col-md-3 col-xs-6 col">
				<div id="plug_peak" class="guage sub_guage"></div>
			</div>
			<div class="col-md-3 col-xs-6 col">
				<div id="tub_adverage" class="guage sub_guage"></div>
			</div>
			<div class="col-md-3 col-xs-6 col">
				<div id="tub_peak" class="guage sub_guage"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col">
				<div class="info guage text-center"><span><a href="history.php" class="linkText today link">View todays data</a></span></div>
			</div>
			<div class="col-md-3 col">
				<div class="info guage text-center"><span><a href="history.php?date=<?php echo date('d-m-Y', time() - 60 * 60 * 24); ?>" class="linkText yesterday link">View yesterdays data</a></span></div>
			</div>
			<div class="col-md-3 col">
				<div class="info guage text-center"><span><a href="yesterdayChart.php" class="linkText link">View 36 Hour Charts</a></span></div>
			</div>
			<div class="col-md-3 col">
				<div class="info guage text-center"><span><a href="charts.php" class="linkText link">View Trend Charts</a></span></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col">
				<div class="info guage">
					<span><p class="infoText">If there is an error or problem with this serivce please take a picture of the screen and email rsens@nb221.com</p></span>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script>

causeRepaintsOn = $(".info, .infoText, .linkText, .guage");

$(window).resize(function() {
    causeRepaintsOn.css("z-index", 1);
});


document.addEventListener("DOMContentLoaded", function(event) {
	var plug = new JustGage({
		id: "plug",
		value : 0,
		min: 0,
		max: 130,
		title: "Plug SPL dB(C)",
		titleFontColor: "#FFFFFF",
		valueFontColor: "#FFFFFF",
		labelFontColor: "#FFFFFF",
		customSectors: [{color : "#00FF00", lo : 0, hi : 97},{color : "#FFB90F", lo : 97, hi : 109}, {color : "#DC143C", lo : 109, hi : 130}],
		counter: true,
		relativeGaugeSize: true
    });   
	
	var tub = new JustGage({
		id: "tub",
		value : 0,
		min: 0,
		max: 130,
		title: "Tub SPL dB(C)",
		titleFontColor: "#FFFFFF",
		valueFontColor: "#FFFFFF",
		labelFontColor: "#FFFFFF",
		customSectors: [{color : "#00FF00", lo : 0, hi : 97},{color : "#FFB90F", lo : 97, hi : 109}, {color : "#DC143C", lo : 109, hi : 130}],
		counter: true,
		relativeGaugeSize: true
    });
	
	var plug_adverage = new JustGage({
		id: "plug_adverage",
		value : 0,
		min: 0,
		max: 130,
		title: "Plug 5 minute\nAverage SPL dB(C)",
		titleFontColor: "#FFFFFF",
		valueFontColor: "#FFFFFF",
		labelFontColor: "#FFFFFF",
		customSectors: [{color : "#00FF00", lo : 0, hi : 97},{color : "#FFB90F", lo : 97, hi : 109}, {color : "#DC143C", lo : 109, hi : 130}],
		counter: true,
		relativeGaugeSize: true
    });
	
	var plug_peak = new JustGage({
		id: "plug_peak",
		value : 0,
		min: 0,
		max: 130,
		title: "Plug 5 minute\nPeak (2\u03c3)",
		titleFontColor: "#FFFFFF",
		valueFontColor: "#FFFFFF",
		labelFontColor: "#FFFFFF",
		customSectors: [{color : "#00FF00", lo : 0, hi : 97},{color : "#FFB90F", lo : 97, hi : 109}, {color : "#DC143C", lo : 109, hi : 130}],
		counter: true,
		relativeGaugeSize: true
    });
	
	var tub_adverage = new JustGage({
		id: "tub_adverage",
		value : 0,
		min: 0,
		max: 130,
		title: "Tub 5 minute\nAverage SPL dB(C)",
		titleFontColor: "#FFFFFF",
		valueFontColor: "#FFFFFF",
		labelFontColor: "#FFFFFF",
		customSectors: [{color : "#00FF00", lo : 0, hi : 97},{color : "#FFB90F", lo : 97, hi : 109}, {color : "#DC143C", lo : 109, hi : 130}],
		counter: true,
		relativeGaugeSize: true
    });
	
	var tub_peak = new JustGage({
		id: "tub_peak",
		value : 0,
		min: 0,
		max: 130,
		title: "Tub 5 minute\nPeak (2\u03c3)",
		titleFontColor: "#FFFFFF",
		valueFontColor: "#FFFFFF",
		labelFontColor: "#FFFFFF",
		customSectors: [{color : "#00FF00", lo : 0, hi : 97},{color : "#FFB90F", lo : 97, hi : 109}, {color : "#DC143C", lo : 109, hi : 130}],
		counter: true,
		relativeGaugeSize: true
    });
	
	function checkSensorStatus(){
		$.getJSON('sensorStatus.php', function(data) {
			if(data){
				if(data['tub']==true){
					$('#tubStatus').css('color', '#00FF00');
				} else {
					$('#tubStatus').css('color', '#DC143C');
				}
				if(data['plug']==true){
					$('#plugStatus').css('color', '#00FF00');
				} else {
					$('#plugStatus').css('color', '#DC143C');
				}
				if(data['tub']==true || data['plug']==true){
					setTimeout(
						function() 
						{
							if(data['plug']==true){
								$('#plugStatus').css('color', 'white');
							}
							if(data['tub']==true){
								$('#tubStatus').css('color', 'white');
							}
						}, 300);
				}
			}
			
		});
		return;
	}
	
	setInterval(function() {
		$.getJSON('monitor_adverage.php', function(data) {
			if(data){
				plug_adverage.refresh(data.plug_adverage);
				plug_peak.refresh(data.plug_peak);
				tub_adverage.refresh(data.tub_adverage);
				tub_peak.refresh(data.tub_peak);
			}
		});
	}, 30000);
	
	setInterval(function() {
		$.getJSON('monitor.php', function(data) {
			if(data.plug){
				plug.refresh(data.plug);
			}
			if(data.tub){
				tub.refresh(data.tub);
			}
		});
	}, 1000);
	
	setInterval(function() {
		checkSensorStatus();
	}, 3000);
	
	//getDataMonitor(function(){
			//$.getJSON('http://mattburnett.co.uk/monitor.php', function(data) {
  			
			//json_new = data.new_message
			//json_num_new = data.new_number
			//json_data = data.messages
			//json_length = data.messages.length
			//new_new = 0;
		//});
	$( document ).ready(function() {
		$.getJSON('monitor_adverage.php', function(data) {
			if(data){
				plug_adverage.refresh(data.plug_adverage);
				plug_peak.refresh(data.plug_peak);
				tub_adverage.refresh(data.tub_adverage);
				tub_peak.refresh(data.tub_peak);
			}
		});
	});


  });
</script>

</body>
</html>
