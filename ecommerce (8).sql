-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 01, 2023 at 06:48 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_data`
--

CREATE TABLE `admin_data` (
  `id` int NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_data`
--

INSERT INTO `admin_data` (`id`, `user_email`, `password`, `created_at`) VALUES
(1, 'rahulpreet025@gmail.com', '12345', '2023-11-01 06:53:56');

-- --------------------------------------------------------

--
-- Table structure for table `daorders_table`
--

CREATE TABLE `daorders_table` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `total_price` int NOT NULL,
  `payment_status` int NOT NULL DEFAULT '0',
  `shipping_address` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `order_status` int DEFAULT '0',
  `transaction_id` varchar(255) DEFAULT NULL,
  `tracking_number` int DEFAULT NULL,
  `is_deleted` int NOT NULL DEFAULT '0',
  `order_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_cart`
--

CREATE TABLE `products_cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_price` int NOT NULL,
  `quantity` int DEFAULT NULL,
  `selected_image` varchar(255) NOT NULL,
  `delete_status` int NOT NULL,
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products_cart`
--

INSERT INTO `products_cart` (`id`, `user_id`, `product_id`, `product_price`, `quantity`, `selected_image`, `delete_status`, `added_on`) VALUES
(77, 20, 37, 7000, NULL, '1700126862_0.webp', 0, '2023-11-24 09:51:47'),
(79, 20, 38, 17000, NULL, '1700127607_2.webp', 0, '2023-11-24 09:53:03'),
(84, 20, 46, 9000, NULL, '1700459299_0.jpeg', 0, '2023-11-24 11:00:36'),
(89, 18, 51, 1000, NULL, '655af63032e24_3708.jpeg', 0, '2023-12-01 10:27:48'),
(90, 18, 37, 7000, NULL, '6555e08ee6088_7881.webp', 0, '2023-12-01 11:03:44'),
(105, 18, 46, 9000, NULL, '1700459299_1.jpeg', 0, '2023-12-01 18:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `products_category`
--

CREATE TABLE `products_category` (
  `id` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `isDeletedCat` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products_category`
--

