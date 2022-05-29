-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 12:56 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_hotel`
--

CREATE TABLE `fasilitas_hotel` (
  `id_fasilitashotel` int(11) NOT NULL,
  `nama_fasilitas_hotel` varchar(200) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `deskripsi` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas_hotel`
--

INSERT INTO `fasilitas_hotel` (`id_fasilitashotel`, `nama_fasilitas_hotel`, `foto`, `deskripsi`) VALUES
(21, 'Deluxe Room', 'Fitnes Center_1.jpg', 'Tempat Fitness'),
(22, 'Junior Suite Room', 'Fasilitas hotel.jpg', 'Kolam Renang'),
(23, 'Deluxe Room', 'restoran.jpg', 'restoran '),
(24, 'Presidential Suite', 'kamar mandi.png', 'Kamar Mandi Mewah'),
(25, 'Presidential Suite', 'restoran.jpeg', 'Restoan luas'),
(26, 'Junior Suite Room', 'Fitness-hotel.jpg', 'Fitnes');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kamar`
--

CREATE TABLE `fasilitas_kamar` (
  `id_fasilitaskamar` int(11) NOT NULL,
  `nama_fasilitas` varchar(200) NOT NULL,
  `tipe_kamar` varchar(200) NOT NULL,
  `id_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fasilitas_kamar`
--

INSERT INTO `fasilitas_kamar` (`id_fasilitaskamar`, `nama_fasilitas`, `tipe_kamar`, `id_kamar`) VALUES
(45, 'kasur 1, free wifi, televisi', 'Deluxe Room', 21),
(46, 'free wifi, kamar mandi, kasur 2, televisi', 'Presindetial Suite', 22);

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` varchar(100) NOT NULL,
  `type_kamar` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `no_kamar`, `type_kamar`, `harga`, `deskripsi`, `foto`) VALUES
(21, '01', 'Deluxe Room', 400000, 'Meja,kasur 1, lampu tidur,kamar mandi', 'Deluxe Room_2.jpg'),
(27, '02', 'Presidential Suite Room', 450000, 'kursi santai dan meja, kamar luar, kasur 1, kamar mandi', 'Presidential Room_1.jpg'),
(29, '03', 'Standar Room', 300000, 'fre tv,wifi, kasur 1, meja, kamar mandi', 'Standard-Room.jpg'),
(30, '04', 'Junior Suite Room', 350000, 'fre wifi, meja dan kursi, lampu tidur', 'Junior Suite room.jpg'),
(31, '05', 'delux room', 0, 'lemari,bagus', 'Deluxe_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_tlp` char(15) NOT NULL,
  `alamat` text NOT NULL,
  `level` enum('admin','resepsionis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_user`, `nama`, `username`, `password`, `no_tlp`, `alamat`, `level`) VALUES
(1, 'ani', 'admin', '202cb962ac59075b964b07152d234b70', '083149064513', 'kuningan', 'admin'),
(2, 'resepsionis', 'resepsionis', '202cb962ac59075b964b07152d234b70', '083149064511', 'kuningan', 'resepsionis'),
(1920, 'nova', 'nova', '202cb962ac59075b964b07152d234b70', '083149064512', 'bayuning', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `nama_tamu` varchar(200) NOT NULL,
  `tgl_cek_in` date NOT NULL,
  `tgl_cek_out` date NOT NULL,
  `jumlah_kamar` int(10) NOT NULL,
  `total` int(15) NOT NULL,
  `status` enum('proses','cek in','cek out') NOT NULL,
  `nama_pemesan` varchar(128) NOT NULL,
  `telepon` int(12) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `id_kamar`, `nama_tamu`, `tgl_cek_in`, `tgl_cek_out`, `jumlah_kamar`, `total`, `status`, `nama_pemesan`, `telepon`, `email`) VALUES
(96, 27, 'nachla', '2022-05-21', '2022-05-23', 1, 0, 'proses', 'nova triliana sukma', 2147483647, 'novatriliana44@gmail.com'),
(97, 21, 'nadia', '2022-05-24', '2022-05-25', 1, 0, 'proses', 'elsa ', 812346, 'elsa@gmail.com'),
(98, 29, 'nayla', '2022-05-22', '2022-05-23', 2, 0, 'proses', 'putri', 2147483647, 'putri@gmail.com'),
(99, 30, 'lucinta, putri', '2022-05-25', '2022-05-27', 2, 0, 'proses', 'novita', 812346, 'novita@gmail.com'),
(100, 21, 'novi', '2022-05-23', '2022-05-24', 1, 0, 'proses', 'asih', 81234674, 'asih@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tamu`
--

CREATE TABLE `tamu` (
  `nik` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `no_telp` char(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fasilitas_hotel`
--
ALTER TABLE `fasilitas_hotel`
  ADD PRIMARY KEY (`id_fasilitashotel`);

--
-- Indexes for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  ADD PRIMARY KEY (`id_fasilitaskamar`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fasilitas_hotel`
--
ALTER TABLE `fasilitas_hotel`
  MODIFY `id_fasilitashotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `fasilitas_kamar`
--
ALTER TABLE `fasilitas_kamar`
  MODIFY `id_fasilitaskamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
