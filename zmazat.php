<?php 
include("connect.php");
$zmaz = mysqli_query($con,"DELETE FROM `autorizovane` WHERE `id`='".$_SERVER['QUERY_STRING']."'") or die(mysqli_error($con));
header("Location: odobrat.php");
?>