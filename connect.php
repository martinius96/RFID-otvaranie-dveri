<?php 
$con = mysqli_connect("localhost","root","pass","dbname");

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}
?>