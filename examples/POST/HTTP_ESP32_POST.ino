/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU               |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: ESP32 DevKit V1 - V4                               |*/
/*|CORE: 1.0.0+                                              |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|----------------------------------------------------------|*/
//#define OTA //odkomentuj pre OTA UPDATE CEZ LAN
#include <WiFi.h>
#include <SPI.h>
#include <RFID.h>

#ifdef OTA
#include <ESPmDNS.h>
#include <WiFiUdp.h>
#include <ArduinoOTA.h>
#endif

const char * ssid = "wifi_meno";
const char * password = "wifi_heslo";
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
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
#ifdef OTA
  // Port defaults to 3232
  // ArduinoOTA.setPort(3232);

  // Hostname defaults to esp3232-[MAC]
  // ArduinoOTA.setHostname("myesp32");

  // No authentication by default
  // ArduinoOTA.setPassword("admin");

  // Password can be set with it's md5 value as well
  // MD5(admin) = 21232f297a57a5a743894a0e4a801fc3
  // ArduinoOTA.setPasswordHash("21232f297a57a5a743894a0e4a801fc3");

  ArduinoOTA
    .onStart([]() {
      String type;
      if (ArduinoOTA.getCommand() == U_FLASH)
        type = "sketch";
      else // U_SPIFFS
        type = "filesystem";

      // NOTE: if updating SPIFFS this would be the place to unmount SPIFFS using SPIFFS.end()
      Serial.println("Start updating " + type);
    })
    .onEnd([]() {
      Serial.println("\nEnd");
    })
    .onProgress([](unsigned int progress, unsigned int total) {
      Serial.printf("Progress: %u%%\r", (progress / (total / 100)));
    })
    .onError([](ota_error_t error) {
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
      Serial.println(kod);
      String kodik = String(kod);
      client.stop();
      String kodik = String(kod);
      String data = "kod=" + kodik;
      String url = "/rfid/karta.php";
      if (client.connect(host, httpPort)) {
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
    }
  }
  rfid.halt();
}
