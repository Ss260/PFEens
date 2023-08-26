-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 26, 2023 at 05:19 PM
-- Server version: 8.0.33
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `AdminID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `CIN` varchar(20) DEFAULT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`AdminID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `CIN`, `Username`, `Password`) VALUES
(1, 'Soufian', 'Amrous', 'amrsfn26@gmail.com', '0679419165', 'R369142', 'Ss26', 'Admin123');

-- --------------------------------------------------------

--
-- Table structure for table `adminactionslog`
--

DROP TABLE IF EXISTS `adminactionslog`;
CREATE TABLE IF NOT EXISTS `adminactionslog` (
  `LogID` int NOT NULL AUTO_INCREMENT,
  `ActionType` varchar(50) DEFAULT NULL,
  `ActionDetails` text,
  `Timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LogID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `BookingID` int NOT NULL AUTO_INCREMENT,
  `CarID` int DEFAULT NULL,
  `ClientID` int DEFAULT NULL,
  `PickupDateTime` datetime DEFAULT NULL,
  `ReturnDateTime` datetime DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `BookingStatus` varchar(50) DEFAULT NULL,
  `PickupLocation` varchar(255) DEFAULT NULL,
  `ReturnLocation` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`BookingID`),
  KEY `CarID` (`CarID`),
  KEY `ClientID` (`ClientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carimages`
--

DROP TABLE IF EXISTS `carimages`;
CREATE TABLE IF NOT EXISTS `carimages` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `vehicle_id` (`vehicle_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `carimages`
--

INSERT INTO `carimages` (`image_id`, `vehicle_id`, `image_url`) VALUES
(9, 20, '../imgquote.jpg'),
(10, 20, '../imgezgif.com-resize.jpg'),
(11, 20, '../imgfeature.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `CarID` int NOT NULL AUTO_INCREMENT,
  `CarModel` varchar(255) DEFAULT NULL,
  `CarType` varchar(50) DEFAULT NULL,
  `Year` int DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Mileage` int DEFAULT NULL,
  `LicensePlate` varchar(20) DEFAULT NULL,
  `FuelType` varchar(50) DEFAULT NULL,
  `Transmission` varchar(50) DEFAULT NULL,
  `SeatingCapacity` int DEFAULT NULL,
  `DailyRate` decimal(10,2) DEFAULT NULL,
  `Availability` tinyint(1) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `AdminNotes` text,
  `LegalDocuments` text,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`CarID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CarID`, `CarModel`, `CarType`, `Year`, `Color`, `Mileage`, `LicensePlate`, `FuelType`, `Transmission`, `SeatingCapacity`, `DailyRate`, `Availability`, `Location`, `AdminNotes`, `LegalDocuments`, `CreatedAt`, `UpdatedAt`) VALUES
(13, 'Toyota Camri', 'Sedan', 2022, 'Blue', 15000, 'ABC123', 'Gasoline', 'Automatic', 5, '50.00', 1, 'New York', 'Sample admin notes for car 1', 'Sample legal documents for car 1', '2023-08-23 20:03:33', '2023-08-25 03:28:25'),
(15, 'Honda Civic', 'Sedan', 2023, 'Red', 12000, 'XYZ789', 'Gasoline', 'Automatic', 5, '45.00', 1, 'Los Angeles', 'Sample admin notes for car 2', 'Sample legal documents for car 2', '2023-08-23 22:37:55', '2023-08-23 22:37:55'),
(20, 'Golf', 'Jetta', 2003, 'black', 15000, '988271', 'none', 'none', 5, '200.00', 1, 'Al hoceima', 'Not for Rent', 'All set', '2023-08-24 20:45:47', '2023-08-24 20:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `ClientID` int NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ClientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maintenancetasks`
--

DROP TABLE IF EXISTS `maintenancetasks`;
CREATE TABLE IF NOT EXISTS `maintenancetasks` (
  `TaskID` int NOT NULL AUTO_INCREMENT,
  `CarID` int DEFAULT NULL,
  `TaskType` varchar(50) DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  `Completed` tinyint(1) DEFAULT NULL,
  `CompletionDate` date DEFAULT NULL,
  PRIMARY KEY (`TaskID`),
  KEY `CarID` (`CarID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `NotificationID` int NOT NULL AUTO_INCREMENT,
  `NotificationType` varchar(50) DEFAULT NULL,
  `Message` text,
  `Timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` enum('Read','Unread') DEFAULT NULL,
  PRIMARY KEY (`NotificationID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
CREATE TABLE IF NOT EXISTS `statistics` (
  `StatisticID` int NOT NULL AUTO_INCREMENT,
  `StatisticType` varchar(50) DEFAULT NULL,
  `Value` decimal(10,2) DEFAULT NULL,
  `Timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`StatisticID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`ClientID`) REFERENCES `clients` (`ClientID`);

--
-- Constraints for table `carimages`
--
ALTER TABLE `carimages`
  ADD CONSTRAINT `carimages_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `cars` (`CarID`);

--
-- Constraints for table `maintenancetasks`
--
ALTER TABLE `maintenancetasks`
  ADD CONSTRAINT `maintenancetasks_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `cars` (`CarID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
