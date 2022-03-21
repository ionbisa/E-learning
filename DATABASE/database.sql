-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2021 at 10:58 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_adm` int(5) NOT NULL,
  `nama_adm` varchar(50) NOT NULL,
  `tmptlahir_adm` varchar(50) NOT NULL,
  `tgllahir_adm` varchar(20) NOT NULL,
  `telp_adm` varchar(15) NOT NULL,
  `jk_adm` varchar(15) NOT NULL,
  `user_adm` varchar(50) NOT NULL,
  `pass_adm` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_adm`, `nama_adm`, `tmptlahir_adm`, `tgllahir_adm`, `telp_adm`, `jk_adm`, `user_adm`, `pass_adm`) VALUES
(1, 'ionbisa', 'Indramayu', '1993-02-22', '085773334309', 'Laki-Laki', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `diskusi`
--

CREATE TABLE `diskusi` (
  `id_diskusi` int(5) NOT NULL,
  `id_tugas` int(5) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `id_user` varchar(20) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diskusi`
--

INSERT INTO `diskusi` (`id_diskusi`, `id_tugas`, `id_kelas`, `id_user`, `nama_user`, `isi`) VALUES
(1, 50, 7, '12345', 'Guru', 'testing'),
(2, 50, 7, '12345', 'kjkjk', 'testing\r\n'),
(3, 51, 7, '11111', 'jjhjhjq', 'Saya guru'),
(4, 51, 8, '11111', 'jjhjhjq', 'Sata guru'),
(5, 51, 8, '89898', 'kkjk', 'asdjaksd'),
(6, 51, 8, '11111', 'jjhjhjq', 'asdasdjka'),
(7, 51, 8, '89898', 'kkjk', 'sdfjksd'),
(9, 53, 9, '12345', 'Sanusih', 'Belajar Algoritma'),
(10, 53, 7, '12345', 'Sanusih', 'Belajar  bangun ruang sisi'),
(11, 54, 7, '01234', 'AGUS WINARDI', 'gfdyr'),
(13, 59, 7, '01234', 'AGUS WINARDI', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `no` int(5) NOT NULL,
  `id_guru` varchar(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tmptlahir` varchar(50) NOT NULL,
  `tgllahir` varchar(20) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `jk_guru` varchar(15) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) NOT NULL,
  `id_adm` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`no`, `id_guru`, `nama`, `tmptlahir`, `tgllahir`, `telp`, `jk_guru`, `password`, `keterangan`, `id_adm`) VALUES
(1, '12345', 'Sanusih', 'Tangerang', '1990-07-17', '0899899989', 'Laki-Laki', '12345', 'Guru Matematika', 1),
(40, '23451', 'Mardika Dien Islami', 'Cirebon', '2018-12-31', '0909', 'Laki-Laki', '23451', 'Guru Bhs Indonesia', 1),
(41, '34512', 'Yuniansih', 'Solo', '2018-02-02', '01203910', 'Laki-Laki', '34512', 'Guru IPA', 1),
(42, '45123', 'Susi Handoyo', 'Bogor', '2018-12-31', '0909', 'Laki-Laki', '45123', 'Guru IPS', 1),
(43, '51234', 'Maman Suhendar', 'Subang', '2018-12-31', '898989', 'Laki-Laki', '51234', 'Guru Pendidikan Agama Islam', 1),
(44, '11234', 'Mawar Ningrum', 'Bogor', '1996-04-01', '0857000000', 'Laki-Laki', '11234', 'Guru Bhs Inggris', 1),
(45, '65123', 'Bagus Arya', 'Indramayu', '1990-02-01', '085773334309', 'Laki-Laki', '01021990', 'Guru PPKn', 1);

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kode` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id`, `nama`, `alamat`, `kode`) VALUES
(1, 'Taryono', 'Pemalang', '3d3aa013608d010779b40f3512cce2a9f08d0381dbb07a53592e11ad226651c04ecf160abcf8b1dbd1895bf6eccb511e4e377799697c4bbba82c6bcbabe20119');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(5) NOT NULL,
  `kelas` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kelas`) VALUES
(7, 'Kelas 7 Th Ajaran 2020/2021'),
(8, 'Kelas 8 Th Ajaran 2020/2021'),
(9, 'Kelas 9 Th Ajaran 2020/2021');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_tugas`
--

CREATE TABLE `kelas_tugas` (
  `id_tugas` int(5) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas_tugas`
--

INSERT INTO `kelas_tugas` (`id_tugas`, `id_kelas`, `aktif`) VALUES
(48, 6, 'N'),
(47, 9, 'Y'),
(50, 7, 'N'),
(51, 8, 'N'),
(51, 7, 'N'),
(52, 7, 'N'),
(53, 9, 'N'),
(54, 7, 'N'),
(55, 7, 'N'),
(55, 8, 'N'),
(55, 9, 'N'),
(53, 8, 'N'),
(53, 7, 'N'),
(51, 9, 'N'),
(54, 8, 'N'),
(54, 9, 'N'),
(58, 8, 'N'),
(57, 7, 'N'),
(56, 7, 'N'),
(56, 8, 'N'),
(56, 9, 'N'),
(59, 7, 'N'),
(60, 7, 'N'),
(60, 8, 'N'),
(60, 9, 'N'),
(59, 8, 'N'),
(59, 9, 'N'),
(50, 8, 'N'),
(50, 9, 'N'),
(52, 8, 'N'),
(52, 9, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(10) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `id_tugas` int(5) NOT NULL,
  `acak_soal` text NOT NULL,
  `jawaban` text NOT NULL,
  `sisa_waktu` varchar(10) NOT NULL,
  `jml_benar` int(5) NOT NULL,
  `nilai` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `nis`, `id_tugas`, `acak_soal`, `jawaban`, `sisa_waktu`, `jml_benar`, `nilai`) VALUES
(13, '12345', 50, '1561', '4', '09:57', 0, '0'),
(14, '89898', 51, '1562', '2', '119:31', 1, '100'),
(15, '2074215', 53, '1565,1564', '1,1', '19:39', 1, '50'),
(16, '123', 54, '1567,1566', '1,5', '09:35', 1, '50'),
(17, '12345', 51, '1562', '2', '119:57', 1, '100'),
(18, '01234', 50, '1561', '5', '09:52', 0, '0'),
(19, '01235', 50, '1561', '1', '119:20', 1, '100'),
(20, '01238', 50, '1561', '3', '119:56', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `no` int(11) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tmpt_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_kelas` int(5) NOT NULL,
  `id_adm` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`no`, `nis`, `nama`, `tmpt_lahir`, `tgl_lahir`, `jk`, `password`, `id_kelas`, `id_adm`) VALUES
