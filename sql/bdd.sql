-- phpMyAdmin SQL Dump
-- version 4.5.3.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 18 Octobre 2016 à 18:19
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
  `titre` varchar(50) NOT NULL,
  `bareme` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `critere`
--

INSERT INTO `critere` (`id`, `titre`, `bareme`) VALUES
(1, 'test1', 1),
(2, 'test2', 2);

-- --------------------------------------------------------

--
-- Structure de la table `critere_groupe_notation_jonction`
--

CREATE TABLE `critere_groupe_notation_jonction` (
  `id` int(11) NOT NULL,
  `id_critere` int(11) NOT NULL,
  `id_groupe_notation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `critere_groupe_notation_jonction`
--

INSERT INTO `critere_groupe_notation_jonction` (`id`, `id_critere`, `id_groupe_notation`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `id_soutenance` int(11) DEFAULT NULL,
  `id_promotion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groupe_notation`
--

CREATE TABLE `groupe_notation` (
  `id` int(11) NOT NULL,
  `titre` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groupe_notation`
--

INSERT INTO `groupe_notation` (`id`, `titre`) VALUES
(1, 'ptut');

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `id` int(11) NOT NULL,
  `duree` time NOT NULL,
  `titre` varchar(50) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `id_groupe_notation` int(11) DEFAULT NULL
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
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `soutenance`
--

CREATE TABLE `soutenance` (
  `id` int(11) NOT NULL,
  `id_salle` int(11) NOT NULL,
  `horaire` time NOT NULL,
  `date` date NOT NULL,
  `professeur1` varchar(25) NOT NULL,
  `professeur2` varchar(50) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `resume` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `critere`
--
ALTER TABLE `critere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `critere_groupe_notation_jonction`
--
ALTER TABLE `critere_groupe_notation_jonction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_critere` (`id_critere`),
  ADD KEY `id_planning` (`id_groupe_notation`);

--
-- Index pour la table `groupe_notation`
--
ALTER TABLE `groupe_notation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `soutenance`
--
ALTER TABLE `soutenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professeur1` (`professeur1`),
  ADD KEY `professeur2` (`professeur2`),
  ADD KEY `id_salle` (`id_salle`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `critere`
--
ALTER TABLE `critere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `critere_groupe_notation_jonction`
--
ALTER TABLE `critere_groupe_notation_jonction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `groupe_notation`
--
ALTER TABLE `groupe_notation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `soutenance`
--
ALTER TABLE `soutenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
