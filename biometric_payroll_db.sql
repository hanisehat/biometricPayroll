-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 04:45 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biometric_payroll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE `allowances` (
  `allowance_id` int(11) NOT NULL,
  `allowance_name` varchar(75) NOT NULL,
  `allowance_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowances`
--

INSERT INTO `allowances` (`allowance_id`, `allowance_name`, `allowance_status`) VALUES
(3, 'Holiday Allowances', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `attendance_id` int(11) NOT NULL,
  `attendance_employee` int(11) NOT NULL,
  `attendance_in` varchar(50) NOT NULL,
  `attendance_out` varchar(50) DEFAULT '00/00/00 00:00:00',
  `attendance_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`attendance_id`, `attendance_employee`, `attendance_in`, `attendance_out`, `attendance_timestamp`) VALUES
(1, 1, '11/14/2018 10:39 AM', '11/14/2018 10:39 AM', '2018-11-14 03:39:54'),
(2, 2, '11/14/2018 10:39 AM', '11/14/2018 10:40 AM', '2018-11-14 03:40:11'),
(3, 3, '11/14/2018 10:38 AM', '11/14/2018 10:39 AM', '2018-11-14 03:39:46'),
(4, 4, '11/14/2018 10:41 AM', '11/14/2018 10:42 AM', '2018-11-14 03:42:11'),
(5, 5, '11/26/2018 11:13 AM', '11/26/2018 2:48 PM', '2018-11-27 02:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `bonuses`
--

CREATE TABLE `bonuses` (
  `bonus_id` int(20) NOT NULL,
  `bonus_type` varchar(100) NOT NULL,
  `bonus_amount` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bonuses`
--

INSERT INTO `bonuses` (`bonus_id`, `bonus_type`, `bonus_amount`) VALUES
(1, 'haha', '76554');

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `claim_id` int(11) NOT NULL,
  `claim_title` varchar(55) NOT NULL,
  `claim_description` text,
  `claim_picture` varchar(95) NOT NULL,
  `claim_user` varchar(55) NOT NULL,
  `claim_status` tinyint(1) NOT NULL,
  `claim_date` varchar(15) NOT NULL,
  `claim_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`claim_id`, `claim_title`, `claim_description`, `claim_picture`, `claim_user`, `claim_status`, `claim_date`, `claim_timestamp`) VALUES
(1, 'kk', 'whats', './files/claim_pictures/1e62ac7706625b93bdcc08759eb4ea4a--kartun-vektor.jpg', 'haa', 1, '11/12/2018', '2018-11-14 06:57:51'),
(2, 'aaa', 'hey!', './files/claim_pictures/20f9ac4c0ef2966194e3bc68890530b5.jpg', 'hasna', 1, '11/12/2018', '2018-11-14 04:06:20'),
(3, 'aaa', 'aa', './files/claim_pictures/muslim-bride-and-groom-cartoon-characters-illustration_2963-226.jpg', 'a', 1, '11/12/2018', '2018-11-14 04:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(51) NOT NULL,
  `employee_username` varchar(75) DEFAULT NULL,
  `employee_password` varchar(50) DEFAULT NULL,
  `employee_picture` varchar(95) DEFAULT NULL,
  `employee_position` int(11) NOT NULL,
  `employee_salary` int(11) NOT NULL,
  `employee_address` varchar(90) DEFAULT NULL,
  `employee_idcard` varchar(75) DEFAULT NULL,
  `employee_certificate` varchar(75) DEFAULT NULL,
  `employee_birth` varchar(15) DEFAULT NULL,
  `employee_start` varchar(15) NOT NULL,
  `employee_phone` int(15) DEFAULT NULL,
  `employee_status` int(1) NOT NULL,
  `employee_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_username`, `employee_password`, `employee_picture`, `employee_position`, `employee_salary`, `employee_address`, `employee_idcard`, `employee_certificate`, `employee_birth`, `employee_start`, `employee_phone`, `employee_status`, `employee_timestamp`) VALUES
(1, 'Andik2', 'andik', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'files/employee_pictures/31dfea34977d9450906152c7eb357d00.jpg', 3, 8889, 'ungaran2', 'files/employee_pictures/00acc4f9183db8d130dbc0149f7b897f.jpg', 'files/employee_pictures/09e61a66c66ad7890f83be8aae6c4889.jpg', '05/09/1990', '11/13/2018', 5456564, 1, '2018-11-26 03:25:11'),
(2, 'aaa', 'a', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'files/employee_pictures/3c104bb7209a8b3464d59b5908b427bc.jpg', 3, 213123213, 'bekonang', 'files/employee_pictures/1b33af94073491883434d76a812b654a.jpg', NULL, '2018-08-09', '10/31/2018', 888, 1, '2018-11-13 03:56:54'),
(3, 'Jhony andrean', 'joni', '91010ab2791f95fcd50d52d8b32f5c756438c411', 'files/employee_pictures/3f71408ffccb266281320a62d2ef1d82.jpg', 3, 2312312, 'bubakan', 'files/employee_pictures/c84beca33b06c7938aff3a754de059ed.jpg', 'files/employee_pictures/8ba747c0f614518b9fd9400e2a84d4ad.jpg', '06/18/1990', '09/11/2018', 990890, 1, '2018-11-26 07:28:57'),
(4, 'jonen', 'haha', NULL, NULL, 3, 1232, 'dskljfljdsf', NULL, NULL, '09/19/2018', '10/28/2018', 123213, 1, '2018-11-13 03:57:24'),
(5, 'hanif', 'hani', '8cb2237d0679ca88db6464eac60da96345513964', 'files/employee_pictures/77df4dfd50cc1edaf9fa318ec98402ab.jpg', 3, 56767, 'i', 'files/employee_pictures/53df430fac0014df6c78cd090336dc84.jpg', 'files/employee_pictures/d9f6ecb8f2f97db991661a980b901fcd.jpg', '05/09/1998', '11/08/2018', 7, 1, '2018-11-26 07:43:27'),
(6, 'b', 'b', '29ccba6066c8e8f899a66128e9a3d4ad9dee1353', 'files/employee_pictures/18739999876f8823f58c1fe9481e74d9.jpg', 3, 44444333, 'smg', NULL, NULL, '05/18/1999', '11/13/2018', 89, 0, '2018-11-27 09:09:13'),
(7, 'a', 'ad', '29ccba6066c8e8f899a66128e9a3d4ad9dee1353', 'files/employee_pictures/c3fef7c97b10dbebac2321db60b185a5.jpg', 3, 43333, 'smg', NULL, NULL, '10/30/2018', '11/28/2018', 5444, 1, '2018-11-28 02:41:23');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `leave_id` int(11) NOT NULL,
  `leave_employee` int(11) DEFAULT NULL,
  `leave_message` tinytext,
  `leave_reply_message` tinytext NOT NULL,
  `leave_date_start` varchar(15) DEFAULT NULL,
  `leave_date_end` varchar(15) DEFAULT NULL,
  `leave_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`leave_id`, `leave_employee`, `leave_message`, `leave_reply_message`, `leave_date_start`, `leave_date_end`, `leave_status`) VALUES
(1, 1, 'qweqwe', '', '09/09/2018', '09/10/2018', 1),
(2, 3, ' ', '', '14/11/2018', '21/11/2018', 1),
(3, 2, NULL, '', '19/05/2018', '23/09/2019', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(20) NOT NULL,
  `payment_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_type`) VALUES
(1, 'Cash'),
(2, 'Paycheck'),
(3, 'Direct Deposit'),
(5, ' 	Payroll Cards');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(55) NOT NULL,
  `position_priority` tinyint(1) NOT NULL,
  `position_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`, `position_priority`, `position_status`) VALUES
