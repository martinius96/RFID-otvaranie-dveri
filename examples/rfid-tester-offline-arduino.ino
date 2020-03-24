/*|----------------------------------------------------------|*/
/*|SKETCH PRE TEST RFID CITACKY RC522 s Arduinom             |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|----------------------------------------------------------|*/

#include <SPI.h>
#include <RFID.h>
#define SS_PIN 6
#define RST_PIN 5
RFID rfid(SS_PIN, RST_PIN); 
unsigned long kod;

void setup(){ 
  Serial.begin(9600);
  SPI.begin(); 
  rfid.init();
}

void loop(){
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.println("Kod karty ziskany: ");
      kod = 10000*rfid.serNum[4]+1000*rfid.serNum[3]+100*rfid.serNum[2]+10*rfid.serNum[1]+rfid.serNum[0];
      Serial.println(kod);
      String kodik = String(kod);        
    }
  }
  rfid.halt();
}
