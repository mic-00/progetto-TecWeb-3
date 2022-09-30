SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `UTENTE` (
  `email` varchar(319) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `UTENTE` (`email`, `username`, `birthday`, `password`, `isAdmin`) VALUES
('gorlandi@unipd.it', 'gorlandi', '0000-00-00 00:00:00', 'Password1', 0),
('mmasetto@unipd.it', 'mmasetto', '0000-00-00 00:00:00', 'Password2', 0),
('test@gmail.com', 'testuser', '0000-00-00 00:00:00', 'Password4', 1),
('zzhenwei@unipd.it', 'zzhenwei', '0000-00-00 00:00:00', 'Password5', 0),
('admin@admin.com', 'admin', '0000-00-00 00:00:00', 'admin', 1),
('user@user.com', 'user', '0000-00-00 00:00:00', 'user', 0);