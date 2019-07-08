-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 03 juil. 2019 à 09:30
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `terreplurielle`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `designation`) VALUES
(1, 'aucune'),
(2, 'adjectif'),
(3, 'chiffre'),
(4, 'couleur'),
(5, 'demande'),
(6, 'habit'),
(7, 'jouet'),
(8, 'lieu'),
(9, 'mal'),
(10, 'proprete');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `text_question` text COLLATE utf8_unicode_ci NOT NULL,
  `question_user_id` int(11) NOT NULL,
  `question_picto_un` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `question_picto_deux` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `question_picto_trois` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `question_picto_quatre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `question_picto_cinq` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`question_id`, `text_question`, `question_user_id`, `question_picto_un`, `question_picto_deux`, `question_picto_trois`, `question_picto_quatre`, `question_picto_cinq`) VALUES
(15, 'Coucou ca va 2 ?', 41, 'adjectif_froid', 'adjectif_grand', 'adjectif_chaud', '', 'adjectif_fort'),
(17, 'Coucouc, ca va 3 ?', 41, 'adjectif_bon', 'adjectif_peu', 'chiffre_7', '', ''),
(18, 'Le test fonctionne t\'il ?', 41, 'adjectif_bon', 'couleur_blanc', 'demande_etre', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `scategorie`
--

DROP TABLE IF EXISTS `scategorie`;
CREATE TABLE IF NOT EXISTS `scategorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idcategorie` int(11) DEFAULT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `scategorie`
--

INSERT INTO `scategorie` (`id`, `designation`, `idcategorie`, `image`) VALUES
(2, 'beaucoup', 2, 'adjectif_beaucoup'),
(3, 'bon', 2, 'adjectif_bon'),
(4, 'chaud', 2, 'adjectif_chaud'),
(5, 'faible', 2, 'adjectif_faible'),
(6, 'fort', 2, 'adjectif_fort'),
(7, 'froid', 2, 'adjectif_froid'),
(8, 'grand', 2, 'adjectif_grand'),
(9, 'gros', 2, 'adjectif_gros'),
(10, 'leger', 2, 'adjectif_leger'),
(11, 'lourd', 2, 'adjectif_lourd'),
(12, 'mince', 2, 'adjectif_mince'),
(13, 'pas_bon', 2, 'adjectif_pas_bon'),
(14, 'petit', 2, 'adjectif_petit'),
(15, 'peu', 2, 'adjectif_peu'),
(16, 'un', 3, 'chiffre_1'),
(17, 'deux', 3, 'chiffre_2'),
(18, 'trois', 3, 'chiffre_3'),
(19, 'quatre', 3, 'chiffre_4'),
(20, 'cinq', 3, 'chiffre_5'),
(21, 'six', 3, 'chiffre_6'),
(22, 'sept', 3, 'chiffre_7'),
(23, 'huit', 3, 'chiffre_8'),
(24, 'neuf', 3, 'chiffre_9'),
(25, 'dix', 3, 'chiffre_10'),
(26, 'blanc', 4, 'couleur_blanc'),
(27, 'bleu', 4, 'couleur_bleu'),
(28, 'gris', 4, 'couleur_gris'),
(29, 'jaune', 4, 'couleur_jaune'),
(30, 'marron', 4, 'couleur_marron'),
(31, 'mauve', 4, 'couleur_mauve'),
(32, 'noir', 4, 'couleur_noir'),
(33, 'orange', 4, 'couleur_orange'),
(34, 'rose', 4, 'couleur_rose'),
(35, 'rouge', 4, 'couleur_rouge'),
(36, 'vert', 4, 'couleur_vert'),
(37, 'avoir', 5, 'demande_avoir'),
(38, 'etre', 5, 'demande_etre'),
(39, 'vouloir', 5, 'demande_vouloir'),
(40, 'bonnet', 6, 'habit_bonnet'),
(41, 'chaussette', 6, 'habit_chaussette'),
(42, 'chemise', 6, 'habit_chemise'),
(43, 'debardeur', 6, 'habit_debardeur'),
(44, 'gant', 6, 'habit_gant'),
(45, 'impermeable', 6, 'habit_impermeable'),
(46, 'jupe', 6, 'habit_jupe'),
(47, 'manteau', 6, 'habit_manteau'),
(48, 'pantalon', 6, 'habit_pantalon'),
(49, 'polo', 6, 'habit_polo'),
(50, 'pull', 6, 'habit_pullt'),
(51, 'pullzip', 6, 'habit_pullzip'),
(52, 'robe', 6, 'habit_robe'),
(53, 'short', 6, 'habit_short'),
(54, 'slip', 6, 'habit_slip'),
(55, 'teeshirt', 6, 'habit_teeshirt'),
(56, 'veste', 6, 'habit_veste'),
(57, 'ballon', 7, 'jouet_ballon'),
(58, 'cartes', 7, 'jouet_cartes'),
(59, 'chateau', 7, 'jouet_chateau'),
(60, 'console', 7, 'jouet_console'),
(61, 'de', 7, 'jouet_de'),
(62, 'dominos', 7, 'jouet_dominos'),
(63, 'fusee', 7, 'jouet_fusee'),
(64, 'poupee', 7, 'jouet_poupee'),
(65, 'puzzle', 7, 'jouet_puzzle'),
(66, 'balancoire', 8, 'lieu_balancoire'),
(67, 'ecole', 8, 'lieu_ecole'),
(68, 'hopital', 8, 'lieu_hopital'),
(69, 'ime', 8, 'lieu_ime'),
(70, 'jardin', 8, 'lieu_jardin'),
(71, 'maison', 8, 'lieu_maison'),
(72, 'mer', 8, 'lieu_mer'),
(73, 'montagne', 8, 'lieu_montagne'),
(74, 'parc', 8, 'lieu_parc'),
(75, 'piscine', 8, 'lieu_piscine'),
(76, 'plage', 8, 'lieu_plage'),
(77, 'bouche', 9, 'lieu_bouche'),
(78, 'bras', 9, 'lieu_bras'),
(79, 'coudes', 9, 'lieu_coudes'),
(80, 'dents', 9, 'lieu_dents'),
(81, 'dos', 9, 'lieu_dos'),
(82, 'epaules', 9, 'lieu_epaules'),
(83, 'fesses', 9, 'lieu_fesses'),
(84, 'genoux', 9, 'lieu_genoux'),
(85, 'jambes', 9, 'lieu_jambes'),
(86, 'mains', 9, 'lieu_mains'),
(87, 'mollet', 9, 'lieu_mollet'),
(88, 'oeil', 9, 'lieu_oeil'),
(89, 'oreilles', 9, 'lieu_oreilles'),
(90, 'pieds', 9, 'lieu_pieds'),
(91, 'tete', 9, 'lieu_tete'),
(92, 'ventre', 9, 'lieu_ventre'),
(93, 'bain', 10, 'proprete_bain'),
(94, 'laver_mains', 10, 'proprete_laver_mains'),
(95, 'toilettes', 10, 'proprete_toilettes');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` text COLLATE utf8_unicode_ci NOT NULL,
  `user_email` text COLLATE utf8_unicode_ci NOT NULL,
  `user_password` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(41, 'Stephane', 'stephane.pjc@gmail.com', '098f6bcd4621d373cade4e832627b4f6');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
