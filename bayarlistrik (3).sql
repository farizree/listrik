-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2022 at 01:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bayarlistrik`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `spDayaPelanggan` (IN `daya` INT(20), IN `id_pelanggan` INT(20))  NO SQL
BEGIN
	IF (daya = 0 AND id_pelanggan = 0) THEN
        SELECT p.id_pelanggan, p.nama_pelanggan, p.alamat, p.nomor_kwh, t.id_tarif, t.daya, t.tarifperkwh
        FROM pelanggan p
        LEFT JOIN tarif t
        ON p.id_tarif = t.id_tarif;
    ELSEIF id_pelanggan > 0 THEN
        SELECT p.id_pelanggan, p.nama_pelanggan, p.alamat, p.nomor_kwh, t.id_tarif, t.daya, t.tarifperkwh
        FROM pelanggan p
        LEFT JOIN tarif t
        ON p.id_tarif = t.id_tarif
        WHERE P.id_pelanggan = id_pelanggan;
    ELSE 
    SELECT p.id_pelanggan, p.nama_pelanggan, p.alamat, p.nomor_kwh, t.id_tarif, t.daya, t.tarifperkwh
        FROM pelanggan p
        LEFT JOIN tarif t
        ON p.id_tarif = t.id_tarif
        WHERE t.daya = daya;
    END IF;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `itungan` (`jumlah_meter` INT(30)) RETURNS INT(11) BEGIN
   
    set @kwhusage :=20950;
    set @perkwh = (select tarifperkwh from tarif LIMIT 1);

    set @pembagianpertama = (SELECT @kwhusage / 1000);
    set @pembagiankedua = (SELECT @pembagianpertama * @perkwh);
    SET @jumlahpenggunaan = (SELECT @pembagiankedua * jumlah_meter);
   

    RETURN @jumlahpenggunaan;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `itungkwh` () RETURNS INT(20) UNSIGNED NO SQL
BEGIN
    set @tagihanmeter = (SELECT jumlah_meter from tagihan); 
    set @kwhusage :=20950;
    set @perkwh = (select tarifperkwh from tarif);

    set @pembagianpertama = (SELECT @kwhusage / 1000);
    set @pembagiankedua = (SELECT @pembagianpertama * @perkwh);
    SET @jumlahpenggunaan = (SELECT @pembagiankedua * @tagihanmeter);
   

    RETURN @jumlahpenggunaan;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(20) NOT NULL,
  `nama_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'admin'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nomor_kwh` int(25) NOT NULL,
  `nama_pelanggan` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `id_tarif` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `username`, `password`, `nomor_kwh`, `nama_pelanggan`, `alamat`, `id_tarif`) VALUES
(1, 'mayahw', 'mayahw2', 14045, 'Maya Hermawati', 'Buaran NO 1', 1),
(9, 'fariz', 'fariz', 43332, 'Fariz', 'bOGOR', 2),
(10, 'joko', 'joko', 12345, 'joko', 'bojong', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(20) NOT NULL,
  `id_tagihan` int(20) NOT NULL,
  `id_pelanggan` int(20) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `bulan_bayar` int(15) NOT NULL,
  `biaya_admin` int(10) NOT NULL,
  `total_bayar` int(50) NOT NULL,
  `id_user` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_tagihan`, `id_pelanggan`, `tanggal_pembayaran`, `bulan_bayar`, `biaya_admin`, `total_bayar`, `id_user`) VALUES
(1, 1, 1, '2022-01-22 09:31:41', 145000, 2500, 1452500, 1),
(2, 1, 1, '2022-01-25 00:00:00', 832763, 2500, 835263, 1),
(3, 5, 8, '2022-01-25 00:00:00', 444140, 2500, 446640, 1),
(4, 6, 9, '2022-01-25 00:00:00', 693969, 2500, 696469, 1),
(5, 7, 10, '2022-01-25 00:00:00', 471899, 2500, 474399, 1);

