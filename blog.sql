-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2020 at 09:03 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `articlename` varchar(50) DEFAULT NULL,
  `articlecontent` varchar(255) DEFAULT NULL,
  `imagepath` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `articlename`, `articlecontent`, `imagepath`, `userid`) VALUES
(1, 'Economy of India', 'articleContent/Economy of India.txt', 'articleContent/image/Screenshot (7).png', 1),
(3, 'Territorial disputes of India and Nepal', 'articleContent/Territorial disputes of India and Nepal.txt', 'articleContent/image/Screenshot (2).png', 3),
(4, 'Corona Virus spread', 'articleContent/Corona Virus spread.txt', 'articleContent/image/Screenshot (1).png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `loginid` int(11) NOT NULL,
  `articleid` int(11) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `loginid`, `articleid`, `createdon`, `updatedon`) VALUES
(245, 'asgdfh', 1, 1, '2020-10-15 13:00:13', '0000-00-00 00:00:00'),
(246, 'dgdfgdfg', 1, 1, '2020-10-15 13:02:57', '0000-00-00 00:00:00'),
(247, 'dhfhgj', 1, 1, '2020-10-15 13:03:13', '0000-00-00 00:00:00'),
(248, 'sdgfdgdfg', 1, 1, '2020-10-15 13:03:29', '0000-00-00 00:00:00'),
(249, 'asdgdfgfd', 1, 1, '2020-10-15 13:03:43', '0000-00-00 00:00:00'),
(250, 'fagdfgdfg', 1, 1, '2020-10-15 13:04:10', '0000-00-00 00:00:00'),
(251, 'asddfgdfg', 1, 1, '2020-10-15 13:04:37', '0000-00-00 00:00:00'),
(252, 'xjngdfhdf', 1, 1, '2020-10-17 01:02:38', '0000-00-00 00:00:00'),
(253, 'tjyuiyu456456', 1, 1, '2020-10-29 11:13:37', '0000-00-00 00:00:00'),
(254, 'dfgfr436456', 1, 1, '2020-10-29 11:19:14', '0000-00-00 00:00:00'),
(255, 'afdgfdhfgh435645654#$$', 1, 1, '2020-10-29 11:31:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` bigint(20) NOT NULL,
  `cookie` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `createAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cookies`
--

INSERT INTO `cookies` (`id`, `cookie`, `username`, `createAt`, `updatedAt`) VALUES
(78, '9211594191834', 'ashishkumar', '2020-07-08 12:33:54', '2020-07-08 07:03:54'),
(86, '291596610959', 'saurabhkala', '2020-08-05 12:32:40', '2020-08-05 07:02:40'),
(89, '5101605419260', 'sanat12', '2020-11-15 11:17:40', '2020-11-15 05:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `dislike_table`
--

CREATE TABLE `dislike_table` (
  `dislike_id` int(11) NOT NULL,
  `dislikes` int(11) NOT NULL,
  `loginid` int(11) NOT NULL,
  `articleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `like_table`
--

CREATE TABLE `like_table` (
  `like_id` int(11) NOT NULL,
  `likes` int(11) NOT NULL,
  `loginid` int(11) NOT NULL,
  `articleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_table`
--

INSERT INTO `like_table` (`like_id`, `likes`, `loginid`, `articleid`) VALUES
(16, 1, 2, 1),
(17, 1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `userid` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`userid`, `username`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'sanat12', 'sanat', 'biswas', 'sanatbiswas786@gmail.com', 'a84f787d4e72ea33adb5ca3e9997490d'),
(2, 'saurabhkala', 'saurabh', 'kala', 'sanatbiswas@gmail.com', '6624eb158332fac5425536df93a681e8'),
(3, 'ashishkumar', 'ashish', 'kumar', 'sanatbiswas541997@gmail.com', 'b20144fcd84e08493cd21206d712feb5');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `replyid` int(11) NOT NULL,
  `replies` varchar(255) DEFAULT NULL,
  `loginid` int(11) NOT NULL,
  `commentid` int(11) NOT NULL,
  `articleid` int(11) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`replyid`, `replies`, `loginid`, `commentid`, `articleid`, `createdon`, `updatedon`) VALUES
(1, 'xchjghjk', 1, 245, 1, '2020-10-29 11:37:34', '0000-00-00 00:00:00'),
(2, 'adfgdfhdg', 1, 248, 1, '2020-10-29 11:42:58', '0000-00-00 00:00:00'),
(3, 'adrytryrt', 1, 248, 1, '2020-10-29 11:43:10', '0000-00-00 00:00:00'),
(6, 'fhgjghj', 1, 255, 1, '2020-10-29 11:49:46', '0000-00-00 00:00:00'),
(7, 'dertytyu', 1, 254, 1, '2020-10-29 12:01:17', '0000-00-00 00:00:00'),
(8, 'erutyuy567567!@#$%^', 1, 253, 1, '2020-10-29 12:02:24', '0000-00-00 00:00:00'),
(9, 'asdfagdf', 1, 246, 1, '2020-10-29 12:07:10', '0000-00-00 00:00:00'),
(10, 'dfjtgj56765', 1, 253, 1, '2020-10-29 12:08:20', '0000-00-00 00:00:00'),
(11, 'dffhfg45657', 1, 253, 1, '2020-10-29 12:09:49', '0000-00-00 00:00:00'),
(12, 'edtyutrut', 1, 249, 1, '2020-10-29 12:21:35', '0000-00-00 00:00:00'),
(13, 'sfhgjghk', 1, 250, 1, '2020-10-29 12:24:21', '0000-00-00 00:00:00'),
(14, 'asdfdfgdghgfhf', 1, 255, 1, '2020-10-29 12:25:21', '0000-00-00 00:00:00'),
(15, 'rtryrtuy45677', 1, 254, 1, '2020-10-29 12:25:57', '0000-00-00 00:00:00'),
(16, 'asgdhfgh', 1, 255, 1, '2020-10-29 12:27:22', '0000-00-00 00:00:00'),
(17, 'tedtrty', 1, 255, 1, '2020-10-29 12:27:54', '0000-00-00 00:00:00'),
(18, 'asgdfhfgh', 1, 255, 1, '2020-10-29 12:29:30', '0000-00-00 00:00:00'),
(19, 'werersyrtyrt56756', 1, 255, 1, '2020-10-29 12:34:06', '0000-00-00 00:00:00'),
(20, 'SAfghfgj', 1, 255, 1, '2020-10-29 12:42:49', '0000-00-00 00:00:00'),
(21, 'adfggfhfgjh', 1, 255, 1, '2020-10-29 12:43:59', '0000-00-00 00:00:00'),
(22, 'adfgfghfgh', 1, 255, 1, '2020-10-29 12:44:21', '0000-00-00 00:00:00'),
(23, 'asdgdffgh', 1, 255, 1, '2020-10-29 12:45:13', '0000-00-00 00:00:00'),
(24, '457567567', 1, 254, 1, '2020-10-29 12:46:59', '0000-00-00 00:00:00'),
(25, 'dghjghj', 1, 245, 1, '2020-10-29 12:48:20', '0000-00-00 00:00:00'),
(26, '45645654645645', 1, 255, 1, '2020-10-29 13:00:06', '0000-00-00 00:00:00'),
(27, '234233453456465', 1, 255, 1, '2020-10-29 13:00:27', '0000-00-00 00:00:00'),
(28, '789789789', 1, 255, 1, '2020-10-29 13:01:27', '0000-00-00 00:00:00'),
(29, '', 1, 245, 1, '2020-10-29 13:02:38', '0000-00-00 00:00:00'),
(30, '', 1, 245, 1, '2020-10-29 13:02:43', '0000-00-00 00:00:00'),
(31, '', 1, 245, 1, '2020-10-29 13:02:43', '0000-00-00 00:00:00'),
(32, '', 1, 245, 1, '2020-10-29 13:02:44', '0000-00-00 00:00:00'),
(33, '', 1, 245, 1, '2020-10-29 13:03:00', '0000-00-00 00:00:00'),
(34, '', 1, 245, 1, '2020-10-29 13:03:01', '0000-00-00 00:00:00'),
(35, '', 1, 245, 1, '2020-10-29 13:03:02', '0000-00-00 00:00:00'),
(36, 'fdgdghjk56756734', 1, 255, 1, '2020-10-30 12:02:22', '0000-00-00 00:00:00'),
(37, 'dfhfgytry5676575675672323', 1, 255, 1, '2020-10-30 12:03:05', '0000-00-00 00:00:00'),
(38, 'hr654665765', 1, 255, 1, '2020-10-30 12:04:02', '0000-00-00 00:00:00'),
(39, 'edtu5675678', 1, 255, 1, '2020-10-30 12:04:32', '0000-00-00 00:00:00'),
(40, 'wryrt45621342343245', 1, 255, 1, '2020-10-30 12:05:01', '0000-00-00 00:00:00'),
(41, 'erter34534534645623543', 1, 255, 1, '2020-10-30 12:05:56', '0000-00-00 00:00:00'),
(42, 'fhfgj346456', 1, 255, 1, '2020-10-30 12:07:39', '0000-00-00 00:00:00'),
(43, '4567657567', 1, 255, 1, '2020-10-30 12:08:28', '0000-00-00 00:00:00'),
(44, 'we6645645647', 1, 255, 1, '2020-10-30 12:09:13', '0000-00-00 00:00:00'),
(45, 'adfgdfshrtyrty456456345634', 1, 255, 1, '2020-10-30 12:09:31', '0000-00-00 00:00:00'),
(46, 'AFWERTER5634645', 1, 255, 1, '2020-10-30 12:10:00', '0000-00-00 00:00:00'),
(47, '@@#$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$', 1, 255, 1, '2020-10-30 12:13:04', '0000-00-00 00:00:00'),
(48, 'sae34534346', 1, 255, 1, '2020-10-30 12:14:15', '0000-00-00 00:00:00'),
(49, 'sadfsdt345345346', 1, 255, 1, '2020-10-30 12:15:28', '0000-00-00 00:00:00'),
(50, 'aertertrtert', 1, 255, 1, '2020-10-30 12:15:55', '0000-00-00 00:00:00'),
(51, 'aewrte46', 1, 255, 1, '2020-10-30 12:16:20', '0000-00-00 00:00:00'),
(52, '21342423445435', 1, 251, 1, '2020-10-30 12:17:07', '0000-00-00 00:00:00'),
(53, 'awrewte3465464564', 1, 255, 1, '2020-10-30 12:17:57', '0000-00-00 00:00:00'),
(54, 'artert346645', 1, 255, 1, '2020-10-30 12:18:22', '0000-00-00 00:00:00'),
(55, 'afa345345664', 1, 255, 1, '2020-10-30 12:23:50', '0000-00-00 00:00:00'),
(56, 'agerer645645', 1, 255, 1, '2020-10-30 12:24:27', '0000-00-00 00:00:00'),
(57, 'wrey45654756', 1, 255, 1, '2020-10-30 12:25:52', '0000-00-00 00:00:00'),
(58, 'qe434536456456', 1, 255, 1, '2020-10-30 12:27:31', '0000-00-00 00:00:00'),
(59, '12342534346456', 1, 255, 1, '2020-10-30 12:28:21', '0000-00-00 00:00:00'),
(60, 'qwert35346456547', 1, 255, 1, '2020-10-30 12:28:56', '0000-00-00 00:00:00'),
(61, 'wertwer456456456', 1, 255, 1, '2020-10-30 12:35:18', '0000-00-00 00:00:00'),
(62, 'asere36456756', 1, 255, 1, '2020-10-30 12:39:13', '0000-00-00 00:00:00'),
(63, '34564565467', 1, 255, 1, '2020-10-30 12:42:25', '0000-00-00 00:00:00'),
(64, 'we46456457', 1, 255, 1, '2020-10-31 11:52:27', '0000-00-00 00:00:00'),
(65, 'atert43645645', 1, 255, 1, '2020-10-31 11:53:10', '0000-00-00 00:00:00'),
(66, '345346456', 1, 255, 1, '2020-10-31 11:55:51', '0000-00-00 00:00:00'),
(67, 'ertty567657', 1, 255, 1, '2020-10-31 11:57:03', '0000-00-00 00:00:00'),
(68, '456456657567', 1, 255, 1, '2020-10-31 11:58:02', '0000-00-00 00:00:00'),
(69, 'aertertert', 1, 254, 1, '2020-10-31 12:02:18', '0000-00-00 00:00:00'),
(70, 'w4e56456456', 1, 255, 1, '2020-10-31 12:03:09', '0000-00-00 00:00:00'),
(71, '34545645645', 1, 255, 1, '2020-10-31 12:04:16', '0000-00-00 00:00:00'),
(72, 'w645657', 1, 255, 1, '2020-10-31 12:06:05', '0000-00-00 00:00:00'),
(73, '456456756756', 1, 255, 1, '2020-10-31 12:06:37', '0000-00-00 00:00:00'),
(74, '546456567', 1, 252, 1, '2020-10-31 12:07:03', '0000-00-00 00:00:00'),
(75, '7567567', 1, 250, 1, '2020-10-31 12:07:16', '0000-00-00 00:00:00'),
(76, '345456456', 1, 255, 1, '2020-10-31 12:08:46', '0000-00-00 00:00:00'),
(77, '1234567890', 1, 255, 1, '2020-10-31 12:25:30', '0000-00-00 00:00:00'),
(78, '123234234', 1, 255, 1, '2020-10-31 12:28:59', '0000-00-00 00:00:00'),
(79, '2132435345', 1, 255, 1, '2020-10-31 12:30:53', '0000-00-00 00:00:00'),
(80, '456456567', 1, 255, 1, '2020-10-31 12:32:23', '0000-00-00 00:00:00'),
(81, '656546', 1, 245, 1, '2020-10-31 12:33:08', '0000-00-00 00:00:00'),
(82, 'etytruy', 1, 245, 1, '2020-10-31 12:33:55', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loginid` (`loginid`),
  ADD KEY `articleid` (`articleid`);

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislike_table`
--
ALTER TABLE `dislike_table`
  ADD PRIMARY KEY (`dislike_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_table`
--
ALTER TABLE `like_table`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`replyid`),
  ADD KEY `commentid` (`commentid`),
  ADD KEY `loginid` (`loginid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `dislike_table`
--
ALTER TABLE `dislike_table`
  MODIFY `dislike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `like_table`
--
ALTER TABLE `like_table`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `replyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `register` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`loginid`) REFERENCES `register` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`articleid`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`loginid`) REFERENCES `register` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`commentid`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
