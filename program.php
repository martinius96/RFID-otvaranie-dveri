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
    <div class="alert alert-success">
	    <strong>Zdrojové kódy webového rozhrania pre projekt RFID vrátnik sú dostupné zdarma pod MIT licenciou:</strong> <a href="https://github.com/martinius96/RFID-otvaranie-dveri/">Repozitár Github</a><br>
</div>
 <h1 id="demo"></h1>
<hr><center><h4>Dostupné knižnice pre mikrokontroléry (Arduino)</h4></center><hr>
<div class="alert alert-danger">
	Archív knižnice (.zip) rozbaliť do <strong>C:/Používatelia/[Používateľ]/Dokumenty/Arduino/libraries</strong>
</div>
<div class="table-responsive">   
<table class="table" style="border: 1px solid black;">
<thead>
<tr>
<th style="width: 25%">Názov knižnice</th>
<th style="width: 50%">Funkcia knižnice</th>
<th style="width: 25%">Stiahnuť</th>
</tr>
</thead>
<tbody>
<tr>
<td style="width: 25%"><b>MFRC522</b></td>
<td style="width: 50%">
<p style="text-align: justify;">
Knižnica pre mikrokontroléry (ATmega) Arduino Uno / Nano / Mega, ESP8266 a ESP32. 
Umožňuje komunikovať s RFID čítačkou NXP RC522 po SPI zbernici. <b>Novšia a udržiavaná knižnica, použitá v príklade pre ESP32.</b>
</p>
</td>
<td style="width: 25%"><a href="https://minhaskamal.github.io/DownGit/#/home?url=https://github.com/martinius96/RFID-otvaranie-dveri/tree/master/src/MFRC522" class="btn btn-success" role="button">Stiahnuť</a></td>
</tr>
<tr>
<td style="width: 25%"><b>RFID</b></td>
<td style="width: 50%">
<p style="text-align: justify;">
Knižnica pre mikrokontroléry (ATmega) Arduino Uno / Nano / Mega, ESP8266 a ESP32. 
Umožňuje komunikovať s RFID čítačkou NXP RC522 po SPI zbernici. <b>Staršia knižnica, použitá v príklade pre Arduino a ESP8266.</b>
</p>
</td>
<td style="width: 25%"><a href="https://minhaskamal.github.io/DownGit/#/home?url=https://github.com/martinius96/RFID-otvaranie-dveri/tree/master/src/rfid" class="btn btn-success" role="button">Stiahnuť</a></td>
</tr>
</tbody>
</table>
</div>
<hr><h2><font color="#27AE60">HTTP - Arduino + Ethernet W5100 / W5500</font></h2><hr>
<pre style="background-color:#27AE60;"> 
/*|-----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU                |*/
/*|Arduino + Ethernet Wiznet W5100 / W5500 + NXP RC522        |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                                |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec            |*/
/*|EMAIL: martinius96@gmail.com                               |*/
/*|Testovacie WEB rozhranie: https://arduino.clanweb.eu/rfid/ |*/
/*|-----------------------------------------------------------|*/

#include &lt;RFID.h>
#include &lt;SPI.h>
#include &lt;Ethernet.h>
byte mac[] = { 0xAA, 0xBB, 0xCC, 0xDD, 0xEE, 0x4A };

const char * host = "<?php echo $_SERVER['SERVER_NAME']; ?>";
String url = "<?php if ($pathInfo['dirname'] != "/") { echo $pathInfo['dirname']; }  ?>/karta.php";
IPAddress ip(192, 168, 1, 254); //STATIC IP

#define SS_PIN 6
#define RST_PIN 5
RFID rfid(SS_PIN, RST_PIN);
unsigned long kod;
const int rele = 3; //D3
EthernetClient client;
void setup() {
  Serial.begin(115200);
  pinMode(rele, OUTPUT);
  digitalWrite(rele, HIGH); //hotfix
  SPI.begin();
  rfid.init();
  if (Ethernet.begin(mac) == 0) {
    // Ethernet.begin(mac);    //FOR DHCP
    Ethernet.begin(mac, ip);
  }
  Serial.print("Assigned IP ");
  Serial.println(Ethernet.localIP());
  Serial.println("Ready");
}

