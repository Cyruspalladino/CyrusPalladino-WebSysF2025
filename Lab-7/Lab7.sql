-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2025 at 09:10 PM
-- Server version: 8.0.43-0ubuntu0.24.04.2
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Lab7`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `crn` int NOT NULL,
  `prefix` varchar(4) NOT NULL,
  `number` smallint NOT NULL,
  `title` varchar(255) NOT NULL,
  `section` varchar(2) NOT NULL,
  `year` char(4) NOT NULL,
  `course_info` json DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`crn`, `prefix`, `number`, `title`, `section`, `year`, `course_info`) VALUES
(10001, 'CSCI', 1200, 'Data Structures', '2', '2025', NULL),
(10002, 'CSCI', 2200, 'Foundations of Computer Science', '5', '2025', NULL),
(10003, 'ASTR', 2120, 'Earth and Sky', '1', '2025', NULL),
(10004, 'ITWS', 2110, 'Web Systems Development', '9', '2025', NULL),
(10005, 'ITWS', 3000, 'Spooky Web Sys', '17', '2025', '{\"Websys_course\": {\"Labs\": {\"Lab 1\": {\"Title\": \"Resume\", \"Description\": \"Create a resume page for yourself.\"}, \"Lab 2\": {\"Title\": \"Constitution\", \"Description\": \"Create a web page teaching about the Constitution.\"}, \"Lab 3\": {\"Title\": \"Weather API\", \"Description\": \"Use weather API to display real-time weather data.\"}, \"Lab 4\": {\"Title\": \"Using AI\", \"Description\": \"Use AI to modify/improve Lab 3.\"}, \"Lab 5\": {\"Title\": \"Bloomberg Terminal\", \"Description\": \"Learn the basics of the Bloomberg Terminal.\"}, \"Lab 6\": {\"Title\": \"PHP Calculator\", \"Description\": \"Create a simple calculator in PHP.\"}, \"Lab 7\": {\"Title\": \"PHP and MySQL\", \"Description\": \"Use phpmyadmin and mySQL to recreate LMS.\"}}, \"Lectures\": {\"Lecture 1\": {\"Title\": \"The Basics\", \"Description\": \"Introduction to web systems and general overview.\"}, \"Lecture 2\": {\"Title\": \"CSS Part 1\", \"Description\": \"Basics of styling web pages with CSS.\"}, \"Lecture 3\": {\"Title\": \"CSS Part 2\", \"Description\": \"Advanced CSS techniques and layouts.\"}, \"Lecture 4\": {\"Title\": \"JavaScript\", \"Description\": \"Client-side scripting with JavaScript.\"}, \"Lecture 5\": {\"Title\": \"AJAX and JSON\", \"Description\": \"Asynchronous requests and working with JSON data.\"}, \"Lecture 6\": {\"Title\": \"APIs\", \"Description\": \"Using external APIs to fetch and manipulate data.\"}, \"Lecture 7\": {\"Title\": \"Front End Optimization\", \"Description\": \"Improving website performance and user experience.\"}, \"Lecture 8\": {\"Title\": \"PHP\", \"Description\": \"Server-side scripting basics with PHP.\"}, \"Lecture 9\": {\"Title\": \"MySQL\", \"Description\": \"Introduction to relational databases and MySQL.\"}, \"Lecture 10\": {\"Title\": \"More PHP\", \"Description\": \"Advanced PHP features and integration with MySQL.\"}, \"Lecture 11\": {\"Title\": \"Authorization and Authentication\", \"Description\": \"User login, sessions, and access control.\"}}}}');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int NOT NULL,
  `crn` int NOT NULL,
  `RIN` int NOT NULL,
  `grade` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `crn`, `RIN`, `grade`) VALUES
(1, 10001, 660000001, 92),
(2, 10001, 660000002, 85),
(3, 10002, 660000003, 88),
(4, 10002, 660000004, 91),
(5, 10003, 660000001, 79),
(6, 10003, 660000002, 83),
(7, 10004, 660000003, 95),
(8, 10004, 660000004, 87),
(9, 10001, 660000003, 90),
(10, 10002, 660000001, 84);

-- --------------------------------------------------------

--
-- Table structure for table `labs`
--

CREATE TABLE `labs` (
  `id` int NOT NULL,
  `crn` int NOT NULL,
  `lab_number` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `labs`
--

INSERT INTO `labs` (`id`, `crn`, `lab_number`, `title`, `description`) VALUES
(1, 10005, 'Lab 1', 'Resume', 'Create a resume page for yourself.'),
(2, 10005, 'Lab 2', 'Constitution', 'Create a web page teaching about the Constitution.'),
(3, 10005, 'Lab 3', 'Weather API', 'Use weather API to display real-time weather data.'),
(4, 10005, 'Lab 4', 'Using AI', 'Use AI to modify/improve Lab 3.'),
(5, 10005, 'Lab 5', 'Bloomberg Terminal', 'Learn the basics of the Bloomberg Terminal.'),
(6, 10005, 'Lab 6', 'PHP Calculator', 'Create a simple calculator in PHP.'),
(7, 10005, 'Lab 7', 'PHP and MySQL', 'Use phpmyadmin and mySQL to recreate LMS.'),
(8, 10005, 'Lab 1', 'Resume', 'Create a resume page for yourself.'),
(9, 10005, 'Lab 2', 'Constitution', 'Create a web page teaching about the Constitution.'),
(10, 10005, 'Lab 3', 'Weather API', 'Use weather API to display real-time weather data.'),
(11, 10005, 'Lab 4', 'Using AI', 'Use AI to modify/improve Lab 3.'),
(12, 10005, 'Lab 5', 'Bloomberg Terminal', 'Learn the basics of the Bloomberg Terminal.'),
(13, 10005, 'Lab 6', 'PHP Calculator', 'Create a simple calculator in PHP.'),
(14, 10005, 'Lab 7', 'PHP and MySQL', 'Use phpmyadmin and mySQL to recreate LMS.');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int NOT NULL,
  `crn` int NOT NULL,
  `lecture_number` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `crn`, `lecture_number`, `title`, `description`) VALUES
(1, 10005, 'Lecture 1', 'The Basics', 'Introduction to web systems and general overview.'),
(2, 10005, 'Lecture 2', 'CSS Part 1', 'Basics of styling web pages with CSS.'),
(3, 10005, 'Lecture 3', 'CSS Part 2', 'Advanced CSS techniques and layouts.'),
(4, 10005, 'Lecture 4', 'JavaScript', 'Client-side scripting with JavaScript.'),
(5, 10005, 'Lecture 5', 'AJAX and JSON', 'Asynchronous requests and working with JSON data.'),
(6, 10005, 'Lecture 6', 'APIs', 'Using external APIs to fetch and manipulate data.'),
(7, 10005, 'Lecture 7', 'Front End Optimization', 'Improving website performance and user experience.'),
(8, 10005, 'Lecture 8', 'PHP', 'Server-side scripting basics with PHP.'),
(9, 10005, 'Lecture 9', 'MySQL', 'Introduction to relational databases and MySQL.'),
(10, 10005, 'Lecture 10', 'More PHP', 'Advanced PHP features and integration with MySQL.'),
(11, 10005, 'Lecture 11', 'Authorization and Authentication', 'User login, sessions, and access control.'),
(12, 10005, 'Lecture 1', 'The Basics', 'Introduction to web systems and general overview.'),
(13, 10005, 'Lecture 2', 'CSS Part 1', 'Basics of styling web pages with CSS.'),
(14, 10005, 'Lecture 3', 'CSS Part 2', 'Advanced CSS techniques and layouts.'),
(15, 10005, 'Lecture 4', 'JavaScript', 'Client-side scripting with JavaScript.'),
(16, 10005, 'Lecture 5', 'AJAX and JSON', 'Asynchronous requests and working with JSON data.'),
(17, 10005, 'Lecture 6', 'APIs', 'Using external APIs to fetch and manipulate data.'),
(18, 10005, 'Lecture 7', 'Front End Optimization', 'Improving website performance and user experience.'),
(19, 10005, 'Lecture 8', 'PHP', 'Server-side scripting basics with PHP.'),
(20, 10005, 'Lecture 9', 'MySQL', 'Introduction to relational databases and MySQL.'),
(21, 10005, 'Lecture 10', 'More PHP', 'Advanced PHP features and integration with MySQL.'),
(22, 10005, 'Lecture 11', 'Authorization and Authentication', 'User login, sessions, and access control.');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `RIN` int NOT NULL,
  `RCSID` char(7) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `phone` bigint DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`RIN`, `RCSID`, `first_name`, `last_name`, `alias`, `phone`, `street`, `city`, `state`, `zip`) VALUES
(660000001, 'smithj', 'John', 'Smith', 'jsmith', 5185551111, '12 Oak St', 'Troy', 'NY', '12180'),
(660000002, 'doej', 'Jane', 'Doe', 'jdoe', 5185552222, '45 Pine Ave', 'Albany', 'NY', '12207'),
(660000003, 'brownm', 'Michael', 'Brown', 'mbrown', 5185553333, '78 Maple Rd', 'Schenectady', 'NY', '12305'),
(660000004, 'leew', 'Wendy', 'Lee', 'wlee', 5185554444, '90 Elm Blvd', 'Saratoga', 'NY', '12866');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`crn`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crn` (`crn`),
  ADD KEY `RIN` (`RIN`);

--
-- Indexes for table `labs`
--
ALTER TABLE `labs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`RIN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `labs`
--
ALTER TABLE `labs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`crn`) REFERENCES `courses` (`crn`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`RIN`) REFERENCES `students` (`RIN`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
