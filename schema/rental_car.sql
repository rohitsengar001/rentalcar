-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2022 at 10:22 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_car`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_table`
--

CREATE TABLE `auth_table` (
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `user_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth_table`
--

INSERT INTO `auth_table` (`username`, `password`, `user_type`) VALUES
('rohitsengar@gmail.com', 'Abc@321', 'agency'),
('test@gmail.com', 'Test@321', 'agency');

-- --------------------------------------------------------

--
-- Table structure for table `post_cars`
--

CREATE TABLE `post_cars` (
  `username` varchar(30) NOT NULL,
  `vehicle_model` text NOT NULL,
  `vehicle_number` text NOT NULL,
  `seating_capacity` text NOT NULL,
  `filename` text NOT NULL,
  `rent_per_day` text NOT NULL,
  `image_destination` text NOT NULL,
  `token` text NOT NULL,
  `vehicle_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_cars`
--

INSERT INTO `post_cars` (`username`, `vehicle_model`, `vehicle_number`, `seating_capacity`, `filename`, `rent_per_day`, `image_destination`, `token`, `vehicle_id`) VALUES
('test@gmail.com', 'activa125', 'up83ab3344', '2', 'recursion.png', '1000', 'C:/xampp/htdocs/rentalcar/upload/recursion.png', 'valid-user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_table`
--
ALTER TABLE `auth_table`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `post_cars`
--
ALTER TABLE `post_cars`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `vehicle_id` (`vehicle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post_cars`
--
ALTER TABLE `post_cars`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
