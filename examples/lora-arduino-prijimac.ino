/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU               |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: Arduino Uno (Nano, Mega) + LoRa modul              |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|----------------------------------------------------------|*/
#include <avr\wdt.h>
#include <SPI.h>
#include <LoRa.h>

void setup() {
  Serial.begin(9600);
  wdt_enable(WDTO_8S);
  if (!LoRa.begin(915E6)) {
    Serial.println("Lora modul nenajdeny! Cakaj na Watchdog reset! Vykona sa o 8 sekund");
    while (1);
  }
}

void loop() {
  wdt_reset();
  int packetSize = LoRa.parsePacket();
  if (packetSize) {
    Serial.print("Prichajuci packet: ");
    while (LoRa.available()) {
      Serial.print((char)LoRa.read());
    }

    Serial.print("Sila signalu: ");
    Serial.println(LoRa.packetRssi());
  }
/*|-------------------------------|*/
/*|DALSIE SPRACOVANIE             |*/
/*|ODOSLANIE DO DATABAZY          |*/
/*|ODOSLANIE INOU TECHNOLOGIOU    |*/
/*|-------------------------------|*/
}
