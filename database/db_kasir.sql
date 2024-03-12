-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 10:14 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga_produk` int(50) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id`, `username`, `nama_produk`, `harga_produk`, `tanggal_transaksi`) VALUES
(4, 'dimas', '100 Diamond FF ', 300000, '2024-03-09 08:18:04'),
(5, 'dimas', '100 Diamond FF ', 300000, '2024-03-09 08:18:09'),
(6, 'dimas', '100 Diamond FF ', 300000, '2024-03-09 08:18:11'),
(9, 'dimas', '700 Diamond FF', 1000000, '2024-03-09 08:23:10'),
(10, 'dimas', '700 Diamond FF', 1000000, '2024-03-09 08:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(45) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jumlah` int(11) DEFAULT 0,
  `kode_unik` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nama_produk`, `harga_produk`, `created_at`, `updated_at`, `jumlah`, `kode_unik`) VALUES
(5, '100 Diamond FF ', 300000, '2024-03-01 14:27:16', '2024-03-01 14:27:16', NULL, 'e34dca0d82'),
(7, '700 Diamond FF', 1000000, '2024-03-01 14:28:10', '2024-03-01 16:23:36', NULL, 'a8466b716e'),
(8, 'UC PUBG 200', 400000, '2024-03-01 15:09:08', '2024-03-01 15:09:08', NULL, '73bca30031');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `created_at`, `updated_at`, `role`) VALUES
(5, 'iky', 'iky', 'Rizky Zakaria', '2024-03-02 08:10:50', '2024-03-09 13:50:18', 'owner'),
(6, 'dimas', 'dimas', 'Dimas', '2024-03-02 08:41:32', '2024-03-09 13:50:36', 'kasir'),
(8, 'oni', 'oni', 'Oni Sumarni', '2024-03-09 13:50:05', '2024-03-09 13:50:05', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
