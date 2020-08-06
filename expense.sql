-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2020 at 12:40 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `expense`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowed`
--

CREATE TABLE `borrowed` (
  `b_id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `date` date NOT NULL,
  `borrowed` int(10) NOT NULL,
  `person` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrowed`
--

INSERT INTO `borrowed` (`b_id`, `userid`, `date`, `borrowed`, `person`) VALUES
(1, 1, '2020-07-28', 500, 'Ramesh'),
(2, 1, '2020-08-19', 500, 'Ramesh');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `userid` int(10) NOT NULL,
  `Bill` int(10) NOT NULL,
  `Entertainment` int(10) NOT NULL,
  `Food` int(10) NOT NULL,
  `Shopping` int(10) NOT NULL,
  `Travel` int(10) NOT NULL,
  `Total` int(10) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`userid`, `Bill`, `Entertainment`, `Food`, `Shopping`, `Travel`, `Total`, `date`) VALUES
(1, 2000, 2000, 4000, 1000, 0, 13000, 'August 2020');

-- --------------------------------------------------------

--
-- Table structure for table `lent`
--

CREATE TABLE `lent` (
  `l_id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `date` date NOT NULL,
  `lent` int(10) NOT NULL,
  `person` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transactionid` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `date` date NOT NULL,
  `amount` int(10) NOT NULL,
  `category` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transactionid`, `userid`, `date`, `amount`, `category`, `note`) VALUES
(1, 1, '2020-07-30', 100, 'food', ''),
(3, 1, '2020-07-30', 100, 'bills', ''),
(4, 1, '2020-07-30', 100, 'bills', ''),
(5, 1, '2020-07-30', 100, 'bills', ''),
(6, 1, '2020-08-05', 100, 'bills', ''),
(7, 1, '2020-07-28', 100, 'bills', ''),
(8, 1, '2020-08-04', 200, 'general', ''),
(10, 1, '2020-08-13', 500, 'food', ''),
(11, 1, '2020-08-27', 600, 'entertainment', ''),
(13, 1, '2020-08-17', 1000, 'shopping', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `currentbudget` int(10) NOT NULL,
  `balance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `contact`, `username`, `password`, `currentbudget`, `balance`) VALUES
(1, 'Vanshika Agrawal', '7489269694', 'vanshika56', 'qwert12345', 13000, 10600),
(3, 'Vanshika Agrawal', '7489269694', 'vanshika562', 'qwertr', 0, 0),
(4, 'Vanshika Agrawal', '9329988157', 'vanshika5622', '1234', 0, 0),
(5, 'pradhi', '7489269694', 'pradhi1812', '1234', 0, 0),
(6, 'Vanshika Agrawal', '7489', 'smhpost1', 'asdf', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowed`
--
ALTER TABLE `borrowed`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `lent`
--
ALTER TABLE `lent`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transactionid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowed`
--
ALTER TABLE `borrowed`
  MODIFY `b_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lent`
--
ALTER TABLE `lent`
  MODIFY `l_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transactionid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
