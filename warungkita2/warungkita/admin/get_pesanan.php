<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$conn = new mysqli('localhost', 'root', '', 'warungkitadb');
if ($conn->connect_error) {
    die(json_encode([]));
}

$result = $conn->query("SELECT * FROM pesanan ORDER BY id DESC");
$pesanan = [];

while ($row = $result->fetch_assoc()) {
    $pesanan[] = $row;
}

echo json_encode($pesanan);
$conn->close();
?>
