<?php
// 1. Pembuatan Fungsi (Prosedur)
function hitungDiskon($totalBelanja) {

    // 2. Logika Diskon
    if ($totalBelanja >= 100000) {
        // Kondisi 1 : diskon 10%
        $diskon = 0.10 * $totalBelanja;

    } elseif ($totalBelanja >= 50000 && $totalBelanja < 100000) {
        // Kondisi 2 : diskon 5%
        $diskon = 0.05 * $totalBelanja;

    } else {
        // Kondisi 3 : tidak ada diskon
        $diskon = 0;
    }

    // 3. Nilai Kembalian
    return $diskon;
}


// 4. Eksekusi dan Output
$totalBelanja = 120000; // Contoh nilai
$diskon = hitungDiskon($totalBelanja); // Panggil fungsi
$totalBayar = $totalBelanja - $diskon; // Hitung total bayar

// Tampilkan hasil
echo "Total Belanja : Rp " . number_format($totalBelanja, 0, ',', '.') . "<br>";
echo "Diskon        : Rp " . number_format($diskon, 0, ',', '.') . "<br>";
echo "Total Bayar   : Rp " . number_format($totalBayar, 0, ',', '.');
?>