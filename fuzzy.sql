-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Út 01.Aug 2023, 16:50
-- Verzia serveru: 10.4.21-MariaDB
-- Verzia PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `fuzzy`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `zakladna_tabulka`
--

CREATE TABLE `zakladna_tabulka` (
  `id` int(3) NOT NULL,
  `meno_hraca` varchar(50) NOT NULL,
  `priezvisko_hraca` varchar(50) NOT NULL,
  `tim_skr` varchar(5) NOT NULL,
  `trestne_minuty` int(4) NOT NULL,
  `goly` int(4) NOT NULL,
  `intenzita_nizky_pocet_trestnych_minut` double(6,3) DEFAULT NULL,
  `intenzita_vysoky_pocet_golov` double(6,3) DEFAULT NULL,
  `minimova` double(6,3) DEFAULT NULL,
  `sucinova` double(6,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `zakladna_tabulka`
--

INSERT INTO `zakladna_tabulka` (`id`, `meno_hraca`, `priezvisko_hraca`, `tim_skr`, `trestne_minuty`, `goly`, `intenzita_nizky_pocet_trestnych_minut`, `intenzita_vysoky_pocet_golov`, `minimova`, `sucinova`) VALUES
(1, 'Samuel', 'Buček', 'HKN', 24, 39, 0.000, 0.000, 0.000, 0.000),
(2, 'Ladislav', 'Nagy', 'KOS', 32, 36, 0.000, 0.000, 0.000, 0.000),
(3, 'Judd', 'Blackwater', 'HKN', 87, 34, 0.000, 0.000, 0.000, 0.000),
(4, 'Guillaume', 'Asselin', 'BBS', 84, 33, 0.000, 0.000, 0.000, 0.000),
(5, 'Milan', 'Kytnár', 'ZVA', 26, 32, 0.000, 0.000, 0.000, 0.000),
(6, 'Brock', 'Higgs', 'BBS', 30, 32, 0.000, 0.000, 0.000, 0.000),
(7, 'Eric', 'Faille', 'BBS', 44, 29, 0.000, 0.000, 0.000, 0.000),
(8, 'Balint', 'Magosi', 'MIJ', 52, 27, 0.000, 0.000, 0.000, 0.000),
(9, 'Tomáš', 'Kempa', 'MAC', 24, 25, 0.000, 0.000, 0.000, 0.000),
(10, 'Lane', 'Scheidl', 'HKN', 90, 25, 0.000, 0.000, 0.000, 0.000),
(11, 'Lukáš', 'Handlovský', 'ZVA', 46, 24, 0.000, 0.000, 0.000, 0.000),
(12, 'Chris', 'Langkow', 'MAC', 81, 23, 0.000, 0.000, 0.000, 0.000),
(13, 'Róbert', 'Lantoši', 'HKN', 12, 23, 0.000, 0.000, 0.000, 0.000),
(14, 'Rudolf', 'Huna', 'ZIL', 28, 21, 0.000, 0.000, 0.000, 0.000),
(15, 'Chris', 'Bodo', 'MAC', 38, 20, 0.000, 0.000, 0.000, 0.000),
(16, 'Henrich', 'Ručkay', 'NZO', 55, 19, 0.000, 0.000, 0.000, 0.000),
(17, 'Peter', 'Olvecký', 'TRE', 30, 18, 0.000, 0.000, 0.000, 0.000),
(18, 'Rastislav', 'Špirko', 'ZVA', 8, 50, 0.000, 0.000, 0.000, 0.000),
(19, 'Milan', 'Bartovič', 'TRE', 40, 17, 0.000, 0.000, 0.000, 0.000),
(20, 'Marek', 'Zagrapan', 'POA', 26, 16, 0.000, 0.000, 0.000, 0.000);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `zakladna_tabulka`
--
ALTER TABLE `zakladna_tabulka`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `zakladna_tabulka`
--
ALTER TABLE `zakladna_tabulka`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
