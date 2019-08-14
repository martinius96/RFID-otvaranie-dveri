<?php 
  include("connect.php");
  $cislo_karty = mysqli_real_escape_string($con, $_SERVER['QUERY_STRING']);
  $cislo_karty = htmlspecialchars($cislo_karty);
  if (is_numeric($cislo_karty)){
    $ins7 = mysqli_query($con,"INSERT INTO `autorizovane` (`cislo_karty`) VALUES ('".$cislo_karty."')") or die (mysqli_error($con));
    $zmaz = mysqli_query($con,"DELETE FROM `neautorizovane` WHERE `cislo_karty`='".$cislo_karty."'") or die(mysqli_error($con));
  }
  header("Location: pridat.php");
?>
