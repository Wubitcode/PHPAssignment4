-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 15, 2026 at 03:08 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tech_support`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `adminID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwordHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `countryCode` char(2) NOT NULL,
  `countryName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`countryCode`, `countryName`) VALUES
('CA', 'Canada');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `postalCode` varchar(20) NOT NULL,
  `countryCode` char(2) NOT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `passwordHash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `firstName`, `lastName`, `address`, `city`, `state`, `postalCode`, `countryCode`, `phone`, `email`, `passwordHash`) VALUES
(2, 'John', 'Smith', '123 Main St', 'Toronto', 'ON', 'M1M1M1', 'CA', '416-555-1234', 'john.smith@email.com', 'test123'),
(3, 'Dan', 'sam', 'mmm3', 'toronto', 'canada', 'w24R', 'CA', '12345678', 'dan@example.com', NULL),
(4, 'Tata', 'Dagm', '123love st', 'toronto', 'on', 'm14w2', 'ca', '12345432', 'tata@example.com', NULL),
(5, 'Elu', 'Bruk', '123we', 'durham', 'on', 'm6w3xy', 'CA', '9871234567', 'elu@gmail.com', NULL),
(7, 'Kelly', 'Irvin', 'M1S7P5', 'Toronto', 'On', '1234', 'CA', '123456789', 'kelly@example.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `incidentID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `productCode` varchar(10) NOT NULL,
  `techID` int(11) DEFAULT NULL,
  `dateOpened` datetime NOT NULL DEFAULT current_timestamp(),
  `dateClosed` datetime DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productCode` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  `releaseDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productCode`, `name`, `version`, `releaseDate`) VALUES
('0002', 'Tarif', '009', '2026-02-06'),
('001', 'sam', '2026', '2026-02-06'),
('003', 'IT jobs', '009', '2026-02-06'),
('DRAFT10', 'Draft Manager1.0', '1.0', '2019-03-01'),
('LEAG10', 'League Scheduler 1.0', '1.0', '2018-06-01'),
('LEAGD10', 'League Scheduler Deluxe 1.0', '1.0', '2018-09-01'),
('TEAM10', 'Team Manager Version1.0', '1.0', '2020-06-01'),
('TRNY10', 'Tournament Master Version1.0', '1.0', '2018-01-01'),
('TRNY20', 'Tournament Master Version2.0', '2.0', '2020-03-15');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `registrationID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `productCode` varchar(10) NOT NULL,
  `registrationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`registrationID`, `customerID`, `productCode`, `registrationDate`) VALUES
(3, 2, 'DRAFT10', '2026-02-05 21:19:46'),
(4, 2, 'LEAGD10', '2026-02-06 15:11:06'),
(5, 2, 'TRNY20', '2026-02-06 15:11:21'),
(6, 3, '003', '2026-02-06 23:46:21'),
(9, 3, '0002', '2026-02-12 21:00:41'),
(10, 4, '003', '2026-02-13 06:37:29'),
(11, 4, 'LEAG10', '2026-02-13 07:03:02'),
(15, 4, 'DRAFT10', '2026-02-13 15:13:55'),
(17, 3, 'TRNY20', '2026-02-15 07:35:22'),
(18, 7, 'TRNY20', '2026-02-15 08:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `techID` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `passwordHash` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`techID`, `firstName`, `lastName`, `email`, `phone`, `password`, `passwordHash`) VALUES
(4, 'Alison', 'Diaz', 'alison@sportpro.com', '800-555-0443', '$2y$10$Ka9vOqNU/7JqtjjYPOHkle/XKZKJHW2Oj96m.zwl1/axBHMe9Tctm', NULL),
(5, 'Gina', 'Flori', 'gflori@sportspro', '800-555-0459', '$2y$10$2h/WajAKxSOw0kg04tZgI.cyxDtsH/PDN/rElFi.4Jl63ygbZx.vS', NULL),
(6, 'Jason', 'Lee', 'jason@sportspro', '800-555-0444', '$2y$10$4x.nQdmeWAhnGj0PMKitLeIhP5.zYd7jOurbwUFnd6on8Q8PZlgfW', NULL),
(7, 'Gunter', 'wendt', 'gunter@sportspro.com', '800-555-0449', '$2y$10$fiRiJyxkFb0pWtKak1dL7.HMBo14NqE9ZcQi/0vfdPlVtqLyYbuOu', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`countryCode`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_customers_country` (`countryCode`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`incidentID`),
  ADD KEY `fk_incident_customer` (`customerID`),
  ADD KEY `fk_incident_product` (`productCode`),
  ADD KEY `fk_incident_tech` (`techID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productCode`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`registrationID`),
  ADD UNIQUE KEY `uq_customer_product` (`customerID`,`productCode`),
  ADD UNIQUE KEY `uniq_customer_product` (`customerID`,`productCode`),
  ADD KEY `fk_reg_product` (`productCode`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`techID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `incidentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `registrationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `techID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_customers_country` FOREIGN KEY (`countryCode`) REFERENCES `countries` (`countryCode`) ON UPDATE CASCADE;

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `fk_incident_customer` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_incident_product` FOREIGN KEY (`productCode`) REFERENCES `products` (`productCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_incident_tech` FOREIGN KEY (`techID`) REFERENCES `technicians` (`techID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `fk_reg_customer` FOREIGN KEY (`customerID`) REFERENCES `customers` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reg_product` FOREIGN KEY (`productCode`) REFERENCES `products` (`productCode`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
