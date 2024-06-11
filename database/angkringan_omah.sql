-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Bulan Mei 2024 pada 12.19
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
-- Database: `angkringan_omah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `role` enum('kasir','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'admin', '$2y$10$Fud5bwh3kF8wGAFtOM1KMu6UZ0dFaiI4ImPAOwZiHcXNxhvbV58rG', 'admin@gmail.com', 'admin'),
(2, 'kasir', '$2y$10$ahbK9LnwksatbVzM.5KmO.FISHQvwfI4Kayr1epzrt1A6.Gby1cEW', '', 'kasir'),
(7, 'kasirkasir', '$2y$10$MrfGgrxTXG7IIeZGzDjYXuKB8eW6EwAOiu7GcYX1TE44eDCpz7xfe', '', 'kasir'),
(8, 'sugeng', '$2y$10$UK7hwDMQbD1T8hYmQI8tWeqqoOpuG/i0RP.l7JyQj0uNwCWA4uS9O', 'sugeng@gmail.com', 'kasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pesanan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_produk`, `id_admin`, `jumlah`, `tanggal_pesanan`, `status`) VALUES
(26, 4, 2, 2, '2024-04-28 08:04:26', 'Pesanan Selesai'),
(27, 5, 2, 1, '2024-04-28 08:04:28', 'Pesanan Selesai'),
(28, 8, 2, 3, '2024-04-28 08:04:29', 'Pesanan Selesai'),
(29, 7, 2, 1, '2024-04-28 08:04:45', 'Pesanan Selesai'),
(30, 8, 2, 2, '2024-04-28 08:04:46', 'Pesanan Selesai'),
(31, 4, 2, 1, '2024-04-29 00:28:41', 'Pesanan Selesai'),
(32, 5, 2, 2, '2024-04-29 00:28:42', 'Pesanan Selesai'),
(33, 6, 2, 2, '2024-04-29 00:28:46', 'Pesanan Selesai'),
(38, 9, 2, 1, '2024-05-05 03:50:57', 'Pesanan Selesai'),
(39, 16, 2, 2, '2024-05-05 03:51:01', 'Pesanan Selesai'),
(40, 8, 2, 1, '2024-05-05 03:51:06', 'Pesanan Selesai'),
(68, 6, 2, 1, '2024-05-13 06:07:32', 'Pesanan Selesai'),
(69, 5, 2, 2, '2024-05-13 06:07:33', 'Pesanan Selesai'),
(70, 4, 2, 1, '2024-05-13 06:07:34', 'Pesanan Selesai'),
(71, 6, 2, 1, '2024-05-14 04:00:11', 'Pesanan Selesai'),
(72, 9, 2, 1, '2024-05-14 04:00:12', 'Pesanan Selesai'),
(76, 6, 2, 1, '2024-05-17 04:35:45', 'Pesanan Selesai'),
(90, 6, 2, 1, '2024-05-17 06:41:28', 'Pesanan Selesai'),
(91, 4, 2, 1, '2024-05-17 06:41:29', 'Pesanan Selesai'),
(92, 5, 2, 1, '2024-05-17 06:41:30', 'Pesanan Selesai'),
(93, 17, 2, 1, '2024-05-17 06:41:42', 'Pesanan Selesai'),
(94, 16, 2, 1, '2024-05-17 06:41:43', 'Pesanan Selesai'),
(96, 4, 2, 1, '2024-05-17 06:49:32', 'Pesanan Selesai'),
(98, 6, 2, 1, '2024-05-17 06:49:38', 'Pesanan Selesai'),
(99, 5, 2, 1, '2024-05-17 07:06:05', 'Pesanan Selesai'),
(100, 6, 2, 1, '2024-05-17 07:06:06', 'Pesanan Selesai'),
(101, 6, 2, 1, '2024-05-17 07:06:18', 'Pesanan Selesai'),
(102, 5, 2, 1, '2024-05-17 07:06:18', 'Pesanan Selesai'),
(103, 6, 2, 1, '2024-05-17 07:08:15', 'Pesanan Selesai'),
(104, 6, 2, 1, '2024-05-17 07:08:24', 'Pesanan Selesai'),
(106, 21, 2, 2, '2024-05-17 07:10:40', 'Pesanan Selesai'),
(107, 6, 2, 1, '2024-05-17 07:15:30', 'Pesanan Selesai'),
(108, 5, 2, 1, '2024-05-17 07:15:30', 'Pesanan Selesai'),
(109, 6, 2, 1, '2024-05-17 07:15:54', 'Pesanan Selesai'),
(110, 5, 2, 1, '2024-05-17 07:15:55', 'Pesanan Selesai'),
(111, 6, 2, 1, '2024-05-17 07:16:04', 'Pesanan Selesai'),
(112, 5, 2, 1, '2024-05-17 07:16:05', 'Pesanan Selesai'),
(113, 6, 2, 1, '2024-05-17 07:22:55', 'Pesanan Selesai'),
(114, 5, 2, 1, '2024-05-17 07:22:56', 'Pesanan Selesai'),
(122, 5, 2, 1, '2024-05-17 07:28:19', 'Pesanan Selesai'),
(123, 6, 2, 1, '2024-05-17 07:28:19', 'Pesanan Selesai'),
(124, 6, 2, 1, '2024-05-17 07:28:40', 'Pesanan Selesai'),
(125, 8, 2, 1, '2024-05-17 07:28:40', 'Pesanan Selesai'),
(126, 6, 2, 1, '2024-05-17 07:29:19', 'Pesanan Selesai'),
(127, 6, 2, 1, '2024-05-17 07:29:28', 'Pesanan Selesai'),
(128, 5, 2, 1, '2024-05-17 08:23:47', 'Pesanan Selesai'),
(129, 6, 2, 1, '2024-05-17 08:23:48', 'Pesanan Selesai'),
(130, 6, 2, 1, '2024-05-17 08:27:15', 'Pesanan Selesai'),
(131, 6, 2, 1, '2024-05-17 08:27:29', 'Pesanan Selesai'),
(132, 6, 2, 1, '2024-05-17 08:28:02', 'Pesanan Selesai'),
(133, 6, 2, 1, '2024-05-17 08:28:45', 'Pesanan Selesai'),
(134, 5, 2, 1, '2024-05-17 08:29:00', 'Pesanan Selesai'),
(135, 4, 2, 1, '2024-05-17 08:29:51', 'Pesanan Selesai'),
(136, 6, 2, 1, '2024-05-17 08:30:08', 'Pesanan Selesai'),
(137, 5, 2, 1, '2024-05-17 08:30:09', 'Pesanan Selesai'),
(143, 4, 1, 1, '2024-05-17 09:43:44', 'Pesanan Selesai'),
(144, 4, 1, 1, '2024-05-17 10:46:46', 'Pesanan Selesai'),
(147, 6, 1, 1, '2024-05-17 10:47:12', 'Pesanan Selesai'),
(148, 5, 8, 1, '2024-05-17 10:48:19', 'Dalam Keranjang'),
(149, 6, 8, 1, '2024-05-17 10:48:19', 'Dalam Keranjang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` bigint(40) NOT NULL,
  `kategori` enum('makanan','minuman','jajanan') NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `kategori`, `stok`, `gambar`) VALUES
