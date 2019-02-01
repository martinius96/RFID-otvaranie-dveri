-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost:3306
-- Čas generovania: Ne 30.Dec 2018, 04:28
-- Verzia serveru: 5.7.22-22-log
-- Verzia PHP: 7.0.30-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
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

--
-- Sťahujem dáta pre tabuľku `autorizovane`
--

INSERT INTO `autorizovane` (`id`, `cislo_karty`, `time`) VALUES
(22, '1044245', '2018-11-27 00:39:53'),
(24, '2053894', '2018-11-27 00:39:59'),
(25, '1411783', '2018-11-27 00:40:29'),
(26, '2428776', '2018-11-27 00:40:30'),
(27, '62410174', '2018-11-27 05:14:55'),
(28, '900906', '2018-11-27 15:40:09'),
(29, '2114614', '2018-11-27 15:42:37'),
(30, '922306', '2018-11-27 15:42:39');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `neautorizovane`
--

CREATE TABLE `neautorizovane` (
  `id` int(11) NOT NULL,
  `cislo_karty` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Sťahujem dáta pre tabuľku `neautorizovane`
--

INSERT INTO `neautorizovane` (`id`, `cislo_karty`, `time`) VALUES
(16, '1152676', '2018-11-27 00:39:52'),
(20, '', '2018-11-27 10:33:38'),
(21, '1354345', '2018-11-27 11:48:04');

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
-- Sťahujem dáta pre tabuľku `pokusy`
--

INSERT INTO `pokusy` (`id`, `cislo_karty`, `vysledok`, `time`) VALUES
(113, '2114614', 0, '2018-11-27 00:22:35'),
(114, '2114614', 0, '2018-11-27 00:22:57'),
(115, '1411783', 0, '2018-11-27 00:23:06'),
(116, '1411783', 1, '2018-11-27 00:23:22'),
(117, '2114614', 1, '2018-11-27 00:23:30'),
(118, '1044245', 0, '2018-11-27 00:23:48'),
(119, '1354345', 0, '2018-11-27 00:23:52'),
(120, '2053894', 0, '2018-11-27 00:23:54'),
(121, '900906', 0, '2018-11-27 00:24:20'),
(122, '1152676', 0, '2018-11-27 00:24:25'),
(123, '922306', 0, '2018-11-27 00:24:30'),
(124, '900906', 0, '2018-11-27 00:24:40'),
(125, '900906', 0, '2018-11-27 00:24:43'),
(126, '2428776', 0, '2018-11-27 00:28:37'),
(127, '922306', 1, '2018-11-27 00:29:40'),
(128, '900906', 1, '2018-11-27 00:29:43'),
(129, '1152676', 1, '2018-11-27 00:29:47'),
(130, '1044245', 1, '2018-11-27 00:29:54'),
(131, '1354345', 1, '2018-11-27 00:29:59'),
(132, '2053894', 1, '2018-11-27 00:30:05'),
(133, '1354345', 0, '2018-11-27 00:32:54'),
(134, '2053894', 0, '2018-11-27 00:33:11'),
(135, '2053894', 0, '2018-11-27 00:39:04'),
(136, '2053894', 0, '2018-11-27 00:39:10'),
(137, '1044245', 0, '2018-11-27 00:39:17'),
(138, '922306', 0, '2018-11-27 00:39:30'),
(139, '900906', 0, '2018-11-27 00:39:43'),
(140, '1152676', 0, '2018-11-27 00:39:52'),
(141, '2428776', 0, '2018-11-27 00:40:13'),
(142, '2114614', 0, '2018-11-27 00:40:22'),
(143, '1411783', 0, '2018-11-27 00:40:26'),
(144, '2428776', 1, '2018-11-27 00:40:50'),
(145, '1411783', 1, '2018-11-27 00:40:57'),
(146, '2053894', 1, '2018-11-27 00:41:01'),
(147, '922306', 0, '2018-11-27 00:41:10'),
(148, '900906', 1, '2018-11-27 00:41:17'),
(149, '1044245', 1, '2018-11-27 00:41:23'),
(150, '1411783', 1, '2018-11-27 00:46:13'),
(151, '900906', 1, '2018-11-27 00:48:08'),
(152, '1152676', 0, '2018-11-27 00:48:14'),
(153, '922306', 0, '2018-11-27 00:48:26'),
(154, '1411783', 1, '2018-11-27 00:48:34'),
(155, '1411783', 1, '2018-11-27 10:21:00'),
(156, '', 0, '2018-11-27 10:33:38'),
(157, '1411783', 1, '2018-11-27 10:52:37'),
(158, '1411783', 1, '2018-11-27 10:53:50'),
(159, '2053894', 1, '2018-11-27 10:54:16'),
(160, '1044245', 1, '2018-11-27 10:54:24'),
(161, '900906', 1, '2018-11-27 10:54:31'),
(162, '2114614', 0, '2018-11-27 10:54:54'),
(163, '900906', 1, '2018-11-27 10:55:04'),
(164, '922306', 0, '2018-11-27 10:55:17'),
(165, '2053894', 1, '2018-11-27 10:56:25'),
(166, '1354345', 0, '2018-11-27 11:48:04'),
(167, '2053894', 1, '2018-11-27 11:48:32'),
(168, '922306', 0, '2018-11-27 11:52:03'),
(169, '900906', 1, '2018-11-27 11:52:12'),
(170, '2053894', 1, '2018-11-27 11:57:12'),
(171, '900906', 1, '2018-11-27 12:05:03'),
(172, '900906', 1, '2018-11-27 15:39:32'),
(173, '900906', 0, '2018-11-27 15:40:00'),
(174, '922306', 0, '2018-11-27 15:40:33'),
(175, '1044245', 1, '2018-11-27 15:41:56');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pre tabuľku `neautorizovane`
--
ALTER TABLE `neautorizovane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pre tabuľku `pokusy`
--
ALTER TABLE `pokusy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
