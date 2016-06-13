-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas generowania: 13 Cze 2016, 22:17
-- Wersja serwera: 10.1.10-MariaDB
-- Wersja PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `logowanie`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `historia`
--

CREATE TABLE `historia` (
  `id` int(11) NOT NULL,
  `id_pracownika` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `operacja` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `id_klienta` int(11) NOT NULL,
  `imie` text COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `pesel` decimal(12,0) NOT NULL,
  `data_urodzenia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konto`
--

CREATE TABLE `konto` (
  `id_klienta` int(11) NOT NULL,
  `nr_konta` decimal(27,0) NOT NULL,
  `saldo` decimal(11,0) NOT NULL,
  `id_lokaty` int(11) DEFAULT NULL,
  `id_kredytu` int(11) DEFAULT NULL,
  `data_ot` datetime NOT NULL,
  `data_zm` datetime DEFAULT NULL,
  `nr_konta2` decimal(27,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kredyt`
--

CREATE TABLE `kredyt` (
  `id_kredytu` int(11) NOT NULL,
  `kwota` decimal(10,2) NOT NULL,
  `oprocentowanie` decimal(5,2) NOT NULL,
  `raty` int(11) NOT NULL,
  `kwota_raty` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lokaty`
--

CREATE TABLE `lokaty` (
  `id_lokaty` int(11) NOT NULL,
  `nazwa` text COLLATE utf8_polish_ci NOT NULL,
  `oprocentowanie` decimal(5,2) NOT NULL,
  `kwota_pocz` decimal(10,2) NOT NULL,
  `kwota` decimal(10,2) NOT NULL,
  `data_pocz` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownik`
--

CREATE TABLE `pracownik` (
  `id_pracownika` int(11) NOT NULL,
  `imie` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `pin` int(4) NOT NULL,
  `data_logowania` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klient`
--
ALTER TABLE `klient`
  ADD UNIQUE KEY `klient_id` (`id_klienta`);

--
-- Indexes for table `konto`
--
ALTER TABLE `konto`
  ADD PRIMARY KEY (`id_klienta`),
  ADD UNIQUE KEY `id_kredytu` (`id_kredytu`),
  ADD UNIQUE KEY `id_lokaty` (`id_lokaty`),
  ADD KEY `id_klienta` (`id_klienta`);

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
  ADD PRIMARY KEY (`id_pracownika`),
  ADD KEY `id_klienta` (`id_pracownika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `historia`
--
ALTER TABLE `historia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT dla tabeli `klient`
--
ALTER TABLE `klient`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `konto`
--
ALTER TABLE `konto`
  MODIFY `id_klienta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT dla tabeli `kredyt`
--
ALTER TABLE `kredyt`
  MODIFY `id_kredytu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `lokaty`
--
ALTER TABLE `lokaty`
  MODIFY `id_lokaty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Ograniczenia dla zrzutów tabel
--

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
