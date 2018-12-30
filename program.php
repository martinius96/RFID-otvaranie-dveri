<!DOCTYPE html>
<html lang="en">
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
			               <span class="sr-only">(current)</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="odobrat.php">Odobrať kartu</a>
            </li>
			<li class="nav-item active">
              <a class="nav-link" href="program.php">Program</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
	 <hr><h2>Wiring</h2><hr>
	 	 <img src="https://i.stack.imgur.com/e1ewN.png" style="display: block; max-width: 100%; height: auto;">
	   <hr><h2>Projekt</h2><hr>
	   <li><a href="https://ulozto.sk/!YUKP0EbHnv5U/rfid-zip">Knižnica pre RC522</a></li><br>
	   <li><a href="https://github.com/esp8266/Arduino/">Návod na inštaláciu NodeMCU do ArduinoIDE</a></li><br>
	  <hr><h2>Zdrojový kód</h2><hr>
<pre style="background-color:powderblue;">
#include &lt;ESP8266WiFi.h&gt;
#include &lt;WiFiClientSecure.h&gt;
#include &lt;SPI.h&gt;
#include &lt;RFID.h&gt;
const char * ssid = "MenoWifiSiete";
const char * password = "HesloWifiSiete";
const char * host = "example.com"; //bez https a www
const int httpsPort = 443; //https port
const char * fingerprint = "‎a6 02 4d e1 32 b0 0b fe 56 85 0f 84 03 ec b2 18 23 09 f0 aa"; // odtlacok HTTPS
#define SS_PIN 4
#define RST_PIN 5

RFID rfid(SS_PIN, RST_PIN); 
unsigned long kod;
 WiFiClientSecure client; //HTTPS client
void setup()
{ 
  Serial.begin(9600);
  SPI.begin(); 
  rfid.init();
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi uspesne pripojene");
  Serial.println("IP adresa: ");
  Serial.println(WiFi.localIP());
  Serial.println("Ready");

}

void loop()
{
if (WiFi.status() != WL_CONNECTED) {
WiFi.begin(ssid, password);
}
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
    if (rfid.isCard()) {
        if (rfid.readCardSerial()) {
           
                /* With a new cardnumber, show it. */
                Serial.println(" ");
                Serial.println("Card found");
              kod = 10000*rfid.serNum[4]+1000*rfid.serNum[3]+100*rfid.serNum[2]+10*rfid.serNum[1]+rfid.serNum[0];
          Serial.println(kod);
          String kodik = String(kod);
            if (client.connect(host, httpsPort)) {
    String url = "/karta.php?kod="+kodik;
    client.print(String("GET ") + url + " HTTP/1.0\r\n" + "Host: " + host + "\r\n" + "User-Agent: NodeMCU\r\n" + "Connection: close\r\n\r\n");

    while (client.connected()) {
      String line = client.readStringUntil('\n');
      if (line == "\r") {
        break;
      }
    }
    String line = client.readStringUntil('\n');
    if (line == "OK") {
	//FUNKCNOST SA DOPLNI NESKOR
    } else if (line == "NO") {
    //FUNKCNOST SA DOPLNI NESKOR
	}
  }
          }
    }

    rfid.halt();
}
	</pre>
    
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
