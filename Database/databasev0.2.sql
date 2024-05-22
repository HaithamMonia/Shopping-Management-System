-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 06:33 PM
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
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `id` int(4) NOT NULL,
  `oid` int(4) NOT NULL,
  `pid` int(4) NOT NULL,
  `qty` int(4) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`id`, `oid`, `pid`, `qty`, `price`) VALUES
(1, 2, 42, 1, 3),
(2, 3, 43, 10, 396),
(3, 3, 43, 2, 66),
(4, 4, 44, 3, 6.9),
(5, 4, 44, 2, 4.6);

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oid`, `uid`, `addressid`, `date/time`, `status`) VALUES
(2, 25, 1, '2024-05-21', 'Ack'),
(3, 25, 1, '2024-05-16', 'process'),
(4, 1, 1, '2024-05-29', 'Transit');

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
(42, 'Handsome', 1, 'marsicecream.jpg', 'Haman', 'The best man i ever known', 3),
(43, '', 2, 'peppers.jpg', 'Noor', 'fdvedvfeve', 78),
(44, 'fruit', 5, 'banana.jpeg', 'Banana', 'The best bananan', 2.3),
(45, 'jhvehviehv', 3, 'PartB.png', 'Nes7t', 'HRfvheiv  vbeakvhiuerv v ebkdj', 10),
(46, 'jhvehviehv', 3, 'PartB.png', 'Nes7t', 'HRfvheiv  vbeakvhiuerv v ebkdj', 10),
(47, 'jhvehviehv', 3, 'PartB.png', 'Nes7t', 'HRfvheiv  vbeakvhiuerv v ebkdj', 10),
(48, 'jhvehviehv', 3, 'PartB.png', 'Nes7t', 'HRfvheiv  vbeakvhiuerv v ebkdj', 10),
(49, 'jveenvev', 11, 'Question(1) A.jpeg', 'Haitham', 'fvdf', 33),
(50, 'jveenvev', 11, 'Question(1) A.jpeg', 'Haitham', 'fvdf', 33),
(51, 'jveenvev', 11, 'Question(1) A.jpeg', 'Haitham', 'fvdf', 33),
(52, 'jveenvev', 11, 'Question(1) A.jpeg', 'Haitham', 'fvdf', 33),
(53, 'jveenvev', 11, 'Question(1) A.jpeg', 'Haitham', 'fvdf', 33),
(54, 'jveenvev', 11, 'Question(1) A.jpeg', 'Haitham', 'fvdf', 33),
(55, 'Best of kind', 1, 'broccoli.webp', 'Salam', 'Hard-working', 1e27),
(56, 'Best of kind', 1, 'broccoli.webp', 'Salam', 'Hard-working', 1e27);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(4) NOT NULL,
  `username` varchar(30) NOT NULL,
  `type` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNum` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `type`, `password`, `email`, `phoneNum`, `address`) VALUES
(11, 'admin', 'customer', '$2y$10$IDF8lwQMJrQaXs6HRswVdubDoLpUByrrj5dpYpMq788J/gIFPpigu', 'admin123@gmail.com', '38701203', 'Manama'),
(12, 'yusuf', 'customer', '$2y$10$eUQgOWU5/imQafL/1Ow4V.FwtQ//jiAPxbwHglwEbAm4aw8qyEXTe', 'yusuf@gmail.com', '38387691', 'Manama'),
(13, 'Haitham', 'customer', '$2y$10$ze4dnIWkc4TrZCksIDdAe.6z2CxwvIqF4m46FAwOnnElHZxZ7a8DG', 'haitham123@gmail.com', '38701707', ''),
(15, 'Haitham', 'customer', '$2y$10$DafpW7fsX8VdwFS1zH/KJuDTdRJwFf6ftqPe51F37AI9o1ZYIAqsy', 'haitham22@gmail.com', '38701707', ''),
(16, 'Nasser', 'Customer', '$2y$10$jy0CKanOBTB6LlY85xUG9OeNOrqUM/MAIAA8akzvvTgsXXAQUoxaO', 'nasser@gmail.com', '38701707', ''),
(19, 'Abdullah', 'customer', '$2y$10$.Bx.6u2G8lT2NGP7NZDsl.xA98q./wyMr2YIcZE6hbdYyr03Et29y', 'Abd@gmail.com', '38701707', ''),
(21, 'Ali', 'staff', '$2y$10$C5laEBUu2ZY4Wb0z8Xx7neFDXyhFPfBgB.Yq6CgFt/SMW0j6LN3Oe', 'Ali123@gmail.com', '38701707', ''),
(22, 'yusuf', 'staff', '$2y$10$ZBaT7ZJmNtP/EmKCGiV/guUQ5F10PTdbV3XAoyDDplOolW76cpMO6', 'yusuf123@gmail.com', '38387691', ''),
(24, 'Maha', 'staff', '$2y$10$bPIotc7/XsB.ORD2D9eeX.Hm1Eox1mDMYv8SMgAI7Rbld9Mkmaj.y', 'maha@gmail.com', '38387691', ''),
(25, 'Love', 'customer', '$2y$10$rdvNRrk8NaxOdj4x8EMY/ublnRDmnNlFvUDTh0E.FfyxkJTjT.Y3u', 'love@gmail.com', '38701707', 'My heart');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
