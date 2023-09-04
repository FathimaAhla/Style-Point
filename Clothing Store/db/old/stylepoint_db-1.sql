-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 08:19 PM
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
-- Database: `stylepoint_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(100) NOT NULL,
  `admin_Name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_Name`, `email`, `number`, `password`) VALUES
(1, 'Fathima ahla', 'ahla@gmail.com', 772466033, '8cb2237d0679ca88db6464eac60da96345513964');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pro_id` int(100) NOT NULL,
  `pro_Name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_Name` varchar(100) NOT NULL,
  `number` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `total_products` varchar(100) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_On` date NOT NULL,
  `payment_Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_ID`, `user_id`, `user_Name`, `number`, `email`, `address`, `total_products`, `total_price`, `placed_On`, `payment_Status`) VALUES
(1, 1, '\r\nWarning:  Undefined variable $fetch_profile in C:\\xampp\\htdocs\\Clothing Store\\checkout.php on line', 0, '\r\nWarning:  Undefined variable $fetch_profile in C:\\xampp\\htdocs\\Clothing Store\\checkout.php on line', '\r\nWarning:  Undefined variable $fetch_profile in C:\\xampp\\htdocs\\Clothing Store\\checkout.php on line', '<br />\r\n<b>Warning</b>:  Undefined variable $total_products in <b>C:\\xampp\\htdocs\\Clothing Store\\che', 0, '0000-00-00', '\r\nWarning:  Undefined variable $fetch_orders in C:\\xampp\\htdocs\\Clothing Store\\checkout.php on line ');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_ID` int(100) NOT NULL,
  `pro_Name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `dis_Price` int(100) NOT NULL,
  `dis_Percentage` int(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `img_1` varchar(100) NOT NULL,
  `img_2` varchar(100) NOT NULL,
  `img_3` varchar(100) NOT NULL,
  `img_4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_ID`, `pro_Name`, `price`, `dis_Price`, `dis_Percentage`, `color`, `size`, `gender`, `description`, `img_1`, `img_2`, `img_3`, `img_4`) VALUES
(1, 'Windbreaker , Denim - Jacket', 5000, 4000, 20, 'M', 'M', 'Women', 'Light Gray solid Top, has a boat nack, 3/4 sleeves', 'gallery-1.jpg', 'gallery-2.jpg', 'gallery-3.jpg', 'gallery-4.jpg'),
(2, 'Windbreaker ', 5000, 4000, 10, 'M', 'M', 'Women', 'Light Gray solid Top, has a boat nack, 3/4 sleeves', 'Mens-Standard-Fit-Short-Sleeve-V-Neck-T-Shirt01-1-600x764.jpg', 'Mens-Standard-Fit-Short-Sleeve-V-Neck-T-Shirt02-1-600x764.jpg', 'Mens-Standard-Fit-Short-Sleeve-V-Neck-T-Shirt03-1-600x764.jpg', 'buy-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_ID` int(100) NOT NULL,
  `first_Name` varchar(100) NOT NULL,
  `last_Name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_ID`, `first_Name`, `last_Name`, `email`, `number`, `password`, `address`, `image`) VALUES
(1, 'Mrs. , Fathima', 'ahla', 'ahla@gmail.com', 772466033, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '133 A/2, Kahatowita, Veyangoda, 11144', 'user-3.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
