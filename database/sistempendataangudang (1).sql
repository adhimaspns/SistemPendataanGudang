-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Mar 2021 pada 18.30
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistempendataangudang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok_barang` int(20) NOT NULL,
  `satuan_stok_barang` varchar(100) NOT NULL,
  `harga_barang` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `stok_barang`, `satuan_stok_barang`, `harga_barang`) VALUES
(1, 'BRG000001', 'Beras Rojo Lele', 10, 'Kilogram', 250000),
(2, 'BRG000002', 'Tepung Terigu Segitiga Biru', 650, 'Pcs', 35000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `tgl_transaksi_detail` date NOT NULL,
  `nomor_transaksi_detail` varchar(100) NOT NULL,
  `barang_id_detail` int(20) NOT NULL,
  `qty_detail` int(20) NOT NULL,
  `harga_item_detail` int(20) NOT NULL,
  `sub_total_detail` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `tgl_transaksi_detail`, `nomor_transaksi_detail`, `barang_id_detail`, `qty_detail`, `harga_item_detail`, `sub_total_detail`) VALUES
(12, '2021-03-22', '202103220001', 1, 20, 250000, 5000000),
(13, '2021-03-22', '202103220001', 2, 210, 35000, 7350000),
(14, '2021-03-22', '202103220002', 1, 40, 250000, 10000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kasir`
--

CREATE TABLE `kasir` (
  `id_kasir` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nomor_transaksi_kasir` varchar(100) NOT NULL,
  `barang_id_kasir` int(20) NOT NULL,
  `qty_kasir` int(20) NOT NULL,
  `harga_item_kasir` int(20) NOT NULL,
  `sub_total_kasir` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_brg_keluar`
--

CREATE TABLE `laporan_brg_keluar` (
  `id_barang_keluar` int(11) NOT NULL,
  `tanggal_brg_keluar` date NOT NULL,
  `no_tr_brg_keluar` varchar(100) NOT NULL,
  `jumlah_barang_keluar` int(20) NOT NULL,
  `total` int(100) NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan_brg_keluar`
--

INSERT INTO `laporan_brg_keluar` (`id_barang_keluar`, `tanggal_brg_keluar`, `no_tr_brg_keluar`, `jumlah_barang_keluar`, `total`, `nama_pembeli`) VALUES
(1, '2021-03-22', '202103220001', 2, 12350000, 'Bondan'),
(2, '2021-03-22', '202103220002', 1, 10000000, 'Adhimas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_brg_masuk`
--

CREATE TABLE `laporan_brg_masuk` (
  `id_lprn_brg_msk` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_brg` varchar(100) NOT NULL,
  `stok_masuk` int(20) NOT NULL,
  `stn_brg_masuk` varchar(100) NOT NULL,
  `harga_satuan` int(20) NOT NULL,
  `sbttl_brg_masuk` int(20) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan_brg_masuk`
--

INSERT INTO `laporan_brg_masuk` (`id_lprn_brg_msk`, `tgl_masuk`, `kode_barang`, `nama_brg`, `stok_masuk`, `stn_brg_masuk`, `harga_satuan`, `sbttl_brg_masuk`, `nama_pengirim`) VALUES
(1, '2021-03-21', 'BRG000001', 'Beras Rojo Lele', 100, 'Kilogram', 250000, 25000000, 'UD. Petani Jaya Makmur'),
(2, '2021-03-21', 'BRG000002', 'Tepung Terigu Segitiga Biru', 1000, 'Pcs', 35000, 35000000, 'PT. Segitiga Biru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `nomor_transaksi` varchar(100) NOT NULL,
  `nama_pembeli` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `nomor_transaksi`, `nama_pembeli`, `keterangan`, `tgl_transaksi`) VALUES
(3, '202103210001', 'Arie Untung', 'Beli Barang', '2021-03-21'),
(4, '202103220001', 'Bondan', 'Keterangan Barang', '2021-03-22'),
(5, '202103220002', 'Adhimas', 'Beli Beras', '2021-03-22');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indeks untuk tabel `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`id_kasir`);

--
-- Indeks untuk tabel `laporan_brg_keluar`
--
ALTER TABLE `laporan_brg_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indeks untuk tabel `laporan_brg_masuk`
--
ALTER TABLE `laporan_brg_masuk`
  ADD PRIMARY KEY (`id_lprn_brg_msk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `kasir`
--
ALTER TABLE `kasir`
  MODIFY `id_kasir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `laporan_brg_keluar`
--
ALTER TABLE `laporan_brg_keluar`
  MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `laporan_brg_masuk`
--
ALTER TABLE `laporan_brg_masuk`
  MODIFY `id_lprn_brg_msk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
