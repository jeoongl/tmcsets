-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2024 at 10:56 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmcsetsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$N4n.Pdn6NvYTzy/Ff6htIO4GNFYYwiE44qWc1NcFbR40GYz1DHQPi', '2024-05-21 10:36:02', '2024-05-21 10:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `expense_tbl`
--

CREATE TABLE `expense_tbl` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `store` varchar(255) NOT NULL,
  `purchase_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense_tbl`
--

INSERT INTO `expense_tbl` (`id`, `product`, `quantity`, `price`, `store`, `purchase_date`, `created_at`, `updated_at`) VALUES
(1, 'Mango', '4kg', '810.00', 'Puregold', '2024-05-17', '2024-05-16 22:54:04', '2024-05-19 10:31:07'),
(2, 'Banana', '4kg', '700.00', 'Bagsakan', '2024-05-16', '2024-05-16 22:58:40', '2024-05-19 10:31:07'),
(3, 'Banana', '1 sack', '2500.00', 'SM', '2024-05-19', '2024-05-19 05:46:16', '2024-05-19 10:31:07'),
(6, 'Banana', '1 sack', '2000.00', 'Bagsakan', '2024-05-20', '2024-05-19 21:36:59', '2024-05-19 21:36:59'),
(7, 'Banana', '1 sack', '1000.00', 'Bagsakan', '2024-05-21', '2024-05-21 15:32:47', '2024-05-21 15:32:47'),
(8, 'Sugar', '4kg', '200.00', 'Puregold', '2024-05-22', '2024-05-21 23:54:17', '2024-05-21 23:54:17'),
(9, 'Banana', '1 sack', '1000.00', 'Bagsakan', '2024-05-22', '2024-05-22 01:42:11', '2024-05-22 01:42:11'),
(13, 'Mango', '1', '1000.00', 'Sonsavings', '2024-05-18', '2024-05-22 06:02:47', '2024-05-22 06:02:47'),
(14, 'Mango', '5 kg', '900.00', 'Bagsakan', '2024-06-10', '2024-06-10 05:25:21', '2024-06-10 08:38:11'),
(15, 'Banana', '1 sack', '700.00', 'Sonsavings', '2024-06-09', '2024-06-10 08:35:02', '2024-06-10 08:35:41'),
(16, 'Plastic Cups', '3 boxes', '600.00', 'SaveMore', '2024-06-08', '2024-06-10 08:37:59', '2024-06-10 08:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `sale_tbl`
--

CREATE TABLE `sale_tbl` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sold_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_tbl`
--

INSERT INTO `sale_tbl` (`id`, `product`, `quantity`, `price`, `sold_date`, `created_at`, `updated_at`) VALUES
(4, 'Fries', '1', '1500.00', '2024-05-16', '2024-05-17 06:43:51', '2024-05-17 06:43:51'),
(5, 'Lomi', '1', '1200.00', '2024-05-17', '2024-05-17 06:44:48', '2024-05-17 06:44:48'),
(6, 'Banana', '1', '2300.00', '0000-00-00', '2024-05-17 07:33:31', '2024-05-21 23:41:13'),
(12, 'Mango Shake', '7', '150.00', '2024-05-22', '2024-05-22 02:16:31', '2024-05-22 06:22:27'),
(13, 'Mango Crepe', '1', '500.00', '2024-05-22', '2024-05-22 02:39:56', '2024-05-22 02:39:56'),
(14, 'Mango', '1sack', '5000.00', '2024-05-21', '2024-05-22 05:32:48', '2024-05-22 05:32:48'),
(15, 'Burger', '20', '6000.00', '2024-06-10', '2024-06-10 05:26:01', '2024-06-10 06:04:45'),
(16, 'Pizza', '3', '800.00', '2024-06-10', '2024-06-10 06:05:09', '2024-06-10 06:05:09'),
(18, 'Lomi', '20', '6500.00', '2024-06-09', '2024-06-10 08:36:19', '2024-06-10 08:36:19'),
(19, 'Beef Pares', '15', '4500.00', '2024-06-08', '2024-06-10 08:38:39', '2024-06-10 08:38:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `expense_tbl`
--
ALTER TABLE `expense_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_tbl`
--
ALTER TABLE `sale_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expense_tbl`
--
ALTER TABLE `expense_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sale_tbl`
--
ALTER TABLE `sale_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
