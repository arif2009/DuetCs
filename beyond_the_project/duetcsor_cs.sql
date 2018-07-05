-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2013 at 09:11 AM
-- Server version: 5.5.32-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `duetcsor_cs`
--

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2013 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(1995, 1378200414, '188.143.232.31', 'SOmvB4nY'),
(1996, 1378200415, '188.143.232.31', 'LzjvfWSL'),
(1997, 1378200416, '188.143.232.31', 'rDJHisa9'),
(1998, 1378200417, '188.143.232.31', 'xU90C19n'),
(1999, 1378200418, '188.143.232.31', '8BmG8vTG'),
(2000, 1378200419, '188.143.232.31', 'qBRhOhQv'),
(2001, 1378200420, '188.143.232.31', '4CNmX4Zr'),
(2002, 1378200422, '188.143.232.31', 'wiTWWr1n'),
(2003, 1378200423, '188.143.232.31', 'd0iYFxpZ'),
(2004, 1378200425, '188.143.232.31', 'uUhmvAH3'),
(2005, 1378200426, '188.143.232.31', 'LqRUBNE8'),
(2006, 1378217398, '58.97.185.22', 'fY0X9JTE'),
(2007, 1378310781, '69.58.178.59', 'v7hg1y4D'),
(2008, 1378606743, '157.56.92.151', 'BwWLZ1A2'),
(2009, 1378846626, '66.249.73.24', '5Ct2ocH9'),
(2010, 1379010948, '58.97.171.185', 'b3h5L95k'),
(2011, 1379035382, '220.181.108.170', 'HdzZ8vPd'),
(2012, 1379097887, '37.57.133.179', 'lRFh1v2x');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `entry_id` bigint(20) NOT NULL,
  `comment_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_id` varchar(8) CHARACTER SET latin1 NOT NULL,
  `comment_body` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `CommentEntryFK` (`entry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `DepartmentId` varchar(3) NOT NULL,
  `DepartmentName` varchar(35) NOT NULL,
  `FacultyId` varchar(3) NOT NULL,
  `DegreeAward` varchar(3) NOT NULL,
  `NickName` varchar(5) NOT NULL,
  PRIMARY KEY (`DepartmentId`),
  KEY `DeptFacultyFK` (`FacultyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentId`, `DepartmentName`, `FacultyId`, `DegreeAward`, `NickName`) VALUES
('D01', 'Biomedical Department', 'F03', 'yes', 'BD'),
('D02', 'Textile Engineering', 'F03', 'yes', 'TE'),
('D03', 'Civil Engineering', 'F01', 'yes', 'CE'),
('D04', 'Chemistry', 'F01', 'no', 'Ch'),
('D05', 'Computer Science & Engineering', 'F02', 'yes', 'CSE'),
('D06', 'Electrical & Electronic Engineering', 'F02', 'yes', 'EEE'),
('D07', 'Humanities', 'F03', 'no', 'Hum'),
('D08', 'Mathematics', 'F01', 'no', 'Math'),
('D09', 'Mechanical Engineering', 'F03', 'yes', 'ME'),
('D10', 'Physics', 'F01', 'no', 'Ph');

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE IF NOT EXISTS `entry` (
  `entry_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `entry_name` varchar(255) NOT NULL,
  `entry_body` text NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `entry_year` int(11) NOT NULL,
  `entry_month` varchar(20) CHARACTER SET latin1 NOT NULL,
  `entry_author_name` varchar(20) CHARACTER SET latin1 NOT NULL,
  `user_id` varchar(8) NOT NULL,
  PRIMARY KEY (`entry_id`),
  UNIQUE KEY `entry_name` (`entry_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Table structure for table `executive_body`
--

CREATE TABLE IF NOT EXISTS `executive_body` (
  `StudentId` varchar(8) NOT NULL,
  `GroupId` varchar(3) DEFAULT NULL,
  `Responsibility` varchar(250) NOT NULL,
  KEY `MemExeFK` (`StudentId`),
  KEY `MemGroupFK` (`GroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `executive_body`
--

INSERT INTO `executive_body` (`StudentId`, `GroupId`, `Responsibility`) VALUES
('084002', NULL, 'President');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `FacultyId` varchar(3) NOT NULL,
  `FacultyName` varchar(4) NOT NULL,
  `Location` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`FacultyId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`FacultyId`, `FacultyName`, `Location`) VALUES
('F01', 'CE', 'Gazipur'),
('F02', 'EEE', 'Gazipur'),
('F03', 'ME', 'Gazipur');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `GroupId` varchar(3) NOT NULL,
  `GroupName` varchar(200) NOT NULL,
  `Description` text,
  PRIMARY KEY (`GroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`GroupId`, `GroupName`, `Description`) VALUES
('G01', 'Programming & Algorithms', NULL),
('G02', 'Application & Project Development', NULL),
('G03', 'Network & Communication', NULL),
('G04', 'Multimedia & Gaming', NULL),
('G05', 'Co-Curricular activities', NULL),
('G06', 'Li-aison & Publications', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `Name` varchar(100) NOT NULL,
  `FacultyId` varchar(3) NOT NULL,
  `DepartmentId` varchar(3) NOT NULL,
  `Year` varchar(6) NOT NULL,
  `Semister` varchar(6) NOT NULL,
  `StudentId` varchar(8) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Sex` varchar(6) NOT NULL,
  `Address` text,
  `ReasonOfInterest` text NOT NULL,
  `Email` varchar(150) NOT NULL,
  `ContractNo` varchar(20) NOT NULL,
  `Password` text NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT '0',
  `Admin` varchar(3) NOT NULL DEFAULT 'no',
  `Batch` varchar(5) NOT NULL,
  `YearOfResponsibly` varchar(10) NOT NULL,
  `Responsibly` varchar(150) NOT NULL,
  PRIMARY KEY (`StudentId`),
  UNIQUE KEY `Email` (`Email`),
  KEY `MembersFacultyFK` (`FacultyId`),
  KEY `MemberDeptFK` (`DepartmentId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Name`, `FacultyId`, `DepartmentId`, `Year`, `Semister`, `StudentId`, `DateOfBirth`, `Sex`, `Address`, `ReasonOfInterest`, `Email`, `ContractNo`, `Password`, `user_level`, `Admin`, `Batch`, `YearOfResponsibly`, `Responsibly`) VALUES
('Md. Mahbub Alam', 'F02', 'D05', 'no', 'no', '044045', '2013-01-10', 'Mail', 'Dept. of CSE, DUET, Gazipur', '', 'emahbub.cse@gmail.com', '01818727574', '8i8kpxfcSsv31eL94h80X9vZ+wcfouEU7Pf9FYcgtH9BGPaIaXC7CJQb8YUY5xgjfFn9aGxhdz42LM6MUUIh7Q==', 1, 'yes', '6th', '', ''),
('Arifur Rahman', 'F02', 'D05', 'no', 'no', '074051', '1988-11-01', 'Mail', 'Hall Name:Shahid Muktijodda Hall, Room No:307', 'Arifur Rahman', 'arif.rahman2009@gmail.com', '01721654450', 'G8ADNyLZEXIDovfErbhEmcOp5X+Q+FVckiAotvXaWRiQLrFjehHQJgW622u6Je9wlZN9Z7FI/civ88JVJGctuA==', 1, 'no', '9th', '', ''),
('Ashis Barai', 'F02', 'D05', '3rd', '2nd', '084002', '1988-03-05', 'Mail', 'Hall Name:Kazi Nazrul Islam Hall, Room No:4011', 'My favorite task is programming. I like it very much.', 'ashis084002@gmail.com', '01932910711', 'iM3NZmyzd8YTXrC7523wdA/vPGBnW0C/AmmGislTu1ft8Rk5ExomxB9iwuV3NnAuBiUwvTZB8gkezfNVOME2hw==', 1, 'yes', '10th', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `member_group`
--

CREATE TABLE IF NOT EXISTS `member_group` (
  `StudentId` varchar(8) NOT NULL,
  `GroupId` varchar(3) NOT NULL,
  PRIMARY KEY (`StudentId`,`GroupId`),
  KEY `Mem_grpGrpFK` (`GroupId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_group`
--

INSERT INTO `member_group` (`StudentId`, `GroupId`) VALUES
('084002', 'G01'),
('074051', 'G02');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;


--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `ProjectId` bigint(20) NOT NULL AUTO_INCREMENT,
  `ProjectName` varchar(255) NOT NULL,
  `UploadDate` date NOT NULL,
  `ProjectDocumentation` varchar(255) NOT NULL,
  `ProjectCode` varchar(255) NOT NULL,
  `StudentId` varchar(8) NOT NULL,
  PRIMARY KEY (`ProjectId`),
  KEY `ProjectMembersFK` (`StudentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ProjectId`, `ProjectName`, `UploadDate`, `ProjectDocumentation`, `ProjectCode`, `StudentId`) VALUES
(1, 'Test', '2012-12-23', 'project/074051/test.pdf', 'project/074051/New_folder.zip', '074051');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `CommentEntryFK` FOREIGN KEY (`entry_id`) REFERENCES `entry` (`entry_id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `DeptFacultyFK` FOREIGN KEY (`FacultyId`) REFERENCES `faculty` (`FacultyId`);

--
-- Constraints for table `executive_body`
--
ALTER TABLE `executive_body`
  ADD CONSTRAINT `MemExeFK` FOREIGN KEY (`StudentId`) REFERENCES `members` (`StudentId`),
  ADD CONSTRAINT `MemGroupFK` FOREIGN KEY (`GroupId`) REFERENCES `groups` (`GroupId`);

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `MemberDeptFK` FOREIGN KEY (`DepartmentId`) REFERENCES `department` (`DepartmentId`),
  ADD CONSTRAINT `MembersFacultyFK` FOREIGN KEY (`FacultyId`) REFERENCES `faculty` (`FacultyId`);

--
-- Constraints for table `member_group`
--
ALTER TABLE `member_group`
  ADD CONSTRAINT `Mem_grpGrpFK` FOREIGN KEY (`GroupId`) REFERENCES `groups` (`GroupId`),
  ADD CONSTRAINT `Mem_grpMemFK` FOREIGN KEY (`StudentId`) REFERENCES `members` (`StudentId`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `ProjectMembersFK` FOREIGN KEY (`StudentId`) REFERENCES `members` (`StudentId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
