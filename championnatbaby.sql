-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 27 fév. 2018 à 08:23
-- Version du serveur :  5.7.19
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `championnatbaby`
--

-- --------------------------------------------------------

--
-- Structure de la table `competitions`
--

DROP TABLE IF EXISTS `competitions`;
CREATE TABLE IF NOT EXISTS `competitions` (
  `id_competition` int(11) NOT NULL AUTO_INCREMENT,
  `nomChamp` varchar(25) DEFAULT NULL,
  `nbreJoueurs` int(25) NOT NULL,
  `terminee` tinyint(1) NOT NULL DEFAULT '0',
  `dateDebut` date DEFAULT NULL,
  PRIMARY KEY (`id_competition`)
) ENGINE=InnoDB AUTO_INCREMENT=320018 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competitions`
--

INSERT INTO `competitions` (`id_competition`, `nomChamp`, `nbreJoueurs`, `terminee`, `dateDebut`) VALUES
  (1, 'copa del mondo', 4, 0, '2018-01-10'),
  (2, 'coupe EPSI', 4, 0, '2018-01-08'),
  (12, 'test5', 8, 1, '2008-01-01'),
  (13, 'test5', 8, 1, '2008-01-01'),
  (14, 'test5', 8, 1, '2008-01-01'),
  (15, 'test5', 8, 1, '2008-01-01'),
  (16, 'test5', 8, 1, '2008-01-01'),
  (17, 'test6', 8, 1, '2008-01-01'),
  (18, 'test7', 8, 1, '2008-01-01'),
  (19, 'test8', 8, 0, '2016-01-01'),
  (20, 'test9', 8, 0, '2015-01-01'),
  (21, 'test10', 8, 0, '2016-01-01'),
  (22, 'Test 11', 8, 0, '2015-01-01'),
  (23, 'Tournoi 2', 8, 0, '2018-02-25'),
  (24, 'test12', 8, 0, '2018-12-20'),
  (25, 'test13', 8, 0, '2019-01-01'),
  (26, 'test14', 8, 0, '2018-01-02'),
  (27, 'test15', 8, 0, '2018-02-02'),
  (28, 'test16', 8, 0, '2018-03-01'),
  (29, 'test17', 8, 0, '2018-03-03'),
  (320014, 'testB3', 8, 0, '2021-01-01'),
  (320015, 'TESTc1', 0, 0, '2020-01-01'),
  (320016, 'TESTc2', 0, 0, '2020-01-01'),
  (320017, 'TestB4', 0, 0, '2020-02-02');

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
CREATE TABLE IF NOT EXISTS `equipes` (
  `id_Equipe` int(11) NOT NULL AUTO_INCREMENT,
  `joueur1` int(11) NOT NULL,
  `joueur2` int(11) NOT NULL,
  `id_compet` int(11) NOT NULL,
  PRIMARY KEY (`id_Equipe`),
  KEY `fk_joueur1` (`joueur1`),
  KEY `fk_joueur2` (`joueur2`),
  KEY `FK_EquipeCompet` (`id_compet`)
) ENGINE=InnoDB AUTO_INCREMENT=749 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id_Equipe`, `joueur1`, `joueur2`, `id_compet`) VALUES
  (1, 1, 2, 1),
  (2, 3, 4, 1),
  (3, 1, 3, 2),
  (4, 2, 4, 1),
  (5, 1, 4, 2),
  (6, 2, 3, 1),
  (7, 1, 6, 12),
  (8, 3, 7, 12),
  (9, 5, 2, 12),
  (10, 10, 4, 12),
  (11, 8, 9, 12),
  (12, 1, 4, 13),
  (13, 3, 6, 13),
  (14, 7, 5, 13),
  (15, 2, 8, 13),
  (16, 1, 6, 14),
  (17, 3, 8, 14),
  (18, 5, 2, 14),
  (19, 4, 7, 14),
  (20, 1, 4, 15),
  (21, 3, 8, 15),
  (22, 6, 2, 15),
  (23, 5, 7, 15),
  (24, 1, 5, 16),
  (25, 3, 2, 16),
  (26, 7, 4, 16),
  (27, 6, 8, 16),
  (28, 1, 7, 17),
  (29, 3, 2, 17),
  (30, 6, 4, 17),
  (31, 5, 8, 17),
  (32, 1, 8, 18),
  (33, 3, 5, 18),
  (34, 6, 4, 18),
  (35, 2, 7, 18),
  (36, 1, 3, 19),
  (37, 4, 6, 19),
  (38, 7, 5, 19),
  (39, 2, 8, 19),
  (733, 4, 8, 320014),
  (734, 5, 6, 320014),
  (735, 7, 1, 320014),
  (736, 3, 2, 320014),
  (737, 4, 7, 320015),
  (738, 3, 8, 320015),
  (739, 1, 2, 320015),
  (740, 6, 5, 320015),
  (741, 4, 2, 320016),
  (742, 7, 1, 320016),
  (743, 6, 8, 320016),
  (744, 3, 5, 320016),
  (745, 6, 2, 320017),
  (746, 1, 4, 320017),
  (747, 3, 8, 320017),
  (748, 7, 5, 320017);

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

