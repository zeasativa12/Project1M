-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2025 at 09:09 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekamedis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kegunaan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_obat`
--

INSERT INTO `tbl_obat` (`id`, `nama`, `kegunaan`) VALUES
(1, 'Paracetamol', 'Mengurangi demam dan meredakan nyeri ringan hingga sedang'),
(11, 'Amoxilint', 'Mengobati infeksi bakteri seperti infeksi saluran pernapasan dan THT'),
(12, 'Ibuprofen', 'Mengurangi nyeri, peradangan, dan demam'),
(13, 'Cetirizine', 'Meredakan gejala alergi seperti bersin dan gatal-gatal'),
(14, 'Metformin', 'Mengontrol kadar gula darah pada penderita diabetes tipe 2'),
(15, 'Salbutamol', 'Mengatasi asma dan sesak napas'),
(16, 'Ranitidine', 'Mengurangi produksi asam lambung dan mengobati tukak lambung'),
(17, 'Simvastatin', 'Menurunkan kadar kolesterol dalam darah'),
(18, 'Loperamide', 'Mengatasi diare akut maupun kronis'),
(19, 'Omeprazole', 'Mengobati masalah lambung seperti GERD dan tukak lambung');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pasien`
--

CREATE TABLE `tbl_pasien` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` enum('P','W') NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`id`, `nama`, `tgl_lahir`, `gender`, `telpon`, `alamat`) VALUES
('250407053316', 'Budi Santoso', '2004-04-12', 'P', '08123456', 'Bogor'),
('250407053421', 'Sinta', '2002-02-02', 'W', '08654321', 'Cianjur');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekamedis`
--

CREATE TABLE `tbl_rekamedis` (
  `no_rm` varchar(15) NOT NULL,
  `tgl_rm` date NOT NULL,
  `id_pasien` varchar(20) NOT NULL,
  `keluhan` text NOT NULL,
  `id_dokter` int NOT NULL,
  `diagnosa` text NOT NULL,
  `obat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` enum('1','2','3') NOT NULL COMMENT '1=administrator, 2=petugas, 3=dokter',
  `alamat` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `fullname`, `password`, `jabatan`, `alamat`, `gambar`) VALUES
(1, 'Admin', 'Administrator', '$2y$10$xXhMgjGMNS4ftSH/zDYBv.f7QzlEvvmEZfYib.X8SYoxvD5Dubn.i', '1', 'Bogor', '1742306203-download (8).jpeg'),
(3, 'Wira', 'Wira Sanjaya', '$2y$10$uESNLb03swLHVmhmPAZ.CeShpzPxbrSu3.Mo70gqLkslg5HBG9DyS', '3', 'Jambi', '1742868287-𝙿𝚒𝚗_𝙱𝚢 ~ ༺𝓟𝓲𝓪𝓷𝓸𝓲𝓷𝓰༻.jpeg'),
(4, 'Zea', 'Zea Sativa', '$2y$10$ZfTWzGNmB5BPkdVYWAtKduAHgdNiXPJ.6Tddz/RRr.1Tm71FsxG0e', '2', 'Bandung', '1742868180-download (9).jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rekamedis`
--
ALTER TABLE `tbl_rekamedis`
  ADD PRIMARY KEY (`no_rm`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_rekamedis`
--
ALTER TABLE `tbl_rekamedis`
  ADD CONSTRAINT `tbl_rekamedis_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tbl_pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_rekamedis_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `tbl_user` (`userid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
