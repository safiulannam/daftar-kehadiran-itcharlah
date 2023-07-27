<?php

$server = "localhost";
$user = "root";
$password = "";
$db = "kehadiran-itcharlah";

// $conn = mysqli_connect($server, $user, $password, $db) or die(mysqli_error($conn));

$conn = new mysqli($server, $user, $password, $db);

// Periksa koneksi
if ($conn->connect_error) {
    // die("Koneksi gagal: " . $conn->connect_error);
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit(); 
}

?>