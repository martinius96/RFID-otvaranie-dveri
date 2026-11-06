# RFID vrátnik s mikrokontrolérom ESP8266, ESP32

# Systém ponúka 2 typy užívateľov projektu
| Administrátor: <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnGCGOwcj7dI9Y3XVPOqpoG14JQRxOymAar4eBrCfFi8pULu32k658SazQ&s=10" width="64" height="64"> | Používateľ: <img src="https://cdn-icons-png.flaticon.com/512/12583/12583751.png" width="64" height="64"> |
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

# Technológie
* ![HTML5](https://imag.malavida.com/mvimgbig/download-s/html5-video-player-10741-0.jpg)
* ![PHP](https://images.sftcdn.net/images/t_app-logo-l,f_auto,dpr_auto/p/4050af38-9b27-11e6-b10d-00163ec9f5fa/1688065098/php-logo.jpg)
* <img src="https://d1q6f0aelx0por.cloudfront.net/product-logos/0dd7193f-e747-4a15-b797-818b9fac3656-mysql.png" width="64" height="64">
* <img src="https://cdn.iconscout.com/icon/free/png-256/jquery-10-1175155.png" width="64" height="64">
* <img src="https://cdn.iconscout.com/icon/free/png-256/bootstrap-6-1175203.png" width="64" height="64">
* ![Arduino core](http://users.sch.gr/johnmaga/0/images/logo/logo-64x64/arduino_b-64x64.png)
* <img src="https://images.g2crowd.com/uploads/product/image/large_detail/large_detail_977c0721699223be28566021a78599e9/autodesk-eagle.png" width="64" height="64">

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
