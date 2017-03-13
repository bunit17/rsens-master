<html>
<head>
<script src="scripts/jquery-1.11.3.min.js"></script>
<script src="scripts/raphael-2.1.4.min.js"></script>
<script src="scripts/Chart.bundle.js"></script>
<link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
	body {background-color:black;}
/* .large_gage {width: 660px; height: 400px;} */
/* .small_gage {width: 323px; height: 325px;} */
	.h4 {
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

	.guage{
		background-color: #007FDF;	
	}
	.main_guage{
		height: 58%;
	}
	.sub_guage{
		height: 28%;
	}
	.info{
		height: 4%;
		color: white;
		font-size: 22px;
	}

	.info a{
		color: white;
	}

	.col{
		padding-right:5px;
		padding-left:5px;
	}

	.row{
		padding-bottom: 5px;
		padding-top: 5px;
	}

</style>
</head>
<body>
<div id="wrapper" class="container-fluid">
	<div>
	  <canvas id="430amAverage" width="400" height="400"></canvas>
  </div>
  <div class="row">
    <div class="col-md-4 col">
      <div class="info guage text-center"><a href="history.php" class="today link">View todays data</a></div>
    </div>
    <div class="col-md-4 col">
      <div class="info guage text-center"><a href="history.php?date=<?php echo date('d-m-Y', time() - 60 * 60 * 24); ?>" class="yesterday link">View yesterdays data</a></div>
    </div>
    <div class="col-md-4 col">
      <div class="info guage text-center"><a href="history.php" class="historic link">View historic data</a></div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col">
      <div class="info guage">
        If there is an error or problem with this serivce please take a picture of the screen and email rsens@nb221.com
      </div>
    </div>
	</div>
</div>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script>
  <script>
var ctx = document.getElementById("430amAverage");
var 430amAverage = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
</script>

</body>
</html>
