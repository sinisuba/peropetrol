-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2021 at 01:22 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

CREATE DATABASE peropetrol;
USE peropetrol;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peropetrol`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `admin_email` varchar(320) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `admin_email`, `admin_password`) VALUES
(1, 'admin@peropetrol.com', '$2y$10$f/QLgfGAZxQKYfo61n5erOS6QPr4xvp8UkUtGsF1FK3hs3kv8sxe.');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `ID` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `korisnik_email` varchar(320) NOT NULL,
  `korisnik_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`ID`, `ime`, `prezime`, `korisnik_email`, `korisnik_password`) VALUES
(1, 'Jovan', 'Jovanović', 'jovan.jovanovic@gmail.com', '$2y$10$PfqEiXQw6nDXr.chQTxDfuFiwJX9p6J1oHnU8Ulqoir14MQeK3GiG'),
(2, 'Marko', 'Čičić', 'marko.cicic@yahoo.com', '$2y$10$hJmBzg/N6uyZ8HaojM8QAuyrXz4SZLPvAxYy4o5Y66bPM0ARC7Sb2'),
(3, 'Jovan', 'Tomić', 'jovan.tomic@outlook.com', '$2y$10$4amBXNTmRlYk8rS7tzkrm.x8VPnTnilTbFxM8WHcN5Q05gARcnE8S'),
(5, 'Dragan', 'Marković', 'dragan.markovic@hotmail.com', '$2y$10$ulj9Jish.mBe6e32lKTmOO.GDYRaKY0P51KmViDqpBG1jk82g7UzC');

-- --------------------------------------------------------

--
-- Table structure for table `pumpe`
--

CREATE TABLE `pumpe` (
  `ID` int(11) NOT NULL,
  `lokacija` varchar(50) NOT NULL,
  `benzin95` mediumint(8) UNSIGNED NOT NULL,
  `benzin98` mediumint(8) UNSIGNED NOT NULL,
  `dizel` mediumint(8) UNSIGNED NOT NULL,
  `plin` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pumpe`
--

INSERT INTO `pumpe` (`ID`, `lokacija`, `benzin95`, `benzin98`, `dizel`, `plin`) VALUES
(1, 'Obilićevo', 5000, 6500, 6000, 3000),
(2, 'Starčevica', 3500, 2100, 4000, 2250),
(3, 'Petrićevac', 4600, 7000, 2400, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `radnici`
--

CREATE TABLE `radnici` (
  `ID` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `radnik_email` varchar(320) NOT NULL,
  `radnik_password` varchar(255) NOT NULL,
  `staz` tinyint(3) UNSIGNED DEFAULT 0,
  `plata` decimal(10,2) DEFAULT 500.00,
  `godisnji` tinyint(3) UNSIGNED DEFAULT 0,
  `pumpa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `radnici`
--

INSERT INTO `radnici` (`ID`, `ime`, `prezime`, `radnik_email`, `radnik_password`, `staz`, `plata`, `godisnji`, `pumpa`) VALUES
(1, 'Marko', 'Jovanović', 'marko.jovanovic@peropetrol.com', '$2y$10$PdmcUvCK1UdELVjBbXqRx.JoI433pSgyFUS.BP2xGnxN/4.dT4CqO', 2, '770.00', 12, 'Obilićevo'),
(2, 'Zoran', 'Ilić', 'zoran.ilic@peropetrol.com', '$2y$10$vwiLX10ogADW4mCar/.5ius3nbG5W/rsTi0HHQrToTRAn.sICXPcS', 4, '880.00', 14, 'Starčevica'),
(3, 'Dragan', 'Simić', 'dragan.simic@peropetrol.com', '$2y$10$SQy9RYIb.iMZkuI2M7npZOFxsUjLgOA66IZva/mhQ5BqPNzaDidW2', 3, '815.00', 13, 'Petrićevac'),
(7, 'Saša', 'Jović', 'sasa.jovic@peropetrol.com', '$2y$10$ZpdXkq3mOGRl593XnJRBPuvGSTIwQ91rp1J4LJq8IMRNsTQAt/Z1y', 1, '650.00', 10, 'Petrićevac'),
(8, 'Jovan', 'Topić', 'jovan.topic@peropetrol.com', '$2y$10$Ri1.kD.9Z5BIIQFWnAOEJuyZg1QDL0oVuxTd0isVZTxzgE3I6lib.', 3, '815.00', 13, 'Obilićevo'),
(15, 'Petar', 'Šojić', 'petar.sojic@peropetrol.com', '$2y$10$QmucuGvMsjXRn6iN0PZKGOZ9sQUdpRbS0kt2pmZqinWKZwat..rSa', 1, '770.00', 12, 'Starčevica');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `admin_email` (`admin_email`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `korisnik_email` (`korisnik_email`);

--
-- Indexes for table `pumpe`
--
ALTER TABLE `pumpe`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `radnici`
--
ALTER TABLE `radnici`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `radnik_email` (`radnik_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pumpe`
--
ALTER TABLE `pumpe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `radnici`
--
ALTER TABLE `radnici`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
