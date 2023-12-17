-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 07:49 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rating` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `rating`, `message`) VALUES
(4, 1, 'UMMI', 'ummi@gmail.com', '5', 'saya suka kedai ini, sangat bagus, sila datang ke kedai ini, dapat perbaiki kerosakan laptop dan sebagainya, juga menjual perkakas elektrik seperti kipas, peti sejuk. dapur gas, mesin basuh'),
(6, 1, 'ummi', 'ummi@gmail.com', '5', 'saya ummi, hjkslmnjmjkl, shk bajjhb, fjasnuudjn , dmnjnhdahnnan nd, asjbbshuhdudiufjakm,,mNJDIHwiHF.NJFHUHFUHNFAHEHHAJASH'),
(7, 1, 'ummi noramirah binti', 'umminoramirahbintimuhamad@gmail.com', '5', 'saya suka kedai ini, sangat bagus, sila datang ke kedai ini, dapat perbaiki kerosakan laptop dan sebagainya, juga menjual perkakas elektrik seperti kipas, peti sejuk. dapur gas, mesin basuh'),
(8, 1, 'ummi noramirah binti muhamad shambudin bin nayan', 'umminoramirahbintimuhamadshambudin@gmail.com', '5', 'saya suka kedai ini, sangat bagus, sila datang ke kedai ini, dapat perbaiki kerosakan laptop dan sebagainya, juga menjual perkakas elektrik seperti kipas, peti sejuk. dapur gas, mesin basuh, saya, suka, makan, cekodok, nyum, nyum, hoho, haha, hihi, huhu lala lulu shdadada mimi nuu jhff\r\n\r\n'),
(9, 1, 'ummi noramirah binti muhamad shambudin bin nayan', 'umminoramirahbintimuhamadshambudin@gmail.com', '5', 'saya suka kedai ini, sangat bagus, sila datang ke kedai ini, dapat perbaiki kerosakan laptop dan sebagainya, juga menjual perkakas elektrik seperti kipas, peti sejuk. dapur gas, mesin basuh, saya, suka, makan, cekodok, nyum, nyum, hoho, haha, hihi, huhu lala lulu shdadada mimi nuu jhff'),
(10, 1, 'ummi noramirah binti muhamad shambudin bin nayan', 'umminoramirahbintimuhamadshambudin@gmail.com', '5', 'saya suka kedai ini, sangat bagus, sila datang ke kedai ini, dapat perbaiki kerosakan laptop dan sebagainya, juga menjual perkakas elektrik seperti kipas, peti sejuk. dapur gas, mesin basuh, saya, suka, makan, cekodok, nyum, nyum, hoho, haha, hihi, huhu lala lulu shdadada mimi nuu jhffb,  fbejganmfnfuhskls, ,mdabfuehfil, DMFKJAJHIEJIJF NIJIJm,njadbjgjghij');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `details` varchar(500) NOT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `image_01` mediumblob NOT NULL,
  `image_02` mediumblob NOT NULL,
  `image_03` mediumblob NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `details`, `buy_price`, `sale_price`, `image_01`, `image_02`, `image_03`, `date`) VALUES
(19, 'UMMI', '1', '2', '3.00', '2.00', 0x63616d6572612d312e77656270, 0x63616d6572612d322e77656270, 0x63616d6572612d332e77656270, '0000-00-00 00:00:00'),
(20, 'ERR', '7', 'CGF', '44.00', '78.00', 0x6672696467652d312e77656270, 0x6672696467652d322e77656270, 0x6672696467652d332e77656270, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `details` varchar(500) NOT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `total_price` decimal(25,2) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `name`, `quantity`, `details`, `sale_price`, `total_price`, `image_01`, `date`) VALUES
(1, 20, 'ERR', 2, 'CGF', '78.00', '156.00', 'fridge-1.webp', '2023-11-02'),
(2, 19, 'UMMI', 4, '2', '2.00', '8.00', 'camera-1.webp', '2023-11-02'),
(3, 19, 'UMMI', 100, '2', '2.00', '200.00', 'camera-1.webp', '2023-11-02'),

(4, 20, 'ERR', 1, 'CGF', '78.00', '78.00', 'fridge-1.webp', '2023-11-03'),
(5, 19, 'UMMI', 70, '2', '2.00', '140.00', 'camera-1.webp', '2023-11-03'),

(28, 20, 'ERR', 2, 'CGF', '78.00', '156.00', 'fridge-1.webp', '2023-12-02'),
(31, 19, 'UMMI', 4, '2', '2.00', '8.00', 'camera-1.webp', '2023-12-02'),
(32, 19, 'UMMI', 100, '2', '2.00', '200.00', 'camera-1.webp', '2023-12-02'),

(33, 20, 'ERR', 1, 'CGF', '78.00', '78.00', 'fridge-1.webp', '2023-12-03'),
(34, 19, 'UMMI', 70, '2', '2.00', '140.00', 'camera-1.webp', '2023-12-03'),
(35, 20, 'ERR', 7, 'CGF', '78.00', '546.00', 'fridge-1.webp', '2023-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sales_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
