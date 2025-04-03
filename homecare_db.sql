-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 11:31 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homecare_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`) VALUES
(1, 'Admin User', 'admin', 9874563210, 'admin@gmail.com', 'ed20a959d410ccd843d9e1dfcee04228');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(5) NOT NULL,
  `CategoryName` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `CategoryName`, `CreationDate`) VALUES
(1, 'laundry', '2023-06-16 01:52:51'),
(2, 'Mopping', '2023-06-16 01:52:51'),
(3, 'Dusting and Mopping', '2023-06-16 01:52:51'),
(4, 'Utensil Cleaning', '2023-06-16 01:52:51'),
(5, 'Bathroom Cleaning', '2023-06-16 01:52:51'),
(6, 'Cooking Service', '2023-06-16 01:52:51'),
(8, 'Others', '2023-06-16 01:57:02');

-- --------------------------------------------------------

--
-- Table structure for table `maid`
--

CREATE TABLE `maid` (
  `ID` int(11) NOT NULL,
  `CatID` int(11) NOT NULL,
  `MaidID` varchar(50) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `ContactNumber` bigint(20) NOT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `Experience` int(11) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Address` text NOT NULL,
  `Description` text NOT NULL,
  `IdProof` varchar(255) NOT NULL,
  `RegDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maid`
--

