-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2024 at 04:04 PM
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
-- Table structure for table `available_seats`
--

DROP TABLE IF EXISTS `available_seats`;
CREATE TABLE IF NOT EXISTS `available_seats` (
  `SeatID` int NOT NULL AUTO_INCREMENT,
  `FlightNumber` int NOT NULL,
  `SeatNumber` varchar(10) NOT NULL,
  `IsReserved` tinyint(1) NOT NULL DEFAULT '0',
  `PassengerID` int DEFAULT NULL,
  PRIMARY KEY (`SeatID`),
  UNIQUE KEY `UniqueSeat` (`FlightNumber`,`SeatNumber`),
  KEY `fk_available_seats_passenger_id` (`PassengerID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `available_seats`
--

INSERT INTO `available_seats` (`SeatID`, `FlightNumber`, `SeatNumber`, `IsReserved`, `PassengerID`) VALUES
(1, 101, 'seat1', 1, 2),
(2, 101, 'seat2', 0, NULL),
(3, 101, 'seat3', 0, NULL),
(4, 102, 'seat4', 0, NULL),
(5, 102, 'seat5', 0, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=123456790 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`ticketNumber`, `FlightNumber`, `PassengerID`, `SeatNumber`, `FastPassStatus`) VALUES
(10101, 101, 2, 'seat1', 'False'),
(10113, 101, 2, 'seat13', 'False');

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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `MaxPassengers` int NOT NULL,
  UNIQUE KEY `FlightNumber` (`FlightNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`FlightNumber`, `DepartureAirport`, `ArrivalAirport`, `DepartureDateTime`, `ArrivalDateTime`, `FlightStatus`, `MaxPassengers`) VALUES
(101, 'JFK', 'LAX', '2024-04-10 08:00:00', '2024-04-10 11:00:00', 'Scheduled', 30),
(102, 'LAX', 'ORD', '2024-04-11 12:00:00', '2024-04-11 15:30:00', 'Delayed', 30),
(103, 'DFW', 'MIA', '2024-04-12 14:30:00', '2024-04-12 17:00:00', 'On Time', 30),
(104, 'ATL', 'SFO', '2024-04-13 16:45:00', '2024-04-13 20:15:00', 'Scheduled', 30),
(105, 'SFO', 'SEA', '2024-04-14 18:30:00', '2024-04-14 20:45:00', 'On Time', 30),
(106, 'ORD', 'DEN', '2024-04-15 22:00:00', '2024-04-16 01:30:00', 'Delayed', 30),
(107, 'MIA', 'LGA', '2024-04-16 04:00:00', '2024-04-16 06:30:00', 'Scheduled', 30),
(108, 'SEA', 'PHX', '2024-04-17 08:45:00', '2024-04-17 10:30:00', 'On Time', 30),
(109, 'PHX', 'ORD', '2024-04-18 12:15:00', '2024-04-18 15:45:00', 'Scheduled', 30),
(110, 'LGA', 'DFW', '2024-04-19 18:00:00', '2024-04-19 21:30:00', 'On Time', 30);

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
  `DateCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `PassengerID` (`PassengerID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`PassengerID`, `FirstName`, `LastName`, `Email`, `password`, `DateCreated`) VALUES
(1, 'Piper', 'Keim', 'piperskeim@gmail.com', '$2y$10$oQ4DywOgCFIUYMSQKxbEC.JjTz50Et2/OatRbA9/7T5g1lR5w7LR.', '2024-03-06 10:50:00'),
(2, 'Curt', 'Bennett', 'chaszor@gmail.com', '$2y$10$YH56UHhR9ZUwQZ5tnLGMreIChfgbjsFHr3d5aPlMqQcNAo94MaIG6', '2024-03-06 10:50:00'),
(9, 'Austin', 'Belt', 'austinebelt@gmail.com', '$2y$10$yDoJq90uURJPs.hvbUFqIONCZK07VbXXnork9omKDMEohRu0rWbci', '2024-03-06 10:50:00'),
(11, 'sdfsd', 'sdfsdf', 'sdfsdf@sfdsdf.com', '$2y$10$MAKdN.I.CtcdJpmWK.KR8OYpceejCT8eu6iNacsE5zQng3OiB4y/.', '2024-03-06 10:50:00'),
(12, 'test', 'test', 'test@test.com', '$2y$10$RzwfFGuYAq59efve8viCdOYBP1L2J.fwsip.kqSoZu8rCL7f5ZQ8u', '2024-03-06 10:50:00'),
(15, 'bluh', 'bluh', 'test1@test.com', '$2y$10$ZXQ6Te/uWJNmoSKd2PLuyu6fMMhGO8u5di7Tz0Y6L9sMaL91NVL4e', '2024-04-09 10:14:24'),
(16, 'Test', 'Ing', 'test@gmail.com', '$2y$10$/F6CdLkaqzAdmn.V1Og9P.eHVA5fCtPw4zm/bCQddaHGv42EZBC0q', '2024-04-15 11:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `TransactionID` int NOT NULL AUTO_INCREMENT,
  `TransactionType` varchar(50) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `TransactionDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` varchar(255) DEFAULT NULL,
  `BookingReferenceNumber` int DEFAULT NULL,
  PRIMARY KEY (`TransactionID`),
  KEY `transactions_ibfk_1` (`BookingReferenceNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `available_seats`
--
ALTER TABLE `available_seats`
  ADD CONSTRAINT `available_seats_ibfk_1` FOREIGN KEY (`FlightNumber`) REFERENCES `flights` (`FlightNumber`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_available_seats_passenger_id` FOREIGN KEY (`PassengerID`) REFERENCES `passengers` (`PassengerID`) ON DELETE SET NULL ON UPDATE CASCADE;

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

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`BookingReferenceNumber`) REFERENCES `bookings` (`ticketNumber`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
