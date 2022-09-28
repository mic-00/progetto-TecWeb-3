SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `ACQUISTO` (
  `nome` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(319) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `ACQUISTO`
--

INSERT INTO `ACQUISTO` (`nome`,`email`) VALUES
('Acer', 'giacomo.orlandi@studenti.unipd.it');