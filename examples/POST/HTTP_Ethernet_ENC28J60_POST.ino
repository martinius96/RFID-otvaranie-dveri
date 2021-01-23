/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU               |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: Arduino Uno (Nano, Mega) + ENC28J60 (Ethernet)     |*/
/*|WEB: https://arduino.clanweb.eu                           |*/
/*|----------------------------------------------------------|*/
#include <RFID.h>
#include <SPI.h>
#include <UIPEthernet.h>
byte mac[] = { 0xAA, 0xBB, 0xCC, 0xDD, 0xEE, 0x4C };
const char * host = "arduino.clanweb.eu";
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
  Serial.print(F("Assigned IP "));
  Serial.println(Ethernet.localIP());
  Serial.println(F("Ready"));
}

void loop() {
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.print(F("Pouzivatel prilozil kartu: "));
      kod = 10000 * rfid.serNum[4] + 1000 * rfid.serNum[3] + 100 * rfid.serNum[2] + 10 * rfid.serNum[1] + rfid.serNum[0];
      Serial.println("**********"); //nezverejni sa vo vypise moznemu utocnikovi
      client.stop();
      String kodik = String(kod);
      String data = "kod=" + kodik;
      String url = F("/rfid/karta.php"); //URL k target php suboru
      if (client.connect(host, 80)) {
        client.println("POST " + url + " HTTP/1.0"); //pri HTTP/1.1 Chunk encoding - narocne spracovanie
        client.println("Host: " + (String)host);
        client.println(F("User-Agent: ENC28J60"));
        client.println(F("Connection: close"));
        client.println(F("Content-Type: application/x-www-form-urlencoded;"));
        client.print(F("Content-Length: "));
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
        // Ethernet.maintain(); //ONLY FOR DHCP
      }
    }
  }
  rfid.halt();
}
