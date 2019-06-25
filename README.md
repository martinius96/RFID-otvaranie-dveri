# RFID vrátnik s ESP8266
**Nakoľko rada používateľov systému nerešpektuje licenciu projektu a práva na copyright autora, ktoré odstraňujú, webové rozhranie projektu už nebude dostupné na stiahnutie!**
* MIT licencia v plnom znení: https://sk.wikipedia.org/wiki/Massachusetts_Institute_of_Technology

# Stránka projektu
* https://arduino.php5.sk/rfid/
* Vzorové zdrojové kódy pre ESP8266 komunikujú priamo s touto webovou lokalitou
* Možnosť ihneď vyskúšať po zapojení čítačky a nahratí programu pre odtestovanie funkčnosti

# Systém ponúka 2 typy užívateľov projektu
| Administrátor <img src="https://image.flaticon.com/icons/svg/236/236831.svg" width="64" height="64"> | Používateľ <img src="https://www.flaticon.com/premium-icon/icons/svg/1610/1610320.svg" width="64" height="64"> |
| ------------- | ------------- |
| Spravuje webové rozhranie | Fyzicky prikladá NFC tag/kľúčenku/náramok/kartu|
| V reálnom čase vidí priloženie karty s výsledkom overenia  | Pri overeni sú mu odistené dvere na 5 sekúnd|
| Historicky vidí 100 posledných priložení  | Pri neoverení používateľa sa jazýček nevtiahne  |
| Jedným klikutím môže schváliť už priloženú kartu  | Používateľ o overení/neoverení nie je informovaný (led/buzzer)|
| Odstránenie karty jedným kliknutím  |  Informovanie používateľa o výsleku overenia cez diódu/buzzer (len platená verzia) |
| Grafická reprezentácia prístupov  | Používateľ použije bankomatovú kartu, ISIC kartu, spĺňajú štandard ISO/IEC 14443 A|
| Štatistika RFID vrátnika  |  |
| Vidí zdrojový kód pre NodeMCU  |  |
| Prihlásenie/odhlásenie (len platená verzia)  |   |
| Priradenie mien, fotografií ku kartám (len platená verzia)  |  |
| Export mesačnej dochádzky  vstupov v .csv, .xml, .sql (len platená verzia)  |  |
| História 1 rok dozadu (len platená verzia)  |  |

* Overenie kariet a prístupu cez web do objektu
* Čítačka prečíta kartu štandardu ISO/IEC 14443 A, jej MAC adresu odošle na web, kde sa overí a odpovie sa OK/NO
* Možno použiť ISIC karty, bankomatové, zamestnanecké karty
* V prípade odpovede OK NodeMCU aktivuje jazýček, čím je možné dvere otvoriť. 
* Z vnútornej strany objektu je možné dvere kľúčkou otvoriť, elmg. jazýček sa vtiahne
# Podpora projektu
* https://www.paypal.me/chlebovec

# Hardvér
* ![NodeMCU](https://arduino.php5.sk/images/nodemcuv3.jpg)NodeMCU (v2, alebo v3)
* ![Basekit](https://arduino.php5.sk/images/basekit.jpg)Basekit (možný iba pri V3, možnosť využiť napájanie na 6-24V)
* ![RC522](https://rukminim1.flixcart.com/image/128/128/learning-toy/m/b/e/grab-em-rfid-rc522-spi-original-imaehszrwtx9gshm.jpeg?q=70)Čítačka RC522 na 13.56 MHz pre štandard ISO/IEC 14443 A
* ![13.56MHz](https://mi4.rightinthebox.com/images/128x128/201307/rpqwut1374140279910.jpg)Kompatibilné karty a kľúčenky
* ![RC522](https://rukminim1.flixcart.com/image/128/128/jlfh6kw0/learning-toy/2/z/f/single-channel-5v-relay-module-sunrobotics-original-imaf8k84asferu9r.jpeg?q=70)5V elmg. 1-kanálové relé
* ![Solenoidový jazýček](https://tshop.r10s.com/e15/6ac/b493/9ecd/709c/ca5e/d201/1108e7b222c4544488dd21.jpg?_ex=128x128)Solenoid jazýček

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
* V súbore connect.php nastaviť vaše údaje na databázu (umiestnenie, user, heslo, meno_db)
*  **(Win 10)** src priečinok skopírovať do: C:/Moje Dokumenty/Arduino/libraries/rfid
*  **(Win XP/Vista/7)** src priečinok skopírovať do: C:/Program Files/Arduino/libraries/rfid
* Web súbory nahrať na FTP server (kompatibilné s PHP 5, aj PHP 7)
* v zdrojovom kóde pre NodeMCU - zvoliť si verziu HTTPS/HTTP, zmeniť údaje k wifi sieti, meno webservera, cestu
* Nahrať program, používať Arduino core 2.3.0, **verzia 2.5.0 (najnovšia) je nekompatibilná** pre HTTPS fingerpeint!
* Hotovo

# Webové rozhranie v prevádzke:
* Hlavný prehľad (real-time vstupy s výsledkom overenia)
![Hlavný prehľad](https://i.nahraj.to/f/2afM.PNG)
* Prehľad neautorizovaných a autorizovaných kariet( s možnosťou autorizovania jedným tlačidlom)
![Autorizované karty](https://i.nahraj.to/f/2afL.PNG)
* Grafická reprezentácia overení za 7 dní s výsledok 1 - overený, 0 - neoverený
![Grafická reprezentácia overení](https://i.nahraj.to/f/2gPU.PNG)

# Zapojenie komponentov
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

| Relé | Solenoid |
|:-----|--------:|
| NO | IN |
| COM  | - |
| NC  | 12/24 DC/AC |

* Nulák, resp. GND podľa typu obvodu (AC/DC) je pripojený na zdroj po celú dobu prevádzky

# Schéma zapojenia
![Schéma](https://i.imgur.com/j9wciSz.png)
