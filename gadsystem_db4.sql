-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 06:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gadsystem_db4`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `university_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `university_email`, `password`, `created_at`) VALUES
(1, 'Ferdinand Mark Peña', 'fmbpena@usep.edu.ph', '$2y$10$Rto/zwhbz0UatW4PkGM15O0uExuPM/tYsjnlYlzj182FLTEwBF8DK', '2024-06-20 03:52:26');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `proposer_id` int(11) NOT NULL,
  `evaluator_id` int(11) NOT NULL,
  `document_file` text DEFAULT NULL,
  `resources_file` varchar(255) DEFAULT NULL,
  `date_received` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_reviewed` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `college_office` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `proposer_id`, `evaluator_id`, `document_file`, `resources_file`, `date_received`, `date_reviewed`, `status`, `remarks`, `description`, `college_office`) VALUES
(1, 1, 2, '\"[{\\\"item\\\":\\\"item2\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item3\\\",\\\"score\\\":0.5,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item4\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item6\\\",\\\"score\\\":0.5,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item7\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item8\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item9\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item11\\\",\\\"score\\\":0.33,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item12\\\",\\\"score\\\":0.67,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item13\\\",\\\"score\\\":0.33,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item14\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item15\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item17\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item18\\\",\\\"score\\\":0.5,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item20\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item21\\\",\\\"score\\\":0.33,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item22\\\",\\\"score\\\":0.67,\\\"comment\\\":\\\"\\\"}]\"', '../resources/proposal_1', '2024-06-20 03:56:00', '2024-06-20 03:56:00', 'Completed', NULL, 'This proposed Memorandum of Understanding (MoU) between Curtin University, Malaysia and University of Southeastern Philippines aims to foster internationalization and advance higher education by collaborating in academic and cultural exchanges, research, and related activities. Curtin University is the largest international campus of Curtin University, Kent Street, Bentley, Western Australia, 6102 and a leading private institution of higher learning in Malaysia. It strives to provide quality education and richly interactive and personalized learning experiences for its students, equipping them with the leadership skills for the future and valuing them as partners in education and research as well as long-term influencers of change within society. This partnership holds significant value in USeP\'s ongoing efforts toward internationalization, serving as a catalyst for achieving the strategic goals set forth by the University. By leveraging the strengths of both institutions, the MoU aims to create a dynamic environment that fosters learning, research, and professional growth, thereby nurturing a diverse community of scholars and practitioners committed to global excellence in legal education.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluators`
--

CREATE TABLE `evaluators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `evaluator_id` varchar(10) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `university_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluators`
--

INSERT INTO `evaluators` (`id`, `evaluator_id`, `full_name`, `university_email`, `password`, `created_at`) VALUES
(1, 'e-000001', 'Clifton John Rojo', 'cjrojo@usep.edu.ph', '$2y$10$WgvThp/7M55YwyAX5cEPnevW13BIGB4Z8yY49y3lof2n/8yaT8LFG', '2024-06-20 03:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `proponents`
--

CREATE TABLE `proponents` (
  `id` int(11) NOT NULL,
  `proposer_id` varchar(10) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `college_office` varchar(100) NOT NULL,
  `university_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proponents`
--

INSERT INTO `proponents` (`id`, `proposer_id`, `full_name`, `college_office`, `university_email`, `password`) VALUES
(1, 'i-000001', 'Lestat Ariola', 'CIC', 'lariola@usep.edu.ph', '$2y$10$TIX3pcWNvFeBJNNOTHlUTe7G5Di6JmPgw8PjFdc2IPAF8Oa6TRAke');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `proposer_id` int(11) NOT NULL,
  `evaluator_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `proponent_name` varchar(255) NOT NULL,
  `office` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `college_office` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `proposer_id`, `evaluator_id`, `title`, `proponent_name`, `office`, `description`, `document`, `submitted_at`, `status`, `college_office`) VALUES
(1, 1, 1, 'Memorandum of Understanding between Curtin University, Malaysia and the University of Southeastern Philippines', 'DR. ADORA P. ZERRUDO, IAD Director', 'International Affairs Division', 'This proposed Memorandum of Understanding (MoU) between Curtin University, Malaysia and University of Southeastern Philippines aims to foster internationalization and advance higher education by collaborating in academic and cultural exchanges, research, and related activities. Curtin University is the largest international campus of Curtin University, Kent Street, Bentley, Western Australia, 6102 and a leading private institution of higher learning in Malaysia. It strives to provide quality education and richly interactive and personalized learning experiences for its students, equipping them with the leadership skills for the future and valuing them as partners in education and research as well as long-term influencers of change within society. This partnership holds significant value in USeP\'s ongoing efforts toward internationalization, serving as a catalyst for achieving the strategic goals set forth by the University. By leveraging the strengths of both institutions, the MoU aims to create a dynamic environment that fosters learning, research, and professional growth, thereby nurturing a diverse community of scholars and practitioners committed to global excellence in legal education.', '../resources/proposal_1', '2024-06-20 03:54:21', 'Completed', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluators`
--
ALTER TABLE `evaluators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `university_email` (`university_email`);

--
-- Indexes for table `proponents`
--
ALTER TABLE `proponents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `evaluators`
--
ALTER TABLE `evaluators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proponents`
--
ALTER TABLE `proponents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
