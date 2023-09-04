-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 08:30 PM
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
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_Name`, `email`, `number`, `password`, `image`) VALUES
(1, 'Fathima Ahla', 'binthfayis2321@gmail.com', 761234567, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'user-2.png');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_ID` int(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_ID`, `brand_name`) VALUES
(1, 'Nike'),
(2, 'Zara'),
(3, 'Gucci');

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
  `color` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_ID`, `user_id`, `pro_id`, `pro_Name`, `price`, `color`, `size`, `quantity`, `image`) VALUES
(17, 2, 1, 'Windbreaker , Denim ', 5000, '', '', 1, 'gallery-2.jpg'),
(18, 2, 2, 'Windbreaker ', 5000, '', '', 5, 'Mens-Standard-Fit-Short-Sleeve-V-Neck-T-Shirt01-1-600x764.jpg'),
(25, 1, 2, 'Windbreaker ', 5000, '', '', 15, 'Mens-Standard-Fit-Short-Sleeve-V-Neck-T-Shirt01-1-600x764.jpg'),
(26, 1, 5, 'shirt', 3000, '', '', 1, 'shirt2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_ID` int(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_ID`, `category`) VALUES
(1, 'Men'),
(2, 'Women'),
(3, 'Kids'),
(4, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_ID` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` int(10) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `send_date` date NOT NULL,
  `reply` varchar(1000) NOT NULL,
  `reply_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `first_Name` varchar(100) NOT NULL,
  `last_Name` varchar(100) NOT NULL,
  `number` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `material` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `total_products` varchar(100) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_On` date NOT NULL,
  `image` varchar(100) NOT NULL,
  `payment_Status` varchar(100) NOT NULL,
  `pay_Method` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_ID`, `user_id`, `first_Name`, `last_Name`, `number`, `email`, `address`, `color`, `material`, `size`, `total_products`, `total_price`, `placed_On`, `image`, `payment_Status`, `pay_Method`) VALUES
(9, 1, 'Mrs. , Fathima', 'ahla', 772466033, 'ahla@gmail.com', '133 A/2, Kahatowita, Veyangoda, 11144', '', '', '', 'Windbreaker , Denim  (5000 x 23) - Windbreaker  (5000 x 15) - ', 120750, '2023-06-21', '', 'pending', ''),
(10, 1, 'Mrs. , Fathima', 'ahla', 772466033, 'ahla@gmail.com', '133 A/2, Kahatowita, Veyangoda, 11144', '', '', '', 'Windbreaker , Denim  (5000 x 23) - Windbreaker  (5000 x 15) - ', 120750, '2023-06-21', '', 'completed', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_ID` int(100) NOT NULL,
  `pro_Name` varchar(100) NOT NULL,
  `pro_number` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `dis_Price` int(100) NOT NULL,
  `dis_Percentage` int(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `material` varchar(100) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `img_1` varchar(100) NOT NULL,
  `img_2` varchar(100) NOT NULL,
  `img_3` varchar(100) NOT NULL,
  `img_4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_ID`, `pro_Name`, `pro_number`, `category`, `brand_name`, `price`, `dis_Price`, `dis_Percentage`, `color`, `material`, `description`, `img_1`, `img_2`, `img_3`, `img_4`) VALUES
(8, 'Multicolor Floral Printed Midi Dress', '#1234', 'Women', 'Zara', 2000, 1600, 20, 'Red', 'Polyester', ' Polyester Model Height 5&#39; 6&#34; wearing size M Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', 'Floral_Printed_Midi_1.webp', 'Floral_Printed_Midi_3.webp', 'Floral_Printed_Midi_2.webp', 'Floral_Printed_Midi_4.webp'),
(9, 'Floral Printed Mini Dress', '#1231', 'Women', 'Gucci', 2000, 1500, 25, 'White', 'Cotun', 'Height 5&#39; wearing Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', 'Floral_Printed_1.webp', 'Floral_Printed_3.webp', 'Floral_Printed_2.webp', 'Floral_Printed_1.webp'),
(10, ' Floral Embroidery Kurta Top', '#1235', 'Women', 'Gucci', 1600, 1300, 15, 'Orange', 'Polyester', ' Polyester Model Height 5&#39; 6&#34; wearing color Orange Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', 'Embroidery_Kurta_Top_1.webp', 'Embroidery_Kurta_Top_2.webp', 'Embroidery_Kurta_Top_3.webp', 'Embroidery_Kurta_Top_2.webp');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_ID` int(100) NOT NULL,
  `pro_ID` int(100) NOT NULL,
  `sizes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_ID`, `pro_ID`, `sizes`) VALUES
(13, 8, 'XXL');

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
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_ID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_ID`);

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
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_ID`);

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
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
