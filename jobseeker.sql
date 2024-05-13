-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: May 13, 2024 at 02:13 AM
-- Server version: 10.11.6-MariaDB
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobseeker`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_application`
--

CREATE TABLE `t_application` (
  `application_id` int(11) NOT NULL,
  `candidate_id` int(11) DEFAULT NULL,
  `vacancy_id` int(11) DEFAULT NULL,
  `application_date` datetime DEFAULT NULL,
  `application_status` varchar(1) NOT NULL CHECK (`application_status` in ('0','1','2')),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_candidate`
--

CREATE TABLE `t_candidate` (
  `candidate_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `pob` varchar(255) DEFAULT NULL,
  `gender` varchar(1) NOT NULL CHECK (`gender` in ('F','M')),
  `year_exp` int(11) NOT NULL,
  `last_salary` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_candidate`
--

INSERT INTO `t_candidate` (`candidate_id`, `email`, `phone_number`, `full_name`, `dob`, `pob`, `gender`, `year_exp`, `last_salary`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'candidate@mail.com', '08123456789', 'Test Candidate', '1990-01-01', 'Jakarta', 'M', 5, '10000000', '2024-05-13 02:11:01', '2024-05-13 02:11:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL CHECK (`status` in ('0','1')),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`user_id`, `email`, `password`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test@mail.com', '$2a$12$SuEZs7fdMRLQiRX796K6neRAKyxHQ11A.HA5ofJgwpX1Fh4ZG1Mbq', '1', '2024-05-13 02:10:35', '2024-05-13 02:10:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_vacancy`
--

CREATE TABLE `t_vacancy` (
  `vacancy_id` int(11) NOT NULL,
  `vacancy_name` varchar(255) NOT NULL,
  `minimum_exp` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `flag_status` varchar(1) NOT NULL CHECK (`flag_status` in ('0','1')),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_vacancy`
--

INSERT INTO `t_vacancy` (`vacancy_id`, `vacancy_name`, `minimum_exp`, `created_date`, `expired_date`, `flag_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Software Engineer', 3, '2021-01-01 00:00:00', '2021-04-01 00:00:00', '1', '2024-05-13 02:12:04', '2024-05-13 02:12:04', NULL);

--
-- Triggers `t_vacancy`
--
DELIMITER $$
CREATE TRIGGER `set_expired_date` BEFORE INSERT ON `t_vacancy` FOR EACH ROW BEGIN
    SET NEW.expired_date = NEW.created_date + INTERVAL 3 MONTH;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_application`
--
ALTER TABLE `t_application`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `candidate_id` (`candidate_id`),
  ADD KEY `vacancy_id` (`vacancy_id`);

--
-- Indexes for table `t_candidate`
--
ALTER TABLE `t_candidate`
  ADD PRIMARY KEY (`candidate_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `t_vacancy`
--
ALTER TABLE `t_vacancy`
  ADD PRIMARY KEY (`vacancy_id`),
  ADD KEY `idx_created_date` (`created_date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_application`
--
ALTER TABLE `t_application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_candidate`
--
ALTER TABLE `t_candidate`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_vacancy`
--
ALTER TABLE `t_vacancy`
  MODIFY `vacancy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_application`
--
ALTER TABLE `t_application`
  ADD CONSTRAINT `t_application_ibfk_1` FOREIGN KEY (`candidate_id`) REFERENCES `t_candidate` (`candidate_id`),
  ADD CONSTRAINT `t_application_ibfk_2` FOREIGN KEY (`vacancy_id`) REFERENCES `t_vacancy` (`vacancy_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
