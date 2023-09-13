-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 10, 2023 at 05:32 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uv_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `batch` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_book` varchar(255) NOT NULL,
  `project_link` varchar(255) DEFAULT NULL,
  `project_supervisor` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `batch`, `project_name`, `project_book`, `project_link`, `project_supervisor`, `added_by`, `is_approved`, `created_at`) VALUES
(1, 333, 'aaaaaaaaaaaa', 'test', 'a df fa faf ada', 'asfdaffasff', 3, 0, '2023-09-02 21:34:35'),
(2, 333, 'aaaaaaaaaaaa', 'test', 'a df fa faf ada', 'asfdaffasff', 3, 0, '2023-09-02 21:35:16'),
(3, 333, 'aaaaaaaaaaaa', 'test', 'a df fa faf ada', 'asfdaffasff', 3, 0, '2023-09-02 21:35:35'),
(4, 333, 'aaaaaaaaaaaa', 'test', 'a df fa faf ada', 'asfdaffasff', 3, 0, '2023-09-02 21:36:47'),
(5, 333, 'aaaaaaaaaaaa', 'test', 'a df fa faf ada', 'asfdaffasff', 3, 0, '2023-09-02 21:37:20'),
(6, 333, 'aaaaaaaaaaaa', 'test', 'a df fa faf ada', 'asfdaffasff', 3, 0, '2023-09-02 21:38:16'),
(7, 333, 'aaaaaaaaaaaa', 'test', 'a df fa faf ada', 'asfdaffasff', 3, 0, '2023-09-02 21:38:52'),
(8, 333, 'aaaaaaaaaaaa', 'test', 'a df fa faf ada', 'asfdaffasff', 3, 0, '2023-09-02 21:44:51'),
(9, 45334534, 'asdfasd', 'test', 'afa sfa', 'sfsaffa', 3, 0, '2023-09-02 21:50:55'),
(10, 45334534, 'asdfasd', 'test', 'afa sfa', 'sfsaffa', 3, 0, '2023-09-02 21:54:02'),
(11, 45334534, 'asdfasd', 'test', 'afa sfa', 'sfsaffa', 3, 0, '2023-09-02 22:10:02'),
(12, 45334534, 'asdfasd', 'test', 'afa sfa', 'sfsaffa', 3, 0, '2023-09-02 22:11:38'),
(13, 45334534, 'asdfasd', 'test', 'afa sfa', 'sfsaffa', 3, 0, '2023-09-02 22:12:01'),
(14, 45334534, 'asdfasd', 'test', 'afa sfa', 'sfsaffa', 3, 0, '2023-09-02 22:13:13'),
(15, 45334534, 'asdfasd', 'test', 'afa sfa', 'sfsaffa', 3, 0, '2023-09-02 22:14:37'),
(16, 45334534, 'asdfasd', 'test', 'afa sfa', 'sfsaffa', 3, 0, '2023-09-02 22:15:00'),
(17, 45334534, 'asdfasd', 'test', 'afa sfa', 'sfsaffa', 3, 0, '2023-09-02 22:24:51'),
(18, 23, 'adfsafasdf', 'test', 'sdafsdfasd', 'fsadfsadfsafsadf', 3, 0, '2023-09-02 22:25:14'),
(19, 23, 'adfsafasdf', 'test', 'sdafsdfasd', 'fsadfsadfsafsadf', 3, 0, '2023-09-02 22:27:49'),
(20, 23, 'adfsafasdf', 'test', 'sdafsdfasd', 'fsadfsadfsafsadf', 3, 0, '2023-09-02 22:31:59'),
(21, 3243, 'dddddddd', '[]', 'sadfasdfasdfasdf', 'sdfasdfasdfasd', 3, 0, '2023-09-08 15:21:32');

-- --------------------------------------------------------

--
-- Table structure for table `project_student`
--

CREATE TABLE `project_student` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `reg_no` int(9) NOT NULL,
  `roll_no` int(9) NOT NULL,
  `batch` int(4) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project_student`
--

INSERT INTO `project_student` (`id`, `project_id`, `student_name`, `reg_no`, `roll_no`, `batch`, `image`, `contact_no`, `contact_email`, `created_at`) VALUES
(11, 16, 'asfdff', 34234234, 234234234, 45334534, NULL, NULL, NULL, '2023-09-02 22:15:00'),
(12, 16, 'asfaffs', 234234234, 234234, 45334534, NULL, NULL, NULL, '2023-09-02 22:15:00'),
(13, 16, 'afafafadf', 4234234, 234324, 45334534, NULL, NULL, NULL, '2023-09-02 22:15:00'),
(14, 17, 'asfdff', 34234234, 234234234, 45334534, NULL, NULL, NULL, '2023-09-02 22:24:51'),
(15, 17, 'asfaffs', 234234234, 234234, 45334534, NULL, NULL, NULL, '2023-09-02 22:24:51'),
(16, 17, 'afafafadf', 4234234, 234324, 45334534, NULL, NULL, NULL, '2023-09-02 22:24:51'),
(17, 18, 'asfadf', 3423423, 4342424, 23, NULL, NULL, NULL, '2023-09-02 22:25:14'),
(18, 18, 'sadffad', 2342342, 234234, 23, NULL, NULL, NULL, '2023-09-02 22:25:14'),
(19, 18, 'afafadsf', 23423443, 234234, 23, NULL, NULL, NULL, '2023-09-02 22:25:14'),
(20, 19, 'asfadf', 3423423, 4342424, 23, NULL, NULL, NULL, '2023-09-02 22:27:49'),
(21, 19, 'sadffad', 2342342, 234234, 23, NULL, NULL, NULL, '2023-09-02 22:27:49'),
(22, 19, 'afafadsf', 23423443, 234234, 23, NULL, NULL, NULL, '2023-09-02 22:27:49'),
(23, 20, 'asfadf', 3423423, 4342424, 23, NULL, NULL, NULL, '2023-09-02 22:31:59'),
(24, 20, 'sadffad', 2342342, 234234, 23, NULL, NULL, NULL, '2023-09-02 22:31:59'),
(25, 20, 'afafadsf', 23423443, 234234, 23, NULL, NULL, NULL, '2023-09-02 22:31:59'),
(42, 21, 'dsfsdaf', 23424234, 32423423, 3243, NULL, NULL, NULL, '2023-09-08 16:41:15'),
(43, 21, 'sadfaf', 234234, 4234, 3243, NULL, NULL, NULL, '2023-09-08 16:41:15'),
(44, 21, 'adfadfsdf', 23423423, 234234, 3243, NULL, NULL, NULL, '2023-09-08 16:41:15');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `reg` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `image`, `is_admin`, `created_at`) VALUES
(1, 'admin', 'bijoykarmokar71@gmail.com', '3dbe00a167653a1aaee01d93e77e730e', NULL, NULL, 0, '2023-08-26 21:18:51'),
(2, 'aaaaaaaa', 'aaaaaaaa@mail.com', '3dbe00a167653a1aaee01d93e77e730e', NULL, NULL, 0, '2023-08-26 21:19:58'),
(3, 'asdfasdfa', 'test@mail.com', '098f6bcd4621d373cade4e832627b4f6', '34234242', '64fae4839505c.png', 0, '2023-09-02 18:20:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_by` (`added_by`);

--
-- Indexes for table `project_student`
--
ALTER TABLE `project_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `project_student`
--
ALTER TABLE `project_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `added_by` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_student`
--
ALTER TABLE `project_student`
  ADD CONSTRAINT `project_student_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
