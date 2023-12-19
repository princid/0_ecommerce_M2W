-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2023 at 03:15 PM
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
  `transaction_id` varchar(255) NOT NULL DEFAULT 'cod',
  `payment_status` int NOT NULL DEFAULT '0',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'n',
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders_table`
--

INSERT INTO `orders_table` (`id`, `user_id`, `total_price`, `address_id`, `total_products`, `payment_method`, `tracking_number`, `invoice_number`, `transaction_id`, `payment_status`, `status`, `order_date`) VALUES
(1, 18, 48540, 11, 4, 'cod', 'TRK-W7NHU5NG', 'INV-20231208-6233', 'cod', 0, 'y', '2023-12-08 15:56:12'),
(29, 20, 45440, 13, 6, 'cod', 'TRK-LJ8YL40Z', 'INV-20231212-7415', 'cod', 0, 's', '2023-12-12 17:35:12'),
(30, 18, 41240, 11, 5, 'card', 'TRK-116M0MRQ', 'INV-20231212-2642', 'cod', 1, 'n', '2023-12-12 17:36:45'),
(47, 20, 5040, 13, 2, 'card', 'TRK-0ZJA6OZP', 'INV-20231218-9118', 'pi_3OOdJRSDZQL6WmwF11I3ngWX', 1, 'n', '2023-12-18 15:10:37'),
(48, 20, 2540, 1, 1, 'card', 'TRK-1EQVVDQB', 'INV-20231218-5557', 'pi_3OOeLnSDZQL6WmwF1TEYdAaB', 1, 'n', '2023-12-18 16:17:08'),
(49, 20, 2540, 1, 1, 'card', 'TRK-1OG1K9YS', 'INV-20231218-856', 'pi_3OOeMDSDZQL6WmwF1AmS0ADL', 1, 'n', '2023-12-18 16:17:34');

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
  `o_product_size` varchar(255) NOT NULL,
  `o_product_price` int NOT NULL,
  `o_product_image` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `o_product_id`, `o_product_name`, `o_product_quantity`, `o_product_size`, `o_product_price`, `o_product_image`, `order_date`) VALUES
(1, 1, 52, 'Cricket Bat', 5, '0', 15000, '655af668a75ce_4097.jpeg', '2023-12-08 15:56:12'),
(2, 1, 48, 'Shoes-3', 1, '9', 16000, '655af387637bb_4348.jpeg', '2023-12-08 15:56:12'),
(3, 1, 38, 'suit-3', 1, '0', 17000, '6555e377504b0_5931.webp', '2023-12-08 15:56:12'),
(12, 29, 62, 'Mens jacket Armaani', 2, '', 2500, '6576e100a15b9_7854.webp', '2023-12-12 17:35:12'),
(13, 29, 58, 'Gucci Sneakers', 1, '10,', 3500, '6576ddaf29898_3046.jpg', '2023-12-12 17:35:12'),
(14, 29, 67, 'Denim Jacket', 3, 'xl,', 3500, '6576e5d9ddee7_8087.jpg', '2023-12-12 17:35:12'),
(15, 29, 65, 'Maniac Jacket', 2, 'm,', 2900, '6576e4e9b1e60_4074.webp', '2023-12-12 17:35:12'),
(16, 30, 68, 'Leather Jacket', 1, 'l,', 5500, '6576e655bd0b1_7979.jpg', '2023-12-12 17:36:45'),
(17, 30, 60, 'Classic Formal Shoes', 1, '10,', 2200, '6576df128ef6d_9746.jpeg', '2023-12-12 17:36:45'),
(36, 47, 69, 'Football', 1, '0', 2500, '6576e7c265482_8674.avif', '2023-12-18 15:10:37'),
(37, 47, 62, 'Mens jacket Armaani', 1, 'l,', 2500, '6576e100a15b9_7854.webp', '2023-12-18 15:10:37'),
(38, 48, 69, 'Football', 1, '0', 2500, '6576e7c265482_8674.avif', '2023-12-18 16:17:08'),
(39, 49, 69, 'Football', 1, '0', 2500, '6576e7c265482_8674.avif', '2023-12-18 16:17:34');

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
(158, 18, 68, 0, 5500, 1, 0, 'l,', '6576e655bd0b1_7979.jpg', '2023-12-12 17:36:05'),
(159, 18, 60, 0, 2200, 2, 0, '8,', '6576df128ef6d_9746.jpeg', '2023-12-12 17:36:22'),
(160, 18, 61, 0, 1100, 1, 0, '7,', '6576e03831cd6_1743.jpeg', '2023-12-13 17:58:20'),
(176, 20, 69, 0, 2500, 1, 0, '0', '6576e7c265482_8674.avif', '2023-12-15 11:09:29');

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
(2, 'Clothes', '1', NULL, '2023-11-07 10:29:28', '2023-12-12 12:27:54', NULL),
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
  `brand` varchar(255) NOT NULL,
  `stock` int NOT NULL,
  `product_size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `isFeatured` int NOT NULL DEFAULT '0',
  `isDeleted` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `featured_product_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products_table`
