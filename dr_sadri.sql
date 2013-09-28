-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 28, 2013 at 05:27 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dr_sadri`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secid` int(11) NOT NULL,
  `catname` varchar(25) NOT NULL,
  `latinname` varchar(25) NOT NULL,
  `describe` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `secid`, `catname`, `latinname`, `describe`) VALUES
(1, 1, 'اتاق عمل', 'Operating room', ''),
(2, 1, 'درمانگاه', 'Clinic', '');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(60) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `body` varchar(250) NOT NULL,
  `latin-subject` varchar(50) NOT NULL,
  `latin-body` varchar(250) NOT NULL,
  `catid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `subject`, `body`, `latin-subject`, `latin-body`, `catid`) VALUES
(1, '../gallerypics/image_1.jpg', 'اتاق عمل اول', 'توضیحات در مورد اتاق عمل اول....', 'Operation room 1', 'detail of Operation room one', 1),
(2, '../gallerypics/image_2.jpg', 'درمانگاه 1', 'توضیحات در مورد درمانگاه یک...', 'Clinic 1', 'detail of Clinic one...', 2),
(3, '../gallerypics/image_3.jpg', 'اتاق عمل 2', 'توضیحات در مورد اتاق عمل دوم', 'Operation room 2', 'detail of Operation room two', 1),
(4, '../gallerypics/image_4.jpg', 'درمانگاه 2', 'توضیحات در مورد درمانگاه دو...', 'Clinic 2', 'detail of Clinic two...', 2);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `latin-subject` varchar(50) NOT NULL,
  `latin-body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `subject`, `body`, `latin-subject`, `latin-body`) VALUES
(1, 'خدمت اول', ' توضیحات خدمت اول... توضیحات خدمت اول... توضیحات خدمت اول... توضیحات خدمت اول... توضیحات خدمت اول...  توضیحات خدمت اول... توضیحات خدمت اول... توضیحات خدمت اول... توضیحات خدمت اول... توضیحات خدمت اول...  توضیحات خدمت اول... توضیحات خدمت اول... توضیحات خدمت اول... توضیحات خدمت اول... توضیحات خدمت اول... ', 'service one', '  detail of service one... detail of service one... detail of service one... '),
(3, 'خدمت دوم', ' توضیح در مورد خدمت دوم...  توضیح در مورد خدمت دوم...  توضیح در مورد خدمت دوم...  توضیح در مورد خدمت دوم... ', 'service two', ' detail of service two...  detail of service two...  detail of service two...  detail of service two... '),
(4, 'خدمت سوم', ' توضیحات در مورد خدمت سوم....  توضیحات در مورد خدمت سوم....  توضیحات در مورد خدمت سوم....  توضیحات در مورد خدمت سوم....  توضیحات در مورد خدمت سوم.... ', 'service three', 'Detail of service three... Detail of service three...Detail of service three...Detail of service three...Detail of service three...Detail of service three...Detail of service three...Detail of service three...'),
(5, 'خدمت چهارم', ' توضیحات در مورد خدمت چهارم...  توضیحات در مورد خدمت چهارم...  توضیحات در مورد خدمت چهارم...  توضیحات در مورد خدمت چهارم...  توضیحات در مورد خدمت چهارم...  توضیحات در مورد خدمت چهارم... ', 'service four', 'detail of service four...  detail of service four...  detail of service four...  detail of service four...  detail of service four...  detail of service four...  detail of service four...  '),
(6, 'خدمت پنجم', 'توضیحات در مورد خدمت پنجم...  توضیحات در مورد خدمت پنجم...  توضیحات در مورد خدمت پنجم...  توضیحات در مورد خدمت پنجم...  توضیحات در مورد خدمت پنجم...  توضیحات در مورد خدمت پنجم...  توضیحات در مورد خدمت پنجم...  ', 'service five', 'detail of service five...  detail of service five... detail of service five... detail of service five... detail of service five... detail of service five... detail of service five... '),
(7, 'خدمت ششم', 'توضیحات در مورد خدمت ششم...  توضیحات در مورد خدمت ششم... توضیحات در مورد خدمت ششم... توضیحات در مورد خدمت ششم... توضیحات در مورد خدمت ششم... توضیحات در مورد خدمت ششم... ', 'service six', 'detail of service six...  detail of service six... detail of service six... detail of service six... detail of service six... detail of service six... detail of service six... '),
(8, 'خدمت هفتم', 'توضیحات در مورد خدمت هفتم...  توضیحات در مورد خدمت هفتم... توضیحات در مورد خدمت هفتم... توضیحات در مورد خدمت هفتم... توضیحات در مورد خدمت هفتم... توضیحات در مورد خدمت هفتم... ', 'service seven', 'detail of  service seven... detail of  service seven... detail of  service seven... detail of  service seven... detail of  service seven... detail of  service seven... '),
(9, 'خدمت هشتم', ' توضیحات در مورد خدمت هشتم...  توضیحات در مورد خدمت هشتم...  توضیحات در مورد خدمت هشتم...  توضیحات در مورد خدمت هشتم...  توضیحات در مورد خدمت هشتم...  توضیحات در مورد خدمت هشتم... ', 'service eight', ' detail of service eight...  detail of service eight...  detail of service eight...  detail of service eight...  detail of service eight...  detail of service eight... '),
(10, 'خدمت نهم', 'توضیحات در مورد خدمت نهم...  توضیحات در مورد خدمت نهم... توضیحات در مورد خدمت نهم... توضیحات در مورد خدمت نهم... توضیحات در مورد خدمت نهم... توضیحات در مورد خدمت نهم... توضیحات در مورد خدمت نهم... ', 'service nine', 'detail of service nine...  detail of service nine... detail of service nine... detail of service nine... detail of service nine... detail of service nine... detail of service nine... ');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `secname` varchar(50) NOT NULL,
  `latinname` varchar(50) NOT NULL,
  `describe` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `secname`, `latinname`, `describe`) VALUES
