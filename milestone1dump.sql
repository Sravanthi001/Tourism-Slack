-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 10, 2017 at 08:09 PM
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
CREATE DATABASE IF NOT EXISTS `cs518-test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cs518-test`;

-- --------------------------------------------------------

--
-- Table structure for table `amusement_parks`
--

DROP TABLE IF EXISTS `amusement_parks`;
CREATE TABLE IF NOT EXISTS `amusement_parks` (
  `username` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `message` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amusement_parks`
--

INSERT INTO `amusement_parks` (`username`, `timestamp`, `message`) VALUES
('@doc', '2017-09-30 09:30:12', 'Hi,\r\nI visited Disneyland last week. I really enjoyed there.'),
('@mater', '2017-09-30 16:11:22', 'Wow..That\'s sounds amazing.'),
('@doc', '2017-10-03 15:43:25', 'This line inserted twice'),
('@doc', '2017-10-03 15:43:18', 'This line inserted twice'),
('@doc', '2017-10-03 15:40:58', 'This line inserted twice'),
('@sally', '2017-10-02 09:42:59', 'glad u enjoyed');

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
(1, '@doc', '2017-10-09 08:16:23.00000', 'Hi how are you'),
(1, '@mater', '2017-10-09 10:22:14.00000', 'I\'m fine.. how are you?');

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
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `user_id_2` (`user_id`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email_id`, `username`, `password`) VALUES
(1, 'Tow', 'Mater', 'mater@rsprings.gov', '@mater', 'admin'),
(2, 'Sally', 'Carrera', 'porsche@rsprings.gov', '@sally', 'admin'),
(3, 'Doc', 'Hudson', 'hornet@rsprings.gov', '@doc', 'admin'),
(4, 'Finn', 'McMissile', 'topsecret@agent.org', '@mcmissile', 'admin'),
(5, 'Lightning', 'McQueen', 'kachow@rusteze.com', '@mcqueen', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
