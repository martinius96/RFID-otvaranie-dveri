<?php
$stranka = "Stats";
?>
<!DOCTYPE html>
<?php include("connect.php"); ?>
<html lang="sk">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Štatistika pre RFID vrátnika. Počet autorizovaných a neautorizovaných kariet">
    <meta name="keywords" content="internet, esp32, esp, espressif, rfid, rc522, vrátnik, brána, vstup, kontrola, štatistika">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - štatistika vstupov</title>
    <link rel="icon" type="image/png" href="https://i.nahraj.to/f/2g8C.png" />
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript">
      window.smartlook||(function(d) {
      var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
      var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
      c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
      })(document);
      smartlook('init', 'db50efe9fff280a17db52b82be221240cbbd3dbe');
    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  </head>
  <?php 
  $vsetky = mysqli_query($con,"SELECT * from `pokusy`") or die (mysqli_error($con));
  $vsetky_vstup = mysqli_query($con,"SELECT * from `pokusy` WHERE `vysledok` = 1") or die (mysqli_error($con));
  $vsetky_stop = mysqli_query($con,"SELECT * from `pokusy` WHERE `vysledok` = 0") or die (mysqli_error($con));
  $autorizovane = mysqli_query($con,"SELECT * from `autorizovane`") or die (mysqli_error($con));
  $neautorizovane = mysqli_query($con,"SELECT * from `neautorizovane`") or die (mysqli_error($con));
  $cislom_vstup = mysqli_num_rows($vsetky_vstup);
  $cislom_stop = mysqli_num_rows($vsetky_stop);
  $cislom_vsetky = mysqli_num_rows($vsetky);
  $cislom_autorizovane = mysqli_num_rows($autorizovane);
  $cislom_neautorizovane = mysqli_num_rows($neautorizovane);
  ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    var vstup = <?=$cislom_vstup?>;
    var nevstup = <?=$cislom_stop?>;
    var vsetky_pokusy = <?=$cislom_vsetky?>;
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Výsledok autorizácie', 'Počet'],
          ['Overený',     vstup],
          ['Zamietnutý',      nevstup]
        ]);

        var options = {
          title: 'Pomer overení na počet pokusov ('+(vsetky_pokusy)+')',
          pieHole: 0.2,
          colors: ['#2ECC71', '#E74C3C'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
    var autor = <?=$cislom_autorizovane?>;
    var neautor = <?=$cislom_neautorizovane?>;
    var spolu = autor + neautor;
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Overená karta', 'Počet'],
          ['Autorizovaná',     autor],
          ['Neautorizovaná',      neautor]
        ]);

        var options = {
          title: 'Pomer autorizovaných kariet na počet kariet v databáze ('+(spolu)+')',
          pieHole: 0.2,
          colors: ['#2ECC71', '#E74C3C'],
        };
                                                                                         
        var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
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
         <?php
            	include("menu.php");
            ?>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
  <center><h2>Štatistika RFID vrátnika</h2></center>
    <li><b>Počet záznamov: </b><?php echo $cislom_vsetky; ?></li>
    <li><b>Počet vstupov: </b><?php echo $cislom_vstup; ?></li>
    <li><b>Počet zamietnutí: </b><?php echo $cislom_stop; ?></li>
    <li><b>Počet autorizovaných kariet: </b><?php echo $cislom_autorizovane; ?></li>
    <li><b>Počet neautorizovaných kariet: </b><?php echo $cislom_neautorizovane; ?></li>
    <div class="row">
    <div class="col-md-6">
      <center><div id="donutchart" style="display: block; width: 100%; height: 500px;"></div></center>
  </div>
  <div class="col-md-6">
      <center><div id="donutchart2" style="display: block; width: 100%; height: 500px;"></div></center>
  </div>
  </div>
      </div>
      <?php 
      include("footer.php");
      ?>
      </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
