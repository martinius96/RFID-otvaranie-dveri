# [RFID prístupový systém so správou on-line](https://arduino.php5.sk/rfid/)

# Systém ponúka
* Overenie kariet a prístupu cez web do objektu
* Vizualizácia overenia/neoverenia v grafe
* Štatistika systému
* Program pre NodeMCU
* Čítačka prečíta kartu štandardu ISO/IEC 14443 A, jej MAC adresu odošle na web, kde sa overí a odpovie sa OK/NO
* Možno použiť ISIC karty, bankomatové, zamestnanecké karty
* V prípade odpovede OK NodeMCU aktivuje jazýček, čím je možné dvere otvoriť. 
* Z vnútornej strany objektu je možné dvere kľúčkou otvoriť, jazýček sa vtiahne
* Adresy kariet sú odteraz hashované cez crc32b algoritmus

# Hardvér
* NodeMCU (v2, alebo v3)![NodeMCU](https://arduino.php5.sk/images/nodemcuv3.jpg)
* Basekit (možný iba pri V3, možnosť využiť napájanie na 6-24V)![Basekit](https://arduino.php5.sk/images/basekit.jpg)
* Čítačka RC522 na 13.56 MHz pre štandard ISO/IEC 14443 A![RC522](https://rukminim1.flixcart.com/image/128/128/learning-toy/m/b/e/grab-em-rfid-rc522-spi-original-imaehszrwtx9gshm.jpeg?q=70)
* Kompatibilné karty a kľúčenky ![13.56MHz](https://mi4.rightinthebox.com/images/128x128/201307/rpqwut1374140279910.jpg)
* 5V elmg. 1-kanálové relé![RC522](https://rukminim1.flixcart.com/image/128/128/jlfh6kw0/learning-toy/2/z/f/single-channel-5v-relay-module-sunrobotics-original-imaf8k84asferu9r.jpeg?q=70)

# Technológie
* ![HTML5](https://imag.malavida.com/mvimgbig/download-s/html5-video-player-10741-0.jpg)
* ![PHP](https://images.sftcdn.net/images/t_app-logo-l,f_auto,dpr_auto/p/4050af38-9b27-11e6-b10d-00163ec9f5fa/1688065098/php-logo.jpg)
* <img src="https://cdn.iconscout.com/icon/free/png-256/jquery-10-1175155.png" width="64" height="64">
* <img src="https://cdn.iconscout.com/icon/free/png-256/bootstrap-6-1175203.png" width="64" height="64">
* ![Arduino core](http://users.sch.gr/johnmaga/0/images/logo/logo-64x64/arduino_b-64x64.png)

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
![RFID grafy vstupov](https://i.nahraj.to/f/2gIt.PNG)
![RFID štatistika vrátnika](https://i.nahraj.to/f/2gIs.PNG)

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

# Obrázkové zapojenie
![Schéma](https://i.stack.imgur.com/e1ewN.png)
