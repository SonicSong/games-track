-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2023 at 09:47 PM
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
  `title` text NOT NULL,
  `release_date` date DEFAULT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp(),
  `genres_id` int(11) DEFAULT NULL,
  `publishers_id` int(11) DEFAULT NULL,
  `platforms_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `release_date`, `date_added`, `genres_id`, `publishers_id`, `platforms_id`) VALUES
(1, 'Ace Combat 5: The Unsung War', '2004-10-21', '2022-12-20', 1, 1, 3),
(2, 'Outer Wilds', '2019-05-28', '2022-12-26', 2, 2, 12),
(3, 'Ace Combat 04: Shattered Skies', '2001-09-13', '2022-12-20', 1, 1, 3),
(4, 'Ace Combat Zero: The Belkan War', '2006-03-23', '2022-12-20', 1, 1, 3),
(5, 'Ace Combat 3: Electrosphere', '1999-05-27', '2022-12-20', 1, 1, 2),
(6, 'Ace Combat 6: Fires of Liberation', '2007-10-23', '2022-12-20', 1, 3, 9),
(7, 'Ace Combat 7: Skies Unknown', '2019-01-18', '2022-12-20', 1, 4, 12),
(8, 'Ace Combat 2', '1997-05-30', '2022-12-20', 1, 1, 2),
(9, 'Ace Combat', '1995-06-30', '2022-12-20', 1, 1, 2),
(10, 'World of Warcraft', '2004-11-23', '2022-12-20', 4, 5, 1),
(11, 'Command & Conquer: Remastered Collection', '2020-06-05', '2022-12-20', 5, 6, 1),
(12, 'Death Stranding', '2019-11-08', '2022-12-26', 3, 7, 5),
(13, 'Project Wingman', '2020-12-01', '2022-12-26', 1, 8, 1),
(14, 'Stardew Valley', '2016-02-26', '2022-12-26', 13, 9, 1),
(15, 'Fallout: New Vegas', '2010-10-19', '2022-12-26', 10, 10, 14),
(16, 'Fallout 3', '2008-12-31', '2022-12-30', 10, 10, 14),
(17, 'Code Vein', '2019-09-27', '2023-01-04', 10, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genres` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genres`) VALUES
(1, 'Air combat simulation'),
(2, 'Action-adventure'),
(3, 'Action'),
(4, 'Massively multiplayer online role-playing'),
(5, 'Real-time strategy'),
(6, 'First-person shooter'),
(7, 'Massively multiplayer online'),
(8, 'Factory simulation'),
(9, 'Space trading and combat'),
(10, 'Action role-playing'),
(11, 'Roguelike'),
(12, 'Third-person shooter'),
(13, 'Simulation'),
(14, 'Tactical role-playing'),
(15, 'Tower defense'),
(16, 'Survival horror'),
(17, 'Top-down shooter'),
(18, ' Puzzle'),
(19, 'Music'),
(20, 'Open World'),
(21, 'Party'),
(22, 'Metroidvania');

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

CREATE TABLE `platforms` (
  `id` int(11) NOT NULL,
  `platforms` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`id`, `platforms`) VALUES
(1, 'PC'),
(2, 'Play Station'),
(3, 'Play Station 2'),
(4, 'Play Station 3'),
(5, 'Play Station 4'),
(6, 'Play Station 4'),
(7, 'Play Station 5'),
(8, 'Xbox'),
(9, 'Xbox 360'),
(10, 'Xbox One'),
(11, 'Xbox Series X/S'),
(12, 'PC/Xbox One/Play Station 4'),
(13, 'PC/Xbox Series/Play Station 5'),
(14, 'PC/Xbox 360/Play Station 3');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `id` int(11) NOT NULL,
  `publisher` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`id`, `publisher`) VALUES
(1, 'Namco'),
(2, 'Annapurna Interactive'),
(3, 'Namco Bandai Games'),
(4, 'Bandai Namco Entertainment'),
(5, 'Blizzard Entertainment'),
(6, 'Electronic Arts'),
(7, 'Sony Interactive Entertainment'),
(8, 'Humble Games'),
(9, 'ConcernedApe'),
(10, 'Bethesda Softworks');

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
(18, 'admin', 'c380f833034d60bf035a134094eb538d600dc6f9', 'example@example.org', '2022-12-23 23:10:47', b'1'),
(21, 'Robert', '1fce47db018ccbc4c34df8acf925c5b92bc804e1', 'asd@asd.pl', '2022-12-30 15:57:12', b'0');

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
(1, 21, 3, 'Paused', 0, 'N/A'),
(2, 18, 1, 'Completed', 10, 'The Unsung War'),
(4, 21, 6, 'Completed', 10, 'N/A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`) USING HASH,
  ADD KEY `games_ibfk_1` (`genres_id`),
  ADD KEY `games_ibfk_2` (`publishers_id`),
  ADD KEY `games_ibfk_3` (`platforms_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_games`
--
ALTER TABLE `user_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`genres_id`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `games_ibfk_2` FOREIGN KEY (`publishers_id`) REFERENCES `publishers` (`id`),
  ADD CONSTRAINT `games_ibfk_3` FOREIGN KEY (`platforms_id`) REFERENCES `platforms` (`id`);

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