(8, '01234', 'AGUS WINARDI', 'Bekasi', '2018-12-31', 'Laki-Laki', '01234', 7, 1),
(9, '01235', 'ANNA ANDRIANA', 'Bandung', '2018-12-31', 'Perempuan', '01235', 7, 1),
(10, '01236', 'ROLAND YUSTRIA', 'Semarang', '2018-01-01', 'Laki-Laki', '01236', 8, 1),
(11, '01237', 'ALEK ANDRIYANA', 'Bogor', '1996-04-01', 'Laki-Laki', '01237', 9, 1),
(12, '01238', 'SARI WANGI', 'Pemalang', '2000-01-01', 'Perempuan', '01238', 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(5) NOT NULL,
  `id_tugas` int(5) NOT NULL,
  `soal` text NOT NULL,
  `pilihan_1` text NOT NULL,
  `pilihan_2` text NOT NULL,
  `pilihan_3` text NOT NULL,
  `pilihan_4` text NOT NULL,
  `pilihan_5` text NOT NULL,
  `kunci` int(2) NOT NULL,
  `urut` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id_soal`, `id_tugas`, `soal`, `pilihan_1`, `pilihan_2`, `pilihan_3`, `pilihan_4`, `pilihan_5`, `kunci`, `urut`) VALUES
(1562, 51, '<p>KJHKHK</p>', '<p>1</p>', '<p>BENAR</p>', '<p>3</p>', '<p>4</p>', '<p>5</p>', 2, 0),
(1561, 50, '<p>askjdkaj</p>', '<p>a</p>', '<p>b</p>', '<p>c</p>', '<p>d</p>', '<p>e</p>', 1, 0),
(1563, 52, '<p>jyy</p>', '<p>a</p>', '<p>b</p>', '<p>c</p>', '<p>d</p>', '<p>e</p>', 5, 0),
(1576, 60, '', '', '', '', '', '', 3, 0),
(1577, 60, '', '', '', '', '', '', 4, 0),
(1578, 60, '', '', '', '', '', '', 5, 0),
(1573, 53, '', '', '', '', '', '', 1, 0),
(1574, 60, '', '', '', '', '', '', 3, 0),
(1575, 60, '', '', '', '', '', '', 2, 0),
(1566, 54, '<p>asdjkj</p>', '<p>1</p>', '<p>1</p>', '<p>1</p>', '<p>1</p>', '<p>1</p>', 1, 0),
(1567, 54, '<p>sadalskd</p>', '<p>2</p>', '<p>2</p>', '<p>2</p>', '<p>2</p>', '<p>2</p>', 1, 0),
(1568, 59, '', '', '', '', '', '', 4, 0),
(1569, 59, '', '', '', '', '', '', 4, 0),
(1570, 59, '', '', '', '', '', '', 1, 0),
(1571, 59, '', '', '', '', '', '', 3, 0),
(1572, 59, '', '', '', '', '', '', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(5) NOT NULL,
  `topik` varchar(50) NOT NULL,
  `nama_mapel` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` int(5) NOT NULL,
  `jml_soal` int(3) NOT NULL,
  `materi` varchar(100) NOT NULL,
  `id_guru` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `topik`, `nama_mapel`, `tanggal`, `waktu`, `jml_soal`, `materi`, `id_guru`) VALUES
(51, 'Puisi', 'Bahasa Indonesia', '2020-03-27', 90, 100, 'uunomor6tahun2017(uunomor6tahun2017).pdf', 40),
(50, 'Besaran dan Pengukuran', 'IPA', '2020-03-27', 120, 100, 'irfanmaulanafardi-ppnpn-operatorkomputer.pdf', 41),
(52, 'Interaksi Sosial', 'IPS', '2020-03-27', 90, 100, 'transaction_receipt.pdf', 42),
(53, 'Himpunan', 'Matematika', '2020-03-27', 120, 100, 'materihimpunan.pdf', 1),
(54, 'Greeting and Parting', 'Bahasa Ingris', '2020-03-27', 120, 100, 'transaction_receipt.pdf', 44),
(55, 'Sholat 5 waktu', 'Pendidikan Agama Islam', '2020-06-15', 10, 10, '', 43),
(59, 'Aljabar', 'Matematika', '2021-04-05', 10, 5, '', 1),
(60, 'Pancasila', 'Pendidikan Pancasila dan Kewarganegaraan', '2021-04-06', 10, 5, '', 45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Indexes for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD PRIMARY KEY (`id_diskusi`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_adm` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diskusi`
--
ALTER TABLE `diskusi`
  MODIFY `id_diskusi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1579;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
