<?php
include 'koneksi.php';

if (isset($_POST['nama'], $_POST['menu'], $_POST['jumlah'], $_POST['harga'], $_POST['catatan'])) {
    $nama = $_POST['nama'];
    $menu = $_POST['menu'];
   $jumlah = (int)$_POST['jumlah'];
    $harga = (int)$_POST['harga']; // wajib diisi
    $total = $jumlah * $harga;

    $stmt = $conn->prepare("INSERT INTO tb_pesanan (nama, menu, jumlah, harga, total, catatan, tanggal) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssiiis", $nama, $menu, $jumlah, $harga, $total, $catatan);


    echo "Pesanan berhasil ditambahkan!";
} else {
    echo "Data tidak lengkap!";
}

$conn->close();
?>
