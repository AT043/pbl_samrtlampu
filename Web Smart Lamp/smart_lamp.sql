-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2024 at 09:00 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_lamp`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `login_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `username`, `login_time`) VALUES
(1, 'admine7', '2024-01-15 08:11:40'),
(2, 'admine7', '2024-01-15 09:52:38'),
(3, 'admine7', '2024-01-15 14:01:46'),
(4, 'testop', '2024-01-15 14:19:27'),
(5, 'testop', '2024-01-15 14:26:40'),
(6, 'admine7', '2024-01-15 14:28:54'),
(7, 'testop', '2024-01-15 15:21:51'),
(8, 'testop', '2024-01-15 15:23:43'),
(9, 'testop', '2024-01-15 16:52:43'),
(10, 'testop', '2024-01-15 16:53:28'),
(11, 'admine7', '2024-01-15 17:00:14'),
(12, 'testop', '2024-01-15 17:02:35'),
(13, 'testop', '2024-01-15 17:06:50'),
(14, 'admine7', '2024-01-15 17:08:04'),
(15, 'testop', '2024-01-15 17:14:58'),
(16, 'admine7', '2024-01-15 17:21:51'),
(17, 'admine7', '2024-01-15 20:42:48'),
(18, 'admine7', '2024-01-15 22:13:09'),
(19, 'admine7', '2024-01-16 07:20:01'),
(20, 'testop', '2024-01-16 08:26:24'),
(21, 'admine7', '2024-01-16 08:27:52'),
(22, 'admine7', '2024-01-16 10:24:39'),
(23, 'admine7', '2024-01-16 10:45:26'),
(24, 'testop', '2024-01-16 10:53:18'),
(25, 'testop', '2024-01-16 10:54:02'),
(26, 'admine7', '2024-01-16 12:27:45'),
(27, 'admine7', '2024-01-16 13:27:59'),
(28, 'admine7', '2024-01-16 18:10:55'),
(29, 'admine7', '2024-01-16 20:07:09'),
(30, 'admine7', '2024-01-16 20:16:23'),
(31, 'admine7', '2024-01-16 20:18:21'),
(32, 'admine7', '2024-01-16 21:12:56'),
(33, 'admine7', '2024-01-16 21:18:22'),
(34, 'testop', '2024-01-16 21:22:29'),
(35, 'admine7', '2024-01-16 21:23:19'),
(36, 'admine7', '2024-01-16 21:38:15'),
(37, 'admine7', '2024-01-16 22:06:28'),
(38, 'admine7', '2024-01-17 01:15:02'),
(39, 'admine7', '2024-01-17 08:24:06'),
(40, 'admine7', '2024-01-17 08:28:04'),
(41, 'admine7', '2024-01-17 17:18:16'),
(42, 'admine7', '2024-01-18 05:59:42'),
(43, 'admine7', '2024-01-18 12:04:20'),
(44, 'admine7', '2024-01-19 10:33:56'),
(45, 'admine7', '2024-01-19 13:49:07'),
(46, 'admine7', '2024-01-19 21:25:51'),
(47, 'admine7', '2024-01-20 09:09:44'),
(48, 'admine7', '2024-01-20 18:32:30'),
(49, 'admine7', '2024-01-20 19:35:26'),
(50, 'admine7', '2024-01-20 21:22:30'),
(51, 'admine7', '2024-01-20 22:10:30'),
(52, 'qqqq', '2024-01-20 23:25:40'),
(53, 'admine7', '2024-01-20 23:26:54'),
(54, 'admine1', '2024-01-20 23:48:18'),
(55, 'admine7', '2024-01-20 23:56:30'),
(56, 'admine7', '2024-01-21 00:37:40'),
(57, 'admine1', '2024-01-21 02:15:25'),
(58, 'admine7', '2024-01-21 02:20:53'),
(59, 'admine1', '2024-01-21 02:24:05'),
(60, 'admine7', '2024-01-21 08:22:52'),
(61, 'sup', '2024-01-21 10:35:17'),
(62, 'sup', '2024-01-21 10:45:49'),
(63, 'admine1', '2024-01-21 11:13:34'),
(64, 'admine1', '2024-01-21 13:17:57'),
(65, 'admine1', '2024-01-21 13:18:40'),
(66, 'admine1', '2024-01-21 13:21:53'),
(67, 'admine1', '2024-01-21 13:23:22'),
(68, 'admine1', '2024-01-21 15:02:33'),
(69, 'admine7', '2024-01-21 15:10:42'),
(70, 'pilho', '2024-01-21 15:17:15'),
(71, 'admine7', '2024-01-21 15:18:27'),
(72, 'admine7', '2024-01-21 15:27:35'),
(73, 'admine1', '2024-01-21 15:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `manual_lamp`
--

CREATE TABLE `manual_lamp` (
  `no_lampu` int NOT NULL,
  `waktu` datetime NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `manual_lamp`
--

INSERT INTO `manual_lamp` (`no_lampu`, `waktu`, `status`) VALUES
(1, '2024-01-21 15:57:18', 0),
(2, '2024-01-21 15:57:19', 0),
(3, '2024-01-21 15:57:19', 0),
(4, '2024-01-21 15:57:19', 0),
(5, '2024-01-15 12:15:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `scheduling`
--

CREATE TABLE `scheduling` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `scheduling`
--

INSERT INTO `scheduling` (`id`, `username`, `tanggal`, `mulai`, `selesai`, `status`) VALUES
(1, 'admine1', '2024-01-21', '15:57:00', '15:59:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `token_admin`
--

CREATE TABLE `token_admin` (
  `id_token` int NOT NULL,
  `token` varchar(10) NOT NULL,
  `admin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `token_admin`
--

INSERT INTO `token_admin` (`id_token`, `token`, `admin`) VALUES
(1, '121213', 'admineo'),
(2, 'IQ51ID', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `permissions` int NOT NULL,
  `otp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `otp_expiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `permissions`, `otp`, `otp_expiration`) VALUES
(1, 'admine1', 'daffaassyamthariq@gmail.com', '$2y$10$8/oQ.yHxGWuoHzagVdhdaeHC5XryMUkM2eMFFnR.VYFOTvsQ7sy/S', 2, '', NULL),
(13, 'admine7', 'qqq@q.co', '$2y$10$Z6HUu/3vGzPutWrdbP89YOZ3b0kxRMKfi5UoDkFFvSjr6C5NT2sdm', 1, '', NULL),
(28, 'sup', 'sup@mau.co', '$2y$10$GdE4XqZ9zfybNDCawyn6.uB18BMnyoAR8/m1Ss6urVge9jK9K9krW', 0, '', NULL),
(30, 'pilho', 'diegogomez81655@gmail.com', '$2y$10$icu.GmWKC1/bPzZElSzfPui.ltZzclAJfjtH5d2sIBgT0ZA.I78tq', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int NOT NULL,
  `tgl` datetime NOT NULL,
  `expired` datetime NOT NULL,
  `token` varchar(40) NOT NULL,
  `username` varchar(50) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `useragent` varchar(150) NOT NULL,
  `stat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `tgl`, `expired`, `token`, `username`, `ip`, `useragent`, `stat`) VALUES
(1, '2024-01-14 06:21:10', '2024-01-14 12:21:10', '188f5b240263c28e1ccd1cff63190c3db0d0911c', 'testop', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(2, '2024-01-14 06:22:09', '2024-01-14 12:22:09', '4f2e4a82db5e44c8d78f775318d2527f3ebb8bc1', 'testop', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(3, '2024-01-14 23:34:25', '2024-01-15 05:34:26', '4afae12513c7ae1abe445baf0f4ad91bdd99b077', 'testop', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(4, '2024-01-14 23:36:39', '2024-01-15 05:36:39', 'f0612ebc7574b0fc43e47313d19f85603fb37c9e', 'testop', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(5, '2024-01-14 23:37:51', '2024-01-15 05:37:51', '3ce6cccabcc831c255850a65e36d884d6b55e26a', 'testop', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(6, '2024-01-14 23:38:02', '2024-01-15 05:38:02', '7dfae71b6b3221d1a40f000b1ad7b0c6e99fdbe1', 'admine7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(7, '2024-01-15 00:07:53', '2024-01-15 06:07:53', '2b3849708fb51184f3525df03977155a76b7449b', 'testop', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(8, '2024-01-15 00:08:55', '2024-01-15 06:08:55', '217bc611b0099c8972c7a208aece94888e1ce7a5', 'admine7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(9, '2024-01-15 00:09:39', '2024-01-15 06:09:39', '58bea2f208dc8ff502b38fd4df4b8e9ace54174e', 'admine7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(10, '2024-01-15 00:09:50', '2024-01-15 06:09:50', '6b2401dc1a05625fabf975a04406c787543fafe7', 'admine7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(11, '2024-01-15 00:29:38', '2024-01-15 06:29:38', 'ff6068baab75605679c22a2684a78953130e39ea', 'testop', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(12, '2024-01-15 00:29:44', '2024-01-15 06:29:44', '879fc1fd031493dd7235d440978428c79d0f4c58', 'testop', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1),
(13, '2024-01-15 00:44:34', '2024-01-15 06:44:34', 'edfa318f03ed982be42c4534ec5f8f011daae29e', 'admine7', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manual_lamp`
--
ALTER TABLE `manual_lamp`
  ADD PRIMARY KEY (`no_lampu`);

--
-- Indexes for table `scheduling`
--
ALTER TABLE `scheduling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_admin`
--
ALTER TABLE `token_admin`
  ADD PRIMARY KEY (`id_token`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `scheduling`
--
ALTER TABLE `scheduling`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token_admin`
--
ALTER TABLE `token_admin`
  MODIFY `id_token` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
