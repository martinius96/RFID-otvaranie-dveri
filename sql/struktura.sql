-- Export vyhotovil: Martin Chlebovec
-- email: martinius96@gmail.com
-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost:3306
-- Čas generovania: Pi 01.Feb 2019, 12:13
-- Verzia serveru: 5.7.24-27-log
-- Verzia PHP: 7.3.1-1+0~20190113101756.25+stretch~1.gbp15aaa9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `skapartman`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `autorizovane`
--

CREATE TABLE `autorizovane` (
  `id` int(11) NOT NULL,
  `cislo_karty` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `neautorizovane`
--

CREATE TABLE `neautorizovane` (
  `id` int(11) NOT NULL,
  `cislo_karty` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pokusy`
--

CREATE TABLE `pokusy` (
  `id` int(11) NOT NULL,
  `cislo_karty` text NOT NULL,
  `vysledok` tinyint(1) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `autorizovane`
--
ALTER TABLE `autorizovane`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `neautorizovane`
--
ALTER TABLE `neautorizovane`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `pokusy`
--
ALTER TABLE `pokusy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `autorizovane`
--
ALTER TABLE `autorizovane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `neautorizovane`
--
ALTER TABLE `neautorizovane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `pokusy`
--
ALTER TABLE `pokusy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
