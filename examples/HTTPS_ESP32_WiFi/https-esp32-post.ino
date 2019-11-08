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
#include <WiFiClientSecure.h>
#include <SPI.h>
#include <RFID.h>
const char * ssid = "huawei-2929";
const char * password = "chefrolet";
const char * host = "arduino.php5.sk";
const int httpsPort = 443; //http port
const int rele = 17;
#define SS_PIN 21
#define RST_PIN 22
RFID rfid(SS_PIN, RST_PIN);
unsigned long kod;
const char* test_root_ca = \
                           "-----BEGIN CERTIFICATE-----\n" \
                           "MIIEsTCCA5mgAwIBAgIQCKWiRs1LXIyD1wK0u6tTSTANBgkqhkiG9w0BAQsFADBh\n" \
                           "MQswCQYDVQQGEwJVUzEVMBMGA1UEChMMRGlnaUNlcnQgSW5jMRkwFwYDVQQLExB3\n" \
                           "d3cuZGlnaWNlcnQuY29tMSAwHgYDVQQDExdEaWdpQ2VydCBHbG9iYWwgUm9vdCBD\n" \
                           "QTAeFw0xNzExMDYxMjIzMzNaFw0yNzExMDYxMjIzMzNaMF4xCzAJBgNVBAYTAlVT\n" \
                           "MRUwEwYDVQQKEwxEaWdpQ2VydCBJbmMxGTAXBgNVBAsTEHd3dy5kaWdpY2VydC5j\n" \
                           "b20xHTAbBgNVBAMTFFJhcGlkU1NMIFJTQSBDQSAyMDE4MIIBIjANBgkqhkiG9w0B\n" \
                           "AQEFAAOCAQ8AMIIBCgKCAQEA5S2oihEo9nnpezoziDtx4WWLLCll/e0t1EYemE5n\n" \
                           "+MgP5viaHLy+VpHP+ndX5D18INIuuAV8wFq26KF5U0WNIZiQp6mLtIWjUeWDPA28\n" \
                           "OeyhTlj9TLk2beytbtFU6ypbpWUltmvY5V8ngspC7nFRNCjpfnDED2kRyJzO8yoK\n" \
                           "MFz4J4JE8N7NA1uJwUEFMUvHLs0scLoPZkKcewIRm1RV2AxmFQxJkdf7YN9Pckki\n" \
                           "f2Xgm3b48BZn0zf0qXsSeGu84ua9gwzjzI7tbTBjayTpT+/XpWuBVv6fvarI6bik\n" \
                           "KB859OSGQuw73XXgeuFwEPHTIRoUtkzu3/EQ+LtwznkkdQIDAQABo4IBZjCCAWIw\n" \
                           "HQYDVR0OBBYEFFPKF1n8a8ADIS8aruSqqByCVtp1MB8GA1UdIwQYMBaAFAPeUDVW\n" \
                           "0Uy7ZvCj4hsbw5eyPdFVMA4GA1UdDwEB/wQEAwIBhjAdBgNVHSUEFjAUBggrBgEF\n" \
                           "BQcDAQYIKwYBBQUHAwIwEgYDVR0TAQH/BAgwBgEB/wIBADA0BggrBgEFBQcBAQQo\n" \
                           "MCYwJAYIKwYBBQUHMAGGGGh0dHA6Ly9vY3NwLmRpZ2ljZXJ0LmNvbTBCBgNVHR8E\n" \
                           "OzA5MDegNaAzhjFodHRwOi8vY3JsMy5kaWdpY2VydC5jb20vRGlnaUNlcnRHbG9i\n" \
                           "YWxSb290Q0EuY3JsMGMGA1UdIARcMFowNwYJYIZIAYb9bAECMCowKAYIKwYBBQUH\n" \
                           "AgEWHGh0dHBzOi8vd3d3LmRpZ2ljZXJ0LmNvbS9DUFMwCwYJYIZIAYb9bAEBMAgG\n" \
                           "BmeBDAECATAIBgZngQwBAgIwDQYJKoZIhvcNAQELBQADggEBAH4jx/LKNW5ZklFc\n" \
                           "YWs8Ejbm0nyzKeZC2KOVYR7P8gevKyslWm4Xo4BSzKr235FsJ4aFt6yAiv1eY0tZ\n" \
                           "/ZN18bOGSGStoEc/JE4ocIzr8P5Mg11kRYHbmgYnr1Rxeki5mSeb39DGxTpJD4kG\n" \
                           "hs5lXNoo4conUiiJwKaqH7vh2baryd8pMISag83JUqyVGc2tWPpO0329/CWq2kry\n" \
                           "qv66OSMjwulUz0dXf4OHQasR7CNfIr+4KScc6ABlQ5RDF86PGeE6kdwSQkFiB/cQ\n" \
                           "ysNyq0jEDQTkfa2pjmuWtMCNbBnhFXBYejfubIhaUbEv2FOQB3dCav+FPg5eEveX\n" \
                           "TVyMnGo=\n" \
                           "-----END CERTIFICATE-----\n";
WiFiClientSecure client;
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
  client.setCACert(test_root_ca);
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
      String kodik = String(kod);
      client.stop();
      String data = "kod=" + kodik;
      if (client.connect(host, httpsPort)) {
        String url = "/rfid/karta.php";
        //String url = "/rfid/karta.php?kod="+kodik+"&origin=ESP32";
        //String url = "/rfid/karta.php?kod="+kodik+"&origin=ESP32&topsecret=topsecret";
        client.print(String("POST ") + url + " HTTP/1.0\r\n" + "Host: " + host + "\r\n" + "User-Agent: ESP32\r\n" + "Connection: close\r\n" + "Content-Type: application/x-www-form-urlencoded;Content-Length: " + data.length() + "\r\n\r\n" + data + "\r\n");
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
