-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2025 pada 09.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama_barang`, `jumlah`, `harga`, `total`, `metode_pembayaran`, `tanggal`) VALUES
(1, 'Kaos Polos', 1, 35000, 35000, 'E-Wallet', '2025-08-04 14:59:53'),
(2, 'Kaos Polos', 1, 35000, 35000, 'Transfer Bank', '2025-08-04 15:01:15'),
(3, 'Kaos Polos', 1, 35000, 35000, 'E-Wallet', '2025-08-04 15:06:48'),
(4, 'Kaos Polos', 1, 35000, 35000, 'E-Wallet', '2025-08-04 15:07:10'),
(5, 'Celana Jeans', 1, 90000, 90000, 'Tunai', '2025-08-04 15:12:02'),
(6, 'Hoodie', 2, 120000, 240000, 'Transfer Bank', '2025-08-04 15:18:07'),
(7, 'Kaos Polos', 1, 35000, 35000, 'Transfer Bank', '2025-08-04 15:51:11'),
(8, 'Celana Jeans', 1, 90000, 90000, 'E-Wallet', '2025-08-04 15:51:34'),
(9, 'Kaos Polos', 1, 35000, 35000, 'E-Wallet', '2025-08-04 15:52:45'),
(10, 'Kaos Polos', 3, 35000, 105000, 'Transfer Bank', '2025-08-04 15:53:27'),
(11, 'Hoodie', 1, 120000, 120000, 'Transfer Bank', '2025-08-05 09:20:58'),
(12, 'Celana Jeans', 4, 90000, 360000, 'Transfer Bank', '2025-08-05 09:20:58'),
(13, 'Kaos Polos', 3, 35000, 105000, 'Tunai', '2025-08-05 10:05:53'),
(14, 'Kaos Polos', 4, 35000, 140000, 'E-Wallet', '2025-08-05 10:09:12'),
(15, 'Kaos Polos', 4, 35000, 140000, 'E-Wallet', '2025-08-05 10:11:32'),
(16, 'Celana Jeans', 2, 90000, 180000, 'Tunai', '2025-08-05 10:14:15'),
(17, 'Celana Jeans', 1, 90000, 90000, 'Transfer Bank', '2025-08-05 10:15:51'),
(18, 'Celana Jeans', 2, 90000, 180000, 'Tunai', '2025-08-05 10:16:49'),
(19, 'Kaos Polos', 1, 35000, 35000, 'Transfer Bank', '2025-08-05 10:24:05'),
(20, 'Hoodie', 1, 120000, 120000, 'Transfer Bank', '2025-08-05 10:28:05'),
(21, 'Hoodie', 2, 120000, 240000, 'E-Wallet', '2025-08-05 10:32:38'),
(22, 'Hoodie', 1, 120000, 120000, 'Transfer Bank', '2025-08-05 10:37:25'),
(23, 'Celana Jeans', 5, 90000, 450000, 'Tunai', '2025-08-05 11:20:59'),
(24, 'sepatu', 2, 21600, 43200, 'Transfer Bank', '2025-08-06 15:09:26'),
(25, 'sepatu', 1, 21600, 21600, 'E-Wallet', '2025-08-06 15:25:54'),
(26, 'celan jeans', 2, 0, 0, 'Tunai', '2025-08-06 15:29:11'),
(27, 'hoodie', 3, 500000, 1500000, 'Tunai', '2025-08-06 15:46:04'),
(28, 'celan jeans', 1, 0, 0, 'E-Wallet', '2025-08-07 08:57:18'),
(29, 'hoodie', 1, 500000, 500000, 'E-Wallet', '2025-08-07 08:57:19'),
(30, 'celan jeans', 1, 0, 0, 'E-Wallet', '2025-08-07 09:01:41'),
(31, 'hoodie', 1, 500000, 500000, 'E-Wallet', '2025-08-07 09:01:41'),
(32, 'celan jeans', 3, 2790000, 8370000, 'Transfer Bank', '2025-08-07 19:54:52'),
(33, 'baju hitam', 1, 228000, 228000, 'Transfer Bank', '2025-08-12 13:15:52'),
(34, 'ransel', 2, 1200000, 2400000, 'Transfer Bank', '2025-08-12 13:18:38'),
(35, 'kaus kaki', 1, 23000, 23000, 'Transfer Bank', '2025-08-12 13:18:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
