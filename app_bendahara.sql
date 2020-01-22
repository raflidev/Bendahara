-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2020 at 03:07 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_bendahara`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `hapus_grup` (IN `idgrup` INT)  DELETE FROM grup where grup.id_grup = idgrup$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_grup` (IN `nama` VARCHAR(30))  INSERT INTO grup VALUES("",nama)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tampil_transaksi_member` (IN `idmember` INT)  select modul.nama_modul,grup.nama_grup,member.nama_member, transaksi.total_tagihan from transaksi,modul,member,grup where member.id_member = transaksi.id_member and modul.id_modul = transaksi.id_modul and grup.id_grup = modul.id_grup and member.id_member= idmember$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `grup`
--

CREATE TABLE `grup` (
  `id_grup` int(11) NOT NULL,
  `nama_grup` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grup`
--

INSERT INTO `grup` (`id_grup`, `nama_grup`) VALUES
(1, 'RPL 2'),
(3, 'Ibu2 RT 6'),
(4, 'Anak RT 6'),
(6, 'hell'),
(7, 'hell'),
(8, '123'),
(9, '123'),
(10, '1'),
(11, '221'),
(12, 'jujuy'),
(13, 'asd11'),
(14, 'yayan'),
(15, 'baguz'),
(16, 'RPL 3');

