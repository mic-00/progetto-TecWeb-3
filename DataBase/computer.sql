-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Set 27, 2022 alle 17:17
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
-- Struttura della tabella `computer`
--

CREATE TABLE `computer` (
  `Marca` varchar(20) NOT NULL,
  `Prezzo` varchar(20) NOT NULL,
  `Tipo PC` varchar(20) NOT NULL,
  `Tipo CPU` varchar(20) NOT NULL,
  `Velocità CPU` varchar(20) NOT NULL,
  `Tipo di Hard-Disk` varchar(20) NOT NULL,
  `Sistema Operativo` varchar(20) NOT NULL,
  `Durata Batteria` varchar(20) NOT NULL,
  `Capacità Hard-Disk` varchar(20) NOT NULL,
  `Risoluzione Schermo PC Portatile` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `computer`
--

INSERT INTO `computer` (`Marca`, `Prezzo`, `Tipo PC`, `Tipo CPU`, `Velocità CPU`, `Tipo di Hard-Disk`, `Sistema Operativo`, `Durata Batteria`, `Capacità Hard-Disk`, `Risoluzione Schermo PC Portatile`) VALUES
('[Samsung]', '600', '[fisso]', '[Intel Core-2]', 'Fino [4,1 GHz]', '[SSD]', '[Windows 11]', '[4 ore]', '[500 GB]', '[]');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`Marca`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
