-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2021 at 01:54 PM
-- Server version: 10.1.48-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `admin`
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
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`, `email`, `realname`, `profile`) VALUES
('52086616-c85c-4363-98f0-4dcd698ec356', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Mathijs54@Gmail.com', 'Mathijs Clasener', 'uploads/6080359930cf5_6080359930cfc.png');

-- --------------------------------------------------------

--
-- Table structure for table `dieren`
--

CREATE TABLE `dieren` (
  `id` varchar(64) NOT NULL,
  `naam` varchar(64) NOT NULL,
  `soort` varchar(64) NOT NULL,
  `leeftijd` int(3) NOT NULL,
  `eigenaar_id` varchar(64) NOT NULL,
  `geboortedatum` date NOT NULL,
  `regristratiedatum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `naar` varchar(64) NOT NULL,
  `kenmerken` text NOT NULL,
  `vaccinatie` text NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dieren`
--

INSERT INTO `dieren` (`id`, `naam`, `soort`, `leeftijd`, `eigenaar_id`, `geboortedatum`, `regristratiedatum`, `naar`, `kenmerken`, `vaccinatie`, `image`) VALUES
('9052406c-c535-401e-b4ee-f8e99a3c80c2', 'Morgana', 'Kat/Poes', 22, '2814a684-9d3d-472e-adf6-f2cd776aaebb', '2021-06-16', '2021-06-25 15:26:35', 'DierenOpvang', 'funky cat', 'asdfasdf', 'uploads/60d5d98b23e18_60d5d98b23e1a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mensen`
--

CREATE TABLE `mensen` (
  `id` varchar(64) NOT NULL,
  `naam` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `huisdierid` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `soort`
--

CREATE TABLE `soort` (
  `id` varchar(64) NOT NULL,
  `soort` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soort`
--

INSERT INTO `soort` (`id`, `soort`) VALUES
('02b95889-5448-47e4-8ee1-bff1d5574483', 'Hond'),
('357705d4-88fd-457b-9cfb-e39d6762bed5', 'Kat/Poes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `dieren`
--
ALTER TABLE `dieren`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mensen`
--
ALTER TABLE `mensen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soort`
--
ALTER TABLE `soort`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
