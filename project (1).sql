-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2022 at 06:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `otp` int(8) NOT NULL,
  `otp_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `otp`, `otp_time`) VALUES
(1, 'admin', '$2y$10$oxc6nKScHklAgufLVR6TPufk/QERLmc3JTHsGbu4FN5YNqDwo6.3O', 'sajankhad2@gmail.com', 801751, '2022-04-28 10:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `blog_id` int(255) NOT NULL,
  `cust_id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`blog_id`, `cust_id`, `title`, `description`, `photo`, `video`) VALUES
(4, 2, 'Cartoon Embriodery', 'This is the embriodery done on a cloth using color threads. The time taken to complete the work was 5 hrs.', 'em4.jpg', ''),
(5, 2, 'Embrioded tshirt', 'This is the customised embroied t-shirt.', '626add7c025292.09123084.jpg', ''),
(6, 1, 'Bamboo: The World’s Most Versatile Product', 'As we’re naturally one of the more vocal advocates of this versatile plant material in the USA. Not only is it fast-growing, sustainable, and eco-friendly, bamboo can be processed in different ways to be used for a huge variety of products around the world.\r\n\r\nOur flooring is a hard-wearing, low cost, and easy to maintain solution for many USA households. Still, bamboo is also found in everything from roads and bridges to entire home constructions, even clothing, beverages, the automotive industry, and toys and gadget accessories, to name but a few.\r\n\r\nHere are just some areas where bamboo is being used today:\r\n\r\nBamboo Roads and Bridges\r\nIf you want any evidence of how strong bamboo is, then its use in roads and bridges should prove enough. China is one place where they are experimenting with this kind of construction, and it could provide a viable alternative to the steel and concrete that have been used in the past in many other parts of the world.', '626bc2721d5dd4.76531352.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `customer_id`, `qty`) VALUES
(78, 34, 14, 5),
(79, 33, 14, 1),
(102, 41, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ct_id` bigint(20) NOT NULL,
  `ct_name` varchar(255) NOT NULL,
  `ct_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ct_id`, `ct_name`, `ct_desc`) VALUES
(29, 'ACHAR', 'Homemade Pickles'),
(30, 'RELIGIOUS ITEM', 'This category contains items for religious purpose'),
(32, 'CLOTHES', 'Wearbale products'),
(33, 'BAGS', 'Used to carry things.');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login_type` varchar(255) NOT NULL,
  `contact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `email`, `password`, `name`, `login_type`, `contact`) VALUES
(1, 'sajankhad1@gmail.com', '$2y$10$obEmTRHHjTWJkE1LlZgxve25CWsYfGkB4ZRLZU11tpV.DnO1VZMP2', 'Ryan Jordan', 'custom', '9865284390'),
(2, 'sajankhad2@gmail.com', '$2y$10$FpxO1WJqz6qGttqdjbzlAebXjvzhKrrZi3Ua3bWOcGFb0IGPipBP.', 'Sajan Khadka', 'custom', '9865284390'),
(14, 'store.homeappliance@gmail.com', 'qwertyuiop', 'Home Appliance Store', 'gmail', '5435643534'),
(17, 'mayatamang4@gmail.com', '$2y$10$RYN.zWGyM3Yme4TUniKrX.g3OV/oukmKE5CqG2btlfaoLTk4QMJiW', 'Maya Tamang', 'custom', '9845213564');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `del_id` bigint(20) NOT NULL,
  `del_user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`del_id`, `del_user`, `password`) VALUES
(2, 'Sam WikWiki', '$2y$10$ow0LRvMNu.GJeiAbBta0P.iXhe2PAp7ewqB.22NWz.9RFE5TJHlUO'),
(4, 'SamWIkWIKI 43254', '$2y$10$5DQfsH1rNlJcFSyomweHPedx0ACwiEp5XrRlzv/W./l/Obr1KECCm'),
(6, 'asda', '$2y$10$qqABejJDqjXiApz71A3eKuOiz2.jhnKqFFEvrdBj21wVeKx7HxQNK'),
(7, 'dasda', '$2y$10$lgCk2k6J1w.67yeUFYCoreRuWzk0N18Z/8i.OXHwSuChxS6Jg8sia'),
(8, 'sdadaf', '$2y$10$vlmTP.gtv.QDXgv7Sb5lYOrc7pKMrvgJ.lkuUbVkBgebD3lkXlNzy'),
(9, 'aaaaaaaaaaaaaaaaaaaaaaaaa', '$2y$10$4llemkjuqjS1KTwU9f1NUOPv7lcNZSF6cG9Nz6plGZrRq97/Kp6bG'),
(10, 'WWWWWWWWWWWWWWWWWWWWWWWWW', '$2y$10$4l4tkODY0pDj08aZupnTmOB1g.OdWc2c2sijZzaS88RLr4V.1TFKa');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` bigint(20) NOT NULL,
  `notices` varchar(2043) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `notices`) VALUES
(9, 'Recruitment of Staff of Women Help Line (WHL) 181 & SRCW The Government of Tamil Nadu is implementing Women Help Line with an objective to provide 24 hours immediate and emergency response to women affected by violence, information about women related government schemes and programs across the country through a single uniform number 181 under State resource Centre for Women, Directorate of Social Welfare, Saidapet, Chennai-15 The Women Help Line (WHL) contact Centre'),
(10, '<b>Women Helpline Coordinator – 1</b> The application form, educational qualification, age and other details are given in the www.tn.gov.in (Social Welfare & Women Empowerment Department). Eligible candidates can apply for the above said posts in the prescribed application form along with a pass-port size photograph which is to be sent to the following address. The Director Directorate of Social Welfare'),
(11, '<b>WOMEN’S EMPOWERMENT SMALL GRANTS PROGRAM</b><br> Polls show that in BiH belief that women should have equal rights with men has declined by 20% since 2015.  We want to reverse that trend and to make women equal participants in economic, civil, and political life in BiH. This program supports NGO efforts to reach that goal. We encourage ideas that are creative and engage citizens at the grass roots level in improving their communities.');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `productid` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_type` text NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_address` varchar(255) NOT NULL,
  `order_delivered` tinyint(1) NOT NULL,
  `payment_received` tinyint(1) NOT NULL,
  `sold` tinyint(1) NOT NULL,
  `bill_no` varchar(255) NOT NULL,
  `seller_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `productid`, `quantity`, `payment_type`, `amount`, `order_date`, `order_address`, `order_delivered`, `payment_received`, `sold`, `bill_no`, `seller_id`) VALUES
