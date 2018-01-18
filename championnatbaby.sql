-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 18 jan. 2018 à 16:05
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

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
  `id_competition` int(25) NOT NULL AUTO_INCREMENT,
  `nomChamp` varchar(25) DEFAULT NULL,
  `nbreJoueurs` int(25) DEFAULT NULL,
  `terminée` tinyint(1) DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  PRIMARY KEY (`id_competition`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `competitions`
--

INSERT INTO `competitions` (`id_competition`, `nomChamp`, `nbreJoueurs`, `terminée`, `dateDebut`) VALUES
(1, 'copa del mondo', 4, NULL, NULL),
(2, 'coupe EPSI', 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `equipes`
--

DROP TABLE IF EXISTS `equipes`;
CREATE TABLE IF NOT EXISTS `equipes` (
  `id_Equipe` int(11) NOT NULL AUTO_INCREMENT,
  `joueur1` int(11) NOT NULL,
  `joueur2` int(11) NOT NULL,
  PRIMARY KEY (`id_Equipe`),
  KEY `fk_joueur1` (`joueur1`),
  KEY `fk_joueur2` (`joueur2`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `equipes`
--

INSERT INTO `equipes` (`id_Equipe`, `joueur1`, `joueur2`) VALUES
(1, 1, 2),
(2, 3, 4),
(3, 1, 3),
(4, 2, 4),
(5, 1, 4),
(6, 2, 3);

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
  `meilleureperformance` varchar(255) DEFAULT NULL,
  `defaut` varchar(255) DEFAULT NULL,
  `qualité` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT 'img/photo_default.png',
  `victoireChamp` int(25) DEFAULT NULL,
  PRIMARY KEY (`id_Joueur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `joueurs`
--

INSERT INTO `joueurs` (`id_Joueur`, `nom`, `prenom`, `surnom`, `meilleureperformance`, `defaut`, `qualité`, `photo`, `victoireChamp`) VALUES
(1, 'Houisse', 'Nicolas', 'Dézaxé', NULL, 'aucun', 'Carresseur de balle', 'img/photo_default.png', 0),
(2, 'Blot', 'Aurelien', 'Castruche', NULL, 'trop fort', 'aucune lucidité', 'img/photo_default.png', 0),
(3, 'Pepion', 'Elvis', 'El Mas Grande', NULL, 'trop collectif', 'trop collectif', 'img/photo_default.png', 0),
(4, 'Monnerie', 'Monnerie', 'le cisailleur', 'null', 'nul devant', 'grosse frappe de balle', 'img/photo_default.png', 0);

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

DROP TABLE IF EXISTS `matchs`;
CREATE TABLE IF NOT EXISTS `matchs` (
  `id_Match` int(11) NOT NULL AUTO_INCREMENT,
  `equipe1` varchar(255) NOT NULL,
  `equipe2` varchar(255) NOT NULL,
  `butEquipe1` int(25) DEFAULT NULL,
  `butEquipe2` int(25) DEFAULT NULL,
  `vainqueur` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_Match`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `matchs`
--

INSERT INTO `matchs` (`id_Match`, `equipe1`, `equipe2`, `butEquipe1`, `butEquipe2`, `vainqueur`) VALUES
(1, '1', '2', 10, 8, NULL),
(2, '2', '3', 9, 10, NULL),
(3, '5', '6', 10, 2, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
