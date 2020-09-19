-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2020 at 07:53 PM
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
  `Acc_Bal` double(9,2) DEFAULT NULL,
  `Trans_Limit_Monthly` double(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `Card_No` int(6) NOT NULL,
  `Customer_ID` bigint(20) NOT NULL,
  `Card_Name` varchar(20) DEFAULT NULL,
  `Card_Type` varchar(20) DEFAULT NULL,
  `Expiry_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` bigint(20) NOT NULL,
  `Fname` varchar(20) DEFAULT NULL,
  `LName` varchar(20) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `Birth_Date` date DEFAULT NULL,
  `Occupation` varchar(30) DEFAULT NULL,
  `Phone_No` varchar(11) DEFAULT NULL,
  `Street_Add` varchar(60) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Country` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Employee_ID` bigint(20) NOT NULL,
  `Fname` varchar(20) DEFAULT NULL,
  `LName` varchar(20) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `Birth_Date` date DEFAULT NULL,
  `Occupation` varchar(30) DEFAULT NULL,
  `Phone_No` varchar(11) DEFAULT NULL,
  `Street_Add` varchar(60) DEFAULT NULL,
  `City` varchar(20) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `Country` varchar(30) DEFAULT NULL,
  `Designation` varchar(30) DEFAULT NULL,
  `Salary` double(8,2) DEFAULT NULL,
  `Work_Limit` int(6) DEFAULT NULL,
  `Manager_ID` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `performs`
--

CREATE TABLE `performs` (
  `Acc_No` bigint(20) NOT NULL,
  `Trans_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `work_tracker`
--

CREATE TABLE `work_tracker` (
  `Employee_ID` bigint(20) NOT NULL,
  `SignIn_Time` time NOT NULL,
  `SignOut_Time` time DEFAULT NULL,
  `Work_Date` date NOT NULL,
  `Working_Hours` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`Card_No`),
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
-- Indexes for table `performs`
--
ALTER TABLE `performs`
  ADD PRIMARY KEY (`Acc_No`,`Trans_ID`),
  ADD KEY `Trans_ID` (`Trans_ID`);

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
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `card_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`);

--
-- Constraints for table `performs`
--
ALTER TABLE `performs`
  ADD CONSTRAINT `performs_ibfk_1` FOREIGN KEY (`Acc_No`) REFERENCES `account` (`Acc_No`),
  ADD CONSTRAINT `performs_ibfk_2` FOREIGN KEY (`Trans_ID`) REFERENCES `transaction` (`Trans_ID`);

--
-- Constraints for table `work_tracker`
--
ALTER TABLE `work_tracker`
  ADD CONSTRAINT `work_tracker_ibfk_1` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`Employee_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
