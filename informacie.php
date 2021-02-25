<?php
$stranka = "Informacie";
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include("connect.php");
?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Informácie o systéme RFID vrátnika, podporovaných kartách a čipoch. Opis funkčnosti, podporovaných štandardoch.">
    <meta name="keywords" content="rfid, vrátnik, štandard, nfc, mifare, ISO/IEC 14443 A, karta, náramok, osi, rc522, čítačka, arduino, ethernet, wifi, esp8266, esp32, espressif, wiznet">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - Informácie - Popis softvéru</title>
     <link rel="icon" type="image/png" href="https://i.nahraj.to/f/2g8C.png" />
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script type="text/javascript">
    window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', 'db50efe9fff280a17db52b82be221240cbbd3dbe');
</script>    
  </head>

  <body onload="myFunction()">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
      <a class="navbar-brand" href="index.php">RFID vrátnik</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
         <?php
            	include("menu.php");
            ?>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
    <div class="col-lg-12">
            <h1 id="demo"></h1>
<h3>Informácie o projekte RFID vrátnika - ESP8266, ESP32, Arduino + Ethernet</h3>
<div class="alert alert-danger">
<strong>Projekt je šírený pod MIT licenciou. <font color="red">Prečítajte si obsah stránky licencia pre vedomosť o povinnostiach a obmedzeniach spojených s touto licenciou. Používaním projektu súhlasíte s MIT licenciou a uvedomujete si právne následky spojené s nedodržaním licencie v prípade jej porušenia!</font></strong>
</div>   
<hr>
<div class="row">
<div class="col-md-12">
<center><h3>Administrátor: <img src="https://image.flaticon.com/icons/svg/236/236831.svg" width=64px height=64px></h3></center>
<hr>
<p style="text-align: justify;">
Spravuje webové rozhranie projektu RFID vrátnik.
V reálnom čase vidí aktivitu - priloženie karty vrátane jej adresy (UID) s časovou značkou jej priloženia spolu s výsledkom overenia: <b><font color="#27AE60">OVERENÝ</font></b> / <b><font color="red">NEOVERENÝ</font></b>.
Hlávný prehľad RFID vrátnika ponúka vo free verzii históriu posledných 100 priložení karty.
V sekcii pridať kartu môže administrátor jedným kliknutím potvrdiť kartu - autorizovať ju, od tohto momentu je možné kartou odomknúť dvere, je autorizovaná, systém na ňu bude reagovať.
Okrem zobrazenia posledných 5 priložení karty vidí administrátor všetky neautorizované doteraz priložené karty a autorizované karty vrátane dátumov a časov ich autorizácie, resp. záznamu.
V záložke Odobrania karty je možné deautozizovať autorizovanú kartu - s okamžitou platnosťou zrušiť jej autorizáciu, alebo ju je možné úplne odstrániť zo systému.
V záložke Zapojenie môže administrátor nahliadnuť do schémy zapojenia RFID čítačky NXP RC522 s podporovanými platformami -  NodeMCU s čipom ESP8266-12E, pre Devkit ESP32, či Arduino s Ethernet modulom rady Wiznet W5100 respektíve W5500.
Administrátor môže nahliadnuť a stiahnuť si zdrojový kód, ktorý je dostupný pre túto webovú lokalitu pre platformy ESP8266, ESP32, Arduino + Ethernet.
Pre lepšiu prenositeľnosť programu medzi jednotlivými platformami používajú zdrojové kódy hardvérové SPI vývody tejto zbernice, čím je program možné kombinovať na rôzne platformy bez nutnosti zásahu (program pre Arduino je kompatibilný pre Arduino Uno, Nano, Mega 1280 / 2560.
<b>Možnosť prihlásenia, odhlásenia adminsitrátora, zmeny prihlasovacích údajov, núdzové otvorenie dverí z webového prostredia v prípade straty karty, priradenie zamestnancov, mien, fotografií a tlačenie reportov je súčasťou platenej verzie projektu.</b>
</p>
<hr>
<center><h3>Používateľ: <img src="https://www.flaticon.com/premium-icon/icons/svg/3135/3135715.svg" width=64px height=64px></h3></center>
<hr>
<p style="text-align: justify;">
Využíva služby RFID čítačky NXP RC522 fyzickým priložením karty, náramku, kľúčenky kompatibilného štandardu ISO/IEC 14443-A.
V prípade overenia priloženého čipu mu mikrokontróler odistí dvere na 5 a pol sekundy (vtiahne západku), počas ktorých musí používateľ dvere otvoriť. 
V opačnom prípade sa uzamknú a používateľ musí opakovať priloženie karty. Systém reaguje na nové priloženie karty až po 5-tich sekundách od priloženia karty v predchádzajúcom pokuse.
Pri neoverení používateľa z dôvodu neovereného čipu, prípadne nedostupnosti overenia webu mu zámok nie je odistený - nevtiahne sa, dvere nie je možné otvoriť (používateľ ako taký nemá vedomosť o výsledku overenia).
Používateľ o neoverení svojho čipu ako takého nie je informovaný. Jeho pokus je zapísaný do databázy za predpokladu, že sa ESP8266 (ESP32, Arduino) napojí na web, kde sa karta overuje.
Používateľ môže na overenie použiť aj svoju ISIC, autobusovú kartu, ktorej fyzickú UID adresu čítačka dokáže prečítať, musí spĺňať štandard ISO/IEC 14443 A.
</p>
<hr>
<center><h3>Technické informácie: <img src="https://www.flaticon.com/premium-icon/icons/svg/1326/1326318.svg" width=64px height=64px></h3></center>
<hr>
<p style="text-align: justify;">
Čítačka NXP RC522, ktoráje v projekte použitá pracuje na frekvencii 13.56MHz.
V tomto projekte čítačka načítava iba fyzickú adresu (UID) RFID kariet, kľúčeniek náramkov, ktoré sa sami odhlásia RFID čítačke, ktorá ich nabije elektrickým poľom.
Pre komunikáciu s mikrokontrolérom využíva čítačka NXP RC522 SPI zbernicu.
V projekte sú dostupné programové implementácie pre ESP8266, ESP32, Arduino + Ethernet pre komunikáciu s RFID čítačkou a prenosom zaznamenaných údajov na vzdialené webové rozhranie.
Mikrokontrolér využíva HTTP (HTTPS - iba ESP8266 a ESP32 má aj túto možnosť) POST request, pričom má v tele správy payload z RFID čítačky.
Neposiela sa reálne UID, mikrokontróler vykoná jeho korekciu - pozmenenie.
Po odoslaní dát do webového rozhrania sa vykoná checksum cez CRC32B na strane webservera.
Pod týmto checksumom vystupuje UID v systéme a je to jeho identifikátor v celom webovom rozhraní.
<b><font color="red">Týmto projektom nie je odporúčané zabezpečovať majetok</font>, za škody, stratu dát autor projektu nezodpovedá.</b>
</p>
<div class="alert alert-danger">
      <strong>Pozor na RFID čítačky NXP RC522 s falošným (neoriginálnym NXP RC522) čipom! - V projekte na UART hlási: Firmware version: 0x12 - counterfeit chip. Projekt s falošným čipom nefuinguje. </strong>
	Testované a funkčné s NXP RFID čítačkou RC522, ktorá hlási verziu firmvéru: Firmware version 0x92 (Version 2.0).
      </div>
</div>
</div>
<hr>
</div>   
      <?php 
      include("footer.php");
      ?>
       </div>
</div>
  </body>
</html>
