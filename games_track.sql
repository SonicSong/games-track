-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Gru 2022, 22:05
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `games_track`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `publisher` text DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `genre` text NOT NULL,
  `platform` text DEFAULT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `games`
--

INSERT INTO `games` (`id`, `title`, `publisher`, `release_date`, `genre`, `platform`, `date_added`) VALUES
(1, 'Ace Combat 5: The Unsung War', 'Namco', '2004-10-21', 'Air combat simulation', 'Play Station 2', '2022-12-20'),
(2, 'Outer Wilds', 'Annapurna Interactive', '2019-05-28', 'Action-adventure', 'PC/Xbox One/Play Station 4', '2022-12-26'),
(3, 'Ace Combat 04: Shattered Skies', 'Namco', '2001-09-13', 'Air combat simulation', 'Play Station 2', '2022-12-20'),
(4, 'Ace Combat Zero: The Belkan War', 'Namco', '2006-03-23', 'Air combat simulation', 'Play Station 2', '2022-12-20'),
(5, 'Ace Combat 3: Electrosphere', 'Namco', '1999-05-27', 'Air combat simulation', 'Play Station', '2022-12-20'),
(6, 'Ace Combat 6: Fires of Liberation', 'Namco Bandai Games', '2007-10-23', 'Air combat simulation', 'Xbox 360', '2022-12-20'),
(7, 'Ace Combat 7: Skies Unknown', 'Bandai Namco Entertainment', '2019-01-18', 'Air combat simulation', 'PC/Xbox One/Play Station 4', '2022-12-20'),
(8, 'Ace Combat 2', 'Namco', '1997-05-30', 'Air combat simulation', 'Play Station', '2022-12-20'),
(9, 'Ace Combat', 'Namco', '1995-06-30', 'Air combat simulation', 'Play Station', '2022-12-20'),
(10, 'World of Warcraft', 'Blizzard Entertainment', '2004-11-23', 'Massively multiplayer online role-playing', 'PC', '2022-12-20'),
(11, 'Command & Conquer: Remastered Collection', 'Electronic Arts', '2020-06-05', 'Real-time strategy', 'PC', '2022-12-20'),
(12, 'Death Stranding', 'Sony Interactive Entertainment', '2019-11-08', 'Action', 'Play Station 4', '2022-12-26'),
(13, 'Project Wingman', 'Humble Games', '2020-12-01', 'Air combat simulation', 'PC', '2022-12-26'),
(14, 'Stardew Valley', 'ConcernedApe', '2016-02-26', 'Simulation', 'PC', '2022-12-26'),
(17, 'Fallout: New Vegas', 'Bethesda Softworks', '2010-10-19', 'Action role-playing', 'PC/Xbox 360/Play Station 3', '2022-12-26');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(150) NOT NULL,
  `email` varchar(75) NOT NULL,
  `creation_date` datetime NOT NULL,
  `is_admin` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `creation_date`, `is_admin`) VALUES
(2, 'SonicSong', '1fce47db018ccbc4c34df8acf925c5b92bc804e1', 'example1@example.org', '2022-12-20 08:52:16', b'0'),
(3, 'cvuj', '2a1dc769d77ec17186d03c701408d3d7d65347d3', 'example2@example.org', '2022-12-20 09:38:38', b'0'),
(16, 'Robert', '3da541559918a808c2402bba5012f6c60b27661c', 'asdf@asdf.aa', '2022-12-23 23:02:04', b'0'),
(18, 'admin', 'c380f833034d60bf035a134094eb538d600dc6f9', 'example@example.org', '2022-12-23 23:10:47', b'1');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
