-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 01:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `souqbh`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressid` int(4) NOT NULL,
  `block` int(3) NOT NULL,
  `building` int(5) NOT NULL,
  `road` int(4) NOT NULL,
  `addinfo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `id` int(4) NOT NULL,
  `oid` int(4) NOT NULL,
  `pid` int(4) NOT NULL,
  `qty` int(4) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oid` int(4) NOT NULL,
  `uid` int(4) NOT NULL,
  `addressid` int(4) NOT NULL,
  `date/time` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(4) NOT NULL,
  `type` varchar(30) NOT NULL,
  `stock` int(4) NOT NULL,
  `picture` text NOT NULL,
  `pname` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `type`, `stock`, `picture`, `pname`, `description`, `price`) VALUES
(1, 'drink', 35, '', 'Apple Juice', 'Fresh apple juice for Almarai', 0.15),
(2, 'drink', 10, '', 'Barbican Rasberry', 'Raspberry barbicanrasberry', 0.35),
(3, 'drink', 10, '', 'Black Coffee', 'Brazilian Black Coffee', 0.6),
(4, 'drink', 5, '', 'Gran Rasberry', 'Fresh Gran Rasberry', 1.5),
(5, 'drink', 40, '', 'Red Bull', 'Energy drink red bull', 0.95),
(6, 'drink', 22, '', 'Kinza Citrus', 'kinza Citrus', 0.2),
(7, 'drink', 22, '', 'Kinza cola', 'kinza cola', 0.2),
(8, 'drink', 22, '', 'Kinza Lemon', 'kinza Lemon', 0.2),
(9, 'drink', 10, '', 'Fruit Juice', 'Fruit juice smoothie', 0.4),
(10, 'drink', 15, '', 'Mango Nectar', 'Awal Manago Nectar', 0.2),
(11, 'drink', 10, '', 'Milk', 'Fresh Milk Almarai', 1.35),
(12, 'drink', 12, '', 'Orange Juice', 'Nada Orange Juice', 0.2),
(13, 'drink', 3, '', 'Cardamom Tea', 'Tea Cardamom tea', 2.7),
(14, 'drink', 10, '', 'Mint Green Tea', 'Mint Green Tea', 2.2),
(15, 'drink', 50, '', 'Water', 'Water', 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `type`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'abc123', 'admin123@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressid`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `f1` (`oid`),
  ADD KEY `f2` (`pid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `foreignkey1` (`uid`),
  ADD KEY `foreignkey2` (`addressid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressid` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `f1` FOREIGN KEY (`oid`) REFERENCES `orders` (`oid`),
  ADD CONSTRAINT `f2` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `foreignkey1` FOREIGN KEY (`uid`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `foreignkey2` FOREIGN KEY (`addressid`) REFERENCES `address` (`addressid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
