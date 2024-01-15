-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 15, 2024 at 05:50 AM
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
(2, 'admine7', '2024-01-15 09:52:38');

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
(1, '2024-01-15 12:15:32', 1),
(2, '2024-01-15 12:15:32', 1),
(3, '2024-01-15 12:15:32', 1),
(4, '2024-01-15 12:15:32', 1),
(5, '2024-01-15 12:15:32', 1);

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
  `permissions` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `permissions`) VALUES
(1, 'testop', 'testop@mail.y', '$2y$10$8/oQ.yHxGWuoHzagVdhdaeHC5XryMUkM2eMFFnR.VYFOTvsQ7sy/S', 0),
(13, 'admine7', 'qqq@q.co', '$2y$10$Z6HUu/3vGzPutWrdbP89YOZ3b0kxRMKfi5UoDkFFvSjr6C5NT2sdm', 1),
(25, 'sup', 'sup@mau.co', '$2y$10$03uxhlUFW80rtWOuIz1FDOBUC0LbEF/nOsO6Gsz2m/YgVtJfL6NXi', 0),
(26, 'pilho', 'pilho@mage.za', '$2y$10$Mhdpw.DbV/9ZA9gEkMUZ5.5cF/pxFBPMaoehKX3S8AisxDdLcHGLi', 0),
(27, 'qqqq', 'qqq@0.co', '$2y$10$evxx7MdMlL1vP888dHSe6eCdb8TkjIg66rz9a3z6905b60jViH6Wi', 0);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `token_admin`
--
ALTER TABLE `token_admin`
  MODIFY `id_token` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
