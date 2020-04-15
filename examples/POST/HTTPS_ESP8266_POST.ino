/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU  (FUNGUJE)    |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: NodeMCU v3 Lolin (v2 compatible)                   |*/
/*|CORE: 2.5.0 (2.5.2)                                       |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|----------------------------------------------------------|*/
#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>
#include <SPI.h>
#include <RFID.h>

const char * ssid = "MenoWifiSiete";
const char * password = "HesloWifiSiete";
const char * host = "arduino.php5.sk"; //bez https a www
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
  pinMode(rele, OUTPUT);
  digitalWrite(rele, HIGH); //hotfix
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

void loop() {
  if (WiFi.status() != WL_CONNECTED) {
    WiFi.begin(ssid, password);
  }
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.println("Card found");
      kod = 10000 * rfid.serNum[4] + 1000 * rfid.serNum[3] + 100 * rfid.serNum[2] + 10 * rfid.serNum[1] + rfid.serNum[0];
      Serial.println(kod);
      WiFiClientSecure client;
      Serial.printf("Using fingerprint '%s'\n", fingerprint);
      client.setFingerprint(fingerprint);
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
        if (line == "OK") {
          digitalWrite(rele, LOW); //invertovane spinane rele active LOW
          delay(5500);              //cas otvorenia dveri
          digitalWrite(rele, HIGH); //zatvor zamok
        } else if (line == "NO") {
          digitalWrite(rele, HIGH);
        } else {
          Serial.println("Prosim pockajte s dalsim overenim karty 5 sekund!");
        }
      }
      client.stop();
    }
  }
  rfid.halt();
}
