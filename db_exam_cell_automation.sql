-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 13, 2020 at 11:23 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_exam_cell_automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminuser`
--

DROP TABLE IF EXISTS `adminuser`;
CREATE TABLE IF NOT EXISTS `adminuser` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `uid` varchar(30) NOT NULL,
  `pass` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `designation` text NOT NULL,
  `phone_no` bigint(20) NOT NULL,
  `profileimage` text NOT NULL,
  PRIMARY KEY (`_id`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `email` (`email`)
)  ;

--
-- Dumping data for table `adminuser`
--

INSERT INTO `adminuser` (`_id`, `name`, `uid`, `pass`, `email`, `designation`, `phone_no`, `profileimage`) VALUES
(1, 'Aditya Bodhankar', 'aditya_ab', '1234', 'adityaabodhankar@gmail.com', 'admin', 9325880972, '../images/profile/profile(aditya_ab).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch` varchar(100) NOT NULL,
  `branchcode` varchar(10) NOT NULL,
  PRIMARY KEY (`_id`)
)  ;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`_id`, `branch`, `branchcode`) VALUES
(1, 'Computer Engineering', 'CO'),
(2, 'Information Technology', 'IF');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

DROP TABLE IF EXISTS `carousel`;
CREATE TABLE IF NOT EXISTS `carousel` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `path` text NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`_id`)
)  ;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`_id`, `path`, `title`, `description`) VALUES
(1, 'images/c1.jpg', 'Cover Image 1', 'Cover Image 1'),
(2, 'images/c2.jpg', 'Cover Image 2', 'Cover Image 2'),
(3, 'images/c3.jpg', 'Cover Image 3', 'Cover Image 3'),
(6, './images/50', 'as', 'ash\r\n\r\n                    ');

-- --------------------------------------------------------

--
-- Table structure for table `exam_form`
--

DROP TABLE IF EXISTS `exam_form`;
CREATE TABLE IF NOT EXISTS `exam_form` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `enrollment_no` bigint(20) NOT NULL,
  `semester` text NOT NULL,
  `branch` text NOT NULL,
  `exam_name` text NOT NULL,
  `seatno` varchar(50) NOT NULL,
  PRIMARY KEY (`_id`)
)  ;

--
-- Dumping data for table `exam_form`
--

INSERT INTO `exam_form` (`_id`, `enrollment_no`, `semester`, `branch`, `exam_name`, `seatno`) VALUES
(1, 1234, 'First Semester', 'Computer Engineering', 'Sessional 1', 'CO001'),
(2, 54654, 'Fifth Semester', 'Information Technology', 'Sessional 1', 'IF001'),
(3, 1800180102, 'Fifth Semester', 'Computer Engineering', 'Sessional 1', 'CO002'),
(8, 1800180100, 'Fifth Semester', 'Computer Engineering', 'Exam 1', 'CO001'),
(9, 1800180100, 'Fifth Semester', 'Computer Engineering', 'Exam 2', 'CO001'),
(10, 1800180100, 'Fifth Semester', 'Computer Engineering', 'Exam 3', 'CO001');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

DROP TABLE IF EXISTS `marks`;
CREATE TABLE IF NOT EXISTS `marks` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `enrollment_no` text NOT NULL,
  `seatno` varchar(50) NOT NULL,
  `semester` text NOT NULL,
  `subject_code` text NOT NULL,
  `total_marks` varchar(11) NOT NULL,
  `min_marks` varchar(11) NOT NULL,
  `obtained_marks` varchar(11) NOT NULL,
  `credits` varchar(11) NOT NULL,
  `exam_name` varchar(50) NOT NULL,
  PRIMARY KEY (`_id`)
)  ;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`_id`, `enrollment_no`, `seatno`, `semester`, `subject_code`, `total_marks`, `min_marks`, `obtained_marks`, `credits`, `exam_name`) VALUES
(40, '1800180100', 'CO001', 'Fifth Semester', 'CSS', '100', '40', '123', '6', 'Exam 3'),
(39, '1800180100', 'CO001', 'Fifth Semester', 'AJP', '200', '80', '123', '9', 'Exam 3'),
(38, '1800180100', 'CO001', 'Fifth Semester', 'OS', '150', '60', '123', '7', 'Exam 3');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
CREATE TABLE IF NOT EXISTS `notice` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`_id`)
) ;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`_id`, `title`, `link`) VALUES
(3, 'Site Ready', './');

