-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2025 at 02:02 AM
-- Server version: 8.0.41-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `prod_qty` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `prod_id`, `prod_qty`, `created_at`) VALUES
(28, 4, 15, 1, '2025-03-03 02:11:28'),
(39, 1, 23, 1, '2025-03-05 01:40:40');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_general_ci,
  `status` tinyint DEFAULT '0',
  `popular` tinyint DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_description` mediumtext COLLATE utf8mb4_general_ci,
  `meta_keywords` mediumtext COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `description`, `status`, `popular`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`) VALUES
(7, 'Drinks', 'Orange juice', 'Orange juice', 0, 1, '1741086014.jpg', 'Orange juice', 'Orange juice', 'Orange juice', '2025-02-27 07:36:33'),
(8, 'Natural vegetables', 'Natural vegetables', 'Natural vegetables', 0, 1, '1741085730.jpg', 'Natural vegetables', 'Natural vegetables', 'Natural vegetables', '2025-02-27 07:37:24'),
(9, 'Fruit', 'Fruit', 'Fruit', 0, 1, '1741085629.jpg', 'Fruit', 'Fruit', 'Fruit', '2025-02-27 07:38:31'),
(13, 'Meat', 'meat', 'all meat', 0, 1, '1741090014.jpg', 'demo', 'demo', 'demo', '2025-03-04 11:37:00'),
(15, 'Oil', 'oil', 'demo', 0, 1, '1741136565.jpg', '', '', '', '2025-03-05 01:02:45'),
(16, 'Cotton Product', 'cotton', 'demo', 0, 1, '1741136725.jpg', '', '', '', '2025-03-05 01:03:43'),
(17, 'Electronics', 'Electronics', 'Electronics', 0, 1, '1741137601.jpg', 'Electronics', 'Electronics', 'Electronics', '2025-03-05 01:10:34'),
(18, 'Plant', 'pant', 'demo', 0, 1, '1741138255.jpg', 'demo', 'demo', 'demo', '2025-03-05 01:28:41');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `tracking_no` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `address` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `pincode` int NOT NULL,
  `total_price` int NOT NULL,
  `payment_mode` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_id` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint DEFAULT '0',
  `comments` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_no`, `user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `created_at`) VALUES
(1, 'sharmacoder701363622336', 1, 'AM Channel', 'houtsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 4086, 'COD', '', 0, NULL, '2025-03-02 01:59:33'),
(2, 'sharmacoder382963622336', 1, 'AM Channel', 'houtsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 4086, 'COD', '', 0, NULL, '2025-03-02 02:02:09'),
(3, 'sharmacoder652563622336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 9, 'COD', '', 0, NULL, '2025-03-02 02:22:26'),
(4, 'sharmacoder989563622336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 18, 'COD', '', 0, NULL, '2025-03-02 02:38:43'),
(5, 'sharmacoder84233', 1, 'AM Channel', 'huotsethla@gmail.com', '123', 'Pursat Village/ Pursat City', 15254, 90, 'COD', '', 0, NULL, '2025-03-02 02:42:19'),
(6, 'sharmacoder30693', 1, 'AM Channel', 'huotsethla@gmail.com', '123', 'Pursat Village/ Pursat City', 15254, 90, 'COD', '', 0, NULL, '2025-03-02 02:44:10'),
(7, 'sharmacoder905363622336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 90, 'COD', '', 0, NULL, '2025-03-02 02:49:05'),
(8, 'sharmacoder449163622121336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622121336', 'Pursat Village/ Pursat City', 15254, 90, 'COD', '', 0, NULL, '2025-03-02 02:52:17'),
(9, 'sharmacoder422763622121336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622121336', 'Pursat Village/ Pursat City', 15254, 90, 'COD', '', 0, NULL, '2025-03-02 02:53:38'),
(10, 'sharmacoder374463622336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 90, 'COD', '', 0, NULL, '2025-03-02 02:58:24'),
(11, 'sharmacoder883763622336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 90, 'COD', '', 0, NULL, '2025-03-02 03:03:37'),
(12, 'sharmacoder45083', 1, 'AM Channel', 'huotsethla@gmail.com', '123', 'Pursat Village/ Pursat City', 15254, 36, 'COD', '', 0, NULL, '2025-03-02 03:05:21'),
(13, 'sharmacoder52873', 1, 'AM Channel', 'huotsethla@gmail.com', '123', 'Pursat Village/ Pursat City', 15254, 108, 'COD', '', 0, NULL, '2025-03-02 03:13:36'),
(14, 'sharmacoder212263622336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 3879, 'COD', '', 0, NULL, '2025-03-02 03:51:11'),
(15, 'sharmacoder411763622336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 3861, 'COD', '', 0, NULL, '2025-03-03 02:09:28'),
(16, 'sharmacoder913163622336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 18, 'Paid by PayPal', '9XA97679ED626061R', 0, NULL, '2025-03-03 09:27:36'),
(17, 'sharmacoder918163622336', 1, 'test test', 'huotsethla@gmail.com', '0963622336', 'test', 90001, 9, 'Paid by PayPal', '12L88129BC118483S', 0, NULL, '2025-03-04 01:08:41'),
(18, 'sharmacoder861663622336', 5, 'AM Channel', 'houtsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 3798, 'Paid by PayPal', '6WA82214WR339825P', 0, NULL, '2025-03-04 02:10:16'),
(19, 'sharmacoder450763622336', 1, 'Huotsethla', 'huotsethla@gmail.com', '0963622336', 'Apartment, suite, unit, building, floor, etc.', 123000, 18, 'Paid by PayPal', '5LF29486R78110406', 0, NULL, '2025-03-04 10:05:01'),
(20, 'sharmacoder861763622336', 1, 'AM Channel', 'huotsethla@gmail.com', '0963622336', 'Pursat Village/ Pursat City', 15254, 9, 'Paid by PayPal', '3CL68128NJ231320A', 0, NULL, '2025-03-05 00:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `qty` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `qty`, `price`, `created_at`) VALUES
(1, 2, 15, 2, 1899, '2025-03-02 02:02:09'),
(2, 2, 14, 1, 18, '2025-03-02 02:02:09'),
(3, 2, 16, 10, 9, '2025-03-02 02:02:09'),
(4, 2, 14, 10, 18, '2025-03-02 02:02:09'),
(5, 3, 13, 1, 9, '2025-03-02 02:22:26'),
(6, 12, 14, 2, 18, '2025-03-02 03:05:21'),
(7, 13, 14, 6, 18, '2025-03-02 03:13:36'),
(8, 14, 15, 2, 1899, '2025-03-02 03:51:11'),
(9, 14, 13, 4, 9, '2025-03-02 03:51:11'),
(10, 14, 16, 1, 9, '2025-03-02 03:51:11'),
(11, 14, 14, 2, 18, '2025-03-02 03:51:11'),
(12, 15, 15, 2, 1899, '2025-03-03 02:09:28'),
(13, 15, 16, 7, 9, '2025-03-03 02:09:28'),
(14, 16, 13, 1, 9, '2025-03-03 09:27:36'),
(15, 16, 13, 1, 9, '2025-03-03 09:27:36'),
(16, 17, 13, 1, 9, '2025-03-04 01:08:41'),
(17, 18, 15, 2, 1899, '2025-03-04 02:10:16'),
(18, 19, 13, 1, 9, '2025-03-04 10:05:01'),
(19, 19, 13, 1, 9, '2025-03-04 10:05:01'),
(20, 20, 21, 1, 9, '2025-03-05 00:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `small_description` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `original_price` int NOT NULL,
  `selling_price` int NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `trending` tinyint NOT NULL DEFAULT '0',
  `meta_title` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `meta_keywords` mediumtext COLLATE utf8mb4_general_ci,
  `meta_description` mediumtext COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`, `image`, `qty`, `status`, `trending`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`) VALUES
(21, 9, 'Avocados', 'avocado', 'Green-Avocado', 'Avocado is a creamy, nutrient-rich fruit packed with healthy fats, fiber, and vitamins.', 10, 9, '1741086462.jpg', 149, 0, 1, 'Nautural', 'Avocado', 'Fresh', '2025-03-04 11:07:42'),
(22, 8, 'Cucumber', 'cucumber', 'healthy', 'Cucumber is refreshing, low-calorie vegetable with a crisp texture and mild flavor.', 2, 1, '1741086891.jpg', 200, 0, 1, 'Nautural', 'organic', 'Cucumber', '2025-03-04 11:14:51'),
(23, 9, 'Apples', 'apple', 'Red', 'Apples are sweet, crunchy fruits packed with vitamins, fiber, antioxidants, fresh. ', 6, 4, '1741087276.jpg', 80, 0, 1, 'Nautural', 'Fresh', 'Good', '2025-03-04 11:21:16'),
(24, 9, 'Mangoes', 'mango', 'Sweet', 'Mangoes are sweet, juicy tropical fruits with a vibrant orange flesh and a slightly tangy flavor. ', 3, 2, '1741087524.jpg', 200, 0, 1, 'Nautural', 'Yellow', 'Good', '2025-03-04 11:25:24'),
(25, 9, 'Strawberries', 'strawbery', 'Red', 'Strawberries are sweet, juicy red berries. Rich in vitamin C, fiber,burst of flavor to salads.', 8, 5, '1741087653.jpg', 50, 0, 1, 'Nautural', 'demo', 'natural', '2025-03-04 11:27:33'),
(26, 9, 'Rambutan', 'rambutan', 'savmav', 'Rambutan is a tropical fruit with a hairy, red or yellow outer skin and a sweet, juicy interior.', 3, 2, '1741087811.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 11:30:11'),
(27, 9, 'Lychee', 'lychee', 'Red', 'Lychee is a small, fruit with a rough, red skin and translucent, sweet, and juicy flesh.', 8, 7, '1741087963.jpg', 80, 0, 1, 'Nautural', 'demo', 'demo', '2025-03-04 11:32:43'),
(28, 9, 'Longan', 'longan', 'mean', 'Longan is a tropical fruit with a sweet, floral flavor and translucent, juicy flesh. ', 2, 1, '1741088140.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 11:35:40'),
(29, 13, 'Sausage', 'sausage', 'sachkrok', 'Sausage is a flavorful meat product, typically made from ground pork, beef.It can be grilled, fried.', 15, 13, '1741088327.jpg', 20, 0, 0, 'demo', 'demo\r\n', 'demo', '2025-03-04 11:38:47'),
(30, 13, 'Beef', 'beef', 'sachko', 'Beef is a rich, protein meat sourced from cattle,its bold flavor and versatility in cooking.', 18, 16, '1741088456.jpg', 20, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 11:40:56'),
(31, 7, 'Milk', 'milk', 'demo', 'Milk is a nutritious liquid produced by mammals, rich in calcium, protein, and vitamins.', 6, 4, '1741088677.jpg', 30, 0, 0, 'demo', 'demo', 'demo', '2025-03-04 11:44:37'),
(32, 7, 'Juice', 'juice', 'fresh', 'Juice is a liquid made from fruits, vegetables,natural flavors and nutrients. ', 4, 3, '1741088767.jpg', 80, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 11:46:07'),
(33, 13, 'Chicken', 'chicken', 'demo', 'Chicken is a versatile, lean source of protein, commonly used in a variety of dishes.', 9, 8, '1741088923.jpg', 20, 0, 1, 'demo', 'demo', 'demod', '2025-03-04 11:48:43'),
(34, 13, 'Egg', 'egg', 'demo', 'Eggs are a highly nutritious food, rich in protein, vitamins, minerals, and used in baking.', 3, 2, '1741090807.jpg', 100, 0, 1, 'demo', 'demo', 'demod', '2025-03-04 12:20:07'),
(35, 8, 'Nuts', 'nut', 'demo', 'Nuts are nutrient-dense snacks packed with healthy fats, protein, vitamins, and minerals. ', 8, 6, '1741090961.jpg', 100, 0, 1, 'demo', 'demo', 'demod', '2025-03-04 12:22:41'),
(36, 8, 'Carrots', 'carrots', 'demo', 'Carrots are crunchy, sweet root vegetables rich in vitamins, and antioxidants.', 4, 3, '1741091033.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 12:23:53'),
(37, 8, 'Corns', 'corn', 'demo', 'Corn is a versatile, starchy vegetable, enjoyed fresh, grilled, or popped. Rich in fiber.', 3, 1, '1741091094.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 12:24:54'),
(38, 8, 'Garlic', 'garlic', 'demo', 'Garlic is a fragrant, flavorful bulb used widely in cooking for its distinctive taste and aroma.', 2, 1, '1741091251.jpg', 100, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 12:27:31'),
(39, 8, 'Banana flower', 'banana', 'demo', 'It has a mild, slightly bitter taste and is rich in vitamins, minerals, and antioxidants.', 3, 2, '1741091356.jpg', 20, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 12:29:16'),
(40, 8, 'Bok Choy', 'bokchoy', 'demo', 'Bok choy is a leafy green vegetable with crisp white stems and dark green leaves.', 3, 2, '1741091471.jpg', 100, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 12:31:11'),
(41, 8, 'Papaya', 'papaya', 'demo', ' Papaya is often enjoyed fresh, in smoothies, or used in salads and desserts.', 4, 3, '1741091547.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 12:32:27'),
(42, 9, 'Dragon fruit', 'dragon fruit', 'demo', 'Dragon fruit is a vibrant fruit with a unique, spiky red flesh speckled with black seeds. ', 6, 5, '1741091997.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 12:39:57'),
(43, 7, 'Orange juice', 'orange', 'demo', 'Orange juice is a refreshing beverage made by extracting the juice from fresh oranges. ', 3, 2, '1741092113.jpg', 50, 0, 1, 'demod', 'demo', 'demo', '2025-03-04 12:41:53'),
(44, 7, 'Honey', 'honey', 'demo', 'Honey is a natural sweetener produced by bees from flower nectar and make healthy.', 8, 7, '1741092205.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-04 12:43:25'),
(45, 7, 'Olive oil', 'olive oil', 'demo', 'Olive oil is a healthy, versatile oil made from pressed olives, Mediterranean cuisine.', 11, 10, '1741092267.jpg', 50, 1, 0, 'demo', 'demo', 'demo', '2025-03-04 12:44:27'),
(46, 16, 'Cotton Bedset', 'betset', 'demo', 'A cotton bedset is a bedding collection made from soft, flat sheet, and pillowcases.', 105, 99, '1741136875.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:07:55'),
(47, 16, 'bamboo silk', 'silk', 'demo', 'Bamboo silk is a luxurious, eco-friendly fabric made from the pulp of bamboo plants.', 80, 70, '1741136984.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:09:44'),
(48, 16, 'Pink set', 'set', 'demo', 'A pink bedset is a bedding collection featuring soft pink tones, calming, and cozy to a bedroom. ', 99, 89, '1741137090.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:11:30'),
(49, 15, 'rosemary oil', 'rosemary', 'demo', 'Rosemary oil is an essential oil extracted from the leaves of the rosemary plant.', 22, 21, '1741137253.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:14:13'),
(50, 15, 'sunflower oil', 'sunflower', 'demo', 'Sunflower oil is a light, mild-flavored oil extracted from sunflower seeds that goods. ', 9, 8, '1741137340.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:15:40'),
(51, 17, 'Drone', 'drone', 'demo', 'A drone is an unmanned aerial vehicle (UAV) that is remotely controlled flown.', 220, 200, '1741137716.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:21:56'),
(53, 17, 'Headphone', 'headphone', 'demo', 'Headphones are audio in the ears to listen to music, podcasts, or other audio.', 99, 89, '1741137861.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:24:21'),
(54, 17, 'Apple watch', 'watch', 'demo', 'The Apple Watch is a modern smartwatch designed and produced by Apple.very Good', 330, 333, '1741137950.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:25:50'),
(55, 18, 'Green plant', 'tree', 'demo', 'Green plant with the best smell of your garden or room.having a good with your plant', 12, 10, '1741138338.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:32:18'),
(56, 18, 'Baby Green', 'tree', 'demo', 'It a good plant for your best partner to reduce stress with naturally and push. your energy day.', 20, 16, '1741138465.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:34:25'),
(57, 18, 'long green', 'tree', 'demo', 'with the long plant it have a good fresh and more feeling with that and make us excited.', 30, 15, '1741138597.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:36:37'),
(58, 18, 'cactus', 'cactus', 'demo', 'my popular cactus with the cute vase and have a nice colors with that body.', 40, 33, '1741138804.jpg', 50, 0, 1, 'demo', 'demo', 'demo', '2025-03-05 01:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role_as` tinyint DEFAULT '0',
  `creared_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role_as`, `creared_at`) VALUES
(1, 'Demo', 'huotsethla@gmail.com', '123', 1, '2025-02-25 05:11:21'),
(2, 'sela', 'houthegnsela@gmail.com', '123', 0, '2025-02-25 05:12:14'),
(4, 'demo', 'houtsethla@gmail.com', '123', 0, '2025-03-01 05:28:14'),
(5, 'AM Channel', 'demo@test.com', '123', 1, '2025-03-04 01:19:52'),
(7, 'admin', 'admin@gmail.com', '$2y$10$mdPR4QRLergZI.4tbP', 1, '2025-03-04 06:03:52'),
(8, 'adminmey', 'limsokmey1168@gmail.com', '123', 0, '2025-03-04 10:30:43'),
(9, 'ROCK', 'rock@rock.com', '123', 0, '2025-03-05 01:47:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
