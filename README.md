# [RFID prístupový systém so správou on-line](https://arduino.php5.sk/rfid-system.php)

# Systém ponúka 2 typy užívateľov projektu
| Administrátor <img src="https://image.flaticon.com/icons/svg/236/236831.svg" width="64" height="64"> | Používateľ <img src="https://www.flaticon.com/premium-icon/icons/svg/1610/1610320.svg" width="64" height="64"> |
| ------------- | ------------- |
| Spravuje webové rozhranie | Fyzicky prikladá NFC tag/kľúčenku/náramok/kartu|
| V reálnom čase vidí priloženie karty s výsledkom overenia  | Pri overeni sú odistené dvere na 5 sekúnd|
| Historicky vidí 100 posledných priložení  | Pri neoverení používateľa sa jazýček nevtiahne  |
| Jedným klikutím môže schváliť už priloženú kartu  | Používateľ o overení/neoverení nie je informovaný (led/buzzer)|
| Manuálne zadanie karty  | Používateľ použije bankomatovú kartu, ISIC kartu, spĺňajú štandard ISO/IEC 14443 A|
| Odstránenie karty  |  Informovanie používateľa o výsleku overenia cez diódu/buzzer (len platená verzia) |
| Vidí zdrojový kód pre NodeMCU  |  |
| Prihlásenie/odhlásenie (len platená verzia)  |   |
| Priradenie mien ku kartám (len platená verzia)  |  |
| Export mesačnej dochádzky (len platená verzia)  |  |
| História 1 rok dozadu (len platená verzia)  |  |

* Overenie kariet a prístupu cez web do objektu
* Čítačka prečíta kartu štandardu ISO/IEC 14443 A, jej MAC adresu odošle na web, kde sa overí a odpovie sa OK/NO
* Možno použiť ISIC karty, bankomatové, zamestnanecké karty
* V prípade odpovede OK NodeMCU aktivuje jazýček, čím je možné dvere otvoriť. 
* Z vnútornej strany objektu je možné dvere kľúčkou otvoriť, elmg. jazýček sa vtiahne

# Hardvér
* NodeMCU (v2, alebo v3) ![NodeMCU](https://www.researchgate.net/profile/Hamzah_Marhoon/publication/325181089/figure/fig3/AS:627026931236872@1526506278395/NodeMCU-module_Q320.jpg)
* Basekit (možný iba pri V3, možnosť využiť napájanie na 6-24V) ![Base kit](https://images-na.ssl-images-amazon.com/images/I/51Gqf0K%2B2QL._SX342_.jpg)
* Čítačka RC522 na 13.56 MHz pre štandard ISO/IEC 14443 A ![RC522](http://www.desiengineer.in/wp-content/uploads/2017/03/Desi2513_b.png)
* 5V elmg. 1-kanálové relé ![Relé](https://leobot.net/productimages/1636.jpg)
* Solenoid jazýček ![Jazýček](https://www.heaps.co.uk/images/Products/Solenoids/lucifer-solenoid.jpg)

# Princíp solenoid jazýčka 
![Jazýček](http://www.kuhnke.co.uk/images/solenoids/bistable.gif)

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
