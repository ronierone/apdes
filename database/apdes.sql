-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Bulan Mei 2020 pada 05.49
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apdes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `jenis_desain` varchar(20) NOT NULL,
  `ukuran` varchar(20) NOT NULL,
  `kegiatan` varchar(50) NOT NULL,
  `isi` text NOT NULL,
  `tgl_pengajuan` varchar(255) NOT NULL,
  `deadline` varchar(50) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `management` varchar(50) NOT NULL,
  `kd_guru` varchar(5) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kd_guru` varchar(5) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `kd_guru`, `foto`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Setiawan', 'g001', 'default.jpg', '$2y$10$Toi8E2zKyMWX/cyPNdPekOqC5pIvTkzHe56rSEa5qVg5fiYPDmLAy', 1, 1, 1588445252),
(2, 'fajar banyu', 'g002', 'default.jpg', '$2y$10$IHxwbP1ETS7qRGtEsJqf/umh8juvgMLaUVZKTH.0uUTeYdkqODvD6', 2, 1, 1588447288),
(3, 'ajay', 'g011', 'default.jpg', '$2y$10$tvMHNhumybgLw/p9h9y3sOpkrw5dhnfTi3QGNcE./Y2stIe7BPsHq', 3, 1, 1588475897),
(4, 'ajay', 'g012', 'default.jpg', '$2y$10$9/iUjA2.THzvaTVlZ6muyu2YAaJS.8SBKH8pig7/JHhfc5Ousz9oa', 3, 1, 1588951705);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(13, 1, 1),
(15, 2, 2),
(16, 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Accessor'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Accessor'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'accessor', 'fas fa-fw fa-tachometer-alt', 1),
(2, 1, 'My Profile', 'accessor/profile', 'fas fa-fw fa-user', 1),
(3, 1, 'Edit Profile', 'accessor/edit', 'fas fa-fw fa-user-edit', 1),
(4, 1, 'Ubah Password', 'accessor/ubahPassword', 'fas fa-fw fa-key', 1),
(5, 1, 'Pengajuan Desain', 'accessor/pengajuan', 'fas fa-fw fa-file-medical', 1),
(6, 2, 'Pengajuan Desain', 'editor/pengajuan', 'fas fa-fw fa-file-medical', 1),
(7, 2, 'My Profile', 'editor', 'fas fa-fw fa-user', 1),
(8, 2, 'Edit Profile', 'editor/edit', 'fas fa-fw fa-user-edit', 1),
(9, 2, 'Ubah Password', 'editor/ubahPassword', 'fas fa-fw fa-key', 1),
(10, 3, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(11, 3, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(13, 3, 'Pengajuan Desain', 'user/pengajuan', 'fas fa-fw fa-file-medical', 1),
(27, 3, 'Ubah Password', 'user/ubahPassword', 'fas fa-fw fa-key', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
