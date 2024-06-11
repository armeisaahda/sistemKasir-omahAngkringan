-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 07:35 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('kasir','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$Fud5bwh3kF8wGAFtOM1KMu6UZ0dFaiI4ImPAOwZiHcXNxhvbV58rG', 'admin'),
(2, 'kasir', '$2y$10$ahbK9LnwksatbVzM.5KmO.FISHQvwfI4Kayr1epzrt1A6.Gby1cEW', 'kasir'),
(7, 'kasirkasir', '$2y$10$MrfGgrxTXG7IIeZGzDjYXuKB8eW6EwAOiu7GcYX1TE44eDCpz7xfe', 'kasir');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pesanan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pesanan`
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
(72, 9, 2, 1, '2024-05-14 04:00:12', 'Pesanan Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` bigint(40) NOT NULL,
  `kategori` enum('makanan','minuman','jajanan') NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`, `kategori`, `stok`, `gambar`) VALUES
(4, 'Seblak Sayur Komplit', 15000, 'makanan', 0, '../gambar_produk/662dfd03ed698.jpg'),
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
(17, 'Sosis Goreng', 10000, 'jajanan', 0, '../gambar_produk/662e02cae4a4a.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