(3, 'CEO', 1, 1),
(4, 'HR Manager', 3, 1),
(5, 'Security', 4, 1),
(6, 'Developer', 4, 1),
(7, 'Branch Manager', 2, 1),
(10, 'Sales', 4, 1),
(11, 'Secretary', 3, 1),
(12, 'Administrator', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(35) NOT NULL,
  `report_employee` int(100) NOT NULL,
  `report_start` int(30) NOT NULL,
  `report_salary` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `report_employee`, `report_start`, `report_salary`) VALUES
(1, 5, 0, 5),
(3, 3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `salary_id` int(20) NOT NULL,
  `salary_name` int(60) NOT NULL,
  `salary_amount` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`salary_id`, `salary_name`, `salary_amount`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(21, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(222) NOT NULL,
  `name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `role` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `email`, `password`, `role`, `status`) VALUES
(13, 'leon', 'Leon', 'leon@kerjaholic.com', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 1, 1),
(14, 'david', 'Davids', 'david@ds-estates.coms', 'aa743a0aaec8f7d7a1f01442503957f4d7a2d634', 2, 1),
(16, 'hanif', 'haniaa', 'hanialifia2@gmail.com', '51eac6b471a284d3341d8c0c63d0f1a286262a18', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
  ADD PRIMARY KEY (`allowance_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD PRIMARY KEY (`bonus_id`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`claim_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `allowance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `bonus_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(35) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `salary_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
