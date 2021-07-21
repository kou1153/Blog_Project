-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 21, 2021 at 01:30 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16978003_schiitblogdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `post_id`, `message`, `date_created`) VALUES
(10, 5, 6, 'hahah I\'m talking to myself', '2021-06-06 02:18:09'),
(9, 4, 5, 'oh wtf ', '2021-06-06 02:13:13'),
(8, 3, 1, 'nice', '2021-06-06 02:09:03'),
(7, 1, 1, 'first', '2021-06-06 02:00:38'),
(11, 7, 8, 'nice', '2021-06-06 02:23:49'),
(12, 8, 1, 'nice mlem mlem', '2021-06-06 14:27:12'),
(13, 9, 1, 'eww', '2021-06-06 15:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `content` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `title`, `image`, `content`, `date_created`) VALUES
(1, 1, 'HololiveEN', './user_images/60bba378e23363.70427074.jpg', 'YES YES YES', '2021-06-05 16:16:56'),
(5, 4, 'TGR Alice', './user_images/60bc2f284a0fe4.63540448.jpg', 'Alice layout', '2021-06-06 02:12:56'),
(4, 3, 'SchiitStack', './user_images/60bc2de43ca5e9.31884942.jpg', 'Schiit Dac Amp stack', '2021-06-06 02:07:32'),
(6, 5, 'Natsuiro Matsuri', './user_images/60bc304feadce8.66643138.jpg', 'Kataomoi', '2021-06-06 02:17:51'),
(7, 6, 'Suisei Consert', './user_images/60bc30ef80e1f6.63856939.png', 'Nice', '2021-06-06 02:20:31'),
(9, 7, 'Good Duo', './user_images/60bc8a2b058b60.83202145.jpg', 'Nice', '2021-06-06 08:41:15'),
(10, 9, 'cringe', './user_images/60bce6e15ad342.70217447.jpg', 'cringe', '2021-06-06 15:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profileimg` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `name`, `profileimg`) VALUES
(1, 'Yagami Kou', '202cb962ac59075b964b07152d234b70', 'this is a name', './profilePics/60bc2c38eef914.50978316.png'),
(3, 'Nuke Code', '4297f44b13955235245b2497399d7a93', '356321', './profilePics/60bc2d7226e4f4.96569798.jpg'),
(4, 'nukecode', '4297f44b13955235245b2497399d7a93', '350536', './profilePics/60bc2f0ef058d3.53745374.jpg'),
(5, 'why am I like this', '4297f44b13955235245b2497399d7a93', '339912', './profilePics/60bc300cc70e84.80629284.jpg'),
(6, 'Suisei', '4297f44b13955235245b2497399d7a93', '355390', './profilePics/60bc30b2355609.80253797.jpg'),
(7, 'DAD', '4297f44b13955235245b2497399d7a93', '299080', './profilePics/60bc31523faba2.92514879.jpg'),
(8, 'khangng2001', 'd67e4382790b023c06f3dee11ef00b9e', 'Khang', './profilePics/60bcdaf8afbe62.40937808.png'),
(9, 'heh cringe', '59cad9a8cc51d085c7fc3243bf7f948f', 'heh cringe', './profilePics/60bce696b162c9.23588787.jpg'),
(10, '18072001', 'd67e4382790b023c06f3dee11ef00b9e', '1959009', './profilePics/60d9320958c007.49847087.png'),
(11, 'minh123', 'e10adc3949ba59abbe56e057f20f883e', 'Kou1153', './profilePics/60f8207c889f86.24934629.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
