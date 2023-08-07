-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 03:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectsp_dbw`
--

-- --------------------------------------------------------

--
-- Table structure for table `dj`
--

CREATE TABLE `dj` (
  `id` int(11) NOT NULL,
  `dasd` int(11) DEFAULT NULL,
  `dasdsa` int(11) DEFAULT NULL,
  `dasdas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `field_value`
--

CREATE TABLE `field_value` (
  `id` int(11) NOT NULL,
  `formName` varchar(255) NOT NULL,
  `keyName` varchar(255) NOT NULL,
  `valueType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purnendu talukder`
--

CREATE TABLE `purnendu talukder` (
  `id` int(11) NOT NULL,
  `heghit` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `students` int(11) DEFAULT NULL,
  `fields` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `students`, `fields`) VALUES
(1, 200, 'park'),
(2, 200, 'park');

-- --------------------------------------------------------

--
-- Table structure for table `studentinformation`
--

CREATE TABLE `studentinformation` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `table_names`
--

CREATE TABLE `table_names` (
  `table_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_names`
--

INSERT INTO `table_names` (`table_name`) VALUES
('vehicle'),
('Purnendu Talukder'),
('school'),
('StudentInFormation');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `Brand` varchar(255) DEFAULT NULL,
  `Tire` varchar(255) DEFAULT NULL,
  `dsadsa` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `Brand`, `Tire`, `dsadsa`) VALUES
(1, 'das', 'das', 'da');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dj`
--
ALTER TABLE `dj`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_value`
--
ALTER TABLE `field_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purnendu talukder`
--
ALTER TABLE `purnendu talukder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentinformation`
--
ALTER TABLE `studentinformation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dj`
--
ALTER TABLE `dj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_value`
--
ALTER TABLE `field_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `purnendu talukder`
--
ALTER TABLE `purnendu talukder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studentinformation`
--
ALTER TABLE `studentinformation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
