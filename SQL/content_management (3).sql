-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2019 at 10:32 AM
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
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `upload_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_num` int(11) NOT NULL,
  `visibility_status` tinyint(1) NOT NULL,
  `slot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_type`, `content`, `description`, `url`, `upload_time`, `order_num`, `visibility_status`, `slot_id`) VALUES
(1, 'image', 'backlit-chiemsee-dawn-1363876.jpg', '', 'www.mymobiledgs', '', 1, 1, 1),
(2, 'image', 'waterfall_grass_nature_shadow_92753_1920x1080.jpg', '', 'www.mymobile.lk', '', 3, 1, 1),
(3, 'image', 'waterfall_grass_nature_shadow_92753_1920x1080.jpg', '', 'mymobile.lk', '', 1, 1, 2),
(4, '', 'pexels-photo-248797.jpeg', '', '', '2019-07-31 09:56:58', 4, 1, 1),
(6, '', 'bg-01.jpg', '', '', '2019-08-21 12:07:45', 2, 0, 2),
(10, '', 'backlit-chiemsee-dawn-1363876.jpg', '', '', '2019-08-21 12:39:54', 3, 0, 2),
(11, '', 'apple-pro-display-xdr-1280x720-wwdc-2019-21593.jpg', '', '', '2019-08-21 12:40:12', 2, 0, 1),
(12, '', 'code-coding-css-92905.jpg', '', '', '2019-08-21 12:40:12', 0, 0, 1),
(13, '', 'apple-pro-display-xdr-1280x720-wwdc-2019-21593.jpg', '', '', '2019-08-21 12:58:21', 0, 0, 2),
(14, '', 'Capture.PNG', '', '', '2019-09-16 10:16:01', 2, 0, 21),
(15, '', 'Capture.PNG', '', 'www.yfh', '2019-09-16 11:01:16', 1, 0, 20),
(16, '', 'apple-pro-display-xdr-1280x720-wwdc-2019-21593.jpg', '', 'test.com', '2019-09-16 11:14:57', 0, 0, 21),
(17, '', '601909.jpg', '', 'www.music.lk', '2019-09-17 06:11:07', 0, 0, 20),
(18, '', '5iq6Rpc-minions-wallpaper.jpg', '', 'www.lady.lk', '2019-09-17 08:54:16', 0, 0, 20),
(19, '', '5iq6Rpc-minions-wallpaper.jpg', '', 'www.grgg.lk', '2019-09-17 10:31:24', 1, 0, 21);

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `slot_id` int(11) NOT NULL,
  `slot_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slot_type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `web_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`slot_id`, `slot_name`, `slot_type`, `web_id`) VALUES
(2, '', 'text', 2),
(11, 'Test', 'text', 2),
(19, 'Main Banner', 'image', 1),
(20, 'Header 1', 'text', 1),
(21, 'Banner', 'image', 2);

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
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `user_name`, `password`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'admin'),
(2, 'Test', 'test1@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'user');

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
(1, 3),
(1, 4),
(1, 19),
(1, 21),
(2, 1),
(2, 2),
(2, 11),
(13, 11),
(14, 19),
(14, 20);

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
(1, 'Mymobile', 'www.mymobile.lk'),
(2, 'GalleZone Solutions', 'www.gallezone.lk'),
(5, 'MusicLK', 'www.music.lk'),
(6, 'LadyLK', 'www.lady.lk');

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
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `web_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
