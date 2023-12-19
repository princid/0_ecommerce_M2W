-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2023 at 06:28 PM
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
-- Table structure for table `orders_table`
--

CREATE TABLE `orders_table` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `total_price` int NOT NULL,
  `address_id` int NOT NULL,
  `total_products` int NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'cod',
  `tracking_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'n',
  `is_cancelled` int DEFAULT '0',
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders_table`
--

INSERT INTO `orders_table` (`id`, `user_id`, `total_price`, `address_id`, `total_products`, `payment_method`, `tracking_number`, `invoice_number`, `status`, `is_cancelled`, `order_date`) VALUES
(1, 18, 48540, 11, 4, 'cod', 'TRK-W7NHU5NG', 'INV-20231208-6233', 's', 0, '2023-12-08 15:56:12'),
(2, 20, 16040, 13, 1, 'cod', 'TRK-7QZAKGIM', 'INV-20231208-4136', 'n', 0, '2023-12-08 16:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `o_product_id` int NOT NULL,
  `o_product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `o_product_quantity` int NOT NULL,
  `o_product_size` int NOT NULL,
  `o_product_price` int NOT NULL,
  `o_product_image` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `o_product_id`, `o_product_name`, `o_product_quantity`, `o_product_size`, `o_product_price`, `o_product_image`, `order_date`) VALUES
(1, 1, 52, 'Cricket Bat', 5, 0, 15000, '655af668a75ce_4097.jpeg', '2023-12-08 15:56:12'),
(2, 1, 48, 'Shoes-3', 1, 9, 16000, '655af387637bb_4348.jpeg', '2023-12-08 15:56:12'),
(3, 1, 38, 'suit-3', 1, 0, 17000, '6555e377504b0_5931.webp', '2023-12-08 15:56:12'),
(4, 2, 48, 'Shoes-3', 1, 9, 16000, '655af387637bb_4348.jpeg', '2023-12-08 16:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `products_cart`
--

CREATE TABLE `products_cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `image_id` int NOT NULL DEFAULT '0',
  `product_price` int NOT NULL,
  `quantity` int DEFAULT '1',
  `delete_status` int NOT NULL DEFAULT '0',
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `selected_image` varchar(255) NOT NULL,
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products_cart`
--

INSERT INTO `products_cart` (`id`, `user_id`, `product_id`, `image_id`, `product_price`, `quantity`, `delete_status`, `size`, `selected_image`, `added_on`) VALUES
(141, 18, 36, 0, 500, 3, 0, 'm', '6555e041af8dc_9793.webp', '2023-12-08 12:17:56'),
(144, 18, 52, 0, 15000, 5, 0, '0', '655af668a75ce_4097.jpeg', '2023-12-08 12:20:30'),
(145, 18, 48, 0, 16000, 1, 0, '9', '655af387637bb_4348.jpeg', '2023-12-08 13:02:35'),
(146, 18, 38, 0, 17000, 1, 0, '0', '6555e377504b0_5931.webp', '2023-12-08 14:44:29'),
(147, 20, 48, 0, 16000, 1, 0, '9', '655af387637bb_4348.jpeg', '2023-12-08 14:51:32'),
(149, 20, 35, 0, 17000, 1, 0, 'xl,l,m,s,xxl', '1700634517-31566.webp', '2023-12-08 16:52:27');

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
(1, 'Shoes', '1', NULL, '2023-11-07 10:29:22', '2023-12-06 06:53:37', NULL),
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
(35, 'product-shoppingo', 'It is a Shoppingo special product.', 1700, 160, 'xl,l,m,s,xxl', 0, 0, 2, '1702034784-45544.jpg', '2023-11-16 09:24:25', NULL, '2023-12-01 07:53:02', '2023-12-07 09:42:48'),
(36, 'socks', 'they are beautiful socksddddd', 500, 319, 'm', 1, 0, 2, '6555e041af8dc_9793.webp', '2023-11-16 09:26:25', NULL, '2023-11-17 09:41:40', NULL),
(37, 'suit-2', 'It is a beautiful suit', 7000, 325, '0', 1, 0, 2, '6555e08ee6088_7881.webp', '2023-11-16 09:27:42', NULL, NULL, NULL),
(38, 'suit-3', 'It is a beautiful suit', 17000, 334, '0', 1, 0, 2, '6555e377504b0_5931.webp', '2023-11-16 09:40:07', NULL, NULL, NULL),
(39, 'suit-5', 'It is a purple suit', 8000, 800, '0', 1, 0, 2, '6555e3d7824ef_7366.webp', '2023-11-16 09:41:43', NULL, NULL, NULL),
(40, 'Suit-6', 'It is a red suit. w $&amp;', 9000, 5000, '0', 1, 0, 2, '1700213898-3162.webp', '2023-11-16 09:43:17', NULL, '2023-11-17 10:33:14', NULL),
(46, 'Shoes-1', 'Is is a beautiful set', 9000, 2871, '8', 1, 0, 1, '655af3232fc5a_3561.jpeg', '2023-11-20 05:48:19', NULL, NULL, NULL),
(47, 'Shoes-2', 'Is is a beautiful set', 19000, 435, '7', 1, 0, 1, '655af35c7563d_2316.jpeg', '2023-11-20 05:49:16', NULL, NULL, NULL),
(48, 'Shoes-3', 'Is is a beautiful set', 16000, 471, '9', 1, 0, 1, '655af387637bb_4348.jpeg', '2023-11-20 05:49:59', NULL, NULL, NULL),
(49, 'Shoes-4', 'Is is a beautiful set', 25000, 1000, '7', 1, 0, 1, '655af3b9d79ac_5590.jpeg', '2023-11-20 05:50:49', NULL, NULL, NULL),
(50, 'football', 'it is a good football', 1500, 800, '0', 0, 1, 37, '655af5fadb19e_6097.jpeg', '2023-11-20 06:00:26', NULL, '2023-12-01 10:24:15', '2023-12-01 15:54:09'),
(51, 'jersey', 'It is a beautiful jersey', 1000, 2000, 'l, s, m, xl', 0, 0, 37, '655af63032e24_3708.jpeg', '2023-11-20 06:01:20', NULL, NULL, NULL),
(52, 'Cricket Bat', 'It is a powerful bat', 15000, 75, '0', 0, 0, 37, '655af668a75ce_4097.jpeg', '2023-11-20 06:02:16', NULL, NULL, NULL),
(54, 'dfhfgdhdf', 'gghjkhjk', 787878, 678768, 'l, s, m', 0, 1, 2, '656efe8a31ff2_2193.jpg', '2023-12-05 10:42:18', NULL, '2023-12-08 10:54:37', '2023-12-08 16:24:17'),
(56, 'Shoes- 3', 'it is a nike branded shoes', 9000, 476, '8, 9, 10, 11', 0, 0, 1, '657197ca56ed4_5230.jpeg', '2023-12-07 10:00:42', NULL, NULL, NULL);

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
(94, '53', '1700460204_3.jpeg', NULL, '2023-11-20 06:03:24', NULL),
(95, '56', '1701943242_0.jpeg', NULL, '2023-12-07 10:00:42', NULL),
(96, '56', '1701943242_1.jpeg', NULL, '2023-12-07 10:00:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_wishlist`
--

CREATE TABLE `product_wishlist` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_wishlist`
--

INSERT INTO `product_wishlist` (`id`, `user_id`, `product_id`, `status`, `added_on`) VALUES
(6, 20, 35, 0, '2023-11-22 12:11:28'),
(15, 18, 36, 0, '2023-12-08 12:46:37');

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
(18, 'Adarsh', 'rahulpreet025@gmail.com', '$2y$10$a2vZ5nCjGTPyTeJmCc6TD.CKc5wB09cril9h/VpJe.fHNW2/UpYVi', 'Rahul', 'Dadwal', '9915084857', 1, '1970-01-01', '2023-11-14 04:33:17', '2023-12-01 11:43:55'),
(20, 'Rajput', 'himanshu.sharma0397@gmail.com', '$2y$10$NNTxbaJFl4G9.vF2fvdVguf3ClKarQ4nJeCx17ukuxk9kzO5jRDpa', 'Rahul', 'Rajput', '9915084857', 1, '1970-01-01', '2023-11-14 05:41:07', NULL);

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
  `selected_address` int NOT NULL DEFAULT '0',
  `isDeleted` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `address`, `state`, `city`, `landmark`, `pin_code`, `contact_number`, `selected_address`, `isDeleted`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 20, 'mohali', 'Punjab', 'mohali', 'abc', 144221, '9915084857', 0, 0, '2023-11-15 07:00:50', '2023-12-08 14:53:42', NULL),
(11, 18, 'model town, near (post office)', 'Punjab', 'mohali', 'BAR MAJRA', 144221, '9915084857', 0, 0, '2023-11-22 07:47:05', '2023-12-08 15:58:16', NULL),
(13, 20, 'All blue v', 'Punjab', 'mohali', 'BAR MAJRA', 144221, '9915084857', 1, 0, '2023-11-22 12:40:37', '2023-12-08 14:53:42', NULL),
(15, 18, 'model town, near (post office) abcd', 'Punjab', 'mohali', 'ROAD OF BAR MAJRA', 144221, '9478645364', 1, 0, '2023-12-04 04:49:54', '2023-12-08 15:58:16', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_data`
--
ALTER TABLE `admin_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_table`
--
ALTER TABLE `orders_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
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
-- AUTO_INCREMENT for table `orders_table`
--
ALTER TABLE `orders_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products_cart`
--
ALTER TABLE `products_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `products_category`
--
ALTER TABLE `products_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `products_table`
--
ALTER TABLE `products_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `product_wishlist`
--
ALTER TABLE `product_wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
