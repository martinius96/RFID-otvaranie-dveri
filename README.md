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
* Súbor priečinka sql importovať do vašej MySQL databázy - štruktúru, alebo štruktúru + vzorové dáta
* V súbore connect.php nastaviť vaše údaje na databázu
* src priečinok skopírovať do: C:/Moje Dokumenty/Arduino/libraries/rfid (Win 10)
* Web súbory nahrať na FTP server
* v zdrojovom kóde pre NodeMCU - zvoliť si verziu HTTPS/HTTP, zmeniť údaje k wifi sieti, meno webservera
* Hotovo

# Webová časť
![Hlavný prehľad](https://i.nahraj.to/f/2afM.PNG)
![Autorizované karty](https://i.nahraj.to/f/2afL.PNG)

# Zakúpenie projektu
* Okrem Github verzie projektu zdarma ponúkam i platenú variantu projektu s dokonalejším overením prijatého kódu (porovnáva sa dátový typ)
* Overenie NodeMCU
* Login systém do webového rozhrania - prístupný iba adminovi
* Pri záujme navštívte: https://arduino.php5.sk/rfid-system.php

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
| 5V | VIN / VUSB (Adaptér/USB napájanie)  |
| GND  | GND |
| IN  | D0 (GPIO16) |

# Obrázkové zapojenie
![Schéma](https://i.stack.imgur.com/e1ewN.png)