(1, 'بیمارستان', 'Hospital', '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'Site_Title', 'دکتر اقبال صدری'),
(2, 'Site_KeyWords', 'جراحی,ارتوپدی,صدری'),
(3, 'Site_Describtion', 'دکتر اقبال صدری جراح و متخصص ارتوپد'),
(4, 'Dr_Name', 'دکتر اقبال صدری'),
(5, 'Dr_Specialty', 'متخصص ارتوپد'),
(6, 'About_System', 'درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. درباره دکتر.. '),
(7, 'Dr_Name_Latin', 'Dr Eghbal Sadri'),
(8, 'About_System_Latin', 'detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... detail... '),
(9, 'Dr_Specialty_Latin', 'Orthopedics'),
(10, 'Contact_Email', 'info@sadri.com'),
(11, 'FaceBook_Add', '#'),
(12, 'Twitter_Add', '#'),
(13, 'Rss_Add', '#'),
(14, 'Tell_Number', '+98(511) 841 2211'),
(15, 'Fax_Number', '+98(511) 841 2211'),
(16, 'Address', 'خیابان احمد آباد...'),
(17, 'Gplus_Add', '#'),
(18, 'Dr_Pic', '../userspics/amjadi.jpg'),
(19, 'Latin_Site_Title', 'Dr Eghbal Sadri'),
(20, 'Latin_Site_KeyWords', 'surgery,orthopedics,sadri'),
(21, 'Latin_Site_Describtion', 'Dr Eghbal Sadri an orthopedic surgeon'),
(22, 'Latin_Tell_Number', '+1(511) 841 2211'),
(23, 'Latin_Fax_Number', '+1(511) 841 2211'),
(24, 'Latin_Address', 'Canada...');

-- --------------------------------------------------------

--
-- Table structure for table `uploadcenter`
--

CREATE TABLE IF NOT EXISTS `uploadcenter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(60) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `body` varchar(250) NOT NULL,
  `address` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `uploadcenter`
--

INSERT INTO `uploadcenter` (`id`, `image`, `subject`, `body`, `address`) VALUES
(1, 'amjadi.jpg', '', '', '00100'),
(2, 'amjadi.jpg', '', '', '00100'),
(3, 'image_1.jpg', '', '', '01'),
(4, 'image_2.jpg', '', '', '01'),
(5, 'image_3.jpg', '', '', '01'),
(6, 'image_4.jpg', '', '', '01'),
(7, 'image_5.jpg', '', '', '01'),
(8, 'image_6.jpg', '', '', '01'),
(9, 'image_7.jpg', '', '', '01'),
(10, 'image_8.jpg', '', '', '01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `family` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `image`, `email`, `username`, `password`, `type`) VALUES
(3, 'Mojtaba', 'Amjadi', '../userspics/amjadi.jpg', 'amjadi.mojtaba@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70', 0);

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE IF NOT EXISTS `works` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `latin-subject` varchar(50) NOT NULL,
  `latin-body` text NOT NULL,
  `date` date NOT NULL,
  `group` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`id`, `subject`, `body`, `latin-subject`, `latin-body`, `date`, `group`) VALUES
(1, 'مقاله یک', 'توضیحات مقاله اول... توضیحات مقاله اول... توضیحات مقاله اول... توضیحات مقاله اول... توضیحات مقاله اول... توضیحات مقاله اول... توضیحات مقاله اول... توضیحات مقاله اول... توضیحات مقاله اول... ', 'article one', 'detail of article one... detail of article one... detail of article one... detail of article one... detail of article one... detail of article one... detail of article one... ', '2013-09-25', 1),
(2, 'سمینار اول', 'توضیحات در مورد سمینار اول.. توضیحات در مورد سمینار اول.. توضیحات در مورد سمینار اول.. توضیحات در مورد سمینار اول.. توضیحات در مورد سمینار اول.. توضیحات در مورد سمینار اول.. توضیحات در مورد سمینار اول.. توضیحات در مورد سمینار اول.. ', 'seminar one', 'detail seminar one... detail seminar one... detail seminar one... detail seminar one... detail seminar one... detail seminar one... detail seminar one... detail seminar one... ', '2013-09-24', 2),
(3, 'عنوان اول', 'توضیحات در مورد عنوان اول... توضیحات در مورد عنوان اول... توضیحات در مورد عنوان اول... توضیحات در مورد عنوان اول... توضیحات در مورد عنوان اول... توضیحات در مورد عنوان اول... ', 'title one', 'detail of title one.. detail of title one.. detail of title one.. detail of title one.. detail of title one.. detail of title one.. detail of title one.. detail of title one.. ', '2013-09-23', 3),
(4, 'مقاله دوم', 'توضیحات مقاله دوم... توضیحات مقاله دوم... توضیحات مقاله دوم... توضیحات مقاله دوم... توضیحات مقاله دوم... توضیحات مقاله دوم... توضیحات مقاله دوم... توضیحات مقاله دوم... توضیحات مقاله دوم... ', 'article two', 'detail pf article two... detail pf article two... detail pf article two... detail pf article two... detail pf article two... detail pf article two... detail pf article two... ', '2013-09-26', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
