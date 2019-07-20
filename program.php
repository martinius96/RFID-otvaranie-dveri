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
	   <hr><h2>Projekt</h2><hr>
	   <li><a href="https://github.com/esp8266/Arduino/">Návod na inštaláciu NodeMCU do ArduinoIDE</a></li><br>
	   <li><a href="http://www.handsontec.com/pdf_learn/esp8266-V10.pdf">NodeMCU v1.0 (v3, v2) datasheet</a></li><br>
	   <li><a href="https://www.nxp.com/docs/en/data-sheet/MFRC522.pdf">RC522 datasheet</a></li><br>
	   <li><a href="https://github.com/martinius96/RFID-otvaranie-dveri/">Repozitár so zdrojovými kódmi pre webstránku, ESP8266 a RFID čítačku RC522</a></li>
	  <hr><h2>Zdrojové kódy s pripojením na: https://arduino.php5.sk/rfid</h2><hr>
    <h3>Arduino + Ethernet</h3>
    <li>Arduino + Ethernet W5100<a href="examples/http-ethernet-w5100.ino"><img src="http://www.multipecastec.com.br/loja/img/thumb/ethernet-shield-wiznet-w5100-para-arduino_3464.jpg" width="48px" height="48px" title="Ethernet W5100" alt="Ethernet W5100" border-radius="50px"></a></li>  
    <li>Arduino + Ethernet W5500<a href="examples/http-ethernet-w5500.ino"><img src="https://cdn.instructables.com/FAT/YMPE/JHQJS5HZ/FATYMPEJHQJS5HZ.LARGE.jpg" width="48px" height="48px" title="Ethernet W5500" alt="Ethernet W5500" border-radius="50px"></a></li> 
    <h3>ESP8266 (NodeMCU)</h3>
    <li>HTTP (PSK)<a href="examples/http-esp8266-psk.ino"><img src="https://0.allegroimg.com/s128/03b7c4/b538b7284cdf8e5fad55bcad8b10/Modul-WiFi-NodeMCU-V3-ESP8266-ESP-12E-Arduino" width="48px" height="48px" title="NodeMCU v3 Lolin" alt="NodeMCU v3 Lolin" border-radius="50px"></a></li>  
    <li>HTTPS (PSK)<a href="examples/https-esp8266-psk.ino"><img src="https://0.allegroimg.com/s128/03b7c4/b538b7284cdf8e5fad55bcad8b10/Modul-WiFi-NodeMCU-V3-ESP8266-ESP-12E-Arduino" width="48px" height="48px" title="NodeMCU v3 Lolin" alt="NodeMCU v3 Lolin" border-radius="50px"></a></li>  
    <hr>
    <li>HTTP (802.1X)<a href="examples/http-esp8266-eduroam.ino"><img src="https://0.allegroimg.com/s128/03b7c4/b538b7284cdf8e5fad55bcad8b10/Modul-WiFi-NodeMCU-V3-ESP8266-ESP-12E-Arduino" width="48px" height="48px" title="NodeMCU v3 Lolin" alt="NodeMCU v3 Lolin" border-radius="50px"></a></li>  
    <li>HTTPS (802.1X)<a href="examples/https-esp8266-eduroam.ino"><img src="https://0.allegroimg.com/s128/03b7c4/b538b7284cdf8e5fad55bcad8b10/Modul-WiFi-NodeMCU-V3-ESP8266-ESP-12E-Arduino" width="48px" height="48px" title="NodeMCU v3 Lolin" alt="NodeMCU v3 Lolin" border-radius="50px"></a></li>  
    <h3>ESP32 (Devkit)</h3>
    <li>HTTP (PSK)<a href="examples/http-esp32-psk.ino"><img src="https://a.allegroimg.com/s128/0333a2/0e99076c4dfe84c6e6632f4759e0" width="48px" height="48px" title="ESP32 DevKit" alt="ESP32 DevKit" border-radius="50px"></a></li>  
    <li>HTTPS (PSK)<a href="examples/https-esp32-psk.ino"><img src="https://a.allegroimg.com/s128/0333a2/0e99076c4dfe84c6e6632f4759e0" width="48px" height="48px" title="ESP32 DevKit" alt="ESP32 DevKit" border-radius="50px"></a></li>  
    <hr>
    <li>HTTP (802.1X)<a href="examples/http-esp32-eduroam.ino"><img src="https://a.allegroimg.com/s128/0333a2/0e99076c4dfe84c6e6632f4759e0" width="48px" height="48px" title="ESP32 DevKit" alt="ESP32 DevKit" border-radius="50px"></a></li>  
    <li>HTTPS (802.1X)<a href="examples/https-esp32-eduroam.ino"><img src="https://a.allegroimg.com/s128/0333a2/0e99076c4dfe84c6e6632f4759e0" width="48px" height="48px" title="ESP32 DevKit" alt="ESP32 DevKit" border-radius="50px"></a></li>
    <hr><h2>Zdrojový kód - Offline tester</h2><hr>
<pre style="background-color:#3498DB;">
/*|----------------------------------------------------------|*/
/*|SKETCH PRE TEST RFID CITACKY RC522                        |*/
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

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
