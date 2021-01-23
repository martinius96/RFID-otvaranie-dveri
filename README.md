# RFID vrátnik s mikrokontrolérom ESP8266, ESP32
# Podporte projekt pre pridanie nových funkcionalít
* https://www.paypal.me/chlebovec
# Stránka projektu
* Informácie o projekte: http://arduino.clanweb.eu/rfid-system.php 
* Testovacie webové rozhranie: http://arduino.clanweb.eu/rfid/
* **Z dostupných zdrojových kódov pre platformy Arduino, ESP8266 a ESP32 je možné využiť iba HTTP variant, nakoľko freehosting clanweb.eu nemá podporu HTTPS!**
* Možnosť ihneď vyskúšať funkcionalitu systému v testovacom webovom rozhraní po zapojení čítačky NXP RC522 a nahratí programu pre odtestovanie funkčnosti
* Čítačka RC522 funguje na frekvencii 13.56 MHz, dokáže prečítať RFID tagy štandardu ISO/IEC 14443-A
* Webové rozhranie dokáže vizualizovať aktuálne priloženia karty s výsledkom overenia s možnosťou riadenia prístupu - autorizácie / deautorizácie kariet
* Vhodné ako základ pre vlastný projekt s RFID výstupom
* Pridaná podpora pre Over The Air aktualizáciu firmvéru prostredníctvom LAN siete - Basic OTA cez Python z prostredia Arduino IDE
* **Čítačka Wiegand, RDM6300 nie je dostupná vo free verzii projektu RFID vrátnik**
* Článok k projektu (verzia 1.0): https://chiptron.cz/articles.php?article_id=216

# Systém ponúka 2 typy užívateľov projektu
| Administrátor: <img src="https://image.flaticon.com/icons/svg/236/236831.svg" width="64" height="64"> | Používateľ: <img src="https://image.flaticon.com/icons/svg/1326/1326318.svg" width="64" height="64"> |
| ------------- | ------------- |
| Spravuje webové rozhranie | Fyzicky prikladá NFC tag/kľúčenku/náramok/kartu|
| V reálnom čase vidí priloženie karty s výsledkom overenia  | Pri overeni sú mu odistené dvere na 5 sekúnd|
| Historicky vidí 100 posledných priložení  | Pri neoverení používateľa sa jazýček nevtiahne  |
| Jedným kliknutím môže schváliť už (skôr) priloženú kartu  | Používateľ o overení/neoverení nie je informovaný (led/buzzer)|
| Odstránenie karty jedným kliknutím  |  Používateľ použije Mifare tag, bankomatovú kartu, ISIC kartu, náramok, ktorý spĺňa štandard ISO/IEC 14443 A |
| Grafická reprezentácia prístupov  | |
| Štatistika RFID vrátnika  |  |
| Vidí zdrojový kód pre mikrokontroléry  |  |

* Mikrokontróler po prečítaní UID (identifikátor, ktorý vysiela) RFID karty prostredníctvom čítačky odošle HTTP (HTTPS) POST request na webové rozhranie
* Webserver overí, či je karta medzi autorizovanými a odpovie textom OK, prípadne NO.
* Mikrokontróler na tento payload zareaguje a odistí dvere prostredníctvom solenoidu, ktorý je ovládaný cez 5V relé
* Z vnútornej strany objektu je možné dvere kľúčkou otvoriť, elektromagnetický jazýček (solenoid) sa vtiahne pri stlačení kľučky (1-cestný RFID vrátnik)
* Možno použiť Mifare tagy, ISIC karty, bankomatové, zamestnanecké karty, náramky i kľúčenky, ktoré spĺňajú štandard ISO/IEC 14443-A
* Mikrokontróler UID upraví, nikdy neodosiela pôvodný identifikátor karty, ktorý načíta.
* Na UART rozhranie mikrokontróler posiela udalosti - Eventy - priloženie karty s výsledkom overenia (akceptácie karty webserverom)
* UID sa ukladajú do MySQL databázy, existujú rôzne tabuľky - prístupy, autorizované karty, evidencia mien ku kartám...

