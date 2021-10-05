-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2021 at 08:16 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(100) NOT NULL,
  `bookname` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `publisher` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `bookname`, `category`, `publisher`, `year`, `isbn`, `date`, `status`, `image`) VALUES
(14, 'gfd', 'Business', 'fvfff', '2021', '2021', '2021-10-01', 'Available', '55760451_6117218410266_5009126993325719552_n.png'),
(16, 'some book', 'Information Technology', 'fvfff', '2021', '22336', '2021-10-03', 'Available', '55417551_6116454915866_2956305141789097984_n.png');

-- --------------------------------------------------------

--
-- Table structure for table `lendingbooks`
--

CREATE TABLE `lendingbooks` (
  `id` int(100) NOT NULL,
  `code` text NOT NULL,
  `book` varchar(100) NOT NULL,
  `student` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `days` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lendingbooks`
--

INSERT INTO `lendingbooks` (`id`, `code`, `book`, `student`, `date`, `days`) VALUES
(16, 'LE#215752', 'aa', 'ruzny', '2021-09-15', 10),
(19, 'LE#203820', 'some book', 'hello', '2021-10-03', 30),
(20, 'LE#231922', 'some book', 'Hell', '2021-10-05', 20),
(21, 'LE#232342', 'some book', 'Hell', '2021-10-05', 20),
(22, 'LE#23288', 'some book', 'Hell', '2021-10-05', 30);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `UID` int(100) NOT NULL,
  `BID` int(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `date`, `UID`, `BID`, `status`) VALUES
(1, '2021-10-05', 56, 16, 'Lended'),
(2, '2021-10-05', 56, 16, 'Canceled'),
(3, '2021-10-05', 57, 16, 'Pending'),
(4, '2021-10-05', 56, 16, 'Canceled'),
(5, '2021-10-05', 56, 14, 'Canceled'),
(6, '2021-10-05', 56, 16, 'Lended');

-- --------------------------------------------------------

--
-- Table structure for table `returnbooks`
--

CREATE TABLE `returnbooks` (
  `id` int(100) NOT NULL,
  `lendingid` varchar(100) NOT NULL,
  `returndate` date NOT NULL,
  `lendingdate` date NOT NULL,
  `freedays` varchar(100) NOT NULL,
  `addays` int(100) NOT NULL,
  `amount` decimal(65,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `returnbooks`
--

INSERT INTO `returnbooks` (`id`, `lendingid`, `returndate`, `lendingdate`, `freedays`, `addays`, `amount`) VALUES
(8, '16', '2021-10-03', '2021-09-15', '10  ', 8, '400'),
(10, '16', '2021-10-05', '2021-09-15', '10', 10, '500');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile`, `first_name`, `last_name`, `mobile`, `email`, `role`, `password`) VALUES
(55, '52684873_6113151779371_762149325429014528_n.png', 'hello', 'world', '7675759177', 'hello1@gmail.com', 'Librarian', '123456'),
(56, '52684873_6113151779371_762149325429014528_n.png', 'Hell', 'world', '7562428030', 'student@gmail.com', 'Student', '123456'),
(57, '', 'hello', 'world', '0756242803', 'hello@gmail.com', 'Student', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lendingbooks`
--
ALTER TABLE `lendingbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returnbooks`
--
ALTER TABLE `returnbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lendingbooks`
--
ALTER TABLE `lendingbooks`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `returnbooks`
--
ALTER TABLE `returnbooks`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
