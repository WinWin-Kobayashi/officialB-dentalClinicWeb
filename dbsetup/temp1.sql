-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2023 at 02:53 AM
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
-- Database: `dental_clinic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(10) NOT NULL,
  `date_created` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `time` time(6) NOT NULL,
  `date` date NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `active_gmail` varchar(50) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `service` varchar(50) NOT NULL,
  `screenshot` varchar(60) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `date_created`, `time`, `date`, `first_name`, `last_name`, `active_gmail`, `contact_number`, `service`, `screenshot`, `status`) VALUES
(107, '2023-11-06 18:36:01.261567', '14:35:00.000000', '2023-11-10', 'Rina Mae', 'Romero', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Dental Checkup', '65493219452cb.png', 'Pending'),
(108, '2023-11-06 18:37:13.148769', '11:40:00.000000', '2023-11-10', 'Cat', 'Win', 'crmchs.lawas.cathlenwin@gmail.com', '09184533848', 'Tooth Extraction', '6549326066952.jpg', 'Pending'),
(109, '2023-11-06 18:44:14.709579', '10:40:00.000000', '2023-11-10', 'Marimar', 'Alarde', 'crmchs.alarde.maricar@gmail.com', '666999666', 'Dental Cleaning', '6549340fe5263.png', 'Pending'),
(110, '2023-11-06 19:20:37.270442', '16:21:00.000000', '2023-11-08', 'Boang', 'Ka', 'pengwin553@gmail.com', '666999666', 'Tooth Extraction', '65493c8ec796d.jpg', 'Pending'),
(111, '2023-11-06 19:23:13.976190', '09:10:00.000000', '2023-11-08', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '3532', 'Tooth Extraction', '65493d2b6ae14.jpg', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
