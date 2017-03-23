<html>
<head>
<script src="scripts/jquery-1.11.3.min.js"></script>
<script src="scripts/raphael-2.1.4.min.js"></script>
<script src="scripts/Chart.bundle.js"></script>
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<link href="css/rsens.css" rel="stylesheet">
</head>
<body>
<div id="wrapper" class="container-fluid">
	<div class="chart2">
	  <canvas id="36HourAverage" width="100%" height="40%"></canvas>
  </div>
	<div class="chart2">
	  <canvas id="36HourPeak" width="100%" height="40%"></canvas>
  </div>
	<div class="row">
		<div class="col-md-3 col">
			<div class="info guage text-center"><span><a href="history.php" class="linkText today link">View todays data</a></span></div>
		</div>
		<div class="col-md-3 col">
			<div class="info guage text-center"><span><a href="history.php?date=<?php echo date('d-m-Y', time() - 60 * 60 * 24); ?>" class="linkText yesterday link">View yesterdays data</a></span></div>
		</div>
		<div class="col-md-3 col">
			<div class="info guage text-center"><span><a href="index.php" class="linkText link">View Live Guages</a></span></div>
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
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script>

var tempData

function draw36HourAverageLineChart() {

    // Add a helper to format timestamp data
    Date.prototype.formatDDMMYYYY = function() {
        return this.getDate() +
        "/" +  (this.getMonth() + 1) +
        "/" +  this.getFullYear();
    }

    var jsonData = $.ajax({
      url: 'yesterday.php',
      dataType: 'json',
    }).done(function (results) {

      // Split timestamp and data into separate arrays
      var labels = [], tub=[], plug=[];
      results.forEach(function(average) {
        labels.push(new Date(average.timestamp);//.formatDDMMYYYY());

        tub.push(parseFloat(average.tub_adverage));
		plug.push(parseFloat(average.plug_adverage));
      });

      // Create the chart.js data structure using 'labels' and 'data'
      tempData = {
        labels : labels,
        datasets : [{
            data                  : tub,
			label: "Tub 36 Hour Average",
			borderColor: 'rgba(255,99,132,1)',
			backgroundColor: 'rgba(255, 99, 132, 0.2)'
        },
		{
            data                  : plug,
			label: "Plug 36 Hour Average",
			borderColor: 'rgba(54, 162, 235, 1)',
			backgroundColor: 'rgba(54, 162, 235, 0.2)'
        },
		]
      };

      // Get the context of the canvas element we want to select
      var ctx = document.getElementById("36HourAverage").getContext("2d");

      // Instantiate a new chart
	 	var LineChart = new Chart(ctx, {
			type: 'line',
			data: tempData,
			options: {
				scales: {
					xAxes: [{
						display: false
					}],
					yAxes: [{
						ticks: {
							max: 130,
							min: 36,
							stepSize: 12
						}
					}]
				},
				responsive:true,
				maintainAspectRatio: false
			}
		}); 
	});
  }

function draw36HourPeakLineChart() {

    // Add a helper to format timestamp data
    Date.prototype.formatDDMMYYYY = function() {
        return this.getDate() +
        "/" +  (this.getMonth() + 1) +
        "/" +  this.getFullYear();
    }

    var jsonData = $.ajax({
      url: 'yesterday.php',
      dataType: 'json',
    }).done(function (results) {

      // Split timestamp and data into separate arrays
      var labels = [], tub=[], plug=[];
      results.forEach(function(peak) {
        labels.push(new Date(peak.timestamp);//.formatDDMMYYYY());
        tub.push(parseFloat(peak.tub_peak));
		plug.push(parseFloat(peak.plug_peak));
      });

      // Create the chart.js data structure using 'labels' and 'data'
      tempData = {
        labels : labels,
        datasets : [{
            data                  : tub,
			label: "Tub 36 Hour Peak",
			borderColor: 'rgba(255,99,132,1)',
			backgroundColor: 'rgba(255, 99, 132, 0.2)'
        },
		{
            data                  : plug,
			label: "Plug 36 Hour Peak",
			borderColor: 'rgba(54, 162, 235, 1)',
			backgroundColor: 'rgba(54, 162, 235, 0.2)'
        },
		]
      };

      // Get the context of the canvas element we want to select
      var ctx = document.getElementById("36HourPeak").getContext("2d");

      // Instantiate a new chart
	 	var LineChart = new Chart(ctx, {
			type: 'line',
			data: tempData,
			options: {
				scales: {
					xAxes: [{
						display: false
					}],
					yAxes: [{
						ticks: {
							max: 130,
							min: 36,
							stepSize: 12
						}
					}]
				},
				responsive:true,
				maintainAspectRatio: false
			}
		}); 
	});
  }
  
draw36HourAverageLineChart();
draw36HourPeakLineChart();
</script>

</body>
</html>
