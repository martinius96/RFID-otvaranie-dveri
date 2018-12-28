<!DOCTYPE html>
<html lang="en">
<?php 
include("connect.php");
?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Webaplikácia apartmánu</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Webaplikácia apartmánu</a>
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
			               
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="odobrat.php">Odobrať kartu</a>
			  <span class="sr-only">(current)</span>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="program.php">Program</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
	
        <div class="col-lg-12 text-center">
		<center><b>Posledných 5 interakcií</b></center>
      <div id="last5"></div>
		<b>Autorizované karty</b>
		<div id="aut"></div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
<script>
       setInterval(function(){
  $.get('last5.php', function(data){
        $('#last5').html(data)
    });
	$.get('autorizovaneodobrat.php', function(data){
        $('#aut').html(data)
    });
},800);   
</script>

</html>
