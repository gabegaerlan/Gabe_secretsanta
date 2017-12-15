-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: us-cdbr-iron-east-05.cleardb.net
-- Generation Time: Dec 15, 2017 at 12:05 AM
-- Server version: 5.6.36-log
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heroku_21d18c1df95a42f`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `username`, `password`) VALUES
(1, 'Gabe', 'Gaerlan', 'gaer4457', '66ec465982a81e16ce2829ce9a81a2d3db663fd7');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `username`, `password`) VALUES
(11, 'Test', 'Testing', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishId` int(11) NOT NULL,
  `wishName` varchar(100) NOT NULL,
  `wishPrice` double NOT NULL,
  `description` varchar(1000) NOT NULL,
  `wishUser` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishId`, `wishName`, `wishPrice`, `description`, `wishUser`) VALUES
(1, 'Anker Powerbank', 44, 'You can buy this on AMAZON for $40', 'Tester'),
(61, 'Teleporter Gun', 80085, 'Get schwifty bitch!! ', 'Pickle Rick '),
(70, 'Dragon Plushy', 69, 'GIVE ME MY PLUSH BACK', 'Drew Fidel');

-- --------------------------------------------------------

--
-- Table structure for table `wishlistusers`
--

CREATE TABLE `wishlistusers` (
  `wishId` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `wishName` varchar(100) NOT NULL,
  `wishPrice` double NOT NULL,
  `description` varchar(1000) NOT NULL,
  `wishUser` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlistusers`
--

INSERT INTO `wishlistusers` (`wishId`, `userID`, `wishName`, `wishPrice`, `description`, `wishUser`) VALUES
(1, 81, 'Anker Powerbank', 44, 'You can buy this on AMAZON for $40', 'Tester'),
(61, 101, 'Teleporter Gun', 80085, 'Get schwifty bitch!!', 'Pickle Rick '),
(70, 141, 'Dragonite Plushy', 69, 'GIVE ME MY PLUSH BACK', 'Drew Fidel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `password` (`password`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishId`);

--
-- Indexes for table `wishlistusers`
--
ALTER TABLE `wishlistusers`
  ADD PRIMARY KEY (`wishId`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `wishlistusers`
--
ALTER TABLE `wishlistusers`
  MODIFY `wishId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wishlistusers`
--
ALTER TABLE `wishlistusers`
  ADD CONSTRAINT `wishlistusers_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
