-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2026 at 08:18 AM
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
-- Database: `custom_orders_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_no` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `whatsapp` varchar(30) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `event_date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Confirmed','Completed') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `name`, `whatsapp`, `location`, `category`, `details`, `total_price`, `event_date`, `image`, `status`, `created_at`) VALUES
(8, 'ORD-20260101-B3621', 'hussana', '03899283898', '', 'Custom Bouquet', '', 0.00, '2026-01-17', '1767275782_69567d06b3632.jpg', 'Pending', '2026-01-01 13:56:22'),
(13, 'ORD-09FA43', 'hussana ', '03899283898', '', NULL, 'Red Velvet Cake (x1),  | Area: DHA - Rs. 200 | Address: askari tower 2', 0.00, NULL, NULL, 'Completed', '2026-01-03 03:27:26'),
(15, 'ORD-20260103-4DE33', 'hussana', '03899283898', '', 'Custom Cake', 'no door bell ring', 0.00, '2026-01-04', '1767425238_6958c4d64de72.jpg', 'Confirmed', '2026-01-03 07:27:18'),
(16, 'ORD-2ACD9E', 'hussana ', '03899283898', '', NULL, 'Ranch Dip (x1),  | Area: Gulberg - Rs. 150 | Address: saddar', 0.00, NULL, NULL, 'Completed', '2026-01-07 15:34:14'),
(17, 'ORD-050453', 'hussana ', '03899283898', '', NULL, 'Bento Cake (x1),  | Area: Rawalpindi - Rs. 150 | Address: h24', 0.00, NULL, NULL, 'Pending', '2026-01-07 20:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `price_display` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `item_name`, `category`, `description`, `image`, `price`, `price_display`) VALUES
(1, 'Bento Cake', 'Custom Designs', '', 'cake.jpg', 1700, 'Rs. 1700'),
(2, 'Fresh Cream Cake', 'Signature Cakes', '', 'cream cake.jpg', 2000, 'Rs. 2000/pound'),
(3, 'Red Velvet Cake', 'Signature Cakes', '', 'red velvet.jpg', 2800, 'Rs. 2800/pound'),
(4, 'Small Loaded Shawarma', 'Seasonal Specials', '', 'small.jpg', 350, 'Rs. 350'),
(5, 'Large Cheesy Shawarma', 'Seasonal Specials', '', 'big.jpg', 490, 'Rs. 490'),
(6, 'Chicken Chowmein', 'Seasonal Specials', '', 'chowmein.jpg', 1100, '1100 Rs'),
(7, 'Marry Me Pasta', 'Seasonal Specials', '', 'pasta.jpg', 1200, '1200 Rs'),
(8, 'Mini Trio ', 'Seasonal Specials', '', 'deal.jpg', 1090, '1090 Rs'),
(9, 'Classic Fudge (Box of 4)', 'Premium Collection', '', 'brownie.jpg', 1200, '1200 Rs'),
(10, 'Plain Tea / Fruit Cake', 'Premium Collection', '', 'tea loaf.jpg', 1000, '1000 Rs'),
(11, 'Double Chocolate Loaf', 'Premium Collection', '', 'bnana bread.jpg', 1500, '1500 Rs'),
(12, 'Ranch Dip', 'Seasonal Specials', '', 'dip.jpg', 75, '75 Rs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
