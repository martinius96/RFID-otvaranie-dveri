<?php
$stranka = "Historia";
?>
<!DOCTYPE html>
<html lang="sk">
<?php 
include("connect.php");
?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="História RFID vrátnika založenom na platforme Arduino, ESP8266, ESP32.">
    <meta name="keywords" content="rfid, vrátnik, príchod, prístup, overený, neoverený, vstup, odchod, čas, história, minulosť, report">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - História prístupov</title>
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
      </div>
      <div class="col-lg-12 text-center">
       <hr><h2>Historický prehľad priložení kariet</h2>
        <hr>
        <table style="width: 100%;" border="1">
	<thead>
  <tr>
		<th style="width: 25%;">Čas</th>
		<th style="width: 25%;">Kľúčenka</th>
		<th style="width: 25%;">Výsledok</th>
		<th style="width: 25%;">Meno</th>							 
	</tr></thead><tbody>           
<?php
 	$karty = mysqli_query($con,"SELECT * FROM pokusy ORDER BY id DESC") or die(mysqli_error($con));
		while($line = mysqli_fetch_assoc($karty)){
			echo "<tr>";
			$casik = date('d. M H:i:s',strtotime($line['time']));	
			if($line['vysledok']==1){
				echo '<td bgcolor="#2ECC71"><i>'. htmlspecialchars($casik) . '</i></td>';	
				echo '<td bgcolor="#2ECC71"><i>' . htmlspecialchars($line['cislo_karty']) . '</i></td>';    
				$vysledok = "Úspešné overenie";
				echo '<td bgcolor="#2ECC71"><i>' . htmlspecialchars($vysledok) .'</i></td>';
        $zamestnanec = mysqli_query($con,"SELECT meno FROM `zamestnanci` WHERE `cislo_karty`='".$line['cislo_karty']."'") or die(mysqli_error($con));
        $line2 = mysqli_fetch_assoc($zamestnanec);
        echo '<td bgcolor="#2ECC71"><b>' . htmlspecialchars($line2['meno']) . '</b></td>';
			}else{
				echo '<td bgcolor="#E74C3C"><i>'. htmlspecialchars($casik) . '</i></td>';	
				echo '<td bgcolor="#E74C3C"><i>' . htmlspecialchars($line['cislo_karty']) . '</i></td>';
				$vysledok = "Neúspešné overenie";
				echo '<td bgcolor="#E74C3C"><i>' . htmlspecialchars($vysledok) .'</i></td>';
        $zamestnanec = mysqli_query($con,"SELECT meno FROM `zamestnanci` WHERE `cislo_karty`='".$line['cislo_karty']."'") or die(mysqli_error($con));
        $line2 = mysqli_fetch_assoc($zamestnanec);
        echo '<td bgcolor="#E74C3C"><b>' . htmlspecialchars($line2['meno']) . '</b></td>';
			}		
	echo "</tr>";
		}  ?> 
</tbody></table>
        </div>
      </div>
      <?php 
      include("footer.php");
      ?>
    </div>    
  </body>
</html>
