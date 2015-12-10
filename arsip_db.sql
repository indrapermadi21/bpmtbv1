-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2015 at 09:18 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `arsip_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE IF NOT EXISTS `surat_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_agenda` varchar(30) DEFAULT NULL,
  `no_surat_masuk` varchar(30) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `pengirim` varchar(100) DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `perihal` text,
  `lampiran` varchar(10) DEFAULT NULL,
  `no_agenda_keluar` varchar(30) DEFAULT NULL,
  `no_surat_keluar` varchar(30) DEFAULT NULL,
  `catatan` text,
  `ringkasan_surat` text,
  `status` varchar(30) DEFAULT NULL,
  `tgl_status` date DEFAULT NULL,
  `klasifikasi_surat` varchar(10) DEFAULT NULL,
  `derajat_surat` varchar(10) DEFAULT NULL,
  `jenis_surat` varchar(10) DEFAULT NULL,
  `asal_surat` varchar(10) DEFAULT NULL,
  `rak_surat` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `no_agenda`, `no_surat_masuk`, `tgl_surat`, `pengirim`, `tujuan`, `perihal`, `lampiran`, `no_agenda_keluar`, `no_surat_keluar`, `catatan`, `ringkasan_surat`, `status`, `tgl_status`, `klasifikasi_surat`, `derajat_surat`, `jenis_surat`, `asal_surat`, `rak_surat`) VALUES
(1, '0001', '10001', '2015-06-27', 'indra', 'joko', 'pencarian mata uang', '2', '-', '-', 'catatan tidak penting', NULL, 'disetujui', '2015-06-27', '01', '02', '03', '04', '05'),
(2, '0002', '10002', '2015-06-26', 'per', 'joki', 'pasdpasijd', '1', '-', '-', 'catatan', NULL, 'disetujui', '2015-06-27', '05', '04', '03', '02', '01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
