-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2022 at 12:47 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-rest`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

DROP TABLE IF EXISTS `cart_tbl`;
CREATE TABLE IF NOT EXISTS `cart_tbl` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `food_name` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int NOT NULL,
  `toppings` varchar(100) NOT NULL,
  `t_price` decimal(8,2) NOT NULL,
  `size` varchar(10) NOT NULL,
  `p_price` decimal(8,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `user_id` (`user_id`),
  KEY `food_name` (`food_name`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_boy`
--

DROP TABLE IF EXISTS `delivery_boy`;
CREATE TABLE IF NOT EXISTS `delivery_boy` (
  `delb_id` int NOT NULL AUTO_INCREMENT,
  `delb_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `availability` varchar(10) NOT NULL DEFAULT 'YES',
  PRIMARY KEY (`delb_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `delivery_boy`
--

INSERT INTO `delivery_boy` (`delb_id`, `delb_name`, `password`, `phone_number`, `email`, `availability`) VALUES
(1, 'Amal', '2119eb59afc81b22cf8a4298047f9723', '0775698999', 'am@gmail.com', 'No'),
(2, 'Kamal', '2119eb59afc81b22cf8a4298047f9723', '0775698496', 'ka@gmail.com', 'No'),
(3, 'Ajith', '2119eb59afc81b22cf8a4298047f9723', '077655984', 'ajith@gmail.com', 'No'),
(4, 'vimal', '2119eb59afc81b22cf8a4298047f9723', '0775695436', 'vimal@gmail.com', 'No'),
(5, 'Ranjith', '2119eb59afc81b22cf8a4298047f9723', '07766836523', 'ranjith@gmail.com', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tbl`
--

DROP TABLE IF EXISTS `feedback_tbl`;
CREATE TABLE IF NOT EXISTS `feedback_tbl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `feedback` varchar(800) NOT NULL,
  `rating` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `feedback_tbl`
--

INSERT INTO `feedback_tbl` (`id`, `customer_name`, `feedback`, `rating`) VALUES
(1, 'Laksana', ' Its Really good and tasty. I Like it.', 4.5),
(2, 'Navarathan', ' All the food are tasty. Chicken fried rice must try . ', 4),
(3, 'Navarathan', 'Some dishes have much salt. Other wise all are good and tasty.', 3.4),
(4, 'Thinushan', ' Delicious food I did not ever eat. Mainly,chicken fried rice must be tried in this restaurant. ', 3.6),
(5, 'Ajinthan', ' Some foods have extra salt. Other wise all are good.', 3.3),
(6, 'Laksana', ' All are good', 4.5),
(7, 'Laksana', ' Yeah nice', 2.5),
(8, 'Laksana', ' Nice', 1.6),
(9, 'Srishayujcha', 'Delivery takes more time. But foods are packed very clean and healthy', 3.8);

-- --------------------------------------------------------

--
-- Table structure for table `food_tbl`
--

DROP TABLE IF EXISTS `food_tbl`;
CREATE TABLE IF NOT EXISTS `food_tbl` (
  `food_name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(6,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `special_day` varchar(50) NOT NULL,
  `availability` varchar(15) NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `response` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`food_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `food_tbl`
--

INSERT INTO `food_tbl` (`food_name`, `category`, `price`, `image`, `special_day`, `availability`, `rating`, `response`) VALUES
('Cake', 'Dessert', '250.00', 'cake.jpg', 'Sunday', 'Yes', 0, 0),
('Celery Juice', 'Drinks', '250.00', 'celery.jpg', 'Monday', 'Yes', 0, 0),
('Chicken fried rice', 'Rice', '350.00', 'chicken fried rice.jpg', '', 'Yes', 4.1, 1),
('Chicken kottu', 'Kottu', '450.00', 'chicken kothu.jpg', '', 'Yes', 0, 0),
('Chicken Noodels', 'noodels', '450.00', 'chicken.jpg', '', 'Yes', 0, 0),
('Chicken pizza', 'Pizza', '1200.00', 'pizza.jpg', 'Sunday', 'Yes', 0, 0),
('Chilli parota', 'Dinner and Breakfast', '240.00', 'chiilli parota.jpg', 'Monday', 'Yes', 0, 0),
('Chocolate ice-cream', 'Dessert', '320.00', 'chocolate icecream.jpg', '', 'Yes', 0, 0),
('Egg fried rice', 'Rice', '250.00', 'egg fried rice.jpg', '', 'Yes', 3.35, 6),
('Egg kottu', 'Kottu', '380.00', 'egg kottu.jpg', 'Wednesday', 'Yes', 0, 0),
('Egg Noodels', 'noodels', '350.00', 'egg noodels.jpg', 'Tuesday', 'Yes', 0, 0),
('Idiyapam', 'Dinner and Breakfast', '40.00', 'idiyapam.JPG', 'Monday', 'Yes', 0, 0),
('Idly', 'Dinner and Breakfast', '75.00', 'download.jpg', 'Monday', 'Yes', 0, 0),
('Masal dhosai', 'Dinner and Breakfast', '150.00', 'dhosai2.jpg', 'Tuesday', 'Yes', 4.2, 3),
('Nutella pizza', 'Pizza', '1250.00', 'Nutrella.jpg', '', 'Yes', 4, 1),
('Orange Juice', 'Drinks', '200.00', 'orange.jpg', 'Tuesday', 'Yes', 0, 0),
('Panner dhosai', 'Dinner and Breakfast', '120.00', 'dosai.jpg', 'Monday', 'Yes', 0, 0),
('Panner Pizza', 'Pizza', '980.00', 'Panner Pizza.jpg', 'Tuesday', 'Yes', 0, 0),
('Poori', 'Dinner and Breakfast', '110.00', 'poori.jpg', '', 'Yes', 4.3, 4),
('Puttu', 'Dinner and Breakfast', '140.00', 'Pittu.jpg', 'Wednesday', 'Yes', 0, 0),
('Rice and curry', 'Rice', '220.00', 'plain rice.jpg', '', 'Yes', 0, 0),
('Rotti', 'Dinner and Breakfast', '80.00', 'Pic1.jpg', 'Tuesday', 'Yes', 0, 0),
('Strawberry ice-cream', 'Dessert', '240.00', 'strawberry.jpg', 'Thursday', 'Yes', 0, 0),
('Strawberry Juice', 'Drinks', '230.00', 'straberry.jpg', 'Monday', 'No', 0, 0),
('Tantori pizza', 'Pizza', '1400.00', 'Tantori.jpg', 'Thursday', 'Yes', 0, 0),
('Vanila iceream', 'Dessert', '310.00', 'vanila.jpg', '', 'Yes', 0, 0),
('Veg fried rice', 'Rice', '300.00', 'veg fried rice.jpg', '', 'Yes', 0, 0),
('Veg kottu', 'Kottu', '330.00', 'kottu.jpg', '', 'Yes', 0, 0),
('Veg Noodels', 'noodels', '250.00', 'veg noodels.jpg', 'Monday', 'Yes', 0, 0),
('Watermelon', 'Drinks', '200.00', 'watermelon.jpg', 'Sunday', 'Yes', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

DROP TABLE IF EXISTS `help`;
CREATE TABLE IF NOT EXISTS `help` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `phone_no` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `reply` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`msg_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`msg_id`, `user_id`, `user_name`, `phone_no`, `email`, `message`, `reply`) VALUES
(1, 3, 'Ajinthan', '0778645321', 'aji@gmail.com', 'Hi', 'Hello'),
(2, 3, 'Ajinthan', '0778645321', 'aji@gmail.com', 'You ', 'yeah me'),
(3, 3, 'Ajinthan', '0778645321', 'aji@gmail.com', 'I didn\'t receive my order yet', 'okok please wait i will check and inform you'),
(4, 3, 'Ajinthan', '0778645321', 'aji@gmail.com', 'Yeah ok thank you.', 'Thank you sir'),
(5, 7, 'Renu', '0987645321', 'renu@gmail.com', 'Thank you all foods are good', 'You are welcomw'),
(6, 1, 'Laksana', '07789564897', 'luxsasiva@gmail', 'Hii, I didn\'t receive my order yet', 'Yeah wait'),
(7, 1, 'Laksana', '07789564897', 'luxsasiva@gmail', 'OK Thank You', NULL),
(8, 2, 'Navarathan', '0773451618', 'navarathan026@gmail.com', 'Hii, do you have extra chocolate topings', 'Yeah, we have'),
(9, 5, 'Thinushan', '0778564321', 'thinu@gmail.com', 'My orders are not arrival yet\r\n', NULL),
(10, 2, 'Navarathan', '0773451618', 'navarathan026@gmail.com', 'Ok, I need some more', 'Yeah, sure'),
(11, 2, 'Navarathan', '0773451618', 'navarathan026@gmail.com', 'Thank you so much!!!', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

DROP TABLE IF EXISTS `order_tbl`;
CREATE TABLE IF NOT EXISTS `order_tbl` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `phone_no` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `total_items` varchar(800) NOT NULL,
  `topping` varchar(100) NOT NULL,
  `t_price` decimal(8,2) NOT NULL,
  `size` varchar(10) NOT NULL,
  `s_price` decimal(8,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `payment_status` varchar(30) NOT NULL DEFAULT 'pending',
  `order_taken` varchar(10) NOT NULL DEFAULT 'No',
  `delb_id` int DEFAULT NULL,
  `delivery_status` varchar(10) NOT NULL DEFAULT 'No',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `user_id`, `user_name`, `phone_no`, `email`, `payment_method`, `address`, `total_items`, `topping`, `t_price`, `size`, `s_price`, `total_price`, `order_date`, `payment_status`, `order_taken`, `delb_id`, `delivery_status`) VALUES
(1, 1, 'Laksana', '07789564897', 'luxsasiva@gmail', 'cash on delivery', 'jaffna', '  Chicken fried rice(3) ', 'Chicken  Panner  Onion', '560.00', 'full', '630.00', '3225.40', '2022-07-25 00:17:02', 'completed', 'Yes', 1, 'YES'),
(2, 2, 'Navarathan', '0773451618', 'navarathan026@gmail.com', 'cash on delivery', 'Kopay', '  Chicken fried rice(4) ', 'Chicken  Tandoori', '530.00', 'full', '630.00', '4640.00', '2022-07-25 00:17:57', 'pending', 'Yes', NULL, 'No'),
(3, 1, 'Laksana', '07789564897', 'luxsasiva@gmail', 'cash on delivery', 'Jaffna', '  Tantori pizza(2) ', 'Onion  Tandoori', '430.00', 'full', '2520.00', '5900.00', '2022-07-25 00:19:25', 'pending', 'Yes', 2, 'No'),
(4, 3, 'Ajinthan', '0778645321', 'aji@gmail.com', 'cash on delivery', 'Thavadi', '  Nutella pizza(1) ', 'Chicken  Panner', '430.00', 'full', '2250.00', '2680.00', '2022-07-25 00:21:37', 'pending', 'Yes', NULL, 'No'),
(5, 5, 'Thinushan', '0778564321', 'thinu@gmail.com', 'cash on delivery', 'Chavacacheri', '  Tantori pizza(2)   Egg fried rice(1)   Egg kottu(1) ', 'Onion  Tandoori', '430.00', 'full', '684.00', '8014.00', '2022-07-25 00:22:40', 'completed', 'Yes', 1, 'YES'),
(6, 4, 'Srisaayu', '0984273214', 'shaayu@gamil.com', 'cash on delivery', 'manohara', '  Chicken Noodels(3)   Chicken fried rice(2) ', 'Panner  Onion', '330.00', 'normal', '350.00', '4780.00', '2022-07-25 00:23:36', 'pending', 'Yes', NULL, 'No'),
(7, 7, 'Renu', '0987645321', 'renu@gmail.com', 'cash on delivery', 'Manipay', '  Tantori pizza(2) ', 'Tandoori  Mushroom  Cheese', '670.00', 'full', '2520.00', '6347.10', '2022-07-25 00:24:38', 'pending', 'Yes', NULL, 'No'),
(8, 7, 'Renu', '0987645321', 'renu@gmail.com', 'cash on delivery', 'Ilavalai', '  Chocolate ice-cream(3) ', '', '0.00', 'full', '576.00', '1728.00', '2022-07-25 00:25:18', 'pending', 'Yes', NULL, 'No'),
(9, 8, 'Hari', '0785643211', 'hari@mail.com', 'cash on delivery', 'Thavadi', '  Idly(9)   Chicken fried rice(6) ', 'Chicken  Tandoori', '530.00', 'full', '630.00', '7540.42', '2022-07-25 00:26:26', 'pending', 'Yes', NULL, 'No'),
(10, 10, 'Priya', '076543821', 'pri@gmail.com', 'cash on delivery', 'Nerveli', '  Chicken kottu(6) ', 'Chicken  Tandoori', '530.00', 'full', '810.00', '8040.00', '2022-07-25 00:28:15', 'pending', 'Yes', NULL, 'No'),
(11, 20, 'Kenu', '09798783643', 'kenu@gmail.com', 'cash on delivery', 'Kokuvil', '  Tantori pizza(2) ', 'Tandoori  Mushroom', '540.00', 'full', '2520.00', '6074.40', '2022-07-25 00:29:32', 'pending', 'Yes', NULL, 'No'),
(12, 3, 'Ajinthan', '0778645321', 'aji@gmail.com', 'cash on delivery', 'arali', '  Chicken fried rice(2) ', 'Onion  Tandoori', '430.00', 'full', '630.00', '2093.20', '2022-07-25 00:31:17', 'completed', 'Yes', 1, 'YES'),
(13, 1, 'Laksana', '07789564897', 'luxsasiva@gmail', 'cash on delivery', 'Tellippalai', '  Chicken fried rice(3) ', 'Chicken  Panner  Onion', '560.00', 'full', '630.00', '3478.75', '2022-07-25 00:32:55', 'completed', 'Yes', 1, 'YES'),
(75, 2, 'Navarathan', '0773451618', 'navarathan026@gmail.com', 'cash on delivery', 'Jaffna', '  Nutella pizza(1) ', 'Tandoori', '300.00', 'Small', '1250.00', '1550.00', '2022-09-08 21:09:07', 'completed', 'Yes', 1, 'YES'),
(76, 2, 'Navarathan', '0773451618', 'navarathan026@gmail.com', 'paypal', 'Jaffna', '  Nutella pizza(1) ', 'Onion', '130.00', 'Small', '1250.00', '1364.50', '2022-09-08 21:17:56', 'completed', 'No', NULL, 'No');

-- --------------------------------------------------------

--
-- Stand-in structure for view `random`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `random`;
CREATE TABLE IF NOT EXISTS `random` (
`user_id` int
,`user_name` varchar(100)
,`total_amount` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `rand_tbl`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `rand_tbl`;
CREATE TABLE IF NOT EXISTS `rand_tbl` (
`user_id` int
,`user_name` varchar(100)
,`total_amount` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Table structure for table `toppings`
--

DROP TABLE IF EXISTS `toppings`;
CREATE TABLE IF NOT EXISTS `toppings` (
  `toppings_id` int NOT NULL AUTO_INCREMENT,
  `toppings` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `category_toppings` varchar(200) NOT NULL,
  PRIMARY KEY (`toppings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `toppings`
--

INSERT INTO `toppings` (`toppings_id`, `toppings`, `price`, `category_toppings`) VALUES
(1, 'Chicken', '230.00', 'Pizza'),
(2, 'Panner', '200.00', 'Pizza'),
(3, 'Onion', '130.00', 'Pizza'),
(4, 'Tandoori', '300.00', 'Pizza'),
(5, 'Mushroom', '240.00', 'Pizza'),
(6, 'Cheese', '130.00', 'Pizza'),
(7, 'Chocolate', '100.00', 'Dessert'),
(8, 'Nuts', '80.00', 'Dessert'),
(9, 'Waffer', '60.00', 'Dessert'),
(10, 'Fruits', '100.00', 'Dessert'),
(11, 'Chicken gravy', '350.00', 'Rice,Kottu,noodels'),
(12, 'Panner gravy', '300.00', 'Rice,Kottu,noodels'),
(13, 'Potato', '250.00', 'Rice,Kottu,noodels'),
(14, 'Vegitabels', '100.00', 'Rice,Kottu,noodels'),
(17, 'Fried Chicken', '320.00', 'Kottu');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

DROP TABLE IF EXISTS `user_tbl`;
CREATE TABLE IF NOT EXISTS `user_tbl` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `phone_no` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `loyality_cart` varchar(10) NOT NULL DEFAULT 'No',
  `star_points` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  KEY `user_name_2` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `user_name`, `phone_no`, `email`, `password`, `user_type`, `loyality_cart`, `star_points`) VALUES
(1, 'Laksana', '07789564897', 'luxsasiva@gmail.com', '1816ac0b4bf213b0cfaacd48b6127f12', 'user', 'Yes', '56.09'),
(2, 'Navarathan', '0773451618', 'navarathan026@gmail.com', '2119eb59afc81b22cf8a4298047f9723', 'user', 'Yes', '0.00'),
(3, 'Ajinthan', '0778645321', 'aji@gmail.com', '4122cb13c7a474c1976c9706ae36521d', 'user', 'Yes', '20.93'),
(4, 'Srisaayu', '0984273214', 'shaayu@gamil.com', 'd25206f06f3137dd920a3e9ae8f0f704', 'user', 'Yes', '47.80'),
(5, 'Thinushan', '0778564321', 'thinu@gmail.com', '3210ddbeaa16948a702b6049b8d9a202', 'user', 'Yes', '80.14'),
(6, 'Anu', '0712345678', 'anu@gmail.com', '594fedee8577238db857952e4ebd4626', 'user', 'No', '0.00'),
(7, 'Renu', '0987645321', 'renu@gmail.com', 'cf3d0dbd7240376c67a0fc8ae0ee65ef', 'user', 'Yes', '80.75'),
(8, 'Hari', '0785643211', 'hari@mail.com', 'a498efba844315bf51e6c087dd50970c', 'user', 'Yes', '75.40'),
(9, 'Kavitha', '0987654345', 'kavitha@gmail.com', '0f6b8fd6e40e37240d19ad66ac90f25f', 'user', 'No', '0.00'),
(10, 'Priya', '076543821', 'pri@gmail.com', 'cdd9e7a0c422cb654303fcf390be26af', 'user', 'Yes', '80.40'),
(12, 'kc', '0743215672', 'kc@gmail.com', '249356bbfb1da29a9309784250982501', 'user', 'No', '0.00'),
(13, 'ena', '0784236823', 'ena@gmail.com', '039750fd4f8ee961def001e5065a9692', 'user', 'No', '0.00'),
(14, 'sasi', '7482748222', 'sasi@gmail.com', 'aa6bfe8bcf6eb51f7e158d8e5101fb71', 'admin', 'No', '0.00'),
(15, 'Kavi', '0896754321', 'kavi@gmail.com', '0f6b8fd6e40e37240d19ad66ac90f25f', 'user', 'No', '0.00'),
(16, 'Lathsha', '0776543214', 'lathu@gmail.com', 'f387c19d12eb1d4e1c1d729f994cf41e', 'user', 'No', '0.00'),
(17, 'Menan', '0796543211', 'mena@gmail.com', '33911ce130141766273452d36df19b6d', 'user', 'No', '0.00'),
(18, 'Rathan', '0765422345', 'rathu@gmail.com', 'f0f696e558d0d251c07fe205a4c3044e', 'user', 'No', '0.00'),
(19, 'mathu', '09978131242', 'mathu@gmail.com', '1816ac0b4bf213b0cfaacd48b6127f12', 'user', 'Yes', '0.00'),
(20, 'Kenu', '09798783643', 'kenu@gmail.com', '1816ac0b4bf213b0cfaacd48b6127f12', 'user', 'Yes', '60.74'),
(21, 'admin', '0776543217', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'No', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `winner`
--

DROP TABLE IF EXISTS `winner`;
CREATE TABLE IF NOT EXISTS `winner` (
  `date` date NOT NULL,
  `winners` varchar(200) NOT NULL,
  UNIQUE KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `winner`
--

INSERT INTO `winner` (`date`, `winners`) VALUES
('2022-07-20', 'pri,Shaayu,Thinushan'),
('2022-07-21', 'Priya,Renu,Navarathan'),
('2022-07-22', 'Laksana,Hari,Thinushan'),
('2022-07-24', 'Renu,Thinushan,Srisaayu'),
('2022-07-25', 'Navarathan,Priya,Laksana');

-- --------------------------------------------------------

--
-- Structure for view `random`
--
DROP TABLE IF EXISTS `random`;

DROP VIEW IF EXISTS `random`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `random`  AS SELECT `order_tbl`.`user_id` AS `user_id`, `order_tbl`.`user_name` AS `user_name`, sum(`order_tbl`.`total_price`) AS `total_amount` FROM `order_tbl` WHERE ((`order_tbl`.`order_taken` = 'Yes') AND (`order_tbl`.`order_date` between (curdate() - 30) and curdate())) GROUP BY `order_tbl`.`user_id` ;

-- --------------------------------------------------------

--
-- Structure for view `rand_tbl`
--
DROP TABLE IF EXISTS `rand_tbl`;

DROP VIEW IF EXISTS `rand_tbl`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rand_tbl`  AS SELECT `order_tbl`.`user_id` AS `user_id`, `order_tbl`.`user_name` AS `user_name`, sum(`order_tbl`.`total_price`) AS `total_amount` FROM `order_tbl` WHERE (`order_tbl`.`order_date` between (curdate() - 30) and curdate()) GROUP BY `order_tbl`.`user_id` ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD CONSTRAINT `cart_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`),
  ADD CONSTRAINT `cart_tbl_ibfk_2` FOREIGN KEY (`food_name`) REFERENCES `food_tbl` (`food_name`);

--
-- Constraints for table `help`
--
ALTER TABLE `help`
  ADD CONSTRAINT `help_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`);

--
-- Constraints for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD CONSTRAINT `order_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
