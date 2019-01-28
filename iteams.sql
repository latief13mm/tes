-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2019 at 04:23 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drupal8intrest`
--

-- --------------------------------------------------------

--
-- Table structure for table `iteams`
--

CREATE TABLE `iteams` (
  `iid` int(11) NOT NULL,
  `iteam_name` varchar(225) NOT NULL,
  `iteam_detail` varchar(225) NOT NULL,
  `iteam_address` varchar(225) NOT NULL,
  `iteam_age` varchar(225) NOT NULL,
  `iteam_interest` int(255) NOT NULL,
  `iteam_offer` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iteams`
--

INSERT INTO `iteams` (`iid`, `iteam_name`, `iteam_detail`, `iteam_address`, `iteam_age`, `iteam_interest`, `iteam_offer`) VALUES
(2, 'Gas craft', 'About Gas craft', '44 - 1 New street Derric PA 100210', '15 Aug 2019', 1, 0),
(3, 'Gas craft', 'About Gas craft', '44 - 1 New street Derric PA 100210', '15 Aug 2019', 1, 0),
(4, 'rrrerer', 'fgdfAbout Gas craft', '44 - 1 New street Derric PA 100210', '15 Aug 2019', 0, 0),
(5, 'dfgGas craft', 'fgdfAbout Gas craft', '44 - 1 New street Derric PA 100210', '15 Aug 2019', 1, 0),
(6, 'dfgGas craft tessss', 'fgdfAbout Gas craft', '44 - 1 New street Derric PA 100210', '15 Aug 2019', 0, 0),
(7, '22', 'fgdfAbout Gas craft', '44 - 1 New street Derric PA 100210', '15 Aug 2019', 0, 0),
(8, '2', 'fgdfAbout Gas craft', '44 - 1 New street Derric PA 100210', '15 Aug 2019', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iteams`
--
ALTER TABLE `iteams`
  ADD PRIMARY KEY (`iid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iteams`
--
ALTER TABLE `iteams`
  MODIFY `iid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
