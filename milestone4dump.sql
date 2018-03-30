-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2017 at 09:19 PM
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
-- Table structure for table `archive`
--

DROP TABLE IF EXISTS `archive`;
CREATE TABLE IF NOT EXISTS `archive` (
  `archive_id` int(20) NOT NULL AUTO_INCREMENT,
  `channel_id` int(20) NOT NULL,
  `channel_name` varchar(20) NOT NULL,
  PRIMARY KEY (`archive_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`channel_id`, `channel_name`, `channel_type`, `channel_owner`) VALUES
(15, 'snowfall', 0, 'Admin'),
(14, 'private', 1, 'Lightning'),
(13, 'Testing', 0, 'Sally'),
(1, 'General', 0, 'Admin');

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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_voting_count`
--

INSERT INTO `child_voting_count` (`id`, `username`, `userresponded`, `vote_up`, `child_msg_id`, `up_count`, `down_count`) VALUES
(30, 'Admin', 'Finn', 1, 59, 1, 0),
(29, 'Doc', 'Finn', 1, 60, 1, 0),
(28, 'Sally', 'Sally', 1, 61, 1, 0),
(27, 'Doc', 'Sally', 1, 60, 1, 0),
(26, 'Admin', 'Tow', 1, 59, 1, 0),
(25, 'Doc', 'Tow', 2, 60, 0, 1),
(24, 'Doc', 'Tow', 2, 58, 0, 1),
(23, 'Admin', 'Admin', 1, 59, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `direct_message`
--

DROP TABLE IF EXISTS `direct_message`;
CREATE TABLE IF NOT EXISTS `direct_message` (
  `dm_id` int(20) NOT NULL AUTO_INCREMENT,
  `sender` varchar(20) NOT NULL,
  `receiver` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL,
  `dm_message` longtext NOT NULL,
  UNIQUE KEY `dm_id` (`dm_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `direct_message`
--

INSERT INTO `direct_message` (`dm_id`, `sender`, `receiver`, `timestamp`, `dm_message`) VALUES
(1, 'Admin', 'Finn', '2017-12-01 21:39:26', 'Hi Finn'),
(2, 'Finn', 'Admin', '2017-12-01 22:08:21', 'Hello admin'),
(3, 'Admin', 'Finn', '2017-12-02 00:33:27', 'test'),
(4, 'Admin', 'Finn', '2017-12-02 00:46:02', 'hi'),
(5, 'Finn', 'Admin', '2017-12-02 01:03:05', 'hey'),
(6, 'Admin', 'Doc', '2017-12-08 19:15:46', ' Testing Bot direct message.'),
(7, 'Admin', 'Doc', '2017-12-08 19:18:03', ' Testing Bot direct message.'),
(8, 'Admin', 'Doc', '2017-12-08 19:19:53', ' Testing Bot direct message.'),
(9, 'Admin', 'Doc', '2017-12-08 19:23:25', ' wewrewrerdsf fdsdf dsfsdf'),
(10, 'Admin', 'Doc', '2017-12-08 19:24:46', ' checking again '),
(11, 'Admin', 'Finn', '2017-12-08 19:26:10', ' hello Finn this is direct Bot message!!!'),
(12, 'Doc', 'admin', '2017-12-08 23:52:03', ' checking bot'),
(13, 'Admin', 'Finn', '2017-12-09 00:11:53', ' hey '),
(14, 'Doc', 'Finn', '2017-12-09 00:15:29', 'hey'),
(15, 'Doc', 'Lightning', '2017-12-09 00:18:16', 'how are you'),
(16, 'Admin', 'Lightning', '2017-12-09 00:35:22', '/msg @Sally hey'),
(17, 'Admin', 'Lightning', '2017-12-09 00:41:30', 'sahdajs'),
(18, 'Doc', 'Sally', '2017-12-09 01:12:32', 'hey DM'),
(19, 'Admin', 'PrajaktaKanade', '2017-12-10 22:37:37', 'welcome prajakta'),
(20, 'PrajaktaKanade', 'Admin', '2017-12-11 19:45:12', 'hello');

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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE IF NOT EXISTS `membership` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `channel_name` varchar(20) NOT NULL,
  `channel_type` int(10) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`member_id`, `username`, `channel_name`, `channel_type`) VALUES
(42, 'Admin', 'private', 1),
(41, 'Lightning', 'private', 1),
(52, 'Doc', 'Testing', 0),
(39, 'Admin', 'Testing', 0),
(38, 'Sally', 'Testing', 0),
(47, 'Tow', 'General', 0),
(37, 'Lightning', 'General', 0),
(36, 'Finn', 'General', 0),
(46, 'Doc', 'General', 0),
(34, 'Sally', 'General', 0),
(33, 'Admin', 'General', 0),
(43, 'Sally', 'private', 1),
(45, 'Tow', 'Testing', 0),
(53, 'Admin', 'snowfall', 0),
(69, 'PrajaktaKanade', 'General', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`msg_id`, `channel_id`, `username`, `timestamp`, `message`) VALUES
(99, 1, 'Doc', '2017-11-15 17:33:56', '183434.jpg'),
(96, 14, 'Admin', '2017-11-15 20:23:37', '694337.jpg'),
(98, 13, 'Admin', '2017-11-16 08:30:20', '995214.jpg'),
(95, 13, 'Admin', '2017-11-16 13:20:10', '575193.jpg'),
(82, 1, 'Sally', '2017-11-18 20:55:39', '/code function changePagination(option) {\r\n	if(option!= &quot;&quot;) {\r\n		getresult(&quot;getresult.php&quot;);\r\n	}\r\n}'),
(109, 1, 'Admin', '2017-12-03 18:36:11', 'localhost-keysite.txt'),
(106, 1, 'Tow', '2017-11-21 21:39:35', 'hi'),
(107, 1, 'Finn', '2017-12-03 18:03:17', '535896.txt'),
(110, 1, 'Admin', '2017-12-03 18:41:05', 'addChannels.php'),
(86, 13, 'Tow', '2017-11-17 13:04:26', '[:-)]'),
(111, 1, 'Admin', '2017-12-03 18:50:03', 'bootstrap.min.js'),
(83, 13, 'Doc', '2017-11-16 20:57:51', 'welcome testing channel'),
(84, 13, 'Admin', '2017-11-18 19:58:15', 'Hi doc'),
(85, 13, 'Admin', '2017-11-18 20:58:34', 'what is the best html for bold? is it &lt;b&gt;bold&lt;/b&gt; or &lt;strong&gt;strong&lt;/strong&gt;? this is [b]very[/b] important'),
(80, 14, 'Lightning', '2017-11-18 20:53:31', 'Private channel'),
(79, 1, 'Admin', '2017-11-18 20:45:46', 'https://vignette2.wikia.nocookie.net/disney/images/1/1e/Chick_Hicks.png'),
(75, 1, 'Admin', '2017-11-20 20:41:17', 'hello testing'),
(76, 1, 'Doc', '2017-11-20 20:42:25', 'Hello General'),
(77, 1, 'Sally', '2017-11-20 20:44:03', 'http://www.cs.odu.edu/~pkanade/cs518/car.png'),
(81, 14, 'Admin', '2017-11-20 20:53:59', ' ~!@#$%^&amp;*()_+_)(*&amp;^%$#@!~}{:&quot;&gt;&lt;??:{}+}\\|}{P{}|-/*?~!@#$%^&amp;*()_+_)(*&amp;^%$#@!~}{:&quot;&gt;&lt;??:{}+}\\|}{P{}|-/*?~!@#$%^&amp;*()_+_)(*&amp;^%$#@!~}{:&quot;&gt;&lt;??:{}+}\\|}{P{}|-/*?~!@#$%^&amp;*()_+_)(*&amp;^%$#@!~}{:&quot;&gt;&lt;??:{}+}\\|}{P{}|-/*? \\n\\n &lt;!-- unless you cannot read this --&gt;'),
(100, 13, 'Doc', '2017-11-20 22:34:50', '782231.jpg'),
(112, 1, 'Admin', '2017-12-03 19:09:51', 'jquery-1.8.2.min.js'),
(102, 13, 'Doc', '2017-11-20 23:23:20', 'https://vignette2.wikia.nocookie.net/disney/images/1/1e/Chick_Hicks.png/revision/latest?cb=20151222135632'),
(103, 13, 'Doc', '2017-11-20 23:23:50', 'http://www.cs.odu.edu/~pkanade/cs518/car.png'),
(105, 14, 'Admin', '2017-11-20 23:27:55', 'https://vignette2.wikia.nocookie.net/disney/images/1/1e/Chick_Hicks.png/revision/latest?cb=20151222135632'),
(113, 1, 'Admin', '2017-12-03 19:30:53', '104991.jpg'),
(114, 1, 'Admin', '2017-12-03 19:36:46', 'hi checking text messages'),
(115, 1, 'Admin', '2017-12-03 19:38:52', '145722.jpg'),
(116, 1, 'Admin', '2017-12-03 19:40:16', 'milestone1dump.sql'),
(117, 1, 'Doc', '2017-12-04 22:34:49', 'archive.php'),
(118, 1, 'Doc', '2017-12-04 22:40:49', 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902'),
(119, 1, 'Doc', '2017-12-04 22:57:19', '535255.jpg'),
(128, 1, 'Admin', '2017-12-08 20:04:09', 'Â¯\\_(ãƒ„)_/Â¯ '),
(121, 13, 'Admin', '2017-12-08 17:38:21', 'Â¯\\_(ãƒ„)_/Â¯'),
(122, 13, 'Admin', '2017-12-08 17:44:28', '/me test'),
(123, 13, 'Admin', '2017-12-08 17:45:19', 'sadsasa'),
(124, 13, 'Admin', '2017-12-08 18:15:52', '/msg @wqewqewerewrrewtretrytr'),
(125, 13, 'Admin', '2017-12-08 18:16:53', '/msg @wqewqerwrtrtyutyiuyu'),
(126, 13, 'Admin', '2017-12-08 19:57:02', '/me Â¯\\_(ãƒ„)_/Â¯'),
(127, 13, 'Admin', '2017-12-08 20:02:48', '/shrug hello '),
(129, 1, 'Admin', '2017-12-08 20:44:48', '/who Tow, Lightning, Finn, Doc, Sally, a,  and you.'),
(130, 1, 'Doc', '2017-12-08 13:12:35', '/who Tow, Lightning'),
(131, 1, 'Doc', '2017-12-08 23:50:56', '/me sadsa'),
(132, 1, 'Doc', '2017-12-08 23:51:33', '/shrug hey how are you??'),
(133, 1, 'Doc', '2017-12-08 23:52:50', '/who Tow, Lightning, Finn, Sally, Admin, a,  and you.'),
(134, 1, 'Admin', '2017-12-09 00:27:34', '/archive '),
(135, 15, 'Admin', '2017-12-09 18:27:17', 'hi'),
(136, 15, 'Admin', '2017-12-09 18:27:23', 'testing'),
(138, 1, 'PrajaktaKanade', '2017-12-10 22:36:17', 'hi'),
(139, 1, 'PrajaktaKanade', '2017-12-10 22:36:38', 'testing git login'),
(140, 1, 'PrajaktaKanade', '2017-12-11 20:01:48', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `no_page` int(11) NOT NULL,
  `first_result` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`no_page`, `first_result`) VALUES
(1, 0),
(1, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`msg_id`, `reply_id`, `child_msg`, `username`, `timestamp`) VALUES
(134, 78, 'testing git', 'PrajaktaKanade', '2017-12-11 19:26:18'),
(99, 77, '/shrug rttryyt', 'Admin', '2017-12-09 00:01:43'),
(133, 74, '/me testing again', 'Doc', '2017-12-08 23:56:19'),
(132, 75, '/shrug again', 'Doc', '2017-12-09 00:00:20'),
(99, 76, '/me fhgh', 'Admin', '2017-12-09 00:01:06'),
(79, 69, '621503.png', 'Admin', '2017-12-03 19:47:33'),
(109, 70, 'add-channels.css', 'Admin', '2017-12-03 19:53:44'),
(110, 71, 'hi', 'Admin', '2017-12-03 19:55:34'),
(76, 72, 'chatPageold.php', 'Doc', '2017-12-04 22:39:46'),
(100, 66, 'https://vignette2.wikia.nocookie.net/disney/images/1/1e/Chick_Hicks.png/revision/latest?cb=20151222135632', 'Doc', '2017-11-17 23:21:16'),
(76, 63, '998964.jpg', 'Admin', '2017-11-16 22:56:30'),
(83, 64, '545347.jpg', 'Tow', '2017-11-18 22:58:57'),
(117, 73, 'https://vignette.wikia.nocookie.net/disney/images/c/c0/Mack.png/revision/latest?cb=20151213154902', 'Doc', '2017-12-04 22:41:15'),
(80, 62, 'hiiiii', 'Admin', '2017-11-18 21:09:35'),
(75, 58, 'Hi admin', 'Doc', '2017-11-16 20:42:01'),
(76, 59, '&lt;b&gt;DO&lt;/b&gt; Exist', 'Admin', '2017-11-20 20:52:18'),
(75, 60, '/code if($rowCount &gt; 0){ \n    while($row = mysqli_fetch_assoc($query)){ \n        $tutorial_id = $row[&quot;id&quot;]; ?&gt;\n   }\n}', 'Doc', '2017-11-20 20:57:14'),
(79, 61, 'nice', 'Sally', '2017-11-20 21:06:23');

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
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  `gravatar` varchar(100) NOT NULL,
  `profile_flag` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email_id`, `username`, `password`, `avatar`, `gravatar`, `profile_flag`) VALUES
(60, 'Lightning', 'McQueen', 'kachow@rusteze.com', 'Lightning', '5a85a089df6fe34878930f6aff2f38c7', '/msg-profile.png', 'https://www.gravatar.com/avatar/b334d464ca48cc0b45f71b105ab17810?s=50&d=404', 0),
(59, 'Finn', 'McMissile', 'topsecret@agent.org', 'Finn', 'ec92823edaf31a3995b105978a3fd94e', '231634.jpg', 'https://www.gravatar.com/avatar/e6810e5428b5ef81f2c41c5fff797db4?s=50&d=404', 0),
(58, 'Doc', 'Hudson', 'hornet@rsprings.gov', 'Doc', 'c7dcd8eba94a729b6da4a315c4fc704f', '287090.jpg', 'https://www.gravatar.com/avatar/3e12d6f80ac5c81b2631891cbe8287ac?s=50&d=404', 0),
(57, 'Sally', 'Carrera', 'porsche@rsprings.gov', 'Sally', '1ed7b65af7e3f4aaa70c01cf807b2dcc', '/msg-profile.png', 'https://www.gravatar.com/avatar/101265fcf141c6fb4a98e520735e2419?s=50&d=404', 0),
(1, 'Admin', 'Slack', 'admin@rsprings.gov', 'Admin', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', '918051.jpg', 'https://www.gravatar.com/avatar/6ea56415d68a91e43c250820608dd41c?s=50&d=404', 1),
(2, 'Tow', 'Mater', 'mater@rsprings.gov', 'Tow', 'e55c5c294f305b7e17372ec9dc81c8aa', '/msg-profile.png', 'https://www.gravatar.com/avatar/65ff88ee5edcce639c8544d824c6e544?s=50&d=404', 0),
(74, '', '', 'pkana001@odu.edu', 'PrajaktaKanade', '', 'https://avatars0.githubusercontent.com/u/31601934?v=4', 'https://www.gravatar.com/avatar/3e12d6f80ac5c81b2631891cbe8287ac?s=50&d=404', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voting_count`
--

INSERT INTO `voting_count` (`id`, `username`, `userresponded`, `vote_up`, `msg_id`, `up_count`, `down_count`) VALUES
(39, 'Doc', 'Doc', 1, 83, 1, 0),
(38, 'Admin', 'Admin', 1, 81, 1, 0),
(37, 'Lightning', 'Admin', 1, 80, 1, 0),
(36, 'Admin', 'Lightning', 2, 79, 0, 1),
(35, 'Admin', 'Lightning', 1, 75, 1, 0),
(34, 'Sally', 'Lightning', 1, 77, 1, 0),
(33, 'Doc', 'Sally', 2, 76, 0, 1),
(32, 'Admin', 'Sally', 1, 75, 1, 0),
(31, 'Sally', 'Sally', 1, 77, 1, 0),
(30, 'Admin', 'Sally', 1, 79, 1, 0),
(29, 'Admin', 'Doc', 1, 75, 1, 0),
(40, 'Doc', 'Admin', 1, 83, 1, 0),
(41, 'Admin', 'Tow', 1, 85, 1, 0),
(42, 'Tow', 'Tow', 2, 86, 0, 1),
(43, 'Admin', 'Tow', 1, 84, 1, 0),
(44, 'Doc', 'Tow', 1, 83, 1, 0),
(45, 'Sally', 'Sally', 1, 82, 1, 0),
(46, 'Admin', 'Finn', 2, 79, 0, 1),
(47, 'Sally', 'Finn', 1, 82, 1, 0),
(50, 'Admin', 'Admin', 2, 79, 0, 1),
(49, 'Admin', 'Admin', 1, 105, 1, 0),
(51, 'Sally', 'Admin', 2, 77, 0, 1),
(52, 'Sally', 'PrajaktaKanade', 1, 82, 1, 0),
(53, 'Doc', 'PrajaktaKanade', 1, 76, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
