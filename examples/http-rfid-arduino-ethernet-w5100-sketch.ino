/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU               |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: Arduino Uno (Nano, Mega) + Wiznet W5100 (Ethernet) |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|----------------------------------------------------------|*/
#include <RFID.h>
#include <SPI.h>
#include <Ethernet.h>
byte mac[] = { 0xAA, 0xBB, 0xCC, 0x81, 0x7B, 0x4A };
const char * host = "www.arduino.php5.sk";
IPAddress ip(192, 168, 1, 254);
#define SS_PIN 4
#define RST_PIN 5
RFID rfid(SS_PIN, RST_PIN);
unsigned long kod;
const int rele = 3; //D3
EthernetClient client;
void setup() {
  pinMode(rele, OUTPUT);
  digitalWrite(rele, HIGH); //hotfix
  SPI.begin();
  rfid.init();
  if (Ethernet.begin(mac) == 0) {
    Ethernet.begin(mac, ip);
  }
  Serial.begin(115200);
  Serial.println("Ready");
}

void loop() {
  if (Ethernet.begin(mac) == 0) {
    Ethernet.begin(mac, ip);
  }
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.println("Card found");
      kod = 10000 * rfid.serNum[4] + 1000 * rfid.serNum[3] + 100 * rfid.serNum[2] + 10 * rfid.serNum[1] + rfid.serNum[0];
      Serial.println(kod);
      String kodik = String(kod);
      client.stop();
      if (client.connect(host, 80)) {
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
        } else if (line == "NO") {
          digitalWrite(rele, HIGH);
        }
      }
    }
  }

  rfid.halt();
}
