<?php
$server = "localhost";
$user = "root";
$password = "";
$dbname = "db_reservasi_restoran";

$conn = new mysqli($server, $user, $password, $dbname);

if(!$conn){
    die("gagal terhubung database: " . $conn->connect_error);
}