void loop() {
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.print("Pouzivatel prilozil kartu: ");
      kod = 10000 * rfid.serNum[4] + 1000 * rfid.serNum[3] + 100 * rfid.serNum[2] + 10 * rfid.serNum[1] + rfid.serNum[0];
      Serial.println("**********"); //nezverejni sa vo vypise moznemu utocnikovi
      client.stop();
      String kodik = String(kod);
      String data = "kod=" + kodik;
      if (client.connect(host, 80)) {
        client.println("POST " + url + " HTTP/1.0"); //pri HTTP/1.1 Chunk encoding - narocne spracovanie
        client.println("Host: " + (String)host);
        client.println("User-Agent: W5100");
        client.println("Connection: close");
        client.println("Content-Type: application/x-www-form-urlencoded;");
        client.print("Content-Length: ");
        client.println(data.length());
        client.println();
        client.println(data);
        while (client.connected()) {
          String line = client.readStringUntil('\n');
          if (line == "\r") {
            break;
          }
        }
        String line = client.readStringUntil('\n');
        if (line.indexOf("OK") > 0) {
          Serial.println("VSTUP POVOLENY");
          Serial.println("DVERE ODOMKNUTE");
          digitalWrite(rele, LOW); //invertovane spinane rele active LOW
          delay(5500);              //cas otvorenia dveri
          digitalWrite(rele, HIGH); //zatvor zamok
          Serial.println("DVERE ZAMKNUTE");
        } else if (line.indexOf("NO") > 0) {
          Serial.println("VSTUP ZAMIETNUTY");
        } else {
          Serial.println("Prosim pockajte s dalsim overenim karty 5 sekund!");
        }
        // Ethernet.maintain(); //ONLY FOR DHCP
      }
    }
  }
  rfid.halt();
}

</pre>
<hr><h2><font color="#3498DB">HTTP - ESP8266</font></h2><hr>
<pre style="background-color:#3498DB;"> 
/*|-------------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU                  |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                                  |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec              |*/
/*|EMAIL: martinius96@gmail.com                                 |*/
/*|Doska: ESP8266 Generic / NodeMCU / WEmos D1 Mini + NXP RC522 |*/
/*|CORE: 2.7.4 compatible                                       |*/
/*|Testovacie web rozhranie: http://arduino.clanweb.eu/rfid/    |*/
/*|-------------------------------------------------------------|*/

//#define OTA //odkomentuj pre OTA UPDATE CEZ LAN cez espota.py
#include &lt;ESP8266WiFi.h>
#include &lt;SPI.h>
#include &lt;RFID.h>

#ifdef OTA
#include &lt;ESP8266mDNS.h>
#include &lt;WiFiUdp.h>
#include &lt;ArduinoOTA.h>
#endif

const char * ssid = "WIFI_NAME";
const char * password = "WIFI_PASSWORD";

const char * host = "<?php echo $_SERVER['SERVER_NAME']; ?>";
String url = "<?php if ($pathInfo['dirname'] != "/") { echo $pathInfo['dirname']; }  ?>/karta.php";
const int httpPort = 80; //http port

const int rele = 16; //GPIO16 == D0
#define SS_PIN 4
#define RST_PIN 5
RFID rfid(SS_PIN, RST_PIN);
unsigned long kod;
WiFiClient client;
void setup() {
  Serial.begin(9600);
  SPI.begin();
  rfid.init();
  pinMode(rele, OUTPUT);
  digitalWrite(rele, HIGH); //hotfix
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
#ifdef OTA 
  // Port defaults to 8266
  // ArduinoOTA.setPort(8266);

  // Hostname defaults to esp8266-[ChipID]
  // ArduinoOTA.setHostname("myesp8266");

  // No authentication by default
  // ArduinoOTA.setPassword((const char *)"123");

  ArduinoOTA.onStart([]() {
    Serial.println("Start");
  });
  ArduinoOTA.onEnd([]() {
    Serial.println("\nEnd");
  });
  ArduinoOTA.onProgress([](unsigned int progress, unsigned int total) {
    Serial.printf("Progress: %u%%\r", (progress / (total / 100)));
  });
  ArduinoOTA.onError([](ota_error_t error) {
    Serial.printf("Error[%u]: ", error);
    if (error == OTA_AUTH_ERROR) Serial.println("Auth Failed");
    else if (error == OTA_BEGIN_ERROR) Serial.println("Begin Failed");
    else if (error == OTA_CONNECT_ERROR) Serial.println("Connect Failed");
    else if (error == OTA_RECEIVE_ERROR) Serial.println("Receive Failed");
    else if (error == OTA_END_ERROR) Serial.println("End Failed");
  });
  ArduinoOTA.begin();
#endif  
  Serial.println("");
  Serial.println("WiFi uspesne pripojene");
  Serial.println("IP adresa: ");
  Serial.println(WiFi.localIP());
  Serial.println("Ready");
}

