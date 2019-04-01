<?php 
$con = mysqli_connect("localhost","xxx","xxx","xxx");

if (mysqli_connect_errno($con))
{
    echo "Problém s pripojením na databázu: Popis problému: " . mysqli_connect_error();
}
?>
