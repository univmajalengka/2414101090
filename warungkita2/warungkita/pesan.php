<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

// koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'warungkitadb');
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Koneksi gagal: " . $conn->connect_error]));
}

// ambil data JSON dari fetch()
$data = json_decode(file_get_contents("php://input"), true);

// daftar harga menu
$hargaMenu = [
    "Nasi Goreng Spesial" => 18000,
    "Sate Ayam Madura" => 20000,
    "Bakso Malang" => 18000,
    "Mie Ayam Panjul" => 15000,
    "Es Teh Tarot" => 7000,
    "Jus Jeruk" => 10000,
    "Es Kelapa Muda" => 10000,
    "Es Milo" => 10000
];

// amankan dan cek data
$nama = $conn->real_escape_string($data['nama'] ?? '');
$menu = $conn->real_escape_string($data['menu'] ?? '');
$jumlah = (int)($data['jumlah'] ?? 0);
$catatan = $conn->real_escape_string($data['catatan'] ?? '');

// hitung total otomatis
$harga = $hargaMenu[$menu] ?? 0;
$total = $jumlah * $harga;

// validasi data
if ($nama && $menu && $jumlah > 0) {
    $sql = "INSERT INTO pesanan (nama, menu, jumlah, harga, total, catatan)
        VALUES ('$nama', '$menu', '$jumlah', '$harga', '$total', '$catatan')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["status" => "success", "message" => "Pesanan berhasil dikirim!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan: " . $conn->error]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
}

$conn->close();
?>
