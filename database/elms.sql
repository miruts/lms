-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 12, 2019 at 10:06 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `courseId` int(11) NOT NULL AUTO_INCREMENT,
  `courseName` varchar(50) NOT NULL,
  `offDept` int(11) NOT NULL,
  `offYear` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `chour` int(11) NOT NULL,
  `ects` int(11) NOT NULL,
  PRIMARY KEY (`courseId`),
  UNIQUE KEY `course_courseId_uindex` (`courseId`),
  KEY `offDept` (`offDept`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseId`, `courseName`, `offDept`, `offYear`, `semester`, `chour`, `ects`) VALUES
(1, 'Computer Networking', 1, 2, 2, 3, 6),
(2, 'Computer Programming', 1, 2, 2, 3, 7),
(3, 'Software Engineering', 1, 2, 2, 3, 7),
(4, 'Web Developmenet', 1, 2, 2, 3, 7),
(5, 'Computer Graphics', 1, 2, 2, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `deptId` int(11) NOT NULL AUTO_INCREMENT,
  `deptName` varchar(50) NOT NULL,
  PRIMARY KEY (`deptId`),
  UNIQUE KEY `department_deptId_uindex` (`deptId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptId`, `deptName`) VALUES
(1, 'ITSC'),
(2, 'Mechnical'),
(3, 'SECE');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `gradeId` int(11) NOT NULL AUTO_INCREMENT,
  `insId` int(11) NOT NULL,
  `studId` int(11) NOT NULL,
  `test` int(11) DEFAULT '0',
  `mid` int(11) DEFAULT '0',
  `final` int(11) DEFAULT '0',
  `assignment` int(11) DEFAULT '0',
  `project` int(11) DEFAULT '0',
  `courseId` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`gradeId`),
  KEY `insId` (`insId`),
  KEY `studId` (`studId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`gradeId`, `insId`, `studId`, `test`, `mid`, `final`, `assignment`, `project`, `courseId`) VALUES
(1, 1, 1, 10, 20, 40, 10, 20, 1),
(2, 1, 2, 10, 16, 40, 10, 20, 1),
(3, 1, 3, 10, 20, 40, 10, 20, 1),
(4, 1, 4, 10, 20, 40, 10, 20, 1),
(5, 1, 6, 6, 0, 0, 0, 0, 1),
(6, 1, 7, 10, 17, 12, 6, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

DROP TABLE IF EXISTS `instructor`;
CREATE TABLE IF NOT EXISTS `instructor` (
  `insId` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(30) NOT NULL,
  `lName` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `deptId` int(11) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`insId`),
  KEY `deptId` (`deptId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`insId`, `fName`, `lName`, `username`, `deptId`, `title`, `password`) VALUES
(1, 'abebe', 'kebede', 'abebe', 1, 'Doctor', 'abebe'),
(2, 'tesfaye', 'eshetu', 'tesfaye', 2, 'Doctor', 'tesfaye');

-- --------------------------------------------------------

--
-- Table structure for table `instructorcourse`
--

DROP TABLE IF EXISTS `instructorcourse`;
CREATE TABLE IF NOT EXISTS `instructorcourse` (
  `insId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  PRIMARY KEY (`insId`,`courseId`),
  KEY `courseId` (`courseId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructorcourse`
--

INSERT INTO `instructorcourse` (`insId`, `courseId`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `instructorsection`
--

DROP TABLE IF EXISTS `instructorsection`;
CREATE TABLE IF NOT EXISTS `instructorsection` (
  `insId` int(11) NOT NULL,
  `secNum` int(11) NOT NULL,
  PRIMARY KEY (`insId`,`secNum`),
  KEY `secNum` (`secNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructorsection`
--

INSERT INTO `instructorsection` (`insId`, `secNum`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 4),
(3, 1),
(3, 2),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `notId` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(300) NOT NULL,
  `targetSec` int(11) NOT NULL,
  `instructor` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  PRIMARY KEY (`notId`),
  UNIQUE KEY `notification_notId_uindex` (`notId`),
  KEY `instructor` (`instructor`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notId`, `data`, `targetSec`, `instructor`, `courseId`) VALUES
(1, 'This is some notifications', 1, 1, 1),
(2, 'This is some notifications(another)', 2, 2, 2),
(3, 'This is some notifications(another)', 3, 2, 2),
(4, 'This is some another goes here notifications(another)', 3, 2, 2),
(6, 'Some test notifications is here again', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

DROP TABLE IF EXISTS `resource`;
CREATE TABLE IF NOT EXISTS `resource` (
  `resId` int(11) NOT NULL AUTO_INCREMENT,
  `data` blob,
  `description` varchar(200) DEFAULT NULL,
  `courseId` int(11) NOT NULL,
  PRIMARY KEY (`resId`),
  KEY `courseId` (`courseId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `scheduleId` int(11) NOT NULL AUTO_INCREMENT,
  `section` int(11) NOT NULL,
  `day` varchar(15) NOT NULL,
  `time` time NOT NULL,
  `courseId` int(11) NOT NULL,
  PRIMARY KEY (`scheduleId`),
  UNIQUE KEY `schedule_scheduleId_uindex` (`scheduleId`),
  KEY `section` (`section`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleId`, `section`, `day`, `time`, `courseId`) VALUES
(1, 1, 'monday', '11:00:48', 1),
(2, 2, 'monday', '11:21:12', 2),
(3, 1, 'tuesday', '11:51:40', 2);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `secNum` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `maxsize` int(11) NOT NULL,
  PRIMARY KEY (`secNum`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`secNum`, `year`, `semester`, `maxsize`) VALUES
(1, 2, 2, 50),
(2, 2, 2, 50),
(3, 2, 2, 50),
(4, 2, 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `studId` int(11) NOT NULL AUTO_INCREMENT,
  `fName` varchar(30) NOT NULL,
  `lName` varchar(30) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `deptId` int(11) NOT NULL,
  `section` int(11) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  PRIMARY KEY (`studId`),
  UNIQUE KEY `student_studId_uindex` (`studId`),
  KEY `deptId` (`deptId`),
  KEY `section` (`section`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studId`, `fName`, `lName`, `password`, `year`, `semester`, `deptId`, `section`, `username`) VALUES
(1, 'miruts', 'hadush', 'parrot', 2, 2, 1, 1, 'miruts'),
(2, 'tsedeke', 'nigusu', 'tse', 2, 2, 1, 1, 'tsedeke'),
(6, 'user', 'name', 'user', 2, 2, 1, 1, 'user'),
(7, 'user1', 'name1', 'user1', 2, 2, 1, 1, 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `studentenroll`
--

DROP TABLE IF EXISTS `studentenroll`;
CREATE TABLE IF NOT EXISTS `studentenroll` (
  `studId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  PRIMARY KEY (`studId`,`courseId`),
  KEY `courseId` (`courseId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentenroll`
--

INSERT INTO `studentenroll` (`studId`, `courseId`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(8, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
