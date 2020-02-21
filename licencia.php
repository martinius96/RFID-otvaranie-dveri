<?php
$stranka = "Licencia";
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include("connect.php");
?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Licencia používania RFID vrátnika. ESP8266 WiFi vrátnik vo webovom rozhraní.">
    <meta name="keywords" content="rfid, vrátnik, licencia, MIT, použitie, softvér, práva, povinnosti, osobné údaje, ochrana, autorstvo">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - ESP8266 - Licencia</title>
     <link rel="icon" type="image/png" href="https://i.nahraj.to/f/2g8C.png" />
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
<h3>Licencia projektu</h3>
<li>Projekt je šírený pod <a href="https://sk.wikipedia.org/wiki/MIT_licencia">MIT licenciou</a></li>
 </div>
 <div class="col-lg-4">
<center><b>Práva prevádzkovateľa projektu:</b></center>  
<div class="alert alert-success">
<li>Komerčná distribúcia projektu</li>
<li>Vydanie projektu pod inou licenciou (aj bez zdrojových kódov)</li>
<li>Modifikácia projektu</li>
<li>Súkromné využívanie projektu vrátane modifikácii a úprav</li>
</div> 
</div>   
<div class="col-lg-4"> 
<center><b>Obmedzenia projektu:</b></center> 
<div class="alert alert-info">
<li>Bez záruky - zdrojový kód nemusí fungovať, môže obsahovať kritické chyby, za stratu dát, čo môže mať za následok používanie projektu nie je autor zodpovedný</li>
</div>   
</div> 
<div class="col-lg-4"> 
<center><b><font color="red">Podmienky použitia projektu:</font></b></center> 
<div class="alert alert-danger">
<li><b><font color="red">Uvedenie autora pôvodného projektu (t.j. ponechanie spodnej lišty).</font></b></li>
</div>   
</div>  
<div class="col-lg-12">
<div class="alert alert-danger">
<li><font color="red"><b>Prevádzkovateľ projektu sa zaväzuje k dodržiavaniu MIT licencie stiahnutím a prevádzkovaním projektu! V prípade porušenia licencie si plne uvedomuje právne následky pri porušení licencie, autorstva.</b></font></li>
</div>   
<hr><h3>Znenie licencie projektu - RFID vrátnik:</h3><hr>
       <pre>
The MIT License (MIT)

Copyright (c) 2019-2020 Martin Chlebovec

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
       </pre>
       </div>
       </div>   
      <?php 
      include("footer.php");
      ?>
       </div>

  </body>
</html>
