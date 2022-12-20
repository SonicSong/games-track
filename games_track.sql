-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2022 at 05:34 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `games_track`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `publisher` text DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `genre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `publisher`, `release_date`, `genre`) VALUES
(1, 'Ace Combat 5: The Unsung War', 'Namco', '2004-10-21', 'Air combat simulation'),
(3, 'Ace Combat 04: Shattered Skies', 'Namco', '2001-09-13', 'Air combat simulation'),
(4, 'Ace Combat Zero: The Belkan War', 'Namco', '2006-03-23', 'Air combat simulation'),
(5, 'Ace Combat 3: Electrosphere', 'Namco', '1999-05-27', 'Air combat simulation'),
(6, 'Ace Combat 6: Fires of Liberation', 'Namco Bandai Games', '2007-10-23', 'Air combat simulation'),
(7, 'Ace Combat 7: Skies Unknown', 'Bandai Namco Entertainment', '2019-01-18', 'Air combat simulation'),
(8, 'Ace Combat 2', 'Namco', '1997-05-30', 'Air combat simulation'),
(9, 'Ace Combat', 'Namco', '1995-06-30', 'Combat flight simulation'),
(10, 'World of Warcraft', 'Blizzard Entertainment', '2004-11-23', 'Massively multiplayer online role-playing'),
(11, 'Command & Conquer: Remastered Collection', 'Electronic Arts', '2020-06-05', 'Real-time strategy');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(75) NOT NULL,
  `creation_date` datetime NOT NULL,
  `is_admin` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `creation_date`, `is_admin`) VALUES
(1, 'admin', 'c380f833034d60bf035a134094eb538d600dc6f9', 'example@example.org', '2022-12-20 08:20:16', b'1'),
(2, 'SonicSong', '1fce47db018ccbc4c34df8acf925c5b92bc804e1', 'example1@example.org', '2022-12-20 08:52:16', b'0'),
(3, 'cvuj', '3004a9bd2c08c43cc92ffb1c73cf1f29560f9f78', 'example2@example.org', '2022-12-20 09:38:38', b'0'),
(6, '', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '', '2022-12-20 09:43:56', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
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
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
