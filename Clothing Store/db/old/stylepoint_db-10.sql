-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2023 at 01:33 PM
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
(1, 'Fathima Ahla', 'ahla@gmail.com', 782562345, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'user-3.png'),
(2, 'Fathima Ilma', 'ilma@gmail.com', 781231456, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'user-1.jpg');

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
(3, 'Gucci'),
(4, 'NIZA'),
(5, 'Deedat'),
(6, 'MBRK'),
(7, 'MOOSE'),
(8, 'Hue & Dee'),
(9, 'Addidas');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pro_id` int(100) NOT NULL,
  `pro_Name` varchar(100) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `material` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_ID`, `user_id`, `pro_id`, `pro_Name`, `brand_name`, `price`, `color`, `material`, `size`, `quantity`, `image`) VALUES
(17, 2, 1, 'Windbreaker , Denim ', '', 5000, '', '', '', 1, 'gallery-2.jpg'),
(18, 2, 2, 'Windbreaker ', '', 5000, '', '', '', 5, 'Mens-Standard-Fit-Short-Sleeve-V-Neck-T-Shirt01-1-600x764.jpg');

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
(3, 'Kids');

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

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_ID`, `name`, `email`, `number`, `message`, `send_date`, `reply`, `reply_date`) VALUES
(9, 'Fathima Ahla', 'ahla123@gmail.com', 781234567, 'What types of clothing do you offer at your store???', '2023-06-28', ' We offer a variety of clothing options including casual wear, formal wear, activewear, and seasonal', '2023-06-28'),
(10, 'Eshqa', 'eshqa@gmail.com', 753456345, 'How can I place an order on your online clothing store?', '2023-06-29', '', '0000-00-00');

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
  `brand_name` varchar(100) NOT NULL,
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

INSERT INTO `orders` (`orders_ID`, `user_id`, `first_Name`, `last_Name`, `number`, `email`, `address`, `brand_name`, `color`, `material`, `size`, `total_products`, `total_price`, `placed_On`, `image`, `payment_Status`, `pay_Method`) VALUES
(23, 1, 'Mr. , Fathima', 'Ahla', 781234567, 'ahla@gmail.com', '133 A/2, Kahatowita, Veyangoda, 11144', 'Gucci', 'Red', 'Polyester', 'M', 'Floral Printed Mini Dress:  (2000 x 2) Floral Embroidery Kurta Top:  (1600 x 2)', 4200, '2023-06-29', 'Embroidery_Kurta_Top_1.webp', 'completed', 'Payment'),
(25, 1, 'Mr. , Fathima', 'Ahla', 781234567, 'ahla@gmail.com', '133 A/2, Kahatowita, Veyangoda, 11144', 'NIZA', 'Red', 'Denim', 'M', 'adidas Originals Adicolor Crew Set Infant\'s:  (5000 x 1)Flutter Sleeve Denim Romper:  (3000 x 1)', 5250, '2023-06-29', 'Denim_Romper_3.webp', 'pending', 'Direct Bank Transfer'),
(26, 1, 'Mr. , Fathima', 'Ahla', 781234567, 'ahla@gmail.com', '133 A/2, Kahatowita, Veyangoda, 11144', 'NIZA', 'Red', 'Cotton', 'M', 'T-Shirt:  (5000 x 1)Long Sleeve Shirt:  (2500 x 2)', 5250, '2023-06-29', 'long_sleeve_shirt_1.jpg', '', 'Direct Bank Transfer');

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
  `img_1` varchar(1000) NOT NULL,
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
(10, ' Floral Embroidery Kurta Top', '#1235', 'Women', 'Gucci', 1600, 1300, 15, 'Orange', 'Polyester', ' Polyester Model Height 5&#39; 6&#34; wearing color Orange Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', 'Embroidery_Kurta_Top_1.webp', 'Embroidery_Kurta_Top_2.webp', 'Embroidery_Kurta_Top_3.webp', 'Embroidery_Kurta_Top_2.webp'),
(11, 'Print Smocked Sleeve', '#1345', 'Women', 'Gucci', 1500, 1400, 7, 'Orange', 'Cotun', 'Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', 'Print_Smocked_Sleeve_1.webp', 'Print_Smocked_Sleeve_2.webp', 'Print_Smocked_Sleeve_3.webp', 'Print_Smocked_Sleeve_2.webp'),
(14, 'T-Shirt', 'DC02G02', 'Men', 'Deedat', 4450, 4000, 8, 'White', 'DEEDAT', 'Neck - Henle Sleeve - Long Sleeve Texture - Plain Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', 'T-Shirt_white_1.webp', 'T-Shirt_white_2.webp', 'T-Shirt_white_3.webp', 'T-Shirt_white_1.webp'),
(15, 'T-Shirt', 'DC06B01', 'Men', 'Deedat', 5000, 4500, 10, 'Blue', 'DEEDAT', 'Neck - Henley Sleeve - Long Sleeve & Texture - Plain Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', 't-shirt_blue_1.webp', 't-shirt_blue_2.webp', 't-shirt_blue_3.webp', 't-shirt_blue_1.webp'),
(16, 'T-Shirt', '020204320788', 'Men', 'MBRK', 2000, 1600, 20, 'Green', 'Mixed Polyester', 'The model ( Height - 5&#39;11 ft | Waist - 32 | Chest 38 ) is wearing a L size Material - PK Polyester Mix', 't-shirt_green_&_white._1.jpg', 't-shirt_green_&_white.jpg', 't-shirt_green_&_white._2.jpg', 't-shirt_green_&_white.jpg'),
(17, 'Long Sleeve Shirt', '020200413291-1', 'Men', 'NIZA', 2500, 2300, 8, 'Green', 'Cotton', 'The model ( Height - 5&#39;11 ft | Waist - 32 | Chest 38 ) is wearing a XL size', 'long_sleeve_shirt_1.jpg', 'long_sleeve_shirt_2.jpg', 'long_sleeve_shirt_3.jpg', 'long_sleeve_shirt_3.jpg'),
(18, 'Premium Casual Stretch Chino Pant ', '#123445', 'Men', 'MOOSE', 2500, 2300, 8, 'Dark Tan', 'Moose', 'remium Casual Stretch Chino Pant – Dark Tan & Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', 'Casual_Stretch_Chino_Pant_1.jpg', 'Casual_Stretch_Chino_Pant_3.jpg', 'Casual_Stretch_Chino_Pant_2.jpg', 'Casual_Stretch_Chino_Pant_1.jpg'),
(19, 'Casual Dress', '#355674', 'Women', 'Hue & Dee', 3000, 2900, 5, 'Black', 'RIB', 'Texture - Plain Sleeve - Long Sleeve Neck- Crew & Please bear in mind that the photo may be slightly different from the actual item in terms of colour due to lighting conditions or the display used to view', 'Casual_Dress_black_1.webp', 'Casual_Dress_black_3.webp', 'Casual_Dress_black_2.jpeg', 'Casual_Dress_black_1.webp'),
(20, 'adidas Originals Adicolor Crew Set Infant&#39;s', '#2376970', 'Kids', 'Addidas', 5000, 4900, 2, 'Blue', 'Addidas', 'Archival cut lines highlighted with piping details give this infants&#39; adidas crew set its effortlessly cool retro style. Soft fleece keeps them comfortable all day, from playtime to nap time. A Trefoil logo brings it home for a look that is anything but ordinary.', 'jdau_product_1.webp', 'jdau_product_2.webp', 'jdau_product_3.webp', 'jdau_product_4.webp'),
(24, 'Flutter Sleeve Denim Romper', '#274994875', 'Kids', 'NIZA', 3000, 2800, 10, 'Blue', 'Denim', 'Flutter sleeves and a breezy open back dial up the cute factor for your baby on a ruffled denim romper made from soft cotton in a overall-inspired silhouette.', 'Denim_Romper_3.webp', 'Denim_Romper_1.webp', 'Denim_Romper_2.webp', 'Denim_Romper_3.webp');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_ID` int(100) NOT NULL,
  `pro_ID` int(100) NOT NULL,
  `user_ID` int(100) NOT NULL,
  `user_name` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `review` varchar(1000) NOT NULL,
  `rate` int(10) NOT NULL,
  `placed_On` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_ID`, `pro_ID`, `user_ID`, `user_name`, `image`, `review`, `rate`, `placed_On`) VALUES
(5, 16, 0, '', '', 'Thank you for fast shipping from only 3 days', 2, '2023-06-30');

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
(13, 8, 'XXL'),
(14, 11, 'M'),
(15, 11, 'L'),
(16, 11, 'XXL'),
(17, 8, 'L'),
(18, 8, 'XL'),
(19, 11, 'XL');

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
(1, 'Ms. , Fathima', 'ahla', 'ahla@gmail.com', 772466033, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '133 A/2, Kahatowita, Veyangoda, 11144', 'user-4.jpg'),
(2, 'Ms. , Fathima', 'ahla', 'ahla@gmail.com', 772466033, '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '133 A/2, Kahatowita, Veyangoda, 11144', 'user-4.jpg');

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
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_ID`);

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
  MODIFY `admin_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
