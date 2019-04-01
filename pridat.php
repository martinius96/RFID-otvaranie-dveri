<!DOCTYPE html>
<html lang="en">
<?php 
include("connect.php");
?>
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Webové rozhranie RFID vrátnika pre pridanie karty do systému pre overenie vstupujúceho.">
    <meta name="keywords" content="rfid, vrátnik, dochádzka, systém, prístup, overenie, otvorenie, dvere, solenoid, relé, esp8266, nodemcu, jazýček, kľučka">
    <meta name="author" content="Martin Chlebovec">
    <meta name="robots" content="index, follow">
    <title>RFID vrátnik - ESP8266 - Pridanie karty</title>
    <link rel="icon" type="image/png" href="https://i.nahraj.to/f/2g8C.png" />
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Webaplikácia apartmánu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Prehľad
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="pridat.php">Pridať kartu</a>
			               <span class="sr-only">(current)</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="odobrat.php">Odobrať kartu</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="program.php">Program</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
		<?php   if(isset($_POST['odoslat'])){
    $cislo = mysqli_real_escape_string($con, $_POST['cislo']);
    $cislo = htmlspecialchars( $cislo, ENT_QUOTES );
    $cislo = trim( $cislo );
    if($cislo==""){
    echo '<div class="alert alert-danger" style="width:100%;">
  <strong>Pozor!</strong> Neplatný kód karty! Opakujte pokus!
</div>';
    }else{
    $ins = mysqli_query($con,"INSERT INTO `autorizovane` (`cislo_karty`) VALUES ('$cislo')") or die (mysqli_error($con));
    echo '<div class="alert alert-success" style="width:100%;">
  <strong>Zapísané!</strong> Manuálny kód karty zapísaný do systému!
</div>';
    }
} ?>
        <div class="col-lg-12 text-center">
		<center><b>Posledných 5 interakcií</b></center>
          <div id="last5"></div>
		<b>Autorizované karty</b>
		<div id="autorizovane"></div>
		<hr><b>Neautorizované karty</b><hr>
		<div id="neautorizovane"></div>
		
		<hr><b>Manuálne pridať kartu</b><hr>
		 <form method="post"ction="<?php echo $_SERVER['PHP_SELF']; ?>" >
  <fieldset>
    <input type="number" min=0 max=99999999999999 name="cislo" required><br>
  <input type="submit" class="btn btn-success" name="odoslat" value="Zapísať">
  </fieldset>
</form>

        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
  <script>
       setInterval(function(){
  $.get('last5.php', function(data){
        $('#last5').html(data)
    });
	 $.get('autorizovane.php', function(data){
        $('#autorizovane').html(data)
    });
	$.get('neautorizovane.php', function(data){
        $('#neautorizovane').html(data)
    });
},800);   
</script>

</html>