# Hardvér
* ![NodeMCU](https://a.allegroimg.com/s128/038a14/f035c3d6448cbb01f1c543d06c10/Modul-WiFi-ESP8266-NodeMCU-v3-ESP12E-CH340-Arduino)**NodeMCU (v2, alebo v3)**
* ![Basekit](https://www.robotop.lv/1201-home/nodemcu-base-board-v10.jpg)Basekit (možný iba pri V3, možnosť využiť externé napájanie na 6-24V)
#
* ![Arduino Uno](https://s3-ap-northeast-1.amazonaws.com/switch-science-intl/contents/small/789_201602_102_tBuTiHx.jpg)**Arduino Uno**
* ![Ethernet W5100](https://s3.amazonaws.com/storage.wobiz.com/24/24605/images/Square/1503854801_df45e8e990ef7e3b39025df4a8b2a008.24605.jpeg)Ethernet Wiznet W5100
* ![Ethernet W5500](https://content.instructables.com/ORIG/FAT/YMPE/JHQJS5HZ/FATYMPEJHQJS5HZ.jpg?auto=webp&frame=1&md=b5361d3cb7debcabb4f8547a353b9e04)Ethernet Wiznet W5500
#
* ![ESP32 DevKit](https://images.ua.prom.st/785300776_w128_h128_wifi-bluetooth-modul.jpg)**ESP32 DevKit V1 / DevKitC V4**
#
* ![RC522](https://rukminim1.flixcart.com/image/128/128/learning-toy/m/b/e/grab-em-rfid-rc522-spi-original-imaehszrwtx9gshm.jpeg?q=70)Čítačka RC522 na 13.56 MHz pre štandard ISO/IEC 14443 A
* ![13.56MHz](https://mi4.rightinthebox.com/images/128x128/201307/rpqwut1374140279910.jpg)Kompatibilné karty a kľúčenky
* ![1-kanálové elmg. relé](https://rukminim1.flixcart.com/image/128/128/jlfh6kw0/learning-toy/2/z/f/single-channel-5v-relay-module-sunrobotics-original-imaf8k84asferu9r.jpeg?q=70)SRD-05VDC-SL-C (elmg. relé 1-kanálové)
* ![Solenoidový jazýček](https://tshop.r10s.com/e15/6ac/b493/9ecd/709c/ca5e/d201/1108e7b222c4544488dd21.jpg?_ex=128x128)Solenoid - jazýčkový zámok

# Princíp solenoid jazýčka 
![Princíp jazýčka](https://www.adafruit.com/images/1512animation.gif)

# Technológie
* ![HTML5](https://imag.malavida.com/mvimgbig/download-s/html5-video-player-10741-0.jpg)
* ![PHP](https://images.sftcdn.net/images/t_app-logo-l,f_auto,dpr_auto/p/4050af38-9b27-11e6-b10d-00163ec9f5fa/1688065098/php-logo.jpg)
* <img src="https://d1q6f0aelx0por.cloudfront.net/product-logos/0dd7193f-e747-4a15-b797-818b9fac3656-mysql.png" width="64" height="64">
* <img src="https://cdn.iconscout.com/icon/free/png-256/jquery-10-1175155.png" width="64" height="64">
* <img src="https://cdn.iconscout.com/icon/free/png-256/bootstrap-6-1175203.png" width="64" height="64">
* ![Arduino core](http://users.sch.gr/johnmaga/0/images/logo/logo-64x64/arduino_b-64x64.png)
* <img src="https://images.g2crowd.com/uploads/product/image/large_detail/large_detail_977c0721699223be28566021a78599e9/autodesk-eagle.png" width="64" height="64">

# Získanie Root CA certifikátu - (Pre ESP32 - HTTPS):
* openssl s_client -showcerts -verify 5 -connect example.com:443 < /dev/null
# Získanie SHA1 fingerprintu certifikátu - (Pre ESP8266 - HTTPS):
* openssl s_client -connect example.com:443 -showcerts < /dev/null 2>/dev/null   | openssl x509 -in /dev/stdin -sha1 -noout -fingerprint

# Inštalácia systému - krok po kroku
* Stiahnuť repozitár v .zip archíve z Githubu
* Súbor priečinka sql importovať do vašej MySQL databázy - štruktúru, alebo štruktúru + vzorové dáta
* V súbore connect.php nastaviť vaše údaje na databázu (umiestnenie (localhost/external), user, heslo, meno_db)
*  **(Win 10)** src priečinok skopírovať do: C:/Moje Dokumenty/Arduino/libraries/rfid
*  **(Win XP/Vista/7)** src priečinok skopírovať do: C:/Program Files/Arduino/libraries/rfid
* Web súbory nahrať na FTP server (kompatibilné s PHP 5, aj PHP 7)
* V zdrojovom kóde pre NodeMCU - zvoliť si verziu HTTPS/HTTP, zmeniť údaje k wifi sieti, údaje na váš webserver, rovnako i pre ESP32/Arduino
* Nahrať program, používať Arduino core 2.5.0/2.5.2 (pre NodeMCU), **verzia 2.3.0 (doteraz používaná) je nekompatibilná** pre HTTPS fingerprint!
* Pre Arduino, ESP32 je možné použiť aj nanovšie knižnice pre HTTP, HTTPS spojenia
* Program pre Arduino je plne kompatibilný medzi Arduino Uno, Nano, Mega 1280/2560
* Hotovo

# Webové rozhranie v prevádzke:
* Hlavný prehľad (real-time vstupy s výsledkom overenia)
![Hlavný prehľad](https://i.imgur.com/5GWfg6v.png)
* Pridanie autorizovaných kariet jedným kliknutím
![Pridanie autorizovaných kariet jedným kliknutím](https://i.imgur.com/kGZjK1P.png)
* Štatistika RFID vrátnika
![Štatistika RFID vrátnika](https://i.imgur.com/TVMfmeQ.png)

# Zapojenie komponentov (Arduino)
| RC522 | Arduino |
|:-----|--------:|
| 3.3V | 3.3V    |
| RST  | D5 |
| GND  | GND |
| MISO | D12 |
| MOSI | D11 |
| SCK  | D5 |
| SDA/SS  | D6 |
| IRQ  | Nezapája sa |

| Relé | Arduino |
|:-----|--------:|
| 5V | 5V  |
| GND  | GND |
| IN  | D3 |

# Zapojenie komponentov (NodeMCU)
| RC522 | NodeMCU |
|:-----|--------:|
| 3.3V | 3.3V    |
| RST  | D1 (GPIO5) |
| GND  | GND |
| MISO | D6 (GPIO12) |
| MOSI | D7 (GPIO13) |
| SCK  | D5 (GPIO14) |
| SDA/SS  | D2 (GPIO4) |
| IRQ  | Nezapája sa |

| Relé | NodeMCU |
|:-----|--------:|
| 5V | VIN / VUSB (Adaptér/USB napájanie)  |
| GND  | GND |
| IN  | D0 (GPIO16) |

# Zapojenie komponentov (ESP32)
| RC522 | ESP32 |
|:-----|--------:|
| 3.3V | 3.3V    |
| RST  | D22 |
| GND  | GND |
| MISO | D19 |
| MOSI | D23 |
| SCK  | D18 |
| SDA/SS  | D21 |
| IRQ  | Nezapája sa |

| Relé | ESP32 |
|:-----|--------:|
| 5V | 5V VIN  |
| GND  | GND |
| IN  | D17 |

# Zapojenie relé a solenoid jazyčkového zámku
| Relé | Solenoid |
|:-----|--------:|
| NO | IN |
| COM  | - |
| NC  | 12/24 DC/AC |

* Nulák, respektíve GND podľa typu obvodu (AC/DC) je pripojený na zdroj po celú dobu prevádzky solenoid jazýčka.

# Schéma zapojenia Arduino
![Schéma Arduino + Ethernet - RFID vrátnik](https://i.imgur.com/DoPktzT.png)

# Schéma zapojenia ESP8266 (NodeMCU)
![Schéma NodeMCU - ESP8266 - RFID vrátnik](https://i.imgur.com/j9wciSz.png)

# Schéma zapojenia ESP32
![Schéma ESP32 - RFID vrátnik](https://i.imgur.com/oR0RjWB.png)
