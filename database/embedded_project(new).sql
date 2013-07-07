-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 07, 2013 at 07:36 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `embedded_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'sagar');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `routine_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `assignment_detail` varchar(5000) NOT NULL,
  `assignment_deadline` timestamp NOT NULL DEFAULT '2013-06-18 21:29:07',
  `assignment_no` int(11) NOT NULL,
  `is_of_lab` int(1) NOT NULL DEFAULT '0',
  KEY `routine_id` (`routine_id`),
  KEY `course_code` (`course_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`routine_id`, `course_code`, `assignment_detail`, `assignment_deadline`, `assignment_no`, `is_of_lab`) VALUES
(1, 'COMP314', 'Page 43 Question Number 7 and 8', '2013-06-18 21:29:07', 2, 0),
(1, 'COMP309', 'Define Google', '2013-06-18 21:29:07', 3, 0),
(1, 'COMP304', 'Page 243 All Question, defend your answers with suitable reasoning', '2013-06-18 21:29:07', 3, 0),
(1, 'COMP341', 'LAB SHEET ON ETHNOGRAPHY', '2013-06-18 21:29:07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_code` varchar(100) NOT NULL,
  `course_name` varchar(200) DEFAULT NULL,
  `course_credits` int(1) DEFAULT NULL,
  `course_provider_department` int(2) DEFAULT NULL,
  PRIMARY KEY (`course_code`),
  KEY `course_provider_department` (`course_provider_department`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `course_code` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `course_title` varchar(500) NOT NULL,
  `course_credit` int(11) NOT NULL,
  `lab` int(11) NOT NULL,
  `course_password` varchar(100) NOT NULL,
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `department_id`, `semester`, `course_title`, `course_credit`, `lab`, `course_password`) VALUES
('COMP 304', 22, 6, 'Operational Research', 3, 0, 'comp304or'),
('COMP 305', 22, 6, 'Database Design and DBMS', 3, 1, 'comp305dbms'),
('COMP 306', 22, 6, 'Embedded System', 3, 0, 'comp306es'),
('COMP 309', 22, 6, 'Advanced Programming', 3, 1, 'comp309ap'),
('COMP 341', 22, 6, 'Human Computer Interaction', 3, 0, 'comp341hci'),
('COMP 314', 22, 6, 'Algorithm and Complexity', 3, 1, 'comp314ac'),
('COMP 308', 22, 6, 'Combined Engineering Project', 3, 0, 'comp308'),
('COMP 202', 22, 1, 'WHAT IS THE PROBLEM OF COMPUTER?', 3, 0, 'PASSWORD'),
('com1', 22, 2, 'sdfasdf', 2, 1, 'ads'),
('com2', 22, 2, 'adfasdf', 2, 0, 'ads');

-- --------------------------------------------------------

--
-- Table structure for table `courses_taught_in_department`
--

CREATE TABLE IF NOT EXISTS `courses_taught_in_department` (
  `course_code` varchar(10) NOT NULL,
  `department_id` int(10) NOT NULL,
  `course_year` varchar(10) DEFAULT NULL,
  KEY `course_id` (`course_code`,`department_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(10) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `department_desc` varchar(1000) NOT NULL,
  `branch` varchar(100) NOT NULL,
  PRIMARY KEY (`department_id`),
  UNIQUE KEY `department_name` (`department_name`),
  KEY `branch` (`branch`),
  KEY `branch_2` (`branch`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `department_desc`, `branch`) VALUES
(22, 'Computer Engineering', 'Computer engineering department', 'Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `routine`
--

CREATE TABLE IF NOT EXISTS `routine` (
  `course_code` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `group` varchar(100) NOT NULL,
  `day` varchar(100) NOT NULL,
  `from_and_to` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routine`
--

INSERT INTO `routine` (`course_code`, `department_id`, `semester`, `group`, `day`, `from_and_to`) VALUES
('COMP 304', 22, 6, '', 'Sunday', '1-2'),
('COMP 305', 22, 6, '', 'Sunday', '2-3'),
('COMP 306', 22, 6, '', 'Sunday', '3:00-4:00'),
('COMP 304', 22, 6, '', 'Monday', ''),
('COMP 305', 22, 6, '', 'Monday', ''),
('COMP 304', 22, 6, '', 'Monday', ''),
('COMP 305', 22, 6, '', 'Monday', ''),
('COMP 309', 22, 6, '', 'Sunday', ''),
('COMP 308', 22, 6, '', 'Sunday', ''),
('COMP 309', 22, 6, '', 'Wednesday', ''),
('COMP 341', 22, 6, '', 'Thursday', ''),
('COMP 305', 22, 6, '', 'Monday', ''),
('COMP 341', 22, 6, '', 'Sunday', '');

-- --------------------------------------------------------

--
-- Table structure for table `routine_unique_block`
--

CREATE TABLE IF NOT EXISTS `routine_unique_block` (
  `routine_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `routine_block_day` varchar(10) NOT NULL,
  `routine_block_start_time` varchar(10) NOT NULL DEFAULT '',
  `routine_block_end_time` varchar(10) DEFAULT NULL,
  `hours` int(2) DEFAULT NULL,
  `room` varchar(10) DEFAULT NULL,
  `is_lab` int(1) DEFAULT '0',
  PRIMARY KEY (`routine_id`,`course_code`,`routine_block_day`,`routine_block_start_time`),
  KEY `routine_id` (`routine_id`),
  KEY `course_code` (`course_code`),
  KEY `routine_block_day` (`routine_block_day`),
  KEY `routine_block_start_time` (`routine_block_start_time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `routine_unique_block`
--

INSERT INTO `routine_unique_block` (`routine_id`, `course_code`, `routine_block_day`, `routine_block_start_time`, `routine_block_end_time`, `hours`, `room`, `is_lab`) VALUES
(1, 'COMP304', 'TUESDAY', '9 AM', '11 AM', 2, 'ROOM 3', 0),
(1, 'COMP304', 'WEDNESDAY', '9 AM', '11 AM', 2, 'ROOM 2', 0),
(1, 'COMP306', 'MONDAY', '10 AM', '12 PM', 2, 'ROOM 2', 0),
(1, 'COMP309', 'TUESDAY', '11 AM', '12 PM', 1, 'ROOM 3', 0),
(1, 'COMP314', 'SUNDAY', '9 AM', '10 AM', 1, 'ROOM 2', 0),
(1, 'COMP341', 'MONDAY', '9 AM', '10 AM', 1, 'LAB 1', 1),
(1, 'COMP341', 'SUNDAY', '10 AM', '11 AM', 1, 'ROOM 2', 0),
(1, 'COMP341', 'SUNDAY', '11 AM', '12 PM', 1, 'LAB 1', 1),
(1, 'LUNCH', 'WEDNESDAY', '11 AM', '12 PM', 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(10) NOT NULL AUTO_INCREMENT,
  `teacher_full_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `teacher_password` varchar(100) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `teacher_department` int(2) DEFAULT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_teaches_courses`
--

CREATE TABLE IF NOT EXISTS `teacher_teaches_courses` (
  `teacher_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `syllabus` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`teacher_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`routine_id`) REFERENCES `routine_unique_block` (`routine_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`course_code`) REFERENCES `routine_unique_block` (`course_code`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`course_provider_department`) REFERENCES `department` (`department_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses_taught_in_department`
--
ALTER TABLE `courses_taught_in_department`
  ADD CONSTRAINT `courses_taught_in_department_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_taught_in_department_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
