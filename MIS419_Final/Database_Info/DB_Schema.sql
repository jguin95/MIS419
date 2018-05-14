-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2018 at 08:25 AM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `MIS419DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE IF NOT EXISTS `Customer` (
  `CustID` int(11) NOT NULL AUTO_INCREMENT,
  `Corg` varchar(64) DEFAULT NULL,
  `Cfname` varchar(64) NOT NULL,
  `Clname` varchar(64) NOT NULL,
  `Caddr` varchar(64) NOT NULL,
  `Ccity` varchar(50) NOT NULL,
  `Cstate` varchar(30) NOT NULL,
  `Cphone` varchar(30) NOT NULL,
  `Cemail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CustID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=228 ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `EmpID` int(11) NOT NULL AUTO_INCREMENT,
  `EFname` varchar(20) NOT NULL,
  `ELname` varchar(20) NOT NULL,
  `EDOB` date NOT NULL,
  `EPhone` varchar(30) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `EPassword` varchar(200) NOT NULL,
  `HireDate` date NOT NULL,
  `FireDate` date DEFAULT NULL,
  `Active` tinyint(1) NOT NULL,
  `URMLevel` varchar(30) DEFAULT NULL,
  `hrlywage` decimal(10,2) NOT NULL,
  PRIMARY KEY (`EmpID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `Hours`
--

CREATE TABLE IF NOT EXISTS `Hours` (
  `EmployeeID` int(11) NOT NULL,
  `JobID` int(11) NOT NULL,
  `Weeknum` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  `Approved_hrs` decimal(10,2) DEFAULT NULL,
  `Unapproved_hrs` decimal(10,2) DEFAULT NULL,
  `Wages` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`,`JobID`,`Weeknum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Jobs`
--

CREATE TABLE IF NOT EXISTS `Jobs` (
  `JobID` int(11) NOT NULL AUTO_INCREMENT,
  `JobName` varchar(64) NOT NULL,
  `JobStartDate` date NOT NULL,
  `JobEndDate` date DEFAULT NULL,
  `Active` tinyint(1) DEFAULT NULL,
  `Custid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`JobID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `Materials`
--

CREATE TABLE IF NOT EXISTS `Materials` (
  `MatID` int(11) NOT NULL AUTO_INCREMENT,
  `MPDate` date NOT NULL,
  `MCost` decimal(10,2) NOT NULL,
  `MDesc` varchar(255) DEFAULT NULL,
  `Vendor` varchar(60) NOT NULL,
  `JobNum` int(11) NOT NULL,
  `EmpNum` int(11) NOT NULL,
  PRIMARY KEY (`MatID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
