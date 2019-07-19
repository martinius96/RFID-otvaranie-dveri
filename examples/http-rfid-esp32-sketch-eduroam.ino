/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU               |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: ESP32 DevKit V1 - V4                               |*/
/*|CORE: 1.0.0+                                              |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|----------------------------------------------------------|*/
#include <WiFi.h>
#include "esp_wpa2.h"
#include <SPI.h>
#include <RFID.h>

#define ANONYMOUS_EAP_IDENTITY "anonymous@example.com" // use id@example.com if not using ananymous identity
#define EAP_IDENTITY "id@example.com"
#define EAP_PASSWORD "EDUROAM_PASSWORD_USER" //heslo pouzivatela

const char* ssid = "eduroam"; // Eduroam SSID
const char * host = "www.arduino.php5.sk";
const int httpPort = 80; //http port
const int rele = 17;
#define SS_PIN 21
#define RST_PIN 22
RFID rfid(SS_PIN, RST_PIN);
unsigned long kod;
WiFiClient client;
void setup() {
  Serial.begin(115200);
  SPI.begin();
  rfid.init();
  pinMode(rele, OUTPUT);
  digitalWrite(rele, HIGH); //hotfix
  WiFi.disconnect(true);
  WiFi.mode(WIFI_STA);
  esp_wifi_sta_wpa2_ent_set_identity((uint8_t *)ANONYMOUS_EAP_IDENTITY, strlen(ANONYMOUS_EAP_IDENTITY));
  esp_wifi_sta_wpa2_ent_set_username((uint8_t *)EAP_IDENTITY, strlen(EAP_IDENTITY));
  esp_wifi_sta_wpa2_ent_set_password((uint8_t *)EAP_PASSWORD, strlen(EAP_PASSWORD));
  esp_wpa2_config_t config = WPA2_CONFIG_INIT_DEFAULT();
  esp_wifi_sta_wpa2_ent_enable(&config);
  WiFi.begin(ssid);
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
    WiFi.begin(ssid);
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
      String kodik = String(kod);
      client.stop();
      if (client.connect(host, httpPort)) {
        String url = "/rfid/karta.php?kod=" + kodik;
        //String url = "/rfid/karta.php?kod="+kodik+"&origin=ESP32";
        //String url = "/rfid/karta.php?kod="+kodik+"&origin=ESP32&topsecret=topsecret";
        client.print(String("GET ") + url + " HTTP/1.0\r\n" + "Host: " + host + "\r\n" + "User-Agent: ESP32\r\n" + "Connection: close\r\n\r\n");
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
        }
      }
    }
  }

  rfid.halt();
}
