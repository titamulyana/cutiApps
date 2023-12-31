-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 05, 2023 at 05:20 AM
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
-- Database: `db_cuti`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_cuti`
--

CREATE TABLE `tb_cuti` (
  `id` int NOT NULL,
  `nik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_cuti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `lama` int NOT NULL,
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `depApproval` tinyint(1) DEFAULT NULL,
  `depApproval_at` timestamp NULL DEFAULT NULL,
  `sdmApproval` tinyint(1) DEFAULT NULL,
  `sdmApproval_at` timestamp NULL DEFAULT NULL,
  `soft_delete` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_cuti`
--

INSERT INTO `tb_cuti` (`id`, `nik`, `jenis_cuti`, `mulai`, `selesai`, `lama`, `alasan`, `depApproval`, `depApproval_at`, `sdmApproval`, `sdmApproval_at`, `soft_delete`, `created_at`, `updated_at`) VALUES
(15, '62023001', 'hak_cuti_tahunan', '2023-08-30', '2023-08-31', 2, 'test', 1, NULL, 1, '2023-08-05 05:11:50', NULL, '2023-08-05 04:45:37', '2023-08-05 05:11:50');

-- --------------------------------------------------------

--
-- Table structure for table `tb_departemen`
--

CREATE TABLE `tb_departemen` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_departemen`
--

INSERT INTO `tb_departemen` (`id`, `nama`) VALUES
(2, 'finance'),
(1, 'hrd');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id`, `nama`) VALUES
(2, 'dephead'),
(3, 'manager'),
(5, 'pegawai'),
(1, 'sdm'),
(4, 'supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jeniscuti`
--

CREATE TABLE `tb_jeniscuti` (
  `id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_jeniscuti`
--

INSERT INTO `tb_jeniscuti` (`id`, `nama`, `deskripsi`) VALUES
(1, 'hak_cuti_tahunan', 'untuk pekerja yang sudah bekerja selama setahun'),
(2, 'cuti_hamil', 'untuk pekerjawa wanita yang sedang melahirkan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `nik` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_kry` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hak_akses` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tmpt_lahir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hak_cuti_tahunan` int NOT NULL,
  `cuti_hamil` int NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `departemen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_masuk` date NOT NULL,
  `soft_delete` tinyint(1) NOT NULL DEFAULT '0',
  `id_atas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `approval` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`nik`, `username`, `password`, `nama_kry`, `jk`, `jabatan`, `hak_akses`, `tmpt_lahir`, `tgl_lahir`, `agama`, `status`, `telp`, `alamat`, `hak_cuti_tahunan`, `cuti_hamil`, `email`, `departemen`, `tgl_masuk`, `soft_delete`, `id_atas`, `approval`) VALUES
('1111', 'fffdsa', '123', 'ffff', 'laki-laki', 'dephead', 'karyawan', 'jakarta', '2023-08-03', 'Islam', 'single', '999', 'kkkf', 0, 0, 't@gmail.com', 'hrd', '2023-08-04', 1, '62023001', 0),
('62023001', 'staf', '123', 'Budi Prasangka', 'laki-laki', 'staff', 'karyawan', 'kalimantan', '1997-01-01', 'Protestan', 'single', '08233456789', 'Jl. Kiri Kanan', 12, 0, 'staf@gmail.com', 'finance', '2021-12-06', 0, '82023001', 0),
('62023002', 'dsad', '123', 'dsad', 'perempuan', 'manager', 'hrd', 'ambon', '1899-12-15', 'Islam', 'single', '8329183219301', 'das', 12, 0, 'septiandensi131@gmail.com', 'hrd', '2023-08-30', 0, '62023001', 0),
('72023001', 'hrd', '123', 'Adni Malarangeng', 'laki-laki', 'hrd', 'hrd', 'papua', '1995-01-01', 'islam', 'single', '08123456789', 'Jl. SImpang Siur', 12, 0, 'hrd@gmail.com', 'HRD', '2021-12-19', 0, NULL, 0),
('82023001', 'headfinance', '123', 'Jaka Buntung ', 'laki-laki', 'head', 'karyawan', 'papua', '1996-01-01', 'islam', 'single', '08223456789', 'Jl. Mundur Maju', 12, 0, 'headfinanance@gmail.com', 'finance', '2021-12-27', 0, NULL, 0),
('82023002', 'dsadas', '123', 'Adsa', 'perempuan', 'manager', 'karyawan', 'dsad', '1899-12-03', 'Islam', 'single', '321893218', 'dsadas', 12, 0, 'dsadasdas@gmail.com', 'finance', '2023-08-11', 0, '62023001', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`);

--
-- Indexes for table `tb_departemen`
--
ALTER TABLE `tb_departemen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `tb_jeniscuti`
--
ALTER TABLE `tb_jeniscuti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `username` (`username`,`telp`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_departemen`
--
ALTER TABLE `tb_departemen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_jeniscuti`
--
ALTER TABLE `tb_jeniscuti`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_cuti`
--
ALTER TABLE `tb_cuti`
  ADD CONSTRAINT `tb_cuti_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `tb_users` (`nik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
