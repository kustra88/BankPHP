-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Kwi 2016, 20:09
-- Wersja serwera: 5.6.24
-- Wersja PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `bankdatabase`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `historia`
--

CREATE TABLE IF NOT EXISTS `historia` (
  `id_pracownika` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE IF NOT EXISTS `klient` (
  `id_klienta` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `pesel` decimal(12,0) NOT NULL,
  `data_urodzenia` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `klient`
--

INSERT INTO `klient` (`id_klienta`, `imie`, `nazwisko`, `pesel`, `data_urodzenia`) VALUES
(1, 'Astryda', 'Bujanowska', '81122772484', '1991-02-25'),
(2, 'Urszula', 'Nowrot', '33303752427', '1976-05-14'),
(3, 'Blanka', 'Wojcińska', '88573722317', '1967-11-26'),
(4, 'Gertruda', 'Pyczek', '33607151172', '1983-10-04'),
(5, 'Emil', 'Niemyt', '14100883811', '1993-06-24'),
(6, 'Tomasz', 'Jonik', '14100873761', '1989-07-19'),
(7, 'Jędrzej', 'Dratwiński', '14100761601', '1988-03-14');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konto`
--

CREATE TABLE IF NOT EXISTS `konto` (
  `id_klienta` int(11) NOT NULL,
  `nr_konta` decimal(27,0) NOT NULL,
  `saldo` decimal(11,0) NOT NULL,
  `id_lokaty` int(11) DEFAULT NULL,
  `id_kredytu` int(11) DEFAULT NULL,
  `data_ot` datetime NOT NULL,
  `data_zm` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `konto`
--

INSERT INTO `konto` (`id_klienta`, `nr_konta`, `saldo`, `id_lokaty`, `id_kredytu`, `data_ot`, `data_zm`) VALUES
(1, '5434984273348100125446496', '15000', NULL, NULL, '2015-03-15 15:36:00', NULL),
(2, '1234984573349100094229494', '35000', NULL, NULL, '2013-08-15 08:21:23', NULL),
(3, '3234984573342100194229488', '9000', 1, NULL, '2014-01-12 18:23:44', NULL),
(4, '1234984573349100094229494', '35000', NULL, 1, '2013-08-15 08:21:23', NULL),
(5, '3234984573342100194229489', '200000', NULL, NULL, '2015-12-14 10:00:00', NULL),
(6, '3234984573342100194229123', '50000', 2, NULL, '2015-09-06 13:26:00', NULL),
(7, '3234984573334100194221245', '1250', NULL, 2, '2016-04-04 14:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kredyt`
--

CREATE TABLE IF NOT EXISTS `kredyt` (
  `id_kredytu` int(11) NOT NULL,
  `kwota` decimal(10,2) NOT NULL,
  `oprocentowanie` decimal(5,2) NOT NULL,
  `raty` int(11) NOT NULL,
  `kwota_raty` decimal(10,2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kredyt`
--

INSERT INTO `kredyt` (`id_kredytu`, `kwota`, `oprocentowanie`, `raty`, `kwota_raty`) VALUES
(1, '4000.00', '5.00', 24, '600.00'),
(2, '50000.00', '2.00', 25, '330.00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lokaty`
--

CREATE TABLE IF NOT EXISTS `lokaty` (
  `id_lokaty` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `oprocentowanie` decimal(5,2) NOT NULL,
  `kwota_pocz` decimal(10,2) NOT NULL,
  `kwota` decimal(10,2) NOT NULL,
  `data_pocz` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `lokaty`
--

INSERT INTO `lokaty` (`id_lokaty`, `nazwa`, `oprocentowanie`, `kwota_pocz`, `kwota`, `data_pocz`) VALUES
(1, 'Odsetkomat', '2.50', '10000.00', '10004.41', '2016-03-01 15:00:00'),
(2, 'Mała Lokata', '2.00', '3000.00', '3314.25', '2015-10-12 11:18:29');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownik`
--

CREATE TABLE IF NOT EXISTS `pracownik` (
  `id_pracownika` int(11) NOT NULL,
  `imie` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `pin` int(4) NOT NULL,
  `data_logowania` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pracownik`
--

INSERT INTO `pracownik` (`id_pracownika`, `imie`, `nazwisko`, `pin`, `data_logowania`) VALUES
(1, 'Jan', 'Kowalski', 1234, '2016-03-03 03:12:14'),
(2, 'Zenon', 'Janucik', 8394, '2015-04-30 17:18:27'),
(3, 'Tobiasz', 'Wrocławski', 3569, '2015-02-16 04:05:57'),
(4, 'Radosław', 'Rogut', 3363, '2015-08-09 01:15:12'),
(5, 'Radosław', 'Filipczuk', 2596, '2015-06-30 15:02:37'),
(6, 'Sławomir', 'Kalista', 8924, '2015-05-20 14:09:04'),
(7, 'Alfons', 'Kałużniak', 3222, '2015-02-11 00:36:08'),
(8, 'Leonard', 'Starzec', 7297, '2015-02-16 18:06:07'),
(9, 'Bartłomiej', 'Słowiński', 4465, '2015-09-18 09:55:49'),
(10, 'Urban', 'Palica', 1757, '2015-09-21 01:11:24'),
(11, 'Mariam', 'Bukowiec', 6111, '2015-05-11 05:15:12'),
(12, 'Dorota', 'Koczor', 4126, '2015-12-23 06:42:35'),
(13, 'Izolda', 'Bujak', 1834, '2015-03-09 19:11:42'),
(14, 'Sybilla', 'Hejduk', 5710, '2015-08-16 11:16:56'),
(15, 'Amelia', 'Wyżykowska', 5305, '2015-12-18 18:49:03'),
(16, 'Maryla', 'Żelek', 5055, '2015-12-19 05:30:31'),
(17, 'Sandra', 'Siwek', 7255, '2015-12-25 15:54:01'),
(18, 'Ofelia', 'Jezior', 8989, '2015-10-27 07:13:29'),
(19, 'Morzana', 'Flakowska', 8527, '2015-01-11 09:27:39');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `historia`
--
ALTER TABLE `historia`
  ADD UNIQUE KEY `id_log` (`id_pracownika`);

--
-- Indexes for table `klient`
--
ALTER TABLE `klient`
  ADD UNIQUE KEY `klient_id` (`id_klienta`);

--
-- Indexes for table `konto`
--
ALTER TABLE `konto`
  ADD PRIMARY KEY (`id_klienta`), ADD UNIQUE KEY `id_kredytu` (`id_kredytu`), ADD UNIQUE KEY `id_lokaty` (`id_lokaty`), ADD KEY `id_klienta` (`id_klienta`);

--
-- Indexes for table `kredyt`
--
ALTER TABLE `kredyt`
  ADD PRIMARY KEY (`id_kredytu`);

--
-- Indexes for table `lokaty`
--
ALTER TABLE `lokaty`
  ADD PRIMARY KEY (`id_lokaty`);

--
-- Indexes for table `pracownik`
--
ALTER TABLE `pracownik`
  ADD PRIMARY KEY (`id_pracownika`), ADD KEY `id_klienta` (`id_pracownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `historia`
--
ALTER TABLE `historia`
  MODIFY `id_pracownika` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `klient`
--
ALTER TABLE `klient`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `konto`
--
ALTER TABLE `konto`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `kredyt`
--
ALTER TABLE `kredyt`
  MODIFY `id_kredytu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `lokaty`
--
ALTER TABLE `lokaty`
  MODIFY `id_lokaty` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `historia`
--
ALTER TABLE `historia`
ADD CONSTRAINT `id_logh` FOREIGN KEY (`id_pracownika`) REFERENCES `pracownik` (`id_pracownika`);

--
-- Ograniczenia dla tabeli `klient`
--
ALTER TABLE `klient`
ADD CONSTRAINT `key_klient` FOREIGN KEY (`id_klienta`) REFERENCES `konto` (`id_klienta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `kredyt`
--
ALTER TABLE `kredyt`
ADD CONSTRAINT `key_kredyt` FOREIGN KEY (`id_kredytu`) REFERENCES `konto` (`id_kredytu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `lokaty`
--
ALTER TABLE `lokaty`
ADD CONSTRAINT `key_lokata` FOREIGN KEY (`id_lokaty`) REFERENCES `konto` (`id_lokaty`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
