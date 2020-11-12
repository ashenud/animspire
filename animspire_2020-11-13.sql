-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 192.168.1.101
-- Generation Time: Nov 12, 2020 at 11:32 PM
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
-- Table structure for table `backup_details`
--

CREATE TABLE `backup_details` (
  `backup_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `backup_reference` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `backup_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backup_details`
--

INSERT INTO `backup_details` (`backup_id`, `user_id`, `backup_reference`, `description`, `backup_time`) VALUES
(1, 1, 878057317368, 'Backup done by Damith Menaka', '2020-10-29 22:29:02'),
(2, 1, 867146058026, 'Backup done by Damith Menaka', '2020-10-29 22:29:42'),
(3, 1, 252089990023, 'Backup done by Damith Menaka', '2020-10-29 22:29:55'),
(4, 1, 539896341774, 'Backup done by Damith Menaka', '2020-10-29 22:31:10'),
(5, 1, 124618088591, 'Backup done by Damith Menaka', '2020-10-29 22:34:08'),
(6, 1, 709423907556, 'Backup done by Damith Menaka', '2020-10-29 22:37:44'),
(7, 1, 776526063494, 'Backup done by Damith Menaka', '2020-10-29 23:31:11'),
(8, 1, 676554783591, 'Backup done by Damith Menaka', '2020-10-30 10:24:00'),
(9, 5, 483154468334, 'Backup done by Kashun Thilina', '2020-10-31 20:41:09'),
(10, 5, 308452327334, 'Backup done by Kashun Thilina', '2020-10-31 20:43:00'),
(11, 1, 891183605949, 'Backup done by Damith Menaka', '2020-11-05 19:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `communication`
--

CREATE TABLE `communication` (
  `msg_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1-read, 0-unread'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `communication`
--

INSERT INTO `communication` (`msg_id`, `sender_id`, `receiver_id`, `message`, `send_date`, `status`) VALUES
(1, 2, 1, 'Did you contact Mr. Nimal?', '2020-10-30 08:33:50', 1),
(2, 3, 1, 'Did you contact Mr. Niru?', '2020-10-30 08:33:50', 1),
(3, 4, 1, 'Hi Damith, Did you got the issue fixed?', '2020-10-30 08:35:24', 1),
(4, 3, 1, 'Will you come tomorrow meeting?', '2020-10-30 08:35:24', 1),
(5, 1, 3, 'I will contact him today.', '2020-10-30 08:34:31', 1),
(6, 1, 3, 'Yes. Meet you at there.', '2020-10-30 08:59:56', 1),
(7, 1, 2, 'Nope. I will do.', '2020-10-30 10:48:42', 1),
(8, 1, 3, 'Where are You ?', '2020-10-30 10:51:51', 1),
(9, 1, 3, 'Please call me now', '2020-10-30 10:52:30', 1),
(10, 1, 4, 'Yes.', '2020-10-30 10:54:54', 1),
(11, 1, 3, 'Did you receive my letter??', '2020-10-30 15:15:13', 1),
(12, 2, 1, 'Please call me now', '2020-10-30 16:10:13', 1),
(13, 1, 2, 'Ok. wait a minutes.', '2020-10-30 16:18:37', 0),
(14, 1, 2, 'Whats is your tomorrow plans  ?', '2020-10-30 16:22:53', 0),
(15, 6, 1, 'Hi. Damith', '2020-10-30 16:25:20', 0),
(16, 6, 2, 'Hellow Yuresh!', '2020-10-30 16:25:52', 1),
(17, 3, 1, 'Sorry', '2020-10-31 16:56:35', 1),
(18, 3, 1, 'I was busy those days', '2020-10-31 16:56:49', 1),
(19, 3, 1, 'I will call you tomorrow ', '2020-10-31 16:57:21', 1),
(20, 3, 5, 'Hellow Kasun !', '2020-10-31 16:57:43', 0),
(21, 3, 4, 'Hi Madumika!', '2020-10-31 16:59:51', 1),
(22, 4, 3, 'Hi Rushan', '2020-10-31 17:15:28', 0),
(23, 4, 3, 'How are you??', '2020-10-31 17:15:41', 0),
(24, 4, 8, 'Hellow Janaka!', '2020-10-31 17:16:00', 0),
(25, 7, 1, 'Please call me now', '2020-10-31 17:18:24', 0),
(26, 7, 1, 'Did you receive my files??', '2020-10-31 17:23:08', 0),
(27, 7, 3, 'Hellow Rushan !', '2020-10-31 18:16:15', 1),
(28, 6, 7, 'Hellow Sachintha!', '2020-10-31 18:17:57', 0),
(29, 2, 6, 'Hellow whts up ?', '2020-10-31 18:19:21', 0),
(30, 5, 1, 'Hi Damith!', '2020-10-31 20:39:54', 0),
(31, 5, 1, 'I am the another admin', '2020-10-31 20:40:23', 0),
(32, 1, 3, 'Hey, Did you receive my files?', '2020-11-01 12:55:03', 1),
(33, 10, 1, 'Where are You ?', '2020-11-01 14:45:51', 1),
(34, 10, 2, 'Hellow Bro !!', '2020-11-01 14:47:06', 0),
(35, 10, 3, 'Hellow Rushan !', '2020-11-01 14:48:37', 1),
(36, 10, 4, 'Hellow whts up ?', '2020-11-01 14:49:11', 0),
(37, 3, 10, 'Hellow whts up ?', '2020-11-01 14:50:15', 0),
(38, 3, 7, 'Hellow Sachintha!', '2020-11-01 14:50:32', 0),
(39, 1, 10, 'I am at meeting now', '2020-11-01 14:51:42', 0);

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
(2, 'Dhanushka', 'Lakshan', 'dhanushka.lakshan@gmail.com', 'Sri Lanka', '1994-05-25', 0, '0778965925', '1604780980_profile-pic.png', '2020-07-01 19:04:31', '2020-11-07 20:29:40', 1),
(3, 'Ashan', 'Gunawardena', 'ashan.guna@gmail.com', 'Sri Lanka', '1994-06-27', 0, '5555555', 'defaultImage.png', '2020-07-02 17:19:48', '2020-11-04 16:17:30', 1),
(4, 'Kasun', 'Gayantha', 'kasun@gmail.com', 'Sri Lanka', '1990-05-10', 0, '+94786958654', 'defaultImage.png', '2020-07-02 21:16:06', '2020-11-04 16:17:34', 1),
(5, 'Lasith', 'De Silva', 'lasith.de@gmail.com', 'Sri Lanka', '1991-06-25', 0, '+94775698425', 'defaultImage.png', '2020-07-03 17:45:47', '2020-11-04 16:17:39', 1),
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
(1, 'Imesha', 'De Silva', 'imesha.desilva@gmail.com', 'Sri Lanka', '1988-10-25', 1, '0776592630', '1604782839_1596442575_F8.png', '2020-07-28 13:17:00', '2020-11-07 21:00:39', 1),
(2, 'Ashen', 'Udithamal', 'udithamal.lk@gmail.com', 'Sri Lanka', '1995-03-16', 0, '0712758810', '1604143768_K8.jpg', '2020-10-31 16:59:28', '2020-10-31 11:29:28', 1),
(3, 'Samith', 'Perera', 'samith@gmail.com', 'Sri Lanka', '1995-10-04', 0, '0712758813', '1604176625_profile-pic.png', '2020-11-01 02:07:05', '2020-10-31 20:37:05', 1);

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
(1, 'imesha.desilva@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 1),
(2, 'udithamal.lk@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 2, 1),
(3, 'samith@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_description` varchar(1000) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(30) DEFAULT NULL,
  `requested_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `paid_date` timestamp NULL DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 1 COMMENT '1-requested, 2-paid',
  `project_status` int(2) NOT NULL DEFAULT 0 COMMENT '0-not assign, 1-assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `quotation_id`, `customer_id`, `payment_description`, `amount`, `paid_amount`, `payment_method`, `requested_date`, `paid_date`, `status`, `project_status`) VALUES
(1, 2, 2, 'This is description', '1000.00', '1000.00', 'PayPal', '2020-11-09 17:53:44', '2020-11-10 19:18:56', 2, 1),
(2, 1, 2, 'Pay this amount', '1000.00', '1000.00', 'PayPal', '2020-11-09 19:36:56', '2020-11-12 16:36:48', 2, 1),
(3, 5, 2, 'This is our budget', '67500.00', '67500.00', 'PayPal', '2020-11-11 19:03:42', '2020-11-11 19:04:28', 2, 0),
(4, 4, 2, 'Pay this', '15000.00', '0.00', NULL, '2020-11-12 16:41:15', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `project_manager_id` int(11) NOT NULL,
  `freelancer_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `project_status` int(11) NOT NULL DEFAULT 0 COMMENT '0-active, 1-deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `description`, `quotation_id`, `customer_id`, `project_manager_id`, `freelancer_id`, `task_id`, `start_date`, `end_date`, `created_time`, `project_status`) VALUES
(1, 'Logo Design', 'Use any freelancer', 1, 2, 2, NULL, NULL, '2020-11-15', '2020-11-28', '2020-11-12 16:25:28', 0),
(2, 'Graphical Contest', 'This is the biggest in summer ', 2, 2, 6, NULL, NULL, '2020-11-29', '2020-12-12', '2020-11-12 16:46:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `quotation_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `requirements` varchar(1000) NOT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  `date created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(2) NOT NULL DEFAULT 1 COMMENT '1-pending, 2-submitted, 3-approved, 4-rejected'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`quotation_id`, `customer_id`, `subject`, `requirements`, `remarks`, `date created`, `date_updated`, `status`) VALUES
(1, 2, 'Logo Design', 'My budget is around $5', 'OK', '2020-11-04 17:30:10', '2020-11-04 17:30:10', 3),
(2, 2, 'Graphical Contest', 'Need a better place', 'Ok', '2020-11-04 17:32:23', '2020-11-05 17:56:47', 3),
(3, 2, 'Java Project', 'My budget is around $7', 'Our budget is $5', '2020-11-04 19:00:26', '2020-11-05 17:46:47', 4),
(4, 2, 'HTML Project', 'My cost is around 20$', 'Our Budget is 5000.00', '2020-11-05 19:17:12', '2020-11-05 19:17:12', 3),
(5, 2, 'Laravel Project', 'Laravel Passport', 'OK', '2020-11-09 19:16:18', '2020-11-09 19:16:18', 3),
(6, 2, 'NodJs Project ', '7 weeks of time', 'Ok. We can manage it', '2020-11-11 18:59:44', '2020-11-11 18:59:44', 2),
(7, 2, 'Photoshop work', 'Logo Designs and vectors\r\nDo it on 1000.00', 'Our Budget is 1500.00', '2020-11-11 19:00:30', '2020-11-11 19:17:12', 1),
(8, 2, 'Cover Page Design', 'A4 size page', NULL, '2020-11-11 19:12:03', '2020-11-11 19:12:03', 1),
(9, 2, 'Sticker Offset out', 'Bulk size is 12', NULL, '2020-11-11 19:15:34', '2020-11-11 19:15:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `reset_id` int(3) DEFAULT NULL,
  `reset_code` varchar(100) DEFAULT NULL,
  `reset_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Damith', 'Menaka', 'damith@gmail.com', '1', '1997-08-09', 0, '0712974466', '1604014460_K8.jpg', '2020-06-26 14:54:39', '2020-11-07 22:55:40', 1),
(2, 'Yuresh', 'Yasintha', 'yuresh@gmail.com', '2', '1997-12-03', 0, '0758996325', '1596361541_M1.png', '2020-07-03 12:06:02', '2020-11-01 14:01:17', 1),
(3, 'Rushan', 'Tharanga', 'rushan.tharanga@gmail.com', '3', '1991-06-15', 0, '0776859696', '1595930399_M3.png', '2020-07-28 15:29:59', '2020-11-01 14:30:13', 1),
(4, 'Madumika', 'Vithange', 'madumika.v@gmail.com', '4', '1994-02-09', 1, '0756665544', '1596442575_F8.png', '2020-08-03 13:46:15', '2020-11-01 14:23:35', 1),
(5, 'Kasun', 'Thilina', 'kashun.thilina@gmail.com', '1', '1988-02-03', 0, '0772224142', '1603816798_M8.png', '2020-10-27 08:27:20', '2020-10-31 20:50:50', 1),
(6, 'Imesha', 'Thilini', 'imesha.thilini@gmail.com', '2', '1989-12-08', 1, '0716364666', '1603820673_F8.png', '2020-10-27 08:29:36', '2020-10-27 17:44:33', 1),
(7, 'Sachitha', 'Maduranga', 'sachitha.m@gmail.com', '3', '1994-12-08', 0, '0778887799', '1603767657_M8.png', '2020-10-27 08:30:57', '2020-10-27 03:00:57', 1),
(8, 'Janaka', 'Rukantha', 'janaka.r@gmail.com', '4', '1994-10-07', 0, '0771234455', '1603767718_M4.png', '2020-10-27 08:31:58', '2020-10-27 03:01:58', 1),
(9, 'Nimal', 'Perera', 'Nimal@gmail.com', '2', '1981-06-01', 0, '0712758810', '1604014235_M8.png', '2020-10-29 23:46:36', '2020-10-31 19:38:49', 1),
(10, 'Nadeera', 'Nishan', 'nadeera@gmail.com', '1', '1992-12-01', 0, '0712758819', '1604177973_defaultImage.png', '2020-11-01 02:22:53', '2020-10-31 20:59:33', 1),
(11, 'Chamari', 'Athapattu', 'chamari@gmail.com', '2', '1990-02-13', 1, '0712758811', '1604177911_1595922420_F7.png', '2020-11-01 02:28:31', '2020-11-01 13:49:39', 1);

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
(8, 'janaka.r@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 8, 1),
(9, 'Nimal@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 9, 1),
(10, 'nadeera@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 10, 1),
(11, 'chamari@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 11, 1);

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
-- Indexes for table `backup_details`
--
ALTER TABLE `backup_details`
  ADD PRIMARY KEY (`backup_id`);

--
-- Indexes for table `communication`
--
ALTER TABLE `communication`
  ADD PRIMARY KEY (`msg_id`);

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
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`quotation_id`);

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
-- AUTO_INCREMENT for table `backup_details`
--
ALTER TABLE `backup_details`
  MODIFY `backup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `communication`
--
ALTER TABLE `communication`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `freelancer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `freelancer_login`
--
ALTER TABLE `freelancer_login`
  MODIFY `freelancer_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_department`
--
ALTER TABLE `user_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
