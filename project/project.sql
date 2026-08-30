-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 30, 2026 at 11:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

DROP DATABASE IF EXISTS `project`;
CREATE DATABASE `project`;
USE `project`;
--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `value`) VALUES
(1, 'User', 11),
(2, 'Manager', 22),
(3, 'Admin', 33);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1,
  `photo` varchar(255) DEFAULT NULL,
  `suspended` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `role_id`, `photo`, `suspended`, `created_at`, `updated_at`) VALUES
(1, 'Alice', 'alice@gmail.com', '23890248', 'Some address', 'password', 3, 'black-apple.jpg', 0, '2026-08-29 15:49:37', NULL),
(2, 'Bob', 'bob@gmail.com', '2938092842', 'Bob\'s address', 'password', 2, 'cityscape.jpg', 0, '2026-08-29 16:14:02', NULL),
(4, 'Eveline Mills', 'mparisian@gmail.com', '+17034747333', '542 Vaughn Village Suite 596\nPort Queenie, UT 32688', 'password', 2, NULL, 0, '2026-08-30 15:11:25', NULL),
(5, 'Gust Bins', 'emelie.mann@gmail.com', '1-551-718-9587', '768 Claudie Green Suite 271\nTevinside, CO 18169-5374', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(7, 'Prof. Marquise Kiehn I', 'rkutch@mohr.com', '352-426-7162', '75209 Anastasia Parkway Suite 235\nNorth Jazmyneview, DC 37896-7045', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(8, 'Tanya Hessel DVM', 'rose.yost@hotmail.com', '+1-360-422-8025', '391 Casimer Turnpike\nPort Scotty, OH 94737-0918', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(9, 'Simeon Hegmann', 'anika97@gmail.com', '+1.276.202.0565', '21631 Pierre Street\nLake Madge, FL 81134-6203', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(10, 'Jacey Nitzsche DDS', 'ischinner@hotmail.com', '1-707-318-4535', '4216 Josue Cliffs\nTurcotteland, NM 52265', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(11, 'Judy Littel', 'ggibson@deckow.com', '980.344.7795', '659 Destin Burgs Suite 765\nO\'Connellville, GA 83134-5620', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(12, 'Tomasa Walter', 'fabian.white@hotmail.com', '+1-281-492-5591', '19873 Alysa Corner\nSouth Brandt, HI 79839', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(13, 'Prof. Adriel Legros IV', 'gstamm@yahoo.com', '+12287897399', '98736 Demarcus Vista Suite 281\nEast Tremayne, MD 10638-8805', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(14, 'Karlie Aufderhar', 'nhartmann@gmail.com', '(364) 909-6386', '7259 Harber Courts\nSouth Devon, MT 65652', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(15, 'Eusebio Halvorson V', 'owolff@hotmail.com', '(657) 580-2109', '54563 Zemlak Glens Apt. 974\nSchultzview, PA 89479', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(16, 'Tracy Flatley', 'allie81@white.biz', '629.530.0886', '815 Sarah Track Apt. 029\nPfefferbury, AR 80522-8140', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(17, 'Alycia Cremin', 'braun.garth@kozey.com', '+1-559-684-4095', '437 McKenzie Dale\nVilmachester, AK 91096', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(18, 'Annabell Littel', 'chyna.prosacco@stroman.com', '+1-407-462-5038', '25528 Austin Locks\nDasiabury, ME 03975-6670', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(19, 'Rickie Welch', 'gerhold.charlotte@gulgowski.info', '(936) 624-1142', '1439 Jacynthe Summit Suite 972\nPollichstad, IL 25607-8510', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(20, 'Mr. Bernhard Botsford', 'hrau@gmail.com', '508-703-6485', '4001 Marquardt Extension Apt. 237\nCooperfort, OK 20889-1871', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(21, 'Krystina Lockman', 'karen.nienow@gmail.com', '678-801-7636', '848 Haven Alley Apt. 710\nTorphyport, PA 66811', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL),
(22, 'Carlie Hayes', 'edwardo59@larson.com', '+1 (580) 539-1310', '4204 Hessel Square\nAufderharside, TN 53485', 'password', 1, NULL, 0, '2026-08-30 15:11:25', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
