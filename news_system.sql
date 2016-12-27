-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2016 at 12:09 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `date`, `thumbnail`, `status`) VALUES
(37, 'dadsa', 'dasdasd', '2016-12-01', '1482836615_image.jpg', 'active'),
(42, 'bdabdsba', 'babdabsda', '2016-12-05', '1482836491_kuche.jpg', 'active'),
(44, 'News 7', 'dadsa', '2016-12-05', '1482836517_image.jpg', 'active'),
(45, 'News 7', 'dadsa', '2016-12-05', '1482836535_kuch2.jpg', 'active'),
(46, 'News 7', 'dadsa', '2016-12-05', '1482836563_kuche.jpg', 'active'),
(50, 'ladla', 'ldlsdad', '2016-12-01', '1482836623_kuch2.jpg', 'active'),
(54, 'bladas', 'dasdad', '2016-12-06', '1482836361_kuche.jpg', 'active'),
(60, 'dasda', 'dasdsa', '2016-12-06', '1482836439_image.jpg', 'active'),
(61, 'dasdas', 'adsasdad', '2016-12-06', '1482836473_kuch2.jpg', 'active'),
(62, 'dasdas', 'dasdas', '2016-12-05', '1482836580_kuche.jpg', 'active'),
(63, 'saddas', 'dasdasd', '2016-12-05', '1482836589_kuch2.jpg', 'active'),
(64, 'News 5asdadsa', 'dasdas', '2016-12-05', '1482836598_image.jpg', 'active'),
(65, 'Lats', 'dasdas', '2016-12-01', '1482836631_image.jpg', 'active'),
(68, 'News 7', 'news dasas', '2016-12-06', '1482836744_kuche.jpg', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
