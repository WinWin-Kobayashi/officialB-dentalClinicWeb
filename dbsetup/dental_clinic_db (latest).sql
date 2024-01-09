-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 03:58 AM
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
-- Table structure for table `admins_table`
--

CREATE TABLE `admins_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins_table`
--

INSERT INTO `admins_table` (`id`, `name`, `email`, `password`) VALUES
(1, 'mayoladmin', 'mayoladmin@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f');

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
(197, '2023-12-23 16:40:04.609467', '13:40:00.000000', '2024-01-01', 'Rina Mae', 'Romero-Lawas', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Pulpotomy and Root Canal Treatment', '65870d76d083a.png', 'Accepted'),
(198, '2023-12-31 10:28:24.882097', '18:31:00.000000', '2023-12-13', 'Cat', 'Win', 'crmchs.lawas.cathlenwin@gmail.com', '09123456789', 'Dental Crowns', '659142687e139.png', 'Accepted'),
(199, '2023-12-31 13:44:32.245439', '13:44:00.000000', '2023-12-20', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '09184533848', 'Dental Crowns', '65917048c7f02.png', 'Cancelled'),
(200, '2023-12-31 13:52:56.407634', '10:52:00.000000', '2024-01-01', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '09184533848', 'Operculectomy', '65917240c655b.jpg', 'Accepted'),
(201, '2023-12-31 13:55:33.310851', '11:56:00.000000', '2024-01-02', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '09184533848', 'Dental Crowns', '659172db9d21f.jpg', 'Accepted'),
(202, '2023-12-31 14:44:18.896756', '14:44:00.000000', '2024-01-05', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '09184533848', 'Dental Bridges', '65917e573f33c.png', 'Accepted'),
(203, '2023-12-31 16:39:10.262536', '05:44:00.000000', '2024-01-10', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '09184533848', 'Dental Bridges', '65919937d21a3.jpg', 'Cancelled'),
(204, '2023-12-31 16:43:01.383489', '16:46:00.000000', '2024-01-01', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '09184533848', 'Operculectomy', '65919a1add973.jpg', 'Accepted'),
(205, '2023-12-31 17:27:48.764200', '09:00:00.000000', '2024-01-02', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '09184533848', 'Complete Denture', '6591a49a0f61c.jpg', 'Accepted'),
(206, '2024-01-01 10:22:31.375511', '07:25:00.000000', '2024-01-03', 'Rina Mae', 'Romero-Lawas', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Operculectomy', '65929275a4e76.png', 'Cancelled'),
(207, '2024-01-01 10:34:58.297215', '18:34:00.000000', '2024-01-25', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '09184533848', 'Dental Bridges', '65929562677f1.png', 'Cancelled'),
(208, '2024-01-01 14:29:48.211021', '22:32:00.000000', '2024-01-03', 'Rina Mae', 'Romero-Lawas', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Dental Crowns', '6592cc627b9f2.png', 'Cancelled'),
(209, '2024-01-01 14:32:58.207584', '13:32:00.000000', '2024-01-17', 'Boang', 'Ka', 'pengwin553@gmail.com', '666999666', 'Dental Crowns', '6592cd23a3370.jpg', 'Cancelled'),
(210, '2024-01-01 15:48:13.769583', '23:49:00.000000', '2024-01-03', 'Victoria', 'Kobayashi', 'victoriakobayashi553@gmail.com', '09184533848', 'Operculectomy', '6592dec59c3e9.png', 'Cancelled'),
(211, '2024-01-01 16:25:42.951342', '08:30:00.000000', '2024-01-02', 'Rina Mae', 'Romero-Lawas', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Operculectomy', '6592e78c49b8a.png', 'Accepted'),
(212, '2024-01-03 10:12:53.950444', '14:00:00.000000', '2024-01-04', 'Cat', 'Win', 'crmchs.lawas.cathlenwin@gmail.com', '09123456789', 'Dental Crowns', '6595332d2cb99.png', 'Accepted'),
(213, '2024-01-03 10:16:26.619780', '11:00:00.000000', '2024-01-04', 'Cat', 'Win', 'crmchs.lawas.cathlenwin@gmail.com', '09123456789', 'Operculectomy', '65953408bcedc.jpg', 'Accepted'),
(214, '2024-01-03 10:20:09.712096', '10:30:00.000000', '2024-01-04', 'Cat', 'Win', 'crmchs.lawas.cathlenwin@gmail.com', '09123456789', 'Dental Bridges', '659534df1e0ce.png', 'Accepted'),
(215, '2024-01-03 10:29:20.451142', '11:30:00.000000', '2024-01-05', 'Cat', 'Win', 'crmchs.lawas.cathlenwin@gmail.com', '09123456789', 'Pulpotomy and Root Canal Treatment', '65953706eced8.jpg', 'Cancelled'),
(216, '2024-01-03 10:42:13.333460', '08:00:00.000000', '2024-01-04', 'Rina Mae', 'Romero-Lawas', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Operculectomy', '65953a0b797f9.jpg', 'Accepted'),
(217, '2024-01-03 10:42:35.747719', '09:30:00.000000', '2024-01-05', 'Rina Mae', 'Romero-Lawas', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Pulpotomy and Root Canal Treatment', '65953a20528e9.jpg', 'Accepted'),
(218, '2024-01-04 02:45:52.825074', '11:00:00.000000', '2024-01-04', 'Rina Mae', 'Romero-Lawas', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Dental Bridges', '65961be7b84b7.jpg', 'Cancelled'),
(219, '2024-01-04 02:54:30.890205', '11:30:00.000000', '2024-01-05', 'Rina Mae', 'Romero-Lawas', 'arianatorswiftyfangurl@gmail.com', '09123456789', 'Dental Crowns', '65961dec7bcf0.jpg', 'Pending');

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
(15, 'Rina Mae', 'Romero-Lawas', '1998-03-14', 'Female', 'Taytay Rizal Province of Manila Province', '09123456789', 'arianatorswiftyfangurl@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '822276', 1, '2023-12-19 19:19:03.194539', 'I', 'love', 'you,', 'Len', 'because', 'I', 'am', 'a', 'pedo', 'for you.'),
(18, 'Boang', 'Ka', '2023-11-30', 'Female', 'Somewhere in Brooklyn', '666999666', 'pengwin553@gmail.com', '6fb42da0e32e07b61c9f0251fe627a9c', '322403', 1, '2023-12-19 16:15:54.375994', 'sdaf', 'asdf', 'asdf', 'aadfs', 'asdf', 'asdf', 'asdf', 'dsfasdf', 'adsf', 'atay'),
(19, 'Kuro', 'Kobayashi', '2023-11-16', 'Female', 'Ambot', '09123456789', 'kuro07082022@gmail.com', '0131646d9067dfe01a2339791e246821', '855562', 1, '2023-11-05 15:27:28.050853', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
(20, 'Marimar', 'Alarde', '2023-11-30', 'Male', 'Libertad National Highschool', '666999666', 'crmchs.alarde.maricar@gmail.com', '6fb42da0e32e07b61c9f0251fe627a9c', '856618', 1, '2023-11-06 18:43:04.293071', 'dasf', 'dasf', 'adsf', 'asdf', 'adsf', 'adsf', 'asf', 'adsf', 'asdf', 'asdf'),
(35, 'Edison', 'Pagatpat', '2023-12-10', 'Other', 'Cayang, Bogo City, Cebu', '0999666999', 'dagg3r.hilt@gmail.com', '6fb42da0e32e07b61c9f0251fe627a9c', '149099', 1, '2023-12-19 16:05:16.946097', 'ad', 'ad', 'ad', 'ad', 'ad', 'ad', 'ad', 'ad', 'ad', 'ad'),
(45, 'Athena ', 'Saquibal', '2023-12-12', 'Male', 'Polambato, Bogo City, Cebu', '09553603357', 'athenasaquibal2@gmail.com', 'c0c5611d2f86e1e727c8afea97267bf7', '157574', 1, '2023-12-19 16:03:53.967696', 'heartbroken', 'gay', 'gay horny', 'jesus is pregnant trust me', 'judas is the father', 'trust me bro', 'seriously', 'I love america', 'and Russia', 'Russia women are beautiful like goldi'),
(46, 'Victoria', 'Kobayashi', '2023-12-20', 'Female', 'Gairan, Bogo City, Cebu', '09184533848', 'victoriakobayashi553@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '140853', 1, '2023-12-19 16:21:33.074482', 'I love Mae', 'vik2', 'vik3', 'vik4', 'vik5', 'vik6', 'vik7', 'vik8', 'vik9', 'i love rina'),
(56, 'Carla Rey', 'Maono', '2023-12-23', 'it', 'Pandan,  Bogo City, Cebu', '09090909090', '', '', '', 1, '2023-12-26 15:05:54.297468', 'I love my mama dory', '', '', '', '', '', '', '123', 'i', 'so much'),
(61, 'Cat', 'Win', '2023-12-08', 'Female', 'Gairan, Bogo City, Cebu', '09123456789', 'crmchs.lawas.cathlenwin@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', '840508', 1, '2023-12-31 10:48:00.213416', 'dasdasf', 'asdf', 'asdf', 'asdf', 'dsaf', 'adsf', 'asdf', 'asdf', 'adsf', 'ten');

-- --------------------------------------------------------

--
-- Table structure for table `reminders_sent`
--

CREATE TABLE `reminders_sent` (
  `id` int(11) NOT NULL,
  `reminder_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reminders_sent`
--

INSERT INTO `reminders_sent` (`id`, `reminder_date`) VALUES
(2, '2024-01-04');

-- --------------------------------------------------------

--
-- Table structure for table `treatment_records`
--

CREATE TABLE `treatment_records` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `tooth_number` varchar(50) NOT NULL,
  `procedures_performed` varchar(255) NOT NULL,
  `amount_charged` varchar(50) NOT NULL,
  `amount_paid` varchar(50) NOT NULL,
  `patient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treatment_records`
--

INSERT INTO `treatment_records` (`id`, `date`, `tooth_number`, `procedures_performed`, `amount_charged`, `amount_paid`, `patient_id`) VALUES
(1, '2023-12-20', '#1, #2', 'root canal', '10000', '10000', 17),
(2, '2023-12-20', '#1, #2', 'root canal', '10000', '10000', 43),
(3, '2023-12-20', '22', 'Tooth extraction', '300', '300', 18),
(32, '2023-12-23', '21', 'Tooth Massage PREMIUM', '2100', '2100', 56),
(34, '2023-12-06', '123', 'goods lods', '1', '1', 43),
(36, '2023-12-20', '666999', 'Dental Cleaning pro', '100', '100', 45),
(40, '0000-00-00', '', '', '', '', 0),
(41, '0000-00-00', '', '', '', '', 0),
(42, '0000-00-00', '', '', '', '', 0),
(43, '0000-00-00', '', '', '', '', 0),
(48, '2023-12-23', '1', 'Tooth massage vip', '666', '999', 56),
(49, '2023-12-30', '1', 'Tooth Decay', '1000000', '0', 46),
(50, '2024-01-01', '1', 'Root Canal (1-Day rct) *recall after 3-6 months. *plastic crown is not advised not more than 3wks after today.', '5000', '5000', 15),
(51, '2023-12-30', '100', 'tooth ache', '1000000', '1000000', 61),
(52, '2023-12-21', '1', 'tooth ache', '999', '999', 46),
(53, '2024-01-18', 'adf', 'dsaf', '1212', '123', 45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins_table`
--
ALTER TABLE `admins_table`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `reminders_sent`
--
ALTER TABLE `reminders_sent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatment_records`
--
ALTER TABLE `treatment_records`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins_table`
--
ALTER TABLE `admins_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `patients_table1`
--
ALTER TABLE `patients_table1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `reminders_sent`
--
ALTER TABLE `reminders_sent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `treatment_records`
--
ALTER TABLE `treatment_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
