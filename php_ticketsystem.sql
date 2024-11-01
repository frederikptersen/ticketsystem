-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 18, 2023 at 02:57 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_ticketsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `Ticket_Id` int NOT NULL AUTO_INCREMENT,
  `Ticket_Subject` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Ticket_Priority` int NOT NULL,
  `Ticket_Message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Ticket_Attachments` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Saved using the serialize() command',
  `User_Name` varchar(255) NOT NULL,
  `User_Email` varchar(255) NOT NULL,
  `Ticket_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Ticket_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`Ticket_Id`, `Ticket_Subject`, `Ticket_Priority`, `Ticket_Message`, `Ticket_Attachments`, `User_Name`, `User_Email`, `Ticket_DateTime`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `ticket_response`
--

DROP TABLE IF EXISTS `ticket_response`;
CREATE TABLE IF NOT EXISTS `ticket_response` (
  `Response_id` int NOT NULL AUTO_INCREMENT,
  `Ticket_id` int NOT NULL,
  `Response_User` varchar(255) NOT NULL,
  `Response_Email` varchar(255) NOT NULL,
  `Response_Message` longtext NOT NULL,
  `Response_Attachments` varchar(255) NOT NULL COMMENT 'Saved using serialize() command',
  `Response_DateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Response_id`),
  KEY `Ticket_id` (`Ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_response`
--

INSERT INTO `ticket_response` (`Response_id`, `Ticket_id`, `Response_User`, `Response_Email`, `Response_Message`, `Response_Attachments`, `Response_DateTime`) VALUES


--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket_response`
--
ALTER TABLE `ticket_response`
  ADD CONSTRAINT `ticket_response_ibfk_1` FOREIGN KEY (`Ticket_id`) REFERENCES `ticket` (`Ticket_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
