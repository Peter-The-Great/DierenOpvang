-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 28 mei 2021 om 16:53
-- Serverversie: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- PHP-versie: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testserver`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

CREATE TABLE `admin` (
  `ID` varchar(64) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(60) NOT NULL,
  `realname` varchar(60) NOT NULL,
  `profile` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`, `email`, `realname`, `profile`) VALUES
('52086616-c85c-4363-98f0-4dcd698ec356', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Mathijs54@Gmail.com', 'Mathijs Clasener', 'uploads/6080359930cf5_6080359930cfc.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `dieren`
--

CREATE TABLE `dieren` (
  `id` varchar(64) NOT NULL,
  `naam` varchar(64) NOT NULL,
  `soort` varchar(64) NOT NULL,
  `leeftijd` int(3) NOT NULL,
  `eigenaar_naam` varchar(64) NOT NULL,
  `geboortedatum` datetime NOT NULL,
  `regristratiedatum` datetime NOT NULL,
  `naar` varchar(64) NOT NULL,
  `kenmerken` text NOT NULL,
  `vaccinatie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mensen`
--

CREATE TABLE `mensen` (
  `id` varchar(64) NOT NULL,
  `naam` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `huisdierid` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `dieren`
--
ALTER TABLE `dieren`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `mensen`
--
ALTER TABLE `mensen`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
