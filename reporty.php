<?php
$stranka = "Reporty";
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include("connect.php");
?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Reporty prístupu zamestnancov RFID vrátnika. Webstránka pre správcu systému, umožňuje tlačiť report za aktuálny deň, týždeň, mesiac">
    <meta name="keywords" content="rfid, vrátnik, report, zamestnanec, meno, priezvisko, prístup, odchod, čas, karta">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - ESP8266 - Evidencia</title>
     <link rel="icon" type="image/png" href="https://i.nahraj.to/f/2g8C.png" />
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 <script type="text/javascript">
    window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', 'db50efe9fff280a17db52b82be221240cbbd3dbe');
</script>

  </head>

  <body>

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
   <?php 
if (isset($_POST["denny_report"])) {
    echo '<div class="alert alert-danger">
  <strong>Nepovolená akcia!</strong> Možnosť tlačiť reporty do .csv / .pdf / konkrétneho zamestnanca je možné iba v platenej verzii - pri záujme: <b>martinius96@gmail.com</b>
</div>';  
}
if (isset($_POST["tyzdenny_report"])) {
    echo '<div class="alert alert-danger">
  <strong>Nepovolená akcia!</strong> Možnosť tlačiť reporty do .csv / .pdf / konkrétneho zamestnanca je možné iba v platenej verzii - pri záujme: <b>martinius96@gmail.com</b>
</div>';  
} 
if (isset($_POST["mesacny_report"])) {
    echo '<div class="alert alert-danger">
  <strong>Nepovolená akcia!</strong> Možnosť tlačiť reporty do .csv / .pdf / konkrétneho zamestnanca je možné iba v platenej verzii - pri záujme: <b>martinius96@gmail.com</b>
</div>';  
}  
      ?>
   <h3>Reporty prístupu zamestnancov RFID (NFC) vrátnika (globálny)</h3> 
  <div class="row"><div class="col-lg-4"><center><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="denny_report" class="btn btn-success" value="Denný report"></form></center></div>
  <div class="col-lg-4"><center><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="tyzdenny_report" class="btn btn-warning" value="Týždenný report"></form></center></div>
  <div class="col-lg-4"><center><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="mesacny_report" class="btn btn-primary" value="Mesačný report"></form></center></div></div>
  <hr>
  <table style="width: 100%;" border="1">
									 <tr>
									 <th style="width: 25%;">Meno a priezvisko</th>
									 <th style="width: 25%;">Denný report</th>
									 <th style="width: 25%;">Týždenný report</th>
                   <th style="width: 25%;">Mesačný report</th>
                   </tr>
                   <tr><td>Peter Novák</td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="denny_report" class="btn btn-success" value="Denný report"></form></td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="tyzdenny_report" class="btn btn-warning" value="Týždenný report"></form></td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="mesacny_report" class="btn btn-primary" value="Mesačný report"></form></td></tr>
                   <tr><td>John Smith</td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="denny_report" class="btn btn-success" value="Denný report"></form></td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="tyzdenny_report" class="btn btn-warning" value="Týždenný report"></form></td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="mesacny_report" class="btn btn-primary" value="Mesačný report"></form></td></tr>
                   <tr><td>Ľubomír Beňo</td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="denny_report" class="btn btn-success" value="Denný report"></form></td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="tyzdenny_report" class="btn btn-warning" value="Týždenný report"></form></td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="mesacny_report" class="btn btn-primary" value="Mesačný report"></form></td></tr>
                   <tr><td>Ján Roša</td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="denny_report" class="btn btn-success" value="Denný report"></form></td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="tyzdenny_report" class="btn btn-warning" value="Týždenný report"></form></td><td><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="mesacny_report" class="btn btn-primary" value="Mesačný report"></form></td></tr>
                   </table
 </div>

       </div>   
      <?php 
      include("footer.php");
      ?>
       </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
