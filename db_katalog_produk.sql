-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2024 at 02:11 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_katalog_produk`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `kategori_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori_name`) VALUES
(14, 'Smartphone'),
(15, 'Laptop'),
(16, 'Smartband'),
(17, 'Headphone'),
(18, 'Konsol Game'),
(19, 'Kamera'),
(20, 'Televisi'),
(21, 'Tablet'),
(22, 'Speaker'),
(23, 'Vacuum Cleaner'),
(24, 'Smartwatch'),
(25, 'Laptop Gaming'),
(26, 'Kamera Aksi');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `kategori_id` int NOT NULL,
  `produk_nama` varchar(100) NOT NULL,
  `produk_harga` int NOT NULL,
  `produk_deksripsi` text NOT NULL,
  `produk_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `produk_nama`, `produk_harga`, `produk_deksripsi`, `produk_image`) VALUES
(31, 14, 'Samsung Galaxy S21', 11000000, ' Smartphone dengan layar 6.2 inci, prosesor Exynos 2100, RAM 8GB, memori internal 128GB, dan kamera belakang triple 64MP.', 'produk1717243674.jpeg'),
(32, 15, 'Apple MacBook Air M1', 16000000, ' Laptop tipis dan ringan dengan prosesor Apple M1, RAM 8GB, SSD 256GB, dan layar Retina 13.3 inci.', 'produk1717243691.jpg'),
(33, 16, 'Xiaomi Mi Band 6', 500000, ' Smartband dengan layar AMOLED 1.56 inci, 30 mode olahraga, dan sensor detak jantung.', 'produk1717243707.jpeg'),
(34, 17, 'Sony WH-1000XM4', 4000000, '  Headphone nirkabel dengan fitur noise cancelling, baterai tahan hingga 30 jam, dan kualitas suara Hi-Res.', 'produk1717243875.jpg'),
(35, 18, 'Nintendo Switch', 5500000, '   Konsol game hybrid yang bisa digunakan sebagai konsol rumahan atau handheld dengan layar 6.2 inci.', 'produk1717243963.jpeg'),
(36, 19, 'Canon EOS M50', 9000000, ' Kamera mirrorless dengan sensor APS-C 24.1MP, perekaman video 4K, dan layar sentuh vari-angle.', 'produk1717243978.jpg'),
(37, 20, 'Samsung QLED TV 55Q80T', 13000000, '  Televisi QLED 55 inci dengan resolusi 4K UHD, fitur Smart TV, dan Quantum Processor 4K.', 'produk1717244895.jpg'),
(38, 21, 'Apple iPad Pro 11', 14000000, ' Tablet dengan layar Liquid Retina 11 inci, prosesor A12Z Bionic, dan dukungan Apple Pencil generasi kedua.', 'produk1717244780.jpg'),
(39, 22, 'Bose SoundLink Revolve+', 4500000, ' Speaker Bluetooth portabel dengan suara 360 derajat, tahan air, dan baterai hingga 16 jam.', 'produk1717244769.jpeg'),
(40, 23, 'Dyson V11 Absolute', 10000000, '  Vacuum cleaner nirkabel dengan daya hisap kuat, layar LCD, dan waktu operasi hingga 60 menit.', 'produk1717244951.jpeg'),
(41, 24, 'Garmin Fenix 6', 12000000, ' Smartwatch multisport dengan GPS, peta TOPO, dan fitur kesehatan lengkap.', 'produk1717244737.jpg'),
(42, 25, 'Lenovo Legion 5', 15000000, ' Laptop gaming dengan layar 15.6 inci, prosesor AMD Ryzen 7, GPU NVIDIA GeForce GTX 1660 Ti, dan RAM 16GB.', 'produk1717244722.jpg'),
(43, 26, 'GoPro Hero 9 Black', 7000000, ' Kamera aksi dengan perekaman video 5K, layar depan berwarna, dan stabilisasi HyperSmooth 3.0.', 'produk1717244680.jpg'),
(44, 24, 'Fitbit Versa 3', 3500000, ' Smartwatch dengan fitur GPS, detak jantung 24/7, dan pelacakan aktivitas sepanjang hari.', 'produk1717244663.jpg'),
(45, 22, 'JBL Charge 4', 2000000, ' Speaker Bluetooth portabel dengan suara bertenaga, tahan air IPX7, dan baterai hingga 20 jam.', 'produk1717244644.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nomer_hp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `level` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `nomer_hp`, `email`, `alamat`, `level`) VALUES
(1, 'Mauby Purnama Aprilianto', 'Admin', '25f9e794323b453885f5181f1b624d0b', '085876951232', 'maubypurnama010407@gmail.com', 'Jl.Bale Desa Dusun Cimanggeng II Rt.02 Rw.01 Kecamatan Dayeuhluhur', 1),
(4, 'Moch Ripan  Ardiansyah', 'Ripan123', '25f9e794323b453885f5181f1b624d0b', '089523545324', 'ripan@gmail.com', 'Jl. Kerta Sasmita', 2),
(5, 'Pribadi Ramadhan', 'prabusemar', '25f9e794323b453885f5181f1b624d0b', '085876951232', 'pribadiramadhan@gmail.com', 'Sindang Kasih', 2),
(8, 'lorem', 'lorem123', 'e10adc3949ba59abbe56e057f20f883e', '', 'lorem@gmail.com', '', 2),
(9, 'Syehan', 'hans', 'e10adc3949ba59abbe56e057f20f883e', '0859283948', 'hans@gmail.com', 'Sumanding , Banjar', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
