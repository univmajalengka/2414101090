-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2025 pada 11.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata_kelimutu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_wisata`
--

CREATE TABLE `paket_wisata` (
  `id` int(11) NOT NULL,
  `nama_paket` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `harga_dasar` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `paket_wisata`
--

INSERT INTO `paket_wisata` (`id`, `nama_paket`, `deskripsi`, `gambar`, `video_url`, `harga_dasar`) VALUES
(1, 'Paket Sunrise Kelimutu', 'Menikmati sunrise spektakuler di puncak Kelimutu dengan pemandangan Danau Tiga Warna yang memukau. Termasuk guide lokal, sarapan, dan transportasi dari Ende.', 'https://campatour.com/wp-content/uploads/2018/12/P_20151003_053637.jpg', 'https://youtu.be/dQw4w9WgXcQ', 750000.00),
(2, 'Paket Wisata Edukasi Kelimutu', 'Tour edukasi tentang geologi, ekosistem, dan budaya lokal Taman Nasional Kelimutu dengan ranger berpengalaman dan materi edukasi lengkap.', 'https://kelimutu.id/assets/filegaleri/album_foto161482029010.jpg', 'https://youtu.be/dQw4w9WgXcQ', 950000.00),
(3, 'Paket Adventure Kelimutu', 'Eksplorasi lengkap kawasan Kelimutu termasuk trekking ke spot-spot tersembunyi, camping, dan fotografi profesional.', 'https://sailingkomodo.com/wp-content/uploads/2024/08/Paket-Tour-Kelimutu-1-scaled.jpg', 'https://youtu.be/dQw4w9WgXcQ', 1250000.00),
(4, 'Paket Keluarga Kelimutu', 'Paket khusus keluarga dengan rute yang nyaman, aktivitas anak-anak, dan penginapan family-friendly di Desa Moni.', 'https://sailingkomodo.com/wp-content/uploads/2024/08/kelimutu-wae-rebo-5D4N-1-scaled.jpg', 'https://youtu.be/dQw4w9WgXcQ', 850000.00),
(5, 'Paket Fotografi Kelimutu', 'Paket khusus fotografer dengan akses ke spot foto terbaik, guide fotografer lokal, dan waktu fleksibel untuk mendapatkan angle terbaik.', 'https://satyawinnie.com/wp-content/uploads/2015/06/Tiket-Masuk-Danau-Kelimutu-Pesona-Ende-1024x640.jpg', 'https://youtu.be/dQw4w9WgXcQ', 1100000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `waktu_perjalanan` date NOT NULL,
  `lama_hari` int(11) DEFAULT 1,
  `penginapan` tinyint(1) DEFAULT 0,
  `transportasi` tinyint(1) DEFAULT 0,
  `service_makan` tinyint(1) DEFAULT 0,
  `jumlah_peserta` int(11) NOT NULL,
  `harga_paket` decimal(10,2) NOT NULL,
  `jumlah_tagihan` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_paket`, `nama_pemesan`, `nomor_hp`, `tanggal_pesan`, `waktu_perjalanan`, `lama_hari`, `penginapan`, `transportasi`, `service_makan`, `jumlah_peserta`, `harga_paket`, `jumlah_tagihan`, `created_at`) VALUES
(1, 3, 'rrr', '0852121212121', '2025-12-16', '2025-12-23', 3, 0, 1, 0, 2, 2450000.00, 14700000.00, '2025-12-16 10:11:17'),
(2, 5, 'rrr', '082121212121', '2025-12-16', '2025-12-23', 3, 0, 1, 0, 2, 1200000.00, 7200000.00, '2025-12-16 10:19:24'),
(3, 1, 'dimmm', '082121212121', '2025-12-16', '2025-12-23', 3, 1, 1, 0, 2, 2950000.00, 17700000.00, '2025-12-16 10:20:28'),
(4, 1, 'mumud', '082121212121', '2025-12-16', '2025-12-23', 3, 0, 1, 0, 2, 1950000.00, 11700000.00, '2025-12-16 10:22:22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `paket_wisata`
--
ALTER TABLE `paket_wisata`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_paket` (`id_paket`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `paket_wisata`
--
ALTER TABLE `paket_wisata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_paket`) REFERENCES `paket_wisata` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