--
-- Triggers `grup`
--
DELIMITER $$
CREATE TRIGGER `del_grup` AFTER DELETE ON `grup` FOR EACH ROW insert into log_aktifitas values ("grup dihapus",now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ins_grup` AFTER INSERT ON `grup` FOR EACH ROW insert into log_aktifitas values ("grup ditambah",now())
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upt_grup` AFTER UPDATE ON `grup` FOR EACH ROW insert into log_aktifitas values ("grup diubah",now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_aktifitas`
--

CREATE TABLE `log_aktifitas` (
  `kejadian` varchar(40) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_aktifitas`
--

INSERT INTO `log_aktifitas` (`kejadian`, `waktu`) VALUES
('grup ditambah', '2020-01-09 09:23:06'),
('grup diubah', '2020-01-09 09:23:44'),
('grup dihapus', '2020-01-09 09:23:54'),
('grup diubah', '2020-01-09 10:55:24'),
('grup diubah', '2020-01-09 10:55:49'),
('grup diubah', '2020-01-09 10:55:55'),
('grup diubah', '2020-01-09 10:57:49'),
('grup ditambah', '2020-01-16 20:22:44'),
('grup dihapus', '2020-01-16 20:22:54'),
('grup ditambah', '2020-01-16 20:29:08'),
('grup ditambah', '2020-01-16 20:29:38'),
('grup ditambah', '2020-01-16 20:34:08'),
('grup ditambah', '2020-01-16 20:34:08'),
('grup ditambah', '2020-01-16 20:41:36'),
('grup ditambah', '2020-01-16 20:42:17'),
('transaksi ditambah', '2020-01-17 13:46:20'),
('transaksi ditambah', '2020-01-17 13:48:21'),
('transaksi ditambah', '2020-01-17 14:06:37'),
('transaksi ditambah', '2020-01-17 14:09:37'),
('transaksi ditambah', '2020-01-17 14:17:39'),
('transaksi ditambah', '2020-01-19 22:12:57'),
('grup ditambah', '2020-01-19 22:51:34'),
('grup ditambah', '2020-01-19 22:52:44'),
('grup ditambah', '2020-01-19 22:59:27'),
('transaksi ditambah', '2020-01-19 23:00:36'),
('grup ditambah', '2020-01-20 14:34:56'),
('transaksi ditambah', '2020-01-20 14:37:23'),
('grup ditambah', '2020-01-20 15:32:05'),
('transaksi ditambah', '2020-01-20 15:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `id_grup` int(11) NOT NULL,
  `nama_member` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `id_grup`, `nama_member`) VALUES
(1, 1, 'Naufal'),
(2, 1, 'Sujudi'),
(3, 1, 'Rendy'),
(4, 1, 'Ibnu'),
(5, 1, 'Reynaldi'),
(6, 3, 'bu Eka'),
(7, 3, 'bu Soleh'),
(8, 3, 'Bu Ali'),
(9, 4, 'Raka'),
(10, 4, 'Gilang'),
(11, 4, 'Rofi'),
(12, 4, 'Fajar'),
(13, 1, 'Endang'),
(14, 1, 'Juan'),
(15, 13, 'asd'),
(16, 14, 'dodo'),
(17, 14, 'embem'),
(18, 14, 'yanti'),
(19, 15, 'yaya'),
(20, 15, 'mimi'),
(21, 15, 'lulu'),
(22, 15, 'nunu'),
(23, 16, 'Aldi'),
(24, 16, 'Rafli'),
(25, 16, 'Tegar');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(11) NOT NULL,
  `nama_modul` varchar(50) NOT NULL,
  `id_grup` int(11) DEFAULT NULL,
  `waktu` varchar(10) NOT NULL,
  `tagihan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nama_modul`, `id_grup`, `waktu`, `tagihan`) VALUES
(1, 'Kas Kelas', 1, 'Mingguan', 2000),
(2, 'Arisan', 3, 'MIngguan', 5000),
(3, 'Trip Gunung', 4, 'Harian', 2000),
(8, 'Uang Kegiatan', 16, 'Mingguan', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `nominal`, `deskripsi`) VALUES
(1, 0, ''),
(2, 0, ''),
(3, 0, '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_transaksi`
-- (See below for the actual view)
--
CREATE TABLE `tampil_transaksi` (
`id_transaksi` int(11)
,`nama_grup` varchar(50)
,`nama_member` varchar(40)
,`total_tagihan` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `total_tagihan` int(11) NOT NULL,
  `id_pengeluaran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_modul`, `id_member`, `total_tagihan`, `id_pengeluaran`) VALUES
(1, 2, 8, 5000, 1),
(2, 1, 2, 2000, 2),
(3, 3, 9, 2000, 3),
(4, 1, 1, 3000, NULL),
(5, 1, 1, 3000, NULL),
(6, 1, 1, 2000, NULL),
(7, 1, 3, 2000, NULL),
(8, 3, 10, 2000, NULL),
(9, 1, 14, 2000, NULL),
(12, 8, 23, 10000, NULL);

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `ins_transaksi` AFTER INSERT ON `transaksi` FOR EACH ROW insert into log_aktifitas values ("transaksi ditambah",now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewmember1`
-- (See below for the actual view)
--
CREATE TABLE `viewmember1` (
`id_grup` int(11)
,`nama_member` varchar(40)
);

-- --------------------------------------------------------

--
-- Structure for view `tampil_transaksi`
--
DROP TABLE IF EXISTS `tampil_transaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_transaksi`  AS  select `transaksi`.`id_transaksi` AS `id_transaksi`,`grup`.`nama_grup` AS `nama_grup`,`member`.`nama_member` AS `nama_member`,`transaksi`.`total_tagihan` AS `total_tagihan` from ((`transaksi` join `member` on((`transaksi`.`id_member` = `member`.`id_member`))) join `grup` on((`member`.`id_grup` = `grup`.`id_grup`))) ;

-- --------------------------------------------------------

--
-- Structure for view `viewmember1`
--
DROP TABLE IF EXISTS `viewmember1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewmember1`  AS  select `member`.`id_grup` AS `id_grup`,`member`.`nama_member` AS `nama_member` from `member` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grup`
--
ALTER TABLE `grup`
  ADD PRIMARY KEY (`id_grup`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`),
  ADD KEY `id_grup` (`id_grup`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`),
  ADD KEY `id_grup` (`id_grup`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_modul` (`id_modul`,`id_pengeluaran`),
  ADD KEY `id_pengeluaran` (`id_pengeluaran`),
  ADD KEY `id_member` (`id_member`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grup`
--
ALTER TABLE `grup`
  MODIFY `id_grup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`id_grup`);

--
-- Constraints for table `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `modul_ibfk_1` FOREIGN KEY (`id_grup`) REFERENCES `grup` (`id_grup`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pengeluaran`) REFERENCES `pengeluaran` (`id_pengeluaran`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id_modul`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
