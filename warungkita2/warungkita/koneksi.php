<?php
// koneksi.php
$servername = "localhost";
$username = "root";
$password = "";
$database = "warungkitadb"; 

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