(33, 2, 40, 1, 'cash', '350.00', '2021-04-29 03:50:51', 'sdjks,Ktm,NPL,666666', 1, 1, 1, 'COD-2-1651196895', 1),
(35, 2, 40, 1, 'cash', '350.00', '2019-05-02 16:33:14', 'Libali ,BKT,NPL,54564', 1, 1, 1, 'COD-2-1651202882', 1),
(36, 2, 40, 2, 'esewa', '700.00', '2022-03-29 12:36:43', 'sdjks,Ktm,BHR,666666', 1, 1, 1, 'ES-2-1651203171', 1),
(37, 1, 40, 1, 'cash', '350.00', '2022-04-29 06:58:50', 'sdjks,Ktm,NPL,666666', 1, 1, 1, 'COD-1-1651215505', 1),
(38, 1, 46, 2, 'cash', '500.00', '2022-04-29 16:37:51', 'dekocha,bhaktapur,NPL,12', 1, 1, 1, 'COD-1-1651248238', 17),
(39, 1, 42, 10, 'cash', '4500.00', '2022-03-29 16:03:58', 'dekocha,bhaktapur,NPL,12', 1, 1, 1, 'COD-1-1651248238', 1),
(40, 1, 44, 1, 'esewa', '1000.00', '2022-04-09 16:42:45', 'lokanthali,bhaktapur,NPL,90', 1, 1, 1, 'ES-1-1651248471', 1),
(41, 17, 42, 1, 'esewa', '450.00', '2022-04-29 16:37:14', 'sdjks,bhaktapur,BHR,666666', 1, 1, 1, 'ES-17-1651249274', 1),
(42, 17, 43, 1, 'cash', '500.00', '2022-02-23 16:37:25', 'dekocha,bhaktapur,BGD,666666', 1, 1, 1, 'COD-17-1651249470', 1),
(43, 17, 40, 1, 'cash', '350.00', '2022-04-29 16:37:20', 'dekocha,bhaktapur,BGD,666666', 1, 1, 1, 'COD-17-1651249470', 1),
(44, 17, 44, 1, 'esewa', '1000.00', '2022-02-10 16:43:39', 'lokanthali,bhaktapur,NPL,666666', 1, 1, 1, 'ES-17-1651249697', 1),
(45, 17, 43, 1, 'esewa', '500.00', '2022-03-01 16:32:34', 'lokanthali,bhaktapur,NPL,666666', 1, 1, 1, 'ES-17-1651249697', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pr_id` bigint(20) NOT NULL,
  `cus_id` bigint(20) NOT NULL,
  `pr_name` varchar(255) NOT NULL,
  `pr_desc` varchar(255) NOT NULL,
  `pr_img` varchar(255) NOT NULL,
  `pr_price` decimal(10,2) NOT NULL,
  `pr_qty` int(10) NOT NULL,
  `cat_id` bigint(20) NOT NULL,
  `pr_brand` varchar(255) NOT NULL,
  `stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pr_id`, `cus_id`, `pr_name`, `pr_desc`, `pr_img`, `pr_price`, `pr_qty`, `cat_id`, `pr_brand`, `stock`) VALUES
(40, 1, 'Gundruk', 'Gundruk of Mustard Spinach', '626b43494d43b0.71569828.jpg', '350.00', 2, 29, 'Gundruk', 10),
(41, 1, 'Lakhbatti', 'Lakh per package', '626b7474233692.59368196.png', '11111.00', 10, 30, 'Jay Shree Ram', 10),
(42, 1, 'Scented Candles', 'It is rose scented candles', '626bd953a3a5d7.55236209.jpeg', '450.00', 9, 30, 'Kalon Candles', 20),
(43, 1, 'Crotchet Vest', 'It is customised crotchet vest.', '626bdb4a6ae1f0.46454873.jpg', '500.00', 8, 32, 'Crotchet Vest', 10),
(44, 1, 'Crotchet Sweater', 'It is customised handmade sweater.', '626bdd55b5cd95.23603545.jpg', '1000.00', 13, 32, 'Crotchet', 15),
(46, 17, 'Crotchet Bags', 'Handmade crotchet bags', '626be3284e0b54.01388854.jpg', '250.00', 3, 33, 'Crotchet bags', 5);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `rate_points` decimal(2,1) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `feedback_reply` varchar(255) NOT NULL,
  `product_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `customer_id`, `rate_points`, `feedback`, `feedback_reply`, `product_id`) VALUES
