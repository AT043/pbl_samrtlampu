-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 01, 2024 at 10:18 AM
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
  `username` varchar(30) NOT NULL,
  `login_time` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token_admin`
--

CREATE TABLE `token_admin` (
  `id_token` int NOT NULL,
  `token` varchar(10) NOT NULL,
  `admin` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `permissions` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `permissions`) VALUES
(1, 'testop', 'testop@mail.y', '$2y$10$8/oQ.yHxGWuoHzagVdhdaeHC5XryMUkM2eMFFnR.VYFOTvsQ7sy/S', 0),
(13, 'admine7', 'qqq@q.co', '$2y$10$Z6HUu/3vGzPutWrdbP89YOZ3b0kxRMKfi5UoDkFFvSjr6C5NT2sdm', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `token_admin`
--
ALTER TABLE `token_admin`
  MODIFY `id_token` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
