-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Nov 2024 pada 01.33
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-10-16-003241', 'App\\Database\\Migrations\\TbProduk', 'default', 'App', 1729039846, 1),
(3, '2024-11-19-235426', 'App\\Database\\Migrations\\Pelanggan', 'default', 'App', 1732062264, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `pelanggan_id` int(11) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`pelanggan_id`, `nama_pelanggan`, `alamat`, `telepon`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'qaedqsdgsg', 'SRSFS', '12234', '2024-11-20 01:56:13', '2024-11-21 00:00:04', '2024-11-21 00:00:04'),
(2, 'afrtqew', 'qwerfqer1`1', '111', '2024-11-21 00:01:31', '2024-11-21 00:02:09', '2024-11-21 00:02:09'),
(3, 'qweffgfgf', 'w34t3wgrewt', '111112312', '2024-11-21 00:02:15', '2024-11-21 00:02:24', '2024-11-21 00:02:24'),
(4, 'Mello', 'Jl.Nasional III', '088124503219', '2024-11-21 00:19:32', '2024-11-21 00:19:32', NULL),
(5, 'Yupy', 'JL.Nasional III', '08876543211', '2024-11-21 00:20:01', '2024-11-21 00:20:01', NULL),
(6, 'Lula', 'Jl.Nasional III', '085852844632', '2024-11-21 00:20:30', '2024-11-21 00:20:30', NULL),
(7, 'Dudul', 'Jl.Pahlawan 11', '085123458567', '2024-11-21 00:21:13', '2024-11-21 00:22:23', NULL),
(8, 'Riry', 'Jl.Damai II', '085853427603', '2024-11-21 00:21:44', '2024-11-21 00:21:44', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_produk`
--

CREATE TABLE `tb_produk` (
  `produk_id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_produk`
--

INSERT INTO `tb_produk` (`produk_id`, `nama_produk`, `harga`, `stok`, `gambar`) VALUES
(165, 'Whiskas Salmon Adlt', 22000.00, 12, '1732162324_c95005860ba293c8ae49.jpg'),
(166, 'Whiskas Mix Adlt', 22000.00, 12, '1732162374_d314dcbd60a438bd9333.jpg'),
(167, 'Whiskas Chicken Milk Kttn', 25000.00, 12, '1732162412_a21adf8cecd0a8e718ba.jpg'),
(168, 'Cat Choize Tuna Adlt', 18000.00, 12, '1732162472_67e8c5729b63ec3769d0.jpg'),
(169, 'Cat Choize Salmon Adlt', 18000.00, 12, '1732162513_3978a1946c68a548b646.jpg'),
(170, 'Cat Choize Salmon Kttn', 18000.00, 12, '1732162538_f2d0930fc21f704b5b6e.jpg'),
(171, 'MeO Creamy Treats Slmn', 18000.00, 12, '1732162571_73410fd9325ef25f01c5.jpg'),
(172, 'MeO Creamy Treats Crab', 18000.00, 12, '1732162597_226199d646edd77d3733.jpg'),
(173, 'MeO Creamy Treats Tuna', 18000.00, 12, '1732162610_3ec0fdc07679b397ded9.jpg'),
(174, 'Liebao Snack 1 pack Mix', 10000.00, 12, '1732162646_060e8f5d24a2293a564c.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indeks untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `pelanggan_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
