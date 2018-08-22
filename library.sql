-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2018 at 05:12 PM
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
('005.133 BAL/P', 4),
('12444', 5);

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
  `image` varchar(100) NOT NULL DEFAULT 'bookimage.jpg',
  `addedat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`callno`, `title`, `author`, `publisher`, `description`, `image`, `addedat`) VALUES
('005.133 BAL/P', 'Programming with Java', 'E. Balagurusamy', 'Tata', 'A java book for beginners', 'bookimage.jpg', '2018-06-12 14:47:19'),
('12444', 'Java Starter', 'Schilbetatz', 'EEE', 'java Book for beginner', 'bookimage.jpg', '2018-06-23 14:33:36');

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
('005.133 BAL/P', 'Programming'),
('12444', 'Programming'),
('12444', 'Java');

-- --------------------------------------------------------

--
-- Table structure for table `forgotpass`
--

CREATE TABLE `forgotpass` (
  `email` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `otp` varchar(5) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `id` int(11) NOT NULL,
  `req_id` varchar(10) NOT NULL,
  `s_id` varchar(15) NOT NULL,
  `callno` varchar(20) NOT NULL,
  `acc_no` varchar(8) NOT NULL,
  `issue_date` date NOT NULL,
  `issue_time` time NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `l_id` int(11) NOT NULL,
  `l_userid` varchar(15) NOT NULL,
  `l_password` varchar(100) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `l_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`l_id`, `l_userid`, `l_password`, `l_name`, `l_date`) VALUES
(1, 'admin', 'admin', 'Admin', '2018-07-12 02:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `s_id` varchar(15) NOT NULL,
  `callno` varchar(15) NOT NULL,
  `req_date` date NOT NULL,
  `req_time` time NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `s_id`, `callno`, `req_date`, `req_time`, `status`) VALUES
(6, '14HCS0012', '005.133 BAL/P', '2018-06-23', '23:28:51', 1),
(7, '14HCS0012', '12444', '2018-06-24', '00:01:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `return_books`
--

CREATE TABLE `return_books` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `s_id` varchar(10) NOT NULL,
  `callno` varchar(15) NOT NULL,
  `acc_no` varchar(10) NOT NULL,
  `issue_date` date NOT NULL,
  `returned_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_books`
--

INSERT INTO `return_books` (`id`, `req_id`, `s_id`, `callno`, `acc_no`, `issue_date`, `returned_date`) VALUES
(1, 6, '14HCS0012', '005.133 BAL/P', '090909', '2018-07-23', '2018-08-16'),
(2, 7, '14HCS0012', '12444', '12345678', '2018-07-23', '2018-08-16');

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
('14HCS0012', 'Kousik Mitra', 'kousikmitra12@gmail.com', '8b01bb02da6b4dc4873f124d679861a4', '8145169168', 'COSH', '2', '2014-2015', '1');

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
-- Indexes for table `forgotpass`
--
ALTER TABLE `forgotpass`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`l_userid`),
  ADD UNIQUE KEY `l_id` (`l_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_books`
--
ALTER TABLE `return_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`),
  ADD UNIQUE KEY `s_email` (`s_email`),
  ADD UNIQUE KEY `s_phone` (`s_phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `return_books`
--
ALTER TABLE `return_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