void loop() {
  if (WiFi.status() != WL_CONNECTED) {
    WiFi.begin(ssid, password);
  }
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
#ifdef OTA 
  ArduinoOTA.handle();
#endif 
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.println("Card found");
      kod = 10000 * rfid.serNum[4] + 1000 * rfid.serNum[3] + 100 * rfid.serNum[2] + 10 * rfid.serNum[1] + rfid.serNum[0];
      client.stop();
      String kodik = String(kod);
      String data = "kod=" + kodik;
      if (client.connect(host, httpPort)) {
        client.println("POST " + url + " HTTP/1.0");
        client.println("Host: " + (String)host);
        client.println("User-Agent: ESP8266");
        client.println("Connection: close");
        client.println("Content-Type: application/x-www-form-urlencoded;");
        client.print("Content-Length: ");
        client.println(data.length());
        client.println();
        client.println(data);
        while (client.connected()) {
          String line = client.readStringUntil('\n');
          if (line == "\r") {
            break;
          }
        }
        String line = client.readStringUntil('\n');
        if (line.indexOf("OK") > 0) {
          Serial.println(F("VSTUP POVOLENY"));
          Serial.println(F("DVERE ODOMKNUTE"));
          digitalWrite(rele, LOW); //invertovane spinane rele active LOW
          delay(5500);              //cas otvorenia dveri
          digitalWrite(rele, HIGH); //zatvor zamok
          Serial.println(F("DVERE ZAMKNUTE"));
        } else if (line.indexOf("NO") > 0) {
          Serial.println(F("VSTUP ZAMIETNUTY"));
        } else {
          Serial.println(F("Prosim pockajte s dalsim overenim karty 5 sekund!"));
        }
      }
    }
  }

  rfid.halt();
}

</pre>
<hr><h2><font color="#95A5A6">HTTP - ESP32 + FreeRTOS, core 2.0+</font></h2><hr>
<pre style="background-color:#95A5A6;"> 
/*|--------------------------------------------------------|*/
/*|Project: RFID remote database access webapp             |*/
/*|ESP32 (DevKit, Generic), Arduino Core with FreeRTOS     |*/
/*|Autor: Martin Chlebovec (martinius96)                   |*/
/*|E-mail: martinius96@gmail.com                           |*/
/*|Test web interface: http://arduino.clanweb.eu/rfid/     |*/
/*|Usage license: MIT                                      |*/
/*|Revision: 31. March 2022                                |*/
/*|Tested stable ESP32 core: 2.0.2                         |*/
/*|657 kB flash usage, 37 kB RAM usage                     |*/
/*|--------------------------------------------------------|*/

#include &lt;WiFi.h>
#include &lt;SPI.h>
#include &lt;MFRC522.h>

unsigned long code;
const int rele = 17; //RELAY PIN
#define SS_PIN 21 //CHIP SELECT PIN
#define RST_PIN 22 //RESET PIN

const char * ssid = "MY_WIFI"; //WiFi hotspot name
const char * password = "MY_WIFI_PASSWORD"; //WiFi hotspot password
const char* host = "<?php echo $_SERVER['SERVER_NAME']; ?>"; //domain - host
String url = "<?php if ($pathInfo['dirname'] != "/") { echo $pathInfo['dirname']; }  ?>/karta.php"; //URL behind host domain --> target PHP file



TaskHandle_t Task1; //ULTRASONIC MEASUREMENT
TaskHandle_t Task2; //WIFI HTTP SOCKET
QueueHandle_t  q = NULL;

WiFiClient client; //socket client object
MFRC522 rfid(SS_PIN, RST_PIN);
static void Task1code( void * parameter);
static void Task2code( void * parameter);
void dump_byte_array(byte *buffer, byte bufferSize);

