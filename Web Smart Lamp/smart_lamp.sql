-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 18, 2023 at 05:54 AM
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
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id_admin` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id_admin`, `username`, `email`, `password`, `token`) VALUES
(1, 'uadmine', 'uadmine@zoltra.ak', '$2y$10$7upvEHlA.BVkUeEVrpNnZOxaBNf3ZHhZSt9LkDh4Lry84eh/BTDSO', 'PHEWEW'),
(2, 'adoo', 'dodo@do.my', '$2y$10$NC1uRB3MzfzrQNnp/EKY1.bC/dh5tjRcdjLs97Syly8.BrathzJc2', 'i000p0'),
(3, 'admineJ', 'adminej@zoltra.ak', '$2y$10$bCx2SCsxmgzTf0r.Gr7Znudg9I6qp0.niDOqt5xYbwCjCIhgMEVYW', 'IQ51ID');

-- --------------------------------------------------------

--
-- Table structure for table `token_admin`
--

CREATE TABLE `token_admin` (
  `id_token` int NOT NULL,
  `token` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `token_admin`
--

INSERT INTO `token_admin` (`id_token`, `token`) VALUES
(1, 'IQ51ID');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `username`, `email`, `password`) VALUES
(1, 'tesr', 'tesr@jojo.lo', '$2y$10$VMfj9i6m7ff0gZXMIdNR1.OMUJ7Noo6bPi16Fr8docizuBfcC76n2'),
(6, 'admine', 'admine@dat79.id', '$2y$10$OAUxuYazsAuo2L6cO4Tnw.E8XrZ2hNhGQfu1jiCZiS/e.Q.t0MrFm'),
(7, 'admine1', 'admine123@yao.mk', '$2y$10$aQGr5f9DHpqdQJ0tAcZTdewFyA2mUoqf0KholnUKUNCYinXJvUfA2'),
(8, 'admine2', 'admine21@mail.id', '$2y$10$qhOyjjyYGI22SjppECUuoeV93.6.dFwEPOLJGWQJyzt50MqV2pmR.'),
(9, 'admine3', 'admine3@mail.net', '$2y$10$YHfpX2rXTdFBZhycXhQJgOfsOUb57/tSvdAhRubd0ptN4YEPpKayu'),
(10, 'admine4', 'admine4@zoolta.ak', '$2y$10$3t5zwi.XHbYZF7ARVXGWiulBIb4z/PwBNt/uXn.l7vshmOn7fmNeO'),
(11, 'uadmin', 'uadmin@zooltr.ak', '$2y$10$uZlw6SMVyDovY2BriuUub.4fN3YfY/wfJ/DJHotRNNGPDRFFAY4I6'),
(12, 'userz', 'userz@zoltra.ak', '$2y$10$QemTosrsDafpmU.dpAV6zuBplIEel6WfOr94q3NjotJlYzvj3tfuK'),
(13, 'slamp', 'slamp@zoltra.ak', '$2y$10$G4DsLU9NSzqQIdImNrcdm.ng/3B1MEWo1PJwFV0Qhz21R.7WlevPW'),
(14, 'uzser', 'uzser@zoltra.ak', '$2y$10$sYKuetxVQOWYkhu0XXwjn.7pex6DwuAlzVIgjmjb7A.UlQizi8iFe'),
(15, 'uzser', 'uzser@zoltra.ak', '$2y$10$wIiBwBVb3WBsRSJLGf8cBO0BoEqO4N61ZzFfIMbX7zxHpAQN.eVLu'),
(16, 'usser', 'usser@zoltra.ak', '$2y$10$7tjLrn29xEpzVJiJs2.lm.1Q3RYGyg6JGFGwMuaPREKXuVW8bdiBm'),
(17, 'usert', 'usert@zoltra.ak', '$2y$10$Jv5DSsiVn4oqRQOUTpAHR.yB4bfx/RIzy5JPPgI5Du8Hx5VP2tUym');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `token_admin`
--
ALTER TABLE `token_admin`
  ADD PRIMARY KEY (`id_token`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `token_admin`
--
ALTER TABLE `token_admin`
  MODIFY `id_token` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
