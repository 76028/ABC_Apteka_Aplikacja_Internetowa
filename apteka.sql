-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Lis 2020, 16:10
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `apteka`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta_klientow`
--

CREATE TABLE `konta_klientow` (
  `id` int(11) NOT NULL,
  `id_klienta` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `haslo` text COLLATE utf8_unicode_ci NOT NULL,
  `data_zalozenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `konta_klientow`
--

INSERT INTO `konta_klientow` (`id`, `id_klienta`, `haslo`, `data_zalozenia`) VALUES
(14, '68020300458', '$2y$10$uwEzzIUB6dMPzqN2bRhHgOD.DKz/1xLzbHzzFJeraOYPjN5Ye38q.', '2020-11-18 09:19:01'),
(15, '99092123423', '$2y$10$ZLVcw8rtKlptphE47l0th.fo.EVwqxXw5kg52x.n2fn.VFqdZj7IS', '2020-11-18 09:19:18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta_oczekujace`
--

CREATE TABLE `konta_oczekujace` (
  `pesel` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `haslo` text COLLATE utf8_unicode_ci NOT NULL,
  `imie` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nr_telefonu` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `ulica` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nr_domu` int(11) NOT NULL,
  `nr_lokalu` int(11) DEFAULT NULL,
  `kod_pocztowy` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `miasto` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `wojewodztwo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `id_moderatora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `konta_oczekujace`
--

INSERT INTO `konta_oczekujace` (`pesel`, `haslo`, `imie`, `nazwisko`, `email`, `nr_telefonu`, `ulica`, `nr_domu`, `nr_lokalu`, `kod_pocztowy`, `miasto`, `wojewodztwo`, `id_moderatora`) VALUES
('83051200248', '$2y$10$lUYyNlqjvw.lV1ED6y7nVuAbzCPX7YGZrx0rsY/LcxyCaIqk1bg32', 'Tomasz', 'Wronko', 't.wronko@o2.pl', '659025014', 'Słodka', 42, 0, '16-320', 'Bargłów Kościelny', 'podlaskie', 16),
('92010100294', '$2y$10$tOMG2wiZoUPd0XUWGO7qUO3uNE7NQb4my/dnFCtrfXYTcdiGocDRm', 'Łukasz', 'Mazur', 'mazur.l@o2.pl', '586598521', 'Leśna', 14, 0, '14-543', 'Gdynia', 'pomorskie', 16),
('93022500159', '$2y$10$yqN3YI8tFCu41AWCriocV.2xqbByFieQiu4kX9YTQOYEK8FPM5GSC', 'Adrian', 'Kowalski', 'a.kowalski@gmail.com', '658452154', 'Pogodna', 12, 2, '16-234', 'Suwałki', 'podlaskie', 17),
('94021625145', '$2y$10$9GYJP/WGRdAFQN2WOPRck.ff/nhsG.WaZ5xaumhHY0y1sloqvORKG', 'Anna', 'Raczysko', 'raczysko.a@gmail.com', '458569856', 'Stawowa', 14, 2, '14-563', 'Poznań', 'wielkopolskie', 17),
('95021202456', '$2y$10$.Bcse.7NiOtXq4wDncuFaeuOqCWG8X49YgwAPfnYtfgVtsfQs7.bO', 'Wiesław', 'Paleta', 'w.paleta@spinka.pl', '503256985', 'Błędna', 3, 17, '12-324', 'Łomża', 'podlaskie', 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta_odrzucone`
--

CREATE TABLE `konta_odrzucone` (
  `pesel` int(11) NOT NULL,
  `haslo` text COLLATE utf8_unicode_ci NOT NULL,
  `imie` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nr_telefonu` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `ulica` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nr_domu` int(11) NOT NULL,
  `nr_lokalu` int(11) DEFAULT NULL,
  `kod_pocztowy` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `miasto` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `wojewodztwo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `komentarz` text COLLATE utf8_unicode_ci NOT NULL,
  `id_moderatora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `konta_odrzucone`
--

INSERT INTO `konta_odrzucone` (`pesel`, `haslo`, `imie`, `nazwisko`, `email`, `nr_telefonu`, `ulica`, `nr_domu`, `nr_lokalu`, `kod_pocztowy`, `miasto`, `wojewodztwo`, `komentarz`, `id_moderatora`) VALUES
(2147483647, '$2y$10$xPseWKShRLzTrktuHjt09OQAoquTIBF0CozGnjzRdLJl0gn0lP/oK', 'Bartosz', 'Kantosz', 'kantosz.b@o2.pl', '545454658', 'Stokowa', 23, 0, '14-546', 'Radom', 'mazowieckie', 'Dane nie są prawdziwe', 17);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta_pracownikow`
--

CREATE TABLE `konta_pracownikow` (
  `id` int(11) NOT NULL,
  `id_pracownika` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `haslo` text COLLATE utf8_unicode_ci NOT NULL,
  `rodzaj` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data_zalozenia` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `konta_pracownikow`
--

INSERT INTO `konta_pracownikow` (`id`, `id_pracownika`, `haslo`, `rodzaj`, `data_zalozenia`) VALUES
(16, '97082102569', '$2y$10$qmoKvwJ7Hdp.GYQm8Ozbe.2aV88F7ooK6sWjLTTKtVPVfD1oUMCkC', 'Moderator', '2020-11-06 14:02:17'),
(17, '92011300248', '$2y$10$Y3ILy0ZiVLDP096ODKO5QeWPfypBk79sZWg.DYpVUAegalACFest.', 'Moderator', '2020-11-06 14:32:41'),
(19, '68020300458', '$2y$10$GmF518TyxZpiY6xGF.9TUOIELiTEW.t67hl1AFBAokX1ZbtINvp3m', 'Administrator', '2020-11-18 09:27:25');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `id_konta` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `zamowiona_ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `koszyk`
--

INSERT INTO `koszyk` (`id_konta`, `id_produktu`, `zamowiona_ilosc`) VALUES
(14, 9, 1),
(14, 8, 8),
(14, 7, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoby`
--

CREATE TABLE `osoby` (
  `pesel` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `imie` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nr_telefonu` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `ulica` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nr_domu` int(11) NOT NULL,
  `nr_lokalu` int(11) DEFAULT NULL,
  `kod_pocztowy` char(6) COLLATE utf8_unicode_ci NOT NULL,
  `miasto` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `wojewodztwo` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `osoby`
--

INSERT INTO `osoby` (`pesel`, `imie`, `nazwisko`, `email`, `nr_telefonu`, `ulica`, `nr_domu`, `nr_lokalu`, `kod_pocztowy`, `miasto`, `wojewodztwo`) VALUES
('68020300458', 'Marek', 'Kowalski', 'kowalski.m@wp.pl', '555658458', 'Słona', 34, 14, '12-678', 'Koszalin', 'lubuskie'),
('92011300248', 'Anna', 'Kulbacka', 'a.kulbacka@gmail.com', '503658458', 'Nawigacyjna', 3, NULL, '12-032', 'Karlin', 'opolskie'),
('97082102569', 'Daria', 'Prosiewicz', 'd.prosiewicz@wp.pl', '655987569', 'Wojska Polskiego', 12, 3, '16-300', 'Augustów', 'podlaskie'),
('99092123423', 'Jakub', 'Pozniak', 'j.pozniak@o2.pl', '658154856', 'Zielona', 52, 2, '16-300', 'Augustów', 'podlaskie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `obrazek` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`id`, `nazwa`, `opis`, `cena`, `obrazek`) VALUES
(7, 'Rutinoscorbin', 'Lek zastosować doustnie w stanach niedoboru witaminy C, w sytuacjach zwiększonego zapotrzebowania na witaminę C.', '12.50', 'rutinoscorbin.png'),
(8, 'NeoMag', 'Magnez oraz witamina B6 przyczyniają się do utrzymania prawidłowego metabolizmu energetycznego, zmniejszenia uczucia zmęczenia i znużenia.', '32.99', 'neomag.png'),
(9, 'CollaFlex', 'Kolagen typu II to najpowszechniej występująca forma kolagenu w organizmie. Jest on odpornym na rozciąganie białkiem tkanki łącznej. ', '54.00', 'CollaFlex.png');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wiadomosci`
--

CREATE TABLE `wiadomosci` (
  `id` int(11) NOT NULL,
  `imie` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `klient` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `tresc` text COLLATE utf8_unicode_ci NOT NULL,
  `id_moderatora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `wiadomosci`
--

INSERT INTO `wiadomosci` (`id`, `imie`, `nazwisko`, `telefon`, `email`, `klient`, `tresc`, `id_moderatora`) VALUES
(14, 'Zenon', 'Pozniak', '123132123', 'PLGOGUSPL@GMAIL.COM', '', 'Można zamówić hurtowe ilości witaminy C ?', 16);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id_konta_klienta` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `id_administratora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `konta_klientow`
--
ALTER TABLE `konta_klientow`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `konta_klientow_id_klienta_uq` (`id_klienta`) USING BTREE;

--
-- Indeksy dla tabeli `konta_oczekujace`
--
ALTER TABLE `konta_oczekujace`
  ADD PRIMARY KEY (`pesel`),
  ADD UNIQUE KEY `konta_oczekujace_email_uq` (`email`) USING BTREE,
  ADD UNIQUE KEY `konta_oczekujace_nr_telefonu_uq` (`nr_telefonu`) USING BTREE,
  ADD KEY `konta_oczekujace_id_moderatora_fk` (`id_moderatora`) USING BTREE;

--
-- Indeksy dla tabeli `konta_odrzucone`
--
ALTER TABLE `konta_odrzucone`
  ADD PRIMARY KEY (`pesel`),
  ADD KEY `konta_odrzucone_id_moderatora_fk` (`id_moderatora`);

--
-- Indeksy dla tabeli `konta_pracownikow`
--
ALTER TABLE `konta_pracownikow`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `konta_pracownikow_id_pracownika_uq` (`id_pracownika`) USING BTREE;

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD KEY `koszyk_id_klienta_fk` (`id_konta`),
  ADD KEY `koszyk_id_produktu_fk` (`id_produktu`);

--
-- Indeksy dla tabeli `osoby`
--
ALTER TABLE `osoby`
  ADD PRIMARY KEY (`pesel`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD KEY `id_konta_klienta_fk` (`id_konta_klienta`),
  ADD KEY `id_produktu_fk` (`id_produktu`),
  ADD KEY `id_administratora` (`id_administratora`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `konta_klientow`
--
ALTER TABLE `konta_klientow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `konta_odrzucone`
--
ALTER TABLE `konta_odrzucone`
  MODIFY `pesel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT dla tabeli `konta_pracownikow`
--
ALTER TABLE `konta_pracownikow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `konta_klientow`
--
ALTER TABLE `konta_klientow`
  ADD CONSTRAINT `id_klienta_fk` FOREIGN KEY (`id_klienta`) REFERENCES `osoby` (`pesel`);

--
-- Ograniczenia dla tabeli `konta_oczekujace`
--
ALTER TABLE `konta_oczekujace`
  ADD CONSTRAINT `id_moderatora_fk` FOREIGN KEY (`id_moderatora`) REFERENCES `konta_pracownikow` (`id`);

--
-- Ograniczenia dla tabeli `konta_odrzucone`
--
ALTER TABLE `konta_odrzucone`
  ADD CONSTRAINT `konta_odrzucone_id_moderatora_fk` FOREIGN KEY (`id_moderatora`) REFERENCES `konta_pracownikow` (`id`);

--
-- Ograniczenia dla tabeli `konta_pracownikow`
--
ALTER TABLE `konta_pracownikow`
  ADD CONSTRAINT `konta_pracownikow_id_pracownika_fk` FOREIGN KEY (`id_pracownika`) REFERENCES `osoby` (`pesel`);

--
-- Ograniczenia dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `koszyk_id_klienta_fk` FOREIGN KEY (`id_konta`) REFERENCES `konta_klientow` (`id`),
  ADD CONSTRAINT `koszyk_id_produktu_fk` FOREIGN KEY (`id_produktu`) REFERENCES `produkty` (`id`);

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `id_administratora` FOREIGN KEY (`id_administratora`) REFERENCES `konta_pracownikow` (`id`),
  ADD CONSTRAINT `id_konta_klienta_fk` FOREIGN KEY (`id_konta_klienta`) REFERENCES `konta_klientow` (`id`),
  ADD CONSTRAINT `id_produktu_fk` FOREIGN KEY (`id_produktu`) REFERENCES `produkty` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
