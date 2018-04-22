-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 11:27 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtransactions`
--

-- --------------------------------------------------------

--
-- Table structure for table `customeractivity`
--

CREATE TABLE `customeractivity` (
  `transaction_id` bigint(11) NOT NULL,
  `parent_id` bigint(11) NOT NULL,
  `amount` double NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customeractivity`
--

INSERT INTO `customeractivity` (`transaction_id`, `parent_id`, `amount`, `type`) VALUES
(1, 1, 20, 'Movie'),
(2, 1, 30, 'cars'),
(3, 1, 40.5, 'Clothing'),
(4, 1, 49.9, 'Fuel'),
(5, 2, 49.9, 'Fuel'),
(6, 2, 39.9, 'Movies'),
(7, 2, 39.9, 'Movies'),
(8, 2, 12.4, 'Transportation'),
(9, 1, 13.6, 'Transportation'),
(10, 1, 500.99, 'cars');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customeractivity`
--
ALTER TABLE `customeractivity`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customeractivity`
--
ALTER TABLE `customeractivity`
  MODIFY `transaction_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
