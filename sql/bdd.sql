-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 18 Octobre 2016 à 10:39
-- Version du serveur :  5.7.10
-- Version de PHP :  5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `agos`
--

-- --------------------------------------------------------

--
-- Structure de la table `critere`
--

CREATE TABLE `critere` (
  `id` int(11) NOT NULL,
  `crit1` varchar(50) NOT NULL,
  `crit2` varchar(50) NOT NULL,
  `crit3` varchar(50) NOT NULL,
  `crit4` varchar(50) NOT NULL,
  `crit5` varchar(50) NOT NULL,
  `crit6` varchar(50) NOT NULL,
  `not1` float NOT NULL,
  `not2` float NOT NULL,
  `not3` float NOT NULL,
  `not4` float NOT NULL,
  `not5` float NOT NULL,
  `not6` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `id_soutenance` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `id` int(11) NOT NULL,
  `duree` time NOT NULL,
  `titre` varchar(50) NOT NULL,
  `groupe` varchar(25) NOT NULL,
  `id_critere` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `abreviation` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `soutenance`
--

CREATE TABLE `soutenance` (
  `id` int(11) NOT NULL,
  `salle` varchar(25) NOT NULL,
  `horaire` time NOT NULL,
  `date` date NOT NULL,
  `professeur1` varchar(25) NOT NULL,
  `professeur2` varchar(50) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `resume` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `critere`
--
ALTER TABLE `critere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `soutenance`
--
ALTER TABLE `soutenance`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `critere`
--
ALTER TABLE `critere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `soutenance`
--
ALTER TABLE `soutenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
