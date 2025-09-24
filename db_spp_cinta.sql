-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2025 at 01:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp_cinta`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(5) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `kompetensi_keahlian` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`) VALUES
('KS01', 'XII', 'RPL');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `nisn` varchar(10) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `tgl_pembayaran` date DEFAULT NULL,
  `bulan_tagihan` varchar(20) NOT NULL,
  `tahun_tagihan` int(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `no_bayar` varchar(20) DEFAULT NULL,
  `keterangan` varchar(20) NOT NULL DEFAULT 'Ditangguhkan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `nisn`, `id_petugas`, `tgl_pembayaran`, `bulan_tagihan`, `tahun_tagihan`, `id_spp`, `jumlah_bayar`, `no_bayar`, `keterangan`) VALUES
(61, '00001', NULL, NULL, 'Juli', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(62, '00001', NULL, NULL, 'Agustus', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(63, '00001', NULL, NULL, 'September', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(64, '00001', NULL, NULL, 'Oktober', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(65, '00001', NULL, NULL, 'Nopember', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(66, '00001', NULL, NULL, 'Desember', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(67, '00001', NULL, NULL, 'Januari', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(68, '00001', NULL, NULL, 'Februari', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(69, '00001', NULL, NULL, 'Maret', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(70, '00001', NULL, NULL, 'April', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(71, '00001', NULL, NULL, 'Mei', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(72, '00001', NULL, NULL, 'Juni', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(73, '1234', 0, '2025-09-24', 'Juli', 2025, 0, NULL, '2509240001', 'LUNAS'),
(74, '1234', NULL, NULL, 'Agustus', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(75, '1234', NULL, NULL, 'September', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(76, '1234', NULL, NULL, 'Oktober', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(77, '1234', NULL, NULL, 'Nopember', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(78, '1234', NULL, NULL, 'Desember', 2025, 0, NULL, NULL, 'Ditangguhkan'),
(79, '1234', NULL, NULL, 'Januari', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(80, '1234', NULL, NULL, 'Februari', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(81, '1234', NULL, NULL, 'Maret', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(82, '1234', NULL, NULL, 'April', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(83, '1234', NULL, NULL, 'Mei', 2026, 0, NULL, NULL, 'Ditangguhkan'),
(84, '1234', NULL, NULL, 'Juni', 2026, 0, NULL, NULL, 'Ditangguhkan');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` varchar(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `level` enum('admin','petugas','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`) VALUES
('A01', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'sasa', 'admin'),
('A02', 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Budi', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` varchar(10) NOT NULL,
  `nis` varchar(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `id_kelas` varchar(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `id_spp` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_telp`, `id_spp`) VALUES
('1234', '4545', 'Shirone', 'KS01', 'Akademi Alphnes', '08162543242', 'SPP1');

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id_spp` varchar(5) NOT NULL,
  `tahun` int(4) NOT NULL,
  `nominal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id_spp`, `tahun`, `nominal`) VALUES
('SP02', 2025, 5000000),
('SPP1', 2025, 750000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `nisn` (`nisn`,`id_petugas`,`id_spp`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
