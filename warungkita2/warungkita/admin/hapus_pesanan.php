<?php
include '../koneksi.php';

// ambil id dari POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = mysqli_query($conn, "DELETE FROM pesanan WHERE id='$id'");

    if ($query) {
        echo "Pesanan berhasil dihapus!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "ID pesanan tidak ditemukan!";
}
?>
