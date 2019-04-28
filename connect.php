<?php 
$con = mysqli_connect("localhost","root","pass","dbname");
if (mysqli_connect_errno($con))
    {
        echo "Problém s napojením na MySQL databázu: " . mysqli_connect_error();
    }
?>
