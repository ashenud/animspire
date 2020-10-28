-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 192.168.1.110
-- Generation Time: Oct 29, 2020 at 02:54 AM
-- Server version: 10.4.15-MariaDB-1:10.4.15+maria~bionic-log
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animspire`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_fname` varchar(25) NOT NULL,
  `customer_lname` varchar(50) NOT NULL,
  `customer_email` varchar(80) NOT NULL,
  `customer_country` varchar(100) NOT NULL,
  `customer_dob` date NOT NULL,
  `customer_gender` int(11) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `customer_image` text NOT NULL,
  `customer_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_fname`, `customer_lname`, `customer_email`, `customer_country`, `customer_dob`, `customer_gender`, `customer_phone`, `customer_image`, `customer_create_date`, `customer_update_date`, `customer_status`) VALUES
(2, 'Dhanushka', 'Lakshan', 'dhanushka.lakshan@gmail.com', 'Sri Lanka', '1994-05-25', 0, '+94778965925', 'defaultImage.jpg', '2020-07-01 19:04:31', '2020-07-01 13:34:31', 1),
(3, 'Ashan', 'Gunawardena', 'ashan.guna@gmail.com', 'Sri Lanka', '1994-06-27', 0, '5555555', 'defaultImage.jpg', '2020-07-02 17:19:48', '2020-07-02 11:49:48', 1),
(4, 'Kasun', 'Gayantha', 'kasun@gmail.com', 'Sri Lanka', '1990-05-10', 0, '+94786958654', 'defaultImage.jpg', '2020-07-02 21:16:06', '2020-07-02 15:46:06', 1),
(5, 'Lasith', 'De Silva', 'lasith.de@gmail.com', 'Sri Lanka', '1991-06-25', 0, '+94775698425', 'defaultImage.jpg', '2020-07-03 17:45:47', '2020-07-03 12:15:47', 1),
(6, 'Sachin', 'Rukshan', 'sachin.rukshan@gmail.com', 'Sri Lanka', '1994-12-05', 0, '0778889345', '1595851369_M9.png', '2020-07-27 17:32:49', '2020-07-27 12:02:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `customer_login_id` int(11) NOT NULL,
  `customer_login_username` varchar(80) NOT NULL,
  `customer_login_password` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_login_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_login`
--

INSERT INTO `customer_login` (`customer_login_id`, `customer_login_username`, `customer_login_password`, `customer_id`, `customer_login_status`) VALUES
(1, 'dhanushka.lakshan@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, 1),
(2, 'ashan.guna@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3, 1),
(3, 'kasun@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 4, 1),
(4, 'lasith.de@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 5, 1),
(5, 'sachin.rukshan@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer`
--

CREATE TABLE `freelancer` (
  `freelancer_id` int(11) NOT NULL,
  `freelancer_fname` varchar(25) NOT NULL,
  `freelancer_lname` varchar(50) NOT NULL,
  `freelancer_email` varchar(80) NOT NULL,
  `freelancer_country` varchar(100) NOT NULL,
  `freelancer_dob` date NOT NULL,
  `freelancer_gender` int(11) NOT NULL,
  `freelancer_phone` varchar(20) NOT NULL,
  `freelancer_image` text NOT NULL,
  `freelancer_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `freelancer_update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `freelancer_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `freelancer`
--

INSERT INTO `freelancer` (`freelancer_id`, `freelancer_fname`, `freelancer_lname`, `freelancer_email`, `freelancer_country`, `freelancer_dob`, `freelancer_gender`, `freelancer_phone`, `freelancer_image`, `freelancer_create_date`, `freelancer_update_date`, `freelancer_status`) VALUES
(1, 'Imesha', 'De Silva', 'imesha.desilva@gmail.com', 'Sri Lanka', '1988-10-25', 1, '0776592630', '1595922420_F7.png', '2020-07-28 13:17:00', '2020-07-28 07:47:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_login`
--

CREATE TABLE `freelancer_login` (
  `freelancer_login_id` int(11) NOT NULL,
  `freelancer_login_username` varchar(80) NOT NULL,
  `freelancer_login_password` text NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `freelancer_login_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `freelancer_login`
--

INSERT INTO `freelancer_login` (`freelancer_login_id`, `freelancer_login_username`, `freelancer_login_password`, `freelancer_id`, `freelancer_login_status`) VALUES
(1, 'imesha.desilva@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_fname` varchar(25) NOT NULL,
  `user_lname` varchar(50) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `user_role` varchar(25) NOT NULL,
  `user_dob` date NOT NULL,
  `user_gender` int(11) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_image` text NOT NULL,
  `user_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_fname`, `user_lname`, `user_email`, `user_role`, `user_dob`, `user_gender`, `user_phone`, `user_image`, `user_create_date`, `user_update_date`, `user_status`) VALUES
(1, 'Damith', 'Menaka', 'damith@gmail.com', '1', '1997-08-09', 0, '0712974466', '1596361520_M5.png', '2020-06-26 14:54:39', '2020-10-27 16:32:17', 1),
(2, 'Yuresh', 'Yasintha', 'yuresh@gmail.com', '2', '1997-12-03', 0, '0758996325', '1596361541_M1.png', '2020-07-03 12:06:02', '2020-08-05 15:19:07', 1),
(3, 'Rushan', 'Tharanga', 'rushan.tharanga@gmail.com', '3', '1991-06-15', 0, '0776859696', '1595930399_M3.png', '2020-07-28 15:29:59', '2020-07-28 09:59:59', 1),
(4, 'Madumika', 'Vithange', 'madumika.v@gmail.com', '4', '1994-02-09', 1, '0756665544', '1596442575_F8.png', '2020-08-03 13:46:15', '2020-08-03 13:54:02', 1),
(5, 'Kashun', 'Thilina', 'kashun.thilina@gmail.com', '1', '1988-02-03', 0, '0772224142', '1603816798_M8.png', '2020-10-27 08:27:20', '2020-10-27 16:39:58', 1),
(6, 'Imesha', 'Thilini', 'imesha.thilini@gmail.com', '2', '1989-12-08', 1, '0716364666', '1603820673_F8.png', '2020-10-27 08:29:36', '2020-10-27 17:44:33', 1),
(7, 'Sachitha', 'Maduranga', 'sachitha.m@gmail.com', '3', '1994-12-08', 0, '0778887799', '1603767657_M8.png', '2020-10-27 08:30:57', '2020-10-27 03:00:57', 1),
(8, 'Janaka', 'Rukantha', 'janaka.r@gmail.com', '4', '1994-10-07', 0, '0771234455', '1603767718_M4.png', '2020-10-27 08:31:58', '2020-10-27 03:01:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_department`
--

CREATE TABLE `user_department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_department`
--

INSERT INTO `user_department` (`department_id`, `department_name`) VALUES
(1, 'Administration'),
(2, 'Project Management'),
(3, 'Finance Management'),
(4, 'Marketing Management');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_login_id` int(11) NOT NULL,
  `user_login_username` varchar(80) NOT NULL,
  `user_login_password` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_login_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_login_id`, `user_login_username`, `user_login_password`, `user_id`, `user_login_status`) VALUES
(1, 'damith@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1),
(2, 'yuresh@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, 1),
(3, 'rushan.tharanga@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3, 1),
(4, 'madumika.v@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 4, 1),
(5, 'kashun.thilina@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 5, 1),
(6, 'imesha.thilini@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 6, 1),
(7, 'sachitha.m@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 7, 1),
(8, 'janaka.r@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(25) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`, `department_id`) VALUES
(1, 'System Administrator', 1),
(2, 'Project Manager', 2),
(3, 'Finance Manager', 3),
(4, 'Marketing Manager', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`customer_login_id`);

--
-- Indexes for table `freelancer`
--
ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`freelancer_id`);

--
-- Indexes for table `freelancer_login`
--
ALTER TABLE `freelancer_login`
  ADD PRIMARY KEY (`freelancer_login_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_department`
--
ALTER TABLE `user_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_login_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_login`
--
ALTER TABLE `customer_login`
  MODIFY `customer_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `freelancer`
--
ALTER TABLE `freelancer`
  MODIFY `freelancer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `freelancer_login`
--
ALTER TABLE `freelancer_login`
  MODIFY `freelancer_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_department`
--
ALTER TABLE `user_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
