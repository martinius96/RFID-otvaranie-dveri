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
<style>
div.table-title {
   display: block;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
}

.table-title h3 {
   color: #fafafa;
   font-size: 30px;
   font-weight: 400;
   font-style:normal;
   font-family: "Roboto", helvetica, arial, sans-serif;
   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
   text-transform:uppercase;
}


/*** Table Styles **/

.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 320px;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:23px;
  font-weight: 100;
  padding:24px;
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
}
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  background:#4E5066;
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  background:#FFFFFF;
  padding:20px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

td:last-child {
  border-right: 0px;
}

th.text-left {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}

</style>  
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
    <h1 id="demo"></h1>
     <hr><h2>Zapojenie - Arduino + Ethernet W5100</h2>
   <img src="https://i.imgur.com/DoPktzT.png" style="display: block; max-width: 100%; height: auto;" title="RFID vrátnik - schéma Arduino + W5100 Ethernet" alt="RFID vrátnik - schéma Arduino + W5100 Ethernet">
  <center>
   <h3>Tabuľkové zapojenie - korešponduje so schémou</h3>
   <table class="rwd-table">
  <tr>
    <th>RFID RC522</th>
    <th>Arduino (Uno, Nano, Mega)</th>
  </tr>
  <tr>
    <td>3.3V</td>
    <td>3.3V</td>
  </tr>
  <tr>
    <td>RST</td>
    <td>D5</td>
  </tr>
  <tr>
    <td>GND</td>
    <td>GND</td>
  </tr>
  <tr>
    <td>MISO</td>
    <td>D12</td>
  </tr>
  <tr>
    <td>MOSI</td>
    <td>D11</td>
  </tr>
  <tr>
    <td>SCK</td>
    <td>D13</td>
  </tr>
   <tr>
    <td>SDA/SS</td>
    <td>D6</td>
  </tr>
</table></center>
  <hr><h2>Zapojenie - ESP8266</h2>
   <img src="https://i.imgur.com/j9wciSz.png" style="display: block; max-width: 100%; height: auto;" title="RFID vrátnik - schéma ESP8266" alt="RFID vrátnik - schéma ESP8266">
   <center>
   <h3>Tabuľkové zapojenie - korešponduje so schémou</h3>
   <table class="rwd-table">
  <tr>
    <th>RFID RC522</th>
    <th>ESP8266 - NodeMCU</th>
  </tr>
  <tr>
    <td>3.3V</td>
    <td>3.3V</td>
  </tr>
  <tr>
    <td>RST</td>
    <td>D1 (GPIO5)</td>
  </tr>
  <tr>
    <td>GND</td>
    <td>GND</td>
  </tr>
  <tr>
    <td>MISO</td>
    <td>D6 (GPIO12)</td>
  </tr>
  <tr>
    <td>MOSI</td>
    <td>D7 (GPIO13)</td>
  </tr>
  <tr>
    <td>SCK</td>
    <td>D5 (GPIO14)</td>
  </tr>
   <tr>
    <td>SDA/SS</td>
    <td>D2 (GPIO4)</td>
  </tr>
</table></center>
  <hr><h2>Zapojenie - ESP32</h2>
   <img src="https://i.imgur.com/HKHrsEO.png" style="display: block; max-width: 100%; height: auto;" title="RFID vrátnik - schéma ESP32" alt="RFID vrátnik - schéma ESP32">
   <center>
   <h3>Tabuľkové zapojenie - korešponduje so schémou</h3>
   <table class="rwd-table">
  <tr>
    <th>RFID RC522</th>
    <th>ESP8266 - NodeMCU</th>
  </tr>
  <tr>
    <td>3.3V</td>
    <td>3.3V</td>
  </tr>
  <tr>
    <td>RST</td>
    <td>D22</td>
  </tr>
  <tr>
    <td>GND</td>
    <td>GND</td>
  </tr>
  <tr>
    <td>MISO</td>
    <td>D19</td>
  </tr>
  <tr>
    <td>MOSI</td>
    <td>D23</td>
  </tr>
  <tr>
    <td>SCK</td>
    <td>D18</td>
  </tr>
   <tr>
    <td>SDA/SS</td>
    <td>D21</td>
  </tr>
</table></center>
   <hr>
   </div>
     <?php 
      include("footer.php");
      ?>
     </div>

  </body>

</html>
