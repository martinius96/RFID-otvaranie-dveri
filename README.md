# RFID vrátnik s mikrokontrolérom ESP8266, ESP32, Arduino + Ethernet
**Z dôvodu viacnásobného porušenia autorskej licencie sú odteraz projekty monitorované. Stiahnutím a používaním projektu s tým súhlasíte a zaväzujete sa k dodržiavaniu autorského práva. V prípade porušenia si uvedomujete právne následky.**
* MIT licencia v plnom znení: https://en.wikipedia.org/wiki/MIT_License

# Stránka projektu
* https://arduino.php5.sk/rfid/
* Informácie o projekte: https://arduino.php5.sk/rfid-system.php 
* Vzorové zdrojové kódy pre ESP8266, ESP32, Arduino + Ethernet komunikujú priamo s touto webovou lokalitou po HTTP/HTTPS protokole
* Možnosť ihneď vyskúšať po zapojení čítačky a nahratí programu pre odtestovanie funkčnosti

# Systém ponúka 2 typy užívateľov projektu
| Administrátor <img src="https://image.flaticon.com/icons/svg/236/236831.svg" width="64" height="64"> | Používateľ <img src="https://www.flaticon.com/premium-icon/icons/svg/1610/1610320.svg" width="64" height="64"> |
| ------------- | ------------- |
| Spravuje webové rozhranie | Fyzicky prikladá NFC tag/kľúčenku/náramok/kartu|
| V reálnom čase vidí priloženie karty s výsledkom overenia  | Pri overeni sú mu odistené dvere na 5 sekúnd|
| Historicky vidí 100 posledných priložení  | Pri neoverení používateľa sa jazýček nevtiahne  |
| Jedným kliknutím môže schváliť už (skôr) priloženú kartu  | Používateľ o overení/neoverení nie je informovaný (led/buzzer)|
| Odstránenie karty jedným kliknutím  |  Informovanie používateľa o výsledku overenia cez diódu/buzzer (len platená verzia) |
| Grafická reprezentácia prístupov  | Používateľ použije Mifare tag, bankomatovú kartu, ISIC kartu, náramok, ktorý spĺňa štandard ISO/IEC 14443 A|
| Štatistika RFID vrátnika  | Prihlásenia používateľa do aplikácie (len platená verzia) |
| Vidí zdrojový kód pre NodeMCU  |  |
| Prihlásenie/odhlásenie (len platená verzia)  |   |
| Priradenie mien, fotografií ku kartám (len platená verzia)  |  |
| Export mesačnej dochádzky  vstupov v .csv, .xml, .sql (len platená verzia)  |  |
| História 1 rok dozadu (len platená verzia)  |  |

* Overenie kariet a prístupu cez web do objektu
* Čítačka prečíta kartu štandardu ISO/IEC 14443 A, jej MAC adresu odošle na web, kde sa overí a odpovie sa OK/NO
* Možno použiť Mifare tagy, ISIC karty, bankomatové, zamestnanecké karty, náramky i kľúčenky, ktoré spĺňajú štandard ISO/EIC 14443 A
* V prípade odpovede OK mikrokontróler aktivuje jazýček, čím je možné dvere otvoriť. 
* Z vnútornej strany objektu je možné dvere kľúčkou otvoriť, elektromagnetický jazýček (solenoid) sa vtiahne pri stlačení kľučky
# Podpora projektu pre širšiu dostupnosť a pridanie nových funkcionalít
* https://www.paypal.me/chlebovec

# Hardvér
* ![NodeMCU](https://arduino.php5.sk/images/nodemcuv3.jpg)**NodeMCU (v2, alebo v3)**
* ![Basekit](https://arduino.php5.sk/images/basekit.jpg)Basekit (možný iba pri V3, možnosť využiť napájanie na 6-24V)
#
* ![Arduino Uno](https://s3-ap-northeast-1.amazonaws.com/switch-science-intl/contents/small/789_201602_102_tBuTiHx.jpg)**Arduino Uno**
* ![Ethernet W5100](https://arduino.php5.sk/images/ethernetshield.jpg)Ethernet shield W5100
#
* ![ESP32 DevKit](http://www.robotop.lv/1802-home/nodemcu-esp-32-v11.jpg)**ESP32 DevKit v1 - v4**
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


# Inštalácia systému
* Stiahnuť repozitár v .zip archíve z Githubu
* Súbor priečinka sql importovať do vašej MySQL databázy - štruktúru, alebo štruktúru + vzorové dáta
* V súbore connect.php nastaviť vaše údaje na databázu (umiestnenie (localhost/external), user, heslo, meno_db)
*  **(Win 10)** src priečinok skopírovať do: C:/Moje Dokumenty/Arduino/libraries/rfid
*  **(Win XP/Vista/7)** src priečinok skopírovať do: C:/Program Files/Arduino/libraries/rfid
* Web súbory nahrať na FTP server (kompatibilné s PHP 5, aj PHP 7)
* V zdrojovom kóde pre NodeMCU - zvoliť si verziu HTTPS/HTTP, zmeniť údaje k wifi sieti, údaje na váš webserver, rovnako i pre ESP32/Arduino
* Nahrať program, používať Arduino core 2.3.0 (pre NodeMCU), **verzia 2.5.0 (najnovšia) je nekompatibilná** pre HTTPS fingerprint!
* Pre Arduino, ESP32 je možné použiť aj nanovšie knižnice pre HTTP, HTTPS spojenia
* Program pre Arduino je plne kompatibilný medzi Arduino Uno, Nano, Mega 1280/2560
* **Môžete si zakúpiť webové rozhranie na: martinius96@gmail.com, obsahuje dokumentáciu, rozšírenú funkcionalitu, support**
* Hotovo

# Webové rozhranie v prevádzke:
* Hlavný prehľad (real-time vstupy s výsledkom overenia)
![Hlavný prehľad](https://i.imgur.com/5GWfg6v.png)
* Pridanie autorizovaných kariet jedným kliknutím
![Pridanie autorizovaných kariet jedným kliknutím](https://i.imgur.com/kGZjK1P.png)
* Štatistika RFID vrátnika
![Štatistika RFID vrátnika](https://i.imgur.com/TVMfmeQ.png)

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

# Zapojenie komponentov (Arduino + Ethernet W5100)
| RC522 | Arduino |
|:-----|--------:|
| 3.3V | 3.3V    |
| RST  | D5 |
| GND  | GND |
| MISO | D12 |
| MOSI | D11 |
| SCK  | D13 |
| SDA/SS  | D6 |
| IRQ  | Nezapája sa |

| Relé | Arduino |
|:-----|--------:|
| 5V | 5V |
| GND  | GND |
| IN  | D4 (NO SD CARD) |

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

# Schéma zapojenia ESP8266 (NodeMCU)
![Schéma NodeMCU](https://i.imgur.com/j9wciSz.png)

# Schéma zapojenia Arduino Uno + Ethernet W5100
![Schéma Arduino + Ethernet W5100](https://i.imgur.com/7IuhBJy.png)

# Schéma zapojenia ESP32
![Schéma ESP32](https://i.imgur.com/oR0RjWB.png)
