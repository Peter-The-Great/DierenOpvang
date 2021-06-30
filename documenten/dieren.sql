-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 30 jun 2021 om 17:07
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dieren`
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
  `soortid` varchar(64) NOT NULL,
  `leeftijd` int(3) NOT NULL,
  `eigenaar_id` varchar(64) NOT NULL,
  `geboortedatum` date NOT NULL,
  `regristratiedatum` date NOT NULL DEFAULT current_timestamp(),
  `naar` varchar(64) NOT NULL,
  `kenmerken` text NOT NULL,
  `vaccinatie` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `dieren`
--

INSERT INTO `dieren` (`id`, `naam`, `soort`, `soortid`, `leeftijd`, `eigenaar_id`, `geboortedatum`, `regristratiedatum`, `naar`, `kenmerken`, `vaccinatie`, `image`) VALUES
('3d787e55-f5d1-46f6-948d-f8841c7dc3ab', 'Bob Ross', 'Kat/Poes', '357705d4-88fd-457b-9cfb-e39d6762bed5', 10, 'd124b81b-b5ad-42a0-863c-d332a2b064e3', '2001-09-05', '2021-06-18', 'DierenOpvang', 'Spaans', 'fwfewfwfewfewf;', 'uploads/60cce52c82bc7_60cce52c82bcb.jpg');

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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `soort`
--

CREATE TABLE `soort` (
  `id` varchar(64) NOT NULL,
  `soort` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `soort`
--

INSERT INTO `soort` (`id`, `soort`) VALUES
('02b95889-5448-47e4-8ee1-bff1d5574483', 'Hond'),
('232c9ae5-0269-4028-8e13-78a4eec6b365', 'konijn'),
('357705d4-88fd-457b-9cfb-e39d6762bed5', 'Kat/Poes'),
('cde38866-dd47-4065-b4b7-fcf374720209', 'Cavia');

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

--
-- Indexen voor tabel `soort`
--
ALTER TABLE `soort`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
