-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2016 at 07:31 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bloggedin`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `aid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(30) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`aid`, `name`, `location`) VALUES
(1, 'Sk Jhohev', 'Kolkata');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`pid` int(11) NOT NULL,
  `title` text,
  `body` text,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`pid`, `title`, `body`, `date_created`) VALUES
(1, 'Blog Post #1', '<p>This is the <em>first</em> Post</p><span color=''crimson''>hehehe</span>', '2016-04-29 00:00:00'),
(2, 'Blog Post #2', '<p>This is the <em>second</em> Post</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.                         Suspendisse aliquam, augue vitae pulvinar feugiat, magna ipsum varius tellus, quis lobortis est nulla nec ligula.                         Aenean cursus enim sit amet tortor rutrum lobortis.                         Vestibulum mattis mauris fringilla mauris volutpat, in euismod arcu ultricies.                         Nunc eget hendrerit lectus. Proin rutrum elit ut orci fringilla, sit amet ornare turpis molestie.                         Proin nec neque eget nulla scelerisque rhoncus sit amet vitae augue.                         Vivamus ipsum eros, sodales sed enim ac, malesuada iaculis mi.                         Morbi ut orci sit amet tellus posuere convallis.                         Cras rhoncus tincidunt ultrices.</p><span color=''crimson''>huhahua</span>', '2016-04-29 05:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `posts_ref`
--

CREATE TABLE IF NOT EXISTS `posts_ref` (
`prid` int(11) NOT NULL,
  `aid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts_ref`
--

INSERT INTO `posts_ref` (`prid`, `aid`, `pid`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`uid` int(11) NOT NULL,
  `uname` varchar(30) DEFAULT NULL,
  `pass` varchar(128) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uname`, `pass`) VALUES
(1, 'johev09', '5f4dcc3b5aa765d61d8327deb882cf99'),
(4, 'shristi', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
 ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `posts_ref`
--
ALTER TABLE `posts_ref`
 ADD PRIMARY KEY (`prid`), ADD KEY `aid` (`aid`), ADD KEY `pid` (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `posts_ref`
--
ALTER TABLE `posts_ref`
MODIFY `prid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `authors`
--
ALTER TABLE `authors`
ADD CONSTRAINT `authors_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `posts_ref`
--
ALTER TABLE `posts_ref`
ADD CONSTRAINT `posts_ref_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `authors` (`aid`),
ADD CONSTRAINT `posts_ref_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `posts` (`pid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
