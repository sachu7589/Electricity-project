-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 02:36 PM
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
(4, 20, 29, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consumers`
--

CREATE TABLE `tbl_consumers` (
  `C_id` int(11) NOT NULL,
  `C_fname` varchar(50) NOT NULL,
  `C_lname` varchar(50) NOT NULL,
  `C_phne` varchar(15) NOT NULL,
  `C_so` varchar(50) NOT NULL,
  `C_postal` double NOT NULL,
  `C_house` varchar(50) NOT NULL,
  `C_street` varchar(50) NOT NULL,
  `C_city` varchar(50) NOT NULL,
  `C_houseno` varchar(10) NOT NULL,
  `C_district` varchar(50) NOT NULL,
  `C_area` varchar(50) NOT NULL,
  `C_con_type` varchar(50) NOT NULL,
  `C_proof_id` blob NOT NULL,
  `C_building` blob NOT NULL,
  `C_status` varchar(50) NOT NULL DEFAULT 'pending',
  `C_req_date` date NOT NULL DEFAULT current_timestamp(),
  `C_approve_date` date NOT NULL,
  `C_Lid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_consumers`
--

INSERT INTO `tbl_consumers` (`C_id`, `C_fname`, `C_lname`, `C_phne`, `C_so`, `C_postal`, `C_house`, `C_street`, `C_city`, `C_houseno`, `C_district`, `C_area`, `C_con_type`, `C_proof_id`, `C_building`, `C_status`, `C_req_date`, `C_approve_date`, `C_Lid`) VALUES
(8, 'Eapen', 'Thomas', '9961245367', 'qwerty', 654411, 'villunni', 'pettakavala', 'vandiperiyar', '111', 'Kottayam', 'koovapally', 'Commercial Connection', 0x646f63756d656e74732f616e737765722e706466, 0x646f63756d656e74732f616e737765722e70646620, 'approved', '2024-03-01', '0000-00-00', 75),
(10, 'sachu', 'saji', '7902486166', 'qwerty', 685544, 'aaaaaaaaa', 'pettakavala', 'kanjirapally', '111', 'Kottayam', 'koovapally', 'Domestic Connection', 0x646f63756d656e74732f41737369676e6d656e742e706466, 0x646f63756d656e74732f6d6f6420312e706466, 'pending', '2024-03-03', '0000-00-00', 81),
(11, 'sachu', 'saji', '9540036728', 'qwerty', 685544, 'villunni', 'pettakavala', 'vandiperiyar', '111', 'Kottayam', 'koovapally', 'Domestic Connection', 0x646f63756d656e74732f41737369676e6d656e742e706466, 0x646f63756d656e74732f6d6f6420322e706466, 'approved', '2024-03-04', '0000-00-00', 82),
(12, 'sachu', 'saji', '9961245367', 'qwerty', 685544, 'villunni', 'pettakavala', 'kanjirapally', '111', 'Kottayam', 'koovapally', 'Domestic Connection', 0x646f63756d656e74732f41737369676e6d656e742e706466, 0x646f63756d656e74732f6d6f6420312e706466, 'pending', '2024-03-07', '0000-00-00', 83);

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
  `E_level` varchar(50) NOT NULL,
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

INSERT INTO `tbl_employees` (`E_id`, `E_fname`, `E_lname`, `E_phne`, `E_email`, `E_so`, `E_postal`, `E_house`, `E_level`, `E_street`, `E_city`, `E_dob`, `E_district`, `E_L_id`, `E_status`) VALUES
(29, 'sachu', 'saji', '7902486166', 'sachus7589@gmail.com', 'qwerty', 685544, 'villunni', 'manager', 'vandiperiyar', 'pettakavala', '2006-02-07', 'Kottayam', 62, 1),
(30, 'subin', 'santhosh', '9961245367', 'sachu7589@gmail.com', 'qwerty', 748512, 'villunni', 'meter reader', 'vandiperiyar', 'ponkunnam', '2006-02-07', 'Alappuzha', 63, 1);

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
(62, 'sachus7589@gmail.com', '9515f471dd8b1224ea66a933d45d5740', 3, 1),
(63, 'sachu7589@gmail.com', '1fb99cdf3b92c8e70ec30cadac502795', 3, 1),
(75, 'eapentkadamapuzha@gmail.com', '1852bc7f0f362b8829943acfe88cd45e', 2, 1),
(82, 'aromalgirish00@gmail.com', 'bc8b85235f862c4c3c97a78580692bcc', 2, 1),
(83, 'sachus7589@gmail.com', 'c14e5dd0c6a2be60b3485fd4adc3da59', 2, 1);

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
(20, '9961245367', 'login@gmail.com', 'koovapally', 784573, 'pettakavala', 'vandiperiyar', 'near perumpatty', 'Kottayam', 1);

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
-- Indexes for table `tbl_consumers`
--
ALTER TABLE `tbl_consumers`
  ADD PRIMARY KEY (`C_id`);

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
  MODIFY `Alloc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_consumers`
--
ALTER TABLE `tbl_consumers`
  MODIFY `C_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  MODIFY `E_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `L_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tbl_offices`
--
ALTER TABLE `tbl_offices`
  MODIFY `O_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
