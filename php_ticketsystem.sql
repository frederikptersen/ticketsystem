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
(1, 'Hello World!', 0, 'This is the first message saved using this program!\r\nThis first message will also include the icon of this program!\r\nGreets!', 'a:1:{i:0;s:24:\"ticketing-system-128.png\";}', 'Bram Hesen', 'bramhesen@ziggo.nl', '2023-12-18 14:47:19'),
(2, 'Lorem Ipsum', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis ex quis mauris pulvinar, a laoreet quam ullamcorper. Suspendisse vitae est ultrices, placerat metus vitae, vulputate felis. Curabitur sed semper enim. Suspendisse vehicula tincidunt luctus. Maecenas sed volutpat libero. Duis ut pellentesque est, ac malesuada justo. Donec nec auctor odio. Nulla facilisi. Suspendisse cursus eget mi et cursus. Vivamus dapibus, purus quis consequat tincidunt, tellus nunc porttitor magna, in suscipit libero sem et urna.\r\n\r\nSed sit amet fringilla lacus, vitae malesuada erat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin viverra pulvinar molestie. Pellentesque tempor placerat lectus, eu varius enim vulputate in. Sed lorem mi, mattis ac sapien sed, ullamcorper condimentum lectus. Sed volutpat ut eros sit amet accumsan. Ut tincidunt volutpat luctus. Donec sodales ante et dui tristique, id dapibus dolor lobortis. Nullam tincidunt sem lorem, in pulvinar augue commodo vitae. Mauris interdum eros nisi, eget imperdiet felis cursus eget. Suspendisse consequat bibendum justo, eget feugiat orci luctus non. Ut a urna dui. Aliquam fringilla, ex vel efficitur porta, orci ante volutpat sapien, quis interdum nisi massa sit amet quam. Etiam auctor enim id urna vehicula pretium. Vivamus commodo ligula at justo laoreet cursus.\r\n\r\nVestibulum in pharetra magna. Donec pellentesque cursus dui, ac placerat mauris facilisis porta. Integer aliquet sodales massa. Donec a accumsan enim. Phasellus rutrum, turpis at hendrerit convallis, lorem enim cursus nunc, vel mattis ligula nisi eu tortor. Curabitur volutpat quis magna sed vestibulum. Vestibulum mauris lectus, consectetur ut placerat ac, vehicula a dolor. Nullam at dolor id orci posuere viverra. Donec rhoncus, velit non auctor placerat, mauris lacus varius sem, faucibus ornare sapien ligula sed nibh. Nulla vulputate quam at sem tempor egestas. Praesent egestas nibh ac ante volutpat molestie. Ut porttitor odio massa, ut dignissim sem accumsan a. In libero tortor, rhoncus et nunc ut, condimentum ultricies nulla. Nunc vel justo condimentum, ultricies lacus at, faucibus ex. Curabitur vel venenatis nulla. Mauris luctus urna ac lacus maximus, ut hendrerit elit venenatis.\r\n\r\nEtiam lacus nisl, lacinia vel accumsan quis, accumsan ac tortor. Nullam euismod in lacus et suscipit. Duis hendrerit condimentum iaculis. In hac habitasse platea dictumst. Suspendisse ornare quis nisl et bibendum. Duis quis massa et dui venenatis condimentum ac at erat. Maecenas egestas vulputate nunc et venenatis. Integer placerat metus urna, ut faucibus sapien accumsan ultrices.\r\n\r\nMaecenas pulvinar sollicitudin laoreet. Praesent euismod mi augue. Nullam tempor libero mauris, id egestas augue varius ut. Integer laoreet posuere dui. Maecenas lobortis scelerisque vulputate. Integer eu sollicitudin leo. Pellentesque tempor justo eget bibendum viverra. Cras nulla eros, rutrum in condimentum vitae, maximus ac arcu. Vestibulum consequat tincidunt arcu, eget porta dui tempus sed. Donec tincidunt odio lobortis mauris pellentesque ultrices.', 'a:1:{i:0;s:8:\"user.png\";}', 'Lorem Ipsum', 'Lorem@ipsum.com', '2023-12-18 14:48:39'),
(3, 'Ticket With Attacthments', 0, 'This is a test with the attatchments', 'a:4:{i:0;s:8:\"user.png\";i:1;s:24:\"ticketing-system-128.png\";i:2;s:23:\"ticketing-system-64.png\";i:3;s:25:\"Assessment Bram  (1).docx\";}', 'Bram Hesen', 'bramhesen@ziggo.nl', '2023-12-18 14:55:42');

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
(1, 1, 'Bram Hesen', 'bramhesen@ziggo.nl', 'This is the first response made using this program!', 'a:1:{i:0;s:0:\"\";}', '2023-12-18 14:47:46'),
(2, 2, 'Lorem Ipsum', 'Lorem@ipsum.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lobortis ex quis mauris pulvinar, a laoreet quam ullamcorper. Suspendisse vitae est ultrices, placerat metus vitae, vulputate felis. Curabitur sed semper enim. Suspendisse vehicula tincidunt luctus. Maecenas sed volutpat libero. Duis ut pellentesque est, ac malesuada justo. Donec nec auctor odio. Nulla facilisi. Suspendisse cursus eget mi et cursus. Vivamus dapibus, purus quis consequat tincidunt, tellus nunc porttitor magna, in suscipit libero sem et urna.\r\n\r\nSed sit amet fringilla lacus, vitae malesuada erat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin viverra pulvinar molestie. Pellentesque tempor placerat lectus, eu varius enim vulputate in. Sed lorem mi, mattis ac sapien sed, ullamcorper condimentum lectus. Sed volutpat ut eros sit amet accumsan. Ut tincidunt volutpat luctus. Donec sodales ante et dui tristique, id dapibus dolor lobortis. Nullam tincidunt sem lorem, in pulvinar augue commodo vitae. Mauris interdum eros nisi, eget imperdiet felis cursus eget. Suspendisse consequat bibendum justo, eget feugiat orci luctus non. Ut a urna dui. Aliquam fringilla, ex vel efficitur porta, orci ante volutpat sapien, quis interdum nisi massa sit amet quam. Etiam auctor enim id urna vehicula pretium. Vivamus commodo ligula at justo laoreet cursus.\r\n\r\nVestibulum in pharetra magna. Donec pellentesque cursus dui, ac placerat mauris facilisis porta. Integer aliquet sodales massa. Donec a accumsan enim. Phasellus rutrum, turpis at hendrerit convallis, lorem enim cursus nunc, vel mattis ligula nisi eu tortor. Curabitur volutpat quis magna sed vestibulum. Vestibulum mauris lectus, consectetur ut placerat ac, vehicula a dolor. Nullam at dolor id orci posuere viverra. Donec rhoncus, velit non auctor placerat, mauris lacus varius sem, faucibus ornare sapien ligula sed nibh. Nulla vulputate quam at sem tempor egestas. Praesent egestas nibh ac ante volutpat molestie. Ut porttitor odio massa, ut dignissim sem accumsan a. In libero tortor, rhoncus et nunc ut, condimentum ultricies nulla. Nunc vel justo condimentum, ultricies lacus at, faucibus ex. Curabitur vel venenatis nulla. Mauris luctus urna ac lacus maximus, ut hendrerit elit venenatis.\r\n\r\nEtiam lacus nisl, lacinia vel accumsan quis, accumsan ac tortor. Nullam euismod in lacus et suscipit. Duis hendrerit condimentum iaculis. In hac habitasse platea dictumst. Suspendisse ornare quis nisl et bibendum. Duis quis massa et dui venenatis condimentum ac at erat. Maecenas egestas vulputate nunc et venenatis. Integer placerat metus urna, ut faucibus sapien accumsan ultrices.\r\n\r\nMaecenas pulvinar sollicitudin laoreet. Praesent euismod mi augue. Nullam tempor libero mauris, id egestas augue varius ut. Integer laoreet posuere dui. Maecenas lobortis scelerisque vulputate. Integer eu sollicitudin leo. Pellentesque tempor justo eget bibendum viverra. Cras nulla eros, rutrum in condimentum vitae, maximus ac arcu. Vestibulum consequat tincidunt arcu, eget porta dui tempus sed. Donec tincidunt odio lobortis mauris pellentesque ultrices.', 'a:1:{i:0;s:8:\"user.png\";}', '2023-12-18 14:48:52'),
(3, 2, 'Bram Hesen', 'bramhesen@ziggo.nl', 'Nice message Lorem Ipsum!', 'a:1:{i:0;s:0:\"\";}', '2023-12-18 14:49:31');

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
