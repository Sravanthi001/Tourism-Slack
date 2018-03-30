-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 31, 2017 at 06:06 PM
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
  `channel_name` varchar(20) NOT NULL,
  `channel_type` int(10) NOT NULL,
  `channel_owner` varchar(50) NOT NULL,
  PRIMARY KEY (`channel_id`),
  UNIQUE KEY `channel_name` (`channel_name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`channel_id`, `channel_name`, `channel_type`, `channel_owner`) VALUES
(5, 'Private', 1, 'Finn'),
(4, 'Amusement Parks', 0, 'Doc'),
(1, 'General', 0, 'Tow'),
(6, 'National Parks', 0, 'Sally');

-- --------------------------------------------------------

--
-- Table structure for table `child_voting_count`
--

DROP TABLE IF EXISTS `child_voting_count`;
CREATE TABLE IF NOT EXISTS `child_voting_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `userresponded` varchar(50) NOT NULL,
  `vote_up` int(11) NOT NULL,
  `child_msg_id` int(11) NOT NULL,
  `up_count` int(11) NOT NULL,
  `down_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_voting_count`
--

INSERT INTO `child_voting_count` (`id`, `username`, `userresponded`, `vote_up`, `child_msg_id`, `up_count`, `down_count`) VALUES
(17, 'Doc', 'Sally', 1, 8, 1, 0),
(16, 'Finn', 'Sally', 1, 11, 1, 0),
(15, 'Doc', 'Sally', 2, 10, 0, 1),
(14, 'Doc', 'Sally', 1, 9, 1, 0),
(13, 'Doc', 'Doc', 1, 9, 1, 0),
(12, 'Doc', 'Doc', 2, 10, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

DROP TABLE IF EXISTS `invitation`;
CREATE TABLE IF NOT EXISTS `invitation` (
  `invite_id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_name` varchar(50) NOT NULL,
  `sender_name` varchar(20) NOT NULL,
  `receiver_name` varchar(20) NOT NULL,
  PRIMARY KEY (`invite_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`invite_id`, `channel_name`, `sender_name`, `receiver_name`) VALUES
(16, 'Amusement Parks', 'Doc', 'Tow');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE IF NOT EXISTS `membership` (
  `username` varchar(50) NOT NULL,
  `channel_name` varchar(20) NOT NULL,
  `channel_type` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`username`, `channel_name`, `channel_type`) VALUES
('Tow', 'General', 0),
('Sally', 'General', 0),
('Doc', 'General', 0),
('Finn', 'General', 0),
('Lightning', 'General', 0),
('Doc', 'Amusement Parks', 0),
('Finn', 'Amusement Parks', 0),
('Finn', 'Private', 1),
('Sally', 'Private', 1),
('Sally', 'National Parks', 0);

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
(1, 'Doc', '2017-10-28 15:18:19', 'yes'),
(2, 'Doc', '2017-10-29 03:28:43', '~!@#$%^&amp;*()_+_)(*&amp;^%$#@!~}{:&quot;&gt;&lt;??:{}+}\\|}{P{}|-/*?~!@#$%^&amp;*()_+_)(*&amp;^%$#@!~}{:&quot;&gt;&lt;??:{}+}\\|}{P{}|-/*?~!@#$%^&amp;*()_+_)(*&amp;^%$#@!~}{:&quot;&gt;&lt;??:{}+}\\|}{P{}|-/*?~!@#$%^&amp;*()_+_)(*&amp;^%$#@!~}{:&quot;&gt;&lt;??:{}+}\\|}{P{}|-/*? \\n\\n &lt;!-- unless you cannot read this --&gt;'),
(2, 'Doc', '2017-10-29 03:29:25', 'Ghosts &lt;b&gt;DO&lt;/b&gt; Exist');

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
(5, 1, 'Tow', '2017-10-31 02:34:41', '1\'st message ? -- &gt; &quot;'),
(6, 1, 'Tow', '2017-10-31 02:35:08', 'hi &lt;!-- how are you;;&quot;\''),
(7, 1, 'Finn', '2017-10-31 02:54:14', 'i\'m new '),
(8, 1, 'Finn', '2017-10-31 02:54:21', '??????'),
(9, 4, 'Finn', '2017-10-31 02:55:10', 'hello ... !!'),
(10, 5, 'Sally', '2017-10-31 02:59:00', 'this is private ch ; ?');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

DROP TABLE IF EXISTS `replies`;
CREATE TABLE IF NOT EXISTS `replies` (
  `msg_id` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL AUTO_INCREMENT,
  `child_msg` longtext NOT NULL,
  `username` varchar(25) NOT NULL,
  `timestamp` timestamp NOT NULL,
  UNIQUE KEY `reply_id` (`reply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`msg_id`, `reply_id`, `child_msg`, `username`, `timestamp`) VALUES
(6, 11, '\' &quot; &quot; \'', 'Finn', '2017-10-31 02:54:32'),
(5, 10, 'hi', 'Doc', '2017-10-31 02:52:54'),
(6, 9, 'posting ', 'Doc', '2017-10-31 02:52:45'),
(6, 8, 'posting to check', 'Doc', '2017-10-31 02:52:22');

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
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email_id`, `username`, `password`, `avatar`) VALUES
(52, 'Lightning', 'McQueen', 'kachow@rusteze.com', 'Lightning', 'Light123', '/msg-profile.png'),
(51, 'Finn', 'McMissile', 'topsecret@agent.org', 'Finn', 'Finn123', '74290.jpg'),
(50, 'Doc', 'Hudson', 'hornet@rsprings.gov', 'Doc', 'Doc123', '/msg-profile.png'),
(49, 'Sally', 'Carrera', 'porsche@rsprings.gov', 'Sally', 'Sally123', '/msg-profile.png'),
(48, 'Tow', 'Mater', 'mater@rsprings.gov', 'Tow', 'Tow123', '773207.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `voting_count`
--

DROP TABLE IF EXISTS `voting_count`;
CREATE TABLE IF NOT EXISTS `voting_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(2000) NOT NULL,
  `userresponded` varchar(50) NOT NULL,
  `vote_up` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL,
  `up_count` int(11) NOT NULL,
  `down_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voting_count`
--

INSERT INTO `voting_count` (`id`, `username`, `userresponded`, `vote_up`, `msg_id`, `up_count`, `down_count`) VALUES
(16, 'Sally', 'Sally', 2, 10, 0, 1),
(15, 'Finn', 'Finn', 1, 9, 1, 0),
(14, 'Tow', 'Doc', 1, 6, 1, 0),
(13, 'Tow', 'Doc', 1, 5, 1, 0),
(12, 'Tow', 'Tow', 2, 5, 0, 1),
(11, 'Tow', 'Tow', 1, 6, 1, 0),
(17, 'Tow', 'Sally', 1, 6, 1, 0),
(18, 'Tow', 'Sally', 2, 5, 0, 1),
(19, 'Finn', 'Sally', 2, 7, 0, 1),
(20, 'Finn', 'Sally', 1, 8, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
