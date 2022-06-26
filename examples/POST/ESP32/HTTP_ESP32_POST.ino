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

#include <WiFi.h>
#include <SPI.h>
#include <MFRC522.h>

unsigned long code;
const int rele = 17; //RELAY PIN
#define SS_PIN 21 //CHIP SELECT PIN
#define RST_PIN 22 //RESET PIN

const char * ssid = "MY_WIFI"; //WiFi hotspot name
const char * password = "MY_WIFI_PASSWORD"; //WiFi hotspot password
const char* host = "arduino.clanweb.eu"; //domain - host
String url = "/rfid/karta.php"; //URL behind host domain --> target PHP file



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
  for (byte i = 0; i < bufferSize; i++) {
  }
  Serial.print(F("Detected UID (code) of RFID CARD: "));
  code = 10000 * buffer[4] + 1000 * buffer[3] + 100 * buffer[2] + 10 * buffer[1] + buffer[0]; //finalny kod karty
  //Serial.println(code);
}
