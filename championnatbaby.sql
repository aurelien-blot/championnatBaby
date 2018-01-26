-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 26 jan. 2018 à 13:23
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
  `dateDebut` date NOT NULL,
  PRIMARY KEY (`id_competition`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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
(23, 'Tournoi 2', 8, 0, '2018-02-25');

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

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
(40, 1, 5, 20),
(41, 3, 6, 20),
(42, 7, 2, 20),
(43, 4, 8, 20),
(44, 1, 6, 21),
(45, 3, 5, 21),
(46, 7, 2, 21),
(47, 4, 8, 21),
(48, 1, 4, 22),
(49, 3, 2, 22),
(50, 7, 6, 22),
(51, 5, 8, 22),
(52, 1, 5, 23),
(53, 3, 7, 23),
(54, 6, 2, 23),
(55, 4, 8, 23);

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
  `password` varchar(255) NOT NULL,
  `meilleureperformance` varchar(255) DEFAULT NULL,
  `defaut` varchar(255) DEFAULT NULL,
  `qualité` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'img/photo_default.png',
  `victoireChamp` int(25) DEFAULT NULL,
  PRIMARY KEY (`id_Joueur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id_Joueur`, `nom`, `prenom`, `surnom`, `password`, `meilleureperformance`, `defaut`, `qualité`, `photo`, `victoireChamp`) VALUES
(1, 'Houisse', 'Nicolas', 'Dézaxé', 'coucou', NULL, 'aucun', 'Carresseur de balle', 'img/photo_default.png', 6589423),
(2, 'Blot', 'Aurelien', 'Castruche', 'coucou', NULL, 'trop fort', 'aucune lucidité', 'img/photo_default.png', 0),
(3, 'Pepion', 'Elvis', 'El Mas Grande', 'coucou', NULL, 'trop collectif', 'trop collectif', 'img/photo_default.png', 0),
(4, 'Monnerie', 'Monnerie', 'le cisailleur', 'coucou', 'null', 'nul devant', 'grosse frappe de balle', 'img/photo_default.png', 0),
(5, 'Toto', 'Tata', 'TotoTata', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
(6, 'Coco', 'Cici', 'CocoCici', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
(7, 'Michel', 'David', 'MD', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
(8, 'Dupond', 'Jean-Luc', 'JLD', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
(9, 'Durand', 'Daniel', 'DD', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL),
(10, 'Boss', 'Hugo', 'The Boss', 'coucou', NULL, NULL, NULL, 'img/photo_default.png', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

DROP TABLE IF EXISTS `matchs`;
CREATE TABLE IF NOT EXISTS `matchs` (
  `id_Match` int(11) NOT NULL AUTO_INCREMENT,
  `equipe1` varchar(255) DEFAULT NULL,
  `equipe2` varchar(255) DEFAULT NULL,
  `butEquipe1` int(25) DEFAULT NULL,
  `butEquipe2` int(25) DEFAULT NULL,
  `vainqueur` varchar(25) DEFAULT NULL,
  `id_compet` int(11) NOT NULL,
  `type_match` varchar(255) NOT NULL,
  PRIMARY KEY (`id_Match`),
  KEY `FK_match_compet` (`id_compet`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

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
(28, '48', '49', NULL, NULL, NULL, 22, 'demi'),
(29, '50', '51', NULL, NULL, NULL, 22, 'demi'),
(30, NULL, NULL, NULL, NULL, NULL, 22, 'finale'),
(31, '52', '53', NULL, NULL, NULL, 23, 'demi'),
(32, '54', '55', NULL, NULL, NULL, 23, 'demi'),
(33, NULL, NULL, NULL, NULL, NULL, 23, 'finale');

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
