-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Sep 2021 pada 01.25
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tgs1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `idjawaban` int(11) NOT NULL,
  `idsoal` int(11) NOT NULL,
  `isi_jawaban` text DEFAULT NULL,
  `benarkah` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`idjawaban`, `idsoal`, `isi_jawaban`, `benarkah`) VALUES
(1, 1, 'hitam', 0),
(2, 1, 'putih', 1),
(3, 2, 'hitam', 1),
(4, 2, 'putih', 0),
(5, 3, 'hitam', 1),
(6, 3, 'pink', 0),
(7, 4, 'biru tua banget', 1),
(8, 4, 'merah', 0),
(9, 5, 'hitam', 1),
(10, 5, 'silver', 0),
(11, 6, 'hitam keabuan', 1),
(12, 6, 'biru muda', 0),
(13, 7, 'hijau', 1),
(14, 7, 'putih', 0),
(15, 8, 'merah', 1),
(16, 8, 'putih', 0),
(17, 9, 'magenta', 1),
(18, 9, 'putih', 0),
(19, 10, 'biru', 1),
(20, 10, 'putih', 0),
(21, 1, 'merah', 0),
(22, 1, 'biru', 0),
(23, 2, 'hijau', 0),
(24, 2, 'kuning', 0),
(25, 3, 'ungu', 0),
(26, 3, 'coklat', 0),
(27, 4, 'orange', 0),
(28, 4, 'hijau', 0),
(29, 5, 'emas', 0),
(30, 5, 'pink', 0),
(31, 6, 'hijau muda', 0),
(32, 6, 'kuning', 0),
(33, 7, 'merah', 0),
(34, 7, 'ungu tua', 0),
(35, 8, 'cokelat muda', 0),
(36, 8, 'biru', 0),
(37, 9, 'cyan', 0),
(38, 9, 'hijau muda', 0),
(39, 10, 'hitam', 0),
(40, 10, 'emas', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `idsoal` int(11) NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `pertanyaan` text DEFAULT NULL,
  `halaman_ke` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`idsoal`, `nomor`, `pertanyaan`, `halaman_ke`) VALUES
(1, 1, 'Apa nama warna dari #FFFFFF ?', 1),
(2, 2, 'Apa nama warna dari #000000 ?', 1),
(3, 3, 'Apa nama warna dari #111111 ?', 2),
(4, 4, 'Apa nama warna dari #111333 ?', 2),
(5, 5, 'Apa nama warna dari #222222 ?', 3),
(6, 6, 'Apa nama warna dari #323232 ?', 3),
(7, 7, 'Apa nama warna dari #1ef234 ?', 4),
(8, 8, 'Apa nama warna dari #ef3422 ?', 4),
(9, 9, 'Apa nama warna dari #ef2da1 ?', 5),
(10, 10, 'Apa nama warna dari #222ef1 ?', 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`idjawaban`),
  ADD KEY `fk_jawaban_soal_idx` (`idsoal`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`idsoal`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `idjawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `fk_jawaban_soal` FOREIGN KEY (`idsoal`) REFERENCES `soal` (`idsoal`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
