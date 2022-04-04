-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 08:57 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `message` text NOT NULL,
  `dateSent` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `senderID`, `receiverID`, `message`, `dateSent`) VALUES
(1, 2, 1, 'Hallo', '2022-03-14 10:57:28'),
(2, 2, 1, 'Hallo', '2022-03-14 11:25:26'),
(3, 2, 1, 'Hallo', '2022-03-14 11:25:48'),
(4, 2, 1, 'Hallo', '2022-03-14 11:26:26'),
(5, 2, 1, 'Hallo', '2022-03-14 11:26:31'),
(6, 2, 1, 'Hallo', '2022-03-14 11:26:52'),
(7, 2, 1, 'Hallo', '2022-03-14 11:27:11'),
(8, 2, 1, 'Hallo', '2022-03-14 11:31:30'),
(9, 2, 1, 'Hallo', '2022-03-14 11:43:36'),
(10, 2, 1, 'Hallo', '2022-03-14 11:44:15'),
(11, 2, 1, 'Hallo', '2022-03-14 11:44:51'),
(12, 2, 1, 'Hallo', '2022-03-14 11:45:34'),
(13, 2, 1, 'Hallo', '2022-03-14 11:46:02'),
(14, 2, 1, 'Hallo', '2022-03-14 11:46:30'),
(15, 2, 1, 'Hallo', '2022-03-14 11:47:23'),
(16, 2, 1, 'Hallo', '2022-03-14 11:47:57'),
(17, 2, 1, 'Hallo', '2022-03-14 11:48:18'),
(18, 2, 1, 'Hallo', '2022-03-14 11:48:37'),
(19, 2, 1, 'Hallo', '2022-03-14 11:49:46'),
(20, 2, 1, 'Hallo', '2022-03-14 11:58:44'),
(21, 2, 1, 'Hallo', '2022-03-14 11:59:36'),
(22, 2, 1, 'Hallo', '2022-03-14 12:00:18'),
(23, 2, 1, 'Hallo', '2022-03-14 12:00:37'),
(24, 2, 1, 'Hallo', '2022-03-14 12:03:21'),
(25, 2, 1, 'Hallo', '2022-03-14 12:03:38'),
(26, 2, 1, 'Hallo', '2022-03-14 12:05:53'),
(27, 2, 1, 'Hallo', '2022-03-14 12:05:56'),
(28, 2, 1, 'Hallo', '2022-03-14 12:06:41'),
(29, 2, 1, 'Hallo', '2022-03-14 12:06:47'),
(30, 2, 1, 'Hallo', '2022-03-14 12:07:48'),
(31, 2, 1, 'Hallo', '2022-03-14 12:07:52'),
(32, 2, 1, 'Berichtje', '2022-03-14 12:40:52'),
(33, 2, 1, 'Eyyyy, neem een bericht', '2022-03-14 13:47:41'),
(34, 2, 1, 'Nog een bericht!', '2022-03-14 13:50:44'),
(35, 2, 1, 'Neem en bericht', '2022-03-21 09:15:07'),
(36, 2, 1, 'test', '2022-03-21 10:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`) VALUES
(1, 'gebruikersnaam', 0x6ffb48111a8de8fb7e25356c6efea6dc),
(2, 'meneerTwee', 0xb29f9d06aea3a97daad61d19cd411a72);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
