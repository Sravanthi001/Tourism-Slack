-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 10, 2017 at 08:01 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs518-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

DROP TABLE IF EXISTS `channels`;
CREATE TABLE IF NOT EXISTS `channels` (
  `channel_id` int(10) NOT NULL,
  `channel_name` varchar(75) NOT NULL,
  PRIMARY KEY (`channel_id`),
  UNIQUE KEY `channel_name` (`channel_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`channel_id`, `channel_name`) VALUES
(1, 'Amusement Parks'),
(2, 'National Parks'),
(3, 'Beaches'),
(4, 'Aquarium and Zoo'),
(5, 'Museums'),
(6, 'Waterfalls');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
