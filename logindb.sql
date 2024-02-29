-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 29, 2024 at 07:42 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `ticketNumber` int NOT NULL AUTO_INCREMENT,
  `FlightNumber` int NOT NULL,
  `PassengerID` int NOT NULL,
  `SeatNumber` varchar(10) NOT NULL,
  `FastPassStatus` varchar(5) NOT NULL DEFAULT 'false',
  UNIQUE KEY `BookingReferenceNumber` (`ticketNumber`),
  KEY `PassengerID` (`PassengerID`),
  KEY `bookings_ibfk_1` (`FlightNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=12347 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`ticketNumber`, `FlightNumber`, `PassengerID`, `SeatNumber`, `FastPassStatus`) VALUES
(124, 108, 9, 'seat12', 'false'),
(4023, 108, 2, 'seat22', 'false'),
(6969, 108, 9, 'seat19', 'false'),
(7777, 101, 2, 'seat8', 'false'),
(12345, 101, 2, 'seat1', 'true'),
(12346, 101, 2, 'seat9', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `checkedbags`
--

DROP TABLE IF EXISTS `checkedbags`;
CREATE TABLE IF NOT EXISTS `checkedbags` (
  `BagID` int NOT NULL AUTO_INCREMENT,
  `ticketNumber` int NOT NULL,
  `PassengerID` int NOT NULL,
  `Weight` int NOT NULL,
  `BagStatus` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'In Process' COMMENT 'e.g., checked, in transit, delivered',
  `SpecialRequests` varchar(255) NOT NULL,
  UNIQUE KEY `BagID` (`BagID`),
  KEY `PassengerID` (`PassengerID`),
  KEY `BookingReferenceNumber` (`ticketNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `checkedbags`
--

INSERT INTO `checkedbags` (`BagID`, `ticketNumber`, `PassengerID`, `Weight`, `BagStatus`, `SpecialRequests`) VALUES
(10, 12345, 2, 50, 'In Process', 'Dont Throw please'),
(11, 12345, 2, 15, 'In Process', 'Fragile'),
(12, 12346, 2, 150, 'In Process', ''),
(13, 12346, 2, 10, 'In Process', 'dont throw'),
(14, 6969, 9, 100, 'In Process', 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `employeeID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accessLevel` int NOT NULL DEFAULT '5',
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `employeeID` (`employeeID`)
) ENGINE=InnoDB AUTO_INCREMENT=1992 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeID`, `name`, `email`, `password`, `accessLevel`) VALUES
(1989, 'Curt Bennett', 'chaszor@gmail.com', '$2y$10$M6szJYpqs47./Qox1wKQ8uMQL4pWBBYDhRlIjvy2Swn/1lhzMt/Nq', 1);

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

DROP TABLE IF EXISTS `flights`;
CREATE TABLE IF NOT EXISTS `flights` (
  `FlightNumber` int DEFAULT NULL,
  `DepartureAirport` varchar(50) NOT NULL,
  `ArrivalAirport` varchar(50) NOT NULL,
  `DepartureDateTime` datetime NOT NULL,
  `ArrivalDateTime` datetime NOT NULL,
  `FlightStatus` varchar(20) NOT NULL,
  UNIQUE KEY `FlightNumber` (`FlightNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`FlightNumber`, `DepartureAirport`, `ArrivalAirport`, `DepartureDateTime`, `ArrivalDateTime`, `FlightStatus`) VALUES
(101, 'JFK', 'LAX', '2024-02-10 08:00:00', '2024-02-10 11:00:00', 'Scheduled'),
(102, 'LAX', 'ORD', '2024-02-11 12:00:00', '2024-02-11 15:30:00', 'Delayed'),
(103, 'DFW', 'MIA', '2024-02-12 14:30:00', '2024-02-12 17:00:00', 'On Time'),
(104, 'ATL', 'SFO', '2024-02-13 16:45:00', '2024-02-13 20:15:00', 'Scheduled'),
(105, 'SFO', 'SEA', '2024-02-14 18:30:00', '2024-02-14 20:45:00', 'On Time'),
(106, 'ORD', 'DEN', '2024-02-15 22:00:00', '2024-02-16 01:30:00', 'Delayed'),
(107, 'MIA', 'LGA', '2024-02-16 04:00:00', '2024-02-16 06:30:00', 'Scheduled'),
(108, 'SEA', 'PHX', '2024-02-17 08:45:00', '2024-02-17 10:30:00', 'On Time'),
(109, 'PHX', 'ORD', '2024-02-18 12:15:00', '2024-02-18 15:45:00', 'Scheduled'),
(110, 'LGA', 'DFW', '2024-02-19 18:00:00', '2024-02-19 21:30:00', 'On Time');

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

DROP TABLE IF EXISTS `passengers`;
CREATE TABLE IF NOT EXISTS `passengers` (
  `PassengerID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(80) NOT NULL,
  `LastName` varchar(80) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  UNIQUE KEY `PassengerID` (`PassengerID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`PassengerID`, `FirstName`, `LastName`, `Email`, `password`) VALUES
(1, 'Piper', 'Keim', 'piperskeim@gmail.com', '$2y$10$oQ4DywOgCFIUYMSQKxbEC.JjTz50Et2/OatRbA9/7T5g1lR5w7LR.'),
(2, 'Curt', 'Bennett', 'chaszor@gmail.com', '$2y$10$YH56UHhR9ZUwQZ5tnLGMreIChfgbjsFHr3d5aPlMqQcNAo94MaIG6'),
(9, 'Austin', 'Belt', 'austinebelt@gmail.com', '$2y$10$yDoJq90uURJPs.hvbUFqIONCZK07VbXXnork9omKDMEohRu0rWbci');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`FlightNumber`) REFERENCES `flights` (`FlightNumber`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`PassengerID`) REFERENCES `passengers` (`PassengerID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `checkedbags`
--
ALTER TABLE `checkedbags`
  ADD CONSTRAINT `checkedbags_ibfk_1` FOREIGN KEY (`PassengerID`) REFERENCES `passengers` (`PassengerID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `checkedbags_ibfk_2` FOREIGN KEY (`ticketNumber`) REFERENCES `bookings` (`ticketNumber`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
