<?php
$stranka = "Program";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Zdrojový kód pre mikrokontróler NodeMCU s čipom ESP8266-12E. RFID čítačka RC522 na 13.56MHz.">
    <meta name="keywords" content="program, arduino, core, arduinoide, nodemcu, esp8266, čip, iot, rfid, vrátnik, rc522, relé, solenoid, dvere, jazýček, ovládanie, internet">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - ESP8266 - Zdrojový kód</title>
     <link rel="icon" type="image/png" href="https://i.nahraj.to/f/2g8C.png" />
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script type="text/javascript">
    window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', 'db50efe9fff280a17db52b82be221240cbbd3dbe');
</script>    
  </head>

  <body onload="myFunction()">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
    <a class="navbar-brand" href="index.php">RFID vrátnik</a>
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
	   <hr><h2>Projekt RFID otvárania dverí - vrátnika:</h2><hr>
    <div class="alert alert-danger">
	    <strong>Zdrojové kódy pre mikrokontroléry (Arduino, ESP8266, ESP32) dostupné na Github-e:</strong> <a href="https://github.com/martinius96/RFID-otvaranie-dveri/tree/master/examples">Repozitár</a><br>
      <li>Projekt je vhodné najprv odtestovať offline prostredníctvom testera. Neskôr použiť program s pripojením na túto webovú lokalitu.</li>
</div>
<div class="alert alert-info">
      <strong>Zdrojové kódy pre webstránku, celý projekt dostupné na Github-e pod MIT licenciou:</strong> <a href="https://github.com/martinius96/RFID-otvaranie-dveri/">Repozitár</a><br>
</div>
     <b>Datasheety:</b>
	   <li><a href="https://github.com/esp8266/Arduino/">Návod na inštaláciu NodeMCU do ArduinoIDE (V spodnej časti README)</a></li><br>
     <li><a href="https://github.com/espressif/arduino-esp32">Návod na inštaláciu ESP32 do ArduinoIDE (V spodnej časti README)</a></li><br>
          <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/Wiznet-W5100.pdf">Ethernet Wiznet W5100 datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/Wiznet-W5500.pdf">Ethernet Wiznet W5500 datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/RFID-RC522.pdf">RFID RC522 čítačka - datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/SRD-05VDC-SL-C-rele.pdf">SRD-05VDC-SL-C - elektromagnetické relé - datasheet</a></li>
 <h1 id="demo"></h1>
<b>Prenosové technológie v projekte (komunikácia s webovým rozhraním):</b>
<li>Ethernet - (Wiznet W5100 / W5500)</li>
<li>WiFi - (ESP8266 / ESP32)</li>
<hr>
</div>
     <?php 
      include("footer.php");
      ?>
 </body>

</html>
