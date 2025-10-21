<?php
include '../koneksi.php'; // sesuaikan path

if(isset($_POST['id'], $_POST['nama'], $_POST['menu'], $_POST['jumlah'], $_POST['catatan'])) {
    $id = (int)$_POST['id'];
    $nama = $_POST['nama'];
    $menu = $_POST['menu'];
    $jumlah = (int)$_POST['jumlah'];
    $catatan = $_POST['catatan'];

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

    $harga = $hargaMenu[$menu] ?? 0;
    $total = $jumlah * $harga;

    // update query
    $stmt = $conn->prepare("UPDATE pesanan SET nama=?, menu=?, jumlah=?, harga=?, total=?, catatan=? WHERE id=?");
    $stmt->bind_param("ssiiisi", $nama, $menu, $jumlah, $harga, $total, $catatan, $id);

    if($stmt->execute()){
        echo "Pesanan berhasil diupdate!";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Data tidak lengkap!";
}
?>
