-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2023 at 10:53 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `name` varchar(50) NOT NULL,
  `batch` int(3) NOT NULL,
  `id` varchar(11) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `gender` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`name`, `batch`, `id`, `semester`, `gender`, `email`, `password`, `address`, `photo`) VALUES
('Md Toufiq', 13, '01821106001', '4', 'Male', 'toufiq@gmail.com', '111111', 'Bogura', '01821106001.jpg'),
('Mst Bonna', 18, '01821106004', '4', 'Female', 'bonna@gmail.com', '123456', 'Bogura', '01821106004.jpg'),
('Md. Nahid Hasan', 10, '01821106007', '4', 'Male', 'nahidcse.pub@gmail.com', '123456', 'Phulbari, Kurigram.', '01821106007.jpg'),
('Md. Muksit', 12, '01821106008', '4', 'Male', 'muksit@gmail.com', '123456', 'Gabtoli', '01821106008.jpg'),
('Md Naeem Islam', 18, '01821106011', '4', 'Male', 'naeem@gmail.com', '123456', 'Bogura', '01821106011.jpg'),
('Mr xxyz', 12, '01821106015', '4', 'Male', 'xyz@gmail.com', '123123', 'Bogura', 'image.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
