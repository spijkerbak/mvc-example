-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Gegenereerd op: 25 mrt 2019 om 14:38
-- Serverversie: 10.2.12-MariaDB-log
-- PHP-versie: 7.0.33-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS=0;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

DROP TABLE IF EXISTS `note`;
DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `email` varchar(120) PRIMARY KEY,
  `name` varchar(80) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `passwordHash` varchar(64) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`email`, `name`, `salt`, `passwordHash`, `level`) VALUES
('frans@spijkerman.nl', 'Frans', '12345678910', 'f618ae97c9f08912d346729818ac46fc', 2),
('henk@avans.nl', 'Henk', '3faeacc31559960dbfadf3bb5c7b6986', '', 1);

CREATE TABLE `note` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(80) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `owner` varchar(120) NOT NULL,
  `createDate` timestamp NOT NULL DEFAULT current_timestamp(),
  FOREIGN KEY (`owner`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `note` (`id`, `title`, `content`, `owner`, `createDate`) VALUES
(12, '02.', 'Er zijn twee gebruikersniveaus: Gebruiker en Beheerder', 'henk@avans.nl', '2019-03-19 12:01:20'),
(13, '10.', 'Beheerder kan gebruikers toevoegen, wijzigen en verwijderen', 'henk@avans.nl', '2019-03-19 12:01:58'),
(14, '03.', 'Gebruiker kan notities toevoegen, wijzigen en verwijderen', 'henk@avans.nl', '2019-03-19 12:02:52'),
(15, '06.', 'Gebruiker kan wachtwoord veranderen', 'henk@avans.nl', '2019-03-19 12:03:38'),
(16, '05.', 'Gewone gebruiker kan alleen eigen notities zien en wijzigen', 'henk@avans.nl', '2019-03-19 12:04:19'),
(17, '04.', 'Beheerder kan alle notities bekijken.', 'henk@avans.nl', '2019-03-19 12:04:46'),
(18, '07.', 'Bij notitie wordt datum en tijd van invoer opgeslagen', 'henk@avans.nl', '2019-03-19 12:05:32'),
(19, '08.', 'Gebruikers kunnen inloggen met e-mailadres en wachtwoord', 'henk@avans.nl', '2019-03-19 12:09:39'),
(20, '09.', 'Van elke gebruiker wordt de naam opgeslagen', 'henk@avans.nl', '2019-03-19 12:10:14'),
(21, '01.', 'Systeem bewaart notities', 'henk@avans.nl', '2019-03-19 12:11:51'),
(23, '00.', 'Een notitie heeft een korte titel en eventueel een langer blok tekst', 'henk@avans.nl', '2019-03-19 12:12:57'),
(24, '11.', 'Gebruikers kunnen een lijst van notities zien', 'henk@avans.nl', '2019-03-19 12:18:02');

SET FOREIGN_KEY_CHECKS=1;