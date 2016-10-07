-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2016 at 11:16 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_address`
--

CREATE TABLE `tbl_user_address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `barangay` varchar(50) NOT NULL,
  `house_number` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_contact`
--

CREATE TABLE `tbl_user_contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `contact_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_contact_type`
--

CREATE TABLE `tbl_user_contact_type` (
  `contact_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_department`
--

CREATE TABLE `tbl_user_department` (
  `dep_id` int(11) NOT NULL,
  `dep_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_department`
--

INSERT INTO `tbl_user_department` (`dep_id`, `dep_name`) VALUES
(1, 'administration'),
(2, 'human resource'),
(3, 'panasonic'),
(4, 'uniqlo'),
(5, 'web integration'),
(6, 'ecommerce');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_gender`
--

CREATE TABLE `tbl_user_gender` (
  `gender_id` int(11) NOT NULL,
  `gender` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_info`
--

CREATE TABLE `tbl_user_info` (
  `user_id` int(11) NOT NULL,
  `pos_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '2',
  `gender_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `profile_pic` varchar(50) NOT NULL,
  `attempt` int(11) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`user_id`, `pos_id`, `dep_id`, `status_id`, `gender_id`, `first_name`, `middle_name`, `last_name`, `email`, `user_name`, `user_password`, `profile_pic`, `attempt`, `date_created`) VALUES
(1, 1, 1, 1, 1, 'jegger', 'plaza', 'saren', 'jeggersaren@yahoo.com', 'jegger06', '21232f297a57a5a743894a0e4a801fc3 ', '', 0, '2016-10-06 07:00:51'),
(2, 4, 2, 2, 0, 'josie', '', 'dapin', 'petsie_bruidan@yahoo.com', 'josie29', '051156338f4f684383c1ce7baa66c386', '', 0, '2016-10-07 09:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_position`
--

CREATE TABLE `tbl_user_position` (
  `pos_id` int(11) NOT NULL,
  `pos_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_position`
--

INSERT INTO `tbl_user_position` (`pos_id`, `pos_name`) VALUES
(1, 'president'),
(2, 'senior manager'),
(3, 'manager'),
(4, 'associate');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_status`
--

CREATE TABLE `tbl_user_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_status`
--

INSERT INTO `tbl_user_status` (`status_id`, `status_name`) VALUES
(1, 'active'),
(2, 'inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user_address`
--
ALTER TABLE `tbl_user_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `tbl_user_contact`
--
ALTER TABLE `tbl_user_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_contact_type`
--
ALTER TABLE `tbl_user_contact_type`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `tbl_user_department`
--
ALTER TABLE `tbl_user_department`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `tbl_user_gender`
--
ALTER TABLE `tbl_user_gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_position`
--
ALTER TABLE `tbl_user_position`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `tbl_user_status`
--
ALTER TABLE `tbl_user_status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user_address`
--
ALTER TABLE `tbl_user_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user_contact`
--
ALTER TABLE `tbl_user_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user_contact_type`
--
ALTER TABLE `tbl_user_contact_type`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user_department`
--
ALTER TABLE `tbl_user_department`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_user_gender`
--
ALTER TABLE `tbl_user_gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_user_position`
--
ALTER TABLE `tbl_user_position`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_user_status`
--
ALTER TABLE `tbl_user_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
