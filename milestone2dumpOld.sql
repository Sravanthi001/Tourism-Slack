-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 29, 2017 at 01:03 AM
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
  `channel_id` int(10) NOT NULL AUTO_INCREMENT,
  `channel_name` varchar(75) NOT NULL,
  `channel_type` int(10) NOT NULL,
  `channel_owner` varchar(50) NOT NULL,
  PRIMARY KEY (`channel_id`),
  UNIQUE KEY `channel_name` (`channel_name`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`channel_id`, `channel_name`, `channel_type`, `channel_owner`) VALUES
(1, 'Amusement Parks', 0, ''),
(2, 'National Parks', 0, ''),
(3, 'Beaches', 0, ''),
(4, 'Aquarium and Zoo', 0, ''),
(5, 'Museums', 0, ''),
(6, 'Waterfalls', 0, ''),
(14, 'abc', 1, 'Doc');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE IF NOT EXISTS `membership` (
  `username` varchar(50) NOT NULL,
  `channel_name` varchar(2000) NOT NULL,
  `channel_type` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`username`, `channel_name`, `channel_type`) VALUES
('Tow', 'Museums', 0),
('Tow', 'Amusement Parks', 0),
('Tow', 'National Parks', 0),
('Tow', 'Beaches', 0),
('Doc', 'abc', 1);

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
(4, 'Sally', '2017-10-15 20:34:20', 'Metro Richmond Zoo is also a good option.'),
(1, 'Tow', '2017-10-17 20:42:22', '\"how do you html?\"'),
(1, 'Tow', '2017-10-17 20:46:38', '\"what happens when I ~!@#$%^&*()_+_)(*&^%$#@!~}{:\"><??:{}+}|}{P{}|-/*?\"'),
(1, 'Tow', '2017-10-17 20:47:07', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. '),
(2, 'Tow', '2017-10-17 20:47:30', '\"mcqueen is my best friend\"'),
(1, 'Lightning', '2017-10-17 20:48:55', '\"i hope i win another piston cup!\"'),
(1, 'Tow', '2017-10-18 18:25:37', 'hi &lt;!-- j'),
(1, 'Tow', '2017-10-18 18:27:52', 'can you sql inject with \'; -- \'?'),
(1, 'Tow', '2017-10-18 18:28:07', 'can you sql inject with \'; -- \'?'),
(1, 'Tow', '2017-10-27 04:14:58', 'fghf'),
(1, 'Doc', '2017-10-27 04:18:12', 'heyiehfdsf'),
(1, 'Doc', '2017-10-28 04:46:34', 'hy'),
(1, 'Doc', '2017-10-28 04:46:34', 'hy'),
(1, 'Doc', '2017-10-28 04:47:39', 'hy'),
(1, 'Doc', '2017-10-28 04:48:19', 'yes'),
(1, 'Tow', '2017-10-28 04:49:38', 'yup'),
(1, 'Doc', '2017-10-28 15:18:19', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

DROP TABLE IF EXISTS `msg`;
CREATE TABLE IF NOT EXISTS `msg` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `message` longtext NOT NULL,
  UNIQUE KEY `msg_id` (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`msg_id`, `channel_id`, `username`, `timestamp`, `message`) VALUES
(1, 1, 'Doc', '2017-10-28 16:48:16', 'hey'),
(9, 1, 'Doc', '2017-10-28 19:25:30', 'hello'),
(10, 1, 'Doc', '2017-10-28 19:25:34', 'how');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(100) NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email_id`, `username`, `password`, `avatar`) VALUES
(1, 'Tow', 'Mater', 'mater@rsprings.gov', 'Tow', '@tow', '646045.jpg'),
(2, 'Sally', 'Carrera', 'porsche@rsprings.gov', 'Sally', '@sally', ''),
(3, 'Doc', 'Hudson', 'hornet@rsprings.gov', 'Doc', '@doc', '149533.jpg'),
(4, 'Finn', 'McMissile', 'topsecret@agent.org', 'Finn', '@finn', '466629.jpg'),
(5, 'Lightning', 'McQueen', 'kachow@rusteze.com', 'Lightning', '@lightning', '345199.jpg'),
(35, 'q', 'q', 'q', 'q', 'q', 'images/fjords.jpg'),
(16, 'a', 'a', 'a', 'a', 'a', 'images/aurora-borealis.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `voting_count`
--

DROP TABLE IF EXISTS `voting_count`;
CREATE TABLE IF NOT EXISTS `voting_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(2000) NOT NULL,
  `vote_up` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `msg_id` int(11) NOT NULL,
  `up_count` int(11) NOT NULL,
  `down_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voting_count`
--

INSERT INTO `voting_count` (`id`, `username`, `vote_up`, `message`, `msg_id`, `up_count`, `down_count`) VALUES
(1, 'Doc', 2, 'How\'s your trip to the Universal studio?', 1, 9, 0),
(2, 'Tow', 1, 'fghf', 9, 0, 0),
(3, 'Tow', 1, 'yup', 10, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
