-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2019 at 08:20 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 7.2.17-1+0~20190412070953.20+jessie~1.gbp23a36d

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WebDiP2018x009`
--

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `id_grad` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `zupanija` varchar(45) NOT NULL,
  `postanski_broj` int(11) NOT NULL,
  `drzava` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grad`
--

INSERT INTO `grad` (`id_grad`, `naziv`, `zupanija`, `postanski_broj`, `drzava`) VALUES
(1, 'Varaždin', 'Varaždinska', 42000, 'Hrvatska'),
(2, 'Petrijanec', 'Varaždinska', 42206, 'Hrvatska'),
(3, 'Strmec podravski', 'Varaždinska', 42206, 'Hrvatska'),
(4, 'Družbinec', 'Varaždinska', 42206, 'Hrvatska'),
(5, 'Majerje', 'Varaždinska', 42206, 'Hrvatska'),
(6, 'Slavnoski brod', 'Brodsko-posavska', 35000, 'Hrvatska'),
(7, 'Zagreb', 'Varaždinska', 10000, 'Hrvatska'),
(8, 'Vukovar', 'Vukovarsko-srijemska', 32000, 'Hrvatska'),
(9, ' Cestica', 'Varaždinska', 42208, 'Hrvatska'),
(10, 'Komar', 'Varaždinska', 42206, 'Hrvatska');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnika` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `lozinka` varchar(45) NOT NULL,
  `lozinka_kript` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `drzava` varchar(50) DEFAULT NULL,
  `datum_vrijeme_registracije` datetime DEFAULT NULL,
  `uloga_id_uloga` int(11) NOT NULL,
  `aktiviran_racun` varchar(2) DEFAULT 'ne',
  `aktivacijski_kod` int(4) DEFAULT NULL,
  `broj_pokusaja` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnika`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `lozinka_kript`, `status`, `email`, `drzava`, `datum_vrijeme_registracije`, `uloga_id_uloga`, `aktiviran_racun`, `aktivacijski_kod`, `broj_pokusaja`) VALUES
