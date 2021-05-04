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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
-- Table structure for table `exam-details`
--

DROP TABLE IF EXISTS `exam-details`;
CREATE TABLE IF NOT EXISTS `exam-details` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_name` text NOT NULL,
  `exam_sem` text NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam-details`
--

INSERT INTO `exam-details` (`_id`, `exam_name`, `exam_sem`) VALUES
(1, 'sample', 'First Semester'),
(2, 'Sample Exam ', 'Fifth Semester');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`_id`, `title`, `link`) VALUES
(3, 'Site Ready', './');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `examId` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text NOT NULL,
  `option4` text NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`_id`, `examId`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, 1, 'Question 3 ', 'asud', 'jksd', 'bhja', 'h', 'bhja'),
(2, 2, 'Q1', 'o1', 'o2', 'o3', 'o4', 'o1'),
(3, 2, 'Q2', 'o21', 'o22', 'o23', 'o24', 'o21');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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
  `verified` varchar(10) NOT NULL DEFAULT 'true',
  `permitted` varchar(10) NOT NULL DEFAULT 'false',
  `profile` text NOT NULL,
  PRIMARY KEY (`_id`),
  UNIQUE KEY `enrollment_number` (`enrollment_number`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
  `course` text NOT NULL,
  `subjects` text NOT NULL,
  `subject_code` text NOT NULL,
  `maxmarks` int(11) NOT NULL,
  `minmarks` int(11) NOT NULL,
  `credits` int(11) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`_id`, `semester`, `course`, `subjects`, `subject_code`, `maxmarks`, `minmarks`, `credits`) VALUES
(1, 'Fifth Semester', 'Computer Engineering', 'Operating System', 'OS', 150, 60, 7),
(2, 'Fifth Semester', 'Computer Engineering', 'Advance Java Programing\r\n', 'AJP', 200, 80, 9),
(3, 'Fifth Semester', 'Computer Engineering', 'Client Side Scripting', 'CSS', 100, 40, 6),
(4, 'First Semester', 'Computer Engineering', 'Basic Mathematics', 'BMS', 150, 60, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_exam_attempted`
--

DROP TABLE IF EXISTS `user_exam_attempted`;
CREATE TABLE IF NOT EXISTS `user_exam_attempted` (
  `_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `score` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  PRIMARY KEY (`_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_exam_attempted`
--

INSERT INTO `user_exam_attempted` (`_id`, `user_id`, `exam_id`, `score`, `total`) VALUES
(5, '1800180102', 2, '2', '2');

