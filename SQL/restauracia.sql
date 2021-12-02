-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: db.dw082.nameserver.sk
-- Čas generovania: St 24.Nov 2021, 09:15
-- Verzia serveru: 10.5.13-MariaDB-1:10.5.13+maria~focal
-- Verzia PHP: 5.5.9-1ubuntu4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `restauracia`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `enum_alergeny`
--

CREATE TABLE `enum_alergeny` (
  `Id` int(11) NOT NULL,
  `Skratka` int(3) DEFAULT NULL,
  `Nazov` varchar(43) DEFAULT NULL,
  `Popis` varchar(43) DEFAULT NULL,
  `displayNameEng` varchar(37) DEFAULT NULL,
  `PopisEng` varchar(37) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `enum_dni`
--

CREATE TABLE `enum_dni` (
  `id_dna` int(10) NOT NULL,
  `den` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `enum_jednotka`
--

CREATE TABLE `enum_jednotka` (
  `id_jednotky` int(8) NOT NULL,
  `jednotka` varchar(15) NOT NULL,
  `skratka` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `enum_kategoria_suroviny`
--

CREATE TABLE `enum_kategoria_suroviny` (
  `id_kategorie` int(11) NOT NULL,
  `nazov_kategorie` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `recept`
--

CREATE TABLE `recept` (
  `id` int(11) NOT NULL,
  `nazov` varchar(150) NOT NULL,
  `postup` varchar(10000) NOT NULL,
  `typ_receptu` int(11) NOT NULL,
  `alergeny` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `suroviny_k_receptu`
--

CREATE TABLE `suroviny_k_receptu` (
  `id_rec_sur` int(11) NOT NULL,
  `id_sur` int(11) NOT NULL,
  `id_rec` int(11) NOT NULL,
  `mnozstvo` float(11,4) NOT NULL,
  `jednotka` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_jedla_menu`
--

CREATE TABLE `tbl_jedla_menu` (
  `id_menu` int(10) NOT NULL,
  `id_jedla` int(10) NOT NULL,
  `den` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(10) NOT NULL,
  `datum_od` date NOT NULL,
  `datum_do` date NOT NULL,
  `pocet_hosti` int(10) NOT NULL,
  `tyzden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_suroviny`
--

CREATE TABLE `tbl_suroviny` (
  `id_suroviny` int(11) NOT NULL,
  `nazov_suroviny` varchar(150) NOT NULL,
  `kategoria_suroviny` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `typ_receptu`
--

CREATE TABLE `typ_receptu` (
  `id_typu_receptu` int(11) NOT NULL,
  `nazov_typu_receptu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `enum_alergeny`
--
ALTER TABLE `enum_alergeny`
  ADD PRIMARY KEY (`Id`);

--
-- Indexy pre tabuľku `enum_dni`
--
ALTER TABLE `enum_dni`
  ADD PRIMARY KEY (`id_dna`);

--
-- Indexy pre tabuľku `enum_jednotka`
--
ALTER TABLE `enum_jednotka`
  ADD PRIMARY KEY (`id_jednotky`);

--
-- Indexy pre tabuľku `enum_kategoria_suroviny`
--
ALTER TABLE `enum_kategoria_suroviny`
  ADD PRIMARY KEY (`id_kategorie`);

--
-- Indexy pre tabuľku `recept`
--
ALTER TABLE tbl_recept
  ADD PRIMARY KEY (id_receptu),
  ADD KEY `typ_receptu` (`typ_receptu`);

--
-- Indexy pre tabuľku `suroviny_k_receptu`
--
ALTER TABLE tbl_suroviny_k_receptu
  ADD PRIMARY KEY (`id_rec_sur`),
  ADD KEY `id_rec` (`id_rec`),
  ADD KEY `id_sur` (`id_sur`),
  ADD KEY `jednotka` (`jednotka`);

--
-- Indexy pre tabuľku `tbl_jedla_menu`
--
ALTER TABLE `tbl_jedla_menu`
  ADD KEY `jedlo` (`id_jedla`),
  ADD KEY `menu` (`id_menu`),
  ADD KEY `den` (`den`);

--
-- Indexy pre tabuľku `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexy pre tabuľku `tbl_suroviny`
--
ALTER TABLE `tbl_suroviny`
  ADD PRIMARY KEY (`id_suroviny`),
  ADD KEY `kategoria` (`kategoria_suroviny`);

--
-- Indexy pre tabuľku `typ_receptu`
--
ALTER TABLE enum_typ_receptu
  ADD PRIMARY KEY (`id_typu_receptu`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `enum_dni`
--
ALTER TABLE `enum_dni`
  MODIFY `id_dna` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `enum_jednotka`
--
ALTER TABLE `enum_jednotka`
  MODIFY `id_jednotky` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `enum_kategoria_suroviny`
--
ALTER TABLE `enum_kategoria_suroviny`
  MODIFY `id_kategorie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `recept`
--
ALTER TABLE tbl_recept
  MODIFY id_receptu int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `suroviny_k_receptu`
--
ALTER TABLE tbl_suroviny_k_receptu
  MODIFY `id_rec_sur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `tbl_suroviny`
--
ALTER TABLE `tbl_suroviny`
  MODIFY `id_suroviny` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `typ_receptu`
--
ALTER TABLE enum_typ_receptu
  MODIFY `id_typu_receptu` int(11) NOT NULL AUTO_INCREMENT;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `recept`
--
ALTER TABLE tbl_recept
  ADD CONSTRAINT `typ_receptu` FOREIGN KEY (`typ_receptu`) REFERENCES enum_typ_receptu (`id_typu_receptu`);

--
-- Obmedzenie pre tabuľku `suroviny_k_receptu`
--
ALTER TABLE tbl_suroviny_k_receptu
  ADD CONSTRAINT `suroviny_k_receptu_ibfk_1` FOREIGN KEY (`id_rec`) REFERENCES tbl_recept (id_receptu),
  ADD CONSTRAINT `suroviny_k_receptu_ibfk_2` FOREIGN KEY (`id_sur`) REFERENCES `tbl_suroviny` (`id_suroviny`),
  ADD CONSTRAINT `suroviny_k_receptu_ibfk_3` FOREIGN KEY (`jednotka`) REFERENCES `enum_jednotka` (`id_jednotky`);

--
-- Obmedzenie pre tabuľku `tbl_jedla_menu`
--
ALTER TABLE `tbl_jedla_menu`
  ADD CONSTRAINT `den` FOREIGN KEY (`den`) REFERENCES `enum_dni` (`id_dna`),
  ADD CONSTRAINT `jedlo` FOREIGN KEY (`id_jedla`) REFERENCES tbl_recept (id_receptu),
  ADD CONSTRAINT `menu` FOREIGN KEY (`id_menu`) REFERENCES `tbl_menu` (`id_menu`);

--
-- Obmedzenie pre tabuľku `tbl_suroviny`
--
ALTER TABLE `tbl_suroviny`
  ADD CONSTRAINT `kategoria` FOREIGN KEY (`kategoria_suroviny`) REFERENCES `enum_kategoria_suroviny` (`id_kategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
