-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 192.168.1.101
-- Generation Time: Nov 21, 2020 at 12:30 AM
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
(11, 1, 891183605949, 'Backup done by Damith Menaka', '2020-11-05 19:21:16'),
(12, 1, 476953448281, 'Backup done by Damith Menaka', '2020-11-19 18:13:18');

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
(13, 1, 2, 'Ok. wait a minutes.', '2020-10-30 16:18:37', 1),
(14, 1, 2, 'Whats is your tomorrow plans  ?', '2020-10-30 16:22:53', 1),
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
(2, 'Dhanushka', 'Lakshan', 'dhanushka.lakshan@gmail.com', 'Sri Lanka', '1994-05-25', 0, '0778965925', '1604780980_profile-pic.png', '2020-07-01 19:04:31', '2020-11-17 14:37:03', 1),
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
(1, 'Imesha', 'De Silva', 'imesha.desilva@gmail.com', 'Sri Lanka', '1988-10-25', 1, '0776592630', '1604782839_1596442575_F8.png', '2020-07-28 13:17:00', '2020-11-19 15:39:40', 1),
(2, 'Ashen', 'Udithamal', 'udithamal.lk@gmail.com', 'Sri Lanka', '1995-03-16', 0, '0712758810', '1604143768_K8.jpg', '2020-10-31 16:59:28', '2020-11-19 15:39:48', 1),
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
-- Table structure for table `freelancer_marks`
--

CREATE TABLE `freelancer_marks` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `marks` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(2) NOT NULL DEFAULT 0 COMMENT '0-active, 1-inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freelancer_marks`
--

