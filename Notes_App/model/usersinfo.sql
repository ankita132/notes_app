-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2017 at 08:48 PM
-- Server version: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `usersinfo`
--

CREATE TABLE `usersinfo` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersinfo`
--

INSERT INTO `usersinfo` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `date`) VALUES
(4, 'ankita', 'sahoo', 'ankita132', 'ankita13@gmail.com', '$2y$10$r0ybJE1PDNJeQWpAUgemXeNsR8YVcXrxIIMhFTbypxGthcW4FQ1hG', '0000-00-00'),
(5, 'sourav', 'sinha', 'sourav', 'sourav@gmail.com', '$2y$10$bFGsKpi3vZOVjWmXSWILwusUzE1LMWoMRqIlQQsmeXPfwsY2FIJOO', '0000-00-00'),
(6, 'neha', 'gupta', 'neha32', 'neha32@gmail.com', '$2y$10$QuTvqpPhDgOo/fWOx/1Cce2tCx8r5G09GKPd06szIMBhOvFJZwr46', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usersinfo`
--
ALTER TABLE `usersinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usersinfo`
--
ALTER TABLE `usersinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
