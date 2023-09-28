-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Sep 2023 pada 10.01
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_pem_laptop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `f_id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`, `gambar`, `f_id_kategori`) VALUES
(15, 'Asus A516ma', 'Screenshot 2022-11-21 120809.png', 1),
(16, 'Asus Tuff', 'Screenshot (7).png', 1),
(17, 'Acer Aspire 3', 'Screenshot (13).png', 2),
(18, 'Acer E5-471', 'Screenshot (7)_1.png', 2),
(19, 'HP 15S', 'Screenshot (9).png', 3),
(20, 'HP 240-G7', 'Screenshot (2).png', 3),
(21, 'DELL Latitude E54', 'Screenshot (2)_1.png', 4),
(22, 'DELL Latitude', 'Screenshot (1)_1.png', 4),
(23, 'Lenovo ThinPad', 'Screenshot (1)_2.png', 5),
(24, 'Apple M1', 'Screenshot (1)_3.png', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_kriteria`
--

CREATE TABLE `bobot_kriteria` (
  `id_bobot` int(11) NOT NULL,
  `C1` float NOT NULL,
  `C2` float NOT NULL,
  `C3` float NOT NULL,
  `C4` float NOT NULL,
  `C5` float NOT NULL,
  `C6` float NOT NULL,
  `C7` float NOT NULL,
  `C8` float NOT NULL,
  `f_id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot`, `C1`, `C2`, `C3`, `C4`, `C5`, `C6`, `C7`, `C8`, `f_id_user`) VALUES
(8, 0.2, 0.15, 0.12, 0.14, 0.12, 0.09, 0.09, 0.09, 7),
(9, 0.25, 0.15, 0.1, 0.2, 0.05, 0.05, 0.15, 0.05, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_alt`
--

CREATE TABLE `kategori_alt` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_alt`
--

INSERT INTO `kategori_alt` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Asus'),
(2, 'Acer'),
(3, 'HP'),
(4, 'DELL'),
(5, 'Lenovo'),
(6, 'Apple');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kec_alt_kriteria`
--

CREATE TABLE `kec_alt_kriteria` (
  `id_alt_kriteria` int(11) NOT NULL,
  `f_id_alternatif` int(11) NOT NULL,
  `f_id_kriteria` char(2) NOT NULL,
  `f_id_sub_kriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kec_alt_kriteria`
--

INSERT INTO `kec_alt_kriteria` (`id_alt_kriteria`, `f_id_alternatif`, `f_id_kriteria`, `f_id_sub_kriteria`) VALUES
(66, 15, 'C1', 39),
(67, 15, 'C2', 43),
(68, 15, 'C3', 47),
(69, 15, 'C4', 50),
(70, 15, 'C5', 54),
(71, 15, 'C6', 57),
(72, 15, 'C7', 59),
(73, 15, 'C8', 63),
(74, 16, 'C1', 38),
(75, 16, 'C2', 44),
(76, 16, 'C3', 46),
(77, 16, 'C4', 49),
(78, 16, 'C5', 54),
(79, 16, 'C6', 57),
(80, 16, 'C7', 58),
(81, 16, 'C8', 63),
(82, 17, 'C1', 38),
(83, 17, 'C2', 44),
(84, 17, 'C3', 45),
(85, 17, 'C4', 49),
(86, 17, 'C5', 54),
(87, 17, 'C6', 57),
(88, 17, 'C7', 61),
(89, 17, 'C8', 63),
(90, 18, 'C1', 37),
(91, 18, 'C2', 44),
(92, 18, 'C3', 46),
(93, 18, 'C4', 50),
(94, 18, 'C5', 54),
(95, 18, 'C6', 57),
(96, 18, 'C7', 58),
(97, 18, 'C8', 63),
(98, 19, 'C1', 39),
(99, 19, 'C2', 44),
(100, 19, 'C3', 46),
(101, 19, 'C4', 49),
(102, 19, 'C5', 53),
(103, 19, 'C6', 57),
(104, 19, 'C7', 58),
(105, 19, 'C8', 63),
(106, 20, 'C1', 37),
(107, 20, 'C2', 44),
(108, 20, 'C3', 46),
(109, 20, 'C4', 49),
(110, 20, 'C5', 54),
(111, 20, 'C6', 57),
(112, 20, 'C7', 60),
(113, 20, 'C8', 62),
(114, 21, 'C1', 39),
(115, 21, 'C2', 44),
(116, 21, 'C3', 45),
(117, 21, 'C4', 51),
(118, 21, 'C5', 53),
(119, 21, 'C6', 56),
(120, 21, 'C7', 58),
(121, 21, 'C8', 63),
(122, 22, 'C1', 37),
(123, 22, 'C2', 44),
(124, 22, 'C3', 46),
(125, 22, 'C4', 50),
(126, 22, 'C5', 54),
(127, 22, 'C6', 57),
(128, 22, 'C7', 59),
(129, 22, 'C8', 62),
(130, 23, 'C1', 38),
(131, 23, 'C2', 44),
(132, 23, 'C3', 47),
(133, 23, 'C4', 49),
(134, 23, 'C5', 54),
(135, 23, 'C6', 57),
(136, 23, 'C7', 59),
(137, 23, 'C8', 63),
(138, 24, 'C1', 38),
(139, 24, 'C2', 43),
(140, 24, 'C3', 46),
(141, 24, 'C4', 50),
(142, 24, 'C5', 53),
(143, 24, 'C6', 57),
(144, 24, 'C7', 58),
(145, 24, 'C8', 62);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` char(2) NOT NULL,
  `nama_kriteria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`) VALUES
('C1', 'RAM'),
('C2', 'Merk Processor'),
('C3', 'Harga'),
('C4', 'Ukuran Penyimpanan'),
('C5', 'Jenis Penyimpanan'),
('C6', 'Sistem Operasi'),
('C7', 'Daya Tahan Baterai'),
('C8', 'Ukuran Layar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `nama_sub_kriteria` varchar(150) NOT NULL,
  `bobot_sub_kriteria` float NOT NULL,
  `f_id_kriteria` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `nama_sub_kriteria`, `bobot_sub_kriteria`, `f_id_kriteria`) VALUES
(37, '4GB', 1.01, 'C1'),
(38, '8GB', 2, 'C1'),
(39, '16GB', 3, 'C1'),
(40, '> 16GB', 4, 'C1'),
(41, 'Apple', 1, 'C2'),
(42, 'Cyrix', 2, 'C2'),
(43, 'AMD', 3, 'C2'),
(44, 'Intel', 4, 'C2'),
(45, 'Rp. 2.000.000 < harga < Rp. 5.000.000', 4, 'C3'),
(46, 'Rp. 5.000.000 ≤ harga < Rp. 8.000.000', 3, 'C3'),
(47, 'Rp. 8.000.000 ≤ harga ≤ Rp. 12.000.000', 2, 'C3'),
(48, '> Rp. 12.000.000', 1, 'C3'),
(49, '256GB', 1, 'C4'),
(50, '512GB', 2, 'C4'),
(51, '1TB', 3, 'C4'),
(52, '>1TB', 4, 'C4'),
(53, 'HDD', 1, 'C5'),
(54, 'SSD', 2, 'C5'),
(55, 'Mac OS X', 1, 'C6'),
(56, 'Linux', 2, 'C6'),
(57, 'Ms.Windows', 3, 'C6'),
(58, '≤ 5 jam', 1, 'C7'),
(59, '5 jam < baterai ≤ 7 jam', 2, 'C7'),
(60, '7 jam < baterai ≤ 9 jam', 3, 'C7'),
(61, '> 6 jam', 0.05, 'C7'),
(62, '≤ 14 inci', 0.01, 'C8'),
(63, '14 inci < layar ≤ 15 inci', 0.01, 'C8'),
(64, '15 inci < layar ≤ 17 inci', 0.03, 'C8'),
(65, '> 17 inci', 0.04, 'C8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_tampung`
--

CREATE TABLE `tabel_tampung` (
  `id` int(11) NOT NULL,
  `prio1` varchar(50) NOT NULL,
  `prio2` varchar(50) NOT NULL,
  `prio3` varchar(50) NOT NULL,
  `prio4` varchar(50) NOT NULL,
  `prio5` varchar(50) NOT NULL,
  `prio6` varchar(50) NOT NULL,
  `prio7` varchar(50) NOT NULL,
  `prio8` varchar(50) NOT NULL,
  `f_id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_tampung`
--

INSERT INTO `tabel_tampung` (`id`, `prio1`, `prio2`, `prio3`, `prio4`, `prio5`, `prio6`, `prio7`, `prio8`, `f_id_user`) VALUES
(27, 'RAM', 'Merk Processor', 'Ukuran Penyimpanan', 'Harga', 'Jenis Penyimpanan', 'Sistem Operasi', 'Daya Tahan Baterai', 'Ukuran Layar', 7),
(28, 'RAM', 'Ukuran Penyimpanan', 'Merk Processor', 'Daya Tahan Baterai', 'Harga', 'Jenis Penyimpanan', 'Sistem Operasi', 'Ukuran Layar', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(2, 'admin', '$2y$10$vKlD7o2zW7D0NyeRZ9gIOuq/H5cD/hjZgmjZ20.8.yRE9FHaJKqkq', 0),
(7, 'yupi', '$2y$10$ZxU.kfq5Z4OIgfdL4MF8pOvO2Xwn.tvyo.2Yk.Ngmz8AXlYKsZONG', 1),
(10, 'pengguna', '$2y$10$tm/hKTjwdsY2jAvwJUxPpOsioCGbcpm0FiLsZ7sWtBa2z6.VxEYIW', 1),
(11, 'akun', '$2y$10$1AO.NqOqhihWy4PCLzsgKuVHiKNHzotDHhZbwGRz3YDydfdQcz3U6', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`),
  ADD KEY `f_id_kategori` (`f_id_kategori`);

--
-- Indeks untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD PRIMARY KEY (`id_bobot`),
  ADD UNIQUE KEY `f_id_user` (`f_id_user`),
  ADD KEY `id_user` (`f_id_user`);

--
-- Indeks untuk tabel `kategori_alt`
--
ALTER TABLE `kategori_alt`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kec_alt_kriteria`
--
ALTER TABLE `kec_alt_kriteria`
  ADD PRIMARY KEY (`id_alt_kriteria`),
  ADD KEY `f_id_alternatif` (`f_id_alternatif`),
  ADD KEY `f_id_kriteria` (`f_id_kriteria`,`f_id_sub_kriteria`),
  ADD KEY `f_id_sub_kriteria` (`f_id_sub_kriteria`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `f_id_kriteria` (`f_id_kriteria`);

--
-- Indeks untuk tabel `tabel_tampung`
--
ALTER TABLE `tabel_tampung`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `f_id_user_2` (`f_id_user`),
  ADD KEY `f_id_user` (`f_id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  MODIFY `id_bobot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kategori_alt`
--
ALTER TABLE `kategori_alt`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kec_alt_kriteria`
--
ALTER TABLE `kec_alt_kriteria`
  MODIFY `id_alt_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `tabel_tampung`
--
ALTER TABLE `tabel_tampung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD CONSTRAINT `alternatif_ibfk_1` FOREIGN KEY (`f_id_kategori`) REFERENCES `kategori_alt` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `bobot_kriteria_ibfk_1` FOREIGN KEY (`f_id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kec_alt_kriteria`
--
ALTER TABLE `kec_alt_kriteria`
  ADD CONSTRAINT `kec_alt_kriteria_ibfk_1` FOREIGN KEY (`f_id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kec_alt_kriteria_ibfk_2` FOREIGN KEY (`f_id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kec_alt_kriteria_ibfk_3` FOREIGN KEY (`f_id_sub_kriteria`) REFERENCES `sub_kriteria` (`id_sub_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`f_id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tabel_tampung`
--
ALTER TABLE `tabel_tampung`
  ADD CONSTRAINT `tabel_tampung_ibfk_1` FOREIGN KEY (`f_id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
