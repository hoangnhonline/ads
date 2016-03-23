-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2016 at 07:06 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `net`
--
CREATE DATABASE IF NOT EXISTS `net` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `net`;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `date_taken` date NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `display_order` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `name`, `category_id`, `date_taken`, `image_url`, `display_order`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Portrait Vol 01', 1, '2015-11-18', 'upload/2015/11/15/portrait_04_1447591249.jpg', 1, 1447564130, 1447591256, 1),
(2, 'Out-Door', 4, '2015-11-15', 'upload/2015/11/15/landscape_03_1447591269.jpg', 1, 1447582473, 1447592334, 1),
(3, 'Landscape Vol01', 5, '2015-11-15', 'upload/2015/11/15/landscape_04_1447591287.jpg', 1, 1447582598, 1447591291, 1),
(4, 'Landscape Vol 02', 4, '2015-11-15', 'upload/2015/11/15/portrait_11_1447591309.jpg', 1, 1447588576, 1447591315, 1),
(7, 'test2', 2, '2015-11-09', 'upload/2015/11/20/bad-business-nomaden_1448030132.jpg', 1, 1448030159, 1448030159, 1),
(9, 'test4', 5, '2015-11-20', 'upload/2015/11/20/hc001_350a_1448030803.jpg', 1, 1448030988, 1448031018, 1),
(10, 'Clock', 1, '2015-11-24', 'upload/2015/11/24/wallcoocom_it06-27_350_1448353929.JPG', 1, 1448353958, 1448354014, 1);

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `file_url` varchar(500) DEFAULT NULL,
  `file_type` varchar(3) DEFAULT NULL,
  `website_url` varchar(500) NOT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `file_url`, `file_type`, `website_url`, `width`, `height`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Chien dich 1', 'upload/2016/03/23/output_for_flash_1458748674.swf', 'swf', 'https://www.google.com', 300, 250, 1, 1458747330, 1458748812),
(2, 'Chien dich 2', 'upload/2016/03/23/rec728_1458748880.jpg', 'jpg', 'https://www.youtube.com', 728, 90, 1, 1458748884, 1458748884);

-- --------------------------------------------------------

--
-- Table structure for table `uid`
--

CREATE TABLE IF NOT EXISTS `uid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `campaign_id` varchar(255) NOT NULL,
  `website_id` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY `campaign_id` (`campaign_id`,`website_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `uid`
--

INSERT INTO `uid` (`id`, `code`, `campaign_id`, `website_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '1458751282', '2,1', '2,1', 1, 1458751282, 1458751407),
(2, '1458751423', '2', '2,1', 1, 1458751423, 1458751423),
(13, '1458754865', '2,1', '2', 1, 1458754865, 1458755029);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `yahoo` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `level`, `name`, `phone`, `image_url`, `address`, `skype`, `yahoo`, `created_at`, `updated_at`, `status`) VALUES
(10, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 'admin', '', 'upload/images/2015/12/01/koala-6.jpg', '', '', '', 0, 1448987548, 1);

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE IF NOT EXISTS `website` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `website_url` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `display_order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id`, `name`, `website_url`, `status`, `created_at`, `updated_at`, `display_order`) VALUES
(1, 'Diễn đàn điện thoại', 'http://diendandienthoai.net', 1, 1458749775, 1458749775, 1),
(2, 'Người tây ninh', 'http://nguoitayninh.com/', 1, 1458749823, 1458749823, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
