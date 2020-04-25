<?php 
include("connect.php");
$cislo_karty = mysqli_real_escape_string($con, $_SERVER['QUERY_STRING']);
$cislo_karty = htmlspecialchars($cislo_karty);
$cislo_karty = trim($cislo_karty);  
$meno = "Neevidovaný";
$zapis = mysqli_query($con,"UPDATE `zamestnanci` SET `meno`='".$meno."' WHERE `cislo_karty`='".$cislo_karty."'") or die(mysqli_error($con));
header("Location: evidencia.php");
?>
