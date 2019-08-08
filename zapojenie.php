<?php
$stranka = "Zapojenie";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Zapojenie elektroniky - ESP8266, RFID čítačky RC522 a relé s ovládaním bezpečnostného solenoid jazýčka.">
    <meta name="keywords" content="zapojenie, arduino, arduinoide, nodemcu, esp8266, čip, iot, rfid, vrátnik, rc522, relé, solenoid, dvere, jazýček, ovládanie, internet, ethernet">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - Zapojenie komponentov</title>
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
  <hr><h2>Zapojenie - ESP8266</h2>
   <img src="https://i.imgur.com/j9wciSz.png" style="display: block; max-width: 100%; height: auto;" title="RFID vrátnik - schéma ESP8266" alt="RFID vrátnik - schéma ESP8266">
   <hr><h2>Zapojenie - Arduino + Ethernet W5100</h2>
   <img src="https://i.imgur.com/R4d2FvF.png" style="display: block; max-width: 100%; height: auto;" title="RFID vrátnik - schéma Arduino + W5100 Ethernet" alt="RFID vrátnik - schéma Arduino + W5100 Ethernet">
  <hr><h2>Zapojenie - ESP32</h2>
   <img src="https://i.imgur.com/HKHrsEO.png" style="display: block; max-width: 100%; height: auto;" title="RFID vrátnik - schéma ESP32" alt="RFID vrátnik - schéma ESP32">
   <b>Dostupné na stiahnutie (ESP8266): </b>
   <li>Formát .sch - <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/eagle/ESP8266/rfid_vratnik_esp8266.sch"><img src="https://d2.alternativeto.net/dist/icons/eaglecad_116263.png?width=128&height=128&mode=crop&upscale=false" width="32px" height="32px" title="Autodesk Eagle - ESP8266 (NodeMCU)" alt="Autodesk Eagle - ESP8266 (NodeMCU)"></a></li>
   <hr>
   <li>Formát .dxf - <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/eagle/ESP8266/rfid_vratnik_esp8266.dxf"><img src="http://www.iconninja.com/files/424/698/454/file-document-extension-cad-format-page-icon.png" width="32px" height="32px" title="CAD - AutoCAD, SoliCAD, ProgeCAD - ESP8266 (NodeMCU)" alt="CAD - AutoCAD, SoliCAD, ProgeCAD - ESP8266 (NodeMCU)"></a></li>
   <hr>
   <li>Formát .scr - <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/eagle/ESP8266/rfid_vratnik_esp8266.scr"><img src="https://cdn0.iconfinder.com/data/icons/flat-design-database-set-3/24/script-128.png" width="32px" height="32px" title="NetScript - ESP8266 (NodeMCU)" alt="NetScript - ESP8266 (NodeMCU)"></a></li>
   <b>Dostupné na stiahnutie (Arduino + Ethernet W5100): </b>
   <li>Formát .sch - <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/eagle/Arduino/rfid_vratnik_arduino.sch"><img src="https://d2.alternativeto.net/dist/icons/eaglecad_116263.png?width=128&height=128&mode=crop&upscale=false" width="32px" height="32px" title="Autodesk Eagle - Arduino + Ethernet" alt="Autodesk Eagle - Arduino + Ethernet"></a></li>
   <hr>
   <li>Formát .dxf - <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/eagle/Arduino/rfid_vratnik_arduino.dxf"><img src="http://www.iconninja.com/files/424/698/454/file-document-extension-cad-format-page-icon.png" width="32px" height="32px" title="CAD - AutoCAD, SoliCAD, ProgeCAD - Arduino + Ethernet" alt="CAD - AutoCAD, SoliCAD, ProgeCAD - Arduino + Ethernet"></a></li>
   <hr>
   <li>Formát .scr - <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/eagle/Arduino/rfid_vratnik_arduino.dxf"><img src="https://cdn0.iconfinder.com/data/icons/flat-design-database-set-3/24/script-128.png" width="32px" height="32px" title="NetScript - Arduino + Ethernet" alt="NetScript - Arduino + Ethernet"></a></li>  
   <b>Dostupné na stiahnutie (ESP32): </b>
   <li>Formát .sch - <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/eagle/ESP32/rfid_vratnik_esp32.sch"><img src="https://d2.alternativeto.net/dist/icons/eaglecad_116263.png?width=128&height=128&mode=crop&upscale=false" width="32px" height="32px" title="Autodesk Eagle - ESP32" alt="Autodesk Eagle - ESP32"></a></li>
   <hr>
   <li>Formát .dxf - <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/eagle/ESP32/rfid_vratnik_esp32.dxf"><img src="http://www.iconninja.com/files/424/698/454/file-document-extension-cad-format-page-icon.png" width="32px" height="32px" title="CAD - AutoCAD, SoliCAD, ProgeCAD - ESP32" alt="CAD - AutoCAD, SoliCAD, ProgeCAD - ESP32"></a></li>
   <hr>
   <li>Formát .scr - <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/eagle/ESP32/rfid_vratnik_esp32.scr"><img src="https://cdn0.iconfinder.com/data/icons/flat-design-database-set-3/24/script-128.png" width="32px" height="32px" title="NetScript - ESP32" alt="NetScript - ESP32"></a></li>
   <hr></div>
     <?php 
      include("footer.php");
      ?>
     </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
