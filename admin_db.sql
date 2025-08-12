-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2025 pada 09.50
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
-- Database: `admin_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelola`
--

CREATE TABLE `kelola` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `diskon` int(11) NOT NULL DEFAULT 0,
  `gambar` varchar(100) NOT NULL,
  `terjual` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelola`
--

INSERT INTO `kelola` (`id`, `nama`, `harga`, `stok`, `diskon`, `gambar`, `terjual`) VALUES
(20, 'baju hitam', 300000, 24, 24, '1754554308_68945fc4a2237.jpg', 1),
(22, 'celan jeans', 3000000, 20, 7, '1754571252_6894a1f49c3d6.jpeg', 3),
(23, 'kaus kaki', 23000, 22, 0, '1754972459_689ac12bd686c.jpeg', 1),
(25, 'ransel', 2000000, 10, 40, '1754979459_689adc83cddaa.jpeg', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelola`
--
ALTER TABLE `kelola`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelola`
--
ALTER TABLE `kelola`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
