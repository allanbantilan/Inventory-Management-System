-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 07:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventoryms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `category` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `category`) VALUES
(31, 'System Unit'),
(32, 'Network Devices'),
(33, 'Mouse'),
(34, 'Monitor'),
(35, 'Printer'),
(36, 'Webcam'),
(37, 'Speaker'),
(45, 'Keyboard'),
(46, 'Table'),
(47, 'Chair'),
(52, 'Headset');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `historyID` int(11) NOT NULL,
  `serialNumberHis` varchar(24) NOT NULL,
  `typeHis` varchar(24) NOT NULL,
  `statusHis` varchar(24) NOT NULL,
  `dateAddedHis` date DEFAULT NULL,
  `dateDeletedHis` date DEFAULT NULL,
  `siteHis` varchar(64) NOT NULL,
  `descriptionHis` varchar(24) NOT NULL,
  `process` varchar(255) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `deletedBy` varchar(50) NOT NULL,
  `sub_category_his` varchar(255) NOT NULL,
  `item_mode_his` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `historysta`
--

CREATE TABLE `historysta` (
  `historyIDSTA` int(24) NOT NULL,
  `serialNumberHisSTA` int(24) NOT NULL,
  `typeHisSTA` varchar(24) NOT NULL,
  `statusHisSTA` varchar(24) NOT NULL,
  `dateAddedHisSTA` date NOT NULL,
  `dateDeletedHisSTA` date NOT NULL,
  `descriptionHisSTA` varchar(100) NOT NULL,
  `remarksSTA` varchar(100) NOT NULL,
  `deletedBySTA` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `historysta`
--

INSERT INTO `historysta` (`historyIDSTA`, `serialNumberHisSTA`, `typeHisSTA`, `statusHisSTA`, `dateAddedHisSTA`, `dateDeletedHisSTA`, `descriptionHisSTA`, `remarksSTA`, `deletedBySTA`) VALUES
(1, 123123123, 'Monitor', 'New', '2024-02-21', '2024-02-21', 'qe', 'test', 'Jerden Calag');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inv_id` int(24) NOT NULL,
  `serialNumber` varchar(24) NOT NULL,
  `type` varchar(24) NOT NULL,
  `status` varchar(24) NOT NULL,
  `dateAdded` date DEFAULT NULL,
  `site` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `inv_mode` varchar(255) NOT NULL,
  `sub_category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventorysta`
--

CREATE TABLE `inventorysta` (
  `inv_idSTA` int(24) NOT NULL,
  `serialNumberSTA` int(24) NOT NULL,
  `typeSTA` varchar(24) NOT NULL,
  `statusSTA` varchar(24) NOT NULL,
  `dateAddedSTA` date NOT NULL,
  `descriptionSTA` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventorysta`
--

INSERT INTO `inventorysta` (`inv_idSTA`, `serialNumberSTA`, `typeSTA`, `statusSTA`, `dateAddedSTA`, `descriptionSTA`) VALUES
(1, 1234, 'System Unit', 'Good', '2024-02-21', 'test4'),
(2, 1231232, 'Network Devices', 'Defective', '2024-02-21', 'test2'),
(3, 123123123, 'Monitor', 'New', '2024-02-21', 'qe'),
(4, 5315, 'Mouse', 'Good', '2024-02-23', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `issued_items`
--

CREATE TABLE `issued_items` (
  `items_id` int(23) NOT NULL,
  `item_serial_number` varchar(225) NOT NULL,
  `item_type` varchar(225) NOT NULL,
  `item_status` varchar(225) NOT NULL,
  `item_dateissued` date NOT NULL,
  `item_site` varchar(225) NOT NULL,
  `item_description` varchar(225) NOT NULL,
  `item_issued_to` varchar(225) NOT NULL,
  `sub_category_issue` varchar(255) NOT NULL,
  `item_mode_issue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `issued_items_log`
--

CREATE TABLE `issued_items_log` (
  `items_id_log` int(25) NOT NULL,
  `item_serial_number_log` varchar(255) NOT NULL,
  `item_type_log` varchar(255) NOT NULL,
  `item_status_log` varchar(25) NOT NULL,
  `item_dateissued_log` date NOT NULL,
  `item_site_log` varchar(255) NOT NULL,
  `item_description_log` varchar(255) NOT NULL,
  `item_issued_to_log` varchar(255) NOT NULL,
  `item_issued_by` varchar(255) NOT NULL,
  `item_issued_in_out` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issued_items_log`
--

INSERT INTO `issued_items_log` (`items_id_log`, `item_serial_number_log`, `item_type_log`, `item_status_log`, `item_dateissued_log`, `item_site_log`, `item_description_log`, `item_issued_to_log`, `item_issued_by`, `item_issued_in_out`) VALUES
(14, '54135', 'Headset', 'Good', '2024-02-01', 'Puan', 'test2         ', 'Nico Bugatti', ' Allan Bantilan', 'In'),
(15, '54135', 'Headset', 'Good', '2024-03-09', 'Puan', 'test2         ', 'Nico Bugatti', ' Allan Bantilan', 'Out'),
(16, '6314315', 'Headset', 'Good', '2024-03-11', 'Sta. Ana', 'test headset ', 'badenskie', ' Allan Bantilan', 'In'),
(17, '135315', 'Headset', 'Good', '2024-03-08', 'Sta. Ana', '351t  ', 'MIke ikaw akong kusog', ' Admin Admin', 'In'),
(18, '135315', 'Headset', 'Good', '2024-03-12', 'Sta. Ana', '351t  ', 'MIke ikaw akong kusog', ' Admin Admin', 'Out'),
(19, '692001', 'Headset', 'Good', '2024-03-11', 'Puan', 'kuyaw ', 'pelomar', ' Allan Bantilan', 'In');

-- --------------------------------------------------------

--
-- Table structure for table `modes_bp`
--

CREATE TABLE `modes_bp` (
  `mode_id` int(255) NOT NULL,
  `modes_borrow_purchase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modes_bp`
--

INSERT INTO `modes_bp` (`mode_id`, `modes_borrow_purchase`) VALUES
(1, 'Borrowed\r\n'),
(2, 'Purchased'),
(200, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `site_id` int(10) NOT NULL,
  `site_name` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`site_id`, `site_name`) VALUES
(7, 'Puan'),
(8, 'Sta. Ana');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `statusID` int(11) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusID`, `status`) VALUES
(22, 'Good'),
(24, 'Defective'),
(25, 'New');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_id` int(255) NOT NULL,
  `sub_category_name` varchar(244) NOT NULL,
  `sub_category_for` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_id`, `sub_category_name`, `sub_category_for`) VALUES
(7, 'Switches', 'Network Devices'),
(8, 'NUC', 'System Unit'),
(10, 'test', 'Network Devices'),
(200, 'N/A', 'System Unit');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(10) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` varchar(24) NOT NULL,
  `email` varchar(24) NOT NULL,
  `password` varchar(24) NOT NULL,
  `type` varchar(24) DEFAULT NULL,
  `online_status` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `email`, `password`, `type`, `online_status`) VALUES
(8, 'Allan', 'Bantilan', 'SplaceAdmin@gmail.com', 'allan123', 'admin', 1),
(9, 'test', 'test', 'test@test', 'test', 'audit', 0),
(10, 'test2', 'test2', 'test2@test', 'test', 'audit', 0),
(11, 'test', 'testaudit', 'audit@gmail.com', 'audittest', 'audit', 0),
(12, 'Allan', 'Bantilan', 'allan@gmail.com', 'test', 'user', 0),
(13, 'Rico', 'Balaga', 'rico@gmail.com', '12345', 'user', 0),
(14, 'Lawe', 'Goc-ong', 'lawepakers@gmail.com', 'lawe123', 'user', 0),
(111, 'Admin', 'Admin', 'admin@gmail.com', 'admin123', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `user_act_id` int(24) NOT NULL,
  `user_last_name` varchar(255) NOT NULL,
  `user_first_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_date_logged` datetime NOT NULL,
  `user_in_out` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`historyID`);

--
-- Indexes for table `historysta`
--
ALTER TABLE `historysta`
  ADD PRIMARY KEY (`historyIDSTA`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `inventorysta`
--
ALTER TABLE `inventorysta`
  ADD PRIMARY KEY (`inv_idSTA`);

--
-- Indexes for table `issued_items`
--
ALTER TABLE `issued_items`
  ADD PRIMARY KEY (`items_id`);

--
-- Indexes for table `issued_items_log`
--
ALTER TABLE `issued_items_log`
  ADD PRIMARY KEY (`items_id_log`);

--
-- Indexes for table `modes_bp`
--
ALTER TABLE `modes_bp`
  ADD PRIMARY KEY (`mode_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`statusID`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`user_act_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `historyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `historysta`
--
ALTER TABLE `historysta`
  MODIFY `historyIDSTA` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inv_id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `inventorysta`
--
ALTER TABLE `inventorysta`
  MODIFY `inv_idSTA` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issued_items`
--
ALTER TABLE `issued_items`
  MODIFY `items_id` int(23) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `issued_items_log`
--
ALTER TABLE `issued_items_log`
  MODIFY `items_id_log` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `modes_bp`
--
ALTER TABLE `modes_bp`
  MODIFY `mode_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `site_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `statusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `user_act_id` int(24) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