INSERT INTO `maid` (`ID`, `CatID`, `MaidID`, `Name`, `Email`, `ContactNumber`, `Gender`, `Experience`, `DateOfBirth`, `Address`, `Description`, `IdProof`, `RegDate`) VALUES
(1, 6, 'Maid001', 'Eva', 'eva@gmail.com', 3214567890, 'Female', 4, '2008-05-23', '21-road', 'cooking', '1742139953_id.jpg', '2025-03-18 11:14:34'),
(2, 8, 'Maid002', 'ram', 'ram@gmail.com', 7894561230, 'Male', 2, '1990-01-01', '11', 'General helper', '1742139058_id.jpg', '2025-03-18 11:14:34'),
(3, 1, 'Maid003', 'Emma Clark', 'emma.clark@gmail.com', 8979879797, 'Female', 3, '1990-06-15', '45 Pine Street, Oldtown', 'Experienced maid with 3 years of service', '1742139953_id.jpg', '2025-03-18 11:14:34'),
(4, 6, 'Maid004', 'Olivia Harris', 'olivia.harris@gmail.com', 9779789879, 'Female', 4, '1988-07-20', '78 Maple Road, Greenhill', 'Professional cleaner', '1742139953_id.jpg', '2025-03-18 11:14:34'),
(5, 8, 'Maid005', 'Liam Turner', 'liam.turner@gmail.com', 8789789789, 'Male', 5, '1995-03-12', '101 Cedar Avenue, Westbrook', 'Specialized in house cleaning', '1742139953_id.jpg', '2025-03-18 11:14:34'),
(6, 2, 'Maid006', 'Mason Scott', 'mason.scott@gmail.com', 1231231230, 'Male', 6, '1992-11-09', '56 Birch Avenue, Fairview', 'Housekeeping and general cleaning expert', '1742139953_id.jpg', '2025-03-18 11:14:34'),
(7, 1, 'Maid007', 'jack', 'jack@gmail.com', 2314567890, 'Male', 1, '1999-02-17', 'Mumbai', 'Professional cleaner', '1742205201_id.jpg', '2025-03-18 11:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `maidbooking`
--

CREATE TABLE `maidbooking` (
  `ID` int(11) NOT NULL,
  `BookingID` bigint(20) NOT NULL,
  `CatID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `ContactNumber` bigint(20) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Address` text NOT NULL,
  `Gender` enum('Male','Female','Other') DEFAULT NULL,
  `WorkingShiftFrom` time NOT NULL,
  `WorkingShiftTo` time NOT NULL,
  `StartDate` date NOT NULL,
  `BookingDate` datetime NOT NULL,
  `Remark` text DEFAULT NULL,
  `Status` enum('Pending','Approved','Cancelled','Completed') DEFAULT NULL,
  `UpdationDate` datetime NOT NULL,
  `AssignTo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maidbooking`
--

INSERT INTO `maidbooking` (`ID`, `BookingID`, `CatID`, `Name`, `ContactNumber`, `Email`, `Address`, `Gender`, `WorkingShiftFrom`, `WorkingShiftTo`, `StartDate`, `BookingDate`, `Remark`, `Status`, `UpdationDate`, `AssignTo`) VALUES
(1, 836020791, 6, 'Rana', 1234567894, 'rana@gmail.com', 'Plot 11, South City', 'Female', '20:00:00', '22:00:00', '2025-03-19', '2025-03-16 10:44:59', 'good\r\n', 'Approved', '2025-03-17 12:36:18', 'Maid004'),
(2, 504180769, 3, 'John Doe', 9797797879, 'john.doe@example.com', 'J-890, Laxmi Nagar, New Delhi', 'Male', '07:30:00', '09:00:00', '2025-04-02', '2025-03-15 09:30:00', 'Weekly service', 'Cancelled', '2025-03-17 12:17:13', 'Maid004'),
(3, 689758471, 1, 'Michael Brown', 456321023, 'michael.brown@example.com', 'A-123, Raj Nagar Extension', 'Male', '09:00:00', '11:00:00', '2025-04-20', '2025-03-15 10:30:00', 'First-time booking', 'Approved', '2025-03-18 10:30:32', 'Maid003'),
(4, 182765979, 4, 'Emma White', 7412330012, 'emma.white@example.com', 'XYZ Apartments, Ghaziabad', 'Female', '18:00:00', '20:00:00', '2025-03-25', '2025-03-16 11:00:00', 'aa', 'Approved', '0000-00-00 00:00:00', 'Maid004'),
(5, 100001001, 1, 'Sophia Walker', 9876543210, 'sophia.walker@gmail.com', 'Block A, Green Residency, Mumbai', 'Female', '08:00:00', '10:00:00', '2025-04-01', '2025-03-19 11:30:00', 'Looking for laundry help', 'Approved', '2025-03-19 14:15:00', 'Maid003'),
(6, 100001002, 2, 'Arjun Mehta', 9123456780, 'arjun.mehta@gmail.com', 'Plot 56, Ghatkopar West, Mumbai', 'Male', '18:00:00', '20:00:00', '2025-04-05', '2025-03-19 12:45:00', 'Mopping services needed thrice a week', 'Pending', '0000-00-00 00:00:00', NULL),
(7, 100001003, 6, 'Lily Thomas', 8899776655, 'lily.thomas@gmail.com', '23, Palm Heights, Delhi', 'Female', '11:00:00', '13:00:00', '2025-04-07', '2025-03-19 13:10:00', 'Daily cooking service required', 'Approved', '2025-03-19 15:00:00', 'Maid001'),
(8, 100001004, 3, 'Rajesh Kumar', 9871122334, 'rajesh.kumar@gmail.com', 'B-55, Sector 62, Noida', 'Male', '07:00:00', '09:00:00', '2025-04-10', '2025-03-19 14:25:00', 'Dusting and Mopping needed weekly', 'Cancelled', '2025-03-19 16:00:00', 'Maid004'),
(9, 100001005, 4, 'Mira Patel', 9988776655, 'mira.patel@gmail.com', 'D-12, Lotus Garden, Ahmedabad', 'Female', '17:00:00', '19:00:00', '2025-04-12', '2025-03-19 15:45:00', 'Utensil cleaning help', 'Approved', '2025-03-19 18:00:00', 'Maid005'),
(10, 100001006, 8, 'Sanjay Verma', 9080706050, 'sanjay.verma@gmail.com', 'Flat 101, Urban Heights, Pune', 'Male', '20:00:00', '22:00:00', '2025-04-15', '2025-03-19 16:30:00', 'Occasional odd jobs', 'Pending', '0000-00-00 00:00:00', NULL),
(11, 100001007, 5, 'Pooja Sharma', 9955443322, 'pooja.sharma@gmail.com', 'G-90, Connaught Place, Delhi', 'Female', '09:00:00', '11:00:00', '2025-04-18', '2025-03-19 17:00:00', 'gg', 'Approved', '2025-03-19 18:45:00', 'Maid006'),
(12, 222488241, 3, 'raju', 5698741230, 'ww@gmail.com', 'nanded', 'Male', '15:23:00', '20:21:00', '2025-03-29', '2025-03-19 10:51:35', '', NULL, '2025-03-19 10:51:35', NULL),
(13, 237449842, 6, 'kavita', 3214569870, 'kk@gmail.com', 'nanded', 'Female', '07:00:00', '10:00:00', '2025-03-27', '2025-03-19 11:26:45', '', NULL, '2025-03-19 11:26:45', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `maid`
--
ALTER TABLE `maid`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `MaidID` (`MaidID`),
  ADD KEY `CatID` (`CatID`);

--
-- Indexes for table `maidbooking`
--
ALTER TABLE `maidbooking`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `BookingID` (`BookingID`),
  ADD KEY `CatID` (`CatID`),
  ADD KEY `AssignTo` (`AssignTo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `maid`
--
ALTER TABLE `maid`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `maidbooking`
--
ALTER TABLE `maidbooking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maid`
--
ALTER TABLE `maid`
  ADD CONSTRAINT `fk_maid_category` FOREIGN KEY (`CatID`) REFERENCES `category` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maidbooking`
--
ALTER TABLE `maidbooking`
  ADD CONSTRAINT `fk_booking_assign` FOREIGN KEY (`AssignTo`) REFERENCES `maid` (`MaidID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking_category` FOREIGN KEY (`CatID`) REFERENCES `category` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
