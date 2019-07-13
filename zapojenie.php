<?php
$stranka = "Zapojenie";
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Zapojenie elektroniky - ESP8266, RFID čítačky RC522 a relé s ovládaním bezpečnostného solenoid jazýčka.">
    <meta name="keywords" content="zapojenie, arduino, arduinoide, nodemcu, esp8266, čip, iot, rfid, vrátnik, rc522, relé, solenoid, dvere, jazýček, ovládanie, internet">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - ESP8266 - Zapojenie</title>
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
         <?php
            	include("menu.php");
            ?>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
	<b>Dostupné na stiahnutie: </b>
   	<li>Formát .sch - <a href="eagle/rfid_otvaranie_dveri.sch"><img src="https://d2.alternativeto.net/dist/icons/eaglecad_116263.png?width=128&height=128&mode=crop&upscale=false" width="32px" height="32px" title="Autodesk Eagle" alt="Autodesk Eagle"></a></li>
   	<hr>
   	<li>Formát .dxf - <a href="eagle/rfid_otvaranie_dveri.dxf"><img src="http://www.iconninja.com/files/424/698/454/file-document-extension-cad-format-page-icon.png" width="32px" height="32px" title="CAD - AutoCAD, SoliCAD, ProgeCAD" alt="CAD - AutoCAD, SoliCAD, ProgeCAD"></a></li>
   	<hr>
   	<li>Formát .scr - <a href="eagle/rfid_otvaranie_dveri.scr"><img src="https://cdn0.iconfinder.com/data/icons/flat-design-database-set-3/24/script-128.png" width="32px" height="32px" title="NetScript" alt="NetScript"></a></li>
	<hr><h2>Zapojenie:</h2>
	<img src="https://i.imgur.com/j9wciSz.png" style="display: block; max-width: 100%; height: auto;">
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
