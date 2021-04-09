-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 03:10 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_resturant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `firstName` char(20) NOT NULL,
  `lastName` char(20) NOT NULL,
  `email` char(150) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, ' yasmine', 'Nader', 'test@test.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, ' Bethanyy', 'Robertsonn', 'admin@admin.com', '25f9e794323b453885f5181f1b624d0b');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `image` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `image`) VALUES
(10, '16179197202.jpg'),
(11, '16179197581.jpg'),
(12, '1617919918pexels-adam-kontor-420308.jpg'),
(13, '1617919927pexels-diego-pontes-2323398.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` char(100) NOT NULL,
  `image` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`) VALUES
(1, 'Main Courses', '1617861770maincourse.jpg'),
(2, 'Appetizers', '1617913772pexels-ben-1464601.jpg'),
(3, 'Sandwiches', '1617860942sandwich.jpg'),
(4, 'Soup', '1617913670pexels-navada-ra-1703272.jpg'),
(5, 'Beverages', '1617913609pexels-thiszun-(follow-me-on-ig-fb)-1148215.jpg'),
(6, 'Desserts', '1617908842pexels-pixabay-268364.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `name` char(100) NOT NULL,
  `email` char(150) NOT NULL,
  `subject` char(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Irma Lancastermvm', 'myviwykuk@mailinator.com', 'Dolor eveniet sit', 'Unde inventore fugit'),
(2, 'Dale Vance', 'muzase@mailinator.com', 'Nam aut id irure vo', 'Quaerat aut eaque nu');

-- --------------------------------------------------------

--
-- Table structure for table `contact_information`
--

CREATE TABLE `contact_information` (
  `id` int(11) NOT NULL,
  `address` char(100) NOT NULL,
  `phone` char(11) NOT NULL,
  `website` char(150) NOT NULL,
  `email` char(150) NOT NULL,
  `url_facebook` char(255) NOT NULL,
  `url_youtube` char(255) NOT NULL,
  `url_instagram` char(255) NOT NULL,
  `url_twitter` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_information`
--

INSERT INTO `contact_information` (`id`, `address`, `phone`, `website`, `email`, `url_facebook`, `url_youtube`, `url_instagram`, `url_twitter`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur', '01022113344', 'https://www.FoodResturant.com/', 'FoodResturant@mail.com', 'https://www.facebook.com/', 'https://www.youtube.com/', 'https://www.instagram.com/', 'https://www.youtube.com/');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(11) NOT NULL,
  `name` char(100) NOT NULL,
  `subCategory_id` int(11) NOT NULL,
  `image` char(255) NOT NULL,
  `details` varchar(300) NOT NULL,
  `price` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `name`, `subCategory_id`, `image`, `details`, `price`) VALUES
(1, 'Steak', 1, '1617862800pexels-dima-valkov-4001870.jpg', 'Steak Served with Rice and Vegetables', '150'),
(2, 'Meat  With Mushroom sauce', 1, '1617863285pexels-valeria-boltneva-1251208.jpg', 'Meat served with Pasta and Mushroom sauce', '200'),
(3, 'Pasta White Sauce', 4, '1617863644whitesauce.jpg', 'Pasta With White Sauce', '50'),
(4, 'pasta Red Sauce', 4, '1617863679redsauce.jpg', 'pasta With Red Sauce', '40'),
(5, 'Berries Tart', 7, '161791049616179103771617909189pexels-anna-tukhfatullina-food-photographerstylist-2693447.jpg', 'Tart with Berries', '60'),
(6, 'Fruits Tart', 7, '1617909466pexels-nestor-cortez-1157835.jpg', 'Tart with Fruits', '40'),
(7, 'Vanilla Cake', 10, '1617910637pexels-jasmine-lew-140831.jpg', 'Vanilla Cake With Fruits', '200'),
(8, 'Grill Chicken', 2, '1617910852pexels-alleksana-6107766.jpg', 'Grill Chicken served with Corn', '80'),
(9, 'Salmon', 3, '1617910958pexels-krisztina-papp-2374946.jpg', 'Salmon Served With Rice', '110'),
(10, 'Fries With Herbs', 11, '1617911413pexels-romjan-aly-6428247.jpg', 'French Fries With Herbs', '15'),
(11, 'BBQ Wings', 12, '1617911726pexels-omar-mahmood-106343.jpg', 'Fried Chicken Wings With BBQ Sauce', '30'),
(12, 'Chicken Sandwich', 13, '1617912549pexels-nishant-aneja-2955819.jpg', 'Chicken Sandwich Served With Fries', '70'),
(13, 'Chicken Soup', 14, '1617916029pexels-polina-tankilevitch-5419036.jpg', 'Mushroom Chicken Soup  Served with  bread', '25'),
(14, 'Orange Juice', 15, '1617913498pexels-pixabay-158053.jpg', 'Fresh Orange Juice', '20');

-- --------------------------------------------------------

--
-- Table structure for table `home_body`
--

CREATE TABLE `home_body` (
  `id` int(11) NOT NULL,
  `title` char(50) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `home_body`
--

INSERT INTO `home_body` (`id`, `title`, `content`) VALUES
(1, 'About Us', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi eos fugit tenetur at! Reprehenderit corrupti officiis nulla, ue aut, esse nulla sunt deserunt asperiores facilis ratione illum exercitationem nisi cumque maxime fugit voluptatem Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi eos fugit tenetur at! Reprehenderit corrupti officiis nulla, ue aut, esse nulla sunt deserunt asperiores facilis ratione illum exercitationem nisi cumque maxime fugit voluptatem Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi eos fugit tenetur at! Reprehenderit corrupti officiis nulla, ue aut, esse nulla sunt deserunt asperiores facilis ratione illum exercitationem nisi cumque maxime fugit voluptatem\r\n. ');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `name` char(200) NOT NULL,
  `email` char(150) NOT NULL,
  `phone` char(11) NOT NULL,
  `date` date NOT NULL,
  `guests` int(11) NOT NULL,
  `tables` tinyint(20) NOT NULL,
  `time` char(10) NOT NULL,
  `section` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `name`, `email`, `phone`, `date`, `guests`, `tables`, `time`, `section`) VALUES
(7, 'Barry Washingtonjnjjjkjbjhbj', 'sorusiwuli@mailinator.com', '01225557775', '1980-11-18', 999, 127, '5 PM', 'Smoking Area'),
(8, 'Irene Kelleysndjsdshds', 'baza@mailinator.com', '01092065022', '1976-12-21', 730, 127, '9 PM', 'Non Smoking Area'),
(9, 'Vivian Wintersfvkxjvlkjckvkjckv', 'kozup@mailinator.com', '01092065022', '2018-09-17', 787, 127, '3 PM', 'Non Smoking Area');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` char(100) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `image` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `categories_id`, `image`) VALUES
(1, 'Meat', 1, '1617915827meat.jpg'),
(2, 'chicken', 1, '1617861935chicken.jpg'),
(3, 'Fish', 1, '1617861971fish.jpg'),
(4, 'Pasta', 1, '1617863572pasta.jpg'),
(7, 'Tarts', 6, '1617908910pexels-pixabay-461431.jpg'),
(10, 'Cakes', 6, '161791029416179098611617908935pexels-suzy-hazelwood-1126359.jpg'),
(11, 'Fries', 2, '1617911120fries.jpg'),
(12, 'Chicken Wings', 2, '1617911155pexels-harry-dona-2338407.jpg'),
(13, 'Chicken', 3, '1617912683pexels-iconcom-236488.jpg'),
(14, 'Chicken soup', 4, '1617914360pexels-anna-pyshniuk-4103375.jpg'),
(15, 'Fresh Juice', 5, '1617913456pexels-pixabay-209594.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `team_information`
--

CREATE TABLE `team_information` (
  `id` int(11) NOT NULL,
  `name` char(50) NOT NULL,
  `image` char(255) NOT NULL,
  `job_title` char(50) NOT NULL,
  `job_description` char(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `team_information`
--

INSERT INTO `team_information` (`id`, `name`, `image`, `job_title`, `job_description`) VALUES
(2, 'Halla Blankenship', '1617927969t2.jpg', 'Rerum id aliquip', 'Id est non consequa'),
(3, 'Baker Terrell', '1617927989t1.jpg', 'Esse totam ut', 'Aute reprehenderit'),
(4, 'Yoshio Wise', '1617928006t3.jpg', 'Officiis sunt', 'Quis odit veniam no'),
(5, 'Jena Irwin', '1617928022t4.jpg', 'Necessitatibus', 'Autem consequatur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_information`
--
ALTER TABLE `contact_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subCategory_id` (`subCategory_id`);

--
-- Indexes for table `home_body`
--
ALTER TABLE `home_body`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_id` (`categories_id`);

--
-- Indexes for table `team_information`
--
ALTER TABLE `team_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_information`
--
ALTER TABLE `contact_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `home_body`
--
ALTER TABLE `home_body`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `team_information`
--
ALTER TABLE `team_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_items`
--
ALTER TABLE `food_items`
  ADD CONSTRAINT `food_items_ibfk_1` FOREIGN KEY (`subCategory_id`) REFERENCES `subcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