DROP TABLE IF EXISTS `joueurs`;
CREATE TABLE IF NOT EXISTS `joueurs` (
  `id_Joueur` int(25) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `surnom` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `meilleureperformance` varchar(255) DEFAULT NULL,
  `defaut` varchar(255) DEFAULT NULL,
  `qualite` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'img/photo_default.png',
  `victoireChamp` int(25) DEFAULT NULL,
  PRIMARY KEY (`id_Joueur`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id_Joueur`, `nom`, `prenom`, `surnom`, `password`, `meilleureperformance`, `defaut`, `qualite`, `photo`, `victoireChamp`) VALUES
  (1, 'Houisse', 'Nicolas', 'Dézaxé', 'coucou', NULL, 'aucun', 'Carresseur de balle', 'img/photo_default.png', 6589423),
  (2, 'Blot', 'Aurelien', 'Castruche', 'coucou', NULL, 'trop fort', 'aucune lucidité', 'img/photo_default.png', 0),
  (3, 'Pepion', 'Elvis', 'El Mas Grande', 'coucou', NULL, 'trop collectif', 'trop collectif', 'img/photo_default.png', 0),
  (4, 'Monnerie', 'Monnerie', 'le cisailleur', 'coucou', 'null', 'nul devant', 'grosse frappe de balle', 'img/photo_default.png', 0),
  (5, 'Toto', 'Tata', 'TotoTata', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
  (6, 'Coco', 'Cici', 'CocoCici', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
  (7, 'Michel', 'David', 'MD', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
  (8, 'Dupond', 'Jean-Luc', 'JLD', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
  (9, 'Durand', 'Daniel', 'DD', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
  (10, 'Boss', 'Hugo', 'The Boss', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
  (11, 'Moris', 'Phillipe', 'KKK', NULL, 'Champ', 'con', 'beau', 'e', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

DROP TABLE IF EXISTS `matchs`;
CREATE TABLE IF NOT EXISTS `matchs` (
  `id_Match` int(11) NOT NULL AUTO_INCREMENT,
  `equipe1` varchar(255) DEFAULT NULL,
  `equipe2` varchar(255) DEFAULT NULL,
  `butEquipe1` int(25) DEFAULT '0',
  `butEquipe2` int(25) DEFAULT '0',
  `vainqueur` int(25) DEFAULT NULL,
  `id_compet` int(11) NOT NULL,
  `type_match` varchar(255) NOT NULL,
  PRIMARY KEY (`id_Match`),
  KEY `FK_match_compet` (`id_compet`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matchs`
--

INSERT INTO `matchs` (`id_Match`, `equipe1`, `equipe2`, `butEquipe1`, `butEquipe2`, `vainqueur`, `id_compet`, `type_match`) VALUES
  (1, '1', '2', 10, 8, NULL, 1, ''),
  (2, '2', '3', 9, 10, NULL, 1, ''),
  (3, '5', '6', 10, 2, NULL, 1, ''),
  (4, '20', '21', NULL, NULL, NULL, 15, 'quart'),
  (5, '22', '23', NULL, NULL, NULL, 15, 'quart'),
  (6, '24', '25', NULL, NULL, NULL, 16, 'quart'),
  (7, '26', '27', NULL, NULL, NULL, 16, 'quart'),
  (8, NULL, NULL, NULL, NULL, NULL, 16, 'demi'),
  (9, NULL, NULL, NULL, NULL, NULL, 16, 'demi'),
  (10, NULL, NULL, NULL, NULL, NULL, 16, 'finale'),
  (11, '28', '29', NULL, NULL, NULL, 17, 'quart'),
  (12, '30', '31', NULL, NULL, NULL, 17, 'quart'),
  (13, NULL, NULL, NULL, NULL, NULL, 17, 'demi'),
  (14, NULL, NULL, NULL, NULL, NULL, 17, 'demi'),
  (15, NULL, NULL, NULL, NULL, NULL, 17, 'finale'),
  (16, '32', '33', NULL, NULL, NULL, 18, 'demi'),
  (17, '34', '35', NULL, NULL, NULL, 18, 'demi'),
  (18, NULL, NULL, NULL, NULL, NULL, 18, 'finale'),
  (19, '36', '37', NULL, NULL, NULL, 19, 'demi'),
  (20, '38', '39', NULL, NULL, NULL, 19, 'demi'),
  (21, NULL, NULL, NULL, NULL, NULL, 19, 'finale'),
  (22, '40', '41', NULL, NULL, NULL, 20, 'demi'),
  (23, '42', '43', NULL, NULL, NULL, 20, 'demi'),
  (24, NULL, NULL, NULL, NULL, NULL, 20, 'finale'),
  (25, '44', '45', NULL, NULL, NULL, 21, 'demi'),
  (26, '46', '47', NULL, NULL, NULL, 21, 'demi'),
  (27, NULL, NULL, NULL, NULL, NULL, 21, 'finale'),
  (28, '48', '49', 7, 6, 48, 22, 'demi'),
  (29, '50', '51', 4, 6, 50, 22, 'demi'),
  (30, NULL, NULL, NULL, NULL, NULL, 22, 'finale'),
  (31, '52', '53', NULL, NULL, NULL, 23, 'demi'),
  (32, '54', '55', NULL, NULL, NULL, 23, 'demi'),
  (33, NULL, NULL, NULL, NULL, NULL, 23, 'finale'),
  (34, '56', '57', 10, 0, 56, 24, 'demi'),
  (35, '58', '59', 2, 4, 59, 24, 'demi'),
  (36, '56', '59', NULL, NULL, NULL, 24, 'finale'),
  (37, '60', '61', 0, 0, 60, 25, 'demi'),
  (38, '62', '63', 0, 0, 62, 25, 'demi'),
  (39, '60', '62', NULL, NULL, NULL, 25, 'finale'),
  (121, '733', '734', 4, 0, 733, 320014, 'demi'),
  (122, '735', '736', 5, 0, 735, 320014, 'demi'),
  (123, '735', '733', 10, 0, NULL, 320014, 'finale'),
  (124, '737', '738', 0, 0, NULL, 320015, 'demi'),
  (125, '739', '740', 0, 0, NULL, 320015, 'demi'),
  (126, NULL, NULL, 0, 0, NULL, 320015, 'finale'),
  (127, '741', '742', 0, 0, NULL, 320016, 'demi'),
  (128, '743', '744', 0, 0, NULL, 320016, 'demi'),
  (129, NULL, NULL, 0, 0, NULL, 320016, 'finale'),
  (130, '745', '746', 0, 0, NULL, 320017, 'demi'),
  (131, NULL, NULL, 0, 0, NULL, 320017, 'demi'),
  (132, '747', '748', 0, 0, NULL, 320017, 'demi'),
  (133, NULL, NULL, 0, 0, NULL, 320017, 'demi'),
  (134, NULL, NULL, 0, 0, NULL, 320017, 'finale');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `equipes`
--
ALTER TABLE `equipes`
  ADD CONSTRAINT `FK_EquipeCompet` FOREIGN KEY (`id_compet`) REFERENCES `competitions` (`id_competition`);

--
-- Contraintes pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `FK_match_compet` FOREIGN KEY (`id_compet`) REFERENCES `competitions` (`id_competition`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
