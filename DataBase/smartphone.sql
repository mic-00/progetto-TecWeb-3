-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Set 27, 2022 alle 17:27
-- Versione del server: 10.4.24-MariaDB
-- Versione PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydatabase`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `smartphone`
--

CREATE TABLE `smartphone` (
  `Marca` varchar(20) NOT NULL,
  `Prezzo` varchar(20) NOT NULL,
  `Memoria Interna` varchar(20) NOT NULL,
  `Sistema Operativo` varchar(20) NOT NULL,
  `Dimensione dello schermo` varchar(20) NOT NULL,
  `tecnologia connettività` varchar(20) NOT NULL,
  `Stato` varchar(20) NOT NULL,
  `Tecnologia cellulare` varchar(20) NOT NULL,
  `Durata Batteria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `smartphone`
--

INSERT INTO `smartphone` (`Marca`, `Prezzo`, `Memoria Interna`, `Sistema Operativo`, `Dimensione dello schermo`, `tecnologia connettività`, `Stato`, `Tecnologia cellulare`, `Durata Batteria`) VALUES
('Samsung', '[400 euro]', '[3,9 GB]', '[Android]', '[3,9 pollici]', '[Wi-Fi]', '[Nuovo]', '[4G]', '[5 ore]');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
