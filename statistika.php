<!DOCTYPE html>
<?php include("connect.php"); ?>
<html lang="en">
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

  </head>
  <?php 
  $vsetky = mysqli_query($con,"SELECT * from `pokusy`") or die (mysqli_error($con));
  $vsetky_vstup = mysqli_query($con,"SELECT * from `pokusy` WHERE `vysledok` = 1") or die (mysqli_error($con));
  $vsetky_stop = mysqli_query($con,"SELECT * from `pokusy` WHERE `vysledok` = 0") or die (mysqli_error($con));
  $autorizovane = mysqli_query($con,"SELECT * from `autorizovane`") or die (mysqli_error($con));
  $neautorizovane = mysqli_query($con,"SELECT * from `neautorizovane`") or die (mysqli_error($con));
  ?>
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
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pridat.php">Pridať kartu</a>
			               <span class="sr-only">(current)</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="odobrat.php">Odobrať kartu</a>
            </li>
             <li class="nav-item">
              <a class="nav-link" href="grafy.php">Grafy</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="program.php">Program</a>
            </li>
            	<li class="nav-item active">
              <a class="nav-link" href="statistika.php">Štatistika</a>
            </li>
		  <li class="nav-item" id="right">
            <a href="https://www.paypal.me/chlebovec" class="btn btn-success" role="button" style="border-radius: 25px;"><img src="https://image.flaticon.com/icons/svg/888/888870.svg" width=32px height=32px>Podpora</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
    <div class="alert alert-success">
<center><strong>Verzia zdarma</strong> Vytvoril: <a href="https://www.facebook.com/martin.s.chlebovec">Martin Chlebovec</a></center>
</div>
  <center><h2>Štatistika RFID vrátnika</h2></center>
    <li><b>Počet záznamov: </b><?php echo mysqli_num_rows($vsetky); ?></li>
    <li><b>Počet vstupov: </b><?php echo mysqli_num_rows($vsetky_vstup); ?></li>
    <li><b>Počet zamietnutí: </b><?php echo mysqli_num_rows($vsetky_stop); ?></li>
    <li><b>Počet autorizovaných kariet: </b><?php echo mysqli_num_rows($autorizovane); ?></li>
    <li><b>Počet neautorizovaných kariet: </b><?php echo mysqli_num_rows($neautorizovane); ?></li>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
