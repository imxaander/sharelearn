-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2023 at 11:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharelearn`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `file_id` int(11) NOT NULL,
  `file_code` varchar(255) NOT NULL,
  `guest_id` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_expiration` datetime NOT NULL,
  `file_security` varchar(255) NOT NULL,
  `uploaded_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`file_id`, `file_code`, `guest_id`, `file_name`, `file_expiration`, `file_security`, `uploaded_date`) VALUES
(1, 'PNHSSVQNP', 'GUESTA2VEG', 'PNHSSVQNP_meow.mp4', '2023-01-02 17:06:00', 'private', '2023-01-02 17:06:00'),
(2, 'PNHSVF8DN', 'GUESTA2VEG', 'PNHSVF8DN_319195562_557662762424846_8816923538024591927_n (1).jpg', '2023-01-03 17:06:38', 'private', '2023-01-02 17:06:38'),
(3, 'PNHSIMC3X', 'GUESTMFTEX', 'PNHSIMC3X_inbound929226905578157429.jpg', '2023-01-03 18:59:43', 'private', '2023-01-02 18:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `guest_id` varchar(255) NOT NULL,
  `guest_type` varchar(255) NOT NULL,
  `device_id` varchar(255) NOT NULL,
  `date_joined` datetime NOT NULL,
  `download_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guest_id`, `guest_type`, `device_id`, `date_joined`, `download_count`) VALUES
('GUESTA2VEG', 'teacher', 'SLUSER63b4aa6c5db8d', '2023-01-02 16:48:59', 0),
('GUESTMFTEX', 'student', 'SLUSER63b2b8f7f255c', '2023-01-02 18:59:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
