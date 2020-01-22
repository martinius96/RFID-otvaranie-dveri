<?php 
  include("connect.php");
  $cislo_karty = mysqli_real_escape_string($con, $_SERVER['QUERY_STRING']);
  $cislo_karty = trim($cislo_karty);
  if (is_numeric($cislo_karty)){
      $over = mysqli_query($con,"SELECT * FROM `autorizovane` WHERE `cislo_karty`='$cislo_karty'") or die(mysqli_error($con));
 	    if(mysqli_num_rows($over) > 0){
          $zmaz = mysqli_query($con,"DELETE FROM `autorizovane` WHERE `cislo_karty`='".$cislo_karty."'") or die(mysqli_error($con));
          $ins7 = mysqli_query($con,"INSERT INTO `neautorizovane` (`cislo_karty`) VALUES ('".$cislo_karty."')") or die (mysqli_error($con));
      } 
  }
  header("Location: odobrat.php");
?>
