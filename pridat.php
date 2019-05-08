<!DOCTYPE html>
<html lang="en">
<?php 
include("connect.php");
?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Webové rozhranie RFID vrátnika pre pridanie karty do systému pre overenie vstupujúceho.">
    <meta name="keywords" content="rfid, vrátnik, dochádzka, systém, prístup, overenie, otvorenie, dvere, solenoid, relé, esp8266, nodemcu, jazýček, kľučka">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - ESP8266 - Pridanie karty</title>
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
  </head>
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
            <li class="nav-item active">
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
            <li class="nav-item">
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
      <div class="row">
    <div class="col-lg-12 text-center">
        <div class="alert alert-success">
  <strong>Verzia zdarma</strong> Vytvoril: <a href="https://www.facebook.com/martin.s.chlebovec">Martin Chlebovec</a>
</div>
		<center><b>Posledných 5 interakcií</b></center>
          <div id="last5"></div>
		<b>Autorizované karty</b>
		<div id="autorizovane"></div>
		<hr><b>Neautorizované karty</b><hr>
		<div id="neautorizovane"></div>
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
	 $.get('autorizovane.php', function(data){
        $('#autorizovane').html(data)
    });
	$.get('neautorizovane.php', function(data){
        $('#neautorizovane').html(data)
    });
},800);   
</script>
</html>
