-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 01:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_transpadang`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bus`
--

CREATE TABLE `tb_bus` (
  `plat_bus` varchar(12) NOT NULL,
  `kode_bus` int(11) NOT NULL,
  `awal_halte` varchar(255) NOT NULL,
  `tujuan_akhir` varchar(255) NOT NULL,
  `koridor_bus` int(1) NOT NULL,
  `jam_awal` time NOT NULL,
  `jam_akhir` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_bus`
--

INSERT INTO `tb_bus` (`plat_bus`, `kode_bus`, `awal_halte`, `tujuan_akhir`, `koridor_bus`, `jam_awal`, `jam_akhir`) VALUES
('BA 1234 ON', 2, 'Lubeg', 'Pasaraya', 3, '05:20:00', '23:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id_member` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_member` varchar(255) NOT NULL,
  `no_telepon` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `posisi` varchar(10) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id_member`, `username`, `password`, `nama_member`, `no_telepon`, `email`, `posisi`, `foto`) VALUES
(1, 'admin', 'admin', 'admin', '081234567890', 'admin@gmail.com', 'admin', ''),
(2, 'user', 'user', 'user', '080987654321', 'user@gmail.com', 'user', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `id_pemesanan` int(10) NOT NULL,
  `kode_bus` int(11) NOT NULL,
  `koridor_bus` int(1) NOT NULL,
  `awal_halte` varchar(255) NOT NULL,
  `tujuan_akhir` varchar(255) NOT NULL,
  `jumlah_penumpang` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total_pembayaran` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`id_pemesanan`, `kode_bus`, `koridor_bus`, `awal_halte`, `tujuan_akhir`, `jumlah_penumpang`, `status`, `total_pembayaran`, `bukti_pembayaran`) VALUES
(14, 2, 3, 'Pasaraya', 'Lubeg', 4, 'Mahasiswa', '20000', 'Pembayaran Berhasil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bus`
--
ALTER TABLE `tb_bus`
  ADD PRIMARY KEY (`kode_bus`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bus`
--
ALTER TABLE `tb_bus`
  MODIFY `kode_bus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  MODIFY `id_pemesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
