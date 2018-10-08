-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 05 Mai 2017 à 18:26
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
-- Structure de la table `ajoute_modifie`
--

CREATE TABLE `ajoute_modifie` (
  `id_utilisateur` int(11) NOT NULL,
  `id_marque_page` int(11) NOT NULL,
  `date_a` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type_droit` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 : publique | 0 : privé',
  `description` text,
  `date_m` datetime DEFAULT NULL COMMENT 'Gérer avec un Trigger!',
  `createur` tinyint(1) NOT NULL DEFAULT '0',
  `logo_choisi` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ajoute_modifie`
--

INSERT INTO `ajoute_modifie` (`id_utilisateur`, `id_marque_page`, `date_a`, `type_droit`, `description`, `date_m`, `createur`, `logo_choisi`) VALUES
(1, 1, '2017-05-05 20:07:35', 1, '', '2017-05-05 20:07:35', 1, 0),
(1, 2, '2017-05-05 20:08:22', 1, '', '2017-05-05 20:08:22', 1, 12),
(1, 3, '2017-05-05 20:11:04', 1, '', '2017-05-05 20:11:05', 1, 0),
(1, 4, '2017-05-05 20:11:44', 1, 'Chaine de Brune Benamran, très connu des jeunes !', '2017-05-05 20:11:44', 1, 7),
(1, 5, '2017-05-05 20:13:13', 1, 'Chaine sponsorisée par canal+', '2017-05-05 20:13:13', 1, 12),
(1, 6, '2017-05-05 20:13:38', 1, 'Groupe de musique bèlge', '2017-05-05 20:13:38', 1, 10);

--
-- Déclencheurs `ajoute_modifie`
--
DELIMITER $$
CREATE TRIGGER `update_date` BEFORE UPDATE ON `ajoute_modifie` FOR EACH ROW SET NEW.date_m = CURRENT_TIMESTAMP
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `commente`
--

CREATE TABLE `commente` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_marque_page` int(11) NOT NULL,
  `date_c` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `note` int(11) NOT NULL,
  `libelle_c` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commente`
--

INSERT INTO `commente` (`id`, `id_utilisateur`, `id_marque_page`, `date_c`, `note`, `libelle_c`) VALUES
(1, 1, 5, '2017-05-05 20:14:27', 5, 'J\'ai découvert ce groupe par hasard, j\'adore leurs compositions ! :)'),
(2, 1, 6, '2017-05-05 20:15:04', 5, 'Très beau !'),
(3, 1, 6, '2017-05-05 20:15:19', 5, 'Ce sont les plus droles ;)');

-- --------------------------------------------------------

--
-- Structure de la table `marque_page`
--

CREATE TABLE `marque_page` (
  `id` int(11) NOT NULL,
  `url` varchar(300) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `note` int(11) NOT NULL DEFAULT '0' COMMENT 'Géré par un Trigger : Note = somme / 5',
  `somme` int(11) NOT NULL DEFAULT '0' COMMENT 'Géré par un Trigger : A chaque vote somme+=vote'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `marque_page`
--

INSERT INTO `marque_page` (`id`, `url`, `titre`, `note`, `somme`) VALUES
(1, 'https://www.youtube.com/channel/UCzlyMuCVlb2I7MY79K2bDGg', 'Mitxi Tòng', 3, 15),
(2, 'https://www.youtube.com/channel/UCyJDHgrsUKuWLe05GvC2lng', 'Stupid Economics', 0, 0),
(3, 'https://www.youtube.com/channel/UC5Twj1Axp_-9HLsZ5o_cEQQ', 'Doc Seven', 0, 0),
(4, 'https://www.youtube.com/channel/UCcziTK2NKeWtWQ6kB5tmQ8Q', 'e-penser', 0, 0),
(5, 'https://www.youtube.com/channel/UCoZoRz4-y6r87ptDp4Jk74g', 'Palmashow', 0, 0),
(6, 'https://www.youtube.com/channel/UCqDy804FJ75y0LMZC_0XrXQ', 'Boulevard des Airs BDA Officiel', 0, 0);

--
-- Déclencheurs `marque_page`
--
DELIMITER $$
CREATE TRIGGER `CalculNote` BEFORE UPDATE ON `marque_page` FOR EACH ROW BEGIN
SET NEW.note = (NEW.somme + OLD.somme) / 5, NEW.somme = NEW.somme + OLD.somme;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_marque_page` int(11) NOT NULL,
  `date_t` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `label` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `id_utilisateur`, `id_marque_page`, `date_t`, `label`) VALUES
(1, 5, 1, '2017-05-05 20:07:35', 'Musique'),
(2, 5, 1, '2017-05-05 20:07:35', 'guitare'),
(3, 5, 1, '2017-05-05 20:07:35', 'fingerstyle'),
(4, 2, 2, '2017-05-05 20:08:21', 'Economie'),
(5, 2, 2, '2017-05-05 20:08:21', 'science'),
(6, 3, 3, '2017-05-05 20:11:04', 'Top'),
(7, 3, 3, '2017-05-05 20:11:04', 'decouvertes'),
(8, 5, 4, '2017-05-05 20:11:43', 'Science'),
(9, 5, 4, '2017-05-05 20:11:44', 'physique'),
(10, 5, 4, '2017-05-05 20:11:44', 'maths'),
(11, 5, 5, '2017-05-05 20:13:13', 'Humour'),
(12, 4, 6, '2017-05-05 20:13:37', 'Musique'),
(13, 4, 6, '2017-05-05 20:13:37', 'groupe');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `mot_de_passe` varchar(32) NOT NULL COMMENT 'mdp au format md5',
  `pseudo` varchar(20) NOT NULL,
  `avatar` varchar(1000) DEFAULT NULL COMMENT 'url de l''image ',
  `niveau` int(10) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `mail`, `mot_de_passe`, `pseudo`, `avatar`, `niveau`, `admin`) VALUES
(1, 'wsims0@guardian.co.uk', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 358, 0),
(2, 'rgarcia1@youku.com', '06dc3e674a51c0bbee6078b27ab14a89', 'itachi', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSO-MG2D5VbdaQAkN60xGcSYKf-O28tfaxlDTyKhiZk1o62SIDB-w', 4, 0),
(3, 'pgreen2@earthlink.net', '2ac43aa43bf473f9a9c09b4b608619d3', 'light', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcScANEOBbQJ7e0JlW7TZmO-XHOfw5LXCWRphbpLeWxDg4dzeELY', 8, 1),
(4, 'llynch3@ocn.ne.jp', 'n2J9r1Q', 'lalexander3', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 0),
(5, 'cpalmer4@mayoclinic.com', '81dc9bdb52d04dc20036dbd8313ed055', 'gjackson4', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 1),
(6, 'tbishop5@list-manage.com', '81dc9bdb52d04dc20036dbd8313ed055', 'thamilton5', 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTlsmWK0dypowinoCKfk-fpqHRpoU9yyuvPsmT0-r6r3otve2la', 51, 0),
(7, 'dprice6@msu.edu', '5ig36RBum0B', 'daustin6', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 1),
(8, 'sstanley7@1und1.de', 'ERZwZico2q', 'barnold7', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 0),
(9, 'aelliott8@nasa.gov', '6g7n7G0V1', 'ckim8', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 1),
(10, 'kbryant9@mozilla.org', 'yDUyDR', 'awoods9', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(11, 'braya@mapy.cz', '6IkQuhuQ5', 'bnelsona', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(12, 'rrossb@istockphoto.com', '9StoRhTA8Egj', 'criceb', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(13, 'ashawc@posterous.com', 'idyqLf', 'afreemanc', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 1),
(14, 'harmstrongd@weebly.com', 'TPMPoFA03ZN', 'kwalkerd', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 1),
(15, 'ffieldse@europa.eu', 'amNv1Bdwh', 'mcoopere', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 1),
(16, 'mharrisonf@ox.ac.uk', 's5RTZMj', 'lhunterf', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 0),
(17, 'jporterg@illinois.edu', 'ZmEN7uHfo', 'hgreeneg', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(18, 'sberryh@delicious.com', 'nohS7K', 'ereyesh', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 0),
(19, 'tedwardsi@tumblr.com', 'SHb1ytq', 'elarsoni', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(20, 'agreenj@hp.com', 'VVIfdOoenPN', 'jmillerj', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 77, 1),
(21, 'tmartinezk@mozilla.com', 'qTkcxDDsJ', 'enelsonk', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 0),
(22, 'fthomasl@geocities.com', 'pfqiwlfIk', 'lperryl', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(23, 'cbryantm@paginegialle.it', 'P5XWQBlHceNB', 'cwalkerm', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(24, 'jsmithn@hud.gov', 'NxMUEw8puiD', 'jwatkinsn', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(25, 'ielliso@epa.gov', 'js9PsY5y', 'cpierceo', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(26, 'fberryp@over-blog.com', 'gFCSasmKpH', 'hpetersp', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(27, 'rwebbq@wikipedia.org', 'zi9ZhlCtvN4Y', 'rhenryq', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(28, 'llynchr@wikipedia.org', 'GuiVr4pX', 'aturnerr', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 0),
(29, 'dhowells@trellian.com', 'VClLeOP', 'jbrookss', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 1),
(30, 'jburnst@sun.com', 'dSIBAiIJwwPx', 'ahendersont', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(31, 'rwoodsu@wunderground.com', 'shgtfQD2rXs', 'crobertsonu', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 0),
(32, 'mrichardsonv@php.net', '15vt8fIGFFer', 'ktuckerv', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 1),
(33, 'jrobertsonw@linkedin.com', 'amIyxFd6V', 'tmasonw', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(34, 'dperryx@economist.com', 'PfLoGFPr', 'mhamiltonx', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(35, 'twoodsy@biblegateway.com', 'HSnIXT', 'cstanleyy', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(36, 'mstewartz@netscape.com', 'MLJfCNFF', 'ibryantz', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(37, 'jschmidt10@eventbrite.com', 'KsDncgsi', 'mromero10', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 0),
(38, 'gberry11@sogou.com', 'LfbRahhqKFe', 'jmorgan11', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(39, 'hmitchell12@dot.gov', 'VGuBDY', 'cgonzalez12', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 1),
(40, 'nhunter13@icq.com', 'XYfaWJW', 'awhite13', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 0),
(41, 'mfoster14@a8.net', 'Q9ukO4G', 'rbrown14', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 1),
(42, 'plarson15@barnesandnoble.com', 'Nn4MVswXSivi', 'vbailey15', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 0),
(43, 'gfreeman16@nba.com', 't0ITaTRJah', 'jlittle16', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 0),
(44, 'djordan17@angelfire.com', 'df3acpfQXRBx', 'ctucker17', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(45, 'cgarza18@cdbaby.com', 'GOBG4nzd', 'mstewart18', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 0),
(46, 'nchavez19@bigcartel.com', 'iGU68GrklPm', 'gowens19', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 0),
(47, 'glee1a@dmoz.org', 'CcwJ0DAS1', 'jdaniels1a', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 1),
(48, 'jwright1b@twitter.com', 'mDHyQnQP6F0', 'dstephens1b', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 0),
(49, 'kelliott1c@joomla.org', 'iWFP1R5', 'drobinson1c', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 0),
(50, 'bwatson1d@tumblr.com', 'dB5VC7b', 'jmorgan1d', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 1),
(51, 'dgraham1e@blogtalkradio.com', 'pnkV0TI', 'jwhite1e', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(52, 'rruiz1f@mediafire.com', 'POKatwOoeR', 'dgarza1f', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 0),
(53, 'rmorris1g@google.pl', 'Dhlsfw4qV0FF', 'cburns1g', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(54, 'rperez1h@fda.gov', 'VUuXwoD', 'jsimpson1h', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 1),
(55, 'dsnyder1i@drupal.org', 'wvFTKooa9w', 'csanchez1i', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 0),
(56, 'dlittle1j@cnbc.com', 'UEeut2', 'rowens1j', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(57, 'fsmith1k@youku.com', 'EJZW1LOT5nyu', 'eramos1k', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 1),
(58, 'jcole1l@fastcompany.com', 'h6nh7Bde', 'brussell1l', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 1),
(59, 'roliver1m@squarespace.com', 'd1vd8t7O2TB5', 'jwebb1m', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 0),
(60, 'rmontgomery1n@whitehouse.gov', 'saHEaDg', 'ddaniels1n', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(61, 'dcole1o@jalbum.net', 'mPBe8yaZQ6QJ', 'swatson1o', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(62, 'lgeorge1p@washingtonpost.com', 'ZqQvBaWbnv9', 'srichardson1p', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 0),
(63, 'hpatterson1q@amazon.co.jp', 'JFQD9iRva', 'rreed1q', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 1),
(64, 'amyers1r@geocities.com', '9mOX9IszLP', 'showell1r', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(65, 'dlittle1s@linkedin.com', 'WwNnBycVg', 'jcarr1s', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 1),
(66, 'jalvarez1t@storify.com', 'zQtsHqm7VZ1X', 'telliott1t', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 0),
(67, 'rbradley1u@spiegel.de', 'UV2KvcJu', 'jramirez1u', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 0),
(68, 'fweaver1v@geocities.jp', 'KxdFHktVP', 'dlewis1v', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 1),
(69, 'pkennedy1w@indiatimes.com', 'jfx4iikDV4', 'njohnson1w', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 1),
(70, 'dyoung1x@state.tx.us', 'a2DX3WqcrBu', 'ldaniels1x', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 0),
(71, 'fhamilton1y@51.la', 'O8jV8c6KWb', 'ekelly1y', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(72, 'kknight1z@cafepress.com', 'AtnvXq', 'afoster1z', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 1),
(73, 'jfrazier20@ow.ly', 'RlbAEl', 'mhoward20', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 1),
(74, 'achapman21@ifeng.com', 'A9qOjR', 'jburke21', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 1),
(75, 'cbrown22@forbes.com', 'ZGNLdLFK', 'aedwards22', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(76, 'pross23@phoca.cz', 'X8Muohx2', 'rwashington23', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 1),
(77, 'sdunn24@state.tx.us', 'tVXTVhB2q', 'gcruz24', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(78, 'ahamilton25@gnu.org', 'jdRXHnog', 'rgreen25', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 0),
(79, 'rgonzales26@google.ru', 'Lkvqvi', 'jdiaz26', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(80, 'amorgan27@lulu.com', '6eLR2t5g', 'arichards27', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 0),
(81, 'cfoster28@mapquest.com', 'tyc7WrD', 'pharrison28', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 1),
(82, 'colson29@mysql.com', 'eX1eeS0rGA', 'jhall29', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 0),
(83, 'agreene2a@instagram.com', 'zPjVw7j', 'mstone2a', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(84, 'chowell2b@blog.com', 'T3cPUY9JN', 'smitchell2b', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(85, 'bchavez2c@chronoengine.com', 'EkDe8IT', 'rspencer2c', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(86, 'tromero2d@angelfire.com', '9DkbX1', 'dmills2d', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 0),
(87, 'kpalmer2e@unesco.org', 'fUC2nPe1nQrF', 'fschmidt2e', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(88, 'kbailey2f@google.com', 'mgRkvM', 'aaustin2f', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 1),
(89, 'rcarr2g@woothemes.com', 'aMHkjsDAx', 'wgarza2g', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(90, 'sgardner2h@loc.gov', 'H4ZzbbElQW', 'jharper2h', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 0),
(91, 'jturner2i@wikipedia.org', 'bHocgH0fF17p', 'fmeyer2i', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(92, 'amontgomery2j@tinyurl.com', 'Pr8dUJ5', 'mhughes2j', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 3, 1),
(93, 'aarnold2k@un.org', 'e993zLTKsSI', 'mcook2k', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 0),
(94, 'asims2l@istockphoto.com', 'Tgs4uCrh', 'aharvey2l', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(95, 'lford2m@studiopress.com', '7AsjU3TMS7VP', 'lshaw2m', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 0),
(96, 'ktorres2n@bigcartel.com', 'pWNUdQIlO', 'fhansen2n', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 0),
(97, 'jchapman2o@example.com', 'EETKMrAg', 'gblack2o', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 1, 0),
(98, 'bmartinez2p@woothemes.com', '8oSzf3lsG', 'aalexander2p', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 4, 1),
(99, 'jfernandez2q@jigsy.com', 'UhQ9kL1H', 'pbrooks2q', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 2, 0),
(100, 'npalmer2r@themeforest.net', 'UVSg2EiP', 'vhudson2r', 'http://storeprestamodules.com/media/catalog/product/cache/1/image/240x/9df78eab33525d08d6e5fb8d27136e95/u/s/users-256x256.png', 5, 1),
(101, 'test@fr.fr', '098f6bcd4621d373cade4e832627b4f6', 'testnew', NULL, 0, 0),
(102, 'a', '098f6bcd4621d373cade4e832627b4f6', 'test1234', NULL, 0, 0),
(105, 'ab', '187ef4436122d1cc2f40dc2b92f0eba0', 'testnewa', '', 0, 0);

--
-- Déclencheurs `utilisateur`
--
DELIMITER $$
CREATE TRIGGER `UpdateNiveau` BEFORE UPDATE ON `utilisateur` FOR EACH ROW SET NEW.niveau = NEW.niveau + OLD.niveau
$$
DELIMITER ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ajoute_modifie`
--
ALTER TABLE `ajoute_modifie`
  ADD PRIMARY KEY (`id_utilisateur`,`id_marque_page`,`date_a`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_marque_page` (`id_marque_page`),
  ADD KEY `id_utilisateur_2` (`id_utilisateur`),
  ADD KEY `id_marque_page_2` (`id_marque_page`),
  ADD KEY `date_a` (`date_a`);

--
-- Index pour la table `commente`
--
ALTER TABLE `commente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marque_page` (`id_marque_page`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `marque_page`
--
ALTER TABLE `marque_page`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT pour la table `commente`
--
ALTER TABLE `commente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `marque_page`
--
ALTER TABLE `marque_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ajoute_modifie`
--
ALTER TABLE `ajoute_modifie`
  ADD CONSTRAINT `ajoute_modifie_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `ajoute_modifie_ibfk_2` FOREIGN KEY (`id_marque_page`) REFERENCES `marque_page` (`id`);

--
-- Contraintes pour la table `commente`
--
ALTER TABLE `commente`
  ADD CONSTRAINT `commente_ibfk_2` FOREIGN KEY (`id_marque_page`) REFERENCES `marque_page` (`id`),
  ADD CONSTRAINT `commente_ibfk_3` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
