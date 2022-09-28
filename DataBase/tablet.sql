SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `tablet` (
  `Marca` varchar(20) NOT NULL,
  `Prezzo` int(20) NOT NULL,
  `Memoria RAM` varchar(20) NOT NULL,
  `Disco fisso` varchar(20) NOT NULL,
  `Tipo Display` varchar(20) NOT NULL,
  `Durata Batteria` varchar(20) NOT NULL,
  `Generazione` varchar(20) NOT NULL,
  `Stato` varchar(20) NOT NULL,
  `Velocità CPU` varchar(20) NOT NULL,
  `Tecnologia cellulare` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tablet` (`Marca`, `Prezzo`, `Memoria RAM`, `Tipo Display`, `Durata Batteria`, `Generazione`, `Stato`, `Velocità CPU`, `Tecnologia cellulare`) VALUES
('[Samsung]','50', '[3 GB]', '[LG]', '[4 ore]', '[5 generazione]', '[Usato]', '[3,1 GHz]', '[4G]');

ALTER TABLE `tablet`
  ADD PRIMARY KEY (`Marca`);
COMMIT;

