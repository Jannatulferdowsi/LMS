-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 07:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `first name` varchar(100) NOT NULL,
  `last name` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(100) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first name`, `last name`, `Username`, `password`, `email`, `contact`, `pic`) VALUES
(1, 'Nobonita', 'Islam', 'Admin', 'admin@12345', 'n@gmail.com', 9938392, 'user3.jpg'),
(14, 'f', 'f', 'f', 'fffggdfff', 'f', 5, 'user.jpg'),
(15, 'df', 'dfs', 'dsa', 'daF$4dfd', 'dfjkjk@gmail.com', 378, 'user.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `authors` varchar(100) NOT NULL,
  `edition` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bid`, `name`, `authors`, `edition`, `status`, `quantity`, `department`) VALUES
(5, 'System Analysis and Design', 'Mr. Jm', 5, 'Available', 5, 'CSE'),
(3, 'Pythone', 'D Kernel', 5, 'Available', 4, 'CSE'),
(4, 'Java', 'V.K.', 6, 'Available', 16, 'CSE'),
(6, 'Web Programming', 'Mr. k', 2008, 'Available', 3, 'CSE'),
(102, 'Modern Science', 'K N', 5, 'Not-available', 0, 'TE');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `username`, `comment`) VALUES
(12, 'Jannatul', 'Can you tell me when the Technical & vocational Education & Training(TVET) book will be available in library?'),
(15, 'Admin', 'yes'),
(16, 'Admin', 'hi'),
(17, 'Emu', 'Can you tell me about......'),
(18, 'Jannatul', 'Can you tell me when the Technical & vocational Education & Training(TVET) book will be available in library?'),
(19, 'Esmotara', 'Can you tell me about......'),
(20, 'Admin', 'Yes'),
(21, 'lima', 'Can you tell me when the Technical & vocational Education & Training(TVET) book will be available in library?');

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE `fine` (
  `username` varchar(100) NOT NULL,
  `bid` int(100) NOT NULL,
  `returned` varchar(100) NOT NULL,
  `day` int(50) NOT NULL,
  `fine` double NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fine`
--

INSERT INTO `fine` (`username`, `bid`, `returned`, `day`, `fine`, `status`) VALUES
('lima', 1, '2024-05-31', 116, 11.6, 'not paid'),
('Habiba', 6, '2024-05-31', 11, 1.1, 'not paid'),
('Esmotara', 3, '2024-06-02', 18, 1.8, 'not paid'),
('Habiba', 3, '2024-06-02', 29, 2.9, 'not paid'),
('Sumaiya', 1, '2024-06-02', 3, 0.3, 'not paid'),
('ef', 4, '2024-06-02', 2, 0.2, 'not paid'),
('Esmotara', 3, '2024-06-03', 119, 11.9, 'not paid');

-- --------------------------------------------------------

--
-- Table structure for table `issue_book`
--

CREATE TABLE `issue_book` (
  `username` varchar(100) NOT NULL,
  `bid` int(100) NOT NULL,
  `approve` varchar(100) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `return` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_book`
--

INSERT INTO `issue_book` (`username`, `bid`, `approve`, `issue`, `return`) VALUES
('Jannatul', 1, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '', ''),
('Jannatul', 5, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-05-08', '2024-05-15'),
('Jannatul', 2, '0', '', ''),
('Jannatul', 123, '0', '', ''),
('c', 5, '0', '', ''),
('c', 345, '', '', ''),
('Jannatul', 5, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-05-08', '2024-05-15'),
('Jannatul', 5, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-05-08', '2024-05-15'),
('Esmotara', 2, '<p style=\"color:yellow; background-color:red;\"> EXPIRED</p>', '2024-05-08', '2024-05-15'),
('Esmotara', 3, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-01-4', '2024-02-4'),
('Esmotara', 4, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-05-08', '2024-05-15'),
('Esmotara', 3, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-01-4', '2024-02-4'),
('Habiba', 6, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-04-20', '2024-05-20'),
('Emu', 1, '<p style=\"color:yellow; background-color:red;\"> EXPIRED</p>', '2024-01-4', '2024-02-4'),
('Habiba', 3, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-04-4', '2024-05-04'),
('Sumaiya', 1, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-04-30', '2024-05-30'),
('ef', 4, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-05-1', '2024-05-31'),
('Esmotara', 102, '', '', ''),
('Esmotara', 3, '<p style=\"color:yellow; background-color:green;\">RETURNED</p>', '2024-01-4', '2024-02-4'),
('Esmotara', 6, 'Yes', '2024-05-08', '2024-06-8'),
('Sumaiya', 3, 'Yes', '2024-05-08', '2024-06-8'),
('Sumaiya', 5, '<p style=\"color:yellow; background-color:red;\"> EXPIRED</p>', '2024-04-30', '2024-05-30'),
('c', 4, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `first` varchar(100) NOT NULL,
  `last` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roll` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(100) NOT NULL,
  `pic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`first`, `last`, `username`, `password`, `roll`, `email`, `contact`, `pic`) VALUES
('a', 'b', 'c', '14', 12, 'abc@gmail.com', 678543, 'user.jpg'),
('x', 'y', 'z', '12345', 11, 'abc@gmail.com', 1234567, 'user.jpg'),
('Jannatul', 'Ferdowsi', 'Jannatul', '123', 220031406, 'ferdowsi@iut-dhaka.edu', 1709082077, 'user.jpg'),
('Esmotara ', 'Emm', 'Esmotara', '123', 52, 'esmotaraemm8831@gmail.com', 1902028830, 'user.jpg'),
('Most', 'Lipi Khatun', 'lipi', '123', 220031403, 'lipikhatun@iut-dhaka.edu', 1750648507, 'user.jpg'),
('lima', 'khatun', 'lima', '123', 1, 'n@gmail.com', 1234567, 'user.jpg'),
('Umme ', 'Habiba', 'Habiba', '123', 5, 'h@gmail.com', 19000023, 'user.jpg'),
('md ', 'y', 'Md', '123', 123, 'y@gmail.com', 123, 'user.jpg'),
('Umme', 'Habiba', 'Emm', '0', 0, 'esmotaraemm@iut-dhake.edu', 9938392, 'user.jpg'),
('drf', 'fff', 'ff', '0', 0, 'ffd', 0, 'user.jpg'),
('x', 'y', 'z', '0', 0, 'andkdj@gmail.com', 33, 'user.jpg'),
('Most', 'Lipi Khatun', 'Lipi', '0', 220031403, 'lipikhatun@iut-dhaka.edu', 1750648507, 'user.jpg'),
('Mariama', 'Jarjue', 'Mariama', '0', 220031407, 'jarjue@iut-dhaka.edu', 1600413300, 'user.jpg'),
('f', 'f', 'f', '0', 0, 'f', 5, 'user.jpg'),
('ab', 'cd', 'ef', '0', 234, 'kfjjfnfd@gmail.com', 1234, 'user.jpg'),
('Sumaiya', 'Khatun', 'Sumaiya', 'Sumaiya1@', 404, 'sumaiya@gmail.com', 223787367, 'user.jpg'),
('Marjia', 'Jahan', 'Emu', 'Marjia@1', 406, 'marjia@gmail.com', 189287347, 'user.jpg'),
('d', 'd', 'd', 'djsdjD$44jh', 5, 'esmotaraemm@gmail.com', 333, 'user.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
