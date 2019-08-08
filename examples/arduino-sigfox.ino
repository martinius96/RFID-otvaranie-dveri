/*|----------------------------------------------------------|*/
/*|SKETCH PRE RFID SYSTEM S WEB ADMINISTRACIOU               |*/
/*|VYHOTOVIL: MARTIN CHLEBOVEC                               |*/
/*|FB: https://www.facebook.com/martin.s.chlebovec           |*/
/*|EMAIL: martinius96@gmail.com                              |*/
/*|Doska: Arduino Uno (Nano, Mega) + Sigfox modem            |*/
/*|WEB: https://arduino.php5.sk                              |*/
/*|----------------------------------------------------------|*/
#include <RFID.h>
#include <SPI.h>
#include <SoftwareSerial.h>
#define SS_PIN 6
#define RST_PIN 5
RFID rfid(SS_PIN, RST_PIN);
#define TX 7
#define RX 8
unsigned long kod;
const int rele = 3; //D3
SoftwareSerial Sigfox(RX, TX);
void setup() {
  pinMode(rele, OUTPUT);
  digitalWrite(rele, HIGH); //hotfix
  SPI.begin();
  rfid.init();
  Serial.begin(115200);
  Sigfox.begin(9600);
  Serial.println("Ready");
}

void loop() {
  if (Sigfox.available()) {
    Serial.write(Sigfox.read());
  }
  if (Serial.available()) {
    Sigfox.write(Serial.read());
  }
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      Serial.println(" ");
      Serial.println("Card found");
      kod = 10000 * rfid.serNum[4] + 1000 * rfid.serNum[3] + 100 * rfid.serNum[2] + 10 * rfid.serNum[1] + rfid.serNum[0];
      Serial.println(kod);
      char sprava[12];
      unsigned int hodnota = (kod);
      sprintf(sprava, "%04X", hodnota);
      Serial.print("Odosielam cez Sigfox: ");
      Serial.print(hodnota);
      Serial.print(", hexa tvar: ");
      Serial.println(sprava);
      Sigfox.print("AT$SF=");
      Sigfox.println(sprava);
      /*|--------------------------------|*/
      /*|NUTNE NASTAVIT SIGFOX CALLBACK  |*/
      /*|ODOSLANIE DO DATABAZY, REST API |*/
      /*|--------------------------------|*/
    }
  }
  rfid.halt();
}
