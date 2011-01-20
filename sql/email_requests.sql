-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2011 at 04:31 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.10-2ubuntu6.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `colourcafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_requests`
--

CREATE TABLE IF NOT EXISTS `email_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SL_NO` varchar(20) NOT NULL,
  `SOFTWARE_ID` varchar(20) NOT NULL,
  `no_of_email_images` int(11) NOT NULL,
  `no_of_selection_of_images` int(11) NOT NULL,
  `email_send_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `email_requests`
--

INSERT INTO `email_requests` (`id`, `SL_NO`, `SOFTWARE_ID`, `no_of_email_images`, `no_of_selection_of_images`, `email_send_date`) VALUES
(1, '050', '015', 5, 8, '2011-01-17'),
(2, '025', '015', 3, 10, '2011-01-16'),
(3, '050', '123', 9, 9, '2011-01-10'),
(4, '050', '047', 6, 6, '2011-01-07'),
(5, '606', '015', 7, 7, '2010-12-30'),
(6, '632', '015', 0, 5, '2011-01-06'),
(7, '633', '043', 10, 15, '2011-01-06'),
(8, '631', '015', 4, 4, '2011-01-19'),
(9, '630', '043', 8, 7, '2011-01-19'),
(10, '629', '043', 0, 15, '0000-00-00');
