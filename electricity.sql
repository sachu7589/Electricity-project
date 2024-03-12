-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 05:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electricity`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allocate`
--

CREATE TABLE `tbl_allocate` (
  `Alloc_id` int(11) NOT NULL,
  `Alloc_officeid` int(11) NOT NULL,
  `Alloc_manager` int(11) DEFAULT 0,
  `Alloc_meter` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_allocate`
--

INSERT INTO `tbl_allocate` (`Alloc_id`, `Alloc_officeid`, `Alloc_manager`, `Alloc_meter`) VALUES
(1, 17, 0, 0),
(2, 18, 23, 26),
(3, 19, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_connection`
--

CREATE TABLE `tbl_connection` (
  `Con_id` int(11) NOT NULL,
  `Con_request_date` date NOT NULL DEFAULT current_timestamp(),
  `Con_approval_date` date NOT NULL,
  `Con_conn_type` varchar(50) NOT NULL,
  `Con_proof` blob NOT NULL,
  `Con_L_id` int(11) NOT NULL,
  `Con_status` varchar(50) NOT NULL DEFAULT 'pending',
  `Con_off_id` int(11) NOT NULL,
  `Con_det_id` int(11) NOT NULL,
  `Con_name` varchar(50) NOT NULL,
  `Con_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_connection`
--

INSERT INTO `tbl_connection` (`Con_id`, `Con_request_date`, `Con_approval_date`, `Con_conn_type`, `Con_proof`, `Con_L_id`, `Con_status`, `Con_off_id`, `Con_det_id`, `Con_name`, `Con_email`) VALUES
(28, '2024-02-07', '0000-00-00', '', '', 31, 'pending', 0, 0, '', 'subin192@gmail.com'),
(29, '2024-02-07', '0000-00-00', '', '', 32, 'pending', 0, 0, '', 'admin@gmai');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employees`
--

CREATE TABLE `tbl_employees` (
  `E_id` int(11) NOT NULL,
  `E_fname` varchar(50) NOT NULL,
  `E_lname` varchar(50) NOT NULL,
  `E_phne` varchar(15) NOT NULL,
  `E_email` varchar(50) NOT NULL,
  `E_so` varchar(30) NOT NULL,
  `E_postal` double NOT NULL,
  `E_house` varchar(100) NOT NULL,
  `E_street` varchar(50) NOT NULL,
  `E_city` varchar(30) NOT NULL,
  `E_dob` date NOT NULL,
  `E_district` varchar(30) NOT NULL,
  `E_L_id` int(11) NOT NULL,
  `E_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employees`
--

INSERT INTO `tbl_employees` (`E_id`, `E_fname`, `E_lname`, `E_phne`, `E_email`, `E_so`, `E_postal`, `E_house`, `E_street`, `E_city`, `E_dob`, `E_district`, `E_L_id`, `E_status`) VALUES
(23, 'sachu', 'saji', '9961245367', 'subin192@gmail.com', 'qwerty', 685544, 'villunni', 'vandiperiyar', 'chalukunnel', '2006-01-30', 'Alappuzha', 56, 1),
(26, 'felix', 'thomas', '9961245367', 'subin192@gmail.com', 'qwerty', 685522, 'villunni', 'vandiperiyar', 'pettakavala', '2006-02-05', 'Kottayam', 59, 1),
(27, 'subin', 'santhosh', '7902486166', 'sachus7589@gmail.com', 'qwerty', 685544, 'villunni', 'vandiperiyar', 'chenappaddy', '2006-01-30', 'Alappuzha', 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `L_id` int(11) NOT NULL,
  `L_uname` varchar(50) NOT NULL,
  `L_pass` varchar(100) NOT NULL,
  `L_type_id` int(11) NOT NULL,
  `L_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`L_id`, `L_uname`, `L_pass`, `L_type_id`, `L_status`) VALUES
(30, 'admin@gmail.com', '0e7517141fb53f21ee439b355b5a1d0a', 1, 1),
(56, 'subin192@gmail.com', 'cc588ae7b05800143b3817455b128bc7', 3, 1),
(59, 'abyjoy2@gmail.com', 'b092aac417d9a3851d52df2b2e512738', 3, 1),
(61, 'sachus7589@gmail.com', 'a13d36739e0d6a7b86e89903d22c04f4', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offices`
--

CREATE TABLE `tbl_offices` (
  `O_id` int(11) NOT NULL,
  `O_phone` varchar(15) NOT NULL,
  `O_email` varchar(50) NOT NULL,
  `O_area` varchar(50) NOT NULL,
  `O_postal` double NOT NULL,
  `O_street` varchar(100) NOT NULL,
  `O_city` varchar(50) NOT NULL,
  `O_landmark` varchar(100) NOT NULL,
  `O_district` varchar(25) NOT NULL,
  `O_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_offices`
--

INSERT INTO `tbl_offices` (`O_id`, `O_phone`, `O_email`, `O_area`, `O_postal`, `O_street`, `O_city`, `O_landmark`, `O_district`, `O_status`) VALUES
(17, '9540036728', 'login@gmail.com', 'chenappaddy', 685544, 'pettakavala', 'vandiperiyar', 'near perumpatty', 'Palakkad', 0),
(18, '9540036728', 'login@gmail.com', 'chenappaddy', 685522, 'ponkunnam', 'vandiperiyar', 'near perumpatty', 'Idukki', 1),
(19, '7902486165', 'abc@gmail.com', 'koovapally', 654477, 'chalukunnel', 'kottayam', 'near chenappady schooll', 'Ernakulam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_types`
--

CREATE TABLE `tbl_user_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_types`
--

INSERT INTO `tbl_user_types` (`type_id`, `type_name`) VALUES
(1, 'Admin'),
(2, 'Consumer'),
(3, 'Employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_allocate`
--
ALTER TABLE `tbl_allocate`
  ADD PRIMARY KEY (`Alloc_id`);

--
-- Indexes for table `tbl_connection`
--
ALTER TABLE `tbl_connection`
  ADD PRIMARY KEY (`Con_id`);

--
-- Indexes for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  ADD PRIMARY KEY (`E_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`L_id`);

--
-- Indexes for table `tbl_offices`
--
ALTER TABLE `tbl_offices`
  ADD PRIMARY KEY (`O_id`);

--
-- Indexes for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_allocate`
--
ALTER TABLE `tbl_allocate`
  MODIFY `Alloc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_connection`
--
ALTER TABLE `tbl_connection`
  MODIFY `Con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  MODIFY `E_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `L_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_offices`
--
ALTER TABLE `tbl_offices`
  MODIFY `O_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
