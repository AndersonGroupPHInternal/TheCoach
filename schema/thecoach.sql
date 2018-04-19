-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2018 at 10:40 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `id` int(11) NOT NULL,
  `campaignname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `RecordId` int(11) NOT NULL,
  `CoachingTopic` varchar(55) NOT NULL,
  `Campaign` varchar(22) NOT NULL,
  `AgentName` varchar(30) NOT NULL,
  `AreaOfSuccess` varchar(30) NOT NULL,
  `AreaOfOpportunity` varchar(30) NOT NULL,
  `ActionPlans` varchar(30) NOT NULL,
  `CoachingFollowUpDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`RecordId`, `CoachingTopic`, `Campaign`, `AgentName`, `AreaOfSuccess`, `AreaOfOpportunity`, `ActionPlans`, `CoachingFollowUpDate`) VALUES
(58, 'yes', 'Horizon Outsourcing', 'qe', 'rewr', 'weryter', 'qweq', '2018-04-10'),
(60, 'no', 'Horizon Outsourcing', 'Juna Juno', 'N/A', 'N/A', 'N/A', '1970-01-01'),
(61, 'yes', 'Flexr/PayPlus/Choice', 'Juan Dela Cruz', '\"Lorem ipsum dolor sit amet, c', '\"Lorem ipsum dolor sit amet, c', '\"Lorem ipsum dolor sit amet, c', '2018-04-01'),
(62, 'YES', 'Flexible Outsourcing', 'john cena', '8838383', 'q', 'q', '1970-01-01'),
(63, 'No', 'Flexible Outsourcing', 'John john', 'n/a', 'N/A', '\"Lorem ipsum dolor sit amet, c', '2018-04-30'),
(64, 'Yes', 'Horizon Outsourcing', 'Angel Cruz', 'Lorem Ipsum', 'Lorem Ipsum', 'Lorem ipsum', '2018-04-29'),
(65, 'Yes', 'Horizon Outsourcing', 'qqweq', 'qweqwe', 'qweqw', 'qweqwe', '2018-04-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`RecordId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `RecordId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
