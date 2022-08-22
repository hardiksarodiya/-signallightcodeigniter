-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 22, 2022 at 09:02 AM
-- Server version: 5.7.39-0ubuntu0.18.04.2
-- PHP Version: 7.2.34-28+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `signal`
--

-- --------------------------------------------------------

--
-- Table structure for table `signaldata`
--

CREATE TABLE `signaldata` (
  `signalid` int(11) NOT NULL,
  `signalvalue` varchar(255) NOT NULL,
  `signalordor` varchar(255) NOT NULL,
  `signalgreenlight` int(11) NOT NULL,
  `signalyellowlight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `signaldata`
--

INSERT INTO `signaldata` (`signalid`, `signalvalue`, `signalordor`, `signalgreenlight`, `signalyellowlight`) VALUES
(1, '3,4,2,1', '4,3,1,2', 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signaldata`
--
ALTER TABLE `signaldata`
  ADD PRIMARY KEY (`signalid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signaldata`
--
ALTER TABLE `signaldata`
  MODIFY `signalid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
