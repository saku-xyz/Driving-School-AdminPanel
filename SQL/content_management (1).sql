-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2019 at 01:53 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `content_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upload_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_num` int(11) NOT NULL,
  `visibility_status` tinyint(1) NOT NULL,
  `slot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_type`, `content`, `url`, `upload_time`, `order_num`, `visibility_status`, `slot_id`) VALUES
(1, 'image', 'backlit-chiemsee-dawn-1363876.jpg', 'www.mymobile.lk', '', 2, 1, 1),
(2, 'image', 'waterfall_grass_nature_shadow_92753_1920x1080.jpg', 'www.mymobile.lk', '', 5, 1, 1),
(3, 'image', 'waterfall_grass_nature_shadow_92753_1920x1080.jpg', 'mymobile.lk', '', 5, 1, 2),
(4, '', 'pexels-photo-248797.jpeg', '', '2019-07-31 09:56:58', 7, 1, 1),
(6, '', 'bg-01.jpg', '', '2019-08-21 12:07:45', 3, 0, 2),
(10, '', 'backlit-chiemsee-dawn-1363876.jpg', '', '2019-08-21 12:39:54', 6, 0, 2),
(11, '', 'apple-pro-display-xdr-1280x720-wwdc-2019-21593.jpg', '', '2019-08-21 12:40:12', 1, 0, 1),
(12, '', 'code-coding-css-92905.jpg', '', '2019-08-21 12:40:12', 3, 0, 1),
(13, '', 'apple-pro-display-xdr-1280x720-wwdc-2019-21593.jpg', '', '2019-08-21 12:58:21', 0, 0, 2),
(14, '', 'panda_smile_white_black_minimalist_74449_1920x1080.jpg', '', '2019-08-21 13:46:17', 4, 0, 1),
(15, '', 'code-coding-css-92905.jpg', '', '2019-08-21 13:46:17', 6, 0, 1),
(16, '', 'backlit-chiemsee-dawn-1363876.jpg', '', '2019-08-26 06:52:02', 0, 0, 3),
(17, '', 'backlit-chiemsee-dawn-1363876.jpg', '', '2019-08-26 06:52:32', 4, 0, 2),
(18, '', 'code-coding-css-92905.jpg', '', '2019-08-26 06:52:51', 1, 0, 2),
(19, '', 'panda_smile_white_black_minimalist_74449_1920x1080.jpg', '', '2019-08-26 07:01:17', 2, 0, 2),
(20, '', 'code-coding-css-92905.jpg', '', '2019-08-26 07:03:40', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `slot_id` int(11) NOT NULL,
  `slot_type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `web_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`slot_id`, `slot_type`, `web_id`) VALUES
(1, 'banner', 1),
(2, 'logo', 1),
(3, 'banner', 2),
(4, 'text', 2);

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upload_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `file_name`, `upload_time`, `page_order`) VALUES
(1, 'backlit-chiemsee-dawn-1363876.jpg', '2019-07-25 11:21:59', 2),
(2, 'waterfall_grass_nature_shadow_92753_1920x1080.jpg', '2019-07-25 11:23:07', 0),
(6, 'apple-pro-display-xdr-1280x720-wwdc-2019-21593.jpg', '2019-07-29 12:16:10', 5),
(7, 'code-coding-css-92905.jpg', '2019-07-29 12:16:10', 7),
(9, '0.png', '2019-07-31 08:48:11', 4),
(10, 'GalleZone-Logo.jpg', '2019-07-31 08:48:17', 0),
(13, 'pexels-photo-248797.jpeg', '2019-07-31 09:55:39', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `user_name`, `password`, `user_status`) VALUES
(7, 'Sakuntha', 'admin@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 0),
(8, 'Jeffrey', 'jeffrey@gallezone.lk', '81dc9bdb52d04dc20036dbd8313ed055', 0),
(9, 'Test', 'test1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_slots`
--

CREATE TABLE `user_slots` (
  `user_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_slots`
--

INSERT INTO `user_slots` (`user_id`, `slot_id`) VALUES
(1, 1),
(1, 2),
(5, 1),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `web_id` int(11) NOT NULL,
  `web_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`web_id`, `web_name`, `url`) VALUES
(1, 'Gallezone Solutions', 'www.gallezone.lk'),
(2, 'My Mobile', 'www.mymobile.lk');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `slot_id` (`slot_id`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `web_id` (`web_id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_slots`
--
ALTER TABLE `user_slots`
  ADD PRIMARY KEY (`user_id`,`slot_id`);

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`web_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `web_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
