<!DOCTYPE html>
<html lang="en">
<?php 
include("connect.php");
?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Vytvorenie konta nového zamestnanca pre RFID vrátnika">
    <meta name="keywords" content="rfid, vrátnik, zamestnanec, konto, nový, evidencia, zaradenie, systém, vstup, meno, priezvisko">
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
<h3>Úprava zamestnanca</h3>
<hr>
<?php
  $cislo_karty = mysqli_real_escape_string($con, $_SERVER['QUERY_STRING']);
  $cislo_karty = htmlspecialchars($cislo_karty);
  $cislo_karty = trim($cislo_karty);  
    if(isset($_POST['odoslat'])){
              $meno = mysqli_real_escape_string($con, $_POST['meno']);
              $meno = htmlspecialchars($meno);
              $meno = trim($meno);
                 if($meno==""){
                echo '<div class="alert alert-danger"><strong>Meno zamestnanca nemôže byť prázdne! Zápis zakázaný!</strong></div>';
              }else{
                $zapis = mysqli_query($con,"UPDATE `zamestnanci` SET `meno`='".$meno."' WHERE `cislo_karty`='".$cislo_karty."'") or die(mysqli_error($con));
                echo '<div class="alert alert-success"><strong>Meno zamestnanca úspešne pozmenené!</strong></div><br>
<center><a href="evidencia.php" class="btn btn-danger" role="button">Späť na evidenciu neregistrovaných zamestnancov</a></center>';
              }
      }
 $zamestnanec = mysqli_query($con,"SELECT * FROM `zamestnanci` WHERE `cislo_karty`='$cislo_karty'") or die(mysqli_error($con));
 $line = mysqli_fetch_assoc($zamestnanec);
 	    if(mysqli_num_rows($zamestnanec) < 1){
       echo '<center><h3>Nesprávne, neúplné, neplatné ID karty!</h3></center>';
       }else{ 
       ?>
   <center><form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?".$cislo_karty;?>">
    <b>Meno a priezvisko:</b> <br><input type="text" name="meno" value="<?php echo $line['meno']; ?>" required><br>
    <input type="submit" class="btn btn-success" name="odoslat" value="Vytvoriť konto">
    </form></center>    
<?php       
}
     ?>
   
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
