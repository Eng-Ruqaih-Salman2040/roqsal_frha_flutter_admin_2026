-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2026 at 07:51 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `roqsa_frha_2026`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `imge` text NOT NULL,
  `note` text NOT NULL,
  `date_create` varchar(255) NOT NULL,
  `time_create` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `imge`, `note`, `date_create`, `time_create`) VALUES
(13, '554065.jpg', 'تخفيظات خاصة', '2022-06-23', '19:08:11'),
(14, '840097.jpg', 'تجريبي', '2022-06-23', '19:08:32'),
(15, 'default_image.png', '', '2025-11-24', '14:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` int(11) NOT NULL,
  `imge` text NOT NULL,
  `account_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `imge`, `account_name`) VALUES
(1, '802583.png', 'الكريمي'),
(5, '29193.jpg', 'النجم');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts_user`
--

CREATE TABLE `bank_accounts_user` (
  `id` int(11) NOT NULL,
  `bank_accounts_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `account_number` decimal(10,0) NOT NULL,
  `statues` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank_accounts_user`
--

INSERT INTO `bank_accounts_user` (`id`, `bank_accounts_id`, `shop_id`, `account_number`, `statues`) VALUES
(12, 1, 22, '123456', 1),
(14, 1, 23, '4645646', 1),
(15, 5, 23, '75756757', 1),
(17, 1, 28, '778275575', 1),
(18, 5, 28, '783816194', 1),
(19, 5, 31, '9708798', 1),
(20, 1, 31, '758587587', 0),
(21, 1, 33, '7858657', 1),
(22, 1, 27, '9875867', 1);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `statues` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `statues`) VALUES
(14, 'صنعاء', 1),
(15, 'تعز', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `imge` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_register` varchar(255) NOT NULL,
  `error_password` int(11) NOT NULL DEFAULT 0,
  `activ` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `imge`, `name`, `password`, `phone`, `email`, `date_register`, `error_password`, `activ`) VALUES
(5, '1', '1', '1', 1, '1', '1', 0, 1),
(19, '256292.png', 'سامي', '123', 777486001, 'samizak6001@gmail.com', '2020-11-15', 0, 1),
(20, '256292.png', 'q', '123456', 771611353, 'q@gmail.com', '2020-11-15', 0, 1),
(21, '256292.png', '4', '4', 4, '4', '2020-11-15', 0, 1),
(22, '256292.png', '4', '4', 4, '4', '2020-11-15', 0, 1),
(23, '256292.png', '4', '4', 4, '4', '2020-11-15', 0, 1),
(24, '256292.png', '4', '4', 4, '', '2020-11-15', 0, 1),
(25, '256292.png', '', '', 4, '', '2020-11-15', 0, 1),
(26, '256292.png', 'rt', '123456', 434, 's2@fh.h', '2020-11-15', 0, 1),
(27, '256292.png', 'joana', 'joana', 771139750, 'joan@gmail.com', '2020-11-15', 0, 1),
(28, '256292.png', 'jory', 'jor123', 771139750, 'jor@gmail.com', '2020-11-15', 0, 1),
(29, '256292.png', 'ruqaih', 'ruqsal', 771139750, 'ruq@gmail.com', '2020-11-15', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `shop_id`, `customers_id`) VALUES
(39, 25, 20),
(40, 23, 20),
(42, 23, 26),
(43, 24, 26);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `shop_id`, `file_name`, `uploaded_on`, `status`) VALUES
(27, 22, '18-10-21-182109457.jpg', '2022-06-24 00:33:35', '1'),
(28, 22, '20-10-21-762218155.jpg', '2022-06-24 00:33:35', '1'),
(29, 22, '271209753_474094764078784_6232054251992156714_n.jpg', '2022-06-24 00:33:35', '1'),
(30, 23, '0d3a3ed526c1dd4f61fc66793d7a2034_2.jpg', '2022-06-24 00:41:43', '1'),
(31, 23, '39010643_1756413951133299_7150822850771812352_n.jpg', '2022-06-24 00:41:43', '1'),
(32, 23, 'maxresdefault (1).jpg', '2022-06-24 00:41:43', '1'),
(33, 23, 'maxresdefault (2).jpg', '2022-06-24 00:41:43', '1'),
(34, 23, 'maxresdefault (3).jpg', '2022-06-24 00:41:43', '1'),
(35, 24, '69251433_361842961404838_6697654112567164928_n.jpg', '2022-06-24 00:45:36', '1'),
(36, 24, '240442542_867900364132426_3500434151642082998_n.jpg', '2022-06-24 00:45:36', '1'),
(37, 24, '240581466_870868633835599_5316762520801580901_n.jpg', '2022-06-24 00:45:36', '1'),
(39, 30, '6251.jpg', '2025-10-26 16:05:54', '1'),
(40, 30, 'انواع-الخضار.jpg', '2025-10-26 16:06:34', '1'),
(43, 30, '4821-6.jpg', '2025-10-26 16:08:22', '1'),
(44, 30, '4821-6.jpg', '2025-10-26 16:08:31', '1'),
(45, 31, 'Lamborghini-SC18-2019-3-e1545194949867.jpg', '2025-10-27 00:46:36', '1'),
(46, 27, 'فواكة.jpg', '2025-11-26 19:34:59', '1'),
(47, 24, '2639104.jpg', '2025-12-09 16:10:04', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `type_notification` int(11) NOT NULL,
  `note` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_create` varchar(255) NOT NULL,
  `time_create` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `subject`, `type_notification`, `note`, `status`, `date_create`, `time_create`) VALUES
(9, '', 0, 'dfgdf', 0, '2021-07-29', '23:13: pm'),
(10, '', 0, 'رلارلارلارلارلارلارلارار\r\nتتاالاتلاا', 0, '2022-06-20', '14:09: pm');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `rating_value` int(11) NOT NULL,
  `review_comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `reported` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `rating_value`, `review_comment`, `customer_id`, `shop_id`, `created_time`, `reported`) VALUES
(19, 2, 'الكنج', 28, 24, '2025-12-13 11:54:25', 1),
(21, 2, 'علي ', 20, 24, '2025-12-13 11:55:22', 0),
(22, 3, 'عبد الكريم', 23, 24, '2025-12-13 11:55:52', 0),
(23, 3, 'محمد', 27, 24, '2025-12-13 11:56:41', 0),
(24, 4, 'وسام', 20, 24, '2025-12-13 11:57:14', 0),
(25, 2, 'احمد', 23, 24, '2025-12-13 11:57:58', 0),
(26, 5, 'مليح', 5, 31, '2026-02-22 21:48:55', 0),
(27, 2, 'خيبه', 25, 31, '2026-02-22 21:49:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `bank_accounts_user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `booking_date` varchar(255) NOT NULL,
  `reservation_status` int(1) NOT NULL DEFAULT 0,
  `note` text NOT NULL,
  `bond_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `bank_accounts_user_id`, `shop_id`, `customers_id`, `booking_date`, `reservation_status`, `note`, `bond_no`) VALUES
(24, 14, 22, 19, '2022-06-25', 2, 'وااا', 555887),
(25, 12, 22, 5, '2022-06-27', 2, 'sdfsdfsdfsdfsdf', 5464646),
(26, 12, 22, 5, '2022-07-06', 2, 'qw2323', 34534535),
(27, 14, 23, 26, '2022-08-06', 1, 'hh', 4353453);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `image`, `sort`, `status`) VALUES
(1, 'قاعات', '479566.jpg', 1, 1),
(22, 'موسيقى', '245407.jpg', 5, 1),
(23, 'الخيم', '980228.jpg', 3, 0),
(24, 'دعوات', '30122.jpg', 4, 0),
(27, 'الفساتين', '306060.jpg', 2, 1),
(28, 'كوش', '209042.jpg', 6, 1),
(29, 'حلويات', '166241.jpg', 7, 1),
(30, 'المصورين', '337993.jpg', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city_id` int(2) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(9) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `statues` int(11) NOT NULL DEFAULT 0,
  `layout_them` int(11) NOT NULL DEFAULT 1,
  `viewer` int(11) NOT NULL DEFAULT 0,
  `profession_license` varchar(500) NOT NULL,
  `section_id` int(11) NOT NULL,
  `rating_Admin` double UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `user_name`, `password`, `name`, `city_id`, `address`, `email`, `phone`, `image`, `description`, `price`, `statues`, `layout_them`, `viewer`, `profession_license`, `section_id`, `rating_Admin`) VALUES