(1, 'Pero', 'Perin', 'ppin', '123456', NULL, 1, 'pp9990@gmail.com', 'hrvatska', '2019-04-01 04:13:21', 3, 'da', NULL, 0),
(2, 'Marko', 'Mark', 'mm93939', '123456', NULL, 1, 'rfri55@net.hr', 'hrvatska', '2019-04-15 00:00:00', 3, 'da', NULL, 0),
(3, 'Sara', 'Small', 'ssmaalexs', '123456', NULL, 1, 'smallxs@gmail.com', 'hrvatska', '2019-04-02 00:00:00', 3, 'da', NULL, 0),
(4, 'Valentino', 'Handsome', 'Handxl', '123456', NULL, 1, 'ceco@gmail.com', 'hrvatska', '2019-04-03 07:00:00', 3, 'da', NULL, 0),
(5, 'Lana', 'Jug', 'ljuga', 'ljuga1', NULL, 1, 'ljugga@gmail.com', 'hrvatska', '2019-04-01 00:00:00', 3, 'da', NULL, 0),
(6, 'Tea', 'Jug', 'tjug', 'tjug343', NULL, 1, 'jug@gmail.com', 'hrvatska', '2019-04-01 00:00:00', 3, 'da', NULL, 0),
(7, 'Nikolina', 'Telebar', 'nina22', 'niaa22', NULL, 2, 'nininini@gmail.com', 'hrvatska', '2019-04-01 00:00:00', 3, 'da', NULL, 0),
(8, 'Marija', 'Konac', 'mkonac', 'mkonac323', NULL, 1, 'mkonac99@gmail.com', 'hrvatska', '2019-04-02 00:00:00', 3, 'da', NULL, 0),
(9, 'Mina', 'Mimi', 'minsdia', 'mmmm9999', NULL, 1, 'mki@gmail.com', 'hrvatska', '2019-04-01 00:00:00', 3, 'da', NULL, 0),
(10, 'Sara', 'Sarovi', 'sssori', 'soio888', NULL, 1, 'koipp@gmail.com', 'hrvatska', '2019-04-01 00:00:00', 3, 'da', NULL, 0),
(11, 'Valentino', 'Bencek', 'vbencek', 'vbencek1', NULL, 1, 'vbencek@foi.hr', 'hrvatska', '2019-04-01 00:00:00', 1, 'da', NULL, 0),
(27, 'valentino', 'moderator', 'moderator', 'moderator1', NULL, 1, 'moderator@gmail.com', 'hrvatska', '2019-05-29 00:00:00', 2, 'da', NULL, 1),
(28, 'korisnik', 'korisnik_prez', 'korisnik', 'korisnik1', NULL, 1, 'korisnik@gmail.com', 'hrvatska', '2019-05-01 00:00:00', 3, 'da', NULL, 0),
(37, 'Marko', 'Maric', 'mmaric123', '123456', '46e6d951217deb6f9a0895fe67ab7b0bc2694e5d', 1, 'ceco.compani@gmail.com', 'hrvatska', '2019-06-02 13:00:13', 3, 'da', 5188, 0),
(39, 'Lidija', 'Suput', 'llsupu566', '123456', '46e6d951217deb6f9a0895fe67ab7b0bc2694e5d', 1, 'ssuput@gmail.com', 'hrvatska', '2019-06-02 17:32:09', 3, 'da', 4547, 0),
(40, 'Tino', 'Moderator', 'moderator1', '123456', '46e6d951217deb6f9a0895fe67ab7b0bc2694e5d', 1, 'ceco.compani@gmail.com', 'hrvatska', '2019-06-02 17:39:52', 2, 'da', 8200, 1),
(41, 'Val', 'Moderator', 'moderator2', '123456', '46e6d951217deb6f9a0895fe67ab7b0bc2694e5d', 1, 'ceco.compani@gmail.com', 'hrvatska', '2019-06-03 11:14:04', 2, 'da', 2224, 0),
(42, 'Dejan', 'Lovren', 'dLovren', '123456', '46e6d951217deb6f9a0895fe67ab7b0bc2694e5d', 1, 'dlovren@gmail.com', 'hrvatska', '2019-06-03 17:03:25', 3, 'da', 3720, 0),
(43, 'Mirko', 'Filipovic', 'mfilipovic', 'filipovic1', '029d543291bb5f9e410b85dd1f93656dc82b8b4d', 1, 'mfilipovic123@gmail.com', 'francuska', '2019-06-03 17:07:23', 3, 'da', 2863, 0),
(44, 'Davor', 'Zlatni', 'zlatni124', '123456', '46e6d951217deb6f9a0895fe67ab7b0bc2694e5d', 1, 'zlatni6@gmail.com', 'hrvatska', '2019-06-03 17:20:48', 3, 'da', 8353, 0),
(45, 'Igor', 'Vor', 'vori123', '123456', '46e6d951217deb6f9a0895fe67ab7b0bc2694e5d', 1, 'vori45@gmail.com', 'hrvatska', '2019-06-03 17:22:00', 3, 'da', 5163, 0),
(46, 'Sven', 'Osmi', 'osmi888', '123456', '46e6d951217deb6f9a0895fe67ab7b0bc2694e5d', 1, 'osmi888@gmail.com', 'hrvatska', '2019-06-03 17:22:49', 3, 'da', 7803, 0),
(47, 'Silvija', 'Miko', 'smiko123', 'smiko1', '17ab7a6c095b4f9d605ed22cb21596ca48b3280d', 1, 'smiko7@gmail.com', 'hrvatska', '2019-06-03 17:23:45', 3, 'da', 5497, 0),
(48, 'Lovro', 'Lovrek', 'llovrek123', '123456', '46e6d951217deb6f9a0895fe67ab7b0bc2694e5d', 1, 'llovrek@gmail.com', 'hrvatska', '2019-06-03 17:24:44', 3, 'da', 5306, 0),
(49, 'Harry', 'Potter', 'hpotter123', '123456', '46e6d951217deb6f9a0895fe67ab7b0bc2694e5d', 1, 'hpotter2@gmail.com', 'hrvatska', '2019-06-03 17:25:43', 3, 'ne', 9212, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lokacija`
--

CREATE TABLE `lokacija` (
  `id_lokacija` int(11) NOT NULL,
  `naziv_rijeke` varchar(45) NOT NULL,
  `duljina` int(11) NOT NULL,
  `grad` int(11) NOT NULL,
  `administrator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lokacija`
--

INSERT INTO `lokacija` (`id_lokacija`, `naziv_rijeke`, `duljina`, `grad`, `administrator`) VALUES
(1, 'Drava', 10, 1, 11),
(2, 'Drava', 20, 2, 11),
(3, 'Drava', 30, 3, 11),
(4, 'Drava', 35, 4, 11),
(5, 'Drava', 22, 5, 11),
(6, 'Drava', 99, 9, 11),
(7, 'Drava', 9, 10, 11),
(8, 'Sava', 66, 6, 11),
(9, 'Sava', 88, 7, 11),
(10, 'Dunav', 88, 8, 11),
(13, 'Mura', 4, 10, 11),
(14, 'Jezero ribnjak', 11, 2, 11),
(15, 'Ribnjak kutina', 11, 7, 11),
(16, 'Ribnjak marija', 1, 5, 11),
(17, 'Ribnjak jezero 33', 1, 4, 11),
(18, 'Vizija jezera', 11, 8, 11),
(19, 'Mura', 11, 6, 11),
(20, 'Danica', 1, 5, 11),
(21, 'Kanal', 11, 5, 11),
(22, 'Kopno ribanja', 1, 6, 11),
(23, 'Jezero bok', 44, 7, 11),
(24, 'Rijeka lada', 1, 6, 11),
(25, 'Kupa', 1, 6, 11),
(26, 'Kongo', 1, 2, 11),
(27, 'Inf', 11, 3, 11),
(28, 'Kolima', 44, 4, 11),
(29, 'Ural', 4, 1, 11),
(30, 'Oranje', 4, 4, 11),
(31, 'Rio negro', 4, 9, 11),
(32, 'Senegal', 7, 9, 11),
(33, 'Kura', 1, 4, 11),
(34, 'Tigris', 1, 5, 11),
(35, 'Ohio', 11, 6, 11),
(36, 'Volza', 1, 7, 11),
(37, 'Oka', 4, 6, 11),
(38, 'Oka', 4, 5, 11),
(39, 'Tigris', 4, 1, 11),
(40, 'Nil', 44, 8, 11),
(41, 'Ohio', 44, 7, 11),
(42, 'Colorado', 11, 4, 11),
(43, 'Colorafo', 44, 4, 11);

-- --------------------------------------------------------

--
-- Table structure for table `natjecanje`
--

CREATE TABLE `natjecanje` (
  `id_natjecanje` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `opis` longtext NOT NULL,
  `datum_pocetka` date DEFAULT NULL,
  `datum_zavrsetka` date DEFAULT NULL,
  `lokacija` int(11) NOT NULL,
  `ribicki_klub` int(11) DEFAULT NULL,
  `moderator` int(11) NOT NULL,
  `pobjednik` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `natjecanje`
--

INSERT INTO `natjecanje` (`id_natjecanje`, `naziv`, `opis`, `datum_pocetka`, `datum_zavrsetka`, `lokacija`, `ribicki_klub`, `moderator`, `pobjednik`) VALUES
(28, 'Kederi 97/98', 'natjecanje u lovu na kedere, ulaz besplatan, natjecatelji placaju upad 50 kuna. vrijdne nagrade', '2019-06-01', '2019-06-03', 1, 2, 27, NULL),
(29, 'Open som cup 90', 'Natjecanje u lovu na ribe', '2019-05-28', '2019-06-06', 3, 8, 27, NULL),
(30, 'Kederi pecanje natjecanje', 'natjecanje za starije ljude', '2019-05-27', '2019-05-29', 5, 4, 27, 9),
(31, 'Ribolov drava 2019', 'Natjecanje u lovu na ribice. Nagrada je trofej najboljeg ribolovca', '2019-05-31', '2019-06-07', 3, 2, 27, NULL),
(32, 'Dravolov 450', 'lov na dravi, za vise informacija posjetite web stranicu', '2019-05-27', '2019-05-29', 2, 2, 27, 45),
(33, 'Savolov 2019', 'lov na ribe na preljepoj savi, upad se placa 20 kuna, dobra muzika i jelo', '2019-05-28', '2019-06-06', 8, 4, 27, NULL),
(34, 'Natjecanje ribolovaca 90', 'Natjecanje svih ljudi i uzrasta na dunavu', '2019-05-27', '2019-05-28', 10, 6, 27, 1),
(35, 'Ljudi i ribe', 'druzenje ljudi i riba', '2019-06-13', '2019-06-19', 8, 8, 27, NULL),
(36, 'Drava natjecanje 2019.', 'Ribolovno natjecanje na Dravi 2019. godine', '2019-05-28', '2019-05-28', 2, 2, 11, 49),
(37, 'Natjecanje u lovu somova', 'Ribolovno natjecanje u lovu somova. Po?inje 10.09.2019.', '2019-06-10', '2019-06-11', 9, 10, 27, NULL),
(38, 'Ribolov u Vukovaru', 'Ribolovno natjecanje u organizaciji kluba ribara u Vukovaru', '2019-06-03', '2019-06-04', 10, 25, 27, NULL),
(39, 'Ribolovna liga', 'Ribolovna liga na Dravi', '2019-06-11', '2019-06-15', 6, 4, 27, NULL),
(40, 'Natjecanje Pecalica', 'Natjecanje u ribolovu pecalicama', '2019-06-17', '2019-06-19', 8, 7, 40, NULL),
(41, 'Ribolovno natjecanje Sava', 'Ribolovno natjecanje koje se održava na Savi', '2019-06-13', '2019-06-15', 9, 3, 40, NULL),
(42, 'Som natjecanje', 'Natjecanje u lovu na somove', '2019-06-17', '2019-06-20', 2, 5, 40, NULL),
(43, 'Prijateljsko natjecanje u ribolovu', 'Prijateljsko natjecanje na Dravi u Majerju 29.06.2019. s po?etkom u 8:00 sati', '2019-06-29', '2019-06-30', 5, 1, 40, NULL),
(44, 'Keder natjecanje 2019', 'Natjecanje u lovu na kedere. ', '2019-06-26', '2019-06-27', 3, 7, 40, NULL),
(45, 'Dravica i pivica 11', 'drava uz pivu', '2019-05-27', '2019-05-28', 4, 8, 27, NULL),
(46, 'Pecanje u ribnjaku ', 'Pecanje i pecarenje', '2019-06-01', '2019-06-02', 17, 37, 41, NULL),
(47, 'Super pecanje 2019', 'Cup natjecanje i trofeji', '2019-06-12', '2019-06-13', 4, 36, 41, NULL),
(48, 'Ribolov 3.6.2019.', 'ribolov na rijeci Dravi, cijena upada iznosi 40 kuna. Razni trofeji, druzenje i zabava', '2019-05-29', '2019-05-30', 3, 34, 41, NULL),
(49, 'Ribolovno natjecanje u lovu manjih riba', 'Natjecanje u lovu na manje ribe, obavezno donijeti vlastitu opremu.', '2019-05-27', '2019-05-28', 16, 41, 41, 44),
(50, 'Open cup "Lady Sponge"', 'natjecanje za manje uzraste, ulaznica iznosi 10kuna. Natjecatelji placaju 30kuna i imaju osigurano jesti i piti', '2019-05-01', '2019-05-05', 10, 39, 41, NULL),
(51, 'RN "Zadravec"', 'Natjecanju u lovu na tezinu, lokacija je jezero 33 pokraj druzbinca. Donesite svoju opremu', '2019-05-28', '2019-05-30', 17, 39, 41, NULL),
(52, 'Ribolov na Muri 11.06', 'ribolov na rijeci muri, super zabava', '2019-06-12', '2019-06-19', 13, 31, 41, NULL),
(53, 'Ribolov 2018 drava', 'ribolov na manje ribe', '2019-06-11', '2019-06-26', 3, 34, 41, NULL),
(54, 'Kup varazdin', 'natjecanje u ribolovu u varazdinu', '2019-05-27', '2019-06-13', 1, 36, 41, NULL),
(55, 'Kup zagreb', 'natjecanje u ribolovu u zagrebu', '2019-06-04', '2019-06-06', 9, 33, 41, NULL),
(56, 'Kup Petrijanec', 'natjecanje u lovu na svakojake ribe, razne kategorije i razne nagrade', '2019-06-05', '2019-06-05', 26, 30, 41, NULL),
(57, 'Kup Kanal', 'Kup gdje se natjecu samo najbolji ribolovci iz okolice', '2019-05-05', '2019-05-19', 21, 30, 41, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `odobreno_odbijeno`
--

CREATE TABLE `odobreno_odbijeno` (
  `id_odobreno_odbijeno` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `odobreno_odbijeno`
--

INSERT INTO `odobreno_odbijeno` (`id_odobreno_odbijeno`, `naziv`) VALUES
(1, 'Odobreno'),
(2, 'Odbijeno'),
(3, 'Nije pregledano');

-- --------------------------------------------------------

--
-- Table structure for table `ribicki_klub`
--

CREATE TABLE `ribicki_klub` (
  `id_ribicki_klub` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL,
  `adresa` varchar(60) NOT NULL,
  `predsjednik` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `web_adresa` varchar(45) DEFAULT 'nema',
  `datum_kreiranja` date NOT NULL,
  `moderator` int(11) NOT NULL,
  `administrator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ribicki_klub`
--

INSERT INTO `ribicki_klub` (`id_ribicki_klub`, `naziv`, `adresa`, `predsjednik`, `email`, `web_adresa`, `datum_kreiranja`, `moderator`, `administrator`) VALUES
(1, 'Srk Varazdin', 'varazdinska 22', 'Pero Mali', 'srkvaraz@gmail.com', 'Nema', '2019-03-06', 40, 11),
(2, 'Klub Drava', 'dravska 88', 'Dravko Dravi', 'nema', 'nema', '2019-04-09', 27, 11),
(3, 'Klub 88', 'adresa 99', 'Mario mari', 'mm68@gmail.com', 'nema', '2019-04-10', 40, 11),
(4, 'Klub 901', 'adresa 901', 'nema', 'nema', 'nema', '2019-04-01', 27, 11),
(5, 'Klub SOM', 'klubska 88', 'Mario Klepem', 'som@gmail.com', 'nema', '2019-04-22', 40, 11),
(6, 'Klub Iki', 'ikiara 88', 'Celio Mark', 'iikkic@gmail.com', 'nema', '2019-04-02', 27, 11),
(7, 'Keder2', 'Kederova 8881', 'Mali Keder', 'keder@gmail.com', 'klubkedera@gmail.com', '2019-04-01', 40, 11),
(8, 'Klub Riba 1', 'ribica 88', 'Bob Sponge', 'riba@gmail.com', 'www.riba.com', '2019-04-02', 27, 11),
(9, 'Ribicev klub', 'Ribo 9', 'Mario Am', 'nema', 'www.rklub.com', '2019-04-01', 40, 11),
(10, 'Som i lov', 'somova 99', 'Kim Kard', 'somic@gmail.com', 'nema', '2019-04-01', 27, 11),
(24, 'Ribica', 'ribiceva 44', 'Spuzva Bob', 'ribica.company@gmail.com', 'nema', '2019-06-02', 40, 11),
(25, 'Klub ribara', 'Vladimira Nazora 99, Varazdin', 'org d.o.o', 'nema@gmail.com', 'nema', '2019-06-02', 27, 11),
(26, 'SRK drava', 'Dravska 44, varazdin ', 'Marko Visak', 'srkvz@gmail.com', 'Www.srkvz.com', '2019-06-03', 27, 11),
(27, 'Srk Sava', 'Savska 55, Zagreb', 'Savko Savic', 'savasrk@gmail.com', 'Www.savasrk.com', '2019-06-03', 40, 11),
(28, 'SRK sljuka', 'Edge 33, varazdin', 'Ivo Ivic', 'iivic77@gmail.com', 'Sljuka@gmail.hr', '2019-06-03', 27, 11),
(29, 'Srk jadran', 'Jardanova 33, cakovec', 'Ivica ivicovic', 'dika44@gmail.com', 'nema', '2019-06-03', 40, 11),
(30, 'Mrk riba', 'Adresa ribe 44, karlovac', 'Karlo karlo', 'kkarlo55@gmail.com', 'Kkaaaa.Com', '2019-06-03', 41, 11),
(31, 'Rk rak', 'Rakova 33 zagreb', 'Ratko rak', 'rak@gmail.com', 'Nema', '2019-06-03', 41, 11),
(32, 'Rk sljuka cakovec', 'Cakovecka 44 cakovec', 'Tino tinic', 'ratkoaa5@gmail.com', 'Ratko.com', '2019-06-03', 41, 11),
(33, 'Klub riba', 'Ribicevq 44, varazdin', 'Nema', 'neszo55@gmail.com', 'Nema', '2019-06-03', 41, 11),
(34, 'Rkr rakovi11', 'Rakova 53 zagreb', 'Rovac mirko', 'ra3335@gmail.com', 'Nema', '2019-06-03', 41, 11),
(36, 'Klub Garaza', 'Garazeva 55 zagreb', 'Galio gal', 'v@g.v', 'Nema', '2019-06-03', 41, 11),
(37, 'Drava 3000', 'Dravska 3000', 'Imenko ime', 'dika@gmail.com', 'Nema', '2019-06-03', 41, 11),
(38, 'Klub sportskih ribara', 'Ribar 55, varazdin', 'Goran pirac', 'pirooo@gmail.com', 'Nema', '2019-06-03', 41, 11),
(39, 'Ribic and baits', 'Ribica 44, Zagreb ', 'Ribic ribar', '344gggg@gmail.com', 'Gggggklub. Com', '2019-06-03', 41, 11),
(40, 'Klub zena ribolovca', 'Optujska 44 varazdin', 'Maria maric', 'klubzena@gmail.com', 'Zenaklub.com', '2019-06-03', 27, 11),
(41, 'SRK pero', 'Prova 44,zg', 'Pero peric', 'pero@gmail.com', 'Perolovac.com', '2019-06-03', 41, 11),
(42, 'Klub julius', 'Julijeva 55', 'Nema', 'julije@gmail.com', 'nema', '2019-06-03', 40, 11),
(44, 'Klub riba 68', 'ribicka 88 varazdin', 'Ribo ribic', 'ribic@gmail.com', 'ribic.com', '2019-06-03', 40, 11),
(45, 'Ribar "Maro"', 'maro 55, varazdin', 'Maro Maric', 'mmaric22@gmail.com', 'nema', '2019-06-03', 27, 11);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_statusa` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_statusa`, `naziv`) VALUES
(1, 'nije blokiran'),
(2, 'blokiran');

-- --------------------------------------------------------

--
-- Table structure for table `sudionici_natjecanja`
--

CREATE TABLE `sudionici_natjecanja` (
  `korisnik_id` int(11) NOT NULL,
  `natjecanje_id` int(11) NOT NULL,
  `bodovi` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sudionici_natjecanja`
--

INSERT INTO `sudionici_natjecanja` (`korisnik_id`, `natjecanje_id`, `bodovi`) VALUES
(5, 28, 0),
(6, 29, 0),
(1, 30, 11),
(9, 30, 34),
(45, 30, 34),
(46, 30, 0),
(9, 32, 3),
(45, 32, 444),
(2, 33, 0),
(1, 34, 1),
(1, 35, 0),
(2, 35, 0),
(45, 35, 0),
(45, 36, 1),
(46, 36, 0),
(47, 36, 0),
(48, 36, 0),
(49, 36, 23),
(44, 37, 0),
(5, 40, 0),
(6, 40, 0),
(8, 40, 0),
(2, 42, 0),
(5, 44, 0),
(8, 44, 0),
(27, 44, 0),
(2, 47, 0),
(8, 48, 41),
(46, 48, 41),
(44, 49, 45),
(48, 51, 1),
(27, 53, 0),
(8, 55, 0),
(45, 56, 0),
(45, 57, 123);

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id_uloga` int(11) NOT NULL,
  `naziv` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id_uloga`, `naziv`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `zahtjev_za_prijavu_na_natjecanje`
--

CREATE TABLE `zahtjev_za_prijavu_na_natjecanje` (
  `id_zahtjev_za_prijavu_na_natjecanje` int(11) NOT NULL,
  `opis_prijave` varchar(300) NOT NULL,
  `prilozena_slika` varchar(100) NOT NULL DEFAULT 'default.png',
  `broj_mobitela` varchar(50) NOT NULL,
  `datum_prijave` date NOT NULL,
  `datum_pregleda_zahtjeva` date DEFAULT NULL,
  `odobreno` int(11) DEFAULT NULL,
  `natjecanje` int(11) NOT NULL,
  `korisnik` int(11) NOT NULL,
  `moderator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zahtjev_za_prijavu_na_natjecanje`
--

INSERT INTO `zahtjev_za_prijavu_na_natjecanje` (`id_zahtjev_za_prijavu_na_natjecanje`, `opis_prijave`, `prilozena_slika`, `broj_mobitela`, `datum_prijave`, `datum_pregleda_zahtjeva`, `odobreno`, `natjecanje`, `korisnik`, `moderator`) VALUES
(27, 'zelim se prijaviti na natjecanje, volim ribe.', 'Applejack.png', '099-333-9999', '2019-06-02', '2019-06-02', 2, 36, 5, 27),
(28, 'Zelim se prijaviti na natjecanje', 'multi_s5.jpg', '099-333-9999', '2019-06-02', '2019-06-02', 1, 44, 5, 40),
(29, 'prijava', 'Applejack.png', '099-333-9999', '2019-06-02', '2019-06-02', 1, 28, 5, 27),
(30, 'moja prijava', 'default.png', '099-333-9999', '2019-06-02', '2019-06-02', 1, 40, 5, 40),
(31, 'zelim se prijaviti na natjecanje. Imam iskustva sa ribolovom.', 'default.png', '091-222-3222', '2019-06-02', '2019-06-02', 1, 30, 1, 27),
(32, 'zelim se prijaviti na natjecanje. Imam iskustva sa ribolovom.', 'default.png', '099-333-9999', '2019-06-02', '2019-06-02', 1, 34, 1, 27),
(33, 'zelim se prijaviti na natjecanje. Imam iskustva sa ribolovom.', 'default.png', '091-222-3222', '2019-06-02', '2019-06-02', 1, 35, 1, 27),
(34, 'zelim se prijaviti na natjecanje. Imam iskustva sa ribolovom.', 'default.png', '099-333-9999', '2019-06-02', '2019-06-02', 2, 42, 1, 40),
(35, 'zelim se prijaviti na natjecanje', 'default.png', '095-9889878', '2019-06-04', '2019-06-02', 2, 35, 9, 27),
(36, 'prijava na natjecanje', 'default.png', '095-9889878', '2019-06-03', '2019-06-02', 1, 30, 9, 27),
(37, 'prijava na natjecanje u pecanju', 'default.png', '095-9889878', '2019-06-03', '2019-06-02', 2, 31, 9, 27),
(38, 'prijava na natjecanje u pecanju', 'default.png', '095-9889878', '2019-06-03', '2019-06-02', 1, 32, 9, 27),
(39, 'prijava na natjecanje u pecanju', 'default.png', '095-9889878', '2019-06-03', '2019-06-02', 2, 33, 9, 27),
(40, 'zeljala bih se prijaviti na natjecanje', 'default.png', '095-9889899', '2019-06-01', NULL, 3, 28, 6, NULL),
(41, 'zeljala bih se prijaviti na natjecanje', 'default.png', '095-9889899', '2019-06-01', '2019-06-03', 1, 29, 6, 11),
(42, 'zeljala bih se prijaviti na natjecanje', 'default.png', '095-9889899', '2019-06-01', NULL, 3, 34, 6, NULL),
(43, 'zeljala bih se prijaviti na natjecanje', 'default.png', '095-9889899', '2019-06-01', '2019-06-03', 2, 33, 6, 27),
(44, 'zeljala bih se prijaviti na natjecanje', 'default.png', '095-9889899', '2019-06-01', '2019-06-03', 1, 40, 6, 40),
(45, 'zelim se prijaviti na natjecanje, pecam vec 7 godina', 'default.png', '092-355-2323', '2019-06-03', '2019-06-03', 1, 36, 45, 27),
(46, 'zelim se prijaviti na natjecanje, pecam vec 7 godina', 'default.png', '092-355-2323', '2019-06-03', '2019-06-03', 1, 32, 45, 27),
(47, 'zelim se prijaviti na natjecanje, pecam vec 7 godina', 'default.png', '092-355-2323', '2019-06-03', '2019-06-03', 1, 30, 45, 27),
(48, 'zelim se prijaviti na natjecanje, pecam vec 7 godina', 'default.png', '092-355-2323', '2019-06-03', '2019-06-03', 1, 57, 45, 41),
(49, 'zelim se prijaviti na natjecanje, pecam vec 7 godina', 'default.png', '092-355-2323', '2019-06-03', '2019-06-03', 1, 56, 45, 11),
(50, 'zelim se prijaviti na natjecanje, pecam vec 7 godina', 'rarity.png', '099-333-9999', '2019-06-03', '2019-06-03', 1, 35, 45, 27),
(51, 'super sam ribolovac, molim odobrite molbu', 'Rainbow_Dash.png', '098-333-3333', '2019-06-03', '2019-06-03', 1, 37, 44, 27),
(52, 'super sam ribolovac, molim odobrite molbu', 'default.png', '099-333-9999', '2019-06-03', '2019-06-03', 2, 37, 44, 27),
(53, 'super sam ribolovac, molim odobrite molbu', 'default.png', '098-333-3333', '2019-06-03', '2019-06-03', 2, 50, 44, 41),
(54, 'super sam ribolovac, molim odobrite molbu', 'default.png', '092-355-2323', '2019-06-03', '2019-06-03', 1, 49, 44, 41),
(55, 'molim odobrite prijavu', 'default.png', '095-444-4444', '2019-06-03', '2019-06-03', 1, 30, 46, 11),
(56, 'molim odobrite prijavu', 'default.png', '092-355-2323', '2019-06-03', '2019-06-03', 1, 48, 46, 41),
(57, 'molim vas mogu li se prijaviti na natjecanje', 'default.png', '092-444-1231', '2019-06-03', '2019-06-03', 1, 36, 46, 27),
(58, 'zelim se prijaviti na natjecanje', 'default.png', '099-333-9999', '2019-06-03', '2019-06-03', 1, 36, 47, 27),
(59, 'super sam lovac, molim odobrite prijavu', 'default.png', '385928984232', '2019-06-03', '2019-06-03', 2, 35, 47, 27),
(60, 'lovim ribe cijeli zivot, molim odobrite mi prijavu', 'default.png', '092-355-2323', '2019-06-03', '2019-06-03', 1, 36, 48, 27),
(61, 'Molim prijavu odobrite', 'default.png', '091-222-3222', '2019-06-03', '2019-06-03', 1, 51, 48, 41),
(62, 'molim vas odobrite ovu prijavu, jako dobar sam lovac na ribe', 'potter.jpg', '092-355-2323', '2019-06-03', '2019-06-03', 1, 36, 49, 27),
(63, 'prijava', 'default.png', '091-222-3222', '2019-06-03', '2019-06-03', 1, 42, 2, 40),
(64, 'moja prijava', 'default.png', '091-222-3222', '2019-06-03', '2019-06-03', 1, 47, 2, 11),
(65, 'prijava', 'default.png', '092-355-2323', '2019-06-03', '2019-06-03', 1, 33, 2, 11),
(66, 'prijavica na natjecanje', 'default.png', '098-232-2111', '2019-06-03', NULL, 3, 30, 2, NULL),
(67, 'molim prijava', 'default.png', '096-1221-111', '2019-06-03', '2019-06-03', 1, 35, 2, 11),
(68, 'prijava na natjecanje', 'default.png', '095-444-4111', '2019-06-03', NULL, 3, 31, 2, NULL),
(69, 'molim prijavila bih se na natjecanje', 'default.png', '092-444-1231', '2019-06-03', '2019-06-03', 1, 40, 8, 40),
(70, 'super sam cura, volim ribolovna natjecanja molim odobrite prijavu', 'default.png', '091-411-1211', '2019-06-03', '2019-06-03', 1, 48, 8, 41),
(71, 'prijava', 'default.png', '092-355-2323', '2019-06-03', '2019-06-03', 1, 55, 8, 41),
(72, 'molim prijava', 'default.png', '091-222-3222', '2019-06-03', '2019-06-03', 1, 44, 8, 40),
(73, 'organizator sam drugih natjecanja pa bih se htio prijaviti na ovo malo da vidim kako je to', 'default.png', '092-444-1298', '2019-06-03', '2019-06-03', 1, 44, 27, 40),
(74, 'zelim vidjeti kako izgleda vase natjecanje', 'shrek.jpg', '092-441-1233', '2019-06-03', '2019-06-03', 1, 53, 27, 41);

-- --------------------------------------------------------

--
-- Table structure for table `zahtjev_za_proglasenje_pobjednika`
--

CREATE TABLE `zahtjev_za_proglasenje_pobjednika` (
  `id_zahtjeva` int(11) NOT NULL,
  `opis` varchar(300) DEFAULT NULL,
  `datum_zahtjeva` date DEFAULT NULL,
  `moderator` int(11) DEFAULT NULL,
  `administrator` int(11) DEFAULT NULL,
  `natjecanje` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zahtjev_za_proglasenje_pobjednika`
--

INSERT INTO `zahtjev_za_proglasenje_pobjednika` (`id_zahtjeva`, `opis`, `datum_zahtjeva`, `moderator`, `administrator`, `natjecanje`) VALUES
(4, NULL, '2019-06-03', 41, 11, 49),
(5, 'odabran je zbog fair playa', '2019-06-03', 27, 11, 30),
(6, NULL, '2019-06-03', 27, 11, 36),
(7, NULL, '2019-06-03', 27, 11, 34),
(8, NULL, '2019-06-03', 27, NULL, 45),
(9, NULL, '2019-06-03', 27, 11, 32),
(10, NULL, '2019-06-03', 41, NULL, 57),
(11, NULL, '2019-06-03', 41, NULL, 48);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grad`
--
ALTER TABLE `grad`
  ADD PRIMARY KEY (`id_grad`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnika`),
  ADD KEY `fk_korisnik_uloga_idx` (`uloga_id_uloga`),
  ADD KEY `fk_korisnik_status1_idx` (`status`);

--
-- Indexes for table `lokacija`
--
ALTER TABLE `lokacija`
  ADD PRIMARY KEY (`id_lokacija`),
  ADD KEY `fk_Lokacija_korisnik1_idx` (`administrator`),
  ADD KEY `fk_lokacija_grad1_idx` (`grad`);

--
-- Indexes for table `natjecanje`
--
ALTER TABLE `natjecanje`
  ADD PRIMARY KEY (`id_natjecanje`),
  ADD KEY `fk_Natjecanje_Lokacija1_idx` (`lokacija`),
  ADD KEY `fk_natjecanje_korisnik1_idx` (`moderator`),
  ADD KEY `fk_natjecanje_korisnik2_idx` (`pobjednik`),
  ADD KEY `ribicki_klub` (`ribicki_klub`);

--
-- Indexes for table `odobreno_odbijeno`
--
ALTER TABLE `odobreno_odbijeno`
  ADD PRIMARY KEY (`id_odobreno_odbijeno`);

--
-- Indexes for table `ribicki_klub`
--
ALTER TABLE `ribicki_klub`
  ADD PRIMARY KEY (`id_ribicki_klub`),
  ADD KEY `fk_Ribicki_klub_korisnik1_idx` (`moderator`),
  ADD KEY `fk_Ribicki_klub_korisnik2_idx` (`administrator`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_statusa`);

--
-- Indexes for table `sudionici_natjecanja`
--
ALTER TABLE `sudionici_natjecanja`
  ADD PRIMARY KEY (`natjecanje_id`,`korisnik_id`),
  ADD KEY `fk_korisnik_has_natjecanje_natjecanje1_idx` (`natjecanje_id`),
  ADD KEY `fk_korisnik_has_natjecanje_korisnik1_idx` (`korisnik_id`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id_uloga`);

--
-- Indexes for table `zahtjev_za_prijavu_na_natjecanje`
--
ALTER TABLE `zahtjev_za_prijavu_na_natjecanje`
  ADD PRIMARY KEY (`id_zahtjev_za_prijavu_na_natjecanje`),
  ADD KEY `fk_zahtjev_za_prijavu_na_natjecanje_natjecanje1_idx` (`natjecanje`),
  ADD KEY `fk_zahtjev_za_prijavu_na_natjecanje_korisnik1_idx` (`korisnik`),
  ADD KEY `fk_zahtjev_za_prijavu_na_natjecanje_korisnik2_idx` (`moderator`),
  ADD KEY `fk_zahtjev_za_prijavu_na_natjecanje_odobreno_odbijeno1_idx` (`odobreno`);

--
-- Indexes for table `zahtjev_za_proglasenje_pobjednika`
--
ALTER TABLE `zahtjev_za_proglasenje_pobjednika`
  ADD PRIMARY KEY (`id_zahtjeva`),
  ADD KEY `fk_zahtjev_za_proglasenje_pobjednika_korisnik1_idx` (`moderator`),
  ADD KEY `fk_zahtjev_za_proglasenje_pobjednika_korisnik2_idx` (`administrator`),
  ADD KEY `natjecanje` (`natjecanje`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `lokacija`
--
ALTER TABLE `lokacija`
  MODIFY `id_lokacija` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `natjecanje`
--
ALTER TABLE `natjecanje`
  MODIFY `id_natjecanje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `odobreno_odbijeno`
--
ALTER TABLE `odobreno_odbijeno`
  MODIFY `id_odobreno_odbijeno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ribicki_klub`
--
ALTER TABLE `ribicki_klub`
  MODIFY `id_ribicki_klub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_statusa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id_uloga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `zahtjev_za_prijavu_na_natjecanje`
--
ALTER TABLE `zahtjev_za_prijavu_na_natjecanje`
  MODIFY `id_zahtjev_za_prijavu_na_natjecanje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `zahtjev_za_proglasenje_pobjednika`
--
ALTER TABLE `zahtjev_za_proglasenje_pobjednika`
  MODIFY `id_zahtjeva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `fk_korisnik_status1` FOREIGN KEY (`status`) REFERENCES `status` (`id_statusa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnik_uloga` FOREIGN KEY (`uloga_id_uloga`) REFERENCES `uloga` (`id_uloga`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lokacija`
--
ALTER TABLE `lokacija`
  ADD CONSTRAINT `fk_Lokacija_korisnik1` FOREIGN KEY (`administrator`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lokacija_grad1` FOREIGN KEY (`grad`) REFERENCES `grad` (`id_grad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `natjecanje`
--
ALTER TABLE `natjecanje`
  ADD CONSTRAINT `fk_natjecanje_korisnik1` FOREIGN KEY (`moderator`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_natjecanje_korisnik2` FOREIGN KEY (`pobjednik`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Natjecanje_Lokacija1` FOREIGN KEY (`lokacija`) REFERENCES `lokacija` (`id_lokacija`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Natjecanje_ribicki_klub` FOREIGN KEY (`ribicki_klub`) REFERENCES `ribicki_klub` (`id_ribicki_klub`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ribicki_klub`
--
ALTER TABLE `ribicki_klub`
  ADD CONSTRAINT `fk_Ribicki_klub_korisnik1` FOREIGN KEY (`moderator`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Ribicki_klub_korisnik2` FOREIGN KEY (`administrator`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sudionici_natjecanja`
--
ALTER TABLE `sudionici_natjecanja`
  ADD CONSTRAINT `fk_korisnik_has_natjecanje_korisnik1` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_korisnik_has_natjecanje_natjecanje1` FOREIGN KEY (`natjecanje_id`) REFERENCES `natjecanje` (`id_natjecanje`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zahtjev_za_prijavu_na_natjecanje`
--
ALTER TABLE `zahtjev_za_prijavu_na_natjecanje`
  ADD CONSTRAINT `fk_zahtjev_za_prijavu_na_natjecanje_korisnik1` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zahtjev_za_prijavu_na_natjecanje_korisnik2` FOREIGN KEY (`moderator`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zahtjev_za_prijavu_na_natjecanje_natjecanje1` FOREIGN KEY (`natjecanje`) REFERENCES `natjecanje` (`id_natjecanje`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zahtjev_za_prijavu_na_natjecanje_odobreno_odbijeno1` FOREIGN KEY (`odobreno`) REFERENCES `odobreno_odbijeno` (`id_odobreno_odbijeno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zahtjev_za_proglasenje_pobjednika`
--
ALTER TABLE `zahtjev_za_proglasenje_pobjednika`
  ADD CONSTRAINT `fk_zahtjev_natjecanje` FOREIGN KEY (`natjecanje`) REFERENCES `natjecanje` (`id_natjecanje`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zahtjev_za_proglasenje_pobjednika_korisnik1` FOREIGN KEY (`moderator`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_zahtjev_za_proglasenje_pobjednika_korisnik2` FOREIGN KEY (`administrator`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
