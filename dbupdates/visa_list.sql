-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2020 at 02:42 PM
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
-- Table structure for table `visa_list`
--

CREATE TABLE `visa_list` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `visa_title` text NOT NULL,
  `visa_amount` float(10,2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visa_list`
--

INSERT INTO `visa_list` (`id`, `country_id`, `visa_title`, `visa_amount`, `created`) VALUES
(1, 1, '30 Days Stay Single Entry', 50.00, '2020-01-25 11:39:58'),
(2, 1, '30 Days Stay Multiple Entry', 100.00, '2020-01-25 11:39:58'),
(3, 1, '90 Days Stay Single Entry', 150.00, '2020-01-25 11:40:36'),
(4, 1, '90 Days Stay Multiple Entry', 200.00, '2020-01-25 11:40:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `visa_list`
--
ALTER TABLE `visa_list`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `visa_list`
--
ALTER TABLE `visa_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
