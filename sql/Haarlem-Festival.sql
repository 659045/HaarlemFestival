-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 22, 2023 at 09:31 AM
-- Server version: 11.0.2-MariaDB-1:11.0.2+maria~ubu2204
-- PHP Version: 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Haarlem-Festival`
--

-- --------------------------------------------------------

--
-- Table structure for table `API_KEYS`
--

CREATE TABLE `API_KEYS` (
  `id` int(11) NOT NULL,
  `uuid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `API_KEYS`
--

INSERT INTO `API_KEYS` (`id`, `uuid`) VALUES
(1, '87c8c901-7a89-7624-4681-76e78a14ad76'),
(3, '6e6472f7-2ff9-8d24-9d0c-e3c0b89947f5'),
(4, 'd97c16a4-77ff-68eb-d193-b7a732088b0a');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `popularSongs` varchar(255) DEFAULT NULL,
  `imagePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `name`, `description`, `genre`, `popularSongs`, `imagePath`) VALUES
(1, 'Hardwell', 'temp description', 'dance and house', 'Bella Ciao:Spaceman:Apollo', '/img/Artist4.png'),
(2, 'Armin van Buuren', 'Armin Jozef Jacobus Daniël van Buuren, born 25 December 1976 is a Dutch DJ and record producer. Since 2001, he has hosted A State of Trance (ASOT), a weekly radio show, which is broadcast to nearly 40 million listeners in 84 countries on over 100 FM radio stations. According to the website DJs and Festivals, \"the radio show propelled him to stardom and helped cultivate an interest in trance music around the world\".', 'trance and techo', 'Blah Blah Blah:This Is What It Feels Like:No Fun', '/img/Artist5.png'),
(3, 'Martin Garrix', 'Martijn Gerard Garritsen, born on 14 May 1996, known professionally as Martin Garrix and also as Ytram and GRX, is a Dutch DJ and record producer who was ranked number one on DJ Mag\'s Top 100 DJs list for three consecutive years—2016, 2017, and 2018. He is best known for his singles \"Animals\", \"In the Name of Love\", and \"Scared to Be Lonely\".\r\n\r\nGarrix has performed at music festivals such as Coachella, Electric Daisy Carnival, Ultra Music Festival, Tomorrowland, and Creamfields. In 2014, he headlined the first edition of Ultra South Africa, making this his first major festival. In the same year, he became the youngest DJ to headline 2014 Ultra Music Festival at the age of 17. He was a resident DJ at Spain\'s Hï Ibiza (2017) and Ushuaïa Ibiza (2016 and 2018). He founded the label Stmpd Rcrds in 2016, months after leaving Spinnin\' Records and before signing with Sony Music. ', 'dance and electronic', 'Animals:In The Name Of Love:Scared To Be Lonely', '/img/Artist6.png'),
(4, 'Tiësto', 'Tijs Michiel Verwest, born on 17 January 1969, known professionally as Tiësto  is a Dutch DJ and music producer. He was voted \"The Greatest DJ of All Time\" by Mix magazine in a 2010/2011 poll amongst fans. In 2013, he was voted by DJ Mag readers as the \"best DJ of the last 20 years\". He is also regarded as the \"Godfather of EDM\" by many sources. ', 'trance, techno, minimal, house and electro', 'Adagio For Strings:Feel It In My Bones:Lethal Industry', '/img/Artist3.png'),
(5, 'Nicky Romero', 'Nick Rotteveel, a professional DJ from the Netherlands known as Nicky Romero came into the light thanks to his hit Toulouse in 2011. From then on he has worked with, and received support from DJs, such as Tiësto, David Guetta, Calvin Harris, Avicii and Hardwell.', 'electrohouse and progressive house', 'Toulouse:I Could Be The One:Lose My Mind', '/img/Artist1.png'),
(6, 'Afrojack', 'Nick Leonardus van de Wall, born on 9 September 1987, better known as Afrojack, is a Dutch DJ, music producer and remixer. In 2007, he founded the record label Wall Recordings; his debut album Forget the World was released in 2014. Afrojack regularly features as one of the ten best artists in the Top 100 DJs published by DJ Mag. He is also the CEO of LDH Europe.', 'house', 'Hey Mama:Alone Again:Anywhere With You', '/img/Artist2.png');

-- --------------------------------------------------------

--
-- Table structure for table `artist_event_edm`
--

CREATE TABLE `artist_event_edm` (
  `artist_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dance_location`
--

CREATE TABLE `dance_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `imagePath` varchar(1000) DEFAULT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance_location`
--

INSERT INTO `dance_location` (`id`, `name`, `address`, `imagePath`, `capacity`) VALUES
(1, 'Lichtfabriek', 'Minckelersweg 2', '/img/danceLocation1.png', 1500),
(2, 'Caprera Openluchttheater', 'Hoge Duin en Daalseweg 2', '/img/danceLocation2.png', 2000),
(3, 'Club Stalker', 'Kromme Elleboogsteeg 2', '/img/danceLocation3.png', 200),
(4, 'Jopenkerk', 'Gedemte Voldergracht 2', '/img/danceLocation4.png', 300),
(5, 'XO the club', 'Grote Markt 8', '/img/danceLocation5.png', 200),
(6, 'Club Ruis', 'Smedestraat 32', '/img/danceLocation6.png', 200);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `ticketsAmount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `ticketsAmount`) VALUES
(1, 52),
(2, 52),
(3, 52),
(4, 40),
(5, 40),
(6, 40),
(7, 36),
(8, 36),
(9, 36),
(10, 48),
(11, 48),
(12, 48),
(13, 59),
(14, 60),
(15, 100),
(16, 100),
(17, 100),
(18, 45),
(19, 45),
(20, 45),
(21, 200),
(22, 1500),
(23, 1500),
(24, 200),
(25, 300),
(26, 200),
(27, 200),
(28, 2000),
(29, 300),
(30, 1500),
(31, 200),
(32, 2000),
(33, 2000),
(34, 1997),
(35, 2000),
(36, 2000),
(37, 300),
(38, 1500),
(39, 19),
(40, 19),
(41, 20),
(42, 20),
(43, 20),
(44, 20),
(45, 20),
(46, 20),
(47, 20),
(48, 20),
(49, 20),
(50, 20),
(51, 20),
(52, 20),
(53, 20),
(54, 20),
(55, 20),
(56, 20),
(57, 20),
(58, 20),
(59, 20),
(60, 20),
(61, 20),
(62, 20),
(63, 20),
(64, 20),
(65, 20),
(66, 20),
(67, 20),
(68, 20),
(69, 20),
(70, 20),
(71, 20),
(72, 20),
(73, 20),
(74, 20),
(75, 50),
(76, 52),
(77, 52),
(78, 52),
(79, 52),
(80, 52),
(81, 52),
(82, 52),
(83, 52),
(84, 52),
(85, 52),
(86, 52),
(87, 40),
(88, 40),
(89, 40),
(90, 40),
(91, 40),
(92, 40),
(93, 40),
(94, 40),
(95, 40),
(96, 40),
(97, 40),
(98, 40),
(99, 36),
(100, 36),
(101, 36),
(102, 36),
(103, 36),
(104, 36),
(105, 36),
(106, 36),
(107, 36),
(108, 36),
(109, 36),
(110, 36),
(111, 48),
(112, 48),
(113, 48),
(114, 48),
(115, 48),
(116, 48),
(117, 48),
(118, 48),
(119, 48),
(120, 48),
(121, 48),
(122, 48),
(123, 60),
(124, 60),
(125, 60),
(126, 60),
(127, 60),
(128, 60),
(129, 60),
(130, 60),
(131, 100),
(132, 100),
(133, 100),
(134, 100),
(135, 100),
(136, 100),
(137, 100),
(138, 100),
(139, 100),
(140, 100),
(141, 100),
(142, 100),
(143, 45),
(144, 45),
(145, 45),
(146, 45),
(147, 45),
(148, 45),
(149, 45),
(150, 45),
(151, 45),
(152, 45),
(153, 45),
(154, 45),
(155, 52);

