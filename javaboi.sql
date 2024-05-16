-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2023 at 10:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `javaboi`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `achievement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `competency_level` varchar(50) NOT NULL,
  `level_round` int(11) NOT NULL,
  `points_scored` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `java_compiler_works`
--

CREATE TABLE `java_compiler_works` (
  `code_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `submission_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `code` text NOT NULL,
  `compilation_status` enum('Pending','Successful','Failed') DEFAULT 'Pending',
  `error_message` text DEFAULT NULL,
  `output` text DEFAULT NULL,
  `points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `question_id`, `option_text`) VALUES
(1, 1, 'Compile Error'),
(2, 1, 'Throws Exception'),
(3, 1, 'I'),
(4, 1, '24 I'),
(5, 2, 'char[] ch = new char(5)'),
(6, 2, 'char[] ch = new char[5]'),
(7, 2, 'char[] ch = new char()'),
(8, 2, 'char[] ch = new char[]'),
(9, 3, 'the reference of the array'),
(10, 3, 'a copy of the array'),
(11, 3, 'length of an array'),
(12, 3, 'copy of the first elements');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `question_type` enum('multiple_choice','true_false','open_ended') NOT NULL,
  `correct_option` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`question_id`, `quiz_id`, `question_text`, `question_type`, `correct_option`) VALUES
(1, 1, 'What will be the output of the following code?\n   int Integer = 24; char String  = ‘I’;  \n   System.out.print(Integer);  \n   System.out.print(String);\n      ', 'multiple_choice', 4),
(2, 2, 'Select the Valid Statement', 'multiple_choice', 6),
(3, 3, 'when an array is passed to a method, what does the method receive?', 'multiple_choice', 9),
(4, 4, 'question 4', 'multiple_choice', NULL),
(5, 5, 'question 5', 'multiple_choice', NULL),
(6, 6, 'question 6', 'multiple_choice', NULL),
(7, 7, 'q7', 'multiple_choice', NULL),
(8, 8, 'q8', 'multiple_choice', NULL),
(9, 9, 'q9', 'multiple_choice', NULL),
(10, 10, 'q10', 'multiple_choice', NULL),
(11, 11, 'q11', 'multiple_choice', NULL),
(12, 12, 'q12', 'multiple_choice', NULL),
(13, 13, 'q13', 'multiple_choice', NULL),
(14, 14, 'q14', 'multiple_choice', NULL),
(15, 15, 'q15', 'multiple_choice', NULL),
(16, 16, 'q16', 'multiple_choice', NULL),
(17, 17, 'q17', 'multiple_choice', NULL),
(18, 18, 'q18', 'multiple_choice', NULL),
(19, 19, 'q19', 'multiple_choice', NULL),
(20, 20, 'q20', 'multiple_choice', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `points` int(11) NOT NULL,
  `otp` int(11) NOT NULL,
  `quiz_score` int(11) NOT NULL DEFAULT 0,
  `level3` int(255) NOT NULL,
  `level4` int(245) NOT NULL,
  `allpoints` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `username`, `email`, `password`, `points`, `otp`, `quiz_score`, `level3`, `level4`, `allpoints`) VALUES
(1, 'karan', 'karan123@gmail.com', '$2y$10$5.BPuTTROQFiTmtud7Eisu6PAGL8J786UdNA/jzjG..2F6gtvIhsS', 5, 0, 4, 3, 0, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`achievement_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `java_compiler_works`
--
ALTER TABLE `java_compiler_works`
  ADD PRIMARY KEY (`code_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `achievement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `java_compiler_works`
--
ALTER TABLE `java_compiler_works`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievements`
--
ALTER TABLE `achievements`
  ADD CONSTRAINT `achievements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `achievements_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user_info` (`username`);

--
-- Constraints for table `java_compiler_works`
--
ALTER TABLE `java_compiler_works`
  ADD CONSTRAINT `java_compiler_works_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`),
  ADD CONSTRAINT `java_compiler_works_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `quizzes` (`question_id`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `quizzes` (`question_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
