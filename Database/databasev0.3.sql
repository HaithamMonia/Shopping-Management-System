-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:14 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(59, 'Bakery', 30, 'baguette.jpg', 'Baguette', 'delicious baguette', 4),
(60, 'Bakery', 3, 'birthdaycake.jpg', 'Birthday Cake', 'delicious cake', 20),
(61, 'Bakery', 40, 'donuts.webp', 'Donuts', 'nice donuts', 3),
(62, 'Bakery', 8, 'slicedbread.webp', 'Sliced Bread', 'good quality bread', 2.5),
(63, 'Bakery', 7, 'breadrolls.webp', 'Bread Rolls', 'fresh rolls', 1.5),
(64, 'Drink', 50, 'applejuice.jpg', 'Apple Juice', 'fresh and cool', 0.3),
(65, 'Drink', 5, 'coffee.jpg', 'Coffee', 'very nice', 0.8),
(66, 'Drink', 19, 'kinzacitrus.webp', 'Kinza Citrus', 'better soft drink', 0.5),
(67, 'Drink', 5, 'milk.jpg', 'Milk', 'fresh milk', 1.2),
(68, 'Drink', 100, 'water.jpg', 'Water', 'cool water bottle', 0.1),
(69, 'Drink', 23, 'mangojuice.jpg', 'Mango Juice', 'thick mango juice', 0.3),
(70, 'Fruit', 200, 'apple.webp', 'Apple', 'fresh apples', 0.2),
(71, 'Fruit', 200, 'banana.jpeg', 'Banana', 'makes you go bananas', 0.3),
(72, 'Fruit', 10, 'watermelon.jpeg', 'Watermelon', 'watery watermelons', 1),
(73, 'Fruit', 100, 'orange.webp', 'Orange', 'juicy oranges', 0.2),
(74, 'Meat', 16, 'beefpatty.jpg', 'Beef Patty', 'good patty', 1),
(75, 'Meat', 12, 'chickenbreast.jpg', 'Chicken Breast', 'expensive chicken', 2.5),
(76, 'Meat', 31, 'hotdogs.jpg', 'Hotdogs', 'best hotdogs', 1.1),
(77, 'Meat', 400, 'chickenwings.jpg', 'Chicken Wings', 'best type of chicken', 3),
(78, 'Snack', 300, 'extragum.jpg', 'Extra Gum', 'chewy gum', 1.5),
(79, 'Snack', 53, 'popcorn.jpg', 'Popcorn', 'popcorn', 2),
(80, 'Snack', 200, 'snickers.jpg', 'Snickers', 'overpriced chocolate', 0.5),
(81, 'Snack', 500, 'sunflowerseeds.webp', 'Sunflower Seeds', 'very nice', 0.8),
(82, 'Vegetable', 300, 'onion.jpg', 'Onion', 'do not cry', 0.3),
(83, 'Vegetable', 500, 'peppers.jpg', 'Peppers', 'spicy', 0.5),
(84, 'Vegetable', 200, 'zuchinni.jpg', 'Zuchinni', 'interesting vegetable', 0.9),
(85, 'Vegetable', 600, 'broccoli.webp', 'Brocolli', 'good hair', 0.2),
(86, 'Vegetable', 600, 'carrots.png', 'Carrot', 'look out for the rabbits', 0.4),
(87, 'Vegetable', 600, 'carrots.png', 'Carrot', 'look out for the rabbits', 0.4);

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
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `username_3` (`username`),
  ADD UNIQUE KEY `username_5` (`username`),
  ADD KEY `username_4` (`username`);

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
  MODIFY `oid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
