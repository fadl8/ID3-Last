-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 07:35 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id3`
--

-- --------------------------------------------------------

--
-- Table structure for table `electronic`
--

DROP TABLE IF EXISTS `electronic`;
CREATE TABLE IF NOT EXISTS `electronic` (
  `RID` int(11) NOT NULL AUTO_INCREMENT,
  `age` varchar(20) NOT NULL,
  `income` varchar(20) NOT NULL,
  `student` varchar(20) NOT NULL,
  `credit` varchar(20) NOT NULL,
  `buy` varchar(20) NOT NULL,
  PRIMARY KEY (`RID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `electronic`
--

INSERT INTO `electronic` (`RID`, `age`, `income`, `student`, `credit`, `buy`) VALUES
(2, 'youth', 'high', 'no', 'fair', 'no'),
(3, 'youth', 'high', 'no', 'excellent', 'no'),
(4, 'middle', 'high', 'no', 'fair', 'yes'),
(5, 'senior', 'medium', 'no', 'fair', 'yes'),
(6, 'senior', 'low', 'yes', 'fair', 'yes'),
(7, 'senior', 'low', 'yes', 'excellent', 'no'),
(8, 'middle', 'low', 'yes', 'excellent', 'yes'),
(9, 'youth', 'medium', 'no', 'fair', 'no'),
(10, 'youth', 'low', 'yes', 'fair', 'yes'),
(11, 'senior', 'medium', 'yes', 'fair', 'yes'),
(12, 'youth', 'medium', 'yes', 'excellent', 'yes'),
(13, 'middle', 'medium', 'no', 'excellent', 'yes'),
(14, 'middle', 'high', 'yes', 'fair', 'yes'),
(15, 'senior', 'medium', 'no', 'excellent', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `weathers`
--

DROP TABLE IF EXISTS `weathers`;
CREATE TABLE IF NOT EXISTS `weathers` (
  `Day` varchar(4) NOT NULL,
  `Outlook` varchar(10) NOT NULL,
  `Temperature` varchar(10) NOT NULL,
  `Humidity` varchar(10) NOT NULL,
  `Wind` varchar(10) NOT NULL,
  `Play` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weathers`
--

INSERT INTO `weathers` (`Day`, `Outlook`, `Temperature`, `Humidity`, `Wind`, `Play`) VALUES
('D1', 'sunny', 'hot', 'high', 'weak', 'no'),
('D2', 'sunny', 'hot', 'high', 'strong', 'no'),
('D3', 'overcast', 'hot', 'high', 'weak', 'yes'),
('D4', 'rain', 'mild', 'high', 'weak', 'yes'),
('D5', 'rain', 'cool', 'normal', 'weak', 'yes'),
('D6', 'rain', 'cool', 'normal', 'strong', 'no'),
('D7', 'overcast', 'cool', 'normal', 'strong', 'yes'),
('D8', 'sunny', 'mild', 'high', 'weak', 'no'),
('D9', 'sunny', 'cool', 'normal', 'weak', 'yes'),
('D10', 'rain', 'mild', 'normal', 'weak', 'yes'),
('D11', 'sunny', 'mild', 'normal', 'strong', 'yes'),
('D12', 'overcast', 'mild', 'high', 'strong', 'yes'),
('D13', 'overcast', 'hot', 'normal', 'weak', 'yes'),
('D14', 'rain', 'mild', 'high', 'strong', 'no');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
