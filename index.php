<html>
<head>
<script src="scripts/jquery-1.11.3.min.js"></script>
 <script src="scripts/raphael-2.1.4.min.js"></script>
  <script src="scripts/justgage-1.1.0.min.js"></script>
<style type="text/css">
.table  {border-spacing:10; width:100%; height:100%;}
.table_cell {background-color:#007FDF;}
body {background-color:black;}
.large_gage {width: 660px; height: 400px;}
.small_gage {width: 323px; height: 350px;}
.link {
	font-size: 30px;
    font-weight: bold;
    color: white;
    font-family: Tahoma;
    text-decoration: none;
    margin-left: 20px;
}
.error_text {
	font-size: 30px;
    font-weight: bold;
    color: white;
    font-family: Tahoma;
    text-decoration: none;
    margin-left: 20px;
}
</style>
</head>
<body>
<table class="table">
  <tr>
    <th id="plug" class="table_cell large_gage" colspan="2"></th>
    <th id="tub" class="table_cell large_gage" colspan="2"></th>
  </tr>
  <tr>
    <td id="plug_adverage" class="table_cell small_gage" width="25%"></td>
    <td id="plug_peak" class="table_cell small_gage" width="25%"></td>
    <td id="tub_adverage" class="table_cell small_gage" width="25%"></td>
    <td id="tub_peak" class="table_cell small_gage" width="25%"></td>
  </tr>
   <tr>
    <td id="" class="table_cell" colspan="4">
	<a href="history.php" class="today link">View todays data</a>
	<a href="history.php?date=<?php echo date('d-m-Y', time() - 60 * 60 * 24); ?>" class="yesterday link">View yesterdays data</a>
	<a href="history.php" class="historic link">View historic data</a>
	</td>
  </tr>
  <tr>
	<td id="" class="table_cell error_text" colspan="4">
    If there is an error or problem with this serivce please take a picture of the screen and email rsens@nb221.com
	</td>
  </tr>
</table>

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

