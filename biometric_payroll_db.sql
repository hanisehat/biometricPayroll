-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 19 Okt 2018 pada 04.40
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `allowances`
--

CREATE TABLE `allowances` (
  `allowance_id` int(11) NOT NULL,
  `allowance_name` varchar(75) NOT NULL,
  `allowance_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `allowances`
--

INSERT INTO `allowances` (`allowance_id`, `allowance_name`, `allowance_status`) VALUES
(3, 'Holiday Allowances', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendances`
--

CREATE TABLE `attendances` (
  `attendance_id` int(11) NOT NULL,
  `attendance_employee` int(11) NOT NULL,
  `attendance_in` datetime NOT NULL,
  `attendance_out` datetime NOT NULL,
  `attendance_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `claims`
--

CREATE TABLE `claims` (
  `claim_id` int(11) NOT NULL,
  `claim_title` int(55) NOT NULL,
  `claim_description` text,
  `claim_picture` varchar(55) NOT NULL,
  `claim_user` int(11) NOT NULL,
  `claim_status` tinyint(1) NOT NULL,
  `claim_date` date NOT NULL,
  `claim_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
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
  `employee_phone` int(15) DEFAULT NULL,
  `employee_status` int(1) NOT NULL,
  `employee_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_username`, `employee_password`, `employee_picture`, `employee_position`, `employee_salary`, `employee_address`, `employee_idcard`, `employee_certificate`, `employee_birth`, `employee_phone`, `employee_status`, `employee_timestamp`) VALUES
(1, 'aaa', '', '77bf34b1fa8fa2658bfd77b900e147bd2332afac', 'files/employee_pictures/3c104bb7209a8b3464d59b5908b427bc.jpg', 3, 213123213, 'bekonang', 'files/employee_pictures/1b33af94073491883434d76a812b654a.jpg', NULL, '2018-08-09', 888, 1, '2018-10-19 02:38:32'),
(5, 'Andik2', 'andik', NULL, 'files/employee_pictures/5214729ae6d05b2706563b0786228b57.jpg', 3, 11111, 'ungaran2', 'files/employee_pictures/00acc4f9183db8d130dbc0149f7b897f.jpg', 'files/employee_pictures/09e61a66c66ad7890f83be8aae6c4889.jpg', '05/09/1990', 5456564, 1, '2018-09-03 04:23:09'),
(6, 'Jhony andrean', 'joni', '91010ab2791f95fcd50d52d8b32f5c756438c411', 'files/employee_pictures/3f71408ffccb266281320a62d2ef1d82.jpg', 3, 2312312, 'bubakan', 'files/employee_pictures/c84beca33b06c7938aff3a754de059ed.jpg', 'files/employee_pictures/8ba747c0f614518b9fd9400e2a84d4ad.jpg', '06/18/1990', 990890, 1, '2018-09-05 09:40:55'),
(7, 'jonen', 'haha', NULL, NULL, 3, 1232, 'dskljfljdsf', NULL, NULL, '09/19/2018', 123213, 1, '2018-09-04 09:07:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `leaves`
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
-- Dumping data untuk tabel `leaves`
--

INSERT INTO `leaves` (`leave_id`, `leave_employee`, `leave_message`, `leave_reply_message`, `leave_date_start`, `leave_date_end`, `leave_status`) VALUES
(1, 1, 'qweqwe', '', '09/09/2018', '09/10/2018', 1),
(2, 6, 'test', '', '07/09/2018', '08/09/2018', 1),
(3, 6, ' test', '', '07/09/2018', '08/09/2018', 1),
(4, 6, ' test', 'bad', '07/09/2018', '08/09/2018', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `positions`
--

CREATE TABLE `positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(55) NOT NULL,
  `position_priority` tinyint(1) NOT NULL,
  `position_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `positions`
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
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `email`, `password`, `role`, `status`) VALUES
(13, 'leon', 'Leon', 'leon@kerjaholic.com', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 1, 1),
(14, 'david', 'Davids', 'david@ds-estates.coms', 'aa743a0aaec8f7d7a1f01442503957f4d7a2d634', 2, 1);

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
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_id`);

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
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
