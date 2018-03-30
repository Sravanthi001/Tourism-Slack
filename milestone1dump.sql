-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2017 at 10:44 PM
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
-- Database: `tourism-slack`
--
CREATE DATABASE IF NOT EXISTS `tourism-slack` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tourism-slack`;
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

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `channel_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `message` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`channel_id`, `username`, `timestamp`, `message`) VALUES
(1, 'Doc', '2017-10-11 17:17:19', 'How\'s your trip to the Universal studio?'),
(1, 'Tow', '2017-10-09 10:22:14', 'I\'m fine.. how are you?'),
(1, 'Doc', '2017-10-09 08:16:23', 'Hi, how are you?'),
(1, 'Tow', '2017-10-11 19:14:23', 'It was super fun. We enjoyed a lot.'),
(1, 'Finn', '2017-10-12 13:16:07', 'Universal studio is really fun. Recently I visited Six Flags and it was fun too.'),
(2, 'Finn', '2017-10-14 17:18:26', 'Hello guys, I\'m planning to visit Yellowstone. Can anyone suggest the best time to go there?'),
(2, 'Doc', '2017-10-14 17:24:27', 'Summer is the best season to go there.'),
(2, 'Lightning', '2017-10-14 18:18:28', 'Yes, now it\'s very cold over there.'),
(3, 'Doc', '2017-10-15 22:33:19', 'Guys must visit the Clearwater beach in Florida. '),
(3, 'Sally', '2017-10-16 00:09:14', 'Really! I will definitely anyways I\'m traveling to Florida in next month.'),
(3, 'Tow', '2017-10-16 00:33:16', 'Yeah I know Doc it\'s beautiful.'),
(4, 'Lightning', '2017-10-15 20:31:19', 'Can someone suggest the excellent zoo in Virginia?'),
(4, 'Finn', '2017-10-15 20:32:13', 'The Virginia Zoo. It\'s in Norfolk.'),
(4, 'Sally', '2017-10-15 20:34:20', 'Metro Richmond Zoo is also a good option.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(100) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email_id`, `username`, `password`) VALUES
(1, 'Tow', 'Mater', 'mater@rsprings.gov', 'Tow', '@tow'),
(2, 'Sally', 'Carrera', 'porsche@rsprings.gov', 'Sally', '@sally'),
(3, 'Doc', 'Hudson', 'hornet@rsprings.gov', 'Doc', '@doc'),
(4, 'Finn', 'McMissile', 'topsecret@agent.org', 'Finn', '@finn'),
(5, 'Lightning', 'McQueen', 'kachow@rusteze.com', 'Lightning', '@lightning');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
