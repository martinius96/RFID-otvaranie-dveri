<?php 
$con = mysqli_connect("localhost","pouzivatel","heslo","nazov_databazy");
if (mysqli_connect_errno($con))
    {
        echo "Problém s napojením na MySQL databázu: " . mysqli_connect_error();
    }
?>
