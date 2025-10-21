<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// koneksi database
$conn = new mysqli('localhost', 'root', '', 'warungkitadb');
if ($conn->connect_error) {
  die(json_encode(["status" => "error", "message" => "Koneksi gagal"]));
}

// ambil data dari fetch()
$data = json_decode(file_get_contents("php://input"), true);
$username = $data['username'] ?? '';
$password = $data['password'] ?? '';

// untuk contoh sederhana, pakai data statis
$admin_user = "admin";
$admin_pass = "12345"; // nanti bisa disimpan di database

if ($username === $admin_user && $password === $admin_pass) {
  echo json_encode(["status" => "success", "message" => "Login berhasil!"]);
} else {
  echo json_encode(["status" => "error", "message" => "Username atau password salah!"]);
}

$conn->close();
?>
