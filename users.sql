-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2017 at 01:32 AM
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
  UNIQUE KEY `user_id_2` (`user_id`)
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
