-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: db.dw082.nameserver.sk
-- Čas generovania: Pi 31.Dec 2021, 19:03
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
-- Databáza: `demorest`
--
CREATE DATABASE IF NOT EXISTS `demorest` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `demorest`;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `enum_alergeny`
--

DROP TABLE IF EXISTS `enum_alergeny`;
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

DROP TABLE IF EXISTS `enum_dni`;
CREATE TABLE `enum_dni` (
  `id_dna` int(10) NOT NULL,
  `den` varchar(20) NOT NULL,
  `Jazyk` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `enum_jednotka`
--

DROP TABLE IF EXISTS `enum_jednotka`;
CREATE TABLE `enum_jednotka` (
  `id_jednotky` int(8) NOT NULL,
  `jednotka` varchar(15) NOT NULL,
  `skratka` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `enum_kategoria_suroviny`
--

DROP TABLE IF EXISTS `enum_kategoria_suroviny`;
CREATE TABLE `enum_kategoria_suroviny` (
  `id_kategorie` int(11) NOT NULL,
  `nazov_kategorie` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `enum_typ_receptu`
--

DROP TABLE IF EXISTS `enum_typ_receptu`;
CREATE TABLE `enum_typ_receptu` (
  `id_typu_receptu` int(11) NOT NULL,
  `nazov_typu_receptu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_jedla_menu`
--

DROP TABLE IF EXISTS `tbl_jedla_menu`;
CREATE TABLE `tbl_jedla_menu` (
  `id_menu` int(10) NOT NULL,
  `den` int(10) NOT NULL,
  `polievka` int(11) NOT NULL,
  `menu1` int(11) NOT NULL,
  `menu2` int(11) NOT NULL,
  `menu3` int(11) NOT NULL,
  `statny_sviatok` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_menu`
--

DROP TABLE IF EXISTS `tbl_menu`;
CREATE TABLE `tbl_menu` (
  `id_menu` int(10) NOT NULL,
  `datum_od` date NOT NULL,
  `datum_do` date NOT NULL,
  `pocet_hosti` int(10) NOT NULL,
  `tyzden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_prijemka`
--

DROP TABLE IF EXISTS `tbl_prijemka`;
CREATE TABLE `tbl_prijemka` (
  `ID_objednavky` int(10) NOT NULL,
  `Cislo_objednavky` varchar(35) NOT NULL,
  `Datum_dorucenia` date NOT NULL,
  `Datum_splatnosti` date NOT NULL,
  `Celkova_cena` decimal(10,0) NOT NULL,
  `Variabilny_symbol` int(11) NOT NULL,
  `Vybavena` tinyint(1) NOT NULL,
  `Doklad` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_recept`
--

DROP TABLE IF EXISTS `tbl_recept`;
CREATE TABLE `tbl_recept` (
  `id_receptu` int(11) NOT NULL,
  `nazov_receptu` varchar(150) NOT NULL,
  `postup_receptu` varchar(10000) NOT NULL,
  `typ_receptu` int(11) NOT NULL,
  `alergeny` varchar(60) NOT NULL,
  `cena_jedla` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_suroviny`
--

DROP TABLE IF EXISTS `tbl_suroviny`;
CREATE TABLE `tbl_suroviny` (
  `id_suroviny` int(11) NOT NULL,
  `nazov_suroviny` varchar(150) NOT NULL,
  `kategoria_suroviny` int(11) NOT NULL,
  `mnozstvo_sklad` int(11) DEFAULT NULL,
  `jednotka` int(11) DEFAULT NULL,
  `popis_suroviny` varchar(1000) DEFAULT NULL,
  `dodavatel` varchar(100) DEFAULT NULL,
  `hmotnost_netto` float DEFAULT NULL,
  `hmotnost_brutto` float DEFAULT NULL,
  `katalogove_cislo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_suroviny_k_receptu`
--

DROP TABLE IF EXISTS `tbl_suroviny_k_receptu`;
CREATE TABLE `tbl_suroviny_k_receptu` (
  `id_rec_sur` int(11) NOT NULL,
  `id_sur` int(11) NOT NULL,
  `id_rec` int(11) NOT NULL,
  `mnozstvo` float(11,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `tbl_suroviny_v_objednavke`
--

DROP TABLE IF EXISTS `tbl_suroviny_v_objednavke`;
CREATE TABLE `tbl_suroviny_v_objednavke` (
  `ID_sur_obj` int(11) NOT NULL,
  `ID_objednavky` int(11) NOT NULL,
  `ID_suroviny` int(11) NOT NULL,
  `Mnozstvo` decimal(10,0) NOT NULL,
  `Jednotka` int(11) NOT NULL
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
-- Indexy pre tabuľku `enum_typ_receptu`
--
ALTER TABLE `enum_typ_receptu`
  ADD PRIMARY KEY (`id_typu_receptu`);

--
-- Indexy pre tabuľku `tbl_jedla_menu`
--
ALTER TABLE `tbl_jedla_menu`
  ADD KEY `menu` (`id_menu`),
  ADD KEY `den` (`den`),
  ADD KEY `tbl_jedla_menu_FK` (`polievka`),
  ADD KEY `tbl_jedla_menu_FK_1` (`menu1`),
  ADD KEY `tbl_jedla_menu_FK_3` (`menu3`);

--
-- Indexy pre tabuľku `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexy pre tabuľku `tbl_prijemka`
--
ALTER TABLE `tbl_prijemka`
  ADD PRIMARY KEY (`ID_objednavky`);

--
-- Indexy pre tabuľku `tbl_recept`
--
ALTER TABLE `tbl_recept`
  ADD PRIMARY KEY (`id_receptu`),
  ADD KEY `typ_receptu` (`typ_receptu`);

--
-- Indexy pre tabuľku `tbl_suroviny`
--
ALTER TABLE `tbl_suroviny`
  ADD PRIMARY KEY (`id_suroviny`),
  ADD KEY `kategoria` (`kategoria_suroviny`),
  ADD KEY `tbl_suroviny_FK` (`jednotka`);

--
-- Indexy pre tabuľku `tbl_suroviny_k_receptu`
--
ALTER TABLE `tbl_suroviny_k_receptu`
  ADD PRIMARY KEY (`id_rec_sur`),
  ADD KEY `id_rec` (`id_rec`),
  ADD KEY `id_sur` (`id_sur`);

--
-- Indexy pre tabuľku `tbl_suroviny_v_objednavke`
--
ALTER TABLE `tbl_suroviny_v_objednavke`
  ADD PRIMARY KEY (`ID_sur_obj`),
  ADD KEY `tbl_suroviny_v_objednavke_FK` (`Jednotka`),
  ADD KEY `tbl_suroviny_v_objednavke_FK_1` (`ID_suroviny`),
  ADD KEY `tbl_suroviny_v_objednavke_FK_2` (`ID_objednavky`);

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
-- AUTO_INCREMENT pre tabuľku `enum_typ_receptu`
--
ALTER TABLE `enum_typ_receptu`
  MODIFY `id_typu_receptu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `tbl_prijemka`
--
ALTER TABLE `tbl_prijemka`
  MODIFY `ID_objednavky` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `tbl_recept`
--
ALTER TABLE `tbl_recept`
  MODIFY `id_receptu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `tbl_suroviny`
--
ALTER TABLE `tbl_suroviny`
  MODIFY `id_suroviny` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `tbl_suroviny_k_receptu`
--
ALTER TABLE `tbl_suroviny_k_receptu`
  MODIFY `id_rec_sur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `tbl_suroviny_v_objednavke`
--
ALTER TABLE `tbl_suroviny_v_objednavke`
  MODIFY `ID_sur_obj` int(11) NOT NULL AUTO_INCREMENT;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `tbl_jedla_menu`
--
ALTER TABLE `tbl_jedla_menu`
  ADD CONSTRAINT `den` FOREIGN KEY (`den`) REFERENCES `enum_dni` (`id_dna`),
  ADD CONSTRAINT `menu` FOREIGN KEY (`id_menu`) REFERENCES `tbl_menu` (`id_menu`),
  ADD CONSTRAINT `tbl_jedla_menu_FK` FOREIGN KEY (`polievka`) REFERENCES `tbl_recept` (`id_receptu`),
  ADD CONSTRAINT `tbl_jedla_menu_FK_1` FOREIGN KEY (`menu1`) REFERENCES `tbl_recept` (`id_receptu`),
  ADD CONSTRAINT `tbl_jedla_menu_FK_2` FOREIGN KEY (`menu3`) REFERENCES `tbl_recept` (`id_receptu`),
  ADD CONSTRAINT `tbl_jedla_menu_FK_3` FOREIGN KEY (`menu3`) REFERENCES `tbl_recept` (`id_receptu`);

--
-- Obmedzenie pre tabuľku `tbl_suroviny`
--
ALTER TABLE `tbl_suroviny`
  ADD CONSTRAINT `jednotka` FOREIGN KEY (`jednotka`) REFERENCES `enum_jednotka` (`id_jednotky`),
  ADD CONSTRAINT `tbl_suroviny_FK` FOREIGN KEY (`kategoria_suroviny`) REFERENCES `enum_kategoria_suroviny` (`id_kategorie`);

--
-- Obmedzenie pre tabuľku `tbl_suroviny_k_receptu`
--
ALTER TABLE `tbl_suroviny_k_receptu`
  ADD CONSTRAINT `tbl_suroviny_k_receptu_ibfk_1` FOREIGN KEY (`id_rec`) REFERENCES `tbl_recept` (`id_receptu`),
  ADD CONSTRAINT `tbl_suroviny_k_receptu_ibfk_2` FOREIGN KEY (`id_sur`) REFERENCES `tbl_suroviny` (`id_suroviny`);

--
-- Obmedzenie pre tabuľku `tbl_suroviny_v_objednavke`
--
ALTER TABLE `tbl_suroviny_v_objednavke`
  ADD CONSTRAINT `tbl_suroviny_v_objednavke_FK` FOREIGN KEY (`Jednotka`) REFERENCES `enum_jednotka` (`id_jednotky`),
  ADD CONSTRAINT `tbl_suroviny_v_objednavke_FK_1` FOREIGN KEY (`ID_suroviny`) REFERENCES `tbl_suroviny` (`id_suroviny`),
  ADD CONSTRAINT `tbl_suroviny_v_objednavke_FK_2` FOREIGN KEY (`ID_objednavky`) REFERENCES `tbl_prijemka` (`ID_objednavky`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
