-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 18 jan. 2018 à 15:58
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