-- --------------------------------------------------------

--
-- Table structure for table `quicklinks`
--

DROP TABLE IF EXISTS `quicklinks`;
CREATE TABLE IF NOT EXISTS `quicklinks` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `link` text NOT NULL,
  PRIMARY KEY (`_id`)
) ;

--
-- Dumping data for table `quicklinks`
--

INSERT INTO `quicklinks` (`_id`, `title`, `link`) VALUES
(3, 'Aditya Bodhankar', 'http://www.aditya.team'),
(4, 'Aditya Bodhankar', 'http://www.aditya.team'),
(5, 'Aditya Bodhankar', 'http://www.aditya.team'),
(6, 'Aditya Bodhankar', 'http://www.aditya.team');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `status` text CHARACTER  NOT NULL,
  `examname` text NOT NULL,
  `activatedate` text NOT NULL,
  PRIMARY KEY (`_id`)
);

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`_id`, `name`, `status`, `examname`, `activatedate`) VALUES
(1, 'exam form', 'false', 'Exam 3', '13/08/2020'),
(2, 'hall ticket', 'false', 'Exam 3', '13/08/2020'),
(3, 'result', 'false', 'Exam 3', '13/08/2020');

-- --------------------------------------------------------

--
-- Table structure for table `studentuser`
--

DROP TABLE IF EXISTS `studentuser`;
CREATE TABLE IF NOT EXISTS `studentuser` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `enrollment_number` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileno` bigint(20) NOT NULL,
  `semester` text NOT NULL,
  `branch` text NOT NULL,
  `uname` text NOT NULL,
  `pass` text NOT NULL,
  `verified` varchar(10) CHARACTER NOT NULL DEFAULT 'true',
  `permitted` varchar(10) NOT NULL DEFAULT 'false',
  `profile` text NOT NULL,
  PRIMARY KEY (`_id`),
  UNIQUE KEY `enrollment_number` (`enrollment_number`)
)  ;

--
-- Dumping data for table `studentuser`
--

INSERT INTO `studentuser` (`_id`, `enrollment_number`, `name`, `email`, `mobileno`, `semester`, `branch`, `uname`, `pass`, `verified`, `permitted`, `profile`) VALUES
(1, 1800180102, 'Aditya Bodhankar', 'adityaabodhankar@gmail.com', 9325880972, 'Fifth Semester', 'Computer Engineering', '1800180102', '1234', 'true', 'true', '../images/profile/profileimage(1800180102).jpg'),
(2, 54654, '46c', 'adityaabodhankar2@gmail.com', 5745642, 'Fifth Semester', 'Information Technology', 'aditya', '1234', 'true', 'true', 'images/profile/54654'),
(3, 1234, 'Aditya Bodhankar', 'adityaabodhankar1@gmail.com', 9325880972, 'First Semester', 'Computer Engineering', '1234', '12345', 'true', 'true', '../images/profile/profileimage(1234).jpg'),
(4, 1800180101, '1234', 'adityaabodhankar2@gmail.com', 123154643, 'Fifth Semester', 'Computer Engineering', '', '', 'true', 'false', 'images/profile/1800180101.jpg'),
(5, 1800180100, '123', 'adityaabodhankar2@gmail.com', 12, 'Fifth Semester', 'Computer Engineering', '1800180100', '1234', 'true', 'true', '../images/profile/1800180100.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `semester` text NOT NULL,
  `course` text CHARACTER NOT NULL,
  `subjects` text NOT NULL,
  `subject_code` text NOT NULL,
  `maxmarks` int(11) NOT NULL,
  `minmarks` int(11) NOT NULL,
  `credits` int(11) NOT NULL,
  PRIMARY KEY (`_id`)
)  ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`_id`, `semester`, `course`, `subjects`, `subject_code`, `maxmarks`, `minmarks`, `credits`) VALUES
(1, 'Fifth Semester', 'Computer Engineering', 'Operating System', 'OS', 150, 60, 7),
(2, 'Fifth Semester', 'Computer Engineering', 'Advance Java Programing\r\n', 'AJP', 200, 80, 9),
(3, 'Fifth Semester', 'Computer Engineering', 'Client Side Scripting', 'CSS', 100, 40, 6),
(4, 'First Semester', 'Computer Engineering', 'Basic Mathematics', 'BMS', 150, 60, 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
