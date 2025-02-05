<?php

$host     = "localhost";
$username = "root";
$password = "";
$database = "ukk_perpus_digital";

$koneksi = new mysqli($host, $username, $password, $database);
if ($koneksi){
    echo "";
}else{
	echo "database tidak terkoneksi";
}
?>