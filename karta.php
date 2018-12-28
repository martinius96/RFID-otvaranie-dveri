<?php 

include("connect.php");
$kod = mysqli_real_escape_string($con, $_GET['kod']);
 $register1 = mysqli_query($con,"SELECT * FROM `autorizovane` WHERE `cislo_karty`='$kod'") or die(mysqli_error($con));
 	 if(mysqli_num_rows($register1) < 1){
	 	 $ins7 = mysqli_query($con,"INSERT INTO `pokusy` (`cislo_karty`,`vysledok`) VALUES ('$kod',0)") or die (mysqli_error($con));
		 echo "NO";
		 $register2 = mysqli_query($con,"SELECT * FROM `neautorizovane` WHERE `cislo_karty`='$kod'") or die(mysqli_error($con));
		  if(mysqli_num_rows($register2) < 1){
		  $ins7 = mysqli_query($con,"INSERT INTO `neautorizovane` (`cislo_karty`) VALUES ('$kod')") or die (mysqli_error($con));
		  }
	 }else{
	 	$ins7 = mysqli_query($con,"INSERT INTO `pokusy` (`cislo_karty`,`vysledok`) VALUES ('$kod',1)") or die (mysqli_error($con));
		echo "OK";
	 }