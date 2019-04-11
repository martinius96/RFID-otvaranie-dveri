<!DOCTYPE html>
<html lang="en">
<?php 
include("connect.php");
?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Grafická reprezentácia vstupov do budovy s časom overenia.">
    <meta name="keywords" content="rfid, vrátnik, dochádzka, systém, grafy, odmietnutie, otvorenie, dvere, solenoid, relé, esp8266, nodemcu, jazýček, kľučka">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - ESP8266 - Grafy</title>
    <link rel="icon" type="image/png" href="https://i.nahraj.to/f/2g8C.png" />
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>
       <?php 
 $result = mysqli_query($con,"SELECT * FROM pokusy  WHERE time >= DATE_SUB(NOW(),INTERVAL 7 DAY)") or die(mysqli_error($con));
$rows = array();
$table = array();
$table['cols'] = array(
   array('label' => 'time', 'type' => 'string'),
    array('label' => 'Vstup', 'type' => 'number')
	   // array('label' => $t5, 'type' => 'number')
//		 array('label' => $t6, 'type' => 'number')
	);
    foreach($result as $r) {
$cas = strtotime($r['time']);
	$cas = date('d.M H:i',$cas);
        $temp = array();
        // The following line will be used to slice the Pie chart
         $temp[] = array('v' => (string) $cas);
        $temp[] = array('v' => (int) $r['vysledok']);
			 $rows[] = array('c' => $temp);
        }
$table['rows'] = $rows;
$jsonTable = json_encode($table);
       ?>
       <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
    google.load('visualization', '1', {'packages':['corechart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options = {
          title: 'Vstupy používateľov za 7 dní - 1 overený - 0 neoverený',
		  	   colors: ['#0D93CA'],
			  pointSize: 1
          //is3D: 'true',
       //   width: 800,
         // height: 400
        };
      var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
      chart.draw(data, options);

    }
    </script>
  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
      <a class="navbar-brand" href="index.php">Webaplikácia - RFID vrátnik cez ESP8266</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Prehľad
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pridat.php">Pridať kartu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="odobrat.php">Odobrať kartu</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="grafy.php">Grafy</a>
            </li>
			 <li class="nav-item">
              <a class="nav-link" href="program.php">Program</a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="statistika.php">Štatistika</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
    
      <div class="row">
        <div class="col-lg-12 text-center">
        <div class="alert alert-success">
  <strong>Verzia zdarma</strong> Vytvoril: <a href="https://www.facebook.com/martin.s.chlebovec">Martin Chlebovec</a>
</div>
 <div class="col-md-12">
      <div id="chart_div" style="display: block; width: 100%; height: 300px;"></div>
  </div>
       
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
