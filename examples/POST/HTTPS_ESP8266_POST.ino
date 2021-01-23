/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU  (FUNGUJE)    |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: NodeMCU v3 Lolin (v2 compatible)                   |*/
/*|CORE: 2.7.4                                               |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|----------------------------------------------------------|*/
//#define OTA //odkomentuj pre OTA UPDATE CEZ LAN
#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>
#include <SPI.h>
#include <RFID.h>

#ifdef OTA
#include <ESP8266mDNS.h>
#include <WiFiUdp.h>
#include <ArduinoOTA.h>
#endif

const char * ssid = "WIFI_NAME";
const char * password = "WIFI_PASSWORD";
const char * host = "arduino.php5.sk"; //dana domena neexistuje, pripojenie sa nevykona
const int httpsPort = 443; //https port

const int rele = 16; //GPIO16 == D0
const char fingerprint[] PROGMEM = "00 2c c1 3a 3c fd a2 0a a3 f1 19 1a ee ee 54 72 93 56 7d 1b";
#define SS_PIN 4
#define RST_PIN 5
RFID rfid(SS_PIN, RST_PIN);
unsigned long kod;
void setup() {
  Serial.begin(9600);
  SPI.begin();
  rfid.init();
  //client.setInsecure(); //ak webserver neakceptuje pripojenie s fingerpritom, vyuzite allowinsecure (pripojenie bez fingerprintu)
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
#ifdef OTA
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
  ArduinoOTA.handle();
#endif
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.println("Card found");
      kod = 10000 * rfid.serNum[4] + 1000 * rfid.serNum[3] + 100 * rfid.serNum[2] + 10 * rfid.serNum[1] + rfid.serNum[0];
      Serial.println(kod);
      WiFiClientSecure client;
      Serial.printf("Using fingerprint '%s'\n", fingerprint); // zakomentovat, ak je odkomentovane client.setInsecure()
      client.setFingerprint(fingerprint); // zakomentovat, ak je odkomentovane client.setInsecure()
      String kodik = String(kod);
      String data = "kod=" + kodik;
      String url = "/rfid/karta.php";
      if (client.connect(host, httpsPort)) {
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
      client.stop();
    }
  }
  rfid.halt();
}
