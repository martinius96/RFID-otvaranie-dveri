<?php 
//UDAJE PRE PRIPOJENIE K DATABAZE
//parameters order: host, username, password, database_name
$con = mysqli_connect("localhost/EXTERNAL_DB_HOST","pouzivatel_db_root","heslo_do_databazy","pouzivana_databaza");
mysqli_set_charset($con, "utf8");
if (mysqli_connect_errno($con))
    {
        echo "Problém s napojením na MySQL databázu: " . mysqli_connect_error();
    }
?>
