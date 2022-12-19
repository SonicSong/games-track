-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 20 Gru 2022, 00:05
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
  `name` text DEFAULT NULL,
  `publisher` text NOT NULL,
  `release_date` date NOT NULL,
  `genre` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `games`
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

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
