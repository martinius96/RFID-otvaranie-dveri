<?php
$stranka = "Index";
?>
<!DOCTYPE html>
<html lang="sk">
<?php 
include("connect.php");
?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="RFID vrátnik založený na čítačke RC522 pracujúcej na frekvencii 13.56MHz. Prepojenie s mikrokontrolérmi Arduino, ESP32, ESP8266.">
    <meta name="keywords" content="rfid, vrátnik, príchod, systém, prístup, odmietnutie, otvorenie, dvere, solenoid, relé, esp8266, nodemcu, jazýček, kľučka, arduino, ethernet, wifi, esp32">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - Arduino / ESP8266 / ESP32</title>
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
  <style>

.aa_h2{
  font:100 5rem/1 Roboto;
  text-transform: uppercase;
}
table{
   background: #fff;
}
table,thead,tbody,tfoot,tr, td,th{
  text-align: center;
  margin: auto;
  border:1px solid #dedede;
  padding: 1rem;
}
.table    { display: table; width: 50%; }
.tr       { display: table-row;  }
.thead    { display: table-header-group }
.tbody    { display: table-row-group }
.tfoot    { display: table-footer-group }
.col      { display: table-column }
.colgroup { display: table-column-group }
.td, .th   { display: table-cell; width: 50%; }
.caption  { display: table-caption }

.table,
.thead,
.tbody,
.tfoot,
.tr,
.td,
.th{
  text-align: center;
  margin: auto;
  padding: 1rem;
}
.table{
  background: #fff;
  margin: auto;
  border:none;
  padding: 0;
  margin-bottom: 5rem;
}

.th{
  font-weight: 700;
  border:1px solid #dedede;
  &:nth-child(odd){
    border-right:none;
  }
}
.td{
  font-weight: 300;
  border:1px solid #dedede;
  border-top:none;
  &:nth-child(odd){
    border-right:none;
  }
}

.aa_htmlTable{
  background: tomato;
  padding: 5rem;
  display: table;
  width: 100%;
  height: 100vh;
  vertical-align: middle;
}
.aa_css{
  background: skyblue;
  padding: 5rem;
  display: table;
  width: 100%;
  height: 100vh;
  vertical-align: middle;
}

.aa_ahmadawais{
  display: table;
  width: 100%;
  font: 100 1.2rem/2 Roboto;
  margin: 5rem auto;
}
    
  </style>  
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
      </div>
      <div class="col-lg-12 text-center">
        <h1 id="demo"></h1>
       <div id="full"></div>
        <hr>
        </div>
      </div>
    </div>    
  </body>
    <script>
  $(function() {
   $.get('full_vypis.php', function(data){
        $('#full').html(data)
    });
  });
  </script>
</html>