--
-- Triggers `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `trigger_after_pembayaran` AFTER INSERT ON `pembayaran` FOR EACH ROW UPDATE tagihan SET status = "Pembayaran Berhasil"
WHERE id_tagihan = new.id_tagihan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id_penggunaan` int(20) NOT NULL,
  `id_pelanggan` int(20) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `meter_awal` date NOT NULL,
  `meter_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
(1, 1, 1, 2022, '2022-01-01', '2022-01-31'),
(20, 9, 1, 2022, '2022-01-01', '2022-01-26');

--
-- Triggers `penggunaan`
--
DELIMITER $$
CREATE TRIGGER `tagihan_after_penggunaan_insert` AFTER INSERT ON `penggunaan` FOR EACH ROW INSERT INTO tagihan SET
    id_penggunaan = new.id_penggunaan,
    id_pelanggan = new.id_pelanggan, 
    bulan = NEW.bulan, 
    status = 'Menunggu Pembayaran', 
    tahun = NEW.tahun, 
    jumlah_meter = DATEDIFF(NEW.meter_akhir, NEW.meter_awal),
    tagihan_penggunaan = DATEDIFF(NEW.meter_akhir, NEW.meter_awal)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_after_penggunaan_delete` AFTER DELETE ON `penggunaan` FOR EACH ROW DELETE FROM tagihan WHERE id_penggunaan = old.id_penggunaan
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_after_penggunaan_update` AFTER UPDATE ON `penggunaan` FOR EACH ROW UPDATE tagihan SET
    id_pelanggan = new.id_pelanggan, 
    jumlah_meter = DATEDIFF(NEW.meter_akhir, NEW.meter_awal),
    tagihan_penggunaan = DATEDIFF(NEW.meter_akhir, NEW.meter_awal)
    WHERE id_penggunaan = new.id_penggunaan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(20) NOT NULL,
  `id_penggunaan` int(20) NOT NULL,
  `id_pelanggan` int(20) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `jumlah_meter` int(10) NOT NULL,
  `status` varchar(25) NOT NULL,
  `tagihan_penggunaan` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`, `tagihan_penggunaan`) VALUES
(1, 1, 1, 1, 2022, 30, 'Pembayaran Berhasil', 30),
(6, 20, 9, 1, 2022, 25, 'Pembayaran Berhasil', 25);

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(20) NOT NULL,
  `daya` varchar(25) NOT NULL,
  `tarifperkwh` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `daya`, `tarifperkwh`) VALUES
(1, '900', 1325),
(2, '1300', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `id_level` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_admin`, `id_level`) VALUES
(1, 'admin', 'admin', 'Administrator', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_penggunaan`
-- (See below for the actual view)
--
CREATE TABLE `view_penggunaan` (
`id_penggunaan` int(20)
,`id_pelanggan` int(20)
,`bulan` int(2)
,`tahun` int(4)
,`meter_awal` date
,`meter_akhir` date
,`nama_pelanggan` varchar(250)
,`alamat` text
,`nomor_kwh` int(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_tagihan_pelanggan`
-- (See below for the actual view)
--
CREATE TABLE `view_tagihan_pelanggan` (
`id_tagihan` int(20)
,`id_penggunaan` int(20)
,`id_pelanggan` int(20)
,`bulan` int(2)
,`tahun` int(4)
,`jumlah_meter` int(10)
,`status` varchar(25)
,`nama_pelanggan` varchar(250)
,`alamat` text
,`nomor_kwh` int(25)
,`total_tagihan` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `view_penggunaan`
--
DROP TABLE IF EXISTS `view_penggunaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_penggunaan`  AS SELECT `p`.`id_penggunaan` AS `id_penggunaan`, `c`.`id_pelanggan` AS `id_pelanggan`, `p`.`bulan` AS `bulan`, `p`.`tahun` AS `tahun`, `p`.`meter_awal` AS `meter_awal`, `p`.`meter_akhir` AS `meter_akhir`, `c`.`nama_pelanggan` AS `nama_pelanggan`, `c`.`alamat` AS `alamat`, `c`.`nomor_kwh` AS `nomor_kwh` FROM (`penggunaan` `p` left join `pelanggan` `c` on(`p`.`id_pelanggan` = `c`.`id_pelanggan`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_tagihan_pelanggan`
--
DROP TABLE IF EXISTS `view_tagihan_pelanggan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_tagihan_pelanggan`  AS SELECT `t`.`id_tagihan` AS `id_tagihan`, `t`.`id_penggunaan` AS `id_penggunaan`, `t`.`id_pelanggan` AS `id_pelanggan`, `t`.`bulan` AS `bulan`, `t`.`tahun` AS `tahun`, `t`.`jumlah_meter` AS `jumlah_meter`, `t`.`status` AS `status`, `p`.`nama_pelanggan` AS `nama_pelanggan`, `p`.`alamat` AS `alamat`, `p`.`nomor_kwh` AS `nomor_kwh`, `itungan`(`t`.`tagihan_penggunaan`) AS `total_tagihan` FROM (`tagihan` `t` left join `pelanggan` `p` on(`t`.`id_pelanggan` = `p`.`id_pelanggan`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `nomor_kwh` (`nomor_kwh`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id_penggunaan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
