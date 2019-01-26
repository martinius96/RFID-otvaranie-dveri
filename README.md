# [RFID prístupový systém so správou on-line](https://arduino.php5.sk/rfid/)

# Systém ponúka
* Overenie kariet a prístupu cez web do objektu
* Čítačka prečíta kartu štandardu ISO/IEC 14443 A, jej MAC adresu odošle na web, kde sa overí a odpovie sa OK/NO
* Možno použiť ISIC karty, bankomatové, zamestnanecké karty
* V prípade odpovede OK NodeMCU aktivuje jazýček, čím je možné dvere otvoriť. 
* Z vnútornej strany objektu je možné dvere kľúčkou otvoriť, jazýček sa vtiahne

# Hardvér
* NodeMCU (v2, alebo v3)
* Basekit (možný iba pri V3, možnosť využiť napájanie na 6-24V)
* Čítačka RC522 na 13.56 MHz pre štandard ISO/IEC 14443 A,
* 5V elmg. 1-kanálové relé

# Technológie
* PHP
* AJAX
* HTML
* Wiring (pre NodeMCU)

# Inštalácia systému
* Stiahnuť repozitár
* Súbor export_dat_db.sql z priečinka sql importovať do vašej MySQL databázy
* V súbore connect.php nastaviť vaše údaje na databázu
* src priečinok skopírovať do: C:/Moje Dokumenty/Arduino/libraries/rfid
* Web súbory nahrať na FTP
* v zdrojovom kóde pre NodeMCU - zvoliť si verziu HTTPS/HTTP, zmeniť údaje k wifi sieti, meno webservera
* Hotovo

# Zapojenie
| RC522 | NodeMCU |
|:-----|--------:|
| 3.3V | 3.3V    |
| RST  | D1 (GPIO5) |
| GND  | GND |
| MISO | D6 (GPIO12) |
| MOSI | D7 (GPIO13) |
| SCK  | D5 (GPIO14) |
| SDA  | D2 (GPIO4) |
| IRQ  | Nezapája sa |

| Relé | NodeMCU |
|:-----|--------:|
| 5V | VIN / VUSB    |
| GND  | GND |
| IN  | D0 (GPIO16) |
