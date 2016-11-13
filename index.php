<html>
<head>
<script src="scripts/jquery-1.11.3.min.js"></script>
<script src="scripts/raphael-2.1.4.min.js"></script>
<script src="scripts/justgage-1.1.0.min.js"></script>
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
.table  {border-spacing:10; width:100%; height:100%;}
.table_cell {background-color:#007FDF;}
body {background-color:black;}
/* .large_gage {width: 660px; height: 400px;} */
/* .small_gage {width: 323px; height: 325px;} */
.link {
	font-size: 30px;
    	font-weight: bold;
    	color: white;
    	font-family: Tahoma;
    	text-decoration: none;
    	margin-left: 20px;
}
.error_text {
	font-size: 20px;
    	font-weight: bold;
    	color: white;
    	font-family: Tahoma;
    	text-decoration: none;
    	padding-left: 20px;
}
.text_row{
	height: 30px;
}
.Menu_row{
	height: 30px;
}
	
.Help_row{
	height: 30px;
}

.Main_row{
	height: 50%;
	width: 100%;
	padding: 2px;
}

.Sub_row{
	height: 30%;
	width: 100%;
	padding: 2px;
}
.guage{
	background-color:#007FDF;
}
</style>
</head>
<body>
<div id="wrapper" class="container-fluid">
	<div class="row">
		<div id="plug" class="col-md-6 guage"></div>
		<div id="tub" class="col-md-6 guage"></div>
	</div>
	<div class="row">
		<div id="plug_adverage" class="col-md-3 guage"></div>
		<div id="plug_peak" class="col-md-3 guage"></div>
		<div id="tub_adverage" class="col-md-3 guage"></div>
		<div id="tub_peak" class="col-md-3 guage"></div>
	</div>
	<div class="row guage">
		<h4><a href="history.php" class="today link">View todays data</a></h4>
		<h4><a href="history.php?date=<?php echo date('d-m-Y', time() - 60 * 60 * 24); ?>" class="yesterday link">View yesterdays data</a></h4>
		<h4><a href="history.php" class="historic link">View historic data</a></h4>
	</div>
   	<div class="row guage">
	    	<h4>If there is an error or problem with this serivce please take a picture of the screen and email rsens@nb221.com</h4>
	</div>
</div>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script>
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
      customSectors: [{color : "#00FF00", lo : 0, hi : 100},{color : "#FFB90F", lo : 100, hi : 112}, {color : "#DC143C", lo : 112, hi : 130}],
      counter: true
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
      customSectors: [{color : "#00FF00", lo : 0, hi : 100},{color : "#FFB90F", lo : 100, hi : 112}, {color : "#DC143C", lo : 112, hi : 130}],
      counter: true
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
      customSectors: [{color : "#00FF00", lo : 0, hi : 100},{color : "#FFB90F", lo : 100, hi : 112}, {color : "#DC143C", lo : 112, hi : 130}],
      counter: true
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
      customSectors: [{color : "#00FF00", lo : 0, hi : 100},{color : "#FFB90F", lo : 100, hi : 112}, {color : "#DC143C", lo : 112, hi : 130}],
      counter: true
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
      customSectors: [{color : "#00FF00", lo : 0, hi : 100},{color : "#FFB90F", lo : 100, hi : 112}, {color : "#DC143C", lo : 112, hi : 130}],
      counter: true
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
      customSectors: [{color : "#00FF00", lo : 0, hi : 100},{color : "#FFB90F", lo : 100, hi : 112}, {color : "#DC143C", lo : 112, hi : 130}],
      counter: true
    });
	
	
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
