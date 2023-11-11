-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 07:20 PM
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
(107, '2023-11-06 18:36:01.261567', '14:35:00.000000', '2023-11-10', 'Rina Mae', 'Romero', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Dental Checkup', '654cf9273f984.jpg', 'Pending'),
(108, '2023-11-06 18:37:13.148769', '11:40:00.000000', '2023-11-10', 'Cat', 'Win', 'crmchs.lawas.cathlenwin@gmail.com', '09184533848', 'Tooth Extraction', '6549326066952.jpg', 'Pending'),
(109, '2023-11-06 18:44:14.709579', '10:40:00.000000', '2023-11-10', 'Marimar', 'Alarde', 'crmchs.alarde.maricar@gmail.com', '666999666', 'Dental Cleaning', '6549340fe5263.png', 'Pending'),
(110, '2023-11-06 19:20:37.270442', '16:21:00.000000', '2023-11-08', 'Boang', 'Ka', 'pengwin553@gmail.com', '666999666', 'Tooth Extraction', '65493c8ec796d.jpg', 'Pending'),
(111, '2023-11-06 19:23:13.976190', '09:10:00.000000', '2023-11-08', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '3532', 'Tooth Extraction', '65493d2b6ae14.jpg', 'Pending'),
(112, '2023-11-09 15:22:06.175203', '00:23:00.000000', '2023-11-30', 'Rina Mae', 'Romero', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Dental Checkup', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `booking_history_table`
--

CREATE TABLE `booking_history_table` (
  `patient_id` int(10) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `appointment_id` int(10) NOT NULL,
  `date_created` datetime(6) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL,
  `service` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients_table1`
--

CREATE TABLE `patients_table1` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthdate` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `active_gmail` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `vkey` varchar(50) NOT NULL,
  `verified` tinyint(50) NOT NULL,
  `create_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `med_info_1` varchar(50) NOT NULL,
  `med_info_2` varchar(50) NOT NULL,
  `med_info_3` varchar(50) NOT NULL,
  `med_info_4` varchar(50) NOT NULL,
  `med_info_5` varchar(50) NOT NULL,
  `med_info_6` varchar(50) NOT NULL,
  `med_info_7` varchar(50) NOT NULL,
  `med_info_8` varchar(50) NOT NULL,
  `med_info_9` varchar(50) NOT NULL,
  `med_info_10` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients_table1`
--

INSERT INTO `patients_table1` (`id`, `first_name`, `last_name`, `birthdate`, `gender`, `address`, `contact_number`, `active_gmail`, `password`, `vkey`, `verified`, `create_date`, `med_info_1`, `med_info_2`, `med_info_3`, `med_info_4`, `med_info_5`, `med_info_6`, `med_info_7`, `med_info_8`, `med_info_9`, `med_info_10`) VALUES
(15, 'Rina Mae', 'Romero', '2023-11-01', 'Female', 'Taytay Rizal', '09123456789', 'arianatorswiftyfangurl@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '822276', 1, '2023-11-09 18:19:20.023232', 'one', 'two', '3', '4', '5', '6', '7', '8', '9', '0'),
(16, 'Victoria', 'Kobayashi', '2023-11-04', 'Male', 'Oshiis', '3532', 'victoriakobayashi553@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '149110', 1, '2023-11-03 02:11:28.744489', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
(17, 'Cat', 'Win', '2003-05-05', 'Female', 'Gairan, Bogo City, Cebu', '09184533848', 'crmchs.lawas.cathlenwin@gmail.com', 'b67f48e797bab446b99745bd9b3f0b73', '470469', 1, '2023-11-03 08:21:56.524183', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
(18, 'Boang', 'Ka', '2023-11-30', 'Female', 'Somewhere in Brooklyn', '666999666', 'pengwin553@gmail.com', '6fb42da0e32e07b61c9f0251fe627a9c', '322403', 1, '2023-11-03 14:04:18.479808', 'sdaf', 'asdf', 'asdf', 'aadfs', 'asdf', 'asdf', 'asdf', 'dsfasdf', 'adsf', 'adsf'),
(19, 'Kuro', 'Kobayashi', '2023-11-16', 'Female', 'Ambot', '09123456789', 'kuro07082022@gmail.com', '0131646d9067dfe01a2339791e246821', '855562', 1, '2023-11-05 15:27:28.050853', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
(20, 'Marimar', 'Alarde', '2023-11-30', 'Male', 'Libertad National Highschool', '666999666', 'crmchs.alarde.maricar@gmail.com', '6fb42da0e32e07b61c9f0251fe627a9c', '856618', 1, '2023-11-06 18:43:04.293071', 'dasf', 'dasf', 'adsf', 'asdf', 'adsf', 'adsf', 'asf', 'adsf', 'asdf', 'asdf'),
(21, 'dsafdsafasdf', 'asdfasdfasdf', '2023-11-10', 'Female', 'dsaf', 'asdfasdf', 'adsf@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '315973', 0, '2023-11-06 19:25:17.666398', 'dasfasd', 'dsafasdf', 'dsafasdf', 'sadfsadf', 'sadfasdf', 'adsfasdf', 'adsfasdf', 'sadfasdf', 'asdfasdf', 'sadfsdaf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients_table1`
--
ALTER TABLE `patients_table1`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `patients_table1`
--
ALTER TABLE `patients_table1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
