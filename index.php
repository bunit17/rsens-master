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
.small_gage {width: 323px; height: 325px;}
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
	background-color: red;
}
.text_row{
	height: 30px;
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
  <tr class="text_row">
    <td id="" class="table_cell" colspan="4">
	<a href="history.php" class="today link">View todays data</a>
	<a href="history.php?date=<?php echo date('d-m-Y', time() - 60 * 60 * 24); ?>" class="yesterday link">View yesterdays data</a>
	<a href="history.php" class="historic link">View historic data</a>
	</td>
  </tr>
  <tr class="text_row">
	<td id="error_row" class="table_cell error_text " colspan="4">
    Please take a picture of the screen and email rsens@nb221.com. <span id="error"></span>
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
	
	var error1 = false;
	var error2 = false;
	
	 setInterval(function() {
		  /* $.getJSON('monitor_adverage.php', function(data) {
		  if(data){
          plug_adverage.refresh(data.plug_adverage);
		  plug_peak.refresh(data.plug_peak);
          tub_adverage.refresh(data.tub_adverage);
          tub_peak.refresh(data.tub_peak);
		  }
		  }); */
		  
		  		$.ajax({
				url: "monitor_adverage.php", 
				data: {value: 1},
				type: 'post',
				error: function(XMLHttpRequest, textStatus, errorThrown){
					$("#error_row").show();
					//alert('Monitor average status:' + XMLHttpRequest.status + ', status text: ' + XMLHttpRequest.statusText);
				},
				success: function(data){
						error1 = flase;
					
					try {
						json = jQuery.parseJSON(data);
					  } catch (e) {
							error1 = true;
							$("#error").text('Monitor average status: json error, data: ' + data);
							$("#error_row").show();
					
					  }
					
				
					
					if(!error2){
					$("#error_row").hide();
					}
					
					if(json.plug_adverage && json.plug_adverage>0){
					plug_adverage.refresh(json.plug_adverage);
					}else{
						error1 = true;
					$("#error").text('Monitor average status: plug_adverage data throwing an error, plug_adverage value: ' + json.plug_adverage);
					$("#error_row").show();
					}
					
					if(json.plug_peak && json.plug_peak>0){
					 plug_peak.refresh(json.plug_peak);
					}else{
						error1 = true;
					$("#error").text('Monitor average status: plug_peak data throwing an error, plug_peak value: ' + json.plug_peak);
					$("#error_row").show();
					}
					
					if(json.tub_adverage && json.tub_adverage>0){
					tub_adverage.refresh(json.tub_adverage);
					}else{
						error1 = true;
					$("#error").text('Monitor average status: tub_adverage data throwing an error, tub_adverage value: ' + json.tub_adverage);
					$("#error_row").show();
					}
					
					if(json.tub_peak && json.tub_peak>0){
					tub_peak.refresh(json.tub_peak);
					}else{
					error1 = true;
					$("#error").text('Monitor average status: tub_peak data throwing an error, tub_peak value: ' + json.tub_peak);
					$("#error_row").show();
					}
				}
			});
		  
        }, 30000);
	
	setInterval(function() {
			/* $.getJSON('monitor.php', function(data) {
			if(data.plug){
			plug.refresh(data.plug);
			}
			if(data.tub){
			tub.refresh(data.tub);
			}
			}); */
			
			$.ajax({
				url: "monitor.php", 
				data: {value: 1},
				type: 'post',
				error: function(XMLHttpRequest, textStatus, errorThrown){
					$("#error").text('Monitor status:' + XMLHttpRequest.status + ', status text: ' + XMLHttpRequest.statusText);
					$("#error_row").show();
					//alert('Monitor status:' + XMLHttpRequest.status + ', status text: ' + XMLHttpRequest.statusText);
				},
				success: function(data){
					error2 = flase;
					
					try {
						json = jQuery.parseJSON(data);
					  } catch (e) {
							error1 = true;
							$("#error").text('Monitor status: json error, data: ' + data);
							$("#error_row").show();
					
					  }
					
					if(!error1){
					$("#error_row").hide();
					}
					
					if(json.plug && json.plug>0){
					plug.refresh(json.plug);
					}else{
					error2 = true;
					$("#error").text('Monitor status: plug data throwing an error, plug value: ' + json.plug);
					$("#error_row").show();
					}
					
					if(json.tub && json.tub>0){
					tub.refresh(json.tub);
					}else{
					error2 = true;
					$("#error").text('Monitor status: plug data throwing an error, plug value: ' + json.tub);
					$("#error_row").show();
					}
				}
			});
			
			/* $.get('monitor.php', function (data) {
			  if( !data || data === ""){
				alert("error");
				return;
			  }
			  var json;
			  try {
				json = jQuery.parseJSON(data);
			  } catch (e) {
				alert("error 2");
				return;
			  }
			  
				if(json.plug){
				plug.refresh(json.plug);
				}
				if(json.tub){
				tub.refresh(json.tub);
				}
			  
			}, "text"); */
			
         }, 1000);
	
	//getDataMonitor(function(){
			//$.getJSON('http://mattburnett.co.uk/monitor.php', function(data) {
  			
			//json_new = data.new_message
			//json_num_new = data.new_number
			//json_data = data.messages
			//json_length = data.messages.length
			//new_new = 0;
		//});
		  $.ajax({
				url: "monitor_adverage.php", 
				data: {value: 1},
				type: 'post',
				error: function(XMLHttpRequest, textStatus, errorThrown){
					$("#error_row").show();
					//alert('Monitor average status:' + XMLHttpRequest.status + ', status text: ' + XMLHttpRequest.statusText);
				},
				success: function(data){
						error1 = flase;
					
					try {
						json = jQuery.parseJSON(data);
					  } catch (e) {
							error1 = true;
							$("#error").text('Monitor average status: json error, data: ' + data);
							$("#error_row").show();
					
					  }
					
					if(!error2){
					$("#error_row").hide();
					}
					
					if(json.plug_adverage && json.plug_adverage>0){
					plug_adverage.refresh(json.plug_adverage);
					}else{
						error1 = true;
					$("#error").text('Monitor average status: plug_adverage data throwing an error, plug_adverage value: ' + json.plug_adverage);
					$("#error_row").show();
					}
					
					if(json.plug_peak && json.plug_peak>0){
					 plug_peak.refresh(json.plug_peak);
					}else{
						error1 = true;
					$("#error").text('Monitor average status: plug_peak data throwing an error, plug_peak value: ' + json.plug_peak);
					$("#error_row").show();
					}
					
					if(json.tub_adverage && json.tub_adverage>0){
					tub_adverage.refresh(json.tub_adverage);
					}else{
						error1 = true;
					$("#error").text('Monitor average status: tub_adverage data throwing an error, tub_adverage value: ' + json.tub_adverage);
					$("#error_row").show();
					}
					
					if(json.tub_peak && json.tub_peak>0){
					tub_peak.refresh(json.tub_peak);
					}else{
					error1 = true;
					$("#error").text('Monitor average status: tub_peak data throwing an error, tub_peak value: ' + json.tub_peak);
					$("#error_row").show();
					}
				}
			});


  });
  </script>

</body>
</html>

