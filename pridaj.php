<?php 
  include("connect.php");
  $ins7 = mysqli_query($con,"INSERT INTO `autorizovane` (`cislo_karty`) VALUES ('".$_SERVER['QUERY_STRING']."')") or die (mysqli_error($con));
  $zmaz = mysqli_query($con,"DELETE FROM `neautorizovane` WHERE `cislo_karty`='".$_SERVER['QUERY_STRING']."'") or die(mysqli_error($con));
  echo "OK";  
  header("Location: pridat.php");
?>
