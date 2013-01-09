-- phpMyAdmin SQL Dump
-- version 3.5.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2013 at 07:26 AM
-- Server version: 5.5.28-cll
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pulsir_ldr`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblDistribution`
--

CREATE TABLE IF NOT EXISTS `tblDistribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `webpage` varchar(30) NOT NULL,
  `descripy` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tblDistribution`
--

INSERT INTO `tblDistribution` (`id`, `name`, `webpage`, `descripy`) VALUES
(1, 'openSUSE', 'www.opensuse.org', ''),
(2, 'Ubuntu', 'www.ubuntu.com', ''),
(3, 'Fedora', 'http://fedoraproject.org', 'Bleeding-edge distribucija, koristi RPM paketni sustav.'),
(5, 'Debian', 'www.debian.org', ''),
(11, 'Sabayon', 'http://www.sabayon.org/', 'Distribucija bazirana na Gentoo Linuxu.'),
(7, 'Linux Mint', 'http://linuxmint.com', ''),
(13, 'Nosonja', 'http://nosonja.org', 'NO Sonja.');

-- --------------------------------------------------------

--
-- Table structure for table `tblDistributionVersion`
--

CREATE TABLE IF NOT EXISTS `tblDistributionVersion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distributionId` int(11) NOT NULL,
  `version` varchar(20) NOT NULL,
  `releaseDate` date NOT NULL,
  `ss1` varchar(200) NOT NULL,
  `ss2` varchar(200) NOT NULL,
  `ss3` varchar(200) NOT NULL,
  `current` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tblDistributionVersion`
--

INSERT INTO `tblDistributionVersion` (`id`, `distributionId`, `version`, `releaseDate`, `ss1`, `ss2`, `ss3`, `current`) VALUES
(13, 1, '12.1', '2011-11-16', '', '', '', 0),
(12, 1, '12.2', '2012-09-20', 'http://placehold.it/350x150', 'http://placehold.it/350x150', 'http://placehold.it/350x150', 0),
(11, 2, '12.04', '2012-04-26', '', '', '', 0),
(14, 1, '11.4', '2011-03-10', '', '', '', 0),
(15, 3, '17', '2012-05-29', '', '', '', 0),
(18, 5, 'Testing (Wheezy)', '0000-00-00', '', '', '', 0),
(19, 5, 'Squeeze', '2011-02-06', '', '', '', 0),
(20, 7, '13 - Maya', '0000-00-00', '', '', '', 0),
(21, 11, '10', '2012-09-13', '', '', '', 0),
(23, 13, '(RR)', '0000-00-00', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblRating`
--

CREATE TABLE IF NOT EXISTS `tblRating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `versionId` int(11) NOT NULL,
  `rating1` int(100) NOT NULL,
  `rating2` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tblRating`
--

INSERT INTO `tblRating` (`id`, `userId`, `versionId`, `rating1`, `rating2`) VALUES
(6, 1, 12, 0, 0),
(7, 1, 14, 8, 7),
(8, 3, 19, 0, 0),
(9, 3, 18, 5, 5),
(10, 5, 18, 10, 9),
(11, 5, 12, 8, 10),
(12, 5, 20, 9, 8),
(13, 5, 15, 9, 3),
(14, 5, 19, 0, 0),
(15, 5, 14, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblUser`
--

CREATE TABLE IF NOT EXISTS `tblUser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `hashPassword` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tblUser`
--

INSERT INTO `tblUser` (`id`, `username`, `hashPassword`, `email`) VALUES
(5, 'root', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