(22, 'h', '123456', 'حسين محب', 14, 'شارع كلية الطيران', 'hosin@gmail.com', 777777777, '123260.jpg', '																																																																																																																																															متاح في الايام التالية\r\nالاربعاء,الخميس, الجمعة																																																																																																																																															', 2147483647, 1, 0, 72, 'profession_license_239914.pdf', 22, 5),
(23, 'h1', '123456', 'حمود السمه', 14, 'شارع خولان', 'h1@gmail.com', 777777777, '393432.jpg', 'متوفر في جميع ايام الأسبوع\r\n', 35000, 1, 1, 31, 'profession_license_915778.pdf', 22, 2),
(24, 'm', '123456', 'محمد نبيل محب', 14, 'الحصبة', 'm@gmail.com', 777777777, '548146.jpg', '																																																																																																																																																																																																																																																																																																																																																																																																	متاح في الايام التالية\r\nالاربعاء,الخميس, الجمعة																																																																																																																																																																																																																																																																																																																																																																																																	', 15000, 0, 1, 39, 'profession_license_403284.pdf', 22, 5),
(25, 'admin', '123456', 'كوشة جديد', 14, 'الحصبة', 'q@q.com', 777777777, '229980.jpg', '											جججج											', 10000, 1, 0, 5, 'profession_license_758863.pdf', 28, 3.2),
(27, 'fanan', 'fanan123', '12347', 14, 'شملان', 'jalalwq@gmail.com', 0, '560959.jpg', '																																																																																																																																																																																																																												', 40000, 0, 0, 1, 'profession_license_876022.pdf', 27, NULL),
(28, 'jalal', '12345', 'كيك', 14, 'شملان', 'jalalwq@gmail.com', 0, 'default_image.png', '																																																																																																														', 2000000, 1, 1, 0, 'profession_license_868772.pdf', 29, 2),
(29, 'jalal', '1234567', 'خيم اعراس', 14, 'صنعاء', 'Jalal@gmail.com', 0, '342200.jpg', '																																																																																																																																				', 2000000, 0, 1, 0, 'profession_license_292310.pdf', 23, NULL),
(30, 'hkr', 'jor123', 'خيم اعراس', 14, '', '', 0, 'default_image.png', '', 2147483647, 1, 1, 0, 'profession_license_92717.pdf', 1, NULL),
(31, 'جلال الحمادي', '7777777', 'فنان ', 14, 'شملان', 'Jalal@gmail.com', 0, 'default_image.png', '																																												', 200, 1, 1, 0, 'profession_license_749012.pdf', 22, 2),
(33, 'mohmed', '12345', 'دعوات', 14, 'taiz', 'jalalwq@gmail.com', 0, '983126.jpg', '																																																																																																																																																																																																																																																																																																																																																																																																												', 0, 1, 0, 0, 'profession_license_819353.pdf', 24, 5);

