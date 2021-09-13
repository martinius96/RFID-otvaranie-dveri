<?php
$stranka = "Evidencia";
?>
<!DOCTYPE html>
<html lang="en">
<?php 
include("connect.php");
?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Evidencia zamestnancov RFID vrátnika. Webstránka pre správcu systému">
    <meta name="keywords" content="rfid, vrátnik, evidencia, zamestnanec, meno, priezvisko, priradenie, fotografia">
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
    <div class="col-lg-12 text-center">
      <h1 id="demo"></h1>
<h3>Evidencia nových (neregistrovaných) zamestnancov</h3>
<hr>
<table style="width: 100%;" border="1">
<tr>
	<th style="width: 50%;">Číslo karty</th>
	<th style="width: 50%;">Akcia<img src="https://image.flaticon.com/icons/svg/788/788893.svg" width="20px" height="20px" data-toggle="tooltip" data-placement="right" title="Zaevidovať nového zamestnanca"></th>
 </tr>
<?php
 	$karty = mysqli_query($con,"SELECT * FROM zamestnanci WHERE meno = 'Neevidovaný' ORDER BY id DESC") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
				  echo '<td><i>' . htmlspecialchars($line['cislo_karty']) .'</i></td>';
          echo "<td><a href='vytvorit.php?".htmlspecialchars($line['cislo_karty'])."' class='btn btn-danger'>Vytvoriť</a></td>";
			echo "</tr>";
		}  ?> </tbody></table>
    <hr>
   
 </div>

       </div>   
      <?php 
      include("footer.php");
      ?>
       </div>

  </body>
      <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();    
});
</script>
</html>