INSERT INTO `freelancer_marks` (`id`, `group_id`, `freelancer_id`, `marks`, `created_at`, `status`) VALUES
(1, 1, 1, 100, '2020-11-18 19:57:54', 0),
(2, 2, 1, 80, '2020-11-18 19:59:48', 0),
(3, 1, 2, 100, '2020-11-19 13:43:31', 0),
(4, 2, 2, 80, '2020-11-19 14:01:30', 0),
(5, 3, 2, 60, '2020-11-19 14:19:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `freelancer_tools`
--

CREATE TABLE `freelancer_tools` (
  `id` int(11) NOT NULL,
  `tool_id` int(11) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 0 COMMENT '0-requested, 1-access given, 2-access denied '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `freelancer_tools`
--

INSERT INTO `freelancer_tools` (`id`, `tool_id`, `freelancer_id`, `user_name`, `password`, `status`) VALUES
(1, 1, 1, 'imasha', '123', 1),
(2, 2, 1, 'imeshapr', 'lm3#ApR', 1),
(3, 1, 2, NULL, NULL, 0),
(4, 2, 2, 'ashen', '@sh3NPr', 1),
(5, 3, 1, NULL, NULL, 0);

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
(4, 4, 2, 'Pay this', '15000.00', '0.00', NULL, '2020-11-12 16:41:15', NULL, 1, 0),
(5, 10, 3, 'Pay advanced before next week', '6500.00', '6500.00', 'PayPal', '2020-11-14 10:58:53', '2020-11-14 10:59:42', 2, 1),
(6, 13, 6, 'Use paypal method', '60000.00', '60000.00', 'PayPal', '2020-11-15 08:24:04', '2020-11-15 08:25:12', 2, 1);

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
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `project_timeline` int(2) NOT NULL DEFAULT 0 COMMENT 'o-pending,1-completed',
  `project_status` int(11) NOT NULL DEFAULT 0 COMMENT '0-active, 1-deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `description`, `quotation_id`, `customer_id`, `project_manager_id`, `freelancer_id`, `start_date`, `end_date`, `created_time`, `project_timeline`, `project_status`) VALUES
(1, 'Logo Design', 'Use suitable freelancer', 1, 2, 2, NULL, '2020-11-15', '2020-11-29', '2020-11-12 16:25:28', 0, 1),
(2, 'Graphical Contest', 'This is the biggest in summer ', 2, 2, 6, NULL, '2020-11-29', '2020-12-12', '2020-11-12 16:46:40', 0, 0),
(3, 'Email 2000 Send', 'Use One freelancer', 10, 3, 9, 1, '2020-11-14', '2020-12-12', '2020-11-14 11:02:31', 0, 0),
(4, 'Find 5000 advertisement ', 'Please complete as soon as possible', 13, 6, 9, 2, '2020-11-15', '2020-12-06', '2020-11-15 08:27:19', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `question` varchar(1000) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0 COMMENT '0-active, 1-inactive	'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `group_id`, `question`, `status`) VALUES
(1, 1, 'The PC keyboard command for turning on the ruler in PhotoShop is?', 0),
(2, 1, 'A color of a triadic color scheme with red-violet in it is', 0),
(3, 1, 'Vector based graphic work is', 0),
(4, 1, 'What is the single most powerful tool of tradigital design?', 0),
(5, 1, 'A triadic partner for yellow is', 0),
(6, 2, 'What is the major purpose of social media metrics?', 0),
(7, 2, 'Reddit, Delicious and Digg are examples of...', 0),
(8, 2, 'Which of the following is the first step to creating an effective strategy?', 0),
(9, 2, 'What is the function of the awareness metrics?', 0),
(10, 2, 'Which of the following is the best for new brands?', 0),
(11, 3, 'What does SEO Stand for?', 0),
(12, 3, 'What is SEO?', 0),
(13, 3, 'What is the \"secret recipe\" for turning websites into search results?', 0),
(14, 3, 'What are some of the ingredients in a search algorithm?', 0),
(15, 3, 'What does a site need to be considered a Reputable Site?', 0),
(16, 4, 'Animating \"straight ahead action\" is', 0),
(17, 4, 'Who is this Warner Brother creation?', 0),
(18, 4, 'What is this type of sound that is characterized by two speakers?', 0),
(19, 4, 'What is the dominant video effect used in this frame?', 0),
(20, 4, 'What is the dominant video effect in this current frame?', 0),
(21, 5, 'Identify this Cable', 0),
(22, 5, 'Frequency is ...', 0),
(23, 5, 'Speed of Sound equals', 0),
(24, 5, 'Responsible for recording film/video production Sound', 0),
(25, 5, 'Recreated by people matching live sound to the video in real time', 0),
(26, 6, 'What is Wordpress?', 0),
(27, 6, 'What is bluehost?', 0),
(28, 6, 'Alt Text......', 0),
(29, 6, 'Which data structure uses LIFO?', 0),
(30, 6, 'A memory location that holds a single letter or number', 0),
(31, 7, 'Paypal is an example of', 0),
(32, 7, 'Who offer intangible products, value, and convenience to consumers?', 0),
(33, 7, '________ is people who grew up during the digital revolution', 0),
(34, 7, 'Buying and Selling the products over the Internet is called', 0),
(35, 7, 'Cyworld is a(n) ________ site emerging from South Korea', 0),
(36, 8, 'A cell can contain the following:', 0),
(37, 8, 'A spreadsheet is a software program that allows one to:', 0),
(38, 8, 'All money amounts should be formatted to how many decimal places?', 0),
(39, 8, 'Page margins are:', 0),
(40, 8, 'A bullet is:', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions_group`
--

CREATE TABLE `questions_group` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `color_class` varchar(20) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0 COMMENT '0-active, 1-inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions_group`
--

INSERT INTO `questions_group` (`group_id`, `group_name`, `color_class`, `status`) VALUES
(1, 'Graphic & Design', 'btn-pink', 0),
(2, 'Social Media Marketing', 'btn-primary', 0),
(3, 'SEO', 'btn-danger', 0),
(4, 'Video & Animation', 'btn-purple', 0),
(5, 'Music & Audio', 'btn-success', 0),
(6, 'Programming', 'btn-warning', 0),
(7, 'E-commerce', 'btn-brown', 0),
(8, 'Word/Excel', 'btn-info', 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_answers`
--

CREATE TABLE `question_answers` (
  `answers_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answers` varchar(200) NOT NULL,
  `is_correct` int(2) NOT NULL COMMENT '1-correct, 0-incorrect',
  `status` int(2) NOT NULL DEFAULT 0 COMMENT '0-active, 1-inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_answers`
--

INSERT INTO `question_answers` (`answers_id`, `question_id`, `answers`, `is_correct`, `status`) VALUES
(5, 1, 'Option R', 7, 0),
(6, 1, 'Command r', 5, 0),
(7, 1, 'Shift R', 6, 0),
(8, 1, 'Control r', 1, 0),
(9, 2, 'Orange', 8, 0),
(10, 2, 'Green', 4, 0),
(11, 2, 'Blue-green', 1, 0),
(12, 2, 'Red-orange', 3, 0),
(13, 3, 'Limited by large file sizes', 9, 0),
(14, 3, 'Scalable', 1, 0),
(15, 3, 'Used by most digital photographers', 3, 0),
(16, 3, 'Only used in Flash and PhotoShop', 9, 0),
(17, 4, 'Layers', 1, 0),
(18, 4, 'CMYK', 5, 0),
(19, 4, 'PhotoShop', 9, 0),
(20, 4, 'Illustrators', 8, 0),
(21, 5, 'Green', 3, 0),
(22, 5, 'Violet', 4, 0),
(23, 5, 'Blue', 1, 0),
(24, 5, 'Magenta', 3, 0),
(25, 6, 'They give accurate number of engagements', 2, 0),
(26, 6, 'They make it easy to track constant engages', 8, 0),
(27, 6, 'They demonstrate the value and impacts of decisions made', 1, 0),
(28, 6, 'They prevent vanity metrics', 8, 0),
(29, 7, 'Social Bookmarking Sites', 1, 0),
(30, 7, 'Online Video Sharing sites', 4, 0),
(31, 7, 'Blog Platforms', 5, 0),
(32, 7, 'Wikis', 2, 0),
(33, 8, 'Lobbying', 2, 0),
(34, 8, 'Establishing objectives', 1, 0),
(35, 8, 'Attainability', 4, 0),
(36, 8, 'Setting time', 9, 0),
(37, 9, 'It illuminates current and potential audience', 1, 0),
(38, 9, 'It helps marketers know the next step', 3, 0),
(39, 9, 'It solidifies loyal advocates', 2, 0),
(40, 9, 'It ensures feedback from customers', 6, 0),
(41, 10, 'Telegram', 7, 0),
(42, 10, 'Twitter', 6, 0),
(43, 10, 'Pinterest', 7, 0),
(44, 10, 'Instagram', 1, 0),
(45, 11, 'Search Engine Optimization', 1, 0),
(46, 11, 'Search Engine Optimizing', 7, 0),
(47, 11, 'Search Equity Otego', 4, 0),
(48, 11, 'Search Engine Options', 6, 0),
(49, 12, 'A way to increase traffic on your website', 9, 0),
(50, 12, 'A process to improve the visibility of your website on search engines', 1, 0),
(51, 12, 'A Coding Language', 8, 0),
(52, 12, 'Something Extremely Offensive', 4, 0),
(53, 13, 'Keywords', 2, 0),
(54, 13, 'Meta Tags', 3, 0),
(55, 13, 'Algorithm', 1, 0),
(56, 13, 'Search Engines', 2, 0),
(57, 14, 'Keywords, Titles, Links, Words in Links, Reputation', 1, 0),
(58, 14, 'Titles, Links, Word Stuffing, Social Media, Traffic', 6, 0),
(59, 14, 'Keywords, Links, Search Engines, Search Results', 8, 0),
(60, 14, 'Keywords, Anchor Text, Brown Sugar, Flour', 4, 0),
(61, 15, 'Consistent and Engaging Content', 3, 0),
(62, 15, 'Fresh Content', 8, 0),
(63, 15, 'Growing Numbers of Quality Links', 8, 0),
(64, 15, 'All of the Above', 1, 0),
(65, 16, 'Drawing the animation one frame at a time', 1, 0),
(66, 16, 'When a character walks straight', 6, 0),
(67, 16, 'Drawing the animation one keyframe at a time', 6, 0),
(68, 16, 'Drawing straight lines', 8, 0),
(69, 17, 'The Little Black boy', 4, 0),
(70, 17, 'Bosko', 1, 0),
(71, 17, 'Bimbo', 3, 0),
(72, 17, 'Jhon', 8, 0),
(73, 18, 'Mono', 8, 0),
(74, 18, '5.1', 7, 0),
(75, 18, 'Stereo', 1, 0),
(76, 18, 'Dolby Surround', 7, 0),
(77, 19, 'Chroma key', 5, 0),
(78, 19, 'Color key', 9, 0),
(79, 19, 'Luma key', 1, 0),
(80, 19, 'Ghost key', 5, 0),
(81, 20, 'Lighting', 5, 0),
(82, 20, 'Lightning', 1, 0),
(83, 20, 'Lens flare', 8, 0),
(84, 20, 'Thunder bolt', 8, 0),
(85, 21, 'XLR', 1, 0),
(86, 21, 'RCA', 8, 0),
(87, 21, 'BNC', 4, 0),
(88, 21, 'Mini', 5, 0),
(89, 22, 'Pitch', 1, 0),
(90, 22, 'Sound', 4, 0),
(91, 22, 'Volume', 3, 0),
(92, 22, 'Decibel', 8, 0),
(93, 23, '1130 ft per second', 1, 0),
(94, 23, '1130 ft per decible', 5, 0),
(95, 23, '1130 miles per minute', 8, 0),
(96, 23, '1150 ft per minute', 6, 0),
(97, 24, 'Production Sound Mixer', 1, 0),
(98, 24, 'Boom Operator', 7, 0),
(99, 24, 'Cable Utility Guy', 6, 0),
(100, 24, 'Audio Collector', 9, 0),
(101, 25, 'ADR', 7, 0),
(102, 25, 'Field Recording', 7, 0),
(103, 25, 'Foley Sound', 1, 0),
(104, 25, 'Sound Design', 6, 0),
(105, 26, 'It is a social media management tool', 8, 0),
(106, 26, 'It is a customer relationship management tool', 6, 0),
(107, 26, 'It is a content management system', 1, 0),
(108, 26, 'It is an online conferencing tool', 9, 0),
(109, 27, 'A content management tool', 5, 0),
(110, 27, 'A Theme', 3, 0),
(111, 27, 'Hosting Account', 1, 0),
(112, 27, 'Project Management Tool', 5, 0),
(113, 28, 'Is the caption for the image', 7, 0),
(114, 28, 'Shows when the page loads properly', 3, 0),
(115, 28, 'Shows when a picture doesn\'t load properly', 1, 0),
(116, 28, 'Is a place where we can link another page', 7, 0),
(117, 29, 'Array', 9, 0),
(118, 29, 'Int', 8, 0),
(119, 29, 'Stacks', 1, 0),
(120, 29, 'Queues', 4, 0),
(121, 30, 'Double', 2, 0),
(122, 30, 'Int', 3, 0),
(123, 30, 'Char', 1, 0),
(124, 30, 'Word', 7, 0),
(125, 31, 'Financial cybermediary', 1, 0),
(126, 31, 'Digital wallet', 9, 0),
(127, 31, 'Electronic payment', 9, 0),
(128, 31, 'Electronic check', 6, 0),
(129, 32, 'Internet Marketers', 3, 0),
(130, 32, 'Service Providers', 1, 0),
(131, 32, 'Value Providers', 5, 0),
(132, 32, 'Affiliate Marketers', 4, 0),
(133, 33, 'Push', 5, 0),
(134, 33, 'Public key', 5, 0),
(135, 33, 'Digital natives', 1, 0),
(136, 33, 'Screenagers', 6, 0),
(137, 34, 'Electronic Market', 5, 0),
(138, 34, 'Electronic Commerce', 1, 0),
(139, 34, 'E-Shopping', 5, 0),
(140, 34, 'None of the above', 8, 0),
(141, 35, 'Web shopping', 9, 0),
(142, 35, 'Social networking', 1, 0),
(143, 35, 'Music downloading', 4, 0),
(144, 35, 'None of these', 5, 0),
(145, 36, 'Number', 5, 0),
(146, 36, 'Formula', 2, 0),
(147, 36, 'Text', 2, 0),
(148, 36, 'All of the above', 1, 0),
(149, 37, 'Organize data', 9, 0),
(150, 37, 'Calculate answers', 7, 0),
(151, 37, 'Chart data', 6, 0),
(152, 37, 'All of the above', 1, 0),
(153, 38, 'One', 9, 0),
(154, 38, 'Two', 1, 0),
(155, 38, 'Zero', 8, 0),
(156, 38, 'It depends', 2, 0),
(157, 39, 'Exact middle of page', 8, 0),
(158, 39, 'Where page numbers are', 2, 0),
(159, 39, '1 and 1/2 inches at top of page', 7, 0),
(160, 39, 'Blank areas around the top, bottom and sides of a page', 1, 0),
(161, 40, 'Something you use with a knife', 5, 0),
(162, 40, 'A small character that appears before an item in a document', 1, 0),
(163, 40, 'A dash', 9, 0),
(164, 40, 'A period', 5, 0);

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
(9, 2, 'Sticker Offset out', 'Bulk size is 12', NULL, '2020-11-11 19:15:34', '2020-11-11 19:15:34', 1),
(10, 3, 'Email 2000 Send', 'Send 2000 emails before 10/12/2020', 'We can send it', '2020-11-14 10:49:32', '2020-11-14 10:49:32', 3),
(11, 3, 'TV commercial ', 'Computer shop advertisement ', NULL, '2020-11-14 10:50:41', '2020-11-14 10:50:41', 1),
(12, 3, 'Cricket Campaign ', 'Need a best Organizer', NULL, '2020-11-14 10:52:37', '2020-11-14 10:52:37', 1),
(13, 6, 'Find 5000 advertisement ', 'find advertisement for my by and sell web site', 'We can settle it', '2020-11-15 08:15:35', '2020-11-15 08:15:35', 3);

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
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(250) NOT NULL,
  `project_id` int(11) NOT NULL,
  `priority_level` int(2) NOT NULL DEFAULT 0 COMMENT '	1-Normal, 2-Urgent, 3-Top Urgent	',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `task_timeline` int(2) NOT NULL DEFAULT 0 COMMENT '0-pending, 1-completed',
  `task_status` int(2) NOT NULL DEFAULT 0 COMMENT '0-active, 1-delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `project_id`, `priority_level`, `start_date`, `end_date`, `assigned_at`, `task_timeline`, `task_status`) VALUES
(1, 'Create 100 emails', 3, 2, '2020-11-14', '2020-11-16', '2020-11-14 15:15:34', 1, 0),
(2, 'Send 1st 100 emails', 3, 1, '2020-11-16', '2020-11-18', '2020-11-14 17:46:22', 0, 0),
(3, 'Find vehicle advertisement', 4, 3, '2020-11-15', '2020-11-19', '2020-11-15 08:30:41', 0, 0),
(4, 'Find land advertisement', 4, 1, '2020-11-16', '2020-11-23', '2020-11-15 08:34:20', 0, 0),
(5, 'Create 50 emails', 3, 1, '2020-11-18', '2020-11-24', '2020-11-15 09:30:57', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE `tools` (
  `tool_id` int(11) NOT NULL,
  `tool_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `website` varchar(200) NOT NULL,
  `tool_image` varchar(200) NOT NULL,
  `tool_status` int(11) NOT NULL DEFAULT 0 COMMENT '0-active, 1-inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`tool_id`, `tool_name`, `category_id`, `website`, `tool_image`, `tool_status`) VALUES
(1, 'Ilustrator Pro Package ', 1, 'https://www.adobe.com', '1605633462_adobe-ai.png', 0),
(2, 'Premiere Pro  ', 2, 'https://www.adobe.com', '1605633400_adobe-pr.png', 0),
(3, 'Gmail Optimizer', 5, 'https://www.mail.google.com', '1605636370_gmail.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tool_category`
--

CREATE TABLE `tool_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_status` int(2) NOT NULL DEFAULT 0 COMMENT '0-active, 1-inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tool_category`
--

INSERT INTO `tool_category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Graphic Design', 0),
(2, 'Video & Animation', 0),
(3, 'Search Engine Optimization', 0),
(4, 'Social Media Marketing', 0),
(5, 'Email Marketing', 0),
(6, 'Photography Services', 0);

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
-- Indexes for table `freelancer_marks`
--
ALTER TABLE `freelancer_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `freelancer_tools`
--
ALTER TABLE `freelancer_tools`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `questions_group`
--
ALTER TABLE `questions_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `question_answers`
--
ALTER TABLE `question_answers`
  ADD PRIMARY KEY (`answers_id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`quotation_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tools`
--
ALTER TABLE `tools`
  ADD PRIMARY KEY (`tool_id`);

--
-- Indexes for table `tool_category`
--
ALTER TABLE `tool_category`
  ADD PRIMARY KEY (`category_id`);

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
  MODIFY `backup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `freelancer_marks`
--
ALTER TABLE `freelancer_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `freelancer_tools`
--
ALTER TABLE `freelancer_tools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `questions_group`
--
ALTER TABLE `questions_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `question_answers`
--
ALTER TABLE `question_answers`
  MODIFY `answers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tools`
--
ALTER TABLE `tools`
  MODIFY `tool_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tool_category`
--
ALTER TABLE `tool_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