--

INSERT INTO `products_table` (`id`, `product_name`, `description`, `price`, `brand`, `stock`, `product_size`, `isFeatured`, `isDeleted`, `category_id`, `featured_product_image`, `created_at`, `updated_at`, `deleted_at`, `restored_at`) VALUES
(50, 'football', 'it is a good football', 1500, 'Nivia', 800, '0', 0, 1, 37, '655af5fadb19e_6097.jpeg', '2023-11-20 06:00:26', NULL, '2023-12-01 10:24:15', '2023-12-01 15:54:09'),
(52, 'Cricket Bat', 'It is a powerful bat', 15000, 'Kukaboora', 75, '0', 0, 0, 37, '655af668a75ce_4097.jpeg', '2023-11-20 06:02:16', NULL, NULL, NULL),
(57, 'Puma Shoes', 'They are Mustered colored shoes of type lofers, Try foor sure', 1900, 'puma', 999, '7, 8, 9, 10, 11', 1, 0, 1, '6576dd06f15f1_8166.webp', '2023-12-11 09:57:26', '2023-12-14 12:06:45', '2023-12-13 05:23:43', '2023-12-13 10:53:48'),
(58, 'Gucci Sneakers', 'They are a branded sneakers', 3500, 'gucci', 988, '7, 8, 9, 10, 11', 1, 0, 1, '6576ddaf29898_3046.jpg', '2023-12-11 10:00:15', '2023-12-14 12:06:45', NULL, NULL),
(59, 'Nike Sneakers', 'They are a sky blue nike sneakers', 1500, 'nike', 1500, '0, 7, 8, 9, 10, 11', 0, 0, 1, '6576de718562b_8078.webp', '2023-12-11 10:03:29', NULL, NULL, NULL),
(60, 'Classic Formal Shoes', 'They are a classic formal shoes in brown color.', 2200, 'gucci', 1494, '7, 8, 9, 10, 11', 1, 0, 1, '6576df128ef6d_9746.jpeg', '2023-12-11 10:06:10', NULL, NULL, NULL),
(61, 'Mens Sports Shoes', 'They are a smooth, comfortable men\'s black shoes', 1100, 'armani', 797, '7, 8, 9, 10', 1, 0, 1, '6576e03831cd6_1743.jpeg', '2023-12-11 10:11:04', NULL, NULL, NULL),
(62, 'Mens jacket Armaani', 'This is a very cool Jacket by Armani for mens', 2500, 'armani', 0, 'l, s, m, xl, xxl', 1, 0, 2, '6576e100a15b9_7854.webp', '2023-12-11 10:14:24', '2023-12-18 09:40:37', NULL, NULL),
(63, 'White Gucci Jacket', 'This is a white warm jacket by Gucci', 4500, 'gucci', 1000, 'l, s, m, xl', 1, 0, 2, '6576e1f05978a_6862.avif', '2023-12-11 10:18:24', NULL, NULL, NULL),
(64, 'Cricket Bat', 'It is an English villow bat', 5000, 'kukaboora', 800, '0', 0, 0, 37, '6576e417a93a4_9223.jpeg', '2023-12-11 10:27:35', NULL, NULL, NULL),
(65, 'Maniac Jacket', 'It is a good jacket by Maniac in black and Yellow.', 2900, 'maniac', 1796, 'l, s, m, xl, xxl', 1, 0, 2, '6576e4e9b1e60_4074.webp', '2023-12-11 10:31:05', '2023-12-14 12:06:45', NULL, NULL),
(66, 'Black Jacket', 'It is a jacket in black', 4500, 'armani', 1000, 'l, s, m, xl', 0, 0, 2, '6576e55a80393_2620.webp', '2023-12-11 10:32:58', NULL, NULL, NULL),
(67, 'Denim Jacket', 'It is a danim blue jacket by Zara', 3500, 'zara', 994, 'l, s, m, xl, xxl', 1, 0, 2, '6576e5d9ddee7_8087.jpg', '2023-12-11 10:35:05', '2023-12-14 12:06:45', NULL, NULL),
(68, 'Leather Jacket', 'It is a pure lather jacket in brown color', 5500, 'zara', 4994, 'l, xl, xxl', 1, 0, 2, '6576e655bd0b1_7979.jpg', '2023-12-11 10:37:09', NULL, NULL, NULL),
(69, 'Football', 'It is a high quality football', 2500, 'sparten', 4997, '0', 1, 0, 37, '6576e7c265482_8674.avif', '2023-12-11 10:43:14', '2023-12-18 10:47:34', NULL, NULL);

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
(89, '52', '1700460136_0.jpeg', NULL, '2023-11-20 06:02:16', NULL),
(90, '52', '1700460136_1.jpeg', NULL, '2023-11-20 06:02:16', NULL),
(91, '53', '1700460204_0.jpeg', NULL, '2023-11-20 06:03:24', NULL),
(92, '53', '1700460204_1.jpeg', NULL, '2023-11-20 06:03:24', NULL),
(93, '53', '1700460204_2.jpeg', NULL, '2023-11-20 06:03:24', NULL),
(94, '53', '1700460204_3.jpeg', NULL, '2023-11-20 06:03:24', NULL),
(95, '56', '1701943242_0.jpeg', NULL, '2023-12-07 10:00:42', NULL),
(96, '56', '1701943242_1.jpeg', NULL, '2023-12-07 10:00:42', NULL),
(97, '57', '1702288646_0.jpeg', NULL, '2023-12-11 09:57:26', NULL),
(98, '57', '1702288646_1.jpeg', NULL, '2023-12-11 09:57:26', NULL),
(99, '57', '1702288646_2.jpeg', NULL, '2023-12-11 09:57:26', NULL),
(100, '58', '1702288815_0.jpeg', NULL, '2023-12-11 10:00:15', NULL),
(101, '58', '1702288815_1.jpeg', NULL, '2023-12-11 10:00:15', NULL),
(102, '59', '1702289009_0.jpeg', NULL, '2023-12-11 10:03:29', NULL),
(103, '59', '1702289009_1.jpeg', NULL, '2023-12-11 10:03:29', NULL),
(104, '59', '1702289009_2.jpeg', NULL, '2023-12-11 10:03:29', NULL),
(105, '59', '1702289009_3.jpeg', NULL, '2023-12-11 10:03:29', NULL),
(106, '60', '1702289170_0.jpeg', NULL, '2023-12-11 10:06:10', NULL),
(107, '60', '1702289170_1.webp', NULL, '2023-12-11 10:06:10', NULL),
(108, '61', '1702289464_0.jpeg', NULL, '2023-12-11 10:11:04', NULL),
(109, '61', '1702289464_1.avif', NULL, '2023-12-11 10:11:04', NULL),
(110, '61', '1702289464_2.jpeg', NULL, '2023-12-11 10:11:04', NULL),
(111, '61', '1702289464_3.jpeg', NULL, '2023-12-11 10:11:04', NULL),
(112, '62', '1702289664_0.jpeg', NULL, '2023-12-11 10:14:24', NULL),
(113, '62', '1702289664_1.jpeg', NULL, '2023-12-11 10:14:24', NULL),
(114, '63', '1702289904_0.jpeg', NULL, '2023-12-11 10:18:24', NULL),
(115, '63', '1702289904_1.jpeg', NULL, '2023-12-11 10:18:24', NULL),
(116, '64', '1702290455_0.jpeg', NULL, '2023-12-11 10:27:35', NULL),
(117, '65', '1702290665_0.jpeg', NULL, '2023-12-11 10:31:05', NULL),
(118, '65', '1702290665_1.jpeg', NULL, '2023-12-11 10:31:05', NULL),
(119, '65', '1702290665_2.jpeg', NULL, '2023-12-11 10:31:05', NULL),
(120, '66', '1702290778_0.jpeg', NULL, '2023-12-11 10:32:58', NULL),
(121, '66', '1702290778_1.jpeg', NULL, '2023-12-11 10:32:58', NULL),
(122, '66', '1702290778_2.jpeg', NULL, '2023-12-11 10:32:58', NULL),
(123, '67', '1702290905_0.jpeg', NULL, '2023-12-11 10:35:05', NULL),
(124, '68', '1702291029_0.jpeg', NULL, '2023-12-11 10:37:09', NULL),
(125, '68', '1702291029_1.jpeg', NULL, '2023-12-11 10:37:09', NULL),
(126, '69', '1702291394_0.jpeg', NULL, '2023-12-11 10:43:14', NULL),
(127, '69', '1702291394_1.jpeg', NULL, '2023-12-11 10:43:14', NULL),
(128, '69', '1702291394_2.jpeg', NULL, '2023-12-11 10:43:14', NULL),
(129, '70', '1702294202_0.jpeg', NULL, '2023-12-11 11:30:02', NULL);

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
(15, 18, 36, 0, '2023-12-08 12:46:37'),
(17, 20, 37, 0, '2023-12-11 12:09:00'),
(18, 20, 40, 0, '2023-12-11 12:34:27'),
(19, 20, 68, 0, '2023-12-11 16:10:06'),
(20, 18, 57, 0, '2023-12-12 10:05:33'),
(21, 18, 62, 0, '2023-12-12 10:27:51'),
(22, 20, 61, 0, '2023-12-15 09:44:09'),
(23, 20, 62, 0, '2023-12-15 09:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `isDeleted` int NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `isDeleted`, `date`) VALUES
(1, 'rahuldadwal1122@gmail.com', 0, '2023-12-11 18:29:34'),
(2, 'rahulpreet025@gmail.com', 1, '2023-12-12 11:50:15'),
(3, 'himanshu.sharma0397@gmail.com', 0, '2023-12-12 11:50:33');

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
(18, 'Adarsh', 'rahulpreet025@gmail.com', '$2y$10$a2vZ5nCjGTPyTeJmCc6TD.CKc5wB09cril9h/VpJe.fHNW2/UpYVi', 'Rahul', 'Dadwal', '9915084857', 1, '1970-01-01', '2023-11-14 04:33:17', '2023-12-11 10:02:33'),
(20, 'Rajput', 'himanshu.sharma0397@gmail.com', '$2y$10$NNTxbaJFl4G9.vF2fvdVguf3ClKarQ4nJeCx17ukuxk9kzO5jRDpa', 'Rahul', 'Rajput', '9915084857', 1, '1970-01-01', '2023-11-14 05:41:07', '2023-12-14 15:30:43');

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
(1, 20, 'mohali', 'Punjab', 'mohali', 'abcd', 144221, '9915084857', 0, 0, '2023-11-15 07:00:50', '2023-12-18 16:51:48', NULL),
(11, 18, 'model town, near (post office)', 'Punjab', 'mohali', 'BAR MAJRA', 144221, '9915084857', 1, 0, '2023-11-22 07:47:05', '2023-12-15 16:41:04', NULL),
(13, 20, 'All Blue', 'Punjab', 'mohali', 'BAR MAJRA', 144221, '9915084857', 1, 0, '2023-11-22 12:40:37', '2023-12-18 16:51:48', NULL),
(15, 18, 'model town, near (post office) abcd', 'Punjab', 'mohali', 'ROAD OF BAR MAJRA', 144221, '9478645364', 0, 0, '2023-12-04 04:49:54', '2023-12-15 16:41:04', NULL),
(17, 20, 'Mukerian', 'New Brunswick', 'Starlight Village', 'BAR MAJRA', 144221, '991508485799', 0, 1, '2023-12-11 07:37:00', '2023-12-11 15:14:49', NULL);

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
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products_cart`
--
ALTER TABLE `products_cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `products_category`
--
ALTER TABLE `products_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `products_table`
--
ALTER TABLE `products_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `product_wishlist`
--
ALTER TABLE `product_wishlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
