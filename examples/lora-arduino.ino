/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU               |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: Arduino Uno (Nano, Mega) + LoRa modul              |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|----------------------------------------------------------|*/
#include <RFID.h>
#include <SPI.h>
#include <LoRa.h>
#define SS_PIN 6
#define RST_PIN 5
RFID rfid(SS_PIN, RST_PIN);
unsigned long kod;
const int rele = 3; //D3
void setup() {
  pinMode(rele, OUTPUT);
  digitalWrite(rele, HIGH); //hotfix
  if (!LoRa.begin(915E6)) {
    Serial.println("Lora modul nenajdeny! Cakaj na Watchdog reset! Vykona sa o 8 sekund");
    while (1);
  }
  SPI.begin();
  rfid.init();
  Serial.begin(115200);
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
      LoRa.beginPacket();
      LoRa.print(kodik);
      LoRa.endPacket();
    }
  }
  rfid.halt();
}