-- --------------------------------------------------------

--
-- Table structure for table `technical_support`
--

CREATE TABLE `technical_support` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_create` varchar(255) NOT NULL,
  `time_create` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technical_support`
--

INSERT INTO `technical_support` (`id`, `name`, `email`, `subject`, `message`, `status`, `date_create`, `time_create`) VALUES
(8, '33', '22', '2', '2', 1, '2022-06-20', '09:49:13'),
(9, '33', '22', '2', '2', 1, '2022-06-20', '09:52:51'),
(10, '6767', '757', '7', '777777', 1, '2022-06-20', '14:11:05'),
(11, '21', '2', '2', '2', 1, '2022-07-15', '17:33:24'),
(12, '21', '2', '2', '2', 1, '2022-07-15', '17:33:28'),
(13, '21', '2', '2', '2', 1, '2022-07-15', '17:33:30'),
(14, 'الاسمسم', 'shsh@gmail.com', 'اايليلث', 'تيتياي', 1, '2022-07-16', '09:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `img_user` varchar(255) NOT NULL,
  `phone` int(9) NOT NULL DEFAULT 777777777,
  `email` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `date_register` varchar(255) NOT NULL,
  `id_validity` int(1) NOT NULL,
  `statues` tinyint(1) NOT NULL,
  `otp_code` int(11) NOT NULL,
  `layout_them` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `password`, `user_name`, `img_user`, `phone`, `email`, `note`, `date_register`, `id_validity`, `statues`, `otp_code`, `layout_them`) VALUES
(137, '7777', 'Gamil', 'default_image.png', 777777777, 'admin@gmail.com', '																						note																						', '', 1, 1, 1, 1),
(138, '123456', 'admin', 'default_image.png', 0, '', '', '2022-07-23', 1, 0, 0, 0),
(139, '123456', 'admin', 'default_image.png', 657, 'fdgdg', '', '2022-07-23', 1, 0, 0, 0),
(140, '123456', 'admin', 'default_image.png', 0, '', '', '2022-07-23', 1, 0, 0, 0),
(141, '123', 'hkr', '920340.jpg', 775432165, 'wessamaref25@gmail.com', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                jalal jmail                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											                                          \r\n											', '2025-10-01', 1, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_accounts_user`
--
ALTER TABLE `bank_accounts_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `bank_accounts_id` (`bank_accounts_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_id` (`customers_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_id` (`customers_id`),
  ADD KEY `bank_accounts_user_id` (`bank_accounts_user_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `main_sections_id` (`section_id`);

--
-- Indexes for table `technical_support`
--
ALTER TABLE `technical_support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bank_accounts_user`
--
ALTER TABLE `bank_accounts_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `technical_support`
--
ALTER TABLE `technical_support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_accounts_user`
--
ALTER TABLE `bank_accounts_user`
  ADD CONSTRAINT `bank_accounts_user_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`),
  ADD CONSTRAINT `bank_accounts_user_ibfk_2` FOREIGN KEY (`bank_accounts_id`) REFERENCES `bank_accounts` (`id`);

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`bank_accounts_user_id`) REFERENCES `bank_accounts_user` (`id`),
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`);

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `shop_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
