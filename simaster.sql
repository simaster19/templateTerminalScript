-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Des 2022 pada 11.22
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simaster`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tableShortlink`
--

CREATE TABLE `tableShortlink` (
  `id` int(11) NOT NULL,
  `short` varchar(30) NOT NULL,
  `token` varchar(30) NOT NULL,
  `created_at` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tableShortlink`
--

INSERT INTO `tableShortlink` (`id`, `short`, `token`, `created_at`) VALUES
(1, 'a', 'xxx', ''),
(2, 'b', 'xxb', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tableSourcecode`
--

CREATE TABLE `tableSourcecode` (
  `id` int(11) NOT NULL,
  `namaSc` varchar(30) NOT NULL,
  `namaApkWeb` varchar(30) NOT NULL,
  `linkYt` text NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tableUa`
--

CREATE TABLE `tableUa` (
  `id` int(11) NOT NULL,
  `ua` text NOT NULL,
  `tanggal` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tableUa`
--

INSERT INTO `tableUa` (`id`, `ua`, `tanggal`) VALUES
(20, 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '15-12-2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tableUser`
--

CREATE TABLE `tableUser` (
  `id` int(11) NOT NULL,
  `id_versi` int(11) NOT NULL,
  `id_shortlink` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `userAgent` text NOT NULL,
  `expiredToken` varchar(10) NOT NULL,
  `count` int(11) NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tableUser`
--

INSERT INTO `tableUser` (`id`, `id_versi`, `id_shortlink`, `username`, `ip`, `userAgent`, `expiredToken`, `count`, `created_at`) VALUES
(11, 1, 1, 'd7eff3a59cd7c0d36566bcdac80a824b', '182.1.69.189', 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '25', 1, '15-12-2022'),
(12, 1, 2, 'c1b020e98914c8c6fe2b8022cb2efc8f', '114.125.95.209', 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '24', 1, '15-12-2022'),
(13, 1, 2, '817d7b8f9a11121b304f44e50e76e81a', '114.125.95.209', 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '23', 1, '15-12-2022'),
(14, 1, 1, '41af7f63aa56b96da02ccbacc76f3e81', '114.125.95.209', 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '25', 1, '15-12-2022'),
(15, 1, 2, '9a8197c255589998491a39f3249ab672', '114.125.95.209', 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '24', 1, '15-12-2022'),
(16, 1, 2, '8a23fc5ed901930bfb65077129ed9f78', '114.125.95.209', 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '24', 1, '15-12-2022'),
(17, 1, 1, '45ab32f2e4d6bf523fd89a3d4e05cba3', '114.125.95.209', 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '12', 1, '15-12-2022'),
(18, 1, 1, 'e721cb270badadeebf0242c842e71b8f', '114.125.95.209', 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '25', 1, '15-12-2022'),
(19, 1, 1, '35f07caef0c6d64e34b6a57b59eea778', '114.125.95.209', 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '25', 1, '15-12-2022'),
(20, 1, 2, 'a5e26dcf079d12ce437c10ffdb60ee70', '182.1.90.13', 'jdjdjdjddjdjdjdjdjdjdjdjdjdjfjfjfjfjfjfjfjfjfjfjfjfjfjjffjfjfjfjfjfjfjfjfjfjfjndndjddjdjdjdjdjdjdjdjdjdjdjdjfj', '15', 5, '15-12-2022');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tableUserPremium`
--

CREATE TABLE `tableUserPremium` (
  `id` int(11) NOT NULL,
  `id_versi` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tableUserPremium`
--

INSERT INTO `tableUserPremium` (`id`, `id_versi`, `username`, `pass`, `created_at`, `expired_at`) VALUES
(1, 2, 'premium1', 'c9a598b9ca7177bfd26612a11030e410', '2022-12-15 04:59:41', '2022-12-31 04:59:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tableVersi`
--

CREATE TABLE `tableVersi` (
  `id` int(11) NOT NULL,
  `namaSc` varchar(20) NOT NULL,
  `versi` varchar(5) NOT NULL,
  `link` text NOT NULL,
  `message` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tableVersi`
--

INSERT INTO `tableVersi` (`id`, `namaSc`, `versi`, `link`, `message`, `status`) VALUES
(1, 'TemplateDebug.php', '1.3', 'Linkmu', 'jdjddjjd\\njdjdjddj\\nhdhddhd\\njsjsjdjdj', 'Active'),
(2, 'TemplateDebug2.php', '1.3', 'hhhhhhhh', 'xnxx.com', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tableShortlink`
--
ALTER TABLE `tableShortlink`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tableSourcecode`
--
ALTER TABLE `tableSourcecode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tableUser`
--
ALTER TABLE `tableUser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tableUser_id_versi_tableVersi_id` (`id_versi`),
  ADD KEY `tableUser_id_shortlink_tableShortlink_id` (`id_shortlink`);

--
-- Indeks untuk tabel `tableUserPremium`
--
ALTER TABLE `tableUserPremium`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pass` (`pass`) USING HASH,
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `tableUserPremium_id_versi_tableVersi_id` (`id_versi`);

--
-- Indeks untuk tabel `tableVersi`
--
ALTER TABLE `tableVersi`
  ADD PRIMARY KEY (`id`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tableUser`
--
ALTER TABLE `tableUser`
  ADD CONSTRAINT `tableUser_id_shortlink_tableShortlink_id` FOREIGN KEY (`id_shortlink`) REFERENCES `tableShortlink` (`id`),
  ADD CONSTRAINT `tableUser_id_versi_tableVersi_id` FOREIGN KEY (`id_versi`) REFERENCES `tableVersi` (`id`);

--
-- Ketidakleluasaan untuk tabel `tableUserPremium`
--
ALTER TABLE `tableUserPremium`
  ADD CONSTRAINT `tableUserPremium_id_versi_tableVersi_id` FOREIGN KEY (`id_versi`) REFERENCES `tableVersi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
