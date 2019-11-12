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
    <meta name="description" content="Informácie o systéme RFID vrátnika, podporovaných kartách a čipoch. Názorná ukážka">
    <meta name="keywords" content="rfid, vrátnik, štandard, nfc, mifare, ISO/IEC 14443 A, karta, náramok, osi, rc522, čítačka">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - Informácie</title>
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
<h3>Informácie o projekte RFID vrátnika</h3>
<hr>
<div class="row">
<div class="col-md-6">
 <h3>Administrátor: <img src="https://image.flaticon.com/icons/svg/236/236831.svg" width=64px height=64px></h3>
<hr>
<li>Spravuje webové rozhranie</li>
<li>V reálnom čase vidí aktivitu - priloženie karty vrátane jej adresy s časom jej priloženia s výsledkom overenia: OVERENÝ / NEOVERENÝ.</li>
<li>Hlávný prehľad ponúka 100 posledných priložení karty, má výlučne informatívny charakter.</li>
<li>V sekcii pridať kartu môže administrátor jedným kliknutím potvrdiť kartu - autorizovať ju, ktorá bola priložená, no nebola zatiaľ autorizovaná.</li>
<li>Okrem zobrazenia posledných 5 priložení karty vidí administrátor všetky neautorizované doteraz priložené karty a autorizované karty vrátane dátumov a časov ich autorizácie.</li>
<li>V záložke Odobrania karty je možné deautozizovať autorizovanú kartu - karta nebude figurovať ani v zozname neautozizovaných kariet, bude tam pridelená automaticky až po jej priložení.</li>
<li>V záložke Program môže administrátor nahliadnuť do schémy zapojenia RFID čítačky s vývojovou doskou NodeMCU s čipom ESP8266, prípadne aj iných platforiem - ESP32, či Arduino s LoRa, Sigfox modulom. Administrátor môže nahliadnuť a stiahnuť si zdrojový kód, ktorý je dostupný pre túto webovú lokalitu.</li>
<li>Pre lepšiu prenositeľnosť programu medzi jednotlivými platformami používajú zdrojové kódy hardvérové SPI vývody tejto zbernice, čím je program možné kombinovať na rôzne platformy bez nutnosti zásahu.</li>
<li>Možnosť prihlásenia, odhlásenia adminsitrátora, zmeny prihlasovacích údajov, núdzové otvorenie dverí z webového prostredia v prípade straty karty, priradenie zamestnancov, mien, fotografií a tlačenie reportov je súčasťou platenej verzie projektu.</li>
</div>
<div class="col-md-6">
<h3>Používateľ: <img src="https://www.flaticon.com/premium-icon/icons/svg/1610/1610320.svg" width=64px height=64px></h3>
<hr>
<li>Využíva služby RFID čítačky fyzickým priložením NFC tagu, kľúčenky, karty, náramku.</li>
<li>V prípade overenia priloženého čipu mu NodeMCU odistí dvere na 5 a pol sekundy, počas ktorých musí dvere otvoriť. V opačnom prípade sa uzamknú a používateľ opakuje priloženie karty</li>
<li>Pri neoverení používateľa z dôvodu neovereného čipu, prípadne nedostupnosti overenia webu mu zámok nie je odistený - nevtiahne sa.</li>
<li>Používateľ o neoverení svojho čipu ako takého nie je informovaný. Jeho pokus je zapísaný do databázy za predpokladu, že sa ESP8266 (ESP32, Arduino) napojí na web, kde sa karta overuje.</li>
<li>Používateľ môže na overenie použiť aj svoju bankomatovú kartu, ISIC kartu, či zamestnaneckú kartu, ktorej fyzickú adresu čítačka dokáže prečítať, musí spĺňať štandard ISO/IEC 14443 A a pracovnú frekvenciu 13.56MHz.</li>
</div>
</div>
<hr>
<li>Čítačka RC522 pracuje na frekvencii 13.56MHz, využíva SPI zbernicu pre rýchlu komunikáciu s mikrokontrolérom</li>
<li>Implementačné demo využíva trojicu platforiem - ESP8266, ESP32, Arduino + LoRa/Sigfox na prepojenie s touto čítačkou pre dosiahnutie optimálnej funkčnosti.</li>
<li><b>Čítačka RC522 využíva už prelomený algoritmus Crypto-1, nie je preto vhodná pre zabezpečenie cenného majetku.</b></li>
<li>Pre zvýšenie bezpečnosti tejto implementácie sa používa konverzia MAC adries na strane mikrokontroléru po načítaní, druhotná konverzia sa vykoná na strane webového servera, kedy je výsledná adresa karty hashuje algoritmom CRC32B, tento hash je uložený do databázy a reprezentuje danú kartu.</li>
<li>Čítačka má vstavanú anténu, priloženie karty vie registrovať na cca. 3 centimetre od kontaktnej plochy. </li>
<li>V kľúdovom stave čítačka spotrebuje 13mA pri 3.3V, pri načítavaní kariet (v prevádzke) je prúdovú odber na hranici 26mA pri 3.3V. </li>
<hr>


       </div>   
      <?php 
      include("footer.php");
      ?>
       </div>
</div>
  </body>
</html>
