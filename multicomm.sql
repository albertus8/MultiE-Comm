-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2017 at 09:11 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `multicomm`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `ID_BARANG` varchar(14) NOT NULL,
  `ID_user` varchar(13) NOT NULL,
  `NAMA_BARANG` varchar(64) NOT NULL,
  `JENIS_BARANG` varchar(64) NOT NULL,
  `QUANTITY_BARANG` int(4) NOT NULL,
  `HARGA_PER_SATUAN_BARANG` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `ID_user`, `NAMA_BARANG`, `JENIS_BARANG`, `QUANTITY_BARANG`, `HARGA_PER_SATUAN_BARANG`) VALUES
('BC070217000001', 'EC101216AL001', 'Xiaomi Redmi Note 3', 'Smartphone', 10, 2500000);

-- --------------------------------------------------------

--
-- Table structure for table `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `ID_DPENJUALAN` varchar(14) NOT NULL,
  `ID_user` varchar(13) NOT NULL,
  `TGL_BELI` date NOT NULL,
  `TOTAL_PENJUALAN` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_penjualan`
--

INSERT INTO `data_penjualan` (`ID_DPENJUALAN`, `ID_user`, `TGL_BELI`, `TOTAL_PENJUALAN`) VALUES
('ECDP070217001', 'EC101216AL001', '2017-02-07', 2500000),
('ECDP080217001', 'EC101216AL001', '2017-02-08', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi`
--

CREATE TABLE `data_transaksi` (
  `ID_TRANSAKSI` varchar(14) NOT NULL,
  `ID_PAKET` varchar(6) NOT NULL,
  `TGL_BERLANGGANAN` date NOT NULL,
  `ID_user` varchar(13) NOT NULL,
  `NAMA_PAKET` varchar(64) NOT NULL,
  `HARGA_PAKET` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_transaksi`
--

INSERT INTO `data_transaksi` (`ID_TRANSAKSI`, `ID_PAKET`, `TGL_BERLANGGANAN`, `ID_user`, `NAMA_PAKET`, `HARGA_PAKET`) VALUES
('ECTR0708170001', 'ECP001', '2017-02-07', 'EC101216AL001', 'Premium', 150000);

-- --------------------------------------------------------

--
-- Table structure for table `d_data_penjualan`
--

CREATE TABLE `d_data_penjualan` (
  `ID_DPENJUALAN` varchar(14) NOT NULL,
  `ID_BARANG` varchar(14) NOT NULL,
  `NAMA_BARANG` varchar(64) NOT NULL,
  `JENIS_BARANG` varchar(64) NOT NULL,
  `QUANTITY_BARANG` int(4) NOT NULL,
  `HARGA_PER_SATUAN_BARANG` int(9) NOT NULL,
  `SUBTOTAL_PER_BARANG` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_data_penjualan`
--

INSERT INTO `d_data_penjualan` (`ID_DPENJUALAN`, `ID_BARANG`, `NAMA_BARANG`, `JENIS_BARANG`, `QUANTITY_BARANG`, `HARGA_PER_SATUAN_BARANG`, `SUBTOTAL_PER_BARANG`) VALUES
('ECDP070217001', 'BC070217000001', 'Xiaomi Redmi Note 3', 'Smartphone', 1, 2500000, 2500000),
('ECDP080217001', 'BC070217000001', 'Xiaomi Redmi Note 3', 'Smartphone', 2, 2500000, 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `paket_berlangganan`
--

CREATE TABLE `paket_berlangganan` (
  `ID_PAKET` varchar(6) NOT NULL,
  `NAMA_PAKET` varchar(64) NOT NULL,
  `HARGA_PAKET` int(9) NOT NULL,
  `DETAIL_PAKET` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket_berlangganan`
--

INSERT INTO `paket_berlangganan` (`ID_PAKET`, `NAMA_PAKET`, `HARGA_PAKET`, `DETAIL_PAKET`) VALUES
('ECP001', 'Premium', 150000, '');

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE `userlist` (
  `ID_user` varchar(13) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `joindate` datetime NOT NULL,
  `remember_toogle` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`ID_user`, `username`, `password`, `firstname`, `joindate`, `remember_toogle`) VALUES
('EC101216AL001', 'albertus.adhi', '2a447fd732a46a7194aa4ce05dddcddb4420e4698e04d3cc6332e28dd982f948', 'Albertus', '2016-12-15 09:33:38', 0),
('EC151216AL002', 'albertus8', '2a447fd732a46a7194aa4ce05dddcddb4420e4698e04d3cc6332e28dd982f948', 'Albertus', '2016-12-15 09:36:15', 0),
('EC301216ED001', 'whoami', '808d08d56adc44ecd35f4a603f29e2357dadd0cfd477cb6c49b98505d85f5139', 'Eduardo', '2016-12-30 16:27:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID_BARANG`),
  ADD KEY `ID_user` (`ID_user`),
  ADD KEY `ID_user_2` (`ID_user`),
  ADD KEY `ID_user_3` (`ID_user`);

--
-- Indexes for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`ID_DPENJUALAN`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Indexes for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  ADD PRIMARY KEY (`ID_TRANSAKSI`),
  ADD KEY `COMPOSITE_IDs` (`ID_PAKET`,`ID_user`),
  ADD KEY `FK_DATATRANSAKSI_TO_USERLIST` (`ID_user`);

--
-- Indexes for table `d_data_penjualan`
--
ALTER TABLE `d_data_penjualan`
  ADD KEY `COMPOSITE_IDs` (`ID_DPENJUALAN`,`ID_BARANG`),
  ADD KEY `FK_DDATAPENJUALAN_TO_BARANG` (`ID_BARANG`);

--
-- Indexes for table `paket_berlangganan`
--
ALTER TABLE `paket_berlangganan`
  ADD PRIMARY KEY (`ID_PAKET`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`ID_user`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `FK_USERLIST_TO_BARANG` FOREIGN KEY (`ID_user`) REFERENCES `userlist` (`ID_user`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD CONSTRAINT `FK_DATAPENJUALAN_TO_USERLIST` FOREIGN KEY (`ID_user`) REFERENCES `userlist` (`ID_user`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  ADD CONSTRAINT `FK_DATATRANSAKSI_TO_PAKETBERLANGGANAN` FOREIGN KEY (`ID_PAKET`) REFERENCES `paket_berlangganan` (`ID_PAKET`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DATATRANSAKSI_TO_USERLIST` FOREIGN KEY (`ID_user`) REFERENCES `userlist` (`ID_user`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `d_data_penjualan`
--
ALTER TABLE `d_data_penjualan`
  ADD CONSTRAINT `FK_DDATAPENJUALAN_TO_BARANG` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_DDATAPENJUALAN_TO_DATAPENJUALAN` FOREIGN KEY (`ID_DPENJUALAN`) REFERENCES `data_penjualan` (`ID_DPENJUALAN`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
