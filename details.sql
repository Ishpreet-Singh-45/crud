-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2021 at 03:37 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `records`
--

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `Id` int(3) UNSIGNED NOT NULL,
  `Name` tinytext NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` int(11) NOT NULL,
  `DOB` varchar(20) NOT NULL,
  `Gender` text NOT NULL,
  `City` text NOT NULL,
  `State` text NOT NULL,
  `Current` text NOT NULL,
  `Permanent` text NOT NULL,
  `Document` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`Id`, `Name`, `Email`, `Phone`, `DOB`, `Gender`, `City`, `State`, `Current`, `Permanent`, `Document`, `Image`) VALUES
(32, 'First Name', 'name@email.com', 1234567890, '4-April-2004', 'Male', 'City', 'Punjab', 'Current Residing Address', 'Permanent Residing Address', 'Document1.pdf', 'random3.jpg'),
(33, 'Harry Potetr', 'neyowad593@sejkt.com', 2147483647, '4-April-2005', 'Other', 'Mohali', 'Punjab', 'This is a test address testing with the test message to test the test form.... LOL', 'Same as current. BIG LOL', 'Document1.docx', 'random2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `Id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
