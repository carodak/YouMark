-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 06 Mars 2017 à 14:43
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `social_bookmarking`
--

-- --------------------------------------------------------

--
-- Structure de la table `commente`
--

CREATE TABLE `commente` (
  `id_utilisateur` int(11) NOT NULL,
  `id_marque_page` int(11) NOT NULL,
  `date_c` datetime NOT NULL,
  `note` int(11) NOT NULL,
  `libelle_c` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commente`
--

INSERT INTO `commente` (`id_utilisateur`, `id_marque_page`, `date_c`, `note`, `libelle_c`) VALUES
(1, 1, '2016-01-02 00:00:00', 4, 'Baumbach-VonRueden'),
(2, 2, '2017-01-27 00:00:00', 1, 'Kirlin-Lockman'),
(3, 3, '2016-03-02 00:00:00', 4, 'Labadie LLC'),
(4, 4, '2017-01-07 00:00:00', 4, 'Pfeffer, Reilly and Luettgen'),
(5, 5, '2016-01-14 00:00:00', 5, 'Steuber LLC'),
(6, 6, '2016-11-12 00:00:00', 4, 'Zieme, Jenkins and Batz'),
(7, 7, '2016-10-18 00:00:00', 1, 'Reinger-Bednar'),
(8, 8, '2016-02-27 00:00:00', 5, 'Erdman-O\'Reilly'),
(9, 9, '2016-06-16 00:00:00', 5, 'Cassin and Sons'),
(10, 10, '2016-02-01 00:00:00', 5, 'Schmidt, Emmerich and Weber'),
(11, 11, '2016-04-10 00:00:00', 5, 'Price and Sons'),
(12, 12, '2016-04-07 00:00:00', 4, 'Berge-Bruen'),
(13, 13, '2016-08-24 00:00:00', 1, 'Jaskolski-Bogisich'),
(14, 14, '2016-02-10 00:00:00', 4, 'Effertz, Treutel and Gorczany'),
(15, 15, '2016-05-11 00:00:00', 2, 'Stokes-Fay'),
(16, 16, '2016-02-22 00:00:00', 2, 'Hamill, VonRueden and Kirlin'),
(17, 17, '2016-09-29 00:00:00', 5, 'King-Pfannerstill'),
(18, 18, '2016-10-31 00:00:00', 3, 'Wilkinson Group'),
(19, 19, '2016-10-25 00:00:00', 4, 'Robel-Botsford'),
(20, 20, '2016-03-12 00:00:00', 1, 'Paucek, Grant and Ankunding'),
(21, 21, '2016-06-24 00:00:00', 4, 'Cormier, Bailey and Bernhard'),
(22, 22, '2016-01-26 00:00:00', 1, 'Champlin, Volkman and Jakubowski'),
(23, 23, '2016-07-06 00:00:00', 5, 'Morissette, Schoen and Johns'),
(24, 24, '2015-12-26 00:00:00', 2, 'Brakus, Corwin and Cassin'),
(25, 25, '2017-02-05 00:00:00', 5, 'Brakus, Lowe and VonRueden'),
(26, 26, '2016-12-22 00:00:00', 1, 'Yundt and Sons'),
(27, 27, '2016-06-26 00:00:00', 5, 'Sauer and Sons'),
(28, 28, '2016-03-09 00:00:00', 4, 'Abernathy-Schneider'),
(29, 29, '2016-02-27 00:00:00', 1, 'Sauer-Kohler'),
(30, 30, '2016-08-28 00:00:00', 5, 'Will-McClure'),
(31, 31, '2016-10-22 00:00:00', 4, 'Luettgen, Herman and Lebsack'),
(32, 32, '2016-02-03 00:00:00', 2, 'Bartoletti LLC'),
(33, 33, '2016-08-04 00:00:00', 4, 'Ward-Mraz'),
(34, 34, '2016-05-13 00:00:00', 4, 'Hartmann Inc'),
(35, 35, '2016-10-27 00:00:00', 1, 'Rohan, Torp and Mraz'),
(36, 36, '2016-07-09 00:00:00', 4, 'Wilderman, Heidenreich and Halvorson'),
(37, 37, '2016-11-04 00:00:00', 3, 'Jast-Kihn'),
(38, 38, '2016-10-04 00:00:00', 5, 'Powlowski-Howe'),
(39, 39, '2016-12-21 00:00:00', 4, 'Altenwerth, Schultz and Medhurst'),
(40, 40, '2016-03-18 00:00:00', 2, 'Jast, Jacobs and O\'Keefe'),
(41, 41, '2016-11-26 00:00:00', 2, 'Sanford-Wisozk'),
(42, 42, '2016-10-21 00:00:00', 2, 'Marquardt, Feest and Olson'),
(43, 43, '2016-10-05 00:00:00', 5, 'Kemmer, Medhurst and Hirthe'),
(44, 44, '2016-07-22 00:00:00', 3, 'O\'Keefe and Sons'),
(45, 45, '2016-02-02 00:00:00', 2, 'Kuhlman-Johnston'),
(46, 46, '2016-05-26 00:00:00', 3, 'Hauck-Parker'),
(47, 47, '2017-01-22 00:00:00', 4, 'Schroeder, Greenholt and Metz'),
(48, 48, '2017-02-03 00:00:00', 1, 'Adams, Cole and Bins'),
(49, 49, '2016-04-05 00:00:00', 5, 'Rolfson, Kuphal and Willms'),
(50, 50, '2016-07-20 00:00:00', 2, 'Erdman LLC'),
(51, 51, '2017-02-07 00:00:00', 1, 'Hintz Inc'),
(52, 52, '2016-12-09 00:00:00', 1, 'Nader-Shields'),
(53, 53, '2017-01-27 00:00:00', 1, 'Jacobs Group'),
(54, 54, '2017-02-28 00:00:00', 1, 'Luettgen-Hackett'),
(55, 55, '2016-09-20 00:00:00', 3, 'McDermott-Kulas'),
(56, 56, '2016-11-21 00:00:00', 2, 'Shanahan Inc'),
(57, 57, '2016-03-15 00:00:00', 4, 'Berge and Sons'),
(58, 58, '2016-01-17 00:00:00', 2, 'Miller LLC'),
(59, 59, '2016-04-09 00:00:00', 2, 'Stamm-Schumm'),
(60, 60, '2016-01-29 00:00:00', 2, 'Kuhic-Frami'),
(61, 61, '2016-10-09 00:00:00', 4, 'Thompson-Treutel'),
(62, 62, '2016-05-14 00:00:00', 4, 'Klocko, Pouros and Lindgren'),
(63, 63, '2016-06-13 00:00:00', 1, 'Hagenes-Shields'),
(64, 64, '2016-06-28 00:00:00', 1, 'White-Purdy'),
(65, 65, '2016-12-14 00:00:00', 3, 'Nader-Wolff'),
(66, 66, '2017-02-18 00:00:00', 4, 'Predovic-Nader'),
(67, 67, '2016-11-16 00:00:00', 4, 'Doyle-Pacocha'),
(68, 68, '2016-06-13 00:00:00', 1, 'Kunde, Paucek and Watsica'),
(69, 69, '2016-12-17 00:00:00', 5, 'Pfeffer, Cronin and Lockman'),
(70, 70, '2016-11-18 00:00:00', 4, 'McCullough Group'),
(71, 71, '2016-12-25 00:00:00', 5, 'Purdy-Murphy'),
(72, 72, '2017-01-07 00:00:00', 4, 'Ryan, Crooks and Nicolas'),
(73, 73, '2016-05-24 00:00:00', 1, 'Bernhard-Upton'),
(74, 74, '2016-06-15 00:00:00', 2, 'McGlynn, Romaguera and Nicolas'),
(75, 75, '2016-05-06 00:00:00', 1, 'Hilll, Kunde and Pouros'),
(76, 76, '2016-01-14 00:00:00', 3, 'Smitham-Runte'),
(77, 77, '2016-08-05 00:00:00', 3, 'Buckridge, Zieme and Williamson'),
(78, 78, '2016-09-13 00:00:00', 1, 'Dietrich Inc'),
(79, 79, '2016-07-12 00:00:00', 3, 'Zboncak and Sons'),
(80, 80, '2016-03-21 00:00:00', 4, 'Kling, Ernser and Marquardt'),
(81, 81, '2016-02-29 00:00:00', 3, 'Cummings-Daugherty'),
(82, 82, '2016-02-15 00:00:00', 3, 'Nikolaus, Howe and Yundt'),
(83, 83, '2016-05-12 00:00:00', 2, 'Kessler Inc'),
(84, 84, '2017-01-04 00:00:00', 4, 'Lebsack-Gorczany'),
(85, 85, '2016-10-18 00:00:00', 5, 'Langosh, Flatley and Welch'),
(86, 86, '2016-08-29 00:00:00', 4, 'Lubowitz LLC'),
(87, 87, '2016-02-17 00:00:00', 2, 'Schmeler, Koss and Gulgowski'),
(88, 88, '2016-01-31 00:00:00', 2, 'Effertz Group'),
(89, 89, '2016-09-03 00:00:00', 5, 'Price-Thiel'),
(90, 90, '2016-10-30 00:00:00', 4, 'Hagenes and Sons'),
(91, 91, '2016-09-29 00:00:00', 2, 'Cummerata-Waters'),
(92, 92, '2016-01-09 00:00:00', 4, 'Stark-Ondricka'),
(93, 93, '2016-04-29 00:00:00', 2, 'Schultz and Sons'),
(94, 94, '2016-03-20 00:00:00', 1, 'Olson, Runte and Wintheiser'),
(95, 95, '2016-12-01 00:00:00', 4, 'Buckridge and Sons'),
(96, 96, '2016-07-28 00:00:00', 2, 'Herzog-Abbott'),
(97, 97, '2017-01-16 00:00:00', 2, 'Conn-Okuneva'),
(98, 98, '2016-03-31 00:00:00', 2, 'Gislason and Sons'),
(99, 99, '2016-08-30 00:00:00', 2, 'Leuschke-Konopelski'),
(100, 100, '2016-11-22 00:00:00', 3, 'Zulauf Inc');

-- --------------------------------------------------------

--
-- Structure de la table `marque_page`
--

CREATE TABLE `marque_page` (
  `id` int(11) NOT NULL,
  `url` varchar(300) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `id_createur` int(11) DEFAULT NULL,
  `date_p` datetime NOT NULL,
  `type_droit` int(11) NOT NULL DEFAULT '0',
  `description_p` text,
  `logo_choisi` int(11) NOT NULL DEFAULT '0',
  `note` int(11) NOT NULL DEFAULT '0' COMMENT 'Note = somme / 5',
  `somme` int(11) NOT NULL DEFAULT '0' COMMENT 'A chaque vote somme+=vote'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `marque_page`
--

INSERT INTO `marque_page` (`id`, `url`, `titre`, `id_createur`, `date_p`, `type_droit`, `description_p`, `logo_choisi`, `note`, `somme`) VALUES
(1, 'w3.org/potenti.jpg', 'Feedspan', 1, '2016-04-11 00:00:00', 0, 'Stuart', 0, 1, 0),
(2, 'mysql.com/pede/morbi/porttitor.json', 'Livetube', 2, '2016-04-25 00:00:00', 1, 'Del Sol', 0, 2, 0),
(3, 'alibaba.com/amet/diam/in.png', 'Wikido', 3, '2016-07-17 00:00:00', 0, 'Arapahoe', 0, 3, 0),
(4, 'ucsd.edu/pretium/quis/lectus/suspendisse.aspx', 'Feedfish', 4, '2016-11-24 00:00:00', 0, 'Daystar', 0, 4, 0),
(5, 'shutterfly.com/viverra/pede/ac/diam/cras.aspx', 'Skimia', 5, '2016-07-14 00:00:00', 1, 'Lotheville', 0, 5, 0),
(6, 'seattletimes.com/posuere.js', 'Latz', 6, '2016-05-06 00:00:00', 0, 'Barnett', 0, 6, 0),
(7, 'a8.net/primis/in/faucibus/orci/luctus/et.js', 'Zava', 7, '2016-09-23 00:00:00', 0, 'Roxbury', 0, 7, 0),
(8, 'ihg.com/nisi/eu.png', 'Dabfeed', 8, '2016-07-05 00:00:00', 1, 'Burrows', 0, 8, 0),
(9, 'phoca.cz/ornare/imperdiet/sapien/urna/pretium.jsp', 'Babbleblab', 9, '2016-12-25 00:00:00', 1, 'Monument', 0, 9, 0),
(10, 'ycombinator.com/sit/amet.jsp', 'Pixoboo', 10, '2016-08-29 00:00:00', 1, 'North', 0, 10, 0),
(11, 'paypal.com/in.aspx', 'Zooxo', 11, '2016-07-16 00:00:00', 0, 'Gateway', 0, 11, 0),
(12, 'de.vu/cras/pellentesque/volutpat/dui/maecenas/tristique/est.xml', 'Camido', 12, '2016-11-10 00:00:00', 1, 'Shelley', 0, 12, 0),
(13, 'google.ca/est/quam/pharetra.aspx', 'Trilia', 13, '2016-11-08 00:00:00', 0, 'Fulton', 0, 13, 0),
(14, 'canalblog.com/amet/sem/fusce/consequat/nulla/nisl/nunc.js', 'Blogtags', 14, '2016-09-06 00:00:00', 0, 'Lillian', 0, 14, 0),
(15, 'fema.gov/odio/justo/sollicitudin/ut/suscipit/a/feugiat.jsp', 'Skinte', 15, '2017-01-06 00:00:00', 1, 'Derek', 0, 15, 0),
(16, 'youtube.com/ac/diam.html', 'Trudoo', 16, '2016-08-18 00:00:00', 0, 'Fisk', 0, 16, 0),
(17, 'hc360.com/id/turpis/integer/aliquet/massa/id.xml', 'Rhynyx', 17, '2016-08-28 00:00:00', 1, 'Corben', 0, 17, 0),
(18, 'reverbnation.com/vulputate/vitae.jsp', 'Photojam', 18, '2016-03-31 00:00:00', 0, 'Emmet', 0, 18, 0),
(19, 'apache.org/id.xml', 'Zoomzone', 19, '2016-01-15 00:00:00', 1, 'Kipling', 0, 19, 0),
(20, 'gmpg.org/dui/proin/leo/odio.js', 'Agivu', 20, '2016-05-17 00:00:00', 0, 'Southridge', 0, 20, 0),
(21, 'blinklist.com/consequat/morbi/a/ipsum/integer/a.jsp', 'Feedmix', 21, '2016-05-28 00:00:00', 0, 'Chinook', 0, 21, 0),
(22, 'umich.edu/ut.aspx', 'Aimbo', 22, '2016-04-17 00:00:00', 1, 'Golf', 0, 22, 0),
(23, 'moonfruit.com/vestibulum/rutrum.js', 'Blogtags', 23, '2016-08-18 00:00:00', 0, 'Meadow Valley', 0, 23, 0),
(24, 'hatena.ne.jp/odio/cras/mi.jpg', 'Twinte', 24, '2015-12-22 00:00:00', 0, 'Utah', 0, 24, 0),
(25, 'gizmodo.com/eleifend/luctus/ultricies/eu/nibh/quisque.html', 'Chatterbridge', 25, '2016-09-30 00:00:00', 0, 'Goodland', 0, 25, 0),
(26, 'toplist.cz/condimentum/neque/sapien/placerat/ante/nulla/justo.json', 'Skimia', 26, '2017-02-06 00:00:00', 0, 'Pine View', 0, 26, 0),
(27, 'nydailynews.com/nullam/porttitor/lacus/at/turpis.json', 'Realblab', 27, '2016-01-25 00:00:00', 1, 'Miller', 0, 27, 0),
(28, 'sakura.ne.jp/feugiat/non/pretium/quis/lectus.js', 'Blogtags', 28, '2016-06-16 00:00:00', 0, 'Forest Run', 0, 28, 0),
(29, 'jimdo.com/fusce/consequat/nulla/nisl.png', 'Browsetype', 29, '2016-06-20 00:00:00', 0, 'Sutherland', 0, 29, 0),
(30, 'ucla.edu/auctor.js', 'Gabtune', 30, '2016-09-10 00:00:00', 0, 'Donald', 0, 30, 0),
(31, 'booking.com/in/libero/ut/massa/volutpat.js', 'Roomm', 31, '2016-09-21 00:00:00', 0, 'Upham', 0, 31, 0),
(32, 'yellowbook.com/fermentum/donec/ut/mauris/eget/massa/tempor.png', 'Skyvu', 32, '2016-01-16 00:00:00', 1, 'Walton', 0, 32, 0),
(33, 'parallels.com/turpis.jsp', 'Thoughtbridge', 33, '2016-11-17 00:00:00', 0, 'Mcbride', 0, 33, 0),
(34, 'moonfruit.com/accumsan/tortor/quis/turpis.jsp', 'Quinu', 34, '2016-03-14 00:00:00', 0, 'Melrose', 0, 34, 0),
(35, 'cornell.edu/sollicitudin/mi.html', 'Tagopia', 35, '2016-07-16 00:00:00', 0, 'Linden', 0, 35, 0),
(36, 'mtv.com/in/faucibus/orci/luctus/et/ultrices/posuere.jsp', 'Eare', 36, '2016-11-08 00:00:00', 0, 'Mcbride', 0, 36, 0),
(37, 'jimdo.com/felis/ut/at/dolor/quis.xml', 'Jaxnation', 37, '2016-07-13 00:00:00', 0, 'Clemons', 0, 37, 0),
(38, 'japanpost.jp/justo.js', 'Photolist', 38, '2016-08-21 00:00:00', 0, 'Ronald Regan', 0, 38, 0),
(39, 'fda.gov/duis/faucibus/accumsan.jpg', 'Wikido', 39, '2016-01-29 00:00:00', 0, 'Shopko', 0, 39, 0),
(40, 'cyberchimps.com/bibendum/morbi/non/quam.json', 'Kazu', 40, '2016-02-28 00:00:00', 1, 'Bartelt', 0, 40, 0),
(41, 'freewebs.com/eleifend/luctus.xml', 'Skiba', 41, '2016-09-26 00:00:00', 1, 'Coleman', 0, 41, 0),
(42, 'topsy.com/ultrices/erat/tortor/sollicitudin/mi/sit/amet.js', 'Fivespan', 42, '2017-01-25 00:00:00', 1, 'Grayhawk', 0, 42, 0),
(43, 'irs.gov/justo.png', 'Voonder', 43, '2016-07-30 00:00:00', 0, 'Commercial', 0, 43, 0),
(44, 'ft.com/luctus.png', 'Innotype', 44, '2016-02-29 00:00:00', 0, 'Harper', 0, 44, 0),
(45, 'sciencedaily.com/suspendisse/potenti/in/eleifend.aspx', 'Lazzy', 45, '2015-12-31 00:00:00', 0, 'Sutherland', 0, 45, 0),
(46, 'cbc.ca/ut/mauris.jsp', 'Nlounge', 46, '2016-04-01 00:00:00', 1, 'Mosinee', 0, 46, 0),
(47, 'devhub.com/elementum/in/hac/habitasse/platea/dictumst/morbi.xml', 'Jayo', 47, '2016-12-22 00:00:00', 1, 'Weeping Birch', 0, 47, 0),
(48, 'infoseek.co.jp/libero/ut/massa/volutpat/convallis/morbi.png', 'Photofeed', 48, '2016-04-01 00:00:00', 0, 'Hoffman', 0, 48, 0),
(49, 'ucoz.com/rhoncus/mauris/enim/leo/rhoncus/sed.aspx', 'Feedbug', 49, '2016-11-15 00:00:00', 1, 'Pine View', 0, 49, 0),
(50, 'networkadvertising.org/id/turpis/integer/aliquet/massa/id.json', 'Bubblebox', 50, '2017-02-26 00:00:00', 1, 'Corry', 0, 50, 0),
(51, 'bbb.org/nisi/nam.js', 'Snaptags', 51, '2016-08-10 00:00:00', 0, 'Westridge', 0, 51, 0),
(52, 'wordpress.org/diam/nam/tristique.aspx', 'Brainverse', 52, '2016-05-16 00:00:00', 1, 'Heffernan', 0, 52, 0),
(53, 'elpais.com/suspendisse/ornare.html', 'Flipopia', 53, '2016-06-07 00:00:00', 1, 'Graceland', 0, 53, 0),
(54, 'dyndns.org/mattis/nibh/ligula/nec/sem.json', 'Tazzy', 54, '2016-08-13 00:00:00', 1, 'Lyons', 0, 54, 0),
(55, 'blogger.com/ultrices/posuere/cubilia.html', 'Photojam', 55, '2016-09-06 00:00:00', 0, 'Heffernan', 0, 55, 0),
(56, 'cisco.com/tempor/turpis/nec/euismod.jpg', 'Chatterbridge', 56, '2016-06-28 00:00:00', 0, 'Texas', 0, 56, 0),
(57, 'ucla.edu/tristique/est/et/tempus/semper.aspx', 'Yakijo', 57, '2016-07-29 00:00:00', 1, 'Barby', 0, 57, 0),
(58, 'deviantart.com/mattis/odio/donec/vitae/nisi/nam/ultrices.js', 'Innojam', 58, '2016-11-18 00:00:00', 0, 'Sugar', 0, 58, 0),
(59, 'cdc.gov/pretium/iaculis/justo.jsp', 'Babbleblab', 59, '2016-06-22 00:00:00', 1, 'Johnson', 0, 59, 0),
(60, 'google.ru/pharetra/magna/ac/consequat.jsp', 'Oyoba', 60, '2016-10-04 00:00:00', 1, 'Vermont', 0, 60, 0),
(61, 'cnbc.com/amet/consectetuer/adipiscing/elit.html', 'Roomm', 61, '2016-07-02 00:00:00', 1, 'Carioca', 0, 61, 0),
(62, 'walmart.com/leo/odio/condimentum.json', 'Twimbo', 62, '2016-03-03 00:00:00', 1, 'Service', 0, 62, 0),
(63, 'mlb.com/turpis.xml', 'Shuffledrive', 63, '2016-01-19 00:00:00', 0, 'Fuller', 0, 63, 0),
(64, 'elegantthemes.com/et/magnis/dis/parturient/montes.js', 'Oyoyo', 64, '2016-08-16 00:00:00', 1, 'Crowley', 0, 64, 0),
(65, 'youtube.com/ipsum/dolor.js', 'Eidel', 65, '2017-02-06 00:00:00', 0, 'Warrior', 0, 65, 0),
(66, 'auda.org.au/auctor/sed/tristique.png', 'Fivebridge', 66, '2016-03-01 00:00:00', 0, 'Sage', 0, 66, 0),
(67, 'gizmodo.com/vitae.jsp', 'Tagfeed', 67, '2016-03-01 00:00:00', 1, 'Pennsylvania', 0, 67, 0),
(68, 'usnews.com/potenti.aspx', 'DabZ', 68, '2016-09-26 00:00:00', 1, 'Clove', 0, 68, 0),
(69, 'youtu.be/duis/bibendum.aspx', 'Trilith', 69, '2016-12-08 00:00:00', 0, 'Merchant', 0, 69, 0),
(70, 'php.net/justo/eu/massa/donec.jsp', 'Kayveo', 70, '2016-06-30 00:00:00', 0, 'Texas', 0, 70, 0),
(71, 'eepurl.com/amet.png', 'Edgetag', 71, '2016-04-21 00:00:00', 0, 'Esch', 0, 71, 0),
(72, 'live.com/nascetur/ridiculus.xml', 'Linkbridge', 72, '2016-06-28 00:00:00', 0, 'Larry', 0, 72, 0),
(73, 'imdb.com/nullam.html', 'Izio', 73, '2015-12-25 00:00:00', 1, 'Truax', 0, 73, 0),
(74, 'arstechnica.com/odio.aspx', 'Skilith', 74, '2016-06-09 00:00:00', 0, 'Bay', 0, 74, 0),
(75, 'vkontakte.ru/eu/nibh.jpg', 'Brainlounge', 75, '2016-08-29 00:00:00', 1, 'Bonner', 0, 75, 0),
(76, 'nature.com/platea/dictumst/morbi/vestibulum/velit.aspx', 'Yoveo', 76, '2017-02-16 00:00:00', 1, 'Judy', 0, 76, 0),
(77, 'va.gov/imperdiet/sapien/urna/pretium/nisl/ut/volutpat.json', 'Pixope', 77, '2016-10-26 00:00:00', 1, 'Hollow Ridge', 0, 77, 0),
(78, 'berkeley.edu/luctus/et/ultrices/posuere/cubilia/curae/nulla.json', 'Tagchat', 78, '2016-12-25 00:00:00', 0, 'Raven', 0, 78, 0),
(79, 'alibaba.com/aliquet/maecenas.json', 'Avavee', 79, '2016-03-30 00:00:00', 1, 'Amoth', 0, 79, 0),
(80, 'ebay.co.uk/vestibulum/ante/ipsum/primis/in/faucibus/orci.jpg', 'Twitterwire', 80, '2016-01-07 00:00:00', 0, 'Vidon', 0, 80, 0),
(81, 'vinaora.com/sit/amet/nulla/quisque.png', 'BlogXS', 81, '2017-01-25 00:00:00', 0, 'Delladonna', 0, 81, 0),
(82, 'comcast.net/convallis/tortor/risus/dapibus.js', 'Blogspan', 82, '2016-11-26 00:00:00', 0, 'Westport', 0, 82, 0),
(83, 'e-recht24.de/ante/vestibulum/ante/ipsum/primis/in/faucibus.png', 'Skinte', 83, '2016-10-31 00:00:00', 0, 'Doe Crossing', 0, 83, 0),
(84, 'theatlantic.com/posuere/felis.json', 'Kazio', 84, '2016-03-29 00:00:00', 1, 'Washington', 0, 84, 0),
(85, 'behance.net/consequat/dui.html', 'Youbridge', 85, '2016-09-13 00:00:00', 1, 'Algoma', 0, 85, 0),
(86, 'amazon.de/ipsum/primis/in/faucibus/orci/luctus/et.json', 'Realfire', 86, '2017-01-12 00:00:00', 0, 'Elgar', 0, 86, 0),
(87, 'myspace.com/bibendum/morbi.xml', 'Divanoodle', 87, '2016-04-28 00:00:00', 0, 'Shasta', 0, 87, 0),
(88, 'census.gov/eros/elementum/pellentesque/quisque/porta/volutpat/erat.js', 'Oloo', 88, '2016-05-15 00:00:00', 0, 'Delaware', 0, 88, 0),
(89, 'tuttocitta.it/ante/nulla/justo/aliquam/quis.jsp', 'Trilith', 89, '2016-11-07 00:00:00', 0, 'Logan', 0, 89, 0),
(90, 'about.me/nisl/ut.jsp', 'Realbridge', 90, '2016-05-12 00:00:00', 0, 'Bowman', 0, 90, 0),
(91, 'google.com/vel/nisl.json', 'Leexo', 91, '2016-12-17 00:00:00', 0, 'Eastlawn', 0, 91, 0),
(92, 'github.com/at/diam/nam/tristique/tortor/eu.jpg', 'Realcube', 92, '2016-05-21 00:00:00', 1, 'Paget', 0, 92, 0),
(93, 'google.nl/accumsan/odio.xml', 'Dabshots', 93, '2017-01-16 00:00:00', 0, 'Mayer', 0, 93, 0),
(94, 'digg.com/lacus.jsp', 'Feedmix', 94, '2016-02-01 00:00:00', 1, 'Gina', 0, 94, 0),
(95, 'icq.com/porttitor/pede/justo/eu/massa.jsp', 'Wikivu', 95, '2016-05-24 00:00:00', 0, 'Nobel', 0, 95, 0),
(96, 'photobucket.com/quis/lectus/suspendisse/potenti.xml', 'Bubblebox', 96, '2016-02-03 00:00:00', 0, 'Forest Dale', 0, 96, 0),
(97, 'themeforest.net/vestibulum/ac/est/lacinia/nisi.json', 'Oyoyo', 97, '2016-07-15 00:00:00', 0, 'Dawn', 0, 97, 0),
(98, 'umn.edu/vel/sem/sed/sagittis.png', 'Jaxworks', 98, '2016-05-08 00:00:00', 0, 'Nova', 0, 98, 0),
(99, 'wisc.edu/vestibulum/ante/ipsum.jpg', 'Gabcube', 99, '2016-06-02 00:00:00', 1, 'Hovde', 0, 99, 0),
(100, '4shared.com/volutpat/convallis/morbi/odio.jpg', 'Pixope', 100, '2016-09-03 00:00:00', 0, 'Elka', 0, 100, 0),
(101, 'https://www.youtube.com/channel/UCa3meRxRwQrXg__x--Goxrg', 'rien', 5, '2017-03-05 11:01:08', 0, NULL, 0, 0, 0),
(102, '', '', NULL, '2017-03-05 11:27:44', 0, '', 0, 0, 0),
(103, 'https://www.youtube.com/channel/UCQ0gZgLbqHywkNU_mDJKDzg', 'John butler', NULL, '2017-03-05 12:34:13', 1, '', 7, 0, 0),
(104, 'https://www.youtube.com/channel/UCQ0gZgLbqHywkNU_mDJKDzg', 'John butler', NULL, '2017-03-05 12:36:43', 1, '', 7, 0, 0),
(105, 'https://www.youtube.com/channel/UCQ0gZgLbqHywkNU_mDJKDzg', 'John butler', NULL, '2017-03-05 12:45:57', 0, '', 1, 0, 0),
(106, 'https://www.youtube.com/channel/UCQ0gZgLbqHywkNU_mDJKDzg', 'John butler', NULL, '2017-03-05 12:47:59', 1, 'Donald trump qui chante !', 4, 0, 0),
(107, 'https://www.youtube.com/channel/UCQ0gZgLbqHywkNU_mDJKDzg', 'John butler', NULL, '2017-03-05 12:48:21', 1, 'DummyFrame!', 4, 0, 0),
(108, 'https://www.youtube.com/channel/UCQ0gZgLbqHywkNU_mDJKDzg', 'DummyFrame', NULL, '2017-03-05 12:50:32', 1, 'Salut salut', 2, 0, 0),
(109, 'https://www.youtube.com/channel/UCQ0gZgLbqHywkNU_mDJKDzg', 'John butler', NULL, '2017-03-05 13:06:12', 1, 'Donald trump qui chante !', 3, 0, 0),
(110, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'Mon titre', NULL, '2017-03-05 21:15:20', 1, NULL, 0, 0, 0),
(111, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'LinkstheSun', NULL, '2017-03-05 21:18:00', 1, NULL, 0, 0, 0),
(112, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'LinkstheSun', NULL, '2017-03-05 21:18:43', 1, NULL, 0, 0, 0),
(113, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'LinkstheSun', NULL, '2017-03-05 21:19:19', 1, NULL, 0, 0, 0),
(114, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'LinkstheSun', NULL, '2017-03-05 21:22:28', 1, NULL, 0, 0, 0),
(115, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'LinkstheSun', NULL, '2017-03-05 21:22:43', 1, NULL, 0, 0, 0),
(116, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'Vieux', NULL, '2017-03-05 21:23:30', 1, 'Voilavoilavous', 0, 0, 0),
(117, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'Vieux', NULL, '2017-03-05 21:23:57', 1, 'Voilavoilavous', 0, 0, 0),
(118, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'Jspr', NULL, '2017-03-05 21:25:30', 1, 'Par miracle', 0, 0, 0),
(119, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'Jspr', NULL, '2017-03-05 21:25:44', 1, 'Par miracle', 0, 0, 0),
(120, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'Jspr', NULL, '2017-03-05 21:26:08', 1, 'Par miracle', 0, 0, 0),
(121, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'Jspr', NULL, '2017-03-05 21:27:14', 1, 'Par miracle', 0, 0, 0),
(122, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'Jspr', NULL, '2017-03-05 21:27:29', 1, 'Par miracle', 0, 0, 0),
(123, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'Prefere', NULL, '2017-03-05 21:27:55', 1, 'Des oliviers', 0, 0, 0),
(124, 'https://www.youtube.com/channel/UCfXXAQ-mp1uUcvSpvMcAAtw', 'Prefere', NULL, '2017-03-05 21:29:06', 1, 'Des oliviers', 0, 0, 0),
(125, 'https://www.youtube.com/channel/UCQ0gZgLbqHywkNU_mDJKDzg', 'John butler', NULL, '2017-03-05 21:29:29', 1, 'Voilavoilavous2', 7, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `modifie`
--

CREATE TABLE `modifie` (
  `id_utilisateur` int(11) NOT NULL,
  `id_marque_page` int(11) NOT NULL,
  `date_m` datetime NOT NULL,
  `description_m` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `modifie`
--

INSERT INTO `modifie` (`id_utilisateur`, `id_marque_page`, `date_m`, `description_m`) VALUES
(1, 1, '2016-09-07 00:00:00', 'VonRueden Inc'),
(2, 2, '2016-06-13 00:00:00', 'Thompson, Bayer and Cummings'),
(3, 3, '2016-10-04 00:00:00', 'Wolf-Casper'),
(4, 4, '2017-02-19 00:00:00', 'Marquardt, Zemlak and Bernhard'),
(5, 5, '2017-01-24 00:00:00', 'Kuhlman-Maggio'),
(6, 6, '2016-07-02 00:00:00', 'Rolfson and Sons'),
(7, 7, '2016-04-17 00:00:00', 'Buckridge-Cremin'),
(8, 8, '2016-09-13 00:00:00', 'Thompson LLC'),
(9, 9, '2017-02-24 00:00:00', 'Schuppe, Schamberger and Mraz'),
(10, 10, '2016-12-27 00:00:00', 'Funk Group'),
(11, 11, '2016-12-18 00:00:00', 'Marquardt, Nikolaus and Bauch'),
(12, 12, '2016-08-20 00:00:00', 'Parker-Littel'),
(13, 13, '2016-08-20 00:00:00', 'Labadie and Sons'),
(14, 14, '2016-02-12 00:00:00', 'Altenwerth, Gislason and Swaniawski'),
(15, 15, '2016-06-03 00:00:00', 'O\'Hara, Towne and Ritchie'),
(16, 16, '2016-08-18 00:00:00', 'Goodwin Inc'),
(17, 17, '2016-12-25 00:00:00', 'Rosenbaum and Sons'),
(18, 18, '2016-06-04 00:00:00', 'Marvin Group'),
(19, 19, '2016-06-20 00:00:00', 'Klein Group'),
(20, 20, '2016-06-24 00:00:00', 'Auer, Lakin and Shanahan'),
(21, 21, '2016-07-23 00:00:00', 'Gutkowski-Heidenreich'),
(22, 22, '2016-06-06 00:00:00', 'Skiles LLC'),
(23, 23, '2016-09-22 00:00:00', 'O\'Hara-Ratke'),
(24, 24, '2016-04-28 00:00:00', 'Koelpin, Cummings and Williamson'),
(25, 25, '2016-04-01 00:00:00', 'Klein Group'),
(26, 26, '2016-03-17 00:00:00', 'Yost Inc'),
(27, 27, '2016-05-27 00:00:00', 'Schuster-Little'),
(28, 28, '2016-12-27 00:00:00', 'Ferry, Batz and Bartell'),
(29, 29, '2016-11-13 00:00:00', 'Willms, Stanton and Witting'),
(30, 30, '2016-04-17 00:00:00', 'Shanahan Inc'),
(31, 31, '2017-02-17 00:00:00', 'Lesch-Krajcik'),
(32, 32, '2016-05-29 00:00:00', 'Kerluke, Schamberger and Kuhic'),
(33, 33, '2016-07-19 00:00:00', 'Nienow, Price and Christiansen'),
(34, 34, '2016-07-15 00:00:00', 'Greenfelder Inc'),
(35, 35, '2016-08-19 00:00:00', 'Hodkiewicz-Casper'),
(36, 36, '2016-07-23 00:00:00', 'Gulgowski, Daugherty and Toy'),
(37, 37, '2017-02-22 00:00:00', 'Crist, Brown and Hartmann'),
(38, 38, '2016-05-09 00:00:00', 'Hoeger-O\'Hara'),
(39, 39, '2016-08-28 00:00:00', 'Ondricka-Bernhard'),
(40, 40, '2016-11-15 00:00:00', 'McDermott Group'),
(41, 41, '2016-09-09 00:00:00', 'Swaniawski-Bashirian'),
(42, 42, '2016-04-05 00:00:00', 'Brakus-Ortiz'),
(43, 43, '2015-12-31 00:00:00', 'Haley, Fay and Reichert'),
(44, 44, '2016-04-20 00:00:00', 'Monahan-Sanford'),
(45, 45, '2016-09-30 00:00:00', 'Kuhlman Inc'),
(46, 46, '2016-05-09 00:00:00', 'Stiedemann Inc'),
(47, 47, '2016-04-03 00:00:00', 'Schoen and Sons'),
(48, 48, '2016-09-03 00:00:00', 'Block LLC'),
(49, 49, '2016-12-18 00:00:00', 'Bartoletti Inc'),
(50, 50, '2016-08-27 00:00:00', 'McKenzie-Schoen'),
(51, 51, '2016-03-26 00:00:00', 'Gerlach-Hartmann'),
(52, 52, '2015-12-31 00:00:00', 'Kessler-Frami'),
(53, 53, '2016-05-04 00:00:00', 'Kautzer, O\'Keefe and Hansen'),
(54, 54, '2017-02-13 00:00:00', 'Turner Inc'),
(55, 55, '2017-01-21 00:00:00', 'Doyle-Gusikowski'),
(56, 56, '2016-09-19 00:00:00', 'Koch, Mayert and Klein'),
(57, 57, '2016-05-09 00:00:00', 'Wolff Group'),
(58, 58, '2016-03-28 00:00:00', 'Erdman, Emard and Mraz'),
(59, 59, '2016-11-18 00:00:00', 'Heaney-Reilly'),
(60, 60, '2016-04-16 00:00:00', 'Morissette-Beier'),
(61, 61, '2016-03-24 00:00:00', 'Conn, Marquardt and Wilkinson'),
(62, 62, '2016-01-19 00:00:00', 'Stracke, Green and Davis'),
(63, 63, '2016-06-24 00:00:00', 'Kuhlman Inc'),
(64, 64, '2017-01-23 00:00:00', 'Jaskolski-Walter'),
(65, 65, '2016-07-08 00:00:00', 'Kassulke and Sons'),
(66, 66, '2016-10-29 00:00:00', 'Goodwin-Feil'),
(67, 67, '2016-08-08 00:00:00', 'Hand-Torp'),
(68, 68, '2017-03-02 00:00:00', 'Barrows, Koch and Turner'),
(69, 69, '2016-07-01 00:00:00', 'Jenkins, O\'Hara and Hane'),
(70, 70, '2016-06-22 00:00:00', 'Morissette-Blick'),
(71, 71, '2016-03-19 00:00:00', 'Schmitt-Renner'),
(72, 72, '2016-03-29 00:00:00', 'Daniel, Abshire and Reichel'),
(73, 73, '2016-11-25 00:00:00', 'Schuppe, Lemke and Stracke'),
(74, 74, '2016-04-18 00:00:00', 'Jones and Sons'),
(75, 75, '2016-03-13 00:00:00', 'Thiel Group'),
(76, 76, '2017-02-21 00:00:00', 'Bahringer Group'),
(77, 77, '2016-09-12 00:00:00', 'Prohaska-Jenkins'),
(78, 78, '2016-12-18 00:00:00', 'Walker-Mante'),
(79, 79, '2016-10-01 00:00:00', 'Douglas-Brakus'),
(80, 80, '2016-01-26 00:00:00', 'Anderson Group'),
(81, 81, '2016-07-13 00:00:00', 'Weissnat-Bruen'),
(82, 82, '2016-01-07 00:00:00', 'Ankunding-Kris'),
(83, 83, '2016-02-16 00:00:00', 'Schoen Inc'),
(84, 84, '2016-03-11 00:00:00', 'Hills-McLaughlin'),
(85, 85, '2017-01-09 00:00:00', 'Schuster, Kerluke and Stroman'),
(86, 86, '2016-05-28 00:00:00', 'Stanton and Sons'),
(87, 87, '2016-05-27 00:00:00', 'Roberts-Kassulke'),
(88, 88, '2016-04-08 00:00:00', 'McDermott-Satterfield'),
(89, 89, '2016-11-26 00:00:00', 'Kozey, Smith and Bradtke'),
(90, 90, '2016-03-26 00:00:00', 'Cartwright, Russel and Schmeler'),
(91, 91, '2016-12-07 00:00:00', 'Ledner-Reynolds'),
(92, 92, '2016-07-10 00:00:00', 'Sipes-Rohan'),
(93, 93, '2016-05-26 00:00:00', 'Schmidt-Cruickshank'),
(94, 94, '2016-03-30 00:00:00', 'Pfannerstill, Kirlin and Abernathy'),
(95, 95, '2017-02-06 00:00:00', 'Armstrong-Wilderman'),
(96, 96, '2017-02-28 00:00:00', 'Rohan Group'),
(97, 97, '2016-07-01 00:00:00', 'Shanahan, Lehner and Weissnat'),
(98, 98, '2016-02-26 00:00:00', 'Lynch LLC'),
(99, 99, '2016-11-20 00:00:00', 'Bednar, Hermann and Little'),
(100, 100, '2016-08-10 00:00:00', 'Swift, Gottlieb and Borer');

-- --------------------------------------------------------

--
-- Structure de la table `suit`
--

CREATE TABLE `suit` (
  `id_utilisateur` int(11) NOT NULL,
  `id_marque_page` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `suit`
--

INSERT INTO `suit` (`id_utilisateur`, `id_marque_page`) VALUES
(2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id_utilisateur` int(11) NOT NULL,
  `id_marque_page` int(11) NOT NULL,
  `date_t` datetime NOT NULL,
  `label` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id_utilisateur`, `id_marque_page`, `date_t`, `label`) VALUES
(1, 1, '2016-06-09 00:00:00', 'Childrens Ibuprofen'),
(2, 2, '2016-01-20 00:00:00', 'Loxapine Succinate'),
(3, 3, '2016-11-15 00:00:00', 'Cephalosporium'),
(4, 4, '2016-01-08 00:00:00', 'Cytarabine'),
(5, 5, '2016-11-16 00:00:00', 'Valacyclovir'),
(6, 6, '2016-12-04 00:00:00', 'Pollens - Trees, Willow, Black Salix nigra'),
(7, 7, '2017-01-12 00:00:00', 'Kiehls Since 1851 Broad Spectrum SPF 30 Sunscreen Powerful Wrinkle Reducing'),
(8, 8, '2016-02-13 00:00:00', 'Extra Strength Acetaminophen PM'),
(9, 9, '2016-12-13 00:00:00', 'KOCHIA SCOPARIA POLLEN'),
(10, 10, '2016-07-16 00:00:00', 'Diazepam'),
(11, 11, '2016-04-17 00:00:00', 'Profuse Sweating'),
(12, 12, '2016-11-17 00:00:00', 'Lisinopril'),
(13, 13, '2016-02-05 00:00:00', 'Nortriptyline Hydrochloride'),
(14, 14, '2016-10-04 00:00:00', 'Naratriptan'),
(15, 15, '2016-07-14 00:00:00', 'Orange Pollen'),
(16, 16, '2016-05-27 00:00:00', 'Linden'),
(17, 17, '2016-12-05 00:00:00', 'Norco'),
(18, 18, '2016-01-25 00:00:00', 'Advanced Hand Sanitizer'),
(19, 19, '2017-02-18 00:00:00', 'Olanzapine'),
(20, 20, '2016-07-05 00:00:00', 'Bupivacaine Hydrochloride'),
(21, 21, '2016-03-21 00:00:00', 'CALCID'),
(22, 22, '2016-01-31 00:00:00', 'Sodium Chloride'),
(23, 23, '2016-01-05 00:00:00', 'Nasal Decongestant'),
(24, 24, '2016-02-19 00:00:00', 'Atenolol'),
(25, 25, '2017-01-22 00:00:00', 'SKELAXIN'),
(26, 26, '2016-11-06 00:00:00', 'Neomycin and Polymyxin B Sulfates and Gramicidin'),
(27, 27, '2016-05-28 00:00:00', 'Azilect'),
(28, 28, '2016-09-02 00:00:00', 'Fluocinolone Acetonide'),
(29, 29, '2017-02-22 00:00:00', 'Dial Acne'),
(30, 30, '2016-04-17 00:00:00', 'LES BEIGES'),
(31, 31, '2016-02-04 00:00:00', 'Rimmel London'),
(32, 32, '2016-04-03 00:00:00', 'Cedar Elm'),
(33, 33, '2016-02-01 00:00:00', 'LISINOPRIL'),
(34, 34, '2016-10-13 00:00:00', 'Sunmark Chest Congestion Relief PE'),
(35, 35, '2016-04-04 00:00:00', 'CD DIOR PRESTIGE WHITE COLLECTION SATIN BRIGHTENING UVB BASE WITH SUNSCREEN SPF 50'),
(36, 36, '2016-05-28 00:00:00', 'INTRON A'),
(37, 37, '2016-05-12 00:00:00', 'Dovonex'),
(38, 38, '2016-09-09 00:00:00', 'Aveeno Baby Calming Comfort'),
(39, 39, '2016-06-20 00:00:00', 'Lidocaine Hydrochloride and Epinephrine'),
(40, 40, '2016-05-12 00:00:00', 'Oxygen'),
(41, 41, '2017-01-27 00:00:00', 'No7 Beautifully Matte Foundation Sunscreen Broad Spectrum SPF 15 Wheat'),
(42, 42, '2016-06-30 00:00:00', 'SALICYLIC ACID'),
(43, 43, '2016-03-21 00:00:00', 'Magnesium Citrate'),
(44, 44, '2016-03-15 00:00:00', 'GUNA-IL 10'),
(45, 45, '2016-06-19 00:00:00', 'BZK Plus Prep Pad'),
(46, 46, '2016-02-20 00:00:00', 'OB Metab'),
(47, 47, '2017-01-19 00:00:00', 'Chemet'),
(48, 48, '2016-02-21 00:00:00', 'Aveeno Positively Radiant CC'),
(49, 49, '2017-02-02 00:00:00', 'Testosterone'),
(50, 50, '2016-08-10 00:00:00', 'Diltiazem Hydrochloride'),
(51, 51, '2016-06-19 00:00:00', 'METHYLPHENIDATE HYDROCHLORIDE'),
(52, 52, '2016-04-16 00:00:00', 'Aplicare Total Joint Prep'),
(53, 53, '2016-08-21 00:00:00', 'Ramipril'),
(54, 54, '2016-12-08 00:00:00', 'HYDROMORPHONE HYDROCHLORIDE'),
(55, 55, '2016-07-20 00:00:00', 'Fentanyl'),
(56, 56, '2016-07-20 00:00:00', 'benzonatate'),
(57, 57, '2016-07-23 00:00:00', 'Dettol'),
(58, 58, '2016-01-03 00:00:00', 'Norditropin'),
(59, 59, '2016-06-23 00:00:00', 'SHISEIDO SUNCARE ULTIMATE'),
(60, 60, '2017-02-19 00:00:00', 'Molds, Rusts and Smuts, Candida albicans'),
(61, 61, '2016-02-19 00:00:00', 'Avapro'),
(62, 62, '2017-02-06 00:00:00', 'OXYCODONE HYDROCHLORIDE'),
(63, 63, '2017-01-01 00:00:00', 'Loratadine'),
(64, 64, '2016-02-04 00:00:00', 'ShopRite Anti Itch'),
(65, 65, '2016-05-25 00:00:00', 'Fulton Street Market Cetirizine Hydrochloride'),
(66, 66, '2016-02-24 00:00:00', 'Loratadine'),
(67, 67, '2016-05-13 00:00:00', 'HYDROCODONE BITARTRATE'),
(68, 68, '2016-03-24 00:00:00', 'Methylphenidate Hydrochloride'),
(69, 69, '2016-07-02 00:00:00', 'Didanosine'),
(70, 70, '2017-01-31 00:00:00', 'ECOSAVE GRAPEFRUIT AND LEMONGRASS SOAP ANTIBACTERIAL HAND SOAP'),
(71, 71, '2016-10-16 00:00:00', 'ANTIBACTERIAL FOAMING'),
(72, 72, '2016-10-29 00:00:00', 'Desmopressin Acetate'),
(73, 73, '2016-01-21 00:00:00', 'Elcure Ato'),
(74, 74, '2016-01-31 00:00:00', 'Shopko Hydrocortisone Plus 12 Moisturizers'),
(75, 75, '2016-05-19 00:00:00', 'Digoxin'),
(76, 76, '2016-12-18 00:00:00', 'Dry Scalp Dandruff'),
(77, 77, '2016-10-21 00:00:00', 'Apis Bryonia Special Order'),
(78, 78, '2016-10-20 00:00:00', 'Potassium Chloride in Dextrose and Sodium Chloride'),
(79, 79, '2016-11-25 00:00:00', 'Divalproex Sodium'),
(80, 80, '2015-12-27 00:00:00', 'Anti-bacterial Hand'),
(81, 81, '2016-04-08 00:00:00', 'Ranitidine'),
(82, 82, '2016-10-23 00:00:00', 'OXYGEN'),
(83, 83, '2016-03-05 00:00:00', 'added strength pm'),
(84, 84, '2016-12-24 00:00:00', 'Triple Antibiotic Plus Pain Relief'),
(85, 85, '2016-02-14 00:00:00', 'AIM CAVITY PROTECTION'),
(86, 86, '2016-09-19 00:00:00', 'Wingscale'),
(87, 87, '2017-01-17 00:00:00', 'Ocean Potion Cool Dry Touch Sport 30 Sunscreen'),
(88, 88, '2016-09-15 00:00:00', 'Prazosin Hydrochloride'),
(89, 89, '2016-07-25 00:00:00', 'Quetiapine fumarate'),
(90, 90, '2016-10-18 00:00:00', 'ESTRACE'),
(91, 91, '2016-12-04 00:00:00', 'Labetalol hydrochloride'),
(92, 92, '2017-02-18 00:00:00', 'Famciclovir'),
(93, 93, '2017-02-28 00:00:00', 'Ramipril'),
(94, 94, '2016-01-20 00:00:00', 'daytime'),
(95, 95, '2017-02-26 00:00:00', 'Promethazine Hydrochloride'),
(96, 96, '2017-02-22 00:00:00', 'Hydrocodone Bitartate and Acetaminophen'),
(97, 97, '2016-09-21 00:00:00', 'REVITEALIZE'),
(98, 98, '2016-04-10 00:00:00', 'milk of magnesia'),
(99, 99, '2016-11-20 00:00:00', 'Secret Clinical Strength'),
(100, 100, '2017-01-01 00:00:00', 'Amlodipine besylate and Atorvastatin calcium');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `mot_de_passe` varchar(32) NOT NULL COMMENT 'mdp au format md5',
  `pseudo` varchar(20) NOT NULL,
  `avatar` varchar(100) DEFAULT NULL COMMENT 'url de l''image ',
  `niveau` int(10) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `mail`, `mot_de_passe`, `pseudo`, `avatar`, `niveau`, `admin`) VALUES
(1, 'wsims0@guardian.co.uk', 'Bjteq4RJy', 'aalvarez0', NULL, 5, 0),
(2, 'rgarcia1@youku.com', '64cMrUSyWwI', 'jbrown1', NULL, 2, 0),
(3, 'pgreen2@earthlink.net', '6ZYFojR', 'sdunn2', NULL, 4, 1),
(4, 'llynch3@ocn.ne.jp', 'n2J9r1Q', 'lalexander3', NULL, 5, 0),
(5, 'cpalmer4@mayoclinic.com', 'bsSzfjT9z1h', 'gjackson4', NULL, 2, 1),
(6, 'tbishop5@list-manage.com', 'XNYzJdGJTDQL', 'thamilton5', NULL, 1, 0),
(7, 'dprice6@msu.edu', '5ig36RBum0B', 'daustin6', NULL, 2, 1),
(8, 'sstanley7@1und1.de', 'ERZwZico2q', 'barnold7', NULL, 3, 0),
(9, 'aelliott8@nasa.gov', '6g7n7G0V1', 'ckim8', NULL, 1, 1),
(10, 'kbryant9@mozilla.org', 'yDUyDR', 'awoods9', NULL, 1, 0),
(11, 'braya@mapy.cz', '6IkQuhuQ5', 'bnelsona', NULL, 1, 0),
(12, 'rrossb@istockphoto.com', '9StoRhTA8Egj', 'criceb', NULL, 1, 0),
(13, 'ashawc@posterous.com', 'idyqLf', 'afreemanc', NULL, 1, 1),
(14, 'harmstrongd@weebly.com', 'TPMPoFA03ZN', 'kwalkerd', NULL, 1, 1),
(15, 'ffieldse@europa.eu', 'amNv1Bdwh', 'mcoopere', NULL, 2, 1),
(16, 'mharrisonf@ox.ac.uk', 's5RTZMj', 'lhunterf', NULL, 5, 0),
(17, 'jporterg@illinois.edu', 'ZmEN7uHfo', 'hgreeneg', NULL, 3, 1),
(18, 'sberryh@delicious.com', 'nohS7K', 'ereyesh', NULL, 4, 0),
(19, 'tedwardsi@tumblr.com', 'SHb1ytq', 'elarsoni', NULL, 5, 1),
(20, 'agreenj@hp.com', 'VVIfdOoenPN', 'jmillerj', NULL, 2, 1),
(21, 'tmartinezk@mozilla.com', 'qTkcxDDsJ', 'enelsonk', NULL, 4, 0),
(22, 'fthomasl@geocities.com', 'pfqiwlfIk', 'lperryl', NULL, 5, 1),
(23, 'cbryantm@paginegialle.it', 'P5XWQBlHceNB', 'cwalkerm', NULL, 3, 1),
(24, 'jsmithn@hud.gov', 'NxMUEw8puiD', 'jwatkinsn', NULL, 5, 1),
(25, 'ielliso@epa.gov', 'js9PsY5y', 'cpierceo', NULL, 1, 0),
(26, 'fberryp@over-blog.com', 'gFCSasmKpH', 'hpetersp', NULL, 3, 1),
(27, 'rwebbq@wikipedia.org', 'zi9ZhlCtvN4Y', 'rhenryq', NULL, 3, 1),
(28, 'llynchr@wikipedia.org', 'GuiVr4pX', 'aturnerr', NULL, 4, 0),
(29, 'dhowells@trellian.com', 'VClLeOP', 'jbrookss', NULL, 2, 1),
(30, 'jburnst@sun.com', 'dSIBAiIJwwPx', 'ahendersont', NULL, 1, 0),
(31, 'rwoodsu@wunderground.com', 'shgtfQD2rXs', 'crobertsonu', NULL, 2, 0),
(32, 'mrichardsonv@php.net', '15vt8fIGFFer', 'ktuckerv', NULL, 2, 1),
(33, 'jrobertsonw@linkedin.com', 'amIyxFd6V', 'tmasonw', NULL, 5, 1),
(34, 'dperryx@economist.com', 'PfLoGFPr', 'mhamiltonx', NULL, 3, 1),
(35, 'twoodsy@biblegateway.com', 'HSnIXT', 'cstanleyy', NULL, 3, 1),
(36, 'mstewartz@netscape.com', 'MLJfCNFF', 'ibryantz', NULL, 5, 1),
(37, 'jschmidt10@eventbrite.com', 'KsDncgsi', 'mromero10', NULL, 4, 0),
(38, 'gberry11@sogou.com', 'LfbRahhqKFe', 'jmorgan11', NULL, 3, 1),
(39, 'hmitchell12@dot.gov', 'VGuBDY', 'cgonzalez12', NULL, 4, 1),
(40, 'nhunter13@icq.com', 'XYfaWJW', 'awhite13', NULL, 4, 0),
(41, 'mfoster14@a8.net', 'Q9ukO4G', 'rbrown14', NULL, 4, 1),
(42, 'plarson15@barnesandnoble.com', 'Nn4MVswXSivi', 'vbailey15', NULL, 3, 0),
(43, 'gfreeman16@nba.com', 't0ITaTRJah', 'jlittle16', NULL, 3, 0),
(44, 'djordan17@angelfire.com', 'df3acpfQXRBx', 'ctucker17', NULL, 1, 0),
(45, 'cgarza18@cdbaby.com', 'GOBG4nzd', 'mstewart18', NULL, 4, 0),
(46, 'nchavez19@bigcartel.com', 'iGU68GrklPm', 'gowens19', NULL, 3, 0),
(47, 'glee1a@dmoz.org', 'CcwJ0DAS1', 'jdaniels1a', NULL, 1, 1),
(48, 'jwright1b@twitter.com', 'mDHyQnQP6F0', 'dstephens1b', NULL, 5, 0),
(49, 'kelliott1c@joomla.org', 'iWFP1R5', 'drobinson1c', NULL, 3, 0),
(50, 'bwatson1d@tumblr.com', 'dB5VC7b', 'jmorgan1d', NULL, 4, 1),
(51, 'dgraham1e@blogtalkradio.com', 'pnkV0TI', 'jwhite1e', NULL, 5, 1),
(52, 'rruiz1f@mediafire.com', 'POKatwOoeR', 'dgarza1f', NULL, 5, 0),
(53, 'rmorris1g@google.pl', 'Dhlsfw4qV0FF', 'cburns1g', NULL, 5, 1),
(54, 'rperez1h@fda.gov', 'VUuXwoD', 'jsimpson1h', NULL, 1, 1),
(55, 'dsnyder1i@drupal.org', 'wvFTKooa9w', 'csanchez1i', NULL, 2, 0),
(56, 'dlittle1j@cnbc.com', 'UEeut2', 'rowens1j', NULL, 1, 0),
(57, 'fsmith1k@youku.com', 'EJZW1LOT5nyu', 'eramos1k', NULL, 4, 1),
(58, 'jcole1l@fastcompany.com', 'h6nh7Bde', 'brussell1l', NULL, 2, 1),
(59, 'roliver1m@squarespace.com', 'd1vd8t7O2TB5', 'jwebb1m', NULL, 3, 0),
(60, 'rmontgomery1n@whitehouse.gov', 'saHEaDg', 'ddaniels1n', NULL, 3, 1),
(61, 'dcole1o@jalbum.net', 'mPBe8yaZQ6QJ', 'swatson1o', NULL, 3, 1),
(62, 'lgeorge1p@washingtonpost.com', 'ZqQvBaWbnv9', 'srichardson1p', NULL, 3, 0),
(63, 'hpatterson1q@amazon.co.jp', 'JFQD9iRva', 'rreed1q', NULL, 4, 1),
(64, 'amyers1r@geocities.com', '9mOX9IszLP', 'showell1r', NULL, 3, 1),
(65, 'dlittle1s@linkedin.com', 'WwNnBycVg', 'jcarr1s', NULL, 2, 1),
(66, 'jalvarez1t@storify.com', 'zQtsHqm7VZ1X', 'telliott1t', NULL, 2, 0),
(67, 'rbradley1u@spiegel.de', 'UV2KvcJu', 'jramirez1u', NULL, 2, 0),
(68, 'fweaver1v@geocities.jp', 'KxdFHktVP', 'dlewis1v', NULL, 4, 1),
(69, 'pkennedy1w@indiatimes.com', 'jfx4iikDV4', 'njohnson1w', NULL, 4, 1),
(70, 'dyoung1x@state.tx.us', 'a2DX3WqcrBu', 'ldaniels1x', NULL, 3, 0),
(71, 'fhamilton1y@51.la', 'O8jV8c6KWb', 'ekelly1y', NULL, 1, 0),
(72, 'kknight1z@cafepress.com', 'AtnvXq', 'afoster1z', NULL, 2, 1),
(73, 'jfrazier20@ow.ly', 'RlbAEl', 'mhoward20', NULL, 2, 1),
(74, 'achapman21@ifeng.com', 'A9qOjR', 'jburke21', NULL, 1, 1),
(75, 'cbrown22@forbes.com', 'ZGNLdLFK', 'aedwards22', NULL, 3, 1),
(76, 'pross23@phoca.cz', 'X8Muohx2', 'rwashington23', NULL, 4, 1),
(77, 'sdunn24@state.tx.us', 'tVXTVhB2q', 'gcruz24', NULL, 5, 1),
(78, 'ahamilton25@gnu.org', 'jdRXHnog', 'rgreen25', NULL, 2, 0),
(79, 'rgonzales26@google.ru', 'Lkvqvi', 'jdiaz26', NULL, 1, 0),
(80, 'amorgan27@lulu.com', '6eLR2t5g', 'arichards27', NULL, 2, 0),
(81, 'cfoster28@mapquest.com', 'tyc7WrD', 'pharrison28', NULL, 2, 1),
(82, 'colson29@mysql.com', 'eX1eeS0rGA', 'jhall29', NULL, 2, 0),
(83, 'agreene2a@instagram.com', 'zPjVw7j', 'mstone2a', NULL, 5, 1),
(84, 'chowell2b@blog.com', 'T3cPUY9JN', 'smitchell2b', NULL, 3, 1),
(85, 'bchavez2c@chronoengine.com', 'EkDe8IT', 'rspencer2c', NULL, 5, 1),
(86, 'tromero2d@angelfire.com', '9DkbX1', 'dmills2d', NULL, 5, 0),
(87, 'kpalmer2e@unesco.org', 'fUC2nPe1nQrF', 'fschmidt2e', NULL, 5, 1),
(88, 'kbailey2f@google.com', 'mgRkvM', 'aaustin2f', NULL, 1, 1),
(89, 'rcarr2g@woothemes.com', 'aMHkjsDAx', 'wgarza2g', NULL, 1, 0),
(90, 'sgardner2h@loc.gov', 'H4ZzbbElQW', 'jharper2h', NULL, 5, 0),
(91, 'jturner2i@wikipedia.org', 'bHocgH0fF17p', 'fmeyer2i', NULL, 5, 1),
(92, 'amontgomery2j@tinyurl.com', 'Pr8dUJ5', 'mhughes2j', NULL, 3, 1),
(93, 'aarnold2k@un.org', 'e993zLTKsSI', 'mcook2k', NULL, 5, 0),
(94, 'asims2l@istockphoto.com', 'Tgs4uCrh', 'aharvey2l', NULL, 1, 0),
(95, 'lford2m@studiopress.com', '7AsjU3TMS7VP', 'lshaw2m', NULL, 2, 0),
(96, 'ktorres2n@bigcartel.com', 'pWNUdQIlO', 'fhansen2n', NULL, 2, 0),
(97, 'jchapman2o@example.com', 'EETKMrAg', 'gblack2o', NULL, 1, 0),
(98, 'bmartinez2p@woothemes.com', '8oSzf3lsG', 'aalexander2p', NULL, 4, 1),
(99, 'jfernandez2q@jigsy.com', 'UhQ9kL1H', 'pbrooks2q', NULL, 2, 0),
(100, 'npalmer2r@themeforest.net', 'UVSg2EiP', 'vhudson2r', NULL, 5, 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commente`
--
ALTER TABLE `commente`
  ADD PRIMARY KEY (`id_utilisateur`,`id_marque_page`,`date_c`),
  ADD KEY `id_marque_page` (`id_marque_page`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `marque_page`
--
ALTER TABLE `marque_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_createur` (`id_createur`);

--
-- Index pour la table `modifie`
--
ALTER TABLE `modifie`
  ADD PRIMARY KEY (`id_utilisateur`,`id_marque_page`,`date_m`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_marque_page` (`id_marque_page`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_utilisateur`,`id_marque_page`,`date_t`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_marque_page` (`id_marque_page`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `mail_2` (`mail`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `marque_page`
--
ALTER TABLE `marque_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commente`
--
ALTER TABLE `commente`
  ADD CONSTRAINT `commente_ibfk_2` FOREIGN KEY (`id_marque_page`) REFERENCES `marque_page` (`id`),
  ADD CONSTRAINT `commente_ibfk_3` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `marque_page`
--
ALTER TABLE `marque_page`
  ADD CONSTRAINT `marque_page_ibfk_1` FOREIGN KEY (`id_createur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `modifie`
--
ALTER TABLE `modifie`
  ADD CONSTRAINT `modifie_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `modifie_ibfk_2` FOREIGN KEY (`id_marque_page`) REFERENCES `marque_page` (`id`);

--
-- Contraintes pour la table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `tag_ibfk_2` FOREIGN KEY (`id_marque_page`) REFERENCES `marque_page` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
