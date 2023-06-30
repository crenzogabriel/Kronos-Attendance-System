-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 04:19 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kronos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `fname`, `lname`, `pass`, `email`, `phone`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin@gmail.com', '09088900270');

-- --------------------------------------------------------

--
-- Table structure for table `attendancetable`
--

CREATE TABLE `attendancetable` (
  `id` int(200) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `attendanceDate` date DEFAULT NULL,
  `studentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendancetable`
--

INSERT INTO `attendancetable` (`id`, `fname`, `lname`, `status`, `subject`, `attendanceDate`, `studentid`) VALUES
(212, 'Geraldine', 'Mirabel', 'late', 'APPLICATION DEVELOPMENT', '2023-06-06', 9),
(213, 'Angelbert', 'Agorilla', 'absent', 'APPLICATION DEVELOPMENT', '2023-06-06', 10),
(214, 'Dark', 'Vader', 'present', 'CS Project', '2023-06-07', 13),
(215, 'Kristine', 'Baclagon', 'absent', 'CS Project', '2023-06-07', 14);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `username`, `fname`, `lname`, `pass`, `email`, `phone`) VALUES
(3, 'mika', 'Mikaela', 'Recamike', 'mike', 'mika@gmail.com', '78967453'),
(4, 'miles', 'Miles', 'Ortega', 'miles', 'milagros@gmail.com ', '090909696'),
(5, 'jof', 'Joferson', 'Bombasi', 'jof', 'joferson@gmail.com', '6969696969');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `status` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `studentid` int(20) NOT NULL,
  `subjectid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `subjectid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `fname`, `lname`, `pass`, `email`, `phone`, `subjectid`) VALUES
(4, 'kael', 'Kael', 'Kael', 'kael', 'kael@gmail.com', '09876543', 6),
(9, 'geraldine', 'Geraldine', 'Mirabel', 'geraldine', 'geraldine@gmail.com', '1837567382', 4),
(10, 'ago', 'Angelbert', 'Agorilla', 'ago', 'ago@gmail.com', '3287456', 4),
(11, 'juan', 'Juan', 'Dela Cruz', 'juan', 'juan@gmail.com', '134862387', 0),
(12, 'james', 'James', 'Montilla', 'james', 'james@gmail.com', '312847321', 5),
(13, 'dark', 'Dark', 'Vader', 'dark', 'dark@gmail.com', '2423423', 7),
(14, 'kristine', 'Kristine', 'Baclagon', 'kristine', 'kristine@gmail.com', '31242367', 7);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `facultyid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `subject_name`, `facultyid`) VALUES
(1, 'GED0045', 'WORLD LITERATURE', 4),
(2, 'CCS003', 'DATABASE MANAGEMENT', 3),
(3, 'CP01', 'Computer Programming', 4),
(4, 'CS0043', 'APPLICATION DEVELOPMENT', 3),
(7, 'CS0055', 'CS Project', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendancetable`
--
ALTER TABLE `attendancetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendancetable`
--
ALTER TABLE `attendancetable`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
