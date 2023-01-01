-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2017 at 11:21 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `year2project`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `EventType` int(11) DEFAULT NULL,
  `StartDate` varchar(255) NOT NULL,
  `EndDate` varchar(255) NOT NULL,
  `Cost` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `Title`, `Description`, `StartDate`, `EndDate`, `Cost`, `LocationID`) VALUES
(1, 'Wedding Anniversary', '1st Anniversary Celebration', '2015-06-15', '2015-06-16', 25000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `LocationID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ManagerFName` varchar(255) DEFAULT NULL,
  `ManagerLName` varchar(255) DEFAULT NULL,
  `ManagerEmail` varchar(255) DEFAULT NULL,
  `ManagerNumber` int(11) DEFAULT NULL,
  `MaxCapacity` int(11) DEFAULT NULL,
  `LocationType` int(11) DEFAULT NULL,
  `SeatingAvailable` int(11) DEFAULT NULL,
  `Url` varchar(255) DEFAULT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`LocationID`, `Name`, `Address`, `ManagerFName`, `ManagerLName`, `ManagerEmail`, `ManagerNumber`, `MaxCapacity`, `LocationType`, `SeatingAvailable`, `Url`, `Image`) VALUES
(1, 'Royal Hotel', 'Bray', 'John', 'Byrne', 'John@email.com', 123456, 100, NULL, 1, NULL, NULL),
(2, 'Desamas', 'No.1, Jalan AU5C/6', 'Humaira&#39; ', 'Ahmad Shuhemi', 'humairas00@yahoo.com', 12345, 50, 2, 1, 'https://www.google.com', 0x64616e6765722e706e67);

-- FACILITIES --------------------------------------------------------

-- Table structure for table `facilities`

CREATE TABLE `facilities` (
  `FacilitiesID` int(11) NOT NULL,
  `Facility` int(11) DEFAULT NULL,
  `LocationID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `facilities`

INSERT INTO `facilities` (`FacilitiesID`, `Facility`, `LocationID`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 2),
(4, 4, 2),
(5, 5, 2);

-- Indexes for dumped tables


-- Indexes for table `facilities`

ALTER TABLE `facilities`
  ADD PRIMARY KEY (`FacilitiesID`),
  ADD KEY `LocationID` (`LocationID`);

-- AUTO_INCREMENT for dumped tables


-- AUTO_INCREMENT for table `facilities`

ALTER TABLE `facilities`
  MODIFY `FacilitiesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


-- Constraints for dumped tables


-- Constraints for table `facilities`
-- ALTER TABLE `facilities`
--   ADD CONSTRAINT `LocationID` FOREIGN KEY (`LocationID`) REFERENCES `locations` (`LocationID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
-- COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `role`) VALUES
('test', '1234', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `LocationID` (`LocationID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`LocationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `LocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `events` CHANGE `StartDate` `StartDate` DATE NOT NULL;
ALTER TABLE `events` CHANGE `EndDate` `EndDate` DATE NOT NULL;

-- UPDATE `events` SET `StartDate` = '2015-06-15', `EndDate` = '2016-06-15' WHERE `events`.`EventID` = 1
