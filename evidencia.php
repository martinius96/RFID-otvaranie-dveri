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
      if (isset($_POST["autorizovany_submit"])) {
    echo '<div class="alert alert-danger">
  <strong>Nepovolená akcia!</strong> Možnosť upravovať mená zamestnancov k autorizovaným kartám s fotografiami je možné vykonať iba v platenej verzii. - pri záujme: <b>martinius96@gmail.com</b>
</div>';  
} 
if (isset($_POST["neautorizovany_submit"])) {
    echo '<div class="alert alert-danger">
  <strong>Nepovolená akcia!</strong> Možnosť upravovať mená zamestnancov k neautorizovaným kartám s fotografiami je možné vykonať iba v platenej verzii. - pri záujme: <b>martinius96@gmail.com</b>
</div>';  
}  
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
<h3>Evidencia zamestnancov - autorizované karty</h3>
<hr>
<form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<table style="width: 100%;" border="1">
									 <tr>
									 <th style="width: 25%;">Autorizované od</th>
									 <th style="width: 25%;">Číslo karty</th>
									 <th style="width: 25%;">Meno zamestnanca</th>
                   <th style="width: 25%;">Fotografia zamestnanca</th>
 </tr>
<?php
 	$karty = mysqli_query($con,"SELECT * FROM autorizovane ORDER BY id DESC") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
				$casik = date('d. M H:i:s',strtotime($line['time']));			
       echo "<td><i>". $casik . "</i></td>";
				  echo '<td><i>' . $line['cislo_karty'] .'</i></td>';
				  echo "<td><input type='text' name='meno_zamestnanca'></td>";
          echo "<td><input type='file' name='fotografia_zamestnanca_autorizovane'></td>";
			echo "</tr>";
		}  ?> </tbody></table>
    <hr>
    <center><input type="submit" name="autorizovany_submit" class="btn btn-success" value="Upraviť autorizovaných zamestnancov"></center>
    </form>
    <h3>Evidencia zamestnancov - neautorizované karty</h3>
<hr>
<form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<table style="width: 100%;" border="1">
									 <tr>
									 <th style="width: 25%;">Neautorizované od</th>
									 <th style="width: 25%;">Číslo karty</th>
									 <th style="width: 25%;">Meno zamestnanca</th>
                   <th style="width: 25%;">Fotografia zamestnanca</th>
 </tr>
<?php
 	$karty = mysqli_query($con,"SELECT * FROM neautorizovane GROUP BY cislo_karty") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
			$casik = date('d. M H:i:s',strtotime($line['time']));			
       echo "<td><i>". $casik . "</i></td>";
				  echo '<td><i>' . $line['cislo_karty'] .'</i></td>';
				 echo "<td><input type='text' name='meno_zamestnanca_neautorizovane'></td>";
         echo "<td><input type='file' name='fotografia_zamestnanca_neautorizovane'></td>";
			echo "</tr>";
		}  ?> </tbody></table>
     <center><input type="submit" name="neautorizovany_submit" class="btn btn-danger" value="Upraviť neautorizovaných zamestnancov"></center>
    </form>
   <h3>Evidencia zamestnancov - reporty</h3> 
  <div class="row"><div class="col-lg-4"><center><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="denny_report" class="btn btn-success" value="Denný report"></form></center></div>
  <div class="col-lg-4"><center><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="tyzdenny_report" class="btn btn-warning" value="Týždenný report"></form></center></div>
  <div class="col-lg-4"><center><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"><input type="submit" name="mesacny_report" class="btn btn-primary" value="Mesačný report"></form></center></div></div>
  <hr>
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