void setup() {
  Serial.begin(115200);
  SPI.begin();
  rfid.PCD_Init(); // Init MFRC522
  rfid.PCD_SetAntennaGain(112); // set antenna gain to max (00001110)
  rfid.PCD_DumpVersionToSerial(); //Write version of Firmware to UART
  pinMode(rele, OUTPUT);
  digitalWrite(rele, HIGH); //hotfix
  WiFi.begin(ssid, password); //pripoj sa na wifi siet s heslom
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.print(".");
  }
  Serial.println(F(""));
  Serial.println(F("Wifi connected with IP:"));
  Serial.println(WiFi.localIP());
  q = xQueueCreate(20, sizeof(unsigned long));
  if (q != NULL) {
    Serial.println(F("Queue FIFO buffer is created"));
    vTaskDelay(1000 / portTICK_PERIOD_MS); //wait for a second
    xTaskCreatePinnedToCore(
      Task1code,   /* Task function. */
      "Task1",     /* name of task. */
      10000,       /* Stack size of task */
      NULL,        /* parameter of the task */
      1,           /* priority of the task */
      &Task1,      /* Task handle to keep track of created task */
      1);          /* pin task to core 1 */
    Serial.println(F("RFID handler task started"));
    xTaskCreatePinnedToCore(
      Task2code,   /* Task function. */
      "Task2",     /* name of task. */
      10000,       /* Stack size of task */
      NULL,        /* parameter of the task */
      1,           /* priority of the task */
      &Task2,      /* Task handle to keep track of created task */
      0);          /* pin task to core 0 */
    Serial.println(F("HTTP Socket task started"));
  } else {
    Serial.println(F("Queue creation failed"));
  }
}

void loop() {
  if (WiFi.status() != WL_CONNECTED) {
    WiFi.begin(ssid, password); //pripoj sa na wifi siet s heslom
  }
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  yield();

}

static void Task1code( void * parameter) {
  unsigned long RFIDcode;
  if (q == NULL) {
    Serial.println(F("Queue in RFID handler task is not ready"));
    return;
  }
  while (1) {
    if (rfid.PICC_IsNewCardPresent() && rfid.PICC_ReadCardSerial()) {
      dump_byte_array(rfid.uid.uidByte, rfid.uid.size);
      rfid.PICC_HaltA();
      rfid.PCD_StopCrypto1();
      RFIDcode = code;
      xQueueSend(q, (void *)&RFIDcode, (TickType_t )0); //add RFID card UID to Queue
    }
  }
}
static void Task2code( void * parameter) {
  unsigned long RFIDcode;
  if (q == NULL) {
    Serial.println(F("Queue in HTTP socket task is not ready"));
    return;
  }
  while (1) {
    xQueueReceive(q, &RFIDcode, portMAX_DELAY); //read measurement value from Queue and run code below, if no value, WAIT until portMAX_DELAY
    String data = "kod=" + RFIDcode;
    client.stop();
    if (client.connect(host, 80)) {
      client.println("POST " + url + " HTTP/1.0");
      client.println("Host: " + (String)host);
      client.println("User-Agent: ESP32");
      client.println("Connection: close");
      client.println("Content-Type: application/x-www-form-urlencoded;");
      client.print("Content-Length: ");
      client.println(data.length());
      client.println();
      client.println(data);
      while (client.connected()) {
        String line = client.readStringUntil('\n');
        if (line == "\r") {
          break;
        }
      }
      String line = client.readStringUntil('\n');
      if (line.indexOf("OK") > 0) {
        Serial.println(F("ACCESS GAINED"));
        Serial.println(F("DOORS OPENED"));
        digitalWrite(rele, LOW); //inverted ACTIVE-LOW logic
        vTaskDelay(5500 / portTICK_PERIOD_MS); //duration of doors opened
        digitalWrite(rele, HIGH); //lock doors pack
        Serial.println(F("DOORS CLOSED"));
      } else if (line.indexOf("NO") > 0) {
        Serial.println(F("ACCESS REJECTED"));
      } else {
        Serial.println(F("WAIT 5 seconds before next attempt!"));
      }
    } else {
      Serial.println(F("Connection to webserver was not successful!"));
    }
    client.stop();
  }
}

void dump_byte_array(byte *buffer, byte bufferSize) {
  for (byte i = 0; i &lt; bufferSize; i++) {
  }
  Serial.print(F("Detected UID (code) of RFID CARD: "));
  code = 10000 * buffer[4] + 1000 * buffer[3] + 100 * buffer[2] + 10 * buffer[1] + buffer[0]; //finalny kod karty
  //Serial.println(code);
}

</pre>
<hr>
</div>
     <?php 
      include("footer.php");
      ?>
 </body>

</html>
