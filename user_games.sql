-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 02, 2023 at 06:26 PM
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
-- Table structure for table `user_games`
--

CREATE TABLE `user_games` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `progress` enum('Plan to play','Playing','Completed','Replaying','Paused','Dropped') DEFAULT NULL,
  `score` int(11) NOT NULL CHECK (`score` >= 0 and `score` <= 10),
  `review` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_games`
--

INSERT INTO `user_games` (`id`, `user_id`, `game_id`, `progress`, `score`, `review`) VALUES
(1, 21, 3, 'Plan to play', 9, 'LET US TAKE OUR SHATTERED SKIES!'),
(2, 18, 1, 'Completed', 10, 'RAZGRIZ!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_games`
--
ALTER TABLE `user_games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_game` (`user_id`,`game_id`),
  ADD KEY `game_id` (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_games`
--
ALTER TABLE `user_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_games`
--
ALTER TABLE `user_games`
  ADD CONSTRAINT `user_games_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_games_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
