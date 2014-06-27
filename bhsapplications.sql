-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2014 at 05:36 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bhsapplications`
--

-- --------------------------------------------------------

--
-- Table structure for table `citationstable`
--

CREATE TABLE IF NOT EXISTS `citationsTable` (
  `citId` int(10) NOT NULL AUTO_INCREMENT,
  `rptId` int(10) NOT NULL,
  `citNumber` varchar(100) DEFAULT NULL,
  `citType` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`citId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `officerdetailstable`
--

CREATE TABLE IF NOT EXISTS `officerDetailsTable` (
  `offDtlId` int(10) NOT NULL AUTO_INCREMENT,
  `rptId` int(10) NOT NULL,
  `officerName` varchar(100) NOT NULL,
  `officerHours` varchar(100) NOT NULL,
  PRIMARY KEY (`offDtlId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reporttable`
--

CREATE TABLE IF NOT EXISTS `reportTable` (
  `rptId` int(10) NOT NULL AUTO_INCREMENT,
  `userId` int(10) DEFAULT NULL,
  `detailDate` date DEFAULT NULL,
  `dateSubmit` date DEFAULT NULL,
  `dateApproved` date DEFAULT NULL,
  `approvalStatus` enum('approved','unapproved','','') DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `weather` varchar(250) DEFAULT NULL,
  `county` varchar(100) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  `route` varchar(100) DEFAULT NULL,
  `ouiLiquorCitSum` int(10) DEFAULT NULL,
  `ouiLiquorCitWarn` int(10) DEFAULT NULL,
  `ouiLiquorComments` varchar(500) DEFAULT NULL,
  `ouiMinorCitSum` int(10) DEFAULT NULL,
  `ouiMinorCitWarn` int(10) DEFAULT NULL,
  `ouiMinorComments` varchar(500) DEFAULT NULL,
  `ouicdl04CitSum` int(10) DEFAULT NULL,
  `ouicdl04CitWarn` int(10) DEFAULT NULL,
  `ouicdl04Comments` varchar(500) DEFAULT NULL,
  `ouiDrugsCitSum` int(10) DEFAULT NULL,
  `ouiDrugsCitWarn` int(10) DEFAULT NULL,
  `ouiDrugsComments` varchar(500) DEFAULT NULL,
  `speedInfractionCitSum` int(10) DEFAULT NULL,
  `speedInfractionCitWarn` int(10) DEFAULT NULL,
  `speedInfractionComments` varchar(500) DEFAULT NULL,
  `speedCriminalCitSum` int(10) DEFAULT NULL,
  `speedCriminalCitWarn` int(10) DEFAULT NULL,
  `speedCriminalComments` varchar(500) DEFAULT NULL,
  `speedConstZoneCitSum` int(10) DEFAULT NULL,
  `speedConstZoneCitWarn` int(10) DEFAULT NULL,
  `speedConstZoneComments` varchar(500) DEFAULT NULL,
  `speedConstZoneDblFneCitSum` int(10) DEFAULT NULL,
  `speedConstZoneDblFneCitWarn` int(10) DEFAULT NULL,
  `speedConstZoneDblFneComments` varchar(500) DEFAULT NULL,
  `speedTollArea10ZoneCitSum` int(10) DEFAULT NULL,
  `speedTollArea10ZoneCitWarn` int(10) DEFAULT NULL,
  `speedTollArea10ZoneComments` varchar(500) DEFAULT NULL,
  `speedTollArea35ZoneCitSum` int(10) DEFAULT NULL,
  `speedTollArea35ZoneCitWarn` int(10) DEFAULT NULL,
  `speedTollArea35ZoneComments` varchar(500) DEFAULT NULL,
  `dftEquipmentCitSum` int(10) DEFAULT NULL,
  `dftEquipmentCitWarn` int(10) DEFAULT NULL,
  `dftEquipmentComments` varchar(500) DEFAULT NULL,
  `drgViolationCivilCitSum` int(10) DEFAULT NULL,
  `drgViolationCivilCitWarn` int(10) DEFAULT NULL,
  `drgViolationCivilComments` varchar(500) DEFAULT NULL,
  `drgViolationCriminalCitSum` int(10) DEFAULT NULL,
  `drgViolationCriminalCitWarn` int(10) DEFAULT NULL,
  `drgViolationCriminalComments` varchar(500) DEFAULT NULL,
  `warrantCitSum` int(10) DEFAULT NULL,
  `warrantCitWarn` int(10) DEFAULT NULL,
  `warrantComments` varchar(500) DEFAULT NULL,
  `stBltViolationCitSum` int(10) DEFAULT NULL,
  `stBltViolationCitWarn` int(10) DEFAULT NULL,
  `stBltViolationComments` varchar(100) DEFAULT NULL,
  `chldRestraintCitSum` int(10) DEFAULT NULL,
  `chldRestraintCitWarn` int(10) DEFAULT NULL,
  `chldRestraintComments` varchar(500) DEFAULT NULL,
  `oasHabitualOffenderCitSum` int(10) DEFAULT NULL,
  `oasHabitualOffenderCitWarn` int(10) DEFAULT NULL,
  `oasHabitualOffenderComments` varchar(500) DEFAULT NULL,
  `commVehicleOffenderCitSum` int(10) DEFAULT NULL,
  `commVehicleOffenderCitWarn` int(10) DEFAULT NULL,
  `commVehicleOffenderComments` varchar(500) DEFAULT NULL,
  `uninsuredMotoristCitSum` int(10) DEFAULT NULL,
  `uninsuredMotoristCitWarn` int(10) DEFAULT NULL,
  `uninsuredMotoristComments` varchar(500) DEFAULT NULL,
  `otherMovingViolationsCitSum` int(10) DEFAULT NULL,
  `otherMovingViolationsCitWarn` int(10) DEFAULT NULL,
  `otherMovingViolationsComments` varchar(500) DEFAULT NULL,
  `otherNonMovingViolationsCitSum` int(10) DEFAULT NULL,
  `otherNonMovingViolationsCitWarn` int(10) DEFAULT NULL,
  `otherNonMovingViolationsComments` varchar(500) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `rmsCadNumber` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rptId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `supervisorbridgetable`
--

CREATE TABLE IF NOT EXISTS `supervisorBridgeTable` (
  `sId` int(10) NOT NULL AUTO_INCREMENT,
  `superviseeId` int(10) NOT NULL,
  `supervisorId` int(10) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE IF NOT EXISTS `userTable` (
  `userId` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `isAdmin` enum('y','n') NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
