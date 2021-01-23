/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU               |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: Arduino Uno (Nano, Mega) + Wiznet W5100 (Ethernet) |*/
/*|WEB: https://arduino.clanweb.eu                           |*/
/*|----------------------------------------------------------|*/
#include <RFID.h>
#include <SPI.h>
#include <Ethernet2.h>
byte mac[] = { 0xAA, 0xBB, 0xCC, 0xDD, 0xEE, 0x4A };
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
  Serial.print("Assigned IP ");
  Serial.println(Ethernet.localIP());
  Serial.println("Ready");
}

void loop() {
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.print("Pouzivatel prilozil kartu: ");
      kod = 10000 * rfid.serNum[4] + 1000 * rfid.serNum[3] + 100 * rfid.serNum[2] + 10 * rfid.serNum[1] + rfid.serNum[0];
      Serial.println("**********"); //nezverejni sa vo vypise moznemu utocnikovi
      client.stop();
      String kodik = String(kod);
      String data = "kod=" + kodik;
      String url = "/rfid/karta.php";
      if (client.connect(host, 80)) {
        client.println("POST " + url + " HTTP/1.0"); //pri HTTP/1.1 Chunk encoding - narocne spracovanie
        client.println("Host: " + (String)host);
        client.println("User-Agent: W5100");
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
          Serial.println("VSTUP POVOLENY");
          Serial.println("DVERE ODOMKNUTE");
          digitalWrite(rele, LOW); //invertovane spinane rele active LOW
          delay(5500);              //cas otvorenia dveri
          digitalWrite(rele, HIGH); //zatvor zamok
          Serial.println("DVERE ZAMKNUTE");
        } else if (line.indexOf("NO") > 0) {
          Serial.println("VSTUP ZAMIETNUTY");
        } else {
          Serial.println("Prosim pockajte s dalsim overenim karty 5 sekund!");
        }
        // Ethernet.maintain(); //ONLY FOR DHCP
      }
    }
  }
  rfid.halt();
}
