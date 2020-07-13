-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 13, 2020 at 02:41 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spotify_ex`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

DROP TABLE IF EXISTS `artists`;
CREATE TABLE IF NOT EXISTS `artists` (
  `artist_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `bio` varchar(12000) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `date_of_birth` date NOT NULL,
  PRIMARY KEY (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `name`, `bio`, `gender`, `date_of_birth`) VALUES
(1, 'mark knopfler', 'Mark Freuder Knopfler est un auteur, compositeur, guitariste, et chanteur écossais, né à Glasgow le 12 août 1949.\r\n\r\nFondateur durant l\'été 1977, avec son frère David, du groupe Dire Straits — ce nom vient de l\'expression anglaise « to be in dire straits », qui signifie « être dans une situation désespérée, dans la dèche » —, il poursuit depuis 1996 une carrière solo.\r\n\r\nSes mélodies sont particulièrement fines et adaptées à son style de guitare très aérien, un style blues-country-rock virtuose qui a pu être comparé, aux débuts de l\'artiste, à Bob Dylan et à J.J. Cale1.\r\n\r\nMark Knopfler, avec Dire Straits et en solo, a vendu plus de 130 millions d\'albums. Il est classé 27e dans le classement des meilleurs guitaristes de tous les temps par le magazine Rolling Stone2.', 'male', '1949-08-12'),
(2, 'Bruce Springsteen', 'Bruce Springsteen, né le 23 septembre 1949 à Long Branch (New Jersey), est un chanteur, auteur-compositeur et guitariste américain.\r\n\r\nIl est l\'un des artistes les plus populaires aux États-Unis, avec plus de 64 millions d\'albums écoulés, pour un total de plus de 130 millions à travers le monde1,2. Selon le classement établi par le magazine Rolling Stone, il figure à la 36e place parmi les 100 plus grands chanteurs anglo-saxons de tous les temps, ainsi qu\'à la 23e place des 100 plus grands artistes3. Il est classé 96e meilleur guitariste de tous les temps sur 1004.', 'male', '1949-09-23'),
(3, 'Daft Punk', 'Daft Punk (prononcé en anglais : [dæft pʌŋk]), est un groupe de musique électronique français, originaire de Paris. Composé de Thomas Bangalter et Guy-Manuel de Homem-Christo, le groupe est actif depuis 1993, et participe à la création et à la démocratisation du mouvement de musique électronique baptisé french touch. Ils font partie des artistes français s\'exportant le mieux à l\'étranger, et ce depuis la sortie de leur premier véritable succès, Da Funk en 1995. Une des originalités de Daft Punk est la culture de leur notoriété d\'artistes indépendants et sans visage, portant toujours en public des casques et des costumes. Ils s\'inspirent sur ce point du film Phantom of the Paradise de Brian De Palma.\r\n\r\nDaft Punk sort son premier album intitulé Homework en 1997. Leur second album, commercialisé en 2001, s\'intitule Discovery. Il comprend des succès tels que One More Time, Digital Love et Harder, Better, Faster, Stronger. Le duo a également composé la bande son du film Tron : L\'Héritage. En 2013, Daft Punk quitte EMI Records pour signer avec le label Columbia Records et sortir un album intitulé Random Access Memories qui remporte un important succès international et cinq Grammy Awards dont celui du meilleur album de l\'année.', 'male', '1997-01-01'),
(4, 'Adele', 'Adele Laurie Blue Adkins MBE, dite Adele [əˈdɛl]1, née le 5 mai 1988 dans le quartier londonien de Tottenham, est une autrice-compositrice-interprète britannique.\r\n\r\nEn 2008, elle sort son premier album 19 (le titre de son album) qui se vend à plus de 7 millions d’exemplaires. Elle est la première à recevoir le prix Critics’ Choice (prix de la critique) des Brit Awards, distinguée « découverte de l’année 2008 » dans un vote des critiques musicales de BBC, Sound of 2009. En 2009, Adele remporte deux prix de la 51e édition des Grammy Awards, celui du meilleur nouvel artiste et celui de la meilleure prestation pop féminine2,3. Elle est présentée par la presse britannique, comme Duffy et d\'autres artistes montantes de 2007-2008, « New Amys », ou la « Nouvelle Amy Winehouse ».', 'female', '1988-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categ_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` enum('Rock','Electro','Pop') NOT NULL,
  PRIMARY KEY (`categ_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categ_id`, `title`) VALUES
(1, 'Rock'),
(2, 'Electro'),
(3, 'Pop');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

DROP TABLE IF EXISTS `playlists`;
CREATE TABLE IF NOT EXISTS `playlists` (
  `playlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `creation_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`playlist_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlists`
--

INSERT INTO `playlists` (`playlist_id`, `title`, `creation_date`, `user_id`) VALUES
(4, 'myFirstPL', '2020-07-13', 2),
(5, 'mySecondtPL', '2020-07-13', 2);

-- --------------------------------------------------------

--
-- Table structure for table `playlist_content`
--

DROP TABLE IF EXISTS `playlist_content`;
CREATE TABLE IF NOT EXISTS `playlist_content` (
  `playlist_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  KEY `playlist_id` (`playlist_id`),
  KEY `song_id` (`song_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `song_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `release_date` date NOT NULL,
  `categ_id` int(11) DEFAULT NULL,
  `artist_id` int(11) NOT NULL,
  PRIMARY KEY (`song_id`),
  KEY `categ_id` (`categ_id`),
  KEY `artist_id` (`artist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`song_id`, `title`, `release_date`, `categ_id`, `artist_id`) VALUES
(1, 'Money for nothing', '1985-06-24', 1, 1),
(2, 'brothers in arms', '1985-10-14', 1, 1),
(3, 'On every street', '1991-09-10', 1, 1),
(4, 'Private investigation', '1982-09-20', 1, 1),
(5, 'Born in the U.S.A', '1984-10-30', 1, 2),
(6, 'I\'m on fire', '1985-02-06', 1, 2),
(7, 'Dancing in the dark', '1984-05-03', 1, 2),
(8, 'Da funk', '1996-12-01', 2, 3),
(9, 'Around the world', '1997-03-17', 2, 3),
(10, 'Digital love', '2001-08-21', 2, 3),
(11, 'Harder better faster stronger', '2001-10-13', 2, 3),
(12, 'Get lucky', '2013-04-19', 2, 3),
(13, 'Skyfall', '2012-10-05', 3, 4),
(14, 'Rolling in the deep', '2010-11-29', 3, 4),
(15, 'Hometown glory', '2007-10-22', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `mail`, `password`) VALUES
(2, 'Matthieu', 'BarbiÃ©', 'matthieu.barbie@gmail.com', '$2y$10$xIcapaF2t0hKvub1hM082u2FJfVuxlbDP.434RwXR4WwFBzzkdImO');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `playlist_content`
--
ALTER TABLE `playlist_content`
  ADD CONSTRAINT `playlist_content_ibfk_1` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`playlist_id`),
  ADD CONSTRAINT `playlist_content_ibfk_2` FOREIGN KEY (`song_id`) REFERENCES `songs` (`song_id`);

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`categ_id`) REFERENCES `categories` (`categ_id`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
