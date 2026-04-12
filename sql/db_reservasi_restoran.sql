-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Apr 2026 pada 07.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_reservasi_restoran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_meja`
--

CREATE TABLE `tbl_meja` (
  `id` int(11) NOT NULL,
  `nama_meja` varchar(20) NOT NULL,
  `kapasitas_meja` int(11) NOT NULL,
  `status` enum('tersedia','dipesan','tidak tersedia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_meja`
--

INSERT INTO `tbl_meja` (`id`, `nama_meja`, `kapasitas_meja`, `status`) VALUES
(1, 'Meja 1', 1, 'tidak tersedia'),
(2, 'Meja 2', 2, 'dipesan'),
(3, 'Meja 3', 4, 'tersedia'),
(4, 'Meja 4', 4, 'tersedia'),
(5, 'Meja 5', 4, 'tidak tersedia'),
(6, 'Meja 6', 6, 'tersedia'),
(7, 'Meja 7', 6, 'dipesan'),
(8, 'Meja 8', 8, 'tersedia'),
(9, 'Meja 9', 8, 'tersedia'),
(11, 'Meja 11', 10, 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL,
  `nama_menu` varchar(20) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `deskripsi` text NOT NULL,
  `stok` tinyint(3) UNSIGNED NOT NULL,
  `kategori` enum('makanan','minuman') NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `status` enum('tersedia','tidak tersedia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_menu`
--

INSERT INTO `tbl_menu` (`id`, `nama_menu`, `harga`, `deskripsi`, `stok`, `kategori`, `gambar`, `status`) VALUES
(1, 'Ayam Goreng', 15000.00, 'Ayam goreng dengan sambel dan lalapan', 20, 'makanan', 'Resep Masak Ayam Goreng Kalasan - Resep Masakan Indonesia.jpg', 'tersedia'),
(2, 'Bebek Goreng', 20000.00, 'Bebek gorenng dengan sambel dan lalapan', 15, 'makanan', 'Bebek Goreng Madura.jpg', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `id_reservasi` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `id` int(11) NOT NULL,
  `id_reservasi` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL,
  `id_kasir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_reservasi`
--

CREATE TABLE `tbl_reservasi` (
  `id` int(11) NOT NULL,
  `kode_reservasi` varchar(60) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `tanggal_reservasi` date NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','kasir','pelanggan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nama_lengkap`, `email`, `username`, `password`, `role`) VALUES
(1, 'Edie Feeding Frenzy', 'admin@gmail.com', 'edie', '$2y$10$hqsiqJPECd97AghRqpdA5ueG3tZuwhZzbXRa6b/3fWnGu.Tmo7BpK', 'admin'),
(2, 'Raihan Wijayadi', 'kasir@gmail.com', 'raihanwijay', '$2y$10$3QS/tEFiTCHG461sGSzb7ukj6jmf7c/SRQFcEvitlD6hnKGcjMtJq', 'kasir'),
(3, 'Krisna Jauhari', 'pelanggan@gmail.com', 'krisnajauhara', '$2y$10$Tf/gOyBkL9YXdVBoMfTu6u1FmHkerAjDedUKj5JWoHlnFLlpPzkrW', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_meja`
--
ALTER TABLE `tbl_meja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_reservasi` (`id_reservasi`);

--
-- Indeks untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reservasi` (`id_reservasi`),
  ADD KEY `id_kasir` (`id_kasir`);

--
-- Indeks untuk tabel `tbl_reservasi`
--
ALTER TABLE `tbl_reservasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_reservasi` (`kode_reservasi`),
  ADD KEY `id_meja` (`id_meja`),
  ADD KEY `id_pelangan` (`id_pelanggan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_meja`
--
ALTER TABLE `tbl_meja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_reservasi`
--
ALTER TABLE `tbl_reservasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `tbl_menu` (`id`),
  ADD CONSTRAINT `tbl_order_ibfk_2` FOREIGN KEY (`id_reservasi`) REFERENCES `tbl_reservasi` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD CONSTRAINT `tbl_pembayaran_ibfk_1` FOREIGN KEY (`id_reservasi`) REFERENCES `tbl_reservasi` (`id`),
  ADD CONSTRAINT `tbl_pembayaran_ibfk_2` FOREIGN KEY (`id_kasir`) REFERENCES `tbl_user` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_reservasi`
--
ALTER TABLE `tbl_reservasi`
  ADD CONSTRAINT `tbl_reservasi_ibfk_1` FOREIGN KEY (`id_meja`) REFERENCES `tbl_meja` (`id`),
  ADD CONSTRAINT `tbl_reservasi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
