-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2020 at 04:55 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main`
--

-- --------------------------------------------------------

--
-- Table structure for table `ccavenue_config`
--

CREATE TABLE `ccavenue_config` (
  `id` int(11) NOT NULL,
  `merchant_id` varchar(155) NOT NULL,
  `status` int(11) NOT NULL COMMENT '''demo=>0'',''live=>1''',
  `working_key` varchar(255) NOT NULL,
  `access_code` varchar(255) NOT NULL,
  `live_url` text NOT NULL,
  `demo_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ccavenue_config`
--

INSERT INTO `ccavenue_config` (`id`, `merchant_id`, `status`, `working_key`, `access_code`, `live_url`, `demo_url`) VALUES
(1, '178695', 0, 'BE3F289E2EE663123E95B854004E5E45', 'AVGC03HA03BQ74CGQB', 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction', 'https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ccavenue_config`
--
ALTER TABLE `ccavenue_config`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ccavenue_config`
--
ALTER TABLE `ccavenue_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
