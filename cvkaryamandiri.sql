-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jun 2022 pada 17.17
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cvkaryamandiri`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `username` varchar(50) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `user_group` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`username`, `pwd`, `last_login`, `user_group`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', '2022-06-04 22:16:11', 'admin'),
('bambang', 'a9711cbb2e3c2d5fc97a63e45bbe5076', '2021-04-27 11:10:23', 'pemilik'),
('hendro', '66cb5177a2d8017b6e71983e95659388', '2021-04-27 11:15:01', 'pemilik'),
('tora', '8303220f39c4f57e9499733006a1d3cc', '2021-04-23 10:39:58', 'analis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa`
--

CREATE TABLE `coa` (
  `id` int(10) NOT NULL,
  `kode_coa` int(10) NOT NULL,
  `nama_coa` varchar(50) NOT NULL,
  `posisi_d_c` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `coa`
--

INSERT INTO `coa` (`id`, `kode_coa`, `nama_coa`, `posisi_d_c`) VALUES
(1, 1, 'Aktiva', 'd'),
(2, 2, 'Kewajiban', 'c'),
(3, 3, 'Modal', 'c'),
(4, 4, 'Pendapatan', 'c'),
(5, 5, 'Beban', 'd'),
(6, 11, 'Aktiva Lancar', 'd'),
(7, 12, 'Aktiva Tetap', 'd'),
(8, 21, 'Kewajiban Lancar', 'c'),
(9, 22, 'Kewajiban Jangka Panjang', 'c'),
(10, 31, 'Modal Pemilik', 'c'),
(11, 41, 'Pendapatan Operasional', 'c'),
(12, 42, 'Pendapatan Non Operasional', 'c'),
(13, 51, 'Beban Operasional', 'd'),
(14, 52, 'Beban Non Operasional', 'd'),
(15, 111, 'Kas', 'd'),
(16, 112, 'Persediaan Barang Dagang', 'd'),
(17, 411, 'Penjualan', 'c'),
(18, 412, 'Harga Pokok Penjualan', 'c'),
(19, 511, 'Beban Administrasi dan Umum', 'd'),
(32, 32, 'Prive Pemilik', 'c'),
(33, 113, 'Piutang Usaha', 'd'),
(34, 231, 'Pendapatan Diterima Dimuka', 'c'),
(35, 401, 'Pembelian', 'd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `alamat_customer` varchar(50) NOT NULL,
  `telepon_customer` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `alamat_customer`, `telepon_customer`) VALUES
(1, 'kiki', 'sukapura', '08971017185'),
(2, 'sapik', 'bandung', '089700112930');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dummy`
--

CREATE TABLE `dummy` (
  `id_belanja` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `nama_mainan` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dummy`
--

INSERT INTO `dummy` (`id_belanja`, `tanggal`, `waktu`, `nama_mainan`, `harga`, `quantity`) VALUES
(19, '2022-06-04', '07:38:32', 'Boneka', 50000, 3),
(20, '2022-06-04', '07:38:36', 'Puzzle', 7000, 4),
(21, '2022-06-04', '09:56:12', 'Rubik', 7000, 1),
(22, '2022-06-04', '09:57:21', 'Yoyo', 6000, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dummy2`
--

CREATE TABLE `dummy2` (
  `id` int(11) NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `nama_mainan` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `jumlah_mainan` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `total_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal2`
--

CREATE TABLE `jurnal2` (
  `id` int(11) NOT NULL,
  `kode_akun` int(11) NOT NULL,
  `tgl_jurnal` date NOT NULL,
  `waktu` time NOT NULL,
  `posisi_d_c` varchar(1) NOT NULL,
  `nominal` double NOT NULL,
  `transaksi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jurnal2`
--

INSERT INTO `jurnal2` (`id`, `kode_akun`, `tgl_jurnal`, `waktu`, `posisi_d_c`, `nominal`, `transaksi`) VALUES
(1, 411, '2022-05-25', '21:45:57', 'c', 5000, 'Penjualan'),
(2, 111, '2022-05-25', '21:45:57', 'd', 5000, 'Penjualan'),
(3, 411, '2022-05-25', '09:57:14', 'c', 7000, 'Penjualan'),
(4, 111, '2022-05-25', '09:57:14', 'd', 7000, 'Penjualan'),
(7, 411, '2022-06-01', '21:45:57', 'c', 7000, 'Penjualan'),
(8, 111, '2022-06-01', '21:45:57', 'd', 7000, 'Penjualan'),
(9, 411, '2022-05-29', '01:04:12', 'd', 20000, 'Pembelian'),
(10, 111, '2022-05-29', '01:04:12', 'c', 20000, 'Pembelian'),
(11, 401, '2022-06-03', '09:20:49', 'd', 25000, 'Pembelian'),
(12, 111, '2022-06-03', '09:20:49', 'c', 25000, 'Pembelian'),
(13, 401, '2022-06-03', '09:21:46', 'd', 25000, 'Pembelian'),
(14, 111, '2022-06-03', '09:21:46', 'c', 25000, 'Pembelian'),
(15, 401, '2022-06-04', '09:24:43', 'd', 15000, 'Pembelian'),
(16, 111, '2022-06-04', '09:24:43', 'c', 15000, 'Pembelian'),
(17, 401, '2022-06-04', '09:25:52', 'd', 15000, 'Pembelian'),
(18, 111, '2022-06-04', '09:25:52', 'c', 15000, 'Pembelian'),
(19, 401, '2022-06-04', '09:26:48', 'd', 10000, 'Pembelian'),
(20, 111, '2022-06-04', '09:26:48', 'c', 10000, 'Pembelian'),
(21, 401, '2022-06-04', '09:27:55', 'd', 10000, 'Pembelian'),
(22, 111, '2022-06-04', '09:27:55', 'c', 10000, 'Pembelian'),
(23, 401, '2022-06-04', '09:28:42', 'd', 12000, 'Pembelian'),
(24, 111, '2022-06-04', '09:28:42', 'c', 12000, 'Pembelian'),
(25, 401, '2022-06-04', '09:29:41', 'd', 20000, 'Pembelian'),
(26, 111, '2022-06-04', '09:29:41', 'c', 20000, 'Pembelian'),
(27, 401, '2022-06-04', '09:57:58', 'd', 10000, 'Pembelian'),
(28, 111, '2022-06-04', '09:57:58', 'c', 10000, 'Pembelian'),
(29, 401, '2022-06-04', '10:00:03', 'd', 15000, 'Pembelian'),
(30, 111, '2022-06-04', '10:00:03', 'c', 15000, 'Pembelian'),
(31, 401, '2022-06-04', '10:00:03', 'd', 15000, 'Pembelian'),
(32, 111, '2022-06-04', '10:00:03', 'c', 15000, 'Pembelian'),
(33, 401, '2022-06-04', '10:00:04', 'd', 15000, 'Pembelian'),
(34, 111, '2022-06-04', '10:00:04', 'c', 15000, 'Pembelian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mainan`
--

CREATE TABLE `mainan` (
  `id_mainan` int(11) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `nama_mainan` varchar(50) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok_mainan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mainan`
--

INSERT INTO `mainan` (`id_mainan`, `nama_vendor`, `nama_mainan`, `harga_beli`, `harga_jual`, `stok_mainan`) VALUES
(1, 'PT JOKO', 'mobil-mobilan', 6000, 11000, 2),
(2, 'PT SUKA', 'Puzzle', 5000, 7000, 3),
(3, 'PT ANTO', 'Yoyo', 5000, 6000, 1),
(4, 'PT YUDI', 'Boneka', 45000, 50000, 10),
(5, 'PT ABC', 'Rubik', 5000, 7000, 2);

--
-- Trigger `mainan`
--
DELIMITER $$
CREATE TRIGGER `InsertAwal` AFTER INSERT ON `mainan` FOR EACH ROW INSERT INTO stock_card (id, tgl_stock, id_mainan, nama_mainan, stock, keterangan) VALUES (NULL, CURRENT_TIME, new.id_mainan, new.nama_mainan, new.stok_mainan, 'stock awal')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `nama_mainan` varchar(50) NOT NULL,
  `jumlah_mainan` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `total_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tgl_pembelian`, `nama_vendor`, `nama_mainan`, `jumlah_mainan`, `harga_beli`, `total_pembelian`) VALUES
(1, '2022-01-01', 'PT JOKO', 'mobil-mobilan', 5, 6000, 30000),
(2, '2022-01-06', 'PT JOKO', 'puzzel', 5, 5000, 25000),
(3, '2021-12-29', 'PT SUKA', 'Puzzle', 10, 5000, 50000),
(4, '2021-12-21', 'PT JOKO', 'mobil-mobilan', 2, 6000, 12000),
(5, '2021-11-30', 'PT SUKA', 'Puzzle', 3, 5000, 15000),
(6, '2022-01-11', 'PT SUKA', 'Puzzle', 3, 5000, 15000),
(7, '2022-01-10', 'PT JOKO', 'mobil-mobilan', 4, 6000, 24000),
(8, '2022-05-16', 'PT JOKO', 'mobil-mobilan', 2, 6000, 12000),
(9, '2022-05-16', 'PT SUKA', 'Puzzle', 4, 5000, 20000),
(10, '2022-05-16', 'PT SUKA', 'Puzzle', 10, 5000, 50000),
(11, '2022-05-28', 'PT JOKO', 'mobil-mobilan', 4, 6000, 24000),
(12, '2022-05-29', 'PT ANTO', 'Yoyo', 4, 5000, 20000),
(13, '2022-06-03', 'PT ANTO', 'Yoyo', 5, 5000, 25000),
(14, '2022-06-03', 'PT ANTO', 'Yoyo', 5, 5000, 25000),
(15, '2022-06-04', 'PT ABC', 'Rubik', 3, 5000, 15000),
(16, '2022-06-04', 'PT ANTO', 'Yoyo', 3, 5000, 15000),
(17, '2022-06-04', 'PT SUKA', 'Puzzle', 2, 5000, 10000),
(18, '2022-06-04', 'PT SUKA', 'Puzzle', 2, 5000, 10000),
(19, '2022-06-04', 'PT JOKO', 'mobil-mobilan', 2, 6000, 12000),
(20, '2022-06-04', 'PT SUKA', 'Puzzle', 4, 5000, 20000),
(21, '2022-06-04', 'PT ABC', 'Rubik', 2, 5000, 10000),
(22, '2022-06-04', 'PT SUKA', 'Puzzle', 3, 5000, 15000),
(23, '2022-06-04', 'PT SUKA', 'Puzzle', 3, 5000, 15000),
(24, '2022-06-04', 'PT SUKA', 'Puzzle', 3, 5000, 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_card`
--

CREATE TABLE `stock_card` (
  `id` int(11) NOT NULL,
  `tgl_stock` date NOT NULL,
  `id_mainan` int(11) NOT NULL,
  `nama_mainan` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stock_card`
--

INSERT INTO `stock_card` (`id`, `tgl_stock`, `id_mainan`, `nama_mainan`, `stock`, `keterangan`) VALUES
(1, '2022-05-23', 1, 'mobil-mobilan', 5, 'stock awal'),
(2, '2022-05-20', 2, 'Puzzle', 13, 'Stock Awal'),
(3, '2022-06-01', 3, 'Yoyo', 5, 'Stock Awal'),
(4, '2022-05-30', 4, 'Boneka', 10, 'Stock Awal'),
(5, '2022-06-04', 5, 'Rubik', 5, 'stock awal'),
(6, '2022-06-04', 5, 'Rubik', 3, 'stock masuk'),
(7, '2022-06-04', 3, 'Yoyo', 3, 'stock masuk'),
(8, '2022-06-04', 2, 'Puzzle', 2, 'stock masuk'),
(9, '2022-06-04', 2, 'Puzzle', 2, 'stock masuk'),
(10, '2022-06-04', 1, 'mobil-mobilan', 2, 'stock masuk'),
(11, '2022-06-04', 2, 'Puzzle', 4, 'stock masuk'),
(12, '2022-06-04', 5, 'Rubik', 1, 'stock Keluar'),
(13, '2022-06-04', 3, 'Yoyo', 2, 'stock keluar'),
(14, '2022-06-04', 5, 'Rubik', 2, 'stock masuk'),
(15, '2022-06-04', 2, 'Puzzle', 3, 'stock masuk'),
(16, '2022-06-04', 2, 'Puzzle', 3, 'stock masuk'),
(17, '2022-06-04', 2, 'Puzzle', 3, 'stock masuk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `No` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Waktu` time NOT NULL,
  `Harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_penjualan`
--

INSERT INTO `t_penjualan` (`No`, `Tanggal`, `Waktu`, `Harga`) VALUES
(1, '2022-05-21', '08:31:44', 400000),
(2, '2022-05-21', '08:33:45', 400000),
(3, '2022-05-21', '08:45:17', 33000),
(4, '2022-06-01', '21:51:45', 50000),
(5, '2022-05-25', '08:54:46', 105000),
(9, '2022-05-25', '09:42:18', 6000),
(10, '2022-05-25', '09:45:40', 14000),
(11, '2022-05-25', '09:48:04', 14000),
(12, '2022-05-25', '09:48:06', 14000),
(13, '2022-05-25', '09:48:55', 14000),
(14, '2022-05-25', '09:49:05', 3000),
(15, '2022-05-25', '09:50:20', 3000),
(16, '2022-05-25', '09:51:28', 3000),
(17, '2022-05-25', '09:57:14', 7000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` int(11) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `alamat_vendor` varchar(50) NOT NULL,
  `no_telp_vendor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `alamat_vendor`, `no_telp_vendor`) VALUES
(1, 'PT JOKO', 'Bandung', '081381057200'),
(2, 'PT SUKA', 'yayay', '082'),
(3, 'PT YUDI', '', ''),
(4, 'PT B', 'B', '567889');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `dummy`
--
ALTER TABLE `dummy`
  ADD PRIMARY KEY (`id_belanja`);

--
-- Indeks untuk tabel `dummy2`
--
ALTER TABLE `dummy2`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurnal2`
--
ALTER TABLE `jurnal2`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mainan`
--
ALTER TABLE `mainan`
  ADD PRIMARY KEY (`id_mainan`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `stock_card`
--
ALTER TABLE `stock_card`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`No`);

--
-- Indeks untuk tabel `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `coa`
--
ALTER TABLE `coa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dummy`
--
ALTER TABLE `dummy`
  MODIFY `id_belanja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `jurnal2`
--
ALTER TABLE `jurnal2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `mainan`
--
ALTER TABLE `mainan`
  MODIFY `id_mainan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `stock_card`
--
ALTER TABLE `stock_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id_vendor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
