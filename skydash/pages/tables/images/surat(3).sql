-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2023 at 05:33 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `id_arsip` int(5) NOT NULL,
  `id_surat` int(5) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `ket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`id_arsip`, `id_surat`, `tanggal`, `ket`) VALUES
(4, 1, '2023-07-11 17:00:00', '11 halaman'),
(6, 4, '2023-07-12 17:00:00', '12 halaman lebih'),
(7, 5, '2023-07-12 17:00:00', '12 halaman');

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `id_disposisi` int(5) NOT NULL,
  `id_surat` int(5) NOT NULL,
  `isi` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`id_disposisi`, `id_surat`, `isi`, `tanggal`) VALUES
(1, 1, 'Segera tindak lanjuti', '2023-07-11 17:00:00'),
(3, 4, 'Segera tindak lanjuti segera ya', '2023-07-12 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Surat Permohonan'),
(2, 'Surat Keputusan'),
(3, 'Surat Kuasa'),
(4, 'Surat Perintah'),
(5, 'Surat Tugas'),
(6, 'Surat Pengantar'),
(7, 'Surat Undangan'),
(8, 'Surat Edaran');

-- --------------------------------------------------------

--
-- Table structure for table `lampiran`
--

CREATE TABLE `lampiran` (
  `id_lampiran` int(5) NOT NULL,
  `id_surat` int(5) NOT NULL,
  `deskripsi_lampiran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lampiran`
--

INSERT INTO `lampiran` (`id_lampiran`, `id_surat`, `deskripsi_lampiran`) VALUES
(1, 1, 'Jadwal Piket'),
(2, 1, 'Jadwal Libur Hari Raya'),
(12, 1, 'Jadwal Harian'),
(17, 3, 'Jadwal Harian');

-- --------------------------------------------------------

--
-- Table structure for table `penerima`
--

CREATE TABLE `penerima` (
  `id_penerima` int(5) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerima`
--

INSERT INTO `penerima` (`id_penerima`, `nama_penerima`, `jabatan`, `alamat`) VALUES
(1, 'Anik Zulaika', 'Sekretaris', 'Kota Kediri'),
(2, 'Erlita', 'Sekretaris', 'Kota Kediri');

-- --------------------------------------------------------

--
-- Table structure for table `pengirim`
--

CREATE TABLE `pengirim` (
  `id_pengirim` int(5) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengirim`
--

INSERT INTO `pengirim` (`id_pengirim`, `nama_pengirim`, `jabatan`, `alamat`) VALUES
(1, 'Danang Surono', 'Kepala Desa', 'Kab Nganjuk');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(5) NOT NULL,
  `nomor_surat` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_pengirim` int(5) NOT NULL,
  `id_penerima` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id_surat`, `nomor_surat`, `tanggal`, `keterangan`, `id_pengirim`, `id_penerima`, `id_kategori`, `foto`) VALUES
(1, '09/D-IV/07/2023', '2023-07-11', 'Surat Perintah Mulai Kerja', 1, 1, 4, ''),
(3, '08/D-IV/07/2023', '2023-07-13', 'Surat Perintah Mulai Kerja Bersama', 1, 1, 2, ''),
(4, '09/D-IV/07/2023', '2023-07-13', 'Surat Perintah Mulai Kerja', 1, 1, 1, ''),
(5, '09/D-IV/07/2023', '2023-07-13', 'Surat', 1, 1, 5, NULL),
(6, '09/D-IV/07/2023', '2023-07-13', 'Surat Edaran Kemenkes', 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`) VALUES
(1, 'ardha@gmail.com', 123456);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id_arsip`),
  ADD KEY `fk_surat_arsip` (`id_surat`);

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`id_disposisi`),
  ADD KEY `fk_surat_disposisi` (`id_surat`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD PRIMARY KEY (`id_lampiran`),
  ADD KEY `fk_surat` (`id_surat`);

--
-- Indexes for table `penerima`
--
ALTER TABLE `penerima`
  ADD PRIMARY KEY (`id_penerima`);

--
-- Indexes for table `pengirim`
--
ALTER TABLE `pengirim`
  ADD PRIMARY KEY (`id_pengirim`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`),
  ADD KEY `fk_kategori` (`id_kategori`),
  ADD KEY `fk_pengirim` (`id_pengirim`),
  ADD KEY `fk_penerima` (`id_penerima`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id_arsip` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `id_disposisi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lampiran`
--
ALTER TABLE `lampiran`
  MODIFY `id_lampiran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penerima`
--
ALTER TABLE `penerima`
  MODIFY `id_penerima` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengirim`
--
ALTER TABLE `pengirim`
  MODIFY `id_pengirim` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `fk_surat_arsip` FOREIGN KEY (`id_surat`) REFERENCES `surat` (`id_surat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD CONSTRAINT `fk_surat_disposisi` FOREIGN KEY (`id_surat`) REFERENCES `surat` (`id_surat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lampiran`
--
ALTER TABLE `lampiran`
  ADD CONSTRAINT `fk_surat` FOREIGN KEY (`id_surat`) REFERENCES `surat` (`id_surat`);

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `fk_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_penerima` FOREIGN KEY (`id_penerima`) REFERENCES `penerima` (`id_penerima`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengirim` FOREIGN KEY (`id_pengirim`) REFERENCES `pengirim` (`id_pengirim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