INSERT INTO `products_category` (`id`, `category_name`, `status`, `isDeletedCat`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Shoes', '1', NULL, '2023-11-07 10:29:22', '2023-11-09 11:34:34', NULL),
(2, 'Clothes', '1', NULL, '2023-11-07 10:29:28', '2023-11-17 04:27:43', NULL),
(37, 'Sports', '1', NULL, '2023-11-16 11:47:05', '2023-11-20 05:37:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_table`
--

CREATE TABLE `products_table` (
  `id` int NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `stock` int NOT NULL,
  `product_size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `isFeatured` int NOT NULL DEFAULT '0',
  `isDeleted` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `featured_product_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products_table`
--

INSERT INTO `products_table` (`id`, `product_name`, `description`, `price`, `stock`, `product_size`, `isFeatured`, `isDeleted`, `category_id`, `featured_product_image`, `created_at`, `updated_at`, `deleted_at`, `restored_at`) VALUES
(35, 'suit-1', 'yjytjtyjtyjr', 17000, 160, '0', 1, 1, 2, '1700634517-31566.webp', '2023-11-16 09:24:25', NULL, '2023-12-01 07:53:02', NULL),
(36, 'socks', 'they are beautiful socksddddd', 500, 435, '0', 1, 0, 2, '6555e041af8dc_9793.webp', '2023-11-16 09:26:25', NULL, '2023-11-17 09:41:40', NULL),
(37, 'suit-2', 'It is a beautiful suit', 7000, 500, '0', 1, 0, 2, '6555e08ee6088_7881.webp', '2023-11-16 09:27:42', NULL, NULL, NULL),
(38, 'suit-3', 'It is a beautiful suit', 17000, 150, '0', 1, 0, 2, '6555e377504b0_5931.webp', '2023-11-16 09:40:07', NULL, NULL, NULL),
(39, 'suit-5', 'It is a purple suit', 8000, 800, '0', 1, 0, 2, '6555e3d7824ef_7366.webp', '2023-11-16 09:41:43', NULL, NULL, NULL),
(40, 'Suit-6', 'It is a red suit. w $&amp;', 9000, 5000, '0', 1, 0, 2, '1700213898-3162.webp', '2023-11-16 09:43:17', NULL, '2023-11-17 10:33:14', NULL),
(46, 'Shoes-1', 'Is is a beautiful set', 9000, 800, '8', 1, 0, 1, '655af3232fc5a_3561.jpeg', '2023-11-20 05:48:19', NULL, NULL, NULL),
(47, 'Shoes-2', 'Is is a beautiful set', 19000, 435, '7', 1, 0, 1, '655af35c7563d_2316.jpeg', '2023-11-20 05:49:16', NULL, NULL, NULL),
(48, 'Shoes-3', 'Is is a beautiful set', 16000, 500, '9', 1, 0, 1, '655af387637bb_4348.jpeg', '2023-11-20 05:49:59', NULL, NULL, NULL),
(49, 'Shoes-4', 'Is is a beautiful set', 25000, 1000, '7', 8, 0, 1, '655af3b9d79ac_5590.jpeg', '2023-11-20 05:50:49', NULL, NULL, NULL),
(50, 'football', 'it is a good football', 1500, 800, '0', 0, 1, 37, '655af5fadb19e_6097.jpeg', '2023-11-20 06:00:26', NULL, '2023-12-01 10:24:15', '2023-12-01 15:54:09'),
(51, 'jersey', 'It is a beautiful jersey', 1000, 2000, 'l, s, m, xl', 0, 0, 37, '655af63032e24_3708.jpeg', '2023-11-20 06:01:20', NULL, NULL, NULL),
(52, 'Cricket Bat', 'It is a powerful bat', 15000, 80, '0', 0, 0, 37, '655af668a75ce_4097.jpeg', '2023-11-20 06:02:16', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `featured` tinyint DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `product_image`, `featured`, `created_at`, `updated_at`) VALUES
(51, '34', '1699595824_0.jpg', NULL, '2023-11-10 05:57:04', NULL),
(52, '34', '1699595824_1.jpg', NULL, '2023-11-10 05:57:04', NULL),
(53, '35', '1700126665_0.webp', NULL, '2023-11-16 09:24:25', NULL),
(54, '36', '1700126785_0.webp', NULL, '2023-11-16 09:26:25', NULL),
(55, '37', '1700126862_0.webp', NULL, '2023-11-16 09:27:42', NULL),
(56, '37', '1700126862_1.webp', NULL, '2023-11-16 09:27:42', NULL),
(57, '37', '1700126862_2.webp', NULL, '2023-11-16 09:27:42', NULL),
(58, '38', '1700127607_0.webp', NULL, '2023-11-16 09:40:07', NULL),
(59, '38', '1700127607_1.webp', NULL, '2023-11-16 09:40:07', NULL),
(60, '38', '1700127607_2.webp', NULL, '2023-11-16 09:40:07', NULL),
(61, '39', '1700127703_0.webp', NULL, '2023-11-16 09:41:43', NULL),
(62, '39', '1700127703_1.webp', NULL, '2023-11-16 09:41:43', NULL),
(63, '39', '1700127703_2.webp', NULL, '2023-11-16 09:41:43', NULL),
(64, '40', '1700127797_0.webp', NULL, '2023-11-16 09:43:17', NULL),
(65, '40', '1700127797_1.webp', NULL, '2023-11-16 09:43:17', NULL),
(66, '40', '1700127797_2.webp', NULL, '2023-11-16 09:43:17', NULL),
(67, '40', '1700127797_3.webp', NULL, '2023-11-16 09:43:17', NULL),
(68, '41', '1700132060_0.webp', NULL, '2023-11-16 10:54:20', NULL),
(73, '46', '1700459299_0.jpeg', NULL, '2023-11-20 05:48:19', NULL),
(74, '46', '1700459299_1.jpeg', NULL, '2023-11-20 05:48:19', NULL),
(75, '46', '1700459299_2.jpeg', NULL, '2023-11-20 05:48:19', NULL),
(76, '47', '1700459356_0.jpeg', NULL, '2023-11-20 05:49:16', NULL),
(77, '47', '1700459356_1.jpeg', NULL, '2023-11-20 05:49:16', NULL),
(78, '48', '1700459399_0.jpeg', NULL, '2023-11-20 05:49:59', NULL),
(79, '48', '1700459399_1.jpeg', NULL, '2023-11-20 05:49:59', NULL),
(80, '49', '1700459449_0.jpeg', NULL, '2023-11-20 05:50:49', NULL),
(81, '49', '1700459449_1.jpeg', NULL, '2023-11-20 05:50:49', NULL),
(82, '49', '1700459449_2.jpeg', NULL, '2023-11-20 05:50:49', NULL),
(83, '50', '1700460026_0.jpeg', NULL, '2023-11-20 06:00:26', NULL),
(84, '50', '1700460026_1.jpeg', NULL, '2023-11-20 06:00:26', NULL),
(85, '50', '1700460026_2.jpeg', NULL, '2023-11-20 06:00:26', NULL),
(86, '50', '1700460026_3.jpeg', NULL, '2023-11-20 06:00:26', NULL),
(87, '51', '1700460080_0.jpeg', NULL, '2023-11-20 06:01:20', NULL),
(88, '51', '1700460080_1.jpeg', NULL, '2023-11-20 06:01:20', NULL),
(89, '52', '1700460136_0.jpeg', NULL, '2023-11-20 06:02:16', NULL),
(90, '52', '1700460136_1.jpeg', NULL, '2023-11-20 06:02:16', NULL),
(91, '53', '1700460204_0.jpeg', NULL, '2023-11-20 06:03:24', NULL),
(92, '53', '1700460204_1.jpeg', NULL, '2023-11-20 06:03:24', NULL),
(93, '53', '1700460204_2.jpeg', NULL, '2023-11-20 06:03:24', NULL),
(94, '53', '1700460204_3.jpeg', NULL, '2023-11-20 06:03:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_wishlist`
--

CREATE TABLE `product_wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `selected_image` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_wishlist`
--

INSERT INTO `product_wishlist` (`id`, `user_id`, `product_id`, `selected_image`, `status`, `added_on`) VALUES
(6, 20, 35, '', 0, '2023-11-22 12:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile_number` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gender` int DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `mobile_number`, `gender`, `dob`, `created_at`, `updated_at`) VALUES
(18, 'Adarsh', 'luffy@gmail.com', '$2y$10$a2vZ5nCjGTPyTeJmCc6TD.CKc5wB09cril9h/VpJe.fHNW2/UpYVi', 'Rahul', 'Dadwal', '9915084857', 1, '1970-01-01', '2023-11-14 04:33:17', '2023-12-01 11:43:55'),
(20, 'Rajput', 'rajput@gmail.com', '$2y$10$NNTxbaJFl4G9.vF2fvdVguf3ClKarQ4nJeCx17ukuxk9kzO5jRDpa', 'Rahul', 'Rajput', '9915084857', 1, '1970-01-01', '2023-11-14 05:41:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `pin_code` int NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `address`, `state`, `city`, `landmark`, `pin_code`, `contact_number`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 20, 'mohali', 'Punjab', 'mohali', 'abc', 144221, '9915084857', '2023-11-15 07:00:50', NULL, NULL),
(11, 18, 'model town, near (post office) , z', 'Punjab', 'mohali', 'BAR MAJRA', 144221, '991508485799', '2023-11-22 07:47:05', '2023-12-01 13:07:12', NULL),
(13, 20, 'All blue v', 'Punjab', 'mohali', 'BAR MAJRA', 144221, '9915084857', '2023-11-22 12:40:37', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_data`
--
ALTER TABLE `admin_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daorders_table`
--
ALTER TABLE `daorders_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_cart`
--
ALTER TABLE `products_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_category`
--
ALTER TABLE `products_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_table`
--
ALTER TABLE `products_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_wishlist`
--
ALTER TABLE `product_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_data`
--
ALTER TABLE `admin_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `daorders_table`
--
ALTER TABLE `daorders_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_cart`
--
ALTER TABLE `products_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `products_category`
--
ALTER TABLE `products_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `products_table`
--
ALTER TABLE `products_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `product_wishlist`
--
ALTER TABLE `product_wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
