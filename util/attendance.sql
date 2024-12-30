-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 02:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attCode` int(11) NOT NULL,
  `mtgID` int(11) NOT NULL,
  `empID` int(11) NOT NULL,
  `timeIn` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attCode`, `mtgID`, `empID`, `timeIn`) VALUES
(2, 1, 2, '18:58:38'),
(3, 1, 7, '11:28:17'),
(4, 2, 4, '11:41:10'),
(5, 1, 4, '11:54:00'),
(6, 2, 1, '13:15:04'),
(7, 6, 1, '13:54:45'),
(8, 6, 2, '13:54:51'),
(9, 6, 7, '13:55:05'),
(10, 7, 8, '14:18:45'),
(11, 7, 2, '14:19:09'),
(12, 7, 7, '14:19:17'),
(13, 8, 1, '15:22:02'),
(14, 8, 4, '15:33:45'),
(15, 8, 7, '15:35:44'),
(16, 8, 8, '15:36:04'),
(17, 10, 1, '16:22:26'),
(18, 10, 2, '16:22:41'),
(20, 10, 4, '18:39:35'),
(21, 9, 10, '19:40:36'),
(22, 9, 2, '19:40:47'),
(23, 9, 7, '19:41:03'),
(24, 9, 9, '19:41:12'),
(25, 9, 11, '19:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `empNo` int(11) NOT NULL,
  `empFName` text NOT NULL,
  `empMName` text NOT NULL,
  `empLName` text NOT NULL,
  `empPosition` text NOT NULL,
  `empDept` text NOT NULL,
  `empCampus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`empNo`, `empFName`, `empMName`, `empLName`, `empPosition`, `empDept`, `empCampus`) VALUES
(1, 'Ariana', 'Butera', 'Grande', 'Singer', 'CCS', 'UC - MAIN'),
(2, 'Dominic', 'Cuesta', 'Navos', 'Database Designer', 'CCS', 'UC - MAIN'),
(4, 'Onicka', 'Tanya', 'Maraj', 'Rapper', 'Store', 'UC - BANILAD'),
(7, 'Janine', 'Bustamante', 'Ubal', 'UI/UX Designer', 'CCS', 'UC - MAIN'),
(8, 'Airah', 'Kuan', 'Baculo', 'Project Manager', 'Tech', 'UC - MAIN'),
(9, 'Karl John', 'Talolong', 'Delfin', 'Programmer', 'CCS', 'UC - MAIN'),
(10, 'Dwieght Dewey', 'Eagle', 'Fuentes', 'Project Manager', 'CCS', 'UC - MAIN'),
(11, 'Steven Bruce', 'Kuan', 'Miñoria', 'Technical Writer', 'CCS', 'UC - MAIN');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `mtgCode` int(11) NOT NULL,
  `mtgAgenda` text NOT NULL,
  `mtgVenue` text NOT NULL,
  `mtgDate` date NOT NULL,
  `mtgTstart` time NOT NULL,
  `mtgTend` time NOT NULL,
  `mtgFaci` text NOT NULL,
  `mtgStatus` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`mtgCode`, `mtgAgenda`, `mtgVenue`, `mtgDate`, `mtgTstart`, `mtgTend`, `mtgFaci`, `mtgStatus`) VALUES
(1, 'ICT Congress', 'SM Seaside', '2023-07-26', '18:37:00', '20:00:00', 'Lady Glitter Smackles', 'CLOSED'),
(2, 'CCS DAY', 'UC-MAIN', '2023-07-31', '18:45:00', '22:00:00', 'Onicka Tanya Maraj', 'CLOSED'),
(6, 'INTRAMURALS', 'UC - MAIN', '2023-07-17', '07:30:00', '11:00:00', 'Katy Perry', 'CLOSED'),
(7, 'Oral Defense', 'Meca Hall', '2023-07-25', '14:00:00', '15:00:00', 'Mr. Marvin Marinduque', 'CLOSED'),
(8, 'Team Formation', 'Classroom', '2023-07-21', '14:51:00', '16:00:00', 'Manny Pedro Moore', 'CLOSED'),
(9, 'Dry Run', 'Ilang Ubal', '2023-07-22', '08:30:00', '17:00:00', 'Dwieght Dewey Fuentes', 'CLOSED'),
(10, 'Testing Meeting', 'Everywhere', '2023-07-21', '16:21:00', '19:21:00', 'The Weeknd', 'CLOSED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attCode`),
  ADD KEY `attendance_ibfk_1` (`empID`),
  ADD KEY `attendance_ibfk_2` (`mtgID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`empNo`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`mtgCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `empNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `mtgCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`empID`) REFERENCES `employees` (`empNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`mtgID`) REFERENCES `meetings` (`mtgCode`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