-- --------------------------------------------------------

--
-- Table structure for table `event_edm`
--

CREATE TABLE `event_edm` (
  `id` int(11) NOT NULL,
  `venue` int(11) NOT NULL,
  `artist_id` int(11) NOT NULL,
  `date` datetime(1) NOT NULL,
  `session` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `ticketsAmount` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_edm`
--

INSERT INTO `event_edm` (`id`, `venue`, `artist_id`, `date`, `session`, `duration`, `ticketsAmount`, `price`) VALUES
(21, 3, 3, '2023-07-29 16:00:00.0', 'Club', 90, 200, 60),
(22, 1, 6, '2023-07-27 20:00:00.0', 'Back2Back', 360, 1500, 75),
(23, 1, 1, '2023-07-27 10:00:00.0', 'Back2Back', 360, 1500, 75),
(24, 3, 4, '2023-07-27 22:00:00.0', 'Club', 90, 200, 60),
(25, 4, 1, '2023-07-27 23:00:00.0', 'Club', 90, 300, 60),
(26, 5, 2, '2023-07-27 22:00:00.0', 'Club', 90, 200, 60),
(27, 6, 3, '2023-07-27 22:00:00.0', 'Club', 90, 200, 60),
(28, 2, 1, '2023-07-28 14:00:00.0', 'Back2Back', 540, 2000, 110),
(29, 4, 6, '2023-07-28 22:00:00.0', 'Club', 90, 300, 60),
(30, 1, 4, '2023-07-28 21:00:00.0', 'TiëstoWorld', 240, 1500, 75),
(31, 3, 5, '2023-07-28 23:00:00.0', 'Club', 90, 200, 60),
(32, 2, 6, '2023-07-29 14:00:00.0', 'Back2Back', 540, 2000, 110),
(33, 2, 3, '2023-07-28 14:00:00.0', 'Back2Back', 540, 2000, 110),
(34, 2, 2, '2023-07-28 14:00:00.0', 'Back2Back', 540, 2000, 110),
(35, 2, 4, '2023-07-29 14:00:00.0', 'Back2Back', 540, 2000, 110),
(36, 2, 5, '2023-07-29 14:00:00.0', 'Back2Back', 540, 2000, 110),
(37, 4, 2, '2023-07-29 19:00:00.0', 'Club', 90, 300, 60),
(38, 5, 1, '2023-07-29 21:00:00.0', 'Club', 90, 1500, 90);

-- --------------------------------------------------------

--
-- Table structure for table `event_stroll`
--

CREATE TABLE `event_stroll` (
  `id` int(11) NOT NULL,
  `price` double NOT NULL,
  `date` datetime NOT NULL,
  `language` varchar(255) NOT NULL,
  `family_Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_stroll`
--

INSERT INTO `event_stroll` (`id`, `price`, `date`, `language`, `family_Price`) VALUES
(39, 17.5, '2023-07-26 10:00:00', 'english', 60),
(40, 17.5, '2023-07-26 10:00:00', 'dutch', 60),
(41, 17.5, '2023-07-26 10:00:00', 'chinese', 60),
(42, 17.5, '2023-07-26 13:00:00', 'english', 60),
(43, 17.5, '2023-07-26 13:00:00', 'dutch', 60),
(44, 17.5, '2023-07-26 13:00:00', 'chinese', 60),
(45, 17.5, '2023-07-26 16:00:00', 'english', 60),
(46, 17.5, '2023-07-26 16:00:00', 'dutch', 60),
(47, 17.5, '2023-07-26 16:00:00', 'chinese', 60),
(48, 17.5, '2023-07-27 10:00:00', 'english', 60),
(49, 17.5, '2023-07-27 10:00:00', 'dutch', 60),
(50, 17.5, '2023-07-27 10:00:00', 'chinese', 60),
(51, 17.5, '2023-07-27 13:00:00', 'english', 60),
(52, 17.5, '2023-07-27 13:00:00', 'dutch', 60),
(53, 17.5, '2023-07-27 13:00:00', 'chinese', 60),
(54, 17.5, '2023-07-27 16:00:00', 'english', 60),
(55, 17.5, '2023-07-27 16:00:00', 'dutch', 60),
(56, 17.5, '2023-07-27 16:00:00', 'chinese', 60),
(57, 17.5, '2023-07-28 10:00:00', 'english', 60),
(58, 17.5, '2023-07-28 10:00:00', 'dutch', 60),
(59, 17.5, '2023-07-28 10:00:00', 'chinese', 60),
(60, 17.5, '2023-07-28 13:00:00', 'english', 60),
(61, 17.5, '2023-07-28 13:00:00', 'dutch', 60),
(62, 17.5, '2023-07-28 13:00:00', 'chinese', 60),
(63, 17.5, '2023-07-28 16:00:00', 'english', 60),
(64, 17.5, '2023-07-28 16:00:00', 'dutch', 60),
(65, 17.5, '2023-07-28 16:00:00', 'chinese', 60),
(66, 17.5, '2023-07-29 10:00:00', 'english', 60),
(67, 17.5, '2023-07-29 10:00:00', 'dutch', 60),
(68, 17.5, '2023-07-29 10:00:00', 'chinese', 60),
(69, 17.5, '2023-07-29 13:00:00', 'english', 60),
(70, 17.5, '2023-07-29 13:00:00', 'dutch', 60),
(71, 17.5, '2023-07-29 13:00:00', 'chinese', 60),
(72, 17.5, '2023-07-29 16:00:00', 'english', 60),
(73, 17.5, '2023-07-29 16:00:00', 'dutch', 60),
(74, 17.5, '2023-07-29 16:00:00', 'chinese', 60);

-- --------------------------------------------------------

--
-- Table structure for table `event_yummie`
--

CREATE TABLE `event_yummie` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `adult_Price` double NOT NULL,
  `kids_Price` double NOT NULL,
  `session_startTime` time(1) NOT NULL,
  `session_endTime` time(1) NOT NULL,
  `session_date` date DEFAULT NULL,
  `seatings` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_yummie`
--

INSERT INTO `event_yummie` (`id`, `restaurant_id`, `adult_Price`, `kids_Price`, `session_startTime`, `session_endTime`, `session_date`, `seatings`) VALUES
(1, 1, 45, 22.5, '17:00:00.0', '19:00:00.0', '2023-07-27', 52),
(2, 1, 45, 22.5, '19:30:00.0', '21:30:00.0', '2023-07-27', 52),
(3, 1, 45, 22.5, '22:00:00.0', '00:00:00.0', '2023-07-27', 52),
(4, 2, 45, 22.5, '18:00:00.0', '19:30:00.0', '2023-07-27', 40),
(5, 2, 45, 22.5, '20:00:00.0', '21:30:00.0', '2023-07-27', 40),
(6, 2, 45, 22.5, '22:00:00.0', '23:30:00.0', '2023-07-27', 40),
(7, 3, 35, 17.5, '17:00:00.0', '18:30:00.0', '2023-07-27', 36),
(8, 3, 35, 17.5, '19:00:00.0', '20:30:00.0', '2023-07-27', 36),
(9, 3, 35, 17.5, '21:00:00.0', '22:30:00.0', '2023-07-27', 36),
(10, 4, 35, 17.5, '17:30:00.0', '19:00:00.0', '2023-07-27', 48),
(11, 4, 35, 17.5, '19:30:00.0', '21:00:00.0', '2023-07-27', 48),
(12, 4, 35, 17.5, '21:30:00.0', '23:00:00.0', '2023-07-27', 48),
(13, 5, 45, 22.5, '17:00:00.0', '19:00:00.0', '2023-07-27', 60),
(14, 5, 45, 22.5, '19:30:00.0', '21:30:00.0', '2023-07-27', 60),
(15, 6, 35, 17.5, '16:30:00.0', '18:00:00.0', '2023-07-27', 100),
(16, 6, 35, 17.5, '18:30:00.0', '20:00:00.0', '2023-07-27', 100),
(17, 6, 35, 17.5, '20:30:00.0', '22:00:00.0', '2023-07-27', 100),
(18, 7, 45, 22.5, '17:30:00.0', '19:00:00.0', '2023-07-27', 45),
(19, 7, 45, 22.5, '19:30:00.0', '21:00:00.0', '2023-07-27', 45),
(20, 7, 45, 22.5, '21:30:00.0', '23:00:00.0', '2023-07-27', 45),
(75, 1, 45, 22.5, '17:00:00.0', '19:00:00.0', '2023-07-28', 52),
(76, 1, 45, 22.5, '17:00:00.0', '19:00:00.0', '2023-07-29', 52),
(77, 1, 45, 22.5, '17:00:00.0', '19:00:00.0', '2023-07-30', 52),
(78, 1, 45, 22.5, '17:00:00.0', '19:00:00.0', '2023-07-31', 52),
(79, 1, 45, 22.5, '19:30:00.0', '21:30:00.0', '2023-07-28', 52),
(80, 1, 45, 22.5, '19:30:00.0', '21:30:00.0', '2023-07-29', 52),
(81, 1, 45, 22.5, '19:30:00.0', '21:30:00.0', '2023-07-30', 52),
(82, 1, 45, 22.5, '19:30:00.0', '21:30:00.0', '2023-07-31', 52),
(83, 1, 45, 22.5, '22:00:00.0', '00:00:00.0', '2023-07-28', 52),
(84, 1, 45, 22.5, '22:00:00.0', '00:00:00.0', '2023-07-29', 52),
(85, 1, 45, 22.5, '22:00:00.0', '00:00:00.0', '2023-07-30', 52),
(86, 1, 45, 22.5, '22:00:00.0', '00:00:00.0', '2023-07-31', 52),
(87, 2, 45, 22.5, '18:00:00.0', '19:30:00.0', '2023-07-28', 40),
(88, 2, 45, 22.5, '18:00:00.0', '19:30:00.0', '2023-07-29', 40),
(89, 2, 45, 22.5, '18:00:00.0', '19:30:00.0', '2023-07-30', 40),
(90, 2, 45, 22.5, '18:00:00.0', '19:30:00.0', '2023-07-31', 40),
(91, 2, 45, 22.5, '20:00:00.0', '21:30:00.0', '2023-07-28', 40),
(92, 2, 45, 22.5, '20:00:00.0', '21:30:00.0', '2023-07-29', 40),
(93, 2, 45, 22.5, '20:00:00.0', '21:30:00.0', '2023-07-30', 40),
(94, 2, 45, 22.5, '20:00:00.0', '21:30:00.0', '2023-07-31', 40),
(95, 2, 45, 22.5, '22:00:00.0', '23:30:00.0', '2023-07-28', 40),
(96, 2, 45, 22.5, '22:00:00.0', '23:30:00.0', '2023-07-29', 40),
(97, 2, 45, 22.5, '22:00:00.0', '23:30:00.0', '2023-07-30', 40),
(98, 2, 45, 22.5, '22:00:00.0', '23:30:00.0', '2023-07-31', 40),
(99, 3, 35, 17.5, '17:00:00.0', '18:30:00.0', '2023-07-28', 36),
(100, 3, 35, 17.5, '17:00:00.0', '18:30:00.0', '2023-07-29', 36),
(101, 3, 35, 17.5, '17:00:00.0', '18:30:00.0', '2023-07-30', 36),
(102, 3, 35, 17.5, '17:00:00.0', '18:30:00.0', '2023-07-31', 36),
(103, 3, 35, 17.5, '19:00:00.0', '20:30:00.0', '2023-07-28', 36),
(104, 3, 35, 17.5, '19:00:00.0', '20:30:00.0', '2023-07-29', 36),
(105, 3, 35, 17.5, '19:00:00.0', '20:30:00.0', '2023-07-30', 36),
(106, 3, 35, 17.5, '19:00:00.0', '20:30:00.0', '2023-07-31', 36),
(107, 3, 35, 17.5, '21:00:00.0', '22:30:00.0', '2023-07-28', 36),
(108, 3, 35, 17.5, '21:00:00.0', '22:30:00.0', '2023-07-29', 36),
(109, 3, 35, 17.5, '21:00:00.0', '22:30:00.0', '2023-07-30', 36),
(110, 3, 35, 17.5, '21:00:00.0', '22:30:00.0', '2023-07-31', 36),
(111, 4, 35, 17.5, '17:30:00.0', '19:00:00.0', '2023-07-28', 48),
(112, 4, 35, 17.5, '17:30:00.0', '19:00:00.0', '2023-07-29', 48),
(113, 4, 35, 17.5, '17:30:00.0', '19:00:00.0', '2023-07-30', 48),
(114, 4, 35, 17.5, '17:30:00.0', '19:00:00.0', '2023-07-31', 48),
(115, 4, 35, 17.5, '19:30:00.0', '21:00:00.0', '2023-07-28', 48),
(116, 4, 35, 17.5, '19:30:00.0', '21:00:00.0', '2023-07-29', 48),
(117, 4, 35, 17.5, '19:30:00.0', '21:00:00.0', '2023-07-30', 48),
(118, 4, 35, 17.5, '19:30:00.0', '21:00:00.0', '2023-07-31', 48),
(119, 4, 35, 17.5, '21:30:00.0', '23:00:00.0', '2023-07-28', 48),
(120, 4, 35, 17.5, '21:30:00.0', '23:00:00.0', '2023-07-29', 48),
(121, 4, 35, 17.5, '21:30:00.0', '23:00:00.0', '2023-07-30', 48),
(122, 4, 35, 17.5, '21:30:00.0', '23:00:00.0', '2023-07-31', 48),
(123, 5, 45, 22.5, '17:00:00.0', '19:00:00.0', '2023-07-28', 60),
(124, 5, 45, 22.5, '17:00:00.0', '19:00:00.0', '2023-07-29', 60),
(125, 5, 45, 22.5, '17:00:00.0', '19:00:00.0', '2023-07-30', 60),
(126, 5, 45, 22.5, '17:00:00.0', '19:00:00.0', '2023-07-31', 60),
(127, 5, 45, 22.5, '19:30:00.0', '21:30:00.0', '2023-07-28', 60),
(128, 5, 45, 22.5, '19:30:00.0', '21:30:00.0', '2023-07-29', 60),
(129, 5, 45, 22.5, '19:30:00.0', '21:30:00.0', '2023-07-30', 60),
(130, 5, 45, 22.5, '19:30:00.0', '21:30:00.0', '2023-07-31', 60),
(131, 6, 35, 17.5, '16:30:00.0', '18:00:00.0', '2023-07-28', 100),
(132, 6, 35, 17.5, '16:30:00.0', '18:00:00.0', '2023-07-29', 100),
(133, 6, 35, 17.5, '16:30:00.0', '18:00:00.0', '2023-07-30', 100),
(134, 6, 35, 17.5, '16:30:00.0', '18:00:00.0', '2023-07-31', 100),
(135, 6, 35, 17.5, '18:30:00.0', '20:00:00.0', '2023-07-28', 100),
(136, 6, 35, 17.5, '18:30:00.0', '20:00:00.0', '2023-07-29', 100),
(137, 6, 35, 17.5, '18:30:00.0', '20:00:00.0', '2023-07-30', 100),
(138, 6, 35, 17.5, '18:30:00.0', '20:00:00.0', '2023-07-31', 100),
(139, 6, 35, 17.5, '20:30:00.0', '22:00:00.0', '2023-07-28', 100),
(140, 6, 35, 17.5, '20:30:00.0', '22:00:00.0', '2023-07-29', 100),
(141, 6, 35, 17.5, '20:30:00.0', '22:00:00.0', '2023-07-30', 100),
(142, 6, 35, 17.5, '20:30:00.0', '22:00:00.0', '2023-07-31', 100),
(143, 7, 45, 22.5, '17:30:00.0', '19:00:00.0', '2023-07-28', 45),
(144, 7, 45, 22.5, '17:30:00.0', '19:00:00.0', '2023-07-29', 45),
(145, 7, 45, 22.5, '17:30:00.0', '19:00:00.0', '2023-07-30', 45),
(146, 7, 45, 22.5, '17:30:00.0', '19:00:00.0', '2023-07-31', 45),
(147, 7, 45, 22.5, '19:30:00.0', '21:00:00.0', '2023-07-28', 45),
(148, 7, 45, 22.5, '19:30:00.0', '21:00:00.0', '2023-07-29', 45),
(149, 7, 45, 22.5, '19:30:00.0', '21:00:00.0', '2023-07-30', 45),
(150, 7, 45, 22.5, '19:30:00.0', '21:00:00.0', '2023-07-31', 45),
(151, 7, 45, 22.5, '21:30:00.0', '23:00:00.0', '2023-07-28', 45),
(152, 7, 45, 22.5, '21:30:00.0', '23:00:00.0', '2023-07-29', 45),
(153, 7, 45, 22.5, '21:30:00.0', '23:00:00.0', '2023-07-30', 45),
(154, 7, 45, 22.5, '21:30:00.0', '23:00:00.0', '2023-07-31', 45);

-- --------------------------------------------------------

--
-- Table structure for table `homepage_events`
--

CREATE TABLE `homepage_events` (
  `id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `small_title` varchar(255) DEFAULT NULL,
  `imagePath` varchar(255) DEFAULT NULL,
  `pageLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homepage_events`
--

INSERT INTO `homepage_events` (`id`, `title`, `description`, `small_title`, `imagePath`, `pageLink`) VALUES
(1, 'A stroll through Haarlem', 'The city of Haarlem is holding a tour to showcase fun and important historical sites. Join us on this tour between the dates of 26-29 of July this year. If you are interested in Haarlem\'s history this tour is for you!', 'Explore the city', '/img/festival-stroll-haarlem.png', '/tour'),
(2, 'Food event', 'Enjoy the wide variety of culinary delights that the city of Haarlem has to offer. Join us as we explore the city one bite at a time.', 'Food', '/img/festival-yummie-event.png', '/food'),
(3, 'Let\'s dance', 'The city of Haarlem welcomes you to a dance party! from popular DJs to up and coming artists, we have it all at Haarlem Dance event. Welcome to the party everyone!', 'Life of the party', '/img/festival-dance-event.png', '/dance');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `html` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `title`, `html`) VALUES
(5, 'dance', 'Dance Event', '<div class=\"pb-[2.5rem] mt-[100px] mb-[150px] lg:w-[1280px] md:w-[100vw] sm:w-[100vw]\" id=\"content-container\">\n    <div class=\"grid grid-cols-2 grid-rows-1 h-[600px]\">\n      <div class=\"flex flex-col justify-center text-[#F7F7FB] font-[\'Lato\']\">\n        <h1 id=\"HeroHeader\" class=\"text-[64px]\">Let\'s Dance</h1>\n        <p class=\"w-[80%] text-[20px]\">\n          Dance for us is not just an activity, it’s a way of life.\n          Come dance the best Dutch produced music out there right here, right now!\n        </p>\n        <a href=\"/danceTicket\"><button\n          class=\'w-max h-[40px] mt-[15px] text-[#F7F7FB] flex items-center gap-[10px] border-2 border-[#F7F7FB] px-4 py-5 transition ease-in-out cursor-pointer\'>Buy\n          Tickets</button>\n      </div>\n      <div class=\"flex items-center justify-center\">\n        <image src=\"/img/danceImg1.png\" class=\"w-[500px]\">\n      </div>\n    </div>\n\n    <div id=\"content-wrapper\">\n    \n    </div>\n\n  </div>\n\n  <script src=\"/js/dance/index.js\"></script>\n'),
(6, 'home', 'HomePage', '<div class=\"lg:w-[1280px] md:w-[100vw] sm:w-[100vw] pb-[2.5rem]\" id=\"content-container\"><!-- Festival main screeen, background image -->\r\n<div class=\"w-screen h-[100vh] h-14\"><img alt=\"Image description\" class=\"absolute w-full h-full object-cover z-0\" src=\"/img/festival-homepage.png\" />\r\n<div class=\"absolute top-0 left-0 w-full h-full flex items-center justify-center z-10\">\r\n<p class=\"absolute left-40 pl-20 pb-30 font-extrabold tracking-wide text-violet-700 text-6xl text-center opacity-50 \">T H E F E S T I V A L</p>\r\n\r\n<div class=\"absolute left-20 pl-20 mt-20 text-center text-white\">\r\n<p class=\"font-extrabold tracking-wide text-3xl mt-10 pl-10\">T H E F E S T I V A L</p>\r\n\r\n<p class=\"text-xl pt-5  tracking-wide\">Enjoy the cultural and historical parts of Haarlem with this festival!</p>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- Festival events -->\r\n\r\n<div class=\"flex justify-center w-[100%] flex-col items-center ml-[150px] bg-white z-0\" id=\"events\">&nbsp;</div>\r\n<!-- Festival locations-->\r\n\r\n<div class=\"flex items-center mt-[100px] ml-[200px]\">\r\n<div class=\"flex-none \"><img class=\"absolutew-[100px] h-[100px] mt-[50px] ml-[200px] \" src=\"/img/Vector5.png\" /> <img class=\"absolute w-[100px] h-[100px] mt-[150px] ml-[70px]\" src=\"/img/Vector1.png\" /> <img class=\"absolute w-[100px] h-[100px] mt-[200px] ml-[100px] \" src=\"/img/Vector2.png\" /></div>\r\n\r\n<div class=\"flex-initial ml-[120px] \">\r\n<p class=\"font-extrabold tracking-wide text-3xl \">Locations</p>\r\n<img class=\"w-[700px] h-[500px] mt-10\" src=\"/img/festival-map-locations.png\" /></div>\r\n\r\n<div class=\"flex-none\"><img class=\"absolute w-[100px] h-[100px] mt-[100px] ml-[100px] \" src=\"/img/Vector2.png\" /> <img class=\"absolute w-[100px] h-[100px] mt-[180px] ml-[120px]\" src=\"/img/Vector1.png\" /></div>\r\n</div>\r\n<!-- Festival schedule -->\r\n\r\n<div class=\"flex justify-center mt-[100px] mb-[100px] ml-[600px]\">\r\n<div>\r\n<h1 class=\"absolute font-extrabold text-3xl \">Schedule</h1>\r\n</div>\r\n\r\n<div class=\"w-maxcontent h-[175px] bg-blue-100 drop-shadow-lg flex justify-center rounded-[15px] flex-row gap-16 mt-20 leading-5 p-6 lg:pl-[75px] lg:pr-[75px] md:pl-[20px] sm:flex-row\">\r\n<h2 class=\"font-extrabold mb-2\">Events</h2>\r\n\r\n<ul class=\"list-none flex flex-col\">\r\n	<li class=\"text-sm w-20 pt-6\">Dance!</li>\r\n	<li class=\"text-sm w-20 pt-2\">Yummie!</li>\r\n	<li class=\"text-sm w-40 pt-2\">Stroll through Haarlem</li>\r\n</ul>\r\n\r\n<h2 class=\"font-extrabold mb-2\">Thursday 26 Jul</h2>\r\n\r\n<ul class=\"list-none flex flex-col w-20\">\r\n	<li class=\"text-sm w-20 pt-2\">10:00-16:00</li>\r\n	<li class=\"text-sm w-20 pt-2\">16:30-23:30</li>\r\n	<li class=\"text-sm w-20 pt-2\">n/a</li>\r\n</ul>\r\n\r\n<h2 class=\"font-extrabold mb-2\">Friday 27 Jul</h2>\r\n\r\n<ul class=\"list-none flex flex-col w-20\">\r\n	<li class=\"text-sm w-20 pt-2\">10:00-16:00</li>\r\n	<li class=\"text-sm w-20 pt-2\">16:30-23:30</li>\r\n	<li class=\"text-sm w-20 pt-2\">n/a</li>\r\n</ul>\r\n\r\n<h2 class=\"font-extrabold mb-2\">Saturday 28 Jul</h2>\r\n\r\n<ul class=\"list-none flex flex-col w-20\">\r\n	<li class=\"text-sm w-20 pt-2\">10:00-16:00</li>\r\n	<li class=\"text-sm w-20 pt-2\">16:30-23:30</li>\r\n	<li class=\"text-sm w-20 pt-2\">14:00-00:30</li>\r\n</ul>\r\n\r\n<h2 class=\"font-extrabold mb-2\">Sunday 29 Jul</h2>\r\n\r\n<ul class=\"list-none flex flex-col w-20\">\r\n	<li class=\"text-sm w-20 pt-2\">10:00-16:00</li>\r\n	<li class=\"text-sm w-20 pt-2\">16:30-23:30</li>\r\n	<li class=\"text-sm w-20 pt-2\">14:00-23:00</li>\r\n</ul>\r\n\r\n<h2 class=\"font-extrabold mb-2\">Monday 30 Jul</h2>\r\n\r\n<ul class=\"list-none flex flex-col w-20\">\r\n	<li class=\"text-sm w-20 pt-2\">n/a</li>\r\n	<li class=\"text-sm w-20 pt-2\">16:30-23:30</li>\r\n	<li class=\"text-sm w-20 pt-2\">n/a</li>\r\n</ul>\r\n\r\n<h2 class=\"font-extrabold mb-2\">Tuesday 31 Jul</h2>\r\n\r\n<ul class=\"list-none flex flex-col w-20\">\r\n	<li class=\"text-sm w-20 pt-2\">n/a</li>\r\n	<li class=\"text-sm w-20 pt-2\">16:30-23:30</li>\r\n	<li class=\"text-sm w-20 pt-2\">n/a</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n<script src=\"/js/homepage/index.js\"></script>'),
(7, 'food', 'Yummie! Event', '<div class=\"grid justify-items-center\" id=\"content-container\">\r\n<div class=\"pt-[150px] pb-[50px] grid grid-cols-2 ml-[150px]\" id=\"introSection\">\r\n<div id=\"introduction\">\r\n<h1 class=\"text-[42px] font-bold\"><span class=\"text-[#42BFDD]\">Yummie!</span> Food Event</h1>\r\n\r\n<p class=\"text-2xl\">27 July - 31 July</p>\r\n\r\n<p class=\"text-base w-[700px] pt-[25px]\">Welcome to the Haarlem Food Festival! Come and join us for an amazing culinary experience. This event is a celebration of the culinary delights that the Netherlands has to offer, showcasing different cuisines and the talented chefs who prepare it.<br />\r\n<br />\r\nWe look forward to seeing you there!</p>\r\n\r\n<p class=\"text-sm text-[#656262] w-[300px] pt-[5px]\">** &euro;10,- deposit pp. and mandatory reservation. Deposit will be deducted upon payment.**</p>\r\n</div>\r\n<img alt=\"circleFoodImage\" class=\"w-[400px] h-[400px] ml-[180px]\" src=\"/img/circleFoodImage.png\" /></div>\r\n\r\n<div class=\"grid justify-center w-[100%] flex-col ml-[500px]\" id=\"restaurants\">&nbsp;</div>\r\n</div>\r\n<script src=\"/js/food/index.js\"></script>'),
(8, 'tour', 'Haarlem Tour', ' <div class=\"lg:w-[1280px] md:w-[100vw] sm:w-[100vw] mt-[100px]\" id=\"content-container\">\n        <div class=\"mt-[100px]\" id=\"introSection\">\n            <h1 class=\"text-[36px] font-bold w-[600px]\">Come join us on a stroll through <span class=\"text-[#42BFDD]\">Haarlem’s</span> historic city centre</h1>\n            <p class=\"text-xl w-[600px] mt-[20px]\">Take the tour through Haarlem with one of our expert guides, and discover the city’s historic sites.</p>\n        </div>\n        <div class=\"grid grid-cols-3 mt-[100px] \">\n            <img class=\"w-[900px] h-[300px] col-span-2\" src=\"/img/tourImg1.png\">\n            <div class=\"col-span-1 ml-[80px]\" id=\"buyTicketsSection1\">\n                <h1 class=\"text-[36px] mb-[10px] mt-[20px]\">Buy Tickets</h1>\n                <p class=\"mb-[10px]\">Personal tickets €17,50. <br> Family ticket(max 4 participants) €60,00. <br> Date: 26-29 July.</p>\n                <a href=\"/tourTicket\"><button class=\"bg-[#42BFDD] text-white text-[24px] font-bold py-[10px] px-[20px] mt-[20px] rounded-[10px]\">Buy Tickets</button>\n            </div>\n        </div>\n        <div class=\"grid grid-cols-5 mt-[100px] gap-[50px]\" id=\"mapSection\">\n            <div class=\"col-span-3\">\n                <h1 class=\"text-[36px] font-bold\">Have a look at the route we will be following</h1>\n                <img class=\"w-[600px] h-[400px] mt-[40px] ml-[60px]\" src=\"/img/tourRoute.png\">\n                <a href=\"/tour/tourOverview\"><button class=\"bg-[#42BFDD] text-white text-[24px] font-bold py-[10px] px-[20px] mt-[20px] rounded-[10px] mt-[40px] ml-[110px]\">View more info on the route and location</button></a>\n            </div>\n            <img class=\"w-[500px] h-[600px] col-span-2\" src=\"/img/tourImg2.png\">\n        </div>\n        <div class=\"grid grid-cols-5 mt-[100px]\" id=\"dateSection\">\n            <div class=\"col-span-3\" id=\"date\">\n                <h1 class=\"text-[36px] font-bold\">Dates</h1>\n                <p class=\"text-xl mt-[20px] w-[700px]\">There are multiple tours taking place from 26-29 July. Tours are given in English, Dutch, and French at a frequency of three timeslots per day these timeslots are: 10:00, 13:00, and 16:00. We expect the tour to take around 120 to 150 minutes.</p>\n                <div class=\"bg-[#42BFDD] rounded-[10px] w-[700px] h-[200px] mt-[50px]\" id=\"schedule\">\n                    <h2 class=\"ml-[20px] pt-[20px] text-[24px] text-white\">Schedule</h2>              \n                    <div class=\"grid grid-cols-3 mt-[20px]  bg-[#FFFFFF] pl-[100px]\">\n                        <div class=\"col-span-1\">\n                            <p>26th July - 29th July 2023</p>\n                        </div>\n                        <div class=\"col-span-1\">\n                            <p class=\"ml-[20px]\">First Timeslot</p>\n                            <p class=\"ml-[20px]\">Second Timeslot</p>\n                            <p class=\"ml-[20px]\">Third Tiomeslot</p>\n                        </div>\n                        <div class=\"col-span-1\">\n                        <p class=\"ml-[20px]\">10:00</p>\n                            <p class=\"ml-[20px]\">13:00</p>\n                            <p class=\"ml-[20px]\">16:00</p>\n                        </div>\n                    </div>\n                </div>\n            </div>\n            <div class=\"col-span-2 ml-[50px]\" id=\"buyTicketsSection2\">\n                <h1 class=\"text-[36px] mb-[10px]\">Buy Tickets</h1>\n                <p class=\"mb-[10px]\">Personal tickets €17,50. <br> Family ticket(max 4 participants) €60,00. <br> Date: 26-29 July.</p>\n                <a href=\"/tourTicket\"><button class=\"bg-[#42BFDD] text-white text-[24px] font-bold py-[10px] px-[20px] mt-[20px] rounded-[10px]\">Buy Tickets</button>\n            </div>\n        </div>\n        <div class=\"mt-[100px]\" id=\"kidsAppSection\"> \n            <h1 class=\"text-[36px] font-bold\">Open to ages 12 and up</h1>\n            <p class=\"w-[700px] mt-[20px]\">If you are with children you can participate in Teylers museum special event. Discover professor Teylers secret using an interactive application on your mobile. <span class=\"text-[#42BFDD]\">Download the app on the app store.</span></p>\n        </div>\n        <div class=\"mt-[50px] grid grid-cols-3 mb-[100px]\">\n            <img class=\"w-[1000px] h-[700px] col-span-2\" src=\"/img/appPreview.png\">\n            <img class=\"w-[300px] h-[300px] mt-[300px] ml-[50px] col-span-1\" src=\"/img/downloadApp.png\">\n        </div>\n    </div>'),
(9, 'tourOverview', 'Tour OverView', '<div class=\"lg:w-[1280px] md:w-[100vw] sm:w-[100vw] mt-[100px] mb-[100px]\" id=\"content-container\">\r\n        <h1 class=\"text-[36px] font-bold mt-[100px]\">Haarlem Tour Route</h1>       \r\n               \r\n        <div id=content-wrapper>\r\n            \r\n        </div>\r\n    </div>\r\n\r\n    <script src=\"/js/tour/tourOverview.js\"></script>'),
(23, 'aa', 'AA', '<p>aa</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `personal_program`
--

CREATE TABLE `personal_program` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `uuid` varchar(255) NOT NULL,
  `session_id` int(6) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `adults` int(4) NOT NULL,
  `kids` int(4) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`uuid`, `session_id`, `status`, `adults`, `kids`, `comment`) VALUES
('003fb4d2-102f-4841-8d5f-6a6f75881e92', 140, 1, 1, 0, ''),
('118911aa-0ee5-11ee-947d-0242ac140004', 2, 1, 11, 11, 'Gluten Free'),
('138f2431-8ff6-413a-ad35-4dc640785282', 75, 1, 1, 0, ''),
('25214241-82fd-400a-af09-a73ef9ae7d72', 2, 1, 1, 0, ''),
('2b787bf1-2dfd-402b-9a0d-ab031afa301d', 1, 1, 1, 0, ''),
('32bb33f8-0ee5-11ee-947d-0242ac140004', 3, 1, 1, 1, 'Allergic seafood');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `star` double NOT NULL,
  `michelinStar` tinyint(1) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `address` varchar(1000) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `imagePath` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `category`, `star`, `michelinStar`, `description`, `address`, `phone_number`, `imagePath`) VALUES
(1, 'Ratatouille', 'French, Seafood, Eurpean', 4.7, 1, 'Ratatouille is one of Haarlem’s only Michelin starred restaurant. Located in the city centre, and owned by a talented chef Jozua Jaring, the restaurant specialises in creating delicious French dishes using fresh, local ingredients. The menu features a wide variety of classic and modern takes on French favourites Offering indoor and outdoor seating, Ratatouille appeals to a broad range of tastes and is sure to please a wide variety of diners.', 'Spaarne 96, 2011 CL Haarlem', '+31 23 542 7271', '/img/4.7Rating.png:/img/ratatouilleImg1.png:/img/ratatouilleImg2.png:/img/ratatouilleImg3.png:\r\n/img/detailRatatouilleImg1.png:\r\n/img/detailRatatouilleImg2.png:\r\n/img/detailRatatouilleImg3.png:\r\n/img/detailRatatouilleImg4.png:\r\n/img/detailRatatouilleImg5.png:'),
(2, 'Mr&Mrs', 'Dutch, Seafood, European', 4.7, 0, 'Mr&Mrs is nice little restaurant. Located in Haarlem, and owned by a lovely couple, the restaurant specialises in creating delicious Dutch dishes using fresh, local ingredients. The menu features a wide variety of classic and modern takes on Dutch favourites Offering indoor and outdoor seating, Mr&Mrs appeals to a broad range of tastes and is sure to please a wide variety of diners.', 'Lange Veerstraat 4, 2011 DB Haarlem', '+31 23 531 5935', '/img/4.7Rating.png:/img/mr&mrsImg1.png:/img/mr&mrsImg2.png:/img/mr&mrsImg3.png:/img/mr&mrsImg3.png:/img/mr&mrsImg2.png:/img/mr&mrsImg4.png:/img/mr&mrsImg6.png:/img/mr&mrsImg5.png'),
(3, 'Specktakel', 'European, International, Asian', 4.5, 0, 'Specktakel is a unique World Restaurant centrally located in the heart of Haarlem. With a special covered courtyard and a terrace with a view of the historic Vleeshal and the centuries-old Bavo church. In the world kitchen, true works of art are created where every sense is stimulated.\r\n\r\nSpecktakel is all about the experience, an experience that we create together, each in his or her own role. The world wines are selected with care, so that the wine is in harmony with the aromas and spices of the dish.\r\nThe colours, aromas and flavors create a wonderful interplay that can be talked about…', 'Klokhuisplein 9, 2011 HK Haarlem', '+31 023 512 3910', '/img/4.5Rating.png:/img/specktakelImg1.png:/img/specktakelImg2.png:/img/specktakelImg3.png:/img/specktakelImg3.png:/img/specktakelImg4.png:/img/specktakelImg2.png:/img/specktakelImg1.png:/img/specktakelImg5.png:'),
(4, 'Toujours', 'Dutch, Seafood, European', 4.4, 0, 'The wine is ready, the beer tap is running at full speed again and the cocktails are already being shaken. Sit comfortably on our terrace with a rug and patio heaters. And all that in combination with delicious dishes that we have on the menu. Let us spoil you with our appetizers & finger food. And if you want to go ALL OUT, then one of our signature dishes is perfect for you!', 'Oude Groenmarkt 10-12, 2011 HL Haarlem', '+31 023 532 1699', '/img/4.4Rating.png:/img/toujoursImg1.png:/img/toujoursImg2.png:/img/toujoursImg3.png:/img/toujoursImg3.png:/img/toujoursImg2.png:/img/toujoursImg1.png:/img/toujoursImg4.png:/img/toujoursImg5.png:'),
(5, 'ML', 'Dutch, Seafood, European', 4.1, 1, 'ML has been housing, in the beautiful, monumental building at Klokhuisplein since 2018. A place where you can eat, drink, meet and sleep.Restaurant ML is located in the courtyard of the historic printer Johan Enschedé and in the old style room of the former home of the Enschedé family. The decor is sleek and modern and includes a fine backdrop for the culinary sensations presented by chef Mark Gratama and his kitchen team. In 2021, restaurant ML is once again awarded with a Michelin star!', 'Klokhuisplein 9, 2011 HK Haarlem', '+31 023 512 3910', '/img/4.1Rating.png:/img/mlImg1.png:/img/mlImg2.png:/img/mlImg3.png:\r\n/img/mlImg4.png:/img/mlImg2.png:\r\n/img/mlImg3.png:/img/mlImg1.png:\r\n/img/mlImg5.png:'),
(6, 'Grand Cafe Brinkmann', 'Modern, Dutch, European', 4.1, 0, 'Brinkmann is a well-known grand café that has been located on the Grote Markt in Haarlem since 1881. In the thirties of the twentieth century, the business had grown into a large complex of entertainment venues. At the end of the seventies it made way for the Brinkmannpassage. Brinkmann has continued in a smaller form as a grand café. Come and have a taste of History.', 'Grote Markt 13, 2011 RC Haarlem', '+31 023 532 3111', '/img/4.4Rating.png:/img/grandcafebrinkmannImg1.png:\r\n/img/grandcafebrinkmannImg2.png:\r\n/img/grandcafebrinkmannImg3.png:\r\n/img/grandcafebrinkmannImg3.png:\r\n/img/grandcafebrinkmannImg2.png:\r\n/img/grandcafebrinkmannImg1.png:\r\n/img/grandcafebrinkmannImg4.png:\r\n/img/grandcafebrinkmannImg5.png:'),
(7, 'Fris', 'Dutch, French, European', 4.1, 1, 'Fris is One of the michelin starred restaurants and offer you class and great food. Original textures and product combinations ensure tasty flavors and a pleasant mouthfeel. And with a wines round off the story nicely. A unique experience and totally recommended.', 'Twijnderslaan 7, 2012 BG Haarlem', '+31 023 531 0717', '/img/4.1Rating.png:/img/frisImg1.png:/img/frisImg2.png:/img/frisImg3.png:\r\n/img/frisImg5.png:/img/frisImg2.png:/img/frisImg3.png:/img/frisImg1.png:/img/frisImg6.png:');

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `location_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stroll_location`
--

CREATE TABLE `stroll_location` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `imagePath` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stroll_location`
--

INSERT INTO `stroll_location` (`id`, `name`, `title`, `description`, `address`, `imagePath`) VALUES
(1, 'St. Bavo Church', 'History of the church:Importance to Haarlem.:The location and where we are on our tour.', 'The first time St. Bavo Church was mentioned was in 1245 and at that time it was considered a prominent church because of its belfry, and because Influential people like Arnoud van Sassenheim acted there as priests.\r\n\r\nA lot of the furniture dates back from before the iconoclasm of 1566 like the choir fence, choir benches, and copper lectern with pelican.:Around the church there is a big market every week this is very important to Haarlem since a lot of people from the surrounding regions come to this market to sell.:This is the starting location of our tour. On the map below you can see the exact location.', 'Grote Markt 22', '/img/stBavoChurchImg4.png:\r\n/img/stBavoChurchImg1.png:\r\n/img/stBavoChurchImg2.png:\r\n/img/stBavoChurchImg3.png:'),
(2, 'Grote Markt', 'History of the place:Importance to Haarlem.:The location.', 'The Grote Markt in Haarlem is a large square in the center of Haarlem, where a number of old and well-known buildings are located, such as the Grote or Sint-Bavokerk (more than 80 meters high) and the town hall. The Grote Markt used to be called \'t Sant. That name comes from a time when the market was still unpaved.\r\n\r\nThere is an important Haarlem symbol; Loutje, the statue of Laurens Janszoon Coster, a pioneer in the field of printing who was often seen as its inventor in the Netherlands in the past. Coster would have lived at 23 Grote Markt.:Gives this historic feel to the centre of haarlem:It is located in the centre of haarlem.\r\n\r\n\r\n', 'Grote Markt', '/img/groteMarktImg1.png:/img/groteMarktImg2.png:/img/groteMarktImg3.png:\r\n/img/groteMarktImg4.png:'),
(3, 'The Hallen', 'History of the place:Importance to Haarlem.:The location.', 'De Hallen Haarlem regularly shows solo presentations by internationally acclaimed artists who have never exhibited in the Netherlands before.\r\n\r\nThree times a year, De Hallen Haarlem organizes an exhibition cluster about current developments in the visual arts. The museum thus offers a platform for artists from the Netherlands and abroad, with an emphasis on photography and video art.:Shows historical art over the years.:In the city centre.\r\n\r\n', 'Grote Markt 16', '/img/deHallenImg1.png:/img/deHallenImg2.png:\r\n/img/deHallenImg3.png:/img/deHallenImg4.png:\r\n'),
(4, 'Proveniershof', 'History of the place:Importance to Haarlem.:The location.', 'The Proveniershof was founded in 1704 and has a rich history. In 1414, the stately Sint Michielsklooster for women was built here. In 1578, the nuns were driven out by the Protestants, at the time of the Reformation. Three years later, the monastery and the surrounding grounds were assigned to the city of Haarlem by the Prince of Orange. It served as compensation for the enormous damage the city had suffered during the Siege of Haarlem during the Eighty Years\' War.:The Proveniershof has a different appearance than the small courtyards in Haarlem. The houses of the Proveniershof were not a form of charity, but were intended for the well-to-do bourgeoisie, who bought in and could then live here at a later age. The Proveniershof is located on the busy shopping street Grote Houtstraat 144 and is freely accessible to visitors. : Located in the city centre.', 'Grote Houtsstraat 140', '/img/proverniershofImg1.png:/img/proverniershofImg2.png:/img/proverniershofImg3.png:/img/proverniershofImg4.png:'),
(5, 'Jopenkerk', 'History of the church:Importance to Haarlem.:The location.', NULL, 'Emrikweg 21', NULL),
(6, 'Waalse kerk', 'History of the church:Importance to Haarlem.:The location and where we are on our tour.', NULL, 'Begijnhof 30', NULL),
(7, 'Molen de Adriaan', 'History of the place:Importance to Haarlem.:The location and where we are on our tour.', NULL, 'Papentorenvest 1a', NULL),
(8, 'Amsterdamse Poort', 'History of the place:Importance to Haarlem.:The location and where we are on our tour.', NULL, 'Amsterdamsevaart', NULL),
(9, 'Hof van Bakenes', 'History of the place:Importance to Haarlem.:The location and where we are on our tour.', NULL, 'Korte Begijnestraat 21ZW', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `uuid` uuid NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `exp_date` datetime DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `isAllAccess` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `role` int(1) NOT NULL,
  `register_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `register_date`) VALUES
(1, 'admin', 'admin@gmail.com', '5d7845ac6ee7cfffafc5fe5f35cf666d', 9, NULL),
(2, 'customer', 'customer@gmail.com', '5d7845ac6ee7cfffafc5fe5f35cf666d', 0, NULL),
(3, 'employee', 'employee@gmail.com', '5d7845ac6ee7cfffafc5fe5f35cf666d', 1, NULL),
(4, 'Test', 'test@gmail.com', '5d7845ac6ee7cfffafc5fe5f35cf666d', 0, NULL),
(6, 'billy', 'billy@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '2023-04-05'),
(8, 'JasonXie', 'jasonxie62@gmail.com', '5d7845ac6ee7cfffafc5fe5f35cf666d', 0, '2023-04-09'),
(9, 'cody', 'codykoning1@gmail.com', '5d7845ac6ee7cfffafc5fe5f35cf666d', 0, '2023-06-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `API_KEYS`
--
ALTER TABLE `API_KEYS`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist_event_edm`
--
ALTER TABLE `artist_event_edm`
  ADD KEY `event_id` (`event_id`),
  ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `dance_location`
--
ALTER TABLE `dance_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_edm`
--
ALTER TABLE `event_edm`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `venue` (`venue`),
  ADD KEY `artist` (`artist_id`) USING BTREE;

--
-- Indexes for table `event_stroll`
--
ALTER TABLE `event_stroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_yummie`
--
ALTER TABLE `event_yummie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant` (`restaurant_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_program`
--
ALTER TABLE `personal_program`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`uuid`) USING BTREE,
  ADD KEY `session` (`session_id`) USING BTREE;

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD KEY `location_id` (`location_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `stroll_location`
--
ALTER TABLE `stroll_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `API_KEYS`
--
ALTER TABLE `API_KEYS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `dance_location`
--
ALTER TABLE `dance_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `event_edm`
--
ALTER TABLE `event_edm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `event_yummie`
--
ALTER TABLE `event_yummie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `stroll_location`
--
ALTER TABLE `stroll_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artist_event_edm`
--
ALTER TABLE `artist_event_edm`
  ADD CONSTRAINT `artist_event_edm_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`),
  ADD CONSTRAINT `artist_event_edm_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event_edm` (`id`);

--
-- Constraints for table `event_edm`
--
ALTER TABLE `event_edm`
  ADD CONSTRAINT `event_edm_ibfk_1` FOREIGN KEY (`venue`) REFERENCES `dance_location` (`id`),
  ADD CONSTRAINT `event_edm_ibfk_3` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`),
  ADD CONSTRAINT `event_edm_ibfk_4` FOREIGN KEY (`id`) REFERENCES `events` (`id`);

--
-- Constraints for table `event_stroll`
--
ALTER TABLE `event_stroll`
  ADD CONSTRAINT `event_stroll_ibfk_1` FOREIGN KEY (`id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_stroll_ibfk_2` FOREIGN KEY (`id`) REFERENCES `events` (`id`);

--
-- Constraints for table `event_yummie`
--
ALTER TABLE `event_yummie`
  ADD CONSTRAINT `event_yummie_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurant` (`id`),
  ADD CONSTRAINT `event_yummie_ibfk_2` FOREIGN KEY (`id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_yummie_ibfk_3` FOREIGN KEY (`id`) REFERENCES `events` (`id`);

--
-- Constraints for table `personal_program`
--
ALTER TABLE `personal_program`
  ADD CONSTRAINT `personal_program_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `personal_program_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `route_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `stroll_location` (`id`),
  ADD CONSTRAINT `route_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `event_stroll` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
