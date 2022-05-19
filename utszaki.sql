-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2022 at 07:15 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utszaki`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_panitia`
--

CREATE TABLE `tb_panitia` (
  `id_panitia` int(20) NOT NULL,
  `nama_panitia` text NOT NULL,
  `alamat_panitia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_panitia`
--

INSERT INTO `tb_panitia` (`id_panitia`, `nama_panitia`, `alamat_panitia`) VALUES
(1, 'Ridwan Syahjawi Spsi.', 'JL. Rukun No. 15'),
(2, 'Khairil Ramlu LC. MA.', 'Jl. Speksi No.11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemberi`
--

CREATE TABLE `tb_pemberi` (
  `id_pemberi` int(20) NOT NULL,
  `panitia_pemberi` text NOT NULL,
  `nama_pemberi` text NOT NULL,
  `alamat_pemberi` text NOT NULL,
  `type_pemberi` text NOT NULL,
  `beras_pemberi` text NOT NULL,
  `uang_pemberi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pemberi`
--

INSERT INTO `tb_pemberi` (`id_pemberi`, `panitia_pemberi`, `nama_pemberi`, `alamat_pemberi`, `type_pemberi`, `beras_pemberi`, `uang_pemberi`) VALUES
(1, '2', 'Muhammad Imbalo Zaki Hasibuan', 'JL.Gaperta No.19', 'Zakat Mal', '25', ''),
(2, '1', 'Maulana Sutan', 'JL. Rukun No. 15', 'Zakat Fitrah', '', '154000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penerima`
--

CREATE TABLE `tb_penerima` (
  `id_penerima` int(20) NOT NULL,
  `nama_penerima` text NOT NULL,
  `alamat_penerima` text NOT NULL,
  `status_penerima` text NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penerima`
--

INSERT INTO `tb_penerima` (`id_penerima`, `nama_penerima`, `alamat_penerima`, `status_penerima`) VALUES
(1, 'Jaka Permana', 'Jl. Speksi No.11', '0'),
(2, 'Anggreini', 'JL. Rukun No. 15', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_panitia`
--
ALTER TABLE `tb_panitia`
  ADD PRIMARY KEY (`id_panitia`);

--
-- Indexes for table `tb_pemberi`
--
ALTER TABLE `tb_pemberi`
  ADD PRIMARY KEY (`id_pemberi`);

--
-- Indexes for table `tb_penerima`
--
ALTER TABLE `tb_penerima`
  ADD PRIMARY KEY (`id_penerima`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_panitia`
--
ALTER TABLE `tb_panitia`
  MODIFY `id_panitia` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pemberi`
--
ALTER TABLE `tb_pemberi`
  MODIFY `id_pemberi` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_penerima`
--
ALTER TABLE `tb_penerima`
  MODIFY `id_penerima` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
