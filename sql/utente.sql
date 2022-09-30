SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `UTENTE` (
  `email` varchar(319) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `UTENTE` (`email`, `username`, `password`, `isAdmin`) VALUES
('gorlandi@unipd.it', 'gorlandi', 'Password1', 0),
('mmasetto@unipd.it', 'mmasetto', 'Password2', 0),
('test@gmail.com', 'testuser', 'Password4', 1),
('zzhenwei@unipd.it', 'zzhenwei', 'Password5', 0),
('admin@admin.com', 'admin', 'admin', 1),
('user@user.com', 'user', 'user', 0);