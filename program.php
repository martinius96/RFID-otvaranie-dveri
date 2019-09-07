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
   <hr><h2>Projekt</h2><hr>
     <b>Datasheety:</b>
	   <li><a href="https://github.com/esp8266/Arduino/">Návod na inštaláciu NodeMCU do ArduinoIDE (V spodnej časti README)</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/ATmega328P.pdf">ATmega328P datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/ESP32-WROOM-32.pdf">ESP32-WROOM-32 datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/ESP8266-12E.pdf">ESP8266-12E datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/NodeMCU.pdf">NodeMCU (v2) datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/RFID-RC522.pdf">RFID RC522 datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/SRD-05VDC-SL-C-rele.pdf">SRD-05VDC-SL-C datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/WISOL-SFM10R1-SigFox.pdf">WISOL-SFM10R1 datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/Wiznet-W5100.pdf">Ethernet Wiznet W5100 datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/Wiznet-W5500.pdf">Ethernet Wiznet W5500 datasheet</a></li><br>
     <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/datasheet/Semtech-SX1276_77_78_79-LoRa.pdf">Semtech - SX1276 (77/78/79) datasheet</a></li><br>
	   <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/">Repozitár so zdrojovými kódmi pre webstránku, ESP8266 a RFID čítačku RC522 (v súhľade s dodržaním LICENCIE a podmienok)</a></li>
	  <hr><b>Zdrojové kódy s pripojením na: https://arduino.php5.sk/rfid</b><hr>
    <div class="alert alert-success">
	    <strong>Dostupné na Githube:</strong> <a href="https://github.com/martinius96/RFID-otvaranie-dveri/tree/master/examples">Repozitár</a>
</div>
 <h1 id="demo"></h1>
<b>Dostupné technológie:</b>
<li>Ethernet</li>
<li>WiFi</li>
<li>LoRa</li>
<li>SigFox</li>
<hr><h2>Zdrojový kód - Offline tester</h2><hr>
<pre style="background-color:#3498DB;">
/*|----------------------------------------------------------|*/
/*|SKETCH PRE TEST RFID CITACKY RC522   (HARDWARE SPI)       |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|DOSKA: ESP8266 (NodeMCU), ESP32, Arduino                  |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|LICENCIA: MIT                                             |*/
/*|----------------------------------------------------------|*/
#include &lt;SPI.h&gt;
#include &lt;RFID.h&gt;
#define SS_PIN 4
#define RST_PIN 5
RFID rfid(SS_PIN, RST_PIN); 
unsigned long kod;

void setup(){ 
  Serial.begin(9600);
  SPI.begin(); 
  rfid.init();
}

void loop(){
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.println("Kod karty ziskany: ");
      kod = 10000*rfid.serNum[4]+1000*rfid.serNum[3]+100*rfid.serNum[2]+10*rfid.serNum[1]+rfid.serNum[0];
      Serial.println(kod);
      String kodik = String(kod);        
    }
  }
  rfid.halt();
}
</pre>
<hr>
</div>
     <?php 
      include("footer.php");
      ?>
 </body>

</html>
