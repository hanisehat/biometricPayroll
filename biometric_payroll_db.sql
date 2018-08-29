-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Agu 2018 pada 05.38
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
  `employee_picture` varchar(55) DEFAULT NULL,
  `employee_position` int(11) NOT NULL,
  `employee_salary` int(11) NOT NULL,
  `employee_address` varchar(90) DEFAULT NULL,
  `employee_idcard` varchar(75) DEFAULT NULL,
  `employee_certificate` varchar(75) DEFAULT NULL,
  `employee_birth` date DEFAULT NULL,
  `employee_phone` int(15) DEFAULT NULL,
  `employee_status` int(1) NOT NULL,
  `employee_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_picture`, `employee_position`, `employee_salary`, `employee_address`, `employee_idcard`, `employee_certificate`, `employee_birth`, `employee_phone`, `employee_status`, `employee_timestamp`) VALUES
(1, 'John Immanuel Johansson', 'files/employee_picturesf6a7843a2364cad8ca6c8f4bd94ab88e', 1, 213123213, 'bekonang', NULL, NULL, '2018-08-09', 888, 0, '2018-08-27 11:07:44'),
(2, '', NULL, 1, 0, '', NULL, NULL, NULL, 0, 1, '2018-08-28 04:35:56'),
(3, '', NULL, 1, 0, '', NULL, NULL, NULL, 0, 1, '2018-08-28 04:48:19'),
(4, 'John Tyler', 'files/employee_pictures/5c16e14b71f2357cbb6782e594d389d', 1, 232132, 'banaran', NULL, NULL, NULL, 645632, 1, '2018-08-28 06:40:26'),
(5, 'Andik', 'files/employee_pictures/e6dd20c2d73cc615b6380a9d11dc018', 1, 324324, 'ungaran', NULL, NULL, NULL, 123123, 1, '2018-08-28 07:07:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `positions`
--

CREATE TABLE `positions` (
  `position_id` int(11) NOT NULL,
  `position_name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `positions`
--

INSERT INTO `positions` (`position_id`, `position_name`) VALUES
(1, 'CEO');

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
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `position_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
