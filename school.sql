-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jul 2024 pada 13.23
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
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'admin1', 'dindagatya2@gmail.com', '12345678', '2024-07-25 02:14:50'),
(2, 'dinda', 'dindagatya2@gmail.com', '$2y$10$QDC8cQDVRKaiCVa4LB.1aeaX9kkcJ3pm/ngnhtFu/dAADTBZ0U2V6', '2024-07-25 02:17:13'),
(3, 'admin2', 'admin@admin.com', '$2y$10$I/kYAYst1o83JHHFBcyM1uZNyXANBOlAV4aAt38dqgBBe7Up.9M8i', '2024-07-25 02:21:04'),
(4, 'dindagatya', 'dindagtya2@gmail.com', '$2y$10$oCih5yyXF0p.fK4RdS8CrO2QJogRqDBSOQIISQlSU4wnsF5cM4yoq', '2024-07-25 09:05:57'),
(5, 'dinda gatya', 'dindagatya2@gmail.com', '$2y$10$1z4oR.Q3kssIVKXKAbNpTu/NfgPFppQZIs1hB2OlmJ3oS8/stdqAy', '2024-07-25 09:15:08'),
(6, 'admin', 'admin@admin.com', '$2y$10$xgzfT56dvmAzc1zSGy1Yyug/PQCeD6k/nNohukP3L8UNwtZ/QFg7O', '2024-07-25 09:22:44'),
(7, 'dinda', 'dindagatya@gmail.com', '$2y$10$w3quDNG03UG/.q2Oepet6uZTCQgX0j0jS4GfQiuIGEQB.oS0K/EDG', '2024-07-25 09:49:42'),
(8, 'Dinda gatya', 'dinda@gmail.com', '$2y$10$3TtEr6ZplSj8CFil1TbIz.jWXnPnkA4tOzUlPJsgd9xn2wltvaCpa', '2024-07-25 09:51:48'),
(9, 'dicco ramadhan', 'dico@gmail.com', '$2y$10$lMvizt7lchiMxp9tdXm1wewBXmhqzayu0XqrFK5/1pZ/l/EnZoN2C', '2024-07-25 11:04:00'),
(10, 'admin', '', 'password', '2024-07-25 13:15:42'),
(11, 'dindagatya', 'dinda@gmai.com', '$2y$10$CsnPgzjHZ3c7E5cmI7.2R.TleI96tdc0gqvZXA8ZP446xXdVq6DqK', '2024-07-25 14:12:44'),
(12, 'dindagatya', 'dinda@gmail.com', '$2y$10$3fBqEDzNR6rxK5temPPCDOawfn4DKq5Nuf0VAOjL4a7WM8CRQ0Wgu', '2024-07-25 14:17:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `created_at`, `image`) VALUES
(4, 'Pengumuman Libur Sekolah', 'Sekolah akan diliburkan mulai tanggal 1 Agustus hingga 5 Agustus.', '2024-07-25 02:35:32', 'images/holiday.jpg'),
(5, 'Prestasi Siswa', 'Siswa kelas 12 berhasil meraih juara 1 dalam lomba debat nasional.', '2024-07-25 02:35:32', 'images/achievement.jpg'),
(6, 'Kegiatan Bakti Sosial', 'Sekolah akan mengadakan kegiatan bakti sosial pada tanggal 10 Agustus.', '2024-07-25 02:35:32', 'images/social_work.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_of_birth` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `nisn` varchar(20) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `created_by`, `created_at`, `date_of_birth`, `address`, `nisn`, `gender`, `parent_name`, `phone`) VALUES
(11, 'Muhammad alifiansyah', 'ali@gmail.com', 8, '2024-07-25 09:53:10', '2024-07-09', 'depok', '', 'L', '', ''),
(12, 'John Doe', 'john@example.com', 1, '2024-07-25 13:15:42', '2000-01-01', '123 Main St', '1234567890', 'L', 'Jane Doe', '081234567890');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