(4, 'Seblak Sayur Komplit', 15000, 'makanan', 1, '../gambar_produk/662dfd03ed698.jpg'),
(5, 'Ceker Mix Bakso', 15000, 'makanan', 0, '../gambar_produk/662dfd3c7155c.jpg'),
(6, 'Sosis Mix Bakso', 15000, 'makanan', 0, '../gambar_produk/662dfed28d7d8.jpg'),
(7, 'Ceker Solehot', 12000, 'makanan', 0, '../gambar_produk/662dff245afef.jpg'),
(8, 'Otak Otak Solehot', 12000, 'makanan', 0, '../gambar_produk/662dff903b66f.jpg'),
(9, 'Mie Goreng Telor', 12000, 'makanan', 0, '../gambar_produk/662e0035dad32.jpeg'),
(10, 'Mie Kuah Telor', 12000, 'makanan', 0, '../gambar_produk/662e0061d5aee.jpg'),
(11, 'Pisang Crispy', 10000, 'jajanan', 0, '../gambar_produk/662e00b5df3f1.jpg'),
(12, 'Roti Bakar', 10000, 'jajanan', 0, '../gambar_produk/662e00e24ddd1.jpeg'),
(13, 'Singkong Keju', 10000, 'jajanan', 0, '../gambar_produk/662e011fdca65.jpg'),
(14, 'Bakso Goreng', 10000, 'jajanan', 0, '../gambar_produk/662e01718abcf.jpg'),
(15, 'Otak Otak Goreng', 10000, 'jajanan', 0, '../gambar_produk/662e01c3d6c6d.jpg'),
(16, 'Naget Goreng', 10000, 'jajanan', 0, '../gambar_produk/662e022bf1d92.jpg'),
(17, 'Sosis Goreng', 10000, 'jajanan', 0, '../gambar_produk/662e02cae4a4a.jpg'),
(21, 'esteh', 5000, 'makanan', 31, '../gambar_produk/664702e6a53dc.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
