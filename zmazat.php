<?php 
  include("connect.php");
  $cislo_karty = mysqli_real_escape_string($con, $_SERVER['QUERY_STRING']);
  $cislo_karty = htmlspecialchars($cislo_karty);
  if (is_numeric($cislo_karty)){
    $zmaz = mysqli_query($con,"DELETE FROM `autorizovane` WHERE `cislo_karty`='".$cislo_karty."'") or die(mysqli_error($con));
  }
  header("Location: odobrat.php");
?>
