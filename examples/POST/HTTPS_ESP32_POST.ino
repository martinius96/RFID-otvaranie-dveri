/*|--------------------------------------------------------|*/
/*|Project: RFID remote database access webapp             |*/
/*|ESP32 (DevKit, Generic), Arduino Core with FreeRTOS     |*/
/*|Autor: Martin Chlebovec (martinius96)                   |*/
/*|E-mail: martinius96@gmail.com                           |*/
/*|There isn't test web interface available for HTTPS      |*/
/*|Usage license: MIT                                      |*/
/*|Revísion: 31. March 2022                                |*/
/*|Tested stable ESP32 core: 2.0.2                         |*/
/*|799 kB flash usage, 38 kB RAM usage                     |*/
/*|--------------------------------------------------------|*/

#include <WiFi.h>
#include <WiFiClientSecure.h>
#include <SPI.h>
#include <MFRC522.h>

unsigned long code;
const int rele = 17; //RELAY PIN
#define SS_PIN 21 //CHIP SELECT PIN
#define RST_PIN 22 //RESET PIN

const char * ssid = "MY_WIFI"; //WiFi hotspot name
const char * password = "MY_WIFI_PASSWORD"; //WiFi hotspot password
const char* host = "XXXXX.com"; //domain - host
String url = "/rfid/karta.php"; //URL behind host domain --> target PHP file



TaskHandle_t Task1; //ULTRASONIC MEASUREMENT
TaskHandle_t Task2; //WIFI HTTP SOCKET
QueueHandle_t  q = NULL;

WiFiClientSecure client;
MFRC522 rfid(SS_PIN, RST_PIN);
static void Task1code( void * parameter);
static void Task2code( void * parameter);
void dump_byte_array(byte *buffer, byte bufferSize);

//DST ROOT CA X3 EXAMPLE (https://i.imgur.com/fvw4huT.png)
const static char* test_root_ca PROGMEM = \
    "-----BEGIN CERTIFICATE-----\n" \
    "MIIDrzCCApegAwIBAgIQCDvgVpBCRrGhdWrJWZHHSjANBgkqhkiG9w0BAQUFADBh\n" \
    "MQswCQYDVQQGEwJVUzEVMBMGA1UEChMMRGlnaUNlcnQgSW5jMRkwFwYDVQQLExB3\n" \
    "d3cuZGlnaWNlcnQuY29tMSAwHgYDVQQDExdEaWdpQ2VydCBHbG9iYWwgUm9vdCBD\n" \
    "QTAeFw0wNjExMTAwMDAwMDBaFw0zMTExMTAwMDAwMDBaMGExCzAJBgNVBAYTAlVT\n" \
    "MRUwEwYDVQQKEwxEaWdpQ2VydCBJbmMxGTAXBgNVBAsTEHd3dy5kaWdpY2VydC5j\n" \
    "b20xIDAeBgNVBAMTF0RpZ2lDZXJ0IEdsb2JhbCBSb290IENBMIIBIjANBgkqhkiG\n" \
    "9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4jvhEXLeqKTTo1eqUKKPC3eQyaKl7hLOllsB\n" \
    "CSDMAZOnTjC3U/dDxGkAV53ijSLdhwZAAIEJzs4bg7/fzTtxRuLWZscFs3YnFo97\n" \
    "nh6Vfe63SKMI2tavegw5BmV/Sl0fvBf4q77uKNd0f3p4mVmFaG5cIzJLv07A6Fpt\n" \
    "43C/dxC//AH2hdmoRBBYMql1GNXRor5H4idq9Joz+EkIYIvUX7Q6hL+hqkpMfT7P\n" \
    "T19sdl6gSzeRntwi5m3OFBqOasv+zbMUZBfHWymeMr/y7vrTC0LUq7dBMtoM1O/4\n" \
    "gdW7jVg/tRvoSSiicNoxBN33shbyTApOB6jtSj1etX+jkMOvJwIDAQABo2MwYTAO\n" \
    "BgNVHQ8BAf8EBAMCAYYwDwYDVR0TAQH/BAUwAwEB/zAdBgNVHQ4EFgQUA95QNVbR\n" \
    "TLtm8KPiGxvDl7I90VUwHwYDVR0jBBgwFoAUA95QNVbRTLtm8KPiGxvDl7I90VUw\n" \
    "DQYJKoZIhvcNAQEFBQADggEBAMucN6pIExIK+t1EnE9SsPTfrgT1eXkIoyQY/Esr\n" \
    "hMAtudXH/vTBH1jLuG2cenTnmCmrEbXjcKChzUyImZOMkXDiqw8cvpOp/2PV5Adg\n" \
    "06O/nVsJ8dWO41P0jmP6P6fbtGbfYmbW0W5BjfIttep3Sp+dWOIrWcBAI+0tKIJF\n" \
    "PnlUkiaY4IBIqDfv8NZ5YBberOgOzW6sRBc4L0na4UU+Krk2U886UAb3LujEV0ls\n" \
    "YSEY1QSteDwsOoBrp+uvFRTp2InBuThs4pFsiv9kuXclVzDAGySj4dzp30d8tbQk\n" \
    "CAUw7C29C79Fv1C5qfPrmAESrciIxpg0X40KPMbp1ZWVbd4=\n" \
    "-----END CERTIFICATE-----\n";

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
  client.setCACert(test_root_ca);
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
      xQueueSend(q, (void *)&RFIDcode, (TickType_t )0); //add the measurement value to Queue
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
    if (client.connect(host, 443)) {
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
        delay(5500);              //duration of doors opened
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
  for (byte i = 0; i < bufferSize; i++) {
  }
  Serial.print(F("Detected UID (code) of RFID CARD: "));
  code = 10000 * buffer[4] + 1000 * buffer[3] + 100 * buffer[2] + 10 * buffer[1] + buffer[0]; //finalny kod karty
  Serial.println(code);
}
