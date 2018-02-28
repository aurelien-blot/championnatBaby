-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 28 fév. 2018 à 10:32
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
) ENGINE=InnoDB AUTO_INCREMENT=320039 DEFAULT CHARSET=latin1;

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
  (320017, 'TestB4', 0, 0, '2020-02-02'),
  (320018, 'B31', 0, 0, '2020-02-03'),
  (320019, 'azdad', 0, 0, '2020-02-04'),
  (320020, 'testb3', 0, 0, '2020-04-04'),
  (320021, 'B32', 0, 1, '2021-02-02'),
  (320022, 'Testfinal8J', 8, 1, '2021-04-04'),
  (320023, 'test101', 10, 0, '2022-01-01'),
  (320024, 'test102', 10, 0, '2022-05-05'),
  (320025, 'test102', 10, 0, '2022-05-05'),
  (320026, 'test103', 10, 0, '2022-05-05'),
  (320027, 'test104', 8, 0, '2022-06-06'),
  (320028, 'test105', 8, 0, '2022-06-06'),
  (320029, 'test106', 8, 0, '2022-07-07'),
  (320030, 'test107', 8, 0, '2022-07-07'),
  (320031, 'test108', 8, 0, '2022-08-08'),
  (320032, 'test109', 8, 0, '2022-02-23'),
  (320033, 'test110', 8, 0, '2023-02-23'),
  (320034, 'test111', 10, 0, '2023-01-01'),
  (320035, 'test112', 10, 0, '2023-01-01'),
  (320036, 'test113', 10, 0, '2023-01-01'),
  (320037, 'test114', 10, 1, '2023-01-01'),
  (320038, 'test115', 10, 0, '2024-01-01');

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
  `pointsPoule` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_Equipe`),
  KEY `fk_joueur1` (`joueur1`),
  KEY `fk_joueur2` (`joueur2`),
  KEY `FK_EquipeCompet` (`id_compet`)
) ENGINE=InnoDB AUTO_INCREMENT=835 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id_Equipe`, `joueur1`, `joueur2`, `id_compet`, `pointsPoule`) VALUES
  (1, 1, 2, 1, 0),
  (2, 3, 4, 1, 0),
  (3, 1, 3, 2, 0),
  (4, 2, 4, 1, 0),
  (5, 1, 4, 2, 0),
  (6, 2, 3, 1, 0),
  (7, 1, 6, 12, 0),
  (8, 3, 7, 12, 0),
  (9, 5, 2, 12, 0),
  (10, 10, 4, 12, 0),
  (11, 8, 9, 12, 0),
  (12, 1, 4, 13, 0),
  (13, 3, 6, 13, 0),
  (14, 7, 5, 13, 0),
  (15, 2, 8, 13, 0),
  (16, 1, 6, 14, 0),
  (17, 3, 8, 14, 0),
  (18, 5, 2, 14, 0),
  (19, 4, 7, 14, 0),
  (20, 1, 4, 15, 0),
  (21, 3, 8, 15, 0),
  (22, 6, 2, 15, 0),
  (23, 5, 7, 15, 0),
  (24, 1, 5, 16, 0),
  (25, 3, 2, 16, 0),
  (26, 7, 4, 16, 0),
  (27, 6, 8, 16, 0),
  (28, 1, 7, 17, 0),
  (29, 3, 2, 17, 0),
  (30, 6, 4, 17, 0),
  (31, 5, 8, 17, 0),
  (32, 1, 8, 18, 0),
  (33, 3, 5, 18, 0),
  (34, 6, 4, 18, 0),
  (35, 2, 7, 18, 0),
  (36, 1, 3, 19, 0),
  (37, 4, 6, 19, 0),
  (38, 7, 5, 19, 0),
  (39, 2, 8, 19, 0),
  (733, 4, 8, 320014, 0),
  (734, 5, 6, 320014, 0),
  (735, 7, 1, 320014, 0),
  (736, 3, 2, 320014, 0),
  (737, 4, 7, 320015, 0),
  (738, 3, 8, 320015, 0),
  (739, 1, 2, 320015, 0),
  (740, 6, 5, 320015, 0),
  (741, 4, 2, 320016, 0),
  (742, 7, 1, 320016, 0),
  (743, 6, 8, 320016, 0),
  (744, 3, 5, 320016, 0),
  (745, 6, 2, 320017, 0),
  (746, 1, 4, 320017, 0),
  (747, 3, 8, 320017, 0),
  (748, 7, 5, 320017, 0),
  (749, 2, 5, 320018, 0),
  (750, 3, 7, 320018, 0),
  (751, 4, 8, 320018, 0),
  (752, 1, 6, 320018, 0),
  (753, 7, 8, 320019, 0),
  (754, 1, 5, 320019, 0),
  (755, 3, 4, 320019, 0),
  (756, 2, 6, 320019, 0),
  (757, 7, 5, 320020, 0),
  (758, 4, 8, 320020, 0),
  (759, 3, 6, 320020, 0),
  (760, 2, 1, 320020, 0),
  (761, 8, 6, 320021, 0),
  (762, 2, 1, 320021, 0),
  (763, 7, 3, 320021, 0),
  (764, 4, 5, 320021, 0),
  (765, 3, 8, 320022, 0),
  (766, 7, 5, 320022, 0),
  (767, 6, 10, 320022, 0),
  (768, 1, 11, 320022, 0),
  (769, 1, 3, 320023, 4),
  (770, 2, 6, 320023, 0),
  (771, 4, 9, 320023, 2),
  (772, 10, 5, 320023, 0),
  (773, 6, 3, 320025, 0),
  (774, 4, 5, 320025, 0),
  (775, 2, 1, 320025, 0),
  (776, 8, 9, 320025, 0),
  (777, 7, 10, 320025, 0),
  (778, 8, 4, 320026, 1),
  (779, 5, 2, 320026, 0),
  (780, 10, 1, 320026, 2),
  (781, 9, 7, 320026, 2),
  (782, 6, 3, 320026, 0),
  (783, 5, 8, 320027, 3),
  (784, 6, 2, 320027, 0),
  (785, 1, 7, 320027, 0),
  (786, 3, 4, 320027, 0),
  (787, 3, 2, 320028, 0),
  (788, 5, 1, 320028, 0),
  (789, 8, 6, 320028, 0),
  (790, 7, 4, 320028, 0),
  (791, 8, 4, 320029, 0),
  (792, 2, 1, 320029, 0),
  (793, 5, 3, 320029, 0),
  (794, 6, 7, 320029, 0),
  (795, 3, 1, 320030, 0),
  (796, 5, 4, 320030, 0),
  (797, 6, 7, 320030, 0),
  (798, 8, 2, 320030, 0),
  (799, 1, 2, 320031, 0),
  (800, 5, 6, 320031, 0),
  (801, 7, 3, 320031, 0),
  (802, 4, 8, 320031, 0),
  (803, 8, 3, 320032, 0),
  (804, 5, 2, 320032, 0),
  (805, 1, 7, 320032, 0),
  (806, 6, 4, 320032, 0),
  (807, 5, 1, 320033, 0),
  (808, 8, 7, 320033, 0),
  (809, 2, 6, 320033, 0),
  (810, 3, 4, 320033, 0),
  (811, 8, 6, 320034, 0),
  (812, 3, 5, 320034, 0),
  (813, 7, 1, 320034, 0),
  (814, 4, 2, 320034, 0),
  (815, 8, 9, 320035, 3),
  (816, 10, 2, 320035, 1),
  (817, 3, 6, 320035, 2),
  (818, 5, 1, 320035, 6),
  (819, 7, 4, 320035, 2),
  (820, 9, 7, 320036, 4),
  (821, 5, 8, 320036, 2),
  (822, 3, 1, 320036, 1),
  (823, 4, 6, 320036, 0),
  (824, 2, 10, 320036, 3),
  (825, 4, 10, 320037, 4),
  (826, 5, 6, 320037, 3),
  (827, 3, 7, 320037, 2),
  (828, 2, 1, 320037, 1),
  (829, 9, 8, 320037, 0),
  (830, 8, 7, 320038, 0),
  (831, 9, 3, 320038, 0),
  (832, 10, 5, 320038, 0),
  (833, 6, 4, 320038, 0),
  (834, 11, 1, 320038, 0);

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
  (11, 'Moris', 'Phillipe', 'KKK', NULL, 'Champ', 'con', 'beau', 'e', NULL),
  (12, 'Rabbit', 'Roger', 'Lapin', NULL, '', 'nul', 'fort', 'img/photo_default.png', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=265 DEFAULT CHARSET=latin1;

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
  (134, NULL, NULL, 0, 0, NULL, 320017, 'finale'),
  (135, '749', '750', 0, 0, NULL, 320018, 'demi'),
  (136, NULL, NULL, 0, 0, NULL, 320018, 'demi'),
  (137, '751', '752', 0, 0, NULL, 320018, 'demi'),
  (138, NULL, NULL, 0, 0, NULL, 320018, 'demi'),
  (139, NULL, NULL, 0, 0, NULL, 320018, 'finale'),
  (140, '753', '754', 0, 0, NULL, 320019, 'demi'),
  (141, NULL, NULL, 0, 0, NULL, 320019, 'demi'),
  (142, '755', '756', 0, 0, NULL, 320019, 'demi'),
  (143, NULL, NULL, 0, 0, NULL, 320019, 'demi'),
  (144, NULL, NULL, 0, 0, NULL, 320019, 'finale'),
  (145, '757', '758', 6, 11, 757, 320020, 'demi'),
  (146, '759', '760', 0, 0, 760, 320020, 'demi'),
  (147, '757', '760', 0, 6, 760, 320020, 'finale'),
  (148, '761', '762', 0, 11, 762, 320021, 'demi'),
  (149, '763', '764', 4, 0, 763, 320021, 'demi'),
  (150, '762', '763', 8, 0, 762, 320021, 'finale'),
  (151, '765', '766', 0, 0, 765, 320022, 'demi'),
  (152, '767', '768', 0, 14, 767, 320022, 'demi'),
  (153, '765', '767', 0, 0, 765, 320022, 'finale'),
  (154, '769', '770', 0, 0, NULL, 320023, 'demi'),
  (155, '771', '772', 0, 0, NULL, 320023, 'demi'),
  (156, NULL, NULL, 0, 0, NULL, 320023, 'finale'),
  (157, '773', '774', 3, 6, 773, 320025, 'poule'),
  (158, '773', '775', 0, 0, 773, 320025, 'poule'),
  (159, '773', '776', 1, 14, 776, 320025, 'poule'),
  (160, '773', '777', 0, 0, 773, 320025, 'poule'),
  (161, '774', '775', 0, 0, NULL, 320025, 'poule'),
  (162, '774', '776', 0, 0, NULL, 320025, 'poule'),
  (163, '774', '777', 0, 0, NULL, 320025, 'poule'),
  (164, '775', '776', 0, 0, NULL, 320025, 'poule'),
  (165, '775', '777', 0, 0, NULL, 320025, 'poule'),
  (166, '776', '777', 0, 0, NULL, 320025, 'poule'),
  (167, NULL, NULL, 0, 0, NULL, 320025, 'demi'),
  (168, NULL, NULL, 0, 0, NULL, 320025, 'demi'),
  (169, NULL, NULL, 0, 0, NULL, 320025, 'fausseFinale'),
  (170, '773', '776', 0, 0, NULL, 320025, 'finale'),
  (171, '778', '779', 0, 0, 778, 320026, 'poule'),
  (172, '778', '780', 0, 0, NULL, 320026, 'poule'),
  (173, '778', '781', 0, 0, NULL, 320026, 'poule'),
  (174, '778', '782', 0, 0, NULL, 320026, 'poule'),
  (175, '779', '780', 0, 0, NULL, 320026, 'poule'),
  (176, '779', '781', 0, 0, NULL, 320026, 'poule'),
  (177, '779', '782', 0, 0, NULL, 320026, 'poule'),
  (178, '780', '781', 0, 0, NULL, 320026, 'poule'),
  (179, '780', '782', 0, 0, NULL, 320026, 'poule'),
  (180, '781', '782', 0, 0, NULL, 320026, 'poule'),
  (181, NULL, NULL, 0, 0, NULL, 320026, 'demi'),
  (182, NULL, NULL, 0, 0, NULL, 320026, 'demi'),
  (183, NULL, NULL, 0, 0, NULL, 320026, 'fausseFinale'),
  (184, '778', NULL, 0, 0, NULL, 320026, 'finale'),
  (185, '783', '784', 2, 0, 783, 320027, 'demi'),
  (186, '785', '786', 0, 0, 785, 320027, 'demi'),
  (187, '783', NULL, 0, 0, NULL, 320027, 'finale'),
  (188, '787', '788', 0, 5, 788, 320028, 'demi'),
  (189, '789', '790', 0, 0, 789, 320028, 'demi'),
  (190, NULL, NULL, 0, 0, NULL, 320028, 'finale'),
  (191, '791', '792', 0, 0, 791, 320029, 'demi'),
  (192, '793', '794', 0, 0, NULL, 320029, 'demi'),
  (193, 'demi', NULL, 0, 0, NULL, 320029, 'finale'),
  (194, '795', '796', 14, 0, 795, 320030, 'demi'),
  (195, '797', '798', 0, 4, 798, 320030, 'demi'),
  (196, '795', '798', 0, 0, NULL, 320030, 'finale'),
  (197, '799', '800', 0, 0, 800, 320031, 'demi'),
  (198, '801', '802', 0, 0, 802, 320031, 'demi'),
  (199, '800', '802', 0, 0, NULL, 320031, 'finale'),
  (200, '803', '804', 0, 0, 803, 320032, 'demi'),
  (201, '805', '806', 0, 0, 805, 320032, 'demi'),
  (202, '803', '805', 0, 0, NULL, 320032, 'finale'),
  (203, '807', '808', 0, 0, 807, 320033, 'demi'),
  (204, '809', '810', 0, 0, 810, 320033, 'demi'),
  (205, '807', '810', 0, 0, NULL, 320033, 'finale'),
  (206, '811', '812', 0, 0, NULL, 320034, 'demi'),
  (207, '813', '814', 0, 0, NULL, 320034, 'demi'),
  (208, NULL, NULL, 0, 0, NULL, 320034, 'finale'),
  (209, '815', '816', 0, 0, 815, 320035, 'poule'),
  (210, '815', '817', 0, 0, 815, 320035, 'poule'),
  (211, '815', '818', 0, 0, 815, 320035, 'poule'),
  (212, '815', '819', 0, 0, 819, 320035, 'poule'),
  (213, '816', '817', 0, 0, 817, 320035, 'poule'),
  (214, '816', '818', 0, 0, 816, 320035, 'poule'),
  (215, '816', '819', 0, 0, 819, 320035, 'poule'),
  (216, '817', '818', 0, 0, 818, 320035, 'poule'),
  (217, '817', '819', 0, 0, 817, 320035, 'poule'),
  (218, '818', '819', 0, 0, 818, 320035, 'poule'),
  (219, '815', '816', 0, 0, 815, 320035, 'demi'),
  (220, '817', '819', 0, 0, NULL, 320035, 'demi'),
  (221, NULL, NULL, 0, 0, NULL, 320035, 'fausseFinale'),
  (222, '818', '815', 0, 0, NULL, 320035, 'finale'),
  (223, '820', '821', 0, 0, 820, 320036, 'poule'),
  (224, '820', '822', 0, 0, 820, 320036, 'poule'),
  (225, '820', '823', 0, 0, 820, 320036, 'poule'),
  (226, '820', '824', 0, 0, 820, 320036, 'poule'),
  (227, '821', '822', 0, 0, 821, 320036, 'poule'),
  (228, '821', '823', 0, 0, 821, 320036, 'poule'),
  (229, '821', '824', 0, 0, 824, 320036, 'poule'),
  (230, '822', '823', 0, 0, 822, 320036, 'poule'),
  (231, '822', '824', 0, 0, 824, 320036, 'poule'),
  (232, '823', '824', 0, 0, 824, 320036, 'poule'),
  (233, '821', '822', 0, 0, 821, 320036, 'demi'),
  (234, '823', '824', 0, 0, 823, 320036, 'demi'),
  (235, '823', NULL, 0, 0, NULL, 320036, 'fausseFinale'),
  (236, '820', NULL, 0, 0, NULL, 320036, 'finale'),
  (237, '825', '826', 0, 0, 825, 320037, 'poule'),
  (238, '825', '827', 0, 0, 825, 320037, 'poule'),
  (239, '825', '828', 0, 0, 825, 320037, 'poule'),
  (240, '825', '829', 0, 0, 825, 320037, 'poule'),
  (241, '826', '827', 0, 0, 826, 320037, 'poule'),
  (242, '826', '828', 0, 0, 826, 320037, 'poule'),
  (243, '826', '829', 0, 0, 826, 320037, 'poule'),
  (244, '827', '828', 0, 0, 827, 320037, 'poule'),
  (245, '827', '829', 0, 0, 827, 320037, 'poule'),
  (246, '828', '829', 0, 0, 828, 320037, 'poule'),
  (247, '826', '827', 0, 0, 826, 320037, 'demi'),
  (248, '828', '829', 0, 0, 828, 320037, 'demi'),
  (249, '826', '828', 0, 0, 826, 320037, 'fausseFinale'),
  (250, '825', '826', 0, 0, 825, 320037, 'finale'),
  (251, '830', '831', 0, 0, NULL, 320038, 'poule'),
  (252, '830', '832', 0, 0, NULL, 320038, 'poule'),
  (253, '830', '833', 0, 0, NULL, 320038, 'poule'),
  (254, '830', '834', 0, 0, NULL, 320038, 'poule'),
  (255, '831', '832', 0, 0, NULL, 320038, 'poule'),
  (256, '831', '833', 0, 0, NULL, 320038, 'poule'),
  (257, '831', '834', 0, 0, NULL, 320038, 'poule'),
  (258, '832', '833', 0, 0, NULL, 320038, 'poule'),
  (259, '832', '834', 0, 0, NULL, 320038, 'poule'),
  (260, '833', '834', 0, 0, NULL, 320038, 'poule'),
  (261, NULL, NULL, 0, 0, NULL, 320038, 'demi'),
  (262, NULL, NULL, 0, 0, NULL, 320038, 'demi'),
  (263, NULL, NULL, 0, 0, NULL, 320038, 'fausseFinale'),
  (264, NULL, NULL, 0, 0, NULL, 320038, 'finale');

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
