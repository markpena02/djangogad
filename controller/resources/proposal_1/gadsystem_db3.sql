-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 05:01 AM
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
-- Database: `gadsystem_db3`
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
(2, 'mark pena wala', 'genzo5401@gmail.com', '$2y$10$Sl9jL8AJ504i8o/381PClesTJdbUnsUEdE3RYYFfPQkjiSpU5pdqS', '2024-06-02 17:06:35'),
(3, 'Ferdinand Mark Peña', 'fmbpena@usep.edu.ph', '$2y$10$Sn3i/LGt4WHgjhHkHcOSwexghyjlbhwc4vQb/r6lb0cwvLKoErKSe', '2024-06-19 01:40:24');

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
(1, 1, 2, '\"[{\\\"item\\\":\\\"item2\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item3\\\",\\\"score\\\":0.5,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item4\\\",\\\"score\\\":2,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item6\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item7\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item8\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item9\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item11\\\",\\\"score\\\":0.33,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item12\\\",\\\"score\\\":0.67,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item13\\\",\\\"score\\\":0.67,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item14\\\",\\\"score\\\":2,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item15\\\",\\\"score\\\":2,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item17\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item18\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item20\\\",\\\"score\\\":0.67,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item21\\\",\\\"score\\\":0.67,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item22\\\",\\\"score\\\":0.67,\\\"comment\\\":\\\"\\\"}]\"', '../resources/resources-1-1.zip', '2024-06-02 14:34:10', '2024-06-02 14:34:10', 'Completed', NULL, 'This OJT program serves as a venue to experience industry standards whereby students should be able to bridge the gap between lecture/laboratory activities and\nindustry practices. During the internship program, the student interns are assigned to different areas and venues, while the Host Training Establishments (HTEs),\nthe student interns are given actual work experience in various departments that may be determined and mutually agreed upon by the school, THE or the student\nintern. An internship contract is signed by the student intern, the Higher Education Institution (HEI) and the Host Training Establishment (HTE). This agreement\nidentifies the student intern’s tasks and some policies regarding the program. This is a requirement for graduation as part of the curriculum design. Hence, this\nMOA is proposed to formalize the academe-industry collaboration. \n', NULL),
(2, 2, 2, '\"[{\\\"item\\\":\\\"item2\\\",\\\"score\\\":0.5,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item3\\\",\\\"score\\\":0.5,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item4\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item6\\\",\\\"score\\\":0.5,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item7\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item8\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item9\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item11\\\",\\\"score\\\":0.33,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item12\\\",\\\"score\\\":0.67,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item13\\\",\\\"score\\\":0.33,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item14\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item15\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item17\\\",\\\"score\\\":1,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item18\\\",\\\"score\\\":0.5,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item20\\\",\\\"score\\\":0,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item21\\\",\\\"score\\\":0.33,\\\"comment\\\":\\\"\\\"},{\\\"item\\\":\\\"item22\\\",\\\"score\\\":0.67,\\\"comment\\\":\\\"\\\"}]\"', '../resources/resources-2-1.zip', '2024-06-02 14:53:13', '2024-06-02 14:53:13', 'Completed', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluators`
--

CREATE TABLE `evaluators` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `university_email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evaluators`
--

INSERT INTO `evaluators` (`id`, `full_name`, `university_email`, `password`, `created_at`) VALUES
(1, 'Jennifer Montesclaros', 'jmontesclaros@usep.edu.ph', '$2y$10$fucKbzF35Sn/9G61GhXIeueKwu9Ilx5iLRQTy2EVs4sRD11gEFtDq', '2024-06-02 14:01:28'),
(2, 'Remah Joy Gador', 'rjgador@gmail.com', '$2y$10$VecJJqynzQkfBzWhOcoJg.bho01Wefw2mvt9MoiJX1S1.6Bm9faK6', '2024-06-02 16:22:41'),
(3, 'lestat lestat lestat', 'lestat@gmail.com', '$2y$10$WpAPyr9y4GniAIXTO2FX6uYiRwvhgN0aYMfDcOcG861Tfv4sOA04q', '2024-06-19 02:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `proponents`
--

CREATE TABLE `proponents` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `college_office` varchar(100) NOT NULL,
  `university_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proponents`
--

INSERT INTO `proponents` (`id`, `full_name`, `college_office`, `university_email`, `password`) VALUES
(1, 'Clifton John Rojo', 'CIC', 'cjrojo@usep.edu.ph', '$2y$10$OT8icmQjSk/FXA697IeykOYxMRMPLi3PUbHT94/vVp080Ihddh6Yy'),
(2, 'Ferdinand Mark B. Peña', 'CIC', 'fmbpena@usep.edu.ph', '$2y$10$v0tGD6sDZDED81OGAucMUeFGGTfXVsVSPsiVxG.oZGuXdbbadpapa'),
(3, 'Jeff Andrew', 'CIC', 'jabangkas@gmail.com', '$2y$10$HmVHUcqINoEEHE5FiKzMReAMwR7cXfyb31Wo1Ifpg5ZtLPo03h0xC'),
(4, 'Marlo Tisoy', 'CAS', 'mbarua@usep.edu.ph', '$2y$10$XdruVpJMnOClk8vHnjCMZu2zGF1eshU5XCYKNKc9hhcBdr.vpPOzm'),
(5, 'Mariam Daud', 'CIC', 'mdaud@usep.edu.ph', '$2y$10$/xSp8ZMhwfcVLTGvnfk6iuc9/s7N58/lkSX/uH0Yb/qhWsh4wRR0G'),
(6, 'Mark Peña', 'CIC', 'donquixote5401@gmail.com', '$2y$10$DPB0fYL0Ai8BRe5ZNY8DDucEzBHLULItesp3PE3Aj//8qqijFQ8SO'),
(7, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$juysyzGLsPSJkc.KvI74De6QqOIQzV1tlhr5RipWzhMJ4QyRa0Xa.'),
(8, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$shef.yMWhkvTIZrkVFSgPe4SGmBAoo3NferOlxqKe8pIW47Zks4Ue'),
(9, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$DSqNBVbjThU6NLyMjblaXuP74A3necxJP4In98gCl7ykbKMQCwr/q'),
(10, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$54W8LaFG0neBhtIWA63mBO773GyWkzdtpujqqqGC0RrJzNNRBrQwG'),
(11, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$q8FWx34J7uhxz.FxdQEhW.8t2066WlSqEO7FkrQfZmq0AVLv.OUBm'),
(12, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$CdcwvhbuRY3fmAlL/hCjae0vIzYZLGI/olNz1iCCIQRjThYuPPHzq'),
(13, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$pzdexWRMlKzNhXdnCAkskOhylqx24qV0bgCiUjfSeWeGFYrxd0gp.'),
(14, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$HTpLv4WdkxXa06GVMDIE4eNhJdM2dT7iRuUZCFopx5A2bW0QYIqy6'),
(15, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$9dWw2MnUznxi.5myjLrDRenEUVTnt3mPAIRufOSL/8Q58ZDGe4rqi'),
(16, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$c/e4IYEq8p7CIwp3QVj3re06IEwyjBwOj05jHusnDOAN6tOib7W3m'),
(17, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$E55sFGdL1Lq0NA2cB0stz.71VOf5QkJsEd5e9guPp3TPLP9EType2'),
(18, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$D/J2QXm8W09ozjPsXBm.uu3WWZJu2yTYKSZySggw0l1MArvdZQqX2'),
(19, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$/19GtdFLdoBHZZHcfnBBOOxh1gXzXuIE6kTCUU5b6jX9NHH0qEZxG'),
(20, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$xWx3jemWfzrgcqPNlCu5mOeWQTjCyc1avmWSuhQU3XmZ4Pp0MPSt6'),
(21, 'kani kani kani', 'kani', 'kani@gmail.com', '$2y$10$Uh5Fbz73D9zo6hlmQjRcOeCO4FqR.Dm4XmkmeqpzFG8n/XvUnt/Ae'),
(22, 'lestat lestat lestat', '123123', 'lestat123123@gmail.com', '$2y$10$Uj0u8Ro7zHjaWRm/FzSEGelk/x9WLmpYRjoiQalv50LQLgspCtJny'),
(23, 'lestat lestat lestat', '123123', 'lestat123123@gmail.com', '$2y$10$EdlApbI6Sb7jgi5riwcPD.X.4X2Hiso5enhIeP.5v6Fm6mIVBojte'),
(24, 'locasas', 'locasas', 'locasas@gmail.comj', '$2y$10$PY3fIJ30rKS8iYmYVJC8KOzhXSsdTNuhdNlcOTp9osXN990TGL6IK'),
(25, 'mark mark mark', 'COE', 'mark@usep.edu.ph', '$2y$10$icleKFXuAEm8J26Lg6VjJeZGosPMRsb7SuEqPzDc0tJ.WX18h4Rs2'),
(26, 'mark mark mark', 'COE', 'mark@usep.edu.ph', '$2y$10$cZai3kL47X94JKzY9ggFtObELb.pAmVi5tO4FDjdBM/8znk/wVmGK'),
(27, 'mark mark mark', 'COE', 'mark@usep.edu.ph', '$2y$10$jc6xB90Nbplza5uW2gs1lecT/4x/DrZ29IeCjp3XieKNlSTr.DpW6'),
(28, 'mark mark mark', 'COE', 'mark@usep.edu.ph', '$2y$10$4.XBXSbMSAdjnBmhusYQueBNX3tVSTKnihfvOIxC5ZnOV8366wdg6'),
(29, 'mark mark mark', 'COE', 'mark@usep.edu.ph', '$2y$10$GV9SzUSMmeouTyQ6aC5m2ezHznwjCWmIp9Qc4/8u9PG.r4c4wPK7K'),
(30, 'mark mark mark', 'COE', 'mark@usep.edu.ph', '$2y$10$zKNDbmW3nwgK.wLqXFjN1eeDhThNTKZCqo3zK3EQEO.6FQrM038v6'),
(31, 'mark mark mark', 'COE', 'mark@usep.edu.ph', '$2y$10$sFNJ9Bw.meB9b47ulR0sM.RpXICbf6kgWoKrCegtfGEhtYwZscoae');

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
(1, 1, 1, 'Memorandum of Agreement with Interfacing Development Intervention for Sustainability for OffCampus Internship of BSEE Students', 'ENGR. RICARDO FORBES L. ABEAR, BSEE OJT Faculty Supervisor', 'College of Engineering (CoE)', 'This OJT program serves as a venue to experience industry standards whereby students should be able to bridge the gap between lecture/laboratory activities and\nindustry practices. During the internship program, the student interns are assigned to different areas and venues, while the Host Training Establishments (HTEs),\nthe student interns are given actual work experience in various departments that may be determined and mutually agreed upon by the school, THE or the student\nintern. An internship contract is signed by the student intern, the Higher Education Institution (HEI) and the Host Training Establishment (HTE). This agreement\nidentifies the student intern’s tasks and some policies regarding the program. This is a requirement for graduation as part of the curriculum design. Hence, this\nMOA is proposed to formalize the academe-industry collaboration. \n', '../resources/resources-1-1.zip', '2024-06-02 13:50:19', 'Completed', NULL),
(2, 2, 1, 'Moa sa taga CIC', 'Vera Kim Tequin', 'CIC', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '../resources/resources-2-1.zip', '2024-06-02 14:16:11', 'Completed', NULL),
(3, 6, 2, 'kani kani kani', 'donquixote5401@gmail.com', 'donquixote5401@gmail.com', 'donquixote5401@gmail.com', '../resources/resources-3-1.zip', '2024-06-19 02:16:55', 'pending', NULL),
(4, 6, 0, 'weqwe', 'donquixote5401@gmail.com', 'donquixote5401@gmail.com', 'wdqwrdqwqweqe', '../resources/resources-4-1.zip', '2024-06-19 02:19:33', 'pending', NULL),
(5, 6, 0, 'fsadfsafdasf', 'aafsdsafdasfasf', 'asdfasdfasdf', 'sadfasdfsafas', '../resources/resources-5-1.zip', '2024-06-19 02:21:28', 'pending', NULL),
(6, 6, 0, 'asdfasdfasdfas', 'asdfasdfasdf', 'sadf2q', 'tq3wretgaew', '../resources/resources-6-1.zip', '2024-06-19 02:21:50', 'pending', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `evaluators`
--
ALTER TABLE `evaluators`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proponents`
--
ALTER TABLE `proponents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
