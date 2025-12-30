-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 29, 2025 at 09:47 AM
-- Server version: 11.4.9-MariaDB-cll-lve
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nexb5821_serv_nexory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_categories`
--

CREATE TABLE `tb_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `icon` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_categories`
--

INSERT INTO `tb_categories` (`id`, `name`, `slug`, `icon`, `created_at`) VALUES
(1, 'Art Frame', 'leather-goods', 'leather.png', '2025-12-28 11:25:48'),
(2, 'Art Frame', 'bags-backpack', 'bag.png', '2025-12-28 11:25:48'),
(3, 'Art Frame', 'electronics-gadget', 'gadget.png', '2025-12-28 11:25:48'),
(4, 'Art Frame', 'fashion-apparel', 'fashion.png', '2025-12-28 11:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_logs`
--

CREATE TABLE `tb_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_orders`
--

CREATE TABLE `tb_orders` (
  `id` int(11) NOT NULL,
  `order_code` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` bigint(20) DEFAULT NULL,
  `payment_status` enum('pending','paid','failed','cancelled') DEFAULT 'pending',
  `order_status` enum('processing','shipping','completed','cancelled') DEFAULT 'processing',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_items`
--

CREATE TABLE `tb_order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_products`
--

CREATE TABLE `tb_products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `slug` varchar(220) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `description` text DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_products`
--

INSERT INTO `tb_products` (`id`, `category_id`, `user_id`, `name`, `slug`, `price`, `stock`, `description`, `featured`, `status`, `created_at`) VALUES
(1, 1, 1, 'Iphone - Art Frame', 'premium-leather-wallet', 250000, 20, 'Dompet kulit premium handmade', 1, 1, '2025-12-28 11:28:05'),
(2, 1, 1, 'Samsung - Art Frame', 'executive-leather-belt', 180000, 30, 'Sabuk kulit premium elegan', 0, 1, '2025-12-28 11:28:05'),
(3, 2, 1, 'Xiaomi - Art Frame', 'minimalist-travel-backpack', 475000, 15, 'Backpack ringan stylish', 1, 1, '2025-12-28 11:28:05'),
(4, 3, 2, 'Pocophone - Art Frame', 'wireless-bluetooth-earbuds', 320000, 35, 'Earbuds audio jernih', 0, 1, '2025-12-28 11:28:05'),
(5, 3, 2, 'Infixin - Art Frame', 'smartwatch-series-x', 1250000, 12, 'Smartwatch fitur kesehatan', 1, 1, '2025-12-28 11:28:05'),
(6, 4, 3, 'Vivo - Art Frame', 'casual-hoodie-unisex', 285000, 40, 'Hoodie nyaman breathable', 0, 1, '2025-12-28 11:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product_images`
--

CREATE TABLE `tb_product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_product_images`
--

INSERT INTO `tb_product_images` (`id`, `product_id`, `image`, `created_at`) VALUES
(8, 1, 'img.jpg', '2025-12-28 11:28:09'),
(9, 1, 'img.jpg', '2025-12-28 11:28:09'),
(10, 2, 'img.jpg', '2025-12-28 11:28:09'),
(11, 3, 'img.jpg', '2025-12-28 11:28:09'),
(12, 4, 'img.jpg', '2025-12-28 11:28:09'),
(13, 5, 'img.jpg', '2025-12-28 11:28:09'),
(14, 6, 'img.jpg', '2025-12-28 11:28:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('user','seller','admin') DEFAULT 'user',
  `status` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `name`, `email`, `password`, `phone`, `role`, `status`, `created_at`) VALUES
(1, 'Administrator', 'admin@nexory.com', '$2y$10$EixZaYVK1fsbw1Zfbx3OXe.P9Z3rroWJxE6C0Bpvy.bukC9VHtV2G', '081111111111', 'admin', 1, '2025-12-28 11:26:36'),
(2, 'Main Seller', 'seller@nexory.com', '$2y$10$EixZaYVK1fsbw1Zfbx3OXe.P9Z3rroWJxE6C0Bpvy.bukC9VHtV2G', '082222222222', 'seller', 1, '2025-12-28 11:26:36'),
(3, 'User Premium', 'user@nexory.com', '$2y$10$EixZaYVK1fsbw1Zfbx3OXe.P9Z3rroWJxE6C0Bpvy.bukC9VHtV2G', '083333333333', 'user', 1, '2025-12-28 11:26:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_categories`
--
ALTER TABLE `tb_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_logs`
--
ALTER TABLE `tb_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_orders`
--
ALTER TABLE `tb_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_order_items`
--
ALTER TABLE `tb_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_products`
--
ALTER TABLE `tb_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_product_images`
--
ALTER TABLE `tb_product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_categories`
--
ALTER TABLE `tb_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_logs`
--
ALTER TABLE `tb_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_orders`
--
ALTER TABLE `tb_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_order_items`
--
ALTER TABLE `tb_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_products`
--
ALTER TABLE `tb_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_product_images`
--
ALTER TABLE `tb_product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
