<?php
$stranka = "Nastavenia";
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include("connect.php");
?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Nastavenia administrátora pre webaplikáciu RFID vrátnika. Systémové nastavenia">
    <meta name="keywords" content="rfid, vrátnik, administrátor, nfc, nastavenia, formulár, systém">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - ESP8266 - Evidencia</title>
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
   /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
    <h1 id="demo"></h1>
   <?php 
      if (isset($_POST["odosli_nastavenia"])) {
    echo '<div class="alert alert-danger">
  <strong>Nepovolená akcia!</strong> Možnosť upravovať nastavenia je možné iba v platenej verzii projektu - pri záujme: <b>martinius96@gmail.com</b>
</div>';  
} 
?>
<h3>Nastavenia administrátora</h3>
<hr>
<form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    <center><b>Meno a priezvisko administrátora: </b><input type="text" name="meno" value="Martin Chlebovec"></center>
    <!-- Rounded switch -->
<center><b>Upozorniť na nové priloženie karty: </b><label class="switch"><input type="checkbox"><span class="slider round"></span></label></center>
    <center><b>Priloženie novej karty hlásiť na: </b><input type="text" name="email" value="martinius96@gmail.com"></center>
    <h4>Zmena prihlasovacích údajov</h4>
    <center><b>Prihlasovacie meno: </b><input type="text" name="login" value="admin"></center>
    <center><b>Prihlasovacie meno: </b><input type="password" name="password" value="administrator"></center>
    <hr>
    <center><input type="submit" name="odosli_nastavenia" class="btn btn-success" value="Upraviť nastavenia"></center>
    </form>
 
  <hr>
 </div>

       </div>   
      <?php 
      include("footer.php");
      ?>
       </div>
  </body>
</html>
