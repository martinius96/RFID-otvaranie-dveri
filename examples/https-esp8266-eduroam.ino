/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU               |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: NodeMCU v3 Lolin (v2 compatible)                   |*/
/*|CORE: 2.5.0 ONLY!!! (EXPERIMENTAL)                        |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|----------------------------------------------------------|*/
#include <ESP8266WiFi.h>
#include <WiFiClientSecure.h>
#include <SPI.h>
#include <RFID.h>

extern "C" {
#include "user_interface.h"
#include "wpa2_enterprise.h"
}

static const char* ssid = "eduroam";
static const char* identity = "anonymous@example.com";
static const char* username = "id@example.com";
static const char* password = "password";

const char * host = "arduino.php5.sk"; //bez https a www
const int httpsPort = 443; //https port
const int rele = 16; //GPIO16 == D0
const char * fingerprint = "b0 6d 7f 8c 98 78 8e 6e 0a 57 a8 2f 7e d1 40 2a 1e 3f 48 f7"; // odtlacok HTTPS cert
#define SS_PIN 4
#define RST_PIN 5
RFID rfid(SS_PIN, RST_PIN);
unsigned long kod;
WiFiClientSecure client; //HTTPS client
void setup() {
  Serial.begin(9600);
  SPI.begin();
  rfid.init();
  pinMode(rele, OUTPUT);
  digitalWrite(rele, HIGH); //hotfix
  wifi_set_opmode(STATION_MODE);
  struct station_config wifi_config;
  memset(&wifi_config, 0, sizeof(wifi_config));
  strcpy((char*)wifi_config.ssid, ssid);
  wifi_station_set_config(&wifi_config);
  wifi_station_clear_cert_key();
  wifi_station_clear_enterprise_ca_cert();
  wifi_station_set_wpa2_enterprise_auth(1);
  wifi_station_set_enterprise_identity((uint8*)identity, strlen(identity));
  wifi_station_set_enterprise_username((uint8*)username, strlen(username));
  wifi_station_set_enterprise_password((uint8*)password, strlen(password));
  wifi_station_connect();
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
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.println("Card found");
      kod = 10000 * rfid.serNum[4] + 1000 * rfid.serNum[3] + 100 * rfid.serNum[2] + 10 * rfid.serNum[1] + rfid.serNum[0];
      Serial.println(kod);
      String kodik = String(kod);
      client.stop();
      if (client.connect(host, httpsPort)) {
        String url = "/rfid/karta.php?kod=" + kodik;
        //String url = "/rfid/karta.php?kod="+kodik+"&origin=Lolin";
        //String url = "/rfid/karta.php?kod="+kodik+"&origin=Lolin&topsecret=topsecret";
        client.print(String("GET ") + url + " HTTP/1.0\r\n" + "Host: " + host + "\r\n" + "User-Agent: NodeMCU\r\n" + "Connection: close\r\n\r\n");
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
        } else{
          Serial.println("Prosim pockajte s dalsim overenim karty 5 sekund!");
          }  
      }
    }
  }
  rfid.halt();
}
