-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2021 at 09:11 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shreya`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `contact` int(10) NOT NULL,
  `address` varchar(250) NOT NULL,
  `dt` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `token` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `contact`, `address`, `dt`, `token`, `status`) VALUES
(1, 'shreya.paliwal@gingerwebs.co.in', 'Shreya ', '827ccb0eea8a706c4c34a16891f84e7b', 2147483647, 'raj nagar extension', '2021-07-01 04:51:47.000000', 'f7f1942943c660ab441c2259c017b6', 'active'),
(2, 'shreyapaliwal1412@gmail.com', 'Shreya Paliwal', 'e10adc3949ba59abbe56e057f20f883e', 2147483647, 'raj nagar extension', '2021-07-01 05:39:16.000000', '0a19e2461e05f5f7d76aaf371139d6', 'active'),
(3, 'shreayuu@gmail.com', 'ayush', 'e10adc3949ba59abbe56e057f20f883e', 1234567890, 'raj nagar extension', '2021-07-02 16:59:08.000000', '10f923ef8721c6a1c7d34eff7e1f9d', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
