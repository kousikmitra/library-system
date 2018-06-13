-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2018 at 06:03 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `callno` varchar(15) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`callno`, `total`) VALUES
('005.133 BAL/P', 0);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `callno` varchar(15) NOT NULL,
  `title` varchar(30) NOT NULL,
  `author` varchar(40) NOT NULL,
  `publisher` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `addedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`callno`, `title`, `author`, `publisher`, `description`, `addedat`) VALUES
('005.133 BAL/P', 'Programming with Java', 'E. Balagurusamy', 'Tata', 'A java book for beginners', '2018-06-12 14:47:19');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `callno` varchar(15) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`callno`, `name`) VALUES
('005.133 BAL/P', 'Computer Science'),
('005.133 BAL/P', 'BCA'),
('005.133 BAL/P', 'Programming');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `s_id` varchar(15) NOT NULL,
  `s_name` varchar(30) NOT NULL,
  `s_email` varchar(30) NOT NULL,
  `s_password` varchar(200) NOT NULL,
  `s_phone` varchar(10) NOT NULL,
  `s_dept` varchar(8) NOT NULL,
  `s_regno` varchar(8) NOT NULL,
  `s_regyear` varchar(10) NOT NULL,
  `s_status` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `s_name`, `s_email`, `s_password`, `s_phone`, `s_dept`, `s_regno`, `s_regyear`, `s_status`) VALUES
('14HCS0012', 'Kousik Mitra', 'kousikmitra12@gmail.com', '1c67ee36c804535aaad79441c2f4cf65', '8145169168', 'COSH', '2', '2014-2015', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD UNIQUE KEY `callno` (`callno`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`callno`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`),
  ADD UNIQUE KEY `s_email` (`s_email`),
  ADD UNIQUE KEY `s_phone` (`s_phone`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
