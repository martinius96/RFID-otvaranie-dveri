<?php 
include("connect.php");
$kod = mysqli_real_escape_string($con, $_GET['kod']);
$kod = trim( $kod );
$kod = hexdec(hash('crc32b', $kod));
// $zmazat = mysqli_query($con,"DELETE FROM pokusy WHERE date(time) < CURDATE() - INTERVAL 1 MINUTE") or die(mysqli_error($con));
// VOLITELNE (zmenu aplikovat i v programe NodeMCU) $origin = mysqli_real_escape_string($con, $_GET['origin']);
// VOLITELNE (zmenu aplikovat i v programe NodeMCU) $origin = trim( $origin );

// VOLITELNE (zmenu aplikovat i v programe NodeMCU) $topsecret = mysqli_real_escape_string($con, $_GET['topsecret']);
// VOLITELNE (zmenu aplikovat i v programe NodeMCU) $topsecret = trim( $topsecret );
$cas = mysqli_query($con,"SELECT time FROM pokusy ORDER BY id DESC LIMIT 1") or die(mysqli_error($con));
$line = mysqli_fetch_assoc($cas);		
$datum = strtotime($line['time']);
$teraz = strtotime("now");
$vypocet = $teraz - $datum;
if($vypocet >=5){
  if($kod!=""){
// VOLITELNE (zmenu aplikovat i v programe NodeMCU)if($origin=="Lolin"){
// VOLITELNE (zmenu aplikovat i v programe NodeMCU)if($topsecret=="topsecret"){
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
// VOLITELNE (zmenu aplikovat i v programe NodeMCU) }
// VOLITELNE (zmenu aplikovat i v programe NodeMCU) }	
}
}else{
 echo "Pockajte! Prekroceny casovy limit pre overenie karty. Pokus opakujte o 5 sekund.";
}
