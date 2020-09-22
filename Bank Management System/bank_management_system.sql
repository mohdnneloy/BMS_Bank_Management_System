-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2020 at 02:00 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank management system`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Acc_No` bigint(20) NOT NULL,
  `Customer_ID` bigint(20) NOT NULL,
  `Acc_Type` varchar(20) DEFAULT NULL,
  `Acc_Bal` double(9,2) DEFAULT 500.00,
  `Trans_Limit` double(7,2) DEFAULT 50000.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Acc_No`, `Customer_ID`, `Acc_Type`, `Acc_Bal`, `Trans_Limit`) VALUES
(202000000000, 20000001, 'Savings', 500.00, 50000.00),
(202000000001, 20000002, 'Current', 500.00, 50000.00),
(202000000002, 20000003, 'Fixed Deposit', 500.00, 50000.00);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` bigint(20) NOT NULL,
  `Fname` varchar(20) DEFAULT NULL,
  `LName` varchar(20) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `Birth_Date` date DEFAULT NULL,
  `Occupation` varchar(30) DEFAULT NULL,
  `Phone_No` varchar(11) DEFAULT NULL,
  `Street_Add` varchar(60) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Country` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Fname`, `LName`, `Email`, `Password`, `Gender`, `Birth_Date`, `Occupation`, `Phone_No`, `Street_Add`, `City`, `State`, `Country`) VALUES
(20000001, 'Mohammad', 'Neloy', 'neloy1998@gmail.com', 'e2fc714c4727ee9395f324cd2e7f331f', 'M', '1998-11-05', 'Student', '01642259644', '261/1, Bashundhara Gate', 'Dhaka', 'North Dhaka', 'Bangladesh'),
(20000002, 'Tammam', 'Haque', 'tammam.haque@northsouth.edu', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1998-03-12', 'Student', '01685523255', '44/7 Gulshan -2', 'Dhaka', 'North Dhaka', 'Bangladesh'),
(20000003, 'Md', 'Faisal', 'mdfaisal@gmail.com', '6562c5c1f33db6e05a082a88cddab5ea', 'M', '1998-10-22', 'Teacher', '01548895322', 'House No - 15, Commisioner Goli', 'Dhaka', 'South Dhaka', 'Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_ID` bigint(20) NOT NULL,
  `Fname` varchar(20) DEFAULT NULL,
  `LName` varchar(20) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `Birth_Date` date DEFAULT NULL,
  `Occupation` varchar(30) DEFAULT NULL,
  `Phone_No` varchar(11) DEFAULT NULL,
  `Street_Add` varchar(60) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Country` varchar(30) DEFAULT NULL,
  `Designation` varchar(30) DEFAULT 'N/A',
  `Salary` double(8,2) DEFAULT 0.00,
  `Work_Limit` int(6) DEFAULT 0,
  `Manager_ID` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Employee_ID`, `Fname`, `LName`, `Email`, `Password`, `Gender`, `Birth_Date`, `Occupation`, `Phone_No`, `Street_Add`, `City`, `State`, `Country`, `Designation`, `Salary`, `Work_Limit`, `Manager_ID`) VALUES
(2020000000, 'Mohammad', 'Neloy', 'neloy1998@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '1998-07-16', 'Bank Employee', '01816652566', '44/1 Sector-6', 'Uttara', 'North Dhaka', 'Bangladesh', 'Manager', 40000.00, 40, 0),
(2020000001, 'Tammam', 'Haque', 'tammam1998@gmail.com', '6562c5c1f33db6e05a082a88cddab5ea', 'M', '2012-06-22', 'Bank Employee', '01815520511', '56/7 Gulshan -2', 'Dhaka', 'North Dhaka', 'Bangladesh', 'Deputy Manager', 30000.00, 30, 2020000000),
(2020000002, 'Rafid', 'Ahmed', 'rafid.ahmed@gmail.com', 'e2fc714c4727ee9395f324cd2e7f331f', 'M', '2000-07-06', 'Bank Employee', '01615523699', 'House - 55, Commisioner Goli', 'Dhaka', 'South Dhaka', 'Bangladesh', 'Cashier', 10000.00, 30, 2020000001);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `Trans_ID` bigint(20) NOT NULL,
  `Trans_From` bigint(20) NOT NULL,
  `Trans_To` bigint(20) NOT NULL,
  `Amount` double(9,2) DEFAULT NULL,
  `Trans_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`Trans_ID`, `Trans_From`, `Trans_To`, `Amount`, `Trans_Date`) VALUES
(100000000, 202000000000, 202000000001, 500.00, '2020-09-22'),
(100000001, 202000000000, 202000000001, 200.00, '2020-09-22'),
(100000002, 202000000001, 202000000000, 200.00, '2020-09-22'),
(100000003, 202000000001, 202000000000, 500.00, '2020-09-22');

-- --------------------------------------------------------

--
-- Table structure for table `work_tracker`
--

CREATE TABLE `work_tracker` (
  `Employee_ID` bigint(20) NOT NULL,
  `SignIn_Time` time NOT NULL,
  `SignOut_Time` time DEFAULT NULL,
  `Work_Date` date NOT NULL,
  `Working_Hours` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_tracker`
--

INSERT INTO `work_tracker` (`Employee_ID`, `SignIn_Time`, `SignOut_Time`, `Work_Date`, `Working_Hours`) VALUES
(2020000000, '05:46:03', '05:47:13', '2020-09-22', '0.0'),
(2020000000, '05:47:18', '05:47:28', '2020-09-22', '0.0'),
(2020000000, '05:55:07', '05:55:14', '2020-09-22', '0.0'),
(2020000000, '05:59:56', '06:00:10', '2020-09-22', '0.0'),
(2020000001, '05:50:35', '05:50:44', '2020-09-22', '0.0'),
(2020000001, '05:55:21', '05:55:40', '2020-09-22', '0.0'),
(2020000001, '05:58:00', '05:58:11', '2020-09-22', '0.0'),
(2020000001, '05:59:23', '05:59:43', '2020-09-22', '0.0'),
(2020000002, '05:52:02', '05:52:23', '2020-09-22', '0.0'),
(2020000002, '05:56:30', '05:57:51', '2020-09-22', '0.0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Acc_No`),
  ADD KEY `Customer_ID` (`Customer_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Employee_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`Trans_ID`);

--
-- Indexes for table `work_tracker`
--
ALTER TABLE `work_tracker`
  ADD PRIMARY KEY (`Employee_ID`,`SignIn_Time`,`Work_Date`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`);

--
-- Constraints for table `work_tracker`
--
ALTER TABLE `work_tracker`
  ADD CONSTRAINT `work_tracker_ibfk_1` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