(9, 14, '3.5', 'nice product', 'Thank you', 36),
(16, 14, '4.5', 'kjkj', '&#x263A', 32),
(20, 2, '4.5', '4.5', 'thank you', 33),
(22, 1, '3.5', 'nice', '', 40),
(23, 17, '3.5', 'It is nice bag', '', 46);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `sales_qty` int(11) NOT NULL,
  `cus_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `sales_qty`, `cus_id`) VALUES
(12, 40, 6, 1),
(13, 43, 2, 1),
(14, 44, 2, 1),
(15, 42, 11, 1),
(16, 46, 2, 17);

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

CREATE TABLE `wishes` (
  `wish_id` bigint(20) NOT NULL,
  `wish_cust` bigint(20) NOT NULL,
  `wish_product` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishes`
--

INSERT INTO `wishes` (`wish_id`, `wish_cust`, `wish_product`) VALUES
(22, 14, 37),
(23, 14, 33),
(25, 1, 32),
(27, 2, 36),
(28, 2, 35),
(31, 17, 46),
(32, 17, 42),
(33, 17, 41);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ct_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`del_id`),
  ADD UNIQUE KEY `del_user` (`del_user`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordersss` (`productid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales` (`product_id`);

--
-- Indexes for table `wishes`
--
ALTER TABLE `wishes`
  ADD PRIMARY KEY (`wish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `blog_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ct_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `del_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pr_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wishes`
--
ALTER TABLE `wishes`
  MODIFY `wish_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `ordersss` FOREIGN KEY (`productid`) REFERENCES `products` (`pr_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`ct_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales` FOREIGN KEY (`product_id`) REFERENCES `products` (`pr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
